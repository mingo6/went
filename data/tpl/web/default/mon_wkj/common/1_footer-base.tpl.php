<?php defined('IN_IA') or exit('Access Denied');?></div>
	<div class="container-fluid footer text-center" role="footer">	
		<div class="friend-link">
			<?php  if(empty($_W['setting']['copyright']['footerright'])) { ?>
				<a href="http://www.qinhantangtop.com">微信开发</a>
				<a href="http://s.we7.cc">微信应用</a>
				<a href="http://www.qinhantangtop.com">勤瀚堂论坛</a>
				<a href="http://www.qinhantangtop.com">联系客服</a>
			<?php  } else { ?>
				<?php  echo $_W['setting']['copyright']['footerright'];?>
			<?php  } ?>
		</div>
		<div class="copyright"><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.qinhantangtop.com"><b>勤瀚堂</b></a> v<?php echo IMS_VERSION;?> &copy; 2014-2015 <a href="http://www.qinhantangtop.com">www.qinhantangtop.com</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?></div>
		<div><?php  if(!empty($_W['setting']['copyright']['icp'])) { ?>备案号：<?php  echo $_W['setting']['copyright']['icp'];?><?php  } ?></div>
	</div>
	<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
	<?php  if(!empty($_GPC['m']) && !in_array($_GPC['m'], array('keyword', 'special', 'welcome', 'default', 'userapi')) || defined('IN_MODULE')) { ?>
	<script>
		if(typeof $.fn.tooltip != 'function' || typeof $.fn.tab != 'function' || typeof $.fn.modal != 'function' || typeof $.fn.dropdown != 'function') {
			require(['bootstrap']);
		}
	</script>
	<?php  } ?>
	</div>
	
</body>
</html>
