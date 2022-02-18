/*
Navicat MySQL Data Transfer

Source Server         : pro2-192.168.0.222
Source Server Version : 50730
Source Host           : 192.168.0.222:56306
Source Database       : backworker_laravel54

Target Server Type    : MYSQL
Target Server Version : 50730
File Encoding         : 65001

Date: 2022-02-18 19:04:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for todo_list
-- ----------------------------
DROP TABLE IF EXISTS `todo_list`;
CREATE TABLE `todo_list` (
  `id` varchar(255) NOT NULL COMMENT '任务唯一ID',
  `list_name` varchar(255) NOT NULL COMMENT 'Todo 任务列表名称',
  `status` varchar(255) NOT NULL COMMENT '列表状态 1 是未开始、2表示进行中 3 表示暂停 4 表示结束',
  `spend_time` int(255) unsigned DEFAULT NULL COMMENT '花费时间（分钟）',
  `start_time` datetime DEFAULT NULL COMMENT '任务开始时间',
  `complete_time` datetime DEFAULT NULL COMMENT '任务完成时间',
  `stop_count` int(255) unsigned NOT NULL COMMENT '任务被挂起次数',
  `created_at` datetime DEFAULT NULL COMMENT '任务创建时间',
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL COMMENT '软删除标识',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of todo_list
-- ----------------------------
INSERT INTO `todo_list` VALUES ('c74351cbe9043d86b33499fdabd3fb99f9d2', 'java 技术面学习', '1', '0', null, null, '0', '2022-02-18 19:02:28', null, null);
INSERT INTO `todo_list` VALUES ('db3c909b3330c20e136bfcfef22a714618ea', 'php 技术面学习', '1', '0', null, null, '0', '2022-02-18 19:02:40', null, null);

-- ----------------------------
-- Table structure for why_stop
-- ----------------------------
DROP TABLE IF EXISTS `why_stop`;
CREATE TABLE `why_stop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_id` varchar(255) NOT NULL COMMENT '任务唯一ID外键',
  `why_stop` longtext COMMENT '描述中断原因',
  `stop_start_time` varchar(255) DEFAULT NULL COMMENT '中断开始时间',
  `stop_stop_time` varchar(255) DEFAULT NULL COMMENT '中断结束时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of why_stop
-- ----------------------------
