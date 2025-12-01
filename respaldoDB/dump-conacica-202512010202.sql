/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.1.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: conacica
-- ------------------------------------------------------
-- Server version	12.1.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `alianzas`
--

DROP TABLE IF EXISTS `alianzas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `alianzas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(100) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alianzas`
--

LOCK TABLES `alianzas` WRITE;
/*!40000 ALTER TABLE `alianzas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `alianzas` VALUES
(1,'kevallevar.webp','kevallevar',1);
/*!40000 ALTER TABLE `alianzas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `descr` varchar(300) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `offers` varchar(350) DEFAULT NULL,
  `images` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `courses` VALUES
(2,'Finanzas y Contabilidad Básica para el Productor Agrícola','Cálculo de costos por hectárea (semilla, fertilizante, mano de obra) y punto de equilibrio.','Curso Intensivo para productores','2025-05-23','✅ Optimización de Rutas\n✅ Manejo de Cadena de Frío\n✅ Certificación en Normatividad','n2.jpg'),
(3,'Marketing Digital B2B para Mayoristas y Centrales de Abasto','Creación de catálogos de productos (precios, calidad, disponibilidad) fáciles de compartir por WhatsApp Business y correo.','Curso intensivo para distribuidores','2025-09-20','✅ Optimización de Rutas\n✅ Manejo de Cadena de Frío\n✅ Certificación en Normatividad','n4.png'),
(4,'Logística y Manejo de Carga: Conservación de Productos Perecederos','Este curso está diseñado para reducir las pérdidas post-cosecha y optimizar las rutas.','Curso Intensivo para Transportistas','2025-05-06','\n✅ Optimización de Rutas\n✅ Manejo de Cadena de Frío\n✅ Certificación en Normatividad\n','n6.jpg');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `promocional`
--

DROP TABLE IF EXISTS `promocional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `promocional` (
  `promocionalId` varchar(25) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `url` varchar(200) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`promocionalId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocional`
--

LOCK TABLES `promocional` WRITE;
/*!40000 ALTER TABLE `promocional` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `promocional` VALUES
('1','Sabor autentico con productos 100% mexicanos',' En nuestro restaurante, la autenticidad es la base. Utilizamos ingredientes 100% mexicanos, frescos y de origen local, para recrear los sabores tradicionales que cuentan la historia de nuestro país.\nConozca nuestra cocina, un punto de encuentro entre la tradición y el sabor más puro.','#','promocional.webp',0),
('692c06ad9c6cd0.60128531','Sabor autentico con productos 100% mexicanos',' En nuestro restaurante, la autenticidad es la base. Utilizamos ingredientes 100% mexicanos, frescos y de origen local, para recrear los sabores tradicionales que cuentan la historia de nuestro país. Conozca nuestra cocina, un punto de encuentro entre la tradición y el sabor más puro. ','#','promocional.webp',1);
/*!40000 ALTER TABLE `promocional` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `user` varchar(30) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
('1','admin','adminFN','adminLN','1234','admin@email.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Dumping routines for database 'conacica'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-12-01  2:02:52
