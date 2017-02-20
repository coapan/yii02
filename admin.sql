/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : yii02

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2017-02-08 14:13:48
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
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'O65O4vExbXEBljUDxTbRaS5ZIPaLIBs8', '$2y$13$rvQGYLf2oKt8x/eWaSDvz.SKF8PwjJmfGF3KBIGIqo7cGfSfxyaAG', null, null, '123456@qq.com', '10', '1485601300', '1486445523', '我阴险我卑鄙', 'I am the handsome panchaozhi for the blog.', '1486445523', '1485842972', '10', '20170205', '5', '5', '5', 'uploads/201702/148595091419.gif');
INSERT INTO `admin` VALUES ('2', 'test1', 'Rvdpe3aS4FvHMjQxyl6o5JDPtkH-yTE9', '$2y$13$UTYXyvYoIKm71umKzUEyle6ldQb.6t1I4DchJ2f7idbxKuVg4jt/a', null, null, 'test01@qq.com', '10', '1486107915', '1486108248', '我阴险我卑鄙我邪恶我堕落', '我阴险我卑鄙我邪恶我堕落', null, null, '0', '20170203', '1', '1', '1', 'uploads/201702/148610803387.gif');
INSERT INTO `admin` VALUES ('3', 'test03', 'S8t98OV0FobfkAsgB-35p3bvEIOq-dpM', '$2y$13$Uxh3TajmQSGV.7.jCu90u.AcMERR3CuFalggbjEvMNtZWxEJrfwXS', null, null, 'test03@qq.com', '10', '1486303577', '1486303602', null, null, null, null, '0', '20170205', '1', '1', '1', null);
SET FOREIGN_KEY_CHECKS=1;
