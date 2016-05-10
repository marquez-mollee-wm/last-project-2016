-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema MovieZ
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema MovieZ
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `MovieZ` DEFAULT CHARACTER SET utf8 ;
USE `MovieZ` ;

-- -----------------------------------------------------
-- Table `MovieZ`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MovieZ`.`categories` (
  `idcategories` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) CHARACTER SET 'latin1' NOT NULL,
  PRIMARY KEY (`idcategories`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `MovieZ`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MovieZ`.`users` (
  `idusers` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) CHARACTER SET 'latin1' NOT NULL,
  `password` VARCHAR(45) CHARACTER SET 'latin1' NOT NULL,
  `email` VARCHAR(45) CHARACTER SET 'latin1' NOT NULL,
  `profilePic` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  PRIMARY KEY (`idusers`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `idusers_UNIQUE` (`idusers` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `MovieZ`.`movies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MovieZ`.`movies` (
  `idmovies` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `director` VARCHAR(45) NULL DEFAULT NULL,
  `release` DATETIME NULL DEFAULT NULL,
  `description` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `picture` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `approve` VARCHAR(45) NULL DEFAULT NULL,
  `rating` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `categories_idcategories` INT(11) NOT NULL,
  `users_idusers` INT(11) NOT NULL,
  PRIMARY KEY (`idmovies`),
  INDEX `fk_movies_categories_idx` (`categories_idcategories` ASC),
  INDEX `fk_movies_users1_idx` (`users_idusers` ASC),
  CONSTRAINT `fk_movies_categories`
    FOREIGN KEY (`categories_idcategories`)
    REFERENCES `MovieZ`.`categories` (`idcategories`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_movies_users1`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `MovieZ`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
