CREATE DATABASE  IF NOT EXISTS `eventi_bongo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `eventi_bongo`;
-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: eventi_bongo
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.32-MariaDB

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
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorie` (
  `idcategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (1,'Notturno'),(2,'Sociale');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `idevent` varchar(256) NOT NULL,
  `img` varchar(256) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  `price` decimal(5,2) DEFAULT '0.00',
  `numParticipants` int(11) DEFAULT '1',
  `city` varchar(45) NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  `uid_creator` varchar(45) NOT NULL,
  PRIMARY KEY (`idevent`),
  KEY `creator_event_idx` (`uid_creator`),
  KEY `event_img_idx` (`img`),
  CONSTRAINT `fk_evento_1` FOREIGN KEY (`uid_creator`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_2` FOREIGN KEY (`img`) REFERENCES `upload` (`uidimg`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES ('event_1','img_5b2c2387aa669','Viaggio ad Albenga','Viaggio','2018-06-23 09:30:00',5.00,NULL,'Albenga','Notturno','user_5af5aa1313f83'),('event_5b2c27e811f66','img_5b2c27e811349','Cinema all\'aperto','Boh','2018-06-21 21:30:00',0.00,NULL,'Pisa','Notturno','user_5af5aa1313f83'),('event_5b2c34743ae33','img_5b2c34743a349','DiscoBus','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas finibus aliquet sapien, non imperdiet massa pharetra faucibus. Sed nec sapien ut diam posuere porta. Etiam sollicitudin augue sed leo condimentum, in hendrerit tortor aliquam. Nunc tempus tristique metus, ac molestie purus bibendum id','2018-06-25 21:30:00',0.00,NULL,'Pisa','Notturno','user_5af5aa1313f83'),('event_5b2d107e9cd3a','img_5b2d107e9c038','Senegal-Islanda','Partita Campionato mondiale di calcio.','2018-06-24 17:30:00',0.00,1,'Russia','Sociale','user_5af5aa1313f83'),('event_5b2d3bb4ec9fa','img_5b2d3bb4ebfaf','dsadsadas','3223223','0022-03-31 03:02:00',0.00,1,'321321321312','Sociale','user_5af5aa1313f83');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partecipazione_evento`
--

DROP TABLE IF EXISTS `partecipazione_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partecipazione_evento` (
  `idpartecipazione_evento` int(11) NOT NULL AUTO_INCREMENT,
  `evento` varchar(255) NOT NULL,
  `user` varchar(256) NOT NULL,
  PRIMARY KEY (`idpartecipazione_evento`),
  KEY `fk_partecipazione_evento_1_idx` (`evento`),
  KEY `fk_partecipazione_evento_2_idx` (`user`),
  CONSTRAINT `fk_partecipazione_evento_1` FOREIGN KEY (`evento`) REFERENCES `evento` (`idevent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partecipazione_evento_2` FOREIGN KEY (`user`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partecipazione_evento`
--

LOCK TABLES `partecipazione_evento` WRITE;
/*!40000 ALTER TABLE `partecipazione_evento` DISABLE KEYS */;
INSERT INTO `partecipazione_evento` VALUES (1,'event_5b2d107e9cd3a','user_5af5aa1313f83'),(2,'event_5b2c27e811f66','user_5af5aa1313f83'),(3,'event_5b2c27e811f66','user_5af5aa1313f83'),(4,'event_5b2d107e9cd3a','user_5af5aa1313f83'),(5,'event_5b2d107e9cd3a','user_5af5aa1313f83');
/*!40000 ALTER TABLE `partecipazione_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload`
--

DROP TABLE IF EXISTS `upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload` (
  `uidimg` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(256) NOT NULL,
  `location` varchar(256) NOT NULL,
  PRIMARY KEY (`uidimg`),
  UNIQUE KEY `uidimg_UNIQUE` (`uidimg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload`
--

LOCK TABLES `upload` WRITE;
/*!40000 ALTER TABLE `upload` DISABLE KEYS */;
INSERT INTO `upload` VALUES ('11','10723781_774685949268923_1938210483_n.jpg',80935,'image/jpeg','../img/upload/10723781_774685949268923_1938210483_n.jpg'),('18','test',1,'test','test'),('5af3098a9528c','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af309bb79e24','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af30a6090997','sc.png',545704,'image/png','../img/upload/sc.png'),('5af30acfc39eb','IMG_1227.JPG',1670783,'image/jpeg','../img/upload/IMG_1227.JPG'),('5af30d1cca4bd','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a1b147f68','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a1ba035cf','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a21a26741','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a22ce7f46','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a2476ea49','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a2c8258dd','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a31435c05','10723781_774685949268923_1938210483_n.jpg',80935,'image/jpeg','../img/upload/10723781_774685949268923_1938210483_n.jpg'),('5af5a32b9e3e4','10723781_774685949268923_1938210483_n.jpg',80935,'image/jpeg','../img/upload/10723781_774685949268923_1938210483_n.jpg'),('5af5a4c454354','sc.png',545704,'image/png','../img/upload/sc.png'),('default_avatar1','default_avatar',391,'image/jpeg','../img/icon/account_circle_black.svg'),('img_5af5a4f0c32e1','10723781_774685949268923_1938210483_n.jpg',80935,'image/jpeg','../img/upload/10723781_774685949268923_1938210483_n.jpg'),('img_5af7205b3f37b','13924860_10202149481256244_2154816844915390999_n.jpg',232126,'image/jpeg','../img/upload/13924860_10202149481256244_2154816844915390999_n.jpg'),('img_5b06a0917ab20','13924860_10202149481256244_2154816844915390999_n.jpg',232126,'image/jpeg','../img/upload/13924860_10202149481256244_2154816844915390999_n.jpg'),('img_5b06a0a9d4274','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b06a1e338658','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b06a93fb7e03','IMG_1227.JPG',1670783,'image/jpeg','../img/upload/IMG_1227.JPG'),('img_5b06a950a0ba8','sc.png',545704,'image/png','../img/upload/sc.png'),('img_5b06a959012ad','13924860_10202149481256244_2154816844915390999_n.jpg',232126,'image/jpeg','../img/upload/13924860_10202149481256244_2154816844915390999_n.jpg'),('img_5b081f3d0e161','192111_10151072401537210_814203299_o.jpg',157070,'image/jpeg','../img/upload/192111_10151072401537210_814203299_o.jpg'),('img_5b087e978c342','IMG_1227.JPG',1670783,'image/jpeg','../img/upload/IMG_1227.JPG'),('img_5b087e9c704ba','13924860_10202149481256244_2154816844915390999_n.jpg',232126,'image/jpeg','../img/upload/13924860_10202149481256244_2154816844915390999_n.jpg'),('img_5b088056ba3b0','IMG_1227.JPG',1670783,'image/jpeg','../img/upload/IMG_1227.JPG'),('img_5b08805bd57f2','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b08ac8178bbc','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b08ac8b88ed1','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b08acb9585be','sc.png',545704,'image/png','../img/upload/sc.png'),('img_5b08acc1077d2','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b2c131f0b13f','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c17ec4afb2','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c18122e1d6','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c1849a8ed0','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c186c6a674','Schermata da 2018-06-20 17-14-46.png',575927,'image/png','../img/upload/Schermata da 2018-06-20 17-14-46.png'),('img_5b2c18e46d587','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c19362aa33','Schermata da 2018-06-20 17-04-17.png',553310,'image/png','../img/upload/Schermata da 2018-06-20 17-04-17.png'),('img_5b2c1a2be931b','Schermata da 2018-06-20 17-04-17.png',553310,'image/png','../img/upload/Schermata da 2018-06-20 17-04-17.png'),('img_5b2c1a40a37f1','Schermata da 2018-06-20 17-16-15.png',309633,'image/png','../img/upload/Schermata da 2018-06-20 17-16-15.png'),('img_5b2c1a63ea29c','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c1bb38cc78','Schermata da 2018-06-20 17-04-17.png',553310,'image/png','../img/upload/Schermata da 2018-06-20 17-04-17.png'),('img_5b2c1bd51262f','Schermata da 2018-06-20 17-14-46.png',575927,'image/png','../img/upload/Schermata da 2018-06-20 17-14-46.png'),('img_5b2c1bf1dd26c','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c1c158d4c0','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c1c446dbda','Schermata da 2018-06-20 17-14-46.png',575927,'image/png','../img/upload/Schermata da 2018-06-20 17-14-46.png'),('img_5b2c1c5d1b7ff','Schermata da 2018-06-20 17-16-15.png',309633,'image/png','../img/upload/Schermata da 2018-06-20 17-16-15.png'),('img_5b2c202d4d827','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c20ccee1ad','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c215648231','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c21cd3c617','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c2227490f8','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c227385420','Schermata da 2018-06-20 17-16-15.png',309633,'image/png','../img/upload/Schermata da 2018-06-20 17-16-15.png'),('img_5b2c22af1d315','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c22dd86477','Schermata da 2018-06-20 17-16-15.png',309633,'image/png','../img/upload/Schermata da 2018-06-20 17-16-15.png'),('img_5b2c232b1f739','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c23499b19a','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c2387aa669','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c27e811349','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c34743a349','Schermata da 2018-06-20 17-14-46.png',575927,'image/png','../img/upload/Schermata da 2018-06-20 17-14-46.png'),('img_5b2d1010008f1','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2d1042d2e78','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2d107e9c038','Screenshot-2018-6-6 Salvatore Cognetta su Instagram E pensare che fino a qualche giorno fa mi svegliavo con questo panorama[...](1).png',419275,'image/png','../img/upload/Screenshot-2018-6-6 Salvatore Cognetta su Instagram E pensare che fino a qualche giorno fa mi svegliavo con questo panorama[...](1).png'),('img_5b2d3bb4ebfaf','Screen Shot 2018-06-21 at 15.55.24.png',425061,'image/png','../img/upload/Screen Shot 2018-06-21 at 15.55.24.png'),('testimg_5b06a1ffbe066','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg');
/*!40000 ALTER TABLE `upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` varchar(256) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `idavatar` varchar(256) DEFAULT 'default_avatar1',
  PRIMARY KEY (`userid`),
  KEY `fk_img_idx` (`idavatar`),
  CONSTRAINT `fk_img` FOREIGN KEY (`idavatar`) REFERENCES `upload` (`uidimg`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('user_5af5aa1313f83','salvik','salvatore.cognetta@gmail.com','Salvatore Cognetta','pass','img_5b2d1042d2e78'),('user_5b06cd2db9f5a','akrapovic22','f22@gmail.com','Francesco Scaldarella','spigola','default_avatar1'),('user_5b07d75924c4e','drake','drake@c.c','sal','dakr','default_avatar1'),('user_5b081f08d3d12','Pasquale','pacopaky.pc@gmail.com','Pasquale Cognetta','55ViVo90','img_5b081f3d0e161');
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

-- Dump completed on 2018-06-23  4:23:47
