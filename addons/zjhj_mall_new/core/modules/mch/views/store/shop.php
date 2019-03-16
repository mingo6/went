<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 16:41
 */
defined('YII_RUN') or exit('Access Denied');
$urlManager = Yii::$app->urlManager;
$this->title = '门店设置';
$this->params['active_nav_group'] = 1;
?>

<script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77"></script>
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
            <div class="float-left pt-2 mb-4">
                <a class="btn btn-orange mt-4 mb-5" style="padding: 0.7rem 4rem" href="<?=$urlManager->createUrl(['mch/store/shop-edit'])?>">添加门店</a>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>门店名称</th>
                    <th>联系方式</th>
                    <th>门店地址</th>
                    <th>经纬度</th>
                    <th>核销订单</th>
                    <th>核销卡券</th>
                    <th style="width: 14rem;">操作</th>
                </tr>
                </thead>
                <?php foreach ($list as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['mobile'] ?></td>
                        <td><?= $item['address'] ?></td>
                        <td>
                            <?php if ($item['longitude']): ?>
                                <?= "(".$item['longitude'].",".$item['latitude'].")" ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= $urlManager->createUrl(['mch/order/index', 'shop_id' => $item['id']]) ?>"><?= $item['order_count'] ?></a>
                        </td>
                        <td>
                            <a href="<?= $urlManager->createUrl(['mch/user/card', 'shop_id' => $item['id']]) ?>"><?=$item['card_count']?></a>
                        </td>
                        <td>
                            <a class="btn btn-default btn-sm"
                               href="<?= $urlManager->createUrl(['mch/store/shop-edit', 'id' => $item['id']]) ?>">修改</a>
                            <a class="btn btn-default btn-sm del" href="javascript:"
                               data-url="<?= $urlManager->createUrl(['mch/store/shop-del', 'id' => $item['id']]) ?>"
                               data-content="是否删除？">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="text-center">
                <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination,]) ?>
                <div class="text-muted"><?= $row_count ?>条数据</div>
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
                                title: "提示",
                                content: res.msg
                            });
                        }
                    }
                });
            }
        });
        return false;
    });
</script>