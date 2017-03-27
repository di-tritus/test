/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : test_code_geek

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-03-27 23:33:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text,
  `url_book` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES ('1', '4', 'Степфордские жены', null, null, null);
INSERT INTO `books` VALUES ('2', '4', 'О Дивный новый мир', null, null, null);
INSERT INTO `books` VALUES ('3', '8', 'СВОД ДРЕВНЕЙШИХ ПИСЬМЕННЫХ ИЗВЕСТИЙ О СЛАВЯНАХ', null, null, null);
INSERT INTO `books` VALUES ('6', '8', 'Игра Эндера', '1490634980_image.jpg', 'ssssssssssssssssssd\r\nds\r\nd\r\nsd\r\nsd\r\ns', '1490634980_book.txt');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('4', 'Фантастика');
INSERT INTO `category` VALUES ('5', 'Научная фантастика');
INSERT INTO `category` VALUES ('7', 'История');
INSERT INTO `category` VALUES ('8', 'Детектив');
