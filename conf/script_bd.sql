-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema rec
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema rec
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rec` DEFAULT CHARACTER SET utf8 ;
USE `rec` ;

-- -----------------------------------------------------
-- Table `rec`.`livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rec`.`livro` (
  `l_id_livro` INT NOT NULL AUTO_INCREMENT,
  `l_titulo` VARCHAR(250) NULL,
  `l_ano_publicacao` INT NULL,
  `l_isdn` VARCHAR(45) NULL,
  `l_preco` DECIMAL(16,2) NULL,
  PRIMARY KEY (`l_id_livro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rec`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rec`.`cliente` (
  `c_idCliente` INT NOT NULL AUTO_INCREMENT,
  `c_nome` VARCHAR(250) NULL,
  `c_cpf` VARCHAR(45) NULL,
  `c_dt_nascimento` VARCHAR(45) NULL,
  PRIMARY KEY (`c_idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rec`.`venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rec`.`venda` (
  `v_idVenda` INT NOT NULL AUTO_INCREMENT,
  `v_valor_total_venda` DECIMAL(16,2) NULL,
  `v_desconto` DECIMAL(16,2) NULL,
  `v_c_idCliente` INT NOT NULL,
  PRIMARY KEY (`v_idVenda`),
  INDEX `fk_venda_cliente1_idx` (`v_c_idCliente` ASC),
  CONSTRAINT `fk_venda_cliente1`
    FOREIGN KEY (`v_c_idCliente`)
    REFERENCES `rec`.`cliente` (`c_idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rec`.`item_venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rec`.`item_venda` (
  `iv_v_idVenda` INT NOT NULL,
  `iv_l_id_livro` INT NOT NULL,
  `iv_quantidade` INT NULL,
  `iv_valor_total_item` DECIMAL(16,2) NULL,
  `iv_data_venda` VARCHAR(45) NULL,
  PRIMARY KEY (`iv_v_idVenda`, `iv_l_id_livro`),
  INDEX `fk_venda_has_livro_livro1_idx` (`iv_l_id_livro` ASC),
  INDEX `fk_venda_has_livro_venda_idx` (`iv_v_idVenda` ASC),
  CONSTRAINT `fk_venda_has_livro_venda`
    FOREIGN KEY (`iv_v_idVenda`)
    REFERENCES `rec`.`venda` (`v_idVenda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venda_has_livro_livro1`
    FOREIGN KEY (`iv_l_id_livro`)
    REFERENCES `rec`.`livro` (`l_id_livro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rec`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rec`.`autor` (
  `a_idAutor` INT NOT NULL AUTO_INCREMENT,
  `a_nome` VARCHAR(45) NULL,
  `a_sobrenome` VARCHAR(45) NULL,
  PRIMARY KEY (`a_idAutor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rec`.`livro_has_autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rec`.`livro_has_autor` (
  `la_livro_l_id_livro` INT NOT NULL,
  `la_autor_a_idAutor` INT NOT NULL,
  PRIMARY KEY (`la_livro_l_id_livro`, `la_autor_a_idAutor`),
  INDEX `fk_livro_has_autor_autor1_idx` (`la_autor_a_idAutor` ASC),
  INDEX `fk_livro_has_autor_livro1_idx` (`la_livro_l_id_livro` ASC),
  CONSTRAINT `fk_livro_has_autor_livro1`
    FOREIGN KEY (`la_livro_l_id_livro`)
    REFERENCES `rec`.`livro` (`l_id_livro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro_has_autor_autor1`
    FOREIGN KEY (`la_autor_a_idAutor`)
    REFERENCES `rec`.`autor` (`a_idAutor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
