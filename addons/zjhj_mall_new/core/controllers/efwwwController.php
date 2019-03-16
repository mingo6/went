<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/19
 * Time: 9:57
 */

namespace app\controllers;


use app\extensions\Sms;
use app\models\CardSendForm;
use app\models\Option;
use app\models\Order;
use app\models\OrderMessage;
use app\models\PrinterSetting;
use app\models\Setting;
use app\models\Share;
use app\models\Store;
use app\models\User;
use app\models\WechatApp;
use app\models\WechatTplMsgSender;
use app\modules\api\models\CouponPaySendForm;
use luweiss\wechat\DataTransform;
use luweiss\wechat\Wechat;
use app\extensions\PinterOrder;

class PayNotifyController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $xml = file_get_contents("php://input");
        $res = DataTransform::xmlToArray($xml);
        if ($res && !empty($res['out_trade_no'])) {//微信支付回调
            $this->wechatPayNotify($res);
        }
    }

    private function wechatPayNotify($res)
    {
        if ($res['result_code'] != 'SUCCESS' && $res['return_code'] != 'SUCCESS')
            return;
        $order = Order::findOne([
            'order_no' => $res['out_trade_no'],
        ]);
        if (!$order)
            return;
        $store = Store::findOne($order->store_id);
        if (!$store)
            return;
        $wechat_app = WechatApp::findOne($store->wechat_app_id);
        if (!$wechat_app)
            return;
        $wechat = new Wechat([
            'appId' => $wechat_app->app_id,
            'appSecret' => $wechat_app->app_secret,
            'mchId' => $wechat_app->mch_id,
            'apiKey' => $wechat_app->key,
            'cachePath' => \Yii::$app->runtimePath . '/cache',
        ]);
        $new_sign = $wechat->pay->makeSign($res);
        if ($new_sign != $res['sign']) {
            echo "Sign 错误";
            return;
        }
        if ($order->is_pay == 1) {
            echo "订单已支付";
            return;
        }
        $order->is_pay = 1;
        $order->pay_time = time();
        $order->pay_type = 1;
        if ($order->save()) {
            //$this->setReturnData($order);
            $this->paySendCoupon($order->store_id, $order->user_id);
            $this->autoBecomeShare($order->user_id, $order->store_id);


            $wechat_tpl_meg_sender = new WechatTplMsgSender($order->store_id, $order->id, $wechat);
            $wechat_tpl_meg_sender->payMsg();
            Sms::send($order->store_id, $order->order_no);
            OrderMessage::set($order->id, $order->store_id);
            $this->paySendCard($order->store_id, $order->user_id,$order->id);
            $printer_setting = PrinterSetting::findOne(['store_id'=>$order->store_id,'is_delete'=>0]);
            $type = json_decode($printer_setting->type,true);
            if($type['pay'] && $type['pay'] == 1){
                $printer_order = new PinterOrder($order->store_id,$order->id);
                $res = $printer_order->print_order();
            }
            echo '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
            return;
        } else {
            echo "支付失败";
            return;
        }
    }

    /**
     * @deprecated 已弃用
     * 设置佣金
     * @param Order $order
     */
    private function setReturnData($order)
    {
        $setting = Setting::findOne(['store_id' => $order->store_id]);
        if (!$setting || $setting->level == 0)
            return;
        $user = User::findOne($order->user_id);
        if (!$user)
            return;
        $order->parent_id = $user->parent_id;

        $first_price = $setting->first * $order->pay_price / 100;
        $second_price = $setting->second * $order->pay_price / 100;
        $third_price = $setting->third * $order->pay_price / 100;

        $order->first_price = $first_price < 0.01 ? 0 : $first_price;
        $order->second_price = $second_price < 0.01 ? 0 : $second_price;
        $order->third_price = $third_price < 0.01 ? 0 : $third_price;
        $order->save();
    }

    /**
     * 支付成功送优惠券
     */
    private function paySendCoupon($store_id, $user_id)
    {
        $form = new CouponPaySendForm();
        $form->store_id = $store_id;
        $form->user_id = $user_id;
        $form->save();
    }


    /**
     * 消费满指定金额自动成为分销商
     * @param $user_id integer 用户id
     */
    private function autoBecomeShare($user_id, $store_id)
    {
        $auto_share_val = floatval(Option::get('auto_share_val', $store_id, 'share', 0));
        if ($auto_share_val == 0)
            return;
        $is_share = Share::find()->where(['user_id' => $user_id, 'is_delete' => 0])->exists();
        if ($is_share)
            return;
        $consumption_sum = Order::find()->where(['user_id' => $user_id, 'is_delete' => 0, 'is_pay' => 1])->sum('pay_price');
        $consumption_sum = floatval(($consumption_sum ? $consumption_sum : 0));
        if ($consumption_sum < $auto_share_val)
            return;
        $share = new Share();
        $share->user_id = $user_id;
        $share->mobile = '';
        $share->name = '';
        $share->status = 1;
        $share->is_delete = 0;
        $share->addtime = time();
        $share->store_id = $store_id;
        $share->save();

        $user = User::findOne($user_id);
        $user->time = time();
        $user->is_distributor = 1;
        $user->save();
    }

    /**
     * 支付成功送卡券
     */
    private function paySendCard($store_id, $user_id,$order_id)
    {
        $form = new CardSendForm();
        $form->store_id = $store_id;
        $form->user_id = $user_id;
        $form->order_id = $order_id;
        $form->save();
    }
}