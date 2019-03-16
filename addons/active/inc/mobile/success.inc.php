<?php
global $_W,$_GPC;

if(empty($_SESSION['check_success'])) {
    message('',$this->createMobileUrl("index"));
} 
include $this->template('success');