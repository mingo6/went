<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<div class="menu-header">超级红包</div>
	<ul class="menu-item">
		<?php  if(check_perm('superRedpacket.grant')) { ?>
			<li <?php  if($_W['_action'] == 'grant') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('superRedpacket/grant')?>">发放红包</a>
			</li>
		<?php  } ?>
		<?php  if(check_perm('superRedpacket.share')) { ?>
			<li <?php  if($_W['_action'] == 'share') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('superRedpacket/share')?>">分享红包</a>
			</li>
		<?php  } ?>
		<?php  if(check_plugin_exist('superRedpacket_meal')) { ?>
			<?php  if(check_perm('superRedpacket.meal')) { ?>
				<li <?php  if($_W['_action'] == 'meal') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('superRedpacket/meal')?>">套餐红包</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('superRedpacket.mealOrder')) { ?>
				<li <?php  if($_W['_action'] == 'mealOrder') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('superRedpacket/mealOrder')?>">购买记录</a>
				</li>
			<?php  } ?>
		<?php  } ?>
	</ul>
	<div class="menu-header">入口</div>
	<ul class="menu-item">
		<?php  if(check_perm('superRedpacket.urls')) { ?>
		<li <?php  if($_W['_action'] == 'urls') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('superRedpacket/urls')?>" title="套餐红包购买链接">套餐红包入口</a>
		</li>
		<?php  } ?>
	</ul>
</div>
