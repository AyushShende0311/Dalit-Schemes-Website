DROP DATABASE IF EXISTS nivadakdalit;
 
CREATE DATABASE nivadakdalit;
USE nivadakdalit;

DROP TABLE IF EXISTS `images`;
DROP TABLE IF EXISTS `main`;
DROP TABLE IF EXISTS `localarea`;
DROP TABLE IF EXISTS `schemes`;
DROP TABLE IF EXISTS `taluka`;
DROP TABLE IF EXISTS `district`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `session`;
DROP TABLE IF EXISTS `events`;

CREATE TABLE district (
	`id` int AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
    PRIMARY KEY(`id`),
    `created_datetime` datetime NOT NULL,
	`updated_datetime` datetime NOT NULL,
	`created_by` varchar(50) NOT NULL,
	`updated_by` varchar(50) NOT NULL
);

CREATE TABLE taluka (
	`id` int AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
    `district_id` int NOT NULL,
    PRIMARY KEY(`id`),
    `created_datetime` datetime NOT NULL,
	`updated_datetime` datetime NOT NULL,
	`created_by` varchar(50) NOT NULL,
	`updated_by` varchar(50) NOT NULL,
	FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE CASCADE
);

CREATE TABLE localarea (
	`id` int AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
    `taluka_id` int NOT NULL,
    PRIMARY KEY(`id`),
    `created_datetime` datetime NOT NULL,
	`updated_datetime` datetime NOT NULL,
	`created_by` varchar(50) NOT NULL,
	`updated_by` varchar(50) NOT NULL,
    FOREIGN KEY (`taluka_id`) REFERENCES `taluka` (`id`) ON DELETE CASCADE
);

CREATE TABLE schemes (
	`id` int AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
     PRIMARY KEY(`id`),
     `created_datetime` datetime NOT NULL,
	`updated_datetime` datetime NOT NULL,
	`created_by` varchar(50) NOT NULL,
	`updated_by` varchar(50) NOT NULL
);

CREATE TABLE main (
	`id` int AUTO_INCREMENT,
    `district_id` int NOT NULL,
    `taluka_id` int NOT NULL,
    `schemes_id` int NOT NULL,
    `localarea_id` int NOT NULL,
	PRIMARY KEY(`id`),
	`created_datetime` datetime NOT NULL,
	`updated_datetime` datetime NOT NULL,
	`created_by` varchar(50) NOT NULL,
	`updated_by` varchar(50) NOT NULL,
    FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`taluka_id`) REFERENCES `taluka` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`schemes_id`) REFERENCES `schemes` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`localarea_id`) REFERENCES `localarea` (`id`) ON DELETE CASCADE
);

CREATE TABLE images (
	`id` int AUTO_INCREMENT,
	`url` varchar(2048) NOT NULL,
    `main_id` int NOT NULL,
     PRIMARY KEY(`id`),
	`created_datetime` datetime NOT NULL,
	`updated_datetime` datetime NOT NULL,
	`created_by` varchar(50) NOT NULL,
	`updated_by` varchar(50) NOT NULL,
    FOREIGN KEY (`main_id`) REFERENCES `main` (`id`) ON DELETE CASCADE
);

CREATE TABLE session (
  `id` INT NOT NULL DEFAULT 1,
  `user_name` VARCHAR(45) NULL,
  `is_logged_in` INT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE users (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(300) NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE event (
	`id` int AUTO_INCREMENT,
	`event_title` varchar(50) NOT NULL,
    `event_details` varchar(200) NOT NULL,
    `district_id` int NOT NULL,
    PRIMARY KEY(`id`),
    `created_datetime` datetime NOT NULL,
	`updated_datetime` datetime NOT NULL,
	`created_by` varchar(50) NOT NULL,
	`updated_by` varchar(50) NOT NULL,
	FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE CASCADE
);