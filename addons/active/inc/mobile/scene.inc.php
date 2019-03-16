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
// 问题总条数
$library_num = count($list);

include $this->template('main_scene');