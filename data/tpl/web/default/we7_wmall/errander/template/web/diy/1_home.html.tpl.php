<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<link href="../addons/we7_wmall/plugin/errander/static/css/web/diy.web.css?t=<?php  echo time();?>" rel="stylesheet" type="text/css"/>
<?php  if($op == 'home') { ?>
<div class="clearfix">
	<div class="app-preview">
		<div class="app-header"></div>
		<div class="app-body">
			<div class="title" id="page">编辑跑腿场景</div>
			<div class="main" id="app-preview">
			</div>
		</div>
		<div class="app-footer"></div>
	</div>
	<div class="app-editor form-horizontal" id="app-editor">
		<div class="editor-arrow"></div>
		<div class="inner">
		</div>
	</div>
</div>
<div class="app-action">
	<div class="parts" id="parts"></div>
	<div class="action">
		<nav class="btn btn-default btn-sm pull-left" id="gotop">返回顶部</nav>
		<nav class="btn btn-primary btn-sm btn-save">保存并设置</nav>
	</div>
</div>

<script type="text/html" id="tpl-show-guide">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="page-errander-guide" style="background-color: <(style.background)>;">
			<div class='shop-wrapper'>
				<div class="shop">
					<div class='shop-banner'>
						<div class='rider-nearby-content'>
							<div class='rider-nearby-icon'></div>
							<div style="color: <(rider.color)>;">
								<(rider.text.left)>
								<span class='num' style="color: <(rider.num_color)>;"><(rider.text.num)></span>
								<(rider.text.right)>
							</div>
						</div>
						<div class='swiper-container'>
							<div class='swiper--wrapper'>
								<(each picture as item)>
									<a href="<(item.linkurl)>">
										<div class="swiper-slide">
											<img src='<(tomedia item.imgurl)>'>
										</div>
									</a>
								<(/each)>
							</div>
						</div>
					</div>
					<div class='good-edit'>
						<div class='good-input'>
							<div class='good-input-placeholder'>
								<div class='good-input-icon'>
									<img src='https://xs01.meituan.net/banma_paotui/dist/public/edit-icon.png'>
								</div>
								<(params.placeholder)>
							</div>
							<div class='good-input-content active'>
								<textarea maxlength="100" placeholder="<(params.placeholder)>" class="good-input-textarea"></textarea>
								<div class='good-input-submit'></div>
							</div>
						</div>
						<div class='good-tags'>
							<div class='good-tag-list'>
								<(each lanmu as item)>
									<div class='good-tag' style="color: <(item.color)>;background-color: <(item.background_color)>;">
										<(item.text)>
										<(if item.is_hot == '1')>
											<div class='good-tag-hot'>
												<img src='http://p0.meituan.net/xianfu/863820dcf9344412c0eeb4b112904e693136.png'>
											</div>
										<(/if)>
									</div>
								<(/each)>
							</div>
						</div>
					</div>

					<div class="paotui-feature-panel">
						<div class='paotui-feature-title'>跑腿特色</div>
						<div class='paotui-feature-list'>
							<(each feature as item)>
								<div class='paotui-feature-item'>
									<div class='paotui-feature-item-icon' style="border-color: <(item.icon_color)>;">
										<div class="icon <(item.icon)>" style="color: <(item.icon_color)>;"></div>
									</div>
									<div class="paotui-feature-item-text" style="color: <(item.color)>;"><(item.text)></div>
								</div>
							<(/each)>
						</div>
					</div>
				</div>
			</div>
			<div class='order-icon' style="border:1px solid <(order.border_color)>">
				<div class="icon <(order.icon)>" style="color: <(order.color)>"></div>
				<div class="order-text" style="color: <(order.color)>"><(order.text)></div>
			</div>
		</div>
	</div>

</script>
<script type="text/html" id="tpl-editor-guide">
	<div class="alert alert-info">
		跑腿首页的入口链接地址为：<a href="javascript:;" class="js-clip" data-url="pages/paotui/guide">pages/paotui/guide</a>
		<br/>
		<span class="text-danger">
			注意：您需要创建一个跑腿场景并设置为“下单”按钮的跳转链接，否则点击“下单”不会有任何反应
		</span>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">页面背景颜色</div>
		<div class="col-sm-10">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="input-group form-group" style="width: 100%;">
		<div class="col-sm-2 control-label">搜索框提示</div>
		<div class="col-sm-10 input-group" style="padding: 0 15px;">
			<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="placeholder" value="<(params.placeholder||'请输入提示信息')>" />
		</div>
	</div>
	<div class="input-group form-group" style="width: 100%;">
		<div class="col-sm-2 control-label">下单按钮跳转链接</div>
		<div class="col-sm-10 input-group" style="padding: 0 15px;">
			<input type="text" class="form-control input-sm diy-bind" data-bind-child="params" data-bind="submiturl" id="params-submiturl" placeholder="请选择链接或输入链接地址" value="<(params.submiturl)>" />
			<span class="input-group-addon btn btn-default js-selectWxappLink" data-input="#params-submiturl">选择链接</span>
		</div>
	</div>
	<div class="line"></div>
	<div class="form-items" data-min="1" data-max="4">
		<div class="inner">
			<(each picture as child itemid )>
			<div class="item" data-id="<(itemid)>">
				<span class="btn-del" title="删除" data-goal="picture"></span>
				<div class="item-image">
					<img src="<(tomedia child.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" id="pimg-<(itemid)>" />
				</div>
				<div class="item-form">
					<div class="input-group" style="margin-bottom:0px; ">
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="picture" data-bind-child="<(itemid)>" data-bind="imgurl"  id="cimg-<(itemid)>" placeholder="请选择图片或输入图片地址" value="<(child.imgurl)>" />
						<span class="input-group-addon btn btn-default js-selectImg" data-input="#cimg-<(itemid)>" data-img="#pimg-<(itemid)>" data-element="#pimg-<(itemid)>">选择图片</span>
					</div>
					<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="picture" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-<(itemid)>" placeholder="请选择链接或输入链接地址" value="<(child.linkurl)>" />
						<span class="input-group-addon btn btn-default js-selectWxappLink" data-input="#curl-<(itemid)>">选择链接</span>
					</div>
				</div>
			</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline addChild" data-goal="picture"><i class="fa fa-plus"></i> 添加轮播图片</div>
	</div>
	<div class="line"></div>
	<div class="form-items" data-min="1">
		<div class="inner">
			<div class="item">
				<div class="item-form">
					<div class="input-group" style="margin-bottom:0px; ">
						<span class="input-group-addon">文字左</span>
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="rider" data-bind-child="text" data-bind="left" placeholder="请输入左侧文字" value="<(rider.text.left)>" />
						<span class="input-group-addon">数字</span>
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="rider" data-bind-child="text" data-bind="num" placeholder="请输入数字" value="<(rider.text.num)>"  />
						<span class="input-group-addon">文字右</span>
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="rider" data-bind-child="text" data-bind="right" placeholder="请输入右侧文字" value="<(rider.text.right)>"/>
					</div>
					<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
						<span class="input-group-addon">文字颜色</span>
						<input class="form-control input-sm diy-bind color" data-bind-child="rider" data-bind="color" value="<(rider.color)>" type="color"/>
						<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置颜色</span>
						<span class="input-group-addon">数字颜色</span>
						<input class="form-control input-sm diy-bind colorx" data-bind-child="rider" data-bind="num_color" value="<(rider.num_color)>" type="color" />
						<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#f6ce00').trigger('propertychange')">重置颜色</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="form-items" data-min="1">
		<div class="inner">
			<div class="item">
				<div class="item-image">
					<div class="icon-main">
						<(if order.icon)>
						<span class="icon <(order.icon)>" id="cicon-order"></span>
						<(else)>
						<p>无图标</p>
						<(/if)>
					</div>
					<input type="hidden" class="diy-bind" value="<(order.icon)>"  id="picon-order" data-bind="icon" data-bind-child="order" data-bind-init="true"/>
					<div class="select-icon js-selectIcon" data-input="#picon-order" data-element="cicon-order">选择图标</div>
				</div>
				<div class="item-form">
					<div class="input-group" style="margin-bottom:0px; ">
						<span class="input-group-addon">文字</span>
						<input type="text" class="form-control input-sm diy-bind"  data-bind-child="order" data-bind="text" placeholder="请选择图片或输入图片地址" value="<(order.text)>" style="width: 60%" />
						<input class="form-control input-sm diy-bind color " data-bind-child="order" data-bind="color" value="<(order.color)>" type="color" style="width: 40%" />
						<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#FFD56F').trigger('propertychange')">重置颜色</span>
					</div>
					<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
						<span class="input-group-addon">边框颜色</span>
						<input class="form-control input-sm diy-bind color " data-bind-child="order" data-bind="border_color" value="<(order.border_color)>" type="color" />
						<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#FFD56F').trigger('propertychange')">重置颜色</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="line"></div>

	<div class="form-items" data-min="4" data-max="8">
		<div class="inner">
			<(each lanmu as child itemid )>
				<div class="item" data-id="<(itemid)>">
					<span class="btn-del" title="删除" data-goal="lanmu"></span>
					<div class="item-form">
						<div class="input-group" style="margin-bottom:0px; ">
							<span class="input-group-addon">栏目名称</span>
							<input type="text" class="form-control input-sm diy-bind" data-bind-parent="lanmu" data-bind-child="<(itemid)>" data-bind="text" placeholder="请输入栏目名称" value="<(child.text)>" style="width: 60%" />
							<input class="form-control input-sm diy-bind color " data-bind-parent="lanmu" data-bind-child="<(itemid)>" data-bind="color" value="<(child.color)>" type="color" style="width: 40%" />
							<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置颜色</span>
						</div>
						<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
							<span class="input-group-addon">栏目背景色</span>
							<input class="form-control input-sm diy-bind color " data-bind-parent="lanmu" data-bind-child="<(itemid)>" data-bind="background_color" value="<(child.background_color)>" type="color"/>
							<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fef7df').trigger('propertychange')">重置颜色</span>
							<input type="text" class="form-control input-sm diy-bind" data-bind-parent="lanmu" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-lanmu-<(itemid)>" placeholder="请选择链接或输入链接地址" value="<(child.linkurl)>" />
							<span class="input-group-addon btn btn-default js-selectWxappLink" data-input="#curl-lanmu-<(itemid)>">选择链接</span>
						</div>
					</div>
				</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline addChild" data-goal="lanmu"><i class="fa fa-plus"></i> 添加一个栏目</div>
	</div>
	<div class="line"></div>
	<div class="form-items" data-min="1" data-max="3">
		<div class="inner">
			<(each feature as child itemid )>
			<div class="item" data-id="<(itemid)>">
				<span class="btn-del" title="删除" data-goal="feature"></span>
				<div class="item-image">
					<div class="icon-main">
						<(if child.icon)>
						<span class="icon <(child.icon)>" id="cicon-feature"></span>
						<(else)>
						<p>无图标</p>
						<(/if)>
					</div>
					<input type="hidden" class="diy-bind" value="<(child.icon)>"  id="picon-feature-<(itemid)>" data-bind="icon" data-bind-child="<(itemid)>" data-bind-parent="feature" data-bind-init="true"/>
					<div class="select-icon js-selectIcon" data-input="#picon-feature-<(itemid)>" data-element="cicon-feature">选择图标</div>
				</div>
				<div class="item-form">
					<div class="input-group" style="margin-bottom:0px; ">
						<span class="input-group-addon">文字</span>
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="feature" data-bind-child="<(itemid)>" data-bind="text" value="<(child.text)>" style="width: 60%" />
						<input class="form-control input-sm diy-bind color " data-bind-parent="feature" data-bind-child="<(itemid)>" data-bind="color" value="<(child.color)>" type="color" style="width: 40%" />
						<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置颜色</span>
					</div>
					<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
						<span class="input-group-addon">图标颜色</span>
						<input class="form-control input-sm diy-bind color " data-bind-parent="feature" data-bind-child="<(itemid)>" data-bind="icon_color" value="<(child.icon_color)>" type="color" style="width: 70px"/>
						<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#FFD56F').trigger('propertychange')">重置颜色</span>
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="feature" data-bind-child="<(itemid)>" data-bind="linkurl" id="feature-curl-<(itemid)>" placeholder="请选择链接或输入链接地址" value="<(child.linkurl)>" />
						<span class="input-group-addon btn btn-default js-selectWxappLink" data-input="#feature-curl-<(itemid)>">选择链接</span>
					</div>
				</div>
			</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline addChild" data-goal="feature"><i class="fa fa-plus"></i> 添加跑腿特色</div>
	</div>
</script>
<script type="text/html" id="tpl-parts">
	<nav class="btn btn-link" data-id="page"><i class="fa fa-cog"></i> 页面设置</nav>
	<(each initPart as part)>
	<nav class="btn btn-link" data-id="<(part.id)>"><i class="fa fa-plus"></i> <(part.name)></nav>
	<(/each)>
</script>

<script type="text/html" id="tpl-editor-del">
	<div class="btn-edit-del">
		<div class="btn-edit">编辑</div>
		<div class="btn-del">删除</div>
	</div>
</script>
<script type="text/html" id="tpl-editor-page">
	<div class="form-group">
		<div class="col-sm-2 control-label">页面名称</div>
		<div class="col-sm-10">
			<input class="form-control input-sm diy-bind" data-bind="name" data-placeholder="请输入名称" placeholder="请输入名称" value="<(page.name)>" />
			<div class="help-block">注意：页面名称是便于后台查找，页面标题是手机端标题。</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">页面标题</div>
		<div class="col-sm-10">
			<input class="form-control input-sm diy-bind" data-bind="title" data-placeholder="请输入标题" placeholder="请输入标题" value="<(page.title)>" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">页面介绍</div>
		<div class="col-sm-10">
			<textarea class="form-control richtext diy-bind" cols="70" rows="3" placeholder="请输入页面介绍" data-bind="desc" data-placeholder=""><(page.desc)></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind="background" value="<(page.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#efeff4').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">导航栏背景色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind="navigationbackground" value="<(page.navigationbackground)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#000').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">导航栏字体颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<label class="radio-inline"><input type="radio" name="navigationtextcolor" value="#000000" class="diy-bind" data-bind="navigationtextcolor" <(if page.navigationtextcolor=='#000000' || !page.navigationtextcolor)>checked="checked"<(/if)> > 黑</label>
				<label class="radio-inline"><input type="radio" name="navigationtextcolor" value="#ffffff" class="diy-bind" data-bind="navigationtextcolor" <(if page.navigationtextcolor=='#ffffff')>checked="checked"<(/if)>> 白</label>
			</div>
		</div>
	</div>
</script>
<script type="text/html" id="tpl-editor-fees">
</script>

<script type="text/javascript" src="./resource/components/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/lang/zh-cn/zh-cn.js"></script>
<script language="javascript">
	var path = '../../plugin/errander/static/js/diy';
	irequire([path, 'tmodtpl'],function(diy, tmodtpl){
		diy.init({
			tmodtpl: tmodtpl,
			attachurl: "<?php  echo $_W['attachurl'];?>",
			id: '<?php  echo intval($_GPC["id"])?>',
			type: <?php  if(!empty($homepage['type'])) { ?>'<?php  echo $homepage['type']?>'<?php  } else { ?>'home'<?php  } ?>,
			data: <?php  if(!empty($homepage['data'])) { ?><?php  echo json_encode($homepage['data'])?><?php  } else { ?>null<?php  } ?>,
		});
	});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>