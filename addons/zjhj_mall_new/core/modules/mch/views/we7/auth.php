<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '权限管理';
$this->params['active_nav_group'] = 1;
$permission_count = count($permission_list);
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
    <form method="get" class="form">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-b-l border-b-r">
            <div class="row mb-3">
                <div class="col-3">
                    <?php foreach ($_GET as $name => $value):if (!in_array($name, ['keyword'])): ?>
                        <input type="hidden" name="<?= $name ?>" value="<?= $value ?>">
                    <?php endif; endforeach; ?>
                    <input placeholder="UID、用户名" class="form-control mr-3" name="keyword"
                           value="<?= \Yii::$app->request->get('keyword') ?>">
                </div>
                <div class="col-1"><button class="btn btn-orange">查找</button></div>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>UID</th>
                    <th>用户名</th>
                    <th>注册时间</th>
                    <th>权限</th>
                </tr>
                </thead>
                <?php foreach ($list as $item): ?>
                    <tr>
                        <td><?= $item['uid'] ?></td>
                        <td><?= $item['username'] ?></td>
                        <td><?= date('Y-m-d H:i', $item['joindate']) ?></td>
                        <td>
                            <?php if ($item['auth'] == null): ?>
                                <a href="javascript:" data-target="#auth_modal_<?= $item['uid'] ?>"
                                   data-toggle="modal"><?= $permission_count ?>/<?= $permission_count ?></a>
                            <?php else: ?>
                                <a href="javascript:" data-target="#auth_modal_<?= $item['uid'] ?>"
                                   data-toggle="modal"><?= count($item['auth']) ?>/<?= $permission_count ?></a>
                            <?php endif; ?>
                            <!-- Modal -->
                            <div class="modal fade" id="auth_modal_<?= $item['uid'] ?>" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">权限设置</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" class="auto-submit-form"
                                              data-return="<?= Yii::$app->request->absoluteUrl ?>">
                                            <div class="modal-body">
                                                <input type="hidden" name="we7_user_id" value="<?= $item['uid'] ?>">
                                                <p>
                                                    <span class="mr-3">UID:<?= $item['uid'] ?></span>
                                                    <span>用户名:<?= $item['username'] ?></span>
                                                </p>
                                                <?php foreach ($permission_list as $permission): ?>
                                                    <label class="custom-control custom-checkbox mr-5 mb-3">
                                                        <input type="checkbox"
                                                               name="auth[]"
                                                               value="<?= $permission->name ?>"
                                                            <?= ($item['auth'] == null || in_array($permission->name, $item['auth'])) ? 'checked' : null ?>
                                                               class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description"><?= $permission->display_name ?></span>
                                                    </label>
                                                <?php endforeach; ?>
                                                <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                                                <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:" class="btn btn-secondary" data-dismiss="modal">取消</a>
                                                <button class="btn btn-primary submit-btn">保存</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </form>
    

    <nav aria-label="Page navigation example">
        <?php echo \yii\widgets\LinkPager::widget([
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
