<?php defined('IN_IA') or exit('Access Denied');?><?php  if($op == 'changes') { ?>
<form class="form-horizontal form-validate" id="form-changes" action="<?php  echo iurl('merchant/account/changes');?>" method="post" enctype="multipart/form-data">
	<input type='hidden' name='id' value='<?php  echo $id;?>' />
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">账户变动</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户信息</label>
					<div class="col-sm-9 col-xs-12">
						<img width="50" height="50" src="<?php  echo tomedia($store['logo'])?>" alt="">
						&nbsp;&nbsp;<span><?php  echo $store['title'];?>/<?php  echo $store['telephone'];?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">当前余额</label>
					<div class="col-sm-9 col-xs-12"><span><?php  echo $account['amount'];?>元</span></div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">变动类型</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" value="1" name="change_type" id="change-type-1" checked>
							<label for="change-type-1">增加</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="2" name="change_type" id="change-type-2">
							<label for="change-type-2">减少</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="3" name="change_type" id="change-type-3">
							<label for="change-type-3">最终余额</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">变动金额</label>
					<div class="col-sm-9 col-xs-12">
						<input type="number" name="amount" class="form-control" required="true">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
					<div class="col-sm-9 col-xs-12">
						<textarea name="remark"  class="form-control" required="true"></textarea>
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

<?php  if($op == 'cancel') { ?>
<form class="form-horizontal form-validate" id="form-changes" action="<?php  echo iurl('merchant/getcash/cancel');?>" method="post" enctype="multipart/form-data">
	<input name="id" type="hidden" value="<?php  echo $id;?>"/>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">申请提现撤销</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户信息</label>
					<div class="col-sm-9 col-xs-12">
						<img width="50" height="50" src="<?php  echo tomedia($store['logo'])?>" alt="">
						&nbsp;&nbsp;<span><?php  echo $store['title'];?>/<?php  echo $store['telephone'];?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">申请时间</label>
					<div class="col-sm-9 col-xs-12">
						<span><?php  echo date('Y-m-d H:i:s', $log['addtime'])?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单号</label>
					<div class="col-sm-9 col-xs-12">
						<span><?php  echo $log['trade_no'];?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">撤销金额</label>
					<div class="col-sm-9 col-xs-12">
						<span><?php  echo $log['get_fee'];?>元</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
					<div class="col-sm-9 col-xs-12">
						<textarea name="remark"  class="form-control" required="true"></textarea>
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