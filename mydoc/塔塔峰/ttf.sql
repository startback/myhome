/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : myhome

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-11-10 14:33:45
*/

SET FOREIGN_KEY_CHECKS=0;

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
  `role_hp` smallint(6) DEFAULT NULL,
  `role_mp` smallint(6) DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_user
-- ----------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_user_info
-- ----------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttf_user_role
-- ----------------------------
