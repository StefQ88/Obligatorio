-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-06-2024 a las 21:43:03
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

DROP TABLE IF EXISTS `datos`;
CREATE TABLE IF NOT EXISTS `datos` (
  `IdSala` int NOT NULL,
  `CiEmpleado` varchar(8) DEFAULT NULL,
  `fechaReserva` timestamp NULL DEFAULT NULL,
  `horaInicio` datetime DEFAULT NULL,
  `horaFin` datetime DEFAULT NULL,
  `motivo` varchar(200) DEFAULT NULL,
  `fechaCreacion` timestamp NULL DEFAULT NULL,
  `estado` enum('activa','finalizada') DEFAULT NULL,
  PRIMARY KEY (`IdSala`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saladeconferencias`
--

DROP TABLE IF EXISTS `saladeconferencias`;
CREATE TABLE IF NOT EXISTS `saladeconferencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `capacidad` int NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `equipamientoDisponible` varchar(100) DEFAULT NULL,
  `estado` enum('disponible','no diaponible') DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `ci` varchar(8) NOT NULL,
  `primerNombre` varchar(50) NOT NULL,
  `segundoNombre` varchar(50) DEFAULT NULL,
  `primerApellido` varchar(50) NOT NULL,
  `segundoApellido` varchar(50) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `fotoPerfil` varchar(150) DEFAULT NULL,
  `pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipoUsuario` enum('empleado','administrador') NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `ci`, `primerNombre`, `segundoNombre`, `primerApellido`, `segundoApellido`, `fechaNacimiento`, `email`, `fotoPerfil`, `pass`, `tipoUsuario`, `activo`) VALUES
(1, '12345678', 'stef', '', 'quio', 'per', '1988-06-16', 'stefquio@gmail.com', '', 'fc7ec6f8c8cfcda5ef848b4a6baac266', 'administrador', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos`
--
ALTER TABLE `datos`
  ADD CONSTRAINT `datos_ibfk_1` FOREIGN KEY (`IdSala`) REFERENCES `saladeconferencias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
