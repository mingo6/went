<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 10:56
 */

namespace app\modules\mch\controllers;

use app\models\Attr;
use app\models\AttrGroup;
use app\models\Card;
use app\models\Cat;
use app\models\Coupon;
use app\models\Goods;
use app\models\Level;
use app\models\CouponGoodsLevel;
use app\models\GoodsCard;
use app\models\PostageRules;
use app\modules\mch\models\CatForm;
use app\modules\mch\models\CopyForm;
use app\modules\mch\models\GoodsForm;
use app\modules\mch\models\CouponGoodsLevelForm;
use yii\data\Pagination;
use yii\helpers\VarDumper;
use yii\web\HttpException;

/**
 * Class GoodController
 * @package app\modules\mch\controllers
 * 商品
 */
class GoodsController extends Controller
{


    /**
     * 商品分类删除
     * @param int $id
     */
    public function actionGoodClassDel($id = 0)
    {
        $dishes = Cat::findOne(['id' => $id, 'is_delete' => 0, 'store_id' => $this->store->id]);
        if (!$dishes) {
            $this->renderJson([
                'code' => 1,
                'msg' => '商品分类删除失败或已删除'
            ]);
        }
        $dishes->is_delete = 1;
        if ($dishes->save()) {
            $this->renderJson([
                'code' => 0,
                'msg' => '成功'
            ]);
        } else {
            foreach ($dishes->errors as $errors) {
                $this->renderJson([
                    'code' => 1,
                    'msg' => $errors[0],
                ]);
            }
        }
    }

    public function actionGetCatList($parent_id = 0)
    {
        $list = Cat::find()->select('id,name')->where(['is_delete' => 0, 'parent_id' => $parent_id, 'store_id' => $this->store->id])->asArray()->all();
        return $this->renderJson([
            'code' => 0,
            'data' => $list
        ]);
    }

    /**
     * 商品管理
     * @return string
     */
    public function actionGoods($keyword = null)
    {
        $query = Goods::find()->alias('g')->where(['g.store_id' => $this->store->id, 'g.is_delete' => 0]);
        $query->leftJoin(['c' => Cat::tableName()], 'c.id=g.cat_id');
        $cat_query = clone $query;
        if (trim($keyword)) {
            $query->andWhere([
                'OR',
                ['LIKE', 'g.name', $keyword],
                ['LIKE', 'c.name', $keyword],
            ]);
        }
        if (isset($_GET['cat'])) {
            $cat = trim($_GET['cat']);
            $query->andWhere(['like', 'c.name', $cat]);
        }
        $cat_list = $cat_query->groupBy('g.cat_id')->orderBy(['g.cat_id' => SORT_ASC])->select(['c.name'])->asArray()->column();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,]);
        $list = $query->orderBy('g.sort ASC,g.addtime DESC')->limit($pagination->limit)->offset($pagination->offset)->all();

        return $this->render('goods', [
            'list' => $list,
            'pagination' => $pagination,
            'cat_list' => $cat_list
        ]);
    }

    /**
     * 商品修改
     * @param int $id
     * @return string
     */
    public function actionGoodsEdit($id = 0)
    {
        $goods = Goods::findOne(['id' => $id, 'store_id' => $this->store->id]);
        if (!$goods) {
            $goods = new Goods();
        }
        $form = new GoodsForm();
        if (\Yii::$app->request->isPost) {
            $model = \Yii::$app->request->post('model');
            $model['store_id'] = $this->store->id;
            $form->attributes = $model;
            $form->attr = \Yii::$app->request->post('attr');
            $form->goods_card = \Yii::$app->request->post('goods_card');
            $form->full_cut = \Yii::$app->request->post('full_cut');
            $form->integral = \Yii::$app->request->post('integral');
            $form->goods = $goods;
            return json_encode($form->save(), JSON_UNESCAPED_UNICODE);
        }

        $cat_list = Cat::find()->where(['store_id' => $this->store->id, 'is_delete' => 0, 'parent_id' => 0])->all();
        $postageRiles = PostageRules::find()->where(['store_id' => $this->store->id, 'is_delete' => 0])->all();
        $card_list = Card::find()->where(['store_id' => $this->store->id, 'is_delete' => 0])->asArray()->all();
        if ($goods->full_cut) {
            $goods->full_cut = json_decode($goods->full_cut, true);
        } else {
            $goods->full_cut = [
                'pieces' => '',
                'forehead' => '',
            ];
        }
        if ($goods->integral) {
            $goods->integral = json_decode($goods->integral, true);
        } else {
            $goods->integral = [
                'give' => 0,
                'deduction' => 0,
                'more' => 0,
            ];
        }
        $goods_card_list = Goods::getGoodsCard($goods->id);
        return $this->render('goods-edit', [
            'goods' => $goods,
            'cat_list' => $cat_list,
            'postageRiles' => $postageRiles,
            'card_list' => json_encode($card_list, JSON_UNESCAPED_UNICODE),
            'goods_card_list' => json_encode($goods_card_list, JSON_UNESCAPED_UNICODE)
        ]);
    }


    /**
     * 商品优惠券管理列表
     */

    public function actionGoodsCoupon($id)
    {
        $query = CouponGoodsLevel::find()->alias('a')->where(['a.store_id' => $this->store->id, 'a.goods_id' =>$id]);
        $query->leftJoin(['b' => Coupon::tableName()], 'a.coupon_id = b.id');
        $query->leftJoin(['c' => Level::tableName()], 'a.level_id = c.id');
        $query ->select(['a.*','b.name as coupon_name','c.name as level_name']);
        $list = $query->asArray()->all();
        return $this->render('goods-coupon', [
            'list' => $list,
            'goods_id'=>$id,
        ]);

    }





    /**
     * 商品优惠券管理编辑、添加
     * @param int $id
     * @return string
     */
    public function actionGoodsCouponEdit($id = 0)
    {

        $goods_id = \Yii::$app->request->get('goods_id');
        $coupondetail = CouponGoodsLevel::findOne(['id' => $id,'store_id' => $this->store->id]);
        if (!$coupondetail) {
            $coupondetail = new CouponGoodsLevel();
        }
        $form = new CouponGoodsLevelForm();
        if (\Yii::$app->request->isPost) {
          //  $form->attributes = $model;
            $form->goods_id = \Yii::$app->request->post('goods_id');
            $form->coupon_id = \Yii::$app->request->post('coupon_id');
            $form->level_id = \Yii::$app->request->post('level_id');
            $form->num = \Yii::$app->request->post('num');
            $form->store_id =  $this->store->id;
            $form->couponGoodsLevel = $coupondetail;

            //检查该商品是否有添加过该等级的优惠券
            if (!$id) {
                $check = CouponGoodsLevel::findOne(['goods_id'=>$form->goods_id,'store_id'=>$form->store_id,'level_id'=>$form->level_id]);
            } else {
               // $check = CouponGoodsLevel::findOne(['goods_id'=>$form->goods_id,'store_id'=>$form->store_id,'level_id'=>$form->level_id]);
                $check = CouponGoodsLevel::find()->andWhere(['=','goods_id',$form->goods_id])->andWhere(['=','store_id',$form->store_id])->andWhere(['=','level_id',$form->level_id])->andWhere(['!=','id',$id])->one();
            }
            if ($check) {
                return json_encode(array('code'=>1,'msg'=>'该会员等级优惠券已经添加了'), JSON_UNESCAPED_UNICODE);
            }


            //如果加入了领券中心的话，则需要注意数量
            $couponDetailbyCouponId = Coupon::findOne(['id'=>$form->coupon_id]);
            if ($couponDetailbyCouponId['is_join'] == 2&&$couponDetailbyCouponId['total_count']<$form->num) {
                return json_encode(array('code'=>1,'msg'=>'不得超过该优惠券的总数'.$couponDetailbyCouponId['total_count']));
            }
            return json_encode($form->save(), JSON_UNESCAPED_UNICODE);
        }

        //查出优惠券列表 （有效期内）
        $coupon_list = Coupon::find()->andWhere(['=','store_id',$this->store_id])->all();
        //查出用户等级类别 (未禁用)
        $level_list = Level::find()->andWhere(['=','status',1])->andWhere(['=','store_id',$this->store_id])->all();

        //详情
       // $detail = CouponGoodsLevel::find()->andwhere(['=','coupon_id',$this->id])->andWhere(['=','store_id',$this->store_id])->all();

        return $this->render('goods-coupon-edit', [
            'coupondetail' =>$coupondetail,
            'coupon_list' => $coupon_list,
            'level_list' => $level_list,
           // 'detail' => $detail,
            'goods_id'=>$goods_id,
        ]);

    }


    /**
     * 删除商品优惠券（逻辑）
     * @param int $id
     */
    public function actionGoodsCouponDelete($id = 0)
    {
        $goods = CouponGoodsLevel::findOne(['id' => $id, 'store_id' => $this->store->id]);
        if (!$goods) {
            $this->renderJson([
                'code' => 1,
                'msg' => '优惠券删除失败或已删除'
            ]);
        }
        if ($goods->delete()) {
            $this->renderJson([
                'code' => 0,
                'msg' => '成功'
            ]);
        } else {
            foreach ($goods->errors as $errors) {
                $this->renderJson([
                    'code' => 1,
                    'msg' => $errors[0],
                ]);
            }
        }
    }




    /**
     * 删除（逻辑）
     * @param int $id
     */
    public function actionGoodsDel($id = 0)
    {
        $goods = Goods::findOne(['id' => $id, 'is_delete' => 0, 'store_id' => $this->store->id]);
        if (!$goods) {
            $this->renderJson([
                'code' => 1,
                'msg' => '商品删除失败或已删除'
            ]);
        }
        $goods->is_delete = 1;
        if ($goods->save()) {
            $this->renderJson([
                'code' => 0,
                'msg' => '成功'
            ]);
        } else {
            foreach ($goods->errors as $errors) {
                $this->renderJson([
                    'code' => 1,
                    'msg' => $errors[0],
                ]);
            }
        }
    }

    //商品上下架
    public function actionGoodsUpDown($id = 0, $type = 'down')
    {
        if ($type == 'down') {
            $goods = Goods::findOne(['id' => $id, 'is_delete' => 0, 'status' => 1, 'store_id' => $this->store->id]);
            if (!$goods) {
                $this->renderJson([
                    'code' => 1,
                    'msg' => '商品已删除或已下架'
                ]);
            }
            $goods->status = 0;
        } elseif ($type == 'up') {
            $goods = Goods::findOne(['id' => $id, 'is_delete' => 0, 'status' => 0, 'store_id' => $this->store->id]);

            if (!$goods) {
                $this->renderJson([
                    'code' => 1,
                    'msg' => '商品已删除或已上架'
                ]);
            }
            if (!$goods->getNum()) {
                $return_url = \Yii::$app->urlManager->createUrl(['mch/goods/goods-attr', 'id' => $goods->id]);
                if (!$goods->use_attr)
                    $return_url = \Yii::$app->urlManager->createUrl(['mch/goods/goods-edit', 'id' => $goods->id]) . '#step3';
                $this->renderJson([
                    'code' => 1,
                    'msg' => '商品库存不足，请先完善商品库存',
                    'return_url' => $return_url,
                ]);
            }
            $goods->status = 1;
        } else {
            $this->renderJson([
                'code' => 1,
                'msg' => '参数错误'
            ]);
        }
        if ($goods->save()) {
            $this->renderJson([
                'code' => 0,
                'msg' => '成功'
            ]);
        } else {
            foreach ($goods->errors as $errors) {
                $this->renderJson([
                    'code' => 1,
                    'msg' => $errors[0],
                ]);
            }
        }
    }

    /**
     * 商品规格库存管理
     * @param int $id 商品id
     */
    public function actionGoodsAttr($id)
    {
        $goods = Goods::findOne([
            'store_id' => $this->store->id,
            'is_delete' => 0,
            'id' => $id,
        ]);
        if (!$goods)
            throw new HttpException(404);
        if (\Yii::$app->request->isPost) {
            $goods->attr = json_encode(\Yii::$app->request->post('attr', []), JSON_UNESCAPED_UNICODE);
//            var_dump($goods->attr);die();
            if ($goods->save()) {
                $this->renderJson([
                    'code' => 0,
                    'msg' => '保存成功',
                ]);
            } else {
                $this->renderJson([
                    'code' => 1,
                    'msg' => '保存失败',
                ]);
            }
        } else {
            $attr_group_list = AttrGroup::find()
                ->select('id attr_group_id,attr_group_name')
                ->where(['store_id' => $this->store->id, 'is_delete' => 0])
                ->asArray()->all();
            foreach ($attr_group_list as $i => $g) {
                $attr_list = Attr::find()
                    ->select('id attr_id,attr_name')
                    ->where(['attr_group_id' => $g['attr_group_id'], 'is_delete' => 0, 'is_default' => 0,])
                    ->asArray()->all();
                if (empty($attr_list))
                    unset($attr_group_list[$i]);
                else {
                    $goods_attr_list = json_decode($goods->attr, true);
                    if (!$goods_attr_list)
                        $goods_attr_list = [];
                    foreach ($attr_list as $j => $attr) {
                        $checked = false;
                        foreach ($goods_attr_list as $goods_attr) {

                            foreach ($goods_attr['attr_list'] as $g_attr) {
                                if ($attr['attr_id'] == $g_attr['attr_id']) {
                                    $checked = true;
                                    break;
                                }
                            }
                            if ($checked)
                                break;
                        }
                        $attr_list[$j]['checked'] = $checked;
                    }
                    $attr_group_list[$i]['attr_list'] = $attr_list;
                }
            }
            $new_attr_group_list = [];
            foreach ($attr_group_list as $item)
                $new_attr_group_list[] = $item;
            return $this->render('goods-attr', [
                'goods' => $goods,
                'attr_group_list' => $new_attr_group_list,
                'checked_attr_list' => $goods->attr,
            ]);
        }
    }

    /**
     * 一键采集
     */
    public function actionCopy()
    {
        $form = new CopyForm();
        $form->attributes = \Yii::$app->request->get();
        $this->renderJson($form->copy());
    }

    /**
     * 批量设置
     */
    public function actionBatch()
    {
        $get = \Yii::$app->request->get();
        $res = 0;
        $goods_group = $get['goods_group'];
        $goods_id_group = [];
        foreach ($goods_group as $index => $value) {
            if ($get['type'] == 0) {
                if ($value['num'] != 0) {
                    array_push($goods_id_group, $value['id']);
                }
            } else {
                array_push($goods_id_group, $value['id']);
            }
        }

        $condition = ['and', ['in', 'id', $goods_id_group], ['store_id' => $this->store->id]];
        if ($get['type'] == 0) { //批量上架
            $res = Goods::updateAll(['status' => 1], $condition);
        } elseif ($get['type'] == 1) {//批量下架
            $res = Goods::updateAll(['status' => 0], $condition);
        } elseif ($get['type'] == 2) {//批量删除
            $res = Goods::updateAll(['is_delete' => 1], $condition);
        }
        if ($res > 0) {
            $this->renderJson([
                'code' => 0,
                'msg' => 'success'
            ]);
        } else {
            $this->renderJson([
                'code' => 1,
                'msg' => 'fail'
            ]);
        }
    }

    /**
     * 批量设置积分
     */
    public function actionBatchIntegral()
    {
        $get = \Yii::$app->request->get();
        $integral['give'] = $get['give'] ?: 0;
        $integral['forehead'] = $get['forehead'] ?: 0;
        $integral['more'] = $get['more'] ?: 0;

        $integral = json_encode($integral, JSON_UNESCAPED_UNICODE);

        if (empty($get['goods_group'])) {
            $this->renderJson([
                'code' => 1,
                'msg' => '请选择商品'
            ]);
        }
        $res = Goods::updateAll(['integral' => $integral], ['in', 'id', $get['goods_group']]);
        if ($res) {
            $this->renderJson([
                'code' => 0,
                'msg' => 'success'
            ]);
        } else {
            $this->renderJson([
                'code' => 1,
                'msg' => '系统错误'
            ]);
        }
    }

}

