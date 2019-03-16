<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'post') { ?>
<style>
.address .list-block .item-title.label{
	width:34%;
	text-align:right;
	padding-right:2%;
}
</style>
<div class="page address">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">新增地址</h1>
		<button class="button button-link button-nav pull-right" id="btnSubmit">保存</button>
	</header>
	<?php  get_mall_menu()?>
	<div class="content">
		<div id="allmap" style="display: none"></div>
		<div class="list-block">
			<ul class="border-1px-tb">
				<li class="item-addr">
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title label">小区/大厦/学校</div>
							<div class="item-input">
								<label></label>
								<input type="hidden" name="lat" id="lat" value="<?php  echo $address['location_x'];?>"/>
								<input type="hidden" name="lng" id="lng" value="<?php  echo $address['location_y'];?>"/>
								<input type="hidden" name="name" id="name" value="<?php  echo $address['name'];?>"/>
								<input type="hidden" name="address" id="address" value="<?php  echo $address['address'];?>"/>
								<a id="location" href="<?php  echo imurl('errander/address/location', array('id' => $id, 'errander_id' => $_GPC['errander_id'], 'redirect_input' => $_GPC['redirect_input']));?>"><?php  if(!empty($address['address'])) { ?><?php  echo $address['address'];?><?php  } else { ?><span>点击添加地址(必填)</span><?php  } ?> <i class="icon fa fa-arrow-right pull-right"></i></a>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title label">楼号-门牌号</div>
							<div class="item-input">
								<input type="text" placeholder="详细地址,例：1号楼一单元102室" name="number" class="number" value="<?php  echo $address['number'];?>">
							</div>
						</div>
					</div>
				</li>
				<li class="item-li-one">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">联系人</div>
							<div class="item-input">
								<div class="meitem-input border-1px-b"><input type="text" name="realname" class="realname" placeholder="您的姓名" value="<?php  echo $address['realname'];?>"></div>
								<div class="item-sex border-1px-b">
									<label class="label-checkbox item-content">
										<input type="radio" name="sex" value="先生" class="sex" <?php  if($address['sex'] == '先生' || !$address['sex']) { ?>checked<?php  } ?>>
										<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
										<div class="item-inner">
											<div class="item-title">先生</div>
										</div>
									</label>
									<label class="label-checkbox item-content">
										<input type="radio" name="sex" value="女士" class="sex" <?php  if($address['sex'] == '女士') { ?>checked<?php  } ?>>
										<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
										<div class="item-inner">
											<div class="item-title">女士</div>
										</div>
									</label>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title label">手机号</div>
							<div class="item-input">
								<input type="text" name="mobile" class="mobile" placeholder="配送人员联系您的电话" value="<?php  echo $address['mobile'];?>">
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.1&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>
<?php  if(empty($address['id']) && empty($_GPC['d'])) { ?>
	function getLocation() {
		var map, geolocation;
		map = new AMap.Map('allmap');
		map.plugin('AMap.Geolocation', function() {
			geolocation = new AMap.Geolocation({
				enableHighAccuracy: true //是否使用高精度定位，默认:true
			});
			geolocation.getCurrentPosition();
			AMap.event.addListener(geolocation, 'complete', function(point){
				var lnglatXY = [point.position.lng, point.position.lat]; //已知点坐标
				map.plugin('AMap.Geocoder', function() {
					var geocoder = new AMap.Geocoder();
					geocoder.getAddress(lnglatXY, function(status, result) {
						if (status === 'complete' && result.info === 'OK') {
							var address = result.regeocode.formattedAddress;
							var obj = result.regeocode.addressComponent;
							address = address.replace(obj.province, '');
							address = address.replace(obj.district, '');
							address = address.replace(obj.city, '');
							$('#address').val(address);
							$('#lng').val(point.position.lng);
							$('#lat').val(point.position.lat);
							$('#location').html(address + ' <i class="icon fa fa-arrow-right pull-right"></i>');
						}
					});
				});
			});
		});
	}
	getLocation();
<?php  } ?>

var redirect_url = "<?php  echo $redirect_url;?>";
$(function(){
	$('#btnSubmit').click(function(){
		var $this = $(this);
		if($(this).hasClass('disabled')) {
			return false;
		}
		var realname = $.trim($('.realname').val());
		if(!realname) {
			$.toast("联系人不能为空");
			return false;
		}
		var mobile = $.trim($('.mobile').val());
		var reg = /^[01][3456789][0-9]{9}$/;
		if(!reg.test(mobile)) {
			$.toast("手机号格式错误");
			return false;
		}
		var sex = $.trim($('.sex:checked').val());
		if(!sex) {
			$.toast("请选择性别");
			return false;
		}
		var address = $.trim($('#address').val());
		var name = $.trim($('#name').val());
		if(!address) {
			$.toast("地址不能为空");
			return false;
		}
		var lat = $('#lat').val();
		var lng = $('#lng').val();
		if(!lat || !lng) {
			$.toast("地址信息有误");
			return false;
		}
		var number = $('.number').val();
		var params = {
			realname: realname,
			mobile: mobile,
			sex: sex,
			name: name,
			address: address,
			number: number,
			location_x: lat,
			location_y: lng
		};
		$(this).addClass('disabled');
		$.post("<?php  echo imurl('errander/address/post', array('id' => $id))?>", params, function(data) {
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$this.removeClass('disabled');
				$.toast(result.message.message);
			} else {
				location.href = redirect_url + result.message.message;
			}
			return false;
		});
	});
});
</script>
<?php  } ?>

<?php  if($op == 'location') { ?>
<div class="page locate" id="page-app-locate">
	<header class="bar bar-nav">
		<a class="pull-left" id="locate-back" href="javascript:;" data-href="<?php  echo imurl('errander/address/post', array('id' => $id, 'errander_id' => $_GPC['errander_id'], 'redirect_input' => $_GPC['redirect_input']));?>"><i class="icon icon-arrow-left"></i></a>
		<div class="search-input">
			<label class="icon locateicon" for="search"></label>
			<input type="search" id='search' placeholder='请输入小区/大厦/学校等'/>
		</div>
	</header>
	<div class="content">
		<div class="map">
			<div id="allmap"></div>
			<div class="dot" style="display:block;"></div>
			<input name="lat" id="lat" type="hidden"/>
			<input name="lng" id="lng" type="hidden"/>
		</div>
		<div class="buttons-tab select-tab border-1px-t">
			<a href="javascript:;" class="button active" data-keywords=" ">全部</a>
			<a href="javascript:;" class="button" data-keywords="小区">小区</a>
			<a href="javascript:;" class="button" data-keywords="写字楼">写字楼</a>
			<a href="javascript:;" class="button" data-keywords="学校">学校</a>
		</div>
		<ul class="locate-ls border-1px-tb" id="locate-ls"></ul>
		<ul class="search-list hide" id="search-list"></ul>
	</div>
</div>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.1&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>
	$(function(){
		var config = <?php  echo json_encode($_config_plugin);?>;
		var map = new AMap.Map('allmap', {
			resizeEnable: true,
			center: [config.map.location_y, config.map.location_x],
			zoom: 13
		});
		var circle = new AMap.Circle({
			center: new AMap.LngLat(config.map.location_y, config.map.location_x),// 圆心位置
			radius: config.serve_radius * 1000, //半径
			strokeColor: "#F33", //线颜色
			strokeOpacity: 0.7, //线透明度
			strokeWeight: 2, //线粗细度
			fillColor: "#1791fc", //填充颜色
			fillOpacity: 0.5//填充透明度
		});
		circle.setMap(map);
		$('#lat').val(config.map.location_x);
		$('#lng').val(config.map.location_y);
		getPositionInfo(config.map.location_x, config.map.location_y);

		AMap.event.addListener(map, "dragend", function(){
			var center = map.getCenter();
			$('#lat').val(center.lat);
			$('#lng').val(center.lng);
			getPositionInfo(center.lat, center.lng);
		});

		$('#search').bind('input', function(){
			var key = $.trim($(this).val());
			if(!key) {
				return false;
			}
			$('#search-list').removeClass('hide');
			$.post("<?php  echo imurl('errander/address/suggestion');?>", {key: key}, function(data){
				var result = $.parseJSON(data);
				if(result.message.error != -1) {
					getAdress(result.message.message, '#search-list');
				}
			});
		});

		$(document).on('click', '#locate-back', function() {
			var href = $(this).data('href');
			if(!$('#search-list').hasClass('hide')) {
				$('#search-list').html('').addClass('hide');
				$('#search').val('');
			} else {
				location.href = href;
			}
		});
		$(document).on('click', '.buttons-tab .button', function() {
			$(this).addClass('active').siblings().removeClass('active');
			var lat = $('#lat').val();
			var lng = $('#lng').val();
			getPositionInfo(lat, lng);
		});

		$(document).on('click', '.select-locate', function(){
			var lng = $(this).data('lng');
			var lat = $(this).data('lat');
			var lnglat = new AMap.LngLat(config.map.location_y, config.map.location_x);
			var dist = ((lnglat.distance([lng, lat])) / 1000).toFixed(2);
			if(config.serve_radius > 0 && dist > config.serve_radius) {
				$.toast('跑腿服务范围' + config.serve_radius + '公里, 当前地址不在服务范围内');
				return false;
			}
			var url = "<?php  echo imurl('errander/address/post', array('id' => $_GPC['id'], 'd' => 1, 'r' => $_GPC['r'], 'redirect_input' => $_GPC['redirect_input'], 'errander_id' => $_GPC['errander_id']));?>";
			url += '&name=' + $(this).data('address') +'&address=' + $(this).data('name') + '&lng=' + $(this).data('lng') + '&lat=' + $(this).data('lat');
			location.href = url;
		});
	});

	function getPositionAdress(result){
		if(result.info == "OK"){
			var re = [];
			for(var i in result.pois){
				var location = result.pois[i].location.split(',');
				re.push({'name':result.pois[i].name, 'address':result.pois[i].pname+result.pois[i].cityname+result.pois[i].adname+result.pois[i].address, 'lng':location[0],'lat':location[1]});
			}
			getAdress(re, '#locate-ls');
		} else {
			alert('获取位置失败！');
		}
	}

	function getPositionInfo(lat, lng){
		var keywords = $.trim($('.buttons-tab .button.active').data('keywords'));
		$.getJSON('https://restapi.amap.com/v3/place/around?key=37bb6a3b1656ba7d7dc8946e7e26f39b&location='+lng+','+lat+'&radius=50000&sortrule=distance&extensions=all&output=json&keywords='+keywords+'&callback=getPositionAdress&json=?');
	}

	function getAdress(re, container){
		var addressHtml = '';
		for(var i=0; i < re.length; i++){
			addressHtml += '<li class="border-1px-b select-locate '+ (i == 0 ? 'locate-ls-active' : '') +'" data-lng="'+re[i]['lng']+'" data-lat="'+re[i]['lat']+'" data-name="'+re[i]['name']+'" data-address="'+re[i]['address']+'">';
			addressHtml += '<div class="locate-ls-info">'+(i == 0 ? '[推荐位置]' : '')+'   '+re[i]['name']+' </span></div>';
			addressHtml += '<span> '+re[i]['address']+' </span>';
			addressHtml += '</li>';
		}
		$(container).html(addressHtml);
	}
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>