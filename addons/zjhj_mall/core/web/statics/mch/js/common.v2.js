/*---- 文件上传 start ----*/
var _pl_file_uploader = {
    id: $.randomString(),
    uploader: null,
    input: null,
    start: null,
    progress_timer: null,
    progress: null,
    success: null,
    error: null,
    complete: null,
    dataType: 'json',
};
$(document).ready(function () {
    $('body').append('<a id="' + _pl_file_uploader.id + '" href="javascript:" style="display: none!important;">pl_file_element</a>');

    function uploader_init() {
        _pl_file_uploader.uploader = new plupload.Uploader({
            browse_button: _pl_file_uploader.id, //触发文件选择对话框的按钮，为那个元素id
            url: _upload_url, //服务器端的上传页面地址
        });
        _pl_file_uploader.uploader.bind('Init', function (uploader) {
            _pl_file_uploader.input = $('#' + _pl_file_uploader.id + ' ~ .moxie-shim input[type=file]');
        });
        _pl_file_uploader.uploader.bind('FilesAdded', function (uploader, files) {
            if (typeof _pl_file_uploader.start === 'function') {
                _pl_file_uploader.start();
            }
            if (typeof _pl_file_uploader.progress === 'function') {
                _pl_file_uploader.progress_timer = setInterval(function () {
                    _pl_file_uploader.progress(_pl_file_uploader.uploader.total);
                }, 200);
            }
            _pl_file_uploader.uploader.start();
        });
        _pl_file_uploader.uploader.bind('FileUploaded', function (uploader, file, responseObject) {
            if (responseObject.status === 200 && typeof _pl_file_uploader.success === 'function') {
                var res = null;
                if (_pl_file_uploader.dataType === 'json') {
                    res = JSON.parse(responseObject.response);
                } else {
                    res = responseObject.response;
                }
                _pl_file_uploader.success(res);
            }
        });
        _pl_file_uploader.uploader.bind('UploadComplete', function (uploader, files) {
            if (_pl_file_uploader.progress_timer)
                clearInterval(_pl_file_uploader.progress_timer);
            if (typeof _pl_file_uploader.complete === 'function') {
                _pl_file_uploader.complete();
            }
            _pl_file_uploader.uploader.destroy();
            uploader_init();
        });
        _pl_file_uploader.uploader.bind('Error', function (uploader, errObject) {
            if (typeof _pl_file_uploader.error === 'function') {
                _pl_file_uploader.error(errObject);
            }
        });
        _pl_file_uploader.uploader.init();
    }

    uploader_init();

});

$.upload_file = function (args) {
    _pl_file_uploader.input.prop('multiple', args.multiple || false);
    _pl_file_uploader.input.attr('accept', args.accept || '*/*');
    _pl_file_uploader.dataType = args.dataType || 'json';
    _pl_file_uploader.dataType = _pl_file_uploader.dataType.toLowerCase();
    _pl_file_uploader.start = args.start || null;
    _pl_file_uploader.progress = args.progress || null;
    _pl_file_uploader.success = args.success || null;
    _pl_file_uploader.error = args.error || null;
    _pl_file_uploader.complete = args.complete || null;
    document.getElementById(_pl_file_uploader.id).click();
};
/*---- 文件上传 end ----*/

/*---- 文件选择 start ----*/
var _file_select = {
    success: null,
};

$(document).on('click', '#file_select_modal .file-item', function () {
    var item = $(this);
    if (typeof _file_select.success === 'function') {
        _file_select.success({
            name: item.attr('data-name'),
            url: item.attr('data-url'),
        });
    }
    $('#file_select_modal').modal('hide');
});

$(document).on('click', '#file_select_modal .file-more', function () {
    var list_block = $('#file_select_modal .file-list');
    var more_btn = $('#file_select_modal .file-more');
    var loading_block = $('#file_select_modal .file-loading');
    var page = parseInt(more_btn.attr('data-page'));
    loading_block.show();
    more_btn.hide();
    $.ajax({
        url: _upload_file_list_url,
        data: {
            dataType: 'html',
            type: 'image',
            page: page,
        },
        success: function (res) {
            more_btn.attr('data-page', page + 1);
            loading_block.hide();
            more_btn.show();
            list_block.append(res);
        }
    });
});

$.select_file = function (args) {
    $('#file_select_modal').modal('show');
    var list_block = $('#file_select_modal .file-list');
    var more_btn = $('#file_select_modal .file-more');
    var loading_block = $('#file_select_modal .file-loading');
    list_block.html('');
    loading_block.show();
    more_btn.hide();
    $.ajax({
        url: _upload_file_list_url,
        data: {
            dataType: 'html',
            type: 'image',
            page: 1,
        },
        success: function (res) {
            more_btn.attr('data-page', 2);
            loading_block.hide();
            more_btn.show();
            list_block.append(res);
        }
    });
    if (typeof args.success === 'function') {
        _file_select.success = args.success;
    }
};
/*---- 文件选择 end ----*/