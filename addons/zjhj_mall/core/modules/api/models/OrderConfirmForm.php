<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/20
 * Time: 10:25
 */

namespace app\modules\api\models;


use app\extensions\PinterOrder;
use app\models\Level;
use app\models\Order;
use app\models\OrderDetail;
use app\models\PrinterSetting;
use app\models\CouponGoodsLevel;
use app\models\User;
use app\models\Coupon;
use app\modules\mch\models\CouponGoodsLevelForm;

class OrderConfirmForm extends Model
{
    public $store_id;
    public $user_id;
    public $order_id;

    public function rules()
    {
        return [
            [['order_id'], 'required'],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getModelError();
        }
        $order = Order::findOne([
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'id' => $this->order_id,
            'is_pay' => 1,
            'is_send' => 1,
            'is_delete' => 0,
        ]);
        if (!$order) {
            return [
                'code' => 1,
                'msg' => '订单不存在'
            ];
        }
        $order->is_confirm = 1;
        $order->confirm_time = time();
        /* $user = User::findOne(['id' => $order->user_id, 'store_id' => $this->store_id]);
        $order_money = Order::find()->where(['store_id' => $this->store_id, 'user_id' => $user->id, 'is_delete' => 0])
            ->andWhere(['is_pay' => 1, 'is_confirm' => 1])->select([
                'sum(pay_price)'
            ])->scalar();
        $next_level = Level::find()->where(['store_id' => $this->store_id, 'is_delete' => 0,'status'=>1])
            ->andWhere(['<', 'money', $order_money])->orderBy(['level' => SORT_DESC])->asArray()->one();
        if ($user->level < $next_level['level']) {
            $user->level = $next_level['level'];
            $user->save();
        } */

        //查出该订单里的所有商品
        $allgoods = OrderDetail::find()->select(['goods_id'])->where(['order_id'=>$this->order_id])->asArray()->all();
        foreach($allgoods as $k=>&$v) {
            //查出每个商品对应的等级
            $coupon_level = $this->getCouponLevelListbyGood($v['goods_id'],$this->user_id);
            if($coupon_level) {
                $v['coupon_id'] = $coupon_level['coupon_id'];
                $v['level_id'] = $coupon_level['level_id'];
                //发放优惠券
                $res = $this->sendCoupon($v['coupon_id'],$v['goods_id'],$this->user_id);
                if($res === false) {
                    //记录日志
                    /* return [
                        'code' => 1,
                        'msg' => '优惠券发放失败！'
                    ]; */
                }

            }
        }
        unset($v);
        if ($order->save()) {
            $printer_setting = PrinterSetting::findOne(['store_id'=>$this->store_id,'is_delete'=>0]);
            $type = json_decode($printer_setting->type,true);
            if($type['confirm'] && $type['confirm'] == 1){
                $printer_order = new PinterOrder($this->store_id,$order->id);
                $res = $printer_order->print_order();
            }
            return [
                'code' => 0,
                'msg' => '已确认收货'
            ];
        } else {
            return [
                'code' => 1,
                'msg' => '确认收货失败'
            ];
        }
    }


    //确认收货后发送优惠券
    protected function sendCoupon($coupon_id,$goods_id,$user_id)
    {
        if (!$this->validate())
            return $this->getModelError();
        $coupon = Coupon::findOne([
            'id' => $coupon_id,
            'is_delete' => 0,
            'store_id' => $this->store_id,
        ]);
        if (!$coupon)
            return [
                'code' => 1,
                'msg' => '优惠券不存在',
            ];
        $user_list = User::find()->select('id')->where(['id' => $user_id, 'store_id' => $this->store_id])->all();
        $user_detail = User::findOne(['id'=>$user_id])->toArray();
        $count = 0;
        foreach ($user_list as $u) {
            $res = Coupon::userAddCoupon($u->id, $coupon_id,0,3);//type=3，该优惠券是确认收货后获取的类型
            if ($res)
                $count++;
        }

        //查出coupon_goods_level中的数量
        $coupon = CouponGoodsLevel::findOne(['goods_id'=>$goods_id,'level_id'=>$user_detail['level']])->toArray(); //商品id和等级id可以唯一确定一个优惠券
        if ($coupon['num'] <=0) {
            return [
                'code' => 1,
                'msg' => '该商品优惠券发放完了,暂时无法发放',
            ];
        }
        //同时更新coupon_goods_level表里的num字段减少1个
        $res = CouponGoodsLevel::updateAll(['num'=>$coupon['num'] - 1],['goods_id'=>$goods_id,'level_id'=>$user_detail['level'],'store_id'=>$this->store_id]);
        return [
            'code' => 0,
            'msg' => "操作完成，共发放{$count}人次。",
        ];
    }


    //查出每个商品,用户等级对应的 优惠券 信息
    public function getCouponLevelListbyGood($goods_id,$user_id)
    {
        $user = User::findOne(['id'=>$user_id]);
        if($user) {
            $level_id = $user['level'];
        } else {
            return false;
        }
        $detail = CouponGoodsLevel::find()->where(['AND',['goods_id'=>$goods_id,'level_id'=>$level_id],['>','num',0]])->asArray()->one();
      //  var_dump($level_id);die;
        return $detail;
    }


    //原系统发送优惠券
    public function saveold()
    {
        if (!$this->validate())
            return $this->getModelError();
        $coupon = Coupon::findOne([
            'id' => $this->coupon_id,
            'is_delete' => 0,
            'store_id' => $this->store_id,
        ]);
        if (!$coupon)
            return [
                'code' => 1,
                'msg' => '优惠券不存在',
            ];
        $user_list = User::find()->select('id')->where(['id' => $this->user_id, 'store_id' => $this->store_id])->all();
        $count = 0;
        foreach ($user_list as $u) {
            $res = Coupon::userAddCoupon($u->id, $this->coupon_id);
            if ($res)
                $count++;
        }
        return [
            'code' => 0,
            'msg' => "操作完成，共发放{$count}人次。",
        ];
    }


}