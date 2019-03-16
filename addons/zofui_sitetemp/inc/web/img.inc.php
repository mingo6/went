<?php 
	global $_W,$_GPC;

	load()->model('account');
	
	$uniacccount = WeAccount::create($_W['acid']);	

	if( $_GPC['op'] == 'admin' ) {
		$res = Util::wxappQrcode( $uniacccount,$_GPC['id'],'zofui_sitetemp/pages/page/page' );

	}elseif( $_GPC['op'] == 'formlist' ) {

		$res = Util::wxappQrcode( $uniacccount,TIMESTAMP,'zofui_sitetemp/pages/form/form' );
	}
	
	
	//var_dump( $res );
	header("content-type: image/jpeg"); 
	echo $res;
	
	
