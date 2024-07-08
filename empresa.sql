-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-07-2024 a las 21:44:05
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

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`IdSala`, `CiEmpleado`, `fechaReserva`, `horaInicio`, `horaFin`, `motivo`, `fechaCreacion`, `estado`) VALUES
(1, '12345679', '2024-07-11', '21:09:00', '23:09:00', NULL, '2024-07-08 21:09:11', NULL),
(2, '13246578', '2024-07-11', '21:40:00', '23:40:00', NULL, '2024-07-08 21:41:00', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `saladeconferencias`
--

INSERT INTO `saladeconferencias` (`id`, `nombre`, `capacidad`, `ubicacion`, `equipamientoDisponible`, `estado`, `foto`) VALUES
(1, 'Sala Verdi', 1450, 'cuidad vieja', 'equipamiento', 'no_disponible', 'uploads/668c2b4ebdd0d9.33617029_1b2d9510-d66d-43a2-971a-cfcbb600e7fe.png'),
(2, 'Sala2', 667, 'piso123', 'equipo', 'no_disponible', 'uploads/668c5cda310e84.94506399_2f97f05b32547f54ef1bdf99cd207c90.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `ci`, `primerNombre`, `segundoNombre`, `primerApellido`, `segundoApellido`, `fechaNacimiento`, `email`, `fotoPerfil`, `pass`, `tipoUsuario`, `activo`) VALUES
(1, '12345678', 'Santiago', 'Agustin', 'Sibilia', 'Sastre', '1998-08-17', 'algo@mail.com', '12345678668c2b082951b5.94267590.jpg', 'f501a8928398ff5210fd486a248e1a52', 'administrador', 1),
(2, '12345679', 'Agustin', 'Santiago', 'Gagleano', 'Garcia', '1998-10-20', 'empleado@mail.com', '12345679668c2c16684f23.40888593.png', '0314ee502c6f4e284128ad14e84e37d5', 'empleado', 1),
(3, '13246578', 'Nombre', '', 'Apellido', 'segApellido', '1999-05-05', 'mail@mail.com', '', 'e3ae69b7485a1ba5dfec809789d8a55b', 'empleado', 1);

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
