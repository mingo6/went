<?php
global $_W,$_GPC;

$_SESSION['check_success'] = false;

$sql = 'select * from ' . tablename('gt_library') .' where uniacid=:uniacid order by sort asc';
$param = array(':uniacid' => $_W['uniacid']);
$list = pdo_fetchall($sql, $param);

$sql_answer = 'select * from ' . tablename('gt_library_answer') .' where uniacid=:uniacid and library_id=:library_id order by sort asc';
$score = 0;
foreach($list as $key => $item)
{
    $list[ $key ]['num'] = $key + 1;
    $answer = pdo_fetchall($sql_answer, array(':uniacid' => $_W['uniacid'], 'library_id'=>$item['id']));
    $list[ $key ]['answer'] = $answer;
    $score += $item['grade'];
}
// 合格分数
$score = $_W['current_module']['config']['standard_score'];
$music = $_W['current_module']['config']['bg_music'];
// 问题总条数
$library_num = count($list);
// 规则
$roles = $_W['current_module']['config']['roles'];
$roles = htmlspecialchars_decode($roles);

$accsql = 'select * from ' . tablename('uni_account_modules') .' where uniacid=:uniacid AND module=:module';
$accparam = array(':uniacid'=>$_W['uniacid'], ':module'=>$_W['current_module']['name']);
$account = pdo_fetch($accsql, $accparam);
if($account) {
    $settings = unserialize($account['settings']);
    var_dump($settings);
    $settings['visit'] = empty($settings['visit'])? 1 : $settings['visit']+1;
    $new_settings = serialize($settings);
    $prizeRes = pdo_query("UPDATE " . tablename('uni_account_modules') . " SET settings='{$new_settings}' WHERE uniacid=".$_W['uniacid']." and module='".$_W['current_module']['name']."'");
}

include $this->template('index');