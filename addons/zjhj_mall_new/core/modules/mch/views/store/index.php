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
$this->title = '我的商城';
$this->params['active_nav_group'] = 0;
?>
<style>
    .data-block {
        background: #fff;
        padding: 0 1.5rem;
        display: block;
        border-radius: .35rem;
        text-decoration: none;
        color: inherit;
        margin-bottom: 2rem;
        height: 8rem;
    }

    .data-block.block-big {
        height: 18rem;
    }

    .data-block > div {
        height: 100%;
    }

    .data-block .title {
        text-align: right;
    }

    .data-block .iconfont {
        font-size: 4rem;
    }

    .data-block .content {
        font-size: 1.5rem;
        margin-bottom: .5rem;
        text-align: right;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .data-block:hover {
        text-decoration: none;
        color: inherit;
    }

    .data-block.green {
        background: #1ab394;
        color: #fff !important;
    }

    .data-block.blue {
        background: rgb(35, 198, 200);;
        color: #fff !important;
    }
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

<div class="main-body pt-3 pb-5 pl-1 pr-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="col-xl-12 col-lg-12 main-nav row breadcrumb-wrapper" flex="cross:center dir:left box:first">
                    <div class="col-xl-12 col-lg-12 breadcrumb">
                        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                            <span style="margin-right: 1rem">位置：</span>
                            <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
                            <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
                        </nav>
                    </div>
                    <div class="col-xl-3 col-lg-3 income active">
                        <div class="nums"><?= $store_data['money']['day']?$store_data['money']['day']:0 ?></div>            
                        <div class="desc">
                            <div class="label">今日收入（元）</div>
                            <div><img src="/addons/zjhj_mall/core/web/statics/images/icon/day_income.png"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 income">
                        <div class="nums"><?= $store_data['money']['month']?$store_data['money']['month']:0 ?></div>            
                        <div class="desc">
                            <div class="label">本月收入（元）</div>
                            <div><img src="/addons/zjhj_mall/core/web/statics/images/icon/day_income.png"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 income">
                        <div class="nums"><?= $store_data['money']['all']?$store_data['money']['all']:0 ?></div>            
                        <div class="desc">
                            <div class="label">总收入（元）</div>
                            <div><img src="/addons/zjhj_mall/core/web/statics/images/icon/day_income.png"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 income">
                        <?php
                        $refuse_1 = $store_data['money']['refuse_1']?$store_data['money']['refuse_1']:0;
                        $refuse_2 = $store_data['money']['refuse_2']?$store_data['money']['refuse_2']:0;
                        ?>
                        <div class="nums"><?= $refuse_1+$refuse_2 ?></div>            
                        <div class="desc">
                            <div class="label">总退款（元）</div>
                            <div><img src="/addons/zjhj_mall/core/web/statics/images/icon/day_income.png"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 总订单数据 -->
            <div class="col-xl-5 col-lg-5 today-order">
                <div>
                    <div class="order-class">
                        <div class="title-line">今日订单</div>
                        <div>笔</div>
                    </div>
                    <div class="nums"><?= $store_data['all_count']['1day'] ?></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 week-month-order">
                <div class="week">
                    <div class="order-class">
                        <div class="ver-m"><span class="number">7</span><span class="title-line">日订单</span></div>
                        <div>笔</div>
                    </div>
                    <div class="nums"><?= $store_data['all_count']['7day'] ?></div>
                </div>
                <div class="month">
                    <div class="order-class">
                        <div class="ver-m"><span class="number">30</span><span class="title-line">日订单</span></div>
                        <div>笔</div>
                    </div>
                    <div class="nums"><?= $store_data['all_count']['30day'] ?></div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 all-order">
                <div>
                    <div class="order-class">
                        <div class="title-line">总订单量</div>
                        <div>笔</div>
                    </div>
                    <div class="nums"><?= $store_data['all_count']['all'] ?></div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3">
                <a href="<?= $urlManager->createUrl(['mch/order/index', 'status' => 0]) ?>">
                    <div class="order-status">
                        <div class="title-line">未支付订单</div>
                        <div class="order-status-nums" style="color: #FF5F61"><?= $store_data['status_count']['status_0'] ?></div>
                        <div class="order-link"><img src="/addons/zjhj_mall/core/web/statics/images/icon/arror_right.png"></div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-3">
                <a href="<?= $urlManager->createUrl(['mch/order/index', 'status' => 1]) ?>">
                    <div class="order-status">
                        <div class="title-line">待发订单</div>
                        <div class="order-status-nums" style="color: #8FE256"><?= $store_data['status_count']['status_1'] ?></div>
                        <div class="order-link"><img src="/addons/zjhj_mall/core/web/statics/images/icon/arror_right.png"></div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-3">
                <a href="<?= $urlManager->createUrl(['mch/order/index', 'status' => 2]) ?>">
                    <div class="order-status">
                        <div class="title-line">待收货订单</div>
                        <div class="order-status-nums" style="color: #E9D042"><?= $store_data['status_count']['status_2'] ?></div>
                        <div class="order-link"><img src="/addons/zjhj_mall/core/web/statics/images/icon/arror_right.png"></div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-3">
                <a href="<?= $urlManager->createUrl(['mch/order/index', 'status' => 3]) ?>">
                    <div class="order-status">
                        <div class="title-line">已完成订单</div>
                        <div class="order-status-nums" style="color: #76BEFF"><?= $store_data['status_count']['status_3'] ?></div>
                        <div class="order-link"><img src="/addons/zjhj_mall/core/web/statics/images/icon/arror_right.png"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>