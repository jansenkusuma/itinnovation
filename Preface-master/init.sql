-- MySQL dump 10.13  Distrib 5.5.24, for Win64 (x86)
--
-- Host: localhost    Database: fakeig
-- ------------------------------------------------------
-- Server version	5.5.24

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
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `username` varchar(40) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `profile_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('sutandi_tan','601f1889667efaebb33b8c12572835da3f027f78',3),('stanley_leo','601f1889667efaebb33b8c12572835da3f027f78',4),('sonyw','601f1889667efaebb33b8c12572835da3f027f78',5),('sutandi_tanz','601f1889667efaebb33b8c12572835da3f027f78',6),('asdaaa','601f1889667efaebb33b8c12572835da3f027f78',7),('kirakatouu','601f1889667efaebb33b8c12572835da3f027f78',16),('kirakatou','601f1889667efaebb33b8c12572835da3f027f78',15),('kira','601f1889667efaebb33b8c12572835da3f027f78',14),('marioo','c2df4de8c9c034c638527afa5a6f6f21eea377cd',17),('kirakatouuu','601f1889667efaebb33b8c12572835da3f027f78',18);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned NOT NULL,
  `image` varchar(45) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (2,3,'3-2.png','test','2016-10-22 22:54:34'),(3,3,'3-3.jpg','Background Smart Campus','2016-10-22 23:54:34'),(21,3,'3-5.jpg','asde','2016-11-06 01:40:09'),(5,3,'3-5.png','One piece','2016-10-24 17:48:11'),(6,3,'3-6.jpg','One Piece part 2','2016-10-24 17:48:33'),(12,4,'4-1.jpg','stanley','2016-11-01 17:29:38'),(24,18,'18-1.jpg','','2016-11-06 02:21:01'),(22,3,'3-6.jpg','Dor','2016-11-06 01:43:47'),(23,3,'3-7.jpg','','2016-11-06 02:05:19');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_comment`
--

DROP TABLE IF EXISTS `post_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_comment`
--

LOCK TABLES `post_comment` WRITE;
/*!40000 ALTER TABLE `post_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_like`
--

DROP TABLE IF EXISTS `post_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_like` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_like`
--

LOCK TABLES `post_like` WRITE;
/*!40000 ALTER TABLE `post_like` DISABLE KEYS */;
INSERT INTO `post_like` VALUES (41,3,3),(44,2,3),(45,12,17);
/*!40000 ALTER TABLE `post_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_pic` varchar(45) DEFAULT NULL,
  `job` varchar(50) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `verify` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (3,'Sutandi','tanzwithyou@yahoo.com','','Programmer','1998-02-24','08123984123','sutandi.asia','Perfectionist',NULL),(4,'Stanley','stanzzz@yahoo.com','4.jpg','Admin Marketing','1998-01-11','+72391831','stanzzzzz.com','Stanley',NULL),(6,'Sutandi','asd@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'Sutandi','a@mgiald',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'kirakatou','kirakatouu@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,1),(15,'kirakatou','kirakatouu@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'kira','kirakatouu@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,1),(17,'Mario','kirakatouu@gmail.com','17.jpg','','1998-01-11','08546121161','','',1),(18,'Kira Katou','kirakatouu@gmail.com',NULL,'Gamer','1998-01-11','08216546216','kirakatou.com','asdadadsada',1);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_follower`
--

DROP TABLE IF EXISTS `profile_follower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_follower` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned DEFAULT NULL,
  `follower_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_follower`
--

LOCK TABLES `profile_follower` WRITE;
/*!40000 ALTER TABLE `profile_follower` DISABLE KEYS */;
INSERT INTO `profile_follower` VALUES (2,3,4);
/*!40000 ALTER TABLE `profile_follower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(45) NOT NULL,
  `profile_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (3,'MgaZ9Gd199Rp58c',18);
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-06  2:26:21
