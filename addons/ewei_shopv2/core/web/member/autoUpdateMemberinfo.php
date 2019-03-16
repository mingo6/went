<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class AutoUpdateMemberinfo_EweiShopV2Page extends WebPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$memberList = pdo_fetchall('SELECT id,agentid,agentid_str FROM '.tablename('ewei_shop_member').' WHERE uniacid=:uniacid AND agentid = 0',array(':uniacid' => $_W['uniacid']));
		$count = count($memberList);
		foreach($memberList AS $key=>$memberInfo)
		{
			if(!empty($memberInfo['agentid_str']))
			{
				pdo_update('ewei_shop_member',array('agentid_str' => ''),array('id' => $memberInfo['id']));
			}
			$i = $this->memberRecursion($memberInfo['id']);
			if($i){
				$ii = $i;
			}
		}
		$count += $ii;
		var_dump($count);exit;
	}

	public function memberRecursion($id,$agentStr = ''){
		global $_W;
		global $_GPC;
		static $alreadyMemberList = array();
		static $i = 0;
		if($id > 0)
		{
			if(in_array($id,$alreadyMemberList)){
				echo '<hr />此id已存在<hr />';
				return false;
			}
			$alreadyMemberList[] = $id;
			$memberList = pdo_fetchall('SELECT * FROM '.tablename('ewei_shop_member').' WHERE agentid = :id AND uniacid = :uniacid',array(':uniacid' => $_W['uniacid'] ,':id' => $id));
			if(empty($memberList))
			{
				return false;
			}
			$agentStr = m('member')->getAgentidStr($id,$agentStr);
			foreach($memberList AS $key=>$memberInfo)
			{
				$i++;
				pdo_update('ewei_shop_member',array('agentid_str' => $agentStr), array('id' => $memberInfo['id']));
				$this->memberRecursion($memberInfo['id'], $agentStr);
			}
			return $i;
		}
		return true;
	}
}


?>