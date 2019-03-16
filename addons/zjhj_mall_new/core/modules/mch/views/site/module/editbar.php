<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '模板导航';
$this->params['active_nav_group'] = 15;
$this->params['is_book'] = 2;
$this->params['isSiteTemp'] = 1;
?>

<div class="main-body p-3">
	<form class="form card auto-submit-form" method="post" autocomplete="off">
	<div class="form-title white-bg">
		<div class="main-nav" flex="cross:center dir:left box:first">
			<div>
				<nav class="breadcrumb rounded-0 mb-0" flex="cross:center" style="background-color: transparent;">
					<span style="margin-right: 1rem">位置：</span>
					<a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/module/index']) ?>">我的模板</a>
					<span class="breadcrumb-item active"><?= $this->title ?></span>
				</nav>
			</div>
		</div>
	</div>
	<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/bootstrap.min.css?v=20180203" rel="stylesheet">
	<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/common_public.css?v=20180203" rel="stylesheet">
	<script type="text/javascript">
		window.sysinfo = {
			<?php if(!empty($_W['uniacid'])) echo '"uniacid":'.$_W['uniacid'].','; ?>
			<?php if(!empty($_W['acid'])) echo '"acid":'.$_W['acid'].','; ?>
			<?php if(!empty($_W['openid'])) echo 'openid:'.$_W['openid'].','; ?>
			<?php if(!empty($_W['uid'])) echo 'uid:'.$_W['uid'].','; ?>
			'isfounder': <?php echo !empty($_W['isfounder'])?1:0; ?>,
			'family': '<?php echo IMS_FAMILY ?>',
			'siteroot': '<?php echo $_W['siteroot'] ?>',
			'siteurl': '<?php echo $_W['siteurl'] ?>',
			'attachurl': '<?php echo $_W['attachurl'] ?>',
			'attachurl_local': '<?php echo $_W['attachurl_local'] ?>',
			'attachurl_remote': '<?php echo $_W['attachurl_remote'] ?>',
			'module' : {'url' : '<?php if(defined('MODULE_URL')) echo MODULE_URL ?>', 'name' : '<?php if(defined('IN_MODULE')) echo IN_MODULE ?>'},
			'cookie' : {'pre': '<?php echo $_W['config']['cookie']['pre'] ?>'},
			'account' : <?php echo json_encode($_W['account']) ?>,
			'server' : {'php' : '<?php echo phpversion() ?>'}, 
		};
	</script>
	<script>var require = { urlArgs: 'v=20180203' };</script>
	<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-1.11.1.min.js"></script>
    <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/bootstrap.min.js"></script>
    <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/util.js"></script>
    <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/common.min.js"></script>
	<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/require.js"></script>

	<div class="loader" style="display:none">
		<div class="la-ball-clip-rotate">
			<div></div>
		</div>
	</div>

	<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/common.css?t=1528273804" rel="stylesheet">
	<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/tao.css?t=1528273804" rel="stylesheet">
	<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-ui.css" rel="stylesheet">
	<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-ui.js"></script>
	<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/tao.js?t=1527838941"></script>

		<div id="js_container_box" class="container_box cell_layout side_l">
			<div class="col_main">
				<div class="main_hd">
					<!-- <h2>456789</h2> -->
					<div class="title_tab" id="topTab">
						<!-- <ul class="tab_navs title_tab">
							<li class="tab_nav first js_top selected">
								<a class="left_title_box top_title_box" href="#">asdasd
									<i>2</i> </a>
							</li>
						</ul> -->
					</div>
				</div>

				<div class="main_bd">

					<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/style.css?t=1528273804" rel="stylesheet">
					<script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/angular.min.js"></script>
					<script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp"></script>
					<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-ui.css" rel="stylesheet">

					<div class="my_article_box" ng-app="myyapp" ng-controller="ctr">
						<div class="" ng-cload>
							<div class="item_cell_box">
								<div class="article_left">
									<div class="article_left_mobile">
										<div class="page-content" style="padding: 5px">
											<div class="mobile_body" style="min-height: 200px;">
												<div class="nav_list item_cell_box" ng-style="{'background':items.bgcolor}">
													<div ng-repeat="item in items.data track by $index" class="item_cell_flex nav_list_item">
														<div class="nav_list_img">
															<img ng-src="{{item.img}}">
														</div>
														<div class="nav_list_name">{{item.name}}</div>
													</div>
												</div>
											</div>
										</div>
										<div class="mobile_bottom"></div>
									</div>

								</div>
								<div class="article_right item_cell_flex">
									<div class="portable_editor ">
										<div class="editor_inner" id="js_editFormContent" style="margin-top: 100px;">
											<div ng-include="'./../web/temp/edit-bar.html'" ></div>
										</div>
										<span class="editor_arrow_wrp js_arrow">
											<i class="editor_arrow editor_arrow_out"></i>
											<i class="editor_arrow editor_arrow_in"></i>
										</span>
									</div>
								</div>

							</div>

							<div class="module_box">
								<span ng-click="saveData()" class="btn btn_primary btn_p20">保存</span>
							</div>
						</div>
						<div class="my_model" url style="display: none">
							<div class=" ui-draggable ">
								<div class="dialog">
									<div class="dialog_hd">
										<a href="javascript:;" class="icon16_opr closed pop_closed model_close">关闭</a>
									</div>
									<div class="dialog_bd info_box item_cell_box">
										<div class="setlink_l">
											<li ng-class="seturltype == 'page' ? 'setlink_act' : ''" ng-click="pagetype('page')">程序页面</li>
											<li ng-show="setindex != 0" ng-class="seturltype == 'news' ? 'setlink_act' : ''" ng-click="pagetype('news')">文章页面</li>
											<li ng-show="setindex != 0" ng-class="seturltype == 'other' ? 'setlink_act' : ''" ng-click="pagetype('other')">其他页面</li>
										</div>
										<div class="setlink_r item_cell_flex">
											<div ng-show="urltype == 'my' && seturltype == 'page'" ng-repeat="item in allpage" class="item_cell_box setlink_r_item">
												<li>{{item.name}}</li>
												<li class="setlink_r_box item_cell_flex">
													<span ng-click="setLink(item.url,item.name,item.id)">选择</span>
												</li>
											</div>
											<div ng-show="urltype == 'my' && seturltype == 'news' && setindex != 0" ng-repeat="item in allnews" class="item_cell_box setlink_r_item">
												<li>{{item.title}}</li>
												<li class="setlink_r_box item_cell_flex">
													<span ng-click="setLink(item.url,item.title)">选择</span>
												</li>
											</div>
											<div ng-show="urltype == 'my' && seturltype == 'other' && setindex != 0" ng-repeat="item in otherurl" class="item_cell_box setlink_r_item">
												<li>{{item.title}}</li>
												<li class="setlink_r_box item_cell_flex">
													<span ng-click="setLink(item.url,item.title)">选择</span>
												</li>
											</div>
											<div ng-show="urltype == 'app' && setindex != 0" ng-repeat="item in allapp" class=" setlink_r_item">
												<div ng-repeat="initem in item.list" class="item_cell_box">
													<li>
														<img class="setlink_logoimg" ng-src="{{item.logo}}">
													</li>
													<li class="setlink_in_item setlink_in_mname">{{item.appname}}</li>
													<li class="setlink_in_item">{{initem.title}}</li>
													<li class="setlink_in_item">{{initem.url}}</li>
													<li class="setlink_r_box item_cell_flex setlink_in_item">
														<span ng-click="setotherLink(item,initem)">选择</span>
													</li>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog_ft">
										<span class="btn btn_default btn_input js_btn_p model_close">
											<button type="button" class="js_btn">取消</button>
										</span>
									</div>
								</div>
							</div>
							<div class="mask ui-draggable" style="display: block;"></div>
						</div>

						<div class="my_model" map style="display: none">
							<div class=" ui-draggable ">
								<div class="dialog">
									<div class="dialog_hd">
										<a href="javascript:;" class="icon16_opr closed pop_closed model_close">关闭</a>
									</div>
									<div class="dialog_bd info_box">
										<div class="font_mini">左键点击所在出现红色标记，点击确定即可</div>
										<div class="map_box" style="margin: 0 auto;">
											<!-- <div class="map_search">
									<span class="frm_input_box frm_input_box_100">
										<input type="text" class="frm_input"  name="searaddress" value="">
									</span><a href="javascript:;" id="find_address">搜索</a>
								</div>
								<div class="baidu_map" id="map"></div> -->
											<div class="map_search">
												<span class="frm_input_box frm_input_box_100">
													<input type="text" class="frm_input" name="searaddress" id="searaddress" value="">
												</span>
												<a href="javascript:;" id="find_address">搜索</a>
											</div>
											<div class="baidu_map" id="map"></div>
										</div>
									</div>
									<div class="dialog_ft">
										<span class="btn btn_primary btn_input js_btn_p" ng-click="setLocation()">
											<button type="button" class="js_btn">确定</button>
										</span>
										<span class="btn btn_default btn_input js_btn_p model_close">
											<button type="button" class="js_btn">取消</button>
										</span>
									</div>
								</div>
							</div>
							<div class="mask ui-draggable" style="display: block;"></div>
						</div>

					</div>
					<script type="text/javascript">
						var page = <?php echo json_encode($page); ?>;
						var tempid = <?php echo intval( $_GET['tid'] ); ?>;
					</script>
					<script type="text/javascript" src="<?= Yii::$app->request->baseUrl ?>/statics/md/bar.js?t=<?php echo time() ?>"></script>

				</div>
			</div>
		</div>
	</div>
	</form>
	</div>
	</div>
