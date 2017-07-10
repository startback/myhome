/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : myhome

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-07-10 11:02:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api_comment
-- ----------------------------
DROP TABLE IF EXISTS `api_comment`;
CREATE TABLE `api_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_article_id` int(11) DEFAULT NULL,
  `comment_home_id` int(11) DEFAULT NULL,
  `comment_user_id` int(11) DEFAULT NULL,
  `comment_time` int(11) DEFAULT NULL,
  `comment_content` text,
  `comment_status` tinyint(4) DEFAULT '0' COMMENT '评论状态 0正常 1隐藏',
  `comment_is_delete` tinyint(4) DEFAULT '0' COMMENT '是否删除 0否 1是',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_comment
-- ----------------------------

-- ----------------------------
-- Table structure for api_home_article
-- ----------------------------
DROP TABLE IF EXISTS `api_home_article`;
CREATE TABLE `api_home_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_home_id` int(11) DEFAULT NULL,
  `article_title` varchar(128) DEFAULT NULL,
  `article_content` mediumtext,
  `article_time` int(11) DEFAULT NULL,
  `article_user_id` int(11) DEFAULT NULL,
  `article_type` tinyint(4) DEFAULT NULL,
  `article_is_open` tinyint(4) DEFAULT '1' COMMENT '文章是否公开 0否 1是',
  `article_is_out` tinyint(4) DEFAULT '0' COMMENT '文章是否游客可访问 0否 1是',
  `article_file_url` varchar(255) DEFAULT NULL,
  `article_desc` varchar(255) DEFAULT NULL,
  `article_click` int(11) DEFAULT '0',
  `article_reply` int(11) DEFAULT '0',
  `article_is_top` tinyint(4) DEFAULT '0' COMMENT '文章置顶 0否 1是',
  `article_is_good` tinyint(4) DEFAULT '0' COMMENT '文章精华 0否 1是',
  `article_is_recommend` tinyint(4) DEFAULT '0' COMMENT '文章推荐 0否 1是',
  `article_order_num` tinyint(4) DEFAULT '0' COMMENT '文章排序 越大越前(0-255)',
  `article_is_delete` tinyint(4) DEFAULT '0' COMMENT '文章删除 0否 1是',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_home_article
-- ----------------------------

-- ----------------------------
-- Table structure for api_home_level
-- ----------------------------
DROP TABLE IF EXISTS `api_home_level`;
CREATE TABLE `api_home_level` (
  `level_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(36) DEFAULT NULL,
  `level_min_score` int(11) DEFAULT NULL,
  `level_max_score` int(11) DEFAULT NULL,
  `level_is_used` tinyint(4) DEFAULT '1' COMMENT '是否启用 0否 1是',
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_home_level
-- ----------------------------

-- ----------------------------
-- Table structure for api_home_notice
-- ----------------------------
DROP TABLE IF EXISTS `api_home_notice`;
CREATE TABLE `api_home_notice` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_home_id` int(11) DEFAULT '0',
  `notice_title` varchar(128) DEFAULT NULL,
  `notice_content` text,
  `notice_time` int(11) DEFAULT NULL,
  `notice_author` int(11) DEFAULT NULL,
  `notice_type` tinyint(4) DEFAULT '0',
  `notice_is_top` tinyint(4) DEFAULT '0' COMMENT '置顶 0否 1是',
  `notice_is_delete` tinyint(4) DEFAULT '0' COMMENT '删除 0否 1是',
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_home_notice
-- ----------------------------

-- ----------------------------
-- Table structure for api_homes
-- ----------------------------
DROP TABLE IF EXISTS `api_homes`;
CREATE TABLE `api_homes` (
  `home_id` int(11) NOT NULL AUTO_INCREMENT,
  `home_name` varchar(36) DEFAULT NULL,
  `home_desc` text,
  `home_builder_id` int(11) DEFAULT '0',
  `home_builder_time` int(11) DEFAULT '0',
  `home_logo` varchar(255) DEFAULT NULL,
  `home_background` varchar(255) DEFAULT NULL,
  `home_mod_time` int(11) DEFAULT '0',
  `home_country` smallint(6) DEFAULT NULL,
  `home_province` smallint(6) DEFAULT NULL,
  `home_city` smallint(6) DEFAULT NULL,
  `home_district` smallint(6) DEFAULT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `home_is_private` tinyint(4) DEFAULT '0' COMMENT '是否私有 0公共(所有可访问 ) 1私有(仅家园成员可访问)',
  `home_is_close` tinyint(4) DEFAULT '0' COMMENT '是否开放申请 0可申请加入 1不可申请加入',
  `home_visitor_gag` tinyint(4) DEFAULT '0' COMMENT '禁止游客发言 0发言 1禁言',
  `home_level_id` tinyint(4) DEFAULT '0',
  `home_is_vip` tinyint(4) DEFAULT '0' COMMENT '是否VIP',
  `home_score` int(11) DEFAULT NULL,
  `home_use_score` int(11) DEFAULT NULL,
  `home_is_certification` tinyint(4) DEFAULT '0' COMMENT '官方认证 0未认证 1已认证',
  PRIMARY KEY (`home_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_homes
-- ----------------------------

-- ----------------------------
-- Table structure for api_message
-- ----------------------------
DROP TABLE IF EXISTS `api_message`;
CREATE TABLE `api_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_name` varchar(60) DEFAULT NULL,
  `message_content` text,
  `message_time` int(11) DEFAULT NULL,
  `message_send_id` int(11) DEFAULT '0' COMMENT '信息发送人(0为系统发的信息不能回复)',
  `message_admin_id` smallint(6) DEFAULT '0' COMMENT '如是系统发记录是哪一位发的',
  `message_get_id` int(11) DEFAULT NULL,
  `message_status` tinyint(4) DEFAULT '0' COMMENT '信息状态 0未读 1已读',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_message
-- ----------------------------

-- ----------------------------
-- Table structure for api_region
-- ----------------------------
DROP TABLE IF EXISTS `api_region`;
CREATE TABLE `api_region` (
  `region_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `region_pid` smallint(6) DEFAULT NULL,
  `region_name` varchar(36) DEFAULT NULL,
  `region_type` tinyint(4) DEFAULT '0' COMMENT '区域级别 0国级 1省级 2市级 3区级',
  `region_is_close` tinyint(4) DEFAULT '0' COMMENT '是否屏蔽 0公开 1屏蔽',
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_region
-- ----------------------------

-- ----------------------------
-- Table structure for api_report
-- ----------------------------
DROP TABLE IF EXISTS `api_report`;
CREATE TABLE `api_report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_user_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `report_time` int(11) DEFAULT NULL,
  `report_type` tinyint(4) DEFAULT NULL,
  `report_content` varchar(255) DEFAULT NULL,
  `report_status` tinyint(4) DEFAULT '0' COMMENT '举报状态 0未读 1未处理 2已处理 3暂缓处理 4已删除 5已封号',
  `admin_id` smallint(6) DEFAULT NULL,
  `admin_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_report
-- ----------------------------

-- ----------------------------
-- Table structure for api_report_type
-- ----------------------------
DROP TABLE IF EXISTS `api_report_type`;
CREATE TABLE `api_report_type` (
  `type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(36) DEFAULT NULL,
  `type_is_used` tinyint(4) DEFAULT '1' COMMENT '类型是否启用 0否 1是',
  `type_add_time` int(11) DEFAULT NULL,
  `type_admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_report_type
-- ----------------------------

-- ----------------------------
-- Table structure for api_suggest
-- ----------------------------
DROP TABLE IF EXISTS `api_suggest`;
CREATE TABLE `api_suggest` (
  `suggest_id` int(11) NOT NULL AUTO_INCREMENT,
  `suggest_user_id` int(11) DEFAULT NULL,
  `suggest_time` int(11) DEFAULT NULL,
  `suggest_content` text,
  `suggest_status` tinyint(4) DEFAULT '0' COMMENT '建议状态 0未读 1未处理 2已处理未回复 3已处理已回复 4已处理不需回复',
  `admin_id` smallint(6) DEFAULT NULL,
  `admin_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`suggest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_suggest
-- ----------------------------

-- ----------------------------
-- Table structure for api_user_home
-- ----------------------------
DROP TABLE IF EXISTS `api_user_home`;
CREATE TABLE `api_user_home` (
  `user_id` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `role_id` tinyint(4) DEFAULT '0',
  `nick_name` varchar(36) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '状态 0正常 1禁言 2禁止进入',
  `score` int(11) DEFAULT '0',
  `use_score` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`,`home_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_user_home
-- ----------------------------

-- ----------------------------
-- Table structure for api_users
-- ----------------------------
DROP TABLE IF EXISTS `api_users`;
CREATE TABLE `api_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `home_id` int(11) DEFAULT '0',
  `user_name` varchar(36) DEFAULT NULL,
  `user_pass` binary(16) DEFAULT NULL,
  `user_phone` char(11) DEFAULT NULL,
  `user_email` varchar(64) DEFAULT NULL,
  `user_sex` tinyint(4) DEFAULT '0' COMMENT '0未知 1男 2女',
  `user_head` varchar(128) DEFAULT NULL COMMENT '用户头像',
  `user_birthday` date DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL COMMENT '户籍地址',
  `user_now_address` varchar(255) DEFAULT NULL COMMENT '现居地址',
  `user_reg_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `user_login_time` int(11) DEFAULT NULL,
  `user_money` decimal(10,2) DEFAULT '0.00',
  `user_frozen_money` decimal(10,2) DEFAULT '0.00',
  `user_qq_id` varchar(32) DEFAULT NULL,
  `user_weixin_id` varchar(32) DEFAULT NULL,
  `user_score` int(11) DEFAULT '0' COMMENT '总积分',
  `user_use_score` int(11) DEFAULT '0' COMMENT '可用积分',
  `user_status` tinyint(4) DEFAULT '0' COMMENT '用户状态 0正常 1禁言 2禁止登录',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_users
-- ----------------------------
