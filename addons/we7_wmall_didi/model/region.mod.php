<?php
defined('IN_IA') or exit('Access Denied');

function find_all_region_list()
{
    global $_W;
    return pdo_getall('tiny_wmall_region', array('uniacid' => $_W['uniacid']));
}