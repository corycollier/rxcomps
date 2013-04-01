CREATE  TABLE IF NOT EXISTS `events` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` TEXT NULL ,
  `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `scales` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `code` VARCHAR(2) NOT NULL,
  `event_id` INT NOT NULL ,
  `max_count` INT NOT NULL DEFAULT 1,
  `price` FLOAT(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`) ,
  INDEX `fk_events_idx` (`event_id` ASC) ,
  CONSTRAINT `fk_scales_events`
    FOREIGN KEY (`event_id`)
    REFERENCES `events` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `athletes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `scale_id` INT NOT NULL ,
  `event_id` INT NOT NULL ,
  `gender` ENUM('male', 'female', 'team') NOT NULL DEFAULT 'team',
  `gym` TEXT,
  `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) ,
  INDEX `fk_events_idx` (`event_id` ASC) ,
  CONSTRAINT `fk_athletes_events`
    FOREIGN KEY (`event_id` )
    REFERENCES `events` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_athletes_scales`
    FOREIGN KEY (`scale_id` )
    REFERENCES `scales` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `competitions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  `date` TIMESTAMP NOT NULL DEFAULT 0 ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` TIMESTAMP NOT NULL DEFAULT 0 ,
  `event_id` INT NOT NULL ,
  `goal` ENUM('time', 'amrap', 'max') NOT NULL DEFAULT 'time' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_events_idx` (`event_id` ASC) ,
  CONSTRAINT `fk_competitions_events`
    FOREIGN KEY (`event_id` )
    REFERENCES `events` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION
  )
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `scorings` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `competition_id` INT NOT NULL ,
  `definition` TEXT,
  PRIMARY KEY (`id`) ,
  UNIQUE KEY `uk_competition_scoring` (`competition_id`),
  CONSTRAINT `fk_competitions_scorings`
    FOREIGN KEY (`competition_id` )
    REFERENCES `competitions` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `scores` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `score` FLOAT(10,3) NOT NULL DEFAULT 0.000 ,
  `athlete_id` INT NOT NULL ,
  `competition_id` INT NOT NULL ,
  `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) ,
  UNIQUE KEY `uk_athlete_competition_score` (`athlete_id`,`competition_id`),
  INDEX `fk_athletes_idx` (`athlete_id` ASC) ,
  INDEX `fk_competitions_idx` (`competition_id` ASC) ,
  CONSTRAINT `fk_scores_athletes`
    FOREIGN KEY (`athlete_id` )
    REFERENCES `athletes` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_scores_competitions`
    FOREIGN KEY (`competition_id` )
    REFERENCES `competitions` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `passwd` VARCHAR(40) NOT NULL ,
  `role` VARCHAR(40) NOT NULL DEFAULT 'user' ,
  `gender` ENUM('male', 'female') NOT NULL DEFAULT 'male',
  `first_name` VARCHAR(40) NULL ,
  `last_name` VARCHAR(40) NULL ,
  `address1` VARCHAR(40) NULL ,
  `address2` VARCHAR(40) NULL ,
  `city` VARCHAR(40) NULL ,
  `state` VARCHAR(2) NULL ,
  `postal` VARCHAR(10) NULL ,
  `country` VARCHAR(255) NULL ,
  `birthday` DATETIME NOT NULL ,
  `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `registrations` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `event_id` INT(11) NOT NULL, -- what event the registration is for
    `user_id` INT(11) NOT NULL, -- who created the registration
    `athlete_id` INT(11) NOT NULL, -- the athlete record that will be used for scoring
    `role` ENUM('user', 'judge', 'admin') NOT NULL DEFAULT 'user',
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_event_user_registration` (`event_id`,`user_id`),
    CONSTRAINT `fk_registrations_event_id` FOREIGN KEY (`event_id`)
        REFERENCES `events` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT `fk_registrations_user_id` FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT `fk_registrations_athlete_id` FOREIGN KEY (`athlete_id`)
        REFERENCES `athletes` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `registration_shirts` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `registration_id` INT(11) NOT NULL,
    `size` ENUM('xx-small', 'x-small', 'small', 'medium', 'large', 'x-large', 'xx-large') DEFAULT 'medium',
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_registration_shirts_registration_id` FOREIGN KEY (`registration_id`)
        REFERENCES `registrations` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `event_options` (
    id INT(11) NOT NULL AUTO_INCREMENT,
    event_id INT(11) NOT NULL,
    name VARCHAR(40) NOT NULL,
    value TEXT,
    PRIMARY KEY(id),
    UNIQUE KEY `uk_competition_scoring` (`event_id`, `name`)
)
ENGINE = InnoDB;