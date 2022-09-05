/*
 Navicat Premium Data Transfer

 Source Server         : reser656_reservasresort
 Source Server Type    : MySQL
 Source Server Version : 50641
 Source Host           : 108.179.252.200:3306
 Source Schema         : reser656_reservasresort

 Target Server Type    : MySQL
 Target Server Version : 50641
 File Encoding         : 65001

 Date: 05/09/2022 00:20:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for empreendimento_tipo_unidade
-- ----------------------------
DROP TABLE IF EXISTS `empreendimento_tipo_unidade`;
CREATE TABLE `empreendimento_tipo_unidade`  (
  `id` int(11) NOT NULL,
  `id_empreendimento` int(11) NOT NULL,
  `nome` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_empreendimento`(`id_empreendimento`) USING BTREE,
  CONSTRAINT `empreendimento_tipo_unidade_ibfk_1` FOREIGN KEY (`id_empreendimento`) REFERENCES `empreendimento` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of empreendimento_tipo_unidade
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
