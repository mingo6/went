define(['core', 'tpl', 'biz/member/op'], function(core, tpl, op) {
    var modal = {
        params: {}
    };
    modal.init = function(params) {
        modal.params.orderid = params.orderid;
        op.init({
            fromDetail: true
        });
        $('.btn-cancel').click(function() {
            if ($(this).attr('stop')) {
                return
            }
            FoxUI.confirm('确定您要取消申请?', '', function() {
                $(this).attr('stop', 1).attr('buttontext', $(this).html()).html('正在处理..');
                core.json('member/aftersale/cancel', {
                    'id': modal.params.orderid
                }, function(postjson) {
                    if (postjson.status == 1) {
                        location.href = core.getUrl('member/aftersale', {
                            id: modal.params.orderid
                        });
                        return
                    } else {
                        FoxUI.toast.show(postjson.result.message)
                    }
                    $('.btn-cancel').removeAttr('stop').html($('.btn-cancel').attr('buttontext')).removeAttr('buttontext')
                }, true, true)
            })
        });
    };
    return modal
});