<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/8
 * Time: 18:01
 */
defined('YII_RUN') or exit('Access Denied');
/* @var $list \app\models\Setting */

/* @var $qrcode \app\models\Qrcode */

use yii\widgets\LinkPager;

$static = Yii::$app->request->baseUrl . '/statics';
$urlManager = Yii::$app->urlManager;
$this->title = '基础设置';
$this->params['active_nav_group'] = 5;
?>
<style>
    .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
        color: #737373;
    }
</style>
<!-- <div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div> -->
<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off">
        <!-- <div class="form-title">基础设置</div> -->
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/order/index']) ?>">分销商管理</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7 mb-3">
            <div class="form-group row">
                <div class="col-12 mb-3"><span class="title-line">分销信息</span></div>
                <div class="col-1 text-left">
                    <label class=" col-form-label required">分销层级</label>
                </div>
                <div class="col-4">
                    <label class="col-form-label mr-3"><input type="radio" name="model[level]"
                                                              value="0" <?= ($list->level == 0) ? "checked" : "" ?>>不开启</label>
                    <label class="col-form-label mr-3"><input type="radio" name="model[level]"
                                                              value="1" <?= ($list->level == 1) ? "checked" : "" ?>>一级分销</label>
                    <label class="col-form-label mr-3"><input type="radio" name="model[level]"
                                                              value="2" <?= ($list->level == 2) ? "checked" : "" ?>>二级分销</label>
                    <label class="col-form-label"><input type="radio" name="model[level]"
                                                         value="3" <?= ($list->level == 3) ? "checked" : "" ?>>三级分销</label>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label required">成为下线条件</label>
                </div>
                <div class="col-6">
                    <div>
                        <label class="col-form-label mr-3"><input type="radio" name="model[condition]"
                                                                  value="0" <?= ($list->condition == 0) ? "checked" : "" ?>>首次点击链接</label>
                        <!--                        <label class="col-form-label mr-3"><input type="radio" name="model[condition]" value="1">首次下单</label>-->
                        <!--                        <label class="col-form-label mr-3"><input type="radio" name="model[condition]" value="2">首次付款</label>-->
                    </div>
                    <div class="help-block">首次点击分享链接： 可以自由设置分销商条件</div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label required">成为分销商条件</label>
                </div>
                <div class="col-5">
                    <div>
                        <label class="col-form-label mr-3"><input type="radio" name="model[share_condition]"
                                                                  value="0" <?= ($list->share_condition == 0) ? "checked" : "" ?>>无条件（需要审核）</label>
                        <label class="col-form-label mr-3"><input type="radio" name="model[share_condition]"
                                                                  value="1" <?= ($list->share_condition == 1) ? "checked" : "" ?>>申请（需要审核）</label>
                        <label class="col-form-label mr-3"><input type="radio" name="model[share_condition]"
                                                                  value="2" <?= ($list->share_condition == 2) ? "checked" : "" ?>>无需审核</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">推广海报图</label>
                </div>
                <div class="col-9">
                    <a href="<?= $urlManager->createUrl(['mch/share/qrcode']) ?>"
                       class="btn btn-sm btn-orange">设置</a>

                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7 mb-3">

            <div class="form-group row">
                <div class="col-3 text-left">
                    <label class=" col-form-label title-line mb-3">提现信息</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class="col-form-label required">提现方式</label>
                </div>
                <div class="col-11">
                    <div>
                        <label class="col-form-label mr-3">
                            <input type="checkbox" name="model[pay_type][]" value="0"
                                <?=($list->pay_type==2||$list->pay_type==0)?"checked":""?>>
                            <span>微信支付</span>
                        </label>
                        <label class="col-form-label mr-3">
                            <input type="checkbox" name="model[pay_type][]" value="1"
                                <?=($list->pay_type==2||$list->pay_type==1)?"checked":""?>>
                            <span>支付宝支付</span>
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="col-form-label text-muted">微信自动支付，需要申请微信支付的企业付款到零钱功能</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 mb-3 text-left">
                    <label class=" col-form-label required">最少提现额度</label>
                </div>
                <div class="col-3 mb-3">
                    <div class="input-group" style="max-width:350px;">
                        <input class="form-control" name="model[min_money]"
                               value="<?= $list->min_money ? $list->min_money : 1 ?>">
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
                <div class="col-1 mb-3 text-left">
                    <label class=" col-form-label required">每日提现上限</label>
                </div>
                <div class="col-3 mb-3">
                    <div class="input-group" style="max-width:350px;">
                        <input type="number" min="0" step="0.01" class="form-control" name="model[cash_max_day]"
                               value="<?= $option['cash_max_day'] ? $option['cash_max_day'] : 0 ?>">
                        <span class="input-group-addon">元</span>
                    </div>
                    <div class="text-muted fs-sm mt-3">0元表示不限制每日提现金额</div>
                </div>
                <div class="col-1 text-left">
                    <label class="col-form-label required">消费自动成为分销商</label>
                </div>
                <div class="col-3">
                    <div class="input-group" style="max-width:350px;">
                        <input type="number" min="0" step="0.01" class="form-control" name="model[auto_share_val]"
                               value="<?= $option['auto_share_val'] ? $option['auto_share_val'] : 0 ?>">
                        <span class="input-group-addon">元</span>
                    </div>
                    <div class="text-muted fs-sm mt-3">消费满指定金额自动成为分销商，0元表示不自动</div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">提现到账通知模板消息id</label>
                </div>
                <div class="col-3">
                    <input class="form-control" value="<?=$tpl_msg['cash_success_tpl']?>" name="model[cash_success_tpl]" style="max-width: 450px">
                    <div class="fs-sm text-muted mt-3">
                        <span>提现转账处理完成后向用户发送消息，</span>
                        <a href="javascript:" class="fs-sm" data-toggle="modal"
                           data-target="#cash_success_tpl">如何获取提现到账通知模板消息id</a>
                    </div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">提现失败通知模板消息id</label>
                </div>
                <div class="col-3">
                    <input class="form-control" value="<?=$tpl_msg['cash_fail_tpl']?>" name="model[cash_fail_tpl]" style="max-width: 450px">
                    <div class="fs-sm text-muted mt-3">
                        <span>提现失败向用户发送消息，</span>
                        <a href="javascript:" class="fs-sm" data-toggle="modal"
                           data-target="#cash_fail_tpl">如何获取提现失败通知模板消息id</a>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">用户须知</label>
                </div>
                <div class="col-9">
                    <textarea class="form-control" name="model[content]"
                              style="min-height: 150px;max-width: 350px;"><?= $list->content ?></textarea>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7 mb-3">

            <div class="form-group row">
                <div class="col-3 text-left">
                    <label class=" col-form-label">申请信息</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">申请页面</label>
                </div>
                <div class="col-3">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[pic_url_1]',
                        'value' => $list->pic_url_1,
                        'width' => 750,
                        'height' => 300,
                    ]) ?>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">待审核页面</label>
                </div>
                <div class="col-7">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[pic_url_2]',
                        'value' => $list->pic_url_2,
                        'width' => 750,
                        'height' => 300,
                    ]) ?>
                </div>
                <div class="col-1 text-left mt-3">
                    <label class=" col-form-label">申请协议</label>
                </div>
                <div class="col-3 mt-3">
                    <textarea class="form-control" name="model[agree]"
                              style="min-height: 150px;width: 100%;"><?= $list->agree ?></textarea>
                </div>
            </div>
            <!-- <div class="form-group row">
                <div class="col-9 offset-sm-3">
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
<!-- Modal -->
<div class="modal fade" id="cash_success_tpl" data-backdrop="static" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">如何获取提现到账通知模板消息id</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol class="pl-3">
                    <li>
                        <div>进入微信小程序官方后台，找到模板库</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/0.png">
                        </div>
                    </li>
                    <li>
                        <div>查找指定模板，点击选用</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/cash_success_tpl/1.png">
                        </div>
                    </li>
                    <li>
                        <div>选择下图关键词，并按下图调好顺序；点击提交</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/cash_success_tpl/2.png">
                        </div>
                    </li>
                    <li>
                        <div>复制模板ID</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/cash_success_tpl/3.png">
                        </div>
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <a href="javascript:" class="btn btn-secondary" data-dismiss="modal">关闭</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="cash_fail_tpl" data-backdrop="static" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">如何获取提现到账通知模板消息id</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol class="pl-3">
                    <li>
                        <div>进入微信小程序官方后台，找到模板库</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/0.png">
                        </div>
                    </li>
                    <li>
                        <div>查找指定模板，点击选用</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/cash_fail_tpl/1.png">
                        </div>
                    </li>
                    <li>
                        <div>选择下图关键词，并按下图调好顺序；点击提交</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/cash_fail_tpl/2.png">
                        </div>
                    </li>
                    <li>
                        <div>复制模板ID</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/cash_fail_tpl/3.png">
                        </div>
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <a href="javascript:" class="btn btn-secondary" data-dismiss="modal">关闭</a>
            </div>
        </div>
    </div>
</div>