-- Progettazione Web 
DROP DATABASE if exists eventi_bongo; 
CREATE DATABASE eventi_bongo; 
USE eventi_bongo; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: eventi_bongo
-- ------------------------------------------------------
-- Server version	5.6.20

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
  `nome` varchar(256) NOT NULL,
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
  `title` varchar(256) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date` datetime NOT NULL,
  `price` decimal(5,2) DEFAULT '0.00',
  `numParticipants` int(11) DEFAULT '1',
  `city` varchar(45) NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  `uid_creator` varchar(256) NOT NULL,
  PRIMARY KEY (`idevent`),
  KEY `creator_event_idx` (`uid_creator`),
  KEY `fk_evento_2_idx` (`img`),
  CONSTRAINT `fk_evento_1` FOREIGN KEY (`uid_creator`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_evento_2` FOREIGN KEY (`img`) REFERENCES `upload` (`uidimg`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES ('event_5b4c8113e8e92','img_5b4c8113e6d11','Fuochi di Ferragosto','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque a sagittis tortor. Vivamus ut erat quis odio vestibulum lacinia ac eu sem. Ut ultrices justo nibh, sit amet fringilla leo cursus in. Integer a augue ut sapien eleifend suscipit. Nam sed facilisis ipsum. Vivamus tempus molestie sagittis. Nullam in ipsum tincidunt, venenatis lectus eu, sollicitudin lorem. Nulla ac metus justo. Donec lobortis sodales purus, non pulvinar mi. Nulla dignissim, leo eu laoreet dignissim, urna dolor condimentum risus, et scelerisque odio risus at lorem.\r\n\r\nCras eu velit sed lorem pellentesque congue a ut leo. Pellentesque eget quam elit. Duis ac neque placerat mi blandit faucibus sed at dolor. Cras tincidunt elit a elit blandit imperdiet. Ut libero mauris, varius eget ornare eget, volutpat ac tellus. Phasellus porttitor leo eros, a maximus dui dictum et. Pellentesque nec eleifend quam, id gravida nulla. Aliquam eleifend nec ligula non rutrum.\r\n\r\nNullam et turpis nulla. Donec nec accumsan dolor. Donec ornare laoreet dignissim. Quisque consectetur, nunc ut pretium efficitur, diam tellus facilisis sem, eu fringilla odio lorem a odio. Sed dapibus felis nisi, at condimentum nunc congue a. Donec nunc massa, aliquam a pretium id, commodo nec turpis. Mauris diam dui, hendrerit consequat interdum quis, scelerisque vel urna. Pellentesque ultrices laoreet orci faucibus accumsan. Integer a lectus sit amet nisl imperdiet placerat. Fusce convallis tellus ac ex pulvinar tristique. Etiam dapibus eleifend lectus. Donec tincidunt molestie venenatis. Sed vel ullamcorper sem, et bibendum augue. Aliquam ut pretium sem.\r\n','2018-08-15 22:30:00',0.00,3,'Pisa','Notturno','user_5b4c7f677636c'),('event_5b4c819de2cc6','img_5b4c819de0f16','Gran Premio di Formula 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque a sagittis tortor. Vivamus ut erat quis odio vestibulum lacinia ac eu sem. Ut ultrices justo nibh, sit amet fringilla leo cursus in. Integer a augue ut sapien eleifend suscipit. Nam sed facilisis ipsum. Vivamus tempus molestie sagittis. Nullam in ipsum tincidunt, venenatis lectus eu, sollicitudin lorem. Nulla ac metus justo. Donec lobortis sodales purus, non pulvinar mi. Nulla dignissim, leo eu laoreet dignissim, urna dolor condimentum risus, et scelerisque odio risus at lorem.\r\n\r\nCras eu velit sed lorem pellentesque congue a ut leo. Pellentesque eget quam elit. Duis ac neque placerat mi blandit faucibus sed at dolor. Cras tincidunt elit a elit blandit imperdiet. Ut libero mauris, varius eget ornare eget, volutpat ac tellus. Phasellus porttitor leo eros, a maximus dui dictum et. Pellentesque nec eleifend quam, id gravida nulla. Aliquam eleifend nec ligula non rutrum.\r\n\r\nNullam et turpis nulla. Donec nec accumsan dolor. Donec ornare laoreet dignissim. Quisque consectetur, nunc ut pretium efficitur, diam tellus facilisis sem, eu fringilla odio lorem a odio. Sed dapibus felis nisi, at condimentum nunc congue a. Donec nunc massa, aliquam a pretium id, commodo nec turpis. Mauris diam dui, hendrerit consequat interdum quis, scelerisque vel urna. Pellentesque ultrices laoreet orci faucibus accumsan. Integer a lectus sit amet nisl imperdiet placerat. Fusce convallis tellus ac ex pulvinar tristique. Etiam dapibus eleifend lectus. Donec tincidunt molestie venenatis. Sed vel ullamcorper sem, et bibendum augue. Aliquam ut pretium sem.\r\n','2018-09-02 14:10:00',100.00,2,'Monza','Festival','user_5b4c7f677636c'),('event_5b4c82c94e02f','img_5b4c82c94c0a0','Ferragosto','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque a sagittis tortor. Vivamus ut erat quis odio vestibulum lacinia ac eu sem. Ut ultrices justo nibh, sit amet fringilla leo cursus in. Integer a augue ut sapien eleifend suscipit. Nam sed facilisis ipsum. Vivamus tempus molestie sagittis. Nullam in ipsum tincidunt, venenatis lectus eu, sollicitudin lorem. Nulla ac metus justo. Donec lobortis sodales purus, non pulvinar mi. Nulla dignissim, leo eu laoreet dignissim, urna dolor condimentum risus, et scelerisque odio risus at lorem.\r\n\r\nCras eu velit sed lorem pellentesque congue a ut leo. Pellentesque eget quam elit. Duis ac neque placerat mi blandit faucibus sed at dolor. Cras tincidunt elit a elit blandit imperdiet. Ut libero mauris, varius eget ornare eget, volutpat ac tellus. Phasellus porttitor leo eros, a maximus dui dictum et. Pellentesque nec eleifend quam, id gravida nulla. Aliquam eleifend nec ligula non rutrum.\r\n\r\nNullam et turpis nulla. Donec nec accumsan dolor. Donec ornare laoreet dignissim. Quisque consectetur, nunc ut pretium efficitur, diam tellus facilisis sem, eu fringilla odio lorem a odio. Sed dapibus felis nisi, at condimentum nunc congue a. Donec nunc massa, aliquam a pretium id, commodo nec turpis. Mauris diam dui, hendrerit consequat interdum quis, scelerisque vel urna. Pellentesque ultrices laoreet orci faucibus accumsan. Integer a lectus sit amet nisl imperdiet placerat. Fusce convallis tellus ac ex pulvinar tristique. Etiam dapibus eleifend lectus. Donec tincidunt molestie venenatis. Sed vel ullamcorper sem, et bibendum augue. Aliquam ut pretium sem.\r\n','2018-08-15 13:30:00',0.00,2,'Santa Teresa Gallura','Sociale','user_5b4c7f677636c'),('event_5b4c8333f2afe','img_5b4c8333efe7a','Mostra museo del calcolo','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque a sagittis tortor. Vivamus ut erat quis odio vestibulum lacinia ac eu sem. Ut ultrices justo nibh, sit amet fringilla leo cursus in. Integer a augue ut sapien eleifend suscipit. Nam sed facilisis ipsum. Vivamus tempus molestie sagittis. Nullam in ipsum tincidunt, venenatis lectus eu, sollicitudin lorem. Nulla ac metus justo. Donec lobortis sodales purus, non pulvinar mi. Nulla dignissim, leo eu laoreet dignissim, urna dolor condimentum risus, et scelerisque odio risus at lorem.\r\n\r\nCras eu velit sed lorem pellentesque congue a ut leo. Pellentesque eget quam elit. Duis ac neque placerat mi blandit faucibus sed at dolor. Cras tincidunt elit a elit blandit imperdiet. Ut libero mauris, varius eget ornare eget, volutpat ac tellus. Phasellus porttitor leo eros, a maximus dui dictum et. Pellentesque nec eleifend quam, id gravida nulla. Aliquam eleifend nec ligula non rutrum.\r\n\r\nNullam et turpis nulla. Donec nec accumsan dolor. Donec ornare laoreet dignissim. Quisque consectetur, nunc ut pretium efficitur, diam tellus facilisis sem, eu fringilla odio lorem a odio. Sed dapibus felis nisi, at condimentum nunc congue a. Donec nunc massa, aliquam a pretium id, commodo nec turpis. Mauris diam dui, hendrerit consequat interdum quis, scelerisque vel urna. Pellentesque ultrices laoreet orci faucibus accumsan. Integer a lectus sit amet nisl imperdiet placerat. Fusce convallis tellus ac ex pulvinar tristique. Etiam dapibus eleifend lectus. Donec tincidunt molestie venenatis. Sed vel ullamcorper sem, et bibendum augue. Aliquam ut pretium sem.\r\n','2018-07-21 13:30:00',0.00,3,'Pisa','Mostra','user_5b4c7f677636c'),('event_5b4c8436b71c7','img_5b4c8436b52fc','Evento Test','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque a sagittis tortor. Vivamus ut erat quis odio vestibulum lacinia ac eu sem. Ut ultrices justo nibh, sit amet fringilla leo cursus in. Integer a augue ut sapien eleifend suscipit. Nam sed facilisis ipsum. Vivamus tempus molestie sagittis. Nullam in ipsum tincidunt, venenatis lectus eu, sollicitudin lorem. Nulla ac metus justo. Donec lobortis sodales purus, non pulvinar mi. Nulla dignissim, leo eu laoreet dignissim, urna dolor condimentum risus, et scelerisque odio risus at lorem.\r\n\r\nCras eu velit sed lorem pellentesque congue a ut leo. Pellentesque eget quam elit. Duis ac neque placerat mi blandit faucibus sed at dolor. Cras tincidunt elit a elit blandit imperdiet. Ut libero mauris, varius eget ornare eget, volutpat ac tellus. Phasellus porttitor leo eros, a maximus dui dictum et. Pellentesque nec eleifend quam, id gravida nulla. Aliquam eleifend nec ligula non rutrum.\r\n\r\nNullam et turpis nulla. Donec nec accumsan dolor. Donec ornare laoreet dignissim. Quisque consectetur, nunc ut pretium efficitur, diam tellus facilisis sem, eu fringilla odio lorem a odio. Sed dapibus felis nisi, at condimentum nunc congue a. Donec nunc massa, aliquam a pretium id, commodo nec turpis. Mauris diam dui, hendrerit consequat interdum quis, scelerisque vel urna. Pellentesque ultrices laoreet orci faucibus accumsan. Integer a lectus sit amet nisl imperdiet placerat. Fusce convallis tellus ac ex pulvinar tristique. Etiam dapibus eleifend lectus. Donec tincidunt molestie venenatis. Sed vel ullamcorper sem, et bibendum augue. Aliquam ut pretium sem.\r\n','2018-07-20 20:30:00',0.00,2,'Pisa','Sociale','user_5b4c8354d8046');
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partecipazione_evento`
--

LOCK TABLES `partecipazione_evento` WRITE;
/*!40000 ALTER TABLE `partecipazione_evento` DISABLE KEYS */;
INSERT INTO `partecipazione_evento` VALUES (61,'event_5b4c8113e8e92','user_5b4c7f677636c'),(62,'event_5b4c819de2cc6','user_5b4c7f677636c'),(63,'event_5b4c82c94e02f','user_5b4c7f677636c'),(64,'event_5b4c8333f2afe','user_5b4c7f677636c'),(65,'event_5b4c8333f2afe','user_5b4c8354d8046'),(66,'event_5b4c8113e8e92','user_5b4c8354d8046'),(67,'event_5b4c8436b71c7','user_5b4c8354d8046');
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
  `location` varchar(256) NOT NULL,
  PRIMARY KEY (`uidimg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload`
--

LOCK TABLES `upload` WRITE;
/*!40000 ALTER TABLE `upload` DISABLE KEYS */;
INSERT INTO `upload` VALUES ('img_5b4c8113e6d11','../img/upload/img_5b4c8113e6d11.jpeg'),('img_5b4c819de0f16','../img/upload/img_5b4c819de0f16.jpeg'),('img_5b4c82c94c0a0','../img/upload/img_5b4c82c94c0a0.jpeg'),('img_5b4c8333efe7a','../img/upload/img_5b4c8333efe7a.jpeg'),('img_5b4c83d77e035','../img/upload/img_5b4c83d77e035.jpeg'),('img_5b4c8436b52fc','../img/upload/img_5b4c8436b52fc.jpeg'),('img_default','../img/img_default.jpg');
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
INSERT INTO `user` VALUES ('user_5b4c7f677636c','salvik','salvatore.cognetta@gmail.com','Salvatore Cognetta','$2y$10$O0RgH.Lm/jvmGx53ULTaYeggIfC9o9lYDXBzGtFLuGux4088tQlIm','img_5b4c83d77e035'),('user_5b4c8354d8046','admin','admin@admin.com','Administrator','$2y$10$iI2GeY/VBM4ZQzy7Up5oTOTG2YLqibsQly7Vwnj/nqzoq61B3wuEK','img_default');
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

-- Dump completed on 2018-07-16 14:14:46
