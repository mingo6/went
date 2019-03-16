<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style type="text/css">
* {
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: transparent;
}
a:active {
    color: #333;
    appearance: none;
}
body {
    background-color: #f8f8f8;
}
.list {
    padding-bottom: 10px;
}
.list-item {
    background-color: #fff;
    padding: 15px;
    margin-bottom: 10px;
    font-size: 0;
}
.list .list-item:last-child {
    margin-bottom: 0;
}
.list-item > img {
    width: 24%;
    float: left;
}
.info {
    width: 100%;
    padding-left: 25%;
    /*padding-top: 5px;*/
    margin-left: -24%;
    float: left;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
}
.info .grouptitle {
    font-size: 16px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    margin-bottom: 20px;
    color: #333;
}
.info .subinfo .price {
    font-size: 16px;
    margin-bottom: 2px;
    color: red;
    float: left;
}
.info .subinfo .price > span {
    vertical-align: baseline;
}
.info .subinfo .price > span:last-child {
    font-size: 12px;
    text-decoration: line-through;
    color: #666;
}
.info .subinfo > div:last-child {
    font-size: 14px;
    padding: 2px 10px;
    background-color: red;
    color: #fff;
    border-radius: 4px;
    float: right;
}
.load-more {
    padding: 15px 0;
    text-align: center;
    font-size: 14px;
    color: #666;
    display: none;
}
</style>
<script type='text/javascript' src='<?php echo WE7_WMALL_URL;?>static/js/components/light7/iscroll-probe.js' charset='utf-8'></script>
<div class="page">
    <header class="bar bar-nav common-bar-nav">
        <a class="pull-left back" href="<?php  echo imurl('wmall/member/mine');?>"><i class="icon icon-arrow-left"></i></a>
        <h1 class="title">拼团</h1>
    </header>
    <div class="content">
        <!-- <div>拼团活动列表</div> -->
        <!-- <a href="/app/index.php?i=1&c=entry&ctrl=allgroupgoods&ac=details&do=mobile&m=we7_wmall">详情页</a> -->
        <div class="page" ng-controller="group-list">
            <div class="list">
                <!-- <div class="list-item">
                    <img style="visibility: hidden;margin-left: -24%;float: none;" src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/qrcode.png">
                    <img src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/qrcode.png">
                    <div class="info">
                        <div class="grouptitle">标题标题标题标题标题标题标题标题标题标题</div>
                        <div class="subinfo">
                            <div class="price">
                                <span>￥100.00</span>
                                <span>￥200.00</span>
                            </div>
                            <div>1人团</div>
                        </div>
                    </div>
                </div> -->
                <div class="load-more">加载中...</div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    window.onload = function () {
        var flag = false
        var page = 1;
        $(window).scroll(function(){
            var docHeight = $('html, body').height()
            var wHeight = $(window).height()
            var scrollT = $(this).scrollTop()
            if (wHeight + scrollT > docHeight - 50) {
                getlist()
            }
        })

        function getlist () {
            if (flag) return false // 阻止连续加载
            flag = true
            $('.load-more').show()
            $.ajax({
                type: "POST",
                url : "<?php  echo imurl('allgroupgoods/index');?>",
                data: {page:page},
                success: function(res){
                    flag = false
                    if(!res || res.resultCode != 0){
                        $('.load-more').hide()
                        return;
                    }
                    ++page;
                    if (res.data.total==0){
                        var str = '<div style="display: block;padding: 15px 0;text-align: center;font-size: 14px;color: #666;">暂无数据！</div>'
                    }else{
                        var data = res.data.data;
                        var str = ''
                        for (var i = 0; i < data.length; i++) {
                            str += '<a href="<?php  echo imurl('allgroupgoods/details');?>&goods_id=' + data[i].id + '">'
                            str +=     '<div class="list-item">'
                            str +=         '<img style="visibility: hidden;margin-left: -24%;float: none;" src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/qrcode.png">'
                            str +=         '<img src="' + data[i].thumb + '">'
                            str +=         '<div class="info">'
                            str +=             '<div class="grouptitle">'+data[i].name+'</div>'
                            str +=             '<div class="subinfo">'
                            str +=                 '<div class="price">'
                            str +=                     '<span>￥'+data[i].pt_price+'</span>'
                            str +=                     '<span>￥'+data[i].y_price+'</span>'
                            str +=                 '</div>'
                            str +=                 '<div>'+data[i].people+'人团</div>'
                            str +=             '</div>'
                            str +=         '</div>'
                            str +=     '</div>'
                            str += '</a>';
                        }
                    }

                    $('.list').before(str)
                    $('.load-more').hide()
                },
                error: function(){
                    alert('网络错误！');
                },
                dataType: "json"
            });
        }
        getlist(); // 初始化数据
    }
</script>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>