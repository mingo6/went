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
        /* min-width:90px;
        height:32px;
        line-height:32px;
        background:#44b549;
        color:white;
        cursor:pointer;
        border:none;
        border-radius:5px; */
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
    <form class="form card auto-submit-form" method="post" autocomplete="off">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/index/index']) ?>">官网</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- <div class="card-header"><?= $this->title ?></div> -->
        <div class="form-body white-bg">

            <div class="form-group row">
                <div class="col-12 mb-5"><span class="title-line">参数设置</span></div>
                <div class="col-sm-1 text-left">
                    <label class="col-form-label">删除缓存</label>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-orange btn-delcache">删除缓存</button>
                    <!-- <div class="text-muted"><span class="tips" href="javascript:" data-tip="tip1">重装模块后必须删除缓存</span></div>
                    <div class="tip-block" id="tip1">
                        <img style="max-width: 100%"
                             src="<?= Yii::$app->request->baseUrl ?>/statics/images/yy_success_notice.png">
                    </div> -->
                </div>
                <div class="col-12 mt-3">
                    <div class="text-muted"><span class="tips" href="javascript:" data-tip="tip1">重装模块后必须删除缓存</span></div>
                    <div class="tip-block" id="tip1">
                        <img style="max-width: 100%"
                             src="<?= Yii::$app->request->baseUrl ?>/statics/images/yy_success_notice.png">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2 text-left">
                    <label class="col-form-label">查看表单数据验证码</label>
                </div>
                <div class="col-sm-3">
                    <input class="form-control" value="<?= $setting['frompass'] ?>"
                           name="frompass">
                    <!-- <div class="text-muted"><span class="tips" href="javascript:" data-tip="tip1">输入别人不知道的字符，前端查看表单数据时，需输入此验证码才能查看</span></div> -->
                    <div class="tip-block" id="tip1">
                        <img style="max-width: 100%"
                             src="<?= Yii::$app->request->baseUrl ?>/statics/images/yy_success_notice.png">
                    </div>
                </div>
                <div class="col-sm-2 text-left">
                    <label class="col-form-label">接收通知邮箱</label>
                </div>
                <div class="col-sm-3">
                    <input class="form-control" value="<?= $setting['mail'] ?>"
                           name="mail">
                    <!-- <div class="text-muted"><span class="tips" href="javascript:" data-tip="tip3">填写你的电子邮箱，接收表单通知等。例如：test@163.com</span></div> -->
                    <div class="tip-block" id="tip3">
                        <img style="max-width: 100%"
                             src="<?= Yii::$app->request->baseUrl ?>/statics/images/yy_refund_notice.png">
                    </div>
                </div>
                <div class="col-sm-5 tips mt-3">输入别人不知道的字符，前端查看表单数据时，需输入此验证码才能查看</div>
                <div class="col-sm-5 tips mt-3">填写你的电子邮箱，接收表单通知等。例如：test@163.com</div>
            </div>

            <!-- <div class="form-group row">
                <div class="col-sm-6 offset-md-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                </div>
            </div> -->
        </div>
        <div class="content-p white-bg form-horizontal mt-4 border-7 p-3">
            <div class="form-group row" style="margin: 0;">
                <div class="col-12 text-center">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-default submit-btn" href="javascript:">保存</a>
                </div>
            </div>
        </div>
    </form>

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