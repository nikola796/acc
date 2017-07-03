-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: intranet
-- ------------------------------------------------------
-- Server version	5.1.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `nested_categories`
--

DROP TABLE IF EXISTS `nested_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nested_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `dep` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `active` tinyint(11) NOT NULL DEFAULT '1',
  `added_when` int(11) NOT NULL,
  `added_from` int(11) NOT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_from` int(11) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`),
  KEY `dep_id_idx` (`dep`),
  KEY `cat_added_from_idx` (`added_from`),
  KEY `cat_modified_from_idx` (`modified_from`),
  CONSTRAINT `dep_id` FOREIGN KEY (`dep`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nested_categories`
--

LOCK TABLES `nested_categories` WRITE;
/*!40000 ALTER TABLE `nested_categories` DISABLE KEYS */;
INSERT INTO `nested_categories` VALUES (1,'ДИС',1,23,6,0,1,1497359141,1,'2017-06-14 07:45:44',2),(2,'Аида',2,9,6,1,1,1497359141,1,'2017-06-13 13:05:41',1),(3,'Тестови сценарии',3,4,6,2,1,1497359141,1,'2017-06-13 13:05:41',1),(4,'Модели на данни',5,6,6,2,1,1497359141,1,'2017-06-13 13:05:41',1),(5,'Техническо задание',7,8,6,2,1,1497359141,1,'2017-06-13 13:05:41',1),(15,'Когнос',10,22,6,1,1,1497359141,1,'2017-06-14 07:45:44',1),(16,'Заповеди',11,14,6,15,1,1497359141,1,'2017-06-13 13:05:41',1),(17,'Заповеди Достъпи',12,13,6,16,1,1497359141,1,'2017-06-13 13:05:41',1),(18,'Ръководства',15,22,6,15,1,1497359141,1,'2017-06-13 13:05:41',1),(19,'Ръководство на потребителя',16,17,6,18,1,1497359141,1,'2017-06-13 13:05:41',1),(20,'Ръководство на админа',18,19,6,18,1,1497359141,1,'2017-06-13 13:05:41',1),(21,'ДА',24,31,2,0,1,1497359141,1,'2017-06-14 09:25:15',1),(39,'Супер ръководство',20,21,6,18,1,1497359141,1,'2017-06-13 13:05:41',1),(40,'Системи',25,30,2,21,1,1497427648,0,'2017-06-14 09:25:15',0),(41,'БАЦИС',26,27,2,40,1,1497427378,1,'2017-06-14 08:02:58',0),(42,'EMCS',28,29,2,40,1,1497432315,1,'2017-06-14 09:25:15',0);
/*!40000 ALTER TABLE `nested_categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-15 14:09:45
