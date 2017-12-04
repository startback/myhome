/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : myhome

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-12-04 14:49:01
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=219 DEFAULT CHARSET=utf8;

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
-- Table structure for ttf_common_skill
-- ----------------------------
DROP TABLE IF EXISTS `ttf_common_skill`;
CREATE TABLE `ttf_common_skill` (
  `common_skill_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `common_skill_name` varchar(36) DEFAULT NULL,
  `common_skill_logo` varchar(128) DEFAULT NULL,
  `common_skill_desc` text,
  `common_skill_time` datetime DEFAULT NULL,
  `common_skill_attack` varchar(255) DEFAULT '0',
  `common_skill_magic` varchar(255) DEFAULT '0',
  `common_skill_hp` varchar(255) DEFAULT '0',
  `common_skill_mp` varchar(255) DEFAULT '0',
  `common_skill_attack_defense` varchar(255) DEFAULT '0',
  `common_skill_magic_defense` varchar(255) DEFAULT '0',
  `common_skill_dodge` varchar(255) DEFAULT '0',
  `common_skill_direct` varchar(255) DEFAULT '0',
  `common_skill_crit` varchar(255) DEFAULT '0',
  `common_skill_hp_regain` varchar(255) DEFAULT '0',
  `common_skill_mp_regain` varchar(255) DEFAULT '0',
  `common_skill_gold_hurt` varchar(255) DEFAULT NULL,
  `common_skill_wood_hurt` varchar(255) DEFAULT NULL,
  `common_skill_water_hurt` varchar(255) DEFAULT NULL,
  `common_skill_fire_hurt` varchar(255) DEFAULT NULL,
  `common_skill_earth_hurt` varchar(255) DEFAULT NULL,
  `common_skill_keep_num` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`common_skill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ttf_goods
-- ----------------------------
DROP TABLE IF EXISTS `ttf_goods`;
CREATE TABLE `ttf_goods` (
  `goods_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_type` smallint(6) DEFAULT '0',
  `goods_name` varchar(36) DEFAULT NULL,
  `goods_logo` varchar(128) DEFAULT NULL,
  `goods_desc` text,
  `goods_time` datetime DEFAULT NULL,
  `goods_attack` smallint(6) DEFAULT '0',
  `goods_magic` smallint(6) DEFAULT '0',
  `goods_hp` int(11) DEFAULT '0',
  `goods_mp` int(11) DEFAULT '0',
  `goods_attack_defense` smallint(6) DEFAULT '0',
  `goods_magic_defense` smallint(6) DEFAULT '0',
  `goods_dodge` smallint(6) DEFAULT '0',
  `goods_direct` smallint(6) DEFAULT '0',
  `goods_crit` smallint(6) DEFAULT '0',
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ttf_level_experience
-- ----------------------------
DROP TABLE IF EXISTS `ttf_level_experience`;
CREATE TABLE `ttf_level_experience` (
  `level` smallint(6) NOT NULL,
  `experience` int(11) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Table structure for ttf_maze_monster_goods
-- ----------------------------
DROP TABLE IF EXISTS `ttf_maze_monster_goods`;
CREATE TABLE `ttf_maze_monster_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `maze_id` smallint(11) NOT NULL DEFAULT '0',
  `floor` smallint(6) NOT NULL,
  `monster_ids` varchar(255) DEFAULT NULL,
  `goods_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ttf_monster
-- ----------------------------
DROP TABLE IF EXISTS `ttf_monster`;
CREATE TABLE `ttf_monster` (
  `monster_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `monster_type` smallint(6) DEFAULT '0',
  `monster_level` smallint(6) DEFAULT NULL,
  `monster_name` varchar(36) DEFAULT NULL,
  `monster_logo` varchar(128) DEFAULT NULL,
  `monster_desc` text,
  `monster_time` datetime DEFAULT NULL,
  `monster_attack` smallint(6) DEFAULT '0',
  `monster_magic` smallint(6) DEFAULT '0',
  `monster_hp` int(11) DEFAULT '0',
  `monster_mp` int(11) DEFAULT '0',
  `monster_attack_defense` smallint(6) DEFAULT '0',
  `monster_magic_defense` smallint(6) DEFAULT '0',
  `monster_dodge` smallint(6) DEFAULT '0',
  `monster_direct` smallint(6) DEFAULT '0',
  `monster_crit` smallint(6) DEFAULT '0',
  `monster_role_skill_id` varchar(255) DEFAULT '0',
  `monster_common_skill_ids` varchar(255) DEFAULT NULL,
  `monster_goods` varchar(255) DEFAULT NULL,
  `monster_kill_experience` int(11) DEFAULT NULL,
  PRIMARY KEY (`monster_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
-- Table structure for ttf_role
-- ----------------------------
DROP TABLE IF EXISTS `ttf_role`;
CREATE TABLE `ttf_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_type` smallint(6) DEFAULT '0',
  `role_name` varchar(36) DEFAULT NULL,
  `role_logo` varchar(128) DEFAULT NULL,
  `role_desc` text,
  `role_time` datetime DEFAULT NULL,
  `role_attack` varchar(255) DEFAULT '0',
  `role_magic` varchar(255) DEFAULT '0',
  `role_hp` varchar(255) DEFAULT '0',
  `role_mp` varchar(255) DEFAULT '0',
  `role_attack_defense` varchar(255) DEFAULT '0',
  `role_magic_defense` varchar(255) DEFAULT '0',
  `role_dodge` varchar(255) DEFAULT '0',
  `role_direct` varchar(255) DEFAULT '0',
  `role_crit` varchar(255) DEFAULT '0',
  `role_skill_id` smallint(6) DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ttf_role_maze_record
-- ----------------------------
DROP TABLE IF EXISTS `ttf_role_maze_record`;
CREATE TABLE `ttf_role_maze_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `maze_id` smallint(6) DEFAULT '0',
  `user_role_id` int(11) DEFAULT NULL,
  `user_orther_role_ids` varchar(32) DEFAULT NULL,
  `maze_now_floor` smallint(6) DEFAULT '1',
  `maze_now_monster_ids` varchar(255) DEFAULT NULL,
  `maze_now_goods_ids` varchar(255) DEFAULT NULL,
  `begin_time` datetime DEFAULT NULL,
  `maze_now_is_over` tinyint(4) DEFAULT '0',
  `max_height_floor` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ttf_role_maze_record_log
-- ----------------------------
DROP TABLE IF EXISTS `ttf_role_maze_record_log`;
CREATE TABLE `ttf_role_maze_record_log` (
  `log_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `maze_id` smallint(6) DEFAULT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `user_other_role_ids` varchar(32) DEFAULT NULL,
  `floor` smallint(6) DEFAULT NULL,
  `maze_monster_ids` varchar(255) DEFAULT NULL,
  `kill_monster_ids` varchar(255) DEFAULT NULL,
  `maze_goods_ids` varchar(255) DEFAULT NULL,
  `get_goods_ids` varchar(255) DEFAULT NULL,
  `roles_get_expericnce` varchar(255) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `role_skill_attack` varchar(255) DEFAULT '0',
  `role_skill_magic` varchar(255) DEFAULT '0',
  `role_skill_hp` varchar(255) DEFAULT '0',
  `role_skill_mp` varchar(255) DEFAULT '0',
  `role_skill_attack_defense` varchar(255) DEFAULT '0',
  `role_skill_magic_defense` varchar(255) DEFAULT '0',
  `role_skill_dodge` varchar(255) DEFAULT '0',
  `role_skill_direct` varchar(255) DEFAULT '0',
  `role_skill_crit` varchar(255) DEFAULT '0',
  `role_skill_hp_regain` varchar(255) DEFAULT '0',
  `role_skill_mp_regain` varchar(255) DEFAULT '0',
  `role_skill_gold_hurt` varchar(255) DEFAULT NULL,
  `role_skill_wood_hurt` varchar(255) DEFAULT NULL,
  `role_skill_water_hurt` varchar(255) DEFAULT NULL,
  `role_skill_fire_hurt` varchar(255) DEFAULT NULL,
  `role_skill_earth_hurt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_skill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ttf_user_goods
-- ----------------------------
DROP TABLE IF EXISTS `ttf_user_goods`;
CREATE TABLE `ttf_user_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `goods_id` int(11) DEFAULT '0',
  `add_time` datetime DEFAULT NULL,
  `attack` smallint(6) DEFAULT '0',
  `magic` smallint(6) DEFAULT '0',
  `hp` int(11) DEFAULT '0',
  `mp` int(11) DEFAULT '0',
  `attack_defense` smallint(6) DEFAULT '0',
  `magic_defense` smallint(6) DEFAULT '0',
  `dodge` smallint(6) DEFAULT '0',
  `direct` smallint(6) DEFAULT '0',
  `crit` smallint(6) DEFAULT '0',
  `add_experience` int(11) DEFAULT NULL,
  `skill_id` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ttf_user_info
-- ----------------------------
DROP TABLE IF EXISTS `ttf_user_info`;
CREATE TABLE `ttf_user_info` (
  `user_id` int(11) unsigned NOT NULL,
  `user_ttbi` int(11) DEFAULT '0',
  `user_gold` int(11) DEFAULT '0',
  `user_vip` tinyint(4) DEFAULT '0',
  `user_role_id` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ttf_user_monster
-- ----------------------------
DROP TABLE IF EXISTS `ttf_user_monster`;
CREATE TABLE `ttf_user_monster` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `monster_id` smallint(6) DEFAULT '0',
  `monster_level` smallint(6) DEFAULT NULL,
  `monster_experience` int(11) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `attack` smallint(6) DEFAULT '0',
  `magic` smallint(6) DEFAULT '0',
  `hp` int(11) DEFAULT '0',
  `mp` int(11) DEFAULT '0',
  `attack_defense` smallint(6) DEFAULT '0',
  `magic_defense` smallint(6) DEFAULT '0',
  `dodge` smallint(6) DEFAULT '0',
  `direct` smallint(6) DEFAULT '0',
  `crit` smallint(6) DEFAULT '0',
  `skill_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ttf_user_role
-- ----------------------------
DROP TABLE IF EXISTS `ttf_user_role`;
CREATE TABLE `ttf_user_role` (
  `user_role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `role_id` smallint(6) DEFAULT '0',
  `level` smallint(6) DEFAULT '1',
  `experience` int(11) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `attack` smallint(6) DEFAULT '0',
  `magic` smallint(6) DEFAULT '0',
  `hp` int(11) DEFAULT '0',
  `mp` int(11) DEFAULT '0',
  `attack_defense` smallint(6) DEFAULT '0',
  `magic_defense` smallint(6) DEFAULT '0',
  `dodge` smallint(6) DEFAULT '0',
  `direct` smallint(6) DEFAULT '0',
  `crit` smallint(6) DEFAULT '0',
  `role_skill_id` smallint(6) DEFAULT NULL,
  `role_skill_level` smallint(6) DEFAULT NULL,
  `skill_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
