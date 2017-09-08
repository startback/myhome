/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : myhome

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-08 11:26:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for game_action_log
-- ----------------------------
DROP TABLE IF EXISTS `game_action_log`;
CREATE TABLE `game_action_log` (
  `number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开奖期数',
  `date_time` datetime DEFAULT NULL,
  `res_num` smallint(6) DEFAULT '0',
  `add_time` datetime DEFAULT NULL,
  `hope_num` varchar(255) DEFAULT NULL,
  `hope_res` varchar(10) DEFAULT NULL,
  `score` varchar(30) DEFAULT NULL,
  `tag` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of game_action_log
-- ----------------------------
INSERT INTO `game_action_log` VALUES ('1151243', '2017-09-08 11:22:00', '8', '2017-09-08 11:25:41', '2,3,5,6,7,8,9,10,', '对', '0/0', '急速11');
