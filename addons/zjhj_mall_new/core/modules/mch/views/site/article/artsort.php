<?php 
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
use \app\models\User;
$urlManager = Yii::$app->urlManager;
$this->title = '分类列表';
$this->params['active_nav_group'] = 15;
$this->params['is_book'] =2;
//var_dump($article);die;
?>

<!-- <div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
            <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div> -->

<div class="main-body p-3">
    
    <form class="form card auto-submit-form" method="post" autocomplete="off">
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
        <div class="form-body white-bg border-7">
            <p style="text-align:right;"><a href="<?= $urlManager->createUrl(['mch/site/article/sortedit']) ?>">添加分类</a></p>
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>分类</th>
                        <th>排序</th>
                        <th style="width: 180px;">操作</th>
                    </tr>
                </thead>

                <?php foreach ($artsort as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['name']; ?></td>
                        <td><?= $u['number']; ?></td>
                        <td style="width: 180px;">
                            <a class="btn btn-sm btn-orange"
                               href="<?= $urlManager->createUrl(['mch/site/article/sortedit', 'id' => $u['id']]) ?>">编辑</a>

                            <a class="btn btn-sm btn-orange" 
                            href="<?= $urlManager->createUrl(['mch/site/article/delartsort', 'id' => $u['id']]) ?>"
                            onclick="return confirm('是否删除？');"
                            >删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="text-center">
                <!-- <= \yii\widgets\LinkPager::widget(['pagination' => $pagination,]) ?> -->
                <div class="text-muted"><?= $pagination ?>条数据</div>
            </div>
        </div>
    </form>

    
</div>


