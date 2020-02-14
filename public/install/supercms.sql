-- MySQL database dump


-- Created by DBAction class, Power By TaoTao. 


-- http://blog.kisscn.com 


--


-- 主机: 


-- 生成日期: 2014 年  06 月 02 日 23:17


-- MySQL版本: 5.0.51a-community-nt


-- PHP 版本: 5.2.4




--


-- 数据库: `waimai0414`


--


-- -------------------------------------------------------




--


-- 表的结构sn_article


--


DROP TABLE IF EXISTS `sn_article`;


CREATE TABLE `sn_article` (
  `aid` int(11) NOT NULL auto_increment,
  `acid` int(11) default NULL,
  `atitle` varchar(150) default NULL,
  `pic` varchar(300) default NULL,
  `keyword` varchar(100) default NULL,
  `alink` varchar(300) default NULL,
  `des` varchar(150) default NULL,
  `content` mediumtext,
  `uid` int(10) default NULL,
  `count_click` int(10) default '0',
  `create_time` int(13) default NULL,
  `top` int(2) default '0',
  `isyes` int(2) default '0',
  `sort` int(3) default '0',
  PRIMARY KEY  (`aid`),
  KEY `aid` (`aid`,`acid`,`atitle`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_article


--




INSERT INTO `sn_article` VALUES('35','15','手机版下周就上线了','','','','','&lt;p&gt;手机版下周就上线了&lt;/p&gt;','0','0','1396158695','0','0','0');


INSERT INTO `sn_article` VALUES('34','15','超级外卖微信版4月26号正式上线','','','','','&lt;p&gt;超级外卖微信版4月26号正式上线&lt;/p&gt;','0','0','1396158528','0','0','0');


INSERT INTO `sn_article` VALUES('31','13','tretretytrty','','','','','&lt;p&gt;ytryt&lt;/p&gt;','0','0','1396077631','0','0','0');


INSERT INTO `sn_article` VALUES('32','14','超级外卖上线了　','','','','','&lt;p&gt;超级外卖上线了　&lt;/p&gt;','0','0','1396087415','0','0','0');


INSERT INTO `sn_article` VALUES('33','15','超级外卖1.0 Bata版上线了','','','','','&lt;p&gt;超级外卖1.0 Bata版上线了&lt;/p&gt;','0','0','1396087453','0','0','0');


INSERT INTO `sn_article` VALUES('36','15','超级外卖多城市版开发中','','','','','&lt;p&gt;超级外卖多城市版开发中&lt;/p&gt;','0','0','1396158734','0','0','0');


INSERT INTO `sn_article` VALUES('37','13','简单　入手容易　','','','','','&lt;p&gt;简单　入手容易　&lt;br/&gt;&lt;/p&gt;','0','0','1396158788','0','0','0');


INSERT INTO `sn_article` VALUES('38','13','接受订制　更多功能','','','','','&lt;p&gt;接受订制&lt;/p&gt;&lt;p&gt;电话：15295086335&lt;br/&gt;&lt;/p&gt;','0','0','1396158835','0','0','0');


--


-- 表的结构sn_article_cat


--


DROP TABLE IF EXISTS `sn_article_cat`;


CREATE TABLE `sn_article_cat` (
  `acid` int(11) NOT NULL auto_increment,
  `afid` int(11) default NULL,
  `aname` varchar(80) default NULL,
  `dir` char(20) default NULL,
  `atop` int(2) default '0',
  `apic` varchar(300) default NULL,
  `wap` int(2) default '0',
  `sort` int(2) default '0',
  `keyword` char(200) default NULL,
  `ades` char(200) default NULL,
  `acreate_time` int(13) default NULL,
  `ispic` int(2) default '0',
  PRIMARY KEY  (`acid`),
  KEY `acid` (`acid`,`afid`,`aname`,`dir`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_article_cat


--




INSERT INTO `sn_article_cat` VALUES('13','0','常见问题','question','0','','0','0','','','1396075063','0');


INSERT INTO `sn_article_cat` VALUES('15','0','优惠活动','youhui','0','','0','0','','','1396081003','0');


--


-- 表的结构sn_config


--


DROP TABLE IF EXISTS `sn_config`;


CREATE TABLE `sn_config` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT '配置ID',
  `cate` int(3) default '0' COMMENT '0为基本设置，1为支付设置，2登录设置,3店铺设置,4积分设置',
  `name` varchar(30) NOT NULL default '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL default '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL default '' COMMENT '配置说明',
  `extra` varchar(255) NOT NULL default '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL default '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL default '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL default '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL default '0' COMMENT '排序',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_config


--




INSERT INTO `sn_config` VALUES('2','0','title','1','首页标题','','首页标题','0','0','0','超级外卖微信订餐系统','0');


INSERT INTO `sn_config` VALUES('1','0','name','1','网站名称','','网站名称或店铺名称','0','0','0','超级外卖','0');


INSERT INTO `sn_config` VALUES('3','0','url','1','网站URL','','网站域名,不带/','0','0','0','http://www.wm126.com','0');


INSERT INTO `sn_config` VALUES('4','0','logo','5','logo','','logo上传,250px-75px','0','0','0','/templates/kfc/images/logo/logo.png','0');


INSERT INTO `sn_config` VALUES('5','0','key','1','关键字','','网站SEO关键字','0','0','0','fds969','0');


INSERT INTO `sn_config` VALUES('6','0','des','2','网站描述','','网站SEO描述','0','0','0','fsd9999666677777777777777','0');


INSERT INTO `sn_config` VALUES('7','0','tj','1','统计','','网站流量统计代码','0','0','0','fsdf75765666','0');


INSERT INTO `sn_config` VALUES('8','0','isorder','4','允许游客下单','1:允许,0:禁止','允许游客下单','0','0','1','1','1');


INSERT INTO `sn_config` VALUES('9','1','pos','3','货到付款','','','0','0','1','默认为货到付款,','0');



INSERT INTO `sn_config` VALUES('11','4','points','1','积分设置','','税分兑换设置,多少元等于1积分','0','0','0','144','0');


INSERT INTO `sn_config` VALUES('12','0','icp','1','网站备案号','','网站备案号','0','0','0','ICP备19042558号\r\n\r\n','0');


INSERT INTO `sn_config` VALUES('13','3','address','1','店铺地址','','店铺详细地址','0','0','0','rew','0');


INSERT INTO `sn_config` VALUES('14','3','tel','1','店铺电话','','店铺电话','0','0','0','4008-323-323','0');


INSERT INTO `sn_config` VALUES('15','3','startpay','8','起送金额','','起送金额','0','0','0','0','0');


INSERT INTO `sn_config` VALUES('16','3','pspay','8','配送费用','','配送费用','0','0','0','0','0');


INSERT INTO `sn_config` VALUES('17','3','notice','2','店铺公告','','店铺公告','0','0','0','凡2月22日--2月26日在淘宝点外卖，返现50%，期待您的光临。','0');


INSERT INTO `sn_config` VALUES('18','3','psarea','2','配送区域','','配送区域','0','0','0','肯德基宅急送实行专属菜单及价格。为了保证食物品质，肯德基宅急送有送餐范围和服务时间限制。不同城市、不同送餐范围的菜单有所不同。不同时段产品品项及价格有所不同。详情以输入送餐地址后显示的菜单为准。不设最低起送金额，每单酌收8元外送费。','0');


INSERT INTO `sn_config` VALUES('27','3','endtime','7','','','','0','0','0','','0');


INSERT INTO `sn_config` VALUES('25','3','opentime','6','营业时间','','','0','0','0','17:00,19:00','0');


INSERT INTO `sn_config` VALUES('28','5','appid','0','','','','0','0','0','12525525852','0');


INSERT INTO `sn_config` VALUES('29','5','appkey','0','','','','0','0','0','88888888855855','0');
INSERT INTO `sn_config` VALUES ('10', '0', 'islogin', '4', '产品页展示方式', '1:弹窗,0:新页面', '产品页展示方式', '0', '0', '0', '0', '1');
INSERT INTO `sn_config` VALUES ('30', '6', 'SMTP_HOST', '1', 'SMTP服务器', '', 'SMTP服务器', '0', '0', '0', '8781111111111111111111111', '0');
INSERT INTO `sn_config` VALUES ('31', '6', 'SMTP_PORT', '1', 'SMTP服务器端口', '', 'SMTP服务器端口', '0', '0', '0', 'fgfgfgfgfdgdf', '0');
INSERT INTO `sn_config` VALUES ('32', '6', 'SMTP_USER', '1', 'SMTP服务器用户名', '', 'SMTP服务器用户名', '0', '0', '0', '111111111111111', '0');
INSERT INTO `sn_config` VALUES ('33', '6', 'SMTP_PASS', '1', 'SMTP服务器密码', '', 'SMTP服务器密码', '0', '0', '0', '1111111111111111', '0');
INSERT INTO `sn_config` VALUES ('34', '6', 'REPLY_NAME', '1', '回复名称', '', '回复名称（留空则为发件人名称）', '0', '0', '0', '1111111111111111', '0');
INSERT INTO `sn_config` VALUES ('35', '6', 'REPLY_EMAIL', '1', '回复EMAIL', '', '回复EMAIL（留空则为发件人EMAIL）', '0', '0', '0', '111111111111111', '0');
INSERT INTO `sn_config` VALUES ('36', '6', 'FROM_NAME', '1', '发件人名称', '', '发件人名称', '0', '0', '0', '1111111111111111111', '0');
INSERT INTO `sn_config` VALUES ('37', '7', 'webappid', '1', '授权码', '', '请购买授权码，联系QQ:97297326', '0', '0', '0', '11', '0');
INSERT INTO `sn_config` VALUES ('38', '7', 'webkey', '1', '密钥key', '', '', '0', '0', '0', '111', '0');

INSERT INTO `sn_config` VALUES ('39', '6', 'FROM_EMAIL', '1', '发件人邮件', '', '发件人邮件', '0', '0', '0', '', '0');
INSERT INTO `sn_config` VALUES ('40', '6', 'TO_EMAIL', '1', '收件邮件', '', '收件人邮件', '0', '0', '0', '', '0');

--


-- 表的结构sn_credit


--


DROP TABLE IF EXISTS `sn_credit`;


CREATE TABLE `sn_credit` (
  `creid` bigint(11) NOT NULL auto_increment COMMENT '充值id',
  `type` int(3) default '0' COMMENT '0为加，1为减去',
  `typename` char(200) default NULL,
  `uid` int(10) default NULL COMMENT '用户id',
  `sid` int(15) default NULL,
  `sname` char(100) default NULL,
  `source` char(100) default NULL,
  `crecount` int(8) default NULL,
  `ctime` int(15) default NULL,
  `ip` char(100) default NULL,
  `etime` int(15) default NULL COMMENT '积分失效时间',
  `crecontent` varchar(500) default NULL,
  PRIMARY KEY  (`creid`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_credit


--






--


-- 表的结构sn_creditgood


--


DROP TABLE IF EXISTS `sn_creditgood`;


CREATE TABLE `sn_creditgood` (
  `cgid` bigint(11) NOT NULL auto_increment COMMENT '充值id',
  `goodname` char(150) default '0' COMMENT '0为加，1为减去',
  `goodcontent` varchar(500) default NULL,
  `credits` int(10) default NULL COMMENT '积分数量',
  `count` int(10) default NULL,
  `sid` int(15) default NULL,
  `sname` char(100) default NULL COMMENT '充值门店名称',
  `goodpic` char(200) default NULL,
  `ctime` int(15) default NULL,
  `sort` int(11) default NULL,
  PRIMARY KEY  (`cgid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_creditgood


--




INSERT INTO `sn_creditgood` VALUES('5','手机','有','55','10','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('6','手机相链接','','5','555','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('7','手机相链接','','9789','5','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('8','手机相链接','','56','4','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('9','手机相链接','','54','5','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('10','手机相链接','','55788','5555','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('11','0手机相链接','','55555','5','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('12','手机相链接','','55','5','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('13','手机相链接','','64','552','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('14','手机相链接','','555','55','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('15','手机相链接','','815','55','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('16','手机相链接','','6546','5','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('17','手机相链接','','6456788','5','','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','','');


INSERT INTO `sn_creditgood` VALUES('18','手机相链接','','55877','5','','','','','');


--


-- 表的结构sn_faddress


--


DROP TABLE IF EXISTS `sn_faddress`;


CREATE TABLE `sn_faddress` (
  `faddid` int(15) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `cityid` int(10) default NULL,
  `cityname` char(90) default NULL,
  `areaid` int(15) default '0',
  `areaname` char(60) default NULL,
  `address` char(100) default NULL,
  `addtop` int(5) default '0',
  `ctime` int(15) default NULL,
  `name` char(60) default NULL,
  `tel` char(60) default NULL,
  PRIMARY KEY  (`faddid`),
  KEY `fcid` (`uid`,`areaid`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_faddress


--




INSERT INTO `sn_faddress` VALUES('46','22','','','0','','fdsfdsf','0','1401634755','fdsfd','sfdsfds');


INSERT INTO `sn_faddress` VALUES('27','22','','','0','','4444北京东路22号0000','0','','545玩友','鬼地方');



--


-- 表的结构sn_food


--


DROP TABLE IF EXISTS `sn_food`;


CREATE TABLE `sn_food` (
  `fid` int(10) NOT NULL auto_increment,
  `fcid` int(10) default NULL,
  `fnum` int(10) default NULL,
  `fname` char(90) default NULL,
  `ftitle` char(150) default NULL,
  `fprice` float(10,2) default NULL,
  `fcontent` varchar(200) default NULL,
  `fpic` char(200) default NULL,
  `fsort` int(5) default '0',
  `ftop` int(5) default '0',
  `fctime` int(16) default NULL,
  `status` int(1) default '0',
  `salecount` int(10) default NULL,
  `iswaimai` int(2) default '0' COMMENT '是否为外卖',
  PRIMARY KEY  (`fid`),
  KEY `fid` (`fid`,`fcid`,`fnum`,`fname`,`fprice`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_food


--




INSERT INTO `sn_food` VALUES('60','19','0','D培根鸡腿燕麦堡套餐A','','35.50','','/uploads/fimg/20140330/5337bc4b3180a.jpg','0','0','1396161611','0','0','0');


INSERT INTO `sn_food` VALUES('61','19','0','培根鸡腿燕麦堡套餐B','','32.50','','/uploads/fimg/20140330/5337bc9a8cce0.jpg','0','0','1396161690','0','0','0');


INSERT INTO `sn_food` VALUES('62','19','0','培根鸡腿燕麦堡套餐C','','35.50','','/uploads/fimg/20140330/5337bcc090dc0.jpg','0','0','1396161728','0','0','0');


INSERT INTO `sn_food` VALUES('63','19','0','藤椒麻香鸡腿堡套餐A','','25.50','','/uploads/fimg/20140330/5337bd1cd56fa.jpg','0','0','1396161821','0','0','0');


INSERT INTO `sn_food` VALUES('64','19','0','川香双层鸡腿堡餐','','50.00','','/uploads/fimg/20140330/5337bd3d64968.jpg','0','0','1396161853','0','0','0');


INSERT INTO `sn_food` VALUES('65','19','0','培根鸡腿燕麦堡','','17.50','','/uploads/fimg/20140330/5337bd6ab72d6.jpg','0','0','1396161898','0','0','0');


INSERT INTO `sn_food` VALUES('66','19','0','香辣鸡腿堡','','15.50','','/uploads/fimg/20140330/5337bf8d4d5ec.jpg','0','0','1396162445','0','0','0');


INSERT INTO `sn_food` VALUES('67','19','0','新奥尔良烤腿堡','','16.50','','/uploads/fimg/20140330/5337bfad087ae.jpg','0','0','1396162477','0','0','0');


INSERT INTO `sn_food` VALUES('68','19','0','新至珍全虾堡','','15.50','','/uploads/fimg/20140330/5337c02e4c9a9.jpg','0','0','1396162606','0','0','0');


INSERT INTO `sn_food` VALUES('69','19','0','劲脆鸡腿堡','','16.50','','/uploads/fimg/20140330/5337c0baafe1b.jpg','0','0','1396162746','0','0','0');


INSERT INTO `sn_food` VALUES('70','20','0','瘦肉粥热豆浆油条餐','','17.50','','/uploads/fimg/20140330/5337c1148d62a.jpg','0','0','1396162836','0','0','0');


INSERT INTO `sn_food` VALUES('71','20','0','雪菜粥热豆浆油条餐','','15.50','','/uploads/fimg/20140330/5337c141ded28.jpg','0','0','1396162882','0','0','0');


INSERT INTO `sn_food` VALUES('72','21','0','安心油条','','5.00','','/uploads/fimg/20140330/5337c1d144f75.jpg','0','0','1396163046','0','0','0');


INSERT INTO `sn_food` VALUES('73','22','0','五味小吃桶升级版','','50.00','','/uploads/fimg/20140330/5337c217ca9cb.jpg','0','0','1396163096','0','0','0');


INSERT INTO `sn_food` VALUES('74','22','0','堡堡双人餐','','80.00','','/uploads/fimg/20140330/5337c241549ed.jpg','0','0','1396163137','0','0','0');


INSERT INTO `sn_food` VALUES('75','22','0','饭堡双人餐','','50.00','','/uploads/fimg/20140330/5337c268bb0d6.jpg','0','0','1396163176','0','0','0');


INSERT INTO `sn_food` VALUES('76','23','0','九块吮指原味鸡','','75.00','','/uploads/fimg/20140330/5337c2a9caf0c.jpg','0','0','1396163241','0','0','0');


INSERT INTO `sn_food` VALUES('77','23','0','吮指原味鸡套餐B','','34.50','','/uploads/fimg/20140330/5337c35236a6e.jpg','0','0','1396163410','0','0','0');


INSERT INTO `sn_food` VALUES('78','24','0','九珍果汁饮料','','15.00','','/uploads/fimg/20140330/5337c55141c56.jpg','0','0','1396163921','0','0','0');


INSERT INTO `sn_food` VALUES('79','24','0','1.25升装百事可乐','','12.00','','/uploads/fimg/20140330/5337c56e351d5.jpg','0','0','1396163950','0','0','0');


INSERT INTO `sn_food` VALUES('80','25','0','菌菇四宝汤','','10.00','','/uploads/fimg/20140330/5337c594177b7.jpg','0','0','1396163988','0','0','0');


INSERT INTO `sn_food` VALUES('81','25','0','土豆泥','','6.00','','/uploads/fimg/20140330/5337c5b48d4dd.jpg','0','0','1396164020','0','0','0');


--


-- 表的结构sn_foodcat


--


DROP TABLE IF EXISTS `sn_foodcat`;


CREATE TABLE `sn_foodcat` (
  `fcid` int(10) NOT NULL auto_increment,
  `fcname` char(90) default NULL,
  `fpid` int(15) default '0',
  `fcsort` int(5) default '0',
  `fctop` int(5) default '0',
  `ctime` int(15) default NULL,
  `sid` int(10) default NULL,
  `fcount` int(5) default NULL,
  PRIMARY KEY  (`fcid`),
  KEY `fcid` (`fcid`,`fcname`,`fpid`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_foodcat


--




INSERT INTO `sn_foodcat` VALUES('19','美味汉堡','0','0','0','1396161410','0','0');


INSERT INTO `sn_foodcat` VALUES('20','现熬好粥','0','0','0','1396161434','0','0');


INSERT INTO `sn_foodcat` VALUES('21','小食配餐','0','0','0','1396161451','0','0');


INSERT INTO `sn_foodcat` VALUES('22','超值多人餐','0','0','0','1396161474','0','0');


INSERT INTO `sn_foodcat` VALUES('23','吮指原味鸡','0','0','0','1396161494','0','0');


INSERT INTO `sn_foodcat` VALUES('24','缤纷饮料','0','0','0','1396161512','0','0');


INSERT INTO `sn_foodcat` VALUES('25','丰富配餐','0','0','0','1396161533','0','0');


--


-- 表的结构sn_foodorder


--


DROP TABLE IF EXISTS `sn_foodorder`;


CREATE TABLE `sn_foodorder` (
  `oid` int(30) NOT NULL auto_increment,
  `orderprice` float(10,2) default NULL,
  `ordercount` int(10) default NULL,
  `zhekou` float(10,2) default NULL,
  `pay` float(10,2) default NULL,
  `paytype` int(2) default '0',
  `ucount` int(10) default '0',
  `uid` int(15) default NULL,
  `uname` char(60) default NULL,
  `pid` char(100) default NULL,
  `shopspay` int(11) default '0' COMMENT '配送费用',
  `shopname` char(100) default NULL,
  `gid` char(90) default NULL,
  `order_ctime` int(16) default NULL,
  `order_endtime` int(16) default NULL,
  `print_time` int(16) default NULL,
  `print_name` char(100) default NULL,
  `morecontent` char(200) default NULL,
  `otel` char(80) default NULL,
  `oman` char(100) default NULL,
  `oaddress` char(200) default NULL,
  `orderstatus` int(1) default '1',
  `ordersource` char(40) default NULL,
  `couponid` int(30) default '0',
  `order_dtime` datetime default NULL,
  PRIMARY KEY  (`oid`),
  KEY `oid` (`oid`,`orderprice`,`ordercount`,`orderstatus`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 CHECKSUM=1;




--


-- 转存表中的数据 sn_foodorder


--


INSERT INTO `sn_foodorder` VALUES('80','22.00','2','','','0','0','72','122111','b5m0qdokkssepp4amm1209lng5','0','','','1401679568','','','','5453543','fdsf','fds','fdsfs','4','','0','2014-06-02 11:30:02');


--


-- 表的结构sn_foodorderext


--


DROP TABLE IF EXISTS `sn_foodorderext`;


CREATE TABLE `sn_foodorderext` (
  `oid` bigint(30) default NULL,
  `did` int(6) default NULL,
  `fid` int(6) default NULL,
  `fname` char(100) default NULL,
  `fcid` int(15) default NULL,
  `fcname` char(100) default NULL,
  `fprice` float(10,2) default NULL,
  `fcount` int(10) default NULL,
  `prices` float(10,2) default NULL,
  `muid` int(15) default NULL,
  `muname` char(100) default NULL,
  `time` int(10) default NULL,
  `fenliang` char(100) default NULL,
  `kouwei` char(100) default NULL,
  `call_time` int(16) default NULL,
  `print_time` int(16) default NULL,
  `end_time` int(16) default NULL,
  `status` int(1) default '0',
  `gid` char(64) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_foodorderext


--




INSERT INTO `sn_foodorderext` VALUES('45','0','61','培根鸡腿燕麦堡套餐B','0','','32.50','1','32.50','0','','0','','','0','0','0','0','');


INSERT INTO `sn_foodorderext` VALUES('45','0','63','藤椒麻香鸡腿堡套餐A','0','','25.50','1','25.50','0','','0','','','0','0','0','0','');


INSERT INTO `sn_foodorderext` VALUES('45','0','60','D培根鸡腿燕麦堡套餐A','0','','35.50','1','35.50','0','','0','','','0','0','0','0','');


INSERT INTO `sn_foodorderext` VALUES('45','0','71','雪菜粥热豆浆油条餐','0','','15.50','1','15.50','0','','0','','','0','0','0','0','');


INSERT INTO `sn_foodorderext` VALUES('45','0','70','瘦肉粥热豆浆油条餐','0','','17.50','1','17.50','0','','0','','','0','0','0','0','');


INSERT INTO `sn_foodorderext` VALUES('46','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('46','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('46','','76','九块吮指原味鸡','','','75.00','1','75.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('47','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('47','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('47','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('47','','78','九珍果汁饮料','','','15.00','1','15.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('48','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('48','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('48','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('49','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('49','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('49','','77','吮指原味鸡套餐B','','','34.50','1','34.50','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('50','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('50','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('50','','76','九块吮指原味鸡','','','75.00','1','75.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('50','','77','吮指原味鸡套餐B','','','34.50','1','34.50','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('51','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('51','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('51','','76','九块吮指原味鸡','','','75.00','1','75.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('52','','62','培根鸡腿燕麦堡套餐C','','','35.50','1','35.50','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('52','','61','培根鸡腿燕麦堡套餐B','','','32.50','1','32.50','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('52','','65','培根鸡腿燕麦堡','','','17.50','1','17.50','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('53','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('53','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('54','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('54','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('55','','71','雪菜粥热豆浆油条餐','','','15.50','1','15.50','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('55','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('55','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('55','','76','九块吮指原味鸡','','','75.00','1','75.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('55','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('56','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('57','','78','九珍果汁饮料','','','15.00','1','15.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('57','','71','雪菜粥热豆浆油条餐','','','15.50','1','15.50','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('58','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('58','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('59','','73','五味小吃桶升级版','','','50.00','1','50.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('59','','75','饭堡双人餐','','','50.00','1','50.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('59','','76','九块吮指原味鸡','','','75.00','1','75.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('59','','77','吮指原味鸡套餐B','','','34.50','1','34.50','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('59','','78','九珍果汁饮料','','','15.00','1','15.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('59','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('59','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('60','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('60','','78','九珍果汁饮料','','','15.00','1','15.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('60','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('60','','73','五味小吃桶升级版','','','50.00','1','50.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('61','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('62','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('63','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('64','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('64','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('65','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('66','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('66','','75','饭堡双人餐','','','50.00','1','50.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('66','','74','堡堡双人餐','','','80.00','1','80.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('66','','73','五味小吃桶升级版','','','50.00','1','50.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('66','','78','九珍果汁饮料','','','15.00','1','15.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('67','','76','九块吮指原味鸡','','','75.00','2','150.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('68','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('68','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('69','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('69','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('70','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('71','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('71','','76','九块吮指原味鸡','','','75.00','1','75.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('72','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('72','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('73','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('74','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('74','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('74','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('75','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('76','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('76','','76','九块吮指原味鸡','','','75.00','1','75.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('77','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('77','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('78','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('78','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('79','','81','土豆泥','','','6.00','1','6.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('80','','79','1.25升装百事可乐','','','12.00','1','12.00','','','','','','','','','0','');


INSERT INTO `sn_foodorderext` VALUES('80','','80','菌菇四宝汤','','','10.00','1','10.00','','','','','','','','','0','');


--


-- 表的结构sn_link


--


DROP TABLE IF EXISTS `sn_link`;


CREATE TABLE `sn_link` (
  `lid` int(10) NOT NULL auto_increment,
  `type` int(1) default '0',
  `linkname` varchar(200) default NULL,
  `link` varchar(300) default NULL,
  `linkpic` varchar(300) default NULL,
  `des` varchar(300) default NULL,
  `content` varchar(300) default NULL,
  `top` int(2) default '0',
  `create_time` int(15) default NULL,
  `isweb` int(1) default '0',
  PRIMARY KEY  (`lid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;




--


-- 转存表中的数据 sn_link


--




--


-- 表的结构sn_members


--


DROP TABLE IF EXISTS `sn_members`;


CREATE TABLE `sn_members` (
  `uid` bigint(20) unsigned NOT NULL auto_increment,
  `username` char(60) NOT NULL,
  `userpass` char(90) NOT NULL default '',
  `userpic` varchar(200) NOT NULL,
  `useremail` varchar(100) NOT NULL default '',
  `usertel` int(15) default '0',
  `nickname` varchar(50) default NULL,
  `userqq` int(15) NOT NULL,
  `usersex` int(3) default NULL,
  `usergroup` int(8) default '0',
  `last_login_ip` varchar(16) NOT NULL,
  `last_login_time` int(15) default NULL,
  `create_time` int(15) default NULL,
  `userlevel` varchar(60) NOT NULL default '0',
  `userpoint` smallint(6) default '0',
  `userstatus` int(11) NOT NULL default '0',
  `gid` char(100) default NULL,
  PRIMARY KEY  (`uid`),
  KEY `user_nicename` (`nickname`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_members


--




INSERT INTO `sn_members` VALUES('1','admin','96e79218965eb72c92a549dd5a330112','','111@11.com','0','','0','1','99','127.0.0.1','1401692205','1401693536','99','0','0','');




--


-- 表的结构sn_message


--


DROP TABLE IF EXISTS `sn_message`;


CREATE TABLE `sn_message` (
  `msid` int(10) NOT NULL auto_increment,
  `mtype` int(1) default '0',
  `sid` int(10) default NULL,
  `sname` char(100) default NULL,
  `uid` int(10) default NULL,
  `uname` char(200) default NULL,
  `upic` char(200) default NULL,
  `mcontent` varchar(600) default NULL,
  `pid` int(10) default '0',
  `top` int(2) default '0',
  `create_time` int(15) default NULL,
  `isweb` int(1) default '0',
  PRIMARY KEY  (`msid`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;




--


-- 转存表中的数据 sn_message


--





--


-- 表的结构sn_pages


--


DROP TABLE IF EXISTS `sn_pages`;


CREATE TABLE `sn_pages` (
  `pagid` int(11) NOT NULL auto_increment,
  `page_fid` int(11) default '0',
  `pagedir` char(30) default NULL,
  `page_title` varchar(150) default NULL,
  `page_content` mediumtext,
  `page_header` varchar(1000) default NULL,
  `page_footer` varchar(1000) default NULL,
  `page_key` char(100) default NULL,
  `page_des` char(200) default NULL,
  `pic` varchar(300) default NULL,
  `pic2` varchar(300) default NULL,
  `pic3` varchar(300) default NULL,
  `pic4` varchar(300) default NULL,
  `sort` int(2) default '0',
  `create_time` int(13) default NULL,
  `page_top` int(1) default '0',
  PRIMARY KEY  (`pagid`),
  KEY `pagid` (`pagid`,`pagedir`,`page_title`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;




--


-- 转存表中的数据 sn_pages


--




INSERT INTO `sn_pages` VALUES('11','0','about','关于我们','&lt;p&gt;fdsfdfdsfdfdfd&lt;/p&gt;','','','','','','','','','0','1396074870','0');


INSERT INTO `sn_pages` VALUES('12','0','add','加入我们','&lt;p&gt;fdsf&lt;/p&gt;','','','','','','','','','0','1396074928','0');


INSERT INTO `sn_pages` VALUES('13','0','yins','隐私条款','&lt;p&gt;fdsfdfdyyyy&lt;/p&gt;','','','','','','','','','0','1396087696','0');


INSERT INTO `sn_pages` VALUES('14','0','law','法律条款','&lt;p&gt;欢迎您使用肯德基宅急送网络订餐服务，包括但不限于通过肯德基宅急送互联网订餐网站，肯德基宅急送手机App订餐客户端，以及肯德基宅急送基于互联网或手机上网功能开发的其他订餐平台（如肯德基宅急送移动互联网订餐网站），提供的服务（以下简称“我们的服务”）。请仔细阅读本法律条款。您使用我们的服务即表示您已同意本条款。我们的服务范围可能会拓展，因此有时还会适用一些附加条款或要求。附加条款将会与相关服务一同提供，并且在您使用这些服务后，成为您与我们所达成的协议的一部分。本法律条款适用于您当前及未来使用的我们的服务。&lt;/p&gt;&lt;p&gt;&lt;strong class=&quot;ersee-lp-subtitle-bottom&quot;&gt;&lt;/strong&gt;&lt;/p&gt;&lt;ul class=&quot; list-paddingleft-2&quot;&gt;&lt;li&gt;&lt;p&gt;我们的服务中所涉及的商标、服务标志、设计、文字或图案及相关知识产权等均属百胜咨询（上海）有限公司或其关联公司（以下简称：百胜公司）所有、或已取得所有人的正式授权，受法律保护，在未取得百胜公司或有关第三方书面授权之前，任何人不得擅自使用，包括但不限于复制、复印、修改、出版、公布、传送、分发我们的服务中使用的文本、图象、影音、镜像等内容，否则将承担相应法律责任。使用我们的服务并不让您拥有我们的服务或您所访问的内容的任何知识产权。本条款并未授予您使用我们的服务中所用的任何商标、标志、设计、文字等的权利。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;我们在提供服务时将会尽到商业上合理水平的技能和注意义务，希望您会喜欢我们的服务，但有些关于服务的事项恕我们无法作出承诺。因此，在法律允许的范围内，我们的服务对信息的准确性和及时性不给予任何明示或默示的保证。我们的服务不承担因您进入或使用我们的服务而导致的任何直接的、间接的、意外的、因果性的损害责任。请使用合法软件和设备。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;您在使用我们的服务时，可以自愿选择是否提交个人信息资料。如果您提交个人信息，即表示您接受我们的服务隐私权条款，我们的服务对于您的个人信息和隐私权予以尊重和保密。您在使用我们的服务时传送的任何其他资料、信息，包括但不限于意见、客户反馈、喜好、建议、支持、请求、问题等内容，将被当作非保密资料和非专有资料处理；您的传送行为即表示您同意这些资料用作我们的调查、统计等目的而由我们无偿使用。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;当您在使用我们的服务时，某些信息可以通过各种技术和方法不经您主动提供而被收集，这些方法包括IP地址、Cookies，设备信息，日志数据收集等。这些信息不足以使他人辨认您个人的身份，收集上述信息的目的旨在为您提供更完善的服务。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;您在使用我们的服务时不得传送和发放带有中伤、诽谤、造谣、色情及其他违法或不道德的资料和言论，我们有权对此进行管理和监督，但并不对您的上述行为承担任何责任。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;我们的服务无意向18岁以下未成年人提供网络订餐服务或收集个人信息，家长或监护人应承担未成年人在网络环境下的隐私权的首要责任。请家长或监护人对其子女或被监护人使用我们的服务进行监管和负责。由于我们的服务无法辨认用户是否为未成年人，因此如有未成年人使用我们的服务，则表示其已获得家长或监护人认可，任何相关后果由其家长或监护人承担。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;如果我们的服务提供了第三方网站链接，仅仅是为了向您提供便利。如果您使用这些链接，您将离开本站。我们无法评估此类第三方网站，也不对任何此类第三方网站或这些网站提供的产品、服务或内容负责。因此，对于此类第三方网站，或此类网站上提供的任何信息、软件、产品、服务或材料，或使用这些网站可能得到的任何结果，您需自行评估及承担使用风险。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;我们可以修改本条款或相关条款并会予以更新和公布，所有修改的适用不具有追溯力。但是，对服务新功能的特别修改或由于法律原因所作的修改将立即生效。如果您不同意服务的修改条款，应停止使用我们的服务。&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;/p&gt;','','','','','','','','','0','1396074998','0');


INSERT INTO `sn_pages` VALUES('15','0','pays','支付方式','&lt;p&gt;支付方式内容编辑　&lt;/p&gt;','','','','','','','','','0','1397633115','0');


INSERT INTO `sn_pages` VALUES('16','0','sess','服务费用','&lt;p&gt;服务费用&lt;/p&gt;','','','','','','','','','0','1397633186','0');


