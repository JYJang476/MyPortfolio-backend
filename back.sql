-- MySQL dump 10.13  Distrib 5.1.44, for Win64 (unknown)
--
-- Host: localhost    Database: myweb
-- ------------------------------------------------------
-- Server version	5.1.44-community

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
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(100) DEFAULT NULL,
  `img_projid` int(11) DEFAULT NULL,
  `img_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myinfo`
--

DROP TABLE IF EXISTS `myinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kind` varchar(10) DEFAULT NULL,
  `info_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myinfo`
--

LOCK TABLES `myinfo` WRITE;
/*!40000 ALTER TABLE `myinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `myinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mystory`
--

DROP TABLE IF EXISTS `mystory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mystory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT NULL,
  `writer` varchar(10) DEFAULT NULL,
  `content` varchar(7000) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tag` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mystory`
--

LOCK TABLES `mystory` WRITE;
/*!40000 ALTER TABLE `mystory` DISABLE KEYS */;
INSERT INTO `mystory` VALUES (1,'test','test2','pondero kawaii','2021-05-20 12:17:49',NULL),(2,'test2','minna','kawaii','2021-05-25 23:36:37',NULL),(3,'%s','%s','%s','2021-05-26 03:03:12',NULL),(4,'%s','%s','%s','2021-05-26 04:42:24',NULL),(5,'%s','%s','%s','2021-05-26 06:35:34',NULL),(6,'%s','%s','%s','2021-05-26 08:02:33',NULL),(7,'%s','%s','%s','2021-05-26 11:54:55',NULL),(8,'%s','%s','%s','2021-05-26 11:55:04',NULL),(9,'%s','%s','%s','2021-05-26 11:56:15',NULL),(10,'adwa','wagawg','','2021-05-26 11:58:36',NULL),(11,'tea','admin','<p>test</p><hr><p>afwaf</p>','2021-05-26 23:49:43',NULL),(12,'xxx','admin','test','2021-05-27 00:39:01',NULL),(13,'xxx','admin','test','2021-05-27 00:40:01',NULL),(14,'tea','admin','test','2021-05-27 00:40:50',NULL),(15,'tea','admin','test','2021-05-27 00:51:58',NULL),(16,'tea','admin','test','2021-05-27 01:03:46',NULL),(17,'ㅋㅋㅋ','admin','test','2021-05-27 01:16:08',NULL);
/*!40000 ALTER TABLE `mystory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ppt`
--

DROP TABLE IF EXISTS `ppt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ppt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_id` int(11) DEFAULT NULL,
  `ppt_no` int(11) DEFAULT NULL,
  `board_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `ppt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `ppt_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ppt`
--

LOCK TABLES `ppt` WRITE;
/*!40000 ALTER TABLE `ppt` DISABLE KEYS */;
/*!40000 ALTER TABLE `ppt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_id` int(11) DEFAULT NULL,
  `project_name` varchar(30) DEFAULT NULL,
  `project_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(15) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `token` varchar(12) DEFAULT NULL,
  `userpw` varchar(17) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-15  9:09:57
-- exit!
