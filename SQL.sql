-- MySQL Script generated by MySQL Workbench
-- mié 03 may 2017 19:15:04 COT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tucasa
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tucasa
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tucasa` DEFAULT CHARACTER SET utf8 ;
SHOW WARNINGS;
USE `tucasa` ;

-- -----------------------------------------------------
-- Table `tucasa`.`Rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tucasa`.`Rol` (
  `idRol` INT NOT NULL AUTO_INCREMENT,
  `nombreRol` VARCHAR(20) NOT NULL,
  `descripcionRol` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idRol`))
ENGINE = InnoDB
AUTO_INCREMENT = 1;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `tucasa`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tucasa`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `fechaNacimiento` DATE NULL,
  `telefono` VARCHAR(10) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` TEXT(100) NOT NULL,
  `avatar` VARCHAR(50) NULL,
  `fechaRegistro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUltimoIngreso` DATETIME NULL,
  `idRol_rol` INT NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_Usuario_rol_idx` (`idRol_rol` ASC),
  CONSTRAINT `fk_Usuario_rol`
    FOREIGN KEY (`idRol_rol`)
    REFERENCES `tucasa`.`Rol` (`idRol`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `tucasa`.`Fotos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tucasa`.`Fotos` (
  `idfotos` INT NOT NULL AUTO_INCREMENT,
  `srcFotos` JSON NOT NULL,
  PRIMARY KEY (`idfotos`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `tucasa`.`Departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tucasa`.`Departamento` (
  `idDepartamento` TINYINT(2) NOT NULL,
  `nombreDepartamento` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idDepartamento`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `tucasa`.`Ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tucasa`.`Ciudad` (
  `idCiudad` SMALLINT(3) NOT NULL,
  `nombreCiudad` VARCHAR(30) NOT NULL,
  `idDepartamento_Departamento` TINYINT(2) NOT NULL,
  PRIMARY KEY (`idCiudad`),
  INDEX `fk_Ciudad_departamento_idx` (`idDepartamento_Departamento` ASC),
  CONSTRAINT `fk_Ciudad_departamento`
    FOREIGN KEY (`idDepartamento_Departamento`)
    REFERENCES `tucasa`.`Departamento` (`idDepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `tucasa`.`Inmueble`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tucasa`.`Inmueble` (
  `idInmueble` INT NOT NULL AUTO_INCREMENT,
  `idCiudad_ciudad` SMALLINT(3) NOT NULL,
  `barrio` VARCHAR(45) NOT NULL,
  `precio` FLOAT NOT NULL,
  `estadoInmueble` ENUM('nuevo', 'usado', 'en_construccion') NOT NULL,
  `noHabitaciones` TINYINT(2) NOT NULL,
  `noBanios` TINYINT(2) NOT NULL,
  `pisos` TINYINT(2) NOT NULL,
  `noParqueadero` TINYINT(2) NOT NULL,
  `estrato` TINYINT(1) NOT NULL,
  `descripcion` JSON NOT NULL,
  `idFotos_fotos` INT NOT NULL,
  PRIMARY KEY (`idInmueble`),
  INDEX `fk_Inmueble_fotos_idx` (`idFotos_fotos` ASC),
  INDEX `fk_Inmueble_ciudad_idx` (`idCiudad_ciudad` ASC),
  CONSTRAINT `fk_Inmueble_fotos`
    FOREIGN KEY (`idFotos_fotos`)
    REFERENCES `tucasa`.`Fotos` (`idfotos`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Inmueble_ciudad`
    FOREIGN KEY (`idCiudad_ciudad`)
    REFERENCES `tucasa`.`Ciudad` (`idCiudad`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 1
PASSWORD = ' ';

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `tucasa`.`PublicacionInmueble`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tucasa`.`PublicacionInmueble` (
  `idPublicacionInmueble` INT NOT NULL AUTO_INCREMENT,
  `idInmueble_inmueble` INT NOT NULL,
  `idUsuario_usuario` INT NOT NULL,
  `tipoPublicacion` ENUM('Alquilar', 'Comprar') NOT NULL,
  `likesPublicacion` TINYINT(3) NOT NULL DEFAULT 0,
  `estadoPublicacion` TINYINT NULL,
  `fechaPublicacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaVencimiento` DATETIME NOT NULL,
  `publicacionVerificada` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`idPublicacionInmueble`, `idInmueble_inmueble`),
  INDEX `fk_PublicacionInmueble_usuario_idx` (`idUsuario_usuario` ASC),
  CONSTRAINT `fk_PublicacionInmueble_usuario`
    FOREIGN KEY (`idUsuario_usuario`)
    REFERENCES `tucasa`.`Usuario` (`idUsuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_PublicacionInmueble_inmueble`
    FOREIGN KEY (`idInmueble_inmueble`)
    REFERENCES `tucasa`.`Inmueble` (`idInmueble`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `tucasa`.`Rol`
-- -----------------------------------------------------
START TRANSACTION;
USE `tucasa`;
INSERT INTO `tucasa`.`Rol` (`idRol`, `nombreRol`, `descripcionRol`) VALUES (1, 'administrador', 'Tiene permisos para todo');
INSERT INTO `tucasa`.`Rol` (`idRol`, `nombreRol`, `descripcionRol`) VALUES (2, 'auditor', 'Revisar publicacion');
INSERT INTO `tucasa`.`Rol` (`idRol`, `nombreRol`, `descripcionRol`) VALUES (3, 'usuario_registrado', 'Usuario Registrado en el sistema');
INSERT INTO `tucasa`.`Rol` (`idRol`, `nombreRol`, `descripcionRol`) VALUES (4, 'Usuario_facebook', 'Usuario registrado por medio de facebook');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tucasa`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `tucasa`;
INSERT INTO `tucasa`.`Usuario` (`idUsuario`, `nombres`, `apellidos`, `fechaNacimiento`, `telefono`, `email`, `password`, `avatar`, `fechaRegistro`, `fechaUltimoIngreso`, `idRol_rol`) VALUES (1, 'Tatiana', 'Aramburo', NULL, DEFAULT, 'tatisandis@gmail.com', 'princess', NULL, '28-02-2016', '28-02-2017', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `tucasa`.`Departamento`
-- -----------------------------------------------------
START TRANSACTION;
USE `tucasa`;
INSERT INTO `tucasa`.`Departamento` (`idDepartamento`, `nombreDepartamento`) VALUES (76, 'Valle');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tucasa`.`Ciudad`
-- -----------------------------------------------------
START TRANSACTION;
USE `tucasa`;
INSERT INTO `tucasa`.`Ciudad` (`idCiudad`, `nombreCiudad`, `idDepartamento_Departamento`) VALUES (109, 'Buenaventura', 76);

COMMIT;

