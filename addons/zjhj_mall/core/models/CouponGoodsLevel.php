<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%coupon}}".
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $name
 * @property string $desc
 * @property string $pic_url
 * @property integer $discount_type
 * @property string $min_price
 * @property string $sub_price
 * @property string $discount
 * @property integer $expire_type
 * @property integer $expire_day
 * @property integer $begin_time
 * @property integer $end_time
 * @property integer $addtime
 * @property integer $is_delete
 * @property integer $total_count
 * @property integer $is_join
 * @property integer $sort
 */
class CouponGoodsLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coupon_goods_level}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'coupon_id', 'goods_id', 'level_id','num'], 'required'],
            [['store_id', 'coupon_id', 'goods_id', 'level_id','num'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
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
     * 给商品设置优惠券
     * @param integer $user_id 用户id
     * @param integer $coupon_id 优惠券id
     * @param integer $coupon_auto_send_id 自动发放id
     * @param integer $type 领券类型
     * @return boolean
     */
    public static function userAddCoupon($user_id, $coupon_id, $coupon_auto_send_id = 0,$type=0)
    {
        $user = User::findOne($user_id);
        if (!$user)
            return false;
        $coupon = Coupon::findOne([
            'id' => $coupon_id,
            'is_delete' => 0,
        ]);
        if (!$coupon)
            return false;
        if($coupon->total_count == 0){
            return false;
        }
        $user_coupon = new UserCoupon();
        if($type == 2){
            $res = UserCoupon::find()->where(['is_delete'=>0,'type'=>2,'user_id'=>$user_id,'coupon_id'=>$coupon_id])->exists();
            if($res)
                return false;
        }

        if ($coupon_auto_send_id) {
            $coupon_auto_send = CouponAutoSend::findOne([
                'id' => $coupon_auto_send_id,
                'is_delete' => 0,
            ]);
            if (!$coupon_auto_send)
                return false;
            if ($coupon_auto_send->send_times != 0) {
                $send_count = UserCoupon::find()->where([
                    'coupon_auto_send_id' => $coupon_auto_send->id,
                    'user_id' => $user->id,
                ])->count();
                if ($send_count && $send_count >= $coupon_auto_send->send_times)
                    return false;
            }
            $user_coupon->coupon_auto_send_id = $coupon_auto_send->id;
            $type = 1;
        }


        $user_coupon->type = $type;
        $user_coupon->store_id = $user->store_id;
        $user_coupon->user_id = $user->id;
        $user_coupon->coupon_id = $coupon->id;
        if ($coupon->expire_type == 1) {
            $user_coupon->begin_time = time();
            $user_coupon->end_time = time() + max(0, 86400 * $coupon->expire_day);
        } elseif ($coupon->expire_type == 2) {
            $user_coupon->begin_time = $coupon->begin_time;
            $user_coupon->end_time = $coupon->end_time;
        }
        $user_coupon->is_expire = 0;
        $user_coupon->is_use = 0;
        $user_coupon->is_delete = 0;
        $user_coupon->addtime = time();
        return $user_coupon->save();
    }

}
