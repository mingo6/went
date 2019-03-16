<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<link href="../addons/we7_wmall/plugin/errander/static/css/web/diy.web.css?t=<?php  echo time();?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
<?php  if($op == 'scene') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('errander/diyPage/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="请输入场景标题或关键字进行搜索">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('errander/diyPage/post');?>" class="btn btn-primary btn-sm">添加跑腿场景</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th width="40">
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="ids[]"/>
							<label></label>
						</div>
					</th>
					<th>场景名称</th>
					<th>创建时间</th>
					<th>最后修改时间</th>
					<th style="width:200px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($pages)) { foreach($pages as $page) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="ids[]" value="<?php  echo $page['id'];?>"/>
							<label></label>
						</div>
					</td>
					<td><?php  echo $page['name'];?></td>
					<td><?php  echo date('Y-m-d H:i:s', $page['addtime'])?></td>
					<td>
						<?php  if(!empty($page['updatetime'])) { ?>
							<?php  echo date('Y-m-d H:i:s', $page['updatetime'])?>
						<?php  } else { ?>
							<?php  echo date('Y-m-d H:i:s', $page['addtime'])?>
						<?php  } ?>
					</td>
					<td style="text-align:right;">
						<a href="<?php  echo iurl('errander/diyPage/post', array('id' => $page['id']))?>" class="btn btn-default btn-sm">编辑</a>
						<a href="<?php  echo iurl('errander/diyPage/del', array('id' => $page['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
						<a href="javascript:;" class="btn btn-default btn-sm js-clip" data-href="pages/paotui/diy?id=<?php  echo $page['id'];?>"><i class="fa fa-link"></i></a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<a href="<?php  echo iurl('errander/diyPage/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
				</div>
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
	</div>
</form>
<?php  } ?>
<?php  if($op == 'post') { ?>
<div class="clearfix">
	<div class="app-preview">
		<div class="app-header"></div>
		<div class="app-body">
			<div class="title" id="page">编辑跑腿场景</div>
			<div class="main" id="app-preview"></div>
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
<script type="text/html" id="tpl-show-text">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-text border-1px-t" style="margin-top: <(style.marginTop)>px;">
			<(each data as item)>
				<div class="diy-text-item border-1px-b">
					<div class="left"><(item.title)></div>
					<div class="right">
						<input type="text" value="<(item.placeholder)>">
					</div>
				</div>
			<(/each)>
		</div>
	</div>
</script>
<script type="text/html" id="tpl-editor-text">
	<div class="form-group">
		<div class="col-sm-2 control-label">上外边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.marginTop)>" data-min="0" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.marginTop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="marginTop" value="<(style.marginTop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-items indent" data-min="1">
		<div class="inner" id="form-items">
			<(each data as item itemid )>
				<div class="item" data-id="<(itemid)>">
					<span class="btn-del" title="删除"></span>
					<div class="item-body">
						<div class="form-group">
							<div class="col-sm-2 control-label">是否必填</div>
							<div class="col-sm-10">
								<div class="col-sm-10">
									<label class="radio-inline"><input type="radio" value="1" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="is_required" data-bind-init="true" <(if item.is_required=='1')>checked<(/if)> > 是</label>
									<label class="radio-inline"><input type="radio" value="0" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="is_required" data-bind-init="true" <(if item.is_required=='0'||!item.is_required)>checked<(/if)> > 否</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 control-label">名称</div>
							<div class="col-sm-10">
								<input class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="title" data-placeholder="请输入名称" value="<(item.title)>" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 control-label">提示</div>
							<div class="col-sm-10">
								<input class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="placeholder" data-placeholder="请输入提示信息" value="<(item.placeholder)>" />
							</div>
						</div>
					</div>
				</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline addChild"><i class="fa fa-plus"></i> 添加一个</div>
	</div>
</script>

<!--单项选择-->
<script type="text/html" id="tpl-show-oneChoice">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-oneChoice border-1px-t" style="margin-top: <(style.marginTop)>px;">
			<(each data as item)>
				<div class="diy-oneChoice-item border-1px-b">
					<div class="left"><(item.title)></div>
					<div class="right">
						选项值<span class="icon icon-right"></span>
					</div>
				</div>
			<(/each)>
		</div>
	</div>
</script>
<script type="text/html" id="tpl-editor-oneChoice">
	<div class="form-group">
		<div class="col-sm-2 control-label">上外边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.marginTop)>" data-min="0" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.marginTop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="marginTop" value="<(style.marginTop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-items indent" data-min="1">
		<div class="inner" id="form-items">
			<(each data as item itemid )>
			<div class="item" data-id="<(itemid)>">
				<span class="btn-del" title="删除"></span>
				<div class="item-body">
					<div class="form-group">
						<div class="col-sm-2 control-label">是否必选</div>
						<div class="col-sm-10">
							<div class="col-sm-10">
								<label class="radio-inline"><input type="radio" value="1" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="is_required" data-bind-init="true" <(if item.is_required=='1')>checked<(/if)> > 是</label>
								<label class="radio-inline"><input type="radio" value="0" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="is_required" data-bind-init="true" <(if item.is_required=='0'||!item.is_required)>checked<(/if)> > 否</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2 control-label">名称</div>
						<div class="col-sm-10">
							<input class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="title" data-placeholder="请输入名称" value="<(item.title)>" />
						</div>
					</div>
					<div class="form-group" >
						<div class="col-sm-2 control-label">选项</div>
						<div class="col-sm-10 option-items" data-min="1" data-max="5">
							<(each item.options as item1 index1)>
								<div class="input-group option-item" style="margin-bottom: 10px;" data-id="<(index1)>">
									<div class="input-group-addon">选项名称</div>
									<input type="text" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="options" data-bind-category="<(index1)>" data-bind-type="name" value="<(item1.name)>" class="form-control diy-bind"/>
									<span class="btn-del del-option-item" title="删除"></span>
								</div>
							<(/each)>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2 control-label"></div>
						<div class="col-sm-10">
							<a href="javascript:;" class="btn btn-default btn-sm add-option-item"><i class="fa fa-plus-circle"></i> 添加一个选项</a>
						</div>
					</div>
				</div>
			</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline addChild"><i class="fa fa-plus"></i> 添加一个</div>
	</div>
</script>

<!--多项选择-->
<script type="text/html" id="tpl-show-multipleChoices">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-oneChoice border-1px-t" style="margin-top: <(style.marginTop)>px;">
			<(each data as item)>
				<div class="diy-oneChoice-item border-1px-b">
					<div class="left"><(item.title)></div>
					<div class="right">
						选项值<span class="icon icon-right"></span>
					</div>
				</div>
			<(/each)>
		</div>
	</div>
</script>
<script type="text/html" id="tpl-editor-multipleChoices">
	<div class="form-group">
		<div class="col-sm-2 control-label">上外边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.marginTop)>" data-min="0" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.marginTop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="marginTop" value="<(style.marginTop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-items indent" data-min="1">
		<div class="inner" id="form-items">
			<(each data as item itemid )>
			<div class="item" data-id="<(itemid)>">
				<span class="btn-del" title="删除"></span>
				<div class="item-body">
					<div class="form-group">
						<div class="col-sm-2 control-label">是否必选</div>
						<div class="col-sm-10">
							<div class="col-sm-10">
								<label class="radio-inline"><input type="radio" value="1" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="is_required" data-bind-init="true" <(if item.is_required=='1')>checked<(/if)> > 是</label>
								<label class="radio-inline"><input type="radio" value="0" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="is_required" data-bind-init="true" <(if item.is_required=='0'||!item.is_required)>checked<(/if)> > 否</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2 control-label">名称</div>
						<div class="col-sm-10">
							<input class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="title" data-placeholder="请输入名称" value="<(item.title)>" />
						</div>
					</div>
					<div class="form-group" >
						<div class="col-sm-2 control-label">选项</div>
						<div class="col-sm-10 extra-fee-items" data-min="1" data-max="5">
							<(each item.options as item1 index1)>
								<div class="input-group option-item" style="margin-bottom: 10px;" data-id="<(index1)>">
									<div class="input-group-addon">选项名称</div>
									<input type="text" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="options" data-bind-category="<(index1)>" data-bind-type="name" value="<(item1.name)>" class="form-control diy-bind"/>
									<span class="btn-del del-option-item" title="删除"></span>
								</div>
							<(/each)>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2 control-label"></div>
						<div class="col-sm-10">
							<a href="javascript:;" class="btn btn-default btn-sm add-option-item"><i class="fa fa-plus-circle"></i> 添加一个选项</a>
						</div>
					</div>
				</div>
			</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline addChild"><i class="fa fa-plus"></i> 添加一个</div>
	</div>
</script>



<script type="text/html" id="tpl-show-fees">
	<div class="drag" data-itemid="<(itemid)>">
	</div>
</script>

<script type="text/html" id="tpl-show-banner">
	<div class="drag" data-itemid="<(itemid)>">
		<(each data as item)>
		<div class="diy-banner" style="padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px; background: <(style.background)>;">
			<img src="<(tomedia item.imgurl)>" alt="" style="width: 100%">
		</div>
		<(/each)>
	</div>
</script>

<script type="text/html" id="tpl-show-basic">
	<div class="drag fixed nodelete" data-itemid="<(itemid)>">
		<div class='shop-content' style="margin: <(style.paddingtop)>px <(style.paddingleft)>px 0px; background: <(style.background)>">
			<div class='shop-content-edit'>
				<textarea class='shop-content-textarea' placeholder="<(params.placeholder)>" maxlength='100'></textarea>
			</div>
			<div class="shop-content-tags <(if params.estimate == '1')>border-1px-b<(/if)>">
				<(each data as item)>
					<div class='shop-content-tag'><(item.tags)></div>
				<(/each)>
			</div>
		</div>
		<(if params.estimate == '1')>
			<div class='shop-amount' style="margin: 0px <(style.paddingleft)>px <(style.paddingtop)>px 0px; background: <(style.background)>">
				<div class='shop-amount-title'>
					<div class='shop-amount-icon'></div>
					骑手垫付商品费，可线上支付
				</div>
				<div class='shop-amount-after'>
					预估商品费
					<i class="icon icon-right"></i>
				</div>
			</div>
		<(/if)>
		<!--地址信息 样式1-->
		<(if params.scene == 'buy')>
		<div class='address-info'>
			<div class='address-item shop-address border-1px-b'>
				<div class='address-item-title'><(params.buytitle)></div>
				<div class='address-item-after'>
					<div class="shop-address-type">
						<div class='shop-address-type-item active'>
							<(params.buytype1title)>
<!--
							<span class='shop-address-type-item-hint'>更精确</span>
-->
						</div>
						<div class='shop-address-type-item border-1px'>
							<(params.buytype2title)>
<!--
							<div class='distanceLimitTip'><(params.buytype2distance)>公里内</div>
-->
						</div>
					</div>
					<div class='shop-address-span shop-address-placeholder'>
						<div><(params.buytype1placehode)></div>
						<div class="icon icon-right"></div>
					</div>
				</div>
			</div>
			<div class='address-item address-recieve'>
				<div class="left">
					<div class='address-item-title'><(params.accepttitle)></div>
					<div class='address-item-after'>
						<div class='receive-address-span' style="color: #c1c1c1"><(params.acceptplacehode)></div>
						<div class='receive-address-userinfo'></div>
					</div>
				</div>
				<div class="icon icon-right"></div>
			</div>
		</div>
		<(/if)>
		<!-- 地址信息 样式2 -->
		<(if params.scene == 'delivery')>
		<div class='delivery-address'>
			<div class="address delivery-address-item border-1px-b" url='receiveAddress'>
				<div class='address-bullet address-send'></div>
				<div class='address-content'>
					<div class="address-location"><(params.buytype1placehode)></div>
				</div>
				<div class="icon icon-right" style="color:#ccc;font-size: 10px;position: absolute;right:-4px;"></div>
			</div>

			<div class='address delivery-address-item' url='receiveAddress'>
				<div class='address-bullet address-get' style='background-color: rgb(255, 129, 122);'></div>
				<div class='address-content'>
					<div class='address-placeholder'><(params.acceptplacehode)></div>
				</div>
				<div class="icon icon-right" style="color:#ccc;font-size: 10px;position: absolute;right:-4px;"></div>
			</div>
		</div>
		<(/if)>
		<!-- 立即取件 -->
		<div class="delivery-extra-info border-1px-t">
			<div class='text-content'>
				<div class="inner-text" style='color: rgb(51, 51, 51);'>立即取件</div>
				<div class="span-arrow" style='transform: rotate(45deg);'></div>
			</div>
			<div class='vertical-divider'></div>
			<div class='text-content'>
				<div class='inner-div' style="color: rgb(153, 153, 153);">物品重量</div>
				<div class='span-arrow' style="transform: rotate(45deg);"></div>
			</div>
		</div>
<!--		&lt;!&ndash; 物品类型 重量 &ndash;&gt;
		<div class="category-info">
			<div class='side'>
				&lt;!&ndash; 头部信息 &ndash;&gt;
				<div class='header'>
					<text class='header-btn'>取消</text>
					<text class='header-title'>物品类型</text>
					<text class='header-btn'>确定</text>
				</div>
				&lt;!&ndash; 物品信息 &ndash;&gt;
				<div class="goods-info">
					&lt;!&ndash; 物品类型选择 &ndash;&gt;
					<div class='types'>
						<div class='tag-list type-list'>
							<div class='tag'>鲜花</div>
							<div class='tag'>餐饮</div>
							<div class='tag'>生鲜</div>
							<div class='tag'>文件</div>
							<div class='tag'>钥匙</div>
							<div class='tag'>其他</div>
						</div>
					</div>
					&lt;!&ndash; 物品重量 &ndash;&gt;
					<div class='weight'>
						<div class='weight-label'>重量</div>
						<div class='weight-value'>5公斤</div>
						<div class="slide-bar goods-info-slide-bar">
							<div class='slide-line-bottom'>
								<text class='left'>
									<text class='left-label'>小于5公斤</text>
								</text>
								<text class='right'>
									<text class='right-label'>20公斤</text>
								</text>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>-->
	</div>
	<div id="basic-extra"></div>
	<div class="drag fixed nodelete" data-itemid="<(itemid)>">
		<div class='extra-fee'>
			<div class="extra-fee-item <(if params.showtips == 1)>border-1px-b<(/if)>">
				<div class="extra-fee-item-title"><(params.redpacketname)></div>
				<div class='extra-fee-item-after' style="color: <(style.redpackettextcolor)>">
					<(params.noredpacketnote)>
					<div class="icon icon-right"></div>
				</div>
			</div>
			<(if params.showtips == 1)>
				<div class='extra-fee-item'>
					<div class="extra-fee-item-title"><(params.tipsname)></div>
					<div class='extra-fee-item-after' style="color: <(style.tipstextcolor)>">
						<(params.tipsnote)>
						<div class="icon icon-right"></div>
					</div>
				</div>
			<(/if)>
		</div>
		<div class='shop-argeement'>
			<div class='user-argeement'>
				<div class="icon icon-check"></div>
				<div class="user-argeement-label">同意并接受</div>
				<div class="argeement">《服务协议》</div>
			</div>
		</div>
		<div class='order-submit'>
			<div class='order-info'>
				<div class='order-info-estimate'>
					<span class='distance'>3公里内</span>
					<span class='duration'>预计60分钟内送达</span>
				</div>
				<div class='order-info-fee'>
					<span class='desc'><(params.feesname)></span>
					<span class="num"> 14</span>
					<span class='unit'>元</span>
					<div class='order-info-arrow-wrap'>
						<div class='order-info-arrow'>
							<span class="icon icon-fold"></span>
						</div>
					</div>
				</div>
			</div>
			<div class='submit-btn' style="background-color: <(style.submitcolor)>"><(params.submitname)></div>
		</div>
	</div>
</script>


<script type="text/html" id="tpl-show-blank">
	<div class="drag" data-itemid="<(itemid)>" style="height: <(style.height)>px; background: <(style.background)>"></div>
</script>

<script type="text/html" id="tpl-show-line">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-line" style="background: <(style.background)>; padding: <(style.padding)>px 0;">
			<div class="line" style="border-top: <(style.height || '2')>px <(style.linestyle || 'solid')> <(style.bordercolor || '#000000')>"></div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-show-redpacket">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-superRedpacket">
			<!--<div class="modal modal-no-buttons modal-in" id="sharemodal">-->
			<div class="banner">
				<img src="../addons/we7_wmall/plugin/superRedpacket/static/img/header.png" alt="">
			</div>
			<div class="container">

				<div class="redpacket">
					<div class="redpacket-info row">
						<div class="col-75 text-left">
							<span class="redpacket-title">通用红包</span>
						</div>
						<div class="col-25 price text-right">
							￥<span>5</span>
						</div>
					</div>
					<div class="circle-container">
						<span class="circle circle-left"></span>
						<span class="circle circle-right"></span>
					</div>
					<div class="redpacket-limit row">
						<div class="col-50 use-days-limit text-left">还有一天可使用</div>
						<div class="col-50 use-condition text-right">满20可用</div>
					</div>
				</div>

				<div class="redpacket">
					<div class="redpacket-info row">
						<div class="col-75 text-left">
							<span class="redpacket-title">下午茶频道红包</span>
						</div>
						<div class="col-25 price text-right">
							￥<span>5</span>
						</div>
					</div>
					<div class="circle-container">
						<span class="circle circle-left"></span>
						<span class="circle circle-right"></span>
					</div>
					<div class="redpacket-limit row">
						<div class="col-50 use-days-limit text-left">还有一天可使用</div>
						<div class="col-50 use-condition text-right">满40可用</div>
					</div>
				</div>

				<div class="redpacket">
					<div class="redpacket-info row">
						<div class="col-75 text-left">
							<span class="redpacket-title">夜宵频道红包</span>
						</div>
						<div class="col-25 price text-right">
							￥<span>6</span>
						</div>
					</div>
					<div class="circle-container">
						<span class="circle circle-left"></span>
						<span class="circle circle-right"></span>
					</div>
					<div class="redpacket-limit row">
						<div class="col-50 use-days-limit text-left">还有一天可使用</div>
						<div class="col-50 use-condition text-right">满50可用</div>
					</div>
				</div>

				<div class="go-home"><a href="javascript:;">进入首页</a></div>
			</div>
			<span class="icon icon-close js-close-modal" data-modal="#sharemodal"></span>
			<!--</div>-->
		</div>
	</div>
</script>

<script type="text/html" id="tpl-show-picture">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-picture" style="padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px; background: <(style.background)>;">
			<(each data as item)>
			<img src="<(tomedia item.imgurl)>" />
			<(/each)>
			<div class="dots <(style.dotalign||'left')>" style="padding: 0 <(style.leftright||'10')>px; bottom: <(style.bottom||'10')>px;">
				<(each data as item)>
				<span style="background: <(style.dotbackground||'#000000')>;"></span>
				<(/each)>
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-parts">
	<nav class="btn btn-link" data-id="page"><i class="fa fa-cog"></i> 场景设置</nav>
	<(each initPart as part)>
		<(if part.id == 'basic')>
			<nav class="btn btn-link" data-id="<(part.id)>" style="color: red"><i class="fa fa-plus"></i> <(part.name)>(必选)</nav>
		<(else)>
			<nav class="btn btn-link" data-id="<(part.id)>"><i class="fa fa-plus"></i> <(part.name)></nav>
		<(/if)>
	<(/each)>
</script>
<script type="text/html" id="tpl-editor-del">
	<div class="btn-edit-del">
		<div class="btn-edit">编辑</div>
		<div class="btn-del">删除</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-page">
	<div class="list-item">
		<div class="form-group">
			<div class="col-sm-2 control-label">场景名称</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind="name" data-placeholder="请输入名称" placeholder="请输入名称" value="<(page.name)>" />
				<div class="help-block">注意：场景名称是便于后台查找，场景标题是手机端标题。</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">场景标题</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind="title" data-placeholder="请输入标题" placeholder="请输入标题" value="<(page.title)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">场景介绍</div>
			<div class="col-sm-10">
				<textarea class="form-control richtext diy-bind" cols="70" rows="3" placeholder="请输入场景介绍" data-bind="desc" data-placeholder=""><(page.desc)></textarea>
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
	</div>
	<div class="line"></div>
	<div class="list-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">可提前&nbsp;&nbsp;&nbsp;<br>几天下单：</label>
			<div class="col-sm-10">
				<div class="input-group" style="margin-top: 7px">
					<input type="number" name="start_km" data-bind="fee_day_limit" value="<(fees.fee_day_limit)>" class="form-control diy-fee-bind" />
					<span class="input-group-addon">天</span>
				</div>
				<div style="margin-top: 5px">提示：若设置为0，则表示没有限制</div>
			</div>

		</div>
		<div class="form-group middle" style="margin:20px 0;">
			<label class="col-sm-2 control-label">计价方式：</label>
			<div class="col-sm-10">
				<div class="radio radio-inline">
					<input type="radio" name="fee_type" value="fee" class="diy-fee-bind" data-bind="fee_type" data-bind-init="true" id="fee_type_fee"  <(if fees.fee_type == 'fee')>checked<(/if)>>
					<label for="fee_type_fee">固定金额</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="fee_type" value="distance" class="diy-fee-bind" data-bind="fee_type" data-bind-init="true" id="fee_type_distance" <(if fees.fee_type == 'distance')>checked<(/if)>>
					<label for="fee_type_distance">里程计价</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="fee_type" value="section" class="diy-fee-bind" data-bind="fee_type" data-bind-init="true" id="fee_type_section" <(if fees.fee_type == 'section')>checked<(/if)>>
					<label for="fee_type_section">区间计价</label>
				</div>
			</div>
		</div>
		<(if fees.fee_type == 'fee')>
		<div class="form-group">
			<div class="col-sm-2 control-label">计费规则：</div>
			<div class="col-sm-10">
				<div class="input-group">
					<span class="input-group-addon">每单</span>
					<input type="text" name="rate" class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind="fee" value="<(fees.fee_data.fee)>"/>
					<span class="input-group-addon">元</span>
				</div>
			</div>
		</div>
		<(/if)>
		<(if fees.fee_type == 'distance')>
		<div class="form-group middle">
			<div class="col-sm-2 control-label">路径计&nbsp;&nbsp;&nbsp;<br>算方式：</div>
			<div class="col-sm-10">
				<div class="radio radio-inline">
					<input type="radio" name="route_mode" value="riding" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="route_mode"  data-bind-init="true" id="route_mode_riding" <(if fees.fee_data.distance.route_mode == 'riding')>checked<(/if)>>
					<label for="route_mode_riding">按骑行路径</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="route_mode" value="driving" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="route_mode"  data-bind-init="false" id="route_mode_driving" <(if fees.fee_data.distance.route_mode == 'driving')>checked<(/if)>>
					<label for="route_mode_driving">按驾车路径</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="route_mode" value="walking" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="route_mode"  data-bind-init="false" id="route_mode_walking" <(if fees.fee_data.distance.route_mode == 'walking')>checked<(/if)>>
					<label for="route_mode_walking">按步行路径</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="route_mode" value="line" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="route_mode"  data-bind-init="false" id="route_mode_line" <(if fees.fee_data.distance.route_mode == 'line')>checked<(/if)>>
					<label for="route_mode_line">按直线路径</label>
				</div>
			</div>
		</div>
		<div class="form-group middle">
			<div class="col-sm-2 control-label">所得配送费&nbsp;&nbsp;&nbsp;<br>是否取整：</div>
			<div class="col-sm-10">
				<div class="radio radio-inline">
					<input type="radio" name="fee_is_int" value="1" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="fee_is_int"  data-bind-init="true" id="fee_is_int_yes" <(if fees.fee_data.distance.fee_is_int == 1)>checked<(/if)>>
					<label for="fee_is_int_yes">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="fee_is_int" value="0" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="fee_is_int"  data-bind-init="false" id="fee_is_int_no" <(if fees.fee_data.distance.fee_is_int == 0)>checked<(/if)>>
					<label for="fee_is_int_no">否</label>
				</div>
			</div>
		</div>
		<div class="form-items" data-min="1" data-max="5">
			<div class="inner">
				<(each fees.fee_data.distance.data as item index)>
				<div class="item" data-id="<(index)>">
					<span class="btn-del del-distance-item" title="删除"></span>
					<div class="item-body">
						<div class="hour clockpicker">
							<div class="form-group">
								<div class="col-sm-2 control-label" style="padding-top:17px;">计费时段：</div>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="text" name="start_hour" readonly class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="data" data-bind-category="<(index)>" data-bind-type="start_hour" value="<(item.start_hour)>">
										<span class="input-group-addon border-0-lr">至</span>
										<input type="text" name="end_hour" readonly class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="data" data-bind-category="<(index)>" data-bind-type="end_hour" value="<(item.end_hour)>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 control-label" >计费规则：</div>
							<div class="col-sm-10">
								<div class="input-group" style="margin-bottom: 10px;">
									<div class="input-group-addon">起步</div>
									<input type="text" name="start_km" class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="data" data-bind-category="<(index)>" data-bind-type="start_km" value="<(item.start_km)>">
									<div class="input-group-addon">km内</div>
									<input type="text" name="start_fee" class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="data" data-bind-category="<(index)>" data-bind-type="start_fee" value="<(item.start_fee)>">
									<div class="input-group-addon">元，每增</div>
									<input type="text" name="pre_km" class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="data" data-bind-category="<(index)>" data-bind-type="pre_km" value="<(item.pre_km)>">
									<div class="input-group-addon">km加</div>
									<input type="text" name="pre_km_fee" class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="data" data-bind-category="<(index)>" data-bind-type="pre_km_fee" value="<(item.pre_km_fee)>">
									<div class="input-group-addon">元</div>
								</div>
								<div class="input-group">
									<div class="input-group-addon">超出</div>
									<input type="text" name="over_km" class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="data" data-bind-category="<(index)>" data-bind-type="over_km" value="<(item.over_km)>">
									<div class="input-group-addon">km后，每增</div>
									<input type="text" name="over_pre_km" class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="data" data-bind-category="<(index)>" data-bind-type="over_pre_km" value="<(item.over_pre_km)>">
									<div class="input-group-addon">km加</div>
									<input type="text" name="over_pre_km_fee" class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="distance" data-bind="data" data-bind-category="<(index)>" data-bind-type="over_pre_km_fee" value="<(item.over_pre_km_fee)>">
									<div class="input-group-addon">元</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<(/each)>
			</div>
			<div class="btn btn-default btn-block" id="addDistanceItem"><i class="icon icon-plus"></i> 添加一个时间段</div>
		</div>
		<(/if)>
		<(if fees.fee_type == 'section')>
		<div class="form-group middle">
			<div class="col-sm-2 control-label">路径计&nbsp;&nbsp;&nbsp;<br>算方式：</div>
			<div class="col-sm-10">
				<div class="radio radio-inline">
					<input type="radio" name="route_mode" value="riding" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="section" data-bind="route_mode"  data-bind-init="true" id="s_route_mode_riding" <(if fees.fee_data.section.route_mode == 'riding')>checked<(/if)>>
					<label for="s_route_mode_riding">按骑行路径</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="route_mode" value="driving" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="section" data-bind="route_mode"  data-bind-init="true" id="s_route_mode_driving" <(if fees.fee_data.section.route_mode == 'driving')>checked<(/if)>>
					<label for="s_route_mode_driving">按驾车路径</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="route_mode" value="walking" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="section" data-bind="route_mode"  data-bind-init="true" id="s_route_mode_walking" <(if fees.fee_data.section.route_mode == 'walking')>checked<(/if)>>
					<label for="s_route_mode_walking">按步行路径</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="route_mode" value="line" class="diy-fee-bind" data-bind-child="fee_data" data-bind-parent="section" data-bind="route_mode"  data-bind-init="true" id="s_route_mode_line" <(if fees.fee_data.section.route_mode == 'line')>checked<(/if)>>
					<label for="s_route_mode_line">按直线路径</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="form-items" data-min="1" data-max="3">
				<div class="inner">
					<(each fees.fee_data.section.data as item index)>
					<div class="item" data-id="<(index)>">
						<span class="btn-del del-section-item" title="删除"></span>
						<div class="item-body">
							<div class="hour clockpicker">
								<div class="form-group">
									<div class="col-sm-2 control-label" style="padding-top:17px;">计费时段：</div>
									<div class="col-sm-10">
										<div class="input-group">
											<input type="text" name="start_hour" readonly class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="section" data-bind="data" data-bind-category="<(index)>" data-bind-type="start_hour" value="<(item.start_hour)>">
											<span class="input-group-addon border-0-lr">至</span>
											<input type="text" name="end_hour" readonly class="form-control diy-fee-bind" data-bind-child="fee_data" data-bind-parent="section" data-bind="data" data-bind-category="<(index)>" data-bind-type="end_hour" value="<(item.end_hour)>">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group" >
								<div class="col-sm-2 control-label" style="padding-top:17px;">计费规则：</div>
								<div class="col-sm-10">
									<(each item.rules.data as rule index1)>
									<div class="input-group rule-item" style="margin-bottom: 10px;" data-id="<(index1)>" data-min="1">
										<input type="text" name="start_km" data-bind-child="fee_data" data-bind-parent="section" data-bind="data" data-bind-category="<(index)>" data-bind-type="rules" data-bind-one="data" data-bind-two="<(index1)>" data-bind-three="start_km" value="<(rule.start_km)>" class="form-control diy-fee-bind"/>
										<div class="input-group-addon">~</div>
										<input type="text" name="end_km" data-bind-child="fee_data" data-bind-parent="section" data-bind="data" data-bind-category="<(index)>" data-bind-type="rules" data-bind-one="data" data-bind-two="<(index1)>" data-bind-three="end_km" value="<(rule.end_km)>" class="form-control diy-fee-bind"/>
										<div class="input-group-addon">km,</div>
										<input type="text" name="fee" data-bind-child="fee_data" data-bind-parent="section" data-bind="data" data-bind-category="<(index)>" data-bind-type="rules" data-bind-one="data" data-bind-two="<(index1)>" data-bind-three="fee" value="<(rule.fee)>" class="form-control diy-fee-bind"/>
										<div class="input-group-addon">元</div>
										<span class="btn-del del-rule-item" title="删除"></span>
									</div>
									<(/each)>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 control-label"></div>
							<div class="col-sm-10">
								<a href="javascript:;" class="btn btn-default btn-sm add-rule"><i class="fa fa-plus-circle"></i> 添加计费规则</a>
							</div>
						</div>
					</div>
					<(/each)>
				</div>
				<div class="btn btn-default btn-block " id="addSectionItem"><i class="icon icon-plus"></i> 添加时间段</div>
			</div>
		</div>
		<(/if)>
	</div>
	<div class="line"></div>
	<div class="list-item">
		<div class="form-group middle">
			<div class="col-sm-2 control-label">是否启用&nbsp;&nbsp;&nbsp; <br>重量计费：</div>
			<div class="col-sm-10">
				<div class="radio radio-inline">
					<input type="radio" name="weight_status" value="1" class="diy-fee-bind" data-bind="weight_status"  data-bind-init="true" id="weight_status_yes" <(if fees.weight_status == 1)>checked<(/if)>>
					<label for="weight_status_yes">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="weight_status" value="0" class="diy-fee-bind" data-bind="weight_status" data-bind-init="false" id="weight_status_no" <(if fees.weight_status == 0)>checked<(/if)>>
					<label for="weight_status_no">否</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="inner">
				<div class="item">
					<div class="item-body">
						<div class="form-group">
							<div class="col-sm-2 control-label">起步价包含：</div>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" name="basic" class="form-control diy-fee-bind" data-bind-child="weight_data" data-bind="basic" value="<(fees.weight_data.basic)>">
									<div class="input-group-addon">千克</div>
								</div>
							</div>
						</div>
						<div class="form-group" >
							<div class="col-sm-2 control-label">计费规则：</div>
							<div class="col-sm-10 weights" data-min="1">
								<(each fees.weight_data.data as weight index)>
								<div class="input-group weight-item" style="margin-bottom: 10px;" data-id="<(index)>">
									<div class="input-group-addon">超过</div>
									<input type="text" name="over_kgs" data-bind-child="weight_data" data-bind-parent="data" data-bind="<(index)>" data-bind-category="over_kgs" value="<(weight.over_kgs)>" class="form-control diy-fee-bind"/>
									<div class="input-group-addon">千克，每千克增加</div>
									<input type="text" name="pre_kg_fees" data-bind-child="weight_data" data-bind-parent="data" data-bind="<(index)>" data-bind-category="pre_kg_fees" value="<(weight.pre_kg_fees)>" class="form-control diy-fee-bind"/>
									<div class="input-group-addon">元</div>
									<span class="btn-del del-weight-item" title="删除"></span>
								</div>
								<(/each)>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2 control-label"></div>
						<div class="col-sm-10">
							<a href="javascript:;" class="btn btn-default btn-sm add-weight-item"><i class="fa fa-plus-circle"></i> 添加计费规则</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="list-item">
		<div class="form-group middle">
			<div class="col-sm-2 control-label">是否启用&nbsp;&nbsp;&nbsp; <br>时段附加：</div>
			<div class="col-sm-10">
				<div class="radio radio-inline">
					<input type="radio" name="extra_fee_time_status" value="1" class="diy-fee-bind" data-bind="extra_fee_time_status"  data-bind-init="true" id="extra_fee_time_status_yes" <(if fees.extra_fee_time_status == 1)>checked<(/if)>>
					<label for="extra_fee_time_status_yes">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="extra_fee_time_status" value="0" class="diy-fee-bind" data-bind="extra_fee_time_status" data-bind-init="false" id="extra_fee_time_status_no" <(if fees.extra_fee_time_status == 0)>checked<(/if)>>
					<label for="extra_fee_time_status_no">否</label>
				</div>
			</div>
		</div>
		<div class="form-items" data-min="1" data-max="5">
			<div class="inner">
				<(each fees.extra_fee_time_data.data as item index)>
				<div class="item" data-id="<(index)>">
					<span class="btn-del del-extra-fee-time-item" title="删除"></span>
					<div class="item-body">
						<div class="hour clockpicker">
							<div class="form-group">
								<div class="col-sm-2 control-label" style="padding-top:17px;">计费时段：</div>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="text" readonly class="form-control diy-fee-bind" data-bind-child="extra_fee_time_data" data-bind-parent="data" data-bind="<(index)>" data-bind-category="start_hour" value="<(item.start_hour)>">
										<span class="input-group-addon border-0-lr">至</span>
										<input type="text" readonly class="form-control diy-fee-bind" data-bind-child="extra_fee_time_data" data-bind-parent="data" data-bind="<(index)>" data-bind-category="end_hour" value="<(item.end_hour)>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 control-label" style="padding-top:17px;">计费规则：</div>
							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">加收服务费</div>
									<input type="text" class="form-control diy-fee-bind" data-bind-child="extra_fee_time_data" data-bind-parent="data" data-bind="<(index)>" data-bind-category="fee" value="<(item.fee)>">
									<div class="input-group-addon">元</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<(/each)>
			</div>
			<div class="btn btn-default btn-block" id="addExtraFeeTimeItem"><i class="icon icon-plus"></i> 添加一个时间段</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="list-item">
		<div class="form-items" data-min="1" data-max="5">
			<div class="inner">
				<(each fees.extra_fee as item index)>
					<div class="item" data-id="<(index)>">
						<span class="btn-del del-extra-fee" title="删除"></span>
						<div class="item-body">
							<div class="form-group">
								<div class="col-sm-2 control-label">是否开启</div>
								<div class="col-sm-10">
									<div class="col-sm-10">
										<label class="radio-inline"><input type="radio" value="1" class="diy-fee-bind"  data-bind-child="extra_fee" data-bind-parent="<(index)>" data-bind="status" data-bind-init="true" <(if item.status=='1')>checked<(/if)> > 是</label>
										<label class="radio-inline"><input type="radio" value="0" class="diy-fee-bind"  data-bind-child="extra_fee" data-bind-parent="<(index)>" data-bind="status" data-bind-init="true" <(if item.status=='0'||!item.status)>checked<(/if)> > 否</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-2 control-label">名称</div>
								<div class="col-sm-10">
									<input class="form-control input-sm diy-fee-bind" data-bind-child="extra_fee" data-bind-parent="<(index)>" data-bind="title" value="<(item.title)>" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-2 control-label" style="padding-top: 17px;">选择个数</div>
								<div class="col-sm-10">
									<div class="input-group">
										<div class="input-group-addon">至少选择</div>
										<input type="text" class="form-control diy-fee-bind" data-bind-child="extra_fee" data-bind-parent="<(index)>" data-bind="min" value="<(item.min)>">
										<div class="input-group-addon">项，最多选择</div>
										<input type="text" class="form-control diy-fee-bind" data-bind-child="extra_fee" data-bind-parent="<(index)>" data-bind="max" value="<(item.max)>">
										<div class="input-group-addon">项</div>
									</div>
								</div>
							</div>
							<div class="form-group" >
								<div class="col-sm-2 control-label">附加费</div>
								<div class="col-sm-10 extra-fee-items" data-min="1" data-max="5">
									<(each item.data as item1 index1)>
										<div class="input-group extra-fee-item" style="margin-bottom: 10px;" data-id="<(index1)>">
											<div class="input-group-addon">附加费名称</div>
											<input type="text" data-bind-child="extra_fee" data-bind-parent="<(index)>" data-bind="data" data-bind-category="<(index1)>" data-bind-type="fee_name" value="<(item1.fee_name)>" class="form-control diy-fee-bind"/>
											<div class="input-group-addon">金额</div>
											<input type="text" data-bind-child="extra_fee" data-bind-parent="<(index)>" data-bind="data" data-bind-category="<(index1)>" data-bind-type="fee" value="<(item1.fee)>" class="form-control diy-fee-bind"/>
											<div class="input-group-addon">元</div>
											<span class="btn-del del-extra-fee-item" title="删除"></span>
										</div>
									<(/each)>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-2 control-label"></div>
								<div class="col-sm-10">
									<a href="javascript:;" class="btn btn-default btn-sm " id="add-extrafee-item"><i class="fa fa-plus-circle"></i> 添加一个附加费</a>
								</div>
							</div>
						</div>
					</div>
				<(/each)>
			</div>
			<div class="btn btn-default btn-block" id="addExtraFee"><i class="icon icon-plus"></i> 添加一个选择附加费</div>
		</div>
	</div>
</script>
<script type="text/html" id="tpl-editor-banner">
	<!--<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>-->
	<div class="form-items indent" data-min="1">
		<div class="inner" id="form-items">
			<(each data as child itemid )>
			<div class="item" data-id="<(itemid)>">
				<span class="btn-del" title="删除"></span>
				<div class="item-body">
					<div class="item-image">
						<img src="<(tomedia child.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" id="pimg-<(itemid)>" />
					</div>
					<div class="item-form">
						<div class="input-group" style="margin-bottom:0px; ">
							<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="imgurl"  id="cimg-<(itemid)>" placeholder="请选择图片或输入图片地址" value="<(child.imgurl)>" />
							<span class="input-group-addon btn btn-default js-selectImg" data-input="#cimg-<(itemid)>" data-img="#pimg-<(itemid)>" data-element="#pimg-<(itemid)>">选择图片</span>
						</div>
						<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
							<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-<(itemid)>" placeholder="请选择链接或输入链接地址" value="<(child.linkurl)>" />
							<span class="input-group-addon btn btn-default js-selectWxappLink" data-input="#curl-<(itemid)>">选择链接</span>
						</div>
					</div>
				</div>
			</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline addChild"><i class="fa fa-plus"></i> 添加一个</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-blank">
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">元素高度</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.height)>" data-min="1" data-max="200"></div>
				<div class="col-sm-4 control-labe count"><span><(style.height)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="height" value="<(style.height)>" type="hidden" />
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-line">
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">线条颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="bordercolor" value="<(style.bordercolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">线条样式</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="linestyle" value="solid" class="diy-bind" data-bind-child="style" data-bind="linestyle" <(if style.linestyle=='solid')>checked="checked"<(/if)> > 实线</label>
			<label class="radio-inline"><input type="radio" name="linestyle" value="dashed" class="diy-bind" data-bind-child="style" data-bind="linestyle" <(if style.linestyle=='dashed')>checked="checked"<(/if)>> 虚线(长方形)</label>
			<label class="radio-inline"><input type="radio" name="linestyle" value="dotted" class="diy-bind" data-bind-child="style" data-bind="linestyle" <(if style.linestyle=='dotted')>checked="checked"<(/if)>> 虚线(正方形)</label>
			<label class="radio-inline"><input type="radio" name="linestyle" value="double" class="diy-bind" data-bind-child="style" data-bind="linestyle" <(if style.linestyle=='double')>checked="checked"<(/if)>> 双实线</label>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">线条高度</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.height)>" data-min="1" data-max="20"></div>
				<div class="col-sm-4 control-labe count"><span><(style.height)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="height" value="<(style.height)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.padding)>" data-min="1" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.height)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="padding" value="<(style.padding)>" type="hidden" />
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-redpacket">
	<div class="alert alert-info">
		提示：每个场景只能添加一个红包组建。在小程序端红包以弹出层的形式显示
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">是否显示</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="showredpacket" value="0" class="diy-bind" data-bind-child="params" data-bind="showredpacket" data-bind-init="true"<(if params.showredpacket=='0'||!params.showredpacket)>checked="checked"<(/if)>> 不显示</label>
			<label class="radio-inline"><input type="radio" name="showredpacket" value="1" class="diy-bind" data-bind-child="params" data-bind="showredpacket" data-bind-init="true"<(if params.showredpacket=='1')>checked="checked"<(/if)>> 显示</label>
			<div class="help-block">提示：用户进入平台后弹出领取红包场景的效果</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-picture">
	<!--<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>-->
	<div class="form-group">
		<div class="col-sm-2 control-label">分页按钮颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="dotbackground" value="<(style.dotbackground)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-items" data-min="1">
		<div class="inner" id="form-items">
			<(each data as child itemid )>
			<div class="item" data-id="<(itemid)>">
				<span class="btn-del" title="删除"></span>
				<div class="item-image">
					<img src="<(tomedia child.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" id="pimg-<(itemid)>" />
				</div>
				<div class="item-form">
					<div class="input-group" style="margin-bottom:0px; ">
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="imgurl"  id="cimg-<(itemid)>" placeholder="请选择图片或输入图片地址" value="<(child.imgurl)>" />
						<span class="input-group-addon btn btn-default js-selectImg" data-input="#cimg-<(itemid)>" data-img="#pimg-<(itemid)>" data-element="#pimg-<(itemid)>">选择图片</span>
					</div>
					<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-<(itemid)>" placeholder="请选择链接或输入链接地址" value="<(child.linkurl)>" />
						<span class="input-group-addon btn btn-default js-selectWxappLink" data-input="#curl-<(itemid)>">选择链接</span>
					</div>
				</div>
			</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline addChild"><i class="fa fa-plus"></i> 添加常用标签</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-basic">
	<div class="form-group middle">
		<div class="col-sm-2 control-label">场景类型：</div>
		<div class="col-sm-10">
			<div class="radio radio-inline">
				<input type="radio" name="scene" value="buy" class="diy-bind"  data-bind-child="params" data-bind="scene"  data-bind-init="true" id="scene-buy" <(if params.scene == 'buy')>checked<(/if)>>
				<label for="scene-buy">代购</label>
			</div>
			<div class="radio radio-inline">
				<input type="radio" name="scene" value="delivery" class="diy-bind"  data-bind-child="params" data-bind="scene"  data-bind-init="true" id="scene-delivery" <(if params.scene == 'delivery')>checked<(/if)>>
				<label for="scene-delivery">取送件</label>
			</div>
		</div>
	</div>
	<div class="list-item">
		<div class="form-group">
			<div class="col-sm-2 control-label">提示文字</div>
			<div class="col-sm-10">
				<input type="text" class="form-control input input-sm diy-bind" data-bind-child="params" data-bind="placeholder" value="<(params.placeholder)>"/>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">商品预估价</div>
			<div class="col-sm-10">
				<div class="col-sm-10">
					<label class="radio-inline"><input type="radio" name="estimate" value="0" class="diy-bind" data-bind-child="params" data-bind="estimate" data-bind-init="true" <(if params.estimate=='0'||!params.estimate)>checked<(/if)> > 关闭</label>
					<label class="radio-inline"><input type="radio" name="estimate" value="1" class="diy-bind" data-bind-child="params" data-bind="estimate" data-bind-init="true" <(if params.estimate=='1')>checked<(/if)> > 开启</label>
				</div>
			</div>
		</div>
		<div class="form-items indent">
			<div class="inner" id="form-items">
				<(each data as child itemid )>
				<div class="item" data-id="<(itemid)>">
					<span class="btn-del" title="删除"></span>
					<div class="item-body">
						<div class="item-form">
							<div class="col-sm-2 control-label">常用标签</div>
							<div class="col-sm-10">
								<input type="text" class="form-control input input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="tags" id="curl-<(itemid)>" placeholder="输入标签" value="<(child.tags)>" />
							</div>
						</div>
					</div>
				</div>
				<(/each)>
			</div>
			<div class="btn btn-w-m btn-block btn-default btn-outline addChild"><i class="fa fa-plus"></i> 添加标签</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="list-item">
		<(if params.scene == 'buy')>
		<div class="form-group">
			<div class="col-sm-2 control-label"><(params.buytitle)>名称</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="buytitle" data-placeholder="请输入名称" placeholder="请输入名称" value="<(params.buytitle)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label"><(params.accepttitle)>名称</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="accepttitle" data-placeholder="请输入标题" placeholder="请输入标题" value="<(params.accepttitle)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">指定地址名称</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="buytype1title" data-placeholder="<(params.buytype1title)>" placeholder="请输入标题" value="<(params.buytype1title)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">骑手购买名称</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="buytype2title" data-placeholder="<(params.buytype2title)>" placeholder="请输入标题" value="<(params.buytype2title)>" />
			</div>
		</div>
		<(/if)>
		<div class="form-group">
			<div class="col-sm-2 control-label">取货/购买提示</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="buytype1placehode" data-placeholder="请输入提示" placeholder="请输入提示" value="<(params.buytype1placehode)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">收货提示</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="acceptplacehode" data-placeholder="请输入提示" placeholder="请输入提示" value="<(params.acceptplacehode)>" />
			</div>
		</div>
	</div>
	<div class="line"></div>
<!--	<(if params.scene == 'delivery')>
		<div class="list-item">
			<div class="form-items indent" data-max="6">
				<div class="inner">
					<(each goodsCategory as child itemid )>
					<div class="item" data-id="<(itemid)>">
						<span class="btn-del" title="删除" data-goal="goodsCategory"></span>
						<div class="item-body">
							<div class="item-form">
								<div class="col-sm-2 control-label">物品类型</div>
								<div class="col-sm-10">
									<input type="text" class="form-control input input-sm diy-bind" data-bind-parent="goodsCategory" data-bind-child="<(itemid)>" data-bind="label" id="c-<(itemid)>" placeholder="输入类型" value="<(child.label)>" />
								</div>
							</div>
						</div>
					</div>
					<(/each)>
				</div>
				<div class="btn btn-w-m btn-block btn-default btn-outline addChild" data-goal="goodsCategory"><i class="fa fa-plus"></i> 添加类型</div>
			</div>
		</div>
		<div class="line"></div>
	<(/if)>-->
	<div class="list-item">
		<div class="form-group">
			<div class="col-sm-2 control-label">红包名称</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="redpacketname" data-placeholder="请输入名称" value="<(params.redpacketname)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">无红包提示语</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="noredpacketnote" data-placeholder="请输入名称" value="<(params.noredpacketnote)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">提示语颜色</div>
			<div class="col-sm-4">
				<div class="input-group">
					<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="redpackettextcolor" value="<(style.redpackettextcolor)>" type="color" />
					<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#999999').trigger('propertychange')">清除</span>
				</div>
			</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="list-item">
		<div class="form-group">
			<div class="col-sm-2 control-label">是否开启小费</div>
			<div class="col-sm-10">
				<div class="col-sm-10">
					<label class="radio-inline"><input type="radio" name="showtips" value="0" class="diy-bind" data-bind-child="params" data-bind="showtips" data-bind-init="true" <(if params.showtips=='0'||!params.estimate)>checked<(/if)> > 关闭</label>
					<label class="radio-inline"><input type="radio" name="showtips" value="1" class="diy-bind" data-bind-child="params" data-bind="showtips" data-bind-init="true" <(if params.showtips=='1')>checked<(/if)> > 开启</label>
				</div>
			</div>
		</div>
		<(if params.showtips == 1)>
		<div class="form-group">
			<div class="col-sm-2 control-label">小费名称</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="tipsname" data-placeholder="请输入名称" value="<(params.tipsname)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">小费提示语</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="tipsnote" data-placeholder="请输入名称" value="<(params.tipsnote)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">小费区间</div>
			<div class="col-sm-10">
				<div class="input-group">
					<span class="input-group-addon">最少</span>
					<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="minfee" data-placeholder="最小金额" value="<(params.minfee)>" />
					<span class="input-group-addon">元</span>
					<span class="input-group-addon">最大</span>
					<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="maxfee" data-placeholder="最大金额" value="<(params.maxfee)>" />
					<span class="input-group-addon">元</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">提示语颜色</div>
			<div class="col-sm-4">
				<div class="input-group">
					<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="tipstextcolor" value="<(style.tipstextcolor)>" type="color" />
					<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#999999').trigger('propertychange')">清除</span>
				</div>
			</div>
		</div>
		<(/if)>
	</div>
	<div class="line"></div>
	<div class="list-item">
		<div class="form-group">
			<div class="col-sm-2 control-label"><(params.feesname)>编辑</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="feesname" data-placeholder="请输入名称" value="<(params.feesname)>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label"><(params.submitname)>编辑</div>
			<div class="col-sm-10">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="submitname" data-placeholder="提交订单" value="<(params.submitname)>" />
			</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="list-item">
		<div class="form-group">
			<div class="col-sm-2 control-label">服务协议</div>
		</div>
		<div class="form-richtext">
			<div id="rich"></div>
			<textarea id="richtext" class="diy-bind" data-bind-child="params" data-bind="agreement" style="display: none"></textarea>
		</div>
	</div>
</script>

<script type="text/javascript" src="./resource/components/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/lang/zh-cn/zh-cn.js"></script>
<script language="javascript">
	var path = '../../plugin/errander/static/js/diycaretory';
	irequire([path, 'tmodtpl'],function(diy, tmodtpl){
		diy.init({
			tmodtpl: tmodtpl,
			attachurl: "<?php  echo $_W['attachurl'];?>",
			id: '<?php  echo intval($_GPC["id"])?>',
			type: <?php  if(!empty($diypage['type'])) { ?>'<?php  echo $diypage['type']?>'<?php  } else { ?>'scene'<?php  } ?>,
			data: <?php  if(!empty($diypage['data'])) { ?><?php  echo json_encode($diypage['data'])?><?php  } else { ?>null<?php  } ?>,
		});
	});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>