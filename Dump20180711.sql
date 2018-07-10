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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (1,'Notturno'),(2,'Sociale'),(3,'Mostra'),(4,'Festival'),(5,'Sagra'),(6,'Concerto');
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
  `description` varchar(2000) NOT NULL,
  `date` datetime NOT NULL,
  `price` decimal(5,2) DEFAULT '0.00',
  `numParticipants` int(11) DEFAULT '1',
  `city` varchar(45) NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  `uid_creator` varchar(45) NOT NULL,
  PRIMARY KEY (`idevent`),
  KEY `creator_event_idx` (`uid_creator`),
  KEY `fk_evento_2_idx` (`img`),
  CONSTRAINT `fk_evento_1` FOREIGN KEY (`uid_creator`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_2` FOREIGN KEY (`img`) REFERENCES `upload` (`uidimg`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES ('event_5b3273e43fb51','img_5b3273e43dd53','Argentina-Nigeria','as','2018-06-26 19:30:00',0.00,1,'Russia','Notturno','user_5b333d54e9d46'),('event_5b32740c9ad20','img_5b32740c994a6','Argentina-Nigeria','asbackground-color: #fafafa;\r\nbox-shadow: 0 3px 6px rgba(0, 0, 0, 0.082), 0 3px 6px rgba(0,0,0,0.13);','2018-06-26 19:30:00',0.00,1,'Russia','Notturno','user_5b333d54e9d46'),('event_5b327af970cf5','img_5b327af96ee89','Sardegna','Viaggio Sardegna','2018-07-27 21:30:00',40.00,5,'Santa Teresa Gallura','Notturno','user_5b333d54e9d46'),('event_5b32b3408c908','img_5b32b3408bd11','Consegna progetto','Consegna','2018-06-26 23:59:00',0.00,1,'Pisa','Notturno','user_5b333d54e9d46'),('event_5b32da80b9f00','img_5b32da80b8d6a','Esame Calcolatori','Esame orale','2018-07-06 09:30:00',0.00,2,'Pisa','Sociale','user_5b333d54e9d46'),('event_5b32ddf16c0c7','img_5b32ddf16b03a','Test img','Test	object-fit: cover;\r\naaaaaaaaaaaaaaaaaaaa','2018-06-29 13:30:00',0.00,3,'Pisa','Notturno','user_5b333d54e9d46'),('event_5b32dea68a4fc','img_5b32dea688a59','test2adsad','Test 2asdasd','2018-07-08 13:30:00',0.00,2,'Abbiategrasso','Notturno','user_5b333d54e9d46'),('event_5b335133f30e1','img_5b335133f21c1','Lorem Ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam maximus est ipsum, quis efficitur elit vestibulum ut. Cras ultricies dolor sit amet ligula porta bibendum. Pellentesque venenatis ultrices mollis. Duis id tincidunt mauris. Aliquam dolor ante, vulputate nec velit at, consectetur dapibus ','2018-06-29 13:30:00',0.00,2,'Roma','Notturno','user_5b334f8a5c464'),('event_5b3405ac11b93','img_5b3405ac0fcb2','Test','asd','2018-06-07 13:30:00',0.80,2,'Abano Terme','Notturno','user_5b334f8a5c464'),('event_5b34e0d8566c1','img_5b4116478b65c','Pisa','Consegna','2018-07-20 13:30:00',1.20,0,'Pisa','Notturno','user_5b3343ef48c82'),('event_5b361e97b90d5','img_5b361e97b8518','Belgio-Giappone',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus condimentum urna nec egestas scelerisque. Etiam non lectus ac eros faucibus lobortis. Mauris quis mi posuere, eleifend nisi a, ullamcorper magna. Etiam volutpat nibh quis ultrices gravida. Mauris non arcu semper, cursus tellus vitae, ','2018-07-01 20:30:00',0.00,2,'Pisa','Notturno','user_5b3343ef48c82'),('event_5b361f231e3c3','img_5b361f231d7bf','Test admin',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus condimentum urna nec egestas scelerisque. Etiam non lectus ac eros faucibus lobortis. Mauris quis mi posuere, eleifend nisi a, ullamcorper magna. Etiam volutpat nibh quis ultrices gravida. Mauris non arcu semper, cursus tellus vitae, ','2018-07-07 13:30:00',0.00,2,'Testico','Notturno','user_5b3343ef48c82'),('event_5b41f146cac03','img_5b41f146ca19f','Pasquale Ã¨ fess','img_5b41f146ca19f','0000-00-00 00:00:00',0.00,3,'img_5b41f146ca19f','2018-07-15 15:30:00','user_5b334f8a5c464'),('event_5b41f35253fc6','img_5b4363607b7c6','pisa',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nunc a ipsum tincidunt blandit. Proin tincidunt tincidunt dolor, ac sodales orci dapibus in. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce a justo viverra, bibendum ante non, rutrum nisl. Curabitur et nunc et orci consectetur malesuada a ac metus. Aenean ac turpis nec sapien ullamcorper convallis. Aenean non velit magna. Nullam sagittis neque nisl, nec aliquam felis lobortis nec. Sed faucibus, nisi vel aliquet dictum, diam arcu rhoncus eros, eu semper risus tortor eget purus. Integer eget cursus mauris, eget imperdiet elit. Nullam gravida consequat gravida.\r\n\r\nIn efficitur sed libero sit amet mattis. Aliquam ante justo, suscipit a feugiat blandit, suscipit eget tellus. In vitae orci ante. In luctus magna nec ante fringilla, vel ullamcorper magna efficitur. Aliquam vel massa egestas nulla euismod lacinia. Fusce elementum dolor sapien. Phasellus quis semper metus, et tristique nunc. Cras at est lobortis libero blandit rutrum. Nunc a rhoncus nulla, vel elementum nunc. Integer sit amet urna egestas, consequat massa facilisis, euismod justo. Morbi vel semper felis. Nulla massa nisi, hendrerit ac augue vitae, consectetur molestie nibh. Nunc rutrum, velit ut ultrices imperdiet, tellus tellus porta sem, sit amet lacinia sapien ligula a est. Nulla enim massa, tempus id risus ac, finibus pulvinar diam. Nullam bibendum, lorem vel posuere commodo, diam est rutrum dolor, at malesuada nisl libero non neque.\r\n\r\nSed eleifend, metus non volutpat aliquet, leo risus dignissim ligula, ac commodo erat urna sit amet est. Curabitur vitae porta nisl. Nullam et dictum lorem. Praesent eget tincidunt dolor. Proin tristique molestie venenatis. Nulla nibh orci, consectetur tristique fringilla aliquet, porttitor sit amet nunc. Fusce consectetur molestie nulla sit amet tempor. Integer eu sapien at libero rutrum maximus et ac magna.\r\n\r\nVestibulum id fermentum libero. Phasellus s','2018-07-20 13:30:00',5.00,2,'pisa','Notturno','user_5b334f8a5c464');
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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partecipazione_evento`
--

LOCK TABLES `partecipazione_evento` WRITE;
/*!40000 ALTER TABLE `partecipazione_evento` DISABLE KEYS */;
INSERT INTO `partecipazione_evento` VALUES (14,'event_5b3405ac11b93','user_5b334f8a5c464'),(15,'event_5b335133f30e1','user_5b334f8a5c464'),(22,'event_5b32da80b9f00','user_5b334f8a5c464'),(23,'event_5b32ddf16c0c7','user_5b334f8a5c464'),(33,'event_5b32ddf16c0c7','user_5b3343ef48c82'),(34,'event_5b361e97b90d5','user_5b3343ef48c82'),(38,'event_5b361f231e3c3','user_5b3343ef48c82'),(44,'event_5b327af970cf5','user_5b3fd951eba2e'),(45,'event_5b327af970cf5','user_5b3343ef48c82'),(52,'event_5b34e0d8566c1','user_5b334f8a5c464'),(55,'event_5b41f146cac03','user_5b334f8a5c464'),(56,'event_5b41f146cac03','user_5b334f8a5c464'),(57,'event_5b41f35253fc6','user_5b334f8a5c464'),(58,'event_5b327af970cf5','user_5b334f8a5c464');
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
  `location` varchar(45) NOT NULL,
  PRIMARY KEY (`uidimg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload`
--

LOCK TABLES `upload` WRITE;
/*!40000 ALTER TABLE `upload` DISABLE KEYS */;
INSERT INTO `upload` VALUES ('img_5b3273e43dd53','../img/upload/img_5b3273e43dd53.png'),('img_5b32740c994a6','../img/upload/img_5b32740c994a6.png'),('img_5b327af96ee89','../img/upload/img_5b327af96ee89.png'),('img_5b32af20a4378','../img/upload/img_5b32af20a4378.png'),('img_5b32b13342964','../img/upload/img_5b32b13342964.png'),('img_5b32b13e429a9','../img/upload/img_5b32b13e429a9.png'),('img_5b32b28ed916d','../img/upload/img_5b32b28ed916d.png'),('img_5b32b3408bd11','../img/upload/img_5b32b3408bd11.png'),('img_5b32c01f3ad48','../img/upload/img_5b32c01f3ad48.png'),('img_5b32c0b73d6f3','../img/upload/img_5b32c0b73d6f3.png'),('img_5b32c10ac722d','../img/upload/img_5b32c10ac722d.png'),('img_5b32c1121b3bd','../img/upload/img_5b32c1121b3bd.png'),('img_5b32da11e28b4','../img/upload/img_5b32da11e28b4.png'),('img_5b32da42b964e','../img/upload/img_5b32da42b964e.jpeg'),('img_5b32da80b8d6a','../img/upload/img_5b32da80b8d6a.jpeg'),('img_5b32ddf16b03a','../img/upload/img_5b32ddf16b03a.jpeg'),('img_5b32dea688a59','../img/upload/img_5b32dea688a59.jpeg'),('img_5b32ded0e8006','../img/upload/img_5b32ded0e8006.jpeg'),('img_5b334bca84923','../img/upload/img_5b334bca84923.jpeg'),('img_5b334cab8a1a0','../img/upload/img_5b334cab8a1a0.jpeg'),('img_5b334cd7a4cbc','../img/upload/img_5b334cd7a4cbc.jpeg'),('img_5b334f9b95999','../img/upload/img_5b334f9b95999.jpeg'),('img_5b335133f21c1','../img/upload/img_5b335133f21c1.jpeg'),('img_5b33dfc461a61','../img/upload/img_5b33dfc461a61.jpeg'),('img_5b3405ac0fcb2','../img/upload/img_5b3405ac0fcb2.jpeg'),('img_5b34888c8eddb','../img/upload/img_5b34888c8eddb.jpeg'),('img_5b34892c11878','../img/upload/img_5b34892c11878.jpeg'),('img_5b3489534a486','../img/upload/img_5b3489534a486.jpeg'),('img_5b34899a8725b','../img/upload/img_5b34899a8725b.jpeg'),('img_5b34e048db41b','../img/upload/img_5b34e048db41b.jpeg'),('img_5b34e0d85593a','../img/upload/img_5b34e0d85593a.jpeg'),('img_5b34e39f9db45','../img/upload/img_5b34e39f9db45.jpeg'),('img_5b34e8af92b2c','../img/upload/img_5b34e8af92b2c.jpeg'),('img_5b34e91b556c1','../img/upload/img_5b34e91b556c1.jpeg'),('img_5b34ed8bdc2df','../img/upload/img_5b34ed8bdc2df.jpeg'),('img_5b34eda746037','../img/upload/img_5b34eda746037.jpeg'),('img_5b34edcc6bd59','../img/upload/img_5b34edcc6bd59.jpeg'),('img_5b34ee2472722','../img/upload/img_5b34ee2472722.jpeg'),('img_5b34ee2fb9a6d','../img/upload/img_5b34ee2fb9a6d.jpeg'),('img_5b361e97b8518','../img/upload/img_5b361e97b8518.jpeg'),('img_5b361ee52a13a','../img/upload/img_5b361ee52a13a.jpeg'),('img_5b361ef76af7e','../img/upload/img_5b361ef76af7e.jpeg'),('img_5b361f00484c4','../img/upload/img_5b361f00484c4.jpeg'),('img_5b361f231d7bf','../img/upload/img_5b361f231d7bf.jpeg'),('img_5b3fd9a2989fa','../img/upload/img_5b3fd9a2989fa.jpeg'),('img_5b4116478b65c','../img/upload/img_5b4116478b65c.jpeg'),('img_5b41f050be5c5','../img/upload/img_5b41f050be5c5.jpeg'),('img_5b41f0581d001','../img/upload/img_5b41f0581d001.jpeg'),('img_5b41f146ca19f','../img/upload/img_5b41f146ca19f.jpeg'),('img_5b41f2cd2881d','../img/upload/img_5b41f2cd2881d.jpeg'),('img_5b41f331d67a6','../img/upload/img_5b41f331d67a6.jpeg'),('img_5b41f35252f98','../img/upload/img_5b41f35252f98.jpeg'),('img_5b436321c705e','../img/upload/img_5b436321c705e.jpeg'),('img_5b4363607b7c6','../img/upload/img_5b4363607b7c6.jpeg'),('img_default','../img/icon/img_default.png');
/*!40000 ALTER TABLE `upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploadImage`
--

DROP TABLE IF EXISTS `uploadImage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploadImage` (
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
-- Dumping data for table `uploadImage`
--

LOCK TABLES `uploadImage` WRITE;
/*!40000 ALTER TABLE `uploadImage` DISABLE KEYS */;
INSERT INTO `uploadImage` VALUES ('11','10723781_774685949268923_1938210483_n.jpg',80935,'image/jpeg','../img/upload/10723781_774685949268923_1938210483_n.jpg'),('18','test',1,'test','test'),('5af3098a9528c','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af309bb79e24','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af30a6090997','sc.png',545704,'image/png','../img/upload/sc.png'),('5af30acfc39eb','IMG_1227.JPG',1670783,'image/jpeg','../img/upload/IMG_1227.JPG'),('5af30d1cca4bd','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a1b147f68','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a1ba035cf','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a21a26741','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a22ce7f46','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a2476ea49','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a2c8258dd','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('5af5a31435c05','10723781_774685949268923_1938210483_n.jpg',80935,'image/jpeg','../img/upload/10723781_774685949268923_1938210483_n.jpg'),('5af5a32b9e3e4','10723781_774685949268923_1938210483_n.jpg',80935,'image/jpeg','../img/upload/10723781_774685949268923_1938210483_n.jpg'),('5af5a4c454354','sc.png',545704,'image/png','../img/upload/sc.png'),('default_avatar1','default_avatar',391,'image/jpeg','../img/icon/account_circle_black.svg'),('img_5af5a4f0c32e1','10723781_774685949268923_1938210483_n.jpg',80935,'image/jpeg','../img/upload/10723781_774685949268923_1938210483_n.jpg'),('img_5af7205b3f37b','13924860_10202149481256244_2154816844915390999_n.jpg',232126,'image/jpeg','../img/upload/13924860_10202149481256244_2154816844915390999_n.jpg'),('img_5b06a0917ab20','13924860_10202149481256244_2154816844915390999_n.jpg',232126,'image/jpeg','../img/upload/13924860_10202149481256244_2154816844915390999_n.jpg'),('img_5b06a0a9d4274','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b06a1e338658','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b06a93fb7e03','IMG_1227.JPG',1670783,'image/jpeg','../img/upload/IMG_1227.JPG'),('img_5b06a950a0ba8','sc.png',545704,'image/png','../img/upload/sc.png'),('img_5b06a959012ad','13924860_10202149481256244_2154816844915390999_n.jpg',232126,'image/jpeg','../img/upload/13924860_10202149481256244_2154816844915390999_n.jpg'),('img_5b081f3d0e161','192111_10151072401537210_814203299_o.jpg',157070,'image/jpeg','../img/upload/192111_10151072401537210_814203299_o.jpg'),('img_5b087e978c342','IMG_1227.JPG',1670783,'image/jpeg','../img/upload/IMG_1227.JPG'),('img_5b087e9c704ba','13924860_10202149481256244_2154816844915390999_n.jpg',232126,'image/jpeg','../img/upload/13924860_10202149481256244_2154816844915390999_n.jpg'),('img_5b088056ba3b0','IMG_1227.JPG',1670783,'image/jpeg','../img/upload/IMG_1227.JPG'),('img_5b08805bd57f2','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b08ac8178bbc','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b08ac8b88ed1','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b08acb9585be','sc.png',545704,'image/png','../img/upload/sc.png'),('img_5b08acc1077d2','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg'),('img_5b2c131f0b13f','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c17ec4afb2','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c18122e1d6','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c1849a8ed0','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c186c6a674','Schermata da 2018-06-20 17-14-46.png',575927,'image/png','../img/upload/Schermata da 2018-06-20 17-14-46.png'),('img_5b2c18e46d587','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c19362aa33','Schermata da 2018-06-20 17-04-17.png',553310,'image/png','../img/upload/Schermata da 2018-06-20 17-04-17.png'),('img_5b2c1a2be931b','Schermata da 2018-06-20 17-04-17.png',553310,'image/png','../img/upload/Schermata da 2018-06-20 17-04-17.png'),('img_5b2c1a40a37f1','Schermata da 2018-06-20 17-16-15.png',309633,'image/png','../img/upload/Schermata da 2018-06-20 17-16-15.png'),('img_5b2c1a63ea29c','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c1bb38cc78','Schermata da 2018-06-20 17-04-17.png',553310,'image/png','../img/upload/Schermata da 2018-06-20 17-04-17.png'),('img_5b2c1bd51262f','Schermata da 2018-06-20 17-14-46.png',575927,'image/png','../img/upload/Schermata da 2018-06-20 17-14-46.png'),('img_5b2c1bf1dd26c','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c1c158d4c0','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c1c446dbda','Schermata da 2018-06-20 17-14-46.png',575927,'image/png','../img/upload/Schermata da 2018-06-20 17-14-46.png'),('img_5b2c1c5d1b7ff','Schermata da 2018-06-20 17-16-15.png',309633,'image/png','../img/upload/Schermata da 2018-06-20 17-16-15.png'),('img_5b2c202d4d827','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c20ccee1ad','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c215648231','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c21cd3c617','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c2227490f8','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c227385420','Schermata da 2018-06-20 17-16-15.png',309633,'image/png','../img/upload/Schermata da 2018-06-20 17-16-15.png'),('img_5b2c22af1d315','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c22dd86477','Schermata da 2018-06-20 17-16-15.png',309633,'image/png','../img/upload/Schermata da 2018-06-20 17-16-15.png'),('img_5b2c232b1f739','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c23499b19a','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c2387aa669','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2c27e811349','dreamteam.jpg',77191,'image/jpeg','../img/upload/dreamteam.jpg'),('img_5b2c34743a349','Schermata da 2018-06-20 17-14-46.png',575927,'image/png','../img/upload/Schermata da 2018-06-20 17-14-46.png'),('img_5b2d1010008f1','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2d1042d2e78','pandino.jpg',74125,'image/jpeg','../img/upload/pandino.jpg'),('img_5b2d107e9c038','Screenshot-2018-6-6 Salvatore Cognetta su Instagram E pensare che fino a qualche giorno fa mi svegliavo con questo panorama[...](1).png',419275,'image/png','../img/upload/Screenshot-2018-6-6 Salvatore Cognetta su Instagram E pensare che fino a qualche giorno fa mi svegliavo con questo panorama[...](1).png'),('img_5b2d3bb4ebfaf','Screen Shot 2018-06-21 at 15.55.24.png',425061,'image/png','../img/upload/Screen Shot 2018-06-21 at 15.55.24.png'),('img_5b31349351fe8','sardo.jpg',41798,'image/jpeg','../img/upload/sardo.jpg'),('testimg_5b06a1ffbe066','sardegna la pelosa1.jpg',91727,'image/jpeg','../img/upload/sardegna la pelosa1.jpg');
/*!40000 ALTER TABLE `uploadImage` ENABLE KEYS */;
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
  `password` varchar(256) NOT NULL,
  `idavatar` varchar(256) DEFAULT 'img_default',
  PRIMARY KEY (`userid`),
  KEY `fk_img_idx` (`idavatar`),
  CONSTRAINT `fk_user_1` FOREIGN KEY (`idavatar`) REFERENCES `upload` (`uidimg`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('user_5b333d54e9d46','hash','hash@h.h','hash','$2y$10$09RK/q4Y5PuY22Jhn8NfVO385wSe5vKa31rTuZNaw0WhFk9I5mPje','img_default'),('user_5b3343ef48c82','admin','admin@bongo.it','Administrator','$2y$10$cR0o50yhjWeds4zh4IntD.w1ki.N8QXmTG/HmhdhLzJi1Z8VyYqMS','img_default'),('user_5b334f8a5c464','salvik','salvatore.cognetta@gmail.com','Salvatore Cognetta','$2y$10$JdY.VSlMeYRrR3ujCtM4YegNc4tQDBJbQJfYoG8lBuTaOE2o1/msK','img_5b41f0581d001'),('user_5b3fd951eba2e','tommyscal','tommy@gmail.com','Tommasina Scaldarella','$2y$10$q09Je/dmJtB/ZVatjBQLsO0y12q4ol//8remP2HuYjdr7RAnhsnyO','img_5b3fd9a2989fa'),('user_5b4363106e07b','geniodelsecolo','klitonfx@gmail.com','Kliton bare','$2y$10$9kn49QDAQWCibJ2hS924d.g6lZHtGKtM.98LCaAcKb1ZIWC5o1qca','img_default');
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

-- Dump completed on 2018-07-11  1:38:09
