<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 16:16
 */
defined('YII_RUN') or exit('Access Denied');

use yii\widgets\LinkPager;
use \app\models\Option;
/* @var \app\models\Printer[] $list */
/* @var \app\models\PrinterSetting $model */

$urlManager = Yii::$app->urlManager;
$this->title = '打印设置';
$this->params['active_nav_group'] = 13;
?>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>
<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/order/index']) ?>">小票打印机</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7">

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">选择打印机</label>
                </div>
                <div class="col-4">
                    <select class="form-control" name="printer_id">
                        <?php foreach($list as $index=>$value):?>
                            <option value="<?=$value->id?>" <?=$model->printer_id == $value['id']?"selected":""?>><?=$value->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">订单打印方式</label>
                </div>
                <div class="col-4">
                    <div class="pt-1">
                        <label class="custom-control custom-checkbox">
                            <input id="radio1"
                                   value="1" <?=$model->type['order'] == 1?"checked":""?>
                                   name="type[order]" type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">下单打印</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="radio2"
                                   value="1" <?=$model->type['pay'] == 1?"checked":""?>
                                   name="type[pay]" type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">付款打印</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="radio2"
                                   value="1" <?=$model->type['confirm'] == 1?"checked":""?>
                                   name="type[confirm]" type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">确认收货打印</span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group row">
                <div class="col-4 offset-sm-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-orange submit-btn" href="javascript:">保存</a>
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
