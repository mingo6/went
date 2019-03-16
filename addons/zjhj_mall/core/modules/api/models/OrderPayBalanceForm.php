<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/18
 * Time: 12:11
 */

namespace app\modules\api\models;


use app\models\FormId;
use app\models\Goods;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Setting;
use app\models\User;
use yii\helpers\VarDumper;


//new
use app\extensions\SendMail;
use app\extensions\Sms;
use app\modules\api\models\CouponPaySendForm;
use app\models\OrderMessage;
use app\models\CardSendForm;
use app\models\CouponAutoSend;
use app\controllers;
use app\modules\api\models\PayNotifyForm;
/**
 * @property User $user
 * @property Order $order
 */
class OrderPayBalanceForm extends Model
{
    public $store_id;
    public $order_id;
    public $pay_type;
    public $user;
    public $user_id;
    public $id;
    public $order_no;

    private $wechat;
    private $order;
    private $balance;

    public function rules()
    {
        return [
            [['order_id', 'pay_type',], 'required'],
            [['pay_type'], 'in', 'range' => ['ALIPAY', 'WECHAT_PAY','BALANCE_PAY']],
        ];
    }

    public function search()
    {

        
        $this->wechat = $this->getWechat();
        
        if (!$this->validate()){
            return $this->getModelError();
        }
        $this->order = Order::findOne([
            'store_id' => $this->store_id,
            'id' => $this->order_id,
        ]);
        
        if (!$this->order)
            return [
                'code' => 1,
                'msg' => '订单不存在',
            ];
        
            
        
        $goods_names = '';
        $goods_list = OrderDetail::find()->alias('od')->leftJoin(['g' => Goods::tableName()], 'g.id=od.goods_id')->where([
            'od.order_id' => $this->order->id,
            'od.is_delete' => 0,
        ])->select('g.name')->asArray()->all();
        foreach ($goods_list as $goods)
            $goods_names .= $goods['name'] . ';';
        $goods_names = mb_substr($goods_names, 0, 32, 'utf-8');
        
        // return $_GET;

        if ($this->pay_type == 'BALANCE_PAY') {

            $this->setReturnData($this->order);


            // return [
            //     'code' => 0,
            //     'msg' => '支付成功',
            //     'data' => '',
            //     'res' => $res,
            //     'body' => $goods_names,
            // ];

            $res=array();
            $res['result_code'] = 'SUCCESS';
            $res['return_code'] = 'SUCCESS';
            $res['out_trade_no'] = $this -> order -> order_no;
            $res['pay_type'] = 2;
            

            //var_dump($res);die;
            $form = new PayNotifyForm();
            return $form -> notify($res);
            

        }
    }

    /**
     * 设置佣金
     * @param Order $order
     */
    private function setReturnData($order)
    {
        $setting = Setting::findOne(['store_id' => $order->store_id]);
        if (!$setting || $setting->level == 0)
            return;
        $user = User::findOne($order->user_id);//订单本人
        if (!$user)
            return;
        $order->parent_id = $user->parent_id;
        $parent = User::findOne($user->parent_id);//上级
        if ($parent->parent_id) {
            $order->parent_id_1 = $parent->parent_id;
            $parent_1 = User::findOne($parent->parent_id);//上上级
            if ($parent_1->parent_id) {
                $order->parent_id_2 = $parent_1->parent_id;
            } else {
                $order->parent_id_2 = -1;
            }
        } else {
            $order->parent_id_1 = -1;
            $order->parent_id_2 = -1;
        }
        $order_total = doubleval($order->total_price - $order->express_price);
        $pay_price = doubleval($order->pay_price - $order->express_price);

        $order_detail_list = OrderDetail::find()->alias('od')->leftJoin(['g' => Goods::tableName()], 'od.goods_id=g.id')
            ->where(['od.is_delete' => 0, 'od.order_id' => $order->id])
            ->asArray()
            ->select('g.individual_share,g.share_commission_first,g.share_commission_second,g.share_commission_third,g.share_commission_first_score,g.share_commission_second_score,g.share_commission_third_score,od.total_price,od.num,g.share_type')
            ->all();
        $share_commission_money_first = 0;//一级分销总佣金
        $share_commission_money_second = 0;//二级分销总佣金
        $share_commission_money_third = 0;//三级分销总佣金
        $share_commission_score_first = 0;//一级分销总积分佣金
        $share_commission_score_second = 0;//二级分销总积分佣金
        $share_commission_score_third = 0;//三级分销总积分佣金
        foreach ($order_detail_list as $item) {
            $item_price = doubleval($item['total_price']);
            if ($item['individual_share'] == 1) {
                $rate_first = doubleval($item['share_commission_first']);
                $rate_second = doubleval($item['share_commission_second']);
                $rate_third = doubleval($item['share_commission_third']);
                $rate_first_score = doubleval($item['share_commission_first_score']);
                $rate_second_score = doubleval($item['share_commission_second_score']);
                $rate_third_score = doubleval($item['share_commission_third_score']);
                if ($item['share_type'] == 1) {
                    if($rate_first > 0) $share_commission_money_first += $rate_first * $item['num'];
                    if($rate_second > 0) $share_commission_money_second += $rate_second * $item['num'];
                    if($rate_third > 0) $share_commission_money_third += $rate_third * $item['num'];
                    if($rate_first_score > 0) $share_commission_score_first += $rate_first_score * $item['num'];
                    if($rate_second_score > 0) $share_commission_score_second += $rate_second_score * $item['num'];
                    if($rate_third_score > 0) $share_commission_score_third += $rate_third_score * $item['num'];
                } else {
                    if($rate_first > 0) $share_commission_money_first += $item_price * $rate_first / 100;
                    if($rate_second > 0) $share_commission_money_second += $item_price * $rate_second / 100;
                    if($rate_third > 0) $share_commission_money_third += $item_price * $rate_third / 100;
                    if($rate_first_score > 0) $share_commission_score_first += $item_price * $rate_first_score / 100;
                    if($rate_second_score > 0) $share_commission_score_second += $item_price * $rate_second_score / 100;
                    if($rate_third_score > 0) $share_commission_score_third += $item_price * $rate_third_score / 100;
                }
            } else {
                $rate_first = doubleval($setting->first);
                $rate_second = doubleval($setting->second);
                $rate_third = doubleval($setting->third);
                $rate_first_score = doubleval($setting->first_score);
                $rate_second_score = doubleval($setting->second_score);
                $rate_third_score = doubleval($setting->third_score);
                if ($setting->price_type == 1) {
                    if($rate_first > 0) $share_commission_money_first += $rate_first * $item['num'];
                    if($rate_second > 0) $share_commission_money_second += $rate_second * $item['num'];
                    if($rate_third > 0) $share_commission_money_third += $rate_third * $item['num'];
                    if($rate_first_score > 0) $share_commission_score_first += $rate_first_score * $item['num'];
                    if($rate_second_score > 0) $share_commission_score_second += $rate_second_score * $item['num'];
                    if($rate_third_score > 0) $share_commission_score_third += $rate_third_score * $item['num'];
                } else {
                    if($rate_first > 0) $share_commission_money_first += $item_price * $rate_first / 100;
                    if($rate_second > 0) $share_commission_money_second += $item_price * $rate_second / 100;
                    if($rate_third > 0) $share_commission_money_third += $item_price * $rate_third / 100;
                    if($rate_first_score > 0) $share_commission_score_first += $item_price * $rate_first_score / 100;
                    if($rate_second_score > 0) $share_commission_score_second += $item_price * $rate_second_score / 100;
                    if($rate_third_score > 0) $share_commission_score_third += $item_price * $rate_third_score / 100;
                }
            }
        }


        $order->first_price = $share_commission_money_first < 0.01 ? 0 : $share_commission_money_first;
        $order->second_price = $share_commission_money_second < 0.01 ? 0 : $share_commission_money_second;
        $order->third_price = $share_commission_money_third < 0.01 ? 0 : $share_commission_money_third;
        $order->first_score = $share_commission_money_first < 0.01 ? 0 : $share_commission_money_first;
        $order->second_score = $share_commission_money_second < 0.01 ? 0 : $share_commission_money_second;
        $order->third_score = $share_commission_money_third < 0.01 ? 0 : $share_commission_money_third;
        $order->save();
    }


    
}