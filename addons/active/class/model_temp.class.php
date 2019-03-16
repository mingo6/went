<?php 


class model_temp {


	static function getTemp(){
		global $_W;

		$cache = Util::getCache('temp','all');
		if( empty( $cache ) ){
			$where = array('uniacid'=>$_W['uniacid'],'isact'=>1);
			$cache = pdo_get('zofui_sitetemp_temp',$where,array('id','name'));
			
			if( !empty( $cache ) ){
				Util::setCache('temp','all',$cache);
			}
		}
		return $cache;
	}
	


	// 插入模板
	static function initTemp(){
		global $_W;

		// 电镀厂
		$isset = pdo_get('zofui_sitetemp_temp',array('name'=>'电镀厂系统模板','issystem'=>1,'uniacid'=>0));
		if( empty( $isset ) ) {

			$tdata = array(
				'uniacid' => 0,
				'name' => '电镀厂系统模板',
				'number' => 1,
				'img' => '/addons/zofui_sitetemp/public/images/dd_thumb.png',
				'issystem' => 1,
			);

			$res = pdo_insert('zofui_sitetemp_temp',$tdata);
			$tid = pdo_insertid();
			self::insertddPage( $tid );
		}

		// 互联网
		$isset = pdo_get('zofui_sitetemp_temp',array('name'=>'网络公司系统模板','issystem'=>1,'uniacid'=>0));
		if( empty( $isset ) ) {

			$tdata = array(
				'uniacid' => 0,
				'name' => '网络公司系统模板',
				'number' => 1,
				'img' => '/addons/zofui_sitetemp/public/images/wl_thumb.png',
				'issystem' => 1,
			);

			$res = pdo_insert('zofui_sitetemp_temp',$tdata);
			$tid = pdo_insertid();
			self::insertwlPage( $tid );
		}		

	}


	static function insertddPage( $tid ){
		global $_W;
		$tid = intval( $tid );

		if( $tid > 0 ){

			$dd1 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_1.jpg';
			$dd2 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_2.jpg';
			$dd3 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_3.jpg';
			$dd4 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_4.jpg';
			$dd5 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_5.jpg';
			$dd6 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_6.jpg';
			$dd7 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_7.jpg';

			$ddn1 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_n1.png';
			$ddn2 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_n2.png';
			$ddn3 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_n3.png';
			$ddn4 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/dd_n4.png';

			$foot1 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/home1.png';
			$foot2 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/home2.png';
			$foot3 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/tel1.png';
			$foot4 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/tel2.png';
			$foot5 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/location1.png';
			$foot6 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/location2.png';
			$foot7 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/share1.png';
			$foot8 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/share2.png';


			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '关于我们',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => 'a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:12:"关于我们";s:5:"title";s:12:"关于我们";s:10:"sharetitle";s:12:"关于我们";s:8:"shareimg";s:80:"'.$dd4.'";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:1:{i:0;a:3:{s:2:"id";s:14:"m1507454374359";s:4:"name";s:4:"text";s:6:"params";a:4:{s:7:"bgcolor";s:7:"#ffffff";s:6:"margin";i:0;s:7:"padding";i:5;s:7:"content";s:4692:"%3Cdiv%20style%3D%22font-size%3A14px%3Bline-height%3A26px%3B%22%3E%0A%09%E4%B8%9C%E8%8E%9E%E5%B8%82%E7%9B%88%E5%B3%B0%E6%96%B0%E6%9D%90%E6%96%99%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8%E4%BD%8D%E4%BA%8E%E4%B8%9C%E8%8E%9E%E5%B8%82%E8%99%8E%E9%97%A8%E9%95%87%E3%80%82%E4%B8%BB%E8%A6%81%E6%98%AF%E4%BB%A5ABS%E5%A1%91%E8%83%B6%E6%B0%B4%E7%94%B5%E9%95%80%E3%80%81%E7%9C%9F%E7%A9%BAUV%E7%94%B5%E9%95%80%EF%BC%8C%E6%A8%A1%E5%85%B7%E5%BC%80%E5%8F%91%EF%BC%8C%E6%B3%A8%E5%A1%91%E5%8A%A0%E5%B7%A5%E6%88%90%E5%9E%8B%E4%B8%BA%E4%B8%80%E4%BD%93%E7%9A%84%E6%9C%8D%E5%8A%A1%E5%85%AC%E5%8F%B8%EF%BC%8C%E7%8E%B0%E6%8B%A5%E6%9C%89%E5%9B%BD%E5%86%85%E5%A4%96%E5%85%88%E8%BF%9B%E7%9A%84%E8%87%AA%E5%8A%A8%E7%94%B5%E9%95%80%E7%94%9F%E4%BA%A7%E7%BA%BF%EF%BC%8C%E7%94%9F%E4%BA%A7%E8%BD%A6%E9%97%B4%E5%8D%A0%E5%9C%B0%E9%9D%A2%E7%A7%AF%E4%B8%80%E5%8D%83%E5%A4%9A%E5%B9%B3%E7%B1%B3%EF%BC%8C%E6%8A%80%E6%9C%AF%E4%BA%BA%E5%91%98%E4%BA%8C%E5%8D%81%E5%A4%9A%E4%BA%BA%EF%BC%8C%E5%B9%B6%E9%80%9A%E8%BF%87ISO%3A14000%E8%AE%A4%E8%AF%81%E4%BC%81%E4%B8%9A%EF%BC%8C%20%E4%BB%A5%E5%8F%8ATS6949%E8%B4%A8%E9%87%8F%E7%AE%A1%E7%90%86%E4%BD%93%E7%B3%BB%E7%9A%84%E8%AE%A4%E8%AF%81%EF%BC%8C%E6%9C%89%E5%85%A8%E8%87%AA%E5%8A%A8%E5%92%8C%E5%A1%91%E8%83%B6%E6%B0%B4%E7%94%B5%E9%95%80%E7%94%9F%E4%BA%A7%E7%BA%BF%E5%90%84%E4%B8%80%E6%9D%A1%EF%BC%8C%E5%85%A8%E8%87%AA%E5%8A%A8%E5%92%8C%E9%95%AD%E9%9B%95%E6%9C%BA%E3%80%82%E5%8F%AF%E4%B8%BA%E5%AE%A2%E6%88%B7%E6%8F%90%E4%BE%9B%EF%BC%9A%E6%A8%A1%E5%85%B7%E5%BC%80%E5%8F%91%E3%80%81%E6%B3%A8%E5%A1%91%E3%80%81%E7%94%B5%E9%95%80%EF%BC%8C%E9%95%AD%E9%9B%95%E7%AD%89%E4%BA%A7%E5%93%81%E7%9A%84%E6%9C%8D%E5%8A%A1%E3%80%82%3Cbr%2F%3E%E5%85%AC%E5%8F%B8%E6%9C%AC%E7%9D%80%E9%AB%98%E6%95%88%EF%BC%8C%E8%8A%82%E8%83%BD%EF%BC%8C%E7%8E%AF%E4%BF%9D%EF%BC%8C%E5%85%B1%E8%B5%A2%E7%9A%84%E5%8F%91%E5%B1%95%E6%96%B9%E9%92%88%EF%BC%8C%E6%8B%A5%E6%9C%89%E8%AF%B8%E5%A4%9A%E7%9A%84%E5%A1%91%E8%83%B6%E7%94%B5%E9%95%80%E4%B8%93%E4%B8%9A%E4%BA%BA%E6%89%8D%E3%80%82%E4%BA%A7%E5%93%81%E5%AE%8C%E5%85%A8%E6%BB%A1%E8%B6%B3%E5%AE%A2%E6%88%B7%E7%9A%84%E5%93%81%E8%B4%A8%E5%8F%8A%E7%8E%AF%E4%BF%9D%E8%A6%81%E6%B1%82%E3%80%82%3Cbr%2F%3E%3Ccenter%3E%3Cimg%20src%3D%22http%3A%2F%2Flogin.114my.cn%2Fmemberpic%2Fyingfengdg10060wap%2Fuploadfile%2Fimage%2F20170904%2F20170904104606_20202.jpg%22%20alt%3D%22%22%2F%3E%3C%2Fcenter%3E%3Cbr%2F%3E%E7%9B%88%E5%B3%B0%E5%8A%A0%E5%B7%A5%E9%95%80%E7%A7%8D%E4%BB%A5%EF%BC%9A%E5%85%89%E9%93%AC%E3%80%81%E9%93%B6%E8%89%B2%E3%80%8124K%E9%87%91%E8%89%B2%E3%80%81%E9%98%B2%E9%87%91%E3%80%81%E4%B8%89%E4%BB%B7%E7%8E%AF%E4%BF%9D%E9%93%AC%E3%80%81%E4%B8%89%E4%BB%B7%E9%BB%91%E9%93%AC%E3%80%81%E6%9E%AA%E8%89%B2%E3%80%81%E7%8F%8D%E7%8F%A0%E9%93%AC%E3%80%81%E4%BB%A3%E9%93%AC%E3%80%81%E5%8D%8A%E5%85%89%E9%93%AC%E3%80%81%E7%BA%A2%E5%8F%A4%E9%93%9C%E3%80%81%E9%9D%92%E5%8F%A4%E9%93%9C%E3%80%81%E6%8B%89%E4%B8%9D%E5%96%B7%E6%B2%B9%E3%80%81%E7%AD%89%E3%80%82%3Cbr%2F%3E%E4%B8%BB%E8%A6%81%E7%94%B5%E9%95%80%E5%8A%A0%E5%B7%A5%E4%BA%A7%E5%93%81%E5%8C%85%E6%8B%AC%E6%B1%BD%E8%BD%A6%E5%86%85%E5%A4%96%E9%A5%B0%E4%BB%B6%E4%BA%A7%E5%93%81%E3%80%81%E7%94%B5%E5%AD%90%E4%BA%A7%E5%93%81%E3%80%81%E7%94%B5%E5%99%A8%E4%BA%A7%E5%93%81%E3%80%81%E6%95%B0%E7%A0%81%E4%BA%A7%E5%93%81%E9%85%8D%E4%BB%B6%E3%80%81%E6%B8%B8%E6%88%8F%E6%9C%BA%E5%A4%96%E5%A3%B3%E3%80%81%E5%8D%AB%E6%B5%B4%E4%BA%A7%E5%93%81%E3%80%81%E7%AE%B1%E5%8C%85%E9%A5%B0%E6%89%A3%E9%85%8D%E4%BB%B6%E3%80%81LED%E7%81%AF%E9%A5%B0%E9%85%8D%E4%BB%B6%E3%80%81%E5%B7%A5%E8%89%BA%E9%A5%B0%E5%93%81%E7%B1%BB%E3%80%81%E5%A4%A7%E5%9E%8B%E5%B9%BF%E5%91%8A%E6%A0%87%E7%89%8C(2.0%E7%B1%B3%E4%BB%A5%E5%86%85%E4%BA%A7%E5%93%81)%E7%AD%89%E7%AD%89%E3%80%82%3Cbr%2F%3E%E7%9B%88%E5%B3%B0%E6%8B%A5%E6%9C%89%E5%AE%8C%E6%95%B4%E3%80%81%E7%A7%91%E5%AD%A6%E7%9A%84%E8%B4%A8%E9%87%8F%E7%AE%A1%E7%90%86%E4%BD%93%E7%B3%BB%E3%80%82%E5%85%AC%E5%8F%B8%E5%AF%B9%E6%B1%BD%E8%BD%A6%E5%86%85%E5%A4%96%E9%A5%B0%E4%BA%A7%E5%93%81%E6%9C%89%E5%BE%88%E5%BC%BA%E7%9A%84%E6%B3%A8%E5%A1%91%E5%92%8C%E7%94%B5%E9%95%80%E5%88%B6%E9%80%A0%E8%83%BD%E5%8A%9B%E3%80%82%E8%AF%9A%E4%BF%A1%E3%80%81%E5%AE%9E%E5%8A%9B%E5%92%8C%E4%BA%A7%E5%93%81%E8%B4%A8%E9%87%8F%E8%8E%B7%E5%BE%97%E4%B8%9A%E7%95%8C%E7%9A%84%E8%AE%A4%E5%8F%AF%E3%80%82%E5%9D%9A%E6%8C%81%E2%80%9C%E5%AE%A2%E6%88%B7%E7%AC%AC%E4%B8%80%E2%80%9D%E7%9A%84%E5%8E%9F%E5%88%99%E4%B8%BA%E5%B9%BF%E5%A4%A7%E5%AE%A2%E6%88%B7%E6%8F%90%E4%BE%9B%E4%BC%98%E8%B4%A8%E7%9A%84%E6%9C%8D%E5%8A%A1%E3%80%82%E6%9C%AC%E5%8E%82%E8%B7%9D%E7%A6%BB%E5%B9%BF%E6%B7%B1%E9%AB%98%E9%80%9F%E7%BA%A6%E5%8D%81%E4%BA%94%E5%88%86%E9%92%9F%E8%B7%AF%E7%A8%8B%EF%BC%8C%E4%BA%A4%E9%80%9A%E4%BE%BF%E5%88%A9%EF%BC%8C%E6%AC%A2%E8%BF%8E%E4%BD%A0%E5%89%8D%E6%9D%A5%E5%85%89%E4%B8%B4%E6%8C%87%E5%AF%BC%E6%AC%A2%E8%BF%8E%E5%B9%BF%E5%A4%A7%E5%AE%A2%E6%88%B7%E6%83%A0%E9%A1%BE%EF%BC%81%3C%2Fdiv%3E";}}}}'
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$aboutid = pdo_insertid();

			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '产品中心',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => 'a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:12:"产品中心";s:5:"title";s:12:"产品中心";s:10:"sharetitle";s:12:"产品中心";s:8:"shareimg";s:80:"'.$dd4.'";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:3:{i:0;a:3:{s:2:"id";s:14:"m1507454443511";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:5;s:4:"type";i:2;s:6:"istext";i:1;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:7:"#ffffff";s:4:"data";a:2:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"'.$dd4.'";s:3:"url";s:0:"";s:5:"title";s:12:"五金电镀";}i:1;a:4:{s:2:"id";s:15:"m01507454445150";s:3:"img";s:80:"'.$dd5.'";s:3:"url";s:0:"";s:5:"title";s:12:"五金电镀";}}}}i:1;a:3:{s:2:"id";s:14:"m1507454544375";s:4:"name";s:5:"space";s:6:"params";a:2:{s:6:"height";s:2:"10";s:7:"bgcolor";s:7:"#ffffff";}}i:2;a:3:{s:2:"id";s:14:"m1507454534446";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:5;s:4:"type";i:2;s:6:"istext";i:1;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:2:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"'.$dd6.'";s:3:"url";s:0:"";s:5:"title";s:15:"塑胶水电镀";}i:1;a:4:{s:2:"id";s:15:"m01507454535871";s:3:"img";s:80:"'.$dd7.'";s:3:"url";s:0:"";s:5:"title";s:15:"塑胶水电镀";}}}}}}'
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$productid = pdo_insertid();

			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '联系我们',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => 'a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:12:"联系我们";s:5:"title";s:12:"联系我们";s:10:"sharetitle";s:12:"联系我们";s:8:"shareimg";s:0:"";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:1:{i:0;a:3:{s:2:"id";s:14:"m1507454630359";s:4:"name";s:4:"text";s:6:"params";a:4:{s:7:"bgcolor";s:7:"#ffffff";s:6:"margin";i:0;s:7:"padding";i:5;s:7:"content";s:543:"%3Cdiv%20style%3D%22font-size%3A14px%3Bline-height%3A28px%3B%22%3E%0A%09%E4%B8%9C%E8%8E%9E%E5%B8%82%E7%9B%88%E5%B3%B0%E6%96%B0%E6%9D%90%E6%96%99%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8%3Cbr%2F%3E%E5%9C%B0%E5%9D%80%EF%BC%9A%E5%B9%BF%E4%B8%9C%E7%9C%81%E4%B8%9C%E8%8E%9E%E5%B8%82%E8%99%8E%E9%97%A8%E9%95%87%E5%8D%97%E6%A0%85%E7%AC%AC%E5%9B%9B%E5%B7%A5%E4%B8%9A%E5%8C%BA%E5%86%9C%E6%9E%97%E8%B7%AF1-3%E5%8F%B7%3Cbr%2F%3E%E7%94%B5%E8%AF%9D%EF%BC%9A0769-85164020%3Cbr%2F%3E%E6%89%8B%E6%9C%BA%EF%BC%9A%E5%90%B4%E5%85%88%E7%94%9F%2013798706262%3C%2Fdiv%3E";}}}}'
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$contactid = pdo_insertid();

			$next = $contactid + 1;
			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '首页',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => 'a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:6:"首页";s:5:"title";s:36:"东莞市盈峰新材料有限公司";s:10:"sharetitle";s:36:"东莞市盈峰新材料有限公司";s:8:"shareimg";s:80:"'.$dd4.'";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:6:{i:0;a:3:{s:2:"id";s:14:"m1507450675290";s:4:"name";s:5:"slide";s:6:"params";a:7:{s:8:"ischange";i:0;s:10:"changetime";i:3;s:10:"changelast";i:500;s:10:"pointcolor";s:7:"#ffffff";s:8:"actcolor";s:7:"#008040";s:9:"showpoint";i:0;s:4:"data";a:3:{i:0;a:2:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"'.$dd1.'";}i:1;a:2:{s:2:"id";s:14:"g1507450677803";s:3:"img";s:80:"'.$dd2.'";}i:2;a:2:{s:2:"id";s:14:"g1507450678658";s:3:"img";s:80:"'.$dd3.'";}}}}i:1;a:3:{s:2:"id";s:14:"m1507450938368";s:4:"name";s:3:"nav";s:6:"params";a:6:{s:3:"num";i:4;s:6:"radius";i:100;s:7:"padding";i:10;s:7:"bgcolor";s:7:"#ffffff";s:9:"fontcolor";s:4:"#000";s:4:"data";a:5:{i:0;a:5:{s:2:"id";s:8:"00000001";s:5:"title";s:12:"关于我们";s:3:"img";s:80:"'.$ddn1.'";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid='.$aboutid.'";s:7:"urlname";s:12:"关于我们";}i:1;a:5:{s:2:"id";s:8:"00000002";s:5:"title";s:12:"产品中心";s:3:"img";s:80:"'.$ddn2.'";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid='.$productid.'";s:7:"urlname";s:12:"产品中心";}i:2;a:5:{s:2:"id";s:8:"00000003";s:5:"title";s:12:"新闻资讯";s:3:"img";s:80:"'.$ddn3.'";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid='.$next.'";s:7:"urlname";s:6:"首页";}i:3;a:5:{s:2:"id";s:8:"00000004";s:5:"title";s:12:"联系我们";s:3:"img";s:80:"'.$ddn4.'";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid='.$contactid.'";s:7:"urlname";s:12:"联系我们";}i:4;a:4:{s:2:"id";s:8:"00000005";s:5:"title";s:12:"导航名称";s:3:"img";s:63:"http://127.0.0.5//addons/zofui_sitetemp/public/images/thank.png";s:3:"url";s:0:"";}}}}i:2;a:3:{s:2:"id";s:14:"m1507450943768";s:4:"name";s:5:"space";s:6:"params";a:2:{s:6:"height";i:8;s:7:"bgcolor";s:7:"#f3f4f5";}}i:3;a:3:{s:2:"id";s:14:"m1507450724594";s:4:"name";s:5:"title";s:6:"params";a:14:{s:7:"content";s:12:"产品列表";s:8:"paddingv";i:5;s:8:"paddingh";s:2:"10";s:7:"bgcolor";s:7:"#ffffff";s:5:"color";s:7:"#000000";s:4:"size";i:18;s:3:"pos";s:4:"left";s:8:"lefticon";i:0;s:7:"leftimg";s:0:"";s:6:"lwidth";i:20;s:9:"righticon";i:0;s:8:"rightimg";s:0:"";s:6:"rwidth";i:20;s:3:"url";s:0:"";}}i:4;a:3:{s:2:"id";s:14:"m1507450790602";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:8;s:4:"type";i:2;s:6:"istext";i:1;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:2:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"'.$dd4.'";s:3:"url";s:0:"";s:5:"title";s:18:"五金电镀加工";}i:1;a:4:{s:2:"id";s:15:"m01507450791867";s:3:"img";s:80:"'.$dd5.'";s:3:"url";s:0:"";s:5:"title";s:18:"东莞五金电镀";}}}}i:5;a:3:{s:2:"id";s:14:"m1507450863369";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:8;s:4:"type";i:2;s:6:"istext";i:1;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:2:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"'.$dd6.'";s:3:"url";s:0:"";s:5:"title";s:18:"加工五金电镀";}i:1;a:4:{s:2:"id";s:15:"m01507450865137";s:3:"img";s:80:"'.$dd7.'";s:3:"url";s:0:"";s:5:"title";s:18:"五金电镀加工";}}}}}}'
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$indexid = pdo_insertid();

			$bdata = array(
				'uniacid' => $_W['uniacid'],
				'tempid' => $tid,
				'createtime' => TIMESTAMP,
				'data' => 'a:6:{s:3:"num";s:1:"4";s:7:"padding";s:1:"5";s:7:"bgcolor";s:7:"#ffffff";s:5:"color";s:4:"#999";s:8:"actcolor";s:7:"#ed414a";s:4:"data";a:4:{i:0;a:9:{s:2:"id";s:8:"00000001";s:4:"name";s:6:"首页";s:3:"img";s:80:"'.$foot1.'";s:6:"actimg";s:80:"'.$foot2.'";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid='.$indexid.'";s:4:"type";s:3:"url";s:9:"$$hashKey";s:9:"object:20";s:6:"pageid";s:2:"'.$indexid.'";s:7:"urlname";s:6:"首页";}i:1;a:8:{s:2:"id";s:8:"00000002";s:4:"name";s:6:"电话";s:3:"img";s:80:"'.$foot3.'";s:6:"actimg";s:80:"'.$foot4.'";s:3:"url";s:0:"";s:4:"type";s:3:"tel";s:9:"$$hashKey";s:9:"object:21";s:3:"tel";s:11:"13112345678";}i:2;a:9:{s:2:"id";s:15:"m01507451962587";s:3:"img";s:80:"'.$foot5.'";s:6:"actimg";s:80:"'.$foot6.'";s:3:"url";s:0:"";s:4:"name";s:6:"地图";s:4:"type";s:3:"map";s:9:"$$hashKey";s:9:"object:51";s:3:"lng";s:18:"114.05121803283691";s:3:"lat";s:18:"22.561628756102063";}i:3;a:7:{s:2:"id";s:15:"m11507451962587";s:3:"img";s:80:"'.$foot7.'";s:6:"actimg";s:80:"'.$foot8.'";s:3:"url";s:0:"";s:4:"name";s:6:"分享";s:4:"type";s:5:"share";s:9:"$$hashKey";s:9:"object:52";}}}'
			);
			pdo_insert('zofui_sitetemp_bar',$bdata);


		}

	}

	
	static function insertwlPage( $tid ){
		global $_W;
		$tid = intval( $tid );

		if( $tid > 0 ){

			$dd1 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_as1.jpg';
			$dd2 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_s4.jpg';
			$dd3 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_as3.jpg';

			$fx1 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_f1.jpg';
			$fx2 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_f2.jpg';
			$fx3 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_f3.jpg';
			$fx4 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_f4.jpg';

			$m1 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_m1.jpg';
			$m2 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_m2.jpg';
			$m3 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_m3.jpg';
			$m4 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_m4.jpg';
			$m5 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_m5.jpg';

			$xcx1 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_x1.jpg';
			$xcx2 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_d2.jpg';
			$xcx3 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_d3.jpg';
			$xcx4 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_d4.jpg';
			$xcx5 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_d5.jpg';
			$xcx6 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_d6.jpg';

			$index1 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_s1.jpg';
			$index2 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_s2.jpg';
			$index3 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_s3.png';
			$index4 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_s4.png';

			$index5 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_n1.png';
			$index6 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_n2.png';
			$index7 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_n3.png';
			$index8 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_n4.png';

			$index9 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_p1.png';
			$index10 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_p2.png';
			$index11 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_p3.png';
			$index12 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_p4.png';
			$index13 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_p5.png';
			$index14 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_p6.png';			

			$index15 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_ma1.jpg';
			$index16 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/wl_ma2.jpg';			

			$foot1 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/home1.png';
			$foot2 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/home2.png';
			$foot3 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/contact1.png';
			$foot4 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/contact2.png';
			$foot5 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/tel1.png';
			$foot6 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/tel2.png';
			$foot7 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/about1.png';
			$foot8 = $_W['siteroot'].'/addons/zofui_sitetemp/public/images/about2.png';

			$params = <<<div
a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:12:"关于我们";s:5:"title";s:12:"关于我们";s:10:"sharetitle";s:12:"关于我们";s:8:"shareimg";s:80:"{$dd1}";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:2:{i:0;a:3:{s:2:"id";s:14:"m1507475611097";s:4:"name";s:5:"slide";s:6:"params";a:7:{s:8:"ischange";i:0;s:10:"changetime";i:3;s:10:"changelast";i:500;s:10:"pointcolor";s:7:"#dddddd";s:8:"actcolor";s:7:"#585656";s:9:"showpoint";i:0;s:4:"data";a:3:{i:0;a:2:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$dd1}";}i:1;a:2:{s:2:"id";s:14:"g1507475612985";s:3:"img";s:80:"{$dd2}";}i:2;a:2:{s:2:"id";s:14:"g1507475613569";s:3:"img";s:80:"{$dd3}";}}}}i:1;a:3:{s:2:"id";s:14:"m1507475647563";s:4:"name";s:4:"text";s:6:"params";a:4:{s:7:"bgcolor";s:7:"#ffffff";s:6:"margin";i:0;s:7:"padding";i:5;s:7:"content";s:8716:"%3Cdiv%20class%3D%22wpb_text_column%20wpb_content_element%20zoomIn%20animate-element%22%3E%3Cdiv%20class%3D%22wpb_wrapper%22%3E%3Cp%3E%3Cspan%20style%3D%22font-size%3A%2016px%3B%20color%3A%20%23666666%3B%20line-height%3A%2035px%3B%22%3E%26nbsp%3B%26nbsp%3B%26nbsp%3B%26nbsp%3B%E6%B7%B1%E5%9C%B3%E5%B8%82%E4%BC%97%E6%83%A0%E4%BA%92%E8%81%94%E7%A7%91%E6%8A%80%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8(%E4%BB%A5%E4%B8%8B%E7%AE%80%E7%A7%B0%3Cspan%20style%3D%22color%3A%20rgb(102%2C%20102%2C%20102)%3B%20line-height%3A%2035px%3B%22%3E%E4%BC%97%E6%83%A0%E4%BA%92%E8%81%94%3C%2Fspan%3E)%20%E4%B8%93%E6%B3%A8%E4%BA%8E%E7%A7%BB%E5%8A%A8%E4%BA%92%E8%81%94%E7%BD%91%2C%E6%8F%90%E4%BE%9B%E5%9F%BA%E4%BA%8E%E7%A7%BB%E5%8A%A8%E4%BA%92%E8%81%94%E7%BD%91%E4%BA%A7%E5%93%81%E7%AD%96%E5%88%92%E3%80%81%E6%96%B9%E6%A1%88%E3%80%81%E8%AE%BE%E8%AE%A1%E3%80%81%E5%BC%80%E5%8F%91%E3%80%81%E6%8E%A8%E5%B9%BF%E4%B8%80%E7%AB%99%E5%BC%8F%E5%BC%80%E5%8F%91%E6%9C%8D%E5%8A%A1%E5%95%86%EF%BC%8C%E4%B8%BB%E8%A6%81%E4%B8%9A%E5%8A%A1%E8%8C%83%E7%95%B4%E5%8C%85%E6%8B%AC%EF%BC%9AAPP%E5%BC%80%E5%8F%91%E3%80%81%E5%BE%AE%E4%BF%A1%E5%BC%80%E5%8F%91%E3%80%81%E5%A4%96%E8%B4%B8%E7%BD%91%E7%AB%99%E8%A7%A3%E5%86%B3%E6%96%B9%E6%A1%88%E3%80%81%E7%A7%BB%E5%8A%A8%E6%94%AF%E4%BB%98%E3%80%81%E8%BD%AF%E4%BB%B6%E5%AE%9A%E5%88%B6%E3%80%81%E6%99%BA%E6%85%A7%E7%A4%BE%E5%8C%BA%E3%80%81%E6%99%BA%E8%83%BD%E5%8C%96%E5%AE%B6%E5%B1%85%E7%AD%89%E3%80%82%3C%2Fspan%3E%3Cbr%2F%3E%20%3Cspan%20style%3D%22font-size%3A%2016px%3B%20color%3A%20%23666666%3B%20line-height%3A%2035px%3B%22%3E%26nbsp%3B%26nbsp%3B%26nbsp%3B%26nbsp%3B%E5%9C%A8%E2%80%9D%E4%BA%92%E8%81%94%E7%BD%91%2B%20%E2%80%9C%E7%9A%84%E5%85%A8%E6%96%B0%E6%97%B6%E4%BB%A3%EF%BC%8C%3Cspan%20style%3D%22color%3A%20rgb(102%2C%20102%2C%20102)%3B%20line-height%3A%2035px%3B%22%3E%E4%BC%97%E6%83%A0%E4%BA%92%E8%81%94%3C%2Fspan%3E%E8%AF%BA%E5%87%AD%E5%80%9F%E4%B8%93%E4%B8%9A%E3%80%81%E6%8A%80%E6%9C%AF%E3%80%81%E5%BE%AE%E5%88%9B%E6%96%B0%E7%9A%84%E7%90%86%E5%BF%B5%EF%BC%8C%E4%B8%BA%E4%BC%81%E4%B8%9A%E6%8F%90%E4%BE%9B%E4%B8%93%E4%B8%9A%E7%9A%84%E5%AE%9A%E5%88%B6%E5%BC%80%E5%8F%91%E6%9C%8D%E5%8A%A1%E5%8F%8A%E4%BC%81%E4%B8%9A%E7%A7%BB%E5%8A%A8%E5%8C%96%E8%A7%A3%E5%86%B3%E6%96%B9%E6%A1%88%E3%80%82%E4%BD%9C%E4%B8%BA%E7%A7%BB%E5%8A%A8%E4%BA%92%E8%81%94%E7%BD%91%E9%A2%86%E5%9F%9F%E6%8F%90%E4%BE%9B%E4%B8%80%E7%AB%99%E5%BC%8F%E7%9A%84%E5%A4%9A%E5%B9%B3%E5%8F%B0%E8%A7%A3%E5%86%B3%E6%96%B9%E6%A1%88%E9%A2%86%E5%AF%BC%E8%80%85%EF%BC%8C%E6%9C%8D%E5%8A%A1%E8%B6%85%E8%BF%87200%E4%BD%8D%E6%B5%B7%E5%86%85%E5%A4%96%E5%AE%A2%E6%88%B7%EF%BC%8C%E5%BD%93%E4%B8%AD%E5%8C%85%E6%8B%AC%E4%BC%97%E5%A4%9A%E7%9F%A5%E5%90%8D%E5%93%81%E7%89%8C%E3%80%81%E5%9B%BD%E9%99%85%E5%93%81%E7%89%8C%E3%80%82%3C%2Fspan%3E%3Cspan%20style%3D%22font-size%3A%2016px%3B%20color%3A%20%23666666%3B%20line-height%3A%2035px%3B%22%3E%3Cbr%2F%3E%20%26nbsp%3B%26nbsp%3B%26nbsp%3B%26nbsp%3B%E5%85%AC%E5%8F%B8%E6%8B%A5%E6%9C%89%E4%B8%80%E6%89%B9%E5%85%85%E6%BB%A1%E6%A2%A6%E6%83%B3%E5%92%8C%E5%B9%B4%E8%BD%BB%E7%9A%84%E6%8A%80%E6%9C%AF%E5%BC%80%E5%8F%91%E5%9B%A2%E9%98%9F%EF%BC%8C%E6%A0%B8%E5%BF%83%E5%9B%A2%E9%98%9F%E6%9D%A5%E5%9D%87%E8%87%AA%E4%BA%8E%E5%9B%BD%E5%86%85%E7%9F%A5%E5%90%8D%E8%BD%AF%E4%BB%B6%E4%BC%81%E4%B8%9A%EF%BC%8C%E5%8A%9B%E4%BA%89%E6%89%93%E9%80%A0%E4%B8%AD%E5%9B%BD%E5%85%B7%E6%9C%89%E7%AB%9E%E4%BA%89%E5%8A%9B%E7%9A%84%E7%A7%BB%E5%8A%A8%E4%BA%92%E8%81%94%E7%BD%91%E7%A7%91%E6%8A%80%E4%BC%81%E4%B8%9A%E3%80%82%E6%88%91%E4%BB%AC%E4%B9%9F%E8%AE%B8%E6%98%AF%E6%82%A8%E6%9C%80%E5%80%BC%E5%BE%97%E4%BF%A1%E8%B5%96%E7%9A%84%E8%BD%AF%E4%BB%B6%E5%BC%80%E5%8F%91%E6%9C%8D%E5%8A%A1%E5%95%86%EF%BC%81%3C%2Fspan%3E%3C%2Fp%3E%3Cp%3E%3Cspan%20style%3D%22font-size%3A%2016px%3B%20color%3A%20%23666666%3B%20line-height%3A%2035px%3B%22%3E%3Cbr%2F%3E%3C%2Fspan%3E%3C%2Fp%3E%3C%2Fdiv%3E%3C%2Fdiv%3E%3Cdiv%20class%3D%22item-right%22%3E%3Cp%3E%3Cspan%20style%3D%22color%3A%20%233f3f3f%3B%22%3E%3Cstrong%3E%E4%B8%93%E4%B8%9A%E7%AD%96%E5%88%92%EF%BC%9A%3C%2Fstrong%3E%3C%2Fspan%3E%E4%BC%97%E6%83%A0%E4%BA%92%E8%81%94%E8%AE%BE%E6%9C%89%E4%B8%93%E4%B8%9A%E7%9A%84%E7%BD%91%E7%AB%99%E7%AD%96%E5%88%92%E9%83%A8%EF%BC%8C%E9%80%9A%E8%BF%87PM%EF%BC%88%E9%A1%B9%E7%9B%AE%E7%BB%8F%E7%90%86%EF%BC%89%E7%90%86%E8%A7%A3%E5%AE%A2%E6%88%B7%E7%9A%84%E5%95%86%E4%B8%9A%E9%9C%80%E6%B1%82%E5%90%8E%EF%BC%8C%E4%B8%8E%E7%BD%91%E7%AB%99%E7%AD%96%E5%88%92%E4%BA%BA%E5%91%98%E5%85%B1%E5%90%8C%E7%AD%96%E5%88%92%E6%96%B9%E6%A1%88%EF%BC%8C%E7%A1%AE%E4%BF%9D%E4%B8%BA%E5%AE%A2%E6%88%B7%E6%8F%90%E4%BE%9B%E6%9C%80%E4%BC%98%E7%A7%80%E3%80%81%E7%8B%AC%E7%89%B9%E3%80%81%E5%85%85%E5%88%86%E4%B8%94%E7%BB%8F%E6%B5%8E%E7%9A%84%E7%BD%91%E7%AB%99%E5%BB%BA%E8%AE%BE%E6%96%B9%E6%A1%88%E3%80%82%3C%2Fp%3E%3Cp%3E%3Cspan%20style%3D%22color%3A%20%23888888%3B%22%3E%3Cbr%2F%3E%3C%2Fspan%3E%3C%2Fp%3E%3Cp%3E%3Cstrong%3E%3Cspan%20style%3D%22color%3A%20%233f3f3f%3B%22%3E%E8%A7%86%E8%A7%89%E8%AE%BE%E8%AE%A1%EF%BC%9A%3C%2Fspan%3E%20%3C%2Fstrong%3E%E4%BC%97%E6%83%A0%E4%BA%92%E8%81%94%E6%8B%A5%E6%9C%89%E5%A4%9A%E5%90%8D%E4%BC%98%E7%A7%80%E7%9A%84%E7%BE%8E%E5%B7%A5%E8%AE%BE%E8%AE%A1%E5%B8%88%EF%BC%8C%E5%9C%A8%E8%A7%86%E8%A7%89%E8%AE%BE%E8%AE%A1%E6%96%B9%E9%9D%A2%EF%BC%8C%E6%88%91%E4%BB%AC%E4%B9%9F%E8%AE%B8%E6%98%AF%E6%9C%80%E8%82%AF%E4%B8%8B%E5%B7%A5%E5%A4%AB%E7%9A%84%E5%9B%A2%E9%98%9F%EF%BC%8C%E5%9C%A8%E7%AD%96%E5%88%92%E9%98%B6%E6%AE%B5%EF%BC%8C%E8%AE%BE%E8%AE%A1%E4%BA%BA%E5%91%98%E5%8D%B3%E5%8F%82%E4%B8%8E%E8%A7%84%E5%88%92%EF%BC%8C%E7%94%84%E9%80%89%E5%9B%BD%E5%A4%96%E4%BC%98%E7%A7%80%E7%B2%BE%E5%93%81%E7%BD%91%E7%AB%99%E4%BD%9C%E4%B8%BA%E5%8F%82%E8%80%83%E5%AF%B9%E8%B1%A1%EF%BC%8C%E8%AE%BE%E8%AE%A1%E9%98%B6%E6%AE%B5%EF%BC%8C%E4%BA%A6%E8%83%BD%E5%AA%B2%E7%BE%8E%E5%B9%B6%E8%B6%85%E8%B6%8A%E5%9B%BD%E5%A4%96%E7%B2%BE%E5%93%81%E7%BD%91%E7%AB%99%E6%B0%B4%E5%B9%B3%E3%80%82%3C%2Fp%3E%3Cp%3E%3Cspan%20style%3D%22color%3A%20%23888888%3B%22%3E%3Cbr%2F%3E%3C%2Fspan%3E%3C%2Fp%3E%3Cp%3E%3Cspan%20style%3D%22color%3A%20%233f3f3f%3B%22%3E%3Cstrong%3E%E5%8A%9F%E8%83%BD%E5%BC%80%E5%8F%91%3A%20%3C%2Fstrong%3E%3C%2Fspan%3E%E4%BC%97%E6%83%A0%E4%BA%92%E8%81%94%E7%9B%B8%E4%BF%A1%EF%BC%8C%E4%B8%AA%E6%80%A7%E5%8C%96%E3%80%81%E5%A4%9A%E6%A0%B7%E5%8C%96%E7%9A%84%E7%BD%91%E7%AB%99%E5%8A%9F%E8%83%BD%E6%89%8D%E6%98%AF%E5%B8%AE%E5%8A%A9%E5%AE%A2%E6%88%B7%E5%AE%9E%E7%8E%B0%E5%95%86%E4%B8%9A%E7%9B%AE%E7%9A%84%E7%9A%84%E6%9C%89%E5%8A%9B%E6%B8%A0%E9%81%93%EF%BC%8C%E8%80%8C%E5%B9%BF%E4%B8%BA%E7%BD%91%E7%BB%9C%E5%85%B7%E6%9C%89%E4%B8%B0%E5%AF%8C%E7%BC%96%E7%A8%8B%E5%BC%80%E5%8F%91%E7%BB%8F%E9%AA%8C%E7%9A%84%E5%BC%80%E5%8F%91%E4%BA%BA%E5%91%98%EF%BC%8C%E4%BF%9D%E9%9A%9C%E4%BA%86%E6%82%A8%E7%8B%AC%E7%89%B9%E7%9A%84%E4%B8%9A%E5%8A%A1%E9%9C%80%E6%B1%82%E5%9D%87%E8%83%BD%E6%BB%A1%E8%B6%B3%E3%80%82%3C%2Fp%3E%3Cp%3E%3Cspan%20style%3D%22color%3A%20%23888888%3B%22%3E%3Cbr%2F%3E%3C%2Fspan%3E%3C%2Fp%3E%3Cp%3E%3Cspan%20style%3D%22color%3A%20%233f3f3f%3B%22%3E%3Cstrong%3E%E6%8E%A8%E5%B9%BF%E8%BF%90%E8%90%A5%3A%20%3C%2Fstrong%3E%3C%2Fspan%3E%E4%BC%97%E6%83%A0%E4%BA%92%E8%81%94%E5%B9%B6%E9%9D%9E%E5%8D%95%E7%BA%AF%E7%9A%84%E5%BB%BA%E7%AB%99%E5%85%AC%E5%8F%B8%EF%BC%8C%E6%88%91%E4%BB%AC%E7%9A%84%E5%8F%A3%E5%8F%B7%E6%98%AF%E2%80%9D%E6%82%A8%E7%9A%84%E7%94%B5%E5%95%86%E4%BC%B4%E4%BE%A3%E2%80%9D%EF%BC%8C%E5%9B%A0%E6%AD%A4%EF%BC%8C%E5%90%8E%E6%9C%9F%E6%9C%8D%E5%8A%A1%E4%B9%9F%E6%98%AF%E6%88%91%E4%BB%AC%E7%9A%84%E4%BC%98%E5%8A%BF%E4%B9%8B%E4%B8%80%E3%80%82%E6%88%91%E4%BB%AC%E4%B8%BA%E5%AE%A2%E6%88%B7%E6%8F%90%E4%BE%9B%E5%8C%85%E6%8B%AC%E7%BD%91%E7%AB%99%E5%9F%BA%E7%A1%80%E7%BB%B4%E6%8A%A4%E6%9C%8D%E5%8A%A1%E3%80%81SEO%E8%90%A5%E9%94%80%E6%8E%A8%E5%B9%BF%E6%9C%8D%E5%8A%A1%E4%BB%A5%E5%8F%8A%E6%95%B4%E7%AB%99%E7%BB%BC%E5%90%88%E8%BF%90%E8%90%A5%E6%9C%8D%E5%8A%A1%EF%BC%8C%E7%A1%AE%E4%BF%9D%E6%82%A8%E7%9A%84%E7%BD%91%E7%AB%99%E5%9C%A8%E5%BB%BA%E7%AB%99%E5%90%8E%E5%85%B7%E6%9C%89%E7%94%9F%E5%91%BD%E5%8A%9B%E4%B8%8E%E7%AB%9E%E4%BA%89%E5%8A%9B%E3%80%82%3C%2Fp%3E%3Cp%3E%3Cspan%20style%3D%22color%3A%20%23888888%3B%22%3E%3Cbr%2F%3E%3C%2Fspan%3E%3C%2Fp%3E%3Cp%3E%3Cstrong%3E%3Cspan%20style%3D%22color%3A%20%233f3f3f%3B%22%3E%E5%93%81%E8%B4%A8%E7%9B%91%E6%8E%A7%3A%3C%2Fspan%3E%20%3C%2Fstrong%3E%E4%BC%97%E6%83%A0%E4%BA%92%E8%81%94%E6%8B%A5%E6%9C%89%E5%8D%93%E8%B6%8A%E7%9A%84%E7%AE%A1%E7%90%86%E5%9B%A2%E9%98%9F%EF%BC%8C%E6%A0%B8%E5%BF%83%E7%AE%A1%E7%90%86%E4%BA%BA%E5%91%98%E5%9D%87%E5%87%BA%E8%87%AA%E5%8D%8E%E4%B8%BA%E3%80%81%E5%BE%AE%E8%BD%AF%E3%80%81%E5%AE%9D%E6%B4%81%E7%AD%89%E7%9F%A5%E5%90%8D%E4%BC%81%E4%B8%9A%E3%80%82%E5%90%8C%E6%97%B6%EF%BC%8C%E5%B9%BF%E4%B8%BA%E7%BD%91%E7%BB%9C%E5%BB%BA%E7%AB%8B%E4%BA%86%E5%AE%8C%E6%95%B4%E7%9A%84%E7%BD%91%E7%AB%99%E5%93%81%E8%B4%A8%E7%9B%91%E6%8E%A7%E6%B5%81%E7%A8%8B%EF%BC%8C%E5%9C%A8%E6%AF%8F%E4%B8%80%E4%B8%AA%E7%BB%86%E8%8A%82%E4%B8%8A%E4%B8%BA%E5%AE%A2%E6%88%B7%E4%BF%9D%E9%9A%9C%E4%BC%98%E7%A7%80%E7%9A%84%E7%BD%91%E7%AB%99%E5%93%81%E8%B4%A8%E3%80%82%3C%2Fp%3E%3C%2Fdiv%3E";}}}}
div;
			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '关于我们',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => $params
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$aboutid = pdo_insertid();


			$params = <<<div
a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:12:"联系我们";s:5:"title";s:12:"联系我们";s:10:"sharetitle";s:12:"联系我们";s:8:"shareimg";s:80:"{$dd1}";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:1:{i:0;a:3:{s:2:"id";s:14:"m1507476281518";s:4:"name";s:4:"text";s:6:"params";a:4:{s:7:"bgcolor";s:7:"#ffffff";s:6:"margin";i:0;s:7:"padding";i:5;s:7:"content";s:391:"%3Cp%3E%E8%81%94%E7%B3%BB%E5%9C%B0%E5%9D%80%EF%BC%9A%E6%B7%B1%E5%9C%B3%E5%B8%82%E9%BE%99%E5%8D%8E%E6%96%B0%E5%8C%BA%E8%A7%82%E6%BE%9C%E8%A1%97%E9%81%93%E7%99%BE%E4%B8%BD%E5%90%8D%E8%8B%9110%E6%A0%8B%3C%2Fp%3E%3Cp%3E%E8%81%94%E7%B3%BB%E7%94%B5%E8%AF%9D%EF%BC%9A0755-36341133%3C%2Fp%3E%3Cp%3E%E8%81%94%E7%B3%BB%E4%BA%BA%EF%BC%9A%E5%94%90%E5%85%88%E7%94%9F%3C%2Fp%3E%3Cp%3E%3Cbr%2F%3E%3C%2Fp%3E";}}}}
div;
			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '联系我们',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => $params,
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$contactid = pdo_insertid();


			$params = <<<div
a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:12:"分销商城";s:5:"title";s:12:"分销商城";s:10:"sharetitle";s:12:"分销商城";s:8:"shareimg";s:80:"{$fx1}";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:4:{i:0;a:3:{s:2:"id";s:14:"m1507474874120";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$fx1}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:1;a:3:{s:2:"id";s:14:"m1507474918278";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$fx2}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:2;a:3:{s:2:"id";s:14:"m1507475044822";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$fx3}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:3;a:3:{s:2:"id";s:14:"m1507474931990";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$fx4}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}}}
div;
			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '分销商城',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => $params,
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$fenxiaoid = pdo_insertid();


			$params = <<<div
a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:12:"码上点餐";s:5:"title";s:12:"码上点餐";s:10:"sharetitle";s:12:"码上点餐";s:8:"shareimg";s:80:"{$m1}";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:6:{i:0;a:3:{s:2:"id";s:14:"m1507475110157";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$m1}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:1;a:3:{s:2:"id";s:14:"m1507475115621";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$m2}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:2;a:3:{s:2:"id";s:14:"m1507475132981";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$m3}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:3;a:3:{s:2:"id";s:14:"m1507475143156";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$m4}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:4;a:3:{s:2:"id";s:14:"m1507475159772";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$m5}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:5;a:3:{s:2:"id";s:14:"m1507475232915";s:4:"name";s:5:"space";s:6:"params";a:2:{s:6:"height";i:62;s:7:"bgcolor";s:7:"#f3f4f5";}}}}
div;
			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '码上点餐',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => $params,
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$diancanid = pdo_insertid();


			$params = <<<div
a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:15:"小程序定制";s:5:"title";s:15:"小程序定制";s:10:"sharetitle";s:15:"小程序定制";s:8:"shareimg";s:80:"{$xcx1}";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:6:{i:0;a:3:{s:2:"id";s:14:"m1507475259956";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$xcx1}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:1;a:3:{s:2:"id";s:14:"m1507475265267";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$xcx2}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:2;a:3:{s:2:"id";s:14:"m1507475276612";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$xcx3}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:3;a:3:{s:2:"id";s:14:"m1507475285324";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$xcx4}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:4;a:3:{s:2:"id";s:14:"m1507475296238";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:1;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$xcx5}";s:3:"url";s:0:"";s:5:"title";s:0:"";}}}}i:5;a:3:{s:2:"id";s:14:"m1507475321132";s:4:"name";s:5:"space";s:6:"params";a:2:{s:6:"height";i:77;s:7:"bgcolor";s:7:"#f3f4f5";}}}}
div;
			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '小程序定制',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => $params,
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$xcxid = pdo_insertid();



			$params = <<<div
a:2:{s:5:"basic";a:8:{s:2:"id";s:7:"0000000";s:4:"name";s:6:"首页";s:5:"title";s:6:"首页";s:10:"sharetitle";s:6:"首页";s:8:"shareimg";s:80:"{$index1}";s:5:"isbar";i:0;s:5:"topbg";s:7:"#ffffff";s:8:"topcolor";s:7:"#000000";}s:4:"data";a:14:{i:0;a:3:{s:2:"id";s:14:"m1507473035317";s:4:"name";s:5:"slide";s:6:"params";a:7:{s:8:"ischange";i:0;s:10:"changetime";i:3;s:10:"changelast";i:500;s:10:"pointcolor";s:7:"#dddddd";s:8:"actcolor";s:7:"#585656";s:9:"showpoint";i:0;s:4:"data";a:4:{i:0;a:2:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$index1}";}i:1;a:2:{s:2:"id";s:14:"g1507473042061";s:3:"img";s:80:"{$index2}";}i:2;a:2:{s:2:"id";s:14:"g1507473042788";s:3:"img";s:80:"{$index3}";}i:3;a:2:{s:2:"id";s:14:"g1507473043501";s:3:"img";s:80:"{$index4}";}}}}i:1;a:3:{s:2:"id";s:14:"m1507473098267";s:4:"name";s:3:"nav";s:6:"params";a:6:{s:3:"num";i:4;s:6:"radius";i:0;s:7:"padding";i:5;s:7:"bgcolor";s:7:"#ffffff";s:9:"fontcolor";s:4:"#000";s:4:"data";a:5:{i:0;a:5:{s:2:"id";s:8:"00000001";s:5:"title";s:12:"分销商城";s:3:"img";s:80:"{$index5}";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid={$fenxiaoid}";s:7:"urlname";s:12:"分销商城";}i:1;a:5:{s:2:"id";s:8:"00000002";s:5:"title";s:12:"码上点餐";s:3:"img";s:80:"{$index6}";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid={$diancanid}";s:7:"urlname";s:12:"码上点餐";}i:2;a:5:{s:2:"id";s:8:"00000003";s:5:"title";s:15:"小程序定制";s:3:"img";s:80:"{$index7}";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid={$xcxid}";s:7:"urlname";s:15:"小程序定制";}i:3;a:4:{s:2:"id";s:8:"00000004";s:5:"title";s:15:"公众号开发";s:3:"img";s:80:"{$index8}";s:3:"url";s:0:"";}i:4;a:4:{s:2:"id";s:8:"00000005";s:5:"title";s:12:"导航名称";s:3:"img";s:63:"http://127.0.0.5//addons/zofui_sitetemp/public/images/thank.png";s:3:"url";s:0:"";}}}}i:2;a:3:{s:2:"id";s:14:"m1507474824943";s:4:"name";s:5:"space";s:6:"params";a:2:{s:6:"height";s:2:"10";s:7:"bgcolor";s:7:"#f3f4f5";}}i:3;a:3:{s:2:"id";s:14:"m1507473185626";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:5;s:4:"type";i:3;s:6:"istext";i:1;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:3:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$index9}";s:3:"url";s:0:"";s:5:"title";s:12:"微信商城";}i:1;a:4:{s:2:"id";s:15:"m01507473187506";s:3:"img";s:80:"{$index10}";s:3:"url";s:0:"";s:5:"title";s:15:"微酒店餐饮";}i:2;a:4:{s:2:"id";s:15:"m11507473187506";s:3:"img";s:80:"{$index11}";s:3:"url";s:0:"";s:5:"title";s:15:"微服务预约";}}}}i:4;a:3:{s:2:"id";s:14:"m1507473228883";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:5;s:4:"type";i:3;s:6:"istext";i:1;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:3:{i:0;a:4:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$index12}";s:3:"url";s:0:"";s:5:"title";s:15:"小程序官网";}i:1;a:4:{s:2:"id";s:15:"m01507473230763";s:3:"img";s:80:"{$index13}";s:3:"url";s:0:"";s:5:"title";s:15:"小程序分销";}i:2;a:4:{s:2:"id";s:15:"m11507473230763";s:3:"img";s:80:"{$index14}";s:3:"url";s:0:"";s:5:"title";s:15:"小程序点餐";}}}}i:5;a:3:{s:2:"id";s:14:"m1507473271841";s:4:"name";s:5:"space";s:6:"params";a:2:{s:6:"height";s:2:"10";s:7:"bgcolor";s:7:"#f3f4f5";}}i:6;a:3:{s:2:"id";s:14:"m1507473295922";s:4:"name";s:5:"title";s:6:"params";a:14:{s:7:"content";s:12:"旗舰产品";s:8:"paddingv";i:10;s:8:"paddingh";i:5;s:7:"bgcolor";s:7:"#ffffff";s:5:"color";s:4:"#333";s:4:"size";i:18;s:3:"pos";s:4:"left";s:8:"lefticon";i:0;s:7:"leftimg";s:0:"";s:6:"lwidth";i:20;s:9:"righticon";i:0;s:8:"rightimg";s:0:"";s:6:"rwidth";i:20;s:3:"url";s:0:"";}}i:7;a:3:{s:2:"id";s:14:"m1507473341738";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:5;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:5:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$index15}";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid={$contactid}";s:5:"title";s:0:"";s:7:"urlname";s:12:"联系我们";}}}}i:8;a:3:{s:2:"id";s:14:"m1507473354434";s:4:"name";s:5:"title";s:6:"params";a:14:{s:7:"content";s:63:"小程序分销商城功能上线（秒杀、拼团、分销）";s:8:"paddingv";i:1;s:8:"paddingh";i:5;s:7:"bgcolor";s:7:"#ffffff";s:5:"color";s:7:"#999999";s:4:"size";i:13;s:3:"pos";s:4:"left";s:8:"lefticon";i:0;s:7:"leftimg";s:0:"";s:6:"lwidth";i:20;s:9:"righticon";i:0;s:8:"rightimg";s:0:"";s:6:"rwidth";i:20;s:3:"url";s:0:"";}}i:9;a:3:{s:2:"id";s:14:"m1507473437585";s:4:"name";s:5:"space";s:6:"params";a:2:{s:6:"height";s:2:"10";s:7:"bgcolor";s:7:"#f3f4f5";}}i:10;a:3:{s:2:"id";s:14:"m1507473445768";s:4:"name";s:5:"title";s:6:"params";a:14:{s:7:"content";s:12:"代理加盟";s:8:"paddingv";s:2:"10";s:8:"paddingh";i:5;s:7:"bgcolor";s:7:"#ffffff";s:5:"color";s:4:"#333";s:4:"size";i:18;s:3:"pos";s:4:"left";s:8:"lefticon";i:0;s:7:"leftimg";s:0:"";s:6:"lwidth";i:20;s:9:"righticon";i:0;s:8:"rightimg";s:0:"";s:6:"rwidth";i:20;s:3:"url";s:0:"";}}i:11;a:3:{s:2:"id";s:14:"m1507473479505";s:4:"name";s:5:"image";s:6:"params";a:7:{s:7:"padding";i:5;s:4:"type";i:1;s:6:"istext";i:0;s:8:"fontsize";i:14;s:9:"fontcolor";s:4:"#333";s:7:"bgcolor";s:4:"#fff";s:4:"data";a:1:{i:0;a:5:{s:2:"id";s:8:"00000001";s:3:"img";s:80:"{$index16}";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid={$contactid}";s:5:"title";s:0:"";s:7:"urlname";s:12:"联系我们";}}}}i:12;a:3:{s:2:"id";s:14:"m1507473486481";s:4:"name";s:5:"title";s:6:"params";a:14:{s:7:"content";s:55:"2017，微信小程序元年，千亿市场等你挖掘";s:8:"paddingv";i:2;s:8:"paddingh";i:5;s:7:"bgcolor";s:7:"#ffffff";s:5:"color";s:7:"#999999";s:4:"size";i:13;s:3:"pos";s:4:"left";s:8:"lefticon";i:0;s:7:"leftimg";s:0:"";s:6:"lwidth";i:20;s:9:"righticon";i:0;s:8:"rightimg";s:0:"";s:6:"rwidth";i:20;s:3:"url";s:0:"";}}i:13;a:3:{s:2:"id";s:14:"m1507473528945";s:4:"name";s:5:"space";s:6:"params";a:2:{s:6:"height";i:60;s:7:"bgcolor";s:7:"#f3f4f5";}}}}
div;
			$next = $contactid + 1;
			$pdata = array(
				'uniacid' => $_W['uniacid'],
				'name' => '首页',
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
				'params' => $params,
			);
			pdo_insert('zofui_sitetemp_page',$pdata);
			$indexid = pdo_insertid();

			$params = <<<div
a:6:{s:3:"num";s:1:"4";s:7:"padding";s:1:"5";s:7:"bgcolor";s:7:"#ffffff";s:5:"color";s:4:"#999";s:8:"actcolor";s:7:"#ed414a";s:4:"data";a:4:{i:0;a:9:{s:2:"id";s:8:"00000001";s:4:"name";s:6:"首页";s:3:"img";s:80:"{$foot1}";s:6:"actimg";s:80:"{$foot2}";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid={$indexid}";s:4:"type";s:3:"url";s:9:"$$hashKey";s:9:"object:20";s:6:"pageid";s:2:"{$indexid}";s:7:"urlname";s:6:"首页";}i:1;a:7:{s:2:"id";s:8:"00000002";s:4:"name";s:6:"咨询";s:3:"img";s:80:"{$foot3}";s:6:"actimg";s:80:"{$foot4}";s:3:"url";s:0:"";s:4:"type";s:4:"kefu";s:9:"$$hashKey";s:9:"object:21";}i:2;a:9:{s:2:"id";s:15:"m01507472225651";s:3:"img";s:80:"{$foot5}";s:6:"actimg";s:80:"{$foot6}";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid={$contactid}";s:4:"name";s:12:"联系我们";s:4:"type";s:3:"url";s:9:"$$hashKey";s:9:"object:54";s:6:"pageid";s:2:"{$contactid}";s:7:"urlname";s:12:"联系我们";}i:3;a:9:{s:2:"id";s:15:"m11507472225651";s:3:"img";s:80:"{$foot7}";s:6:"actimg";s:80:"{$foot8}";s:3:"url";s:38:"/zofui_sitetemp/pages/page/page?pid={$aboutid}";s:4:"name";s:12:"关于我们";s:4:"type";s:3:"url";s:9:"$$hashKey";s:9:"object:55";s:6:"pageid";s:2:"{$aboutid}";s:7:"urlname";s:12:"关于我们";}}}
div;
			$bdata = array(
				'uniacid' => $_W['uniacid'],
				'tempid' => $tid,
				'createtime' => TIMESTAMP,
				'data' => $params,
			);
			pdo_insert('zofui_sitetemp_bar',$bdata);


		}

	}



}
