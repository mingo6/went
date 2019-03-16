<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '参数设置';
$this->params['active_nav_group'] = 15;
$this->params['is_book'] = 2;
$this->params['isSiteTemp'] = 1;
?>
<style>
    .tip-block {
        height: 0;
        overflow: hidden;
        visibility: hidden;
    }

    .tip-block.active {
        height: auto;
        visibility: visible;
    }
    .tips{
        color:#8d8d8d;
    }
    .btn-delcache{
        min-width:90px;
        height:32px;
        line-height:32px;
        background:#44b549;
        color:white;
        cursor:pointer;
        border:none;
        border-radius:5px;
    }
</style>
<!-- <div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/index/index']) ?>">官网</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div> -->

<div class="main-body p-3">
    <script type="text/javascript">
	window.sysinfo = {
		<?php if(!empty($_W['uniacid'])) echo '"uniacid":'.$_W['uniacid'].','; ?>
		<?php if(!empty($_W['acid'])) echo '"acid":'.$_W['acid'].','; ?>
		<?php if(!empty($_W['openid'])) echo 'openid:'.$_W['openid'].','; ?>
		<?php if(!empty($_W['uid'])) echo 'uid:'.$_W['uid'].','; ?>
		'isfounder': <?php echo !empty($_W['isfounder'])?1:0; ?>,
		'family': '<?php echo IMS_FAMILY ?>',
		'siteroot': '<?php echo $_W['siteroot'] ?>',
		'siteurl': '<?php echo $_W['siteurl'] ?>',
		'attachurl': '<?php echo $_W['attachurl'] ?>',
		'attachurl_local': '<?php echo $_W['attachurl_local'] ?>',
		'attachurl_remote': '<?php echo $_W['attachurl_remote'] ?>',
		'module' : {'url' : '<?php if(defined('MODULE_URL')) echo MODULE_URL ?>', 'name' : '<?php if(defined('IN_MODULE')) echo IN_MODULE ?>'},
		'cookie' : {'pre': '<?php echo $_W['config']['cookie']['pre'] ?>'},
		'account' : <?php echo json_encode($_W['account']) ?>,
		'server' : {'php' : '<?php echo phpversion() ?>'},
	};
	</script>

    <form class="form card auto-submit-form" method="post" autocomplete="off">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/index/index']) ?>">官网</a>
                        <span class="breadcrumb-item active">编辑模板</span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-b-l border-b-r">
                    <!-- start -->
            <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/common.css" rel="stylesheet">
            <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/tao.css" rel="stylesheet">
            <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/common.css" rel="stylesheet" type="text/css">
            <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-ui.css" rel="stylesheet" type="text/css">

            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-1.11.1.min.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/bootstrap.min.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/util.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/common.min.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/require.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-ui.js"></script>

            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/tao.js?t=1527838941"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery.zclip.min.js"></script>

            <div class="tr">
                <!-- <a href="javascript:;" class="add_form_btn topbar_jsbtn" js="addtemp">添加模板</a> -->
                <a href="<?= $urlManager->createUrl(['mch/site/module/editview']) ?>" class="add_form_btn topbar_jsbtn">添加模板</a>
            </div>

            <div class="temp_page_box">

                    <?php foreach($module['module'] as $k=>$v){?>
                    <div class="temp_page_item ">
                        
                            <?php if($v['isact'] == 1){?>
                            <div class="temp_page_actitem">使用中</div>
                            <?php }?>

                            <?php if($v['issystem'] == 1){?>
                            <div class="temp_page_actitem temp_page_system">系统模板</div>
                            <?php }?>
                        
                        <div class="temp_item_thumb">
                            <img src="<?php echo $v['img'];?>">
                            <div class="temp_item_name"><?php echo $v['name'];?></div>

                            <div class="temp_page_settemp">
                                <span class="settemp_btn" id="<?php echo $v['id'];?>">使用模板</span>
                            </div>
                        </div>
                            
                            <?php if($v['issystem'] == 1){?>
                                <div class="item_cell_box temp_item_bot">
                                    <li class="item_cell_flex"><a href="javascript:;" class="temptopage" id="{$item['id']}">导出编辑使用模板</a></li>
                                </div>
                                <div class="item_cell_box temp_item_bot">
                                    <li class="deletesystem" id="{$item['id']}"><a href="javascript:;" >删除系统模板</a></li>
                                </div>
                            <?php }else{?>
                
                            <div class="item_cell_box temp_item_bot">
                                <li><a href="<?= $urlManager->createUrl(['mch/site/module/pagelist','tid'=>$v['id']]) ?>">页面列表</a></li>
                                <li class="item_cell_flex tc"><a href="<?= $urlManager->createUrl(['mch/site/module/editnav','tid'=>$v['id']]) ?>">添加页面</a></li>
                                <li><a href="<?= $urlManager->createUrl(['mch/site/module/editbar','tid'=>$v['id']]) ?>">设置导航</a></li>
                            </div>
                            <div class="item_cell_box temp_item_bot">
                                <li><a href="<?= $urlManager->createUrl(['mch/site/module/editview','tid'=>$v['id']]) ?>" class="edit_listitem">编辑模板 </a> </li>
                                <li class="item_cell_flex" style="text-align:center;"><a href="javascript:;" onclick="onajax('<?= $urlManager->createUrl(['mch/site/module/delete','id'=>$v['id']]) ?>', {}, '删除不能恢复，确定要删除吗？');"> 删除模板</a></li>
                        
                                    <li class="tosys" data-id="<?php echo $v['id'];?>"><a href="javascript:;" onclick="onajax('<?= $urlManager->createUrl(['mch/site/module/tosystem','id'=>$v['id']]) ?>', {}, '设为系统模板后，平台的其他小程序也能导出使用此模板，确定要将此模板设为系统模板吗？');" >设为系统</a></li>
                            </div>  
                            <?php   }?>
                    </div>
                    <?php }?>
            </div>
            <div class="tr">
            </div>
        </div>
    </form>
        
<div class="my_model" addtemp style="display: none;position: relative;z-index: 999;">
    <div class=" ui-draggable " >
        <div class="dialog">
            <div class="dialog_hd">
                <a href="javascript:;" class="icon16_opr closed pop_closed model_close" >关闭</a>
            </div>
            <div class="dialog_bd info_box" >
                <form>
					<div class="frm_control_group">
						<label for="" class="frm_label">模板名称</label>
						<div class="frm_controls msg">
							<span class="frm_input_box">
								<input type="text" class="frm_input"  name="name" value="">
							</span>
							<p class="frm_tips frm_tips_default">设置名称便于辨识不同模板</p>
						</div>
					</div>
					<div class="frm_control_group">
						<label for="" class="frm_label">排序序号</label>
						<div class="frm_controls msg">
							<span class="frm_input_box">
								<input type="text" class="frm_input"  name="number" value="">
							</span>
							<p class="frm_tips frm_tips_default">填入数字，越大越前</p>
						</div>
					</div>
					<div class="frm_control_group single_img_upload">
						<label for="" class="frm_label">模板图标</label>
						<div class="frm_controls">

							<p class="frm_tips frm_tips_default"></p>
						</div>
					</div>
                </form>
            </div>
            <div class="dialog_ft">
                <span class="btn btn_primary btn_input js_btn_p" id="confirm_addform" >
                    <button type="button" class="js_btn">保存</button>
                </span>
                <span class="btn btn_default btn_input js_btn_p model_close" >
                    <button type="button" class="js_btn">取消</button>
                </span>
            </div>
        </div>
    </div>
    <div class="mask ui-draggable" style="display: block;z-index: 222"></div>
</div>



    <!-- end -->

</div>

<script>
    $(document).on('click', '.show-tip', function () {
        var tip = $(this).attr('data-tip');
        if ($('#' + tip).hasClass('active')) {
            $('#' + tip).removeClass('active');
        } else {
            $('#' + tip).addClass('active');
        }
    });

    function onajax(url, data, con){

        if(con != '') {
            if(!confirm(con)) {
                return false;
            }
        }

        data['_csrf'] = _csrf;

        $.post(url,data,function(res){
            if(res.status != 200) {
                alert(res.msg);
            } else {
                alert('操作成功')
                location.href = res.msg;
            }
        });
    }
</script>