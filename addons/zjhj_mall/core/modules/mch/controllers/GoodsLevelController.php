<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 10:56
 */

namespace app\modules\mch\controllers;

use Yii;
use yii\data\Pagination;
use app\models\GoodsLevel;
use app\modules\mch\models\GoodsLevelForm;
use app\models\Goods;
use app\models\Level;

class GoodsLevelController extends Controller
{
    /**
     * 商品等级管理
     * @return string
     */
    public function actionIndex($keyword = null)
    {
        $goodsId = Yii::$app->request->get('goods_id');
        if($goodsId <= 0){
            $this->redirect(['goods/goods']);
        }
        $query = GoodsLevel::find()->alias('gl')->leftJoin(Goods::tableName() . ' g', "gl.goods_id = g.id")->leftJoin(Level::tableName() . ' l', 'gl.level_id = l.id')->where(['gl.store_id' => $this->store->id])->select(['gl.*', 'l.name AS level_name', 'g.name AS goods_name']);
        $goodsId = Yii::$app->request->get('goods_id');
        if(!empty($goodsId)){
            $query->andWhere(['gl.goods_id' => 3]);
        }
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,]);
        $list = $query->asArray()->orderBy('id DESC')->limit($pagination->limit)->offset($pagination->offset)->all();
        return $this->render('index', [
            'list' => $list,
            'pagination' => $pagination,
        ]);
    }

    /**
     * 商品等级修改
     * @param int $id
     * @return string
     */
    public function actionEdit()
    {
        $goodsId = Yii::$app->request->get('goods_id');
        $id = Yii::$app->request->get('id');
        if($goodsId <= 0){
            $this->redirect(['goods-level/index', 'goods_id' => Yii::$app->request->get('goods_id')]);
        }
        $goodsInfo = Goods::find()->where(['id' => $goodsId, 'store_id' => $this->store->id])->one();
        if(!$goodsInfo){
            $this->redirect(['goods-level/index', 'goods_id' => Yii::$app->request->get('goods_id')]);
        }
        $goodsLevelInfo = array();
        if($id > 0){
            $goodsLevel = $goodsLevelInfo = GoodsLevel::findOne(['store_id' => $this->store->id, 'id' => $id]);
            if(!$goodsLevel){
                $this->redirect(['goods-level/index', 'goods_id' => Yii::$app->request->get('goods_id')]);
            }
        }
        if(!$goodsLevel){
            $goodsLevel = new GoodsLevel();
        }
        $form = new GoodsLevelForm();
        if (\Yii::$app->request->isPost) {
            $model = \Yii::$app->request->post();
            $model['store_id'] = $this->store->id;
            $form->attributes = $model;
            $form->goodsLevel = $goodsLevel;
            return json_encode($form->save(), JSON_UNESCAPED_UNICODE);
        }
        $levelList = Level::find()->where(['is_delete' => 0, 'store_id' => $this->store->id])->all();
        return $this->render('edit', [
            'goodsLevelInfo' => $goodsLevelInfo,
            'levelList' => $levelList,
            'goodsInfo' => $goodsInfo,
        ]);
    }

    /**
     * 删除（逻辑）
     * @param int $id
     */
    public function actionDel($id = 0)
    {
        $goodsLevel = GoodsLevel::findOne(['id' => $id, 'store_id' => $this->store->id]);
        if (!$goodsLevel) {
            $this->renderJson([
                'code' => 1,
                'msg' => '商品等级删除失败或已删除'
            ]);
        }
        if ($goodsLevel->delete()) {
            $this->renderJson([
                'code' => 0,
                'msg' => '成功'
            ]);
        } else {
            foreach ($goodsLevel->errors as $errors) {
                $this->renderJson([
                    'code' => 1,
                    'msg' => $errors[0],
                ]);
            }
        }
    }
}

