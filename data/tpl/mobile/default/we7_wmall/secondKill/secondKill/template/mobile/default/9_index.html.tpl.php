<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page rush-to-buy">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">秒杀</h1>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="commodity-black-screen"></div>
		<div class="commodity-type-list-box">
			<div class="commodity-type-list">
				<div class="commodity-type-li active" id="0" onclick="get_commodity_list(0)">全部</div>
				<?php  if(is_array($category)) { foreach($category as $item) { ?>
					<div class="commodity-type-li" onclick="get_commodity_list(<?php  echo $item['id'];?>)"><?php  echo $item['name'];?></div>
				<?php  } } ?>
			</div>
			<div class="commodity-type-list-more"><img id="no-more" src="../addons/we7_wmall/plugin/secondKill/static/img/bottom.png"></div>
		</div>
		<div class="commodity-list">

		</div>
	</div>
</div>
<script>
	$(function(){
		if($('.commodity-type-li').length > 4){
			$('.commodity-type-list-more').show();
		}
	})
	$('.commodity-type-list-more img').click(function(){
		if($(this).attr('id') == 'no-more'){
			$(this).attr('id', 'more');
			$(this).attr('src', '../addons/we7_wmall/plugin/secondKill/static/img/top.png');
			$('.commodity-type-list').css('height', 'auto');
			$('.commodity-black-screen').show();
			$('.commodity-black-screen').click(function(){
				$(this).hide();
				more_hide();
			})
		}else{
			more_hide();
		}
	})
	function more_hide(){
		$('.commodity-type-list-more img').attr('id', 'no-more');
		$('.commodity-type-list-more img').attr('src', '../addons/we7_wmall/plugin/secondKill/static/img/bottom.png');
		$('.commodity-type-list').css('height', '2rem');
		$('.commodity-black-screen').hide();
	}
	$('.commodity-type-li').click(function(){
		if(!$(this).hasClass('active')){
			for (var i = 0; i < $('.commodity-type-li').length; i++) {
				if($('.commodity-type-li').eq(i).hasClass('active')){
					$('.commodity-type-li').eq(i).removeClass('active');
				}
			}
			$(this).addClass('active');
		}
	})


    function get_commodity_list(type_id){
        $.ajax({
            url: '<?php  echo $ajax_url;?>',
            type: 'GET',
            data: { type_id: type_id },
            dataType:'json',
            success: function(res) {
                if(res.status == 1){
                    var html = ''
                    for (var i = 0; i < res.data.length; i++) {
                        html += '<div class="commodity-item">'
                        html += 	'<div class="commodity-item-img" style="background-image:url(/attachment/' + res.data[i].thumb + ');"></div>'
                        html += 	'<div class="commodity-item-explain">'
                        html += 		'<div class="commodity-item-name commodity-item-row">' + res.data[i].name + '</div>'
                        html += 		'<div class="commodity-item-type commodity-item-row">' + res.data[i].introduction + '</div>'
                        html += 		'<div class="commodity-item-number commodity-item-row"><span>限量' + res.data[i].number + '份</span></div>'
                        html += 		'<div class="commodity-item-price-box commodity-item-row">'
                        html += 			'<div class="commodity-item-dis-price">￥' + res.data[i].s_price + '</div>'
                        html += 			'<div class="commodity-item-price">￥' + res.data[i].y_price + '</div>'
                        html += 			'<div class="commodity-item-surplus">剩' + res.data[i].surplus + '份</div>'
                        html += 		'</div>'
                        html += 		'<div class="commodity-item-progress-box commodity-item-row">'
                        html += 			'<div class="commodity-item-progress">'
                        html += 				'<div class="commodity-item-progress-active" style="width:' + res.data[i].progress + '%;"></div>'
                        html += 				'<div class="commodity-item-progress-value">' + res.data[i].progress + '%</div>'
                        html += 			'</div>'
						if (res.data[i].is_end==1){
                            html += 			'<div class="commodity-item-rush" style="background-color: #A9A9A9;">'
                            html +=					'<a href="' + res.data[i].url + '">'
                            html +=				'已结束'
						}else{
                            html += 			'<div class="commodity-item-rush">'
                            html +=					'<a href="' + res.data[i].url + '">'
                            html +=				'马上抢<img src="../addons/we7_wmall/plugin/secondKill/static/img/right.png">'
						}

                        html +=					'</a>'
                        html +=				'</div>'
                        html += 		'</div>'
                        html += 	'</div>'
                        html += '</div>'
                    }

                }else{
                    var html = '<div class="commodity-list-empty">暂无相关数据~</div>'
                    $('.rush-to-buy').css('background-color', 'white');
                }
                $('.commodity-list').html(html)
            }
        })
    }
    get_commodity_list(0);
</script>
<style>
.bar-tab{display:none;}
</style>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>