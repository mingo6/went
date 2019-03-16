<?php defined('IN_IA') or exit('Access Denied');?><?php  if($op =='lots') { ?>
<form action="<?php  echo iurl('merchant/store/lots', array('set' => 1));?>" method="post" enctype="multipart/form-data"  class="form-horizontal form-validate" id="form-changes">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">批量操作</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="sid" value="<?php  echo $ids;?>"/>
				<?php  if($_W['is_agent']) { ?>
					<div class="form-group">
						<label class="col-md-3 control-label">选择代理</label>
						<div class="col-md-8">
							<select name="agentid" class="form-control">
								<option value="0">请选择代理</option>
								<?php  if(is_array($agents)) { foreach($agents as $item) { ?>
									<option value="<?php  echo $item['id'];?>"><?php  echo $item['title'];?>[<?php  echo $item['area'];?>]</option>
								<?php  } } ?>}
							</select>
						</div>
					</div>
				<?php  } ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">是否允许商家审核顾客评价</label>
					<div class="col-sm-8 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" value="1" name="self_audit_comment" id="self_audit_comment-1" required="true" onclick="$('.comment').show();">
							<label for="self_audit_comment-1">允许</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="0" name="self_audit_comment" id="self_audit_comment-0" checked onclick="$('.comment').hide();">
							<label for="self_audit_comment-0">不允许</label>
						</div>
						<span class="help-block">注意:设置为不允许后,顾客对于商家的评价将直接审核通过并显示到手机端</span>
					</div>
				</div>
				<div class="form-group comment" style="display: none">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">顾客评价是否需要直接通过审核</label>
					<div class="col-sm-8 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" value="1" name="comment_status" id="comment_status-1">
							<label for="comment_status-1">是</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="0" name="comment_status" id="comment_status-0" checked>
							<label for="comment_status-0">否</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">支付后自动接单</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<div class="radio radio-inline">
							<input type="radio" name="auto_handel_order" id="auto-handel-order-1" value="1">
							<label for="auto-handel-order-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="auto_handel_order" id="auto-handel-order-0" value="0" checked>
							<label for="auto-handel-order-0">关闭</label>
						</div>
						<span class="help-block">开启后, 用户下单支付后,系统会自动接单(设置订单为处理中.)</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">接单后自动通知配送员配送</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<div class="radio radio-inline">
							<input type="radio" name="auto_notice_deliveryer" id="auto-notice-deliveryer-1" value="1">
							<label for="auto-notice-deliveryer-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="auto_notice_deliveryer" id="auto-notice-deliveryer-0" value="0" checked>
							<label for="auto-notice-deliveryer-0">关闭</label>
						</div>
						<span class="help-block">开启后, 店员接单后,系统会自动通知配送员进行配送(设置订单为待配送.仅对外卖订单有效).</span>
						<span class="help-block"><span class="bg-danger">注意：设置支付后自动接单, 也会自动通知配送员抢单</span></span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-warning" type="submit">提交</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
			</div>
		</div>
	</div>
</form>
<?php  } ?>