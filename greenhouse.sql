/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : localhost:3306
 Source Schema         : greenhouse

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 17/09/2020 02:53:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for greenhouse_actuators
-- ----------------------------
DROP TABLE IF EXISTS `greenhouse_actuators`;
CREATE TABLE `greenhouse_actuators` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `greenhouse_id` int unsigned DEFAULT NULL,
  `actuator` varchar(30) DEFAULT NULL,
  `state` enum('OFF','ON') DEFAULT 'OFF',
  `control_level` tinyint DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `greenhouse_id` (`greenhouse_id`),
  CONSTRAINT `greenhouse_actuators_ibfk_1` FOREIGN KEY (`greenhouse_id`) REFERENCES `greenhouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of greenhouse_actuators
-- ----------------------------
BEGIN;
INSERT INTO `greenhouse_actuators` VALUES (5, 5, 'heater', 'ON', 1, '2020-07-01 12:47:50', '2020-07-20 02:37:05');
INSERT INTO `greenhouse_actuators` VALUES (6, 5, 'exhaust_fan', 'ON', 1, '2020-07-01 12:47:50', '2020-07-20 02:37:06');
INSERT INTO `greenhouse_actuators` VALUES (7, 6, NULL, 'OFF', 0, '2020-07-18 17:26:10', '2020-07-18 17:26:10');
INSERT INTO `greenhouse_actuators` VALUES (8, 6, NULL, 'OFF', 0, '2020-07-18 17:26:10', '2020-07-18 17:26:10');
COMMIT;

-- ----------------------------
-- Table structure for greenhouse_environment_limits
-- ----------------------------
DROP TABLE IF EXISTS `greenhouse_environment_limits`;
CREATE TABLE `greenhouse_environment_limits` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `greenhouse_id` int unsigned NOT NULL,
  `sensor` varchar(30) DEFAULT NULL,
  `lower_limit` decimal(8,2) DEFAULT NULL,
  `upper_limit` decimal(8,2) DEFAULT NULL,
  `new_state` enum('OFF','ON') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `greenhouse_environment_limits_ibfk_1` (`greenhouse_id`),
  CONSTRAINT `greenhouse_environment_limits_ibfk_1` FOREIGN KEY (`greenhouse_id`) REFERENCES `greenhouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of greenhouse_environment_limits
-- ----------------------------
BEGIN;
INSERT INTO `greenhouse_environment_limits` VALUES (1, 5, 'temperature', 20.00, 25.00, 'ON', NULL, '2020-07-17 08:13:52');
INSERT INTO `greenhouse_environment_limits` VALUES (2, 5, 'humidity', 0.00, 46.00, 'ON', NULL, '2020-07-18 21:15:46');
INSERT INTO `greenhouse_environment_limits` VALUES (3, 5, 'air_quality', 66.00, 100.00, 'ON', NULL, '2020-07-17 12:36:59');
INSERT INTO `greenhouse_environment_limits` VALUES (4, 6, 'temperature', NULL, NULL, 'ON', '2020-07-18 17:26:10', '2020-07-18 17:26:10');
INSERT INTO `greenhouse_environment_limits` VALUES (5, 6, 'humidity', NULL, NULL, 'ON', '2020-07-18 17:26:10', '2020-07-18 17:26:10');
INSERT INTO `greenhouse_environment_limits` VALUES (6, 6, 'air_quality', NULL, NULL, 'ON', '2020-07-18 17:26:10', '2020-07-18 17:26:10');
COMMIT;

-- ----------------------------
-- Table structure for greenhouse_metrics
-- ----------------------------
DROP TABLE IF EXISTS `greenhouse_metrics`;
CREATE TABLE `greenhouse_metrics` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `greenhouse_id` int unsigned NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `temperature_outdoor` decimal(5,2) DEFAULT NULL,
  `humidity` decimal(5,2) DEFAULT NULL,
  `humidity_outdoor` decimal(5,2) DEFAULT NULL,
  `air_quality` decimal(5,2) DEFAULT NULL,
  `soil_moisture` decimal(5,2) DEFAULT NULL,
  `water_volume` decimal(5,2) DEFAULT NULL,
  `energy_unit` decimal(5,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `greenhouse_id` (`greenhouse_id`),
  CONSTRAINT `greenhouse_metrics_ibfk_1` FOREIGN KEY (`greenhouse_id`) REFERENCES `greenhouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of greenhouse_metrics
-- ----------------------------
BEGIN;
INSERT INTO `greenhouse_metrics` VALUES (1, 5, 20.30, 15.45, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 22:41:38', '2020-07-13 10:41:38');
INSERT INTO `greenhouse_metrics` VALUES (2, 5, 20.30, 15.45, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 22:55:35', '2020-07-13 10:55:35');
INSERT INTO `greenhouse_metrics` VALUES (3, 5, 20.30, 15.45, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 23:14:06', '2020-07-13 11:14:06');
INSERT INTO `greenhouse_metrics` VALUES (4, 5, 20.30, 15.45, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 23:18:41', '2020-07-13 11:18:41');
INSERT INTO `greenhouse_metrics` VALUES (5, 5, 21.30, 16.45, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 23:21:32', '2020-07-13 11:21:32');
INSERT INTO `greenhouse_metrics` VALUES (6, 5, 22.30, 17.45, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 23:41:46', '2020-07-13 11:41:46');
INSERT INTO `greenhouse_metrics` VALUES (7, 5, 23.30, 18.45, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 23:42:59', '2020-07-13 11:42:59');
INSERT INTO `greenhouse_metrics` VALUES (8, 5, 24.30, 19.45, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 23:45:26', '2020-07-13 11:45:26');
INSERT INTO `greenhouse_metrics` VALUES (9, 5, 25.30, 20.45, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 23:49:16', '2020-07-13 11:49:16');
INSERT INTO `greenhouse_metrics` VALUES (10, 5, 26.30, 21.32, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 23:52:09', '2020-07-13 11:52:09');
INSERT INTO `greenhouse_metrics` VALUES (11, 5, 27.30, 24.50, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-14 23:53:05', '2020-07-13 11:53:05');
INSERT INTO `greenhouse_metrics` VALUES (12, 5, 28.30, 26.50, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-15 00:02:47', '2020-07-13 12:02:47');
INSERT INTO `greenhouse_metrics` VALUES (13, 5, 29.30, 22.00, 40.00, 38.00, 60.00, 42.00, 32.00, 23.00, '2020-07-15 00:13:14', '2020-07-13 12:13:14');
INSERT INTO `greenhouse_metrics` VALUES (14, 5, 30.30, 31.00, 40.00, 38.00, 65.00, 48.00, 32.00, 23.00, '2020-07-15 00:54:17', '2020-07-13 12:54:17');
INSERT INTO `greenhouse_metrics` VALUES (34, 5, 10.00, 12.46, 20.00, 66.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:27:59', '2020-07-15 12:27:59');
INSERT INTO `greenhouse_metrics` VALUES (35, 5, 10.00, 12.46, 20.00, 66.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:28:18', '2020-07-15 12:28:18');
INSERT INTO `greenhouse_metrics` VALUES (36, 5, 10.00, 12.46, 20.00, 66.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:28:31', '2020-07-15 12:28:31');
INSERT INTO `greenhouse_metrics` VALUES (37, 5, 10.00, 12.46, 20.00, 66.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:33:31', '2020-07-15 12:33:31');
INSERT INTO `greenhouse_metrics` VALUES (38, 5, 10.00, 12.46, 20.00, 66.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:33:36', '2020-07-15 12:33:36');
INSERT INTO `greenhouse_metrics` VALUES (39, 5, 19.00, 12.46, 20.00, 66.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:33:54', '2020-07-15 12:33:54');
INSERT INTO `greenhouse_metrics` VALUES (40, 5, 19.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:35:58', '2020-07-15 12:35:58');
INSERT INTO `greenhouse_metrics` VALUES (41, 5, 19.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:36:10', '2020-07-15 12:36:10');
INSERT INTO `greenhouse_metrics` VALUES (42, 5, 19.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:36:23', '2020-07-15 12:36:23');
INSERT INTO `greenhouse_metrics` VALUES (43, 5, 8.00, 12.46, 20.00, 66.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:36:37', '2020-07-15 12:36:37');
INSERT INTO `greenhouse_metrics` VALUES (44, 5, 8.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:45:28', '2020-07-15 12:45:28');
INSERT INTO `greenhouse_metrics` VALUES (45, 5, 8.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:45:42', '2020-07-15 12:45:42');
INSERT INTO `greenhouse_metrics` VALUES (46, 5, 8.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:50:34', '2020-07-15 12:50:34');
INSERT INTO `greenhouse_metrics` VALUES (47, 5, 23.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:50:45', '2020-07-15 12:50:45');
INSERT INTO `greenhouse_metrics` VALUES (48, 5, 23.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:52:14', '2020-07-15 12:52:14');
INSERT INTO `greenhouse_metrics` VALUES (49, 5, 10.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:52:25', '2020-07-15 12:52:25');
INSERT INTO `greenhouse_metrics` VALUES (50, 5, 10.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:53:35', '2020-07-15 12:53:35');
INSERT INTO `greenhouse_metrics` VALUES (51, 5, 50.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:53:43', '2020-07-15 12:53:43');
INSERT INTO `greenhouse_metrics` VALUES (52, 5, 50.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:56:25', '2020-07-15 12:56:25');
INSERT INTO `greenhouse_metrics` VALUES (53, 5, 23.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:56:34', '2020-07-15 12:56:34');
INSERT INTO `greenhouse_metrics` VALUES (54, 5, 23.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:58:24', '2020-07-15 12:58:24');
INSERT INTO `greenhouse_metrics` VALUES (55, 5, 50.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:58:40', '2020-07-15 12:58:40');
INSERT INTO `greenhouse_metrics` VALUES (56, 5, 50.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:59:34', '2020-07-15 12:59:34');
INSERT INTO `greenhouse_metrics` VALUES (57, 5, 5.00, 13.48, 20.00, 61.00, 42.00, 48.00, 45.00, 15.00, '2020-07-15 12:59:38', '2020-07-15 12:59:38');
INSERT INTO `greenhouse_metrics` VALUES (58, 5, 23.00, 15.00, 20.00, 12.00, 68.00, 48.00, 20.00, 34.00, '2020-07-15 12:48:06', '2020-07-15 13:48:06');
INSERT INTO `greenhouse_metrics` VALUES (59, 5, 28.00, 15.00, 20.00, 12.00, 45.00, 48.00, 20.00, 36.00, '2020-07-15 12:48:41', '2020-07-15 13:48:41');
INSERT INTO `greenhouse_metrics` VALUES (60, 5, 28.00, 15.00, 20.00, 12.00, 45.00, 48.00, 20.00, 36.00, '2020-07-15 12:51:44', '2020-07-15 13:51:44');
INSERT INTO `greenhouse_metrics` VALUES (61, 5, 28.00, 15.00, 20.00, 12.00, 45.00, 48.00, 20.00, 36.00, '2020-07-15 14:08:37', '2020-07-15 14:08:37');
INSERT INTO `greenhouse_metrics` VALUES (62, 5, 22.00, 15.00, 20.00, 12.00, 43.00, 48.00, 34.00, 36.00, '2020-07-15 14:09:29', '2020-07-15 14:09:29');
INSERT INTO `greenhouse_metrics` VALUES (63, 5, 22.00, 15.00, 20.00, 12.00, 43.00, 48.00, 34.00, 36.00, '2020-07-15 14:09:37', '2020-07-15 14:09:37');
INSERT INTO `greenhouse_metrics` VALUES (64, 5, 22.00, 15.00, 20.00, 12.00, 43.00, 48.00, 34.00, 36.00, '2020-07-15 14:09:43', '2020-07-15 14:09:43');
INSERT INTO `greenhouse_metrics` VALUES (65, 5, 28.00, 15.00, 20.00, 12.00, 43.00, 48.00, 34.00, 36.00, '2020-07-15 14:09:56', '2020-07-15 14:09:56');
INSERT INTO `greenhouse_metrics` VALUES (66, 5, 28.00, 15.00, 20.00, 12.00, 43.00, 48.00, 34.00, 36.00, '2020-07-15 18:58:06', '2020-07-15 18:58:06');
INSERT INTO `greenhouse_metrics` VALUES (67, 5, 15.00, 15.00, 20.00, 12.00, 43.00, 48.00, 34.00, 36.00, '2020-07-15 18:58:18', '2020-07-15 18:58:18');
INSERT INTO `greenhouse_metrics` VALUES (68, 5, 15.00, 15.00, 20.00, 12.00, 43.00, 48.00, 34.00, 36.00, '2020-07-15 18:59:01', '2020-07-15 18:59:01');
INSERT INTO `greenhouse_metrics` VALUES (69, 5, 15.00, 45.00, 20.00, 12.00, 43.00, 48.00, 34.00, 36.00, '2020-07-15 18:59:55', '2020-07-15 18:59:55');
INSERT INTO `greenhouse_metrics` VALUES (70, 5, 15.00, 7.77, 20.00, 80.00, 43.00, 48.00, 34.00, 36.00, '2020-07-16 03:12:18', '2020-07-16 03:12:18');
INSERT INTO `greenhouse_metrics` VALUES (71, 5, 15.00, 7.77, 20.00, 80.00, 43.00, 48.00, 34.00, 36.00, '2020-07-16 03:16:16', '2020-07-16 03:16:16');
INSERT INTO `greenhouse_metrics` VALUES (72, 5, 15.00, 7.27, 20.00, 81.00, 43.00, 48.00, 34.00, 36.00, '2020-07-16 03:51:06', '2020-07-16 03:51:06');
INSERT INTO `greenhouse_metrics` VALUES (73, 5, 15.00, 7.27, 20.00, 81.00, 43.00, 48.00, 34.00, 36.00, '2020-07-16 03:52:05', '2020-07-16 03:52:05');
INSERT INTO `greenhouse_metrics` VALUES (74, 5, 15.00, 7.27, 90.00, 81.00, 68.00, 38.00, 78.00, 36.00, '2020-07-16 04:01:43', '2020-07-16 04:01:43');
INSERT INTO `greenhouse_metrics` VALUES (75, 5, 15.00, 45.00, 90.00, 12.00, 68.00, 38.00, 78.00, 36.00, '2020-07-16 04:42:05', '2020-07-16 04:42:05');
INSERT INTO `greenhouse_metrics` VALUES (76, 5, 15.00, 45.00, 90.00, 12.00, 68.00, 38.00, 68.00, 22.00, '2020-07-16 04:42:47', '2020-07-16 04:42:47');
INSERT INTO `greenhouse_metrics` VALUES (77, 5, 15.00, 13.74, 90.00, 49.00, 68.00, 38.00, 68.00, 22.00, '2020-07-17 13:21:35', '2020-07-17 13:21:35');
INSERT INTO `greenhouse_metrics` VALUES (78, 5, 15.00, 13.74, 90.00, 49.00, 68.00, 38.00, 68.00, 22.00, '2020-07-17 13:23:01', '2020-07-17 13:23:01');
INSERT INTO `greenhouse_metrics` VALUES (79, 5, 15.00, 8.23, 90.00, 74.00, 68.00, 38.00, 68.00, 22.00, '2020-07-18 21:11:33', '2020-07-18 21:11:33');
INSERT INTO `greenhouse_metrics` VALUES (80, 5, 25.00, 8.23, 45.00, 74.00, 78.00, 16.00, 23.00, 45.00, '2020-07-18 21:12:04', '2020-07-18 21:12:04');
INSERT INTO `greenhouse_metrics` VALUES (81, 5, 13.00, 8.23, 56.00, 74.00, 83.00, 28.00, 43.00, 52.00, '2020-07-18 21:12:30', '2020-07-18 21:12:30');
INSERT INTO `greenhouse_metrics` VALUES (82, 5, 32.00, 8.23, 56.00, 74.00, 83.00, 28.00, 43.00, 52.00, '2020-07-18 21:14:31', '2020-07-18 21:14:31');
INSERT INTO `greenhouse_metrics` VALUES (83, 5, 32.00, 8.23, 56.00, 74.00, 83.00, 28.00, 43.00, 52.00, '2020-07-18 21:15:56', '2020-07-18 21:15:56');
INSERT INTO `greenhouse_metrics` VALUES (84, 5, 32.00, 8.23, 56.00, 74.00, 83.00, 28.00, 43.00, 52.00, '2020-07-18 21:17:11', '2020-07-18 21:17:11');
INSERT INTO `greenhouse_metrics` VALUES (85, 5, 18.00, 8.23, 85.00, 74.00, 48.00, 62.00, 83.00, 17.00, '2020-07-18 21:20:53', '2020-07-18 21:20:53');
INSERT INTO `greenhouse_metrics` VALUES (86, 5, 7.00, 45.00, 78.00, 12.00, 48.00, 73.00, 83.00, 17.00, '2020-07-20 02:37:05', '2020-07-20 02:37:05');
COMMIT;

-- ----------------------------
-- Table structure for greenhouses
-- ----------------------------
DROP TABLE IF EXISTS `greenhouses`;
CREATE TABLE `greenhouses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` bigint unsigned NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `greenhouses_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of greenhouses
-- ----------------------------
BEGIN;
INSERT INTO `greenhouses` VALUES (5, 1, '5EDMY', 'Carrot', 'mS842GLPchY0l0y71mWXBub02lBJnpKIvw8M7wYlC5B1Sg7Vv6isYjj5eKRljDzb', '2020-07-01 12:47:50', '2020-07-01 12:47:50');
INSERT INTO `greenhouses` VALUES (6, 1, '5FZCM', 'Floral Space', 'nQZ5ZAvYYsQo6gtzzNWY9eVheqFIV7ScFsqm7qLAPGXnwKmGSJOyEd0WLgMCHQmV', '2020-07-18 17:26:10', '2020-07-18 17:26:10');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (2, '2020_04_22_000837_create_websockets_statistics_entries_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'admin', 'Super Administrator');
INSERT INTO `roles` VALUES (2, 'user', 'Viewer');
INSERT INTO `roles` VALUES (3, 'org-admin', 'Organisational Administrator');
INSERT INTO `roles` VALUES (4, 'data-capture', 'Data Capturer');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned DEFAULT NULL,
  `first_names` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_ibfk_1` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 1, 'Tapiwanashe', 'Mugoniwa', 'tmugonix@gmail.com', 'mugonix', NULL, '$2y$10$Yij1lw8xyEdI26JpqeoFE..1M7iRF9X4RGIMSd9yepORwLEOUDu3G', NULL, 1, '2020-03-05 11:29:30', '2020-03-05 11:29:30');
INSERT INTO `users` VALUES (2, 2, 'Esther', 'Mandina', 'emandina20@gmail.com', 'emandina', NULL, '$2y$10$WaDvgL0VaD5uw9b2csHit.JB9aAlzI/rWXlSFhU/KINr5nOitxa5K', NULL, 1, '2020-03-05 14:45:18', '2020-04-01 02:40:10');
INSERT INTO `users` VALUES (3, 2, 'Joh', 'Does', 'jdoe@gmail.com', 'test', NULL, '$2y$10$NlTxA7O1A3ruxm/zqeOyyuUdBq2rkiF.NA9Nu29RuqXy2L0Vs7LGW', NULL, 1, '2020-03-05 15:21:15', '2020-03-05 15:22:12');
COMMIT;

-- ----------------------------
-- Table structure for websockets_statistics_entries
-- ----------------------------
DROP TABLE IF EXISTS `websockets_statistics_entries`;
CREATE TABLE `websockets_statistics_entries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int NOT NULL,
  `websocket_message_count` int NOT NULL,
  `api_message_count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of websockets_statistics_entries
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
