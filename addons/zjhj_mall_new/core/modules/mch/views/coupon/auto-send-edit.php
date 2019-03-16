<?php
defined('YII_RUN') or exit('Access Denied');

/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/8/24
 * Time: 10:18
 */

use yii\widgets\LinkPager;

$urlManager = Yii::$app->urlManager;
$this->title = '自动发放优惠券编辑';
$this->params['active_nav_group'] = 7;
$returnUrl = Yii::$app->request->referrer;
if (!$returnUrl)
    $returnUrl = $urlManager->createUrl(['mch/coupon/auto-send']);
$events = [
    1 => '页面转发',
    2 => '购买并付款',
];
?>
<link href="https://cdn.bootcss.com/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css" rel="stylesheet">
<!-- <div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $returnUrl ?>">自动发放优惠</a>
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
                        <a class="breadcrumb-item" href="<?= $returnUrl ?>">自动发放优惠</a>
                        <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7">

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class="col-form-label required">触发事件</label>
                </div>
                <div class="col-4">
                    <select class="form-control" name="event">
                        <?php foreach ($events as $i => $v): ?>
                            <option value="<?= $i ?>" <?= $model->event == $i ? 'selected' : null ?>><?= $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class="col-form-label required">发放的优惠券</label>
                </div>
                <div class="col-4">
                    <select class="form-control" name="coupon_id">
                        <?php foreach ($coupon_list as $coupon): ?>
                            <option value="<?= $coupon->id ?>" <?= $model->coupon_id == $coupon->id ? 'selected' : null ?>>
                                <?= $coupon->id ?>:<?= $coupon->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class="col-form-label required">该方案下最多发放次数</label>
                </div>
                <div class="col-4">
                    <input value="<?= $model->send_times ?>" class="form-control"
                           name="send_times" type="number">
                    <div class="fs-sm text-muted">如不限制发放次数，请填写0</div>
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
<script src="https://cdn.bootcss.com/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<script>


</script>