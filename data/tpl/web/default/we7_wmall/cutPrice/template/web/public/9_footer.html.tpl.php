<?php defined('IN_IA') or exit('Access Denied');?>		</div>
	</div>
	<div class="footer">
		<ul class="links container-fluid">
			<li class="links_item"><p class="copyright"><?php  echo $_W['setting']['copyright']['footerleft'];?></p> </li>
		</ul>
	</div>
	<div id="page-loading">
		<div>
			<div class="sk-spinner sk-spinner-three-bounce">
				<div class="sk-bounce1"></div>
				<div class="sk-bounce2"></div>
				<div class="sk-bounce3"></div>
			</div>
		</div>
	</div>
<?php  include itemplate('public/tiny', TEMPLATE_INCLUDEPATH);?>
<?php  include itemplate('public/footer-base', TEMPLATE_INCLUDEPATH);?>
