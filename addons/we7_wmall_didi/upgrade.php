<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_activity_bargain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  `order_limit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `goods_limit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `starthour` smallint(5) unsigned NOT NULL DEFAULT '0',
  `endhour` smallint(5) unsigned NOT NULL DEFAULT '0',
  `use_limit` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'ongoing',
  `total_updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `agentid` (`agentid`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_activity_bargain_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `bargain_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `discount_price` varchar(10) NOT NULL DEFAULT '0',
  `max_buy_limit` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `poi_user_type` varchar(10) NOT NULL DEFAULT 'all',
  `discount_total` int(10) NOT NULL DEFAULT '-1',
  `discount_available_total` int(10) NOT NULL DEFAULT '-1',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `dosage` int(10) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mall_displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `bargain_id` (`bargain_id`),
  KEY `goods_id` (`goods_id`),
  KEY `status` (`status`),
  KEY `mall_displayorder` (`mall_displayorder`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_activity_coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '公号序号',
  `sid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '公号序号',
  `type` varchar(20) NOT NULL DEFAULT 'collect',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题',
  `discount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '折扣券(折扣率), 代金券(面额)',
  `condition` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单满多少可用',
  `type_limit` int(10) NOT NULL DEFAULT '1' COMMENT '1:所有用户都可领取,2:新用户可领取',
  `dosage` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已领取数量',
  `amount` int(10) unsigned NOT NULL COMMENT '总发行数量',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:可领取,2:暂停领取',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发行时间',
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0',
  `coupons` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `type` (`type`),
  KEY `starttime` (`starttime`),
  KEY `endtime` (`endtime`),
  KEY `status` (`status`),
  KEY `activity_id` (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_activity_coupon_grant_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `couponid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL COMMENT '用户编号',
  `grant_type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态: 1:一次性领取,2:每天领取 ',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `couponid` (`couponid`),
  KEY `uid` (`uid`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_activity_coupon_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `couponid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL COMMENT '用户编号',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `code` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态: 1:未使用,2:已使用 ',
  `remark` varchar(300) NOT NULL DEFAULT '',
  `granttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发放时间',
  `usetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用时间',
  `type` varchar(20) NOT NULL DEFAULT 'couponCollect',
  `discount` varchar(10) NOT NULL DEFAULT '0',
  `condition` int(10) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `channel` varchar(30) NOT NULL,
  `is_notice` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `noticetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `couponid` (`couponid`),
  KEY `uid` (`uid`),
  KEY `status` (`status`),
  KEY `is_notice` (`is_notice`),
  KEY `channel` (`channel`),
  KEY `noticetime` (`noticetime`),
  KEY `endtime` (`endtime`),
  KEY `uniacid_sid_uid_orderid` (`uniacid`,`sid`,`uid`,`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_activity_redpacket_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0',
  `super_share_id` int(10) unsigned NOT NULL DEFAULT '0',
  `channel` varchar(20) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `code` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '',
  `discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `category_limit` varchar(500) NOT NULL,
  `times_limit` varchar(500) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `is_show` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(300) NOT NULL DEFAULT '',
  `granttime` int(10) unsigned NOT NULL DEFAULT '0',
  `usetime` int(10) unsigned NOT NULL DEFAULT '0',
  `scene` varchar(100) NOT NULL DEFAULT 'waimai',
  `is_notice` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `noticetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `redpacketid` (`activity_id`),
  KEY `uid` (`uid`),
  KEY `status` (`status`),
  KEY `is_show` (`is_show`),
  KEY `scene` (`scene`),
  KEY `endtime` (`endtime`),
  KEY `is_notice` (`is_notice`),
  KEY `noticetime` (`noticetime`),
  KEY `uniacid_uid_orderid` (`uniacid`,`uid`,`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `realname` varchar(15) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(50) NOT NULL,
  `number` varchar(60) NOT NULL,
  `location_x` varchar(20) NOT NULL,
  `location_y` varchar(20) NOT NULL,
  `is_default` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `mode` varchar(20) NOT NULL DEFAULT 'favorite',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_advertise_trade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `displayorder` tinyint(3) NOT NULL,
  `type` varchar(50) NOT NULL,
  `final_fee` varchar(20) NOT NULL,
  `days` tinyint(10) NOT NULL,
  `data` varchar(1000) NOT NULL,
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `order_sn` varchar(50) NOT NULL,
  `pay_type` varchar(20) NOT NULL,
  `is_pay` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `type` (`displayorder`),
  KEY `status` (`status`),
  KEY `starttime` (`starttime`),
  KEY `endtime` (`endtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_agent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `area` varchar(30) NOT NULL,
  `initial` varchar(10) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(3) unsigned DEFAULT '0',
  `sysset` text NOT NULL,
  `pluginset` text NOT NULL,
  `account` varchar(1000) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fee` varchar(5000) NOT NULL,
  `geofence` text NOT NULL,
  `data` text NOT NULL,
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_agent_current_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `order_type` varchar(20) NOT NULL,
  `extra` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_agent_getcash_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_no` varchar(20) NOT NULL,
  `get_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `take_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `account` varchar(500) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `channel` varchar(10) NOT NULL DEFAULT 'weixin',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_assign_board` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `queue_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(15) NOT NULL,
  `openid` varchar(64) NOT NULL,
  `guest_num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `number` varchar(20) NOT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_notify` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_assign_queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `guest_num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `notify_num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `starttime` varchar(10) NOT NULL,
  `endtime` varchar(10) NOT NULL,
  `prefix` varchar(10) NOT NULL COMMENT '前缀',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `position` int(10) unsigned NOT NULL DEFAULT '1',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '根据这个时间,判断是否将position重新至0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_cache` (
  `name` varchar(50) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT 'member',
  `alias` varchar(20) NOT NULL,
  `score` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(30) NOT NULL,
  `color` varchar(15) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_system` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_clerk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(15) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `openid` varchar(60) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(6) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL,
  `token` varchar(50) NOT NULL,
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `openid_wxapp` varchar(60) NOT NULL,
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `status` (`status`),
  KEY `openid_wxapp` (`openid_wxapp`),
  KEY `openid` (`openid`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sysset` text NOT NULL,
  `pluginset` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_creditshop_adv` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `wxapp_link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(10) DEFAULT '0',
  `status` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `status` (`status`),
  KEY `displayorder` (`displayorder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_creditshop_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` tinyint(3) unsigned DEFAULT '0',
  `status` tinyint(3) DEFAULT '1',
  `advimg` varchar(255) DEFAULT '',
  `advurl` varchar(500) DEFAULT '',
  `isrecommand` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `displayorder` (`displayorder`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_creditshop_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `category_id` int(10) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL,
  `old_price` varchar(10) NOT NULL,
  `chance` tinyint(3) unsigned NOT NULL,
  `totalday` tinyint(3) unsigned NOT NULL,
  `use_credit1` varchar(10) NOT NULL DEFAULT '0',
  `use_credit2` varchar(10) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `credit2` varchar(10) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `redpacket` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_creditshop_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credits` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `itemcode` int(10) unsigned NOT NULL DEFAULT '0',
  `actualprice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `faceprice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `description` varchar(255) NOT NULL,
  `ordernum` varchar(255) NOT NULL,
  `ordersn` varchar(50) NOT NULL,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_creditshop_order_new` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `acid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_type` varchar(20) NOT NULL,
  `order_sn` varchar(50) NOT NULL,
  `pay_type` varchar(15) NOT NULL,
  `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `paytime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `total_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `discount_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `final_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `transaction_id` varchar(60) NOT NULL,
  `use_credit1` varchar(10) NOT NULL DEFAULT '0.00',
  `use_credit2` varchar(10) NOT NULL DEFAULT '0.00',
  `data` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `grant_status` int(10) NOT NULL DEFAULT '0',
  `use_credit1_status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `addtime` (`addtime`),
  KEY `paytime` (`paytime`),
  KEY `is_pay` (`is_pay`),
  KEY `pay_type` (`pay_type`),
  KEY `status` (`status`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_cube` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `tips` varchar(20) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `wxapp_link` varchar(255) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_delivery_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `days` int(10) unsigned NOT NULL DEFAULT '0',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `day_free_limit` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `delivery_fee_free_limit` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_delivery_cards_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `acid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(60) NOT NULL,
  `ordersn` varchar(20) NOT NULL,
  `card_id` int(10) unsigned NOT NULL DEFAULT '0',
  `final_fee` varchar(20) NOT NULL,
  `pay_type` varchar(20) NOT NULL,
  `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `paytime` int(10) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_deliveryer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(15) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `openid` varchar(60) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(6) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `age` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `credit1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `credit2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `groupid` int(10) unsigned NOT NULL DEFAULT '0',
  `token` varchar(32) NOT NULL,
  `work_status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_takeout` tinyint(3) NOT NULL DEFAULT '0',
  `is_errander` tinyint(3) NOT NULL DEFAULT '0',
  `auth_info` varchar(500) NOT NULL,
  `location_x` varchar(20) NOT NULL,
  `location_y` varchar(20) NOT NULL,
  `order_takeout_num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `order_errander_num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `extra` varchar(500) NOT NULL,
  `openid_wxapp` varchar(60) NOT NULL,
  `registration_id` varchar(50) NOT NULL,
  `collect_max_takeout` int(10) NOT NULL,
  `collect_max_errander` int(10) NOT NULL,
  `perm_transfer` varchar(200) NOT NULL,
  `perm_cancel` varchar(200) NOT NULL,
  `fee_delivery` varchar(500) NOT NULL,
  `fee_getcash` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`),
  KEY `work_status` (`work_status`),
  KEY `token` (`token`),
  KEY `is_takeout` (`is_takeout`),
  KEY `is_errander` (`is_errander`),
  KEY `openid_wxapp` (`openid_wxapp`),
  KEY `openid` (`openid`),
  KEY `registration_id` (`registration_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_deliveryer_current_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_type` varchar(20) NOT NULL DEFAULT 'order',
  `trade_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:订单入账, 2: 申请提现',
  `extra` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `deliveryer_id` (`deliveryer_id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`),
  KEY `trade_type` (`trade_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_deliveryer_getcash_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_no` varchar(20) NOT NULL,
  `get_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `take_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '1:申请成功,2:申请中',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `account` varchar(1000) NOT NULL,
  `channel` varchar(10) NOT NULL DEFAULT 'weixin',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `deliveryer_id` (`deliveryer_id`),
  KEY `agentid` (`agentid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_deliveryer_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL DEFAULT '',
  `group_condition` int(10) unsigned NOT NULL DEFAULT '0',
  `delivery_fee` varchar(2000) NOT NULL DEFAULT '',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_deliveryer_location_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_x` varchar(20) NOT NULL,
  `location_y` varchar(20) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime_cn` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `deliveryer_id` (`deliveryer_id`),
  KEY `addtime` (`addtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_deliveryer_transfer_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_type` varchar(20) NOT NULL DEFAULT 'takeout',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `reason` varchar(20) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_year` smallint(10) unsigned NOT NULL DEFAULT '0',
  `stat_month` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_day` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `deliveryer_id` (`deliveryer_id`),
  KEY `stat_year` (`stat_year`),
  KEY `stat_month` (`stat_month`),
  KEY `stat_day` (`stat_day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_diypage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `diymenu` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `type` (`type`),
  KEY `addtime` (`addtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_diypage_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `addtime` (`addtime`),
  KEY `updatetime` (`updatetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_diypage_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  `preview` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_errander_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `goods_thumbs_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_on_upload` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT 'buy',
  `label` varchar(1000) NOT NULL,
  `labels` varchar(1000) NOT NULL,
  `delivery_within_days` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `start_fee` varchar(10) NOT NULL,
  `start_km` varchar(10) NOT NULL,
  `pre_km` varchar(10) NOT NULL DEFAULT '1',
  `pre_km_fee` varchar(10) NOT NULL DEFAULT '0',
  `weight_fee_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `weight_fee` text NOT NULL,
  `multiaddress` varchar(500) NOT NULL,
  `tip_min` varchar(10) NOT NULL DEFAULT '0',
  `tip_max` varchar(10) NOT NULL DEFAULT '0',
  `group_discount` varchar(1000) NOT NULL,
  `delivery_times` text NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rule` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `notice` varchar(500) NOT NULL,
  `deliveryers` varchar(255) NOT NULL,
  `goods_value_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `distance_calculate_type` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_errander_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `acid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `order_sn` varchar(20) NOT NULL,
  `order_channel` varchar(20) NOT NULL DEFAULT 'wap',
  `order_type` varchar(20) NOT NULL DEFAULT 'buy',
  `order_cid` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(60) NOT NULL,
  `goods_price` varchar(30) NOT NULL,
  `goods_weight` varchar(10) NOT NULL,
  `buy_username` varchar(20) NOT NULL,
  `buy_sex` varchar(5) NOT NULL,
  `buy_mobile` varchar(15) NOT NULL,
  `buy_address` varchar(100) NOT NULL,
  `buy_location_x` varchar(20) NOT NULL,
  `buy_location_y` varchar(20) NOT NULL,
  `accept_username` varchar(20) NOT NULL,
  `accept_sex` varchar(5) NOT NULL,
  `accept_mobile` varchar(15) NOT NULL,
  `accept_address` varchar(100) NOT NULL,
  `accept_location_x` varchar(20) NOT NULL,
  `accept_location_y` varchar(20) NOT NULL,
  `distance` varchar(20) NOT NULL,
  `delivery_time` varchar(30) NOT NULL,
  `pay_type` varchar(15) NOT NULL,
  `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `paytime` int(10) unsigned NOT NULL DEFAULT '0',
  `delivery_status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `delivery_handle_type` varchar(15) NOT NULL DEFAULT 'wechat',
  `delivery_assign_time` int(10) NOT NULL DEFAULT '0',
  `delivery_instore_time` int(10) NOT NULL DEFAULT '0',
  `delivery_success_time` int(10) NOT NULL DEFAULT '0',
  `delivery_success_location_x` varchar(15) NOT NULL,
  `delivery_success_location_y` varchar(15) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `print_nums` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delivery_fee` varchar(10) NOT NULL,
  `delivery_tips` varchar(10) NOT NULL,
  `total_fee` varchar(10) NOT NULL,
  `discount_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `final_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `deliveryer_fee` varchar(10) NOT NULL,
  `deliveryer_total_fee` varchar(10) NOT NULL DEFAULT '0',
  `agent_discount_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `agent_serve_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `agent_serve` varchar(1000) NOT NULL,
  `agent_final_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `plateform_serve_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `plateform_serve` varchar(1000) NOT NULL,
  `thumbs` varchar(1000) NOT NULL,
  `note` varchar(200) NOT NULL,
  `is_remind` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_anonymous` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `anonymous_username` varchar(15) NOT NULL,
  `out_trade_no` varchar(50) NOT NULL,
  `transaction_id` varchar(60) NOT NULL,
  `refund_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `refund_out_no` varchar(40) NOT NULL,
  `refund_apply_time` int(10) unsigned NOT NULL DEFAULT '0',
  `refund_success_time` int(10) unsigned NOT NULL DEFAULT '0',
  `refund_channel` varchar(30) NOT NULL,
  `refund_account` varchar(30) NOT NULL,
  `stat_year` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_month` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_day` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `delivery_collect_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `transfer_deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `transfer_delivery_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `addtime` (`addtime`),
  KEY `paytime` (`paytime`),
  KEY `is_pay` (`is_pay`),
  KEY `pay_type` (`pay_type`),
  KEY `refund_status` (`refund_status`),
  KEY `delivery_status` (`delivery_status`),
  KEY `status` (`status`),
  KEY `deliveryer_id` (`deliveryer_id`),
  KEY `stat_year` (`stat_year`),
  KEY `stat_month` (`stat_month`),
  KEY `stat_day` (`stat_day`),
  KEY `agentid` (`agentid`),
  KEY `delivery_collect_type` (`delivery_collect_type`),
  KEY `transfer_deliveryer_id` (`delivery_collect_type`),
  KEY `transfer_delivery_status` (`delivery_collect_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_errander_order_discount` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `note` varchar(50) NOT NULL,
  `fee` varchar(20) NOT NULL DEFAULT '0.00',
  `store_discount_fee` varchar(10) NOT NULL DEFAULT '0',
  `agent_discount_fee` varchar(10) NOT NULL DEFAULT '0',
  `plateform_discount_fee` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `oid` (`oid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_errander_order_status_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `type` varchar(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `note` varchar(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `oid` (`oid`),
  KEY `status` (`status`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_errander_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT 'sence',
  `scene` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  `agreement` text NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `isdefault` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `type` (`type`),
  KEY `addtime` (`addtime`),
  KEY `isdefault` (`isdefault`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_freelunch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `max_partake_times` int(10) unsigned NOT NULL DEFAULT '0',
  `partake_grant_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `reward_grant_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pre_partaker_num` int(10) unsigned NOT NULL DEFAULT '0',
  `pre_partaker_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pre_reward_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pre_max_partake_times` int(10) unsigned NOT NULL DEFAULT '0',
  `plus_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `plus_thumb` varchar(255) NOT NULL,
  `plus_partaker_num` int(10) unsigned NOT NULL DEFAULT '0',
  `plus_reward_num` int(10) unsigned NOT NULL DEFAULT '1',
  `plus_pre_partaker_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pre_plus_reward_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `plus_pre_max_partake_times` int(10) unsigned NOT NULL DEFAULT '0',
  `serial_sn` int(10) unsigned NOT NULL DEFAULT '1',
  `plus_serial_sn` int(10) unsigned NOT NULL DEFAULT '1',
  `share` varchar(3000) NOT NULL,
  `agreement` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `starttime` (`starttime`),
  KEY `endtime` (`endtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_freelunch_partaker` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `freelunch_id` int(10) unsigned NOT NULL DEFAULT '0',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0',
  `serial_sn` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `number` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_sn` varchar(50) NOT NULL,
  `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `freelunch_id` (`freelunch_id`),
  KEY `record_id` (`record_id`),
  KEY `uid` (`uid`),
  KEY `serial_sn` (`serial_sn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_freelunch_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `freelunch_id` int(10) unsigned NOT NULL DEFAULT '0',
  `serial_sn` int(10) unsigned NOT NULL DEFAULT '1',
  `type` varchar(20) NOT NULL DEFAULT 'common',
  `partaker_total` int(10) unsigned NOT NULL DEFAULT '0',
  `partaker_dosage` int(10) unsigned NOT NULL DEFAULT '0',
  `partaker_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `reward_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `reward_uid` varchar(1000) NOT NULL,
  `reward_number` int(10) unsigned NOT NULL DEFAULT '0',
  `startime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `freelunch_id` (`freelunch_id`),
  KEY `serial_sn` (`serial_sn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `cid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(30) NOT NULL,
  `price` varchar(500) NOT NULL,
  `box_price` varchar(10) NOT NULL DEFAULT '0',
  `min_buy_limit` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_options` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `unitname` varchar(10) NOT NULL DEFAULT '份',
  `total` int(10) NOT NULL DEFAULT '0',
  `sailed` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_hot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `thumb` varchar(255) NOT NULL,
  `slides` varchar(1000) NOT NULL,
  `label` varchar(5) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `comment_total` int(10) unsigned NOT NULL DEFAULT '0',
  `comment_good` int(10) unsigned NOT NULL DEFAULT '0',
  `print_label` int(10) unsigned NOT NULL DEFAULT '0',
  `child_id` int(20) unsigned NOT NULL DEFAULT '0',
  `number` varchar(50) NOT NULL,
  `old_price` varchar(10) NOT NULL,
  `total_warning` int(10) unsigned NOT NULL DEFAULT '0',
  `total_update_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `content` varchar(100) NOT NULL,
  `attrs` varchar(1000) NOT NULL,
  `elemeId` varchar(50) NOT NULL DEFAULT '0',
  `meituanId` varchar(50) NOT NULL DEFAULT '0',
  `openplateformCode` varchar(50) NOT NULL DEFAULT '0',
  `is_showtime` tinyint(3) NOT NULL DEFAULT '0',
  `start_time1` varchar(10) NOT NULL,
  `end_time1` varchar(10) NOT NULL,
  `start_time2` varchar(10) NOT NULL,
  `end_time2` varchar(10) NOT NULL,
  `week` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `cid` (`cid`),
  KEY `title` (`title`),
  KEY `is_hot` (`is_hot`),
  KEY `status` (`status`),
  KEY `displayorder` (`displayorder`),
  KEY `elemeId` (`elemeId`),
  KEY `meituanId` (`meituanId`),
  KEY `openplateformCode` (`openplateformCode`),
  KEY `child_id` (`child_id`),
  KEY `is_showtime` (`is_showtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_goods_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `parentid` int(10) NOT NULL DEFAULT '0',
  `min_fee` int(10) unsigned NOT NULL DEFAULT '0',
  `description` varchar(100) NOT NULL,
  `is_showtime` tinyint(3) NOT NULL DEFAULT '0',
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `week` varchar(50) NOT NULL,
  `elemeId` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `status` (`status`),
  KEY `displayorder` (`displayorder`),
  KEY `elemeId` (`elemeId`),
  KEY `is_showtime` (`is_showtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_goods_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `total` int(10) NOT NULL DEFAULT '-1',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `total_warning` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_help` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `click` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_lewaimai_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `storeidOrgoodsid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT 'goods',
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `storeidOrgoodsid` (`storeidOrgoodsid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_member_footmark` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_day` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `sid` (`sid`),
  KEY `stat_day` (`stat_day`),
  KEY `agentid` (`agentid`),
  KEY `addtime` (`addtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_member_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL DEFAULT '',
  `group_condition` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_member_invoice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `recognition` varchar(50) NOT NULL DEFAULT '',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `addtime` (`addtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_member_recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `order_sn` varchar(40) NOT NULL,
  `fee` varchar(10) NOT NULL,
  `final_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `type` varchar(15) NOT NULL DEFAULT 'credit',
  `tag` varchar(1000) NOT NULL,
  `is_pay` tinyint(1) NOT NULL DEFAULT '0',
  `pay_type` varchar(20) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `paytime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `setmeal_id` int(10) unsigned NOT NULL DEFAULT '0',
  `setmeal_day_free_limit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `setmeal_starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `setmeal_endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `success_num` int(10) unsigned DEFAULT '0',
  `success_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cancel_num` int(10) unsigned NOT NULL DEFAULT '0',
  `cancel_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_sys` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:系统会员, 2:模块兼容会员',
  `search_data` varchar(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `groupid` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile_audit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `salt` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `token` varchar(50) NOT NULL,
  `openid_wxapp` varchar(50) NOT NULL,
  `openid_qq` varchar(50) NOT NULL,
  `openid_wx` varchar(50) NOT NULL,
  `uid_qianfan` int(10) unsigned NOT NULL DEFAULT '0',
  `uid_majia` int(10) unsigned NOT NULL DEFAULT '0',
  `unionId` varchar(50) NOT NULL,
  `credit1` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `credit2` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `register_type` varchar(20) NOT NULL DEFAULT 'wechat',
  `success_first_time` int(10) unsigned NOT NULL DEFAULT '0',
  `success_last_time` int(10) unsigned NOT NULL DEFAULT '0',
  `cancel_first_time` int(10) unsigned NOT NULL DEFAULT '0',
  `cancel_last_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_spread` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `spreadcredit2` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `spread1` int(10) unsigned NOT NULL DEFAULT '0',
  `spread2` int(10) unsigned NOT NULL DEFAULT '0',
  `spreadfixed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `spread_groupid` int(10) unsigned NOT NULL DEFAULT '0',
  `spread_status` int(10) unsigned NOT NULL DEFAULT '0',
  `spreadtime` int(10) unsigned NOT NULL DEFAULT '0',
  `groupid_updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `spread_groupid_change_from` varchar(10) NOT NULL DEFAULT 'system',
  `setmeal_deliveryfee_free_limit` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `cancel_first_time` (`cancel_first_time`),
  KEY `cancel_last_time` (`cancel_last_time`),
  KEY `success_first_time` (`success_first_time`),
  KEY `success_last_time` (`success_last_time`),
  KEY `uid_qianfan` (`uid_qianfan`),
  KEY `is_spread` (`is_spread`),
  KEY `spead_groupid` (`spread_groupid`),
  KEY `spead_status` (`spread_status`),
  KEY `spreadtime` (`spreadtime`),
  KEY `openid` (`openid`),
  KEY `uid_majia` (`uid_majia`),
  KEY `spread1` (`spread1`),
  KEY `spread2` (`spread2`),
  KEY `openid_wxapp` (`openid_wxapp`),
  KEY `unionId` (`unionId`),
  KEY `first_order_time` (`success_first_time`),
  KEY `last_order_time` (`success_last_time`),
  KEY `speadid1` (`spread1`),
  KEY `speadid2` (`spread2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `cateid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(50) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_show_home` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `click` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `cateid` (`cateid`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_news_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(30) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT 'member',
  `title` varchar(60) NOT NULL,
  `link` varchar(255) NOT NULL,
  `wxapp_link` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `thumb` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_notice_read_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notice_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `is_new` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `notice_id` (`notice_id`),
  KEY `is_new` (`is_new`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_oauth_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appid` varchar(50) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `oauth_openid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `appid` (`appid`),
  KEY `openid` (`openid`),
  KEY `oauth_openid` (`oauth_openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `acid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `groupid` int(10) unsigned NOT NULL DEFAULT '0',
  `order_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordersn` varchar(20) NOT NULL,
  `code` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `number` varchar(60) NOT NULL,
  `location_x` varchar(20) NOT NULL,
  `location_y` varchar(20) NOT NULL,
  `note` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `num` tinyint(3) unsigned NOT NULL,
  `delivery_day` varchar(20) NOT NULL,
  `delivery_time` varchar(20) NOT NULL,
  `pay_type` varchar(15) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `paytime` int(10) unsigned NOT NULL DEFAULT '0',
  `delivery_assign_time` int(10) NOT NULL DEFAULT '0',
  `delivery_success_time` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `delivery_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '3:待配送, 4:配送中, 5: 配送成功, 6: 配送失败',
  `delivery_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_comment` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `print_nums` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delivery_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '外卖配送费',
  `pack_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `serve_fee` varchar(10) NOT NULL,
  `discount_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `total_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `final_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `vip_free_delivery_fee` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `invoice` varchar(50) NOT NULL,
  `data` text NOT NULL,
  `is_remind` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `is_refund` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `person_num` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `table_id` int(10) unsigned NOT NULL DEFAULT '0',
  `table_cid` int(10) unsigned NOT NULL DEFAULT '0',
  `reserve_type` varchar(10) NOT NULL,
  `reserve_time` varchar(30) NOT NULL,
  `transaction_id` varchar(60) NOT NULL,
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `spread1` int(10) unsigned NOT NULL DEFAULT '0',
  `spread2` int(10) unsigned NOT NULL DEFAULT '0',
  `spreadbalance` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mall_first_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `order_channel` varchar(20) NOT NULL DEFAULT 'wap',
  `serial_sn` int(10) unsigned NOT NULL DEFAULT '1',
  `box_price` varchar(10) NOT NULL DEFAULT '0',
  `handletime` int(10) unsigned NOT NULL DEFAULT '0',
  `clerk_notify_collect_time` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `is_timeout` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delivery_handle_type` varchar(20) NOT NULL DEFAULT 'wechat',
  `delivery_success_location_x` varchar(15) NOT NULL,
  `delivery_success_location_y` varchar(15) NOT NULL,
  `deliveryingtime` int(10) unsigned NOT NULL DEFAULT '0',
  `delivery_instore_time` int(10) NOT NULL DEFAULT '0',
  `deliverysuccesstime` int(10) unsigned NOT NULL DEFAULT '0',
  `refund_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `distance` varchar(20) NOT NULL DEFAULT '0.00',
  `extra_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `store_final_fee` varchar(10) NOT NULL DEFAULT '0',
  `store_discount_fee` varchar(10) NOT NULL DEFAULT '0',
  `plateform_discount_fee` varchar(10) NOT NULL DEFAULT '0',
  `plateform_serve` varchar(500) NOT NULL,
  `plateform_serve_rate` varchar(10) NOT NULL DEFAULT '0',
  `plateform_serve_fee` varchar(10) NOT NULL DEFAULT '0',
  `plateform_delivery_fee` varchar(10) NOT NULL DEFAULT '0',
  `plateform_deliveryer_fee` varchar(10) NOT NULL DEFAULT '0',
  `agent_serve` varchar(500) NOT NULL,
  `agent_final_fee` varchar(10) NOT NULL DEFAULT '0',
  `agent_serve_fee` varchar(10) NOT NULL DEFAULT '0',
  `agent_discount_fee` varchar(10) NOT NULL DEFAULT '0',
  `refund_fee` varchar(10) NOT NULL DEFAULT '0',
  `out_trade_no` varchar(50) NOT NULL,
  `stat_year` smallint(10) unsigned NOT NULL DEFAULT '0',
  `stat_month` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_day` int(10) unsigned NOT NULL DEFAULT '0',
  `last_notify_deliveryer_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_notify_clerk_time` int(10) unsigned NOT NULL DEFAULT '0',
  `notify_deliveryer_total` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `notify_clerk_total` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `elemeOrderId` varchar(60) NOT NULL,
  `elemeDowngraded` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `eleme_store_final_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `meituanOrderId` varchar(50) NOT NULL DEFAULT '0',
  `meituan_store_final_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `order_plateform` varchar(20) NOT NULL DEFAULT 'we7_wmall',
  `is_delete` tinyint(3) NOT NULL DEFAULT '0',
  `delivery_takegoods_time` int(10) NOT NULL DEFAULT '0',
  `deliveryinstoretime` int(10) unsigned NOT NULL DEFAULT '0',
  `print_sn` varchar(100) NOT NULL DEFAULT '0',
  `stat_week` tinyint(3) unsigned NOT NULL,
  `meals_cn` varchar(10) NOT NULL,
  `delivery_collect_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `transfer_deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `transfer_delivery_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid_sid` (`uniacid`,`sid`),
  KEY `delivery_status` (`delivery_status`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `delivery_type` (`delivery_type`),
  KEY `uid` (`uid`),
  KEY `order_type` (`order_type`),
  KEY `status` (`status`),
  KEY `refund_status` (`refund_status`),
  KEY `addtime` (`addtime`),
  KEY `paytime` (`paytime`),
  KEY `endtime` (`endtime`),
  KEY `pay_type` (`pay_type`),
  KEY `stat_year` (`stat_year`),
  KEY `stat_month` (`stat_month`),
  KEY `stat_day` (`stat_day`),
  KEY `is_pay` (`is_pay`),
  KEY `deliveryer_id` (`deliveryer_id`),
  KEY `agentid` (`agentid`),
  KEY `clerk_notify_collect_time` (`clerk_notify_collect_time`),
  KEY `handletime` (`handletime`),
  KEY `elemeOrderId` (`elemeOrderId`),
  KEY `order_plateform` (`order_plateform`),
  KEY `elemeDowngraded` (`elemeDowngraded`),
  KEY `spread1` (`spread1`),
  KEY `spread2` (`spread2`),
  KEY `spreadbalance` (`spreadbalance`),
  KEY `meituanOrderId` (`meituanOrderId`),
  KEY `order_channel` (`order_channel`),
  KEY `print_sn` (`print_sn`),
  KEY `print_nums` (`print_nums`),
  KEY `delivery_collect_type` (`delivery_collect_type`),
  KEY `transfer_deliveryer_id` (`delivery_collect_type`),
  KEY `transfer_delivery_status` (`delivery_collect_type`),
  KEY `stat_week` (`stat_week`),
  KEY `meals_cn` (`meals_cn`),
  KEY `is_remind` (`is_remind`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `groupid` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `data` text NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `paytime` int(10) unsigned NOT NULL DEFAULT '0',
  `box_price` varchar(10) NOT NULL DEFAULT '0',
  `original_price` varchar(10) NOT NULL DEFAULT '0.00',
  `original_data` text NOT NULL,
  `bargain_use_limit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `goods_quality` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delivery_service` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL,
  `data` varchar(1000) NOT NULL,
  `thumbs` varchar(3000) NOT NULL,
  `reply` varchar(500) NOT NULL,
  `replytime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `taste_score` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `package_score` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deliveryer_tag` varchar(255) NOT NULL,
  `is_share` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `oid` (`oid`),
  KEY `addtime` (`addtime`),
  KEY `agentid` (`agentid`),
  KEY `delivery_service` (`delivery_service`),
  KEY `deliveryer_id` (`deliveryer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_discount` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `note` varchar(50) NOT NULL,
  `fee` varchar(20) NOT NULL DEFAULT '0.00',
  `store_discount_fee` varchar(10) NOT NULL DEFAULT '0',
  `agent_discount_fee` varchar(10) NOT NULL DEFAULT '0',
  `plateform_discount_fee` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `oid` (`oid`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_grant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `max` int(10) unsigned NOT NULL DEFAULT '0',
  `continuous` int(10) unsigned NOT NULL DEFAULT '0',
  `sum` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `continuous` (`continuous`),
  KEY `sum` (`sum`),
  KEY `updatetime` (`updatetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_grant_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `days` int(10) unsigned NOT NULL DEFAULT '0',
  `grant` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `credittype` varchar(20) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `stat_month` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `mark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `times` (`days`),
  KEY `type` (`type`),
  KEY `addtime` (`addtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_peerpay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `plid` int(10) unsigned NOT NULL DEFAULT '0',
  `orderid` int(11) NOT NULL DEFAULT '0',
  `peerpay_type` tinyint(1) NOT NULL DEFAULT '0',
  `peerpay_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `peerpay_maxprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `peerpay_realprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `peerpay_selfpay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `peerpay_message` varchar(500) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `data` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `orderid` (`orderid`),
  KEY `plid` (`plid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_peerpay_payinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  `order_sn` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `uname` varchar(255) NOT NULL DEFAULT '',
  `usay` varchar(500) NOT NULL DEFAULT '',
  `final_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `paytime` int(10) unsigned NOT NULL DEFAULT '0',
  `headimg` varchar(255) DEFAULT NULL,
  `refundstatus` tinyint(1) NOT NULL DEFAULT '0',
  `refundprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `openid` (`openid`),
  KEY `order_sn` (`order_sn`),
  KEY `uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_refund` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `acid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` varchar(50) NOT NULL,
  `order_channel` varchar(20) NOT NULL DEFAULT 'wap',
  `reason` varchar(100) NOT NULL,
  `pay_type` varchar(15) NOT NULL,
  `fee` varchar(10) NOT NULL DEFAULT '0',
  `out_trade_no` varchar(60) NOT NULL DEFAULT '0',
  `out_refund_no` varchar(50) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `apply_time` int(10) unsigned NOT NULL DEFAULT '0',
  `handle_time` int(10) unsigned NOT NULL DEFAULT '0',
  `success_time` int(10) unsigned NOT NULL DEFAULT '0',
  `channel` varchar(30) NOT NULL,
  `account` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_refund_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `order_type` varchar(20) NOT NULL DEFAULT 'order',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `type` varchar(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `note` varchar(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `oid` (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_remind_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `remindid` varchar(50) NOT NULL DEFAULT '0',
  `channel` varchar(15) NOT NULL DEFAULT 'system',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `reply` varchar(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`),
  KEY `uniacid` (`uniacid`),
  KEY `oid` (`oid`),
  KEY `remindid` (`remindid`),
  KEY `channel` (`channel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_stat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_cid` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_num` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_title` varchar(30) NOT NULL,
  `goods_unit_price` varchar(10) NOT NULL,
  `goods_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `print_label` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `option_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_discount_num` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_number` varchar(30) NOT NULL,
  `goods_category_title` varchar(20) NOT NULL,
  `goods_original_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `bargain_id` int(10) unsigned NOT NULL DEFAULT '0',
  `total_update_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `order_plateform` varchar(20) NOT NULL DEFAULT 'we7_wmall',
  `stat_year` smallint(10) unsigned NOT NULL DEFAULT '0',
  `stat_month` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_week` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_day` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `addtime` (`addtime`),
  KEY `bargain_id` (`bargain_id`),
  KEY `uid` (`uid`),
  KEY `agentid` (`agentid`),
  KEY `oid` (`oid`),
  KEY `order_plateform` (`order_plateform`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_order_status_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `type` varchar(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `note` varchar(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `role` varchar(30) NOT NULL,
  `role_cn` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `oid` (`oid`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_paybill_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `acid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `serial_sn` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` varchar(50) NOT NULL,
  `pay_type` varchar(15) NOT NULL,
  `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `paytime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `total_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `no_discount_part` varchar(10) NOT NULL DEFAULT '0.00',
  `discount_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `final_fee` varchar(20) NOT NULL DEFAULT '0.00',
  `plateform_serve_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `plateform_serve` varchar(1000) NOT NULL,
  `store_final_fee` varchar(10) NOT NULL DEFAULT '0',
  `agent_serve_fee` varchar(10) NOT NULL DEFAULT '0.00',
  `agent_serve` varchar(1000) NOT NULL,
  `agent_final_fee` varchar(10) DEFAULT '0.00',
  `out_trade_no` varchar(50) NOT NULL,
  `transaction_id` varchar(60) NOT NULL,
  `stat_year` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_month` int(10) unsigned NOT NULL DEFAULT '0',
  `stat_day` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `stat_year` (`stat_year`),
  KEY `stat_month` (`stat_month`),
  KEY `stat_day` (`stat_day`),
  KEY `addtime` (`addtime`),
  KEY `paytime` (`paytime`),
  KEY `is_pay` (`is_pay`),
  KEY `pay_type` (`pay_type`),
  KEY `status` (`status`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_paylog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` varchar(20) NOT NULL,
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_type` varchar(30) NOT NULL,
  `fee` varchar(10) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `paytime` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `out_trade_order_id` varchar(50) NOT NULL,
  `data` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`),
  KEY `order_sn` (`order_sn`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_perm_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `plugins` text,
  `max_store` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_perm_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL DEFAULT '0',
  `rolename` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `perms` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_perm_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL DEFAULT '0',
  `uid` int(10) NOT NULL DEFAULT '0',
  `roleid` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `perms` text NOT NULL,
  `realname` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `roleid` (`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_plugin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL,
  `thumb` varchar(255) DEFAULT '',
  `version` varchar(10) NOT NULL DEFAULT '',
  `ability` varchar(255) NOT NULL,
  `status` int(10) DEFAULT '0',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_show` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_printer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'feie',
  `print_no` varchar(30) NOT NULL,
  `member_code` varchar(50) NOT NULL COMMENT '商户编号',
  `key` varchar(50) NOT NULL,
  `api_key` varchar(100) NOT NULL COMMENT '易联云打印机api_key',
  `print_nums` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `print_label` varchar(50) NOT NULL,
  `is_print_all` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `qrcode_link` varchar(100) NOT NULL,
  `print_header` varchar(50) NOT NULL,
  `print_footer` varchar(50) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `delivery_type_mine_193` int(10) unsigned NOT NULL DEFAULT '0',
  `qrcode_type` varchar(20) NOT NULL DEFAULT 'custom',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_printer_label` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(50) DEFAULT NULL,
  `table_id` int(10) unsigned NOT NULL DEFAULT '0',
  `extra` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `acid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `thumbs` varchar(2000) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_reserve` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `time` varchar(15) NOT NULL,
  `table_cid` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_shareredpacket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `share_redpacket_condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `share_redpacket_min` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `share_redpacket_max` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `share_redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `follow_redpacket_min` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `follow_redpacket_max` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `follow_redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `share` varchar(3000) NOT NULL,
  `agreement` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_shareredpacket_invite_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0',
  `share_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `follow_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `share_redpacket_condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `share_redpacket_discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `share_redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `follow_redpacket_condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `follow_redpacket_discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `follow_redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `activity_id` (`activity_id`),
  KEY `share_uid` (`share_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(30) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'homeTop',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `wxapp_link` varchar(255) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_spread_current_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `spreadid` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `extra` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `spreadid` (`spreadid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_spread_getcash_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `spreadid` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_no` varchar(20) NOT NULL,
  `get_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `take_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `channel` varchar(20) NOT NULL DEFAULT 'wechat',
  `account` varchar(500) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `channel_from` varchar(10) NOT NULL DEFAULT 'weixin',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `status` (`status`),
  KEY `agentid` (`agentid`),
  KEY `spreadid` (`spreadid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_spread_groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL DEFAULT '',
  `commission1` varchar(20) NOT NULL DEFAULT '0',
  `commission2` varchar(20) NOT NULL DEFAULT '0',
  `group_condition` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `cid` varchar(50) NOT NULL,
  `title` varchar(30) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `business_hours` varchar(200) NOT NULL,
  `is_in_business` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `send_price` smallint(5) unsigned NOT NULL DEFAULT '0',
  `delivery_price` varchar(255) NOT NULL DEFAULT '0',
  `delivery_free_price` int(10) unsigned NOT NULL DEFAULT '0',
  `pack_price` float(10,2) unsigned NOT NULL DEFAULT '0.00',
  `delivery_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delivery_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:商家配送,2:到店自提,3:两种都支持',
  `delivery_within_days` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delivery_reserve_days` tinyint(3) unsigned DEFAULT '0',
  `serve_radius` varchar(30) NOT NULL DEFAULT '0.00',
  `serve_fee` varchar(255) NOT NULL,
  `delivery_area` varchar(50) NOT NULL,
  `thumbs` varchar(1000) NOT NULL,
  `address` varchar(50) NOT NULL,
  `location_x` varchar(15) NOT NULL,
  `location_y` varchar(15) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sns` varchar(255) NOT NULL,
  `notice` varchar(100) NOT NULL COMMENT '公告',
  `tips` varchar(100) NOT NULL,
  `content` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `invoice_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `token_status` tinyint(3) unsigned DEFAULT '0',
  `remind_time_limit` tinyint(3) unsigned NOT NULL DEFAULT '10',
  `remind_reply` varchar(1500) NOT NULL,
  `comment_reply` varchar(2000) NOT NULL,
  `sailed` int(10) unsigned NOT NULL DEFAULT '0',
  `score` varchar(10) NOT NULL,
  `first_order_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `discount_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `grant_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bargain_price_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `reserve_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `collect_coupon_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `grant_coupon_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `comment_status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '评论审核.1:直接通过',
  `sms_use_times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '短信使用条数',
  `wechat_qrcode` varchar(500) NOT NULL,
  `custom_url` varchar(1000) NOT NULL,
  `addtype` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:后台添加,2:申请入驻',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `template` varchar(20) NOT NULL DEFAULT 'index',
  `not_in_serve_radius` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `auto_handel_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `auto_get_address` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `auto_notice_deliveryer` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `click` int(10) unsigned NOT NULL DEFAULT '0',
  `is_recommend` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_assign` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_reserve` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_meal` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `forward_mode` varchar(15) NOT NULL,
  `assign_mode` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `assign_qrcode` varchar(255) NOT NULL,
  `delivery_mode` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `order_note` varchar(255) NOT NULL,
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `is_rest` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_stick` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `position` tinyint(3) NOT NULL DEFAULT '1',
  `is_paybill` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `forward_url` varchar(100) NOT NULL,
  `delivery_fee_mode` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `delivery_times` varchar(7000) NOT NULL,
  `delivery_areas` text NOT NULL,
  `qualification` varchar(1000) NOT NULL,
  `label` int(10) NOT NULL DEFAULT '0',
  `push_token` varchar(50) NOT NULL,
  `self_audit_comment` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delivery_extra` varchar(255) NOT NULL,
  `elemeShopId` varchar(30) NOT NULL DEFAULT '0',
  `eleme_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `meituanShopId` varchar(30) DEFAULT '0',
  `meituan_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `openplateform_extra` varchar(1000) NOT NULL,
  `deltime` int(10) unsigned NOT NULL DEFAULT '0',
  `remind_time_start` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `consume_per_person` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `title` (`title`),
  KEY `is_recommend` (`is_recommend`),
  KEY `cid` (`cid`),
  KEY `status` (`status`),
  KEY `label` (`label`),
  KEY `displayorder` (`displayorder`),
  KEY `is_stick` (`is_stick`),
  KEY `agentid` (`agentid`),
  KEY `elemeShopId` (`elemeShopId`),
  KEY `meituanShopId` (`meituanShopId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fee_limit` int(10) unsigned NOT NULL DEFAULT '0',
  `fee_rate` varchar(10) NOT NULL DEFAULT '0',
  `fee_min` int(10) unsigned NOT NULL DEFAULT '0',
  `fee_max` int(10) unsigned NOT NULL DEFAULT '0',
  `wechat` varchar(1000) NOT NULL,
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `fee_takeout` varchar(500) NOT NULL,
  `fee_selfDelivery` varchar(500) NOT NULL,
  `fee_instore` varchar(500) NOT NULL,
  `fee_paybill` varchar(500) NOT NULL,
  `fee_eleme` varchar(500) NOT NULL,
  `fee_meituan` varchar(500) NOT NULL,
  `fee_goods` varchar(10000) NOT NULL,
  `fee_period` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `data` varchar(1000) NOT NULL,
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `starttime` (`starttime`),
  KEY `endtime` (`endtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `wxapp_link` varchar(255) NOT NULL,
  `slide_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `slide` varchar(1500) NOT NULL,
  `nav_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `nav` varchar(1500) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_clerk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `clerk_id` int(10) unsigned NOT NULL DEFAULT '0',
  `role` varchar(20) NOT NULL,
  `extra` varchar(500) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `clerk_id` (`clerk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_current_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:订单入账, 2: 申请提现',
  `extra` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_deliveryer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `delivery_type` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_favorite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid_sid` (`uid`,`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_getcash_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_no` varchar(20) NOT NULL,
  `get_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `take_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `account` varchar(500) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '1:申请成功,2:申请中',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `channel` varchar(10) NOT NULL DEFAULT 'weixin',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `first_order_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_order_time` int(10) unsigned NOT NULL DEFAULT '0',
  `success_num` int(10) unsigned DEFAULT '0',
  `success_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cancel_num` int(10) unsigned NOT NULL DEFAULT '0',
  `cancel_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_sys` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:系统会员, 2:模块兼容会员',
  `success_first_time` int(10) unsigned NOT NULL DEFAULT '0',
  `success_last_time` int(10) unsigned NOT NULL DEFAULT '0',
  `cancel_first_time` int(10) unsigned NOT NULL DEFAULT '0',
  `cancel_last_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`),
  KEY `uniacid` (`uniacid`),
  KEY `first_order_time` (`success_first_time`),
  KEY `last_order_time` (`success_last_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_store_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `data` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_superredpacket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `grant_object` longtext NOT NULL,
  `condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `addtime` (`addtime`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_superredpacket_grant` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `order_id` int(10) NOT NULL DEFAULT '0',
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0',
  `packet_dosage` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `packet_total` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_superredpacket_share` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL DEFAULT '0',
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `grant_days_effect` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `use_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `times_limit` text NOT NULL,
  `category_limit` text NOT NULL,
  `nums` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_system_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `params` varchar(5000) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `type` (`type`),
  KEY `addtime` (`addtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_tables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `cid` int(10) unsigned NOT NULL DEFAULT '0',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当前对应的订单id',
  `guest_num` tinyint(3) unsigned DEFAULT '0',
  `scan_num` int(10) unsigned NOT NULL DEFAULT '0',
  `qrcode` varchar(500) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid_sid` (`uniacid`,`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_tables_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `limit_price` varchar(20) NOT NULL,
  `reservation_price` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_tables_scan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` int(10) unsigned NOT NULL DEFAULT '0',
  `table_id` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `sid` (`sid`),
  KEY `table_id` (`table_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_text` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `agentid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `title` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiny_wmall_wxapp_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `isdefault` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `type` (`type`),
  KEY `addtime` (`addtime`),
  KEY `isdefault` (`isdefault`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'content')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `content` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'order_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `order_limit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'goods_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `goods_limit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'starthour')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `starthour` smallint(5) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'endhour')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `endhour` smallint(5) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'use_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `use_limit` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `status` varchar(20) NOT NULL DEFAULT 'ongoing';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain',  'total_updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD `total_updatetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'bargain_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `bargain_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `goods_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'discount_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `discount_price` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'max_buy_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `max_buy_limit` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'poi_user_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `poi_user_type` varchar(10) NOT NULL DEFAULT 'all';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'discount_total')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `discount_total` int(10) NOT NULL DEFAULT '-1';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'discount_available_total')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `discount_available_total` int(10) NOT NULL DEFAULT '-1';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'dosage')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `dosage` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_bargain_goods',  'mall_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD `mall_displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain_goods',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain_goods',  'bargain_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD KEY `bargain_id` (`bargain_id`);");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain_goods',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD KEY `goods_id` (`goods_id`);");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain_goods',  'mall_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD KEY `mall_displayorder` (`mall_displayorder`);");
}
if(!pdo_indexexists('tiny_wmall_activity_bargain_goods',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_bargain_goods')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '公号序号';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '公号序号';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `type` varchar(20) NOT NULL DEFAULT 'collect';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `discount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '折扣券(折扣率), 代金券(面额)';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `condition` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单满多少可用';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'type_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `type_limit` int(10) NOT NULL DEFAULT '1' COMMENT '1:所有用户都可领取,2:新用户可领取';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'dosage')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `dosage` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已领取数量';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'amount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `amount` int(10) unsigned NOT NULL COMMENT '总发行数量';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:可领取,2:暂停领取';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发行时间';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'activity_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `activity_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon',  'coupons')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD `coupons` varchar(1000) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD KEY `starttime` (`starttime`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD KEY `endtime` (`endtime`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon',  'activity_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon')." ADD KEY `activity_id` (`activity_id`);");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_grant_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_grant_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_grant_log',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_grant_log',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD `couponid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_grant_log',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD `uid` int(10) unsigned NOT NULL COMMENT '用户编号';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_grant_log',  'grant_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD `grant_type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态: 1:一次性领取,2:每天领取 ';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_grant_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_grant_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_grant_log',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_grant_log',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD KEY `couponid` (`couponid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_grant_log',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_grant_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_grant_log')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `couponid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `uid` int(10) unsigned NOT NULL COMMENT '用户编号';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `order_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'code')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `code` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态: 1:未使用,2:已使用 ';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `remark` varchar(300) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'granttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `granttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发放时间';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'usetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `usetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用时间';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `type` varchar(20) NOT NULL DEFAULT 'couponCollect';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `discount` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `condition` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `channel` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'is_notice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `is_notice` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_coupon_record',  'noticetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD `noticetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `couponid` (`couponid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'is_notice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `is_notice` (`is_notice`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `channel` (`channel`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'noticetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `noticetime` (`noticetime`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `endtime` (`endtime`);");
}
if(!pdo_indexexists('tiny_wmall_activity_coupon_record',  'uniacid_sid_uid_orderid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_coupon_record')." ADD KEY `uniacid_sid_uid_orderid` (`uniacid`,`sid`,`uid`,`order_id`);");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'activity_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `activity_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'super_share_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `super_share_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `channel` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `uid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `order_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'code')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `code` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `type` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'category_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `category_limit` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'times_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `times_limit` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `status` tinyint(3) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'is_show')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `is_show` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `remark` varchar(300) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'granttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `granttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'usetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `usetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'scene')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `scene` varchar(100) NOT NULL DEFAULT 'waimai';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'is_notice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `is_notice` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_activity_redpacket_record',  'noticetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD `noticetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'redpacketid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `redpacketid` (`activity_id`);");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'is_show')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `is_show` (`is_show`);");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'scene')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `scene` (`scene`);");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `endtime` (`endtime`);");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'is_notice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `is_notice` (`is_notice`);");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'noticetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `noticetime` (`noticetime`);");
}
if(!pdo_indexexists('tiny_wmall_activity_redpacket_record',  'uniacid_uid_orderid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_activity_redpacket_record')." ADD KEY `uniacid_uid_orderid` (`uniacid`,`uid`,`order_id`);");
}
if(!pdo_fieldexists('tiny_wmall_address',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_address',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_address',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_address',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `realname` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_address',  'sex')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `sex` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_address',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `mobile` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_address',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `name` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_address',  'address')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `address` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_address',  'number')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `number` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_address',  'location_x')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `location_x` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_address',  'location_y')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `location_y` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_address',  'is_default')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `is_default` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_address',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `type` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_address',  'mode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD `mode` varchar(20) NOT NULL DEFAULT 'favorite';");
}
if(!pdo_indexexists('tiny_wmall_address',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_address',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_address')." ADD KEY `uid` (`uid`);");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `displayorder` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `type` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `final_fee` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'days')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `days` tinyint(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `data` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `order_sn` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `pay_type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_advertise_trade',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD `is_pay` tinyint(3) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_advertise_trade',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_advertise_trade',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_advertise_trade',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD KEY `type` (`displayorder`);");
}
if(!pdo_indexexists('tiny_wmall_advertise_trade',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_advertise_trade',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD KEY `starttime` (`starttime`);");
}
if(!pdo_indexexists('tiny_wmall_advertise_trade',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_advertise_trade')." ADD KEY `endtime` (`endtime`);");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `realname` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `mobile` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'area')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `area` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'initial')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `initial` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `salt` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'password')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `password` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `status` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'sysset')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `sysset` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'pluginset')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `pluginset` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'account')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `account` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'amount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `amount` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `fee` varchar(5000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'geofence')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `geofence` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD `displayorder` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_agent',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_agent',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'trade_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `trade_type` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'order_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `order_type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'extra')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `extra` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `fee` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'amount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `amount` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_agent_current_log',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD `remark` varchar(255) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_agent_current_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_agent_current_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_current_log')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'trade_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `trade_no` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'get_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `get_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'take_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `take_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'account')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `account` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_agent_getcash_log',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD `channel` varchar(10) NOT NULL DEFAULT 'weixin';");
}
if(!pdo_indexexists('tiny_wmall_agent_getcash_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_agent_getcash_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_agent_getcash_log')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'queue_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `queue_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `mobile` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `openid` varchar(64) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'guest_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `guest_num` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'number')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `number` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'position')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `position` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'is_notify')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `is_notify` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_board',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD `createtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_assign_board',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_assign_board',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_board')." ADD KEY `sid` (`sid`);");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'guest_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `guest_num` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'notify_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `notify_num` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `starttime` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `endtime` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'prefix')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `prefix` varchar(10) NOT NULL COMMENT '前缀';");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'position')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `position` int(10) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_assign_queue',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '根据这个时间,判断是否将position重新至0';");
}
if(!pdo_indexexists('tiny_wmall_assign_queue',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_assign_queue',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_assign_queue')." ADD KEY `sid` (`sid`);");
}
if(!pdo_fieldexists('tiny_wmall_cache',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cache')." ADD `name` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_cache',  'value')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cache')." ADD `value` longtext NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_category',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD `type` varchar(20) NOT NULL DEFAULT 'member';");
}
if(!pdo_fieldexists('tiny_wmall_category',  'alias')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD `alias` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_category',  'score')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD `score` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_category',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD `title` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_category',  'color')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD `color` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_category',  'is_system')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD `is_system` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_category',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_category')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `title` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `nickname` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `openid` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `mobile` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'password')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `password` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `salt` varchar(6) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'token')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `token` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `updatetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'openid_wxapp')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `openid_wxapp` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_clerk',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_clerk',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_clerk',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_clerk',  'openid_wxapp')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD KEY `openid_wxapp` (`openid_wxapp`);");
}
if(!pdo_indexexists('tiny_wmall_clerk',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD KEY `openid` (`openid`);");
}
if(!pdo_indexexists('tiny_wmall_clerk',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_clerk')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_config',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_config')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_config',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_config')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_config',  'sysset')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_config')." ADD `sysset` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_config',  'pluginset')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_config')." ADD `pluginset` text NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_config',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_config')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD `uniacid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD `advname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_adv',  'wxapp_link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD `wxapp_link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD `displayorder` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_adv',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD `status` int(10) DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_creditshop_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_adv',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_adv')." ADD KEY `displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD `uniacid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD `name` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD `thumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD `displayorder` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD `status` tinyint(3) DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_category',  'advimg')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD `advimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_category',  'advurl')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD `advurl` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_category',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD `isrecommand` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_creditshop_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD KEY `displayorder` (`displayorder`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_category')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'category_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `category_id` int(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `type` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'old_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `old_price` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'chance')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `chance` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'totalday')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `totalday` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'use_credit1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `use_credit1` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'use_credit2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `use_credit2` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'description')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `description` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'credit2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `credit2` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_goods',  'redpacket')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD `redpacket` text NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_creditshop_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_goods',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_goods')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'credits')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `credits` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'itemcode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `itemcode` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'actualprice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `actualprice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'faceprice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `faceprice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'description')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `description` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'ordernum')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `ordernum` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'ordersn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `ordersn` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD `goods_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order')." ADD KEY `goods_id` (`goods_id`);");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `acid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `goods_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'goods_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `goods_type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `order_sn` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `pay_type` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `paytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `status` tinyint(3) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'total_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `total_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `discount_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `final_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'transaction_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `transaction_id` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'use_credit1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `use_credit1` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'use_credit2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `use_credit2` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'username')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `username` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `mobile` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'code')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `code` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'grant_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `grant_status` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_creditshop_order_new',  'use_credit1_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD `use_credit1_status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order_new',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order_new',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order_new',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order_new',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD KEY `paytime` (`paytime`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order_new',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD KEY `is_pay` (`is_pay`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order_new',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD KEY `pay_type` (`pay_type`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order_new',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_creditshop_order_new',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_creditshop_order_new')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_cube',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_cube',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_cube',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD `agentid` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_cube',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_cube',  'tips')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD `tips` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_cube',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_cube',  'link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD `link` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_cube',  'wxapp_link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD `wxapp_link` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_cube',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_cube',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_cube',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_cube')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards',  'days')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD `days` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards',  'price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD `price` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards',  'day_free_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD `day_free_limit` tinyint(3) unsigned NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards',  'delivery_fee_free_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD `delivery_fee_free_limit` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_delivery_cards',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `acid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `openid` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'ordersn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `ordersn` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'card_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `card_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `final_fee` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `pay_type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `paytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_delivery_cards_order',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_delivery_cards_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_delivery_cards_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_delivery_cards_order')." ADD KEY `uid` (`uid`);");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `title` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `nickname` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `openid` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `mobile` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'password')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `password` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `salt` varchar(6) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'sex')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `sex` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'age')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `age` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'credit1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `credit1` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'credit2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `credit2` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'groupid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `groupid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'token')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `token` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'work_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `work_status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'is_takeout')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `is_takeout` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'is_errander')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `is_errander` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'auth_info')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `auth_info` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'location_x')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `location_x` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'location_y')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `location_y` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'order_takeout_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `order_takeout_num` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'order_errander_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `order_errander_num` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'extra')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `extra` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'openid_wxapp')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `openid_wxapp` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'registration_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `registration_id` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'collect_max_takeout')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `collect_max_takeout` int(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'collect_max_errander')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `collect_max_errander` int(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'perm_transfer')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `perm_transfer` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'perm_cancel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `perm_cancel` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'fee_delivery')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `fee_delivery` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer',  'fee_getcash')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD `fee_getcash` varchar(500) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_deliveryer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer',  'work_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD KEY `work_status` (`work_status`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer',  'token')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD KEY `token` (`token`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer',  'is_takeout')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD KEY `is_takeout` (`is_takeout`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer',  'is_errander')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD KEY `is_errander` (`is_errander`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer',  'openid_wxapp')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD KEY `openid_wxapp` (`openid_wxapp`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD KEY `openid` (`openid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer',  'registration_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer')." ADD KEY `registration_id` (`registration_id`);");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'order_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `order_type` varchar(20) NOT NULL DEFAULT 'order';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'trade_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `trade_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:订单入账, 2: 申请提现';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'extra')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `extra` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `fee` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'amount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `amount` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `remark` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_current_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_current_log',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD KEY `deliveryer_id` (`deliveryer_id`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_current_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_current_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_current_log',  'trade_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_current_log')." ADD KEY `trade_type` (`trade_type`);");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'trade_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `trade_no` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'get_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `get_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'take_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `take_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '1:申请成功,2:申请中';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'account')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `account` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_getcash_log',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD `channel` varchar(10) NOT NULL DEFAULT 'weixin';");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_getcash_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_getcash_log',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD KEY `deliveryer_id` (`deliveryer_id`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_getcash_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_getcash_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_getcash_log')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_groups',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_groups')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_groups',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_groups')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_groups',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_groups')." ADD `title` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_groups',  'group_condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_groups')." ADD `group_condition` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_groups',  'delivery_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_groups')." ADD `delivery_fee` varchar(2000) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_groups',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_groups')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_groups',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_groups')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_groups',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_groups')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_location_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_location_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_location_log',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_location_log',  'location_x')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD `location_x` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_location_log',  'location_y')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD `location_y` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_location_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_location_log',  'addtime_cn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD `addtime_cn` varchar(50) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_location_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_location_log',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD KEY `deliveryer_id` (`deliveryer_id`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_location_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_location_log')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'order_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `order_type` varchar(20) NOT NULL DEFAULT 'takeout';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `order_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'reason')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `reason` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'stat_year')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `stat_year` smallint(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `stat_month` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_deliveryer_transfer_log',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD `stat_day` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_transfer_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_transfer_log',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD KEY `deliveryer_id` (`deliveryer_id`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_transfer_log',  'stat_year')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD KEY `stat_year` (`stat_year`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_transfer_log',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD KEY `stat_month` (`stat_month`);");
}
if(!pdo_indexexists('tiny_wmall_deliveryer_transfer_log',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_deliveryer_transfer_log')." ADD KEY `stat_day` (`stat_day`);");
}
if(!pdo_fieldexists('tiny_wmall_diypage',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_diypage',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_diypage',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD `type` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_diypage',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_diypage',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD `data` longtext NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_diypage',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_diypage',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD `updatetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_diypage',  'diymenu')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD `diymenu` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_diypage',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_diypage',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_diypage',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_fieldexists('tiny_wmall_diypage_menu',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_menu')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_diypage_menu',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_menu')." ADD `uniacid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_diypage_menu',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_menu')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_diypage_menu',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_menu')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_diypage_menu',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_menu')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_diypage_menu',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_menu')." ADD `updatetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_diypage_menu',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_menu')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_diypage_menu',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_menu')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_diypage_menu',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_menu')." ADD KEY `updatetime` (`updatetime`);");
}
if(!pdo_fieldexists('tiny_wmall_diypage_template',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_template')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_diypage_template',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_template')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_diypage_template',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_template')." ADD `type` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_diypage_template',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_template')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_diypage_template',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_template')." ADD `data` longtext NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_diypage_template',  'preview')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_template')." ADD `preview` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_diypage_template',  'code')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_template')." ADD `code` varchar(50) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_diypage_template',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_template')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_diypage_template',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_diypage_template')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'goods_thumbs_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `goods_thumbs_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'is_on_upload')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `is_on_upload` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `type` varchar(20) NOT NULL DEFAULT 'buy';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'label')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `label` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'labels')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `labels` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'delivery_within_days')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `delivery_within_days` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'start_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `start_fee` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'start_km')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `start_km` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'pre_km')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `pre_km` varchar(10) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'pre_km_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `pre_km_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'weight_fee_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `weight_fee_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'weight_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `weight_fee` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'multiaddress')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `multiaddress` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'tip_min')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `tip_min` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'tip_max')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `tip_max` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'group_discount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `group_discount` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'delivery_times')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `delivery_times` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'rule')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `rule` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'notice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `notice` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'deliveryers')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `deliveryers` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'goods_value_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `goods_value_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_category',  'distance_calculate_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD `distance_calculate_type` tinyint(3) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_errander_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_category',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_category')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `acid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'code')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `code` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `order_sn` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'order_channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `order_channel` varchar(20) NOT NULL DEFAULT 'wap';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'order_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `order_type` varchar(20) NOT NULL DEFAULT 'buy';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'order_cid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `order_cid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'goods_name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `goods_name` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'goods_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `goods_price` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'goods_weight')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `goods_weight` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'buy_username')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `buy_username` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'buy_sex')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `buy_sex` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'buy_mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `buy_mobile` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'buy_address')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `buy_address` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'buy_location_x')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `buy_location_x` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'buy_location_y')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `buy_location_y` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'accept_username')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `accept_username` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'accept_sex')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `accept_sex` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'accept_mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `accept_mobile` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'accept_address')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `accept_address` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'accept_location_x')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `accept_location_x` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'accept_location_y')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `accept_location_y` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'distance')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `distance` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_time` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `pay_type` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `paytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_handle_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_handle_type` varchar(15) NOT NULL DEFAULT 'wechat';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_assign_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_assign_time` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_instore_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_instore_time` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_success_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_success_time` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_success_location_x')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_success_location_x` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_success_location_y')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_success_location_y` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `status` tinyint(3) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'print_nums')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `print_nums` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_fee` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_tips')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_tips` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'total_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `total_fee` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `discount_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `final_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'deliveryer_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `deliveryer_fee` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'deliveryer_total_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `deliveryer_total_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'agent_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `agent_discount_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'agent_serve_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `agent_serve_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'agent_serve')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `agent_serve` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'agent_final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `agent_final_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'plateform_serve_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `plateform_serve_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'plateform_serve')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `plateform_serve` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'thumbs')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `thumbs` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `note` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'is_remind')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `is_remind` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'is_anonymous')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `is_anonymous` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'anonymous_username')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `anonymous_username` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'out_trade_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `out_trade_no` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'transaction_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `transaction_id` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'refund_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `refund_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'refund_out_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `refund_out_no` varchar(40) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'refund_apply_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `refund_apply_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'refund_success_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `refund_success_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'refund_channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `refund_channel` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'refund_account')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `refund_account` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'stat_year')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `stat_year` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `stat_month` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `stat_day` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'delivery_collect_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `delivery_collect_type` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'transfer_deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `transfer_deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order',  'transfer_delivery_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD `transfer_delivery_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `paytime` (`paytime`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `is_pay` (`is_pay`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `pay_type` (`pay_type`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'refund_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `refund_status` (`refund_status`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'delivery_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `delivery_status` (`delivery_status`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `deliveryer_id` (`deliveryer_id`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'stat_year')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `stat_year` (`stat_year`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `stat_month` (`stat_month`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `stat_day` (`stat_day`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'delivery_collect_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `delivery_collect_type` (`delivery_collect_type`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'transfer_deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `transfer_deliveryer_id` (`delivery_collect_type`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order',  'transfer_delivery_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order')." ADD KEY `transfer_delivery_status` (`delivery_collect_type`);");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `oid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `name` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'icon')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `icon` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `note` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'store_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `store_discount_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'agent_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `agent_discount_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_discount',  'plateform_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD `plateform_discount_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_errander_order_discount',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order_discount',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order_discount',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD KEY `oid` (`oid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order_discount',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_discount')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_status_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_status_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_status_log',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD `oid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_status_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_status_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD `type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_status_log',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD `title` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_status_log',  'note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD `note` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_order_status_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_errander_order_status_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order_status_log',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD KEY `oid` (`oid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order_status_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_errander_order_status_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_order_status_log')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `type` varchar(20) NOT NULL DEFAULT 'sence';");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'scene')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `scene` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `data` longtext NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'agreement')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `agreement` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `updatetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_errander_page',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD `isdefault` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_errander_page',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_errander_page',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_errander_page',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_errander_page',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD KEY `isdefault` (`isdefault`);");
}
if(!pdo_indexexists('tiny_wmall_errander_page',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_errander_page')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `thumb` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'max_partake_times')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `max_partake_times` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'partake_grant_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `partake_grant_type` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'reward_grant_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `reward_grant_type` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'redpacket_days_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'pre_partaker_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `pre_partaker_num` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'pre_partaker_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `pre_partaker_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'pre_reward_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `pre_reward_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'pre_max_partake_times')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `pre_max_partake_times` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'plus_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `plus_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'plus_thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `plus_thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'plus_partaker_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `plus_partaker_num` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'plus_reward_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `plus_reward_num` int(10) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'plus_pre_partaker_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `plus_pre_partaker_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'pre_plus_reward_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `pre_plus_reward_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'plus_pre_max_partake_times')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `plus_pre_max_partake_times` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'serial_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `serial_sn` int(10) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'plus_serial_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `plus_serial_sn` int(10) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'share')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `share` varchar(3000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'agreement')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `agreement` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_freelunch',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_freelunch',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD KEY `starttime` (`starttime`);");
}
if(!pdo_indexexists('tiny_wmall_freelunch',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch')." ADD KEY `endtime` (`endtime`);");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'freelunch_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `freelunch_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'record_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `record_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'serial_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `serial_sn` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'number')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `number` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `order_sn` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_partaker',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_freelunch_partaker',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_freelunch_partaker',  'freelunch_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD KEY `freelunch_id` (`freelunch_id`);");
}
if(!pdo_indexexists('tiny_wmall_freelunch_partaker',  'record_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD KEY `record_id` (`record_id`);");
}
if(!pdo_indexexists('tiny_wmall_freelunch_partaker',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_freelunch_partaker',  'serial_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_partaker')." ADD KEY `serial_sn` (`serial_sn`);");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'freelunch_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `freelunch_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'serial_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `serial_sn` int(10) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `type` varchar(20) NOT NULL DEFAULT 'common';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'partaker_total')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `partaker_total` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'partaker_dosage')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `partaker_dosage` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'partaker_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `partaker_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'reward_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `reward_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'reward_uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `reward_uid` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'reward_number')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `reward_number` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'startime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `startime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_freelunch_record',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_indexexists('tiny_wmall_freelunch_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_freelunch_record',  'freelunch_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD KEY `freelunch_id` (`freelunch_id`);");
}
if(!pdo_indexexists('tiny_wmall_freelunch_record',  'serial_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_freelunch_record')." ADD KEY `serial_sn` (`serial_sn`);");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'cid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `cid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `title` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `price` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'box_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `box_price` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'min_buy_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `min_buy_limit` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'is_options')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `is_options` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'unitname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `unitname` varchar(10) NOT NULL DEFAULT '份';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'total')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `total` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'sailed')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `sailed` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'is_hot')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `is_hot` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'slides')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `slides` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'label')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `label` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'description')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `description` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'comment_total')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `comment_total` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'comment_good')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `comment_good` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'print_label')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `print_label` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'child_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `child_id` int(20) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'number')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `number` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'old_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `old_price` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'total_warning')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `total_warning` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'total_update_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `total_update_type` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'content')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `content` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'attrs')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `attrs` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'elemeId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `elemeId` varchar(50) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'meituanId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `meituanId` varchar(50) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'openplateformCode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `openplateformCode` varchar(50) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'is_showtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `is_showtime` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'start_time1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `start_time1` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'end_time1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `end_time1` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'start_time2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `start_time2` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'end_time2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `end_time2` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods',  'week')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD `week` varchar(50) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'cid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `cid` (`cid`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `title` (`title`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'is_hot')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `is_hot` (`is_hot`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `displayorder` (`displayorder`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'elemeId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `elemeId` (`elemeId`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'meituanId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `meituanId` (`meituanId`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'openplateformCode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `openplateformCode` (`openplateformCode`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'child_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `child_id` (`child_id`);");
}
if(!pdo_indexexists('tiny_wmall_goods',  'is_showtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods')." ADD KEY `is_showtime` (`is_showtime`);");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'parentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `parentid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'min_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `min_fee` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'description')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `description` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'is_showtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `is_showtime` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'start_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `start_time` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'end_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `end_time` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'week')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `week` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods_category',  'elemeId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD `elemeId` varchar(50) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_goods_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_goods_category',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_goods_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_goods_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD KEY `displayorder` (`displayorder`);");
}
if(!pdo_indexexists('tiny_wmall_goods_category',  'elemeId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD KEY `elemeId` (`elemeId`);");
}
if(!pdo_indexexists('tiny_wmall_goods_category',  'is_showtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_category')." ADD KEY `is_showtime` (`is_showtime`);");
}
if(!pdo_fieldexists('tiny_wmall_goods_options',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_goods_options',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_options',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_options',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD `goods_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_options',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD `name` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods_options',  'price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD `price` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_goods_options',  'total')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD `total` int(10) NOT NULL DEFAULT '-1';");
}
if(!pdo_fieldexists('tiny_wmall_goods_options',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_goods_options',  'total_warning')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD `total_warning` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_goods_options',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_goods_options',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_goods_options',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_goods_options')." ADD KEY `goods_id` (`goods_id`);");
}
if(!pdo_fieldexists('tiny_wmall_help',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_help',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_help',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_help',  'content')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_help',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_help',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_help',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_help',  'click')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD `click` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_help',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD KEY `title` (`title`);");
}
if(!pdo_indexexists('tiny_wmall_help',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_help')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_lewaimai_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_lewaimai_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_lewaimai_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_lewaimai_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_lewaimai_log',  'storeidOrgoodsid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_lewaimai_log')." ADD `storeidOrgoodsid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_lewaimai_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_lewaimai_log')." ADD `type` varchar(50) NOT NULL DEFAULT 'goods';");
}
if(!pdo_fieldexists('tiny_wmall_lewaimai_log',  'img')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_lewaimai_log')." ADD `img` varchar(255) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_lewaimai_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_lewaimai_log')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_lewaimai_log',  'storeidOrgoodsid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_lewaimai_log')." ADD KEY `storeidOrgoodsid` (`storeidOrgoodsid`);");
}
if(!pdo_indexexists('tiny_wmall_lewaimai_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_lewaimai_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_member_footmark',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_member_footmark',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_member_footmark',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_member_footmark',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_member_footmark',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_member_footmark',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_member_footmark',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD `stat_day` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_member_footmark',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_member_footmark',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_member_footmark',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_member_footmark',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD KEY `stat_day` (`stat_day`);");
}
if(!pdo_indexexists('tiny_wmall_member_footmark',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_member_footmark',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_footmark')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_fieldexists('tiny_wmall_member_groups',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_groups')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_member_groups',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_groups')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_member_groups',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_groups')." ADD `title` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_member_groups',  'group_condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_groups')." ADD `group_condition` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_member_groups',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_groups')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_member_invoice',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_invoice')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_member_invoice',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_invoice')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_member_invoice',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_invoice')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_member_invoice',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_invoice')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_member_invoice',  'recognition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_invoice')." ADD `recognition` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_member_invoice',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_invoice')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_member_invoice',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_invoice')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_member_invoice',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_invoice')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_member_invoice',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_invoice')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `uid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `order_sn` varchar(40) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `fee` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `final_fee` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `type` varchar(15) NOT NULL DEFAULT 'credit';");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'tag')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `tag` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `is_pay` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `pay_type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `addtime` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_member_recharge',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD `paytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_member_recharge',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_member_recharge',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_member_recharge')." ADD KEY `uid` (`uid`);");
}
if(!pdo_fieldexists('tiny_wmall_members',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `nickname` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'sex')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `sex` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `realname` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `mobile` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'setmeal_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `setmeal_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'setmeal_day_free_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `setmeal_day_free_limit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'setmeal_starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `setmeal_starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'setmeal_endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `setmeal_endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'success_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `success_num` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'success_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `success_price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'cancel_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `cancel_num` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'cancel_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `cancel_price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'is_sys')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `is_sys` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:系统会员, 2:模块兼容会员';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'search_data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `search_data` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'groupid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `groupid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'mobile_audit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `mobile_audit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `salt` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'password')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `password` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'token')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `token` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'openid_wxapp')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `openid_wxapp` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'openid_qq')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `openid_qq` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'openid_wx')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `openid_wx` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'uid_qianfan')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `uid_qianfan` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'uid_majia')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `uid_majia` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'unionId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `unionId` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_members',  'credit1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `credit1` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'credit2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `credit2` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'register_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `register_type` varchar(20) NOT NULL DEFAULT 'wechat';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'success_first_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `success_first_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'success_last_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `success_last_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'cancel_first_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `cancel_first_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'cancel_last_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `cancel_last_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'is_spread')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `is_spread` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'spreadcredit2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `spreadcredit2` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'spread1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `spread1` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'spread2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `spread2` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'spreadfixed')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `spreadfixed` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'spread_groupid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `spread_groupid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'spread_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `spread_status` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'spreadtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `spreadtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'groupid_updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `groupid_updatetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'spread_groupid_change_from')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `spread_groupid_change_from` varchar(10) NOT NULL DEFAULT 'system';");
}
if(!pdo_fieldexists('tiny_wmall_members',  'setmeal_deliveryfee_free_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD `setmeal_deliveryfee_free_limit` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_members',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'cancel_first_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `cancel_first_time` (`cancel_first_time`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'cancel_last_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `cancel_last_time` (`cancel_last_time`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'success_first_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `success_first_time` (`success_first_time`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'success_last_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `success_last_time` (`success_last_time`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'uid_qianfan')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `uid_qianfan` (`uid_qianfan`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'is_spread')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `is_spread` (`is_spread`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'spead_groupid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `spead_groupid` (`spread_groupid`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'spead_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `spead_status` (`spread_status`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'spreadtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `spreadtime` (`spreadtime`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `openid` (`openid`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'uid_majia')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `uid_majia` (`uid_majia`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'spread1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `spread1` (`spread1`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'spread2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `spread2` (`spread2`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'openid_wxapp')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `openid_wxapp` (`openid_wxapp`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'unionId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `unionId` (`unionId`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'first_order_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `first_order_time` (`success_first_time`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'last_order_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `last_order_time` (`success_last_time`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'speadid1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `speadid1` (`spread1`);");
}
if(!pdo_indexexists('tiny_wmall_members',  'speadid2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_members')." ADD KEY `speadid2` (`spread2`);");
}
if(!pdo_fieldexists('tiny_wmall_news',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_news',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_news',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_news',  'cateid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `cateid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_news',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_news',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `desc` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_news',  'content')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_news',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `thumb` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_news',  'author')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `author` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_news',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_news',  'is_display')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `is_display` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_news',  'is_show_home')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `is_show_home` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_news',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_news',  'click')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD `click` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_news',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD KEY `title` (`title`);");
}
if(!pdo_indexexists('tiny_wmall_news',  'cateid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD KEY `cateid` (`cateid`);");
}
if(!pdo_indexexists('tiny_wmall_news',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_news',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_news_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news_category')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_news_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news_category')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_news_category',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news_category')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_news_category',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news_category')." ADD `title` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_news_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news_category')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_news_category',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news_category')." ADD `type` varchar(15) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_news_category',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news_category')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_news_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news_category')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_news_category',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_news_category')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `type` varchar(20) NOT NULL DEFAULT 'member';");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `title` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `link` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'wxapp_link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `wxapp_link` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'content')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_notice',  'description')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD `description` text NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_notice',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_notice',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_notice',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('tiny_wmall_notice_read_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice_read_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_notice_read_log',  'notice_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice_read_log')." ADD `notice_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_notice_read_log',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice_read_log')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_notice_read_log',  'is_new')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice_read_log')." ADD `is_new` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_indexexists('tiny_wmall_notice_read_log',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice_read_log')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_notice_read_log',  'notice_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice_read_log')." ADD KEY `notice_id` (`notice_id`);");
}
if(!pdo_indexexists('tiny_wmall_notice_read_log',  'is_new')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_notice_read_log')." ADD KEY `is_new` (`is_new`);");
}
if(!pdo_fieldexists('tiny_wmall_oauth_fans',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_oauth_fans')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_oauth_fans',  'appid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_oauth_fans')." ADD `appid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_oauth_fans',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_oauth_fans')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_oauth_fans',  'oauth_openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_oauth_fans')." ADD `oauth_openid` varchar(50) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_oauth_fans',  'appid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_oauth_fans')." ADD KEY `appid` (`appid`);");
}
if(!pdo_indexexists('tiny_wmall_oauth_fans',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_oauth_fans')." ADD KEY `openid` (`openid`);");
}
if(!pdo_indexexists('tiny_wmall_oauth_fans',  'oauth_openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_oauth_fans')." ADD KEY `oauth_openid` (`oauth_openid`);");
}
if(!pdo_fieldexists('tiny_wmall_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `acid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'groupid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `groupid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'order_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `order_type` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'ordersn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `ordersn` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'code')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `code` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'username')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `username` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'sex')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `sex` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `mobile` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'address')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `address` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'number')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `number` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'location_x')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `location_x` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'location_y')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `location_y` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `note` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `price` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `num` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_day` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_time` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `pay_type` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `paytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_assign_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_assign_time` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_success_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_success_time` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `status` tinyint(3) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '3:待配送, 4:配送中, 5: 配送成功, 6: 配送失败';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_type` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'is_comment')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `is_comment` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'print_nums')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `print_nums` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '外卖配送费';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'pack_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `pack_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'serve_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `serve_fee` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `discount_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'total_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `total_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `final_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'vip_free_delivery_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `vip_free_delivery_fee` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'invoice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `invoice` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'is_remind')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `is_remind` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'is_refund')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `is_refund` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'person_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `person_num` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'table_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `table_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'table_cid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `table_cid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'reserve_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `reserve_type` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'reserve_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `reserve_time` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'transaction_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `transaction_id` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'spread1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `spread1` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'spread2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `spread2` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'spreadbalance')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `spreadbalance` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'mall_first_order')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `mall_first_order` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'order_channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `order_channel` varchar(20) NOT NULL DEFAULT 'wap';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'serial_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `serial_sn` int(10) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'box_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `box_price` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'handletime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `handletime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'clerk_notify_collect_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `clerk_notify_collect_time` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'is_timeout')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `is_timeout` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_handle_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_handle_type` varchar(20) NOT NULL DEFAULT 'wechat';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_success_location_x')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_success_location_x` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_success_location_y')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_success_location_y` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'deliveryingtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `deliveryingtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_instore_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_instore_time` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'deliverysuccesstime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `deliverysuccesstime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'refund_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `refund_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'distance')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `distance` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'extra_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `extra_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'store_final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `store_final_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'store_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `store_discount_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'plateform_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `plateform_discount_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'plateform_serve')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `plateform_serve` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'plateform_serve_rate')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `plateform_serve_rate` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'plateform_serve_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `plateform_serve_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'plateform_delivery_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `plateform_delivery_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'plateform_deliveryer_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `plateform_deliveryer_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'agent_serve')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `agent_serve` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'agent_final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `agent_final_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'agent_serve_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `agent_serve_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'agent_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `agent_discount_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'refund_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `refund_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'out_trade_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `out_trade_no` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'stat_year')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `stat_year` smallint(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `stat_month` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `stat_day` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'last_notify_deliveryer_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `last_notify_deliveryer_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'last_notify_clerk_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `last_notify_clerk_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'notify_deliveryer_total')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `notify_deliveryer_total` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'notify_clerk_total')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `notify_clerk_total` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'elemeOrderId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `elemeOrderId` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'elemeDowngraded')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `elemeDowngraded` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'eleme_store_final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `eleme_store_final_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'meituanOrderId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `meituanOrderId` varchar(50) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'meituan_store_final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `meituan_store_final_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'order_plateform')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `order_plateform` varchar(20) NOT NULL DEFAULT 'we7_wmall';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'is_delete')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `is_delete` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_takegoods_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_takegoods_time` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'deliveryinstoretime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `deliveryinstoretime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'print_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `print_sn` varchar(100) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'stat_week')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `stat_week` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'meals_cn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `meals_cn` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order',  'delivery_collect_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `delivery_collect_type` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'transfer_deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `transfer_deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order',  'transfer_delivery_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD `transfer_delivery_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_order',  'uniacid_sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `uniacid_sid` (`uniacid`,`sid`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'delivery_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `delivery_status` (`delivery_status`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'delivery_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `delivery_type` (`delivery_type`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'order_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `order_type` (`order_type`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'refund_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `refund_status` (`refund_status`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `paytime` (`paytime`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `endtime` (`endtime`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `pay_type` (`pay_type`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'stat_year')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `stat_year` (`stat_year`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `stat_month` (`stat_month`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `stat_day` (`stat_day`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `is_pay` (`is_pay`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `deliveryer_id` (`deliveryer_id`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'clerk_notify_collect_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `clerk_notify_collect_time` (`clerk_notify_collect_time`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'handletime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `handletime` (`handletime`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'elemeOrderId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `elemeOrderId` (`elemeOrderId`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'order_plateform')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `order_plateform` (`order_plateform`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'elemeDowngraded')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `elemeDowngraded` (`elemeDowngraded`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'spread1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `spread1` (`spread1`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'spread2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `spread2` (`spread2`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'spreadbalance')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `spreadbalance` (`spreadbalance`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'meituanOrderId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `meituanOrderId` (`meituanOrderId`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'order_channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `order_channel` (`order_channel`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'print_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `print_sn` (`print_sn`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'print_nums')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `print_nums` (`print_nums`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'delivery_collect_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `delivery_collect_type` (`delivery_collect_type`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'transfer_deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `transfer_deliveryer_id` (`delivery_collect_type`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'transfer_delivery_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `transfer_delivery_status` (`delivery_collect_type`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'stat_week')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `stat_week` (`stat_week`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'meals_cn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `meals_cn` (`meals_cn`);");
}
if(!pdo_indexexists('tiny_wmall_order',  'is_remind')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order')." ADD KEY `is_remind` (`is_remind`);");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'groupid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `groupid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `num` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `paytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'box_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `box_price` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'original_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `original_price` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'original_data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `original_data` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_cart',  'bargain_use_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD `bargain_use_limit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_order_cart',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_cart',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_order_cart',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_cart')." ADD KEY `uid` (`uid`);");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `oid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'username')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `username` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `mobile` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'goods_quality')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `goods_quality` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'delivery_service')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `delivery_service` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'score')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `score` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `note` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `data` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'thumbs')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `thumbs` varchar(3000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'reply')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `reply` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'replytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `replytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `addtime` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'taste_score')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `taste_score` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'package_score')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `package_score` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'deliveryer_tag')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `deliveryer_tag` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_comment',  'is_share')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD `is_share` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_order_comment',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_comment',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_order_comment',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD KEY `oid` (`oid`);");
}
if(!pdo_indexexists('tiny_wmall_order_comment',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_order_comment',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_order_comment',  'delivery_service')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD KEY `delivery_service` (`delivery_service`);");
}
if(!pdo_indexexists('tiny_wmall_order_comment',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_comment')." ADD KEY `deliveryer_id` (`deliveryer_id`);");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `oid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `name` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'icon')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `icon` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `note` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'store_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `store_discount_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'agent_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `agent_discount_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_discount',  'plateform_discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD `plateform_discount_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_order_discount',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_discount',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_order_discount',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD KEY `oid` (`oid`);");
}
if(!pdo_indexexists('tiny_wmall_order_discount',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_discount')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('tiny_wmall_order_grant',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_grant',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant',  'max')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD `max` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant',  'continuous')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD `continuous` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant',  'sum')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD `sum` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD `updatetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_order_grant',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_grant',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_order_grant',  'continuous')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD KEY `continuous` (`continuous`);");
}
if(!pdo_indexexists('tiny_wmall_order_grant',  'sum')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD KEY `sum` (`sum`);");
}
if(!pdo_indexexists('tiny_wmall_order_grant',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant')." ADD KEY `updatetime` (`updatetime`);");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `oid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'days')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `days` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'grant')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `grant` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'credittype')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `credittype` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `type` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `stat_month` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_grant_record',  'mark')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD `mark` varchar(255) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_order_grant_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_grant_record',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_order_grant_record',  'times')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD KEY `times` (`days`);");
}
if(!pdo_indexexists('tiny_wmall_order_grant_record',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_order_grant_record',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_grant_record')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'plid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `plid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `orderid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'peerpay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `peerpay_type` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'peerpay_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `peerpay_price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'peerpay_maxprice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `peerpay_maxprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'peerpay_realprice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `peerpay_realprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'peerpay_selfpay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `peerpay_selfpay` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'peerpay_message')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `peerpay_message` varchar(500) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `createtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD `data` varchar(1000) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_order_peerpay',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_peerpay',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD KEY `orderid` (`orderid`);");
}
if(!pdo_indexexists('tiny_wmall_order_peerpay',  'plid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD KEY `plid` (`plid`);");
}
if(!pdo_indexexists('tiny_wmall_order_peerpay',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay')." ADD KEY `uid` (`uid`);");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'pid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `pid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `order_sn` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `uid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'uname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `uname` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'usay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `usay` varchar(500) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `final_fee` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `createtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `paytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'headimg')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `headimg` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'refundstatus')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `refundstatus` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'refundprice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `refundprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_order_peerpay_payinfo',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_order_peerpay_payinfo',  'pid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD KEY `pid` (`pid`);");
}
if(!pdo_indexexists('tiny_wmall_order_peerpay_payinfo',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD KEY `openid` (`openid`);");
}
if(!pdo_indexexists('tiny_wmall_order_peerpay_payinfo',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD KEY `order_sn` (`order_sn`);");
}
if(!pdo_indexexists('tiny_wmall_order_peerpay_payinfo',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_peerpay_payinfo')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `acid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `order_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `order_sn` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'order_channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `order_channel` varchar(20) NOT NULL DEFAULT 'wap';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'reason')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `reason` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `pay_type` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'out_trade_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `out_trade_no` varchar(60) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'out_refund_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `out_refund_no` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'apply_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `apply_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'handle_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `handle_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'success_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `success_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `channel` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund',  'account')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD `account` varchar(30) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_order_refund',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_refund',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_order_refund',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund')." ADD KEY `order_id` (`order_id`);");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'order_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `order_type` varchar(20) NOT NULL DEFAULT 'order';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `oid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `title` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `note` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_refund_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_order_refund_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_refund_log',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_order_refund_log',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_refund_log')." ADD KEY `oid` (`oid`);");
}
if(!pdo_fieldexists('tiny_wmall_order_remind_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_remind_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_remind_log',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD `oid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_remind_log',  'remindid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD `remindid` varchar(50) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_remind_log',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD `channel` varchar(15) NOT NULL DEFAULT 'system';");
}
if(!pdo_fieldexists('tiny_wmall_order_remind_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_remind_log',  'reply')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD `reply` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_remind_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD `addtime` int(10) unsigned NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_order_remind_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_order_remind_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_remind_log',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD KEY `oid` (`oid`);");
}
if(!pdo_indexexists('tiny_wmall_order_remind_log',  'remindid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD KEY `remindid` (`remindid`);");
}
if(!pdo_indexexists('tiny_wmall_order_remind_log',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_remind_log')." ADD KEY `channel` (`channel`);");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `oid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_cid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_cid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_num` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_title` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_unit_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_unit_price` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'print_label')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `print_label` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `addtime` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'option_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `option_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_discount_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_discount_num` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_number')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_number` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_category_title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_category_title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'goods_original_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `goods_original_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'bargain_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `bargain_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'total_update_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `total_update_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'order_plateform')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `order_plateform` varchar(20) NOT NULL DEFAULT 'we7_wmall';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'stat_year')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `stat_year` smallint(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `stat_month` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'stat_week')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `stat_week` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_stat',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD `stat_day` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_order_stat',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_stat',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_order_stat',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_order_stat',  'bargain_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD KEY `bargain_id` (`bargain_id`);");
}
if(!pdo_indexexists('tiny_wmall_order_stat',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_order_stat',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_order_stat',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD KEY `oid` (`oid`);");
}
if(!pdo_indexexists('tiny_wmall_order_stat',  'order_plateform')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_stat')." ADD KEY `order_plateform` (`order_plateform`);");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `oid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `title` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `note` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'role')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `role` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_order_status_log',  'role_cn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD `role_cn` varchar(50) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_order_status_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_order_status_log',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD KEY `oid` (`oid`);");
}
if(!pdo_indexexists('tiny_wmall_order_status_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_order_status_log')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `acid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'serial_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `serial_sn` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `order_sn` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `pay_type` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `is_pay` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `paytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `status` tinyint(3) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'total_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `total_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'no_discount_part')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `no_discount_part` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'discount_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `discount_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `final_fee` varchar(20) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'plateform_serve_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `plateform_serve_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'plateform_serve')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `plateform_serve` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'store_final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `store_final_fee` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'agent_serve_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `agent_serve_fee` varchar(10) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'agent_serve')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `agent_serve` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'agent_final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `agent_final_fee` varchar(10) DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'out_trade_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `out_trade_no` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'transaction_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `transaction_id` varchar(60) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'stat_year')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `stat_year` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `stat_month` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paybill_order',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD `stat_day` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'stat_year')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `stat_year` (`stat_year`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'stat_month')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `stat_month` (`stat_month`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'stat_day')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `stat_day` (`stat_day`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `paytime` (`paytime`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'is_pay')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `is_pay` (`is_pay`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `pay_type` (`pay_type`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_paybill_order',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paybill_order')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `order_sn` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `order_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'order_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `order_type` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `fee` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `paytime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'out_trade_order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `out_trade_order_id` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_paylog',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD `data` varchar(1000) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_paylog',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_paylog',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_paylog',  'order_sn')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD KEY `order_sn` (`order_sn`);");
}
if(!pdo_indexexists('tiny_wmall_paylog',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_paylog')." ADD KEY `order_id` (`order_id`);");
}
if(!pdo_fieldexists('tiny_wmall_perm_account',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_account')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_perm_account',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_account')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_perm_account',  'plugins')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_account')." ADD `plugins` text;");
}
if(!pdo_fieldexists('tiny_wmall_perm_account',  'max_store')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_account')." ADD `max_store` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_perm_account',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_account')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_perm_role',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_role')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_perm_role',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_role')." ADD `uniacid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_perm_role',  'rolename')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_role')." ADD `rolename` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_perm_role',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_role')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_perm_role',  'perms')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_role')." ADD `perms` text NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_perm_role',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_role')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_perm_user',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_perm_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD `uniacid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_perm_user',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD `uid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_perm_user',  'roleid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD `roleid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_perm_user',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_perm_user',  'perms')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD `perms` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_perm_user',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD `realname` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_perm_user',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD `mobile` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_indexexists('tiny_wmall_perm_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_perm_user',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD KEY `uid` (`uid`);");
}
if(!pdo_indexexists('tiny_wmall_perm_user',  'roleid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_perm_user')." ADD KEY `roleid` (`roleid`);");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `type` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `title` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'version')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `version` varchar(10) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'ability')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `ability` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `status` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_plugin',  'is_show')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD `is_show` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_indexexists('tiny_wmall_plugin',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_plugin')." ADD KEY `name` (`name`);");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `sid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `name` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `type` varchar(20) NOT NULL DEFAULT 'feie';");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'print_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `print_no` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'member_code')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `member_code` varchar(50) NOT NULL COMMENT '商户编号';");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'key')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `key` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'api_key')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `api_key` varchar(100) NOT NULL COMMENT '易联云打印机api_key';");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'print_nums')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `print_nums` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'print_label')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `print_label` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'is_print_all')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `is_print_all` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'qrcode_link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `qrcode_link` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'print_header')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `print_header` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'print_footer')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `print_footer` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'delivery_type_mine_193')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `delivery_type_mine_193` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_printer',  'qrcode_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD `qrcode_type` varchar(20) NOT NULL DEFAULT 'custom';");
}
if(!pdo_indexexists('tiny_wmall_printer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_printer',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer')." ADD KEY `sid` (`sid`);");
}
if(!pdo_fieldexists('tiny_wmall_printer_label',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer_label')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_printer_label',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer_label')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_printer_label',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer_label')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_printer_label',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer_label')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_printer_label',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer_label')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_printer_label',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer_label')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_printer_label',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_printer_label')." ADD KEY `sid` (`sid`);");
}
if(!pdo_fieldexists('tiny_wmall_reply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reply')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_reply',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reply')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_reply',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reply')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reply')." ADD `rid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_reply',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reply')." ADD `type` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_reply',  'table_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reply')." ADD `table_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_reply',  'extra')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reply')." ADD `extra` text NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_reply',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reply')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_report',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_report',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_report',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `acid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_report',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_report',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_report',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_report',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `mobile` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_report',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_report',  'note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `note` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_report',  'thumbs')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `thumbs` varchar(2000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_report',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_report',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_report',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_report',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_report',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_report',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_report')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_reserve',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reserve')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_reserve',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reserve')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_reserve',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reserve')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_reserve',  'time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reserve')." ADD `time` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_reserve',  'table_cid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reserve')." ADD `table_cid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_reserve',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reserve')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_reserve',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reserve')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_reserve',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_reserve')." ADD KEY `sid` (`sid`);");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'share_redpacket_condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `share_redpacket_condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'share_redpacket_min')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `share_redpacket_min` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'share_redpacket_max')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `share_redpacket_max` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'share_redpacket_days_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `share_redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'follow_redpacket_min')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `follow_redpacket_min` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'follow_redpacket_max')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `follow_redpacket_max` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'follow_redpacket_days_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `follow_redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'share')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `share` varchar(3000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'agreement')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `agreement` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_shareredpacket',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_shareredpacket',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'activity_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `activity_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'share_uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `share_uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'follow_uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `follow_uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'share_redpacket_condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `share_redpacket_condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'share_redpacket_discount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `share_redpacket_discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'share_redpacket_days_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `share_redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'follow_redpacket_condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `follow_redpacket_condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'follow_redpacket_discount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `follow_redpacket_discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'follow_redpacket_days_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `follow_redpacket_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_shareredpacket_invite_record',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_shareredpacket_invite_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_shareredpacket_invite_record',  'activity_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD KEY `activity_id` (`activity_id`);");
}
if(!pdo_indexexists('tiny_wmall_shareredpacket_invite_record',  'share_uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_shareredpacket_invite_record')." ADD KEY `share_uid` (`share_uid`);");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `title` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `link` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `type` varchar(20) NOT NULL DEFAULT 'homeTop';");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'wxapp_link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `wxapp_link` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_slide',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_slide',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_slide',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_slide',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_slide',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_slide')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_spread_current_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_spread_current_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_current_log',  'spreadid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD `spreadid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_current_log',  'trade_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD `trade_type` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_spread_current_log',  'extra')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD `extra` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_spread_current_log',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD `fee` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_spread_current_log',  'amount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD `amount` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_spread_current_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_current_log',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD `remark` varchar(255) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_spread_current_log',  'spreadid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD KEY `spreadid` (`spreadid`);");
}
if(!pdo_indexexists('tiny_wmall_spread_current_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_current_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'spreadid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `spreadid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'trade_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `trade_no` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'get_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `get_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'take_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `take_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `channel` varchar(20) NOT NULL DEFAULT 'wechat';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'account')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `account` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_getcash_log',  'channel_from')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD `channel_from` varchar(10) NOT NULL DEFAULT 'weixin';");
}
if(!pdo_indexexists('tiny_wmall_spread_getcash_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_spread_getcash_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_spread_getcash_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_spread_getcash_log',  'spreadid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_getcash_log')." ADD KEY `spreadid` (`spreadid`);");
}
if(!pdo_fieldexists('tiny_wmall_spread_groups',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_groups')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_spread_groups',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_groups')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_groups',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_groups')." ADD `title` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_spread_groups',  'commission1')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_groups')." ADD `commission1` varchar(20) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_groups',  'commission2')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_groups')." ADD `commission2` varchar(20) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_spread_groups',  'group_condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_groups')." ADD `group_condition` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_spread_groups',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_spread_groups')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_store',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'cid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `cid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `title` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'logo')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `logo` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'telephone')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `telephone` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'business_hours')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `business_hours` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'is_in_business')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `is_in_business` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'description')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `description` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'send_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `send_price` smallint(5) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_price` varchar(255) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_free_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_free_price` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'pack_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `pack_price` float(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:商家配送,2:到店自提,3:两种都支持';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_within_days')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_within_days` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_reserve_days')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_reserve_days` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'serve_radius')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `serve_radius` varchar(30) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'serve_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `serve_fee` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_area')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_area` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'thumbs')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `thumbs` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'address')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `address` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'location_x')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `location_x` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'location_y')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `location_y` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'sns')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `sns` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'notice')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `notice` varchar(100) NOT NULL COMMENT '公告';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'tips')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `tips` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'content')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `content` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'payment')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `payment` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'invoice_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `invoice_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'token_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `token_status` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'remind_time_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `remind_time_limit` tinyint(3) unsigned NOT NULL DEFAULT '10';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'remind_reply')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `remind_reply` varchar(1500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'comment_reply')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `comment_reply` varchar(2000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'sailed')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `sailed` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'score')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `score` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'first_order_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `first_order_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'discount_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `discount_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'grant_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `grant_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'bargain_price_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `bargain_price_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'reserve_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `reserve_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'collect_coupon_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `collect_coupon_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'grant_coupon_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `grant_coupon_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'comment_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `comment_status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '评论审核.1:直接通过';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'sms_use_times')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `sms_use_times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '短信使用条数';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'wechat_qrcode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `wechat_qrcode` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'custom_url')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `custom_url` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'addtype')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `addtype` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:后台添加,2:申请入驻';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'template')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `template` varchar(20) NOT NULL DEFAULT 'index';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'not_in_serve_radius')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `not_in_serve_radius` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'auto_handel_order')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `auto_handel_order` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'auto_get_address')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `auto_get_address` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'auto_notice_deliveryer')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `auto_notice_deliveryer` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'click')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `click` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'is_recommend')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `is_recommend` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'is_assign')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `is_assign` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'is_reserve')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `is_reserve` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'is_meal')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `is_meal` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'forward_mode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `forward_mode` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'assign_mode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `assign_mode` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'assign_qrcode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `assign_qrcode` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_mode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_mode` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'order_note')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `order_note` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'is_rest')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `is_rest` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'is_stick')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `is_stick` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'position')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `position` tinyint(3) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'is_paybill')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `is_paybill` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'forward_url')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `forward_url` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_fee_mode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_fee_mode` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_times')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_times` varchar(7000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_areas')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_areas` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'qualification')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `qualification` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'label')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `label` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'push_token')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `push_token` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'self_audit_comment')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `self_audit_comment` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'delivery_extra')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `delivery_extra` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'elemeShopId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `elemeShopId` varchar(30) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'eleme_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `eleme_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'meituanShopId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `meituanShopId` varchar(30) DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'meituan_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `meituan_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'openplateform_extra')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `openplateform_extra` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store',  'deltime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `deltime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'remind_time_start')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `remind_time_start` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store',  'consume_per_person')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD `consume_per_person` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_store',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `title` (`title`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'is_recommend')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `is_recommend` (`is_recommend`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'cid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `cid` (`cid`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'label')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `label` (`label`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `displayorder` (`displayorder`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'is_stick')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `is_stick` (`is_stick`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'elemeShopId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `elemeShopId` (`elemeShopId`);");
}
if(!pdo_indexexists('tiny_wmall_store',  'meituanShopId')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store')." ADD KEY `meituanShopId` (`meituanShopId`);");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'amount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `amount` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_limit` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_rate')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_rate` varchar(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_min')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_min` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_max')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_max` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'wechat')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `wechat` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_takeout')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_takeout` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_selfDelivery')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_selfDelivery` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_instore')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_instore` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_paybill')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_paybill` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_eleme')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_eleme` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_meituan')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_meituan` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_goods')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_goods` varchar(10000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_account',  'fee_period')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD `fee_period` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_store_account',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_account',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_store_account',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_account')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `data` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_activity',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_store_activity',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_activity',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_store_activity',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_store_activity',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('tiny_wmall_store_activity',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD KEY `starttime` (`starttime`);");
}
if(!pdo_indexexists('tiny_wmall_store_activity',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_activity')." ADD KEY `endtime` (`endtime`);");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `link` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'wxapp_link')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `wxapp_link` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'slide_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `slide_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'slide')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `slide` varchar(1500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'nav_status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `nav_status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'nav')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `nav` varchar(1500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_indexexists('tiny_wmall_store_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_category',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_indexexists('tiny_wmall_store_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_category')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('tiny_wmall_store_clerk',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_clerk',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_clerk',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_clerk',  'clerk_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD `clerk_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_clerk',  'role')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD `role` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_clerk',  'extra')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD `extra` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_clerk',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_store_clerk',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_clerk',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_store_clerk',  'clerk_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_clerk')." ADD KEY `clerk_id` (`clerk_id`);");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'trade_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `trade_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:订单入账, 2: 申请提现';");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'extra')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `extra` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `fee` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'amount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `amount` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `remark` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_current_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_store_current_log',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_store_current_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_current_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_current_log')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_store_deliveryer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_deliveryer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_deliveryer',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_deliveryer',  'deliveryer_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD `deliveryer_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_deliveryer',  'delivery_type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD `delivery_type` tinyint(3) unsigned NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists('tiny_wmall_store_deliveryer',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_deliveryer',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_store_deliveryer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_deliveryer',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_store_deliveryer',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_deliveryer')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_store_favorite',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_favorite')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_favorite',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_favorite')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_favorite',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_favorite')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_favorite',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_favorite')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_favorite',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_favorite')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_store_favorite',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_favorite')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_favorite',  'uid_sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_favorite')." ADD KEY `uid_sid` (`uid`,`sid`);");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'trade_no')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `trade_no` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'get_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `get_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'take_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `take_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'final_fee')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `final_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'account')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `account` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '1:申请成功,2:申请中';");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_getcash_log',  'channel')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD `channel` varchar(10) NOT NULL DEFAULT 'weixin';");
}
if(!pdo_indexexists('tiny_wmall_store_getcash_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_getcash_log',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_store_getcash_log',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_getcash_log')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'first_order_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `first_order_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'last_order_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `last_order_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'success_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `success_num` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'success_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `success_price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'cancel_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `cancel_num` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'cancel_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `cancel_price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'is_sys')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `is_sys` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:系统会员, 2:模块兼容会员';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'success_first_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `success_first_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'success_last_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `success_last_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'cancel_first_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `cancel_first_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_members',  'cancel_last_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD `cancel_last_time` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_store_members',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_store_members',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_members',  'first_order_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD KEY `first_order_time` (`success_first_time`);");
}
if(!pdo_indexexists('tiny_wmall_store_members',  'last_order_time')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_members')." ADD KEY `last_order_time` (`success_last_time`);");
}
if(!pdo_fieldexists('tiny_wmall_store_page',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_store_page',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_page',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_page',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD `name` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_page',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD `type` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_store_page',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_store_page',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD `data` longtext NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_store_page',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_store_page',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_store_page',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_store_page')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `uniacid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `type` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'grant_object')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `grant_object` longtext NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_superredpacket',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_superredpacket',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_superredpacket',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_grant',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_grant',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD `uniacid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_grant',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD `uid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_grant',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD `order_id` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_grant',  'activity_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD `activity_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_grant',  'packet_dosage')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD `packet_dosage` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_grant',  'packet_total')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD `packet_total` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_grant',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_superredpacket_grant',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_superredpacket_grant',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_grant')." ADD KEY `order_id` (`order_id`);");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `uniacid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'activity_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `activity_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'condition')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `condition` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'grant_days_effect')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `grant_days_effect` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'use_days_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `use_days_limit` tinyint(3) unsigned NOT NULL DEFAULT '3';");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'times_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `times_limit` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'category_limit')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `category_limit` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_superredpacket_share',  'nums')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD `nums` int(10) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_indexexists('tiny_wmall_superredpacket_share',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_superredpacket_share')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('tiny_wmall_system_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_system_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_system_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD `type` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_system_log',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_system_log',  'params')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD `params` varchar(5000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_system_log',  'message')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD `message` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_system_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_system_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_system_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_system_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_system_log')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'cid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `cid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'order_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当前对应的订单id';");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'guest_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `guest_num` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'scan_num')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `scan_num` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'qrcode')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `qrcode` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'status')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('tiny_wmall_tables',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD `createtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_tables',  'uniacid_sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables')." ADD KEY `uniacid_sid` (`uniacid`,`sid`);");
}
if(!pdo_fieldexists('tiny_wmall_tables_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_category')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_tables_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_category')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables_category',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_category')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables_category',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_category')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_tables_category',  'limit_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_category')." ADD `limit_price` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_tables_category',  'reservation_price')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_category')." ADD `reservation_price` varchar(20) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_tables_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_category')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_tables_category',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_category')." ADD KEY `sid` (`sid`);");
}
if(!pdo_fieldexists('tiny_wmall_tables_scan',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_tables_scan',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables_scan',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD `sid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables_scan',  'table_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD `table_id` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_tables_scan',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_tables_scan',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD `nickname` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_tables_scan',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_tables_scan',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD `createtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_tables_scan',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_tables_scan',  'sid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD KEY `sid` (`sid`);");
}
if(!pdo_indexexists('tiny_wmall_tables_scan',  'table_id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_tables_scan')." ADD KEY `table_id` (`table_id`);");
}
if(!pdo_fieldexists('tiny_wmall_text',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_text')." ADD `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_text',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_text')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_text',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_text')." ADD `agentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_text',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_text')." ADD `name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_text',  'value')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_text')." ADD `value` text NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_text',  'title')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_text')." ADD `title` varchar(20) NOT NULL;");
}
if(!pdo_indexexists('tiny_wmall_text',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_text')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_text',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_text')." ADD KEY `agentid` (`agentid`);");
}
if(!pdo_fieldexists('tiny_wmall_wxapp_page',  'id')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('tiny_wmall_wxapp_page',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_wxapp_page',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD `type` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_wxapp_page',  'name')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('tiny_wmall_wxapp_page',  'data')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD `data` longtext NOT NULL;");
}
if(!pdo_fieldexists('tiny_wmall_wxapp_page',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD `addtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_wxapp_page',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD `updatetime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('tiny_wmall_wxapp_page',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD `isdefault` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('tiny_wmall_wxapp_page',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('tiny_wmall_wxapp_page',  'type')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD KEY `type` (`type`);");
}
if(!pdo_indexexists('tiny_wmall_wxapp_page',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD KEY `addtime` (`addtime`);");
}
if(!pdo_indexexists('tiny_wmall_wxapp_page',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('tiny_wmall_wxapp_page')." ADD KEY `isdefault` (`isdefault`);");
}

?>