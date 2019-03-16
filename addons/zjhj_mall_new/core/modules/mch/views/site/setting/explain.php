<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '使用说明';
$this->params['active_nav_group'] = 15;
$this->params['is_book'] = 2;
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
        /* min-width:90px;
        height:32px;
        line-height:32px;
        background:#44b549;
        color:white;
        cursor:pointer;
        border:none;
        border-radius:5px; */
    }
    .item_cell_flex .step_item {
        margin-top:40px;
    }
    .step_item img {
        border: 1px solid #ddd;
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
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        <!-- <div class="card-header"><?= $this->title ?></div> -->
        <div class="intro od_msg item_cell_box">
		<div style='margin:40px'>后台配置步骤</div>
		<div class="item_cell_flex" style="margin-left: 40px">
			<div class="step_item">
				<div>1、在模板管理内添加一个模板</div>
				<div>
					<img width="700px" src="<?= Yii::$app->request->baseUrl ?>/statics/images/step1.png">
				</div>
			</div>
			<div class="step_item">
				<div>2、添加模板后，点击模板设置使用模板</div>
				<div>
					<img width="700px" src="<?= Yii::$app->request->baseUrl ?>/statics/images/step2.png">
				</div>
			</div>
			<div class="step_item">
				<div>3、点击模板下方的添加页面，添加各个页面</div>
				<div>
					<img width="700px" src="<?= Yii::$app->request->baseUrl ?>/statics/images/step3.png">
				</div>
			</div>
			<div class="step_item">
				<div>4、添加好各个页面后，点击设置导航，设置好模板的导航，设置完成后后台配置就完成了。</div>
				<div>
					<img width="700px" src="<?= Yii::$app->request->baseUrl ?>/statics/images/step4.png">
				</div>
			</div>
			<div class="step_item">
				<div>其他注意事项</div>
				<div>一、第一个页脚导航链接的页面将作为进入小程序后的展现页面。</div>
				<div>二、富文本编辑模块内不能添加视频、音频、表情、超链接等特殊的编辑内容。</div>
				<div>三、设置跳转网页域名和添加网页容器时，必须在小程序后台-设置-开发设置-业务域名内设置好跳转的域名。</div>
			</div>
			<div class="step_item">
				<div>常见问题</div>
				<div>一、为什么添加模板后打开页面是空白的？</div>
				<div>1:可能你的小程序后台没有设置域名，在小程序后台-设置-开发设置内绑定你的服务器域名。</div>
				<div>2:可能你的小程序后台配置的域名和代码内的域名不一致，保持登录的勤瀚堂后台域名和小程序后台配置的域名一致。</div>
				<div>3:可能你的域名没有配置https，请自行百度配置https。</div>
				<div>4:可能你设置的模板没有设置导航，请设置导航，把第一个导航设置成首页链接。</div>
				<div>5:还出现空白的情况请换个https证书试下，或过段时间再试下。</div>
			</div>		

		</div>
	</div>

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

    //console.log(233);
    $(document).on('click', '.btn-delcache', function () {
        $.ajax({
            url:"<?= $delcache ?>",
            data:{cache:'cache'},
            type:'GET',
            success:function(res){
                alert(res.msg);
            }
        });
    });
</script>