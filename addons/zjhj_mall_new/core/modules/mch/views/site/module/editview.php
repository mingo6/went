<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/4
 * Time: 13:43
 */
defined('YII_RUN') or exit('Access Denied');
$urlManager = Yii::$app->urlManager;
$this->title = '模板编辑';
$this->params['active_nav_group'] = 15;
$statics = Yii::$app->request->baseUrl . '/statics';
?>

<style>
    .pick-image-modal .upload-image-item {
        height:150px !important;
    }
    .image-picker-view {
        height:230px !important;
    }
</style>
<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off" action="<?= $urlManager->createUrl(['mch/site/module/editmd','id'=>$v['id']]) ?>" data-return="<?= $urlManager->createUrl(['mch/site/module/index']) ?>">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/module/index']) ?>">我的模板</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="form-body white-bg border-7">
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">模板名称</label>
                </div>
                <div class="col-9">
                    <input type="hidden" name="id" value="<?= $module['id'] ?>">
                    <input class="form-control" type="text" name="model[name]" value="<?= $module['name'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="offset-1 col-9 col-form-label text-danger">设置名称便于辨识不同模板</label>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">排序序号</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" step="1" name="model[number]"
                           value="<?= $module['number'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="offset-1 col-9 col-form-label text-danger">填入数字，越大越前</label>
            </div>

           
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">模板图标</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[img]',
                        'value' => $module['img'],
                        'width' => 750,
                        'height' => 400,
                    ]) ?>
                </div>
            </div>



            <div class="form-group row">
                <label class="offset-1 col-9 col-form-label text-danger"></label>
            </div>


            <!-- <div class="form-group row">
                <div class="col-9 offset-sm-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <button type='submit' class="btn btn-orange" href="javascript:">保存</button>
                </div>
            </div> -->
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
</div>

<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.config.js?v=1.9.6"></script>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.all.min.js?v=1.9.6"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var video_picker = $('.video-picker');
        video_picker.each(function (i) {
            var picker = this;
            var el = $(this);
            var btn = el.find('.video-picker-btn');
            var url = el.data('url');
            var input = el.find('.video-picker-input');
            var view = el.find('.video-preview');

            function uploaderVideo() {

                var el_id = $.randomString(32);
                btn.attr("id", el_id);

                var uploader = new plupload.Uploader({
                    runtimes: 'html5,flash,silverlight,html4',
                    browse_button: el_id, // you can pass an id...
                    url: url,
                    flash_swf_url: '<?=$statics?>/mch/js/Moxie.swf',
                    silverlight_xap_url: '<?=$statics?>/mch/js/Moxie.xap',

                    filters: {
                        max_file_size: '50mb',
                        mime_types: [
                            {title: "Video files", extensions: "mp4"}
                        ]
                    },

                    init: {
                        PostInit: function () {

                        },

                        FilesAdded: function (up, files) {
                            $('.form-error').hide();
                            uploader.start();
                            btn.btnLoading("正在上传");
                            uploader.disableBrowse(true);

                            plupload.each(files, function (file) {
                                console.log(file)
                                view.html('<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>');
                            });
                        },
                        FileUploaded: function (uploader, file, responseObject) {
                            if (responseObject.status == undefined || responseObject.status != 200) {
                                return true;
                            }
                            var res = $.parseJSON(responseObject.response);
                            if (res.code != 0) {
                                $('.form-error').html(res.msg).show();
                                return true;
                            }
                            $(input).val(res.data.url);
                            $('.video-check').prop('href', res.data.url);
                            $('.video-preview').find('span').html('100%');
                        },

                        UploadProgress: function (up, file) {
                            var percent = file.percent - 1;
                            $($("#" + file.id).find('b')[0]).html('<span>' + percent + "%</span>");
//                            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                        },

                        Error: function (up, err) {
                            $('.form-error').html('文件大小超出配置').show();
//                            document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
                        },
                        UploadComplete: function (uploader, files) {
                            btn.btnReset();
                            uploader.destroy();
                            uploaderVideo();
                        }
                    }
                });
                uploader.init();
            }

            uploaderVideo();
        });
    });
    $(document).on('change', '.video', function () {
        $('.video-check').attr('href', this.value);
    });
</script>







