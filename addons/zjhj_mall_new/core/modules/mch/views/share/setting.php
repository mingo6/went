<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/8
 * Time: 15:40
 */
/* @var $list \app\models\Setting */
use yii\widgets\LinkPager;

$urlManager = Yii::$app->urlManager;
$this->title = '佣金设置';
$this->params['active_nav_group'] = 5;
?>

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
        <div class="form-body white-bg border-7">
            <?php if ($list->level != 0): ?>
                <div class="form-group row">
                    <div class="col-1 text-left">
                        <label class=" col-form-label">分销佣金类型</label>
                    </div>
                    <div class="col-4">
                        <div class="pt-1">
                            <label class="custom-control custom-radio price_type">
                                <input id="radio1" <?= $list->price_type == 0 ? 'checked' : null ?>
                                       value="0"
                                       name="model[price_type]" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">百分比</span>
                            </label>
                            <label class="custom-control custom-radio price_type">
                                <input id="radio2" <?= $list->price_type == 1 ? 'checked' : null ?>
                                       value="1"
                                       name="model[price_type]" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">固定金额</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 text-left">
                        <label class=" col-form-label">一级名称</label>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input class="form-control" name="model[first_name]"
                                   value="<?= $list->first_name ? $list->first_name : "一级" ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 text-left">
                        <label class=" col-form-label required">一级佣金</label>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input class="form-control" type="number" name="model[first]" min="0"
                                   value="<?= $list->first ? $list->first : 0 ?>">
                            <span class="input-group-addon percent"><?= $list->price_type == 0 ? '%' : '元' ?></span>
                        </div>
                    </div>
                </div>
                <?php if ($list->level > 1): ?>
                    <div class="form-group row">
                        <div class="col-1 text-left">
                            <label class=" col-form-label">二级名称</label>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <input class="form-control" name="model[second_name]"
                                       value="<?= $list->second_name ? $list->second_name : "二级" ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-1 text-left">
                            <label class=" col-form-label required">二级佣金</label>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <input class="form-control" type="number" name="model[second]" min="0"
                                       value="<?= $list->second ? $list->second : 0 ?>">
                                <span class="input-group-addon percent"><?= $list->price_type == 0 ? '%' : '元' ?></span>
                            </div>
                        </div>
                    </div>
                    <?php if ($list->level > 2): ?>
                        <div class="form-group row">
                            <div class="col-1 text-left">
                                <label class=" col-form-label">三级名称</label>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <input class="form-control" name="model[third_name]"
                                           value="<?= $list->third_name ? $list->third_name : "三级" ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1 text-left">
                                <label class=" col-form-label required">三级佣金</label>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <input class="form-control" type="number" name="model[third]" min="0"
                                           value="<?= $list->third ? $list->third : 0 ?>">
                                    <span class="input-group-addon percent"><?= $list->price_type == 0 ? '%' : '元' ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


                <!-- <div class="form-group row">
                    <div class="col-4 offset-sm-3">
                        <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                        <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                        <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                    </div>
                </div> -->
            <?php endif; ?>
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
    $(document).on('click','.price_type',function(){
        var price_type = $(this).children('input');
        if($(price_type).val() == 1){
            $('.percent').html('元');
        }else{
            $('.percent').html('%');
        }
    });
</script>