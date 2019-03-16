<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_dg_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `credit` varchar(255) DEFAULT '0',
  `pcate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '一级分类',
  `ccate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二级分类',
  `clickNum` int(10) unsigned NOT NULL DEFAULT '0',
  `zanNum` int(10) unsigned NOT NULL DEFAULT '0',
  `thumb` varchar(500) NOT NULL DEFAULT '' COMMENT '缩略图',
  `description` mediumtext NOT NULL COMMENT '简介',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `author` varchar(100) DEFAULT '' COMMENT '作者',
  `type` varchar(10) NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `tel` varchar(15) NOT NULL,
  `pay_money` decimal(10,2) unsigned DEFAULT '0.00',
  `author_id` int(11) DEFAULT NULL COMMENT '作者id',
  `pay_num` int(11) DEFAULT NULL COMMENT '虚拟支付人数',
  `bg_music` varchar(250) DEFAULT NULL COMMENT '背景音乐',
  `bg_music_set` tinyint(4) DEFAULT '1' COMMENT '背景音乐开启',
  `status` tinyint(4) DEFAULT '1' COMMENT '课程状态',
  `key` varchar(20) DEFAULT NULL COMMENT '作者发布参数',
  `wailian` varchar(300) DEFAULT NULL COMMENT '外链',
  `appoint` tinyint(4) DEFAULT '1' COMMENT '指定用户不开启',
  `appo_users` varchar(300) DEFAULT NULL COMMENT '分组id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_adv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `displayorder` int(11) DEFAULT NULL COMMENT '排序',
  `adg_name` varchar(200) DEFAULT NULL COMMENT '幻灯片名字',
  `adv_img` varchar(300) DEFAULT NULL COMMENT '幻灯片',
  `adv_href` varchar(250) DEFAULT NULL COMMENT '幻灯片链接',
  `adv_status` tinyint(4) DEFAULT NULL COMMENT '显示状态',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_author` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `openid` varchar(255) DEFAULT NULL COMMENT '用户openid',
  `realname` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `mobile` varchar(64) DEFAULT NULL COMMENT '手机号',
  `money` decimal(10,2) DEFAULT NULL COMMENT '余额',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  `scale` decimal(5,2) DEFAULT NULL COMMENT '抽成比例',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `thumb` varchar(1024) NOT NULL DEFAULT '' COMMENT '分类图片',
  `kid` int(10) unsigned NOT NULL COMMENT '关键词ID',
  `rid` int(10) unsigned NOT NULL COMMENT 'rid',
  `type` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '分类描述',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_collect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `article_id` int(11) DEFAULT NULL COMMENT '课程id',
  `uid` int(11) DEFAULT NULL COMMENT '个人中心id',
  `openid` varchar(255) DEFAULT NULL COMMENT '用户OPENID',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_dis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `aritcle_id` int(11) NOT NULL COMMENT '课程ID',
  `openid` varchar(100) NOT NULL COMMENT 'openid',
  `nickname` varchar(200) NOT NULL COMMENT '昵称',
  `avatar` varchar(300) NOT NULL COMMENT '头像',
  `discuss` text COMMENT '评论',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '显示状态',
  `reply` text COMMENT '作者回复',
  `zannum` int(11) DEFAULT NULL COMMENT '评论点赞数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_diszan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号ID',
  `disid` int(11) DEFAULT NULL COMMENT '评论id',
  `artid` int(11) DEFAULT NULL COMMENT '课程id',
  `openid` varchar(200) DEFAULT NULL COMMENT '用户id',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `groupname` varchar(250) NOT NULL COMMENT '分组名称',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `userid` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_income` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `author_id` int(11) NOT NULL COMMENT '作者ID',
  `income_money` decimal(10,2) DEFAULT NULL COMMENT '提现金额',
  `income_time` int(11) DEFAULT NULL COMMENT '提现时间',
  `income_status` tinyint(4) DEFAULT NULL COMMENT '提现状态',
  `createtime` int(11) DEFAULT NULL COMMENT '申请提现时间',
  `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号',
  `batch_num` varchar(100) DEFAULT NULL COMMENT '批次号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_navi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `navi_name` varchar(50) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `create_time` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `redi_url` varchar(255) DEFAULT NULL,
  `url_type` int(10) DEFAULT '1',
  `in_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `article_id` int(10) unsigned NOT NULL COMMENT '课程ID',
  `openid` varchar(40) NOT NULL COMMENT '支付人',
  `oauth_openid` varchar(40) DEFAULT NULL,
  `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号',
  `out_trade_no` varchar(100) DEFAULT NULL,
  `pay_money` decimal(10,2) DEFAULT '0.00' COMMENT '支付金额',
  `order_status` tinyint(3) DEFAULT '0' COMMENT '支付状态',
  `pay_time` int(11) DEFAULT NULL COMMENT '支付时间',
  `fromer` varchar(250) DEFAULT NULL COMMENT '分享者openid',
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `openid` varchar(100) NOT NULL COMMENT '用户ID',
  `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号',
  `out_trade_no` varchar(200) DEFAULT NULL,
  `recharge` decimal(10,2) DEFAULT NULL COMMENT '购买会员的金额',
  `rec_time` int(11) DEFAULT NULL COMMENT '支付时间',
  `rec_status` tinyint(3) DEFAULT NULL COMMENT '支付状态',
  `month` int(11) DEFAULT NULL COMMENT '月份',
  `mode` tinyint(4) NOT NULL DEFAULT '1' COMMENT '付费方式,3为年付费,2位季度付费,1位月付费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_serialize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uniacid` int(11) NOT NULL,
  `author_openid` varchar(255) DEFAULT NULL COMMENT 'openid',
  `author_nickname` varchar(255) DEFAULT NULL,
  `author_avatar` varchar(200) DEFAULT NULL,
  `serialize_title` varchar(200) DEFAULT NULL,
  `serialize_img` varchar(255) DEFAULT NULL,
  `serialize_desc` varchar(255) DEFAULT NULL,
  `serialize_price` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `pcate` int(255) DEFAULT NULL,
  `ccate` int(10) DEFAULT NULL,
  `displayorder` int(10) DEFAULT NULL,
  `pay_num` int(10) DEFAULT NULL,
  `bg_music` varchar(255) DEFAULT NULL,
  `bg_music_set` int(10) DEFAULT NULL,
  `recommend` int(10) DEFAULT '1',
  `status` int(10) DEFAULT '1',
  `clickNum` int(10) DEFAULT '0',
  `free_chapter` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_serializedis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `serialize_id` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `discuss` varchar(255) DEFAULT NULL,
  `reply_id` int(11) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `status` int(10) DEFAULT '1' COMMENT '2 显示   1不显示',
  `formId` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_serializefb` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `serialize_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '专栏id',
  `clickNum` int(10) unsigned NOT NULL DEFAULT '0',
  `zanNum` int(10) unsigned NOT NULL DEFAULT '0',
  `thumb` varchar(500) NOT NULL DEFAULT '' COMMENT '缩略图',
  `description` mediumtext NOT NULL COMMENT '简介',
  `createtime` int(15) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `bg_music` varchar(250) DEFAULT NULL COMMENT '背景音乐',
  `bg_music_set` tinyint(4) DEFAULT '1' COMMENT '背景音乐开启',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '课程状态',
  `wailian` varchar(300) DEFAULT NULL COMMENT '外链',
  `appoint` tinyint(4) NOT NULL DEFAULT '1' COMMENT '指定状态',
  `free_chapter` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_shang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `article_id` int(11) NOT NULL COMMENT '课程ID',
  `openid` varchar(255) DEFAULT NULL COMMENT 'openid',
  `oauth_openid` varchar(255) DEFAULT NULL COMMENT '借权openid',
  `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号',
  `out_trade_no` varchar(200) DEFAULT NULL,
  `shang_money` decimal(10,2) DEFAULT NULL COMMENT '支付金额',
  `shang_status` tinyint(4) DEFAULT NULL COMMENT '赞赏状态',
  `shang_time` int(11) DEFAULT NULL COMMENT '赞赏时间',
  `headimg` varchar(255) NOT NULL COMMENT '用户头像',
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_share` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `sharetitle` varchar(255) NOT NULL COMMENT '分享标题',
  `shareimg` varchar(255) NOT NULL COMMENT '分享图片',
  `sharedesc` varchar(255) NOT NULL COMMENT '分享描述',
  `createtime` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS `ims_dg_article_sharep` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `openid` varchar(250) NOT NULL COMMENT '用户openid',
  `share_money` decimal(10,2) DEFAULT NULL COMMENT '金额',
  `share_time` int(11) DEFAULT NULL COMMENT '时间',
  `share_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `createtime` int(11) DEFAULT NULL COMMENT '申请提现时间',
  `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号',
  `batch_num` varchar(200) DEFAULT NULL COMMENT '批次号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `openid` varchar(255) NOT NULL COMMENT '用户的ID',
  `nickname` varchar(255) NOT NULL COMMENT '用户昵称',
  `avatar` varchar(255) NOT NULL COMMENT '用户头像',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  `realname` varchar(255) DEFAULT NULL COMMENT '姓名',
  `mobile` varchar(100) DEFAULT NULL COMMENT '手机号',
  `desc` varchar(500) DEFAULT NULL COMMENT '详细信息',
  `info_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户状态信息',
  `sex` tinyint(4) DEFAULT NULL COMMENT '用户性别',
  `end_time` int(11) DEFAULT NULL COMMENT '会员到期时间',
  `mode` tinyint(4) NOT NULL DEFAULT '1' COMMENT '付费方式,3为年付费,2位季度付费,1位月付费',
  `setmem` tinyint(4) DEFAULT NULL COMMENT '设置会员者,1为管理员,2为微信支付',
  `settime` int(11) DEFAULT NULL COMMENT '操作时间记录',
  `timeset` int(11) DEFAULT NULL COMMENT '会员时间设置',
  `zfb` varchar(255) DEFAULT NULL COMMENT '支付宝',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dg_article_vipconfig` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `day` int(10) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT NULL,
  `status` int(10) DEFAULT NULL COMMENT '1=显示，2=隐藏',
  `type` int(10) DEFAULT NULL COMMENT '0=普通；1=永久',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('dg_article',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('dg_article',  'title')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dg_article',  'content')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists('dg_article',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `credit` varchar(255) DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article',  'pcate')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `pcate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '一级分类';");
}
if(!pdo_fieldexists('dg_article',  'ccate')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `ccate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二级分类';");
}
if(!pdo_fieldexists('dg_article',  'clickNum')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `clickNum` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article',  'zanNum')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `zanNum` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `thumb` varchar(500) NOT NULL DEFAULT '' COMMENT '缩略图';");
}
if(!pdo_fieldexists('dg_article',  'description')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `description` mediumtext NOT NULL COMMENT '简介';");
}
if(!pdo_fieldexists('dg_article',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `createtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists('dg_article',  'author')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `author` varchar(100) DEFAULT '' COMMENT '作者';");
}
if(!pdo_fieldexists('dg_article',  'type')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `type` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('dg_article',  'kid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `kid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('dg_article',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('dg_article',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `tel` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('dg_article',  'pay_money')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `pay_money` decimal(10,2) unsigned DEFAULT '0.00';");
}
if(!pdo_fieldexists('dg_article',  'author_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `author_id` int(11) DEFAULT NULL COMMENT '作者id';");
}
if(!pdo_fieldexists('dg_article',  'pay_num')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `pay_num` int(11) DEFAULT NULL COMMENT '虚拟支付人数';");
}
if(!pdo_fieldexists('dg_article',  'bg_music')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `bg_music` varchar(250) DEFAULT NULL COMMENT '背景音乐';");
}
if(!pdo_fieldexists('dg_article',  'bg_music_set')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `bg_music_set` tinyint(4) DEFAULT '1' COMMENT '背景音乐开启';");
}
if(!pdo_fieldexists('dg_article',  'status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `status` tinyint(4) DEFAULT '1' COMMENT '课程状态';");
}
if(!pdo_fieldexists('dg_article',  'key')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `key` varchar(20) DEFAULT NULL COMMENT '作者发布参数';");
}
if(!pdo_fieldexists('dg_article',  'wailian')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `wailian` varchar(300) DEFAULT NULL COMMENT '外链';");
}
if(!pdo_fieldexists('dg_article',  'appoint')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `appoint` tinyint(4) DEFAULT '1' COMMENT '指定用户不开启';");
}
if(!pdo_fieldexists('dg_article',  'appo_users')) {
	pdo_query("ALTER TABLE ".tablename('dg_article')." ADD `appo_users` varchar(300) DEFAULT NULL COMMENT '分组id';");
}
if(!pdo_fieldexists('dg_article_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_adv')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_adv')." ADD `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists('dg_article_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_adv')." ADD `displayorder` int(11) DEFAULT NULL COMMENT '排序';");
}
if(!pdo_fieldexists('dg_article_adv',  'adg_name')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_adv')." ADD `adg_name` varchar(200) DEFAULT NULL COMMENT '幻灯片名字';");
}
if(!pdo_fieldexists('dg_article_adv',  'adv_img')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_adv')." ADD `adv_img` varchar(300) DEFAULT NULL COMMENT '幻灯片';");
}
if(!pdo_fieldexists('dg_article_adv',  'adv_href')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_adv')." ADD `adv_href` varchar(250) DEFAULT NULL COMMENT '幻灯片链接';");
}
if(!pdo_fieldexists('dg_article_adv',  'adv_status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_adv')." ADD `adv_status` tinyint(4) DEFAULT NULL COMMENT '显示状态';");
}
if(!pdo_fieldexists('dg_article_adv',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_adv')." ADD `createtime` int(11) DEFAULT NULL COMMENT '时间';");
}
if(!pdo_fieldexists('dg_article_author',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';");
}
if(!pdo_fieldexists('dg_article_author',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `uniacid` int(11) NOT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists('dg_article_author',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `avatar` varchar(255) DEFAULT NULL COMMENT '头像';");
}
if(!pdo_fieldexists('dg_article_author',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `nickname` varchar(255) DEFAULT NULL COMMENT '昵称';");
}
if(!pdo_fieldexists('dg_article_author',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `openid` varchar(255) DEFAULT NULL COMMENT '用户openid';");
}
if(!pdo_fieldexists('dg_article_author',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `realname` varchar(255) DEFAULT NULL COMMENT '真实姓名';");
}
if(!pdo_fieldexists('dg_article_author',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `mobile` varchar(64) DEFAULT NULL COMMENT '手机号';");
}
if(!pdo_fieldexists('dg_article_author',  'money')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `money` decimal(10,2) DEFAULT NULL COMMENT '余额';");
}
if(!pdo_fieldexists('dg_article_author',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `createtime` int(11) DEFAULT NULL COMMENT '时间';");
}
if(!pdo_fieldexists('dg_article_author',  'scale')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_author')." ADD `scale` decimal(5,2) DEFAULT NULL COMMENT '抽成比例';");
}
if(!pdo_fieldexists('dg_article_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists('dg_article_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `name` varchar(50) NOT NULL COMMENT '分类名称';");
}
if(!pdo_fieldexists('dg_article_category',  'parentid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级';");
}
if(!pdo_fieldexists('dg_article_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists('dg_article_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `thumb` varchar(1024) NOT NULL DEFAULT '' COMMENT '分类图片';");
}
if(!pdo_fieldexists('dg_article_category',  'kid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `kid` int(10) unsigned NOT NULL COMMENT '关键词ID';");
}
if(!pdo_fieldexists('dg_article_category',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `rid` int(10) unsigned NOT NULL COMMENT 'rid';");
}
if(!pdo_fieldexists('dg_article_category',  'type')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `type` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('dg_article_category',  'description')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `description` varchar(100) NOT NULL DEFAULT '' COMMENT '分类描述';");
}
if(!pdo_fieldexists('dg_article_category',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_category')." ADD `createtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article_collect',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_collect')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_collect',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_collect')." ADD `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists('dg_article_collect',  'article_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_collect')." ADD `article_id` int(11) DEFAULT NULL COMMENT '课程id';");
}
if(!pdo_fieldexists('dg_article_collect',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_collect')." ADD `uid` int(11) DEFAULT NULL COMMENT '个人中心id';");
}
if(!pdo_fieldexists('dg_article_collect',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_collect')." ADD `openid` varchar(255) DEFAULT NULL COMMENT '用户OPENID';");
}
if(!pdo_fieldexists('dg_article_collect',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_collect')." ADD `createtime` int(11) DEFAULT NULL COMMENT '时间';");
}
if(!pdo_fieldexists('dg_article_dis',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_dis',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `uniacid` int(11) NOT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists('dg_article_dis',  'aritcle_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `aritcle_id` int(11) NOT NULL COMMENT '课程ID';");
}
if(!pdo_fieldexists('dg_article_dis',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `openid` varchar(100) NOT NULL COMMENT 'openid';");
}
if(!pdo_fieldexists('dg_article_dis',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `nickname` varchar(200) NOT NULL COMMENT '昵称';");
}
if(!pdo_fieldexists('dg_article_dis',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `avatar` varchar(300) NOT NULL COMMENT '头像';");
}
if(!pdo_fieldexists('dg_article_dis',  'discuss')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `discuss` text COMMENT '评论';");
}
if(!pdo_fieldexists('dg_article_dis',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `createtime` int(11) DEFAULT NULL COMMENT '时间';");
}
if(!pdo_fieldexists('dg_article_dis',  'status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '显示状态';");
}
if(!pdo_fieldexists('dg_article_dis',  'reply')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `reply` text COMMENT '作者回复';");
}
if(!pdo_fieldexists('dg_article_dis',  'zannum')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_dis')." ADD `zannum` int(11) DEFAULT NULL COMMENT '评论点赞数';");
}
if(!pdo_fieldexists('dg_article_diszan',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_diszan')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_diszan',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_diszan')." ADD `uniacid` int(11) DEFAULT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists('dg_article_diszan',  'disid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_diszan')." ADD `disid` int(11) DEFAULT NULL COMMENT '评论id';");
}
if(!pdo_fieldexists('dg_article_diszan',  'artid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_diszan')." ADD `artid` int(11) DEFAULT NULL COMMENT '课程id';");
}
if(!pdo_fieldexists('dg_article_diszan',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_diszan')." ADD `openid` varchar(200) DEFAULT NULL COMMENT '用户id';");
}
if(!pdo_fieldexists('dg_article_diszan',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_diszan')." ADD `createtime` int(11) DEFAULT NULL COMMENT '时间';");
}
if(!pdo_fieldexists('dg_article_diszan',  'status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_diszan')." ADD `status` tinyint(2) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_group',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_group')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_group',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_group')." ADD `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists('dg_article_group',  'groupname')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_group')." ADD `groupname` varchar(250) NOT NULL COMMENT '分组名称';");
}
if(!pdo_fieldexists('dg_article_group',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_group')." ADD `createtime` int(11) DEFAULT NULL COMMENT '创建时间';");
}
if(!pdo_fieldexists('dg_article_group',  'userid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_group')." ADD `userid` longtext;");
}
if(!pdo_fieldexists('dg_article_income',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_income')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';");
}
if(!pdo_fieldexists('dg_article_income',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_income')." ADD `uniacid` int(11) NOT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists('dg_article_income',  'author_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_income')." ADD `author_id` int(11) NOT NULL COMMENT '作者ID';");
}
if(!pdo_fieldexists('dg_article_income',  'income_money')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_income')." ADD `income_money` decimal(10,2) DEFAULT NULL COMMENT '提现金额';");
}
if(!pdo_fieldexists('dg_article_income',  'income_time')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_income')." ADD `income_time` int(11) DEFAULT NULL COMMENT '提现时间';");
}
if(!pdo_fieldexists('dg_article_income',  'income_status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_income')." ADD `income_status` tinyint(4) DEFAULT NULL COMMENT '提现状态';");
}
if(!pdo_fieldexists('dg_article_income',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_income')." ADD `createtime` int(11) DEFAULT NULL COMMENT '申请提现时间';");
}
if(!pdo_fieldexists('dg_article_income',  'transaction_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_income')." ADD `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号';");
}
if(!pdo_fieldexists('dg_article_income',  'batch_num')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_income')." ADD `batch_num` varchar(100) DEFAULT NULL COMMENT '批次号';");
}
if(!pdo_fieldexists('dg_article_navi',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_navi',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('dg_article_navi',  'navi_name')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `navi_name` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('dg_article_navi',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article_navi',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article_navi',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `create_time` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_navi',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `thumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_navi',  'redi_url')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `redi_url` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_navi',  'url_type')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `url_type` int(10) DEFAULT '1';");
}
if(!pdo_fieldexists('dg_article_navi',  'in_type')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_navi')." ADD `in_type` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_payment',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_payment',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `uniacid` int(10) NOT NULL;");
}
if(!pdo_fieldexists('dg_article_payment',  'article_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `article_id` int(10) unsigned NOT NULL COMMENT '课程ID';");
}
if(!pdo_fieldexists('dg_article_payment',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `openid` varchar(40) NOT NULL COMMENT '支付人';");
}
if(!pdo_fieldexists('dg_article_payment',  'oauth_openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `oauth_openid` varchar(40) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_payment',  'transaction_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号';");
}
if(!pdo_fieldexists('dg_article_payment',  'out_trade_no')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `out_trade_no` varchar(100) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_payment',  'pay_money')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `pay_money` decimal(10,2) DEFAULT '0.00' COMMENT '支付金额';");
}
if(!pdo_fieldexists('dg_article_payment',  'order_status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `order_status` tinyint(3) DEFAULT '0' COMMENT '支付状态';");
}
if(!pdo_fieldexists('dg_article_payment',  'pay_time')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `pay_time` int(11) DEFAULT NULL COMMENT '支付时间';");
}
if(!pdo_fieldexists('dg_article_payment',  'fromer')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `fromer` varchar(250) DEFAULT NULL COMMENT '分享者openid';");
}
if(!pdo_fieldexists('dg_article_payment',  'author_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_payment')." ADD `author_id` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_recharge',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_recharge',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `uniacid` int(11) NOT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists('dg_article_recharge',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `openid` varchar(100) NOT NULL COMMENT '用户ID';");
}
if(!pdo_fieldexists('dg_article_recharge',  'transaction_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号';");
}
if(!pdo_fieldexists('dg_article_recharge',  'out_trade_no')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `out_trade_no` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_recharge',  'recharge')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `recharge` decimal(10,2) DEFAULT NULL COMMENT '购买会员的金额';");
}
if(!pdo_fieldexists('dg_article_recharge',  'rec_time')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `rec_time` int(11) DEFAULT NULL COMMENT '支付时间';");
}
if(!pdo_fieldexists('dg_article_recharge',  'rec_status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `rec_status` tinyint(3) DEFAULT NULL COMMENT '支付状态';");
}
if(!pdo_fieldexists('dg_article_recharge',  'month')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `month` int(11) DEFAULT NULL COMMENT '月份';");
}
if(!pdo_fieldexists('dg_article_recharge',  'mode')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_recharge')." ADD `mode` tinyint(4) NOT NULL DEFAULT '1' COMMENT '付费方式,3为年付费,2位季度付费,1位月付费';");
}
if(!pdo_fieldexists('dg_article_serialize',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id';");
}
if(!pdo_fieldexists('dg_article_serialize',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'author_openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `author_openid` varchar(255) DEFAULT NULL COMMENT 'openid';");
}
if(!pdo_fieldexists('dg_article_serialize',  'author_nickname')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `author_nickname` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'author_avatar')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `author_avatar` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'serialize_title')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `serialize_title` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'serialize_img')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `serialize_img` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'serialize_desc')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `serialize_desc` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'serialize_price')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `serialize_price` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `create_time` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'pcate')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `pcate` int(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'ccate')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `ccate` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `displayorder` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'pay_num')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `pay_num` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'bg_music')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `bg_music` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'bg_music_set')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `bg_music_set` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serialize',  'recommend')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `recommend` int(10) DEFAULT '1';");
}
if(!pdo_fieldexists('dg_article_serialize',  'status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `status` int(10) DEFAULT '1';");
}
if(!pdo_fieldexists('dg_article_serialize',  'clickNum')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `clickNum` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article_serialize',  'free_chapter')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serialize')." ADD `free_chapter` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'serialize_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `serialize_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `nickname` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'discuss')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `discuss` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'reply_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `reply_id` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `createtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serializedis',  'status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `status` int(10) DEFAULT '1' COMMENT '2 显示   1不显示';");
}
if(!pdo_fieldexists('dg_article_serializedis',  'formId')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializedis')." ADD `formId` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_serializefb',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_serializefb',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('dg_article_serializefb',  'title')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'content')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists('dg_article_serializefb',  'serialize_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `serialize_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '专栏id';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'clickNum')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `clickNum` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'zanNum')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `zanNum` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `thumb` varchar(500) NOT NULL DEFAULT '' COMMENT '缩略图';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'description')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `description` mediumtext NOT NULL COMMENT '简介';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `createtime` int(15) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'bg_music')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `bg_music` varchar(250) DEFAULT NULL COMMENT '背景音乐';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'bg_music_set')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `bg_music_set` tinyint(4) DEFAULT '1' COMMENT '背景音乐开启';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '课程状态';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'wailian')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `wailian` varchar(300) DEFAULT NULL COMMENT '外链';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'appoint')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `appoint` tinyint(4) NOT NULL DEFAULT '1' COMMENT '指定状态';");
}
if(!pdo_fieldexists('dg_article_serializefb',  'free_chapter')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_serializefb')." ADD `free_chapter` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('dg_article_shang',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id';");
}
if(!pdo_fieldexists('dg_article_shang',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `uniacid` int(11) NOT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists('dg_article_shang',  'article_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `article_id` int(11) NOT NULL COMMENT '课程ID';");
}
if(!pdo_fieldexists('dg_article_shang',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `openid` varchar(255) DEFAULT NULL COMMENT 'openid';");
}
if(!pdo_fieldexists('dg_article_shang',  'oauth_openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `oauth_openid` varchar(255) DEFAULT NULL COMMENT '借权openid';");
}
if(!pdo_fieldexists('dg_article_shang',  'transaction_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号';");
}
if(!pdo_fieldexists('dg_article_shang',  'out_trade_no')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `out_trade_no` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_shang',  'shang_money')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `shang_money` decimal(10,2) DEFAULT NULL COMMENT '支付金额';");
}
if(!pdo_fieldexists('dg_article_shang',  'shang_status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `shang_status` tinyint(4) DEFAULT NULL COMMENT '赞赏状态';");
}
if(!pdo_fieldexists('dg_article_shang',  'shang_time')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `shang_time` int(11) DEFAULT NULL COMMENT '赞赏时间';");
}
if(!pdo_fieldexists('dg_article_shang',  'headimg')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `headimg` varchar(255) NOT NULL COMMENT '用户头像';");
}
if(!pdo_fieldexists('dg_article_shang',  'author_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_shang')." ADD `author_id` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_share',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_share')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_share',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_share')." ADD `uniacid` int(11) NOT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists('dg_article_share',  'sharetitle')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_share')." ADD `sharetitle` varchar(255) NOT NULL COMMENT '分享标题';");
}
if(!pdo_fieldexists('dg_article_share',  'shareimg')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_share')." ADD `shareimg` varchar(255) NOT NULL COMMENT '分享图片';");
}
if(!pdo_fieldexists('dg_article_share',  'sharedesc')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_share')." ADD `sharedesc` varchar(255) NOT NULL COMMENT '分享描述';");
}
if(!pdo_fieldexists('dg_article_share',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_share')." ADD `createtime` int(11) NOT NULL COMMENT '时间';");
}
if(!pdo_fieldexists('dg_article_sharep',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_sharep')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_sharep',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_sharep')." ADD `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists('dg_article_sharep',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_sharep')." ADD `openid` varchar(250) NOT NULL COMMENT '用户openid';");
}
if(!pdo_fieldexists('dg_article_sharep',  'share_money')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_sharep')." ADD `share_money` decimal(10,2) DEFAULT NULL COMMENT '金额';");
}
if(!pdo_fieldexists('dg_article_sharep',  'share_time')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_sharep')." ADD `share_time` int(11) DEFAULT NULL COMMENT '时间';");
}
if(!pdo_fieldexists('dg_article_sharep',  'share_status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_sharep')." ADD `share_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态';");
}
if(!pdo_fieldexists('dg_article_sharep',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_sharep')." ADD `createtime` int(11) DEFAULT NULL COMMENT '申请提现时间';");
}
if(!pdo_fieldexists('dg_article_sharep',  'transaction_id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_sharep')." ADD `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号';");
}
if(!pdo_fieldexists('dg_article_sharep',  'batch_num')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_sharep')." ADD `batch_num` varchar(200) DEFAULT NULL COMMENT '批次号';");
}
if(!pdo_fieldexists('dg_article_user',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';");
}
if(!pdo_fieldexists('dg_article_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `uniacid` int(11) NOT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists('dg_article_user',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `openid` varchar(255) NOT NULL COMMENT '用户的ID';");
}
if(!pdo_fieldexists('dg_article_user',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `nickname` varchar(255) NOT NULL COMMENT '用户昵称';");
}
if(!pdo_fieldexists('dg_article_user',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `avatar` varchar(255) NOT NULL COMMENT '用户头像';");
}
if(!pdo_fieldexists('dg_article_user',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `createtime` int(11) DEFAULT NULL COMMENT '时间';");
}
if(!pdo_fieldexists('dg_article_user',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `realname` varchar(255) DEFAULT NULL COMMENT '姓名';");
}
if(!pdo_fieldexists('dg_article_user',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `mobile` varchar(100) DEFAULT NULL COMMENT '手机号';");
}
if(!pdo_fieldexists('dg_article_user',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `desc` varchar(500) DEFAULT NULL COMMENT '详细信息';");
}
if(!pdo_fieldexists('dg_article_user',  'info_status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `info_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户状态信息';");
}
if(!pdo_fieldexists('dg_article_user',  'sex')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `sex` tinyint(4) DEFAULT NULL COMMENT '用户性别';");
}
if(!pdo_fieldexists('dg_article_user',  'end_time')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `end_time` int(11) DEFAULT NULL COMMENT '会员到期时间';");
}
if(!pdo_fieldexists('dg_article_user',  'mode')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `mode` tinyint(4) NOT NULL DEFAULT '1' COMMENT '付费方式,3为年付费,2位季度付费,1位月付费';");
}
if(!pdo_fieldexists('dg_article_user',  'setmem')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `setmem` tinyint(4) DEFAULT NULL COMMENT '设置会员者,1为管理员,2为微信支付';");
}
if(!pdo_fieldexists('dg_article_user',  'settime')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `settime` int(11) DEFAULT NULL COMMENT '操作时间记录';");
}
if(!pdo_fieldexists('dg_article_user',  'timeset')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `timeset` int(11) DEFAULT NULL COMMENT '会员时间设置';");
}
if(!pdo_fieldexists('dg_article_user',  'zfb')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_user')." ADD `zfb` varchar(255) DEFAULT NULL COMMENT '支付宝';");
}
if(!pdo_fieldexists('dg_article_vipconfig',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_vipconfig')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dg_article_vipconfig',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_vipconfig')." ADD `uniacid` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_vipconfig',  'title')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_vipconfig')." ADD `title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_vipconfig',  'day')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_vipconfig')." ADD `day` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_vipconfig',  'money')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_vipconfig')." ADD `money` decimal(10,2) DEFAULT NULL;");
}
if(!pdo_fieldexists('dg_article_vipconfig',  'status')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_vipconfig')." ADD `status` int(10) DEFAULT NULL COMMENT '1=显示，2=隐藏';");
}
if(!pdo_fieldexists('dg_article_vipconfig',  'type')) {
	pdo_query("ALTER TABLE ".tablename('dg_article_vipconfig')." ADD `type` int(10) DEFAULT NULL COMMENT '0=普通；1=永久';");
}

?>