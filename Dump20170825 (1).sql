
--
-- Table structure for table `departments`
--


CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_when` int(11) NOT NULL,
  `modified_from` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `added_by` (`added_by`),
  KEY `modified_from_idx` (`modified_from`),
  KEY `departments_modified_from_idx` (`modified_from`),
  KEY `departments_modified_from_who_idx` (`modified_from`),
  CONSTRAINT `departments_added_by_fk` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `departments_modified_from` FOREIGN KEY (`modified_from`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Дирекция Митнически режими и процедури',1,1488791962,1,0,'2017-06-12 08:46:15'),(2,'Дирекция Акцизи',1,1488791998,1,1,'2017-06-12 08:46:15'),(3,'Дирекция Тарифна политика',1,1489071553,1,1,'2017-06-12 08:46:16'),(4,'Дирекция Последващ контрол',1,1489071553,1,1,'2017-06-12 08:46:16'),(5,'Дирекция Митническо разузнаване и разследване',1,1489071712,1,1,'2017-06-12 08:46:16'),(6,'Дирекция Информационни системи',1,1489071712,1,1,'2017-06-12 08:46:16'),(7,' Дирекция Международни отношения',1,1489071772,1,1,'2017-06-12 08:46:16'),(8,'Дирекция Централна митническа лаборатория',1,1489071772,1,1,'2017-06-12 08:46:16'),(9,'Дирекция Стратегически анализи и прогнози ',1,1489071813,1,1,'2017-06-12 08:46:16'),(10,'Дирекция  Финанси и обществени поръчки',1,1489071813,1,1,'2017-06-12 08:46:16'),(11,' Дирекция Организация и управление на човешките ресурси',1,1489071855,1,1,'2017-06-12 08:46:16'),(12,' Дирекция Национален учебен център',1,1489071855,1,1,'2017-06-12 08:46:16'),(13,'Дирекция Административно обслужване',1,1489071891,1,1,'2017-06-12 08:46:16'),(14,'Дирекция Управление на собствеността и логистика',1,1489071891,1,1,'2017-06-12 08:46:16'),(15,' Инспекторат',1,1489071931,1,1,'2017-06-12 08:46:16'),(16,'Отдел Сигурност',1,1489071931,1,1,'2017-06-12 08:46:16'),(17,' Отдел Вътрешен одит',1,1494498907,1,1,'2017-06-12 08:46:16'),(18,'Звено за мрежова и информационна сигурност ',1,1494498923,1,1,'2017-06-12 08:46:16'),(19,'Митница Аерогара София',1,1494498929,1,1,'2017-06-12 08:46:16'),(20,' Митница Бургас',1,1494498936,1,1,'2017-06-12 08:46:16'),(21,'Митница Варна',1,1494498972,1,1,'2017-06-12 08:46:16'),(22,'Митница Лом',1,1494498980,1,1,'2017-06-12 08:46:16'),(23,'Митница Пловдив',1,1494498984,1,1,'2017-06-12 08:46:16'),(24,'Митница Русе',1,1494498988,1,1,'2017-06-12 08:46:16'),(25,'Митница Свищов',1,1494498993,1,1,'2017-06-12 08:46:16'),(26,'Митница Столична ',1,1494498998,1,1,'2017-06-12 08:46:16'),(27,'Митница Югозападна',1,1494499004,1,1,'2017-06-12 08:46:16');
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
  `original_filename` varchar(500) NOT NULL,
  `stored_filename` varchar(250) NOT NULL,
  `file_basename` varchar(250) NOT NULL,
  `file_ext` varchar(10) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_md5_hash` varchar(250) NOT NULL,
  `label` varchar(250) NOT NULL,
  `added_from` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `path` varchar(250) NOT NULL,
  `department_id` int(11) NOT NULL,
  `directory` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `sort_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `added_from_idx` (`added_from`),
  KEY `fold_idx` (`directory`),
  KEY `depart_idx` (`department_id`),
  CONSTRAINT `addedFrom` FOREIGN KEY (`added_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `depart` FOREIGN KEY (`department_id`) REFERENCES `nested_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fold` FOREIGN KEY (`directory`) REFERENCES `nested_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (2,'AM_Annual-plan_2016_report.doc','597edd38f38b5.doc','AM_Annual-plan_2016_report','.doc',388584,'4a1a5cfbe10003db0156d753c43a488c','ОТЧЕТ ПО ГОДИШНИЯ ПЛАН НА АГЕНЦИЯ \"МИТНИЦИ\" 2016 ГОДИНА',1,'2017-07-31 07:33:12',1,'',2,2,NULL,1),(3,'AM_Annual-plan_2017.docx','597f381fe11b2.docx','AM_Annual-plan_2017','.docx',211926,'e3cc3c4f902f2cdfb92fca0026fc9c3a',' 	 ГОДИШЕН ПЛАН НА АГЕНЦИЯ \"МИТНИЦИ\" ЗА 2017',1,'2017-07-31 14:01:03',1,'',2,2,NULL,2),(106,'cvcv.jpg','599c3ffe778e2.jpg','cvcv','.jpg',143180,'a22cb7e55076c41160f29e32f41ced9a','sdsd',1,'2017-08-24 14:13:33',1,'',1,19,NULL,4),(107,'error505.png','599d2b463fa0f.png','error505','.png',77576,'aa0290feb42d32bd79ebc0de14c43d51','Грешка',1,'2017-08-24 14:30:34',1,'',1,70,NULL,8),(108,'ducky.gif','599d2b9f1113e.gif','ducky','.gif',44784,'fcde66cb8c14246ec3f143a8ad1e841f','Патка',1,'2017-08-24 07:40:48',1,'',1,71,35,NULL),(109,'error505.png','599d36106183c.png','error505','.png',77576,'aa0290feb42d32bd79ebc0de14c43d51','Грешка 2',1,'2017-08-23 08:00:16',1,'',1,70,38,NULL),(110,'error505.png','599d368ad3941.png','error5055','.png',77576,'aa0290feb42d32bd79ebc0de14c43d51','Грешка3',1,'2017-08-24 14:24:03',1,'',1,70,39,NULL),(111,'ChinookDatabase1.4_CompleteVersion.zip','599d478334391.zip','ChinookDatabase1.4_CompleteVersion','.zip',3823277,'4a69f30571ae38eb2eacac45e0bd6961','Тестова БД',1,'2017-08-23 09:14:43',1,'',1,70,40,NULL),(112,'DataTables-1.10.12.zip','599d47f4281b6.zip','DataTables-1.10.12','.zip',2346036,'5d6e38017d15726fbb5c4efc7c42e347','Библиотека за таблици',1,'2017-08-24 14:30:34',1,'',1,70,NULL,13),(113,'Tehnitchesko_zadanie.pdf','599d581181fdb.pdf','Tehnitchesko_zadanie','.pdf',202740,'6d1d3b65870a923216ea9a07bc10d47b','pdf 197 KB',16,'2017-08-24 14:30:34',1,'',1,70,NULL,6),(114,'Tehnitchesko_zadanie.docx','599d59e062bdc.docx','Tehnitchesko_zadanie','.docx',60959,'bcc808a100915955708b0f83a990034f','test docx',16,'2017-08-24 14:30:34',1,'',1,70,NULL,14),(115,'ДИ.docx','599d5b740e202.docx','ДИ','.docx',12685,'98440c4a222d684af7a8ec7fcb86326d','поле описание на файла',16,'2017-08-24 14:30:34',1,'',1,70,NULL,15),(117,'002570.png','599d6971749b7.png','002570','.png',409585,'3cdcb3925f5e451e85235594ffbdd5d1','pole opisanie na fail s Vladi',16,'2017-08-23 11:39:29',1,'',1,70,43,NULL),(119,'CELEX-02015R2446-20160501-BG-TXT.pdf','599d7299e8fc4.pdf','CELEX-02015R2446-20160501-BG-TXT','.pdf',10978941,'03db8f1140b8c15bc0b106810486abd2',',jhlkjlk',16,'2017-08-24 14:13:33',1,'',1,70,44,NULL),(121,'ducky.gif','599d792f17be4.gif','ducky','.gif',44784,'fcde66cb8c14246ec3f143a8ad1e841f','Патка',1,'2017-08-23 12:46:39',1,'',1,70,46,NULL),(122,'playground-coloring-page.jpg','599d792f17ef9.jpg','playground-coloring-page','.jpg',60474,'0e4a9f0fc3a6e40aa9612595fb21ec30','Пуйка',1,'2017-08-23 12:46:39',1,'',1,70,46,NULL),(123,'dgrm_user_role1.jpg','599d797992ab0.jpg','dgrm_user_role1','.jpg',14794,'03675a1d889e8acef6e2970b309e04a1','Потребителски роли Бацис',1,'2017-08-24 14:30:34',1,'',1,70,NULL,19),(124,'mustang-paper-car-template_262782.jpg','599d79799313c.jpg','mustang-paper-car-template_262782','.jpg',462058,'4f1781ca3f16badbdf79d353d6347b92','Мустанг',1,'2017-08-24 14:30:34',1,'',1,70,NULL,20),(127,'Pril_3_ZAM-966_V_1.4_20170518.pdf','599d8525d09f8.pdf','Pril_3_ZAM-966_V_1.4_20170518','.pdf',756204,'0dfa6ffee2ce989b40efcc0e85d5da7c',' Pril_3_ZAM-966_V_1.4_20170518.pdf ',15,'2017-08-24 12:19:19',1,'',1,77,47,NULL),(130,'002513 от Im профил.png','599e9c327cd15.png','002513 от Im профил','.png',142163,'95f5334d517e7f312d21f9b36d103150','002513 от Im профил.png',16,'2017-08-24 09:28:18',1,'',1,70,49,NULL),(133,'002560.PNG','599eacda8230d.PNG','002560','.PNG',53230,'6dd62a58b30b6310885d71684ca67cce','vsdvs',16,'2017-08-24 10:39:22',1,'',1,70,46,NULL),(135,'cvcv.jpg','599eb2be858cd.jpg','cvcv','.jpg',143180,'a22cb7e55076c41160f29e32f41ced9a','cv',1,'2017-08-24 11:04:30',1,'',1,22,50,NULL),(136,'dgrm_user_role1.jpg','599eb2f81ffc5.jpg','dgrm_user_role1','.jpg',14794,'03675a1d889e8acef6e2970b309e04a1','Потребителски роли Бацис',1,'2017-08-24 11:05:28',1,'',1,22,50,NULL),(141,'ducky.gif','599eba9f4a0b3.gif','ducky','.gif',44784,'fcde66cb8c14246ec3f143a8ad1e841f','Пате',1,'2017-08-24 11:38:07',1,'',1,70,49,NULL),(142,'cvcv.jpg','599ebad998a36.jpg','cvcv','.jpg',143180,'a22cb7e55076c41160f29e32f41ced9a','cvcv',1,'2017-08-24 11:39:05',1,'',1,70,49,NULL),(143,'# 3058 с ЕГН в статус Подадена.png','599ebcade4779.png','# 3058 с ЕГН в статус Подадена','.png',73363,'02920da75b4bcf39618de9d7d9c26c62','първи',16,'2017-08-24 12:13:44',1,'',1,71,51,NULL),(144,'002572.png','599ebd0e6f115.png','002572','.png',374865,'0641500ecaffbf4915feb6523d6cd3b1','втори',16,'2017-08-24 12:13:44',1,'',1,71,51,NULL),(149,'TestDashbord.doc','599ecd5fc99c9.doc','TestDashbord','.doc',28160,'707f3d3ecb33ad0cad1c719783ff3d0a','дашборд',15,'2017-08-24 12:58:07',1,'',1,76,53,NULL),(150,'Doklad-Rezultati_ZAM_787.pdf','599ed210dcfad.pdf','Doklad-Rezultati_ZAM_787','.pdf',447423,'00295c65e6e9cdcf7eb45a0051a16245','доклад',15,'2017-08-24 13:18:08',1,'',1,77,NULL,1),(151,'2 br. 030031.JPG','599edd96989af.JPG','2 br. 030031','.JPG',357742,'66796949eb631f16a48641692e6553dd','ааааа',16,'2017-08-24 14:07:18',1,'',1,70,55,NULL),(152,'2764 bug 3058 NE.png','599eddf349dba.png','2764 bug 3058 NE','.png',76259,'bf08d832e81745931a7567f0d404ba5f','бббб',16,'2017-08-24 14:08:51',1,'',1,70,57,NULL),(154,'BACIS-Vision-1.03.docx','599ee30ac293d.docx','BACIS-Vision-1.03','.docx',1080217,'915972a21356a66dba251da22d1ac44a','Бацис',1,'2017-08-24 14:30:34',1,'',1,70,NULL,1),(156,'.rels','59a02e7cda761.rels','','.rels',737,'29f309b350da2fbdd04057161c62e292','ghgh',1,'2017-08-25 14:04:44',1,'',1,70,54,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `important`
--

LOCK TABLES `important` WRITE;
/*!40000 ALTER TABLE `important` DISABLE KEYS */;
INSERT INTO `important` VALUES (1,'ZAM_109.pdf','Заповед ЗАМ-109/01.02.2017 г. - \"Вътрешни правила за условията и реда за извършване на изследване за професионална и психологическа пригодност при назначаване и повишаване в длъжност в Агенция \"Митници\"','/public/files/ZAM_109.pdf',1,1489398684,1),(2,'ZAM_135_20170209.pdf','Заповед ЗАМ-135/09.02.2017 за изменение на чл. 16, ал. 1 от \"Вътрешни правила за заплатите в Агенция \"Митници\"','/public/files/ZAM_135_20170209.pdf',1,1489399670,1),(3,'ZAM_58_2070118.pdf','Заповед ЗАМ-58/18.01.2017 г. - \"Правила за реда за предоставяне, обработване, съхраняване и унищожаване на данъчна информация, свързана с прилагането на Закона за акцизите и данъчните складове (ЗАДС)\"','/public/files/ZAM_58_2070118.pdf',1,1489399746,1),(4,'ZAM_57_2070118.pdf','Заповед ЗАМ-57/18.01.2017 г. - Прилагане на чл. 12 от Регламент (ЕС) №952/2013 на Европейския парламент и на Съвета','/public/files/ZAM_57_2070118.pdf',1,1489399788,1),(5,'1153.pdf','Заповед ЗАМ-1153/15.11.2016 г. - \"Вътрешни правила за реда и организацията на служебните командировки в страната на служителите от Агенция \"Митници\"\" - Приложения ','/public/files/1153.pdf',1,1489399960,1),(6,'VP_OP2016.zip','Вътрешни правила за управление на цикъла на обществените поръчки в Агенция \"Митници\"','/public/files/VP_OP2016.zip',1,1489400029,1),(7,'Dekl_po_chl10_al6_ot_ZM_2016utv.pdf','Декларация по чл. 10, ал. 6 от ЗМ, утвърдената със Заповед на Директора на Агенция \"Митници\" № ЗАМ-220/02.03.2016 г. (НОВО) ','/public/files/Dekl_po_chl10_al6_ot_ZM_2016utv.pdf',1,1489400098,1),(8,'226_dvpr_2015.pdf','ЗАМ-226/19.03.2015 г. - Правила за определяне на допълнителните възнаграждения за постигнати резултати (НОВО)','/public/files/226_dvpr_2015.pdf',1,1489400147,1),(9,'ZAM_859_14_10.pdf','ЗАМ-859/14.10.2013 - Инструкция по безопастност и здраве \"Стрес на работното място\"','/public/files/ZAM_859_14_10.pdf',1,1489400246,1),(10,'93_1174_all.pdf','ЗАМ-709/07.08.2013 - Правила за комуникация с медиите на Агенция \"Митници\"','/public/files/93_1174_all.pdf',1,1489400294,1),(11,'Procedure_term_expl_93_932_11.07_1.pdf','Процедура за извеждане от експлоатация на система или компонент на система','/public/files/Procedure_term_expl_93_932_11.07_1.pdf',1,1489400341,1),(12,'ZAM_484_30.05.pdf','Заповед № ЗАМ-484 от 30.05.2013 г. - Инструкция по безопастност и здраве за Отчитане на времето при работа с източници на йонизиращи лъчения (ИЙЛ).','/public/files/ZAM_484_30.05.pdf',1,1489400396,1),(13,'http://intranet.sfPravila za polzvane na pochivnite bazi na AM.pdf','Заповед № ЗАМ - 741/32-149612 от 03.08.2015 г. за утвърждаване на \"Правила за ползване на почивните бази на Агенция \"Митници\"\" , Приложение №2 - заявка за ползване на почивните бази собственост на АМ ','/public/files/Pravila za polzvane na pochivnite bazi na AM.pdf',1,1489400519,1),(14,'Z_L_Danni.pdf','Инструкция за събиране, съхранение и защита на личните данни на физически лица','/public/files/http://intranet.sfarm.customs.bg/customs/zki/files/Z_L_Danni.pdf',1,1489400568,1),(15,'Plan_bedstviya_CMU-2017.pdf','План на ЦМУ за защита на пребиваващите при бедствие или друга извънредна ситуация','/public/files/Plan_bedstviya_CMU-2017.pdf',1,1489400650,1),(16,'image0185.pdf','Заповед ЗАМ-685 от 08.12.2011г. - Вътрешни правила за организация на деловодната дейност в Агенция \"Митници\"','/public/files/image0185.pdf',1,1489400650,1),(17,'ZAM-889_all.pdf','Заповед ЗАМ - 889 от 20.12.2012 г. - вътрешни правила за реда и организацията на служебните командировки в страната на служителите на Агенция \"Митници\"   - Приложения ','/public/files/ZAM-889_all.pdf',1,1489400722,1),(18,'IT_Sec_Pol.pdf','Политика за ИТ сигурност','/public/files/IT_Sec_Pol.pdf',1,1489400722,1),(19,'declaration_sec_policy.doc','Декларация - ИТ сигурност','/public/files/declaration_sec_policy.doc',1,1489400809,1),(20,'DZ_Elena_Kirilova.pdf','Учредяване на секция на Професионалното обединение на държавните служители в МФ','/public/files/DZ_Elena_Kirilova.pdf',1,1489400809,1),(21,'Prilojenie 2.doc','Приложение No.2 - ДОКЛАД ЗА ПРЕДЛОЖЕНИЕ ЗА ИНДИВИДУАЛЕН РАЗМЕР НА ДМС','/public/files/Prilojenie 2.doc',1,1489400899,1),(22,'ZAM-139.pdf','Вътрешни правила за организация на пропускателния режим в административния комплекс на ЦМУ - (НОВО)','/public/files/ZAM-139.pdf',1,1489400899,1),(23,'Plan_krizi-Intranet_Azbuka+AEC.doc','Азбука на оцеляването','/public/files/Plan_krizi-Intranet_Azbuka+AEC.doc',1,1489400957,1),(24,'grafic_pristapi.txt','Тест','',1,1496666800,1),(25,'Файл на български.txt','аоаоаоао','',1,1496668477,1);
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
  `sort_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`),
  KEY `cat_added_from_idx` (`added_from`),
  KEY `cat_modified_from_idx` (`modified_from`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nested_categories`
--

LOCK TABLES `nested_categories` WRITE;
/*!40000 ALTER TABLE `nested_categories` DISABLE KEYS */;
INSERT INTO `nested_categories` VALUES (1,'Информационни системи',1,30,1,0,1,1501235637,1,'2017-08-24 13:15:25',0,2),(2,'Стратегически анализи и прогнози',31,32,2,0,1,1501235679,1,'2017-08-24 13:15:25',0,3),(3,'Тарифна политика',33,34,3,0,1,1501239297,1,'2017-08-24 13:15:25',0,4),(4,'Последващ контрол',35,36,4,0,1,1501239326,1,'2017-08-24 13:15:25',0,5),(5,'Митническо разузнаване и разследване',37,38,5,0,1,1501239347,1,'2017-08-24 13:15:25',0,6),(6,'Митнически режими и процедури',39,40,6,0,1,1501239368,1,'2017-08-24 13:15:25',0,7),(7,'Международни отношения',41,42,7,0,1,1501239387,1,'2017-08-24 13:15:25',0,8),(8,'ФОП',43,44,8,0,1,1501239426,1,'2017-08-24 13:15:25',0,9),(9,'УСЛ',45,46,9,0,1,1501239446,1,'2017-08-24 13:15:25',0,10),(10,'Правно-нормативна',47,48,10,0,1,1501239459,1,'2017-08-24 13:15:25',0,11),(11,'Акцизи',49,50,11,0,1,1501239481,1,'2017-08-24 13:15:25',0,12),(12,'Организация и управление на човешките ресурси',51,52,12,0,1,1501239493,1,'2017-08-24 13:15:25',0,13),(13,'Национален учебен център',53,54,13,0,1,1501239509,1,'2017-08-24 13:15:25',0,14),(14,'Сигурност',55,56,14,0,1,1501239550,1,'2017-08-24 13:15:25',0,15),(15,'Вътрешен одит',57,58,15,0,1,1501239568,1,'2017-08-24 13:15:25',0,16),(16,'Административно обслужване',59,60,16,0,1,1501239595,1,'2017-08-24 13:15:25',0,17),(17,'Важно',61,62,17,0,1,1501239989,1,'2017-08-24 13:15:25',0,1),(18,'Информационни и комуникационни технологии',2,3,1,1,1,1501247057,1,'2017-07-28 13:18:11',0,1),(19,'Първа предметна област',4,13,1,1,1,1501247106,1,'2017-08-24 13:15:25',0,2),(20,'Втора предметна област',14,21,1,1,1,1501247142,1,'2017-08-24 13:15:25',0,3),(21,'Трета предметна област',22,25,1,1,1,1501247178,1,'2017-08-24 13:15:25',0,4),(22,'Четвърта предметна област',26,29,1,1,1,1501247200,1,'2017-08-24 13:15:25',0,5),(59,'Когнос',27,28,1,22,1,1503323858,1,'2017-08-24 13:15:25',0,1),(70,'Първа ПО, тест 1',5,8,1,19,1,1503410540,16,'2017-08-24 14:13:33',0,2),(71,'Първа ПО, тест 2',9,10,1,19,1,1503410594,16,'2017-08-24 14:13:33',0,3),(72,'Когнос',15,20,1,20,1,1503494683,15,'2017-08-24 13:15:25',0,2),(73,'МИС3А',23,24,1,21,1,1503494711,15,'2017-08-24 13:15:25',0,1),(74,'Първа ПО, тест 3',11,12,1,19,1,1503565067,16,'2017-08-24 13:15:25',0,1),(76,'Документи тестове',16,17,1,72,1,1503577044,15,'2017-08-24 13:15:25',0,2),(77,'Докумени внедряване',18,19,1,72,1,1503577102,15,'2017-08-24 13:15:25',0,1),(78,'Първа ПО, тест 1, тест 11',6,7,1,70,1,1503580525,16,'2017-08-24 14:30:34',0,5);
/*!40000 ALTER TABLE `nested_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nested_categories_test`
--

DROP TABLE IF EXISTS `nested_categories_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nested_categories_test` (
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
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nested_categories_test`
--

LOCK TABLES `nested_categories_test` WRITE;
/*!40000 ALTER TABLE `nested_categories_test` DISABLE KEYS */;
INSERT INTO `nested_categories_test` VALUES (17,'ДИС',1,2,17,0,1,2017,1,'2017-07-03 13:18:35',0),(34,'ДСАП',3,6,34,0,1,2017,0,'2017-07-03 13:19:22',0),(35,'Справки',4,5,34,34,1,0,0,'2017-07-03 12:55:17',0);
/*!40000 ALTER TABLE `nested_categories_test` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nested_category`
--

LOCK TABLES `nested_category` WRITE;
/*!40000 ALTER TABLE `nested_category` DISABLE KEYS */;
INSERT INTO `nested_category` VALUES (1,'ELECTRONICS',1,18),(2,'TELEVISIONS',2,9),(3,'TUBE',3,4),(4,'LCD',5,6),(5,'PLASMA',7,8),(9,'CD PLAYERS',10,11),(10,'2 WAY RADIOS',12,17),(12,'FRS',15,16),(13,'MY_FRS',13,14);
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
-- Dumping data for table `nested_categorys`
--

LOCK TABLES `nested_categorys` WRITE;
/*!40000 ALTER TABLE `nested_categorys` DISABLE KEYS */;
INSERT INTO `nested_categorys` VALUES (1,'ДИС',1,23,6,0,1,1497359141,1,'2017-06-14 07:45:44',2),(2,'Аида',2,9,6,1,1,1497359141,1,'2017-06-13 13:05:41',1),(3,'Тестови сценарии',3,4,6,2,1,1497359141,1,'2017-06-13 13:05:41',1),(4,'Модели на данни',5,6,6,2,1,1497359141,1,'2017-06-13 13:05:41',1),(5,'Техническо задание',7,8,6,2,1,1497359141,1,'2017-06-13 13:05:41',1),(15,'Когнос',10,22,6,1,1,1497359141,1,'2017-06-14 07:45:44',1),(16,'Заповеди',11,14,6,15,1,1497359141,1,'2017-06-13 13:05:41',1),(17,'Заповеди Достъпи',12,13,6,16,1,1497359141,1,'2017-06-13 13:05:41',1),(18,'Ръководства',15,22,6,15,1,1497359141,1,'2017-06-13 13:05:41',1),(19,'Ръководство на потребителя',16,17,6,18,1,1497359141,1,'2017-06-13 13:05:41',1),(20,'Ръководство на админа',18,19,6,18,1,1497359141,1,'2017-06-13 13:05:41',1),(21,'ДА',24,31,2,0,1,1497359141,1,'2017-06-14 09:25:15',1),(39,'Супер ръководство',20,21,6,18,1,1497359141,1,'2017-06-13 13:05:41',1),(40,'Системи',25,30,2,21,1,1497427648,0,'2017-06-14 09:25:15',0),(41,'БАЦИС',26,27,2,40,1,1497427378,1,'2017-06-14 08:02:58',0),(42,'EMCS',28,29,2,40,1,1497432315,1,'2017-06-14 09:25:15',0);
/*!40000 ALTER TABLE `nested_categorys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `online_users`
--

DROP TABLE IF EXISTS `online_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `online_users` (
  `session` char(100) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `online_users`
--

LOCK TABLES `online_users` WRITE;
/*!40000 ALTER TABLE `online_users` DISABLE KEYS */;
INSERT INTO `online_users` VALUES ('b1p797rvcto653ggm6c4fhtgs2',1503667627);
/*!40000 ALTER TABLE `online_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `user_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `token` varchar(70) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `used` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES (1,'vladislav.andreev@customs.bg','129bbad706d77317afdae0e09dcd9100b5d2a78cc4753475d0820b4042c513a7','2017-07-06 11:39:40',1),(1,'vladislav.andreev@customs.bg','6cfc543bbf8cdc32904c18cf1964bb45e3def4f641cf5fca7e19fa581e7383eb','2017-07-07 06:24:45',1),(1,'vladislav.andreev@customs.bg','5696d5a02419630b13a609b808943b4fdcb227cd4444ab16091d5f21371f7646','2017-07-07 06:44:01',1),(1,'vladislav.andreev@customs.bg','398fbbb3df08b931361576bccb1f2a16d0c89e7bb824cfad6f3f9c920b28c7bb','2017-07-07 06:54:35',1),(1,'vladislav.andreev@customs.bg','91233aa2b8e49a2a2dc50c76bc6cc5edd148c680249823315c19f0ed2a784c31','2017-07-07 06:58:14',1),(1,'vladislav.andreev@customs.bg','d5f15b30394643cd01cae91a2b984a379291b031ba2987946cdfaeffd8ddb4aa','2017-07-07 07:06:48',1),(1,'vladislav.andreev@customs.bg','c43efbda3d4dc09b6bf59f42872a2cae6e54582fc1991bfea4175705a96389b2','2017-07-07 07:09:52',1),(1,'vladislav.andreev@customs.bg','2474e887a1056fcdd2747ece5f93ffcf7996663477fae86823fa2ab198833f5b','2017-07-07 07:11:00',1),(1,'vladislav.andreev@customs.bg','912a92e0e3dc387a160e9808132eb20e9604de04a8947a6e0102752259997bac','2017-07-07 07:12:45',1),(1,'vladislav.andreev@customs.bg','cabde768db96c41171c56ce454310d28f8230c13ef7eb059c995f0e8b1fd33cd','2017-07-07 07:13:00',1),(1,'vladislav.andreev@customs.bg','5f5c2baea908b429733ed76b8a270686e8f3158f73ae418115a8baff9850bc0b','2017-07-07 07:13:21',1),(1,'vladislav.andreev@customs.bg','2c25ec6f807741a78f2feb63208af9a3ef32f00e2efe6426323767e55fae2c5e','2017-07-07 07:15:13',1),(1,'vladislav.andreev@customs.bg','fe5eeacbadb1e416da0f140c8028fe6371ebdb3a6f56e4e7cde6722d140cba80','2017-07-07 07:18:58',1),(1,'vladislav.andreev@customs.bg','4f10f21af87cb939e9600c2ed17fdfbe2d350c3283206ddfdf02ceca4bf9b131','2017-07-17 12:08:38',1),(1,'vladislav.andreev@customs.bg','c7011e67552a929902c14e311fa92a4e79cd9bd0e2a73df64d732c6e720c74a6','2017-07-17 12:08:41',1),(3,'tsenka.koleva@customs.bg','c3e6851f11629babf6f72deee04e61cd82295fc6564d0196845bf76bd999fc2f','2017-07-28 10:34:20',1),(3,'tsenka.koleva@customs.bg','1d0b6c0139e2fe5b32894d32f0efa957733610cf88dc8de34551d977528265cc','2017-07-31 07:43:33',1),(1,'vladislav.andreev@customs.bg','891028ca91f5472bb0e37db8a50c8040269a8b379d54b04abe1a8dff23030114','2017-08-01 12:04:07',1),(1,'vladislav.andreev@customs.bg','39851001974fe9ecd8538819b1358511dc12ca7ac47aa61be62cd7b61390b8e7','2017-08-15 12:09:42',1),(3,'tsenka.koleva@customs.bg','103979bb3d57fe4da78572a51ee45be397d460cbf30da33848dc66ef4ef54403','2017-08-15 12:23:40',1),(3,'tsenka.koleva@customs.bg','ba854df7dbb9c0d1cdc82d1f86ab378d0808d30e2000b47015f57d576e880766','2017-08-15 12:24:59',1),(3,'tsenka.koleva@customs.bg','9a64c1c18d804efb4d50d4d3bf16fb20b8792ec31ddd8550177375af311ec8b3','2017-08-15 12:25:32',1),(3,'tsenka.koleva@customs.bg','cd8bcc54701d0cca4f0ed0f02968d720b9468e07ffca46856a612c6735dfd178','2017-08-15 12:33:20',1),(1,'vladislav.andreev@customs.bg','cd0b6c64f96b73037c02453f51573177c35f4265667ce013081e84ba032f41d0','2017-08-15 12:47:34',1),(1,'vladislav.andreev@customs.bg','3a19262df157839610adb967efe0d307c5c24b5250e9a5a62095058b4124b096','2017-08-15 12:48:59',1),(27,'tsenka.koleva@customs.bg','c3289c7f85a60a14648b63ab3078b1697e14c5be6977c1093f3f784a7b2a366a','2017-08-18 13:13:27',1),(27,'tsenka.koleva@customs.bg','74d843bb398717b3c25688d995bb95a1d90267965231f9bdca383859c5b1fd82','2017-08-18 13:14:29',1),(27,'tsenka.koleva@customs.bg','3e10c1df712cd0403c54ccc3ee31975e25ede8c2cbcce6d6c61916fcf729cc44','2017-08-18 13:15:19',1),(27,'tsenka.koleva@customs.bg','a48c5c50d19acb0f8bb8ae851e7a5b6fd8480aa507b31e96304195f72c1c63f8','2017-08-18 13:16:18',1);
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
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
  `sort_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `added_from_idx` (`added_from`),
  CONSTRAINT `added_from` FOREIGN KEY (`added_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'<p>Публикация Втора ПО</p>\r\n',0,20,1,1,1501594205,'2017-08-23 13:23:36',1),(29,'<p>ашкнн</p>\r\n',0,34,1,1,1503320872,'2017-08-25 14:03:29',1),(30,'<p>Трета публикация в Когнос</p>\r\n',1,34,1,1,1503321274,'2017-08-21 13:14:34',2),(34,'<p>ТЗ на МВР</p>\r\n',1,70,1,16,1503410915,'2017-08-24 14:30:34',7),(35,'<p>Публикация с файл</p>\r\n',1,71,1,1,1503472543,'2017-08-24 12:13:44',4),(37,'<p>Трета публикация</p>\r\n',0,70,1,1,1503475184,'2017-08-24 14:30:34',9),(38,'<p>Шеста публикация с файл</p>\r\n',1,70,1,1,1503475216,'2017-08-24 14:30:34',10),(39,'<p>Седма публикация с файл</p>\r\n',1,70,1,1,1503475338,'2017-08-24 14:30:34',11),(40,'<p>Тест за архив</p>\r\n',1,70,1,1,1503479683,'2017-08-24 14:30:34',12),(41,'<p>Публикация с IE11</p>\r\n',0,71,1,1,1503480021,'2017-08-24 12:13:44',3),(42,'<p>Пореден тест с файл</p>\r\n',0,71,1,1,1503485074,'2017-08-25 12:36:35',2),(43,'<p>тест с Влади, поле body</p>\r\n',1,70,1,16,1503488369,'2017-08-24 14:30:34',16),(44,'<p>читав текст</p>\r\n',1,70,1,16,1503490713,'2017-08-24 14:30:34',2),(46,'<p>Публикация с два файла +1</p>\r\n',1,70,1,16,1503492399,'2017-08-24 14:30:34',18),(47,'<p>Ръководство за попълване на формуляр за достъп</p>\r\n',1,77,1,15,1503495118,'2017-08-24 13:18:08',2),(49,'<p style=\"text-align:right\"><em>Заповеди за обявавена на спечелилия търг за отдава</em><u>не под наем на част от недвижим имот в с</u>град<strong>ата на Митница Столична и </strong>на част от имот в сградата на МБ София Запад.</p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify\"><s>Пратката е п</s>рист<sup>игнала на Мит</sup>ническ<sub>и пункт &bdquo;П</sub>ристанище Бургас Център&quot;&nbsp; в корабен контейнер със стоки от Китай, &nbsp;декларирани като внос за България. Митнически служители от сектор &bdquo;Оперативен контрол&quot; към отдел &bdquo;Митническо разузнаване и разследване&quot;/МРР/ в Митница Бургас селектират контейнера за щателна митническа проверка. При извършената проверка на 11 август 2017 г. се установява, че съдържанието на контейнера отговаря&nbsp; на декларираните стоки по вид и количество, но&nbsp;196 от колетите в контейнера съдържат 2 352 кутии с общо 56 448 опаковки с&nbsp; бонбони с имитиращи изображения на популярното коте &bdquo;Hello Kitty&quot;.&nbsp;</li>\r\n	<li style=\"text-align:justify\">Пратката е&nbsp; 2017 г. се установява, че съдържанието на контейнера отговаря&nbsp; на декларираните стоки по вид и количество, но&nbsp;196 от колетите в контейнера съдържат 2 352 кутии с общо 56 448 опаковки с&nbsp; бонбони с имитиращи изображения на популярното коте &bdquo;Hello Kitty&quot;.&nbsp;</li>\r\n</ol>\r\n',1,70,1,1,1503566898,'2017-08-24 14:30:34',17),(50,'<p>Нова публикация без файл</p>\r\n',1,22,1,1,1503572141,'2017-08-24 11:04:30',2),(51,'<p>подготвя се за тест обновяване</p>\r\n\r\n<p>публикация с 1 файл +1</p>\r\n',1,71,1,16,1503575213,'2017-08-24 12:13:44',1),(52,'<p>Заповед тестване</p>\r\n',0,76,1,15,1503577287,'2017-08-25 14:04:01',2),(53,'<h1 style=\"text-align:center\">ТЕСТОВЕ ДАШБОРДИ</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">В избрана от нас папка(достъпна с правата на потребителите по дирекции) се създаде шорткът и вю от основните елементи в папка разработка и да се реализира дашборд. Той работи и с потребителските права по дирекции. &ndash; ДА НО</span></span><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">:</span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">Трябва да се създаде ДБ след като са налични всички вюта/шорткъти в папката да която има достъп потребителя, в противен случай генерира се грешка с правата и трябва да се прелинкнат новодобавените елементи. При добавяне на нова група с достъп до ДБ пак се прелинкват елементите му. </span></span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">В база данни bacis_dm - таблица: a_test - се заредиха ръчно данни, за да се провери дали дашборда ще се ъпдейтва при нови данни и на какъв период от време. - ДА Изпълнени и следните две допълнителни стъпки, за да сме сигурни, че<br />\r\nДанните в дашборда създаден от(1бр report view и 1бр shortcut) се ъпдейтват при зареждане на нови данни от базата &ndash; ДА НО:</span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">Справките се кешират стандарт - 60мин. След което данните се актуализират.</span></span></li>\r\n	<li><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">Може да бъде форсирано изчистване на кеша със създаване на </span></span><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">job</span></span><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">, който се прави в администраторската част на Когнос.</span></span></li>\r\n</ul>\r\n',1,76,1,15,1503577619,'2017-08-24 13:16:34',1),(54,'<p>test va</p>\r\n',0,70,1,1,1503583637,'2017-08-25 14:02:33',21),(55,'<p>тест - едновременно</p>\r\n',1,70,1,16,1503583638,'2017-08-24 14:30:34',21),(56,'<p>Test va 1</p>\r\n',0,70,1,1,1503583730,'2017-08-25 14:02:44',3),(57,'<p>тест с влади променен</p>\r\n',1,70,1,1,1503583731,'2017-08-24 14:30:34',3);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'vandreev','$2a$07$usesomadasdsadsadsadae8r8IoXn1AUMCAqOijT/T5xjfC8KOzQu','vladislav.andreev@customs.bg','2017-04-27 15:27:04',1,0,'2017-07-17 12:09:17',1,1),(2,'rstanchev','$2a$07$usesomadasdsadsadsadaeQN0JjiietylPXs417w554iImJ58GhO.','radoslav.stanchev@customs.bg','2017-04-27 15:23:05',1,0,'2017-05-10 09:17:44',1,1),(4,'rankov','$2a$07$usesomadasdsadsadsadaeQN0JjiietylPXs417w554iImJ58GhO.','deyan.rankov@customs.bg','2017-05-03 15:54:45',6,0,'2017-07-28 10:31:46',1,2),(5,'stsanev','$2a$07$usesomadasdsadsadsadaeQN0JjiietylPXs417w554iImJ58GhO.','svilen.tsanev@customs.bg','2017-07-28 13:26:34',6,0,'2017-07-28 10:26:34',1,1),(6,'ndimitrova','$2a$07$usesomadasdsadsadsadaeQN0JjiietylPXs417w554iImJ58GhO.','nely.dimitrova@customs.bg','2017-07-28 13:33:11',6,0,'2017-07-28 10:33:11',1,1),(9,'ddimchev','$2a$07$usesomadasdsadsadsadaekYTyWO/TCCa92fgET7vlUyDXpdNom3K','Dimo.Dimchev@customs.bg','2017-08-16 15:13:56',6,0,'2017-08-16 12:21:03',1,2),(14,'gakifova','$2a$07$usesomadasdsadsadsadae1TskWtEJ3PurVjWfeforlzAqdO1O2B.','gyuldzhan.akifova@customs.bg','2017-08-18 09:30:28',6,0,'2017-08-18 06:30:28',1,2),(15,'zpavlova','$2a$07$usesomadasdsadsadsadaeuXcqmteGTQ1lZm7loJAYFakzEZbVxoa','zvezdelina.pavlova@customs.bg','2017-08-18 09:32:16',6,0,'2017-08-18 07:05:53',1,2),(16,'vkabaeva','$2a$07$usesomadasdsadsadsadae8LZgW9yXqJVNczqNQmKN5f0PTJbxG1y','vesela.kabaeva@customs.bg','2017-08-18 09:51:08',6,0,'2017-08-22 13:52:49',1,2),(27,'koleva','$2a$07$usesomadasdsadsadsadaeQN0JjiietylPXs417w554iImJ58GhO.','tsenka.koleva@customs.bg','2017-08-18 11:00:49',6,0,'2017-08-18 13:16:35',1,1),(28,'testov','$2a$07$usesomadasdsadsadsadae6rjhdfh1wuzJSn7gYbc7x7SCNuL3/1q','vlado796@gmail.com','2017-08-18 11:16:24',6,0,'2017-08-18 08:16:24',1,1);
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
  KEY `folde_id_idx` (`folder_id`),
  CONSTRAINT `folde_id` FOREIGN KEY (`folder_id`) REFERENCES `nested_categories` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_folders`
--

LOCK TABLES `users_folders` WRITE;
/*!40000 ALTER TABLE `users_folders` DISABLE KEYS */;
INSERT INTO `users_folders` VALUES (4,22),(9,21),(9,22),(14,22),(15,20),(16,19);
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

-- Dump completed on 2017-08-25 17:33:09
