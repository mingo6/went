<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/18
 * Time: 19:13
 */

namespace app\modules\api\models\group;


use app\models\OrderDetail;
use app\models\OrderRefund;
use app\models\PtGoods;
use app\models\PtOrder;
use app\models\PtOrderDetail;
use app\models\Store;
use app\modules\api\models\Model;
use yii\data\Pagination;
use yii\helpers\VarDumper;

class OrderListForm extends Model
{
    public $store_id;
    public $user_id;
    public $status;
    public $page;
    public $limit;

    public function rules()
    {
        return [
            [['page', 'limit', 'status',], 'integer'],
            [['page',], 'default', 'value' => 1],
            [['limit',], 'default', 'value' => 3],
        ];
    }

    public function search()
    {
        if (!$this->validate())
            return $this->getModelError();
        $query = PtOrder::find()->where([
            'is_delete' => 0,
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'is_cancel' => 0,
        ]);
        if ($this->status == 0) {//待付款
            $query->andWhere([
                'is_pay' => 0,
                'status' => 1,
            ]);
        }
        if ($this->status == 1) {//拼团中
            $query->andWhere([
                'is_pay' => 1,
                'is_success' => 0,
                'status' => 2,
            ]);
            $query->andWhere(['>','limit_time',time()]);
        }
        if ($this->status == 2) {//拼团成功
            $query->andWhere([
                'is_success' => 1,
                'status' => 3,
            ]);
        }
        if ($this->status == 3) {//拼团失败
            $query->andWhere([
                'is_pay' => 1,
                'status' => 4,
            ]);
        }
        $status = [
            1=> '待付款',
            2=> '拼团中',
            3=> '拼团成功',
            4=> '拼团失败',
        ];
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'page' => $this->page - 1, 'pageSize' => $this->limit]);
        /* @var Order[] $list */
        $list = $query->limit($pagination->limit)->offset($pagination->offset)->orderBy('addtime DESC')->all();
        $new_list = [];

        $stroe = Store::findOne($this->store_id);
        foreach ($list as $index => $order) {
            $order_detail_list = PtOrderDetail::findAll(['order_id' => $order->id, 'is_delete' => 0]);
            $goods_list = [];
            foreach ($order_detail_list as $order_detail) {
                $goods = PtGoods::findOne($order_detail->goods_id);
                if (!$goods)
                    continue;
                $goods_pic = isset($order_detail->pic)?$order_detail->pic?:$goods->cover_pic:$goods->cover_pic;
                $goods_list[] = (object)[
                    'goods_id' => $goods->id,
                    'goods_pic' => $goods_pic,
                    'goods_name' => $goods->name,
                    'num' => $order_detail->num,
                    'price' => $order_detail->total_price,
                    'attr_list' => json_decode($order_detail->attr),
                ];
            }
//            $qrcode = null;
//            $order->getSurplusGruop();

            $limit_time_res = [
                'days'  => '00',
                'hours' => '00',
                'mins'  => '00',
                'secs'  => '00',
            ];
            $limit_time = $order->limit_time;
            if ($order->status==1){ // 未支付订单
                $limit_time = $order->addtime + ($stroe->over_day *3600);
            }
            $timediff = $limit_time - time();
            if ($timediff<0){
                if ($order->status==1){
                    $order->is_cancel = 1;
                    $order->save();
                    continue;
                }
            }
            $limit_time_res['days'] = intval($timediff/86400)>0?intval($timediff/86400):0;
            //计算小时数
            $remain = $timediff%86400;
            $limit_time_res['hours'] = intval($remain/3600)>0?intval($remain/3600):0;
            //计算分钟数
            $remain = $remain%3600;
            $limit_time_res['mins'] = intval($remain/60)>0?intval($remain/60):0;
            //计算秒数
            $limit_time_res['secs'] = $remain%60>0?$remain%60:0;
            $limit_time_ms = explode('-',date('Y-m-d-H-i-s',$limit_time));

            $new_list[] = (object)[
                'order_id' => $order->id,
                'order_no' => $order->order_no,
                'addtime' => date('Y-m-d H:i', $order->addtime),
                'goods_list' => $goods_list,
                'total_price' => $order->total_price,
                'pay_price' => $order->pay_price,
                'is_pay' => $order->is_pay,
                'is_send' => $order->is_send,
                'is_confirm' => $order->is_confirm,
                'is_comment' => $order->is_comment,
                'is_group' => $order->is_group,
                'apply_delete' => $order->apply_delete,
                'status' => $order->status,
                'status_name' => $status[$order->status],
                'express'=>$order->express,
                'surplusGruopNum'=>$order->getSurplusGruop(),
                'is_cancel'=>$order->is_cancel,
                'limit_time'=>$limit_time_res,
                'limit_time_ms'=>$limit_time_ms,
                'is_comment'=>$order->is_comment,
            ];
        }
        return [
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'row_count' => $count,
                'page_count' => $pagination->pageCount,
                'list' => $new_list,
            ],
        ];

    }

    private function getRefundList()
    {
        $query = OrderRefund::find()->alias('or')
            ->leftJoin(['od' => OrderDetail::tableName()], 'od.id=or.order_detail_id')
            ->leftJoin(['o' => Order::tableName()], 'o.id=or.order_id')
            ->where([
                'or.store_id' => $this->store_id,
                'or.user_id' => $this->user_id,
                'or.is_delete' => 0,
                'o.is_delete' => 0,
                'od.is_delete' => 0,
            ]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'page' => $this->page - 1, 'pageSize' => $this->limit]);
        $list = $query->select('o.id AS order_id,o.order_no,or.id AS order_refund_id,od.goods_id,or.addtime,od.num,od.total_price,od.attr,or.refund_price,or.type,or.status')->limit($pagination->limit)->offset($pagination->offset)->orderBy('or.addtime DESC')->asArray()->all();
        $new_list = [];
        foreach ($list as $item) {
            $goods = Goods::findOne($item['goods_id']);
            if (!$goods)
                continue;
            $new_list[] = (object)[
                'order_id' => intval($item['order_id']),
                'order_no' => $item['order_no'],
                'goods_list' => [(object)[
                    'goods_id' => intval($goods->id),
                    'goods_pic' => $goods->getGoodsPic(0)->pic_url,
                    'goods_name' => $goods->name,
                    'num' => intval($item['num']),
                    'price' => doubleval(sprintf('%.2f', $item['total_price'])),
                    'attr_list' => json_decode($item['attr']),
                ]],
                'addtime' => date('Y-m-d H:i', $item['addtime']),
                'refund_price' => doubleval(sprintf('%.2f', $item['refund_price'])),
                'refund_type' => $item['type'],
                'refund_status' => $item['status'],
                'order_refund_id' => $item['order_refund_id'],
            ];
        }
        return [
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'row_count' => $count,
                'page_count' => $pagination->pageCount,
                'list' => $new_list,
            ],
        ];
    }

    public static function getCountData($store_id, $user_id)
    {
        $form = new OrderListForm();
        $form->limit = 0;
        $form->store_id = $store_id;
        $form->user_id = $user_id;
        $data = [];

        $form->status = -1;
        $res = $form->search();

        $data['all'] = $res['data']['row_count'];

        $form->status = 0;
        $res = $form->search();
        $data['status_0'] = $res['data']['row_count'];

        $form->status = 1;
        $res = $form->search();
        $data['status_1'] = $res['data']['row_count'];

        $form->status = 2;
        $res = $form->search();
        $data['status_2'] = $res['data']['row_count'];

        $form->status = 3;
        $res = $form->search();
        $data['status_3'] = $res['data']['row_count'];

        return $data;
    }

}