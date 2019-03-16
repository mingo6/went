<?php
defined('YII_RUN') or exit('Access Denied');

use app\models\AdminPermission;

/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 * @var \yii\web\View $this
 * @var \app\models\Admin $admin
 */
$urlManager = Yii::$app->urlManager;
$this->params['active_nav_group'] = isset($this->params['active_nav_group']) ? $this->params['active_nav_group'] : 0;
$version = '1.9.6';
$is_auth = Yii::$app->cache->get('IS_AUTH');

$admin = null;
$admin_permission_list = [];
if (!Yii::$app->admin->isGuest) {
    $admin = Yii::$app->admin->identity;
    $admin_permission_list = json_decode($admin->permission, true);
    if (!$admin_permission_list)
        $admin_permission_list = [];
}
try {
    $plugin_list = \app\hejiang\CloudPlugin::getInstalledPluginList();
} catch (Exception $e) {
    $plugin_list = [];
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <title><?= $this->title ?></title>
    <!--<link href="//at.alicdn.com/t/font_353057_w3af8teugy1u4n29.css" rel="stylesheet">-->
    <!--<link href="//at.alicdn.com/t/font_353057_k9axrf5jg8ccjtt9.css" rel="stylesheet">-->
    <link href="//at.alicdn.com/t/font_353057_azaq4fse2fl2fbt9.css" rel="stylesheet">
    <link href="//at.alicdn.com/t/font_353057_h7xlg5vw5qaor.css" data-desc="v2" rel="stylesheet">
    <link href="//cdn.bootcss.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl ?>/statics/css/common.css?version=<?= $version ?>" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl ?>/statics/css/flex.css?version=<?= $version ?>" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl ?>/statics/mch/css/common.css?version=<?= $version ?>" rel="stylesheet">
    <!-- 新版 css -->
    <link href="<?= Yii::$app->request->baseUrl ?>/statics/css/repaint.css?version=<?= $version ?>" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl ?>/statics/css/main_public.css?version=<?= $version ?>" rel="stylesheet">

    <style>
        body > .sidebar-tow {
            left: 15rem;
            position: fixed;
            top: 4.52rem;
            bottom: 0;
            height: 100%;
            width: 10.9rem;
            overflow: hidden;
            background: #fff;
            border-right: 1px solid rgba(0, 0, 0, .125);
        }

        /* <?php if ($this->params['is_group']=='1' || $this->params['is_book']==1): ?>
        .sidebar ~ .main {
            padding-left: 26.5rem;
        }
        
        <?php endif; ?>
        <?php if ($this->params['is_book']==2): ?>
        .sidebar ~ .main {
            padding-left: 26.5rem;
        } */

        <?php endif; ?>
        body > .sidebar-tow .sidebar-nav {
            width: 12rem;
        }

        body > .sidebar-tow .nav-group a {
            color: #333333;
            padding: .75rem 1rem;
        }

        body > .sidebar-tow .nav-group.active > a {
            background: #fff;
            color: #333333;
        }

        body > .sidebar-tow .sub-nav-list {
            background: #fff;
        }

        body > .sidebar-tow .sub-nav-list a {
            color: #7c838a;
        }

        body > .sidebar-tow .nav-group a .iconfont {
            color: #333333;
        }

        body > .sidebar-tow .nav-group > a:hover {
            color: #333333;
        }

        body > .sidebar-tow .sub-nav-list a:hover {
            color: #333333;
        }

        body > .sidebar .sidebar-logo {
            color: #333333;
            padding: 1rem 1rem;
        }

        body > .sidebar-tow .sidebar-logo a {
            display: block;
            text-align: center;
            background: transparent;
            border-radius: .5rem;
            height: 2.5rem;
            line-height: 2.5rem;
            padding: 0 .75rem;
            transition: 250ms color;
            color: #333333;
        }

        body > .sidebar-tow .sidebar-logo a:hover {
            color: #333333;
        }
    </style>
    <script>var _csrf = "<?=Yii::$app->request->csrfToken?>";</script>
    <script>var _upload_url = "<?=Yii::$app->urlManager->createUrl(['upload/file'])?>";</script>
    <script>var _upload_file_list_url = "<?=Yii::$app->urlManager->createUrl(['mch/store/upload-file-list'])?>";</script>
    <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-1.11.1.min.js"></script>
    <?php if (empty($this->params['isSiteTemp'])){ ?>
        <script src="//cdn.bootcss.com/vue/2.3.4/vue.js"></script>
        <script src="//cdn.bootcss.com/tether/1.4.0/js/tether.min.js"></script>
        <script src="//cdn.bootcss.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
        <script src="//cdn.bootcss.com/plupload/2.3.0/plupload.full.min.js"></script>
        <script src="<?= Yii::$app->request->baseUrl ?>/statics/js/common.js?version=<?= $version ?>"></script>
        <script src="<?= Yii::$app->request->baseUrl ?>/statics/mch/js/common.v2.js?version=<?= $version ?>"></script>
        <script src="https://cdn.bootcss.com/clipboard.js/1.7.1/clipboard.js"></script>
        <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/mch/vendor/layer/layer.js"></script>
        <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/mch/vendor/laydate/laydate.js"></script>
    <?php }else{ ?>
    <?php } ?>
    
</head>
<body>
<?php if (empty($this->params['isSiteTemp'])){ ?>
    <?= $this->render('/components/pick-file.php') ?>
    <?= $this->render('/components/pick-link.php') ?>
<?php } ?>
<div class="sidebar">
    <div class="sidebar-nav">
        <div class="sidebar-logo" style="">
            <!-- <a class="text-overflow-ellipsis"
               href="<?= $urlManager->createUrl(['mch/store']) ?>"><?= $this->context->store->name ?></a>
            <div style="font-size: .85rem;color: #bbb;display: none">
                <a href="http://cloud.zjhejiang.com/we7/mall/" target="_blank">商城</a>
                <span>v<?= $this->context->version ?></span>
            </div> -->
            </div>
        <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_1.png">商城管理</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/store/setting']) ?>">商城设置</a>
                <a href="<?= $urlManager->createUrl(['mch/store/home-page']) ?>">首页排版</a>
                <a href="<?= $urlManager->createUrl(['mch/store/home-block']) ?>">自定义板块</a>
                <a href="<?= $urlManager->createUrl(['mch/store/form']) ?>">自定义表单</a>
                <a href="<?= $urlManager->createUrl(['mch/store/shop']) ?>">门店设置</a>
                <a href="<?= $urlManager->createUrl(['mch/store/sms']) ?>">短信设置</a>
                <a href="<?= $urlManager->createUrl(['mch/store/mail']) ?>">邮件设置</a>
                <a href="<?= $urlManager->createUrl(['mch/store/tpl-msg']) ?>">通知设置</a>
                <?php if ($this->context->is_admin): ?>
                    <a href="<?= $urlManager->createUrl(['mch/store/upload']) ?>">上传设置</a>
                <?php endif; ?>
                <a href="<?= $urlManager->createUrl(['mch/store/express']) ?>">面单打印设置</a>
                <a href="<?= $urlManager->createUrl(['mch/store/slide']) ?>">轮播图</a>
                <a href="<?= $urlManager->createUrl(['mch/store/home-nav']) ?>">导航图标</a>
                <a href="<?= $urlManager->createUrl(['mch/store/user-center']) ?>">用户中心</a>
                <a href="<?= $urlManager->createUrl(['mch/store/postage-rules']) ?>">运费规则</a>
                <a href="<?= $urlManager->createUrl(['mch/store/wxapp']) ?>">小程序发布</a>
                <?php if ($this->context->is_admin): ?>
                    <a href="<?= $urlManager->createUrl(['mch/update/index']) ?>">系统更新</a>
                    <a href="<?= $urlManager->createUrl(['mch/patch/index']) ?>">补丁区</a>
                    <a href="<?= $urlManager->createUrl(['mch/cache/index']) ?>">清除缓存</a>
                <?php endif; ?>
                <?php if ($this->context->is_admin && $this->context->is_we7): ?>
                    <a href="<?= $urlManager->createUrl(['mch/we7/auth']) ?>">权限管理</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="nav-group <?= $this->params['active_nav_group'] == 11 ? 'active' : null ?>">
            <!-- <a href="<?= $urlManager->createUrl(['mch/store/navbar']) ?>"><i class="iconfont icon-caidan"></i>导航设置</a> -->
            <a href="<?= $urlManager->createUrl(['mch/store/navbar']) ?>"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_2.png">导航设置</a>
        </div>
        <div class="nav-group <?= $this->params['active_nav_group'] == 2 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-goods"></i>商品管理</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_3.png"></i>商品管理</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/store/cat']) ?>">商品分类</a>
                <a href="<?= $urlManager->createUrl(['mch/store/attr']) ?>">商品规格</a>
                <a href="<?= $urlManager->createUrl(['mch/goods/goods']) ?>">商品列表</a>
            </div>
        </div>
        <div <?= ($admin && !in_array('coupon', $admin_permission_list)) ? 'hidden' : null ?>
                class="nav-group <?= $this->params['active_nav_group'] == 7 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-qian1"></i>优惠券管理</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_4.png"></i>优惠券管理</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/coupon/index']) ?>">优惠券列表</a>
                <a href="<?= $urlManager->createUrl(['mch/coupon/auto-send']) ?>">优惠券自动发放</a>
            </div>
        </div>

        <div class="nav-group <?= $this->params['active_nav_group'] == 12 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-dingdan"></i>卡券管理</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_5.png">卡券管理</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/card/index']) ?>">卡券列表</a>
            </div>
        </div>
        <div class="nav-group <?= $this->params['active_nav_group'] == 3 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-dingdan"></i>订单管理</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_6.png">订单管理</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/order/index']) ?>">订单列表</a>
                <a href="<?= $urlManager->createUrl(['mch/order/index', 'is_offline' => 1]) ?>">自提订单</a>
                <a href="<?= $urlManager->createUrl(['mch/order/refund']) ?>">售后订单</a>
                <a href="<?= $urlManager->createUrl(['mch/comment/index']) ?>">评价管理</a>
            </div>
        </div>
        <div class="nav-group <?= $this->params['active_nav_group'] == 4 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-person"></i>用户管理</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_7.png">用户管理</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/user/index']) ?>">会员列表</a>
                <a href="<?= $urlManager->createUrl(['mch/user/clerk']) ?>">核销员列表</a>
                <a href="<?= $urlManager->createUrl(['mch/user/coupon']) ?>">优惠券列表</a>
                <a href="<?= $urlManager->createUrl(['mch/user/level']) ?>">会员等级</a>
                <a href="<?= $urlManager->createUrl(['mch/user/card']) ?>">卡券列表</a>
            </div>
        </div>
        <div <?= ($admin && !in_array('share', $admin_permission_list)) ? 'hidden' : null ?>
                class="nav-group <?= $this->params['active_nav_group'] == 5 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-fenxiao"></i>分销商管理</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_8.png">分销商管理</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/share/index']) ?>">分销商列表</a>
                <a href="<?= $urlManager->createUrl(['mch/share/order']) ?>">分销订单</a>
                <a href="<?= $urlManager->createUrl(['mch/share/cash']) ?>">提现列表</a>
                <a href="<?= $urlManager->createUrl(['mch/share/setting']) ?>">佣金设置</a>
                <a href="<?= $urlManager->createUrl(['mch/share/basic']) ?>">基础设置</a>
            </div>
        </div>
        <div class="nav-group <?= $this->params['active_nav_group'] == 6 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-wenzhang"></i>系统文章</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_9.png">系统文章</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/article/index', 'cat_id' => '1']) ?>">关于我们</a>
                <a href="<?= $urlManager->createUrl(['mch/article/index', 'cat_id' => '2']) ?>">服务中心</a>
            </div>
        </div>
        <div <?= ($admin && !in_array('topic', $admin_permission_list)) ? 'hidden' : null ?>
                class="nav-group <?= $this->params['active_nav_group'] == 8 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-zhuanticehua"></i>专题</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_10.png">专题</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/topic/index', 'cat_id' => '1']) ?>">专题管理</a>
            </div>
        </div>
        <div <?= ($admin && !in_array('video', $admin_permission_list)) ? 'hidden' : null ?>
                class="nav-group <?= $this->params['active_nav_group'] == 9 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-video1"></i>视频专区</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_11.png">视频专区</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/store/video']) ?>">视频管理</a>
            </div>
        </div>
        <div class="nav-group <?= $this->params['active_nav_group'] == 13 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-video1"></i>小票打印机</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_12.png">小票打印机</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/printer/list']) ?>">打印机管理</a>
                <a href="<?= $urlManager->createUrl(['mch/printer/setting']) ?>">打印设置</a>
            </div>
        </div>
        <div class="nav-group <?= $this->params['active_nav_group'] == 14 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-video1"></i>数据统计</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_13.png">数据统计</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/data/goods']) ?>">销售排行</a>
                <a href="<?= $urlManager->createUrl(['mch/data/user']) ?>">用户消费排行</a>
            </div>
        </div>
        <div class="nav-group <?= $this->params['active_nav_group'] == 10 ? 'active' : null ?>">
            <!-- <a href="javascript:"><i class="iconfont icon-plugin_icon"></i>插件专区</a> -->
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_14.png">插件专区</a>
            <div class="sub-nav-list">
                <?php if ($this->context->is_admin): ?>
                    <a href="<?= $urlManager->createUrl(['mch/plugin/index']) ?>">安装插件</a>
                <?php endif; ?>
                <?php $display_plugin_count = 0; ?>
                <?php foreach ($plugin_list as $k => $item): ?>
                    <?php if (!($admin && !in_array($item['name'], $admin_permission_list))) $display_plugin_count++; ?>
                        <div class="nav-group-second  <?= ($admin && !in_array($item['name'], $admin_permission_list)) ? 'acitve' : null ?>">
                            <a href="javascript:"><?= $item['value']['display_name'] ?></a>
                            <div class="sub-nav-list">
                                <a href="<?= $urlManager->createUrl([$item['value']['route']]) ?>"><?= $item['value']['display_name'] ?></a>
                                <?php if ($item['name'] == 'book'): ?>
                                    <a href="<?= $urlManager->createUrl(['mch/book/goods/index']) ?>">商品管理</a>
                                    <a href="<?= $urlManager->createUrl(['mch/book/goods/cat']) ?>">商品分类</a>
                                    <a href="<?= $urlManager->createUrl(['mch/book/order/index']) ?>">订单管理</a>
                                    <a href="<?= $urlManager->createUrl(['mch/book/index/setting']) ?>">预约基础设置</a>
                                    <a href="<?= $urlManager->createUrl(['mch/book/notice/setting']) ?>">消息通知</a>
                                    <a href="   <?= $urlManager->createUrl(['mch/book/comment/index']) ?>">评论管理</a>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php endforeach; ?>
                <?php if ($display_plugin_count == 0 && !$this->context->is_admin): ?>
                    <a href="javascript:">暂无可用插件</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="nav-group <?= $this->params['active_nav_group'] == 15 ? 'active' : null ?>">
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_16.png">官网</a>
            <div class="sub-nav-list">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">参数设置</a>
                <a href="<?= $urlManager->createUrl(['mch/site/module/index']) ?>">我的模板</a>
                <a href="<?= $urlManager->createUrl(['mch/site/module/sysmodule']) ?>">系统模板</a>
                <a href="<?= $urlManager->createUrl(['mch/site/article/edit']) ?>">添加文章</a>
                <a href="<?= $urlManager->createUrl(['mch/site/article/index']) ?>">文章列表</a>
                <a href="<?= $urlManager->createUrl(['mch/site/article/artsort']) ?>">分类列表</a>
                <a href="<?= $urlManager->createUrl(['mch/site/form/index','read' => 1]) ?>">审核数据</a>
                <a href="<?= $urlManager->createUrl(['mch/site/form/index','read' => 2]) ?>">已审数据</a>
                <a href="<?= $urlManager->createUrl(['mch/site/card/edit']) ?>">添加名片</a>
                <a href="<?= $urlManager->createUrl(['mch/site/card/index']) ?>">名片设置</a>
                <a href="<?= $urlManager->createUrl(['mch/site/setting/explain']) ?>">模块使用说明</a>
            </div>
        </div>

    </div>
</div>
<?php if ($this->params['is_group'] == '1'): ?>
    <div class="sidebar sidebar-tow">
        <div class="sidebar-nav">
            <div class="sidebar-logo" style="">
                <a href="<?= $urlManager->createUrl(['mch/group/index/index']) ?>"
                   class="text-overflow-ellipsis">拼团管理</a>
                <div style="font-size: .85rem;color: #bbb;display: none">
                    <a href="http://cloud.zjhejiang.com/we7/mall/" target="_blank">商城</a>
                    <span>v<?= $this->context->version ?></span>
                </div>
            </div>
            <!--<div class="nav-group <? /*= $this->params['active_nav_group'] == 1 ? 'active' : null */ ?>">
            <a href="javascript:">拼团管理</a>
            <div class="sub-nav-list">
                <a href="<? /*= $urlManager->createUrl(['mch/store/setting']) */ ?>">&nbsp;&nbsp;商城设置</a>
                <a href="<? /*= $urlManager->createUrl(['mch/store/home-page']) */ ?>">&nbsp;&nbsp;首页排版</a>
            </div>
        </div>-->
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/goods/index']) ?>">商品管理</a>
            </div>

            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/goods/cat']) ?>">商品分类</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/order/index']) ?>">订单管理</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/pt/banner']) ?>">轮播图管理</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/notice/setting']) ?>">消息通知</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/article/edit']) ?>">拼团规则</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/comment/index']) ?>">评论管理</a></div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/ad/setting']) ?>">广告设置</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/order/group']) ?>">拼团管理</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/data/goods']) ?>">销售排行</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/group/data/user']) ?>">用户排行</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- <?php if ($this->params['is_book'] == '1'): ?>
    <div class="sidebar sidebar-tow">
        <div class="sidebar-nav">
            <div class="sidebar-logo" style="">
                <a href="<?= $urlManager->createUrl(['mch/book/index/index']) ?>"
                   class="text-overflow-ellipsis">预约管理<?php echo $this->params['is_net'];?></a>

                <div style="font-size: .85rem;color: #bbb;display: none">
                    <a href="http://cloud.zjhejiang.com/we7/mall/" target="_blank">商城</a>
                    <span>v<?= $this->context->version ?></span>
                </div>
            </div>
            <a href="javascript:"><img class="iconfont" src="/addons/zjhj_mall/core/web/statics/images/icon/nav_1.png">商城管理</a>
            
            <div class="nav-group <? /*= $this->params['active_nav_group'] == 1 ? 'active' : null */ ?>">
            <a href="javascript:">拼团管理</a>
            <div class="sub-nav-list">
                <a href="<? /*= $urlManager->createUrl(['mch/store/setting']) */ ?>">&nbsp;&nbsp;商城设置</a>
                <a href="<? /*= $urlManager->createUrl(['mch/store/home-page']) */ ?>">&nbsp;&nbsp;首页排版</a>

            </div>
        </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/goods/index']) ?>">商品管理</a>
            </div>

            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/goods/cat']) ?>">商品分类</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/order/index']) ?>">订单管理</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/index/setting']) ?>">预约基础设置</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/notice/setting']) ?>">消息通知</a>
            </div>

            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="   <?= $urlManager->createUrl(['mch/book/comment/index']) ?>">评论管理</a>
            </div>

        </div>
    </div>
<?php endif; ?> -->

<?php if ($this->params['is_book'] == 2): ?>
    <!--<div class="sidebar sidebar-tow">
        <div class="sidebar-nav">
            <div class="sidebar-logo" style="">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>"
                   class="text-overflow-ellipsis">官网管理</a>

                <div style="font-size: .85rem;color: #bbb;display: none">
                    <a href="http://cloud.zjhejiang.com/we7/mall/" target="_blank">商城</a>
                    <span>v<?= $this->context->version ?></span>
                </div>
            </div>
            <div class="nav-group <? /*= $this->params['active_nav_group'] == 1 ? 'active' : null */ ?>">
            <a href="javascript:">拼团管理</a>
            <div class="sub-nav-list">
                <a href="<? /*= $urlManager->createUrl(['mch/store/setting']) */ ?>">&nbsp;&nbsp;商城设置</a>
                <a href="<? /*= $urlManager->createUrl(['mch/store/home-page']) */ ?>">&nbsp;&nbsp;首页排版</a>

            </div>
        </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">参数设置</a>
            </div>
            
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">我的模板</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">系统模板</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">添加文章</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/article/index']) ?>">文章列表</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/article/artsort']) ?>">分类列表</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/form/index','read' => 1]) ?>">审核数据</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/form/index','read' => 2]) ?>">已审数据</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">前端查看</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">设置版权</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">邮件通知</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">名片设置</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/site/setting/index']) ?>">模块使用说明</a>
            </div>

        </div>
    </div> -->
<?php endif; ?>

<!-- <?php if ($this->params['is_site'] == '1'): ?>
    <div class="sidebar sidebar-tow">
        <div class="sidebar-nav">
            <div class="sidebar-logo" style="">
                <a href="<?= $urlManager->createUrl(['mch/book/index/index']) ?>"
                   class="text-overflow-ellipsis">预约管理</a>
                <div style="font-size: .85rem;color: #bbb;display: none">
                    <a href="http://cloud.zjhejiang.com/we7/mall/" target="_blank">商城</a>
                    <span>v<?= $this->context->version ?></span>
                </div>
            </div>
            <div class="nav-group <? /*= $this->params['active_nav_group'] == 1 ? 'active' : null */ ?>">
            <a href="javascript:">拼团管理</a>
            <div class="sub-nav-list">
                <a href="<? /*= $urlManager->createUrl(['mch/store/setting']) */ ?>">&nbsp;&nbsp;商城设置</a>
                <a href="<? /*= $urlManager->createUrl(['mch/store/home-page']) */ ?>">&nbsp;&nbsp;首页排版</a>

            </div>
        </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/goods/index']) ?>">商品管理</a>
            </div>

            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/goods/cat']) ?>">商品分类</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/order/index']) ?>">订单管理</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/index/setting']) ?>">预约基础设置</a>
            </div>
            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="<?= $urlManager->createUrl(['mch/book/notice/setting']) ?>">消息通知</a>
            </div>

            <div class="nav-group <?= $this->params['active_nav_group'] == 1 ? 'active' : null ?>">
                <a href="   <?= $urlManager->createUrl(['mch/book/comment/index']) ?>">评论管理</a>
            </div>

        </div>
    </div>
<?php endif; ?> -->


    

<div class="main">
    <div class="main-nav" flex="cross:center dir:left box:first" style="z-index: 11">
        <div>
            <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">
                    <img src="/addons/zjhj_mall/core/web/statics/images/icon/logo.png" style="width: 7.86rem;margin-left: 0.43rem">
                </a>
            </nav>
        </div>
        <div>
            <?= $this->render('/layouts/nav-right') ?>
        </div>
    </div>
    <?= $content ?>
</div>

<script>
    $(document).on("click", ".sidebar-nav > .nav-group > a", function () {
        var group = $(this).parents(".nav-group");
        if (group.hasClass("active")) {
            group.removeClass("active");
        } else {
            $(this).parents(".nav-group").addClass("active").siblings().removeClass("active");
        }
    });

    $(document).on("click", ".nav-group-second > a", function () {
        var oNav = $(this).parent('.nav-group-second')
        if (oNav.hasClass("active")) {
            oNav.removeClass("active");
        } else {
            oNav.addClass("active")
        }
    });


    $(document).on("click", ".input-hide .tip-block", function () {
        $(this).hide();
    });


    $(document).on("click", ".input-group .dropdown-item", function () {
        var val = $.trim($(this).text());
        $(this).parents(".input-group").find(".form-control").val(val);
    });
</script>
</body>
</html>