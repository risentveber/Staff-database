
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Подразделения`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Подразделения` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`Название подразделения` VARCHAR(45) NOT NULL,

	PRIMARY KEY (`id`)
);

-- -----------------------------------------------------
-- Table `mydb`.`Сектора`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Сектора` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`Название сектора` VARCHAR(45) NULL,
	`Подразделения_id` INT NOT NULL,
	
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_Сектора_Подразделения` FOREIGN KEY (`Подразделения_id`) REFERENCES `mydb`.`Подразделения` (`id`)
);

-- -----------------------------------------------------
-- Table `mydb`.`Сотрудники`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Сотрудники` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`Фамилия` VARCHAR(45) NOT NULL,
	`Имя` VARCHAR(45) NOT NULL,
	`Отчество` VARCHAR(45) NULL,
	`Фамилия на английском` VARCHAR(45) NULL,
	`Имя на английском` VARCHAR(45) NULL,
	`Коэффициент` DOUBLE NULL DEFAULT 1.0,
	`Сектор_id` INT NOT NULL,

	PRIMARY KEY (`id`),
	CONSTRAINT `fk_Сотрудники_сектора` FOREIGN KEY (`Сектор_id`) REFERENCES `mydb`.`Сектора` (`id`)
);

-- -----------------------------------------------------
-- Table `mydb`.`Издания`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Издания` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`Тип издания` VARCHAR(45) NULL,
	`Полное название журнала` VARCHAR(45) NOT NULL,
	`Сокращенное название журнала` VARCHAR(45) NULL,
	`Коэффициент цитируемости` DOUBLE NULL,

	PRIMARY KEY (`id`)
);

-- -----------------------------------------------------
-- Table `mydb`.`Публикации`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Публикации` 
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`Издания_id` INT NOT NULL,
	`Название публикации` VARCHAR(45) NOT NULL,
	`Год публикации` INT NOT NULL,
	`Число авторов` INT NOT NULL,
	`Полная библиографическая ссылка` VARCHAR(200) NULL,

	CONSTRAINT uc_Year_name UNIQUE (`Название публикации`, `Год публикации`),
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_Публикации_Издания` FOREIGN KEY (`Издания_id`) REFERENCES `mydb`.`Издания` (`id`)
);

-- -----------------------------------------------------
-- Table `mydb`.`Авторы-Публикации`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Авторы-Публикации` 
(
	`Сотрудники_id` INT NOT NULL,
	`Публикации_id` INT NOT NULL,
	PRIMARY KEY (`Публикации_id`, `Сотрудники_id`),
	INDEX `idx_Авторы-Публикации_Сотрудники` (`Сотрудники_id` ASC),
	INDEX `idx_Авторы-Публикации_Публикации` (`Публикации_id` ASC),
	CONSTRAINT `fk_Авторы-Публикации_Сотрудники` FOREIGN KEY (`Сотрудники_id`) REFERENCES `mydb`.`Сотрудники` (`id`),
	CONSTRAINT `fk_Авторы-Публикации_Публикации` FOREIGN KEY (`Публикации_id`) REFERENCES `mydb`.`Публикации` (`id`)
);

