CREATE SCHEMA IF NOT EXISTS `staff_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `staff_database`.`units`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `staff_database`.`units` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`unit_name` VARCHAR(45) NOT NULL,

	PRIMARY KEY (`id`),
	CONSTRAINT `uc_unit_name` UNIQUE (`unit_name`)
);

-- -----------------------------------------------------
-- Table `staff_database`.`sectors`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `staff_database`.`sectors` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`sector_name` VARCHAR(45) NULL,
	`unit_id` INT NOT NULL,
	
	PRIMARY KEY (`id`),
	CONSTRAINT `uc_sector_name_unit_id` UNIQUE (`sector_name`,`unit_id`),
	CONSTRAINT `fk_sector_unit` FOREIGN KEY (`unit_id`) REFERENCES `staff_database`.`units` (`id`)
);

-- -----------------------------------------------------
-- Table `staff_database`.`employees`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `staff_database`.`employees` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`surname` VARCHAR(45) NOT NULL,
	`name` VARCHAR(45) NOT NULL,
	`patronymic` VARCHAR(45) NULL,
	`en_surname` VARCHAR(45) NULL,
	`en_name` VARCHAR(45) NULL,
	`coefficient` DOUBLE NOT NULL DEFAULT 1.0,
	`sector_id` INT NOT NULL,

	PRIMARY KEY (`id`),
	CONSTRAINT `uc_surname_name` UNIQUE (`surname`,`name`),
	CONSTRAINT `fk_employee_sector` FOREIGN KEY (`sector_id`) REFERENCES `staff_database`.`sectors` (`id`)
);

-- -----------------------------------------------------
-- Table `staff_database`.`editions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `staff_database`.`editions` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`foreign` BOOLEAN NOT NULL,
	`edition_name` VARCHAR(45) NOT NULL,
	`short_edition_name` VARCHAR(45) NULL,
	`impact_factor` DOUBLE NOT NULL,

	PRIMARY KEY (`id`),
	CONSTRAINT `uc_edition_name` UNIQUE (`edition_name`)
);

-- -----------------------------------------------------
-- Table `staff_database`.`publications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `staff_database`.`publications` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`edition_id` INT NOT NULL,
	`preprint` BOOLEAN NOT NULL,
	`publication_name` VARCHAR(45) NOT NULL,
	`year` INT NOT NULL,
	`number_of_authors` INT NOT NULL,
	`full_bibliographic_reference` VARCHAR(200) NULL,

	CONSTRAINT `uc_publication_name_year` UNIQUE (`publication_name`, `year`),
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_publication_edition` FOREIGN KEY (`edition_id`) REFERENCES `staff_database`.`editions` (`id`)
);

-- -----------------------------------------------------
-- Table `staff_database`.`authors-publications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `staff_database`.`authors-publications` 
(
	`employee_id` INT NOT NULL,
	`publication_id` INT NOT NULL,

	PRIMARY KEY (`publication_id`, `employee_id`),
	INDEX `idx_employee_id` (`employee_id` ASC),
	INDEX `idx_publication_id` (`publication_id` ASC),
	CONSTRAINT `fk_authors-publications_employees` FOREIGN KEY (`employee_id`) REFERENCES `staff_database`.`employees` (`id`),
	CONSTRAINT `fk_authors-publications_publication` FOREIGN KEY (`publication_id`) REFERENCES `staff_database`.`publications` (`id`)
);

-- -----------------------------------------------------
-- Table `staff_database`.`activities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `staff_database`.`activities`
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`activity_name` VARCHAR(45) NOT NULL,
	`activity_coefficient` DOUBLE NOT NULL DEFAULT 1.0,
	`description` VARCHAR(200) NULL,

	CONSTRAINT `fk_employee_sector` FOREIGN KEY (`sector_id`) REFERENCES `staff_database`.`sectors` (`id`)
);

