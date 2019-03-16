<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	账号管理
</div>
<div class="nav slimscroll">
	<?php  if(check_perm('agent/setting')) { ?>
		<div class="menu-header">设置</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'setting') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('agent/setting');?>">账号设置</a>
			</li>
		</ul>
	<?php  } ?>
</div>
