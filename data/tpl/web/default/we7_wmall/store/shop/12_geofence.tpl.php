<?php defined('IN_IA') or exit('Access Denied');?><style>
	.geofence{padding: 15px; border: 1px solid #eee;}
	.geofence .col-md-3{padding-left: 0; position: relative; height: 600px;}
	.geofence .col-md-9{padding: 0;}
	.geofence #allmap{height: 600px;}
	.geofence #allmap .marker-start-head-route{width:40px; height: 55px; background: url(../addons/we7_wmall/static/img/shop_marker.png); background-size: cover;}
	.geofence .geofence-container{height: 545px; overflow-y: auto; padding-left: 0;}
	.geofence .geofence-container .title{font-weight: bold; color: #666;}
	.geofence .area-item{border: 1px solid #eee; border-left: none; padding: 10px 15px; margin: 10px 0; position: relative;}
	.geofence .area-item.active{background: #f8f8f8;}
	.geofence .area-item:before{content: ''; display: block; width: 6px; height: 100%; left: 0; top: 0; position: absolute;}
	.geofence .area-item .area-item-title{height: 30px; line-height: 30px; font-size: 15px; font-weight: bold;}
	.geofence .add-container .area-item .area-item-title{height: 20px; line-height: 20px;}
	.geofence .area-item .area-item-title span{color: #666; cursor: pointer;}
	.geofence .area-item .area-item-title span:hover{color: #18a689;}
	.geofence .area-item .area-item-title .pull-right{font-size: 12px; font-weight: normal;}
	.geofence .area-item .area-item-title .btn-save{font-size: 12px; color: #18a689;}
	.geofence .area-item.area1:before{background-color: #4589ef;}
	.geofence .area-item.area1 .area-item-title{color: #4589ef;}
	.geofence .area-item.area2:before{background-color: #1ebd4f;}
	.geofence .area-item.area2 .area-item-title{color: #1ebd4f;}
	.geofence .area-item.area3:before{background-color: #06954b;}
	.geofence .area-item.area3 .area-item-title{color: #06954b;}
	.geofence .area-item.area4:before{background-color: #9a6a38;}
	.geofence .area-item.area4 .area-item-title{color: #9a6a38;}
	.geofence .area-item.area5:before{background-color: #6b543c;}
	.geofence .area-item.area5 .area-item-title{color: #6b543c;}
	.geofence .area-item .price-container{line-height: 30px; font-size: 12px;}
	.geofence .area-item .price-container span{font-weight: bold; color: #333;}
	.geofence .area-item .price-input-container{font-size: 12px;}
	.geofence .area-item .price-input-container input{width: 80px; border: 1px solid #ccc; outline: 0; border-radius: 5px; margin: 0 10px; text-align: center; font-size: 14px;}
	.geofence .area-item .price-input-container input:focus{border-color: #1ab394;}
	.geofence .area-item .price-input-container .start-send-price{line-height: 30px; margin-bottom: 10px;}
	.geofence .area-item .price-input-container .send-price{line-height: 30px; margin-bottom: 10px;}
	.geofence .area-item .price-input-container .modify-reason{line-height: 30px;}
	.geofence .area-item .price-input-container .modify-reason input{width: 120px;}
	.geofence .area-item .new-area{border-top: 1px dashed #ccc; margin-top: 10px;}
	.geofence .add-container .area-item .new-area{padding: 15px 0; border-top: 1px dashed #ccc; border-bottom: 1px dashed #ccc;}
	.geofence .area-item .new-area .help-block{font-size: 12px; margin-top: 10px;}
	.geofence .area-item .area-delete{padding-top: 10px; cursor: pointer;}
	.geofence .area-item .area-delete .icon{font-size: 15px; position: relative; top: 1px;}
	.geofence #area-add{padding: 8px 12px; margin-top: 10px;}
	.geofence .tip{position: absolute; bottom: 0; padding-right: 15px; padding-top: 15px;}
</style>
<div class="clearfix geofence">
	<input type="hidden" name="areas" value=""/>
	<div class="col-md-3">
		<div class="geofence-container"></div>
	</div>
	<div class="col-md-9">
		<div id="allmap"></div>
	</div>
</div>
<script type="text/html" id="tpl-area">
	<div class="title">区域及配送范围</div>
	<div id="area-container">
		<(each areas as item index)>
		<div class="area-item area<(item.colorType)>" data-id="<(index)>">
			<div class="area-item-inner <(if item.isActive == 1)>hide<(/if)>">
				<div class="area-item-title">配送范围 <span class="pull-right editor-area-item <(if !isChange || isActive == 1)>hide<(/if)>" data-id="<(index)>">编辑</span></div>
				<div class="price-container">
					起送价 <span class="start-send-price"><(item.send_price)></span> 元&nbsp;&nbsp;配送费 <span class="send-price"><(item.delivery_price)></span> 元&nbsp;&nbsp;满 <span class="send-price"><(item.delivery_free_price)></span> 元免配送费
				</div>
			</div>
			<div class="editor-container <(if !item.isActive)>hide<(/if)>">
				<div class="area-item-title">
					配送范围
					<div class="pull-right">
						<span class="btn-reset" data-id="<(index)>">取消</span> / <span class="btn-save" data-id="<(index)>">保存</span>
					</div>
				</div>
				<div class="price-input-container">
					<div class="start-send-price">
						<span>起送价</span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="<(item.send_price)>" class="diy-bind" data-bind-child="<(index)>" data-bind="send_price"/>元
					</div>
					<div class="send-price">
						<span>配送费</span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="<(item.delivery_price)>" class="diy-bind" data-bind-child="<(index)>" data-bind="delivery_price"/>元
					</div>
					<div class="send-price">
						<span>满</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="<(item.delivery_free_price)>" class="diy-bind" data-bind-child="<(index)>" data-bind="delivery_free_price"/>元免配送费
					</div>
				</div>
				<div class="new-area"></div>
				<div class="area-delete btn-delete" data-id="<(index)>">
					<span class="icon icon-delete"></span> 删除此区域
				</div>
			</div>
		</div>
		<(/each)>
	</div>
	<(if isChange)>
		<div id="area-add" class="btn btn-primary btn-block <(if isActive == 1)>disabled<(/if)>"><span class="icon icon-plus"></span>新增配送区域</div>
	<(/if)>
	<(if !isChange)>
		<div class="tip">当前门店的配送模式为平台配送,如需修改该项设置,请联系平台管理员</div>
	<(/if)>
</script>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.1&key=550a3bf0cb6d96c3b43d330fb7d86950&plugin=AMap.MouseTool,AMap.PolyEditor,AMap.CircleEditor,AMap.Geocoder,AMap.ToolBar,AMap.Scale,AMap.OverView"></script>
<script>
irequire(['tmodtpl', 'web/geofence'],function(tmodtpl, geofence){
	var params = {
			areas: <?php  echo json_encode($item['delivery_areas']);?>,
			tmodtpl: tmodtpl,
			store: {
				location_y: <?php  if(!empty($item['location_y'])) { ?><?php  echo $item['location_y'];?><?php  } else { ?>'116.397428'<?php  } ?>,
				location_x: <?php  if(!empty($item['location_x'])) { ?><?php  echo $item['location_x'];?><?php  } else { ?>'39.90923'<?php  } ?>,
			},
			isChange: <?php  echo intval($item['isChange']);?>
		};
						console.dir(params);
	geofence.init(params);
});
</script>