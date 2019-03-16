<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '消息通知';
$this->params['active_nav_group'] = 10;
$this->params['is_book'] = 1;
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
</style>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/book/index/index']) ?>">预约</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <form class="form card auto-submit-form" method="post" autocomplete="off">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/book/index/index']) ?>">预约</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7">
            <div class="card-block">
                <div class="form-group row">
                    <div class="col-sm-2 text-left">
                        <label class="col-form-label">预约成功通知（模板ID）</label>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" value="<?= $setting['success_notice'] ?>"
                               name="model[success_notice]">
                        <div class="text-muted mt-3"><a class="show-tip" href="javascript:" data-tip="tip1">模板消息格式说明</a></div>
                        <div class="tip-block" id="tip1">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/yy_success_notice.png">
                        </div>
                    </div>
                </div>

                <div class="form-group row" hidden>
                    <div class="col-sm-2 text-left">
                        <label class="col-form-label">预约失败退款通知（模板ID）</label>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" value="<?= $model['pintuan_fail_notice'] ?>"
                               name="pintuan_fail_notice">
                        <div class="text-muted mt-3"><a class="show-tip" href="javascript:" data-tip="tip2">模板消息格式说明</a></div>
                        <div class="tip-block" id="tip2">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/yy_refund_notice.png">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2 text-left">
                        <label class="col-form-label">预约失败退款通知（模板ID）</label>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" value="<?= $setting['refund_notice'] ?>"
                               name="model[refund_notice]">
                        <div class="text-muted mt-3"><a class="show-tip" href="javascript:" data-tip="tip3">模板消息格式说明</a></div>
                        <div class="tip-block" id="tip3">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/yy_refund_notice.png">
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <div class="col-sm-4 offset-md-3">
                        <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                        <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                        <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                    </div>
                </div> -->
            </div>
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
</script>