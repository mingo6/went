<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends PluginWebPage
{
    const ORDER_STATUS_CANCEL = 0; //已取消
    const ORDER_STATUS_NO_PAID = 1; //未付款
    const ORDER_STATUS_YES_PAID = 2; //已付款
    const ORDER_STATUS_YES_SEND = 3; //已发货
    const ORDER_STATUS_RETURNING  = 4; //退货中
    const ORDER_STATUS_FINISH = 5; //已完成
    const ORDER_STATUS_YES_CLOSE = 6; //已关闭
    const ORDER_STATUS_YES_RETURN = 7; //已退货

    //订单支付状态
    const PAY_STATUS_YES = 1;//已经支付
    const PAY_STATUS_NO = 0;//未支付

    //refund_type
    const REFUND_TYPE_NO = 0; //未退货
    const REFUND_TYPE_RETURNGOODS = 1; //退款退货
    public function main()
    {

        global $_W;
        global $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 10;
        $params = array(':uniacid' => $_W['uniacid']);
        $condition = ' and uniacid=:uniacid ';

        if (!empty($_GPC['keyword'])) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition .= ' AND `name` LIKE :name';
            $params[':name'] = '%' . trim($_GPC['keyword']) . '%';
        }


        $list = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_water') . ' WHERE 1 ' . $condition . ' ORDER BY create_time desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);


        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('ewei_shop_water') . ' where 1 ' . $condition . ' ', $params);
        $pager = pagination($total, $pindex, $psize);

        include $this->template();
    }

    public function add()
    {
        $this->post();
    }

    public function edit()
    {
        $this->post();
    }


    //添加水产品
    public function post()
    {
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        $plugin_coupon = com('coupon');
        $item = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_water') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));

        if (!empty($item)) {
            $data = json_decode(str_replace('&quot;', '\'', $item['data']), true);
        }
        $data['name'] = $_GPC['name'];
        $data['num'] = $_GPC['num'];
        $data['image'] = $_GPC['image'];
        $data['small_image'] = $_GPC['small_image'];
        $data['price'] = $_GPC['price'];
        $data['already_num'] = $_GPC['already_num'];
        $data['is_on'] = $_GPC['is_on'];
        $data['uniacid'] = $_W['uniacid'];


        if ($_W['ispost']) {

            if (!empty($id)) {
                //编辑
                $data['id'] = $id;
                $res = pdo_update('ewei_shop_water', $data, array('id' => $id));
                plog('water.edit', '编辑成功');

            } else {
                //添加
                $data['create_time'] = time();
                $res = pdo_insert('ewei_shop_water', $data);
                $id = pdo_insertid();
                plog('water.add', '添加成功');
            }

            if ($res === false) {
                show_json(0, array('url' => webUrl('water')));
            } else {
                show_json(1, array('url' => webUrl('water')));
            }
        }
        include $this->template();


    }


    public function delete()
    {
        global $_GPC;
        global $_W;
        $id = intval($_GPC['id']);

        if (empty($id)) {
            $id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
        }


        $water = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_water') . ' WHERE id in ( ' . $id . ' ) and uniacid=' . $_W['uniacid']);

        foreach ($water as $v) {
            pdo_delete('ewei_shop_water', array('id' => $v['id'], 'uniacid' => $_W['uniacid']));
            plog('postera.delete', '删除水 ID: ' . $id . ' 水名称: ' . $v['name']);
        }

        show_json(1, array('url' => webUrl('water')));
    }


    public function waterorder()
    {
        global $_GPC;
        global $_W;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 10;
        $params = array(':uniacid' => $_W['uniacid'],':uniacidb' => $_W['uniacid']);
        $condition = ' and a.uniacid=:uniacid and b.uniacid = :uniacidb';
        if (!empty($_GPC['keyword'])) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition .= ' AND a.linkman LIKE :name OR a.water_name LIKE :water_name'; //按照姓名搜索
            $params[':name'] = '%' . trim($_GPC['keyword']) . '%';
            $params[':water_name'] = '%' . trim($_GPC['keyword']) . '%';
        }

        $searchtime = trim($_GPC['searchtime']);
        if (!(empty($searchtime)) && is_array($_GPC['time']) && in_array($searchtime, array('appointment','create','pay')))
        {
            $starttime = strtotime($_GPC['time']['start']);
            $endtime = strtotime($_GPC['time']['end']);
            $condition .= ' AND a.' . $searchtime . '_time >= :starttime AND a.' . $searchtime . '_time <= :endtime ';
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }


        $list = pdo_fetchall('SELECT a.*,b.realname,c.image FROM ' . tablename('ewei_shop_waterorder') . ' as a left join '.tablename('ewei_shop_member').' as b on a.uid = b.id left join '.tablename('ewei_shop_water').' as c on a.water_id = c.id WHERE 1 ' . $condition . ' ORDER BY a.create_time desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('ewei_shop_waterorder') . ' as a  left join '.tablename('ewei_shop_member').' as b on a.uid = b.id  where 1 ' . $condition . ' ', $params);
        $pager = pagination($total, $pindex, $psize);
        include $this->template();

    }




    //预约时间设置
    public function waterTimeSet()
    {
        global $_GPC;
        global $_W;
        $id = intval($_GPC['id']);
        $list = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_watertime') . ' WHERE 1' );

        if ($_W['ispost']) {
            if($_GPC['small_time']>$_GPC['last_time']) {
                show_json(0,'最小时间不能大于最大时间');
            }
            if($_GPC['last_time']>24||$_GPC['last_time']<0||$_GPC['small_time']>24||$_GPC['small_time']<0) {
                show_json(0,'时间不能大于24或小于0');
            }
            $data['small_time'] = $_GPC['small_time']*60*60; //存为秒数
            $data['last_time'] = $_GPC['last_time']*60*60;//存为秒数
            $data['uniacid'] = $_W['uniacid'];//公众号id
            $data['id'] = 1;
            $res = pdo_update('ewei_shop_watertime', $data, array('id' => 1));
            plog('watertime.edit', '设置成功');

            if ($res === false) {
                show_json(0, array('url' => webUrl('water')));
            } else {
                show_json(1, array('url' => webUrl('water')));
            }
        }

        $list['small_time'] = $list['small_time']/3600;
        $list['last_time'] = $list['last_time']/3600;

        include $this->template('water/postWaterTime');
    }


    //修改订单状态
    public function statusUpdate()
    {
        global $_GPC;
        global $_W;
        $id = intval($_GPC['id']); //订单id
        $status = intval($_GPC['status']); //要修改的状态
        //判断订单是否存在
        $detail = pdo_fetch('select * from '.tablename('ewei_shop_waterorder') .' where id ='.$id.'');
        if(!$detail) {
            show_json(0,'订单不存在');
        }

        $allowArr = array(
            self::ORDER_STATUS_CANCEL,
            self::ORDER_STATUS_NO_PAID,
            self::ORDER_STATUS_YES_PAID,
            self::ORDER_STATUS_YES_SEND,
            self::ORDER_STATUS_RETURNING,
            self::ORDER_STATUS_FINISH,
            self::ORDER_STATUS_YES_CLOSE,
            self::ORDER_STATUS_YES_RETURN
        );
        if(!in_array($status,$allowArr)) {
            show_json(0,'状态错误');
        }
        $updateData = array(
            'status'=>$status
        );
        $res = pdo_update('ewei_shop_water', $updateData, array('id' => 1));
        if ($res === false) {
            show_json(0,'更新错误');
        }else{
            show_json(1,array('url' => webUrl('water')));
        }

    }


    //获取订单详情
    public function orderDetail()
    {
        global $_GPC;
        global $_W;
        $id = intval($_GPC['id']); //订单id

        //判断订单是否存在
        $order = pdo_fetch('select a.*,b.image,c.realname,c.nickname,c.mobile as membermobile,c.weixin,c.avatar from '.tablename('ewei_shop_waterorder') .' as a  left join '.tablename('ewei_shop_water').' as b on a.water_id = b.id left join '.tablename('ewei_shop_member').' as c on c.id = a.uid  where a.id ='.$id.'');
        if(!$order) {
            show_json(0,'订单不存在');
        }

        $order['refund_type_str'] = $order['refund_type'] == self::REFUND_TYPE_RETURNGOODS ?'退款退货':'未退货';
        include $this->template();
    }


    //确认收货 完成订单
    public function confirmShouhuo()
    {
        global $_GPC;
        global $_W;
        $id = intval($_GPC['id']); //订单id

        //判断订单是否存在
        $order = pdo_fetch('select * from '.tablename('ewei_shop_waterorder') .' where id ='.$id.'');
        if(!$order) {
            show_json(0,'订单不存在');
        }
        //修改订单状态
        $updateData = array(
            'status'=>self::ORDER_STATUS_FINISH,
        );
        $res = pdo_update('ewei_shop_waterorder',$updateData,array('id'=>$id));
        if($res === false) {
            show_json(0,'操作失败');
        } else {
            show_json(1);
        }

    }


    //确认发货
    public function confirmFahuo()
    {
        global $_GPC;
        global $_W;
        $id = intval($_GPC['id']); //订单id

        //判断订单是否存在
        $order = pdo_fetch('select * from '.tablename('ewei_shop_waterorder') .' where id ='.$id.'');
        if(!$order) {
            show_json(0,'订单不存在');
        }
        //修改订单状态
        $updateData = array(
            'status'=>self::ORDER_STATUS_YES_SEND,
        );
        $res = pdo_update('ewei_shop_waterorder',$updateData,array('id'=>$id));
        if($res === false) {
            show_json(0,'操作失败');
        } else {
            show_json(1);
        }

    }


    //确认退款
    public function confirmRefound()
    {
        global $_GPC;
        global $_W;
        $id = intval($_GPC['id']); //订单id

        //判断订单是否存在
        $order = pdo_fetch('select * from '.tablename('ewei_shop_waterorder') .' where id ='.$id.'');
        if(!$order) {
            show_json(0,'订单不存在');
        }

        if($order['status']==self::ORDER_STATUS_YES_RETURN) {
            show_json(0,'该订单已经退款');
        }

        //获取该用户的余额
        $member = pdo_fetch('select * from '.tablename('ewei_shop_member').' where id ='.$order['uid'].'');
        if(!$member) {
            show_json(0,'该用户不存在');
        }

        $updateDataMember = array(
            'credit2'=>$member['credit2']+$order['price'],
        );
        $res1 = pdo_update('ewei_shop_member',$updateDataMember,array('id'=>$member['id']));
        if($res1 === false) {
            show_json(0,'网络错误');
        }
        $updateDataOrder = array(
            'status'=>self::ORDER_STATUS_YES_RETURN,//已退货（已退款）
        );

        $res2 = pdo_update('ewei_shop_waterorder',$updateDataOrder,array('id'=>$id));
        if($res2 === false) {
            show_json(0,'网络错误');
        } else {
            show_json(1);
        }
    }







}


?>