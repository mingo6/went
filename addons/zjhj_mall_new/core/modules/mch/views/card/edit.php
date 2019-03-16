<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/25
 * Time: 15:42
 */
defined('YII_RUN') or exit('Access Denied');

$urlManager = Yii::$app->urlManager;
$this->title = '卡券编辑';
$this->params['active_nav_group'] = 12;
$returnUrl = Yii::$app->request->referrer;
if (!$returnUrl)
    $returnUrl = $urlManager->createUrl(['mch/card/index']);
?>
<!-- <div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $returnUrl ?>">卡券列表</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div> -->
<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off" data-return="<?= $returnUrl ?>">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $returnUrl ?>">卡券列表</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- <div class="form-title"><?= $this->title ?></div> -->
        <div class="form-body white-bg border-7">
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">卡券名称</label>
                </div>
                <div class="col-4">
                    <input class="form-control" name="name" value="<?= $model->name ?>">
                    <div class="fs-sm text-danger mt-3">在商品编辑--选择卡券时显示</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class="col-form-label required">卡券图片</label>
                </div>
                <div class="col-4">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'pic_url',
                        'value' => $model->pic_url,
                        'width' => 88,
                        'height' => 88,
                    ]) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">卡券描述</label>
                </div>
                <div class="col-4">
                    <input class="form-control" name="content" value="<?= $model->content ?>">
                    <div class="mt-3">用于线下营销</div>
                    <div class="text-danger fs-sm">卡券会在用户付款后，自动发放给用户</div>
                </div>
            </div>

            <!-- <div class="form-group row">
                <div class="col-4 offset-sm-3">
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
    $(document).on('click', '.del', function () {
        var a = $(this);
        $.myConfirm({
            content: a.data('content'),
            confirm: function () {
                $.ajax({
                    url: a.data('url'),
                    type: 'get',
                    dataType: 'json',
                    success: function (res) {
                        if (res.code == 0) {
                            window.location.reload();
                        } else {
                            $.myAlert({
                                title: res.msg
                            });
                        }
                    }
                });
            }
        });
        return false;
    });
</script>

