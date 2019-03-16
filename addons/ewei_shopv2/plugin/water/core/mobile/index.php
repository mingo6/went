<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends PluginPfMobilePage
{

    //订单状态
    const ORDER_STATUS_CANCEL = 0; //已取消
    const ORDER_STATUS_NO_PAID = 1; //未付款
    const  ORDER_STATUS_YES_PAID= 2; //已付款
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
        $goods = array();
        $openid = $_W['openid'];
        $content = trim(urldecode($_GPC['content']));
        if (empty($openid)) {
           /* exit();*/
        }

        $member = m('member')->getMember($openid);

        if (empty($member)) {
           /* exit();*/
        }

        $uid = $member['uid'];
        //获取所有的产品
        $list = pdo_fetchall('select * from ' . tablename('ewei_shop_water') . ' where  uniacid=:uniacid',array(':uniacid' => $_W['uniacid']));

        //获取地址列表
        $address = pdo_fetchall('select * from '.tablename('ewei_shop_member_address').' where uniacid=:uniacid and openid=:openid',array(':uniacid'=> $_W['uniacid'],':openid'=>$openid));

        include $this->template();
    }


	public function mainold()
	{
		global $_W;
		global $_GPC;
		$goods = array();
		$openid = trim($_GPC['openid']);
		$content = trim(urldecode($_GPC['content']));

		if (empty($openid)) {
			exit();
		}


		$member = m('member')->getMember($openid);

		if (empty($member)) {
			exit();
		}


		$poster = pdo_fetch('select * from ' . tablename('ewei_shop_postera') . ' where keyword2=:keyword and uniacid=:uniacid limit 1', array(':keyword' => $content, ':uniacid' => $_W['uniacid']));

		if (empty($poster)) {
			m('message')->sendCustomNotice($openid, '未找到海报!');
			exit();
		}


		$time = time();

		if ($time < $poster['timestart']) {
			$starttext = ((empty($poster['starttext']) ? '活动于 [starttime] 开始，请耐心等待...' : $poster['starttext']));
			$starttext = str_replace('[starttime]', date('Y年m月d日 H:i', $poster['timestart']), $starttext);
			$starttext = str_replace('[endtime]', date('Y年m月d日 H:i', $poster['timeend']), $starttext);
			m('message')->sendCustomNotice($openid, $starttext);
			exit();
		}


		if ($poster['timeend'] < time()) {
			$endtext = ((empty($poster['endtext']) ? '活动已结束，谢谢您的关注！' : $poster['endtext']));
			$endtext = str_replace('[starttime]', date('Y-m-d H:i', $poster['timestart']), $endtext);
			$endtext = str_replace('[endtime]', date('Y-m-d- H:i', $poster['timeend']), $endtext);
			m('message')->sendCustomNotice($openid, $endtext);
			exit();
		}


		if (($member['isagent'] != 1) || ($member['status'] != 1)) {
			if (empty($poster['isopen'])) {
				$opentext = ((!empty($poster['opentext']) ? htmlspecialchars_decode($poster['opentext'], ENT_QUOTES) : '您还不是我们分销商，去努力成为分销商，拥有你的专属海报吧!'));
				m('message')->sendCustomNotice($openid, $opentext, trim($poster['openurl']));
				exit();
			}

		}


		$waittext = ((!empty($poster['waittext']) ? htmlspecialchars_decode($poster['waittext'], ENT_QUOTES) : '您的专属海报正在拼命生成中，请等待片刻...'));
		$waittext = str_replace('[starttime]', date('Y年m月d日 H:i', $poster['timestart']), $waittext);
		$waittext = str_replace('[endtime]', date('Y年m月d日 H:i', $poster['timeend']), $waittext);
		m('message')->sendCustomNotice($openid, $waittext);
		$qr = $this->model->getQR($poster, $member);

		if (is_error($qr)) {
			m('message')->sendCustomNotice($openid, '生成二维码出错: ' . $qr['message']);
			exit();
		}


		$img = $this->model->createPoster($poster, $member, $qr);
		$mediaid = $img['mediaid'];

		if (!empty($mediaid)) {
			m('message')->sendImage($openid, $mediaid);
		}
		 else {
			$oktext = '<a href=\'' . $img['img'] . '\'>点击查看您的专属海报</a>';
			m('message')->sendCustomNotice($openid, $oktext);
		}

		exit();
	}



	//我的订单 模板
	public function myOrderList()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        if (empty($openid)) {
            exit();
        }
        $member = m('member')->getMember($openid);
        if (empty($openid)) {
            exit();
        }
        $uid = $member['id'];
        //查询 该用户的全部订单

/*
        $condition = ' and a.uid=:uid and a.uniacid=:uniacid and b.uniacid=:uniacidb ';
        $param = array(':uid' => $uid, ':uniacid' => $_W['uniacid'],':uniacidb'=>$_W['uniacid']);

        $status = $_GPC['status'];
        if($status==null&&$status!==0) {

        } else {
            $condition .= 'and a.status = :status';
            $param[':status'] = $status;
        }

        $list = pdo_fetchall('select a.*,b.realname,c.image from ' . tablename('ewei_shop_waterorder') . ' as a  left join '.tablename('ewei_shop_member').' as b on a.uid = b.id left join '.tablename('ewei_shop_water').' as c on c.id = a.water_id where 1'.$condition.'', $param);

        foreach ($list as $k=>&$v) {
            $v['statusstr'] = $this->getStatusName($v['status']);
        }
        unset($v);*/

        include $this->template();

    }



	//我的订单列表
    public function myOrderListold()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        if (empty($openid)) {
             exit();
        }
        $member = m('member')->getMember($openid);
        if (empty($openid)) {
            exit();
        }
        $uid = $member['id'];
        //查询 该用户的全部订单


        $condition = ' and a.uid=:uid and a.uniacid=:uniacid and b.uniacid=:uniacidb ';
        $param = array(':uid' => $uid, ':uniacid' => $_W['uniacid'],':uniacidb'=>$_W['uniacid']);

        $status = $_GPC['status'];

        if($status==null&&$status!==0) {

        } else {
            $condition .= 'and a.status = :status';
            $param[':status'] = $status;
        }

        $list = pdo_fetchall('select a.*,b.realname,c.image from ' . tablename('ewei_shop_waterorder') . ' as a  left join '.tablename('ewei_shop_member').' as b on a.uid = b.id left join '.tablename('ewei_shop_water').' as c on c.id = a.water_id where 1'.$condition.'', $param);

        foreach ($list as $k=>&$v) {
            $v['statusstr'] = $this->getStatusName($v['status']);
        }
        unset($v);

        include $this->template();
    }



    public function get_list()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        if (empty($openid)) {
            exit();
        }
        $member = m('member')->getMember($openid);
        if (empty($openid)) {
            exit();
        }
        $uid = $member['id'];
        //查询 该用户的全部订单

        $condition = ' and a.uid=:uid and a.uniacid=:uniacid and b.uniacid=:uniacidb ';
        $param = array(':uid' => $uid, ':uniacid' => $_W['uniacid'],':uniacidb'=>$_W['uniacid']);

        $status = $_GPC['status'];
        if($status == 4) {
            $status = 5;
        }

        if($status==null&&$status!==0) {

        } else {
            $condition .= 'and a.status = :status';
            $param[':status'] = $status;
        }



        $psize = 50;
        $pindex = max(1, intval($_GPC['page']));

        $list = pdo_fetchall('select a.*,b.realname,c.image from ' . tablename('ewei_shop_waterorder') . ' as a  left join '.tablename('ewei_shop_member').' as b on a.uid = b.id left join '.tablename('ewei_shop_water').' as c on c.id = a.water_id where 1'.$condition.' order by a.create_time desc limit '.(($pindex - 1) * $psize) . ',' . $psize.'', $param);

        foreach ($list as $k=>&$v) {
            $v['statusstr'] = $this->getStatusName($v['status']);
        }
        unset($v);


      //  $total = pdo_fetchcolumn('select COUNT(a.*) from ' . tablename('ewei_shop_waterorder') . ' as a  left join '.tablename('ewei_shop_member').' as b on a.uid = b.id left join '.tablename('ewei_shop_water').' as c on c.id = a.water_id where 1'.$condition.' order by a.create_time desc', $param);

        $total = pdo_fetchcolumn('select COUNT("a.*") from ' . tablename('ewei_shop_waterorder') . ' as a  left join '.tablename('ewei_shop_member').' as b on a.uid = b.id left join '.tablename('ewei_shop_water').' as c on c.id = a.water_id where 1'.$condition.' order by a.create_time desc', $param);

        show_json(1, array('list' => $list, 'pagesize' => $psize, 'total' => $total));
    }




    //根据产品名称获取价格

    public function getPriceByName()
    {
        global $_W;
        global $_GPC;
        $id = $_GPC['id'];//产品id

        $openid = $_W['openid'];
        if (empty($openid)) {
            exit();
        }
        $member = m('member')->getMember($openid);
        if (empty($openid)) {
            exit();
        }
        $uid = $member['id'];
        $price = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_water') . ' where id=:id and uniacid=:uniacid',array(':id' => $id, ':uniacid' => $_W['uniacid']));

        if (!empty($price)) {
            $return = array(
                'code'=>200,
                'msg'=>'查询成功',
                'data'=>$price,
            );
        } else {
            $return = array(
                'code'=>9999,
                'msg'=>'该商品不存在');
        }
        echo json_encode($return,true);
    }



    //下订单
    public function orderMake()
    {
        global $_W;
        global $_GPC;
        $id = $_GPC['id'];//产品id
        $data = $_GPC;
        $openid = $_W['openid'];
        if (empty($openid)) {
            exit();
        }
        $member = m('member')->getMember($openid);
        if (empty($openid)) {
            exit();
        }


        //根据addressmobile查出地址和手机号码
        $addressmobile = pdo_fetch('select * from '.tablename('ewei_shop_member_address').' where id =:id ',array(':id'=>$_GPC['addressmobile']));

        $watername = pdo_fetch('select * from '.tablename('ewei_shop_water').' where id =:id',array(':id'=>$_GPC['water_id']));

        //加入订单表
        $orderData = array(
            'uid'=>$member['id'],
            'price'=>$watername['price']*$_GPC['num'],//订单总价
            'appointment_time'=>strtotime($_GPC['appointment_time']),//预约时间
            'order_sn'=>$this->orderSn(),//订单编号
            'create_time'=>time(),//下订单时间
            'is_pay'=>self::PAY_STATUS_NO,//是否付款 ---未付款
            'status'=>self::ORDER_STATUS_NO_PAID,//订单状态 --- 未付款
            'address'=>$addressmobile['province'].$addressmobile['city'].$addressmobile['area'].$addressmobile['address'],//地址
            'mobile'=>$addressmobile['mobile'],//电话
            'uniacid'=>$_W['uniacid'],//公众号id
            'water_id'=>$_GPC['water_id'],//产品id
            'water_name'=>$watername['name'],//产品名称
            'linkman'=>$addressmobile['realname'],//产品名称
            'num'=>$_GPC['num'],//数量
        );
        if ($orderData['appointment_time']<time()) {
            echo json_encode(array('status'=>99999,'msg'=>'预约时间必须大于当前时间'));
            return;
        }

        //判断该订单号是否存在
        $isExist = pdo_fetch('select * from '.tablename('ewei_shop_waterorder').' where order_sn=:order_sn',array(':order_sn'=>$orderData['order_sn']));
        if($isExist) {
            echo json_encode(array('status'=>99999,'msg'=>'订单号重复'));
            return;
        }


        //判断预购时间
        $sysTime = pdo_fetch('select * from '.tablename('ewei_shop_watertime').' where id = 1');
        //取出用户的预约天数
        $appointment_time = date('Y-m-d',$orderData['appointment_time']);
        $sysTimeDaySmall = strtotime($appointment_time)+$sysTime['small_time']; //当日最小配送标准时间
        $sysTimeDayLast = strtotime($appointment_time)+$sysTime['last_time']; //当日最大配送标准时间

        if($sysTime) {
          if($sysTimeDaySmall>$orderData['appointment_time']||$sysTimeDayLast<$orderData['appointment_time']) {
              echo json_encode(array('status'=>99999,'msg'=>'您预约配送的时间，无法配送，请选择其他时间'));
              return;
          }
        }

        $res = pdo_insert('ewei_shop_waterorder',$orderData);
        $orderid = pdo_insertid();

        if($res) {
            echo json_encode(array('status'=>200,'msg'=>'下单成功','id'=>$orderid));
            return;
        }  else {
            echo json_encode(array('status'=>99999,'msg'=>'下单失败'));
            return;
        }

    }





    //生成订单编号
    public function orderSn()
    {
        return 'w'.date('Ymd').time().rand(1000,9999);
    }



    //获取状态名称
    public function getStatusName($status)
    {
        switch($status){
            case self::ORDER_STATUS_CANCEL:
                $statusName = '已取消';
                break;
            case self::ORDER_STATUS_NO_PAID:
                $statusName = '未付款';
                break;
            case self::ORDER_STATUS_YES_PAID:
                $statusName = '已付款';
                break;
            case self::ORDER_STATUS_YES_SEND:
                $statusName = '已发货';
                break;
            case self::ORDER_STATUS_RETURNING:
                $statusName = '退货中';
                break;
            case self::ORDER_STATUS_FINISH:
                $statusName = '已完成';
                break;
            case self::ORDER_STATUS_YES_CLOSE:
                $statusName = '已关闭';
                break;
            case self::ORDER_STATUS_YES_RETURN:
                $statusName = '已退货';
                break;
            default:
                $statusName = '';
        }

        return $statusName;
    }


    //退款 模板页面
    public function refund($tid, $fee = 0, $reason = '')
    {
        global $_W;
        global $_GPC;

     //   $express_list = m('express')->getExpressList();
        $orderid = $_GPC['id'];
        include $this->template();
    }


    //退款提交
    public function submit()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['id']);//订单id
        $member = m('member')->getMember($openid, true);
        $condition = ' and openid=:openid  and uniacid=:uniacid and id = :orderid ';
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_waterorder') . "\n\t\t\t\t" . 'where uid=:uid  and uniacid=:uniacid and id = :orderid order by create_time desc ', array(':uniacid' => $uniacid, ':uid' => $member['id'], ':orderid' => $orderid));

        if ($order['status'] == '7')
        {
            show_json(0, '订单已完成!');
        }
        $rtype = intval($_GPC['rtype']);

        $refund['create_time'] = time();
        $updateData = array(
            'status' => self::ORDER_STATUS_RETURNING,
            'refund_mark'=>$_GPC['content'],
            'refund_type'=>$_GPC['rtype']
        );

        pdo_update('ewei_shop_waterorder',$updateData, array('id' => $orderid, 'uniacid' => $uniacid));
        show_json(1);
    }





    //订单详情
    public function orderDetail()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['orderid']);
        $member = m('member')->getMember($openid, true);
        $condition = ' and openid=:openid  and uniacid=:uniacid and id = :orderid ';
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_waterorder') . "\n\t\t\t\t" . 'where uid=:uid  and uniacid=:uniacid and id = :orderid order by create_time desc ', array(':uniacid' => $uniacid, ':uid' => $member['id'], ':orderid' => $orderid));
        $good = pdo_fetch('select * from ' . tablename('ewei_shop_water') . "\n\t\t\t\t\t" . 'where id = :id and status = :status and uniacid = :uniacid  desc', array(':id' => $order['water_id'], ':uniacid' => $uniacid));
        $order['refund_type_str'] = $order['refund_type'] == self::REFUND_TYPE_RETURNGOODS ?'退款退货':'未退货';

        include $this->template();
    }


    //确认收货
    public function confirmShouhuo()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['id']);
        $member = m('member')->getMember($openid, true);
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_waterorder') . "\n\t\t\t\t" . 'where uid=:uid  and uniacid=:uniacid and id = :orderid order by create_time desc ', array(':uniacid' => $uniacid, ':uid' => $member['id'], ':orderid' => $orderid));
        if ($order['status'] == self::ORDER_STATUS_FINISH) {
            show_json(0,'该订单已经完成');
        }
        if ($order['status'] != self::ORDER_STATUS_YES_SEND) {
            show_json(0,'该订单尚未发货，不可确认收货');
        }

        $updateData = array(
            'status'=>self::ORDER_STATUS_FINISH,
            'finish_time'=>time(),
        );
        $res = pdo_update('ewei_shop_waterorder',$updateData,array('id'=>$orderid));
        if ($res === false) {
            show_json(0,'通讯错误');
        } else {
            show_json(1);
        }
    }


    //删除订单
    public function orderDelte()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['id']);
        $member = m('member')->getMember($openid, true);
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_waterorder') . "\n\t\t\t\t" . 'where uid=:uid  and uniacid=:uniacid and id = :orderid order by create_time desc ', array(':uniacid' => $uniacid, ':uid' => $member['id'], ':orderid' => $orderid));
        if ($order['status'] != self::ORDER_STATUS_NO_PAID) {
            show_json(0,'该订单不是未付款状态，无法删除');
        }

        $res = pdo_delete('ewei_shop_waterorder',array('id'=>$orderid));
        if ($res === false) {
            show_json(0,'通讯错误');
        } else {
            show_json(1);
        }

    }


    //取消订单
    public function confirmCancel()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['id']);
        $cancelMark = intval($_GPC['mark']);
        $member = m('member')->getMember($openid, true);
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_waterorder') . "\n\t\t\t\t" . 'where uid=:uid  and uniacid=:uniacid and id = :orderid order by create_time desc ', array(':uniacid' => $uniacid, ':uid' => $member['id'], ':orderid' => $orderid));

        if ($order['status'] != self::ORDER_STATUS_NO_PAID) {
            show_json(0,'该订单不是未付款状态，无法取消');
        }

        $updateData = array(
            'status'=>self::ORDER_STATUS_CANCEL,
            'cancel_mark'=>$cancelMark,
        );

        $res = pdo_update('ewei_shop_waterorder',$updateData,array('id'=>$orderid));
        if ($res === false) {
            show_json(0,'通讯错误');
        } else {
            show_json(1);
        }

    }

}


?>