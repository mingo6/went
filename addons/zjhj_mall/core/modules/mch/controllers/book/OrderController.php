<?php
/**
 * Created by PhpStorm.
 * User: peize
 * Date: 2017/12/21
 * Time: 14:25
 */

namespace app\modules\mch\controllers\book;

use app\models\User;
use app\models\YyOrder;
use app\models\YyWechatTplMsgSender;
use app\modules\mch\models\book\OrderForm;
use app\models\BalanceLog;


class OrderController extends Controller
{

    /**
     * @return string
     * 订单列表
     */
    public function actionIndex()
    {
        $form = new OrderForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $arr = $form->getList();

        return $this->render('index',[
            'list'      => $arr['list'],
            'pagination'=> $arr['p'],
            'row_count' => $arr['row_count'],
        ]);
    }

    public function actionRefund()
    {
        $order_id = \Yii::$app->request->get('order_id');
        $order = YyOrder::find()
            ->andWhere([
                'id'            => $order_id,
                'is_delete'     => 0,
                'store_id'      => $this->store->id,
                'is_pay'        => 1,
                'is_refund'     => 0,
                'apply_delete'  => 1,
            ])
            ->one();
        if (!$order){
            $this->renderJson([
                'code'  => 1,
                'msg'   => '订单错误1'
            ]);
        }

        if ($order->pay_price < 0){
            $this->renderJson([
                'code'  => 1,
                'msg'   => '订单错误2'
            ]);
        }
        /** @var Wechat $wechat */
        $wechat = isset(\Yii::$app->controller->wechat) ? \Yii::$app->controller->wechat : null;

        $data = [
            'out_trade_no' => $order->order_no,
            'out_refund_no' => $order->order_no,
            'total_fee' => $order->pay_price * 100,
            'refund_fee' => $order->pay_price * 100,
        ];

        if($order->pay_type == 1){

            $res = $wechat->pay->refund($data);
            if (!$res) {
                $this->renderJson([
                    'code' => 1,
                    'msg' => '订单取消失败，退款失败，服务端配置出错',
                ]);
            }
            if ($res['return_code'] != 'SUCCESS') {
                $this->renderJson([
                    'code' => 1,
                    'msg' => '订单取消失败，退款失败，' . $res['return_msg'],
                    'res' => $res,
                ]);
            }
            if ($res['result_code'] != 'SUCCESS') {
                $this->renderJson([
                    'code' => 1,
                    'msg' => '订单取消失败，退款失败，' . $res['err_code_des'],
                    'res' => $res,
                ]);
            }
            $order->is_refund = 1;
            if ($order->save()) {
                $msg_sender = new YyWechatTplMsgSender($this->store_id, $order->id, $wechat);
                if ($order->is_pay) {
                    $remark = '订单已退款，退款金额：' . $order->pay_price;
                    $refund_reason = '用户取消';
                    $msg_sender->refundMsg($order->pay_price,$refund_reason,$remark);
                }
                $this->renderJson([
                    'code' => 0,
                    'msg' => '订单已退款'
                ]);
            } else {
                $this->renderJson([
                    'code' => 1,
                    'msg' => '订单退款失败'
                ]);
            }


        }elseif($order->pay_type == 2){
            $user=User::findOne($order->user_id);

            $user->balance += $order->pay_price;

            $order->is_refund =1;

            if($user->save() && $order->save()){

                $admin = \Yii::$app->user->identity;

                $balance_log = new BalanceLog();
                $balance_log->user_id = $user->id;
                $balance_log->content = "管理员： ".$admin->username." 后台同意账号：".$user->nickname."的退款申请 金额：".$order->pay_price."返还给用户余额";
                $balance_log->money = $order->pay_price;
                $balance_log->addtime = time();
                $balance_log->username = $user->nickname;
                $balance_log->operator = $admin->username;
                $balance_log->store_id = $this->store->id;
                $balance_log->operator_id = $admin->id;
                if($balance_log -> save()){
                    $this->renderJson([
                        'code' => 0,
                        'msg' => '订单已退款'
                    ]);
                }else{
                    $this->renderJson([
                        'code' => 1,
                        'msg' => '订单已退款,交易记录未保存'
                    ]);
                } 

            }else{
                $this->renderJson([
                    'code' => 1,
                    'msg' => '订单退款失败'
                ]);
            }

            
        }




    }


}