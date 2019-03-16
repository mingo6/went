<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 11:36
 */

$urlManager = Yii::$app->urlManager;
$this->title = '运费规则编辑';
$this->params['active_nav_group'] = 1;
?>

<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/postage-rules']) ?>">运费规则</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3" id="app">
    <form class="form auto-submit-form" method="post" autocomplete="off" data-return="<?=$urlManager->createUrl(['mch/store/postage-rules'])?>">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/postage-rules']) ?>">运费规则</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- <div class="form-title">运费规则编辑</div> -->
        <div class="form-body white-bg border-b-l border-b-r">

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">规则名称</label>
                </div>
                <div class="col-4">
                    <input class="form-control" type="text" name="name" value="<?= $model->name ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">计费方式</label>
                </div>
                <div class="col-4 col-form-label">
                    <label class="custom-control custom-radio">
                        <input <?= $model['type'] == 1 ? 'checked' : 'checked' ?> value="1"
                                                                                         name="type"
                                                                                         type="radio"
                                                                                         class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">按重计费</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input <?= $model['type'] == 2 ? 'checked' : null ?> value="2"
                                                                                         name="type"
                                                                                         type="radio"
                                                                                         class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">按件计费</span>
                    </label>
                </div>
            </div>

            <div class="form-group row" hidden>
                <div class="col-1 text-left">
                    <label class=" col-form-label">快递公司</label>
                </div>
                <div class="col-4">
                    <input class="form-control" type="text" name="express" value="<?= $model->express ?>">
                    <select class="form-control" name="express_id" hidden>
                        <option value="0">无</option>
                        <?php foreach ($express_list as $express): ?>
                            <option value="<?= $express->id ?>" <?= $express->id == $model->express_id ? 'selected' : '' ?>><?= $express->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>



            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">运费规则</label>
                </div>
                <div class="col-4">
                    <div class="card mb-3" v-for="(item,index) in detail">
                        <div class="card-block">
                            <div class="mb-3">
                                <span><span class="show-frist"> 首重/件(克/个)：</span>{{item.frist}}</span>
                                <span><span class="show-frist-price">首费(元) ：</span>{{item.frist_price}}</span>
                                <span><span class="show-second">续重/件(克/个) ：</span>{{item.second}}</span>
                                <span><span>续费(元) ：</span>{{item.second_price}}</span>

                                <a class="del-rules-btn float-right" href="javascript:" v-bind:data-index="index">[-删除条目]</a>
                            </div>
                            <input type="hidden" v-bind:name="'detail['+index+'][frist]'"
                                   v-model="item.frist">
                            <input type="hidden" v-bind:name="'detail['+index+'][frist_price]'"
                                   v-model="item.frist_price">
                            <input type="hidden" v-bind:name="'detail['+index+'][second]'"
                                   v-model="item.second">
                            <input type="hidden" v-bind:name="'detail['+index+'][second_price]'"
                                   v-model="item.second_price">

                            <div>
                                <span>省份：</span>
                                <span v-for="(province,p_index) in item.province_list">
                                        <span>{{province.name}}</span>
                                        <input type="hidden"
                                               v-bind:name="'detail['+index+'][province_list]['+p_index+'][id]'"
                                               v-model="province.id">
                                        <input type="hidden"
                                               v-bind:name="'detail['+index+'][province_list]['+p_index+'][name]'"
                                               v-model="province.name">
                                    </span>
                            </div>
                        </div>
                    </div>
                    <a class="show-rules-modal" href="javascript:">[+新增条目]</a>
                </div>
            </div>
            <!-- <div class="form-group row">
                <div class="col-4 offset-sm-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                </div>
            </div> -->
        </div>
        <div class="content-p white-bg form-horizontal border-7 mt-3 p-3">
            <div class="form-group row" style="margin: 0;">
                <div class="col-12 text-left">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="col-12 btn btn-default submit-btn" href="javascript:">保存</a>
                </div>
            </div>
        </div>
    </form>


    <!-- 添加运费规则 -->
    <div class="modal fade rules-modal" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b>添加运费规则</b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <b class="frist-title">首重(克) ：</b>
                            <input name="frist" class="form-control mb-3 frist" value="" step="1" type="number">
                        </div>
                        <div class="col-6">
                            <b class="frist-price-title">首费(元) ：</b>
                            <input name="frist_price" class="form-control mb-3 frist_price" placeholder="默认0" value="0" step="1" type="number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <b class="second-title">续重(克) ：</b>
                            <input name="second" class="form-control mb-3 second" placeholder="默认0" value="1" step="1" type="number">
                        </div>
                        <div class="col-6">
                            <b class="second-price-title">续费（元）：</b>
                            <input name="second_price" class="form-control mb-3 second_price" placeholder="默认0" value="0" step="1" type="number">
                        </div>
                    </div>

                    <b>省份</b>
                    <div class="row">
                        <div class="col-4" v-for="(province,index) in province_list" v-if="province.selected!=true">
                            <label>
                                <input name="province"
                                       v-bind:id="'index_'+index"
                                       v-bind:data-index="index"
                                       v-bind:data-id="province.id"
                                       v-bind:data-name="province.name" type="checkbox">
                                {{province.name}}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-orange add-rules-btn">确定</button>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    var app = new Vue({
        el: "#app",
        data: {
            detail: <?=$model->detail ? $model->detail : '[]'?>,
            province_list: [],
        },
    });
    <?php foreach ($province_list as $province):?>
    app.province_list.push({
        id:<?=$province->id?>,
        name: "<?=$province->name?>",
        selected: false,
    });
    <?php endforeach;?>
    for (var i in app.province_list) {
        var selected = false;
        for (var j in app.detail) {
            for (var k in app.detail[j].province_list) {
                if (app.detail[j].province_list[k].id == app.province_list[i].id)
                    selected = true;
            }
        }
        app.province_list[i].selected = selected;
    }

    $(document).on('change',".custom-control-input",function () {
        app.detail = [];
        for (var i in app.province_list) {
            app.province_list[i].selected = false;
        }

        changeType();
    });

    function changeType() {
        var type = $('.custom-control-input:checked').val();
        if (type==1){
            $('.frist-title,.show-frist').text('首重(克) ：');
            $('.frist-price-title,.show-frist-price').text('首费(元) ：');
            $('.second-title,.show-second').text('续重(克) ：');
            $('.frist').val('1000');
            $('.second').val('1000');
        }else {
            $('.frist-title,.show-frist').text('首件(个) ：');
            $('.frist-price-title,.show-frist-price').text('运费(元) ：');
            $('.second-title,.show-second').text('续件(个) ：');
            $('.frist').val('1');
            $('.second').val('1');
        }
    }

    $(document).on("click", ".show-rules-modal", function () {
        changeType();
        $(".rules-modal").modal("show");
    });

    $(document).on("click", ".rules-modal .add-rules-btn", function () {
        var frist = $(".rules-modal input[name=frist]").val();
        var frist_price = $(".rules-modal input[name=frist_price]").val();
        var second = $(".rules-modal input[name=second]").val();
        var second_price = $(".rules-modal input[name=second_price]").val();
        var province_list = [];
        $(".rules-modal input[name=province]").each(function () {
            if ($(this).prop("checked")) {
                var index = $(this).attr("data-index");
                var id = $(this).attr("data-id");
                var name = $(this).attr("data-name");
                app.province_list[index].selected = true;
                province_list.push({
                    id: id,
                    name: name,
                });
            }
        });
        $(".rules-modal input[name=province]").prop("checked", false);
        if (province_list.length > 0) {
            app.detail.push({
                frist: frist,
                frist_price: frist_price,
                second: second,
                second_price: second_price,
                province_list: province_list,
            });
            $(".rules-modal").modal("hide");
        }
    });

    $(document).on("click", ".del-rules-btn", function () {
        var index = $(this).attr("data-index");
        var province_list = app.detail[index].province_list;
        app.detail.splice(index, 1);
        for (var i in app.province_list) {
            for (var j in province_list) {
                if (province_list[j].id == app.province_list[i].id) {
                    app.province_list[i].selected = false;
                }
            }
        }
    });

</script>