/*
Navicat MySQL Data Transfer

Source Server         : pro2-192.168.0.222
Source Server Version : 50730
Source Host           : 192.168.0.222:56306
Source Database       : backworker_laravel54

Target Server Type    : MYSQL
Target Server Version : 50730
File Encoding         : 65001

Date: 2022-02-17 17:33:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for todo_list
-- ----------------------------
DROP TABLE IF EXISTS `todo_list`;
CREATE TABLE `todo_list` (
  `id` varchar(255) NOT NULL COMMENT '任务唯一ID',
  `list_name` varchar(255) NOT NULL COMMENT 'Todo 任务列表名称',
  `status` int(255) unsigned NOT NULL COMMENT '列表状态 1 是未开始、2表示进行中 3 表示暂停 4 表示结束',
  `spend_time` int(255) unsigned DEFAULT NULL COMMENT '花费时间（分钟）',
  `start_time` datetime DEFAULT NULL COMMENT '任务开始时间',
  `complete_time` datetime DEFAULT NULL COMMENT '任务完成时间',
  `stop_count` int(255) unsigned NOT NULL COMMENT '任务被挂起次数',
  `created_at` datetime DEFAULT NULL COMMENT '任务创建时间',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of todo_list
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of why_stop
-- ----------------------------
INSERT INTO `why_stop` VALUES ('1', '30e8e43579885b955a4cc0ee02c9c539dca3', '想停', '111', '222');
