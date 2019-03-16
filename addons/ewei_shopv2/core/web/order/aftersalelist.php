<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Aftersalelist_EweiShopV2Page extends WebPage 
{
	/**
	 * 订单列表
	 */
	public function main() 
	{
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		
		$condition = 'a.uniacid = :uniacid';
		$param = array(
			':uniacid' => $_W['uniacid']
		);

		if (empty($starttime) || empty($endtime)) 
		{
			$starttime = strtotime('-1 month');
			$endtime = time();
		}

		if(!empty($_GPC['status']))
		{
			$condition .= ' AND a.status = :status';
			$param[':status'] = $_GPC['status'] - 1;
		}
		if($_GPC['searchtime'] == 'create')
		{
			$starttime = strtotime($_GPC['time']['start']);
			$endtime = strtotime($_GPC['time']['end']);
			if($start > 0)
			{
				$condition .= ' AND a.create_time >= :starttime';
				$param[':starttime'] = $starttime;
			}
			if($end > 0){
				$condition .= ' AND a.create_time < :endtime';
				$param[':endtime'] = $endtime;
			}
		}
		if(!empty($_GPC['keyword']) && !empty($_GPC['searchfield']))
		{
			if($_GPC['searchfield'] == 'nickname_wechat')
			{
				$condition .= ' AND m.nickname_wechat like :keyword';
				$param[':keyword'] = '%'.$_GPC['keyword'].'%';
			}
			else
			{
				$condition .= ' AND a.'.$_GPC['searchfield'].' like :keyword';
				$param[':keyword'] = '%'.$_GPC['keyword'].'%';
			}
		}

		$sql = 'SELECT count(a.id) FROM '.tablename('ewei_shop_apply_after_sale').' AS a LEFT JOIN ' . tablename('ewei_shop_member') . ' AS m ON a.openid=m.openid WHERE ' . $condition;
		$total = pdo_fetchcolumn($sql,$param);

		$list = pdo_fetchall('SELECT a.*,ifnull(m.nickname_wechat,"会员不存在或已经删除") AS nickname_wechat FROM '.tablename('ewei_shop_apply_after_sale').' AS a LEFT JOIN ' . tablename('ewei_shop_member') . ' AS m ON a.openid=m.openid WHERE ' . $condition,$param);
		
		$aftersale = m('aftersale');
		$applystatus = $aftersale->getAllStatus();
		
		if ($_GPC['export'] == 1) 
		{
			plog('order.aftersalelist.export', '导出维修订单');
			$columns = array( 
				array('title' => '商品名称', 'field' => 'goods_name', 'width' => 12), 
				array('title' => '商品型号', 'field' => 'goods_model', 'width' => 12), 
				array('title' => '会员姓名', 'field' => 'nickname_wechat', 'width' => 12), 
				array('title' => '联系人姓名', 'field' => 'name', 'width' => 12), 
				array('title' => '联系人电话', 'field' => 'mobile', 'width' => 12), 
				array('title' => '快递单号', 'field' => 'express_numbers', 'width' => 24), 
				array('title' => '订单状态', 'field' => 'statusMsg', 'width' => 12), 
				array('title' => '创建时间', 'field' => 'create_time', 'width' => 12), 
				array('title' => '备注', 'field' => 'remark', 'width' => 24)
			);
			foreach ($list as &$row)
			{
				$row['create_time'] = date('Y-m-d H:i:s');
				foreach($applystatus AS $key => $status)
				{
					if($status['id'] == $row['status'])
					{
						$row['statusMsg'] = $status['name'];
						break;
					}
				}

				// $row['nickname'] = ((strexists($row['nickname'], '^') ? '\'' . $row['nickname'] : $row['nickname']));
				$row['express_numbers'] = $row['express_numbers'] . ' ';
			}
			unset($row);
			/* $exportlist = array();
			foreach ($list as &$r ) 
			{
				$ogoods = $r['goods'];
				unset($r['goods']);
				foreach ($ogoods as $k => $g ) 
				{
					if (0 < $k) 
					{
						$r['ordersn'] = '';
						$r['realname'] = '';
						$r['mobile'] = '';
						$r['openid'] = '';
						$r['nickname'] = '';
						$r['mrealname'] = '';
						$r['mmobile'] = '';
						$r['address'] = '';
						$r['address_province'] = '';
						$r['address_city'] = '';
						$r['address_area'] = '';
						$r['address_address'] = '';
						$r['paytype'] = '';
						$r['dispatchname'] = '';
						$r['dispatchprice'] = '';
						$r['goodsprice'] = '';
						$r['status'] = '';
						$r['createtime'] = '';
						$r['sendtime'] = '';
						$r['finishtime'] = '';
						$r['expresscom'] = '';
						$r['expresssn'] = '';
						$r['deductprice'] = '';
						$r['deductcredit2'] = '';
						$r['deductenough'] = '';
						$r['changeprice'] = '';
						$r['changedispatchprice'] = '';
						$r['price'] = '';
						$r['order_diyformdata'] = '';
					}
					$r['goods_title'] = $g['title'];
					$r['goods_goodssn'] = $g['goodssn'];
					$r['goods_optiontitle'] = $g['optiontitle'];
					$r['goods_total'] = $g['total'];
					$r['goods_price1'] = $g['price'] / $g['total'];
					$r['goods_price2'] = $g['realprice'] / $g['total'];
					$r['goods_rprice1'] = $g['price'];
					$r['goods_rprice2'] = $g['realprice'];
					$r['goods_diyformdata'] = $g['goods_diyformdata'];
					foreach ($diy_title_data as $key => $value ) 
					{
						$field = 'goods_' . $key;
						$r[$field] = $g[$field];
					}
					$exportlist[] = $r;
				}
			}
			unset($r); */
			m('excel')->export($list, array('title' => '售后订单数据-' . date('Y-m-d-H-i', time()), 'columns' => $columns));
			exit;
		}
		
		$pager = pagination($total, $pindex, $psize);
		
		include $this->template();
	}

	/**
	 * 订单详情
	 */
	public function detail()
	{
		global $_W;
		global $_GPC;
		$id = $_GPC['id'];
		if($id <= 0)
		{
			$this->message('id不能为空!', '', 'error');			
		}
		$condition = 'a.uniacid = :uniacid AND a.id=:id';
		$param = array(
			':uniacid' => $_W['uniacid'],
			':id' => $id
		);
		$after_sale_info = pdo_fetch('SELECT a.*,ifnull(m.nickname_wechat,"会员不存在或已经删除") AS nickname_wechat FROM '.tablename('ewei_shop_apply_after_sale').' AS a LEFT JOIN ' . tablename('ewei_shop_member') . ' AS m ON a.openid=m.openid WHERE ' . $condition,$param);		
		if(empty($after_sale_info))
		{
			$this->message('订单不存在!', '', 'error');		
		}
		if(!empty($after_sale_info['image'])){
			$after_sale_info['image'] = explode(',',$after_sale_info['image']);
		}
		$aftersale = m('aftersale');
		$applystatus = $aftersale->getAllStatus();

		include $this->template('order/aftersaledetail');
	}

	/**
	 * 审核订单
	 */
	public function audit()
	{
		global $_W,$_GPC;
		$id = $_GPC['id'];
		$status = intval($_GPC['status']);
		$condition = 'a.uniacid = :uniacid AND a.id=:id';
		$param = array(
			':uniacid' => $_W['uniacid'],
			':id' => $id
		);
		if($id <= 0)
		{
			show_json(0,'id不能为空!');
		}
		$after_sale_info = pdo_fetch('SELECT a.status FROM '.tablename('ewei_shop_apply_after_sale').' AS a WHERE ' . $condition,$param);
		if(empty($after_sale_info))
		{
			show_json(0,'售后订单不存在!');
		}
		if($status == $after_sale_info['status'])
		{
			show_json(0,'状态错误!');
		}
		$aftersale = m('aftersale');
		if($after_sale_info['status'] == $aftersale::STATUS_REFUSE || $after_sale_info['status'] == $aftersale::STATUS_CANCEL)
		{
			show_json(0,'状态错误!');
		}
		if($after_sale_info['status'] == $aftersale::STATUS_COMPLETED)
		{
			show_json(0,'订单已完成!');
		}
		$bool = pdo_update('ewei_shop_apply_after_sale', array('status' => $status), array('id' => $id));
		if(!$bool)
		{
			show_json(0,'系统错误!');
		}
		show_json(1,'修改成功');
	}

	/**
	 * 删除订单
	 */
	public function del()
	{
		global $_W,$_GPC;
		$id = $_GPC['id'];
		if($id <= 0)
		{
			show_json(0,'id不能为空!');
		}
		$after_sale_info = pdo_fetch('SELECT a.status FROM '.tablename('ewei_shop_apply_after_sale').' AS a WHERE a.uniacid = :uniacid AND a.id=:id', array(
			':uniacid' => $_W['uniacid'],
			':id' => $id
		));
		if(empty($after_sale_info))
		{
			show_json(0,'售后订单不存在!');
		}
		if(!pdo_delete('ewei_shop_apply_after_sale', array('id' => $id, 'uniacid' => $_W['uniacid']))){
			show_json(0,'网络错误!');
		}
		show_json(1,'删除成功!');
	}
}
?>