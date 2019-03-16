<?php
/**
 * 模块微站定义
 *
 * @author 众惠科技
 * @url http://bbs.we7.cc/ 
 */
global $_W;
defined('IN_IA') or exit('Access Denied');
define('ST_ROOT',IA_ROOT.'/addons/gt_answer/');
define('ST_URL',$_W['siteroot'].'addons/gt_answer/');
define('MODULE','gt_answer');
require_once(ST_ROOT.'class/autoload.php');

class Gt_answerModuleSite extends WeModuleSite {
    protected $pagesize;
    public function __construct()
    {
        $this->pagesize = 10;
    }
}

