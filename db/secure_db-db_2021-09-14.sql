-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-09-2021 a las 19:35:07
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `secure_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(20) NOT NULL,
  `Clave` varchar(100) NOT NULL,
  `Token` varchar(100) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `FNacimiento` date DEFAULT NULL,
  `Cedula` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Hijos` int(11) DEFAULT NULL,
  `EstadoCivil` int(11) DEFAULT NULL,
  `Foto` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Clave`, `Token`, `Nombre`, `Apellido`, `Correo`, `FNacimiento`, `Cedula`, `Hijos`, `EstadoCivil`, `Foto`) VALUES
('pepe', '123', '123', 'Pepe', 'Pompan', 'pepe@pompan.com', '2000-01-01', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
