/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : yii02

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2017-02-20 19:29:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自增登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email_validate_token` varchar(255) DEFAULT NULL COMMENT '邮箱验证token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `nickname` varchar(30) DEFAULT NULL COMMENT '昵称',
  `signature` varchar(60) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `last_post` int(11) DEFAULT NULL,
  `online_time` int(10) DEFAULT '0',
  `signin_time` int(6) DEFAULT '0',
  `max_signin` int(5) DEFAULT '0',
  `current_signin` int(5) DEFAULT '0',
  `total_signin` int(5) DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `auth_assignment` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`) USING BTREE,
  KEY `idx-auth_item-type` (`type`) USING BTREE,
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`) USING BTREE,
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for blacklist
-- ----------------------------
DROP TABLE IF EXISTS `blacklist`;
CREATE TABLE `blacklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(60) DEFAULT NULL,
  `time` varchar(100) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_group_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类组ID',
  `name` varchar(50) NOT NULL COMMENT '具体分类名称',
  `sort` int(11) DEFAULT '100' COMMENT '排序规则',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键词',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `create_by` int(11) unsigned DEFAULT NULL COMMENT '创建用户ID',
  `status` tinyint(3) DEFAULT '1' COMMENT '具体分类状态',
  PRIMARY KEY (`id`),
  KEY `create_cate_user_id` (`create_by`),
  KEY `cate_group_id` (`cate_group_id`),
  CONSTRAINT `cate_group_id` FOREIGN KEY (`cate_group_id`) REFERENCES `category_group` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `create_cate_user_id` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for category_group
-- ----------------------------
DROP TABLE IF EXISTS `category_group`;
CREATE TABLE `category_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '分类组的名称',
  `description` varchar(255) DEFAULT NULL COMMENT '分类组描述',
  `sort` int(5) DEFAULT '100' COMMENT '排序规则',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for category_manager
-- ----------------------------
DROP TABLE IF EXISTS `category_manager`;
CREATE TABLE `category_manager` (
  `cate_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`cate_id`,`user_id`),
  KEY `cate_id` (`cate_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `category_manager_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `category_manager_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT NULL,
  `content` text NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `post_id` int(11) unsigned DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '1',
  `signature` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT '0',
  `zan` int(11) DEFAULT '0',
  `cai` int(11) DEFAULT '0',
  `img` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `reply_to` int(11) unsigned DEFAULT NULL,
  `msgstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `comment_ibfk_1` (`user_id`),
  KEY `comment_ibfk_2` (`post_id`),
  KEY `comment_ibfk_3` (`reply_to`),
  KEY `comment_ibfk_4` (`pid`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`reply_to`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`pid`) REFERENCES `comment` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '文章标题',
  `label_img` varchar(255) DEFAULT NULL COMMENT '标签图',
  `summary` varchar(255) DEFAULT NULL COMMENT '文章摘要',
  `content` text NOT NULL COMMENT '文章内容',
  `cate_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `user_name` varchar(50) DEFAULT NULL COMMENT '用户名',
  `is_valid` tinyint(1) DEFAULT '0' COMMENT '文章分类',
  `browser` int(11) DEFAULT '0' COMMENT '浏览次数',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `zan` int(11) DEFAULT '0' COMMENT '赞',
  `cai` int(11) DEFAULT '0' COMMENT '踩',
  `ip_address` varchar(50) DEFAULT NULL COMMENT 'IP地址',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键字',
  `last_comment` int(11) DEFAULT '0' COMMENT '最后评论',
  `signature` varchar(60) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_cate_id_cate_id` (`cate_id`),
  KEY `post_user_id_user_id` (`user_id`),
  CONSTRAINT `post_cate_id_cate_id` FOREIGN KEY (`cate_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `post_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for relation_post_tag
-- ----------------------------
DROP TABLE IF EXISTS `relation_post_tag`;
CREATE TABLE `relation_post_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned DEFAULT NULL,
  `tag_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_id` (`post_id`),
  KEY `tag_post_id` (`tag_id`),
  CONSTRAINT `post_tag_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tag_post_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for report_comment
-- ----------------------------
DROP TABLE IF EXISTS `report_comment`;
CREATE TABLE `report_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) unsigned DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1',
  `ip_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `report_comment_ibfk_1` (`comment_id`),
  CONSTRAINT `report_comment_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) DEFAULT NULL COMMENT '标签名',
  `post_num` int(11) DEFAULT '0' COMMENT '关联的文章数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_tag_name_uindex` (`tag_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自增登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email_validate_token` varchar(255) DEFAULT NULL COMMENT '邮箱验证token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `nickname` varchar(30) DEFAULT NULL COMMENT '昵称',
  `signature` varchar(60) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `last_post` int(11) DEFAULT NULL,
  `online_time` int(10) DEFAULT '0',
  `signin_time` int(6) DEFAULT '0',
  `max_signin` int(5) DEFAULT '0',
  `current_signin` int(5) DEFAULT '0',
  `total_signin` int(5) DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_post
-- ----------------------------
DROP TABLE IF EXISTS `user_post`;
CREATE TABLE `user_post` (
  `user_id` int(11) unsigned NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `time` int(11) DEFAULT '0' COMMENT '收藏时间',
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `user_post_ibfk_2` (`post_id`),
  CONSTRAINT `user_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `user_post_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;
