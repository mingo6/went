<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter" id="form-takeout">
    <?php  echo tpl_form_filter_hidden('allgroupgoods/order/list');?>
    <input type="hidden" name="filter_type" value="<?php  echo $filter_type;?>"/>
    <?php  if($filter_type == 'process' || $filter_type == 'all') { ?>
    <input type="hidden" name="status" value="<?php  echo $status;?>"/>
    <input type="hidden" name="pay_type" value="<?php  echo $pay_type;?>"/>
    <input type="hidden" name="fields" value=""/>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单状态</label>
        <div class="col-sm-9 col-xs-12">
            <div class="btn-group">
                <div class="btn-group">
                    <a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
                    <a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待接单</a>
                    <a href="<?php  echo ifilter_url('status:2');?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已确认</a>
                    <a href="<?php  echo ifilter_url('status:3');?>" class="btn <?php  if($status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待配送</a>
                    <a href="<?php  echo ifilter_url('status:4');?>" class="btn <?php  if($status == 4) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">配送中</a>
                    <a href="<?php  echo ifilter_url('status:5');?>" class="btn <?php  if($status == 5) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已完成</a>
                    <a href="<?php  echo ifilter_url('status:6');?>" class="btn <?php  if($status == 6) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已取消</a>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <div class="checkbox checkbox-inline btn-refresh" data-type="status_order_refresh"><input type="checkbox" value="1" <?php  if($_GPC['_status_order_refresh'] == 1) { ?>checked<?php  } ?>><label><span id="time-count"><span>30</span>秒</span>自动刷新</label></div>
            <div class="checkbox checkbox-inline btn-notice" data-type="status_order_notice">
                <input type="checkbox" value="1" <?php  if($_GPC['_status_order_notice'] == 1) { ?>checked<?php  } ?>>
                <label>语音提示</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付状态</label>
        <div class="col-sm-9 col-xs-12">
            <div class="btn-group">
                <div class="btn-group">
                    <a href="<?php  echo ifilter_url('is_pay:-1');?>" class="btn <?php  if($is_pay == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
                    <a href="<?php  echo ifilter_url('is_pay:0');?>" class="btn <?php  if($is_pay == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未支付</a>
                    <a href="<?php  echo ifilter_url('is_pay:1');?>" class="btn <?php  if($is_pay == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已支付</a>
                </div>
            </div>
        </div>
    </div>

    <?php  } else if($filter_type == 'is_remind') { ?>
    <input type="hidden" name="is_remind" value="<?php  echo $is_remind;?>"/>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">处理状态</label>
        <div class="col-sm-9 col-xs-12">
            <div class="btn-group">
                <div class="btn-group">
                    <a href="<?php  echo ifilter_url('is_remind:1');?>" class="btn <?php  if($is_remind == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未处理</a>
                    <a href="<?php  echo ifilter_url('is_remind:2');?>" class="btn <?php  if($is_remind == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已处理</a>
                </div>
            </div>
        </div>
    </div>
    <?php  } else if($filter_type == 'refund_status') { ?>
    <input type="hidden" name="refund_status" value="<?php  echo $re_status;?>"/>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">处理状态</label>
        <div class="col-sm-9 col-xs-12">
            <div class="btn-group">
                <div class="btn-group">
                    <a href="<?php  echo ifilter_url('refund_status:1');?>" class="btn <?php  if($re_status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未处理</a>
                    <a href="<?php  echo ifilter_url('refund_status:2');?>" class="btn <?php  if($re_status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">退款中</a>
                    <a href="<?php  echo ifilter_url('refund_status:3');?>" class="btn <?php  if($re_status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">退款成功</a>
                </div>
            </div>
        </div>
    </div>
    <?php  } ?>
    <div class="form-group form-inline">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
        <div class="col-sm-9 col-xs-12">
            <?php  if($_W['is_agent']) { ?>
            <select name="agentid" class="select2 js-select2 form-control width-130">
                <option value="0">选择代理区域</option>
                <?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
                <option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
                <?php  } } ?>
            </select>
            <?php  } ?>
            <div style="display: inline-block">
                <?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)));?>
            </div>
            <input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="输入用户名/手机号/订单编号">
            <input type="text" name="uid" value="<?php  if(!empty($uid)) { ?><?php  echo $uid;?><?php  } ?>" class="form-control" placeholder="用户UID">
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <button class="btn btn-primary">筛选</button>
            <?php  if($filter_type == 'process' || $filter_type == 'all') { ?>
            <a class="btn btn-default btn-export" href="javascript:;">导出订单</a>
            <?php  } ?>
        </div>
    </div>
</form>
<div class="clearfix order-list">
    <?php  if(!empty($orders)) { ?>
    <div class="col-md-8">
        <?php  if(is_array($orders)) { foreach($orders as $order) { ?>
        <div class="panel-order <?php  echo $order['order_plateform'];?>">
            <div class="pay-info <?php  echo $order['pay_type_class'];?>"></div>
            <div class="panel-heading clearfix">
                <div class="order-info pull-left">
					<span class="serial-sn">
						#<strong><?php  echo $order['serial_sn'];?></strong>
					</span>
                    <span class="store-info">
						<strong><?php  echo $stores[$order['sid']]['title'];?></strong>
						&nbsp;
					</span>
                    <span class="send-time">
						<strong><?php  echo $order['delivery_time'];?></strong>
						<span class="grayest">（<?php  echo date('Y-m-d H:i', $order['addtime'])?> 下单）</span>
						<?php  if($order['is_pay'] == 1) { ?>
							<span><?php  echo $pay_types[$order['pay_type']]['text'];?></span>
						<?php  } ?>
						<span>&nbsp;<?php  echo $order_channels[$order['order_channel']]['text'];?></span>
					</span>
                </div>
                <div class="order-status pull-right"><strong class="<?php  echo $order_status[$order['status']]['color'];?>"><?php echo ($order['active_state'] != 1)?$order_status[$order['status']]['text']:"拼团中"?></strong></div>
            </div>
            <?php  if(!empty($order['remind'])) { ?>
            <div class="order-remind" data-endtime="<?php  echo $order['remind']['endtime'];?>" data-id="<?php  echo $order['id'];?>" style="background-color: <?php  echo $order['remind']['color'];?>">
                <i class="icon icon-time"></i>
                <?php  echo $order['remind']['text'];?> <?php  if(!empty($order['remind']['endtime'])) { ?><span class="minute">00</span>:<span class="second">00</span><?php  } ?>
            </div>
            <?php  } ?>
            <?php  if($order['status'] == 6) { ?>
            <div class="order-reason">
                <i class="icon icon-time"></i>
                取消原因:<?php  echo $order['cancel_reason'];?>
            </div>
            <?php  } ?>
            <div class="user-info">
                <span class="highlight"><?php  echo $order['username'];?>(<?php  echo $order['sex'];?>)</span>
                <span class="user-phone"><?php  echo $order['mobile'];?></span>
                <a href="<?php  echo ifilter_url('uid:' . $order['uid']);?>" class="greenest pull-right" <?php  if($order['label']['color']) { ?>style="color: <?php  echo $order['label']['color'];?>;"<?php  } ?>>查看用户历史订单</a>
                <div class="user-location clearfix">
                    <span><?php  echo $order['address'];?></span>
                    <a href="javascript:;" class="greenest pull-right hide"><i class="fa fa-map-marker"></i>5.0km</a>
                </div>
            </div>
            <?php  if($order['deliveryer_id'] > 0) { ?>
            <div class="delivery-info clearfix">
                <div class="highlight">配送:</div>
                <div class="deliveryer-info">
                    <strong><?php  echo $deliveryers[$order['deliveryer_id']]['title'];?></strong> &nbsp; &nbsp;<?php  echo $deliveryers[$order['deliveryer_id']]['mobile'];?>
                    <div class="status-info">
                        <?php  if($order['delivery_status'] == 7) { ?>
                        骑士已接单（接单时间：<?php  echo date('Y-m-d H:i', $order['delivery_assign_time'])?>）
                        <?php  } else if($order['delivery_status'] == 8) { ?>
                        骑士已到店（到店时间：<?php  echo date('Y-m-d H:i', $order['delivery_instore_time'])?>）
                        <?php  } else if($order['delivery_status'] == 4) { ?>
                        骑士已取货（取货时间：<?php  echo date('Y-m-d H:i', $order['delivery_takegoods_time'])?>）
                        <?php  } else if($order['delivery_status'] == 5) { ?>
                        骑手已送达（送达时间：<?php  echo date('Y-m-d H:i', $order['delivery_success_time'])?>）
                        <?php  } ?>
                    </div>
                </div>
            </div>
            <?php  } ?>
            <div class="product-info">
                <p class="product-title">
                    <span class="highlight">商品信息</span>
                    <span class="pull-right greenest toggle-product" <?php  if($order['label']['color']) { ?>style="color: <?php  echo $order['label']['color'];?>;"<?php  } ?>>展开 <i class="fa fa-angle-up"></i></span>
                </p>
                <div class="product-display hide">
                    <div class="remark"><span class="orange">备注：</span><?php  if(!empty($order['note'])) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?></div>
                    <div class="table-order">
                        <table class="table">
                            <tbody>
                            <?php  if(is_array($goods_all[$order['id']])) { foreach($goods_all[$order['id']] as $goods) { ?>
                            <tr>
                                <td class="goods-name"><?php  echo $goods['goods_title'];?></td>
                                <td class="goods-price">¥<?php  echo $goods['goods_unit_price'];?></td>
                                <td class="goods-num">x<?php  echo $goods['goods_num'];?></td>
                                <td class="total-price">¥<?php  echo $goods['goods_price'];?></td>
                            </tr>
                            <?php  } } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php  if($order['data']['extra_fee']) { ?>
                    <?php  if(is_array($order['data']['extra_fee'])) { foreach($order['data']['extra_fee'] as $extra_fee) { ?>
                    <div class="list-item clearfix">
                        <span class="pull-left"><?php  echo $extra_fee['name'];?></span>
                        <span class="pull-right">¥<?php  echo $extra_fee['fee'];?></span>
                    </div>
                    <?php  } } ?>
                    <?php  } ?>
                    <?php  if($order['box_price'] > 0) { ?>
                    <div class="list-item clearfix">
                        <span class="pull-left">餐盒费</span>
                        <span class="pull-right">¥<?php  echo $order['box_price'];?></span>
                    </div>
                    <?php  } ?>
                    <?php  if($order['pack_fee'] > 0) { ?>
                    <div class="list-item clearfix">
                        <span class="pull-left">包装费</span>
                        <span class="pull-right">¥<?php  echo $order['pack_fee'];?></span>
                    </div>
                    <?php  } ?>
                    <?php  if($order['delivery_fee'] > 0) { ?>
                    <div class="list-item clearfix">
                        <span class="pull-left">配送费</span>
                        <span class="pull-right">¥<?php  echo $order['delivery_fee'];?></span>
                    </div>
                    <?php  } ?>
                    <div class="charge-info">
                        <div class="charge-title clearfix">
                            <div class="pull-left"><strong>小计</strong></div>
                            <div class="pull-right">¥<?php  echo $order['total_fee'];?></div>
                        </div>
                        <div class="charge-title clearfix">
                            <div class="pull-left"><strong>顾客实际支付</strong></div>
                            <div class="pull-right">¥<?php  echo $order['final_fee'];?></div>
                        </div>
                        <div class="total clearfix">
                            <div class="pull-left"><span class="highlight">商户预计收入</span></div>
                            <div class="pull-right"><span class="highlight">¥<?php  echo $order['store_final_fee'];?></span></div>
                        </div>
                        <?php  if($order['order_plateform'] == 'eleme') { ?>
                        <div class="total clearfix">
                            <div class="pull-left"><span class="highlight">饿了么店铺收入</span></div>
                            <div class="pull-right"><span class="highlight">¥<?php  echo $order['eleme_store_final_fee'];?></span></div>
                        </div>
                        <?php  } else if($order['order_plateform'] == 'meituan') { ?>
                        <div class="total clearfix">
                            <div class="pull-left"><span class="highlight">美团店铺收入</span></div>
                            <div class="pull-right"><span class="highlight">¥<?php  echo $order['meituan_store_final_fee'];?></span></div>
                        </div>
                        <?php  } ?>
                    </div>
                </div>
            </div>
            <div class="btn-area">
                <?php  if($order['status'] < 5) { ?>
                <?php  if($order['status'] == 1) { ?>
                    <?php  if($order['active_state'] != 1) { ?>
                    <a href="<?php  echo iurl('allgroupgoods/order/status', array('type' => 'handle', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定接单吗">接受订单</a>
                    <a href="<?php  echo iurl('allgroupgoods/order/status', array('type' => 'notify_clerk_handle', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定通知商户接单吗">通知商户接单</a>
                    <?php  } ?>
                <?php  } ?>
                <?php  if($order['order_type'] == 1) { ?>
                <?php  if($order['status'] == 2 || $order['status'] == 3) { ?>
                <a href="<?php  echo iurl('allgroupgoods/order/status', array('type' => 'notify_deliveryer_collect', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定通知配送员抢单吗？">通知配送员抢单</a>
                <?php  if($order['delivery_type'] == 2) { ?>
                <a href="javascript:;" class="btn btn-primary btn-sm btn-dispatch" data-id="<?php  echo $order['id'];?>">调度</a>
                <?php  } ?>
                <?php  } ?>
                <?php  if($order['status'] == 4) { ?>
                <a href="<?php  echo iurl('allgroupgoods/order/status', array('type' => 're_notify_deliveryer_collect', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="该订单配送员已经接单,确定将订单重新放入待抢订单列？">将订单重新放入待抢订单列</a>
                <a href="javascript:;" class="btn btn-primary btn-sm btn-dispatch" data-id="<?php  echo $order['id'];?>">重新调度</a>
                <?php  } ?>
                <?php  if($order['status'] > 1) { ?>
                <a href="<?php  echo iurl('allgroupgoods/order/status', array('type' => 'end', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定完成订单吗?">完成订单</a>
                <?php  } ?>
                <?php  } else if($order['order_type'] == 2) { ?>
                <a href="<?php  echo iurl('allgroupgoods/order/status', array('type' => 'end', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定完成订单吗?">完成订单</a>
                <?php  } ?>

                <?php  if($order['is_pay'] == 1 && $order['pay_type'] != 'delivery') { ?>
                <a href="<?php  echo iurl('allgroupgoods/order/cancel', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-modal" data-batch="modal">取消订单并退款</a>
                <?php  } else { ?>
                <a href="<?php  echo iurl('allgroupgoods/order/cancel', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-modal" data-batch="modal">取消订单</a>
                <?php  } ?>

                <?php  if($order['is_remind'] == 1) { ?>
                <a href="<?php  echo iurl('allgroupgoods/order/remind', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-modal">回复催单</a>
                <?php  } ?>
                <?php  } ?>
                <?php  if($order['refund_status'] == 1) { ?>
                <a href="<?php  echo iurl('allgroupgoods/order/refund_handle', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定发起退款吗?">发起退款</a>
                <a href="<?php  echo iurl('allgroupgoods/order/refund_status', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定设置为已退款吗?">已退款</a>
                <?php  } else if($order['refund_status'] == 2) { ?>
                <a href="<?php  echo iurl('allgroupgoods/order/refund_query', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post">查询退款进度</a>
                <a href="<?php  echo iurl('allgroupgoods/order/refund_status', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定设置为已退款吗?">已退款</a>
                <?php  } ?>
                <a href="<?php  echo iurl('allgroupgoods/order/print', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定打印该订单吗?"><i class="fa fa-print"></i> ( <?php  echo $order['print_nums'];?> )</a>
                <a href="<?php  echo iurl('allgroupgoods/order/changeOrder', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-modal" data-batch="modal">修改订单</a>
                <a href="<?php  echo iurl('allgroupgoods/order/detail', array('id' => $order['id']));?>" target="_blank" class="btn btn-primary btn-sm">详情</a>
            </div>
        </div>
        <?php  } } ?>
    </div>
    <div class="col-md-4">
        <div class="panel panel-stat">
            <div class="panel-heading">
                <h3>当日订单概况</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="title">已完成订单(笔)</div>
                    <div class="num-wrapper">
                        <a class="num" href="javascript:;"><?php  echo intval($stat['total_num']);?></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="title">预计收入(元)</div>
                    <div class="num-wrapper">
                        <a class="num" href="javascript:;"><?php  echo round($stat['total_price'], 2);?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php  } else { ?>
    <div class="no-result">
        <p>还没有相关数据</p>
    </div>
    <?php  } ?>
    <div class="col-md-12">
        <?php  echo $pager;?>
    </div>
</div>

<div class="modal fade" id="order-dispatch">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">订单调度</h3>
            </div>
            <div class="modal-body" style="min-height: 530px">
                <form action="">
                    <div class="col-lg-9">
                        <div id="allmap" style="height: 500px">
                        </div>
                    </div>
                    <div class="col-lg-3 table-responsive">
                        <div class="form-group" id="search-deliveryer">
                            <input type="text" name="" class="form-control" placeholder="按照配送员的姓名和编号搜索">
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <th>编号</th>
                            <th>配送员</th>
                            <th>外卖/跑腿(配送中)</th>
                            <th>操作</th>
                            </thead>
                            <tbody class="deliveryer-list">
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="order-export" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <form action="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">导出订单</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>附加会员字段</label>
                        <br/>
                        <?php  if(is_array($fields)) { foreach($fields as $key => $field) { ?>
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="field-<?php  echo $key;?>" name="fields[]" value="<?php  echo $key;?>">
                            <label for="field-<?php  echo $key;?>"><?php  echo $field;?></label>
                        </div>
                        <?php  } } ?>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
                    <a class="btn btn-default" data-dismiss="modal" aria-label="Close">取消</a>
                    <a class="btn btn-primary btn-export-submit" href="javascript:;">确定导出</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script id="tpl-deliveryer-list" type="text/html">
    <{# for(var i = 0, len = d.length; i < len; i++){ }>
    <tr data-bind="1" data-kw="<{d[i].title}>-<{d[i].id}>">
        <td style="vertical-align: middle;">
            <strong>#<{d[i].id}></strong>
        </td>
        <td style="vertical-align: middle">
            <strong><{d[i].title}></strong>
        </td>
        <td style="vertical-align: middle">
            <strong>
                <span <{# if(d[i].order_takeout_num > 0 ) { }> class="text-danger" <{# } }>><{d[i].order_takeout_num}></span>
                /
                <span  <{# if(d[i].order_errander_num > 0 ) { }> class="text-danger" <{# } }>><{d[i].order_errander_num}></strong></span>
        </td>
        <td>
            <a href="javascript:;" data-deliveryer-id="<{d[i].id}>" data-order-id="<{d[i].order_id}>" class="btn btn-primary btn-dispatch-submit">分配</a>
        </td>
    </tr>
    <tr>
        <td colspan="4">配送员-<strong class="text-danger"><{d[i].store2deliveryer_distance}></strong>-门店-<strong class="text-danger"><{d[i].store2user_distance}></strong>-收货人</td>
    </tr>
    <{# } }>
</script>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.1&key=550a3bf0cb6d96c3b43d330fb7d86950&plugin=AMap.Driving,AMap.Geocoder"></script>
<script>
    irequire(['laytpl', 'tiny'], function(laytpl, tiny){
        var config = <?php  echo json_encode($_W['we7_wmall']['config']['takeout']['range']);?>;
        var mpaData = {
            resizeEnable: true,
            zoom: 13
        };
        if(config && config != 'null'){
            mpaData.center = [config.map.location_y, config.map.location_x]
        }
        var map = new AMap.Map('allmap', mpaData);
        var driving = new AMap.Driving({
            policy:AMap.DrivingPolicy.LEAST_TIME,
            map: map
        });

        $('.btn-export').click(function(){
            $('#order-export').modal('show');
            $('.btn-export-submit').click(function(){
                var fields = [];
                $(':checkbox[name="fields[]"]:checked').each(function(){
                    if($(this).val()) {
                        fields.push($(this).val());
                    }
                });
                fields = fields.join('|');
                $('#form-takeout input[name="fields"]').val(fields);
                $('#form-takeout input[name="op"]').val('export');
                $('#form-takeout').submit();
                $('#form-takeout input[name="op"]').val('list');
                $('#order-export').modal('hide');
            });
        });

        $('.btn-refresh, .btn-notice').click(function(){
            var type = $(this).data('type');
            var value = $(this).find(':checkbox').prop('checked') ? 0 : 1;
            var time = 0;
            var proc = function(){
                $.post(location.href, {type: type, value: value}, function(){
                    location.reload();
                });
            };
            if(type == 'status_order_notice' && value == 1) {
                Notify.alert("以下情况下有订单提示音:<br>1.订单已支付 <br>2.商家未接单(即:订单为待接单,其他状态不提示)<br>3.浏览器已打开订单处理中心页面", proc);
                return false;
            } else {
                proc();
            }
            return false;
        });
        <?php  if($_GPC['_status_order_refresh'] == 1) { ?>
        var sync = setInterval(function(){
            var time = parseInt($('#time-count span').html());
            if(time > 1) {
                time--;
                var html = '<span>' + time + '</span>'  + '秒后';
                $('#time-count').html(html);
            } else {
                location.reload();
            }
        }, 1000);
        if(!$('#time-count span').size()) {
            clearInterval(sync);
        }
        <?php  } ?>

            $(document).on('click', '.product-title .toggle-product', function(){
                var $parent = $(this).parents('.panel-order');
                var is_hide = $('.product-display', $parent).hasClass('hide');
                if(is_hide) {
                    $('.product-display', $parent).removeClass('hide');
                    $(this).html('收起 <i class="fa fa-angle-up"></i>');
                } else {
                    $('.product-display', $parent).addClass('hide');
                    $(this).html('展开 <i class="fa fa-angle-down"></i>');
                }
            });

            $(document).on('click', '.btn-dispatch', function(){
                var id = $(this).data('id');
                $.post("<?php  echo iurl('allgroupgoods/order/analyse')?>", {id: id}, function(data){
                    var result = $.parseJSON(data);
                    if(result.message.errno != 0) {
                        Notify.error(result.message.message);
                        return false;
                    }
                    var order = result.message.message;
                    if(!order.location_y || order.location_y == 'undefined' || !order.location_x || order.location_x == 'undefined') {
                        Notify.error('顾客收货地址经纬度不完善，无法进行调度');
                        return false;
                    }
                    var gettpl = $('#tpl-deliveryer-list').html();
                    laytpl(gettpl).render(order.deliveryers, function(html){
                        $('#order-dispatch').find('.deliveryer-list').html(html);
                    });
                    if(order.location_y && order.location_x) {
                        driving.search(new AMap.LngLat(order['store'].location_y, order['store'].location_x), new AMap.LngLat(order.location_y, order.location_x));
                    } else {
                        marker = new AMap.Marker({
                            position: [order.store.location_y, order.store.location_x],
                            offset: new AMap.Pixel(-27, -74),
                            content: '<div class="marker-start-route"></div>'
                        });
                        marker.setMap(map);

                        var geocoder = new AMap.Geocoder({
                            city: config.city
                        });
                        geocoder.getLocation(order.address, function(status, result) {
                            if (status === 'complete' && result.info === 'OK') {
                                var position = result.geocodes[0].location;
                                if(position) {
                                    marker = new AMap.Marker({
                                        position: [position.lng, position.lat],
                                        offset: new AMap.Pixel(-27, -74),
                                        content: '<div class="marker-end-route"></div>'
                                    });
                                    marker.setMap(map);
                                }
                            }
                        });
                        map.setFitView();
                    }
                    $.each(order.deliveryers, function(k, v){
                        var deliveryer = v;
                        if(deliveryer.location_x && deliveryer.location_y) {
                            marker = new AMap.Marker({
                                position: [deliveryer.location_y, deliveryer.location_x],
                                offset: new AMap.Pixel(-26, -80),
                                content: '<div class="marker-deliveyer-route"><img src="'+ deliveryer.avatar +'" alt=""/></div>'
                            });
                            marker.setMap(map);
                        }
                    });
                    $('#order-dispatch').modal('show');
                });
            });

            $('#search-deliveryer input').keyup(function() {
                var key = $.trim($(this).val());
                if(key) {
                    $('.deliveryer-list tr').hide();
                    $('.deliveryer-list tr[data-bind="1"]').each(function() {
                        var kw = $(this).data('kw');
                        if(kw && kw.indexOf(key) >= 0){
                            $(this).next().show();
                            $(this).show();
                        }
                    });
                } else {
                    $('.deliveryer-list tr').show();
                }
            });

            $(document).on('click', '.btn-dispatch-submit', function(){
                var order_id = $(this).data('order-id');
                var deliveryer_id = $(this).data('deliveryer-id');
                if(!order_id || !deliveryer_id) {
                    return false;
                }
                util.loading();
                $.post("<?php  echo iurl('allgroupgoods/order/dispatch')?>", {order_id: order_id, deliveryer_id: deliveryer_id}, function(data){
                    var result = $.parseJSON(data);
                    util.loaded();
                    if(result.message.errno != 0) {
                        Notify.error(result.message.message);
                        return false;
                    } else {
                        location.reload();
                    }
                    $('#order-dispatch').modal('hide');
                });
            });

            $(document).on('click', '.item-deliveryer', function(){
                var deliveryer = $(this).data('info');
                if(!deliveryer) {
                    Notify.error('配送员信息错误');
                    return false;
                }
            });

            $('.panel-order .order-remind').each(function(){
                var endtime = $(this).data('endtime'), id = $(this).data('id');
                var parent = '.panel-order .order-remind[data-id="'+ id +'"]';
                tiny.countDown(endtime, '', parent + ' .hour', parent + ' .minute', parent + ' .second');
            });
        });
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>