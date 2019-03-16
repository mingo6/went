<?php
if (!defined('IN_IA')) 
{
	exit('Access Denied');
}
class Aftersale_EweiShopV2Model 
{
	const STATUS_WAIT = 0;	//待审核
	const STATUS_MAINTENANCE = 1;		//维修中
	const STATUS_DELIVER_GOODS = 2;		//已发货
	const STATUS_COMPLETED = 3;		//已完成
	const STATUS_CANCEL = 10;		//已取消
	const STATUS_REFUSE = 9;		//已拒绝

	public function getAllStatus(){
		return array(
			array('id' => self::STATUS_WAIT,'name'=>'待审核'),
			array('id' => self::STATUS_MAINTENANCE,'name'=>'维修中'),
			array('id' => self::STATUS_DELIVER_GOODS,'name'=>'已发货'),
			array('id' => self::STATUS_COMPLETED,'name'=>'已完成'),
			array('id' => self::STATUS_CANCEL,'name'=>'已取消'),
			array('id' => self::STATUS_REFUSE,'name'=>'已拒绝'),
		);
	}
}
?>