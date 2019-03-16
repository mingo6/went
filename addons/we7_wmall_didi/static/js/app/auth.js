define(["tiny"], function(a) {
    var b = {};
    return b.initLogin = function(b) {
        $(".button-login").click(function() {
            var c = $(this);
            if ($(this).hasClass("disabled")) return false;
            var d = $.trim($('input[name="mobile"]').val());
            if (!d) return $.toast("请输入手机号"), false;
            if (!/^[01][3456789][0-9]{9}/.test(d)) return $.toast("手机号格式错误"), false;
            var e = $.trim($('input[name="password"]').val());
            return e ? (c.addClass("disabled"), $.post(a.getUrl("wmall/auth/login"), {
                mobile: d,
                password: e,
                forward: b
            }, function(a) {
                var b = $.parseJSON(a);
                b.message.errno ? ($.toast(b.message.message), c.removeClass("disabled")) : $.toast("登陆成功", b.message.message)
            }), false) : ($.toast("请输入密码"), false)
        })
    }, b.sendCode = function(b) {
        $(".button-code").click(function() {
            var c = $(this);
            if ($(this).hasClass("disabled")) return false;
            var d = $.trim($('input[name="mobile"]').val());
            if (!d) return $.toast("请输入手机号"), false;
            if (!/^[01][3456789][0-9]{9}/.test(d)) return $.toast("手机号格式错误"), false;
            var e = $.trim($('input[name="captcha"]').val());
            return e ? ($.post(a.getUrl("system/common/code"), {
                mobile: d,
                product: b,
                captcha: e
            }, function(a) {
                if ("success" != a) $.toast(a);
                else {
                    c.addClass("disabled");
                    var b = 60;
                    c.html(b + "秒后重新获取");
                    var d = setInterval(function() {
                        b--, b <= 0 ? (clearInterval(d), c.html("获取验证码"), c.removeClass("disabled"), b = 60) : c.html(b + "秒后重新获取")
                    }, 1e3);
                    $.toast("验证码发送成功, 请注意查收")
                }
            }), false) : ($.toast("请输入图形验证码"), false)
        })
    }, b.initRegister = function() {
        b.sendCode("注册用户"), $(".button-register").click(function() {
            var b = $(this);
            if ($(this).hasClass("disabled")) return false;
            var c = $.trim($('input[name="mobile"]').val());
            if (!c) return $.toast("请输入手机号"), false;
            var bucket_num = $.trim($('input[name="bucket_num"]').val());
            if (!bucket_num) return $.toast("请输入桶数量"), false;
            var drinking_fountain_num = $.trim($('input[name="drinking_fountain_num"]').val());
            if (!drinking_fountain_num) return $.toast("请输入饮水数量"), false;
            var d = /^[01][3456789][0-9]{9}/;
            if (!d.test(c)) return $.toast("手机号格式错误"), false;
            var e = $.trim($('input[name="code"]').val());
            if (!e) return $.toast("请输入短信验证码"), false;
            var f = $.trim($('input[name="password"]').val());
            if (!f) return $.toast("请输入密码"), false;
            var g = f.length;
            if (g < 8 || g > 20) return $.toast("请输入8-20位密码"), false;
            var d = /[0-9]+[a-zA-Z]+[0-9a-zA-Z]*|[a-zA-Z]+[0-9]+[0-9a-zA-Z]*/;
            if (!d.test(f)) return $.toast("密码必须由数字和字母组合"), false;
            var h = $.trim($('input[name="repassword"]').val());
            var isAgreement = $('input[name="agreement"]').is(':checked') ? 1 : 0;
            var region_id = $.trim($('select[name="region_id"]').val());
            if(!isAgreement){
                return $.toast("请同意协议！"), false;
            }
            return h ? f != h ? ($.toast("两次密码输入不一致"), false) : (b.addClass("disabled"), $.post(a.getUrl("wmall/auth/register"), {
                mobile: c,
                password: f,
                code: e,
                bucket_num: bucket_num,
                drinking_fountain_num: drinking_fountain_num,
                isAgreement: isAgreement,
                region_id: region_id,
            }, function(a) {
                var c = $.parseJSON(a);
                c.message.errno ? ($.toast(c.message.message), b.removeClass("disabled")) : $.toast("注册成功", c.message.message)
            }), false) : ($.toast("请重复输入密码"), false)
        })
    }, b.initForget = function() {
        b.sendCode("找回密码"), $(".button-forget").click(function() {
            var b = $(this);
            if ($(this).hasClass("disabled")) return false;
            var c = $.trim($('input[name="mobile"]').val());
            if (!c) return $.toast("请输入手机号"), false;
            var d = /^[01][3456789][0-9]{9}/;
            if (!d.test(c)) return $.toast("手机号格式错误"), false;
            var e = $.trim($('input[name="code"]').val());
            if (!e) return $.toast("请输入短信验证码"), false;
            var f = $.trim($('input[name="password"]').val());
            if (!f) return $.toast("请输入密码"), false;
            var g = f.length;
            if (g < 8 || g > 20) return $.toast("请输入8-20位密码"), false;
            var d = /[0-9]+[a-zA-Z]+[0-9a-zA-Z]*|[a-zA-Z]+[0-9]+[0-9a-zA-Z]*/;
            if (!d.test(f)) return $.toast("密码必须由数字和字母组合"), false;
            var h = $.trim($('input[name="repassword"]').val());
            return h ? f != h ? ($.toast("两次密码输入不一致"), false) : (b.addClass("disabled"), $.post(a.getUrl("wmall/auth/forget"), {
                mobile: c,
                password: f,
                code: e
            }, function(a) {
                var c = $.parseJSON(a);
                c.message.errno ? ($.toast(c.message.message), b.removeClass("disabled")) : $.toast("设置新密码成功", c.message.message)
            }), false) : ($.toast("请重复输入密码"), false)
        })
    }, b
});