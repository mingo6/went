<?php
defined('YII_RUN') or exit('Access Denied');

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/29
 * Time: 9:50
 */

use yii\widgets\LinkPager;

$urlManager = Yii::$app->urlManager;
$this->title = '商品等级列表';
$this->params['active_nav_group'] = 2;
?>
<style>
    table {
        table-layout: fixed;
    }

    th {
        text-align: center;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    td {
        text-align: center;
    }

    .ellipsis {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    td.nowrap {
        white-space: nowrap;
        overflow: hidden;
    }

    .goods-pic {
        width: 3rem;
        height: 3rem;
        display: inline-block;
        background-color: #ddd;
        background-size: cover;
        background-position: center;
    }
</style>

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
    <div class="mb-3 clearfix">
        <div class="float-left">
            <a href="<?= $urlManager->createUrl(['mch/goods-level/edit', 'goods_id' => Yii::$app->request->get('goods_id')]) ?>" class="btn btn-primary"><i class="iconfont icon-playlistadd"></i>添加商品等级</a>
        </div>
    </div>
    <table class="table table-bordered bg-white">
        <thead>
        <tr>
            <th style="text-align: left"><span><input type="checkbox" class="goods-all"></span>&nbsp;&nbsp;ID</th>
            <th>商品名称</th>
            <th>商品id</th>
            <th class="text-left">等级名称</th>
            <th>等级id</th>
            <th>操作</th>
        </tr>
        </thead>
        <col style="width: 10%">
        <col style="width: 7%">
        <col style="width: 19%">
        <col style="width: 8%">
        <col style="width: 8%">
        <col style="width: 13%">
        <tbody>
        <?php foreach ($list as $index => $item): ?>
            <tr>
                <td class="nowrap" style="text-align: left" data-toggle="tooltip"
                    data-placement="bottom" title="<?=$item['id']?>">
                    <span>
                        <input type="checkbox" class="goods-one" value="<?= $item['id'] ?>">
                    </span>&nbsp;&nbsp;<?= $item['id'] ?>
                </td>
                <td class="nowrap"><?= $item['goods_name'] ?></td>
                <td class="nowrap"><?= $item['goods_id'] ?></td>
                <td class="nowrap"><?= $item['level_name'] ?></td>
                <td class="nowrap"><?= $item['level_id'] ?></td>
                <td class="nowrap">
                    <a class="btn btn-sm btn-primary" href="<?= $urlManager->createUrl(['mch/goods-level/edit', 'id' => $item['id'], 'goods_id' => $item['goods_id']]) ?>">修改</a>
                    <a class="btn btn-sm btn-danger del" href="<?= $urlManager->createUrl(['mch/goods-level/del', 'id' => $item['id'], 'goods_id' => $item['goods_id']]) ?>">删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
    <nav aria-label="Page navigation example">
        <?php echo LinkPager::widget([
            'pagination' => $pagination,
            'prevPageLabel' => '上一页',
            'nextPageLabel' => '下一页',
            'firstPageLabel' => '首页',
            'lastPageLabel' => '尾页',
            'maxButtonCount' => 5,
            'options' => [
                'class' => 'pagination',
            ],
            'prevPageCssClass' => 'page-item',
            'pageCssClass' => "page-item",
            'nextPageCssClass' => 'page-item',
            'firstPageCssClass' => 'page-item',
            'lastPageCssClass' => 'page-item',
            'linkOptions' => [
                'class' => 'page-link',
            ],
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
        ])
        ?>
    </nav>
</div>
<script>
    $(document).on('click', '.del', function () {
        if (confirm("是否删除？")) {
            $.ajax({
                url: $(this).attr('href'),
                type: 'get',
                dataType: 'json',
                success: function (res) {
                    alert(res.msg);
                    if (res.code == 0) {
                        window.location.reload();
                    }
                }
            });
        }
        return false;
    });
</script>