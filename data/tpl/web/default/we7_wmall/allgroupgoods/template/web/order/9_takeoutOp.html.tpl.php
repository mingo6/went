<?php defined('IN_IA') or exit('Access Denied');?><?php  if($op == 'remind') { ?>
<form class="form-horizontal form-validate" action="<?php  echo iurl('order/takeout/remind');?>" method="post" enctype="multipart/form-data">
	<input type='hidden' name='id' value='<?php  echo $id;?>' />
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">回复催单</h4>
			</div>
			<div class="modal-body">
				<textarea class="form-control" name="reply"  placeholder="回复催单" rows="4" required="true"></textarea>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">提交</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
			</div>
		</div>
	</div>
</form>
<?php  } ?>
<?php  if($op =='cancel') { ?>
<form class="form-horizontal form-validate" action="<?php  echo iurl('order/takeout/cancel', array('set' => 1));?>" method="post" enctype="multipart/form-data">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">取消订单</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" value="<?php  echo $id;?>"/>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">选择退款理由*</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<select name="reason" class="select2 js-select2 form-control">
							<option value="0">选择退款理由</option>
							<?php  if(is_array($reasons)) { foreach($reasons as $key => $val) { ?>
								<option value="<?php  echo $key;?>"><?php  echo $val;?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">填写备注(选填)</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<textarea name="remark" cols="39" rows="7" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">提交</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
			</div>
		</div>
	</div>
</form>
<?php  } ?>
<?php  if($op =='groupcancel') { ?>
<form class="form-horizontal form-validate" action="<?php  echo iurl('order/takeoutNew/groupcancel', array('set' => 1));?>" method="post" enctype="multipart/form-data">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">取消订单</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" value="<?php  echo $ids;?>"/>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">选择退款理由*</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<select name="reason" class="select2 js-select2 form-control">
							<option value="0">选择退款理由</option>
							<?php  if(is_array($reasons)) { foreach($reasons as $key => $val) { ?>
							<option value="<?php  echo $key;?>"><?php  echo $val;?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">填写备注(选填)</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<textarea name="remark" cols="39" rows="7" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">提交</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
			</div>
		</div>
	</div>
</form>
<?php  } ?>
<?php  if($op =='changeOrder') { ?>
<form class="form-horizontal form-validate" action="<?php  echo iurl('order/takeout/changeOrder', array('set' => 1));?>" method="post" enctype="multipart/form-data">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">修改订单 #<strong><?php  echo $order['serial_sn'];?></strong></h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" value="<?php  echo $id;?>"/>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">收货人姓名</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<input class="form-control" type="text" name="username" value="<?php  echo $order['username'];?>" placeholder="收货人姓名">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">收货地址</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<input class="form-control" type="text" name="address" value="<?php  echo $order['address'];?>" placeholder="收货地址" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">手机号</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<input class="form-control" type="text" name="mobile" value="<?php  echo $order['mobile'];?>" placeholder="收货联系电话" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">订单备注</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<textarea name="note" cols="39" rows="7" class="form-control"><?php  echo $order['note'];?></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">提交</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
			</div>
		</div>
	</div>
</form>
<?php  } ?>