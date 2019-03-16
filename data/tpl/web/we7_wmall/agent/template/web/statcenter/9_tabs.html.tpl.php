<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	数据
</div>
<div class="nav slimscroll">
	<div class="menu-header">外卖</div>
	<ul class="menu-item">
		<?php  if(check_perm('statcenter.takeout')) { ?>
			<li <?php  if($_W['_action'] == 'takeout') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('statcenter/takeout');?>">外卖统计</a>
			</li>
		<?php  } ?>
	</ul>
</div>
