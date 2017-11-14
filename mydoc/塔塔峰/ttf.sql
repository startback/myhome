/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : myhome

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-11-14 17:35:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ttf_admin
-- ----------------------------
DROP TABLE IF EXISTS `ttf_admin`;
CREATE TABLE `ttf_admin` (
  `admin_id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `ip_address` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_admin
-- ----------------------------
INSERT INTO `ttf_admin` VALUES ('1', 'admin', 0xE10ADC3949BA59ABBE56E057F20F883E, '0', '超级管理员', '15811867789', '84656855@qq.com', '1', '2016-11-11', '2016-11-04 23:37:33', '2017-11-14 16:52:18', '走走停停，一路顺景', '127.0.0.1');
INSERT INTO `ttf_admin` VALUES ('5', 'admin123', 0xE10ADC3949BA59ABBE56E057F20F883E, '4', '', '', '', '0', '2017-04-05', '2017-07-11 10:14:32', null, '', null);

-- ----------------------------
-- Table structure for ttf_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `ttf_admin_log`;
CREATE TABLE `ttf_admin_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_time` datetime DEFAULT NULL,
  `log_info` varchar(255) DEFAULT NULL,
  `admin_id` smallint(6) DEFAULT NULL,
  `ip_address` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_admin_log
-- ----------------------------
INSERT INTO `ttf_admin_log` VALUES ('1', '2017-11-14 16:38:17', 'admin 登录系统', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('2', '2017-11-14 16:44:23', 'admin 登录系统', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('3', '2017-11-14 16:46:13', '修改密码，ID为1', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('4', '2017-11-14 16:46:31', 'admin 登录系统', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('5', '2017-11-14 16:46:52', '修改密码，ID为1', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('6', '2017-11-14 16:49:33', 'admin 登录系统', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('7', '2017-11-14 16:52:18', 'admin 登录系统', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('8', '2017-11-14 16:56:28', '增加权限角色，编号为:4', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('9', '2017-11-14 16:56:43', '修改管理员，编号为:5', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('10', '2017-11-14 16:56:52', '删除管理员，编号为:4', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('11', '2017-11-14 16:57:12', '修改管理员，编号为:1', '1', '127.0.0.1');
INSERT INTO `ttf_admin_log` VALUES ('12', '2017-11-14 16:57:21', '修改管理员，编号为:1', '1', '127.0.0.1');

-- ----------------------------
-- Table structure for ttf_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `ttf_admin_role`;
CREATE TABLE `ttf_admin_role` (
  `role_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(32) DEFAULT NULL,
  `role_desc` varchar(255) DEFAULT NULL,
  `role_power` text,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_admin_role
-- ----------------------------
INSERT INTO `ttf_admin_role` VALUES ('4', '你是谁的员', '你是谁的员', 'index/web_set,index/pass,admin/role_list,admin/role_add,admin/role_edit,admin/role_del,admin/admin_list,admin/admin_add,admin/admin_edit,admin/admin_del,admin/admin_log_list');

-- ----------------------------
-- Table structure for ttf_common_skill
-- ----------------------------
DROP TABLE IF EXISTS `ttf_common_skill`;
CREATE TABLE `ttf_common_skill` (
  `common_skill_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `common_skill_name` varchar(36) DEFAULT NULL,
  `common_skill_logo` varchar(128) DEFAULT NULL,
  `common_skill_desc` text,
  `common_skill_time` datetime DEFAULT NULL,
  `common_skill_attack` smallint(6) DEFAULT NULL,
  `common_skill_magic` smallint(6) DEFAULT NULL,
  `common_skill_hp` smallint(6) DEFAULT NULL,
  `common_skill_mp` smallint(6) DEFAULT NULL,
  `common_skill_attack_defense` smallint(6) DEFAULT NULL,
  `common_skill_magic_defense` smallint(6) DEFAULT NULL,
  `common_skill_dodge` smallint(6) DEFAULT NULL,
  `common_skill_direct` smallint(6) DEFAULT NULL,
  `common_skill_crit` smallint(6) DEFAULT NULL,
  `common_skill_hp_regain` smallint(6) DEFAULT NULL,
  `common_skill_mp_regain` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`common_skill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_common_skill
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_goods
-- ----------------------------
DROP TABLE IF EXISTS `ttf_goods`;
CREATE TABLE `ttf_goods` (
  `goods_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_type` smallint(6) DEFAULT NULL,
  `goods_name` varchar(36) DEFAULT NULL,
  `goods_logo` varchar(128) DEFAULT NULL,
  `goods_desc` text,
  `goods_time` datetime DEFAULT NULL,
  `goods_attack` smallint(6) DEFAULT NULL,
  `goods_magic` smallint(6) DEFAULT NULL,
  `goods_hp` int(11) DEFAULT NULL,
  `goods_mp` int(11) DEFAULT NULL,
  `goods_attack_defense` smallint(6) DEFAULT NULL,
  `goods_magic_defense` smallint(6) DEFAULT NULL,
  `goods_dodge` smallint(6) DEFAULT NULL,
  `goods_direct` smallint(6) DEFAULT NULL,
  `goods_crit` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_goods
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_maze
-- ----------------------------
DROP TABLE IF EXISTS `ttf_maze`;
CREATE TABLE `ttf_maze` (
  `maze_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `maze_name` varchar(36) DEFAULT NULL,
  `maze_logo` varchar(128) DEFAULT NULL,
  `maze_desc` text,
  `maze_time` datetime DEFAULT NULL,
  PRIMARY KEY (`maze_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_maze
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_maze_monster_goods
-- ----------------------------
DROP TABLE IF EXISTS `ttf_maze_monster_goods`;
CREATE TABLE `ttf_maze_monster_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `maze_id` int(11) DEFAULT NULL,
  `monster_ids` varchar(255) DEFAULT NULL,
  `goods_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_maze_monster_goods
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_monster
-- ----------------------------
DROP TABLE IF EXISTS `ttf_monster`;
CREATE TABLE `ttf_monster` (
  `monster_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `monster_type` smallint(6) DEFAULT NULL,
  `monster_name` varchar(36) DEFAULT NULL,
  `monster_logo` varchar(128) DEFAULT NULL,
  `monster_desc` text,
  `monster_time` datetime DEFAULT NULL,
  `monster_attack` smallint(6) DEFAULT NULL,
  `monster_magic` smallint(6) DEFAULT NULL,
  `monster_hp` int(11) DEFAULT NULL,
  `monster_mp` int(11) DEFAULT NULL,
  `monster_attack_defense` smallint(6) DEFAULT NULL,
  `monster_magic_defense` smallint(6) DEFAULT NULL,
  `monster_dodge` smallint(6) DEFAULT NULL,
  `monster_direct` smallint(6) DEFAULT NULL,
  `monster_crit` smallint(6) DEFAULT NULL,
  `monster_skill_ids` varchar(255) DEFAULT NULL,
  `monster_goods` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`monster_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_monster
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_province
-- ----------------------------
DROP TABLE IF EXISTS `ttf_province`;
CREATE TABLE `ttf_province` (
  `province_id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `province_name` varchar(36) DEFAULT NULL,
  `province_logo` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_province
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_role
-- ----------------------------
DROP TABLE IF EXISTS `ttf_role`;
CREATE TABLE `ttf_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_type` smallint(6) DEFAULT NULL,
  `role_name` varchar(36) DEFAULT NULL,
  `role_logo` varchar(128) DEFAULT NULL,
  `role_desc` text,
  `role_time` datetime DEFAULT NULL,
  `role_attack` smallint(6) DEFAULT NULL,
  `role_magic` smallint(6) DEFAULT NULL,
  `role_hp` int(6) DEFAULT NULL,
  `role_mp` int(6) DEFAULT NULL,
  `role_attack_defense` smallint(6) DEFAULT NULL,
  `role_magic_defense` smallint(6) DEFAULT NULL,
  `role_dodge` smallint(6) DEFAULT NULL,
  `role_direct` smallint(6) DEFAULT NULL,
  `role_crit` smallint(6) DEFAULT NULL,
  `role_skill_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_role
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_role_maze_record
-- ----------------------------
DROP TABLE IF EXISTS `ttf_role_maze_record`;
CREATE TABLE `ttf_role_maze_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `maze_id` smallint(6) DEFAULT NULL,
  `maze_now_floor` smallint(6) DEFAULT NULL,
  `maze_now_monster_ids` varchar(255) DEFAULT NULL,
  `maze_now_goods_ids` varchar(255) DEFAULT NULL,
  `begin_time` datetime DEFAULT NULL,
  `maze_now_is_over` tinyint(4) DEFAULT '0',
  `max_height_floor` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_role_maze_record
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_role_skill
-- ----------------------------
DROP TABLE IF EXISTS `ttf_role_skill`;
CREATE TABLE `ttf_role_skill` (
  `role_skill_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_skill_name` varchar(36) DEFAULT NULL,
  `role_skill_logo` varchar(128) DEFAULT NULL,
  `role_skill_desc` text,
  `role_skill_time` datetime DEFAULT NULL,
  `role_skill_attact` smallint(6) DEFAULT NULL,
  `role_skill_magic` smallint(6) DEFAULT NULL,
  `role_skill_hp` smallint(6) DEFAULT NULL,
  `role_skill_mp` smallint(6) DEFAULT NULL,
  `role_skill_attack_defense` smallint(6) DEFAULT NULL,
  `role_skill_magic_defense` smallint(6) DEFAULT NULL,
  `role_skill_dodge` smallint(6) DEFAULT NULL,
  `role_skill_direct` smallint(6) DEFAULT NULL,
  `role_skill_crit` smallint(6) DEFAULT NULL,
  `role_skill_hp_regain` smallint(6) DEFAULT NULL,
  `role_skill_mp_regain` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`role_skill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_role_skill
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_type
-- ----------------------------
DROP TABLE IF EXISTS `ttf_type`;
CREATE TABLE `ttf_type` (
  `type_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `type_pid` smallint(6) DEFAULT '0',
  `type_name` varchar(36) DEFAULT NULL,
  `type_logo` varchar(128) DEFAULT NULL,
  `type_desc` text,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_type
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_user
-- ----------------------------
DROP TABLE IF EXISTS `ttf_user`;
CREATE TABLE `ttf_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(36) DEFAULT NULL,
  `user_pass` binary(16) DEFAULT NULL,
  `user_phone` char(11) DEFAULT NULL,
  `user_sex` tinyint(4) DEFAULT '0',
  `user_head` varchar(128) DEFAULT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_reg_time` datetime DEFAULT NULL,
  `user_login_time` datetime DEFAULT NULL,
  `user_qq_id` varchar(32) DEFAULT NULL,
  `user_weixin_id` varchar(255) DEFAULT NULL,
  `user_status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_user
-- ----------------------------
INSERT INTO `ttf_user` VALUES ('14', 'ttf_1581****7789', 0xE10ADC3949BA59ABBE56E057F20F883E, '15811867789', '0', null, null, '2017-11-14 11:37:25', '2017-11-14 11:43:09', null, null, '0');

-- ----------------------------
-- Table structure for ttf_user_goods
-- ----------------------------
DROP TABLE IF EXISTS `ttf_user_goods`;
CREATE TABLE `ttf_user_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `attack` smallint(6) DEFAULT NULL,
  `magic` smallint(6) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `mp` int(11) DEFAULT NULL,
  `attack_defense` smallint(6) DEFAULT NULL,
  `magic_defnese` smallint(6) DEFAULT NULL,
  `dodge` smallint(6) DEFAULT NULL,
  `direct` smallint(6) DEFAULT NULL,
  `crit` smallint(6) DEFAULT NULL,
  `skill_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_user_goods
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_user_info
-- ----------------------------
DROP TABLE IF EXISTS `ttf_user_info`;
CREATE TABLE `ttf_user_info` (
  `user_id` int(11) unsigned NOT NULL,
  `user_ttbi` int(11) DEFAULT NULL,
  `user_gold` int(11) DEFAULT NULL,
  `user_vip` tinyint(4) DEFAULT '0',
  `user_role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_user_info
-- ----------------------------
INSERT INTO `ttf_user_info` VALUES ('14', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for ttf_user_monster
-- ----------------------------
DROP TABLE IF EXISTS `ttf_user_monster`;
CREATE TABLE `ttf_user_monster` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `monster_id` smallint(6) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `attack` smallint(6) DEFAULT NULL,
  `magic` smallint(6) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `mp` int(11) DEFAULT NULL,
  `attack_defense` smallint(6) DEFAULT NULL,
  `magic_defnese` smallint(6) DEFAULT NULL,
  `dodge` smallint(6) DEFAULT NULL,
  `direct` smallint(6) DEFAULT NULL,
  `crit` smallint(6) DEFAULT NULL,
  `skill_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_user_monster
-- ----------------------------

-- ----------------------------
-- Table structure for ttf_user_role
-- ----------------------------
DROP TABLE IF EXISTS `ttf_user_role`;
CREATE TABLE `ttf_user_role` (
  `user_role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` smallint(6) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `attack` smallint(6) DEFAULT NULL,
  `magic` smallint(6) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `mp` int(11) DEFAULT NULL,
  `attack_defense` smallint(6) DEFAULT NULL,
  `magic_defense` smallint(6) DEFAULT NULL,
  `dodge` smallint(6) DEFAULT NULL,
  `direct` smallint(6) DEFAULT NULL,
  `crit` smallint(6) DEFAULT NULL,
  `skill_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_user_role
-- ----------------------------
INSERT INTO `ttf_user_role` VALUES ('1', '14', '1', '2017-11-14 11:37:25', '2', '1', '10', '10', '1', '1', '1', '1', '2', '1');
