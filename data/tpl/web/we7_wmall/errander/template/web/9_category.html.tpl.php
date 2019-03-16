<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'post') { ?>
<div class="page clearfix">
	<h2>编辑跑腿分类</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿类型</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="type" value="buy" id="type-buy" <?php  if($item['type'] == 'buy' || !$item['type']) { ?>checked<?php  } ?>>
					<label for="type-buy">随意购</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="type" value="delivery" id="type-delivery" <?php  if($item['type'] == 'delivery') { ?>checked<?php  } ?>>
					<label for="type-delivery">快速送</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="type" value="pickup" id="type-pickup" <?php  if($item['type'] == 'pickup') { ?>checked<?php  } ?>>
					<label for="type-pickup">快速取</label>
				</div>
				<div class="help-block">随意购: 帮顾客购买商品. 例如: 香烟,咖啡,早餐等.</div>
				<div class="help-block">快速送: 帮顾客送货.</div>
				<div class="help-block">快速取: 帮顾客取货.</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" required="true">
				<div class="help-block">例如: 买香烟</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">图标</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
				<div class="help-block">设置分类图标</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">顾客是否上传相关图片</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="goods_thumbs_status" value="1" id="goods-thumbs-status-1" <?php  if($item['goods_thumbs_status'] == 1) { ?>checked<?php  } ?>>
					<label for="goods-thumbs-status-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="goods_thumbs_status" value="0" id="goods-thumbs-status-0" <?php  if($item['goods_thumbs_status'] == 0) { ?>checked<?php  } ?>>
					<label for="goods-thumbs-status-0">否</label>
				</div>
				<div class="help-block">此处开启上传图片以便于明确顾客需求,可选填</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>商品类型</label>
			<div class="col-sm-9 col-xs-12">
				<?php  if(!empty($item['label'])) { ?>
					<?php  if(is_array($item['label'])) { foreach($item['label'] as $label) { ?>
						<div class="btn-group btn-label">
							<input type="hidden" name="label[]" value="<?php  echo $label;?>">
							<a class="btn btn-default"><?php  echo $label;?></a>
							<a class="btn btn-default label-delete">
								<span class="fa fa-times-circle"></span>
							</a>
						</div>
					<?php  } } ?>
				<?php  } ?>
				<a class="btn btn-success label-add"><i class="icon icon-plus-circle"></i> 添加</a>
				<div class="help-block">例如: 设置的标题是买香烟, 商品标签可设置为: 中南海, 红塔山, 中华, 玉溪等</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>可提前几天下单</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="delivery_within_days" value="<?php  echo $item['delivery_within_days'];?>"/>
				<div class="help-block">单位：天，如果只接受当天订单，请填写0. 最多可提前6天</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费设置</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group margin-b-10">
					<span class="input-group-addon">起步价</span>
					<input type="number" class="form-control" name="start_fee" value="<?php  echo $item['start_fee'];?>">
					<span class="input-group-addon border-0-lr">元包含</span>
					<input type="number" class="form-control" name="start_km" value="<?php  echo $item['start_km'];?>">
					<span class="input-group-addon">公里</span>
				</div>
				<div class="input-group margin-b-10">
					<span class="input-group-addon">每增加</span>
					<input type="number" class="form-control" name="pre_km" value="<?php  echo $item['pre_km'];?>">
					<span class="input-group-addon border-0-lr">公里加</span>
					<input type="number" class="form-control" name="pre_km_fee" value="<?php  echo $item['pre_km_fee'];?>">
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block"></div>
				<div class="margin-b-10">
					<div class="checkbox checkbox-inline">
						<input type="checkbox" name="weight_fee_status" value="1" id="weight-fee-status" <?php  if($item['weight_fee_status'] == 1) { ?>checked<?php  } ?>>
						<label for="weight-fee-status">是否启用重量计费</label>
					</div>
				</div>
				<div id="weight-container" class="<?php  if(empty($item['weight_fee_status'])) { ?>hide<?php  } ?>">
					<div class="input-group margin-b-10">
						<span class="input-group-addon">起步价包含</span>
						<input type="number" class="form-control" name="start_weight" value="<?php  echo $item['weight_fee']['start_weight'];?>">
						<span class="input-group-addon">千克</span>
					</div>
					<?php  if(!empty($item['weight_fee']['weight'])) { ?>
						<?php  if(is_array($item['weight_fee']['weight'])) { foreach($item['weight_fee']['weight'] as $key => $weight) { ?>
							<div class="input-group margin-b-10">
								<span class="input-group-addon">超过</span>
								<input type="number" class="form-control" name="pre_kgs[]" value="<?php  echo $key;?>">
								<span class="input-group-addon border-0-lr">千克</span>
								<span class="input-group-addon">每千克增加</span>
								<input type="number" class="form-control border-0-lr" name="pre_kg_fees[]" value="<?php  echo $weight;?>">
								<span class="input-group-addon">元</span>
								<div class="input-group-btn">
									<a href="javascript:;" class="btn btn-danger weight-fee-del">删除</a>
								</div>
							</div>
						<?php  } } ?>
					<?php  } ?>
				</div>
				<a class="btn btn-default add-weight-fee <?php  if(empty($item['weight_fee_status'])) { ?>hide<?php  } ?>" href="javascript:;"><i class="fa fa-plus"></i> 添加收费规则</a>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">小费设置</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">最低</span>
					<input type="number" class="form-control" name="tip_min" value="<?php  echo $item['tip_min'];?>">
					<span class="input-group-addon border-0-lr">最高</span>
					<input type="number" class="form-control" name="tip_max" value="<?php  echo $item['tip_max'];?>">
					<span class="input-group-addon">元</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送时间段</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">间隔</span>
					<input type="text" class="form-control" name="pre_delivery_time_minute" digits="true" value="<?php  echo $item['pre_delivery_time_minute'];?>">
					<span class="input-group-addon border-0-l">分钟</span>
					<div class="input-group-btn btn-build-delivery-time">
						<a href="javascript:;" class="btn btn-primary">生成配送时间段</a>
					</div>
				</div>
			</div>
		</div>
		<div id="delivery-times" class="delivery-times">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9 col-xs-12 containter">
					<?php  if(is_array($item['delivery_times'])) { foreach($item['delivery_times'] as $time) { ?>
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"><?php  echo $time['start'];?> ~ <?php  echo $time['end'];?></span>
								<span class="input-group-addon">附加费</span>
								<input type="text" class="form-control border-0-lr" name="times[fee][]" value="<?php  echo $time['fee'];?>" placeholder="增加附加费">
								<input type="hidden" name="times[start][]" value="<?php  echo $time['start'];?>"/>
								<input type="hidden" name="times[end][]" value="<?php  echo $time['end'];?>"/>
								<input type="hidden" name="times[status][]" value="<?php  echo $time['status'];?>">
								<span class="input-group-addon">元</span>
								<div class="input-group-btn">
									<a href="javascript:;" class="btn btn-delivery-time-item <?php  if($time['status'] == 1) { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>"><?php  if($time['status'] == 1) { ?>使用中<?php  } else { ?>已弃用<?php  } ?></a>
								</div>
							</div>
						</div>
					<?php  } } ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>">
				<div class="help-block">数字越大越靠前</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿规则</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('rule', $item['rule']);?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<script id="tpl-delivery-time" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><{d[i].start}> ~ <{d[i].end}></span>
				<span class="input-group-addon">附加费</span>
				<input type="text" class="form-control border-0-lr" name="times[fee][]" value="<{d[i].fee}>" placeholder="增加附加费">
				<input type="hidden" name="times[start][]" value="<{d[i].start}>"/>
				<input type="hidden" name="times[end][]" value="<{d[i].end}>"/>
				<input type="hidden" name="times[status][]" value="1">
				<span class="input-group-addon">元</span>
				<div class="input-group-btn">
					<a href="javascript:;" class="btn btn-success btn-delivery-time-item">使用中</a>
				</div>
			</div>
		</div>
	<{# } }>
</script>
<script type="text/javascript">
irequire(['web/tiny'], function(tiny){
	$(document).on('click', '.label-add', function(){
		var $this = $(this);
		tiny.prompt($(this), '', function(data) {
			if(!data) {
				return false;
			}
			var html = '<div class="btn-group btn-label">'+
					'		<input type="hidden" name="label[]" value="'+ data +'">'+
					'		<a class="btn btn-default">'+data+'</a>'+
					'		<a class="btn btn-default label-delete">'+
					'		    <span class="fa fa-times-circle"></span>'+
					'	    </a>'+
					'	</div>';
			$this.before(html);
		});
	});

	$(document).on('click', '.label-delete', function(){
		$(this).parents('.btn-group').remove();
	});

	$(document).on('click', '.btn-build-delivery-time', function(){
		var pre_minute = parseInt($.trim($(':text[name="pre_delivery_time_minute"]').val()));
		if(!pre_minute) {
			Notify.error('时间间隔必须大于0');
			return false;
		}
		$.post("<?php  echo iurl('common/utility/build_time');?>", {pre_minute: pre_minute}, function(data) {
			var result = $.parseJSON(data);
			if(result.message.errno == -1) {
				Notify.error(result.message.message);
				return false;
			}
			var gettpl = $('#tpl-delivery-time').html();
			irequire(['laytpl'], function(laytpl){
				laytpl(gettpl).render(result.message.message, function(html){
					$('#delivery-times .containter').html(html);
				});
			});
		});
	});

	$(document).on('click', '.btn-delivery-time-item', function(){
		if($(this).hasClass('btn-success')) {
			$(this).parent().prev().prev().val(0);
			$(this).removeClass('btn-success').addClass('btn-default');
			$(this).html('已弃用');
		} else {
			$(this).parent().prev().prev().val(1);
			$(this).removeClass('btn-default').addClass('btn-success');
			$(this).html('使用中');
		}
	});

	$(document).on('click', 'input[name="weight_fee_status"]', function() {
		$('#weight-container').addClass('hide');
		$('.add-weight-fee').addClass('hide');
		if($(this).prop('checked')) {
			$('#weight-container').removeClass('hide');
			$('.add-weight-fee').removeClass('hide');
		}
	});

	$(document).on('click', '.add-weight-fee', function() {
		var html = '<div class="input-group margin-b-10">'+
				'		<span class="input-group-addon">超过</span>'+
				'		<input type="number" class="form-control" name="pre_kgs[]">'+
				'		<span class="input-group-addon border-0-lr">千克</span>'+
				'		<span class="input-group-addon">每千克增加</span>'+
				'		<input type="number" class="form-control border-0-lr" name="pre_kg_fees[]">'+
				'		<span class="input-group-addon">元</span>'+
				'		<div class="input-group-btn">'+
				'			<a href="javascript:;" class="btn btn-danger weight-fee-del">删除</a>'+
				'		</div>'+
				'	</div>';
		$("#weight-container").append(html);
	});

	$(document).on('click', '.weight-fee-del', function() {
		$(this).parents('.input-group').remove();
	});
});
</script>
<?php  } ?>

<?php  if($op == 'list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('errander/category/post');?>" class="btn btn-primary btn-sm">添加跑腿分类</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($categorys)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th width="70">图标</th>
							<th>分类名称</th>
							<th>排序</th>
							<th>收费标准</th>
							<th>小费设置</th>
							<th>状态</th>
							<th style="width:150px; text-align:right;">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php  if(is_array($categorys)) { foreach($categorys as $item) { ?>
						<tr>
							<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
							<td><img src="<?php  echo tomedia($item['thumb']);?>" width="50"></td>
							<td><input type="text" name="title[]" class="form-control width-130" value="<?php  echo $item['title'];?>"></td>
							<td><input type="text" name="displayorder[]" class="form-control width-100" value="<?php  echo $item['displayorder'];?>"></td>
							<td>
								<span class="label label-info">起步价<?php  echo $item['start_fee'];?>元包含<?php  echo $item['start_km'];?>公里</span>
								<br>
								<span class="label label-default label-br">每超过1公里增加<?php  echo $item['pre_km_fee'];?>元</span>
							</td>
							<td>
								<span class="label label-danger">最低<?php  echo $item['tip_min'];?>元, 最高<?php  echo $item['tip_max'];?>元</span>
							</td>
							<td>
								<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('errander/category/status', array('id' => $item['id']));?>" data-name="status" value="1" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
							</td>
							<td style="text-align:right;">
								<a href="<?php  echo iurl('errander/category/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm">编辑</a>
								<a href="<?php  echo iurl('errander/category/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除吗">删除</a>
							</td>
						</tr>
					<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交修改" />
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
