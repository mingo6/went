<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2
 * Time: 9:27
 */
defined('YII_RUN') or exit('Access Denied');
use \app\models\Level;

/* @var \app\models\Level $level */
$urlManager = Yii::$app->urlManager;
$this->title = '会员设置';
$this->params['active_nav_group'] = 4;
?>
<!-- <div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
            <a flex="cross:center" class="breadcrumb-item"
               href="<?= $urlManager->createUrl(['mch/user/level']) ?>">会员等级</a>
            <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div> -->

<div class="main-body p-3">

    <div class="form">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
                        <a flex="cross:center" class="breadcrumb-item"
                           href="<?= $urlManager->createUrl(['mch/user/level']) ?>">会员等级</a>
                        <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="level-edit" role="tabpanel" aria-labelledby="nav-level-edit">

                    <form method="post" class="auto-submit-form" autocomplete="off"
                          data-return="<?= $urlManager->createUrl(['mch/user/level']) ?>">
                        <div class="form-body">
                            <input type="hidden" name="scene" value="edit">
                            <div class="form-group row">
                                <div class="col-1 text-left">
                                    <label class="col-form-label required">等级</label>
                                </div>
                                <div class="col-1">
                                    <select class="form-control" name="level">
                                        <?php for ($i = 0; $i <= 100; $i++): ?>
                                            <option
                                                value="<?= $i ?>" <?= ($level->level == $i) ? "selected" : "" ?>><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <div class="text-muted fs-sm">数字越大等级越高</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-1 col-5">
                                    <div class="text-muted fs-sm text-danger">会员满足条件等级从低到高自动升级，高等级不会自动降级</div>
                                    <div class="text-muted fs-sm text-danger">如需个别调整，请前往<a
                                            href="<?= $urlManager->createUrl(['mch/user/index']) ?>">会员列表</a>调整
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-1 text-left">
                                    <label class="col-form-label required">等级名称</label>
                                </div>
                                <div class="col-5">
                                    <input class="form-control" name="name" value="<?= $level->name ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-1 text-left">
                                    <label class="col-form-label required">升级条件</label>
                                </div>
                                <div class="col-5">
                                    <div class="input-group">
                                        <span class="input-group-addon bg-white">累计完成订单金额满</span>
                                        <input class="form-control" name="money" type="number" value="<?= $level->money ?>">
                                        <span class="input-group-addon bg-white">元</span>
                                    </div>
                                    <div class="text-muted fs-sm">会员升级条件</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-1 text-left">
                                    <label class="col-form-label required">折扣</label>
                                </div>
                                <div class="col-5">
                                    <div class="input-group">
                                        <input class="form-control" name="discount" value="<?= $level->discount ?>">
                                        <span class="input-group-addon bg-white">折</span>
                                    </div>
                                    <div class="text-muted fs-sm">请输入0.1~10之间的数字</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-1 text-left">
                                    <label class="col-form-label required">状态</label>
                                </div>
                                <div class="col-5">
                                    <div class="pt-1">
                                        <label class="custom-control custom-radio">
                                            <input id="radio1"
                                                   value="1" <?= $level->status == 1 ? "checked" : "" ?>
                                                   name="status" type="radio" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">启用</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="radio2"
                                                   value="0" <?= $level->status == 0 ? "checked" : "" ?>
                                                   name="status" type="radio" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">禁用</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-1 col-5">
                                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                                    <a class="btn btn-orange" href="javascript:">提交</a>
                                    <a class="btn btn-orange" href="<?= $urlManager->createUrl(['mch/user/level']) ?>">返回列表</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show" id="content-edit" role="tabpanel" aria-labelledby="nav-content-edit">
                    <form method="post" class="auto-submit-form" autocomplete="off"
                          data-return="<?= $urlManager->createUrl(['mch/user/level']) ?>">
                        <div class="form-body">
                            <div class="form-group row">
                                <div class="col-1 text-left required">
                                    <label class="col-form-label required">会员等级说明</label>
                                </div>
                                <div class="col-5">
                                    <textarea class="form-control" name="content" style="min-height: 200px;"><?=$store->member_content?></textarea>
                                </div>
                                <input type="hidden" name="scene" value="content">
                            </div>
                            <div class="form-group row">
                                <div class="offset-1 col-5">
                                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                                    <a class="btn btn-orange" href="javascript:">提交</a>
                                    <a class="btn btn-orange"
                                       href="<?= $urlManager->createUrl(['mch/user/level']) ?>">返回列表</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>