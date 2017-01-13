-- MySQL Script generated by MySQL Workbench
-- 12/21/16 20:49:58
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- -----------------------------------------------------
-- Schema ET3Grupo5
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ET3Grupo5` ;
-- -----------------------------------------------------
-- Schema ET3Grupo5
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `ET3Grupo5` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `ET3Grupo5` ;

GRANT USAGE ON *.* TO 'usuarioEt3'@'localhost';

DROP USER 'usuarioEt3'@'localhost';

CREATE USER 'usuarioEt3'@'localhost' IDENTIFIED BY  'usuarioEt3';

GRANT USAGE ON *.* TO  'usuarioEt3'@'localhost' IDENTIFIED BY  'usuarioEt3' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT ALL PRIVILEGES ON  ET3 .* TO  'usuarioEt3'@'localhost' WITH GRANT OPTION ;

-- -----------------------------------------------------
-- Table `ET3Grupo5`.`perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`perfil` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`perfil` (
  `nombre` VARCHAR(30) COLLATE utf8_spanish_ci NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`usuario` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`usuario` (
  `nombre` VARCHAR(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` VARCHAR(40) COLLATE utf8_spanish_ci NOT NULL,
  `password` VARCHAR(40) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` VARCHAR(15) COLLATE utf8_spanish_ci NOT NULL,
  `DNI` VARCHAR(9) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  `borrado` INT(1) DEFAULT 0
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`accion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`accion` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`accion` (
  `nombre` VARCHAR(20) COLLATE utf8_spanish_ci NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`controlador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`controlador` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`controlador` (
  `nombre` VARCHAR(30) COLLATE utf8_spanish_ci NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`permisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`permisos` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`permisos` (
  `id_permiso` INT(11) NOT NULL,
  `controlador` VARCHAR(30) COLLATE utf8_spanish_ci NOT NULL,
  `accion` VARCHAR(20) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` VARCHAR(30) COLLATE utf8_spanish_ci NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`proveedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`proveedor` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`proveedor` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(40) COLLATE utf8_spanish_ci NOT NULL,
  `nif` VARCHAR(9) COLLATE utf8_spanish_ci NOT NULL,
  `correo_electronico` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` int(9) NOT NULL,
  `direccion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_postal` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(40) COLLATE utf8_spanish_ci NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`pedido` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`pedido` (
  `id` INT(11) NOT NULL,
  `id_proveedor` INT(11) NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  `fecha` varchar(100) COLLATE utf8_spanish_ci NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`material`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`material` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`material` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` TEXT COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0'
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`linea_pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`linea_pedido` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`linea_pedido` (
  `id` INT(11) NOT NULL,
  `id_material` INT(11) NOT NULL,
  `id_pedido` INT(11) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  `estado` enum('completa','pendiente','por llegar') COLLATE utf8_spanish_ci NOT NULL,
  `precio` INT(11) NOT NULL,
  `IVA` INT(11) NOT NULL)
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`material_proveedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`material_proveedor` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`material_proveedor` (
  `id_material` INT(11) NOT NULL,
  `id_proveedor` INT(11) NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`albaran`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`albaran` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`albaran` (
  `id` INT(11) NOT NULL,
  `id_pedido` INT(11) NOT NULL,
  `fecha` DATE NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`producto` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`producto` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` TEXT COLLATE utf8_spanish_ci NOT NULL,
  `id_material` INT(11) NULL,
  `cantidad` INT(11) NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`stock_material`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`stock_material` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`stock_material` (
  `id` INT(11) NOT NULL,
  `id_material` INT(11) NOT NULL,
  `id_albaran` INT(11) NOT NULL,
  `id_producto` INT(11)
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`stock_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`stock_producto` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`stock_producto` (
  `id` INT(11) NOT NULL,
  `id_producto` INT(11) NOT NULL,
  `coste` INT(11) NOT NULL,
  `fecha` DATE NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`linea_albaran`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`linea_albaran` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`linea_albaran` (
  `id` INT(11) NOT NULL,
  `id_albaran` INT(11) NOT NULL,
  `id_material` INT(11) NOT NULL,
  `cantidad` INT(11) NOT NULL)
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`factura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`factura` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`factura` (
  `id` INT(11) NOT NULL,
  `id_proveedor` INT(11) NOT NULL,
  `NIF` VARCHAR(9) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` DATE NOT NULL)
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ET3Grupo5`.`linea_factura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ET3Grupo5`.`linea_factura` ;
CREATE TABLE IF NOT EXISTS `ET3Grupo5`.`linea_factura` (
  `id` INT(11) NOT NULL,
  `id_albaran` INT(11) NOT NULL,
  `id_factura` INT(11) NOT NULL
  )
ENGINE = InnoDB default charset=utf8 collate=utf8_spanish_ci;


--
-- Inserts
--

INSERT INTO `accion` (`nombre`) VALUES
('ADD'),
('DELETE'),
('EDIT'),
('SHOW');
INSERT INTO `controlador` (`nombre`) VALUES
('ACCION'),
('CONTROLADOR'),
('PEDIDO'),
('PERFIL'),
('PERMISO'),
('PIEZA'),
('PRODUCTO'),
('PROVEEDOR'),
('PRUEBA1'),
('USUARIO'),
('ALBARAN'),
('FACTURA');
INSERT INTO `perfil` (`nombre`) VALUES
('Admin'),
('usuario');
INSERT INTO `permisos` (`id_permiso`, `controlador`, `accion`, `perfil`) VALUES
(3, 'USUARIO', 'DELETE', 'Admin'),
(4, 'USUARIO', 'SHOW', 'usuario'),
(12, 'USUARIO', 'SHOW', 'Admin'),
(16, 'USUARIO', 'EDIT', 'Admin'),
(17, 'CONTROLADOR', 'ADD', 'Admin'),
(18, 'CONTROLADOR', 'DELETE', 'Admin'),
(19, 'CONTROLADOR', 'EDIT', 'Admin'),
(20, 'CONTROLADOR', 'SHOW', 'Admin'),
(24, 'PERMISO', 'DELETE', 'Admin'),
(25, 'PRODUCTO', 'ADD', 'Admin'),
(26, 'PRODUCTO', 'DELETE', 'Admin'),
(28, 'ACCION', 'ADD', 'Admin'),
(29, 'ACCION', 'DELETE', 'Admin'),
(30, 'ACCION', 'EDIT', 'Admin'),
(31, 'ACCION', 'SHOW', 'Admin'),
(32, 'PERFIL', 'ADD', 'Admin'),
(33, 'PERFIL', 'DELETE', 'Admin'),
(35, 'PERFIL', 'EDIT', 'Admin'),
(36, 'PERFIL', 'SHOW', 'Admin'),
(39, 'PERMISO', 'EDIT', 'Admin'),
(40, 'PERMISO', 'SHOW', 'Admin'),
(41, 'USUARIO', 'ADD', 'Admin'),
(42, 'PERMISO', 'ADD', 'Admin'),
(43, 'PROVEEDOR', 'ADD', 'Admin'),
(44, 'PROVEEDOR', 'DELETE', 'Admin'),
(45, 'PROVEEDOR', 'EDIT', 'Admin'),
(46, 'PROVEEDOR', 'SHOW', 'Admin'),
(47, 'PEDIDO', 'ADD', 'Admin'),
(48, 'PEDIDO', 'DELETE', 'Admin'),
(49, 'PEDIDO', 'EDIT', 'Admin'),
(50, 'PEDIDO', 'SHOW', 'Admin');
INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `DNI`, `password`, `perfil`, `borrado`) VALUES
(57, 'dkjskjdkjsdkjskjd', 'JARDIM', '12345679A', '25f9e794323b453885f5181f1b624d0b', 'usuario', 0),-- Contraseña 123456789
(58, 'Admin', 'adminadmin', '12345672A', 'f6fdffe48c908deb0f4c3bd36c032e72', 'Admin', 0),-- contraseña adminadmin
(61, 'Marcos', 'Gonzalez', '12345675A', '25f9e794323b453885f5181f1b624d0b', 'Admin', 0);-- contraseña 123456789
INSERT INTO `proveedor` (`id`, `nombre`, `nif`, `correo_electronico`, `telefono`, `direccion`, `codigo_postal`, `ciudad`, `provincia`) VALUES
(1, 'RIPPER Inc.', '12345678A', 'trampa@uvigo.es', 12412341, 'Calle Redondo,12', '1234', 'Ourense', 'Ourense'),
(4, 'jghfjh', '12345691M', 'grande@alumnos.es', 123123123, 'calle tonto', '0', 'Ourense', 'Ourense'),
(5, 'Ã±daslkjfÃ±l', '01234567H', 'tonto@tonto.es', 123123125, 'rua gilipollas', '0', 'gilipollilandia', 'tontolaba'),
(7, 'Prueba Proveedor', '33333333R', 'correo@correo.es', 123123128, 'calle gregoriano', '77777', 'Ourense', 'Ourense'),
(8, 'otra prueba', '12345678R', 'prueba@yahoo.es', 12121212, 'rua gilipollas', '55555', 'Ourense', 'Ourense'),
(9, 'Prueba Proveedor', '12121212H', 'h@hotmail.com', 123456789, 'calle tonto 22', '33333', 'Ourense', 'Ourense'),
(10, 'Metalman', '44444444H', 'burning_angel@hotmail.com', 123456789, 'rua gilipollas 2', '66666', 'Ourense', 'Ourense');
INSERT INTO `linea_pedido` (`id`, `id_material`, `id_pedido`, `cantidad`, `estado`, `precio`, `IVA`) VALUES
(2, 1, 4, 5, '', 200, 16),
(3, 3, 3, 20, '', 200, 8),
(4, 2, 3, 40, '', 50, 16),
(7, 3, 4, 20, '', 50, 16),
(8, 2, 4, 50, '', 250, 16),
(9, 4, 4, 12, '', 120, 16),
(12, 1, 3, 120, '', 120, 16),
(13, 3, 5, 500, '', 300, 16),
(14, 1, 5, 500, '', 200, 16),
(16, 2, 5, 233, 'pendiente', 400, 16),
(17, 1, 7, 666, '', 300, 16),
(18, 2, 7, 777, '', 400, 16),
(19, 4, 7, 123, '', 130, 16),
(20, 2, 16, 123, '', 120, 16);
INSERT INTO `material` (`id`, `nombre`, `descripcion`, `borrado`) VALUES
(1, 'Plastico', 'Buena Calidad', 0),
(2, 'Hierro', 'Buena Calidad', 0),
(3, 'Acero', 'Buena Calidad', 0),
(4, 'Aleación de Titaneo', 'Buena Calidad', 0);
INSERT INTO `pedido` (`id`, `id_proveedor`, `id_usuario`, `fecha`) VALUES
(3, 8, 61, '2016-11-29'),
(4, 1, 58, '2016-12-08'),
(5, 8, 61, '2017-01-03'),
(7, 7, 57, '2016-12-07'),
(13, 4, 58, '2017-01-01'),
(14, 1, 58, '2017-01-01'),
(15, 7, 58, '2018-01-01'),
(16, 1, 61, '2016-11-27');
INSERT INTO `proveedor` (`id`, `nombre`, `nif`, `correo_electronico`, `telefono`, `direccion`, `codigo_postal`, `ciudad`, `provincia`) VALUES
(11, 'Prueba Proveedor 2', '33333332R', 'correo2@correo.es', 123123122, 'calle gregoriano 2', 77772, 'Ourense 2', 'Ourense 2');
INSERT INTO `pedido` (`id`, `id_proveedor`, `id_usuario`, `fecha`) VALUES
('00000000000', 11, '57','2017-10-03'),
('00000000001', 1, '58','2017-10-03');
INSERT INTO `albaran` (`id`, `id_pedido`, `fecha`) VALUES
('00000000000', '00000000000', '2017-10-04'),
('00000000001', '00000000001', '2017-10-04');
INSERT INTO `controlador` (`nombre`) VALUES
('MATERIAL'),
('STOCK_MATERIAL');
INSERT INTO `permisos` (`id_permiso`, `controlador`, `accion`, `perfil`) VALUES
(51, 'MATERIAL', 'ADD', 'Admin'),
(52, 'MATERIAL', 'DELETE', 'Admin'),
(53, 'MATERIAL', 'EDIT', 'Admin'),
(54, 'MATERIAL', 'SHOW', 'Admin'),
(55, 'STOCK_MATERIAL', 'ADD', 'Admin'),
(56, 'STOCK_MATERIAL', 'DELETE', 'Admin'),
(57, 'STOCK_MATERIAL', 'EDIT', 'Admin'),
(58, 'STOCK_MATERIAL', 'SHOW', 'Admin'),
(59, 'ALBARAN', 'SHOW', 'Admin'),
(60, 'ALBARAN', 'DELETE', 'Admin'),
(61, 'ALBARAN', 'ADD', 'Admin'),
(62, 'ALBARAN', 'EDIT', 'Admin'),
(63, 'FACTURA', 'SHOW', 'Admin'),
(64, 'FACTURA', 'DELETE', 'Admin'),
(65, 'FACTURA', 'ADD', 'Admin'),
(66, 'FACTURA', 'EDIT', 'Admin');
INSERT INTO `material` (`id`, `nombre`, `descripcion`, `borrado`) VALUES
('00000000005', 'Tronco', 'Tronco de madera de 2 metros de longitud', '0'),
('00000000006', 'Barra metalica', 'Barra metalica de 5 cm de diametro y 3 m de largo', '0');
INSERT INTO `stock_material` (`id`, `id_material`, `id_albaran`, `id_producto`) VALUES
('00000000000', '00000000005', '00000000000', '00000000000'),
('00000000001', '00000000006', '00000000001', '00000000001');
INSERT INTO `stock_material` (`id`, `id_material`, `id_albaran`) VALUES
('00000000002', '00000000006', '00000000001');
INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `id_material`, `cantidad`) VALUES
('00000000000', 'Mesa', 'Tronco descripcion', '00000000005', '36'),
('00000000001', 'Jaula', 'Barra metalica descripcion', '00000000006', '27');



--
-- Indices, auto-increments y FK
--

ALTER TABLE perfil
ADD PRIMARY KEY (`nombre`);

ALTER TABLE usuario
ADD PRIMARY KEY (`id_usuario`), ADD KEY `perfil_idx` (`perfil`), MODIFY `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `perfil` FOREIGN KEY (`perfil`) REFERENCES `perfil`(`nombre`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE accion
ADD PRIMARY KEY (`nombre`);

ALTER TABLE controlador
ADD PRIMARY KEY (`nombre`);

ALTER TABLE permisos
ADD PRIMARY KEY (`id_permiso`), ADD KEY `accion_idx` (`accion`), ADD KEY `controlador_idx` (`controlador`), ADD KEY `perfil_idx` (`perfil`),
ADD CONSTRAINT `perm_accion` FOREIGN KEY (`accion`) REFERENCES `accion`(`nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `perm_controlador` FOREIGN KEY (`controlador`) REFERENCES `controlador`(`nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `perm_perfil` FOREIGN KEY (`perfil`) REFERENCES `perfil`(`nombre`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE permisos
MODIFY `id_permiso` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE proveedor
ADD PRIMARY KEY (`id`), MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE pedido
ADD PRIMARY KEY (`id`), ADD KEY `proveedor_idx` (`id_proveedor`), ADD KEY `pedido_usuario_idx` (`id_usuario`),
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `pedido_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `pedido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE material
ADD PRIMARY KEY (`id`), MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE linea_pedido
ADD PRIMARY KEY (`id`), ADD KEY `pedido_idx` (`id_pedido`), ADD KEY `lineaped_material_idx` (`id_material`),
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lineaped_material` FOREIGN KEY (`id_material`) REFERENCES `material`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE material_proveedor
ADD PRIMARY KEY (`id_material`,`id_proveedor`), ADD KEY `materialprov_proveedor_idx` (`id_proveedor`),
ADD CONSTRAINT `materialprov_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `materialprov_material` FOREIGN KEY (`id_material`) REFERENCES `material`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE albaran
ADD PRIMARY KEY (`id`), ADD KEY `alabran_pedido_idx` (`id_pedido`), MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `alabran_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE producto
ADD PRIMARY KEY (`id`), ADD KEY `receta_material_idx` (`id_material`), MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `receta_material` FOREIGN KEY (`id_material`) REFERENCES `material`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE stock_material
ADD PRIMARY KEY (`id`), ADD KEY `stockmat_mat_idx` (`id_material`), ADD KEY `stockmat_albaran_idx` (`id_albaran`), ADD KEY `stockmat_producto_idx` (`id_producto`),
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `stockmat_mat` FOREIGN KEY (`id_material`) REFERENCES `material`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `stockmat_albaran` FOREIGN KEY (`id_albaran`) REFERENCES `albaran`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE stock_producto
ADD PRIMARY KEY (`id`), ADD KEY `stockprod_producto_idx` (`id_producto`), MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `stockprod_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE linea_albaran
ADD PRIMARY KEY (`id`), ADD KEY `lineaalbaran_albaran_idx` (`id_albaran`), ADD KEY `lineaalbaran_tipomat_idx` (`id_material`),
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `lineaalbaran_albaran` FOREIGN KEY (`id_albaran`) REFERENCES `albaran`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lineaalbaran_tipomat` FOREIGN KEY (`id_material`) REFERENCES `material`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE factura
ADD PRIMARY KEY (`id`), ADD KEY `factura_proveedor_idx` (`id_proveedor`), MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `factura_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE linea_factura
ADD PRIMARY KEY (`id`), ADD KEY `lineafact_albaran_idx` (`id_albaran`), ADD KEY `lineafact_factura_idx` (`id_factura`),
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `lineafact_albaran` FOREIGN KEY (`id_albaran`) REFERENCES `albaran`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `lineafact_factura` FOREIGN KEY (`id_factura`) REFERENCES `factura`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
