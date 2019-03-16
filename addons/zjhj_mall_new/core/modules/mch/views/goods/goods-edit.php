<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/29
 * Time: 10:49
 */

$urlManager = Yii::$app->urlManager;
$this->title = '商品编辑';
$staticBaseUrl = Yii::$app->request->baseUrl . '/statics';
$this->params['active_nav_group'] = 2;
$returnUrl = Yii::$app->request->referrer;
if (!$returnUrl)
    $returnUrl = $urlManager->createUrl(['mch/goods/goods']);
?>
<script src="<?= $staticBaseUrl ?>/mch/js/uploadVideo.js"></script>
<style>
    .cat-box {
        border: 1px solid rgba(0, 0, 0, .15);
    }

    .cat-box .row {
        margin: 0;
        padding: 0;
    }

    .cat-box .col-6 {
        padding: 0;
    }

    .cat-box .cat-list {
        border-right: 1px solid rgba(0, 0, 0, .15);
        overflow-x: hidden;
        overflow-y: auto;
        height: 10rem;
    }

    .cat-box .cat-item {
        border-bottom: 1px solid rgba(0, 0, 0, .1);
        padding: .5rem 1rem;
        display: block;
        margin: 0;
    }

    .cat-box .cat-item:last-child {
        border-bottom: none;
    }

    .cat-box .cat-item:hover {
        background: rgba(0, 0, 0, .05);
    }

    .cat-box .cat-item.active {
        background: rgb(2, 117, 216);
        color: #fff;
    }

    .cat-box .cat-item input {
        display: none;
    }

    form {
    }

    form .head {
        position: fixed;
        top: 9rem;
        right: 1rem;
        left: 16rem;
        z-index: 9;
        background: #f3f3f3;
    }

    form .head .head-content {
        background: #fff;
        border: 1px solid #eee;
        height: 40px;
    }

    .head-step {
        height: 100%;
        padding: 0 20px;
    }

    .step-block {
        position: relative;
    }

    form .body {
        padding-top: 45px;
    }

    .step-block > div {
        padding: 20px;
        background: #fff;
        /* border: 1px solid #eee; */
        margin-bottom: 5px;
    }

    .step-block > div:first-child {
        padding: 20px;
        width: 200px;
        margin-right: 5px;
        font-weight: bold;
        text-align: center;
    }

    .step-block .step-location {
        position: absolute;
        top: -122px;
        left: 0;
    }

    .step-block:first-child .step-location {
        top: -140px;
    }

    form .foot {
        text-align: center;
        background: #fff;
        border: 1px solid #eee;
        padding: 1rem;
    }

    .edui-editor,
    #edui1_toolbarbox {
        z-index: 2 !important;
    }

    form . {
        width: 380px;
    }

    .form {
        background: none;
        width: 100%;
        max-width: 100%;
    }

    .attr-group {
        border: 1px solid #eee;
        padding: .5rem .75rem;
        margin-bottom: .5rem;
        border-radius: .15rem;
    }

    .attr-group-delete {
        display: inline-block;
        background: #eee;
        color: #fff;
        width: 1rem;
        height: 1rem;
        text-align: center;
        line-height: 1rem;
        border-radius: 999px;
    }

    .attr-group-delete:hover {
        background: #ff4544;
        color: #fff;
        text-decoration: none;
    }

    .attr-list > div {
        vertical-align: top;
    }

    .attr-item {
        display: inline-block;
        background: #eee;
        margin-right: 1rem;
        margin-top: .5rem;
        overflow: hidden;
    }

    .attr-item .attr-name {
        padding: .15rem .75rem;
        display: inline-block;
    }

    .attr-item .attr-delete {
        padding: .35rem .75rem;
        background: #d4cece;
        color: #fff;
        font-size: 1rem;
        font-weight: bold;
    }

    .attr-item .attr-delete:hover {
        text-decoration: none;
        color: #fff;
        background: #ff4544;
    }

    .attr-table td {
        padding: .35rem .75rem;
    }

    .panel {
        padding: 0 1rem;
        background: #fff;
    }

    .panel .panel-header {
        border-bottom: 1px solid #eee;
        padding: 1rem 0;
    }

    .panel .panel-header:after {
        clear: both;
        content: " ";
        display: block;
    }

    .panel .panel-body {
        padding: 1rem 0;
    }

    .panel .panel-footer {
        border-top: 1px solid #eee;
        padding: 1rem 0;
    }

    .panel .panel-header .nav {
        margin-top: -1rem;
        margin-bottom: -1rem;
        float: left;
    }

    .panel .panel-header .nav.nav-right {
        float: right;
    }

    .panel .panel-header .nav-link {
        padding: 1rem 0;
        margin: 0 1rem -1px 1rem;
    }

    .panel .panel-header .nav-item:first-child .nav-link {
        margin-left: 0;
    }

    .panel .panel-header .nav-item:last-child .nav-link {
        margin-right: 0;
    }

    .panel .panel-header .nav-link.active {
        border-bottom: 2px solid #449be6;
    }

    .panel .panel-close {
        float: right;
        font-size: 1.5rem;
        height: 1.1429rem;
        font-weight: 700;
        text-decoration: none;
        color: #666;
        line-height: .9;
    }

    .modal-dialog {
        box-shadow: 0 1px 6px 2px rgba(0, 0, 0, 0.1);
    }

    #file_select_modal .file-list {
        margin-left: -9px;
    }

    #file_select_modal .file-list:after {
        content: " ";
        display: block;
        clear: both;
    }

    #file_select_modal .file-item {
        display: inline-block;
        width: 110px;
        height: 110px;
        line-height: 110px;
        margin-left: 10px;
        margin-bottom: 10px;
        overflow: hidden;
        border: 1px solid #eee;
        float: left;
        transition: 150ms;
    }

    #file_select_modal .file-item:hover {
        border-color: #529fe0;
    }

    #file_select_modal .file-cover {
        max-width: 100%;
        max-height: 100%;
        margin: auto auto;
    }

    .upload-preview {
        position: relative;
        width: 100px;
        height: 100px;
        line-height: 100px;
        border: 1px solid #e3e3e3;
        border-radius: 2px;
        overflow: hidden;
        margin: 5px 0;
    }

    .upload-preview .upload-preview-tip {
        position: absolute;
        top: 2px;
        left: 4px;
        font-size: .65rem;
        text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.75), -1px -1px 0 rgba(255, 255, 255, 0.75);
        font-weight: bold;
        color: rgba(0, 0, 0, 0.6);
        line-height: 1.25;
    }

    .upload-preview .upload-preview-img {
        max-width: 100%;
        max-height: 100%;
        margin: auto auto;
    }
</style>

<!-- 文件选择模态框 Modal -->
<div class="modal fade" id="file_select_modal" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="panel">
            <div class="panel-header">
                <span>选择文件</span>
                <a href="javascript:" class="panel-close" data-dismiss="modal">&times;</a>
            </div>
            <div class="panel-body">
                <div class="file-list"></div>
                <div class="file-loading text-center" style="display: none">
                    <img style="height: 1.14286rem;width: 1.14286rem"
                         src="<?= Yii::$app->request->baseUrl ?>/statics/images/loading-2.svg">
                </div>
                <div class="text-center">
                    <a style="display: none" href="javascript:" class="file-more">加载更多</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $returnUrl ?>">商品管理</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div> -->

<div class="main-body p-3" id="page">

    <form class="form auto-submit-form" method="post" autocomplete="off" data-return="<?= $returnUrl ?>">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
                        <a class="breadcrumb-item" href="<?= $returnUrl ?>">商品管理</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- <div class="head">
            <div class="head-content" flex="dir:left">
                <a flex="cross:center" class="head-step" href="#step1">选择分类</a>
                <a flex="cross:center" class="head-step" href="#step2">基本信息</a>
                <a flex="cross:center" class="head-step" href="#step3">规格/库存</a>
                <a flex="cross:center" class="head-step" href="#step6">营销</a>
                <a flex="cross:center" class="head-step" href="#step5">分销设置</a>
                <a flex="cross:center" class="head-step" href="#step4">商品详情</a>
            </div>
        </div> -->
        <div class="form-body white-bg border-b-l border-b-r mb-3">
            <p class="title-line">选择分类</p>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">商品分类</label>
                </div>
                <div class="col-4">
                    <div class="input-group ">
                        <input readonly class="form-control cat-name" value="<?= $goods->cat->name ?>">
                        <input type="hidden" name="model[cat_id]" class="form-control cat-id"
                               value="<?= $goods->cat->id ?>">
                        <span class="input-group-btn">
                            <a class="btn btn-secondary" href="javascript:" data-toggle="modal" data-target="#catModal">选择分类</a>
                        </span>
                    </div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">淘宝一键采集（链接）</label>
                </div>
                <div class="col-4">
                    <div class="input-group ">
                        <input class="form-control copy-url" placeholder="请输入淘宝商品详情地址连接">
                        <span class="input-group-btn">
                            <a class="btn btn-secondary copy-btn" href="javascript:">立即获取</a>
                        </span>
                    </div>
                    <div class=" text-muted fs-sm mt-3">
                        例如：商品链接为:http://item.taobao.com/item.htm?id=522155891308
                        或:http://detail.tmall.com/item.htm?id=522155891308
                    </div>
                    <div class=" text-muted fs-sm">若不使用，则该项为空</div>
                    <div class="copy-error text-danger fs-sm" hidden></div>
                </div>
            </div>
        </div>

        <div class="form-body white-bg border-7 mb-3">
            <p class="title-line mt-3 mb-5">基本信息</p>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">商品名称</label>
                </div>
                <div class="col-3">
                    <input class="form-control " type="text" name="model[name]"
                           value="<?= $goods['name'] ?>">
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">商品排序</label>
                </div>
                <div class="col-3">
                    <input class="form-control " type="text" name="model[sort]"
                           value="<?= $goods['sort'] ?>">
                    <div class="text-muted fs-sm mt-3">排序按升序排列</div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">虚拟销量</label>
                </div>
                <div class="col-3">
                    <input class="form-control " type="number" name="model[virtual_sales]"
                           value="<?= $goods['virtual_sales'] ?>">
                    <div class="text-muted fs-sm mt-3">前端展示的销量=实际销量+虚拟销量</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">商品视频</label>
                </div>
                <div class="col-3">
                    <div class="video-picker" data-url="<?= $urlManager->createUrl(['upload/video']) ?>">
                        <div class="input-group mb-3">
                            <input class="video-picker-input video form-control" name="model[video_url]"
                                   value="<?= $goods['video_url'] ?>" placeholder="请输入视频源地址或者选择上传视频">
                            <a href="javascript:" class="btn btn-secondary video-picker-btn">选择视频</a>
                        </div>
                        <a class="video-check"
                           href="<?= $goods['video_url'] ? $goods['video_url'] : "javascript:" ?>"
                           target="_blank">视频预览</a>

                        <div class="video-preview"></div>
                        <div>
                            <span
                                    class="text-danger fs-sm">支持格式mp4;支持编码H.264;视频大小不能超过<?= \app\models\UploadForm::getMaxUploadSize() ?>
                                MB</span></div>
                    </div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">服务内容</label>
                </div>
                <div class="col-3">
                    <input class="form-control " name="model[service]"
                           value="<?= $goods['service'] ?>">
                    <div class="fs-sm text-muted mt-3">例子：正品保障,极速发货,7天退换货。多个请使用英文逗号<kbd>,</kbd>分隔</div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">运费设置</label>
                </div>
                <div class="col-3">
                    <select class="form-control " name="model[freight]">
                        <option value="0">默认模板</option>
                        <?php foreach ($postageRiles as $p): ?>
                            <option
                                    value="<?= $p->id ?>" <?= $p->id == $goods['freight'] ? 'selected' : '' ?>><?= $p->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">单位</label>
                </div>
                <div class="col-3">
                    <input class="form-control " type="text" name="model[unit]"
                           value="<?= $goods['unit'] ? $goods['unit'] : '件' ?>">
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">重量</label>
                </div>
                <div class="col-3">
                    <div class="input-group ">
                        <input type="number" step="0.01" class="form-control"
                               name="model[weight]"
                               value="<?= $goods['weight'] ? $goods['weight'] : 0 ?>">
                        <span class="input-group-addon">克<span>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">售价</label>
                </div>
                <div class="col-3">
                    <div class="input-group ">
                        <input type="number" step="0.01" class="form-control"
                               name="model[price]" min="0.01"
                               value="<?= $goods['price'] ? $goods['price'] : 1 ?>">
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label required">原价</label>
                </div>
                <div class="col-3">
                    <input type="number" step="0.01" class="form-control "
                           name="model[original_price]" min="0"
                           value="<?= $goods['original_price'] ? $goods['original_price'] : 1 ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">单品满件包邮</label>
                </div>
                <div class="col-3">
                    <div class="input-group ">
                        <input type="number" class="form-control " name="full_cut[pieces]"
                               value="<?= $goods['full_cut']['pieces'] ?>">
                        <span class="input-group-addon">件</span>
                    </div>
                    <div class="fs-sm text-muted mt-3">如果设置0或空，则不支持满件包邮</div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">单品满额包邮</label>
                </div>
                <div class="col-3">
                    <div class="input-group ">
                        <input type="number" step="0.01" class="form-control "
                               name="full_cut[forehead]"
                               value="<?= $goods['full_cut']['forehead'] ?>">
                        <span class="input-group-addon">元</span>
                    </div>
                    <div class="fs-sm text-muted mt-3">如果设置0或空，则不支持满额包邮</div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class="col-form-label required">商品缩略图</label>
                </div>
                <div class="col-3">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[cover_pic]',
                        'value' => $goods->cover_pic,
                        'width' => 325,
                        'height' => 325,
                    ]) ?>
                </div>
                <div class="col-1 text-left">
                    <label class="col-form-label required">商品图片</label>
                </div>
                <div class="col-7">
                    <?php if ($goods->goodsPicList):foreach ($goods->goodsPicList as $goods_pic): ?>
                        <?php $goods_pic_list[] = $goods_pic->pic_url ?>
                    <?php endforeach;
                    else:$goods_pic_list = [];endif; ?>
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[goods_pic_list][]',
                        'value' => $goods_pic_list,
                        'multiple' => true,
                        'width' => 750,
                        'height' => 750,
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="form-body white-bg border-7 mb-3">
            <p class="title-line mt-3 mb-5">基本信息</p>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">商品库存</label>
                </div>
                <div class="col-3">
                    <div class="input-group ">
                        <input class="form-control" name="model[goods_num]"
                               value="<?= $goods->getNum() ?>">
                        <span class="input-group-addon">件</span>
                    </div>
                </div>
                <div class="col-1 text-left">
                    <label class="col-form-label">是否使用规格</label>
                </div>
                <div class="col-3 col-form-label">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox"
                               name="model[use_attr]"
                               value="1"
                            <?= $goods->use_attr ? 'checked' : null ?>
                               class="custom-control-input use-attr">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">使用规格</span>
                    </label>
                </div>
            </div>

            <!-- 有规格 -->
            <div class="attr-edit-block">
                <div class="form-group row">
                    <div class="col-1 text-left">
                        <label class=" col-form-label required">规格组和规格值</label>
                    </div>
                    <div class="col-3">
                        <div class="input-group  mb-2" v-if="attr_group_list.length<3">
                            <span class="input-group-addon">规格组</span>
                            <input class="form-control add-attr-group-input" placeholder="如颜色、尺码、套餐">
                            <span class="input-group-btn">
                            <a class="btn btn-secondary add-attr-group-btn" href="javascript:">添加</a>
                        </span>
                        </div>
                        <div v-else class="mb-2">最多只可添加3个规格组</div>
                        <div v-for="(attr_group,i) in attr_group_list" class="attr-group">
                            <div>
                                <b>{{attr_group.attr_group_name}}</b>
                                <a v-bind:index="i" href="javascript:" class="attr-group-delete">×</a>
                            </div>
                            <div class="attr-list">
                                <div v-for="(attr,j) in attr_group.attr_list" class="attr-item">
                                    <span class="attr-name">{{attr.attr_name}}</span>
                                    <a v-bind:group-index="i" v-bind:index="j" class="attr-delete"
                                       href="javascript:">×</a>
                                </div>
                                <div style="display: inline-block;width: 200px;margin-top: .5rem">
                                    <div class="input-group attr-input-group" style="border-radius: 0">
                                    <span class="input-group-addon"
                                          style="padding: .35rem .35rem;font-size: .8rem">规格值</span>
                                        <input class="form-control form-control-sm add-attr-input"
                                               placeholder="如红色、白色">
                                        <span class="input-group-btn">
                                        <a v-bind:index="i" class="btn btn-secondary btn-sm add-attr-btn"
                                           href="javascript:">添加</a>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 text-left">
                        <label class=" col-form-label required">价格和库存</label>
                    </div>
                    <div class="col-9">
                        <div v-if="attr_group_list && attr_group_list.length>0">
                            <table class="table table-bordered attr-table">
                                <thead>
                                <tr>
                                    <th v-for="(attr_group,i) in attr_group_list"
                                        v-if="attr_group.attr_list && attr_group.attr_list.length>0">
                                        {{attr_group.attr_group_name}}
                                    </th>
                                    <th>库存</th>
                                    <th>价格</th>
                                    <th>货号</th>
                                    <th>规格图片</th>
                                </tr>
                                </thead>
                                <tr v-for="(item,index) in checked_attr_list">
                                    <td v-for="(attr,attr_index) in item.attr_list">
                                        <input type="hidden"
                                               v-bind:name="'attr['+index+'][attr_list]['+attr_index+'][attr_id]'"
                                               v-bind:value="attr.attr_id">

                                        <input type="hidden" style="width: 40px"
                                               v-bind:name="'attr['+index+'][attr_list]['+attr_index+'][attr_name]'"
                                               v-bind:value="attr.attr_name">

                                        <input type="hidden" style="width: 40px"
                                               v-bind:name="'attr['+index+'][attr_list]['+attr_index+'][attr_group_name]'"
                                               v-bind:value="attr.attr_group_name">
                                        <span>{{attr.attr_name}}</span>
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" type="number" min="0"
                                               step="1" style="width: 60px" v-bind:name="'attr['+index+'][num]'"
                                               v-bind:value="item.num">
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" type="number" min="0"
                                               step="0.01" style="width: 70px"
                                               v-bind:name="'attr['+index+'][price]'"
                                               v-bind:value="item.price">
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" style="width: 100px"
                                               v-bind:name="'attr['+index+'][no]'"
                                               v-bind:value="item.no">
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm" v-bind:data-index="index">
                                            <input class="form-control form-control-sm" style="width: 40px"
                                                   v-bind:name="'attr['+index+'][pic]'"
                                                   v-model="item.pic">
                                            <span class="input-group-btn">
                                            <a class="btn btn-secondary upload-attr-pic" href="javascript:"
                                               data-toggle="tooltip"
                                               data-placement="bottom" title="上传文件">
                                                <span class="iconfont icon-cloudupload"></span>
                                            </a>
                                            </span>
                                            <span class="input-group-btn">
                                                <a class="btn btn-secondary select-attr-pic" href="javascript:"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom" title="从文件库选择">
                                                    <span class="iconfont icon-viewmodule"></span>
                                                </a>
                                            </span>
                                            <span class="input-group-btn">
                                                <a class="btn btn-secondary delete-attr-pic" href="javascript:"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom" title="删除文件">
                                                    <span class="iconfont icon-close"></span>
                                                </a>
                                            </span>
                                        </div>
                                        <img v-if="item.pic" v-bind:src="item.pic"
                                             style="width: 50px;height: 50px;margin: 2px 0;border-radius: 2px">
                                    </td>
                                </tr>
                            </table>
                            <div class="text-muted fs-sm">规格价格0表示保持原售价</div>
                        </div>
                        <div v-else class="pt-2 text-muted">请先填写规格组和规格值</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-body white-bg border-7 mb-3">
            <p class="title-line mt-3 mb-5">营销</p>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">积分赠送</label>
                </div>
                <div class="col-3">
                    <div class="input-group ">
                        <input type="text" step="1" class="form-control " name="integral[give]"
                               value="<?= $goods['integral']['give'] ?>">
                        <span class="input-group-addon">分</span>
                    </div>
                    <div class="fs-sm text-muted mt-3">
                        会员购物赠送的积分, 如果不填写或填写0，则默认为不赠送积分，如果带%则为按成交价格的比例计算积分
                        <br/>
                        如: 购买2件，设置10 积分, 不管成交价格是多少， 则购买后获得20积分
                        <br/>
                        如: 购买2件，设置10%积分, 成交价格2 * 200= 400， 则购买后获得 40 积分（400*10%）
                    </div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">积分抵扣</label>
                </div>
                <div class="col-3">
                    <div class="input-group ">
                        <span class="input-group-addon">最多抵扣</span>
                        <input type="text" step="1" class="form-control " name="integral[forehead]"
                               value="<?= $goods['integral']['forehead'] ?>">
                        <span class="input-group-addon">元</span>
                    </div>
                    <div class="input-group ">
                        <label class="custom-control custom-checkbox">
                            <input <?= $goods['integral']['more'] == 1 ? 'checked' : null ?> value="1"
                                                                                             name="integral[more]"
                                                                                             type="checkbox"
                                                                                             class="custom-control-input">
                            <span class="custom-control-indicator mt-3"></span>
                            <span class="custom-control-description mt-3">允许多件累计折扣</span>
                        </label>
                    </div>
                    <div class="fs-sm text-muted">
                        如果设置0，则不支持积分抵扣 如果带%则为按成交价格的比例计算抵扣多少元
                    </div>
                </div>
                <div class="col-1 text-left">
                    <label class=" col-form-label">卡券发放</label>
                </div>
                <div class="col-3">
                    <div class="input-group ">
                        <select class="form-control card-list">
                            <option value="-1">无</option>
                            <template v-for="(item,index) in card_list">
                                <option :value="index">{{item.name}}</option>
                            </template>
                        </select>
                        <a href="javascript:" class="input-group-addon card-add">添加</a>
                    </div>
                    <div class="fs-sm text-danger mt-3">注：卡券仅限10张</div>
                    <div class="fs-sm text-danger">卡券会在用户付款后自动发放给用户</div>
                </div>
            </div>
            <div class="form-group row" v-if="goods_card_list.length>0">
                <div class="col-1 text-left">
                    <label class=" col-form-label">已添加卡券</label>
                </div>
                <div class="col-9">
                    <div class="card  p-2 mb-2" v-for="(item,index) in goods_card_list">
                        <div flex="dir:left box:last">
                            <input type="hidden" name="goods_card[]" :value="item.id">
                            <div
                                    style="width: 100%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;word-break: break-all">
                                {{item.name}}
                            </div>
                            <div class="pl-2" style="border-left: 1px solid #ddd;">
                                <a href="javascript:" class="card-del" :data-index="index">删除</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-body white-bg border-7 mb-3">
            <p class="title-line mt-3 mb-5">分销设置</p>
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">开启单独分销设置</label>
                </div>
                <div class="col-9 col-form-label">
                    <label class="custom-control custom-radio">
                        <input <?= $goods['individual_share'] == 0 ? 'checked' : null ?> value="0"
                                                                                         name="model[individual_share]"
                                                                                         type="radio"
                                                                                         class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">不开启</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input <?= $goods['individual_share'] == 1 ? 'checked' : null ?> value="1"
                                                                                         name="model[individual_share]"
                                                                                         type="radio"
                                                                                         class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">开启</span>
                    </label>
                </div>
            </div>
            <div class="form-group row share-commission">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">分销佣金类型</label>
                </div>
                <div class="col-9 col-form-label">
                    <label class="custom-control custom-radio share-type">
                        <input <?= $goods->share_type == 0 ? 'checked' : null ?>
                                name="model[share_type]"
                                value="0"
                                type="radio"
                                class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">百分比</span>
                    </label>
                    <label class="custom-control custom-radio share-type">
                        <input <?= $goods->share_type == 1 ? 'checked' : null ?>
                                name="model[share_type]"
                                value="1"
                                type="radio"
                                class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">固定金额</span>
                    </label>
                </div>

                <div class="col-1 text-left">
                    <label class=" col-form-label required">单独分销设置</label>
                </div>
                <div class="col-9">
                    <div class="">
                        <div class="input-group mb-3">
                            <span class="input-group-addon">一级佣金</span>
                            <input name="model[share_commission_first]"
                                   value="<?= $goods['share_commission_first'] ?>"
                                   class="form-control"
                                   type="number"
                                   step="0.01"
                                   min="0" max="100">
                            <span class="input-group-addon percent"><?= $goods->share_type == 1 ? "元" : "%" ?></span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-addon">二级佣金</span>
                            <input name="model[share_commission_second]"
                                   value="<?= $goods['share_commission_second'] ?>"
                                   class="form-control"
                                   type="number"
                                   step="0.01"
                                   min="0" max="100">
                            <span class="input-group-addon percent"><?= $goods->share_type == 1 ? "元" : "%" ?></span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-addon">三级佣金</span>
                            <input name="model[share_commission_third]"
                                   value="<?= $goods['share_commission_third'] ?>"
                                   class="form-control"
                                   type="number"
                                   step="0.01"
                                   min="0" max="100">
                            <span class="input-group-addon percent"><?= $goods->share_type == 1 ? "元" : "%" ?></span>
                        </div>
                        <div class="fs-sm">
                            <a href="<?= $urlManager->createUrl(['mch/share/basic']) ?>"
                               target="_blank">分销层级</a>的优先级高于商品单独的分销比例，例：层级只开二级分销，那商品的单独分销比例只有二级有效
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-body white-bg border-7 mb-3">
            <p class="title-line mt-3 mb-5">图文详情</p>
            <div>
                <div class="form-group row">
                    <div class="col-1 text-left">
                        <label class=" col-form-label required">图文详情</label>
                    </div>
                    <div class="col-9">
                        <textarea class="" id="editor"
                                  name="model[detail]"><?= $goods['detail'] ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-p white-bg form-horizontal mt-4 border-7 p-3">
            <div class="form-group row" style="margin: 0;">
                <div class="col-12 text-center">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-default submit-btn" href="javascript:">保存</a>
                </div>
            </div>
        </div>
    </form>


    <!-- 选择分类 -->
    <div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="catModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b>选择分类</b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="cat-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="cat-list parent-cat-list">
                                    <?php foreach ($cat_list as $index => $cat): ?>
                                        <label class="cat-item <?= $index == 0 ? 'active' : '' ?>">
                                            <?= $cat->name ?>
                                            <input value="<?= $cat->id ?>"
                                                <?= $index == 0 ? 'checked' : '' ?>
                                                   type="radio"
                                                   name="model[cat_id]">
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="cat-list">
                                    <label class="cat-item" v-for="sub_cat in sub_cat_list">
                                        {{sub_cat.name}}
                                        <input v-bind:value="sub_cat.id" type="radio" name="model[cat_id]">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary cat-confirm">确认</button>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.config.js?v=1.9.6"></script>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.all.min.js?v=1.9.6"></script>
<script>
    var Map = function () {
        this._data = [];
        this.set = function (key, val) {
            for (var i in this._data) {
                if (this._data[i].key == key) {
                    this._data[i].val = val;
                    return true;
                }
            }
            this._data.push({
                key: key,
                val: val,
            });
            return true;
        };
        this.get = function (key) {
            for (var i in this._data) {
                if (this._data[i].key == key)
                    return this._data[i].val;
            }
            return null;
        };
        this.delete = function (key) {
            for (var i in this._data) {
                if (this._data[i].key == key) {
                    this._data.splice(i, 1);
                }
            }
            return true;
        };
    };
    var map = new Map();

    var page = new Vue({
        el: "#page",
        data: {
            sub_cat_list: [],
            attr_group_list: JSON.parse('<?=json_encode($goods->getAttrData(), JSON_UNESCAPED_UNICODE)?>'),//可选规格数据
            checked_attr_list: JSON.parse('<?=json_encode($goods->getCheckedAttrData(), JSON_UNESCAPED_UNICODE)?>'),//已选规格数据
            goods_card_list: <?=$goods_card_list?>,
            card_list: <?=$card_list?>
        }
    });

    var ue = UE.getEditor('editor', {
        serverUrl: "<?=$urlManager->createUrl(['upload/ue'])?>",
        enableAutoSave: false,
        saveInterval: 1000 * 3600,
        enableContextMenu: false,
        autoHeightEnabled: false,
    });
    $(document).on("change", ".cat-item input", function () {
        if ($(this).prop("checked")) {
            $(".cat-item").removeClass("active");
            $(this).parent(".cat-item").addClass("active");
        } else {
            $(this).parent(".cat-item").removeClass("active");
        }
    });

    $(document).on("change", ".parent-cat-list input", function () {
        getSubCatList();
    });

    $(document).on("click", ".cat-confirm", function () {
        var cat_name = $.trim($(".cat-item.active").text());
        var cat_id = $(".cat-item.active input").val();
        if (cat_name && cat_id) {
            $(".cat-name").val(cat_name);
            $(".cat-id").val(cat_id);
        }
        $("#catModal").modal("hide");
    });

    function getSubCatList() {
        var parent_id = $(".parent-cat-list input:checked").val();
        page.sub_cat_list = [];
        $.ajax({
            url: "<?=$urlManager->createUrl(['mch/goods/get-cat-list'])?>",
            data: {
                parent_id: parent_id,
            },
            success: function (res) {
                if (res.code == 0) {
                    page.sub_cat_list = res.data;
                }
            }
        });
    }

    getSubCatList();


    $(document).on("change", ".attr-select", function () {
        var name = $(this).attr("data-name");
        var id = $(this).val();
        if ($(this).prop("checked")) {
        } else {
        }
    });

    $(document).on("click", ".add-attr-group-btn", function () {
        var name = $(".add-attr-group-input").val();
        name = $.trim(name);
        if (name == "")
            return;
        page.attr_group_list.push({
            attr_group_name: name,
            attr_list: [],
        });
        $(".add-attr-group-input").val("");
        page.checked_attr_list = getAttrList();
    });

    $(document).on("click", ".add-attr-btn", function () {
        var name = $(this).parents(".attr-input-group").find(".add-attr-input").val();
        var index = $(this).attr("index");
        name = $.trim(name);
        if (name == "")
            return;
        page.attr_group_list[index].attr_list.push({
            attr_name: name,
        });
        $(this).parents(".attr-input-group").find(".add-attr-input").val("");
        page.checked_attr_list = getAttrList();
    });


    $(document).on("click", ".attr-group-delete", function () {
        var index = $(this).attr("index");
        page.attr_group_list.splice(index, 1);
        page.checked_attr_list = getAttrList();
    });

    $(document).on("click", ".attr-delete", function () {
        var index = $(this).attr("index");
        var group_index = $(this).attr("group-index");
        page.attr_group_list[group_index].attr_list.splice(index, 1);
        page.checked_attr_list = getAttrList();
    });


    function getAttrList() {
        var array = [];
        for (var i in page.attr_group_list) {
            for (var j in page.attr_group_list[i].attr_list) {
                var object = {
                    attr_group_name: page.attr_group_list[i].attr_group_name,
                    attr_id: null,
                    attr_name: page.attr_group_list[i].attr_list[j].attr_name,
                };
                if (!array[i])
                    array[i] = [];
                array[i].push(object);
            }
        }
        var len = array.length;
        var results = [];
        var indexs = {};

        function specialSort(start) {
            start++;
            if (start > len - 1) {
                return;
            }
            if (!indexs[start]) {
                indexs[start] = 0;
            }
            if (!(array[start] instanceof Array)) {
                array[start] = [array[start]];
            }
            for (indexs[start] = 0; indexs[start] < array[start].length; indexs[start]++) {
                specialSort(start);
                if (start == len - 1) {
                    var temp = [];
                    for (var i = len - 1; i >= 0; i--) {
                        if (!(array[start - i] instanceof Array)) {
                            array[start - i] = [array[start - i]];
                        }
                        if (array[start - i][indexs[start - i]]) {
                            temp.push(array[start - i][indexs[start - i]]);
                        }
                    }
                    var key = [];
                    for (var i in temp) {
                        key.push(temp[i].attr_id);
                    }
                    var oldVal = map.get(key.sort().toString());
                    if (oldVal) {
                        results.push({
                            num: oldVal.num,
                            price: oldVal.price,
                            no: oldVal.no,
                            pic: oldVal.pic,
                            attr_list: temp
                        });
                    } else {
                        results.push({
                            num: 0,
                            price: 0,
                            no: '',
                            pic: '',
                            attr_list: temp
                        });
                    }
                }
            }
        }

        specialSort(-1);
        return results;
    }


    $(document).on("change", "input[name='model[individual_share]']", function () {
        setShareCommission();
    });
    setShareCommission();

    function setShareCommission() {
        if ($("input[name='model[individual_share]']:checked").val() == 1) {
            $(".share-commission").show();
        } else {
            $(".share-commission").hide();
        }
    }

    function checkUseAttr() {
        if ($('.use-attr').length == 0)
            return;
        if ($('.use-attr').prop('checked')) {
            $('input[name="model[goods_num]"]').val(0).prop('readonly', true);
            $('.attr-edit-block').show();
        } else {
            $('input[name="model[goods_num]"]').prop('readonly', false);
            $('.attr-edit-block').hide();
        }
    }

    $(document).on('change', '.use-attr', function () {
        checkUseAttr();
    });

    checkUseAttr();

</script>
<script>
    $(document).on('change', '.video', function () {
        $('.video-check').attr('href', this.value);
    });
</script>
<script>
    $(document).on('click', '.copy-btn', function () {
        var url = $('.copy-url').val();
        var btn = $(this);
        var error = $('.copy-error');
        error.prop('hidden', true);
        if (url == '' || url == undefined) {
            error.prop('hidden', false).html('请填写宝贝链接');
            return;
        }
        btn.btnLoading('信息获取中');
        $.myLoading();
        $.ajax({
            url: "<?=$urlManager->createUrl(['mch/goods/copy'])?>",
            type: 'get',
            dataType: 'json',
            data: {
                url: url,
            },
            success: function (res) {
                $.myLoadingHide();
                btn.btnReset();
                if (res.code == 0) {
                    $("input[name='model[name]']").val(res.data.title);
                    $("input[name='model[virtual_sales]']").val(res.data.sale_count);
                    $("input[name='model[price]']").val(res.data.sale_price);
                    $("input[name='model[original_price]']").val(res.data.price);
                    page.attr_group_list = res.data.attr_group_list;
                    page.checked_attr_list = res.data.checked_attr_list;
                    ue.setContent(res.data.detail_info + "");
                    var pic = res.data.picsPath;

                    var cover_pic = $("input[name='model[cover_pic]']");
                    var cover_pic_next = cover_pic.next()[0];
                    cover_pic.val(pic[0]);
                    $(cover_pic_next).css('background-image', "url(" + pic[0] + ")");

                    if (pic.length > 1) {
                        var goods_pic_list = $(".picker-multiple-list");
                        goods_pic_list.empty();
                        $(pic).each(function (i) {
                            if (i == 0) {
                                return true;
                            }
                            var goods_pic = '<div class="image-picker-view-item"><input class="image-picker-input" type="hidden" name="model[goods_pic_list][]" value="' +
                                pic[i] + '"> <div class="image-picker-view" data-responsive="750:700" style="width:224px;height:209px;background-image: url(' + "'" +
                                pic[i] + "'" + ')"> <span class="picker-tip">750×750</span> <span class="picker-delete">×</span></div></div>';
                            goods_pic_list.append(goods_pic);
                        });

                    }


                } else {
                    error.prop('hidden', false).html(res.msg);
                }
            }
        });
    });

    //卡券设置
    $(document).on('click', '.card-add', function () {
        var index = $('.card-list').val();
        if (index == -1) {
            return;
        }
        if (page.goods_card_list.length >= 10) {
            return;
        }
        page.goods_card_list.push(page.card_list[index]);
    });
    $(document).on('click', '.card-del', function () {
        var index = $(this).data('index');
        page.goods_card_list.splice(index, 1);
    })

    //分销佣金选择
    $(document).on('click', '.share-type', function () {
        var price_type = $(this).children('input');
        if ($(price_type).val() == 1) {
            $('.percent').html('元');
        } else {
            $('.percent').html('%');
        }
    })
</script>

<!-- 规格图片 -->
<script>
    $(document).on('click', '.upload-attr-pic', function () {
        var btn = $(this);
        var input = btn.parents('.input-group').find('.form-control');
        var index = btn.parents('.input-group').attr('data-index');
        $.upload_file({
            accept: 'image/*',
            start: function (res) {
                btn.btnLoading('');
            },
            success: function (res) {
                input.val(res.data.url).trigger('change');
                page.checked_attr_list[index].pic = res.data.url;
            },
            complete: function (res) {
                btn.btnReset();
            },
        });
    });
    $(document).on('click', '.select-attr-pic', function () {
        var btn = $(this);
        var input = btn.parents('.input-group').find('.form-control');
        var index = btn.parents('.input-group').attr('data-index');
        $.select_file({
            success: function (res) {
                input.val(res.url).trigger('change');
                page.checked_attr_list[index].pic = res.url;
            }
        });
    });
    $(document).on('click', '.delete-attr-pic', function () {
        var btn = $(this);
        var input = btn.parents('.input-group').find('.form-control');
        var index = btn.parents('.input-group').attr('data-index');
        input.val('').trigger('change');
        page.checked_attr_list[index].pic = '';
    });
</script>