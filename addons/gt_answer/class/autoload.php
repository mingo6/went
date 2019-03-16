<?php 
	global $_W;
	defined('IN_IA') or exit('Access Denied');

	function autoLoad ($classname){

		$file = ST_ROOT.'class/'.$classname.".class.php";
		if( file_exists($file) ){
			include_once ($file);
			return true;
		}
		return false;
	}
	spl_autoload_register('autoLoad',false);


	



