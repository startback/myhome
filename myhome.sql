/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : myhome

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-16 00:54:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `my_admin`
-- ----------------------------
DROP TABLE IF EXISTS `my_admin`;
CREATE TABLE `my_admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_account` varchar(32) DEFAULT NULL,
  `admin_pass` binary(16) DEFAULT NULL,
  `admin_role_id` smallint(6) DEFAULT NULL,
  `admin_name` varchar(32) DEFAULT NULL,
  `admin_phone` char(11) DEFAULT NULL,
  `admin_email` varchar(64) DEFAULT NULL,
  `admin_sex` tinyint(4) DEFAULT '0',
  `admin_birthday` date DEFAULT NULL,
  `admin_register_time` datetime DEFAULT NULL,
  `admin_login_time` datetime DEFAULT NULL,
  `admin_tag` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_admin
-- ----------------------------
INSERT INTO `my_admin` VALUES ('1', 'admin', 0xE10ADC3949BA59ABBE56E057F20F883E, '0', '超级管理员', '15811867789', '84656855@qq.com', '1', '2016-11-11', '2016-11-04 23:37:33', null, '走走停停，一路顺景');
INSERT INTO `my_admin` VALUES ('2', 'test', 0xE10ADC3949BA59ABBE56E057F20F883E, '3', '你妈来了', '13838383838', '8899@admin.com', '2', '0000-00-00', '2016-11-11 00:16:05', null, 'byebye');
INSERT INTO `my_admin` VALUES ('4', 'good', 0xE10ADC3949BA59ABBE56E057F20F883E, '2', null, null, null, '0', null, '2016-11-11 22:44:27', null, null);

-- ----------------------------
-- Table structure for `my_album`
-- ----------------------------
DROP TABLE IF EXISTS `my_album`;
CREATE TABLE `my_album` (
  `album_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album_name` varchar(32) DEFAULT NULL,
  `album_origin_url` varchar(128) DEFAULT NULL,
  `album_thumb_url` varchar(128) DEFAULT NULL,
  `album_desc` varchar(255) DEFAULT NULL,
  `album_time` datetime DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `album_tag` varchar(64) DEFAULT NULL,
  `type_id` smallint(6) DEFAULT '0',
  `top_order` tinyint(4) DEFAULT '0',
  `is_top` tinyint(4) DEFAULT '0',
  `is_hot` tinyint(4) DEFAULT '0',
  `is_show` tinyint(4) DEFAULT '1',
  `is_recommend` tinyint(4) DEFAULT '0',
  `read_num` int(11) DEFAULT '0',
  `prize_num` int(11) DEFAULT '0',
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_album
-- ----------------------------
INSERT INTO `my_album` VALUES ('5', '你错就错吧4564', '/Upload/album/origin/f39e2ee248bcd1600a81ed6b884f06b5.jpg', '/Upload/album/thumb/f39e2ee248bcd1600a81ed6b884f06b5_thumb.jpg', 'asdfasd', '2016-11-13 01:07:41', '1', '', '3', '0', '0', '0', '1', '0', '0', '0');
INSERT INTO `my_album` VALUES ('6', '你错就错吧4564', '/Upload/album/origin/3c562b6874f4f2c59b0c73ed48973113.jpg', '/Upload/album/thumb/3c562b6874f4f2c59b0c73ed48973113_thumb.jpg', 'asdfasd', '2016-11-13 01:07:41', '1', '', '3', '0', '0', '0', '1', '0', '0', '0');
INSERT INTO `my_album` VALUES ('7', '不是你的错', '/Upload/album/origin/32bc2b2de012ab68b903787ac469e35c.jpg', '/Upload/album/thumb/32bc2b2de012ab68b903787ac469e35c_thumb.jpg', 'as', '2016-11-13 12:02:52', '1', '大123123', '3', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `my_album` VALUES ('8', '你错就错吧4564', '/Upload/album/origin/f39e2ee248bcd1600a81ed6b884f06b5.jpg', '/Upload/album/thumb/f39e2ee248bcd1600a81ed6b884f06b5_thumb.jpg', '在雪', '2016-11-13 12:03:28', '1', '99888', '4', '0', '1', '1', '1', '0', '0', '0');
INSERT INTO `my_album` VALUES ('9', '你错就错吧4564', '/Upload/album/origin/bc21ea5d46e07a446c4a5cfff9ebc5a6.jpg', '/Upload/album/thumb/bc21ea5d46e07a446c4a5cfff9ebc5a6_thumb.jpg', '在雪', '2016-11-13 12:03:28', '1', '99888', '4', '0', '1', '1', '1', '0', '0', '0');
INSERT INTO `my_album` VALUES ('10', '你错就错吧4564', '/Upload/album/origin/07dfa6080f659a5f93a608fa9c39037a.jpg', '/Upload/album/thumb/07dfa6080f659a5f93a608fa9c39037a_thumb.jpg', '在雪', '2016-11-13 12:03:28', '1', '99888', '4', '0', '1', '1', '1', '0', '0', '0');
INSERT INTO `my_album` VALUES ('11', '你错', '/Upload/album/origin/44f6fbc9d8a492d945aa7949602c2017.jpg', '/Upload/album/thumb/44f6fbc9d8a492d945aa7949602c2017_thumb.jpg', '在雪546464', '2016-11-13 12:03:28', '1', '99888', '4', '0', '0', '1', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `my_album_type`
-- ----------------------------
DROP TABLE IF EXISTS `my_album_type`;
CREATE TABLE `my_album_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(32) DEFAULT NULL,
  `type_desc` varchar(64) DEFAULT NULL,
  `is_show` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_album_type
-- ----------------------------
INSERT INTO `my_album_type` VALUES ('3', '你好呀', '不是你的错', '1');
INSERT INTO `my_album_type` VALUES ('4', '好', '不好？', '1');
INSERT INTO `my_album_type` VALUES ('5', '你真好', '来吧', '1');

-- ----------------------------
-- Table structure for `my_article`
-- ----------------------------
DROP TABLE IF EXISTS `my_article`;
CREATE TABLE `my_article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_title` varchar(64) DEFAULT NULL,
  `article_img` varchar(128) DEFAULT NULL,
  `article_desc` varchar(255) DEFAULT NULL,
  `article_content` text,
  `article_time` datetime DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `article_tag` varchar(64) DEFAULT NULL,
  `type_id` smallint(6) DEFAULT '0',
  `is_show` tinyint(4) DEFAULT '0',
  `top_order` tinyint(4) DEFAULT '0',
  `is_top` tinyint(4) DEFAULT '0',
  `is_hot` tinyint(4) DEFAULT '0',
  `is_recommend` tinyint(4) DEFAULT '0',
  `read_num` int(11) DEFAULT '0',
  `comment_num` int(11) DEFAULT '0',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_article
-- ----------------------------
INSERT INTO `my_article` VALUES ('1', '你是谁呀？', null, '黄梅雨', '<p>真的好吗</p><p><img src=\"/ueditor/php/upload/image/20161108/1478619915209650.jpg\" title=\"1478619915209650.jpg\" alt=\"004.jpg\"/></p><p><img src=\"http://img.baidu.com/hi/jx2/j_0014.gif\"/></p><p>你来不来？</p>', '2016-11-08 23:45:33', '1', '好吧', '8', '1', '0', '1', '0', '0', '7', '0');
INSERT INTO `my_article` VALUES ('2', '不好吧', null, '你来吧', '<p>真的好吧</p>', '2016-11-08 23:47:34', '1', '', '9', '0', '0', '1', '0', '1', '0', '0');
INSERT INTO `my_article` VALUES ('5', '你不好吧', null, '我真的不好呀', '<p>花样百出</p>', '2016-11-08 23:51:19', '1', '', '9', '1', '0', '0', '1', '0', '9', '0');
INSERT INTO `my_article` VALUES ('7', '你快点来吧呀', '/Upload/article/c7c504086300ef2093c17e939e246c36.jpg', '苛苛123', '<p>说到底在</p><p><img src=\"http://img.baidu.com/hi/jx2/j_0024.gif\"/></p>', '2016-11-09 23:10:22', '1', '没有', '11', '0', '9', '1', '1', '0', '0', '0');
INSERT INTO `my_article` VALUES ('8', 'test123456', '/Upload/article/d6113bea888848aec3c3551e9eb67718.jpg', '你快来吧', '<p>不来也没关系，就是要……。</p>', '2016-11-15 00:18:51', '1', '', '8', '1', '0', '0', '0', '0', '0', '0');
INSERT INTO `my_article` VALUES ('10', '不是中工', '/Upload/article/f39e2ee248bcd1600a81ed6b884f06b5.jpg', '人间自有真情在', '<p>人间自有真情在</p><p>人间自有真情在</p><p>人间自有真情在</p><p><br/></p><p>人间自有真情在</p><p>人间自有真情在</p><p>人间自有真情在</p>', '2016-11-15 00:33:17', '1', '', '11', '1', '8', '1', '0', '1', '5', '0');
INSERT INTO `my_article` VALUES ('11', '我就是来看看', '/Upload/article/15a0ed2b54c0750ec3a86ce96a99631f.jpg', '你来不来看看，很好的呀！', '<p>枯</p><p>不与</p><p><span style=\"color: rgb(192, 80, 77);\"><strong><span style=\"font-size: 20px;\">枯枯 枯</span></strong></span></p><p><span style=\"color: rgb(192, 80, 77);\"><strong><span style=\"font-size: 20px;\"><img src=\"http://img.baidu.com/hi/tsj/t_0013.gif\"/></span></strong></span></p>', '2016-11-16 00:30:54', '1', '', '8', '1', '0', '0', '0', '0', '3', '0');

-- ----------------------------
-- Table structure for `my_article_type`
-- ----------------------------
DROP TABLE IF EXISTS `my_article_type`;
CREATE TABLE `my_article_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(32) DEFAULT NULL,
  `type_desc` varchar(64) DEFAULT NULL,
  `is_show` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_article_type
-- ----------------------------
INSERT INTO `my_article_type` VALUES ('8', '你我他', '真正的三人行，包罗万象。', '1');
INSERT INTO `my_article_type` VALUES ('9', '人间有爱', '不管你爱不爱，人间都会有爱；不管你恨不恨，人间也会有恨。', '1');
INSERT INTO `my_article_type` VALUES ('10', '友情饮水饱', '', '1');
INSERT INTO `my_article_type` VALUES ('11', '第一等', '你的等呀', '1');

-- ----------------------------
-- Table structure for `my_role`
-- ----------------------------
DROP TABLE IF EXISTS `my_role`;
CREATE TABLE `my_role` (
  `role_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(32) DEFAULT NULL,
  `role_desc` varchar(255) DEFAULT NULL,
  `role_power` text,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_role
-- ----------------------------
INSERT INTO `my_role` VALUES ('2', '你是谁', '没有人会想你的', 'index/web_set,index/pass,article/atype,article/add_type,article/edit_type,article/del_type,article/article_list,article/article_add,article/article_edit,article/article_del,album/atype,album/add_type,album/edit_type,album/del_type,album/album_list,album/album_add,album/album_edit,album/album_del,admin/role_list,admin/role_add,admin/role_edit,admin/role_del,admin/admin_list,admin/admin_add,admin/admin_edit,admin/admin_del');
INSERT INTO `my_role` VALUES ('3', 'test', 'test', 'index/web_set,index/pass,article/atype,article/add_type,article/edit_type,article/del_type,article/article_list,article/article_add,article/article_edit,article/article_del,album/atype,album/add_type,album/edit_type,album/del_type,album/album_list,album/album_add,album/album_edit,album/album_del,admin/role_list,admin/role_add,admin/role_edit,admin/role_del,admin/admin_list,admin/admin_add,admin/admin_edit,admin/admin_del');
