<?php
/**
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 * $sn$
 */
defined('IN_IA') or exit('Access Denied');
function tpl_form_field_fans($name, $value, $scene = 'notify', $required = false) {
	global $_W;
	if(empty($default)) {
		$default = './resource/images/nopic.jpg';
	}
	$s = '';
	if (!defined('TPL_INIT_TINY_FANS')) {
		$option = array(
			'scene' => $scene,
		);
		$option = json_encode($option);
		$s = '
		<script type="text/javascript">
			function showFansDialog(elm) {
				var btn = $(elm);
				var openid_wxapp = btn.parent().prev();
				var openid = btn.parent().prev().prev();
				var avatar = btn.parent().prev().prev().prev();
				var nickname = btn.parent().prev().prev().prev().prev();
				var img = btn.parent().parent().next().find("img");
				irequire(["web/tiny"], function(tiny){
					tiny.selectfan(function(fans){
						console.log(fans);
						if(img.length > 0){
							img.get(0).src = fans.avatar;
						}
						openid_wxapp.val(fans.openid_wxapp);
						openid.val(fans.openid);
						avatar.val(fans.avatar);
						nickname.val(fans.nickname);
					}, '. $option .');
				});
			}
		</script>';
		define('TPL_INIT_TINY_FANS', true);
	}

	$s .= '
		<div class="input-group">
			<input type="text" name="' . $name . '[nickname]" value="' . $value['nickname'] . '" class="form-control" readonly ' . ($required ? 'required' : '') . '>
			<input type="hidden" name="' . $name . '[avatar]" value="' . $value['avatar'] . '">
			<input type="hidden" name="' . $name . '[openid]" value="' . $value['openid'] . '">
			<input type="hidden" name="' . $name . '[openid_wxapp]" value="' . $value['openid_wxapp'] . '">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="showFansDialog(this);">选择粉丝</button>
			</span>
		</div>
		<div class="input-group" style="margin-top:.5em;">
			<img src="' . $value['avatar'] . '" onerror="this.src=\'' . $default . '\'; this.title=\'头像未找到.\'" class="img-responsive img-thumbnail" width="150" />
		</div>';
	return $s;
}

function itpl_form_field_daterange($name, $value = array(), $time = false) {
	global $_GPC;
	$placeholder = ((isset($value['placeholder']) ? $value['placeholder'] : ''));
	$s = '';

	if (empty($time) && !defined('TPL_INIT_TINY_DATERANGE_DATE')) {
		$s = '
<script type="text/javascript">
	require(["daterangepicker"], function() {
		$(".daterange.daterange-date").each(function(){
			var elm = this;
			var container =$(elm).parent().prev();
			$(this).daterangepicker({
				format: "YYYY-MM-DD"
			}, function(start, end){
				$(elm).find(".date-title").html(start.toDateStr() + " 至 " + end.toDateStr());
				container.find(":input:first").val(start.toDateTimeStr());
				container.find(":input:last").val(end.toDateTimeStr());
			});
		});
	});

	function clearTime(obj){
		$(obj).prev().html("<span class=date-title>" + $(obj).attr("placeholder") + "</span>");
		$(obj).parent().prev().find("input").val("");
	 }
</script>';
		define('TPL_INIT_TINY_DATERANGE_DATE', true);
	}

	if (!empty($time) && !defined('TPL_INIT_TINY_DATERANGE_TIME')) {
		$s = '
<script type="text/javascript">
	require(["daterangepicker"], function($){
		$(function(){
			$(".daterange.daterange-time").each(function() {
				var elm = this;
				var container =$(elm).parent().prev();
				$(this).daterangepicker({
					format: "YYYY-MM-DD HH:mm",
					timePicker: true,
					timePicker12Hour : false,
					timePickerIncrement: 1,
					minuteStep: 1
				}, function(start, end){
					$(elm).find(".date-title").html(start.toDateTimeStr() + " 至 " + end.toDateTimeStr());
					container.find(":input:first").val(start.toDateTimeStr());
					container.find(":input:last").val(end.toDateTimeStr());
				});
			});
		});
	});

	function clearTime(obj){
		$(obj).prev().html("<span class=date-title>" + $(obj).attr("placeholder") + "</span>");
		$(obj).parent().prev().find("input").val("");
	 }
</script>';
		define('TPL_INIT_TINY_DATERANGE_TIME', true);
	}

	$str = $placeholder;
	$value['starttime'] = ((isset($value['starttime']) ? $value['starttime'] : (($_GPC[$name]['start'] ? $_GPC[$name]['start'] : ''))));
	$value['endtime'] = ((isset($value['endtime']) ? $value['endtime'] : (($_GPC[$name]['end'] ? $_GPC[$name]['end'] : ''))));
	if ($value['starttime'] && $value['endtime']) {
		if (empty($time)) {
			$str = date('Y-m-d', strtotime($value['starttime'])) . '至 ' . date('Y-m-d', strtotime($value['endtime']));
		}
		else {
			$str = date('Y-m-d H:i', strtotime($value['starttime'])) . ' 至 ' . date('Y-m-d  H:i', strtotime($value['endtime']));
		}
	}

	$s .= '
		<div style="float:left">
			<input name="' . $name . '[start]' . '" type="hidden" value="' . $value['starttime'] . '" />
			<input name="' . $name . '[end]' . '" type="hidden" value="' . $value['endtime'] . '" />
		</div>
		<div class="btn-group" style="padding-right:0;">
			<button style="width:240px" class="btn btn-default daterange ' . ((!empty($time) ? 'daterange-time' : 'daterange-date')) . '"  type="button"><span class="date-title">' . $str . '</span></button>
			<button class="btn btn-default" type="button" onclick="clearTime(this)" placeholder="' . $placeholder . '"><i class="fa fa-remove"></i></button>
		</div>';
	return $s;
}

function tpl_form_field_tiny_link($name, $value = '', $options = array()) {
	global $_GPC;
	$s = '';
	if (!defined('TPL_INIT_TINY_LINK')) {
		$s = '
		<script type="text/javascript">
			function showTinyLinkDialog(elm) {
				irequire(["web/tiny"], function(tiny){
					var ipt = $(elm).parent().prev();
					tiny.selectLink(function(href){
						ipt.val(href);
					});
				});
			}
		</script>';
		define('TPL_INIT_TINY_LINK', true);
	}
	$s .= '
	<div class="input-group">
		<input type="text" value="'.$value.'" name="'.$name.'" class="form-control ' . $options['css']['input'] . '" autocomplete="off">
		<span class="input-group-btn">
			<button class="btn btn-default ' . $options['css']['btn'] . '" type="button" onclick="showTinyLinkDialog(this);">选择链接</button>
		</span>
	</div>
	';
	return $s;
}

function tpl_form_field_tiny_wxapp_link($name, $value = '', $options = array()) {
	global $_GPC;
	$s = '';
	if (!defined('TPL_INIT_TINY_WXAPP_LINK')) {
		$s = '
		<script type="text/javascript">
			function showTinyWxappLinkDialog(elm) {
				irequire(["web/tiny"], function(tiny){
					var ipt = $(elm).parent().prev();
					tiny.selectWxappLink(function(href){
						ipt.val(href);
					});
				});
			}
		</script>';
		define('TPL_INIT_TINY_WXAPP_LINK', true);
	}
	$s .= '
	<div class="input-group">
		<input type="text" value="'.$value.'" name="'.$name.'" class="form-control ' . $options['css']['input'] . '" autocomplete="off">
		<span class="input-group-btn">
			<button class="btn btn-default ' . $options['css']['btn'] . '" type="button" onclick="showTinyWxappLinkDialog(this);">选择链接</button>
		</span>
	</div>
	';
	return $s;
}

function tpl_form_field_tiny_coordinate($field, $value = array(), $required = false) {
	global $_W;
	$s = '';
	if(!defined('TPL_INIT_TINY_COORDINATE')) {
		$s .= '<script type="text/javascript">
				function showCoordinate(elm) {
					irequire(["web/tiny"], function(tiny){
						var val = {};
						val.lng = parseFloat($(elm).parent().prev().prev().find(":text").val());
						val.lat = parseFloat($(elm).parent().prev().find(":text").val());
						tiny.map(val, function(r){
							$(elm).parent().prev().prev().find(":text").val(r.lng);
							$(elm).parent().prev().find(":text").val(r.lat);
						});
					});
				}
			</script>';
		define('TPL_INIT_TINY_COORDINATE', true);
	}
	$s .= '
		<div class="row row-fix">
			<div class="col-xs-4 col-sm-4">
				<input type="text" name="' . $field . '[lng]" value="'.$value['lng'].'" placeholder="地理经度"  class="form-control" ' . ($required ? 'required' : '') . '/>
			</div>
			<div class="col-xs-4 col-sm-4">
				<input type="text" name="' . $field . '[lat]" value="'.$value['lat'].'" placeholder="地理纬度"  class="form-control" ' . ($required ? 'required' : '') . '/>
			</div>
			<div class="col-xs-4 col-sm-4">
				<button onclick="showCoordinate(this);" class="btn btn-default" type="button">选择坐标</button>
			</div>
		</div>';
	return $s;
}

function cloud_w_upgrade_version($family, $version, $release) {
	$verfile = MODULE_ROOT . '/version.php';
	$verdat = <<<VER
<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
define('MODULE_FAMILY', '{$family}');
define('MODULE_VERSION', '{$version}');
define('MODULE_RELEASE_DATE', '{$release}');
VER;
	file_put_contents($verfile, trim($verdat));
}

function tpl_select2($name, $data, $value = 0, $filter = array('id', 'title'), $default = '请选择') {
	$element_id = "select2-{$name}";
	$json_data = array();
	foreach($data as $da) {
		$json_data[] = array(
			'id' => $da[$filter[0]],
			'text' => $da[$filter[1]],
		);
	}
	$json_data = json_encode($json_data);
	$html = '<select name="' . $name. '" class="form-control" id="' . $element_id . '"></select>';
	$html .= '<script type="text/javascript">
					require(["jquery", "select2"], function($) {
						$("#'. $element_id .'").select2({
							placeholder: "'. $default .'",
							data: '. $json_data .',
							val: '. $value.'
						});
					});
			  </script>';
	return $html;
}

function tpl_form_field_tiny_image($name, $value = '') {
	global $_W;
	$default = '';
	$val = $default;
	if (!empty($value)) {
		$val = tomedia($value);
	}
	if (!empty($options['global'])) {
		$options['global'] = true;
	} else {
		$options['global'] = false;
	}
	if (empty($options['class_extra'])) {
		$options['class_extra'] = '';
	}
	if (isset($options['dest_dir']) && !empty($options['dest_dir'])) {
		if (!preg_match('/^\w+([\/]\w+)?$/i', $options['dest_dir'])) {
			exit('图片上传目录错误,只能指定最多两级目录,如: "we7_store","we7_store/d1"');
		}
	}
	$options['direct'] = true;
	$options['multiple'] = false;
	if (isset($options['thumb'])) {
		$options['thumb'] = !empty($options['thumb']);
	}
	$s = '';
	if (!defined('TPL_INIT_TINY_IMAGE')) {
		$s = '
		<script type="text/javascript">
			function showImageDialog(elm, opts, options) {
				require(["util"], function(util){
					var btn = $(elm);
					var ipt = btn.parent().prev();
					var val = ipt.val();
					var img = ipt.parent().parent().find(".input-group-addon img");
					options = '.str_replace('"', '\'', json_encode($options)).';
					util.image(val, function(url){
						if(url.url){
							if(img.length > 0){
								img.get(0).src = url.url;
							}
							ipt.val(url.attachment);
							ipt.attr("filename",url.filename);
							ipt.attr("url",url.url);
						}
						if(url.media_id){
							if(img.length > 0){
								img.get(0).src = "";
							}
							ipt.val(url.media_id);
						}
					}, null, options);
				});
			}
			function deleteImage(elm){
				require(["jquery"], function($){
					$(elm).prev().attr("src", "./resource/images/nopic.jpg");
					$(elm).parent().prev().find("input").val("");
				});
			}
		</script>';
		define('TPL_INIT_TINY_IMAGE', true);
	}

	$s .= '
		<div class="input-group ' . $options['class_extra'] . '">
			<div class="input-group-addon">
				<img src="' . $val . '" onerror="this.src=\'' . $default . '\'; this.title=\'图片未找到.\'" width="20" height="20" />
			</div>
			<input type="text" name="' . $name . '" value="' . $value . '" class="form-control" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>
			</span>
		</div>';
	return $s;
}

function tpl_form_field_store($name, $value = '', $option = array('mutil' => 0)) {
	global $_W;
	if (empty($default)) {
		$default = './resource/images/nopic.jpg';
	}
	if(!is_array($value)) {
		$value = intval($value);
		$value = array($value);
	}
	$value_ids = implode(',', $value);
	$stores_temp = pdo_fetchall('select id, title, logo from ' . tablename('tiny_wmall_store') . " where uniacid = :uniacid and id in ({$value_ids})" , array(':uniacid' => $_W['uniacid']));
	$stores = array();
	if(!empty($stores_temp)) {
		foreach($stores_temp as $row) {
			$row['logo'] = tomedia($row['logo']);
			$stores[] = $row;
		}
	}

	$definevar = 'TPL_INIT_TINY_STORE';
	$function = 'showStoreDialog';
	if(!empty($option['mutil'])) {
		$definevar = 'TPL_INIT_TINY_MUTIL_STORE';
		$function = 'showMutilStoreDialog';
	}
	$s = '';
	if (!defined($definevar)) {
		$option_json = json_encode($option);
		$s = '
		<script type="text/javascript">
			function '. $function .'(elm) {
				var btn = $(elm);
				var value_cn = btn.parent().prev();
				var logo = btn.parent().parent().next().find("img");
				irequire(["web/tiny"], function(tiny){
					tiny.selectstore(function(stores, option){
						if(option.mutil == 1) {
							$.each(stores, function(idx, store){
								$(elm).parent().parent().next().append(\'<div class="multi-item"><img onerror="this.src=\\\'./resource/images/nopic.jpg\\\'; this.title=\\\'图片未找到.\\\'" src="\'+store.logo+\'" class="img-responsive img-thumbnail"><input type="hidden" name="\'+name+\'[]" value="\'+store.id+\'"><em class="close" title="删除该门店" onclick="deleteStore(this)">×</em><span>\'+store.title+\'</span></div>\');
							});
						} else {
							value_cn.val(stores.title);
							logo[0].src = stores.logo;
							logo.prev().val(stores.id);
							logo.next().removeClass("hide").html(stores.title);
						}
					}, ' . $option_json . ');
				});
			}

			function deleteMutilStore(elm){
				$(elm).parent().remove();
			}
		</script>';
		define($definevar, true);
	}

	$s .= '
		<div class="input-group">
			<input type="text" class="form-control store-cn" readonly value="' . $stores[0]['title'] . '">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="' . $function . '(this);">选择商家</button>
			</span>
		</div>';
	if(empty($option['mutil'])) {
		$s .='
		<div class="input-group single-item" style="margin-top:.5em;">
			<input type="hidden" name="'. $name .'" value="'. $value[0] .'">
			<img src="' . $stores[0]['logo'] . '" onerror="this.src=\'' . $default . '\'; this.title=\'图片未找到.\'" class="img-responsive img-thumbnail" width="150" />
		';
		if(empty($stores[0]['title'])) {
			$s .= '<span class="hide"></span>';
		} else {
			$s .= '<span>' . $stores[0]['title'] . '</span>';
		}
		$s .= '</div>';
	} else {
		$s .= '<div class="input-group multi-img-details">';
		foreach ($stores as $store) {
			$s .= '
			<div class="multi-item">
				<img src="' . $store['logo'] . '" title="'. $store['title'] .'" onerror="this.src=\'./resource/images/nopic.jpg\'; this.title=\'图片未找到.\'" class="img-responsive img-thumbnail">
				<input type="hidden" name="' . $name . '[]" value="' . $store['id'] . '">
				<em class="close" title="删除该门店" onclick="deleteMutilStore()">×</em>
				<span>' . $store['title'] . '</span>
			</div>';
		}
		$s .= '</div>';
	}
	return $s;
}

function tpl_form_field_mutil_store($name, $value = '') {
	return tpl_form_field_store($name, $value, $option = array('mutil' => 1));
}

function tpl_form_field_goods($name, $value = '', $option = array('mutil' => 0, 'sid' => 0, 'ignore' => array())) {
	global $_W;
	if(!isset($option['mutil'])) {
		$option['mutil'] = 0;
	}
	if (empty($default)) {
		$default = './resource/images/nopic.jpg';
	}
	if(!is_array($value)) {
		$value = intval($value);
		$value = array($value);
	}
	$condition = ' where uniacid = :uniacid';
	$params = array(':uniacid' => $_W['uniacid']);
	$value_ids = implode(',', $value);
	$condition .= " and id in ({$value_ids})";
	$goods_temp = pdo_fetchall('select id, title, thumb from ' . tablename('tiny_wmall_goods') . "{$condition}", $params);
	$goods = array();
	if(!empty($goods_temp)) {
		foreach($goods_temp as $row) {
			$row['thumb'] = tomedia($row['thumb']);
			$goods[] = $row;
		}
	}

	$definevar = 'TPL_INIT_TINY_GOODS';
	$function = 'showGoodsDialog';
	if(!empty($option['mutil'])) {
		$definevar = 'TPL_INIT_TINY_MUTIL_GOODS';
		$function = 'showMutilGoodsDialog';
	}
	$s = '';
	if (!defined($definevar)) {
		$option_json = json_encode($option);
		$s = '
		<script type="text/javascript">
			function '. $function .'(elm) {
				var btn = $(elm);
				var value_cn = btn.parent().prev();
				var thumb = btn.parent().parent().next().find("img");
				tiny.selectgoods(function(goods, option){
					if(option.mutil == 1) {
						$.each(goods, function(idx, good){
							$(elm).parent().parent().next().append(\'<div class="multi-item"><img onerror="this.src=\\\'./resource/images/nopic.jpg\\\'; this.title=\\\'图片未找到.\\\'" src="\'+store.good+\'" class="img-responsive img-thumbnail"><input type="hidden" name="\'+name+\'[]" value="\'+good.id+\'"><em class="close" title="删除该商品" onclick="deleteStore(this)">×</em><span>\'+good.title+\'</span></div>\');
						});
					} else {
						value_cn.val(goods.title);
						thumb[0].src = goods.thumb;
						thumb.prev().val(goods.id);
						thumb.next().removeClass("hide").html(goods.title);
					}
				}, ' . $option_json . ');
			}

			function deleteMutilGoods(elm){
				$(elm).parent().remove();
			}
		</script>';
		define($definevar, true);
	}

	$s .= '
		<div class="input-group">
			<input type="text" class="form-control store-cn" readonly value="' . $goods[0]['title'] . '">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="' . $function . '(this);">选择商品</button>
			</span>
		</div>';
	if(empty($option['mutil'])) {
		$s .='
		<div class="input-group single-item" style="margin-top:.5em;">
			<input type="hidden" name="'. $name .'" value="'. $value[0] .'">
			<img src="' . $goods[0]['thumb'] . '" onerror="this.src=\'' . $default . '\'; this.title=\'图片未找到.\'" class="img-responsive img-thumbnail" width="150" />
		';
		if(empty($goods[0]['title'])) {
			$s .= '<span class="hide"></span>';
		} else {
			$s .= '<span>' . $goods[0]['title'] . '</span>';
		}
		$s .= '</div>';
	} else {
		$s .= '<div class="input-group multi-img-details">';
		foreach ($goods as $good) {
			$s .= '
			<div class="multi-item">
				<img src="' . $good['thumb'] . '" title="'. $good['title'] .'" onerror="this.src=\'./resource/images/nopic.jpg\'; this.title=\'图片未找到.\'" class="img-responsive img-thumbnail">
				<input type="hidden" name="' . $name . '[]" value="' . $good['id'] . '">
				<em class="close" title="删除该商品" onclick="deleteMutilStore()">×</em>
				<span>' . $good['title'] . '</span>
			</div>';
		}
		$s .= '</div>';
	}
	return $s;
}

function tpl_form_field_mutil_goods($name, $value = '', $option = array('sid' => 0, 'ignore' => array())) {
	if(!isset($option['mutil'])) {
		$option['mutil'] = 1;
	}
	return tpl_form_field_goods($name, $value, $option);
}

function tpl_form_filter_hidden($ctrls, $do = 'web') {
	global $_W;
	$html = '
		<input type="hidden" name="c" value="site">
		<input type="hidden" name="a" value="entry">
		<input type="hidden" name="m" value="we7_wmall">
		<input type="hidden" name="i" value="'. $_W['uniacid'] .'">
		<input type="hidden" name="do" value="'. $do .'"/>
	';

	list($ctrl, $ac, $op, $ta) = explode('/', $ctrls);
	if(!empty($ctrl)) {
		$html .= '<input type="hidden" name="ctrl" value="'. $ctrl .'"/>';
		if(!empty($ac)) {
			$html .= '<input type="hidden" name="ac" value="'. $ac .'"/>';
			if(!empty($ac)) {
				$html .= '<input type="hidden" name="op" value="'. $op .'"/>';
				if(!empty($ta)) {
					$html .= '<input type="hidden" name="ta" value="'. $ta .'"/>';
				}
			}
		}
	}
	return $html;
}

function tpl_form_field_tiny_account($name, $value = 0, $required = false) {
	$account = array();
	if(!empty($value)) {
		$account = pdo_get('account_wechats', array('uniacid' => $value));
	}
	$s = '';
	if (!defined('TPL_INIT_TINY_ACCOUNT')) {
		$s = '
		<script type="text/javascript">
			function showTinyAccountDialog(elm) {
				irequire(["web/tiny"], function(tiny){
					var $uniacid = $(elm).parent().prev();
					var $name = $(elm).parent().prev().prev();
					tiny.selectaccount(function(account){
						$uniacid.val(account.uniacid);
						$name.val(account.name);
					});
				});
			}
		</script>';
		define('TPL_INIT_TINY_ACCOUNT', true);
	}
	$s .= '
	<div class="input-group">
		<input type="text" name="'.$name.'_cn" value="'.$account['name'].'" class="form-control" autocomplete="off" readonly>
		<input type="hidden" name="'.$name.'" value="'.$value.'">
		<span class="input-group-btn">
			<button class="btn btn-default" type="button" onclick="showTinyAccountDialog(this);">选择公众号</button>
		</span>
	</div>
	';
	return $s;
}

function tpl_form_field_tiny_category_2level($name, $parents, $children, $parentid, $childid){
	$html = '
		<script type="text/javascript">
			window._' . $name . ' = ' . json_encode($children) . ';
		</script>';
	if (!defined('TPL_INIT_TINY_CATEGORY')) {
		$html .= '
					<script type="text/javascript">
						function irenderCategory(obj, name){
							var index = obj.options[obj.selectedIndex].value;
							require([\'jquery\', \'util\'], function($, u){
								$selectChild = $(\'#\'+name+\'_child\');
								var html = \'<option value="0">请选择二级分类</option>\';
								console.log(index);
								console.log(_category);

								if (!window[\'_\'+name] || !window[\'_\'+name][index]) {
									$selectChild.html(html);
									return false;
								}
								for(var i in window[\'_\'+name][index]){
									html += \'<option value="\'+window[\'_\'+name][index][i][\'id\']+\'">\'+window[\'_\'+name][index][i][\'name\']+\'</option>\';
								}
								$selectChild.html(html);
							});
						}
					</script>
					';
		define('TPL_INIT_TINY_CATEGORY', true);
	}

	$html .=
		'<div class="row row-fix tpl-category-container">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<select class="form-control tpl-category-parent" id="' . $name . '_parent" name="' . $name . '[parentid]" onchange="irenderCategory(this,\'' . $name . '\')">
					<option value="0">请选择一级分类</option>';
	$ops = '';
	if(!empty($parents)){
		foreach ($parents as $row) {
			$html .= '
						<option value="' . $row['id'] . '" ' . (($row['id'] == $parentid) ? 'selected="selected"' : '') . '>' . $row['name'] . '</option>';
		}
	}
	$html .= '
				</select>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<select class="form-control tpl-category-child" id="' . $name . '_child" name="' . $name . '[childid]">
					<option value="0">请选择二级分类</option>';
	if (!empty($parentid) && !empty($children[$parentid])) {
		foreach ($children[$parentid] as $row) {
			$html .= '
					<option value="' . $row['id'] . '"' . (($row['id'] == $childid) ? 'selected="selected"' : '') . '>' . $row['name'] . '</option>';
		}
	}
	$html .= '
				</select>
			</div>
		</div>
	';
	return $html;
}

function wxapp_urls() {
	global $_W, $_GPC;
	$data['takeout']['sys'] = array(
		'title' => '小程序链接',
		'items' => array(
			array(
				'title' => '平台首页',
				'url' => 'pages/home/index'
			),
			array(
				'title' => '搜索商家',
				'url' => 'pages/home/search'
			),
			array(
				'title' => '会员中心',
				'url' => 'pages/member/mine'
			),
			array(
				'title' => '我的订单',
				'url' => 'pages/order/index'
			),
			array(
				'title' => '我的代金券',
				'url' => 'pages/member/coupon/index'
			),
			array(
				'title' => '我的红包',
				'url' => 'pages/member/redPacket/index'
			),
			array(
				'title' => '我的收货地址',
				'url' => 'pages/member/address'
			),
			array(
				'title' => '我的收藏',
				'url' => 'pages/member/favorite'
			),
			array(
				'title' => '配送会员卡',
				'url' => 'pages/deliveryCard/index'
			),
			array(
				'title' => '领券中心',
				'url' => 'pages/channel/coupon'
			),
			array(
				'title' => '余额充值',
				'url' => 'pages/member/recharge'
			),
			array(
				'title' => '天天特价',
				'url' => 'pages/bargain/index'
			),
			array(
				'title' => '购物车',
				'url' => 'pages/order/cart'
			),
			array(
				'title' => '为您优选',
				'url' => 'pages/channel/brand'
			),
			array(
				'title' => '帮助中心',
				'url' => 'pages/home/help'
			),
			array(
				'title' => '客服中心',
				'url' => 'pages/home/help'
			),
		)
	);

	$data['other'] = array();
	if(check_plugin_perm('spread')){
		$data['other']['spread'] = array(
			'title' => '啦啦推广',
			'items' => array(
				array(
					'title' => '推广中心',
					'url' => 'pages/spread/index'
				)
			)
		);
	}
	if(check_plugin_perm('ordergrant')){
		$data['other']['ordergrant'] = array(
			'title' => '下单有礼',
			'items' => array(
				array(
					'title' => '下单有礼',
					'url' => 'pages/ordergrant/index'
				)
			)
		);
	}
	if(check_plugin_perm('creditshop')){
		$data['other']['creditshop'] = array(
			'title' => '积分商城',
			'items' => array(
				array(
					'title' => '积分商城',
					'url' => 'pages/creditshop/index'
				)
			)
		);
	}
	if(check_plugin_perm('superRedpacket')){
		$data['other']['superredpacket_meal'] = array(
			'title' => '套餐红包',
			'items' => array(
				array(
					'title' => '套餐红包',
					'url' => 'pages/superredpacket/mealindex'
				),
			),
		);
	}
	if(check_plugin_perm('freeLunch')){
		$data['other']['freelunch'] = array(
			'title' => '霸王餐',
			'items' => array(
				array(
					'title' => '霸王餐',
					'url' => 'pages/freelunch/index'
				),
			),
		);
	}
	if(check_plugin_perm('errander')) {
		$data['errander'] = array(
			array(
				'title' => '平台链接',
				'items' => array(
					array(
						'title' => '跑腿首页（旧版，以后不维护）',
						'url' => 'pages/errander/index'
					),
					array(
						'title' => '跑腿首页（新版）',
						'url' => 'pages/paotui/guide'
					),
					array(
						'title' => '跑腿订单',
						'url' => 'pages/errander/order'
					),
				)
			),
		);
		$data['errander']['business'] = array(
			'title' => '业务链接（2018.6.20以后下架，请使用跑腿场景）',
			'items' => array()
		);
		$categorys = pdo_getall('tiny_wmall_errander_category', array('uniacid' => $_W['uniacid'], 'status' => 1), array('id', 'title'));
		if(!empty($categorys)) {
			foreach($categorys as $category) {
				$data['errander']['business']['items'][] = array(
					'title' => "{$category['title']}（后期不在维护）",
					'url' => 'pages/errander/category?id='.$category['id']
				);
			}
		}
		$data['errander']['scene'] = array(
			'title' => '跑腿场景（新版）',
			'items' => array()
		);
		$scenes = pdo_getall('tiny_wmall_errander_page', array('uniacid' => $_W['uniacid'], 'type' => 'scene'), array('id', 'name'));
		if(!empty($scenes)) {
			foreach($scenes as $scene) {
				$data['errander']['scene']['items'][] = array(
					'title' => $scene['name'],
					'url' => 'pages/paotui/diy?id='.$scene['id']
				);
			}
		}
	}
	if(check_plugin_perm('diypage')) {
		$diypages = pdo_getall('tiny_wmall_wxapp_page', array('uniacid' => $_W['uniacid']), array('id', 'name'));
		if(!empty($diypages)) {
			$data['diyPages'] = $diypages;
		}
	}
	$data['operation']['scanCode'] = array(
		'title' => '扫码',
		'items' => array(
			array(
				'title' => '扫码',
				'url' => 'wx:scanCode'
			),
		),
	);
	$data['store'] = array(
		array(
			'title' => '商户',
			'items' => array(
				array(
					'title' => '门店详情',
					'url' => "pages/store/home?sid={$_GPC['__sid']}"
				),
				array(
					'title' => '订水',
					'url' => "pages/store/goods?sid={$_GPC['__sid']}"
				),
				array(
					'title' => '预定',
					'url' => "pages/reserve/index?sid={$_GPC['__sid']}"
				),
				array(
					'title' => '当面付',
					'url' => "pages/store/paybill?sid={$_GPC['__sid']}"
				),
			)
		)
	);
	return $data;
}


