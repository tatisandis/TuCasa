-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-05-2017 a las 11:48:18
-- Versión del servidor: 5.7.18-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tucasa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudad`
--

CREATE TABLE `Ciudad` (
  `idCiudad` smallint(3) NOT NULL,
  `nombreCiudad` varchar(30) NOT NULL,
  `idDepartamento_Departamento` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Ciudad`
--

INSERT INTO `Ciudad` (`idCiudad`, `nombreCiudad`, `idDepartamento_Departamento`) VALUES
(109, 'Buenaventura', 76);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Departamento`
--

CREATE TABLE `Departamento` (
  `idDepartamento` tinyint(2) NOT NULL,
  `nombreDepartamento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Departamento`
--

INSERT INTO `Departamento` (`idDepartamento`, `nombreDepartamento`) VALUES
(76, 'Valle');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fotos`
--

CREATE TABLE `Fotos` (
  `idfotos_inmueble` int(11) NOT NULL,
  `srcFotos` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Fotos`
--

INSERT INTO `Fotos` (`idfotos_inmueble`, `srcFotos`) VALUES
(1, '[{\"no\": \"1\", \"src\": \"Disenio-de-pequeño-comedor-de-casa-moderna.jpg\"}]'),
(2, '[{\"no\": \"1\", \"src\": \"Disenio-de-sala-moderna3.jpg\"}]'),
(3, '[{\"no\": \"1\", \"src\": \"Disenio-de-sala-moderna3.jpg\"}]'),
(4, '[{\"no\": \"1\", \"src\": \"Disenio-de-sala-moderna3.jpg\"}]'),
(5, '[{\"no\": \"1\", \"src\": \"Disenio-de-sala-moderna3.jpg\"}]'),
(6, '[{\"no\": \"1\", \"src\": \"Disenio-de-sala-moderna3.jpg\"}]'),
(7, '[{\"no\": \"1\", \"src\": \"Disenio-de-sala-moderna3.jpg\", \"descripcion\": \"sala de estar\"}]'),
(8, '[{\"no\": \"1\", \"src\": \"56_5903a2c1563f3\"}]'),
(9, '[{\"no\": \"1\", \"src\": \"56_5903a42c3cda0\"}]'),
(10, '[{\"no\": \"1\", \"src\": \"56_5903a46c278b3\"}]'),
(11, '[{\"no\": \"1\", \"src\": \"56_5903a63084c6a\"}]'),
(12, '[{\"no\": \"1\", \"src\": \"56_5903aa25c5a6c\"}]'),
(13, '[{\"no\": \"1\", \"src\": \"56_5903ab272b8dd\"}]'),
(14, '[{\"no\": \"1\", \"src\": \"56_5903ab5a4d4a9\"}]'),
(15, '[{\"no\": \"1\", \"src\": \"56_5903ab6dbdd40\"}]'),
(16, '[{\"no\": \"1\", \"src\": \"56_5903aba4a6ec9\"}]'),
(17, '[{\"no\": \"1\", \"src\": \"56_5903ac1e1b1c9\"}]'),
(18, '[{\"no\": \"1\", \"src\": \"56_5903b5f29c074\"}]'),
(19, '[{\"no\": \"1\", \"src\": \"56_5903b671925ae\"}]'),
(20, '[{\"no\": \"1\", \"src\": \"56_5903b67f40d4a\"}]'),
(21, '[{\"no\": \"1\", \"src\": \"56_5903b6c85cf23\"}]'),
(22, '[{\"no\": \"1\", \"src\": \"56_5903b7a68a01a\"}]'),
(23, '[{\"no\": \"1\", \"src\": \"56_5903bc29c0eca\"}]'),
(24, '[{\"no\": \"1\", \"src\": \"56_5903bc36c9c5f\"}]'),
(25, '[{\"no\": \"1\", \"src\": \"56_5903bc57083d6\"}]'),
(26, '[{\"no\": \"1\", \"src\": \"56_5903bcb145917\"}]'),
(27, '[]'),
(28, '[]'),
(29, '[{\"no\": \"1\", \"src\": \"56_5903bf22c9065\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inmueble`
--

CREATE TABLE `Inmueble` (
  `idInmueble` int(11) NOT NULL,
  `idCiudad_ciudad` smallint(3) NOT NULL,
  `tipo_inmueble` enum('Apartamento','Casa','Finca','Parqueadero','Oficina','Local','Bodega','Lote','Habitación','Consultorio','Edificio','Cabaña','Casa campestre','Aparta-Estudio','Casa-Lote') DEFAULT NULL,
  `barrio` varchar(45) NOT NULL,
  `precio` float NOT NULL,
  `estadoInmueble` enum('nuevo','usado','en_construccion') NOT NULL,
  `noHabitaciones` tinyint(2) NOT NULL,
  `noBanios` tinyint(2) NOT NULL,
  `pisos` tinyint(2) NOT NULL,
  `noParqueadero` tinyint(2) NOT NULL,
  `estrato` tinyint(1) NOT NULL,
  `descripcion` text,
  `idFotos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Inmueble`
--

INSERT INTO `Inmueble` (`idInmueble`, `idCiudad_ciudad`, `tipo_inmueble`, `barrio`, `precio`, `estadoInmueble`, `noHabitaciones`, `noBanios`, `pisos`, `noParqueadero`, `estrato`, `descripcion`, `idFotos`) VALUES
(1, 109, 'Casa', 'bolivar', 250000, 'usado', 2, 1, 1, 0, 3, '545665', 1),
(2, 109, 'Apartamento', 'bolivar', 350000, 'usado', 3, 2, 1, 0, 3, '[{\"descripcion\": \"esta cerca de parques\"}]', 2),
(3, 109, 'Habitación', 'independencia', 15000, 'usado', 1, 1, 1, 0, 2, '\"apartaestudio para una persona\"', 2),
(4, 109, 'Casa', 'bellavista', 250000, 'usado', 2, 1, 1, 0, 2, '\"-\"', 2),
(5, 109, 'Apartamento', 'centro', 800000, 'usado', 2, 2, 1, 0, 4, '\"cebtri\"', 2),
(6, 109, 'Casa', 'san luis', 350000, 'usado', 2, 1, 1, 0, 3, 'Tiene closet recien renovados, patio amplio', 2),
(7, 109, 'Casa', 'San Luis', 250000, 'usado', 1, 1, 1, 0, 2, 'Casa de una planta, ubicada en el barrio san Luis, a sus alrededores cuenta con escuelas y una iglesia.', 22),
(8, 109, 'Casa', 'San Luis', 250000, 'usado', 1, 1, 1, 0, 2, 'Casa de una planta, ubicada en el barrio san Luis, a sus alrededores cuenta con escuelas y una iglesia.', 25),
(9, 109, 'Casa', 'San Luis', 250000, 'usado', 1, 1, 1, 0, 2, 'Casa de una planta, ubicada en el barrio san Luis, a sus alrededores cuenta con escuelas y una iglesia.', 26),
(10, 109, 'Apartamento', 'Cascajal', 300000, 'nuevo', 2, 1, 1, 0, 3, '+', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PublicacionInmueble`
--

CREATE TABLE `PublicacionInmueble` (
  `idPublicacionInmueble` int(11) NOT NULL,
  `idInmueble_inmueble` int(11) NOT NULL,
  `idUsuario_usuario` int(11) NOT NULL,
  `tipoPublicacion` enum('Alquilar','Comprar') NOT NULL,
  `likesPublicacion` tinyint(3) NOT NULL DEFAULT '0',
  `estadoPublicacion` tinyint(4) DEFAULT NULL,
  `fechaPublicacion` date NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `publicacionVerificada` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `PublicacionInmueble`
--

INSERT INTO `PublicacionInmueble` (`idPublicacionInmueble`, `idInmueble_inmueble`, `idUsuario_usuario`, `tipoPublicacion`, `likesPublicacion`, `estadoPublicacion`, `fechaPublicacion`, `fechaVencimiento`, `publicacionVerificada`) VALUES
(1, 1, 56, 'Comprar', 0, 1, '2017-04-01', '2017-05-31', 0),
(2, 2, 56, 'Alquilar', 2, 1, '2017-04-04', '2017-05-24', 0),
(3, 3, 56, 'Alquilar', 0, 1, '2017-04-05', '2017-04-28', 0),
(4, 4, 56, 'Alquilar', 0, 1, '2017-04-05', '2017-04-28', 0),
(5, 5, 56, 'Alquilar', 0, 1, '2017-04-05', '2017-04-28', 0),
(6, 2, 56, 'Alquilar', 0, 1, '2017-04-05', '2017-04-28', 0),
(7, 2, 57, 'Alquilar', 0, 1, '2017-04-05', '2017-04-28', 0),
(8, 2, 57, 'Alquilar', 0, 1, '2017-04-05', '2017-04-28', 0),
(9, 2, 57, 'Alquilar', 0, 1, '2017-04-05', '2017-04-28', 0),
(10, 2, 57, 'Alquilar', 0, 1, '2017-04-05', '2017-04-28', 0),
(11, 2, 57, 'Alquilar', 0, 1, '2017-04-05', '2017-04-28', 0),
(12, 8, 56, 'Alquilar', 0, 0, '2017-04-28', '2017-07-27', 0),
(13, 9, 56, 'Alquilar', 0, 0, '2017-04-28', '2017-07-27', 0),
(14, 10, 56, 'Alquilar', 0, 1, '2017-04-28', '2017-07-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE `Rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(20) NOT NULL,
  `descripcionRol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`idRol`, `nombreRol`, `descripcionRol`) VALUES
(1, 'administrador', 'Tiene permisos para todo'),
(2, 'auditor', 'Revisar publicacion'),
(3, 'usuario_registrado', 'Usuario Registrado en el sistema'),
(4, 'Usuario_facebook', 'Usuario registrado por medio de facebook');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `fechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUltimoIngreso` datetime DEFAULT NULL,
  `idRol_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `nombres`, `apellidos`, `fechaNacimiento`, `telefono`, `email`, `password`, `avatar`, `fechaRegistro`, `fechaUltimoIngreso`, `idRol_rol`) VALUES
(3, 'Carlos Alfonso', 'Aramburo Lopez', '1954-05-01', '3154381132', 'carlos-lopez54@hotmaill.com', 'e10adc3949ba59abbe56e057f20f883e', 'avatar.jpg', '2017-03-14 00:00:00', '2017-03-31 00:00:00', 3),
(23, 'Martha', 'Morales', '1966-10-14', '3162975299', 'martik-morales@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2017-03-15 00:00:00', NULL, 3),
(24, 'Cecilia', 'Portocarrero', '1966-10-01', '123456', 'cecilia@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2017-03-15 00:00:00', NULL, 3),
(33, 'Gloria', 'Morales', '1966-12-31', '3156586743', 'gloria@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2017-03-31 00:00:00', '2017-03-31 00:00:00', 3),
(45, 'Jhon', 'Velasco', '1985-04-07', '3108274117', 'velasco@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2017-03-15 00:00:00', '2017-03-31 00:00:00', 3),
(46, 'Tatiana', 'Aramburo', '2017-03-11', '123456', 'taramburomorales@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2017-03-16 00:00:00', NULL, 3),
(47, 'Jhon', 'Hurtado', '1980-03-01', '3172466743', 'jhon@hotmaill.com', 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2017-03-16 00:00:00', NULL, 3),
(49, 'Sofia', 'Velasco', '2017-03-17', '123456', 'sofia@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2017-03-17 00:00:00', '2017-03-31 00:00:00', 3),
(52, 'Tatiana', 'Aramburo', '2017-03-09', '3172466743', 'tatisandis@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '2017-03-17 00:00:00', '2017-03-31 00:00:00', 3),
(53, 'Sofia', 'Velasco', '2014-04-04', '789456', 'sofiavelasco@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '2017-03-17 00:00:00', '2017-04-03 22:20:58', 3),
(54, 'Maria A', 'Gallego', '2017-03-01', '456789', 'mariagallego@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '2017-03-17 00:00:00', '2017-03-31 00:00:00', 3),
(55, 'Alexander', 'Velasco', '2017-03-01', '1456456', 'velascohurtado@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2017-03-17 00:00:00', '2017-03-29 00:00:00', 3),
(56, 'Gloria', 'Morales', '1948-12-31', '3156586746', 'gloriamorales31@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'avatar.jpg', '2017-03-31 00:00:00', '2017-04-28 18:13:23', 3),
(57, 'Ingrid', 'Murillo', '1987-12-15', '3151234567', 'vanessamurillo@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2017-04-02 00:00:00', '2017-04-02 21:35:35', 3),
(58, 'Sandra', 'Alzate', '2017-04-25', '3124556656', 'sandra@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2017-04-25 00:00:00', NULL, 3),
(59, 'Sandra', 'Alzate', '2017-04-25', '3124556656', 'sandra1@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2017-04-25 00:00:00', NULL, 3),
(60, 'Sandra', 'Alzate', '2017-04-25', '3124556656', 'sandra2@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2017-04-25 00:00:00', NULL, 3),
(61, 'Liliana', 'Giraldo', '2017-04-03', '3124566989', 'lili_g_7@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2017-04-25 00:00:00', NULL, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Ciudad`
--
ALTER TABLE `Ciudad`
  ADD PRIMARY KEY (`idCiudad`),
  ADD KEY `fk_Ciudad_departamento_idx` (`idDepartamento_Departamento`);

--
-- Indices de la tabla `Departamento`
--
ALTER TABLE `Departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `Fotos`
--
ALTER TABLE `Fotos`
  ADD PRIMARY KEY (`idfotos_inmueble`);

--
-- Indices de la tabla `Inmueble`
--
ALTER TABLE `Inmueble`
  ADD PRIMARY KEY (`idInmueble`),
  ADD KEY `fk_Inmueble_fotos_idx` (`idFotos`),
  ADD KEY `fk_Inmueble_ciudad_idx` (`idCiudad_ciudad`);

--
-- Indices de la tabla `PublicacionInmueble`
--
ALTER TABLE `PublicacionInmueble`
  ADD PRIMARY KEY (`idPublicacionInmueble`,`idInmueble_inmueble`),
  ADD KEY `fk_PublicacionInmueble_usuario_idx` (`idUsuario_usuario`),
  ADD KEY `fk_PublicacionInmueble_inmueble` (`idInmueble_inmueble`);

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_Usuario_rol_idx` (`idRol_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Fotos`
--
ALTER TABLE `Fotos`
  MODIFY `idfotos_inmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `Inmueble`
--
ALTER TABLE `Inmueble`
  MODIFY `idInmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `PublicacionInmueble`
--
ALTER TABLE `PublicacionInmueble`
  MODIFY `idPublicacionInmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `Rol`
--
ALTER TABLE `Rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Ciudad`
--
ALTER TABLE `Ciudad`
  ADD CONSTRAINT `fk_Ciudad_departamento` FOREIGN KEY (`idDepartamento_Departamento`) REFERENCES `Departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Inmueble`
--
ALTER TABLE `Inmueble`
  ADD CONSTRAINT `fk_Inmueble_ciudad` FOREIGN KEY (`idCiudad_ciudad`) REFERENCES `Ciudad` (`idCiudad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Inmueble_fotos` FOREIGN KEY (`idFotos`) REFERENCES `Fotos` (`idfotos_inmueble`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `PublicacionInmueble`
--
ALTER TABLE `PublicacionInmueble`
  ADD CONSTRAINT `fk_PublicacionInmueble_inmueble` FOREIGN KEY (`idInmueble_inmueble`) REFERENCES `Inmueble` (`idInmueble`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_PublicacionInmueble_usuario` FOREIGN KEY (`idUsuario_usuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_Usuario_rol` FOREIGN KEY (`idRol_rol`) REFERENCES `Rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
