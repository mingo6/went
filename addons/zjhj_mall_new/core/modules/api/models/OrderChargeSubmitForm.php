<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/17
 * Time: 11:48
 */

namespace app\modules\api\models;


use app\models\Address;
use app\models\Attr;
use app\models\AttrGroup;
use app\models\Cart;
use app\models\Coupon;
use app\models\Goods;
use app\models\Level;
use app\models\MiaoshaGoods;
use app\models\Order;
use app\models\OrderDetail;
use app\models\OrderForm;
use app\models\PostageRules;
use app\models\PrinterSetting;
use app\models\Store;
use app\models\User;
use app\models\UserCoupon;
use app\modules\api\controllers\OrderController;
use app\extensions\PinterOrder;
use yii\helpers\VarDumper;

class OrderChargeSubmitForm extends Model
{
    public $store_id;
    public $user_id;
    public $version;

    public $address_id;
    public $cart_id_list;
    public $goods_info;

    public $user_coupon_id;

    public $content;
    public $offline;
    public $address_name;
    public $address_mobile;
    public $shop_id;

    public $total_price;

    public $use_integral;

    public $form;//自定义表单信息

    public function rules()
    {
        return [
            [['cart_id_list', 'goods_info', 'content', 'address_name', 'address_mobile'], 'string'],
            [['address_id',], 'required', 'on' => "EXPRESS"],
            [['address_name', 'address_mobile'], 'required', 'on' => "OFFLINE"],
            [['user_coupon_id', 'offline', 'shop_id', 'use_integral'], 'integer'],
            [['offline'], 'default', 'value' => 0],
            [['form'],'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'address_id' => '收货地址',
            'address_name' => '收货人',
            'address_mobile' => '联系电话'
        ];
    }

    public function save()
    {
        $order = new Order();
        $order->store_id = $this->store_id;
        $order->user_id = $this->user_id;
        $order->order_no = $this->getOrderNo();
        $order->total_price = $this->total_price;
        $order->pay_price = $this->total_price;
        $order->express_price = 0;
        $order->discount = 0;
        $order->addtime = time();
        $order->name = $this->address_name;
        $order->shop_id = 0;
        
        $order->first_price = 0;
        $order->second_price = 0;
        $order->third_price = 0;
        $order->content = $this->content;
        $order->is_offline = 0;
        $order->order_type = OrderSubmitForm::ORDER_TYPE_CHARGE;

        // 积分使用
        $resIntegral['forehead_integral'] = 0;
        $resIntegral['forehead'] = sprintf("%.2f", ($resIntegral['forehead_integral'] / $store->integral));
        $order->integral = json_encode($resIntegral, JSON_UNESCAPED_UNICODE);

        $order->version = $this->version;

        if ($order->save()) {

            $printer_setting = PrinterSetting::findOne(['is_delete' => 0]);
            $type = json_decode($printer_setting->type, true);
            if ($type['order'] && $type['order'] == 1) {
                $printer_order = new PinterOrder($this->store_id, $order->id);
                $res = $printer_order->print_order();
            }
            return [
                'code' => 0,
                'msg' => '订单提交成功',
                'data' => (object)[
                    'order_id' => $order->id,
                ],
            ];
        } else {
            return $this->getModelError($order);
        }
    }

    /**
     * 获取购物车商品列表及总价
     * @param string $cart_id_list
     * eg.[1,2,3]
     * @return array 'list'=>商品列表,'total_price'=>总价
     */
    private function getGoodsListByCartIdList($cart_id_list)
    {
        /* @var  Cart[] $cart_list */
        $cart_list = Cart::find()->where([
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'is_delete' => 0,
            'id' => json_decode($cart_id_list, true),
        ])->all();
        $list = [];
        $total_price = 0;
        $new_cart_id_list = [];
        foreach ($cart_list as $item) {
            $goods = Goods::findOne([
                'store_id' => $this->store_id,
                'id' => $item->goods_id,
                'is_delete' => 0,
                'status' => 1,
            ]);
            if (!$goods)
                continue;
            $attr_list = Attr::find()->alias('a')
                ->select('a.id attr_id,ag.attr_group_name,a.attr_name')
                ->leftJoin(['ag' => AttrGroup::tableName()], 'a.attr_group_id=ag.id')
                ->where(['a.id' => json_decode($item->attr, true)])
                ->asArray()->all();
            $goods_attr_info = $goods->getAttrInfo(json_decode($item->attr, true));
            $attr_num = intval(empty($goods_attr_info['num']) ? 0 : $goods_attr_info['num']);
            if ($attr_num < $item->num)
                continue;
            $goods_pic = isset($goods_attr_info['pic']) ? $goods_attr_info['pic'] ?: $goods->getGoodsPic(0)->pic_url : $goods->getGoodsPic(0)->pic_url;
            $new_item = (object)[
                'cart_id' => $item->id,
                'goods_id' => $goods->id,
                'goods_name' => $goods->name,
                'goods_pic' => $goods_pic,
//                'goods_pic' => $goods->getGoodsPic(0)->pic_url,
                'num' => $item->num,
                'price' => doubleval(empty($goods_attr_info['price']) ? $goods->price : $goods_attr_info['price']) * $item->num,
                'attr_list' => $attr_list,
                'max_num' => $attr_num,
                'give' => 0,
            ];

            //秒杀价计算
            $miaosha_data = $this->getMiaoshaData($goods, json_decode($item->attr, true));
            if ($miaosha_data) {
                $res = $this->getMiaoshaPrice($miaosha_data, $goods, json_decode($item->attr, true), $item->num);
                if ($res !== false) {
                    $new_item->price = $res['total_price'];
                    $this->setMiaoshaSellNum($miaosha_data['id'], json_decode($item->attr, true), $res['miaosha_price_num']);
                }
            }


            $total_price += $new_item->price;
            $new_cart_id_list[] = $item->id;
            $list[] = $new_item;
            $item->is_delete = 1;
            $item->save();
        }
        return [
            'total_price' => $total_price,
            'cart_id_list' => $new_cart_id_list,
            'list' => $list,
        ];
    }


    /**
     * @param string $goods_info
     * eg.{"goods_id":"22","attr":[{"attr_group_id":1,"attr_group_name":"颜色","attr_id":3,"attr_name":"橙色"},{"attr_group_id":2,"attr_group_name":"尺码","attr_id":2,"attr_name":"M"}],"num":1}
     */
    private function getGoodsListByGoodsInfo($goods_info)
    {
        $goods_info = json_decode($goods_info);
        $goods = Goods::findOne([
            'id' => $goods_info->goods_id,
            'is_delete' => 0,
            'store_id' => $this->store_id,
            'status' => 1,
        ]);
        if (!$goods) {
            return [
                'total_price' => 0,
                'list' => [],
            ];
        }
        $attr_id_list = [];
        foreach ($goods_info->attr as $item) {
            array_push($attr_id_list, $item->attr_id);
        }
        $total_price = 0;
        $goods_attr_info = $goods->getAttrInfo($attr_id_list);

        $attr_list = Attr::find()->alias('a')
            ->select('a.id attr_id,ag.attr_group_name,a.attr_name')
            ->leftJoin(['ag' => AttrGroup::tableName()], 'a.attr_group_id=ag.id')
            ->where(['a.id' => $attr_id_list])
            ->asArray()->all();
        $goods_pic = isset($goods_attr_info['pic']) ? $goods_attr_info['pic'] ?: $goods->getGoodsPic(0)->pic_url : $goods->getGoodsPic(0)->pic_url;
        $goods_item = (object)[
            'goods_id' => $goods->id,
            'goods_name' => $goods->name,
            'goods_pic' => $goods_pic,
//            'goods_pic' => $goods->getGoodsPic(0)->pic_url,
            'num' => $goods_info->num,
            'price' => doubleval(empty($goods_attr_info['price']) ? $goods->price : $goods_attr_info['price']) * $goods_info->num,
            'attr_list' => $attr_list,
            'give' => 0,
        ];

        //秒杀价计算
        $miaosha_data = $this->getMiaoshaData($goods, $attr_id_list);
        if ($miaosha_data) {
            $res = $this->getMiaoshaPrice($miaosha_data, $goods, $attr_id_list, $goods_info->num);
            if ($res !== false) {
                $goods_item->price = $res['total_price'];
                $this->setMiaoshaSellNum($miaosha_data['id'], $attr_id_list, $res['miaosha_price_num']);
            }
        }

        $total_price += $goods_item->price;
        return [
            'total_price' => $total_price,
            'list' => [$goods_item],
        ];
    }

    public function getOrderNo()
    {
        $store_id = empty($this->store_id) ? 0 : $this->store_id;
        $order_no = null;
        while (true) {
            $order_no = date('YmdHis') . rand(100000, 999999);
            $exist_order_no = Order::find()->where(['order_no' => $order_no])->exists();
            if (!$exist_order_no)
                break;
        }
        return $order_no;
    }


    /**
     * @param Goods $goods
     * @param array $attr_id_list eg.[12,34,22]
     * @return array ['id'=>'miaosha_goods id','attr_list'=>[],'miaosha_price'=>'秒杀价格','miaosha_num'=>'秒杀数量','sell_num'=>'已秒杀商品数量']
     */
    private function getMiaoshaData($goods, $attr_id_list = [])
    {
        $miaosha_goods = MiaoshaGoods::findOne([
            'goods_id' => $goods->id,
            'is_delete' => 0,
            'open_date' => date('Y-m-d'),
            'start_time' => intval(date('H')),
        ]);
        if (!$miaosha_goods)
            return null;
        $attr_data = json_decode($miaosha_goods->attr, true);
        sort($attr_id_list);
        $miaosha_data = null;
        foreach ($attr_data as $i => $attr_data_item) {
            $_tmp_attr_id_list = [];
            foreach ($attr_data_item['attr_list'] as $item) {
                $_tmp_attr_id_list[] = $item['attr_id'];
            }
            sort($_tmp_attr_id_list);
            if ($attr_id_list == $_tmp_attr_id_list) {
                $miaosha_data = $attr_data_item;
                break;
            }
        }
        $miaosha_data['id'] = $miaosha_goods->id;
        return $miaosha_data;
    }

    /**
     * 获取商品秒杀价格，若库存不足则使用商品原价，若有部分库存，则部分数量使用秒杀价，部分使用商品原价，商品库存不足返回false
     * @param array $miaosha_data ['attr_list'=>[],'miaosha_price'=>'秒杀价格','miaosha_num'=>'秒杀数量','sell_num'=>'已秒杀商品数量']
     * @param Goods $goods
     * @param array $attr_id_list eg.[12,34,22]
     * @param integer $buy_num 购买数量
     *
     * @return false|array
     */
    private function getMiaoshaPrice($miaosha_data, $goods, $attr_id_list, $buy_num)
    {
        $attr_data = json_decode($goods->attr, true);
        sort($attr_id_list);
        $goost_attr_data = null;
        foreach ($attr_data as $i => $attr_data_item) {
            $_tmp_attr_id_list = [];
            foreach ($attr_data_item['attr_list'] as $item) {
                $_tmp_attr_id_list[] = intval($item['attr_id']);
            }
            sort($_tmp_attr_id_list);
            if ($attr_id_list == $_tmp_attr_id_list) {
                $goost_attr_data = $attr_data_item;
                break;
            }
        }
        $goods_price = $goost_attr_data['price'];
        if (!$goods_price)
            $goods_price = $goods->price;

        $miaosha_price = min($miaosha_data['miaosha_price'], $goods_price);

        if ($buy_num > $goost_attr_data['num'])//商品库存不足
        {
            \Yii::warning([
                'res' => '库存不足',
                'm_data' => $miaosha_data,
                'g_data' => $goost_attr_data,
                '$attr_id_list' => $attr_id_list,
            ]);
            return false;
        }

        if ($buy_num <= ($miaosha_data['miaosha_num'] - $miaosha_data['sell_num'])) {
            \Yii::warning([
                'res' => '库存充足',
                'price' => $buy_num * $miaosha_price,
                'm_data' => $miaosha_data,
            ]);
            return [
                'miaosha_price_num' => $buy_num,
                'original_price_num' => 0,
                'total_price' => $buy_num * $miaosha_price
            ];
        }

        $miaosha_num = ($miaosha_data['miaosha_num'] - $miaosha_data['sell_num']);
        $original_num = $buy_num - $miaosha_num;

        \Yii::warning([
            'res' => '部分充足',
            'price' => $miaosha_num * $miaosha_price + $original_num * $goods_price,
            'm_data' => $miaosha_data,
        ]);

        return [
            'miaosha_price_num' => $miaosha_num,
            'original_price_num' => $original_num,
            'total_price' => $miaosha_num * $miaosha_price + $original_num * $goods_price,
        ];
    }

    private function setMiaoshaSellNum($miaosha_goods_id, $attr_id_list, $num)
    {
        $miaosha_goods = MiaoshaGoods::findOne($miaosha_goods_id);
        if (!$miaosha_goods)
            return false;
        sort($attr_id_list);
        $attr_data = json_decode($miaosha_goods->attr, true);
        foreach ($attr_data as $i => $attr_row) {
            $_tmp_attr_id_list = [];
            foreach ($attr_row['attr_list'] as $attr) {
                $_tmp_attr_id_list[] = intval($attr['attr_id']);
            }
            sort($_tmp_attr_id_list);
            if ($_tmp_attr_id_list == $attr_id_list) {
                $attr_data[$i]['sell_num'] = intval($attr_data[$i]['sell_num']) + intval($num);
                break;
            }
        }
        $miaosha_goods->attr = json_encode($attr_data, JSON_UNESCAPED_UNICODE);
        $res = $miaosha_goods->save();
        return $res;
    }

}