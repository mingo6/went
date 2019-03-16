<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>
.my-qrcode-img-txt{display:flex;align-items:center;justify-content:center;margin-bottom:1rem;}
.my-qrcode-img-txt img{width:2.5rem;height:2.5rem;vertical-align:middle;margin-right:.75rem;border-radius:50%;}
.my-qrcode-img-txt .txt{font-size:.7rem;line-height:1.25rem;color:white;}
</style>
<div class="page my-qrcode">
    <header class="bar bar-nav">
        <a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
        <h1 class="title">我的二维码</h1>
    </header>
    <div class="content" style="background:url(../addons/we7_wmall/static/img/qrcode_bg.png) no-repeat top center/cover;">
        <div class="my-qrcode-img-box">
            <div class="my-qrcode-img-txt">
                <div>
                    <img src="<?php  echo $user_info['avatar'];?>">
                </div>
                <div class="txt">
                    <div><?php  echo $user_info['nickname'];?></div>
                    <div>ID:<?php  echo $user_info['uid'];?></div>
                </div>
            </div>
            <div class="my-qrcode-img">
                 <img class="ewm" src="#"/>
            </div>
        </div>
    </div>
<script type="text/javascript" src="../addons/we7_wmall/static/js/qrcode.js"></script>
<script type="text/javascript">
    var url = "<?php  echo $code_url;?>";
    var qr = qrcode(10, 'M');
    qr.addData(url);
    qr.make();
    $(".my-qrcode-img").html(qr.createImgTag());
    $(".my-qrcode-img img").addClass('ewm');
    $(".my-qrcode-img img").removeAttr('width');
    $(".my-qrcode-img img").removeAttr('height');
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>