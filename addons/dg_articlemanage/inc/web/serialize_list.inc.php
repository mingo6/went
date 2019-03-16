<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$serialize_id=$_GPC['serialize_id'];

include $this->template('serialize_list');