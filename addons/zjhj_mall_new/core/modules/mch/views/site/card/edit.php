<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/4
 * Time: 13:43
 */
defined('YII_RUN') or exit('Access Denied');
$urlManager = Yii::$app->urlManager;
$this->title = '文章编辑';
$this->params['active_nav_group'] = 15;
$statics = Yii::$app->request->baseUrl . '/statics';
?>

<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/card/index']) ?>">名片列表</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off"
          data-return="<?= $urlManager->createUrl(['mch/site/card/index']) ?>" action="<?= $urlManager->createUrl(['mch/site/card/addcard']) ?>">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/card/index']) ?>">名片列表</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>

        <!-- <div class="form-title">文章编辑</div> -->
        <div class="form-body white-bg border-7">
            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">姓名</label>
                </div>
                <div class="col-9">
                    <input type="hidden" name="id" value="<?= $card['id'] ?>">
                    <input class="form-control" type="text" name="data[name]" value="<?= $card['name'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label required">头像</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'data[headimg]',
                        'value' => $card['headimg'],
                        'width' => 750,
                        'height' => 400,
                    ]) ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">手机号</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="data[tel]" value="<?= $card['tel'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">微信号</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="data[wechar]" value="<?= $card['wechar'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">邮箱</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="data[mail]" value="<?= $card['mail'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">公司名</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="data[company]" value="<?= $card['company'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">职位</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="data[position]" value="<?= $card['position'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">地址</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="data[address]" value="<?= $card['address'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">标签</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="data[tag]" value="<?= $card['tag'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">人气数</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" step="1" name="data[see]"
                           value="<?= intval($card['see']) ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">靠谱</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" step="1" name="data[reliable]"
                           value="<?= intval($card['reliable']) ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">转发数</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" step="1" name="data[share]"
                           value="<?= intval($card['share']) ?>">
                </div>
            </div>




            <!-- <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">所属分类</label>
                </div>
                <div class="col-9">
                    <select name="data[sortid]" class="form-control">
                        <?php foreach($sort as $k=>$v){?>
                        <option value="<?php echo $v['id'];?>" <?php if($v['id'] == $card['sortid']){ echo 'selected';}?>><?php echo $v['name'];?></optioin>
                        <?php }?>
                    </select>
                    
                </div>
            </div> -->


            <!-- <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">文章作者</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" step="1" name="data[author]"
                           value="<?= $card['author'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">发布时间</label>
                </div>
                <div class="col-9">
                    <input class="form-control" id="datetimepicker" type="date" step="1" name="data[time]"
                           value="<?php echo date('Y-m-d',$card['time']);?>">
                </div>
            </div> -->

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">个性签名</label>
                </div>
                <div class="col-9">
                    <textarea class="" id="sign" name="data[sign]"><?= $card['sign'] ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">个性签名点赞数</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" step="1" name="data[call]"
                           value="<?= intval($card['call']) ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1 text-left">
                    <label class=" col-form-label">内容</label>
                </div>
                <div class="col-9">
                    <textarea class="" id="editor" name="data[content]"><?= $card['content'] ?></textarea>
                </div>
            </div>



            <div class="form-group row">
                <label class="offset-3 col-9 col-form-label text-danger"></label>
            </div>


            <!-- <div class="form-group row">
                <div class="col-9 offset-sm-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <button class="btn btn-orange submit-btn" href="javascript:">保存</button>
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
    // Custom example logic

    var ue = UE.getEditor('sign', {
        serverUrl: "<?=$urlManager->createUrl(['upload/ue'])?>",
        enableAutoSave: false,
        saveInterval: 600 * 800,
        enableContextMenu: false,
        autoHeightEnabled: false,
    });

    var ue = UE.getEditor('editor', {
        serverUrl: "<?=$urlManager->createUrl(['upload/ue'])?>",
        enableAutoSave: false,
        saveInterval: 600 * 800,
        enableContextMenu: false,
        autoHeightEnabled: false,
    });
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
    $('.num').html($("textarea[name='data[content]']").val().length);
    $(document).on('input propertychange', "textarea[name='data[content]']", function () {
        var a = $(this).val().length;
        $('.form-error').hide();
        if (a > 100) {
            var num = $(this).val().substr(0, 100);
            $(this).val(num);
            $('.form-error').html('详情介绍不能超过100个字').show();
        } else {
            $('.num').html(a)
        }
    });
    $('#datetimepicker').datetimepicker('show');
</script>







