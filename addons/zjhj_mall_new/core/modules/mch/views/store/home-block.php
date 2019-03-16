<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 * @var \yii\web\View $this
 */
$urlManager = Yii::$app->urlManager;
$this->title = '首页板块';
$this->params['active_nav_group'] = 1;
?>
<style>


</style>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
            <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <form class="form border-b-l border-b-r" style="overflow: hidden;">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
                        <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg">
            <!-- <a class="mb-3" href="<?= $urlManager->createUrl(['mch/store/home-block-edit']) ?>">
                <button class="btn btn-orange mt-4 mb-5" style="padding: 0.7rem 4rem">添加板块</button>
            </a> -->
            <a class="btn btn-orange mt-4 mb-5" style="padding: 0.7rem 4rem" href="<?= $urlManager->createUrl(['mch/store/home-block-edit']) ?>">添加板块</a>
            <table class="table table-bordered bg-white">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>板块名称</th>
                    <th style="width: 14rem;">操作</th>
                </tr>
                </thead>
                <?php foreach ($list as $item): ?>
                    <tr>
                        <td><?= $item->id ?></td>
                        <td><?= $item->name ?></td>
                        <td>
                            <a class="btn btn-sm btn-default" style="padding: 0; color: #EE7B3B"
                               href="<?= $urlManager->createUrl(['mch/store/home-block-edit', 'id' => $item->id]) ?>">编辑</a>
                            <a class="btn btn-sm btn-default delete-confirm"
                               href="<?= $urlManager->createUrl(['mch/store/home-block-delete', 'id' => $item->id]) ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </form>
</div>
<script>
    $(document).on("click", ".delete-confirm", function () {
        var url = $(this).attr("href");
        $.myConfirm({
            content: "确认删除？",
            confirm: function () {
                $.myLoading();
                $.ajax({
                    url: url,
                    dataType: "json",
                    success: function (res) {
                        if (res.code == 0) {
                            location.reload();
                        } else {
                            $.myLoadingHide();
                            $.myAlert({
                                content: res.msg,
                            });
                        }
                    }
                });
            },
        });
        return false;
    });
</script>