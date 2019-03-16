<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/29
 * Time: 14:15
 */
defined('YII_RUN') or exit('Access Denied');


use yii\widgets\LinkPager;

/* @var \app\models\User $user */

$urlManager = Yii::$app->urlManager;
$statics = Yii::$app->request->baseUrl . '/statics';
$this->title = '订单详情';
$this->params['active_nav_group'] = 3;
?>
<style>
    tr > td:first-child {
        text-align: right;
        width: 200px;
    }
    tbody tr {
        border-top: 0;
    }
    .table td, .table th {
        padding: 0;
    }
</style>
<!-- <div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/order/index']) ?>">订单列表</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div> -->
<div class="main-body p-3">
    <form class="form">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/order/index']) ?>">订单列表</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7">
            <div class="row">
                <div class="col-6">
                    <div class="title-line mb-5">订单信息</div>
                    <div class="row">
                        <div class="col-3">订单号</div>
                        <div class="col-9"><?= $order['order_no'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3">下单时间</div>
                        <div class="col-9"><?= date('Y-m-d H:i', $order['addtime']) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3">支付方式</div>
                        <div class="col-9"><?= $order['pay_type'] == 1 ? "微信支付" : "" ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3">用户</div>
                        <div class="col-9"><?= $user['nickname'] ?></div>
                    </div>
                    <div class="title-line mb-5 mt-5">快递信息</div>
                    <div class="row">
                        <div class="col-3">快递公司</div>
                        <div class="col-9"><?= $order['express'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3">快递单号</div>
                        <div class="col-9"><?= $order['express_no'] ?></div>
                    </div>
                    <div class="title-line mb-5 mt-5">订单金额</div>
                    <div class="row">
                        <div class="col-3">总金额（含运费）</div>
                        <div class="col-9"><?= $order['total_price'] ?>元</div>
                    </div>
                    <div class="row">
                        <div class="col-3">运费</div>
                        <div class="col-9"><?= $order['express_price'] ?>元</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="title-line mb-5">订单状态</div>
                    <div class="row">
                        <div class="col-3">付款状态</div>
                        <div class="col-9">
                            <?php if ($order['is_pay'] == 1): ?>
                                <span class="badge badge-success">已付款</span>
                            <?php else: ?>
                                <span class="badge badge-default">未付款</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">发货状态</div>
                        <div class="col-9">
                            <?php if ($order['is_send'] == 1): ?>
                                <span class="badge badge-success">已发货</span>
                            <?php else: ?>
                                <span class="badge badge-default">未发货</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">收货状态</div>
                        <div class="col-9">
                            <?php if ($order['is_send'] == 1): ?>
                                <span class="badge badge-success">已发货</span>
                            <?php else: ?>
                                <span class="badge badge-default">未发货</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="title-line mb-5 mt-5">收货信息</div>
                    <div class="row">
                        <div class="col-3">收货人</div>
                        <div class="col-9"><?= $order['name'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3">电话</div>
                        <div class="col-9"><?= $order['mobile'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3">收货地址</div>
                        <div class="col-9"><?= $order['address'] ?></div>
                    </div>
                    <div class="title-line mb-5 mt-5">商品信息</div>
                    <div class="row">
                        <table class="table table-bordered">
                            <?php foreach ($goods_list as $index => $value): ?>
                                <tr>
                                    <td class="text-left">商品<?= $index + 1 ?></td>
                                    <td class="text-left">商品名</td>
                                    <td><?= $value['name'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">规格</td>
                                    <td>
                                        <div>
                                            <span class="text-danger">
                                                <?php $attr_list = json_decode($value['attr']); ?>
                                                <?php if (is_array($attr_list)):foreach ($attr_list as $attr): ?>
                                                    <span class="mr-3"><?= $attr->attr_group_name ?>
                                                        :<?= $attr->attr_name ?></span>
                                                <?php endforeach;;endif; ?>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">数量</td>
                                    <td><?= $value['num'] . $value['unit'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">小计</td>
                                    <td><?= $value['total_price'] ?>元</td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if ($order_form): ?>
                                <tr>
                                    <td colspan="3"
                                        class="text-center"><?= \app\models\Option::get('form_name', $order['store_id'], 'admin', '表单信息') ?></td>
                                </tr>
                                <?php foreach ($order_form as $k => $v): ?>
                                    <tr>
                                        <td><?= $v['key'] ?></td>
                                        <td colspan="2"><?= $v['value'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-left">备注</td>
                                    <td colspan="2"><?= $order['content'] ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>