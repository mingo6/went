<?php
defined('YII_RUN') or exit('Access Denied');

$urlManager = Yii::$app->urlManager;
$this->title = '商品等级设置';
$this->params['active_nav_group'] = 1;
$returnUrl = Yii::$app->request->referrer;
?>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/goods-level/index','goods_id'=>Yii::$app->request->get('goods_id')]) ?>">商品等级管理</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3" id="app">
    <form class="form auto-submit-form" method="post" autocomplete="off" data-return="<?= $urlManager->createUrl(['mch/goods-level/index','goods_id'=>Yii::$app->request->get('goods_id')]) ?>">
        <div class="form-title"><?= $this->title ?></div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">商品名称</label>
                </div>
                <div class="col-9">
                    <input class="form-control" value="<?= $goodsInfo['name']; ?>" disabled="true">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">会员等级</label>
                </div>
                <div class="col-9">
                    <select class="form-control" name="level_id">
                        <?php foreach ($levelList as $index => $level): ?>
                        <option value="<?= $level->id?>" <?= $level->id == $goodsLevelInfo->level_id ? 'selected' : null ?> ><?= $level->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-9 offset-sm-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <input type="hidden" name="goods_id" value="<?= Yii::$app->request->get('goods_id') ?>" />
                    <input type="hidden" name="id" value="<?= Yii::$app->request->get('id') ?>" />
                    <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                </div>
            </div>
        </div>
    </form>
</div>