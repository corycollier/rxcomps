CREATE  TABLE IF NOT EXISTS `events` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `athletes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `event_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_events_idx` (`event_id` ASC) ,
  CONSTRAINT `fk_athletes_events`
    FOREIGN KEY (`event_id` )
    REFERENCES `events` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `competitions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  `date` TIMESTAMP NOT NULL DEFAULT 0 ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ,
  `updated` TIMESTAMP NOT NULL DEFAULT 0 ,
  `event_id` INT NOT NULL ,
  `goal` ENUM('time', 'amrap', 'max') NOT NULL DEFAULT 'time' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_events_idx` (`event_id` ASC) ,
  CONSTRAINT `fk_competitions_events`
    FOREIGN KEY (`event_id` )
    REFERENCES `events` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `scores` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `score` INT NOT NULL DEFAULT 0 ,
  `athlete_id` INT NOT NULL ,
  `competition_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
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
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `passwd` VARCHAR(40) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;