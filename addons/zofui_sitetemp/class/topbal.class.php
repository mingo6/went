<?php 



	class topbal
	{
		

		static function shopList(){
			global $_W;
			
			return array(
				'status' => array(
					array('value'=>'','name'=>'商家状态','url'=>WebCommon::logUrl('status','')),
					array('value'=>1,'name'=>'正常的','url'=>WebCommon::logUrl('status','1')),
					array('value'=>2,'name'=>'过期的','url'=>WebCommon::logUrl('status','2')),
					array('value'=>3,'name'=>'被禁用','url'=>WebCommon::logUrl('status','3')),
				),				
				'search' => array(
					array(
						'do'=>'shop',
						'op' => 'list',
						'for' => 'shopname',
						'placeholder' => '输入商家名称'
					),				
				),

			);
		}

		static function drawList(){
			global $_W;
			
			return array(
				'status' => array(
					array('value'=>'','name'=>'状态筛选','url'=>WebCommon::logUrl('status','')),
					array('value'=>0,'name'=>'待审核','url'=>WebCommon::logUrl('status','0')),
					array('value'=>1,'name'=>'已提现','url'=>WebCommon::logUrl('status','1')),
					//array('value'=>2,'name'=>'已退回','url'=>WebCommon::logUrl('status','2')),
					array('value'=>3,'name'=>'已拒绝','url'=>WebCommon::logUrl('status','3')),
				),
			);

		}

		static function goodList(){
			global $_W,$_GPC;
			
			return array(
				'status' => array(
					array('value'=>'','name'=>'状态筛选','url'=>WebCommon::logUrl('status','')),
					array('value'=>1,'name'=>'待审核','url'=>WebCommon::logUrl('status','1')),
					array('value'=>2,'name'=>'审核未通过','url'=>WebCommon::logUrl('status','2')),
				),
				'top' => array(
					array('value'=>'','name'=>'置顶筛选','url'=>WebCommon::logUrl('top','')),
					array('value'=>1,'name'=>'置顶推荐','url'=>WebCommon::logUrl('top','1')),
				),
				'search' => array(
					array(
						'do'=>'data',
						'op' => $_GPC['op'],
						'for' => 'gid',
						'placeholder' => '输入商品id'
					),
				)
			);

		}

		static function orderList(){
			global $_W,$_GPC;

			return array(
				'status' => array(
					array('value'=>'','name'=>'状态筛选','url'=>WebCommon::logUrl('status','')),
					array('value'=>1,'name'=>'未支付','url'=>WebCommon::logUrl('status','1')),
					array('value'=>2,'name'=>'已支付','url'=>WebCommon::logUrl('status','2')),
					array('value'=>3,'name'=>'已完成','url'=>WebCommon::logUrl('status','3')),
				),
				'search' => array(
					array(
						'do'=>'data',
						'op' => $_GPC['op'],
						'for' => 'orderid',
						'placeholder' => '输入订单编号'
					),
					array(
						'do'=>'data',
						'op' => $_GPC['op'],
						'for' => 'uorderid',
						'placeholder' => '输入微信订单编号'
					),

				)
			);
		}

		static function goodtempList(){
			global $_W;
			$sort = model_sorttemp::getSort();
			$list[] = array('value'=>'','name'=>'商品类型','url'=>WebCommon::logUrl('sort',''));
			foreach ((array)$sort as $k => $v) {
				$list[] = array('value'=>$v['id'],'name'=>$v['name'],'url'=>WebCommon::logUrl('sort',$v['id']));
			}
			return array(
				'sort' => $list,	
			);
		}

		static function userList(){
			global $_W;

			return array(
				'status' => array(
					array('value'=>'','name'=>'会员状态','url'=>WebCommon::logUrl('status','')),
					array('value'=>1,'name'=>'正常','url'=>WebCommon::logUrl('status','1')),
					array('value'=>2,'name'=>'黑名单','url'=>WebCommon::logUrl('status','2')),
				),
				'search' => array(
					array(
						'do'=>'data',
						'op' => 'user',
						'for' => 'nick',
						'placeholder' => '输入会员昵称'
					),
					array(
						'do'=>'data',
						'op' => 'user',
						'for' => 'user',
						'placeholder' => '输入会员id'
					),		
				),
			);
		}



	}


