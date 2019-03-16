<?php
global $_GPC, $_W;
checklogin();
$uniacid=$_W['uniacid'];

load()->func('tpl');
        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        if ($operation == 'display') {
            $list = pdo_fetchall("SELECT * FROM " . tablename('dg_article_navi') . " WHERE uniacid = '{$uniacid}' ORDER BY displayorder DESC");
        } elseif ($operation == 'post') {

            $id = intval($_GPC['id']);
            if (checksubmit('submit')) {
                if($_GPC['url_type']==1){
                    $in_url=array_filter(explode('|',$_GPC['in_url']));
                    $redi_url=$in_url[0];
                }else{
                    $redi_url=$_GPC['out_url'];
                }

                $data = array(
                    'uniacid' => $uniacid,
                    'navi_name' => $_GPC['navi_name'],
                    'thumb' => tomedia($_GPC['thumb']),
                    'enabled' => intval($_GPC['enabled']),
                    'displayorder' => intval($_GPC['displayorder']),
                    'redi_url' => $redi_url,
                    'url_type' => $_GPC['url_type'],
                	'create_time'=>time()
                );
               if($_GPC['url_type']==1){
                    
                    $data['in_type']=$in_url[1];
                }
                if (!empty($id)) {
                    pdo_update('dg_article_navi', $data, array('id' => $id));
                } else {
                    pdo_insert('dg_article_navi', $data);
                    $id = pdo_insertid();
                }
                message('更新标签成功！', $this->createWebUrl('index_navi', array('op' => 'display')), 'success');
            }
            $banner = pdo_fetch("select * from " . tablename('dg_article_navi') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $uniacid));
        } elseif ($operation == 'delete') {
            $id = intval($_GPC['id']);
            $banner = pdo_fetch("SELECT id  FROM " . tablename('dg_article_navi') . " WHERE id = '$id' AND uniacid=" . $uniacid);
            if (empty($banner)) {
                message('抱歉，标签不存在或是已经被删除！', $this->createWebUrl('index_navi', array('op' => 'display')), 'error');
            }
            pdo_delete('dg_article_navi', array('id' => $id));
            message('标签删除成功！', $this->createWebUrl('index_navi', array('op' => 'display')), 'success');
        } else {
            message('请求方式不存在');
        }
include $this->template('index_navi');
   