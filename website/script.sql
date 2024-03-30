SET FOREIGN_KEY_CHECKS=0;
DROP DATABASE IF EXISTS cryptoshow_db;
CREATE DATABASE cryptoshow_db;
USE cryptoshow_db;

CREATE USER IF NOT EXISTS cryptoshowuser@localhost IDENTIFIED BY 'cryptoshowpass';
GRANT SELECT, INSERT, UPDATE, DELETE ON cryptoshow_db.* TO cryptoshowuser@localhost;

-- ----------------------------------
-- Table structure for `roles`
-- ----------------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Insert some default roles
INSERT INTO `roles` (`role_name`) VALUES ('user'), ('admin');

-- ----------------------------------
-- Table structure for `registered_user`
-- ----------------------------------
DROP TABLE IF EXISTS `registered_user`;
CREATE TABLE `registered_user` (
  `user_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_nickname` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_hashed_password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_role_id` INT(10) UNSIGNED NOT NULL DEFAULT 1, -- Default role is 'user'
  `user_device_count` TINYINT(5) UNSIGNED NOT NULL DEFAULT 0,
  `user_registered_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  FOREIGN KEY (`fk_role_id`) REFERENCES `roles`(`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------------
-- Table structure for `crypto_device`
-- ----------------------------------
DROP TABLE IF EXISTS `crypto_device`;
CREATE TABLE `crypto_device` (
  `crypto_device_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_user_id` INT(10) UNSIGNED NOT NULL,
  `crypto_device_name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `crypto_device_image_name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `crypto_device_record_visible` BOOLEAN DEFAULT FALSE,
  `crypto_device_registered_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`fk_user_id`) REFERENCES `registered_user`(`user_id`),
  PRIMARY KEY (`crypto_device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------------
-- Table structure for `event`
-- ----------------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `event_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_date` DATE COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_venue` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------------
-- Table structure for `user_event`
-- ----------------------------------
DROP TABLE IF EXISTS `user_event`;
CREATE TABLE `user_event` (
  `fk_user_id` INT(10) UNSIGNED NOT NULL,
  `fk_event_id` INT(10) UNSIGNED NOT NULL,
  FOREIGN KEY (`fk_user_id`) REFERENCES `registered_user`(`user_id`),
  FOREIGN KEY (`fk_event_id`) REFERENCES `event`(`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;