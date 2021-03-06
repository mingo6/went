<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'auth') { ?>
<div class="page clearfix">
	<h2>授权管理</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-info">
			模块更新日志：<a href="https://denghuo.kf5.com/hc/kb/category/28875/" target="_blank">https://denghuo.kf5.com/hc/kb/category/28875/</a>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">网站URL</label>
			<div class="col-md-6">
				<input type="text" name="domain" value="<?php  echo $params['domain'];?>" class="form-control" required="true" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">IP地址</label>
			<div class="col-md-6">
				<input type="text" name="ip" value="<?php  echo $params['ip'];?>" class="form-control" required="true" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">站点ID</label>
			<div class="col-md-6">
				<input type="text" name="modname" value="<?php  echo $params['modname'];?>" class="form-control" readonly/>
			</div>
		</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">授权码</label>
				<div class="col-md-6">
					<input type="text" name="code" value="<?php  echo $cache['code'];?>" class="form-control">
					<div class="help-block">请联系客服将IP及站点ID提交给客服, 索取授权码，保护好您的授权码，避免泄漏</div>
				</div>
		<div class="form-group">
			<div class="col-md-6">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
				<p class="form-control-static">
					<?php  if(is_array($cache) && !empty($cache['code'])) { ?>
						<span class="label label-success">已授权</span>
					<?php  } else { ?>
						<span class="label label-danger">您的系统尚未授权，请点击 “验证授权” 按钮就行授权验证。</span>
					<?php  } ?>
				</p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="验证授权" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>

<?php  if($op == 'upgrade') { ?>
<div class="page clearfix">
	<h2>授权管理</h2>
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-warning">
			平台所有打印机均属于定制打印机， 客户自行购买的打印机会造成打印不兼容的问题。由自行购买打印机造成的问题, 我们不提售后服务。 如需购买打印机， 请联系客服。<strong class="text-danger">QQ: 10000</strong>
			<br>
			更新时请注意备份网站数据和相关数据库文件！未备份更新出现问题的情况我们不负责任！
			<br>
			<br>
			★★★★★主要提醒：本程序为单独授权模式，发现倒卖停止一切更新★★★★★
			<br>
			<strong class="text-danger">
				各位在更新前， 务必关闭安全狗， 云锁，防火墙等安全防护软件， 否则将更新不成功。因未关闭安全软件造成的更新失败， 不会针对每个客户单独处理。
			</strong>
		</div>
		<?php  if(!empty($upgrade)) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">版本</label>
				<div class="col-sm-10">
					<p><span class="fa fa-square-o"></span>当前版本号:<?php  echo MODULE_VERSION?></p>
								 <?php  if(!empty($upgrade['release']) && $upgrade['release'] != MODULE_RELEASE_DATE ) { ?>
                                  <p><span class="fa fa-square-o"></span>当前发布号:<?php  echo MODULE_RELEASE_DATE?></p>
                                  <p><span class="fa fa-square-o"></span>存在新版本:<?php  echo $upgrade['version'];?>-<?php  echo $upgrade['release'];?></p>
                                  <?php  } ?>
					<div class="help-block">在一个发布版中可能存在多次补丁, 因此版本可能未更新</div>
				</div>
			</div>
			<?php  if(!empty($upgrade['data'])) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">数据库同步情况</label>
					<div class="col-sm-10">
						<div class="help-block"><strong>注意: 重要: 本次更新涉及到数据库变动, 请做好备份.</strong></div>
						<label for="" class="control-label color-gray col-sm-2">需要更新数据库</label>
						<div class="form-controls col-sm-7 form-control-static"><?php  echo count($upgrade['data'])?> 项</div>
						<span class="color-default col-sm-3 text-right"><a href="#upgrade-databases" data-toggle="modal" >查看</a></span>
						
<div class="modal fade" id="upgrade-databases" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog we7-modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">更新数据库</h4>
			</div>
			<div class="modal-body color-dark">
				<?php  if(is_array($upgrade['data'])) { foreach($upgrade['data'] as $line) { ?>
				<div class="row">
					<div class="col-sm-2">表名:</div>
					<div class="col-sm-4"><?php  echo $line['tablename'];?></div>
					<?php  if(!empty($line['new'])) { ?>
					<div class="col-sm-6">New</div>
					<?php  } else { ?>
					<div class="col-sm-6"><?php  if(!empty($line['fields'])) { ?>fields: <?php  echo $line['fields'];?>; <?php  } ?><?php  if(!empty($line['indexes'])) { ?>indexes: <?php  echo $line['indexes'];?>;<?php  } ?></div>
					<?php  } ?>
				</div>
				<?php  } } ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
			</div>
		</div>
	</div>
</div>
					</div>
				</div>
			<?php  } ?>
			<?php  if(!empty($upgrade['files'])) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">文件同步情况</label>
					<div class="col-sm-10 col-md-10">
						<div class="help-block"><strong>注意: 重要: 本次更新涉及到程序变动, 请做好备份.</strong></div>
						<label for="" class="control-label color-gray col-sm-2">需要更新文件</label>
						<div class="form-controls col-sm-7 form-control-static"><?php  echo count($upgrade['files'])?> 个</div>
						<span class="color-default col-sm-3 text-right"><a href="#upgrade-file" data-toggle="modal" >查看</a></span>
<div class="modal fade" id="upgrade-file" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog we7-modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">更新文件</h4>
			</div>
			<div class="modal-body color-dark">
				<?php  if(is_array($upgrade['files'])) { foreach($upgrade['files'] as $line) { ?>
				<div><span style="display:inline-block; width:30px;"><?php  if(is_file(IA_ROOT . $line)) { ?>M<?php  } else { ?>A<?php  } ?></span><?php  echo $line;?></div>
				<?php  } } ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary"  data-dismiss="modal">确定</button>
			</div>
		</div>
	</div>
</div>
					</div>
				</div>
			<?php  } ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">更新协议</label>
				<div class="col-sm-10 col-md-6">
					<div class="checkbox">
						<input type="checkbox" id="agreement_0">
						<label for="agreement_0">我已经做好了相关文件的备份工作</label>
					</div>
					<div class="checkbox">
							<input type="checkbox" id="agreement_1">
							<label for="agreement_1">认同官方的更新行为并自愿承担更新所存在的风险</label>
					</div>
					<div class="checkbox">
						<input type="checkbox" id="agreement_2">
						<label for="agreement_2">理解官方的辛勤劳动并报以感恩的心态点击更新按钮</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
					<input type="button" id="forward" value="立即更新" class="btn btn-primary" />
				</div>
			</div>
		<?php  } else { ?>
			<div class="form-group">
				<div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
					<input name="submit" type="submit" value="立即检查新版本" class="btn btn-primary" />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					<div class="help-block">当前系统未检测到有新版本, 你可以点击此按钮, 来立即检查一次.</div>
				</div>
			</div>
		<?php  } ?>
	</form>
</div>
<?php  if(!empty($upgrade)) { ?>
<script type="text/javascript">
	$('#forward').click(function(){
		var a = $("#agreement_0").is(':checked');
		var b = $("#agreement_1").is(':checked');
		var c = $("#agreement_2").is(':checked');
		if(a && b && c) {
			Notify.confirm('更新将直接覆盖本地文件, 请注意备份文件和数据. \n\n**另注意** 更新过程中不要关闭此浏览器窗口.', function() {
				location.href = "<?php  echo iurl('system/cloud/process')?>";
			});
		} else {
			Notify.error("抱歉，更新前请仔细阅读更新协议！");
			return false;
		}
	});
</script>
<?php  } ?>
<?php  } ?>

<?php  if($op == 'process') { ?>
<div class="page clearfix">
	<h2>更新进度</h2>
	<div class="alert alert-warning">
		<strong class="text-danger">
			各位在更新前， 务必关闭安全狗， 云锁，防火墙等安全防护软件， 否则将更新不成功。因未关闭安全软件造成的更新失败， 官方不会针对每个客户单独处理。
		</strong>
	</div>
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
	<?php  if($step == 'files') { ?>
		<?php  if(empty($packet['files'])) { ?>
			<script type="text/javascript">
				location.href = "<?php  echo iurl('system/cloud/process', array( 'step' => 'schemas'));?>";
			</script>
		<?php  } ?>
		<div class="alert alert-warning">
			正在更新系统文件, 请不要关闭窗口.
		</div>
		<div class="alert alert-warning">
			如果下载文件失败，可能造成的原因：写入失败，请仔细检查写入权限是否正确。<strong>如果出现更新失败的文件， 请刷新页面重新更新。如果出现空白页面 ，请等待1分钟左右在更新， 是服务器缓存的原因</strong>
		</div>
		<div class="alert alert-info alert-original form-horizontal ng-cloak" ng-controller="processor">
			<dl class="dl-horizontal">
				<dt>整体进度</dt>
				<dd>{{pragress}}</dd>
				<dt>正在下载文件</dt>
				<dd>{{file}}</dd>
			</dl>
			<dl class="dl-horizontal" ng-show="fails.length > 0">
				<dt>下载失败的文件</dt>
				<dd>
					<p class="text-danger" ng-repeat="file in fails" style="margin:0;">{{file}}</p>
				</dd>
			</dl>
		</div>
		<script>
			require(['angular'], function(angular){
				angular.module('app', []).controller('processor', function($scope, $http){
					$scope.files = <?php  echo json_encode($packet['files']);?>;
					$scope.fails = [];
					var total = $scope.files.length;
					var i = 1;
					var proc = function() {
						var path = $scope.files.pop();
						if(!path) {
							if($scope.fails.length == 0) {
								setTimeout(function(){
									location.href = "<?php  echo iurl('system/cloud/process', array( 'step' => 'schemas'));?>";
								}, 2000);
							} else {
								setTimeout(function(){
									location.href = "<?php  echo iurl('system/cloud/process');?>";
								}, 2000);
							}
							return;
						}
						$scope.file = path;
						$scope.pragress = i + '/' + total;
						var params = {path: path};
						$http.post(location.href, params).success(function(dat){
							i++;
							if(dat != 'success') {
								$scope.fails.push(path);
							}
							proc();
						}).error(function(){
							i++;
							$scope.fails.push(path);
							proc();
						});
					}
					proc();
				});
				angular.bootstrap(document, ['app']);
			});
		</script>
	<?php  } ?>
	<?php  if($step == 'schemas') { ?>
		<?php  if(empty($packet['database'])) { ?>
			<script>
				util.message('已经成功执行升级操作!', "<?php  echo iurl('system/cloud/upgrade');?>", 'success');
			</script>
		<?php  } ?>
		<div class="alert alert-warning">
			正在更新数据库, 请不要关闭窗口.
		</div>
		<div class="alert alert-info alert-original form-horizontal ng-cloak" ng-controller="processor">
			<dl class="dl-horizontal">
				<dt>整体进度</dt>
				<dd>{{pragress}}</dd>
			</dl>
			<dl class="dl-horizontal" ng-show="fails.length > 0">
				<dt>处理失败的数据表</dt>
				<dd>
					<p class="text-danger" ng-repeat="schema in fails" style="margin:0;" class="hide">{{schema}}</p>
				</dd>
			</dl>
		</div>
		<script>
			require(['angular', 'util'], function(angular, u){
				angular.module('app', []).controller('processor', function($scope, $http){
					$scope.schemas = <?php  echo json_encode($packet['data']);?>;
					$scope.fails = [];
					var total = $scope.schemas.length;
					var i = 1;
					var error = function() {
						require(['util'], function(u){
							util.message('未能成功执行处理数据库, 请联系开发商解决. ');
						});
					}
					var proc = function() {
						var schema = $scope.schemas.pop();
						if(!schema) {
							if($scope.fails.length > 0) {
								error();
								return;
							} else {
								util.message('已经成功执行升级操作!', "<?php  echo iurl('system/cloud/upgrade');?>");
								return;
							}
						}
						$scope.schema = schema;
						$scope.pragress = i + '/' + total;
						var params = {table: schema};
						$http.post(location.href, params).success(function(dat){
							i++;
							if(dat != 'success') {
								$scope.fails.push(schema)
							}
							proc();
						}).error(function(){
							i++;
							$scope.fails.push(schema);
							proc();
						});
					}
					proc();
				});
				angular.bootstrap(document, ['app']);
			});
		</script>
	<?php  } ?>
	</form>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>