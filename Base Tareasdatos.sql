-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.28-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para registros
CREATE DATABASE IF NOT EXISTS `registros` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `registros`;

-- Volcando estructura para tabla registros.registrotareas
CREATE TABLE IF NOT EXISTS `registrotareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `matematica` tinyint(1) NOT NULL,
  `comunicacion` tinyint(1) NOT NULL,
  `ciencias` tinyint(1) NOT NULL,
  `fisica` tinyint(1) NOT NULL,
  `quimica` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla registros.registrotareas: ~9 rows (aproximadamente)
INSERT INTO `registrotareas` (`id`, `nombre`, `apellido`, `matematica`, `comunicacion`, `ciencias`, `fisica`, `quimica`) VALUES
	(1, 'Stev ', 'Chucuya', 1, 1, 1, 1, 1),
	(2, 'Romeo', 'Chucuya', 0, 0, 0, 0, 0),
	(3, 'Dina', 'Baluarte', 0, 0, 0, 0, 0),
	(4, 'Stev ', 'Chucuya', 1, 1, 1, 1, 1),
	(5, 'Stev ', 'Chucuya', 1, 1, 1, 1, 1),
	(6, 'enrique', 'iglesias', 0, 0, 0, 0, 0),
	(7, 'Canelo', 'Alvarez', 0, 0, 0, 0, 0),
	(8, 'daniel', 'josue', 1, 1, 1, 1, 0),
	(9, 'Daniel', 'Carrion', 0, 0, 0, 0, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
