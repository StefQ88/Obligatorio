-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-07-2024 a las 00:47:22
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

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
  `fechaReserva` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `motivo` varchar(200) DEFAULT NULL,
  `fechaCreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
  `estado` enum('disponible','no_disponible') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
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
  PRIMARY KEY (`ci`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ci`, `primerNombre`, `segundoNombre`, `primerApellido`, `segundoApellido`, `fechaNacimiento`, `email`, `fotoPerfil`, `pass`, `tipoUsuario`, `activo`) VALUES
('12345678', 'Administrador', '', 'Apellido', 'SegundoApellido', '2000-01-01', 'administrador@mail.com', '', '0192023a7bbd73250516f069df18b500', 'administrador', 1),
('12345679', 'Empleado', '', 'Apellido', 'ApellidoDos', '2003-01-01', 'empleado@mail.com', '', '0314ee502c6f4e284128ad14e84e37d5', 'empleado', 1);

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
