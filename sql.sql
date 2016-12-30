-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-12-2016 a las 23:09:02
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `nuevaBD`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE IF NOT EXISTS `accion` (
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion` (`nombre`) VALUES
('ADD'),
('DELETE'),
('EDIT'),
('PRUEBA2'),
('SHOW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlador`
--

CREATE TABLE IF NOT EXISTS `controlador` (
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `controlador`
--

INSERT INTO `controlador` (`nombre`) VALUES
('ACCION'),
('CONTROLADOR'),
('PERFIL'),
('PERMISO'),
('PRUEBA1'),
('USUARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`nombre`) VALUES
('Admin'),
('PRUEBA1'),
('usuario1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
`id_permiso` int(11) NOT NULL,
  `controlador` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `accion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `permisos`
--

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
(42, 'PERMISO', 'ADD', 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `DNI` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `borrado` varchar(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `DNI`, `password`, `perfil`, `borrado`) VALUES
(57, 'dkjskjdkjsdkjskjd', 'JARDIM', '12345679A', '123456789', 'usuario', '1'),
(58, 'Admin', 'Jardim Vila', '12345672A', 'adminadmin', 'Admin', '0'),
(61, 'Marcos', 'Gonzalez', '12345675A', '123456789', 'Admin', '0'),
(62, 'pepe', 'pepe', '12345678B', '123147123', 'usuario', '0'),
(63, 'Jezer', 'Vila', 'Y0199306W', '123456789', 'Admin', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accion`
--
ALTER TABLE `accion`
 ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `controlador`
--
ALTER TABLE `controlador`
 ADD PRIMARY KEY (`nombre`), ADD UNIQUE KEY `nombre` (`nombre`), ADD KEY `nombre_2` (`nombre`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
 ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
 ADD PRIMARY KEY (`id_permiso`), ADD KEY `fk_controlador_permisos_controlador` (`controlador`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
