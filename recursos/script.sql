-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: historial_matriculas
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `m_variables`
--

DROP TABLE IF EXISTS `m_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_variables` (
  `idm_variables` int(11) NOT NULL AUTO_INCREMENT,
  `valor` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `variables_idvariables` int(11) NOT NULL,
  `matricula_idmatricula` int(11) NOT NULL,
  PRIMARY KEY (`idm_variables`),
  KEY `variables_idvariables` (`variables_idvariables`),
  KEY `matricula_idmatricula` (`matricula_idmatricula`),
  CONSTRAINT `m_variables_ibfk_1` FOREIGN KEY (`variables_idvariables`) REFERENCES `variables` (`idvariables`),
  CONSTRAINT `m_variables_ibfk_2` FOREIGN KEY (`matricula_idmatricula`) REFERENCES `matricula` (`idmatricula`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_variables`
--

LOCK TABLES `m_variables` WRITE;
/*!40000 ALTER TABLE `m_variables` DISABLE KEYS */;
INSERT INTO `m_variables` VALUES (1,468,100,1,1),(2,0,0,2,1),(3,0,0,3,1),(4,98,21,4,1),(5,361,77,5,1),(6,9,2,6,1),(7,370,79,7,1),(8,434,100,1,2),(9,0,0,2,2),(10,0,0,3,2),(11,99,23,4,2),(12,335,77,5,2),(13,0,0,6,2),(14,335,77,7,2),(15,498,100,1,3),(16,0,0,2,3),(17,0,0,3,3),(18,102,20,4,3),(19,396,80,5,3),(20,0,0,6,3),(21,396,80,7,3),(22,389,100,1,4),(23,0,0,2,4),(24,0,0,3,4),(25,80,21,4,4),(26,309,79,5,4),(27,0,0,6,4),(28,309,79,7,4),(29,220,100,1,5),(30,0,0,2,5),(31,0,0,3,5),(32,45,20,4,5),(33,175,80,5,5),(34,0,0,6,5),(35,175,80,7,5);
/*!40000 ALTER TABLE `m_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL AUTO_INCREMENT,
  `periodos_idperiodos` int(11) NOT NULL,
  PRIMARY KEY (`idmatricula`),
  KEY `periodos_idperiodos` (`periodos_idperiodos`),
  CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`periodos_idperiodos`) REFERENCES `periodos` (`idperiodos`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` VALUES (1,1),(2,2),(3,3),(4,4),(5,5);
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodos`
--

DROP TABLE IF EXISTS `periodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodos` (
  `idperiodos` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` varchar(45) NOT NULL,
  `fin` varchar(45) NOT NULL,
  `evaluado` tinyint(4) NOT NULL,
  PRIMARY KEY (`idperiodos`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodos`
--

LOCK TABLES `periodos` WRITE;
/*!40000 ALTER TABLE `periodos` DISABLE KEYS */;
INSERT INTO `periodos` VALUES (1,'2016','2017',1),(2,'2017','2018',1),(3,'2018','2019',1),(4,'2019','2020',1),(5,'2020','2021',1);
/*!40000 ALTER TABLE `periodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variables` (
  `idvariables` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`idvariables`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variables`
--

LOCK TABLES `variables` WRITE;
/*!40000 ALTER TABLE `variables` DISABLE KEYS */;
INSERT INTO `variables` VALUES (1,'Matrículas totales al inicio del año'),(2,'Matrículas agregadas'),(3,'Matrículas segregadas'),(4,'Número de deserciones'),(5,'Número de promovidos'),(6,'Número de no promovidos'),(7,'Total de matrículas efectivas');
/*!40000 ALTER TABLE `variables` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-13  1:10:13
