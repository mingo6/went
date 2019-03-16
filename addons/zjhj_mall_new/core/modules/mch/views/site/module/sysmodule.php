<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '系统模板';
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
<!-- start -->
<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/common.css" rel="stylesheet">
<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/tao.css" rel="stylesheet">
<script>
    if(navigator.appName == 'Microsoft Internet Explorer'){
        if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
            alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
        }
    }
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
<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/bootstrap.min.js"></script>
<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/util.js?v=20180615"></script>
<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/common.min.js?v=20180615"></script>
<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/require.js?v=20180615"></script>
<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-ui.js"></script>
<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/tao.js?v=20180615"> </script>
<script charset="utf-8" src="http://tongji.w7.cc/s.php?sid=3"></script>
<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery.zclip.min.js"></script>

<div class="main-nav" flex="cross:center dir:left box:first">
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
</div>

<div class="main-body p-3">
    <div class="form-title white-bg">
        <div class="main-nav" flex="cross:center dir:left box:first">
            <div>
                <nav class="breadcrumb rounded-0 mb-0" flex="cross:center" style="background-color: transparent;">
                    <span style="margin-right: 1rem">位置：</span>
                    <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/module/index']) ?>">我的模板</a>
                    <span class="breadcrumb-item active"><?= $this->title ?></span>
                </nav>
            </div>
        </div>
    </div>
    <div class="form-body white-bg border-b-l border-b-r">
	<!-- <div class="tr">
		<a href="javascript:;" class="add_form_btn topbar_jsbtn" js="addtemp">添加模板</a>
	</div> -->

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
					</div>
                        <?php if($v['issystem'] == 1){?>
                            <div class="item_cell_box temp_item_bot">
                                <li class="item_cell_flex"><a href="<?= $urlManager->createUrl(['mch/site/module/topage','id'=>$v['id']]) ?>" class="" onclick="return confirm('重要：导出后一定要编辑被导出模板的导航和页面链接，否则前端可能无法显示！！！');">导出编辑使用模板</a></li>
                            </div>
                            <div class="item_cell_box temp_item_bot">
                            <?php if($v['issetsystem'] == 1){?>
                                <li class="" id="{$item['id']}"><a href="javascript:;" onclick="onajax('<?= $urlManager->createUrl(['mch/site/module/delsystem','id'=>$v['id']]) ?>', {}, '删除不能恢复，确定要删除吗？');" >删除系统模板</a></li>
                            <?php }?>
                            </div>
                        <?php }else{?>
						<div class="item_cell_box temp_item_bot">
							<li><a href="<?= $urlManager->createUrl(['mch/site/module/pagelist','id'=>$v['id']]) ?>">页面列表</a></li>
							<li class="item_cell_flex tc"><a href="{php echo $this->createWebUrl('page',array('op'=>'add','tid'=>$item['id']))}">添加页面</a></li>
							<li><a href="{php echo $this->createWebUrl('page',array('op'=>'design','op'=>'bar','tid'=>$item['id']))}">设置导航</a></li>
						</div>
						<div class="item_cell_box temp_item_bot">
							<li><a href="javascript:;" class="edit_listitem" id="{$item['id']}">编辑模板 </a> </li>
							<li class="item_cell_flex" style="text-align:center;"><a href="<?= $urlManager->createUrl(['mch/site/module/delete','id'=>$v['id']]) ?>" onclick="return confirm('删除不能恢复，确定要删除吗？');"> 删除模板</a></li>
								<li class="tosystem tosys" data-id="<?php echo $v['id'];?>"><a href="<?= $urlManager->createUrl(['mch/site/module/tosystem','id'=>$v['id']]) ?>" onclick="return confirm('设为系统模板后，平台的其他小程序也能导出使用此模板，确定要将此模板设为系统模板吗？');" >设为系统</a></li>
                        </div>	
                        <?php   }?>
                </div>
                <?php }?>
		</div>
		<div class="tr">
        </div>
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
                                        <input type="text" class="frm_input"  name="name" value="<?= $info['name'] ?>">
                                    </span>
                                    <p class="frm_tips frm_tips_default">设置名称便于辨识不同模板</p>
                                </div>
                            </div>
                            <div class="frm_control_group">
                                <label for="" class="frm_label">排序序号</label>
                                <div class="frm_controls msg">
                                    <span class="frm_input_box">
                                        <input type="text" class="frm_input"  name="number" value="<?= $info['number'] ?>">
                                    </span>
                                    <p class="frm_tips frm_tips_default">填入数字，越大越前</p>
                                </div>
                            </div>
                            <div class="frm_control_group single_img_upload">
                                <label for="" class="frm_label">模板图标</label>
                                <div class="frm_controls">
                                    <?= $info['number'] ?>
                                    <!-- {php echo  WebCommon::tpl_form_field_image('img',$info['img'])} -->
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
</script>

<script type="text/javascript">
	$(function(){
		var fid = 0;
		$('.edit_listitem').click(function(){
            var nowfid = $(this).attr('id');
            var url = 'findtemp';
            $.myConfirm({
                content: a.data('content'),
                confirm: function () {
                    $.ajax({
                        url: a.data('url'),
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            if(data.code == 0) {
                                fid = nowfid; // 防止取消后再添加异常
                                $('input[name=name]').val(data.obj.name);
                                $('input[name=number]').val(data.obj.number);
                                if( data.obj.img ) {
                                    $('input[name=img]').val(data.obj.img);
                                    if( data.obj.img ) $('.img-thumbnail').attr('src',data.obj.showimg).parent().show();
                                }else{
                                    $('input[name=img]').val('');
                                    $('.img-thumbnail').attr('src','').parent().hide();
                                }
                                
                                $('.my_model[addtemp]').show();

                            }else{
                                $.myAlert({
                                    title: data.msg
                                });
                            }
                        }
                    });
                }
            });
		});
		$('#confirm_addform').click(function(){
			var postdata = {
				fid : fid,
				name : $('input[name=name]').val(),
				number : $('input[name=number]').val(),
				img : $('input[name=img]').val(),
			};
			
			Http('post','json','addtempform',postdata,function(data){
				if(data.status == 200){
					webAlert(data.res);
					setTimeout(function(){
						location.href = '';
					},500);
				}else{
					webAlert(data.res);
				}
			},true);

		});

        function showImageDialog(elm, opts, options) {
            require(["util"], function(util){
                var btn = $(elm);
                var ipt = btn.parent().prev();
                var val = ipt.val();
                var img = ipt.parent().next().children();
                options = {'global':false,'class_extra':'','direct':true,'multiple':false};
                util.image(val, function(url){
                    if(url.url){
                        if(img.length > 0){
                            img.get(0).src = url.url;
                        }
                        ipt.val(url.attachment);
                        ipt.attr("filename",url.filename);
                        ipt.attr("url",url.url);
                        img.parent().show();
                    }
                    if(url.media_id){
                        if(img.length > 0){
                            img.get(0).src = "";
                        }
                        ipt.val(url.media_id);
                    }
                }, null, options);
            });
        }
        function deleteImage(elm){
            require(["jquery"], function($){
                $(elm).prev().parent().hide();
                $(elm).parent().prev().find("input").val("");
            });
        }
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
	});
    
   
</script>