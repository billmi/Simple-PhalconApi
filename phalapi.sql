/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50719
Source Host           : 127.0.0.1:3306
Source Database       : phalapi

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2017-10-24 13:54:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `articles`
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT ' 文章ID',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `introduce` text NOT NULL COMMENT '文章摘要',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 0：删除  1：发布 2：草稿',
  `view_number` int(10) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `is_recommend` char(1) NOT NULL DEFAULT '0' COMMENT '是否为推荐阅读',
  `is_top` char(1) NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `create_by` int(10) unsigned NOT NULL COMMENT '创建者',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `modify_by` int(10) unsigned NOT NULL COMMENT '修改者',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`aid`),
  KEY `INDEX_TITLE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='文章表';

-- ----------------------------
-- Records of articles
-- ----------------------------

-- ----------------------------
-- Table structure for `articles_categorys`
-- ----------------------------
DROP TABLE IF EXISTS `articles_categorys`;
CREATE TABLE `articles_categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL COMMENT '文章ID',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  PRIMARY KEY (`id`),
  KEY `INDEX_AID_CID` (`aid`,`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of articles_categorys
-- ----------------------------

-- ----------------------------
-- Table structure for `articles_tags`
-- ----------------------------
DROP TABLE IF EXISTS `articles_tags`;
CREATE TABLE `articles_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL COMMENT '文章ID',
  `tid` int(11) NOT NULL COMMENT '标签ID',
  PRIMARY KEY (`id`),
  KEY `INDEX_AID_TID` (`aid`,`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of articles_tags
-- ----------------------------

-- ----------------------------
-- Table structure for `categorys`
-- ----------------------------
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT ' 分类ID',
  `category_name` varchar(50) NOT NULL COMMENT '分类名称',
  `slug` varchar(50) NOT NULL DEFAULT '' COMMENT '分类缩略名',
  `sort` mediumint(9) NOT NULL DEFAULT '999' COMMENT '分类排序',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '分类描述',
  `parent_cid` int(10) unsigned NOT NULL COMMENT '父分类ID',
  `path` varchar(255) NOT NULL COMMENT '分类路径',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 0：删除',
  `create_by` int(10) unsigned NOT NULL COMMENT '创建者',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `modify_by` int(10) unsigned NOT NULL COMMENT '修改者',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`cid`),
  KEY `INDEX_SLUG` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='分类表';

-- ----------------------------
-- Records of categorys
-- ----------------------------

-- ----------------------------
-- Table structure for `contents`
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `relateid` int(10) NOT NULL COMMENT '关联ID',
  `markdown` text NOT NULL COMMENT 'markdown内容',
  `content` text NOT NULL COMMENT 'html内容',
  PRIMARY KEY (`id`),
  KEY `INDEX_RELATEID` (`relateid`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='内容表';

-- ----------------------------
-- Records of contents
-- ----------------------------

-- ----------------------------
-- Table structure for `file`
-- ----------------------------
DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(50) DEFAULT NULL,
  `file_path` text,
  `file_ext` varchar(10) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '上传类型 : 1:图片',
  `upload_ip` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `file_shal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `filename` (`file_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10073 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of file
-- ----------------------------
INSERT INTO `file` VALUES ('10050', '1261547575022.jpg', 'upload/picture/20171010/2017101016532859dc8a88b7f52.jpg', 'jpg', '51172', '1', '192.168.0.171', '1', '2017-10-10 16:53:28', null, '9f1d26b18ceb5d95b4f5ebcf6e9c6cc3297485e5');
INSERT INTO `file` VALUES ('10051', 'timg (1).jpg', 'upload/picture/20171010/2017101018001659dc9a30371d5.jpg', 'jpg', '12598', '1', '192.168.0.137', '1', '2017-10-10 18:00:16', null, 'd13b18112cc3cfcba458c52e2504bd94a092fea9');
INSERT INTO `file` VALUES ('10052', 'timg.jpg', 'upload/picture/20171010/2017101018001659dc9a303726a.jpg', 'jpg', '17106', '1', '192.168.0.137', '1', '2017-10-10 18:00:16', null, 'd41b3a4ef1edfbf124f7f416fb1bcb4d9ceee0a1');
INSERT INTO `file` VALUES ('10053', 'products.png', 'upload/picture/20171011/2017101116221759ddd4b9e8d1b.png', 'png', '31789', '1', '192.168.0.184', '1', '2017-10-11 16:22:17', null, '1e75420dbeeb2d85c1bcc670e940db1721e57dc7');
INSERT INTO `file` VALUES ('10054', 'products.png', 'upload/picture/20171011/2017101116221759ddd4b9e8db5.png', 'png', '31789', '1', '192.168.0.184', '1', '2017-10-11 16:22:17', null, 'cedfc3ebb227e6ca2568ab7222f19ba9ccbe6531');
INSERT INTO `file` VALUES ('10055', 'timg (1).jpg', 'upload/picture/20171011/2017101116242859ddd53c7f3e1.jpg', 'jpg', '12598', '1', '192.168.0.137', '1', '2017-10-11 16:24:28', null, '7f1fa5525472eb2f50f8cf5ed719228e97f0d4f0');
INSERT INTO `file` VALUES ('10056', 'timg.jpg', 'upload/picture/20171011/2017101116242859ddd53c7f487.jpg', 'jpg', '17106', '1', '192.168.0.137', '1', '2017-10-11 16:24:28', null, '812b4dd6993cb115371baeaad4570859e82da9b6');
INSERT INTO `file` VALUES ('10057', 'QQ图片20171010130531.jpg', 'upload/picture/20171011/2017101119213459ddfebeb138e.jpg', 'jpg', '31938', '1', '192.168.0.171', '1', '2017-10-11 19:21:34', null, 'fb9b4fbf9b898e77a6169882d58a48b53b31c5a4');
INSERT INTO `file` VALUES ('10058', '4556.jpg', 'upload/picture/20171011/2017101119213459ddfebeb1422.jpg', 'jpg', '10054', '1', '192.168.0.171', '1', '2017-10-11 19:21:34', null, '1f4eb7b8f2b8d1b9656c511085d433f135d0a50e');
INSERT INTO `file` VALUES ('10059', 'timg (1).jpg', 'upload/picture/20171011/2017101120343859de0fdee9471.jpg', 'jpg', '12598', '1', '192.168.0.137', '1', '2017-10-11 20:34:38', null, 'e4539592f8af703a6742f8949bf812bb6c954ed7');
INSERT INTO `file` VALUES ('10060', 'timg.jpg', 'upload/picture/20171011/2017101120343859de0fdee950c.jpg', 'jpg', '17106', '1', '192.168.0.137', '1', '2017-10-11 20:34:38', null, '85788a74a00fbff1cf8419403eb6d89a0b6b5523');
INSERT INTO `file` VALUES ('10061', '4556.jpg', 'upload/picture/20171012/2017101219171359df4f3906aa8.jpg', 'jpg', '10054', '1', '192.168.0.172', '1', '2017-10-12 19:17:13', null, 'd71160dd5566d222bf6d78b84f34218d2d211f51');
INSERT INTO `file` VALUES ('10062', 'QQ图片20171010130531.jpg', 'upload/picture/20171012/2017101219171359df4f3906b29.jpg', 'jpg', '31938', '1', '192.168.0.172', '1', '2017-10-12 19:17:13', null, 'c164088a109709e8ea5e03543985114ecf668071');
INSERT INTO `file` VALUES ('10063', 'QQ图片20171010130531.jpg', 'upload/picture/20171012/2017101222545259df823c66c5b.jpg', 'jpg', '31938', '1', '192.168.0.172', '1', '2017-10-12 22:54:52', null, 'b041996dc09e1f93b42efdbb376c0806f8dabad4');
INSERT INTO `file` VALUES ('10064', '1261547575022.jpg', 'upload/picture/20171012/2017101222545259df823c66d12.jpg', 'jpg', '51172', '1', '192.168.0.172', '1', '2017-10-12 22:54:52', null, '77ff19b60b36b4c753b399848c717d62149ddc92');
INSERT INTO `file` VALUES ('10065', 'timg (1).jpg', 'upload/picture/20171013/2017101310024159e01ec1ea846.jpg', 'jpg', '12598', '1', '192.168.0.137', '1', '2017-10-13 10:02:41', null, 'ec33a12c80b8469541b8c3d952c05469c47d2d80');
INSERT INTO `file` VALUES ('10066', 'timg.jpg', 'upload/picture/20171013/2017101310024159e01ec1ea8e1.jpg', 'jpg', '17106', '1', '192.168.0.137', '1', '2017-10-13 10:02:41', null, '1be6cd919437bcf79eed3a0faa314eb6277014b9');
INSERT INTO `file` VALUES ('10067', 'timg (1).jpg', 'upload/picture/20171013/2017101311045559e02d57a41ed.jpg', 'jpg', '12598', '1', '192.168.0.137', '1', '2017-10-13 11:04:55', null, 'aee158a4684936e5e5edea99f218a2e10e88446f');
INSERT INTO `file` VALUES ('10068', 'timg.jpg', 'upload/picture/20171013/2017101311045559e02d57a428e.jpg', 'jpg', '17106', '1', '192.168.0.137', '1', '2017-10-13 11:04:55', null, '4a498a32a8dc126eac9e78c30346b6776b13ad5e');
INSERT INTO `file` VALUES ('10069', 'timg.jpg', 'upload/picture/20171013/2017101311053959e02d83533a4.jpg', 'jpg', '17106', '1', '192.168.0.137', '1', '2017-10-13 11:05:39', null, '16a4b3023662391b6495550ab6a3a24162369700');
INSERT INTO `file` VALUES ('10070', 'timg.jpg', 'upload/picture/20171013/2017101311054159e02d8571fb7.jpg', 'jpg', '17106', '1', '192.168.0.137', '1', '2017-10-13 11:05:41', null, '690b5262ae0e10206387bf13d84b9a10bea30367');
INSERT INTO `file` VALUES ('10071', 'timg.jpg', 'upload/picture/20171013/2017101311054759e02d8b51629.jpg', 'jpg', '17106', '1', '192.168.0.137', '1', '2017-10-13 11:05:47', null, '30bca955d8cbc4e33bead559508ff00be62ad768');
INSERT INTO `file` VALUES ('10072', 'timg (1).jpg', 'upload/picture/20171013/2017101311054759e02d8b516e7.jpg', 'jpg', '12598', '1', '192.168.0.137', '1', '2017-10-13 11:05:47', null, '317e4e315d9d3884cd1bd18275a93352cb41a321');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `menu_name` varchar(50) NOT NULL COMMENT '菜单名',
  `menu_url` varchar(50) NOT NULL COMMENT '菜单URL',
  `sort` mediumint(9) NOT NULL DEFAULT '999' COMMENT '菜单排序',
  `parent_mid` int(10) unsigned NOT NULL COMMENT '父菜单ID',
  `path` varchar(255) NOT NULL COMMENT '菜单路径',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 0：删除',
  `create_by` int(10) unsigned NOT NULL COMMENT '创建者',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `modify_by` int(10) unsigned NOT NULL COMMENT '修改者',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of menu
-- ----------------------------

-- ----------------------------
-- Table structure for `options`
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `op_key` varchar(50) NOT NULL COMMENT '配置key',
  `op_value` varchar(50) NOT NULL DEFAULT '' COMMENT '配置value',
  `create_by` int(10) unsigned NOT NULL COMMENT '创建者',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `modify_by` int(10) unsigned NOT NULL COMMENT '修改者',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_OP_KEY` (`op_key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='配置表';

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('1', 'site_name', 'Marser', '1', '2016-11-28 10:48:58', '1', '2016-12-01 12:01:33');
INSERT INTO `options` VALUES ('2', 'site_url', 'http://www.marser.cn/', '1', '2016-11-28 10:49:20', '1', '2016-12-22 12:22:35');
INSERT INTO `options` VALUES ('3', 'site_description', '描述', '1', '2016-11-28 10:49:33', '1', '2016-11-28 10:53:10');
INSERT INTO `options` VALUES ('4', 'site_keywords', '关键字', '1', '2016-11-28 10:49:45', '1', '2016-11-28 10:53:10');
INSERT INTO `options` VALUES ('5', 'page_article_number', '10', '1', '2016-11-28 11:05:10', '1', '2016-12-29 16:11:46');
INSERT INTO `options` VALUES ('6', 'recommend_article_number', '10', '1', '2016-11-28 11:05:19', '1', '2016-12-29 16:11:43');
INSERT INTO `options` VALUES ('7', 'site_title', '标题', '1', '2016-12-01 11:54:17', '1', '2016-12-01 12:01:33');
INSERT INTO `options` VALUES ('8', 'relate_article_number', '8', '1', '2016-12-21 10:00:38', '1', '2016-12-21 10:00:38');
INSERT INTO `options` VALUES ('9', 'cdn_url', '', '1', '2016-12-22 12:16:41', '1', '2016-12-24 15:51:59');

-- ----------------------------
-- Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签ID',
  `tag_name` varchar(50) NOT NULL COMMENT '标签名称',
  `slug` varchar(50) NOT NULL DEFAULT '' COMMENT '标签缩略名',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '标签状态 0：删除',
  `create_by` int(10) unsigned NOT NULL COMMENT '创建者',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `modify_by` int(10) unsigned NOT NULL COMMENT '修改者',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`tid`),
  UNIQUE KEY `UQ_TAG_NAME` (`tag_name`),
  KEY `INDEX_SLUG` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COMMENT='标签表';

-- ----------------------------
-- Records of tags
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(64) NOT NULL COMMENT '密码',
  `realname` varchar(50) NOT NULL COMMENT '用户真实姓名',
  `phone_number` varchar(20) NOT NULL COMMENT '联系方式 ',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '用户简介',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 1：激活 0：冻结',
  `create_by` int(10) unsigned NOT NULL COMMENT '创建者',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `modify_by` int(10) unsigned NOT NULL COMMENT '修改者',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UQ_USERNAME` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '$2a$08$a5xQpBGe70h2giRTST9KYOoNuKZMFFW2vRJj50t5Yy00dEtPUQKJi', 'admin1', '15866669999', '', '1', '1', '2016-10-24 22:58:44', '1', '2016-10-24 22:58:44');
