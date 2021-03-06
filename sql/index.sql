-- MySQL Script generated by MySQL Workbench
-- 05/12/20 17:44:44
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `Materias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Materias` ;

CREATE TABLE IF NOT EXISTS `Materias` (
  `mat_id` INT NOT NULL AUTO_INCREMENT,
  `mat_nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`mat_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Asignatura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Asignatura` ;

CREATE TABLE IF NOT EXISTS `Asignatura` (
  `asi_id` INT NOT NULL AUTO_INCREMENT,
  `asi_nombre` VARCHAR(45) NOT NULL,
  `mat_id` INT NOT NULL,
  PRIMARY KEY (`asi_id`, `mat_id`),
  CONSTRAINT `fk_Asignatura_Materias`
    FOREIGN KEY (`mat_id`)
    REFERENCES `Materias` (`mat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Grado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Grado` ;

CREATE TABLE IF NOT EXISTS `Grado` (
  `gra_id` INT NOT NULL AUTO_INCREMENT,
  `gra_nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`gra_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Grado_has_Asignatura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Grado_has_Asignatura` ;

CREATE TABLE IF NOT EXISTS `Grado_has_Asignatura` (
  `gra_asi_id` INT NOT NULL AUTO_INCREMENT,
  `gra_id` INT NOT NULL,
  `asi_id` INT NOT NULL,
  `mat_id` INT NOT NULL,
  PRIMARY KEY (`gra_asi_id`, `gra_id`, `asi_id`, `mat_id`),
  CONSTRAINT `fk_Grado_has_Asignatura_Grado1`
    FOREIGN KEY (`gra_id`)
    REFERENCES `Grado` (`gra_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Grado_has_Asignatura_Asignatura1`
    FOREIGN KEY (`asi_id` , `mat_id`)
    REFERENCES `Asignatura` (`asi_id` , `mat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Curso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Curso` ;

CREATE TABLE IF NOT EXISTS `Curso` (
  `cur_id` INT NOT NULL AUTO_INCREMENT,
  `cur_nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cur_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Curso_has_Grado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Curso_has_Grado` ;

CREATE TABLE IF NOT EXISTS `Curso_has_Grado` (
  `cur_gra_id` INT NOT NULL AUTO_INCREMENT,
  `cur_id` INT NOT NULL,
  `gra_id` INT NOT NULL,
  PRIMARY KEY (`cur_gra_id`, `cur_id`, `gra_id`),
  CONSTRAINT `fk_Curso_has_Grado_Curso1`
    FOREIGN KEY (`cur_id`)
    REFERENCES `Curso` (`cur_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_has_Grado_Grado1`
    FOREIGN KEY (`gra_id`)
    REFERENCES `Grado` (`gra_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
