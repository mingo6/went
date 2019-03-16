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
$this->title = '用户管理';
$this->params['active_nav_group'] = 4;
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
    <form class="form">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/order/index']) ?>">我的商城</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7">
            <div class="dropdown float-left">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if (isset($_GET['level'])): ?>
                        <?php foreach ($level_list as $index => $value): ?>
                            <?php if ($value['level'] == $_GET['level']): ?>
                                <?= $value['name']; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        全部类型
                    <?php endif; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                     style="max-height: 200px;overflow-y: auto">
                    <a class="dropdown-item" href="<?= $urlManager->createUrl(['mch/user/index']) ?>">全部会员</a>
                    <?php foreach ($level_list as $index => $value): ?>
                        <a class="dropdown-item"
                           href="<?= $urlManager->createUrl(array_merge(['mch/user/index'], $_GET, ['level' => $value['level'], 'page' => 1])) ?>"><?= $value['name'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="float-right mb-4">
                <form method="get">

                    <?php $_s = ['keyword'] ?>
                    <?php foreach ($_GET as $_gi => $_gv):if (in_array($_gi, $_s)) continue; ?>
                        <input type="hidden" name="<?= $_gi ?>" value="<?= $_gv ?>">
                    <?php endforeach; ?>

                    <div class="input-group">
                        <input class="form-control"
                               placeholder="微信昵称"
                               name="keyword"
                               autocomplete="off"
                               value="<?= isset($_GET['keyword']) ? trim($_GET['keyword']) : null ?>">
                            <span class="input-group-btn">
                            <button class="btn btn-orange">搜索</button>
                        </span>
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>头像</th>
                    <th>昵称</th>
                    <th>加入时间</th>
                    <th>身份</th>
                    <th>订单数</th>
                    <th>优惠券数量</th>
                    <th>卡券数量</th>
                    <th>当前余额</th>
                    <th>当前积分</th>
                    <th>操作</th>
                </tr>
                </thead>
                <?php foreach ($list as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td>
                            <img src="<?= $u['avatar_url'] ?>" style="width: 34px;height: 34px;margin: -.6rem 0;">
                        </td>
                        <td><?= $u['nickname']; ?></td>
                        <td><?= date('Y-m-d H:i:s', $u['addtime']) ?></td>
                        <td>
                            <?= $u['l_name'] ? $u['l_name'] : '普通用户' ?>
                            <?= $u['is_clerk'] == 1 ? "（核销员）" : "" ?>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-link"
                               href="<?= $urlManager->createUrl(['mch/order/index', 'user_id' => $u['id']]) ?>"><?= User::getCount($u['id']) ?></a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-link"
                               href="<?= $urlManager->createUrl(['mch/user/coupon', 'user_id' => $u['id']]) ?>"><?= User::getCouponcount($u['id']) ?></a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-link"
                               href="<?= $urlManager->createUrl(['mch/user/card', 'user_id' => $u['id']]) ?>"><?= User::getCardCount($u['id']) ?></a>
                        </td>
                        
                        <td>
                            <a class="btn btn-sm btn-link"><?= $u['balance']?></a>
                        </td>
                        
                        <td>
                            <a class="btn btn-sm btn-link"
                               href="<?= $urlManager->createUrl(['mch/user/rechange-log', 'user_id' => $u['id']]) ?>"><?= $u['integral']?></a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="<?= $urlManager->createUrl(['mch/user/edit', 'id' => $u['id']]) ?>">编辑</a>
                            <a class="btn btn-sm btn-success rechangeBtn"
                               data-toggle="modal" data-target="#attrAddModal"
                               href="javascript:;"
                               data-integral="<?= $u['integral'] ?>"
                               data-id="<?= $u['id'] ?>">充值积分</a>

                            <a class="btn btn-sm btn-success rechangeBalanceBtn"
                               data-toggle="modal" data-target="#attrBalance"
                               href="javascript:;"
                               data-balance="<?= $u['balance'] ?>"
                               data-id="<?= $u['id'] ?>">充值余额</a>
                        </td>
                        <!--
                        <td>
                            <a class="btn btn-sm btn-danger del" href="javascript:"
                               data-url="<?= $urlManager->createUrl(['mch/user/del', 'id' => $u['id']]) ?>"
                               data-content="是否删除？">删除</a>
                        </td>
                        -->
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
<!-- 充值积分 -->
<div class="modal fade" id="attrAddModal" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">充值积分</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group short-row">
                    <label class="custom-control custom-radio">
                        <input value="1" checked name="rechangeType" type="radio" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">充值</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input value="2" name="rechangeType" type="radio" class="custom-control-input integral-reduce">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">扣除</span>
                    </label>
                </div>

                <input class="form-control" id="integral" placeholder="请填写充值积分" value="0">
                <input type="hidden" id="user_id" value="">
                <div class="form-error text-danger mt-3 rechange-error" style="display: none">ddd</div>
                <div class="form-success text-success mt-3" style="display: none">sss</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary save-rechange">提交</button>
            </div>
        </div>
    </div>
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
                                title: res.msg
                            });
                        }
                    }
                });
            }
        });
        return false;
    });
    $(document).on('click', '.rechangeBtn', function () {
        var a = $(this);
        var id = a.data('id');
        var integral = a.data('integral');
        $('#user_id').val(id);
        $('.integral-reduce').attr('data-integral',integral);
        $('.integral-reduce').data('integral',integral);
        $('#integral').val(integral);
    });
    $(document).on('change', '.integral-reduce', function () {
        $('#integral').val($(this).data('integral'));
    });
    $(document).on('click', '.save-rechange', function () {
        var user_id = $('#user_id').val();
        var integral = $('#integral').val();
        var oldIntegral = $('.integral-reduce').data('integral');
        var rechangeType = $("input[name='rechangeType']:checked").val();
        if (rechangeType == '2'){
            if (integral > oldIntegral){
                $('.rechange-error').css('display','block');
                $('.rechange-error').text('当前用户积分不足');
                return;
            }
        }
        if(!integral || integral<= 0){
            $('.rechange-error').css('display','block');
            $('.rechange-error').text('请填写积分');
            return;
        }
        $.ajax({
            url: "<?= Yii::$app->urlManager->createUrl(['mch/user/rechange']) ?>",
            type: 'post',
            dataType: 'json',
            data:{user_id:user_id,integral:integral,_csrf:_csrf,rechangeType:rechangeType},
            success: function (res) {
                if (res.code == 0) {
                    window.location.reload();
                } else {
                    $('.rechange-error').css('display','block');
                    $('.rechange-error').text(res.msg);
                }
            }
        });
    });


</script>

























<!-- 充值余额 -->
<div class="modal fade show" id="attrBalance" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">充值金额</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group short-row">
                    <label class="custom-control custom-radio">
                        <input value="1" checked name="rechangeBalanceType" type="radio" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">充值</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input value="2" name="rechangeBalanceType" type="radio" class="custom-control-input balance-reduce">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">扣除</span>
                    </label>
                </div>

                <input class="form-control" id="balance" placeholder="请填写金额" value="0">
                <input type="hidden" id="u_id" value="">
                <div class="form-error text-danger mt-3 rechangeBalance-error" style="display: none">ddd</div>
                <div class="form-success text-success mt-3" style="display: none">sss</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary save-rechangeBalance">提交</button>
            </div>
        </div>
    </div>

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
                                title: res.msg
                            });
                        }
                    }
                });
            }
        });
        return false;
    });
    $(document).on('click', '.rechangeBalanceBtn', function () {
        var id = '';
        var balance = '';
        var a = $(this);
        var id = a.data('id');
        var balance = a.data('balance');
        $('#u_id').val(id);
      // $('.balance-reduce').attr('data-balance',balance);
        $('.balance-reduce').data('balance',balance)
        $('#balance').val(balance);
    });
    $(document).on('change', '.balance-reduce', function () {
        $('#balance').val($(this).data('balance'));
    });
    $(document).on('click', '.save-rechangeBalance', function () {
        var user_id = $('#u_id').val();
        var balance = $('#balance').val();
        var oldBalance = $('.balance-reduce').data('balance');
        var rechangeType = $("input[name='rechangeBalanceType']:checked").val();
        if (rechangeType == '2'){
            if (balance > oldBalance){
                $('.rechangeBalance-error').css('display','block');
                $('.rechangeBalance-error').text('当前用户余额不足');
                return;
            }
        }
        if(!balance || balance<= 0){
            $('.rechangeBalance-error').css('display','block');
            $('.rechangeBalance-error').text('请填写金额');
            return;
        }

        //return false;
        $.ajax({
            url: "<?= Yii::$app->urlManager->createUrl(['mch/user/rechangebalance']) ?>",
            type: 'post',
            dataType: 'json',
            data:{user_id:user_id,balance:balance,_csrf:_csrf,rechangeType:rechangeType},
            success: function (res) {
                if (res.code == 0) {
                    window.location.reload();
                } else {
                    $('.rechangeBalance-error').css('display','block');
                    $('.rechangeBalance-error').text(res.msg);
                }
            }
        });
    });


</script>