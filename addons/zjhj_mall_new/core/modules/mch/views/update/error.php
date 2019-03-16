<?php
defined('YII_RUN') or exit('Access Denied');

use yii\widgets\LinkPager;

$urlManager = Yii::$app->urlManager;
$this->title = '系统更新';
$this->params['active_nav_group'] = 1;
?>
<style>
    .alert {
        border-radius: .15rem;
    }

    .alert-primary {
        color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
    }

    .alert-secondary {
        color: #464a4e;
        background-color: #e7e8ea;
        border-color: #dddfe2;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-dark {
        color: #1b1e21;
        background-color: #d6d8d9;
        border-color: #c6c8ca;
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
    <div style="max-width: 60rem">
        <div class="alert alert-dark p-3" role="alert">当前系统版本：<b>v1.9.6.4</b></div>

        
            <div class="alert alert-secondary p-3">&#26356;&#26032;&#35831;&#19982;&#26131;&#31119;&#28304;&#30721;&#32593;&#32852;&#31995;&#32;&#119;&#119;&#119;&#46;&#101;&#102;&#119;&#119;&#119;&#46;&#99;&#111;&#109;</div>
        
    </div>
</div>

