/*
Navicat MySQL Data Transfer

Source Server         : 192.168.0.200
Source Server Version : 50718
Source Host           : 192.168.0.200:3306
Source Database       : member

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2017-10-24 13:28:02
*/

SET FOREIGN_KEY_CHECKS=0;

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
