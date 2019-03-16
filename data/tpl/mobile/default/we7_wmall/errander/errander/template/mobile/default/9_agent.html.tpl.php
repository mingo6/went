<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<link href="../addons/we7_wmall/plugin/errander/static/css/mobile/index.css" rel="stylesheet" type="text/css"/>
<style>
	.errander-agent .icon.icon-xiangshang2{vertical-align: middle}
	.errander-agent .icon.icon-xiangxia2{vertical-align: middle}
	.errander-agent .city-container{position: relative; background-color: #fff;}
	.errander-agent .city-container .current-city{padding: 0.5rem; font-size: 0.7rem; line-height: 0.8rem;}
	.errander-agent .city-container .contacts-block{margin: 0;}
	.errander-agent .city-container .city-list{overflow: auto; height: 100%;}
	.errander-agent .city-container .city-list .city-item a{color: #3d1415;}
	.errander-agent .index-list-bar{z-index: 100001; color: #3d1415;}
</style>
<div class="page errander-agent">
	<div class="content">
		<div class="city-container">
			<div class="current-city">
				<?php  if(!empty($_W['agent'])) { ?>
				当前城市: <span class="color-danger"><?php  echo $_W['agent']['area'];?></span>
				<?php  } else { ?>
				请选择所在区域
				<?php  } ?>
			</div>
			<div class="city-list list-block contacts-block">
				<?php  if(is_array($initials)) { foreach($initials as $initial) { ?>
					<div class="list-group">
						<ul>
							<li class="list-group-title"><?php  echo $initial['initial'];?></li>
							<?php  if(is_array($initial['agent'])) { foreach($initial['agent'] as $key => $agent) { ?>
								<li class="city-item">
									<a href="<?php  echo imurl('errander/index', array('agentid' => $agent['id']));?>">
										<div class="item-content">
											<div class="item-inner <?php  if($key != 0) { ?>border-1px-t<?php  } ?>">
												<div class="item-title"><?php  echo $agent['area'];?></div>
											</div>
										</div>
									</a>
								</li>
							<?php  } } ?>
						</ul>
					</div>
				<?php  } } ?>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	$(document).on('click', '#select-city', function() {
		var $this = $('#select-city span');
		if($this.hasClass('icon-xiangxia2')) {
			$this.removeClass('icon-xiangxia2').addClass('icon-xiangshang2');
			$('.city-container').removeClass('hide');
			$('.category-container').addClass('hide');
			$('.footer-bar').addClass('hide').removeClass('bar-tab');
			$('.index-list-bar').show();
			return false;
		}
		$this.removeClass('icon-xiangshang2').addClass('icon-xiangxia2');
		$('.city-container').addClass('hide');
		$('.category-container').removeClass('hide');
		$('.footer-bar').removeClass('hide').addClass('bar-tab');
		$('.index-list-bar').hide();
	});
})
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>