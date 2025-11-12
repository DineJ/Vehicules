/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: appdb
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB-0ubuntu0.24.04.1

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

USE appdb;

--
-- Table structure for table `Ip`
--

DROP TABLE IF EXISTS `Ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse_ip` varchar(40) NOT NULL,
  `nb_echec` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `adresse_ip` (`adresse_ip`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ip`
--

LOCK TABLES `Ip` WRITE;
/*!40000 ALTER TABLE `Ip` DISABLE KEYS */;
INSERT INTO `Ip` VALUES
(3,'127.0.0.1',0),
(4,'192.168.0.1',0);
/*!40000 ALTER TABLE `Ip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assurance`
--

DROP TABLE IF EXISTS `assurance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `assurance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_contrat` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assurance`
--

LOCK TABLES `assurance` WRITE;
/*!40000 ALTER TABLE `assurance` DISABLE KEYS */;
INSERT INTO `assurance` VALUES
(1,'2025-03-01'),
(2,'2025-02-15'),
(3,'2025-01-20'),
(4,'2024-12-10'),
(5,'2024-11-05'),
(18,'0000-00-00'),
(30,'0000-00-00'),
(70,'0000-00-00'),
(82,'0000-00-00');
/*!40000 ALTER TABLE `assurance` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_date_contrat` AFTER UPDATE ON `assurance` FOR EACH ROW IF OLD.date_contrat >= NEW.date_contrat THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT ="La date du nouveau contrat est antérieur à celle de l'ancien. Veuillez resaisir votre date.";
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `assurance_vehicule`
--

DROP TABLE IF EXISTS `assurance_vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `assurance_vehicule` (
  `id_assurance` int(11) NOT NULL,
  `id_vehicule` int(11) NOT NULL,
  PRIMARY KEY (`id_assurance`,`id_vehicule`),
  KEY `id_vehicule` (`id_vehicule`),
  CONSTRAINT `assurance_vehicule_ibfk_1` FOREIGN KEY (`id_assurance`) REFERENCES `assurance` (`id`),
  CONSTRAINT `assurance_vehicule_ibfk_2` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assurance_vehicule`
--

LOCK TABLES `assurance_vehicule` WRITE;
/*!40000 ALTER TABLE `assurance_vehicule` DISABLE KEYS */;
INSERT INTO `assurance_vehicule` VALUES
(1,1),
(2,2),
(3,3),
(4,4),
(5,5);
/*!40000 ALTER TABLE `assurance_vehicule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historique`
--

DROP TABLE IF EXISTS `historique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `historique` (
  `id_user` int(11) NOT NULL,
  `id_ip` int(11) NOT NULL,
  `date_dbt` timestamp NOT NULL,
  `date_fin` timestamp NOT NULL,
  PRIMARY KEY (`id_user`,`date_dbt`),
  KEY `FK_user` (`id_user`),
  KEY `FK_ip` (`id_ip`) USING BTREE,
  CONSTRAINT `fk_ip` FOREIGN KEY (`id_ip`) REFERENCES `Ip` (`id`),
  CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historique`
--

LOCK TABLES `historique` WRITE;
/*!40000 ALTER TABLE `historique` DISABLE KEYS */;
INSERT INTO `historique` VALUES
(1,3,'2025-07-23 12:05:00','2025-07-23 12:06:07'),
(1,3,'2025-07-23 12:06:09','2025-07-23 12:10:01'),
(1,3,'2025-07-23 12:41:02','2025-07-23 12:41:08'),
(1,3,'2025-07-23 12:41:47','2025-07-23 12:42:29'),
(1,3,'2025-07-23 12:58:00','2025-07-23 12:58:32'),
(1,3,'2025-07-23 13:30:36','2025-07-23 13:31:15'),
(1,3,'2025-08-06 04:36:44','2025-08-06 04:38:17'),
(1,3,'2025-08-07 06:21:28','2025-08-07 06:21:41'),
(1,3,'2025-08-07 06:21:46','2025-08-07 06:21:53'),
(2,3,'2025-07-23 06:38:24','2025-07-23 06:40:17'),
(2,3,'2025-07-23 06:42:22','2025-07-23 06:43:43'),
(2,3,'2025-07-23 06:53:22','2025-07-23 06:53:38'),
(2,3,'2025-07-23 07:23:34','2025-07-23 07:23:50'),
(2,3,'2025-07-23 11:23:35','2025-07-23 11:23:35'),
(2,3,'2025-07-23 12:03:28','2025-07-23 12:04:47'),
(2,3,'2025-07-23 12:20:04','2025-07-23 12:31:37'),
(2,3,'2025-07-23 12:39:23','2025-07-23 12:40:46'),
(2,3,'2025-07-23 12:58:41','2025-07-23 13:00:32'),
(2,3,'2025-07-23 13:28:37','2025-07-23 13:29:36'),
(2,3,'2025-07-23 13:34:36','2025-07-23 13:34:53'),
(2,3,'2025-07-25 04:24:00','2025-07-25 04:24:35'),
(2,3,'2025-07-25 04:43:32','2025-07-25 04:49:00'),
(2,3,'2025-07-25 04:54:47','2025-07-25 05:12:41'),
(2,3,'2025-07-28 04:07:03','2025-07-28 04:33:07'),
(2,3,'2025-07-28 04:45:00','2025-07-28 04:45:24'),
(2,3,'2025-07-28 04:53:10','2025-07-28 05:09:43'),
(2,3,'2025-07-28 05:17:15','2025-07-28 05:28:08'),
(2,3,'2025-07-28 05:35:51','2025-07-28 05:50:46'),
(2,3,'2025-07-28 06:20:01','2025-07-28 06:21:04'),
(2,3,'2025-07-28 07:08:35','2025-07-28 07:08:59'),
(2,3,'2025-07-28 07:16:15','2025-07-28 07:20:09'),
(2,3,'2025-07-28 07:30:07','2025-07-28 07:32:08'),
(2,3,'2025-07-28 07:38:43','2025-07-28 07:39:26'),
(2,3,'2025-07-28 08:13:27','2025-07-28 08:16:21'),
(2,3,'2025-07-28 10:54:15','2025-07-28 10:58:10'),
(2,3,'2025-07-28 11:06:55','2025-07-28 11:17:08'),
(2,3,'2025-07-28 11:25:43','2025-07-28 11:26:51'),
(2,3,'2025-07-28 11:37:53','2025-07-28 11:42:48'),
(2,3,'2025-07-29 03:52:37','2025-07-29 03:53:58'),
(2,3,'2025-07-29 04:05:46','2025-07-29 04:42:02'),
(2,3,'2025-07-29 04:47:48','2025-07-29 04:49:50'),
(2,3,'2025-07-29 04:50:35','2025-07-29 04:55:37'),
(2,3,'2025-07-29 05:03:03','2025-07-29 05:24:54'),
(2,3,'2025-07-29 05:42:06','2025-07-29 05:42:10'),
(2,3,'2025-07-29 05:56:57','2025-07-29 05:57:22'),
(2,3,'2025-07-29 06:14:59','2025-07-29 06:22:58'),
(2,3,'2025-07-29 06:28:22','2025-07-29 06:29:56'),
(2,3,'2025-07-29 06:46:12','2025-07-29 06:47:09'),
(2,3,'2025-07-29 07:24:21','2025-07-29 07:25:03'),
(2,3,'2025-07-29 07:35:22','2025-07-29 07:35:27'),
(2,3,'2025-07-29 07:50:24','2025-07-29 07:52:50'),
(2,3,'2025-07-29 08:07:57','2025-07-29 08:14:51'),
(2,3,'2025-07-29 08:20:32','2025-07-29 08:22:27'),
(2,3,'2025-07-29 10:26:13','2025-07-29 10:32:05'),
(2,3,'2025-07-29 11:19:38','2025-07-29 11:21:47'),
(2,3,'2025-07-29 11:57:14','2025-07-29 11:57:17'),
(2,3,'2025-07-30 04:09:21','2025-07-30 04:09:33'),
(2,3,'2025-07-30 04:22:12','2025-07-30 04:30:20'),
(2,3,'2025-07-30 04:40:31','2025-07-30 04:52:59'),
(2,3,'2025-07-30 05:00:41','2025-07-30 05:05:55'),
(2,3,'2025-07-30 05:14:07','2025-07-30 05:37:18'),
(2,3,'2025-07-30 05:45:25','2025-07-30 06:02:58'),
(2,3,'2025-07-30 06:39:09','2025-07-30 06:53:33'),
(2,3,'2025-07-30 06:58:52','2025-07-30 07:15:31'),
(2,3,'2025-07-30 07:32:38','2025-07-30 07:32:47'),
(2,3,'2025-08-01 05:00:23','2025-08-01 05:00:34'),
(2,3,'2025-08-01 05:08:58','2025-08-01 05:12:50'),
(2,3,'2025-08-01 05:18:42','2025-08-01 05:22:55'),
(2,3,'2025-08-01 05:28:27','2025-08-01 05:37:41'),
(2,3,'2025-08-01 06:42:42','2025-08-01 06:47:31'),
(2,3,'2025-08-01 07:02:13','2025-08-01 07:02:15'),
(2,3,'2025-08-01 07:07:18','2025-08-01 07:15:26'),
(2,3,'2025-08-01 07:20:58','2025-08-01 07:46:18'),
(2,3,'2025-08-01 07:52:49','2025-08-01 07:54:07'),
(2,3,'2025-08-01 08:02:34','2025-08-01 08:09:04'),
(2,3,'2025-08-01 08:14:33','2025-08-01 08:15:44'),
(2,3,'2025-08-01 09:48:25','2025-08-01 09:48:31'),
(2,3,'2025-08-01 10:04:43','2025-08-01 10:05:54'),
(2,3,'2025-08-01 10:13:21','2025-08-01 10:14:09'),
(2,3,'2025-08-01 10:19:39','2025-08-01 10:19:46'),
(2,3,'2025-08-01 10:25:41','2025-08-01 10:54:23'),
(2,3,'2025-08-01 10:54:26','2025-08-01 10:56:18'),
(2,3,'2025-08-04 07:07:15','2025-08-04 07:07:17'),
(2,3,'2025-08-05 10:42:22','2025-08-05 10:43:25'),
(2,3,'2025-08-05 12:17:26','2025-08-05 12:32:09'),
(2,3,'2025-08-06 04:03:06','2025-08-06 04:04:52'),
(2,3,'2025-08-06 04:38:26','2025-08-06 04:38:54'),
(2,3,'2025-08-06 05:49:59','2025-08-06 05:49:59'),
(2,3,'2025-08-06 05:58:30','2025-08-06 05:58:30'),
(2,3,'2025-08-06 06:03:49','2025-08-06 06:05:26'),
(2,3,'2025-08-06 06:15:02','2025-08-06 06:17:16'),
(2,3,'2025-08-06 06:42:38','2025-08-06 06:42:55'),
(2,3,'2025-08-06 06:51:14','2025-08-06 07:01:29'),
(2,3,'2025-08-06 07:11:10','2025-08-06 07:22:55'),
(2,3,'2025-08-06 08:14:13','2025-08-06 08:16:17'),
(2,3,'2025-08-06 10:02:02','2025-08-06 10:20:42'),
(2,3,'2025-08-06 10:34:20','2025-08-06 10:37:59'),
(2,3,'2025-08-06 10:44:27','2025-08-06 10:50:04'),
(2,3,'2025-08-06 10:58:51','2025-08-06 11:04:47'),
(2,3,'2025-08-06 11:33:50','2025-08-06 11:36:40'),
(2,3,'2025-08-06 11:36:41','2025-08-06 11:37:08'),
(2,3,'2025-08-07 04:08:25','2025-08-07 04:16:22'),
(2,3,'2025-08-07 04:22:24','2025-08-07 04:35:21'),
(2,3,'2025-08-07 05:00:19','2025-08-07 05:12:01'),
(2,3,'2025-08-07 05:22:03','2025-08-07 05:22:14'),
(2,3,'2025-08-07 05:44:07','2025-08-07 06:05:22'),
(2,3,'2025-08-07 06:21:54','2025-08-07 06:22:36'),
(2,3,'2025-08-07 06:22:38','2025-08-07 06:29:56'),
(2,3,'2025-08-07 06:35:18','2025-08-07 06:35:18'),
(2,3,'2025-08-07 06:41:36','2025-08-07 06:41:36'),
(2,3,'2025-08-07 06:49:51','2025-08-07 06:58:22'),
(2,3,'2025-08-07 07:04:58','2025-08-07 07:27:01'),
(2,3,'2025-08-07 07:33:06','2025-08-07 07:37:31'),
(2,3,'2025-08-07 07:50:45','2025-08-07 07:57:15'),
(2,3,'2025-08-07 10:11:00','2025-08-07 10:13:07'),
(2,3,'2025-08-07 10:18:56','2025-08-07 10:27:35'),
(2,3,'2025-08-07 10:34:15','2025-08-07 10:35:35'),
(2,3,'2025-08-07 10:44:39','2025-08-07 10:44:55'),
(2,3,'2025-08-07 10:57:44','2025-08-07 10:58:00'),
(2,3,'2025-08-07 11:06:15','2025-08-07 11:06:59'),
(2,3,'2025-08-07 11:07:02','2025-08-07 11:12:05'),
(2,3,'2025-08-07 11:32:31','2025-08-07 11:38:22'),
(2,3,'2025-08-18 04:12:32','2025-08-18 04:15:10'),
(2,3,'2025-08-18 04:26:42','2025-08-18 04:35:56'),
(2,3,'2025-08-18 06:21:40','2025-08-18 06:21:44'),
(2,3,'2025-08-18 06:29:02','2025-08-18 06:29:06'),
(2,3,'2025-08-18 07:14:31','2025-08-18 07:14:37'),
(2,3,'2025-08-18 07:18:15','2025-08-18 07:21:16'),
(2,3,'2025-08-18 07:30:52','2025-08-18 07:31:00'),
(2,3,'2025-08-18 07:32:45','2025-08-18 07:33:11'),
(2,3,'2025-08-18 07:41:22','2025-08-18 07:43:03'),
(2,3,'2025-08-18 07:44:16','2025-08-18 07:44:21'),
(2,3,'2025-08-18 07:47:39','2025-08-18 07:47:57'),
(2,3,'2025-08-18 07:48:39','2025-08-18 07:48:43'),
(2,3,'2025-08-18 07:49:40','2025-08-18 07:50:10'),
(2,3,'2025-08-18 07:50:28','2025-08-18 07:50:34'),
(2,3,'2025-08-18 07:50:42','2025-08-18 07:50:49'),
(2,3,'2025-08-18 07:57:07','2025-08-18 07:57:13'),
(2,3,'2025-08-18 07:58:47','2025-08-18 07:58:59'),
(2,3,'2025-08-18 07:59:06','2025-08-18 07:59:10'),
(2,3,'2025-08-18 10:14:10','2025-08-18 10:14:16'),
(2,3,'2025-08-18 10:18:10','2025-08-18 10:18:14'),
(2,3,'2025-08-18 10:18:44','2025-08-18 10:18:49'),
(2,3,'2025-08-18 10:33:26','2025-08-18 10:33:30'),
(2,3,'2025-08-19 04:18:12','2025-08-19 04:18:21'),
(2,3,'2025-08-19 04:33:19','2025-08-19 04:33:25'),
(2,3,'2025-08-19 04:42:54','2025-08-19 04:49:52'),
(2,3,'2025-08-19 04:52:08','2025-08-19 04:58:32'),
(2,3,'2025-08-19 05:06:27','2025-08-19 05:08:05'),
(2,3,'2025-08-19 05:16:08','2025-08-19 05:27:37'),
(2,3,'2025-08-19 05:33:27','2025-08-19 05:40:02'),
(2,3,'2025-08-19 05:50:32','2025-08-19 05:50:41'),
(2,3,'2025-08-19 10:01:33','2025-08-19 10:02:15'),
(2,3,'2025-08-19 10:08:24','2025-08-19 10:13:25'),
(2,3,'2025-08-19 10:24:40','2025-08-19 10:25:57'),
(2,3,'2025-08-19 10:32:50','2025-08-19 10:33:52'),
(2,3,'2025-08-19 10:39:35','2025-08-19 10:54:51'),
(2,3,'2025-08-19 11:13:18','2025-08-19 11:17:49'),
(2,3,'2025-08-19 11:39:47','2025-08-19 11:47:26'),
(2,3,'2025-09-08 05:44:05','2025-09-08 05:45:13'),
(2,3,'2025-09-08 05:51:34','2025-09-08 05:52:38'),
(2,3,'2025-09-08 05:59:39','2025-09-08 06:29:48'),
(2,3,'2025-09-08 06:52:09','2025-09-08 06:52:14'),
(2,3,'2025-09-08 07:34:55','2025-09-08 07:35:01'),
(2,3,'2025-09-08 07:41:20','2025-09-08 07:41:39'),
(2,3,'2025-09-08 09:03:55','2025-09-08 09:13:27'),
(2,3,'2025-09-08 09:21:11','2025-09-08 09:28:01'),
(2,3,'2025-09-08 09:34:30','2025-09-08 09:35:41'),
(2,3,'2025-09-08 09:42:24','2025-09-08 10:00:32'),
(2,3,'2025-09-09 03:50:55','2025-09-09 03:57:52'),
(2,3,'2025-09-09 04:07:09','2025-09-09 04:27:17'),
(2,3,'2025-09-09 04:32:52','2025-09-09 04:41:29'),
(2,3,'2025-09-09 04:51:45','2025-09-09 04:57:24'),
(2,3,'2025-09-09 05:22:17','2025-09-09 05:28:46'),
(2,3,'2025-09-09 05:34:59','2025-09-09 05:36:18'),
(2,3,'2025-09-09 05:45:13','2025-09-09 05:48:43'),
(2,3,'2025-09-09 05:57:37','2025-09-09 06:13:02'),
(2,3,'2025-09-09 08:02:36','2025-09-09 08:02:36'),
(2,3,'2025-09-09 08:18:58','2025-09-09 08:18:58'),
(2,3,'2025-09-09 08:27:36','2025-09-09 08:27:36'),
(2,3,'2025-09-09 08:35:37','2025-09-09 08:35:37'),
(2,3,'2025-09-09 08:44:16','2025-09-09 08:44:16'),
(2,3,'2025-09-09 09:03:58','2025-09-09 09:03:58'),
(2,3,'2025-09-09 09:08:53','2025-09-09 09:15:16'),
(2,3,'2025-09-09 09:21:16','2025-09-09 07:48:27'),
(2,3,'2025-09-09 10:21:41','2025-09-09 10:52:12'),
(2,3,'2025-09-09 11:00:30','2025-09-09 11:02:35'),
(2,3,'2025-09-09 11:21:36','2025-09-09 11:23:31'),
(2,3,'2025-09-10 04:24:51','2025-09-10 04:24:51'),
(2,3,'2025-09-10 04:38:00','2025-09-10 04:44:17'),
(2,3,'2025-09-10 04:57:40','2025-09-10 05:09:50'),
(2,3,'2025-09-10 05:44:14','2025-09-10 05:54:44'),
(2,3,'2025-09-10 06:04:44','2025-09-10 06:04:44'),
(2,3,'2025-09-10 06:48:21','2025-09-10 06:52:57'),
(2,3,'2025-09-10 07:05:47','2025-09-10 07:27:23'),
(2,3,'2025-09-10 07:38:42','2025-09-10 07:52:47'),
(2,3,'2025-09-10 08:02:59','2025-09-10 08:06:27'),
(2,3,'2025-09-10 10:01:04','2025-09-10 10:12:47'),
(2,3,'2025-09-10 10:20:52','2025-09-10 10:33:19'),
(2,3,'2025-09-10 10:40:54','2025-09-10 10:43:49'),
(2,3,'2025-09-10 10:56:53','2025-09-10 10:57:39'),
(2,3,'2025-09-10 11:23:20','2025-09-10 11:23:34'),
(2,3,'2025-09-11 04:15:09','2025-09-11 04:16:06'),
(2,3,'2025-09-11 04:23:17','2025-09-11 04:31:09'),
(2,3,'2025-09-11 04:43:38','2025-09-11 04:46:27'),
(2,3,'2025-09-11 05:08:20','2025-09-11 05:24:09'),
(2,3,'2025-09-11 05:32:19','2025-09-11 05:32:34'),
(2,3,'2025-09-11 06:21:45','2025-09-11 06:22:41'),
(2,3,'2025-09-11 06:34:36','2025-09-11 06:36:31'),
(2,3,'2025-09-11 07:44:28','2025-09-11 07:45:15'),
(2,3,'2025-09-11 08:14:47','2025-09-11 08:15:05'),
(2,3,'2025-09-11 08:20:12','2025-09-11 08:20:46'),
(2,3,'2025-09-11 10:07:17','2025-09-11 10:21:10'),
(2,3,'2025-09-12 06:48:40','2025-09-12 06:54:21'),
(2,3,'2025-09-12 08:00:18','2025-09-12 08:07:43'),
(2,3,'2025-09-12 08:16:44','2025-09-12 08:16:51'),
(2,3,'2025-09-12 10:20:31','2025-09-12 10:27:21'),
(2,3,'2025-09-15 04:36:07','2025-09-15 05:08:24'),
(2,3,'2025-09-15 05:21:38','2025-09-15 05:45:11'),
(2,3,'2025-09-15 05:58:19','2025-09-15 05:59:33'),
(2,3,'2025-09-15 06:26:50','2025-09-15 06:30:43'),
(2,3,'2025-09-15 07:05:57','2025-09-15 07:15:36'),
(2,3,'2025-09-15 07:22:29','2025-09-15 07:26:45'),
(2,3,'2025-09-15 07:38:39','2025-09-15 08:08:13'),
(2,3,'2025-09-15 08:14:21','2025-09-15 08:29:14'),
(2,3,'2025-09-15 10:36:57','2025-09-15 10:37:50'),
(2,3,'2025-09-15 10:43:32','2025-09-15 10:43:48'),
(2,3,'2025-09-16 03:36:10','2025-09-16 03:36:14'),
(2,3,'2025-09-16 03:44:42','2025-09-16 04:09:57'),
(2,3,'2025-09-16 04:54:33','2025-09-16 04:58:08'),
(2,3,'2025-09-16 05:13:01','2025-09-16 05:21:19'),
(2,3,'2025-09-16 05:44:32','2025-09-16 05:54:39'),
(2,3,'2025-09-16 06:10:10','2025-09-16 06:33:10'),
(2,3,'2025-09-16 07:20:36','2025-09-16 07:25:08'),
(2,3,'2025-09-16 07:56:46','2025-09-16 07:57:41'),
(2,3,'2025-09-16 08:05:41','2025-09-16 08:11:22'),
(2,3,'2025-09-16 08:16:51','2025-09-16 08:23:01'),
(2,3,'2025-09-17 05:37:59','2025-09-17 05:43:49'),
(2,3,'2025-09-17 07:28:17','2025-09-17 07:28:40'),
(2,3,'2025-09-17 08:12:55','2025-09-17 08:21:51'),
(2,3,'2025-09-17 08:58:38','2025-09-17 08:58:47'),
(2,3,'2025-09-17 09:07:31','2025-09-17 09:11:26'),
(2,3,'2025-09-17 09:48:32','2025-09-17 09:48:49'),
(2,3,'2025-09-17 10:07:22','2025-09-17 10:13:55'),
(2,3,'2025-09-17 10:19:01','2025-09-17 10:19:09'),
(2,3,'2025-09-17 10:25:28','2025-09-17 10:26:37'),
(2,3,'2025-09-17 10:45:23','2025-09-17 10:54:53'),
(2,3,'2025-09-17 12:08:55','2025-09-17 12:09:00'),
(2,3,'2025-09-17 12:15:52','2025-09-17 12:16:19'),
(2,3,'2025-09-18 03:13:22','2025-09-18 03:13:22'),
(2,3,'2025-09-18 03:21:24','2025-09-18 03:21:24'),
(2,3,'2025-09-18 03:35:01','2025-09-18 03:35:25'),
(2,3,'2025-09-18 03:53:30','2025-09-18 03:56:21'),
(2,3,'2025-09-18 04:01:30','2025-09-18 04:03:31'),
(2,3,'2025-09-18 04:13:46','2025-09-18 04:13:56'),
(2,3,'2025-09-18 04:29:25','2025-09-18 04:35:31'),
(2,3,'2025-09-18 04:47:12','2025-09-18 04:47:29'),
(2,3,'2025-09-18 05:00:45','2025-09-18 05:06:16'),
(2,3,'2025-09-18 05:35:00','2025-09-18 05:38:50'),
(2,3,'2025-09-18 05:54:14','2025-09-18 05:55:24'),
(2,3,'2025-09-18 07:36:38','2025-09-18 07:41:04'),
(2,3,'2025-09-18 08:03:10','2025-09-18 08:03:33'),
(2,3,'2025-09-18 08:09:34','2025-09-18 08:16:09'),
(2,3,'2025-09-19 05:47:12','2025-09-19 05:49:32'),
(2,3,'2025-09-19 06:22:15','2025-09-19 06:26:14'),
(2,3,'2025-09-19 06:32:00','2025-09-19 06:36:10'),
(2,3,'2025-09-19 06:42:45','2025-09-19 06:47:06'),
(2,3,'2025-09-19 07:12:22','2025-09-19 07:13:43'),
(2,3,'2025-09-19 07:23:11','2025-09-19 07:27:27'),
(2,3,'2025-09-19 08:08:25','2025-09-19 08:13:40'),
(2,3,'2025-09-19 09:30:55','2025-09-19 09:56:46'),
(2,3,'2025-09-22 03:59:44','2025-09-22 04:21:19'),
(2,3,'2025-09-22 04:28:41','2025-09-22 04:34:17'),
(2,3,'2025-09-22 04:40:46','2025-09-22 04:58:28'),
(2,3,'2025-09-22 05:07:47','2025-09-22 05:11:47'),
(2,3,'2025-09-23 04:23:11','2025-09-23 04:26:39'),
(2,3,'2025-09-23 04:40:01','2025-09-23 04:57:53'),
(2,3,'2025-09-23 05:03:48','2025-09-23 05:27:39'),
(2,3,'2025-09-23 05:38:42','2025-09-23 06:23:07'),
(2,3,'2025-09-23 06:28:48','2025-09-23 06:29:45'),
(2,3,'2025-09-23 07:52:39','2025-09-23 07:57:13'),
(2,3,'2025-09-23 08:09:46','2025-09-23 08:17:36'),
(2,3,'2025-09-24 08:59:44','2025-09-24 08:59:54'),
(2,3,'2025-09-24 09:11:33','2025-09-24 09:13:10'),
(2,3,'2025-09-24 09:24:22','2025-09-24 09:26:14'),
(2,3,'2025-09-24 09:37:20','2025-09-24 09:44:09'),
(2,3,'2025-09-24 11:42:12','2025-09-24 11:47:16'),
(2,3,'2025-09-24 12:04:53','2025-09-24 12:08:52'),
(2,3,'2025-09-26 03:00:47','2025-09-26 03:22:51'),
(2,3,'2025-09-26 03:32:15','2025-09-26 03:50:15'),
(2,3,'2025-09-26 04:00:36','2025-09-26 04:07:02'),
(2,3,'2025-09-26 04:15:31','2025-09-26 04:18:21'),
(2,3,'2025-09-26 04:34:13','2025-09-26 04:42:24'),
(2,3,'2025-09-26 05:04:00','2025-09-26 05:04:15'),
(2,3,'2025-09-26 05:36:49','2025-09-26 05:37:03'),
(2,3,'2025-09-26 05:45:40','2025-09-26 06:13:36'),
(2,3,'2025-09-26 06:14:02','2025-09-26 06:19:24'),
(2,3,'2025-10-20 02:55:45','2025-10-20 03:13:39'),
(2,3,'2025-10-20 03:40:56','2025-10-20 03:47:18'),
(2,3,'2025-10-20 03:53:48','2025-10-20 04:06:15'),
(2,3,'2025-10-20 04:27:07','2025-10-20 04:27:24'),
(2,3,'2025-10-20 04:39:51','2025-10-20 04:43:24'),
(2,3,'2025-10-20 05:40:31','2025-10-20 05:45:22'),
(2,3,'2025-10-20 06:17:02','2025-10-20 06:40:22'),
(2,3,'2025-10-20 07:38:58','2025-10-20 07:44:43'),
(2,3,'2025-10-20 07:59:48','2025-10-20 08:01:02'),
(2,3,'2025-10-21 03:50:08','2025-10-21 03:55:14'),
(2,3,'2025-10-21 04:05:43','2025-10-21 04:20:11'),
(2,3,'2025-10-21 07:33:36','2025-10-21 08:06:32'),
(2,3,'2025-10-21 08:16:02','2025-10-21 08:34:34'),
(2,3,'2025-10-21 10:33:50','2025-10-21 10:34:26'),
(2,3,'2025-10-27 04:49:39','2025-10-27 05:01:12'),
(2,3,'2025-10-27 05:07:13','2025-10-27 05:07:43'),
(2,3,'2025-10-27 05:32:47','2025-10-27 05:49:39'),
(2,3,'2025-10-27 05:55:04','2025-10-27 06:12:18'),
(2,3,'2025-10-27 06:40:38','2025-10-27 06:40:38'),
(2,3,'2025-10-27 06:47:52','2025-10-27 06:47:52'),
(2,3,'2025-10-27 06:53:19','2025-10-27 07:15:06'),
(2,3,'2025-10-27 07:15:12','2025-10-27 07:37:59'),
(2,3,'2025-10-27 07:44:33','2025-10-27 07:54:23'),
(2,3,'2025-10-27 08:23:42','2025-10-27 08:23:53'),
(2,3,'2025-10-27 08:29:30','2025-10-27 08:40:30'),
(2,3,'2025-10-27 08:51:15','2025-10-27 08:58:11'),
(2,3,'2025-10-27 09:14:10','2025-10-27 09:19:21'),
(2,3,'2025-10-27 09:27:17','2025-10-27 09:34:41'),
(2,3,'2025-10-27 10:12:56','2025-10-27 10:13:03'),
(2,3,'2025-10-28 05:18:46','2025-10-28 05:26:46'),
(2,3,'2025-10-28 05:55:47','2025-10-28 06:01:17'),
(2,3,'2025-10-28 06:13:39','2025-10-28 06:15:43'),
(2,3,'2025-10-28 06:46:12','2025-10-28 06:46:41'),
(2,3,'2025-10-28 06:52:50','2025-10-28 07:00:51'),
(2,3,'2025-10-28 08:50:28','2025-10-28 08:50:58'),
(2,3,'2025-10-28 08:51:05','2025-10-28 08:51:05'),
(2,3,'2025-10-28 09:03:28','2025-10-28 09:10:33'),
(2,3,'2025-10-28 09:24:58','2025-10-28 09:31:02'),
(2,3,'2025-10-28 11:54:33','2025-10-28 11:54:46'),
(2,3,'2025-10-28 11:54:51','2025-10-28 12:05:55'),
(2,3,'2025-10-28 12:23:19','2025-10-28 12:24:56'),
(2,3,'2025-10-28 12:35:20','2025-10-28 12:57:04'),
(2,3,'2025-10-29 07:51:06','2025-10-29 07:51:13'),
(2,3,'2025-10-29 07:51:25','2025-10-29 07:51:38'),
(2,3,'2025-10-29 08:04:51','2025-10-29 08:04:54'),
(2,3,'2025-10-29 08:09:09','2025-10-29 08:11:08'),
(2,3,'2025-10-29 08:11:14','2025-10-29 08:11:17'),
(2,3,'2025-10-29 08:11:24','2025-10-29 08:14:47'),
(2,3,'2025-10-29 08:31:56','2025-10-29 08:32:19'),
(2,3,'2025-10-29 08:34:10','2025-10-29 09:02:01'),
(2,3,'2025-10-29 09:07:20','2025-10-29 09:08:04'),
(2,3,'2025-10-29 09:18:57','2025-10-29 09:18:57'),
(2,3,'2025-10-29 09:27:53','2025-10-29 09:30:06'),
(2,3,'2025-10-29 09:30:56','2025-10-29 09:32:46'),
(2,3,'2025-10-29 09:46:18','2025-10-29 09:57:25'),
(2,3,'2025-10-29 12:27:24','2025-10-29 12:27:26'),
(2,3,'2025-10-29 12:27:34','2025-10-29 12:27:41'),
(2,3,'2025-10-29 12:27:44','2025-10-29 12:27:44'),
(2,3,'2025-10-30 05:13:41','2025-10-30 05:19:28'),
(2,3,'2025-10-30 05:26:21','2025-10-30 05:27:08'),
(2,3,'2025-10-30 05:36:27','2025-10-30 06:06:13'),
(2,3,'2025-10-30 06:34:56','2025-10-30 06:41:28'),
(2,3,'2025-10-30 06:53:03','2025-10-30 07:17:48'),
(2,3,'2025-10-30 07:33:15','2025-10-30 07:37:08'),
(2,3,'2025-10-31 08:37:00','2025-10-31 08:41:08'),
(2,3,'2025-10-31 08:46:48','2025-10-31 09:01:51'),
(2,3,'2025-10-31 09:14:36','2025-10-31 09:16:44'),
(2,3,'2025-10-31 09:22:27','2025-10-31 09:25:34'),
(2,3,'2025-10-31 09:30:52','2025-10-31 09:30:59'),
(2,3,'2025-10-31 13:51:48','2025-10-31 13:54:54'),
(2,3,'2025-10-31 14:25:05','2025-10-31 14:27:04'),
(2,3,'2025-10-31 15:54:36','2025-10-31 15:59:36');
/*!40000 ALTER TABLE `historique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incident`
--

DROP TABLE IF EXISTS `incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `incident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicule` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_type_incident` int(11) NOT NULL,
  `date_incident` date NOT NULL,
  `explication_incident` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_camion` (`id_vehicule`),
  KEY `id_user` (`id_user`),
  KEY `id_type_accident` (`id_type_incident`),
  CONSTRAINT `incident_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  CONSTRAINT `incident_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `incident_ibfk_3` FOREIGN KEY (`id_type_incident`) REFERENCES `type_incident` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incident`
--

LOCK TABLES `incident` WRITE;
/*!40000 ALTER TABLE `incident` DISABLE KEYS */;
INSERT INTO `incident` VALUES
(3,2,1,3,'2025-07-02',' OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG\r\n  OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOI C LONGOUI C LONGOUI C LONG\r\n OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG\r\n OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG\r\n OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG\r\n OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG\r\n'),
(5,4,2,4,'2025-07-29','OUILLE FOUILLE TOUILLLE'),
(7,2,1,41,'2025-09-03','DZED'),
(8,2,1,6,'2025-09-03','DZED'),
(9,4,8,6,'2025-09-03','DAÉ\"RÉ'),
(10,3,3,5,'2025-09-10','EFEZF'),
(11,1,1,1,'2025-09-23',''),
(12,5,5,9,'2025-09-20','FF');
/*!40000 ALTER TABLE `incident` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_date_incident` BEFORE INSERT ON `incident` FOR EACH ROW IF NEW.date_incident > DATE( NOW()) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date de l'accident est ultérieur à celle d'aujourd'hui. Veuillez resaisir vos dates.";
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `infraction`
--

DROP TABLE IF EXISTS `infraction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `infraction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mission` int(11) NOT NULL,
  `date_infraction` date NOT NULL,
  `commentaire` text NOT NULL,
  `points` tinyint(3) unsigned NOT NULL,
  `prix` smallint(5) unsigned NOT NULL,
  `stationnement` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_trajet` (`id_mission`),
  CONSTRAINT `infraction_ibfk_1` FOREIGN KEY (`id_mission`) REFERENCES `mission` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infraction`
--

LOCK TABLES `infraction` WRITE;
/*!40000 ALTER TABLE `infraction` DISABLE KEYS */;
/*!40000 ALTER TABLE `infraction` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_date_infraction` BEFORE INSERT ON `infraction` FOR EACH ROW IF NEW.date_infraction > DATE( NOW())THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date de l'infraction est ultérieur à celle d'aujourd'hui. Veuillez resaisir votre date.";
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `lieu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_lieu` varchar(100) NOT NULL,
  `code_postal` char(5) NOT NULL,
  `numero` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lieu`
--

LOCK TABLES `lieu` WRITE;
/*!40000 ALTER TABLE `lieu` DISABLE KEYS */;
INSERT INTO `lieu` VALUES
(1,'Paris','75000',1,'10 rue de Paris',1),
(2,'Lyon','69000',2,'20 avenue des Alpes',1),
(3,'Marseille','13000',3,'30 boulevard Saint-Pierre',1),
(4,'Toulouse','31000',4,'40 rue de la Garonne',1),
(5,'Nice','06000',5,'50 avenue des Anges',1),
(14,'','',0,'',0),
(21,'','',0,'',0),
(60,'','',0,'',0),
(77,'','',0,'',0);
/*!40000 ALTER TABLE `lieu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission`
--

DROP TABLE IF EXISTS `mission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `id_vehicule` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lieu_depart` int(11) NOT NULL,
  `id_lieu_arrive` int(11) NOT NULL,
  `motif` enum('maraude','livraison','repas','demenagement','personnel') NOT NULL,
  `date_depart` date NOT NULL,
  `date_arrivee` date NOT NULL,
  `km_depart` int(11) NOT NULL,
  `km_arrive` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_camion` (`id_vehicule`),
  KEY `FK_user` (`id_user`),
  KEY `FK_lieu_depart` (`id_lieu_depart`),
  KEY `FK_lieu_arrive` (`id_lieu_arrive`),
  CONSTRAINT `mission_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  CONSTRAINT `mission_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `mission_ibfk_3` FOREIGN KEY (`id_lieu_depart`) REFERENCES `lieu` (`id`),
  CONSTRAINT `mission_ibfk_4` FOREIGN KEY (`id_lieu_arrive`) REFERENCES `lieu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission`
--

LOCK TABLES `mission` WRITE;
/*!40000 ALTER TABLE `mission` DISABLE KEYS */;
/*!40000 ALTER TABLE `mission` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_date_arrivee` BEFORE INSERT ON `mission` FOR EACH ROW IF NEW.date_arrivee <= NEW.date_depart THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date d'arrivée est antérieur à celle de départ. Veuillez resaisir votre date.";
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_date_depart` BEFORE INSERT ON `mission` FOR EACH ROW IF NEW.date_depart >= DATE( NOW()) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT ="La date de départ est ultérieur à aujourd'hui. Veuillez resaisir votre date.";
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_km_depart` BEFORE INSERT ON `mission` FOR EACH ROW IF NEW.km_depart < (SELECT max(km_arrive) FROM mission as m1, mission as m2 WHERE m1.id_vehicule = m2.id_vehicule) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "Le kilométrage de départ est trop petit par rapport à l'ancien indiquer. Veuillez resaisir votre nombre.";
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_km_arrive` BEFORE UPDATE ON `mission` FOR EACH ROW IF NEW.km_arrive <= NEW.km_depart THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "Le kilométrage d'arrivé est plus petit que celui de départ. Veuillez resaisir votre nombre.";
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `permis`
--

DROP TABLE IF EXISTS `permis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `permis` (
  `id_user` int(11) NOT NULL,
  `num_permis` char(12) NOT NULL,
  `date_permis` date NOT NULL,
  `update_permis` date NOT NULL,
  `type_permis` enum('B','BE','C','C1','C1E') NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `UNIQUE_num_permis` (`num_permis`) USING BTREE,
  CONSTRAINT `permis_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permis`
--

LOCK TABLES `permis` WRITE;
/*!40000 ALTER TABLE `permis` DISABLE KEYS */;
INSERT INTO `permis` VALUES
(1,'1234567888','2025-06-01','2038-11-03','C'),
(4,'1234567900','2025-09-04','2025-09-28','C'),
(8,'1234267893','2222-02-23','2223-02-22','C1'),
(17,'1234567892','2025-05-28','2025-05-03',''),
(18,'1234567800','2025-05-20','2025-05-21','B'),
(22,'1234567890','2025-05-31','2025-09-06','C1E'),
(26,'1235567822','2025-05-24','2025-10-12','BE');
/*!40000 ALTER TABLE `permis` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_date_permis` BEFORE UPDATE ON `permis` FOR EACH ROW IF NEW.update_permis < OLD.update_permis AND NEW.num_permis = OLD.num_permis THEN 
SIGNAL SQLSTATE '45000' 
SET MESSAGE_TEXT = "La date de péremption du permis est antérieur à l'ancienne. Veuillez resaisir votre date."; 
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `suivi`
--

DROP TABLE IF EXISTS `suivi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `suivi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_incident` int(11) NOT NULL,
  `date_intervention` date NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_incident` (`id_incident`),
  CONSTRAINT `suivi_ibfk_1` FOREIGN KEY (`id_incident`) REFERENCES `incident` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suivi`
--

LOCK TABLES `suivi` WRITE;
/*!40000 ALTER TABLE `suivi` DISABLE KEYS */;
INSERT INTO `suivi` VALUES
(20,3,'2025-09-01','INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. INTERVENTION PRÉVENTIVE SUR LE MOTEUR. '),
(21,5,'2025-09-12','Inspection générale après signalement'),
(22,7,'2025-09-09','Contrôle des niveaux d’huile.'),
(23,8,'2025-09-02','Réglage du système électrique. Zd'),
(24,9,'2025-09-08','Changement de pneus usés.'),
(25,10,'2025-09-10','Vérification du système de climatisation'),
(32,3,'2025-09-17','DD'),
(33,9,'2025-09-28','NOOON'),
(34,3,'2025-09-04','F'),
(35,3,'2025-09-21','EUH'),
(36,3,'2025-09-19','TESTDDD'),
(37,3,'2025-09-13','D'),
(38,9,'2025-09-27','CECI EST UN TEST QUI FONCTIONNE '),
(39,10,'2025-09-28','test suivie'),
(40,3,'2025-09-18','Le text n\'est pas assez long'),
(41,8,'2025-09-03','MÊME JOUR'),
(42,10,'2027-09-28','2027'),
(43,5,'2025-09-20','ff'),
(44,3,'2025-09-18','C'),
(45,3,'2025-09-22','C'),
(46,11,'2025-09-18',''),
(47,11,'2025-09-16','test'),
(48,11,'2025-09-23','23 test'),
(49,12,'2025-09-24','testttteofkzopiejgoiejz'),
(50,10,'2025-10-11',''),
(51,5,'2025-09-18','TEST'),
(52,11,'2025-10-31','yyy'),
(53,11,'2025-11-06','pp'),
(54,11,'2025-11-07','modaltestreload'),
(55,11,'2025-11-07','modaltestreload'),
(56,11,'2025-11-07','modaltestreload'),
(57,11,'2025-11-07','modaltestreload'),
(58,11,'2025-10-18','reload'),
(59,11,'2025-10-18','reload'),
(60,11,'2025-10-18','reload'),
(61,11,'2025-10-18','reload'),
(62,11,'2025-10-18','reload'),
(63,11,'2025-10-24','de'),
(64,11,'2025-10-24','d'),
(65,11,'2025-10-25','d'),
(66,11,'2025-10-25','d'),
(67,11,'2025-10-25','d'),
(68,11,'2025-11-01','d'),
(69,11,'2025-10-17',''),
(70,11,'2025-10-17',''),
(71,11,'2025-10-17',''),
(72,11,'2025-10-17',''),
(73,11,'2025-10-17','d'),
(74,11,'2025-10-17','d'),
(75,11,'2025-10-17','d'),
(76,11,'2025-10-31','');
/*!40000 ALTER TABLE `suivi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_incident`
--

DROP TABLE IF EXISTS `type_incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_incident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `critique` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_incident`
--

LOCK TABLES `type_incident` WRITE;
/*!40000 ALTER TABLE `type_incident` DISABLE KEYS */;
INSERT INTO `type_incident` VALUES
(1,'Accident',1),
(2,'Panne',0),
(3,'Fuite',0),
(4,'Défectuosité',0),
(5,'Problème technique',0),
(6,'TEST',0),
(7,'NNNC',0),
(8,'INCIDENT',0),
(9,'TEST-INCIDENTV2',0),
(10,'INCIDENTTTT',0),
(11,'DZDV',0),
(12,'EEEF',0),
(13,'EE',0),
(14,'TESTOUI',0),
(15,'TTT',0),
(16,'FFF',0),
(17,'DINE',0),
(18,'EOFPKOFZ',0),
(19,'DDDD',0),
(20,'DEDD',0),
(21,'FFF',0),
(22,'DDD',0),
(23,'CCC',0),
(24,'FF',0),
(25,'GFGFGG',0),
(26,'FFF',0),
(27,'FVEF',0),
(28,'GTTT',0),
(29,'DFBDFB',0),
(30,'FBEBE',0),
(31,'FBEBE',0),
(32,'DFBEB',0),
(33,'RRR',0),
(34,'FFF',0),
(35,'TESTE',0),
(36,'ALPHA',0),
(37,'BETA',0),
(38,'CHARLIE',0),
(39,'BRUNO',0),
(40,'P',0),
(41,'D',0),
(42,'FEF',0),
(43,'DFZEFZF',0),
(44,'TTTTT',0),
(45,'TTZFZFZEF',0),
(46,'FÉF\"HG\"\'H(\'\"H(',0),
(47,'TEST',0),
(48,'THIERRY',0),
(49,'DINE',0),
(50,'E',0),
(51,'OIUIJ',0),
(52,'NON',0),
(53,'LALALALAL',0),
(54,'TESTMODAL',1),
(55,'MODALREFRESH',1),
(56,'REFRESH2.0',0),
(57,'REFRESHHHHEDHEZUID',0),
(58,'AAAAAA',0),
(59,'TESTREUTN',0),
(60,'RERREER',0),
(61,'TESTZZZZZ',0),
(62,'DFFDZFZEFGZGZGZ\"GZG',0),
(63,'AZXWFD',0),
(64,'TESTETDSQTER',0),
(65,'POIU',0),
(66,'FZFZ',0),
(67,'FEZF',0),
(68,'FFFF',0),
(69,'HHH',0),
(70,'EFZFZ',0),
(71,'BJN N,K B ',0),
(72,'KLKKKKKKI',0),
(73,'CHECK',0),
(74,'PMO',0),
(75,'XXXXX',0),
(76,'POPPPPPPPPPPPPPPPP',0),
(77,'TUTUTUTUTUT',0),
(78,'MMM',1),
(79,'MOMOMMO',0),
(80,'MOMOMOMOMO_MTIUOMT_M',0),
(81,'ALERT',0),
(82,'ALERT2',0),
(83,'ÇA MARCHE',0),
(84,'DDDZDZD\"\"\"\"',0),
(85,'MAMAMIAM',0),
(86,'TESTDEFOU',1),
(87,'JS',1);
/*!40000 ALTER TABLE `type_incident` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `telephone` char(10) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `clef_connexion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'JRIDI','DINE',0,'0624221008','dinejridi1@gmail.com',1,'3e5d8f902ea30adfe5ce81191016bdf9c56a0a78916157ee953f7ef847a73708'),
(2,'THIERRY','T',1,'0102030405','non@gnma.com',1,'efc9f38a3ed4d3378634b2046dc66db5e36f6470ff03d54f695531008cad6576'),
(3,'PAS','PERMIS',0,'0102030406','dinejridi@gmaisl.com',0,'ca287eda7ae05481385d1db8e9416e6a'),
(4,'Oui','Oui',0,'0011220011','test@gmail.com',1,'1'),
(5,'Oui','Oui',1,'0011220011','testz@gmail.com',1,'1'),
(6,'Oui','Oui',0,'0011220011','teset@gmail.com',1,'1'),
(7,'Oui','Oui',0,'0011220011','tezzst@gmail.com',1,'1'),
(8,'Oui','Oui',1,'0011220011','tdest@gmail.com',1,'1'),
(9,'Oui','Oui',0,'0011220011','tdesddt@gmail.com',1,'1'),
(10,'Oui','Oui',0,'0011220011','tdwesddt@gmail.com',1,'1'),
(11,'Oui','Oui',0,'0011220011','tdffwesddt@gmail.com',0,'1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plaque` char(255) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `date_achat` date NOT NULL,
  `date_immat` date NOT NULL,
  `ct` date NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_plaque` (`plaque`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicule`
--

LOCK TABLES `vehicule` WRITE;
/*!40000 ALTER TABLE `vehicule` DISABLE KEYS */;
INSERT INTO `vehicule` VALUES
(1,'AB123CD','Renault','Clio','2020-01-01','2020-01-01','2025-01-01',1),
(2,'BC-234-DE','Peugeot','208','2021-05-31','2021-05-31','2031-05-22',1),
(3,'CD345EF','Volkswagen','Golf','2019-03-10','2019-03-10','2024-03-10',1),
(4,'DE456FG','Audi','A3','2018-07-01','2018-07-01','2023-07-01',1),
(5,'EF567GH','BMW','X3','2022-02-20','2022-02-20','2027-02-20',1),
(7,'AB999CD','Z','D','2025-10-24','2025-10-31','2025-10-31',0),
(8,'AC-128-SG','CITROEN','C3','2025-10-16','2025-10-31','2025-11-01',0),
(9,'BH-434-','PEUGOT','CCCC','2025-10-19','2025-10-31','2025-11-08',0),
(10,'TT-123-','C','E','2025-10-30','2025-10-30','2025-10-30',0),
(11,'TT-123-OU','T','R','2025-10-30','2025-10-30','2025-10-30',0);
/*!40000 ALTER TABLE `vehicule` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_date_achat` BEFORE INSERT ON `vehicule` FOR EACH ROW IF NEW.date_achat > DATE( NOW()) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date d'achat est ultérieur à aujourd'hui. Veuillez resaisir votre date.";
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `normalisation_plaque` BEFORE INSERT ON `vehicule` FOR EACH ROW BEGIN
  SET @plaque = REPLACE(REPLACE(NEW.plaque, ' ', ''), '-', '');
  
  SET NEW.plaque = UPPER(
    CONCAT(
      SUBSTRING(@plaque, 1, 2), '-', 
      SUBSTRING(@plaque, 3, 3), '-', 
      SUBSTRING(@plaque, 6, 2)
    )
  );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `verif_ct` BEFORE UPDATE ON `vehicule` FOR EACH ROW IF OLD.ct > NEW.ct THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date du nouveau contrôle technique est antérieur à celle de l'ancien. Veuillez resaisir votre date.";
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-12  8:44:50
