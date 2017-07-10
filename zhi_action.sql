/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : myhome

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-07-10 14:56:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zhi_action
-- ----------------------------
DROP TABLE IF EXISTS `zhi_action`;
CREATE TABLE `zhi_action` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `act_name` varchar(60) DEFAULT NULL,
  `act_head_url` varchar(128) DEFAULT NULL,
  `act_time` datetime DEFAULT NULL,
  `act_desc` text,
  `act_platform` varchar(60) DEFAULT NULL COMMENT '平台名称',
  `act_player_url` varchar(255) DEFAULT NULL COMMENT '平台播放地址',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `admin_id` int(6) DEFAULT NULL,
  `type_id` smallint(6) DEFAULT NULL,
  `is_show` tinyint(4) DEFAULT '0' COMMENT '是否显示',
  `is_over` tinyint(4) DEFAULT '0' COMMENT '是否完赛',
  `is_hot` tinyint(4) DEFAULT '0' COMMENT '是否热门',
  `is_good` tinyint(4) DEFAULT '0' COMMENT '是否精华',
  `is_del` tinyint(4) DEFAULT '0' COMMENT '软删除',
  PRIMARY KEY (`act_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zhi_action
-- ----------------------------
INSERT INTO `zhi_action` VALUES ('1', '啊打', '/Upload/zhibo/123.png', '2017-07-10 11:40:22', '啊打主播呀', '传媒播放平台', null, '0000-00-00 00:00:00', '3', '8', '1', '0', '0', '0', '0');
INSERT INTO `zhi_action` VALUES ('2', '张三', '/Upload/zhibo/456.png', '2017-08-01 11:44:36', '张三唱吧', '三吧平台', null, '2017-07-10 11:45:07', '2', '9', '1', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for zhi_action_type
-- ----------------------------
DROP TABLE IF EXISTS `zhi_action_type`;
CREATE TABLE `zhi_action_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(32) DEFAULT NULL,
  `type_desc` varchar(64) DEFAULT NULL,
  `is_show` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zhi_action_type
-- ----------------------------
INSERT INTO `zhi_action_type` VALUES ('8', '你我他', '真正的三人行，包罗万象。', '1');
INSERT INTO `zhi_action_type` VALUES ('9', '人间有爱', '不管你爱不爱，人间都会有爱；不管你恨不恨，人间也会有恨。', '1');
INSERT INTO `zhi_action_type` VALUES ('11', '第一等', '你的等呀', '1');

-- ----------------------------
-- Table structure for zhi_admin
-- ----------------------------
DROP TABLE IF EXISTS `zhi_admin`;
CREATE TABLE `zhi_admin` (
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
-- Records of zhi_admin
-- ----------------------------
INSERT INTO `zhi_admin` VALUES ('1', 'admin', 0xE10ADC3949BA59ABBE56E057F20F883E, '0', '超级管理员', '15811867789', '84656855@qq.com', '1', '2016-11-11', '2016-11-04 23:37:33', null, '走走停停，一路顺景');
INSERT INTO `zhi_admin` VALUES ('2', 'test', 0xE10ADC3949BA59ABBE56E057F20F883E, '3', '你妈来了', '13838383838', '8899@admin.com', '2', '0000-00-00', '2016-11-11 00:16:05', null, 'byebye');
INSERT INTO `zhi_admin` VALUES ('4', 'good', 0xE10ADC3949BA59ABBE56E057F20F883E, '2', null, null, null, '0', null, '2016-11-11 22:44:27', null, null);

-- ----------------------------
-- Table structure for zhi_role
-- ----------------------------
DROP TABLE IF EXISTS `zhi_role`;
CREATE TABLE `zhi_role` (
  `role_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(32) DEFAULT NULL,
  `role_desc` varchar(255) DEFAULT NULL,
  `role_power` text,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zhi_role
-- ----------------------------
INSERT INTO `zhi_role` VALUES ('2', '你是谁', '没有人会想你的', 'index/web_set,index/pass,action/atype,action/add_type,action/edit_type,action/del_type,action/action_list,action/action_add,action/action_edit,action/action_del,admin/role_list,admin/role_add,admin/role_edit,admin/role_del,admin/admin_list,admin/admin_add,admin/admin_edit,admin/admin_del');
INSERT INTO `zhi_role` VALUES ('3', 'test', 'test', 'index/web_set,index/pass,action/atype,action/add_type,action/edit_type,action/del_type,action/action_list,action/action_add,action/action_edit,action/action_del,admin/role_list,admin/role_add,admin/role_edit,admin/role_del,admin/admin_list,admin/admin_add,admin/admin_edit,admin/admin_del');
