<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/25
 * Time: 9:24
 */
defined('YII_RUN') or exit('Access Denied');
use yii\widgets\LinkPager;


$urlManager = Yii::$app->urlManager;
$this->title = '卡券管理';
$this->params['active_nav_group'] = 12;
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
    <a class="btn btn-primary mb-3" href="<?= $urlManager->createUrl(['mch/card/edit']) ?>">添加卡券</a>
    <div class=" bg-white" style="max-width: 70rem">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>卡券名称</td>
                <td>卡券信息</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
            </thead>
            <col style="width: 10%;">
            <col style="width: 20%;">
            <col style="width: 35%;">
            <col style="width: 20%;">
            <col style="width: 15%;">
            <tbody>
            <?php foreach ($list as $index => $value): ?>
                <tr>
                    <td><?= $value['id']; ?></td>
                    <td><?= $value['name']; ?></td>
                    <td>
                        <div class="info p-2" style="border: 1px solid #ddd;">
                            <div flex="dir:left box:first">
                                <div class="mr-4" data-responsive="88:88" style="width:44px;
                                    background-image: url(<?= $value['pic_url'] ?>);background-size: cover;
                                    background-position: center;border-radius: 88px;"></div>
                                <div flex="dir:left cross:center"><?= $value['content'] ?></div>
                            </div>
                        </div>
                    </td>
                    <td><?= date('Y-m-d H:i:s', $value['addtime']); ?></td>
                    <td>
                        <a class="btn btn-sm btn-primary"
                           href="<?= $urlManager->createUrl(['mch/card/edit', 'id' => $value['id']]) ?>">编辑</a>
                        <a class="btn btn-sm btn-danger del" href="javascript:"
                           data-content="是否删除？"
                           data-url="<?= $urlManager->createUrl(['mch/card/del', 'id' => $value['id']]) ?>">删除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).on("click", ".del", function () {
        var a = $(this);
        $.myConfirm({
            content: a.data('content'),
            confirm: function () {
                $.myLoading();
                $.ajax({
                    url: a.data('url'),
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
