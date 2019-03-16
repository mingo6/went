<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style type="text/css">
	.button-danger.button-fill{
		background-color: #7da6e8;
	}
</style>
<?php  if($ta == 'index') { ?>
<div class="page recharge">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">充值优惠</h1>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="recharge-list row">
			<?php  if(is_array($recharges)) { foreach($recharges as $recharge) { ?>
				<div class="col-33 recharge-item" data-recharge="<?php  echo $recharge['charge'];?>" <?php  if($recharge['back']<=0) { ?>style="display:flex;justify-content:center;align-items:center;"<?php  } ?>>
					<div class="recharge-num">￥<span><?php  echo $recharge['charge'];?></span></div>
					<?php  if($recharge['back']>0) { ?>
					<div class="back-num" data-back="<?php  echo $recharge['back'];?>" data-type="<?php  echo $recharge['type'];?>">
						送<?php  echo $recharge['back'];?><?php  if($recharge['type'] == 'credit1') { ?>积分<?php  } else { ?>元<?php  } ?>
					</div>
					<?php  } ?>
					<span class="selected-status"></span>
				</div>
			<?php  } } ?>
			<div class="col-33 recharge-item last-item" data-recharge="0">
				<input type="text" class="hide" placeholder="输入金额" name="inputpay" id="inputpay" value="">
				<span class="entry-text">其他金额</span>
				<span class="selected-status"></span>
			</div>
		</div>
		<div class="list-block">
			<ul>
				<li class="item-content">
					<div class="item-inner">
						<div class="item-title">支付金额</div>
						<div class="item-after pay-num" data-charge="0">￥0元</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="content-block">
			<a href="javascript:;" class="button button-danger button-fill button-big btn-submit">确认充值</a>
		</div>
	</div>
</div>
<script>
$(function() {
	$(document).on('click', '.recharge-item', function() {
		$('#inputpay').addClass('hide');
		$('.recharge-item').removeClass('selected');
		$(this).addClass('selected');
		var recharge = $(this).data('recharge');
		if($(this).hasClass('last-item')) {
			$('#inputpay').removeClass('hide').focus();
			recharge = $('#inputpay').val() ? $('#inputpay').val() : 0;
		};
		$('.pay-num').html('￥' +recharge+ '元');
		$('.pay-num').attr('data-charge', recharge);
	});

	$('#inputpay').bind('input propertchange', function() {
		$('.recharge-item').removeClass('selected');
		var recharge = $('#inputpay').val();
		$('.pay-num').text('￥' + recharge + '元');
		$('.pay-num').attr('data-charge', recharge);
	});

	$('.btn-submit').click(function(){
		var $this = $(this);
		var price = parseFloat($('.pay-num').data('charge'));
		if(isNaN(price) || !price) {
			$.toast('充值金额有误');
			return false;
		}
		$this.addClass('disabled');
		$.post("<?php  echo imurl('wmall/member/recharge/submit');?>", {price: price}, function(data){
			var result = $.parseJSON(data);
			$this.removeClass('disabled');
			if(result.message.errno == -1) {
				$.toast(result.message.message);
			} else {
				$.toast('下单成功');
				location.href = "<?php  echo imurl('system/paycenter/pay', array('order_type' => 'recharge'));?>&id=" + result.message.message;
			}
		});
	});
});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>