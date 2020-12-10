SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;

USE `promocode`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `promocodes`;
CREATE TABLE `promocodes`
(
    `id`        int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id`   int(10) unsigned DEFAULT NULL,
    `value`     varchar(100) CHARACTER SET utf8 NOT NULL,
    `issued_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_value` (`value`),
    UNIQUE KEY `unique_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `email`      varchar(255) NOT NULL,
    `password`   varchar(255) NOT NULL,
    `created_at` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
