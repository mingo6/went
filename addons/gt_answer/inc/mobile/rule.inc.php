<?php
global $_W,$_GPC;

$_SESSION['check_success'] = false;

$roles = $_W['current_module']['config']['roles'];
$roles = htmlspecialchars_decode($roles);

include $this->template('rule');