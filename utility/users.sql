USE nivadakdalit;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(300) NULL,
  PRIMARY KEY (`id`));
