USE nivadakdalit;
DROP TABLE IF EXISTS session;

CREATE TABLE session (
  `id` INT NOT NULL DEFAULT 1,
  `user_name` VARCHAR(45) NULL,
  `is_logged_in` INT NULL,
  PRIMARY KEY (`id`));
