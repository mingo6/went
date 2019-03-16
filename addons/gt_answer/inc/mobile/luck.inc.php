<?php
global $_W,$_GPC;

if(empty($_SESSION['check_success'])) {
    message('',$this->createMobileUrl("index"));
} 

$mobile = $_GPC['mobile'];
$name = $_GPC['name'];
$addr = $_GPC['addr'];
if(empty($_GPC['mobile'])) message('手机号码不能为空！');
if(empty($_GPC['name'])) message('姓名不能为空！');
if(empty($_GPC['addr'])) message('地址不能为空！');
$reg = '/^1[34578]\d{9}$/';
if(!preg_match($reg, $_GPC['mobile'])) message('手机号码格式不正确！');

include $this->template('luck');