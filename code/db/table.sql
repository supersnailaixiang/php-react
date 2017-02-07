/*
    需要库分析：本身借助crm本身的员工信息，但是本身独立库，不和crm一起用，在添加员工和修改密码的时候，做一个接口
    需要的表分析：
    1 员工表 已存在，登录信息，可以在crm后台添加员工的时候做一个接口，一
    2 问题表
    



*/

-- 创建数据库

DROP DATABASE IF EXISTS exam;
CREATE DATABASE IF NOT EXISTS exam DEFAULT CHARSET utf8 COLLATE utf8_general_ci;
use `test`;
-- 员工表
DROP TABLE IF EXISTS `cfg_login_account_list`;
CREATE TABLE `cfg_login_account_list`(
    `user_id` INT(11) AUTO_INCREMENT,
    `user_name` VARCHAR(128) NOT NULL DEFAULT '',
    `pwd` VARCHAR(50) NOT NULL DEFAULT '',
    `region_id` INT(11) NOT NULL DEFAULT '0',
    `dept_id` INT(11) NOT NULL DEFAULT '0',
    `is_admin` TINYINT(4) NOT NULL DEFAULT '0', 
    `is_delete` TINYINT(4) NOT null DEFAULT '0',
    PRIMARY KEY(`user_id`)
)Engine='InnoDB' CHARSET='utf8';

-- 部门表
DROP TABLE IF EXISTS `cfg_department`;
CREATE TABLE `cfg_department`(
    `dept_id` INT(11) AUTO_INCREMENT,
    `dept_name` VARCHAR(128) NOT NULL DEFAULT '',
    PRIMARY KEY(`dept_id`)
)Engine='InnoDB' CHARSET='utf8';
 
-- 任务表
DROP TABLE IF EXISTS `task_list`;
 
CREATE TABLE `task_list` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(128) NOT NULL DEFAULT '' COMMENT '任务名称',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '任务状态 1 等待受理 5 已受理 5 已完成 10 已取消',
  `customer_id` int(11) NOT NULL DEFAULT '0' COMMENT '客户id',
  `description` varchar(1024) NOT NULL DEFAULT '' COMMENT '任务描述',
  `assignors` varchar(128) NOT NULL DEFAULT '' COMMENT '指派人id集合',
  `assignors_name` varchar(128) NOT NULL DEFAULT '' COMMENT '指派人名称显示用',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 普通任务 1 客户分配给销售的任务',
  `creator` int(11) NOT NULL DEFAULT '0' COMMENT '创建者',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`task_id`),
  KEY `task_list_customer_id` (`customer_id`),
  KEY `task_list_assignors` (`assignors`)
) ENGINE=InnoDB   DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `task_log`;
CREATE TABLE `task_log` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '日志内容',
  `operator_id` int(11) NOT NULL DEFAULT '0' COMMENT '0',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='任务日志';
