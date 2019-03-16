<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '专题编辑';
$this->params['active_nav_group'] = 8;
?>
<style>
    .goods-item,
    .video-item {
        margin: 1rem 0;
    }

    .goods-item .goods-name,
    .video-item .video-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
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

<div class="main-body p-3" id="app">
    <div class="form">
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
            <form method="post" style="max-width: 50rem" class=" auto-submit-form" autocomplete="off"
                  data-return="<?= $urlManager->createUrl(['mch/topic/index']) ?>">
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class="col-form-label required">标题：</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="title" value="<?= $model->title ?>">
                    </div>
                </div>
                <div class="form-group row" hidden>
                    <div class="col-3 text-right">
                        <label class="col-form-label">副标题：</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="sub_title" value="<?= $model->sub_title ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class="col-form-label">专题列表布局方式：</label>
                    </div>
                    <div class="col-9" style="padding-top: calc(.5rem - 1px * 2);">
                        <label class="custom-control custom-radio">
                            <input value="0" <?= $model->layout == 0 ? 'checked' : null ?> name="layout" type="radio"
                                   class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">小图模式</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input value="1" <?= $model->layout == 1 ? 'checked' : null ?> name="layout" type="radio"
                                   class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">大图模式</span>
                        </label>
                        <div class="text-muted fs-sm">小图模式建议封面图片大小：268×202，大图模式建议封面图片大小：702×350</div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class="col-form-label required">封面图：</label>
                    </div>
                    <div class="col-9">
                        <?= \app\widgets\ImageUpload::widget([
                            'name' => 'cover_pic',
                            'value' => $model->cover_pic,
                            'width' => 268,
                            'height' => 202,
                        ]) ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class="col-form-label">虚拟阅读量：</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="virtual_read_count" value="<?= $model->virtual_read_count ?>">
                        <div class="text-muted fs-sm">手机端显示的阅读量=实际阅读量+虚拟阅读量</div>
                    </div>
                </div>
                <div class="form-group row" hidden>
                    <div class="col-3 text-right">
                        <label class="col-form-label">虚拟收藏量：</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="virtual_favorite_count"
                               value="<?= $model->virtual_favorite_count ?>">
                        <div class="text-muted fs-sm">手机端显示的收藏量=实际收藏量+虚拟收藏量</div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class="col-form-label">排序：</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="sort" value="<?= $model->sort ?>">
                        <div class="text-muted fs-sm">升序，数字越小排序越靠前，默认1000</div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class="col-form-label required">专题详情：</label>
                    </div>
                    <div class="col-9">
                        <div flex="dir:left box:first">
                            <div>
                                <textarea class="short-row" id="editor"
                                          style="width: 30rem"
                                          name="content"><?= $model->content ?></textarea>
                            </div>
                            <div class="text-right">
                                <div>
                                    <a href="javascript:" class="btn btn-secondary mb-3" data-toggle="modal"
                                       data-target="#searchGoodsModal">
                                        <i class="iconfont icon-goods" style="font-size: 2rem;color: #555"></i>
                                        <div class="fs-sm">添加商品</div>
                                    </a>
                                </div>
                                <div>
                                    <a href="javascript:" class="btn btn-secondary" data-toggle="modal"
                                       data-target="#searchVideoModal">
                                        <i class="iconfont icon-video1" style="font-size: 2rem;color: #555"></i>
                                        <div class="fs-sm">添加视频</div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                    </div>
                    <div class="col-9">
                        <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                        <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                        <a class="btn btn-orange submit-btn" href="javascript:">保存</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" id="searchGoodsModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b class="modal-title" id="exampleModalLongTitle">添加商品</b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="search-goods-form" action="<?= $urlManager->createUrl(['mch/topic/search-goods']) ?>">
                        <div class="input-group">
                            <input class="form-control" placeholder="商品名" name="keyword">
                            <span class="input-group-btn">
                            <button class="btn btn-secondary">搜索</button>
                        </span>
                        </div>
                    </form>
                    <template v-if="goods_list">
                        <template v-if="goods_list.length==0">
                            <div class="p-5 text-center text-muted">搜索结果为空</div>
                        </template>
                        <template v-else>
                            <div v-for="(item,index) in goods_list" class="goods-item" flex="dir:left">
                                <div style="width: 60%">
                                    <div class="goods-name">{{item.name}}</div>
                                </div>
                                <div style="width: 20%" class="goods-price text-right">￥{{item.price}}</div>
                                <div style="width: 20%" class="goods-price text-right">
                                    <a v-bind:index="index" href="javascript:" class="insert-goods">添加</a>
                                </div>
                            </div>
                        </template>
                    </template>
                    <template v-else>
                        <div class="p-5 text-center text-muted">请输入关键字搜索商品</div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" id="searchVideoModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b class="modal-title" id="exampleModalLongTitle">添加视频</b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="search-video-form" action="<?= $urlManager->createUrl(['mch/topic/search-video']) ?>">
                        <div class="input-group">
                            <input class="form-control" placeholder="视频专区的视频名" name="keyword">
                            <span class="input-group-btn">
                            <button class="btn btn-secondary">搜索</button>
                        </span>
                        </div>
                    </form>
                    <template v-if="video_list">
                        <template v-if="video_list.length==0">
                            <div class="p-5 text-center text-muted">搜索结果为空</div>
                        </template>
                        <template v-else>
                            <div v-for="(item,index) in video_list" class="video-item" flex="dir:left">
                                <div style="width: 80%" class="pr-3">
                                    <div class="video-name">{{item.name}}</div>
                                </div>
                                <div style="width: 20%" class="text-right">
                                    <a v-bind:index="index" href="javascript:" class="insert-video">添加</a>
                                </div>
                            </div>
                        </template>
                    </template>
                    <template v-else>
                        <div class="p-5 text-center text-muted">请输入关键字搜索视频</div>
                    </template>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.config.js?v=1.6.2"></script>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.all.min.js"></script>
<script>
    var app = new Vue({
        el: "#app",
        data: {
            goods_list: null,
            video_list: null,
        },
    });
    var ue = UE.getEditor('editor', {
        serverUrl: "<?=$urlManager->createUrl(['upload/ue'])?>",
        enableAutoSave: false,
        saveInterval: 1000 * 3600,
        enableContextMenu: false,
        autoHeightEnabled: false,
    });

    $(document).on("submit", ".search-goods-form", function () {
        var form = $(this);
        var btn = form.find(".btn");
        btn.btnLoading("正在搜索");
        $.ajax({
            url: form.attr("action"),
            dataType: "json",
            data: form.serialize(),
            success: function (res) {
                btn.btnReset();
                if (res.code == 0) {
                    app.goods_list = res.data.list;
                }
            }
        });
        return false;
    });

    $(document).on("click", ".insert-goods", function () {
        var index = $(this).attr("index");
        var goods = app.goods_list[index];
        var _html = '';
        _html += '<br><div>';
        _html += '<a class="goods-link" goods="true" href="/pages/goods/goods?id=' + goods.id + '" style="display: block;background: #f3f3f3;border: 1px solid #eee;position: relative;height: 6rem;color: #333;text-decoration: none">';
        _html += '<img mode="aspectFill" class="goods-img" src="' + goods.cover_pic + '">';
        _html += '<div class="goods-info flex-col" style="padding:.5rem .5rem .5rem 6rem">';
        _html += '<div class="goods-name flex-grow-1">' + goods.name + '</div>';
        _html += '<div class="flex-grow-0">';
        _html += '<b class="goods-price" style="color:#ff4544">￥' + goods.price + '</b>';
        _html += '<span class="buy-btn" style="display: inline-block;float: right;font-size: 12px;border: 1px solid #ff4544;color: #ff4544;border-radius: .15rem;padding: .25rem .5rem;">去购买</span>';
        _html += '</div>';
        _html += '</div>';
        _html += '</a>';
        _html += '</div>';
        ue.execCommand("inserthtml", _html);
    });


    $(document).on("submit", ".search-video-form", function () {
        var form = $(this);
        var btn = form.find(".btn");
        btn.btnLoading("正在搜索");
        $.ajax({
            url: form.attr("action"),
            dataType: "json",
            data: form.serialize(),
            success: function (res) {
                btn.btnReset();
                if (res.code == 0) {
                    app.video_list = res.data.list;
                }
            }
        });
        return false;
    });

    $(document).on("click", ".insert-video", function () {
        var index = $(this).attr("index");
        var video = app.video_list[index];
        var _html = '';
        _html += '<video src="' + video.src + '"></video>';
        _html += '';
        _html += '';
        _html += '';
        _html += '';
        _html += '';
        _html += '';
        ue.execCommand("inserthtml", _html);
    });


</script>