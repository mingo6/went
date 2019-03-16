<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/8/7
 * Time: 12:59
 */

namespace app\modules\mch\models;


use app\models\Attr;
use app\models\AttrGroup;
use app\models\Goods;
use app\models\GoodsCard;
use app\models\GoodsPic;
use app\models\CouponGoodsLevel;
use yii\data\Pagination;
use yii\helpers\VarDumper;

class CouponGoodsLevelForm extends Model
{
    public $couponGoodsLevel;
    public $store_id;
    public $coupon_id;
    public $goods_id;
    public $level_id;
    public $num;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['store_id', 'coupon_id', 'goods_id', 'level_id','num'], 'integer'],
            [['store_id', 'coupon_id', 'goods_id', 'level_id','num'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'coupon_id' => '优惠券id',
            'goods_id' => '商品id',
            'level_id' => '会员等级id',
            'num' => '数量',
        ];
    }


    /**
     * 编辑
     * @return array
     */
    public function save()
    {
        if ($this->validate()) {
            if (empty($this->num)) {
                return [
                    'code' => 1,
                    'msg' => '数量不能为空',
                ];
            }

            if (empty($this->coupon_id)) {
                return [
                    'code' => 1,
                    'msg' => '优惠券id不能为空',
                ];
            }

            if (empty($this->level_id)) {
                return [
                    'code' => 1,
                    'msg' => '等级不能为空',
                ];
            }

            if (empty($this->goods_id)) {
                return [
                    'code' => 1,
                    'msg' => '商品id不能为空',
                ];
            }

            $couponGoodsLevel = $this->couponGoodsLevel;
            $couponGoodsLevel->num = $this->num;
            $couponGoodsLevel->coupon_id = $this->coupon_id;
            $couponGoodsLevel->level_id = $this->level_id;
            $couponGoodsLevel->goods_id = $this->goods_id;
            $couponGoodsLevel->store_id = $this->store_id;
            if ($couponGoodsLevel->save()) {
                return [
                    'code' => 0,
                    'msg' => '保存成功',
                ];
            } else {
                return $this->getModelError($couponGoodsLevel);
            }
        } else {
            return $this->getModelError();
        }
    }






}