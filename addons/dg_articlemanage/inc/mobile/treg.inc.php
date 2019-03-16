<?php

//下载图片
function downloadImage($mediaids) {
	global $_W;
	$uniacid = $_W['uniacid'];
	load()->func('file');
	$account = WeAccount::create($_W['account']);
	$mediaarray=explode(",",$mediaids);
	$filenames="";
	foreach($mediaarray as $mediaid){
		$filename = 'FMFetchi'.date('YmdHis').random(16);
		$access_token = $account->fetch_token();
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$mediaid";
	
		$fileInfo = downloadWeixinFile($url);
		$updir = '../attachment/images/'.$uniacid.'/'.date("Y").'/'.date("m").'/';
		if(!is_dir($updir)){
			mkdirs($updir);
		}
		$filename= $updir.$filename.".jpg";
		saveWeixinFile($filename, $fileInfo["body"]);
		$filenames.=$filename.",";
	}
	return $filenames;
}

function downloadWeixinFile($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_NOBODY, 0);    //只取body头
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$package = curl_exec($ch);
	$httpinfo = curl_getinfo($ch);
	curl_close($ch);
	$imageAll = array_merge(array('header' => $httpinfo), array('body' => $package));
	return $imageAll;
}

function saveWeixinFile($filename, $filecontent) {
	$local_file = fopen($filename, 'w');
	if (false !== $local_file){
		if (false !== fwrite($local_file, $filecontent)) {
			fclose($local_file);
		}
	}
}

global $_GPC, $_W;
	$mediaids=$_GPC['mediaids'];
	if(empty($mediaids)){
		$fmdata = array(
				"success" => -1,
				"msg" => "没有找到图片!",
		);
		echo json_encode($fmdata);
		exit();
	}
	$filename=downloadImage($mediaids);
	if(!empty($_GPC["uid"])){ 
		$head=$_W['attachurl'].str_replace("../attachment/", "", substr($filename,0,strlen($filename)-1));
		pdo_update("dg_article_user",array("avatar"=>$head),array("id"=>$_GPC["uid"]));
	}
	$fmdata = array(
			"success" => 1,
			"imgurl" => $filename,
	);
	echo json_encode($fmdata);
	exit();