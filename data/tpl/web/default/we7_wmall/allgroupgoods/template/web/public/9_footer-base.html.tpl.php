<?php defined('IN_IA') or exit('Access Denied');?>	<audio id="musicClick" src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/resource/mp3/click.mp3" preload="auto"></audio>
	<script type="text/javascript">
		require(['bootstrap']);
		irequire(['filestyle'], function(){
			$(".form-group").find(':file').filestyle({buttonText: '上传'});
		});
		<?php  if($_W['_controller'] == 'store' || $ctrl == 'store') { ?>
			$('form.form-horizontal').each(function(){
				var action = $(this).attr('action');
				var method = $(this).attr('method');
				if((action == './index.php?' || action == './index.php' || action == '' || action == "undefined") && (method != 'post')) {
					$(this).attr('action', './index.php?');
				}
			});
		<?php  } ?>
		irequire(['web/notify', 'web/common'], function(){});

		<?php  if($_W['isfounder'] && !defined('IN_MESSAGE')) { ?>
			if(util.cookie.get('ignoreupgrade') != 1) {
				$.getJSON("<?php  echo iurl('system/cloud/check');?>", function(result){
					if(result && result.message && result.message.upgrade == '1') {
						$('body').append('<div class="panel panel-default panel-checkupgrade"><div class="panel-body"><span class="tclose"><i class="fa fa-times-circle"></i></span><div class="title">外送模块检测到更新</div><div class="content">新版本 '+ result.message.version + '-' + result.message.release + ',请尽快更新!</div><div class="buttons"><a href="<?php  echo iurl('system/cloud/upgrade');?>" class="btn btn-warning btn-sm">立即去更新</a></div></div></div>');
					}
				});
			}
			$(document).on('click', '.panel-checkupgrade .fa-times-circle', function(){
				util.cookie.set('ignoreupgrade', 1, 3600);
				$('.panel-checkupgrade').fadeOut(150);
			});
		<?php  } ?>

		$(function(){
			<?php  if($_GPC['_status_order_notice'] || $_GPC['_status_errander_notice'] || $_GPC['_status_store_order_notice']) { ?>
				setInterval(function(){
					$.post("<?php  echo iurl('common/cron/order_notice', array('_ctrl' => $_GPC['ctrl'], '_ac' => $_GPC['ac'], '__sid' => $sid));?>", function(data){
						if(data == 'success') {
							$("#musicClick")[0].play();
						}
					});
				}, 7000);
			<?php  } ?>
			$.post("<?php  echo iurl('common/cron/task');?>", function(){});
			setInterval(function(){
				$.post("<?php  echo iurl('common/cron/order_notice', array('_ctrl' => $_GPC['ctrl'], '_ac' => $_GPC['ac']));?>", function(data){
					if(data == 'success') {
						$("#musicClick")[0].play();
					}
				});
				$.post("<?php  echo iurl('common/cron/task');?>", function(){});
				<?php  if($_W['clerk']) { ?>
					$.post("<?php  echo iurl('common/notice');?>", function(data){
						if(data > 0) {
							$('#notice-total').removeClass('hide');
							$('#notice-total').html(data);
						} else {
							$('#notice-total').addClass('hide');
						}
					});
				<?php  } ?>
			}, 30000);
		});
	</script>
	<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
</body>
</html>
