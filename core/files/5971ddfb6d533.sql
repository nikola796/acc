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
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Dan Brown'),(2,'Paulo Coelho');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `pages` int(11) NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'The Zahir','0-06-083281-9',2005,336,2,2),(2,'The Devil and Miss Prym','0-00-711605-5',2000,205,2,2),(3,'The Alchemist','0-06-250217-4',1988,163,2,2),(4,'Inferno','978-0-385-53785-8',2013,480,1,1),(5,'The Da Vinci Code','0-385-50420-9',2003,454,1,1),(6,'Angels & Demons','0-671-02735-2',2000,616,1,1);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Thriller'),(2,'Novel');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_when` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `added_by` (`added_by`),
  CONSTRAINT `departments_added_by_fk` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Дирекция Митнически режими и процедури',1,1488791962,1),(2,'Дирекция Акцизи',1,1488791998,1),(3,'Дирекция Тарифна политика',1,1489071553,1),(4,'Дирекция Последващ контрол',1,1489071553,1),(5,'Дирекция Митническо разузнаване и разследване',1,1489071712,1),(6,'Дирекция Информационни системи',1,1489071712,1),(7,' Дирекция Международни отношения',1,1489071772,1),(8,'Дирекция Централна митническа лаборатория',1,1489071772,1),(9,'Дирекция Стратегически анализи и прогнози ',1,1489071813,1),(10,'Дирекция  Финанси и обществени поръчки',1,1489071813,1),(11,' Дирекция Организация и управление на човешките ресурси',1,1489071855,1),(12,' Дирекция Национален учебен център',1,1489071855,1),(13,'Дирекция Административно обслужване',1,1489071891,1),(14,'Дирекция Управление на собствеността и логистика',1,1489071891,1),(15,' Инспекторат',1,1489071931,1),(16,'Отдел Сигурност',1,1489071931,1),(17,' Отдел Вътрешен одит',1,1494498907,1),(18,'Звено за мрежова и информационна сигурност ',1,1494498923,1),(19,'Митница Аерогара София',1,1494498929,1),(20,' Митница Бургас',1,1494498936,1),(21,'Митница Варна',1,1494498972,1),(22,'Митница Лом',1,1494498980,1),(23,'Митница Пловдив',1,1494498984,1),(24,'Митница Русе',1,1494498988,1),(25,'Митница Свищов',1,1494498993,1),(26,'Митница Столична ',1,1494498998,1),(27,'Митница Югозападна',1,1494499004,1);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `directories`
--

DROP TABLE IF EXISTS `directories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `directories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `directories`
--

LOCK TABLES `directories` WRITE;
/*!40000 ALTER TABLE `directories` DISABLE KEYS */;
INSERT INTO `directories` VALUES (1,'Когнос',1,10,1,1),(2,'Аида',11,18,1,1),(3,'БАЦИС',19,32,1,1),(4,'Правила и ел. формуляр за предоставяне, промяна и прекратяване на права за достъп до Когнос',2,3,1,1),(5,'Ръководство на потребителя',4,5,1,1),(6,'Други документи',6,9,1,1),(7,'Материали за тестване',12,13,1,1),(8,'Документация на АИДА',14,15,1,1),(9,'Документация за системно администриране на АИДА',16,17,1,1),(10,'Усъвършенстване на БАЦИС',20,21,1,1),(11,'ПРАВИЛА за предоставяне, промяна и прекратяване на права за достъп на служителите от Агенция „Митници“ до информационна система БАЦИС',22,23,1,1),(12,'БАЦИС - Ръководства на потребителя',24,25,1,1),(13,'Система за управление на акциза',26,27,1,1),(14,'Система за управление на бандероли',28,29,1,1),(15,'Система за Контрол на Измервателните Уреди (СКИУ)',30,31,1,1),(16,'Общи разпоредби',1,2,3,1),(17,'Други документи Когнос',7,8,1,1);
/*!40000 ALTER TABLE `directories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `directories_tmp`
--

DROP TABLE IF EXISTS `directories_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `directories_tmp` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `directories_tmp`
--

LOCK TABLES `directories_tmp` WRITE;
/*!40000 ALTER TABLE `directories_tmp` DISABLE KEYS */;
INSERT INTO `directories_tmp` VALUES (1,'Когнос',1,10,1),(2,'Аида',11,18,1),(3,'БАЦИС',19,32,1),(4,'Правила и ел. формуляр за предоставяне, промяна и прекратяване на права за достъп до Когнос',2,3,1),(5,'Ръководство на потребителя',4,5,1),(6,'Други документи',6,9,1),(7,'Материали за тестване',12,13,1),(8,'Документация на АИДА',14,15,1),(9,'Документация за системно администриране на АИДА',16,17,1),(10,'Усъвършенстване на БАЦИС',20,21,1),(11,'ПРАВИЛА за предоставяне, промяна и прекратяване на права за достъп на служителите от Агенция „Митници“ до информационна система БАЦИС',22,23,1),(12,'БАЦИС - Ръководства на потребителя',24,25,1),(13,'Система за управление на акциза',26,27,1),(14,'Система за управление на бандероли',28,29,1),(15,'Система за Контрол на Измервателните Уреди (СКИУ)',30,31,1),(17,'Други документи Когнос',7,8,1);
/*!40000 ALTER TABLE `directories_tmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `label` varchar(250) NOT NULL,
  `added_from` int(11) NOT NULL,
  `file_added_when` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `path` varchar(250) NOT NULL,
  `department_id` int(11) NOT NULL,
  `directory` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id_idx` (`department_id`),
  KEY `directory_idx` (`directory`),
  KEY `added_from_idx` (`added_from`),
  KEY `depart_idx` (`department_id`),
  CONSTRAINT `addedFrom` FOREIGN KEY (`added_from`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `depart` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fold` FOREIGN KEY (`directory`) REFERENCES `nested_categorys` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (2,'grafic_pristapi.txt','Пристъпи',1,1495720664,1,'',6,1,2);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `important`
--

DROP TABLE IF EXISTS `important`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `important` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `label` varchar(500) NOT NULL,
  `path` varchar(250) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_when` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `important_added_by_fk_idx` (`added_by`),
  CONSTRAINT `important_added_by_fk` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `important`
--

LOCK TABLES `important` WRITE;
/*!40000 ALTER TABLE `important` DISABLE KEYS */;
INSERT INTO `important` VALUES (1,'ZAM_109.pdf','Заповед ЗАМ-109/01.02.2017 г. - \"Вътрешни правила за условията и реда за извършване на изследване за професионална и психологическа пригодност при назначаване и повишаване в длъжност в Агенция \"Митници\"','/public/files/ZAM_109.pdf',1,1489398684,1),(2,'ZAM_135_20170209.pdf','Заповед ЗАМ-135/09.02.2017 за изменение на чл. 16, ал. 1 от \"Вътрешни правила за заплатите в Агенция \"Митници\"','/public/files/ZAM_135_20170209.pdf',1,1489399670,1),(3,'ZAM_58_2070118.pdf','Заповед ЗАМ-58/18.01.2017 г. - \"Правила за реда за предоставяне, обработване, съхраняване и унищожаване на данъчна информация, свързана с прилагането на Закона за акцизите и данъчните складове (ЗАДС)\"','/public/files/ZAM_58_2070118.pdf',1,1489399746,1),(4,'ZAM_57_2070118.pdf','Заповед ЗАМ-57/18.01.2017 г. - Прилагане на чл. 12 от Регламент (ЕС) №952/2013 на Европейския парламент и на Съвета','/public/files/ZAM_57_2070118.pdf',1,1489399788,1),(5,'1153.pdf','Заповед ЗАМ-1153/15.11.2016 г. - \"Вътрешни правила за реда и организацията на служебните командировки в страната на служителите от Агенция \"Митници\"\" - Приложения ','/public/files/1153.pdf',1,1489399960,1),(6,'VP_OP2016.zip','Вътрешни правила за управление на цикъла на обществените поръчки в Агенция \"Митници\"','/public/files/VP_OP2016.zip',1,1489400029,1),(7,'Dekl_po_chl10_al6_ot_ZM_2016utv.pdf','Декларация по чл. 10, ал. 6 от ЗМ, утвърдената със Заповед на Директора на Агенция \"Митници\" № ЗАМ-220/02.03.2016 г. (НОВО) ','/public/files/Dekl_po_chl10_al6_ot_ZM_2016utv.pdf',1,1489400098,1),(8,'226_dvpr_2015.pdf','ЗАМ-226/19.03.2015 г. - Правила за определяне на допълнителните възнаграждения за постигнати резултати (НОВО)','/public/files/226_dvpr_2015.pdf',1,1489400147,1),(9,'ZAM_859_14_10.pdf','ЗАМ-859/14.10.2013 - Инструкция по безопастност и здраве \"Стрес на работното място\"','/public/files/ZAM_859_14_10.pdf',1,1489400246,1),(10,'93_1174_all.pdf','ЗАМ-709/07.08.2013 - Правила за комуникация с медиите на Агенция \"Митници\"','/public/files/93_1174_all.pdf',1,1489400294,1),(11,'Procedure_term_expl_93_932_11.07_1.pdf','Процедура за извеждане от експлоатация на система или компонент на система','/public/files/Procedure_term_expl_93_932_11.07_1.pdf',1,1489400341,1),(12,'ZAM_484_30.05.pdf','Заповед № ЗАМ-484 от 30.05.2013 г. - Инструкция по безопастност и здраве за Отчитане на времето при работа с източници на йонизиращи лъчения (ИЙЛ).','/public/files/ZAM_484_30.05.pdf',1,1489400396,1),(13,'http://intranet.sfPravila za polzvane na pochivnite bazi na AM.pdf','Заповед № ЗАМ - 741/32-149612 от 03.08.2015 г. за утвърждаване на \"Правила за ползване на почивните бази на Агенция \"Митници\"\" , Приложение №2 - заявка за ползване на почивните бази собственост на АМ ','/public/files/Pravila za polzvane na pochivnite bazi na AM.pdf',1,1489400519,1),(14,'Z_L_Danni.pdf','Инструкция за събиране, съхранение и защита на личните данни на физически лица','/public/files/http://intranet.sfarm.customs.bg/customs/zki/files/Z_L_Danni.pdf',1,1489400568,1),(15,'Plan_bedstviya_CMU-2017.pdf','План на ЦМУ за защита на пребиваващите при бедствие или друга извънредна ситуация','/public/files/Plan_bedstviya_CMU-2017.pdf',1,1489400650,1),(16,'image0185.pdf','Заповед ЗАМ-685 от 08.12.2011г. - Вътрешни правила за организация на деловодната дейност в Агенция \"Митници\"','/public/files/image0185.pdf',1,1489400650,1),(17,'ZAM-889_all.pdf','Заповед ЗАМ - 889 от 20.12.2012 г. - вътрешни правила за реда и организацията на служебните командировки в страната на служителите на Агенция \"Митници\"   - Приложения ','/public/files/ZAM-889_all.pdf',1,1489400722,1),(18,'IT_Sec_Pol.pdf','Политика за ИТ сигурност','/public/files/IT_Sec_Pol.pdf',1,1489400722,1),(19,'declaration_sec_policy.doc','Декларация - ИТ сигурност','/public/files/declaration_sec_policy.doc',1,1489400809,1),(20,'DZ_Elena_Kirilova.pdf','Учредяване на секция на Професионалното обединение на държавните служители в МФ','/public/files/DZ_Elena_Kirilova.pdf',1,1489400809,1),(21,'Prilojenie 2.doc','Приложение No.2 - ДОКЛАД ЗА ПРЕДЛОЖЕНИЕ ЗА ИНДИВИДУАЛЕН РАЗМЕР НА ДМС','/public/files/Prilojenie 2.doc',1,1489400899,1),(22,'ZAM-139.pdf','Вътрешни правила за организация на пропускателния режим в административния комплекс на ЦМУ - (НОВО)','/public/files/ZAM-139.pdf',1,1489400899,1),(23,'Plan_krizi-Intranet_Azbuka+AEC.doc','Азбука на оцеляването','/public/files/Plan_krizi-Intranet_Azbuka+AEC.doc',1,1489400957,1);
/*!40000 ALTER TABLE `important` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mynested_category`
--

DROP TABLE IF EXISTS `mynested_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mynested_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `dep` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mynested_category`
--

LOCK TABLES `mynested_category` WRITE;
/*!40000 ALTER TABLE `mynested_category` DISABLE KEYS */;
INSERT INTO `mynested_category` VALUES (1,0,'Когнос',1,10,1,1),(2,0,'Аида',11,16,1,1),(3,1,'Документация Когнос',2,5,1,1),(4,3,'Заповеди Когнос',3,4,1,1),(5,2,'Документация Аида',12,15,1,1),(6,5,'Заповеди Аида',13,14,1,1),(11,1,'Тестова папка Когнос',6,7,1,1),(12,1,'Нова Тестова папка К',8,9,1,1),(13,0,'ДСАП',17,18,1,1);
/*!40000 ALTER TABLE `mynested_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nested_category`
--

DROP TABLE IF EXISTS `nested_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nested_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nested_category`
--

LOCK TABLES `nested_category` WRITE;
/*!40000 ALTER TABLE `nested_category` DISABLE KEYS */;
INSERT INTO `nested_category` VALUES (1,'ELECTRONICS',1,20),(2,'TELEVISIONS',2,9),(3,'TUBE',3,4),(4,'LCD',5,6),(5,'PLASMA',7,8),(6,'PORTABLE ELECTRONICS',10,19),(7,'MP3 PLAYERS',11,14),(8,'FLASH',12,13),(9,'CD PLAYERS',15,16),(10,'2 WAY RADIOS',17,18);
/*!40000 ALTER TABLE `nested_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nested_category_tmp`
--

DROP TABLE IF EXISTS `nested_category_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nested_category_tmp` (
  `category_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `dep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nested_category_tmp`
--

LOCK TABLES `nested_category_tmp` WRITE;
/*!40000 ALTER TABLE `nested_category_tmp` DISABLE KEYS */;
INSERT INTO `nested_category_tmp` VALUES (1,'Информационни системи',1,20,1),(2,'Аида',2,9,1),(3,'Тестови сценарии',3,4,1),(4,'Модели на данни',5,6,1),(5,'Техническо задание',7,8,1),(6,'Когнос',10,19,1),(7,'Заповеди ',11,14,1),(8,'Ръководства',12,13,1),(9,'Достъпи',15,16,1),(10,'Договори',17,18,1);
/*!40000 ALTER TABLE `nested_category_tmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nested_categorys`
--

DROP TABLE IF EXISTS `nested_categorys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nested_categorys` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `dep` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`),
  KEY `dep_id_idx` (`dep`),
  CONSTRAINT `dep_id` FOREIGN KEY (`dep`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nested_categorys`
--

LOCK TABLES `nested_categorys` WRITE;
/*!40000 ALTER TABLE `nested_categorys` DISABLE KEYS */;
INSERT INTO `nested_categorys` VALUES (1,'ДИС',1,22,6,0),(2,'Аида',2,9,6,1),(3,'Тестови сценарии',3,4,6,2),(4,'Модели на данни',5,6,6,2),(5,'Техническо задание',7,8,6,2),(15,'Когнос',10,21,6,1),(16,'Заповеди',11,14,6,15),(17,'Заповеди Достъпи',12,13,6,16),(18,'Ръководства',15,20,6,15),(19,'Ръководство на потребителя',16,17,6,18),(20,'Ръководство на админа',18,19,6,18),(21,'ДА',23,44,2,0),(22,'Системи',24,43,2,21),(23,'Бацис',25,42,2,22),(24,'Модули',26,41,2,23),(25,'еАДД',27,40,2,24),(31,'Тест',28,29,2,25),(34,'Test2',30,31,2,25),(35,'Test3',32,39,2,25),(36,'Test33',33,36,2,35),(37,'Тест333',34,35,2,36),(38,'Тест33-1',37,38,2,35);
/*!40000 ALTER TABLE `nested_categorys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` text NOT NULL,
  `attachment` tinyint(1) NOT NULL,
  `directory` int(11) DEFAULT NULL,
  `department` int(11) NOT NULL,
  `added_from` int(11) NOT NULL,
  `added_when` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `added_from_idx` (`added_from`),
  KEY `department_idx` (`department`),
  KEY `dir_id_idx` (`directory`),
  KEY `posts_directory_fk_idx` (`directory`),
  CONSTRAINT `added_from` FOREIGN KEY (`added_from`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dep` FOREIGN KEY (`department`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `posts_directory_fk` FOREIGN KEY (`directory`) REFERENCES `nested_categorys` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'20\" TV',3),(2,'36\" TV',3),(3,'Super-LCD 42\"',4),(4,'Ultra-Plasma 62\"',5),(5,'Value Plasma 38\"',5),(6,'Power-MP3 5gb',7),(7,'Super-Player 1gb',8),(8,'Porta CD',9),(9,'CD To go!',9),(10,'Family Talk 360',10);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_when` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `roles_added_by_fk_idx` (`added_by`),
  CONSTRAINT `roles_added_by_fk` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Супервайзор',1,'2017-04-27 07:23:42',1),(2,'Администратор',1,'2017-04-27 07:23:56',1);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ttt`
--

DROP TABLE IF EXISTS `ttt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ttt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ttt`
--

LOCK TABLES `ttt` WRITE;
/*!40000 ALTER TABLE `ttt` DISABLE KEYS */;
INSERT INTO `ttt` VALUES (1,'test',13,0),(2,'test2',13,14);
/*!40000 ALTER TABLE `ttt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_added_when` datetime DEFAULT NULL,
  `department` int(11) NOT NULL,
  `root_folder` tinyint(11) NOT NULL DEFAULT '0',
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_idx` (`role`),
  KEY `department_idx` (`department`),
  CONSTRAINT `department` FOREIGN KEY (`department`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'vandreev','$2a$07$usesomadasdsadsadsadae8r8IoXn1AUMCAqOijT/T5xjfC8KOzQu','vladislav.andreev@customs.bg','2017-04-27 15:27:04',1,0,'2017-04-27 12:27:28',1,1),(2,'rstanchev','$2a$07$usesomadasdsadsadsadaeQN0JjiietylPXs417w554iImJ58GhO.','radoslav.stanchev@customs.bg','2017-04-27 15:23:05',1,0,'2017-05-10 09:17:44',1,1),(3,'koleva','$2a$07$usesomadasdsadsadsadaeQN0JjiietylPXs417w554iImJ58GhO.','tsenka.koleva@customs.bg','2017-04-27 15:31:58',1,0,'2017-05-10 09:18:06',1,2),(4,'rankov','$2a$07$usesomadasdsadsadsadaeQN0JjiietylPXs417w554iImJ58GhO.','deyan.rankov@customs.bg','2017-05-03 15:54:45',1,0,'2017-05-10 09:18:06',1,2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_folders`
--

DROP TABLE IF EXISTS `users_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_folders` (
  `user_id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  KEY `user_id_idx` (`user_id`),
  KEY `folder_id_idx` (`folder_id`),
  CONSTRAINT `folder_id` FOREIGN KEY (`folder_id`) REFERENCES `nested_categorys` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_folders`
--

LOCK TABLES `users_folders` WRITE;
/*!40000 ALTER TABLE `users_folders` DISABLE KEYS */;
INSERT INTO `users_folders` VALUES (4,2),(3,2);
/*!40000 ALTER TABLE `users_folders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-26 12:18:11
