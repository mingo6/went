<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter">
	<input type="hidden" name="c" value="site">
	<input type="hidden" name="a" value="entry">
	<input type="hidden" name="m" value="we7_wmall">
	<input type="hidden" name="do" value="web"/>
	<input type="hidden" name="ctrl" value="merchant"/>
	<input type="hidden" name="ac" value="storage"/>
	<input type="hidden" name="op" value="list"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">标签</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('label:0');?>" class="btn <?php  if($label == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<?php  if(is_array($store_label)) { foreach($store_label as $row_label) { ?>
				<a href="<?php  echo ifilter_url('label:' . $row_label['id']);?>" class="btn <?php  if($label == $row_label['id']) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>"><?php  echo $row_label['title'];?></a>
				<?php  } } ?>
			</div>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
		<div class="col-sm-9 col-xs-12">
			<select class="form-control" id="cid" name="cid">
				<option value="0">所有分类</option>
				<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
				<option value="<?php  echo $category['id'];?>" <?php  if($cid == $category['id']) { ?>selected<?php  } ?>><?php  echo $category['title'];?></option>
				<?php  } } ?>
			</select>
			<input type="text" name="keyword" value="<?php  echo $_GPC['keyword'];?>" class="form-control" placeholder="门店名称"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form class="form-table " action="" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>门店logo</th>
					<th>门店名称</th>
					<th>门店地址</th>
					<th>联系电话</th>
					<th>所属城市</th>
					<th>标签</th>
					<th>删除时间</th>
					<th style="width:480px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
				<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
				<tr>
					<td><img src="<?php  echo tomedia($item['logo']);?>" width="50"></td>
					<td><?php  echo $item['title'];?></td>
					<td><?php  echo $item['address'];?></td>
					<td><?php  echo $item['telephone'];?></td>
					<td><?php  echo toagent($item['agentid'])?></td>
					<td>
						<span class="label" style="background-color:<?php  echo $store_label[$item['label']]['color'];?>"><?php  echo $store_label[$item['label']]['title'];?></span>
					</td>
					<td><?php  echo date('Y-m-d H:i', $item['deltime'])?></td>
					<td style="text-align:right; overflow: inherit">
						<a href="<?php  echo iurl('merchant/storage/restore', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-post" data-confirm="确定恢复该门店吗?">恢复</a>
						<a href="<?php  echo iurl('merchant/storage/del', array('id' => $item['id']))?>" class="btn btn-danger btn-sm js-post" data-confirm="删除后将不可恢复，确定删除吗?">彻底删除</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<?php  if(!empty($lists)) { ?>
			<div class="btn-region clearfix">
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
