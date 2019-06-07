/*
 Navicat Premium Data Transfer

 Source Server         : shop
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : szxzsyx

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 14/08/2018 08:09:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for szxzsyx_admin
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_admin`;
CREATE TABLE `szxzsyx_admin`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `use` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of szxzsyx_admin
-- ----------------------------
INSERT INTO `szxzsyx_admin` VALUES (1, 'root', 'e10adc3949ba59abbe56e057f20f883e', '', '', 1, NULL, '2018-07-08 07:19:54', NULL);
INSERT INTO `szxzsyx_admin` VALUES (6, 'admin8', 'e10adc3949ba59abbe56e057f20f883e', '', '', 1, '2018-07-03 16:26:15', '2018-07-08 03:33:43', '2018-07-08 03:33:43');

-- ----------------------------
-- Table structure for szxzsyx_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_admin_role`;
CREATE TABLE `szxzsyx_admin_role`  (
  `admin_id` tinyint(3) UNSIGNED NOT NULL COMMENT '管理员的id',
  `role_id` smallint(5) UNSIGNED NOT NULL COMMENT '角色的id',
  INDEX `admin_id`(`admin_id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员角色表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of szxzsyx_admin_role
-- ----------------------------
INSERT INTO `szxzsyx_admin_role` VALUES (1, 6);
INSERT INTO `szxzsyx_admin_role` VALUES (1, 2);

-- ----------------------------
-- Table structure for szxzsyx_attribute
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_attribute`;
CREATE TABLE `szxzsyx_attribute`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '属性名称',
  `attr_type` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT '属性的类型0：唯一 1：可选',
  `attr_option_values` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '属性的可选值，多个可选值用，隔开',
  `un_number` tinyint(4) NOT NULL DEFAULT 100 COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of szxzsyx_attribute
-- ----------------------------
INSERT INTO `szxzsyx_attribute` VALUES (1, '1111', 000, 'null', 100, '2018-08-06 12:35:48', '2018-08-07 00:50:06', NULL);
INSERT INTO `szxzsyx_attribute` VALUES (3, '669', 001, '[\"{\\\"option\\\":\\\"669\\\"}\",\"{\\\"option\\\":\\\"555\\\"}\"]', 100, '2018-08-06 13:17:18', '2018-08-07 00:49:23', NULL);
INSERT INTO `szxzsyx_attribute` VALUES (4, '6667', 001, '[\"{\\\"option\\\":\\\"555\\\"}\"]', 100, '2018-08-07 14:42:08', '2018-08-07 14:42:08', NULL);
INSERT INTO `szxzsyx_attribute` VALUES (5, '66668', 000, '[\"{\\\"option\\\":\\\"\\\"}\"]', 100, '2018-08-07 14:43:38', '2018-08-07 14:43:38', NULL);

-- ----------------------------
-- Table structure for szxzsyx_category
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_category`;
CREATE TABLE `szxzsyx_category`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `parent_id` smallint(5) UNSIGNED NOT NULL COMMENT '上级分类的ID，0：代表顶级',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `search_attr_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '筛选选属性ID，多个ID用逗号隔开',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of szxzsyx_category
-- ----------------------------
INSERT INTO `szxzsyx_category` VALUES (1, '9991', 0, '2018-08-01 15:34:53', '2018-08-01 15:47:41', NULL, NULL);
INSERT INTO `szxzsyx_category` VALUES (2, '70', 0, '2018-08-01 15:43:52', '2018-08-05 23:31:57', NULL, NULL);

-- ----------------------------
-- Table structure for szxzsyx_goods
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_goods`;
CREATE TABLE `szxzsyx_goods`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名称',
  `cat_id` smallint(6) NOT NULL COMMENT '分类名称\r\n',
  `shop_price` decimal(10, 2) NOT NULL COMMENT '本店价',
  `sm_logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'logo缩略图',
  `is_on_sale` tinyint(3) UNSIGNED ZEROFILL NOT NULL DEFAULT 001 COMMENT '是否上架：1：上架，0：下架',
  `seo_keyword` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'seo优化[搜索引擎【百度、谷歌等】优化]_关键字',
  `seo_description` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'seo优化[搜索引擎【百度、谷歌等】优化]_描述',
  `sort_num` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '排序数字',
  `goods_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '商品描述',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '禁用时间',
  `is_hot` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT '是否热卖',
  `is_new` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT '是否新品',
  `is_best` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT '是否精品',
  `logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品图片',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of szxzsyx_goods
-- ----------------------------
INSERT INTO `szxzsyx_goods` VALUES (1, '55598', 1, 666.00, '', 001, '555', '666', 55, '555', '2018-08-11 13:55:27', '2018-08-12 07:56:27', NULL, 000, 000, 000, '/app/uploadImage/Goods/2018-08-11-13-55-09-5b6eeabd80c07.jpg');
INSERT INTO `szxzsyx_goods` VALUES (2, '666', 1, 88.00, '', 001, '555', '666', 100, '555', '2018-08-11 22:40:27', '2018-08-11 22:40:27', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-22-38-35-5b6f656b63d43.jpg');
INSERT INTO `szxzsyx_goods` VALUES (3, '99', 1, 88.00, '', 001, '666', '555', 100, 'hah', '2018-08-11 22:51:13', '2018-08-11 22:51:13', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-22-50-41-5b6f68416d7d8.jpg');
INSERT INTO `szxzsyx_goods` VALUES (4, '666', 1, 88.00, '', 001, '111', '888', 100, 'haha', '2018-08-11 22:53:25', '2018-08-11 22:53:25', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-22-52-59-5b6f68cbe7160.jpg');
INSERT INTO `szxzsyx_goods` VALUES (5, '555', 1, 88.00, '', 001, '888', '99', 100, '888', '2018-08-11 22:55:25', '2018-08-11 22:55:25', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-22-54-58-5b6f6942f2ea6.jpg');
INSERT INTO `szxzsyx_goods` VALUES (6, '555', 1, 88.00, '', 001, '888', '99', 100, '888', '2018-08-11 23:11:57', '2018-08-11 23:11:57', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-22-54-58-5b6f6942f2ea6.jpg');
INSERT INTO `szxzsyx_goods` VALUES (7, '555', 1, 88.00, '', 001, '888', '99', 100, '888', '2018-08-11 23:13:57', '2018-08-11 23:13:57', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-22-54-58-5b6f6942f2ea6.jpg');
INSERT INTO `szxzsyx_goods` VALUES (8, '555', 1, 88.00, '', 001, '888', '99', 100, '888', '2018-08-11 23:14:08', '2018-08-11 23:14:08', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-22-54-58-5b6f6942f2ea6.jpg');
INSERT INTO `szxzsyx_goods` VALUES (9, '555', 1, 88.00, '', 001, '888', '99', 100, '888', '2018-08-11 23:14:30', '2018-08-11 23:14:30', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-22-54-58-5b6f6942f2ea6.jpg');
INSERT INTO `szxzsyx_goods` VALUES (10, '111', 1, 555.00, '', 001, '666', '77', 10, '55', '2018-08-11 23:19:28', '2018-08-11 23:19:28', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-23-19-15-5b6f6ef3009eb.jpg');
INSERT INTO `szxzsyx_goods` VALUES (11, '555', 1, 18.00, '', 001, '666', '666', 66, '11', '2018-08-11 23:21:20', '2018-08-11 23:21:20', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-23-21-06-5b6f6f62bcc3a.jpg');
INSERT INTO `szxzsyx_goods` VALUES (12, '555', 2, 999.00, '', 001, '666', '666', 100, '555', '2018-08-11 23:27:40', '2018-08-11 23:27:40', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-23-27-27-5b6f70df3911c.jpg');
INSERT INTO `szxzsyx_goods` VALUES (13, '555', 1, 55.00, '', 001, '111', '222', 10, '55', '2018-08-11 23:28:27', '2018-08-11 23:28:27', NULL, 001, 001, 001, '/app/uploadImage/Goods/2018-08-11-23-28-14-5b6f710ee9ef1.jpg');

-- ----------------------------
-- Table structure for szxzsyx_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_goods_attr`;
CREATE TABLE `szxzsyx_goods_attr`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(9) NOT NULL COMMENT '商品的id',
  `attr_id` mediumint(9) NOT NULL COMMENT '属性的id',
  `attr_value` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '属性的值',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of szxzsyx_goods_attr
-- ----------------------------
INSERT INTO `szxzsyx_goods_attr` VALUES (1, 9, 1, '555');
INSERT INTO `szxzsyx_goods_attr` VALUES (2, 9, 3, '555');
INSERT INTO `szxzsyx_goods_attr` VALUES (3, 9, 4, '555');
INSERT INTO `szxzsyx_goods_attr` VALUES (4, 9, 5, '666');

-- ----------------------------
-- Table structure for szxzsyx_message
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_message`;
CREATE TABLE `szxzsyx_message`  (
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名字',
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '电话',
  `emali` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱',
  `satisfy` tinyint(4) NOT NULL COMMENT '满意程度',
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '消息内容',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for szxzsyx_migrations
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_migrations`;
CREATE TABLE `szxzsyx_migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of szxzsyx_migrations
-- ----------------------------
INSERT INTO `szxzsyx_migrations` VALUES (1, '2018_07_01_023153_admin', 1);
INSERT INTO `szxzsyx_migrations` VALUES (2, '2018_07_02_154225_create_privileges_table', 2);
INSERT INTO `szxzsyx_migrations` VALUES (3, '2018_07_05_162404_create_roles_table', 3);

-- ----------------------------
-- Table structure for szxzsyx_privilege
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_privilege`;
CREATE TABLE `szxzsyx_privilege`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pri_name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller_name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `parent_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of szxzsyx_privilege
-- ----------------------------
INSERT INTO `szxzsyx_privilege` VALUES (1, '系统管理', 'system', 'null', 'null', 'null', 0, '2018-07-04 16:41:16', '2018-07-08 04:14:36', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (3, '管理员列表', 'Admin', 'Admin', 'list', '1', 1, '2018-07-05 12:12:49', '2018-07-08 04:15:36', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (4, '添加管理员', 'Admin', 'Admin', 'add', '1', 3, '2018-07-05 12:17:23', '2018-07-08 04:17:07', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (5, '管理员修改', 'Admin', 'Admin', 'edit', '0', 3, '2018-07-08 05:01:20', '2018-07-08 05:01:20', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (6, '管理员禁用', 'Admin', 'Admin', 'softDel', '0', 3, '2018-07-08 05:02:23', '2018-07-08 05:02:23', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (7, '管理员恢复', 'Admin', 'Admin', 'recover', '0', 3, '2018-07-08 05:03:23', '2018-07-08 05:03:23', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (8, '管理员删除', 'Admin', 'Admin', 'remove', '0', 3, '2018-07-08 05:04:03', '2018-07-08 05:06:41', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (9, '权限列表', 'Admin', 'Privilege', 'list', '0', 1, '2018-07-08 05:05:44', '2018-07-08 05:05:44', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (10, '权限添加', 'Admin', 'Privilege', 'add', '0', 9, '2018-07-08 05:06:30', '2018-07-08 05:06:30', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (11, '权限修改', 'Admin', 'Privilege', 'edit', '0', 9, '2018-07-08 05:07:16', '2018-07-08 05:07:16', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (12, '权限禁用', 'Admin', 'Privilege', 'softDel', '0', 9, '2018-07-08 05:11:23', '2018-07-08 05:11:23', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (13, '权限恢复', 'Admin', 'Privilege', 'recover', '0', 9, '2018-07-08 05:12:19', '2018-07-08 05:12:19', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (14, '权限删除', 'Admin', 'Privilege', 'remove', '0', 9, '2018-07-08 05:14:36', '2018-07-08 05:14:36', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (15, '获取父级权限', 'Admin', 'Privilege', 'getParent', '0', 9, '2018-07-08 05:15:37', '2018-07-08 05:15:37', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (16, '角色列表', 'Admin', 'Roles', 'list', '0', 1, '2018-07-08 07:15:03', '2018-07-08 07:15:03', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (17, '角色添加', 'Admin', 'Roles', 'add', '0', 16, '2018-07-08 07:15:37', '2018-07-08 07:15:37', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (18, '角色修改', 'Admin', 'Roles', 'edit', '0', 16, '2018-07-08 07:16:16', '2018-07-08 07:16:16', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (19, '角色禁用', 'Admin', 'Roles', 'softDel', '0', 16, '2018-07-08 07:17:00', '2018-07-08 07:17:00', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (20, '角色恢复', 'Admin', 'Roles', 'recover', '0', 16, '2018-07-08 07:17:57', '2018-07-08 07:17:57', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (21, '角色删除', 'Admin', 'Roles', 'remove', '0', 16, '2018-07-08 07:18:34', '2018-07-08 07:18:34', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (22, '获取角色', 'Admin', 'Roles', 'getRole', '0', 16, '2018-07-08 07:19:08', '2018-07-08 07:19:08', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (23, '商品管理', 'goods', 'null', 'null', '0', 0, '2018-07-22 00:28:00', '2018-08-06 00:08:45', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (24, '品牌列表', 'Admin', 'Brand', 'list', '0', 23, '2018-07-22 00:29:19', '2018-08-05 23:54:54', '2018-08-05 23:54:54');
INSERT INTO `szxzsyx_privilege` VALUES (25, '品牌添加', 'Admin', 'Brand', 'add', '0', 24, '2018-07-22 14:45:51', '2018-08-05 23:54:57', '2018-08-05 23:54:57');
INSERT INTO `szxzsyx_privilege` VALUES (26, '品牌修改', 'Admin', 'Brand', 'edit', '0', 24, '2018-07-22 14:46:40', '2018-08-05 23:55:00', '2018-08-05 23:55:00');
INSERT INTO `szxzsyx_privilege` VALUES (27, '品牌禁用', 'Admin', 'Brand', 'softDel', '0', 24, '2018-07-22 14:47:42', '2018-08-05 23:55:03', '2018-08-05 23:55:03');
INSERT INTO `szxzsyx_privilege` VALUES (28, '品牌恢复', 'Admin', 'Brand', 'recover', '0', 24, '2018-07-22 14:48:16', '2018-08-05 23:55:07', '2018-08-05 23:55:07');
INSERT INTO `szxzsyx_privilege` VALUES (29, '品牌删除', 'Admin', 'Brand', 'remove', '0', 24, '2018-07-22 14:49:28', '2018-08-05 23:55:10', '2018-08-05 23:55:10');
INSERT INTO `szxzsyx_privilege` VALUES (30, 'logo上传', 'Admin', 'Brand', 'upload', '0', 24, '2018-07-22 23:09:35', '2018-07-22 23:09:35', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (31, '分类列表', 'Admin', 'Category', 'list', '0', 23, '2018-07-29 09:12:43', '2018-07-29 09:12:43', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (32, '分类添加', 'Admin', 'Category', 'add', '0', 31, '2018-07-29 09:13:26', '2018-07-29 09:13:26', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (33, '分类修改', 'Admin', 'Category', 'edit', '0', 31, '2018-07-29 09:14:00', '2018-07-29 09:14:00', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (34, '分类软删除', 'Admin', 'Category', 'softDel', '0', 31, '2018-07-29 09:14:30', '2018-07-29 09:14:30', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (35, '分类恢复', 'Admin', 'Category', 'recover', '0', 31, '2018-07-29 09:15:21', '2018-07-29 09:15:21', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (36, '分类删除', 'Admin', 'Category', 'remove', '0', 31, '2018-07-29 09:16:12', '2018-07-29 09:16:12', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (37, '获取分类', 'Admin', 'Category', 'getCategory', '0', 31, '2018-07-30 00:03:56', '2018-07-30 00:07:58', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (38, '属性列表', 'Admin', 'Attribute', 'list', '0', 23, '2018-08-06 00:10:02', '2018-08-06 00:10:02', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (39, '属性添加', 'Admin', 'Attribute', 'add', '0', 38, '2018-08-06 00:11:10', '2018-08-06 00:11:10', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (40, '属性修改', 'Admin', 'Attribute', 'edit', '0', 38, '2018-08-06 00:11:49', '2018-08-06 00:11:49', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (41, '属性软删除', 'Admin', 'Attribute', 'softDel', '0', 38, '2018-08-06 00:12:24', '2018-08-06 00:12:24', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (42, '属性恢复', 'Admin', 'Attribute', 'recover', '0', 38, '2018-08-06 00:13:10', '2018-08-06 00:13:10', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (43, '属性删除', 'Admin', 'Attribute', 'remove', '0', 38, '2018-08-06 00:13:53', '2018-08-06 00:13:53', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (44, '商品添加', 'Admin', 'Goods', 'add', '0', 23, '2018-08-10 15:42:28', '2018-08-10 15:42:28', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (45, '商品添加初始化', 'Admin', 'Goods', 'addInit', '0', 44, '2018-08-10 15:48:54', '2018-08-10 15:57:57', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (46, '商品图片上传', 'Admin', 'Goods', 'upload', '0', 44, '2018-08-11 00:52:57', '2018-08-11 00:52:57', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (47, '商品列表', 'Admin', 'Goods', 'list', '0', 23, '2018-08-12 02:27:59', '2018-08-12 02:27:59', NULL);
INSERT INTO `szxzsyx_privilege` VALUES (48, '商品修改', 'Admin', 'Goods', 'edit', '0', 47, '2018-08-12 07:52:36', '2018-08-12 07:52:36', NULL);

-- ----------------------------
-- Table structure for szxzsyx_role_privilege
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_role_privilege`;
CREATE TABLE `szxzsyx_role_privilege`  (
  `pri_id` smallint(5) UNSIGNED NOT NULL COMMENT '权限的ID',
  `role_id` smallint(5) UNSIGNED NOT NULL COMMENT '角色的id',
  INDEX `pri_id`(`pri_id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色权限表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of szxzsyx_role_privilege
-- ----------------------------
INSERT INTO `szxzsyx_role_privilege` VALUES (21, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (20, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (19, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (17, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (15, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (14, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (13, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (12, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (11, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (8, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (7, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (6, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (5, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (4, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (3, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (1, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (9, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (10, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (16, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (18, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (22, 2);
INSERT INTO `szxzsyx_role_privilege` VALUES (47, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (45, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (44, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (37, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (23, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (31, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (32, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (33, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (34, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (35, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (36, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (38, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (39, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (40, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (41, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (42, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (43, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (46, 6);
INSERT INTO `szxzsyx_role_privilege` VALUES (48, 6);

-- ----------------------------
-- Table structure for szxzsyx_roles
-- ----------------------------
DROP TABLE IF EXISTS `szxzsyx_roles`;
CREATE TABLE `szxzsyx_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of szxzsyx_roles
-- ----------------------------
INSERT INTO `szxzsyx_roles` VALUES (2, '系统管理', '2018-07-06 16:29:32', '2018-07-08 04:49:36', NULL);
INSERT INTO `szxzsyx_roles` VALUES (6, '商品管理', '2018-07-22 00:30:48', '2018-07-22 00:30:48', NULL);

SET FOREIGN_KEY_CHECKS = 1;
