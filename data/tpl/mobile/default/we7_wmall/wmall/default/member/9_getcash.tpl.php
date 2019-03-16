<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>
.button.button-fill {
    background: #7da6e8;
}
</style>
<link rel="stylesheet" href="../addons/we7_wmall/template/mobile/manage/static/css/manage.css?t=1535789955">
<div class="page getcash">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back" style="position: relative;z-index: 20;padding: .5rem .1rem;font-size: 1rem;line-height: 1.2rem;"></a>
		<h1 class="title">申请提现</h1>
	</header>
	<div class="content">
		<div class="takeout-title border-1px-tb">账户可用余额：<span>¥<?php  echo $account['credit2'];?></span></div>
		<ul class="takeout-list border-1px-tb">
			<li>
				<div class="takeout-item-left">微信号</div>
				<div class="takeout-item-input">
					<input type="text" id="wx_account" value="">
				</div>
				<div class="takeout-item-left">提现金额</div>
				<div class="takeout-item-right">
					<div class="takeout-item-input">
						<input type="text" placeholder="0" id="fee" value="">
					</div>
					<p class="takeout-rule">最低提现金额为<?php  echo $account["fee_limit"];?>元</p>
					<p class="takeout-rule">提现费率为<?php  echo $account["fee_rate"];?>%,最低收取<?php  echo $account["fee_min"];?>元<?php  if($account['fee_max'] > 0) { ?>,最高收取<?php  echo $account['fee_max'];?>元<?php  } ?></p>
					<p class="takeout-rule">申请提现之后，24小时内会有工作人员联系您的微信，请注意查看微信消息</p>
					<?php  if($account['credit2'] < $account['fee_limit']) { ?>
						<a href="#" class="button button-big button-fill button-success disabled">不足<?php  echo $account['fee_limit'];?>元</a>
					<?php  } else { ?>
						<a href="#" class="button button-big button-fill button-danger">提现</a>
					<?php  } ?>
				</div>
			</li>
		</ul>
	</div>
</div>

<script>
$(function(){
	$('.button-danger').click(function(){
		var $this = $(this);
		if($this.hasClass('disabled')) {
			return false;
		}
		var account = <?php  echo json_encode($account);?>;
		var fee = parseFloat($.trim($('#fee').val()));
		var wx_account = $.trim($('#wx_account').val());
		if (!wx_account){
            $.toast('请填写提现微信号');
            return false;
		}
		if(isNaN(fee)) {
			$.toast('提现金额有误');
			return false;
		}
		if(fee > account.credit2) {
			$.toast('提现金额大于账户可用余额');
			return false;
		}
		if(fee < account.fee_limit) {
			$.toast('提现金额不能小于' + account.fee_limit + '元');
			return false;
		}
		var rule_fee = (fee * account.fee_rate/100).toFixed(2);
		rule_fee = Math.max(rule_fee, account.fee_min);
		if(account.fee_max > 0) {
			rule_fee = Math.min(rule_fee, account.fee_max);
		}
		rule_fee = parseFloat(rule_fee);
		var final_fee = (fee - rule_fee).toFixed(2);
		var tips = "提现金额" + fee + "元, 手续费" + rule_fee + "元,实际到账" + final_fee + "元, 确定提现吗";
		$.confirm(tips, function(){
			if(final_fee <= 0) {
				$.toast('实际到账金额小于0元, 不能进行提现');
				return false;
			}
			$this.addClass('disabled');
			$.post("<?php  echo imurl('wmall/member/getcash');?>", {fee: fee, wx_account: wx_account}, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno == -1) {
					$.toast(result.message.message);
					$this.removeClass('disabled');
				} else {
					$.toast('申请提现成功, 平台会尽快处理', "<?php  echo imurl('wmall/member/mine');?>");
				}
				return false;
			});
		});
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>