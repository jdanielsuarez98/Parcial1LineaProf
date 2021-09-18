-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-09-2021 a las 18:40:21
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `Usuario_origen` varchar(20) NOT NULL,
  `Usuario_destino` varchar(20) NOT NULL,
  `Texto` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(20) NOT NULL,
  `Clave` varchar(100) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `FNacimiento` date DEFAULT NULL,
  `Color` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Hijos` int(11) DEFAULT NULL,
  `Foto` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Clave`, `Nombre`, `Apellido`, `FNacimiento`, `Color`, `Hijos`, `Foto`) VALUES
('pepe', '123', 'Pepe', 'Pompan', '2000-01-01', NULL, NULL, NULL),
('pipe', 'pipe1', 'felipe', 'suarez', '2002-01-01', 'verde', 2, 'hola');


-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);

