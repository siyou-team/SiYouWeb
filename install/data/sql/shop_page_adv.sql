/*
Navicat MySQL Data Transfer

Source Server         : 讯有-测试站
Source Server Version : 50556
Source Host           : localhost:3306
Source Database       : xunyou_test

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2018-07-17 14:49:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for shop_page_adv
-- ----------------------------
DROP TABLE IF EXISTS `shop_page_adv`;
CREATE TABLE `shop_page_adv` (
  `adv_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adv_page_name` varchar(20) NOT NULL COMMENT '二级页面名称',
  `adv_banner_json` varchar(10000) NOT NULL DEFAULT '[]' COMMENT '模块banner轮播JSON代码(JSON)，图片路径，广告位地址',
  `adv_page_color` varchar(20) NOT NULL COMMENT '页面颜色风格',
  `adv_page_uptime` datetime NOT NULL COMMENT '更新时间',
  `adv_page_order` smallint(3) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `adv_page_enable` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用',
  `adv_goods_json` varchar(10000) NOT NULL DEFAULT '[]' COMMENT '模块商品JSON代码(JSON)，商品ID，商品排序',
  `subsite_id` mediumint(4) NOT NULL DEFAULT '0' COMMENT '所属分站Id:0-总站',
  PRIMARY KEY (`adv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='二级页面表';
