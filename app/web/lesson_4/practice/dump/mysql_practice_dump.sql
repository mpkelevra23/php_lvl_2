-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: geekbrains
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `Customers`
--

DROP TABLE IF EXISTS `Customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(32) DEFAULT NULL,
  `secondName` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Customers_telephone_uindex` (`telephone`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customers`
--

LOCK TABLES `Customers` WRITE;
/*!40000 ALTER TABLE `Customers` DISABLE KEYS */;
INSERT INTO `Customers` VALUES (1,'Александр','Иванов','+7-920-123-45-67'),(2,'Дмитрий','Петров','+7-495-123-45-67'),(3,'Елена','Козлова','+7-920-765-43-21');
/*!40000 ALTER TABLE `Customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Books`
--

DROP TABLE IF EXISTS `Books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Books` (
  `bookId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `authors` varchar(500) DEFAULT NULL,
  `pageCount` int(4) DEFAULT NULL,
  PRIMARY KEY (`bookId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Books`
--

LOCK TABLES `Books` WRITE;
/*!40000 ALTER TABLE `Books` DISABLE KEYS */;
INSERT INTO `Books` VALUES (1,'Золотые сказки','Александр Сергеевич Пушкин',128),(2,'ASP.NET MVC 4','Джес Чедвик, Тодд Снайдер',432),(3,'LINQ. Язык интегрированных запросов','Адам Фримен, Джозеф С. Раттц',656),(4,'Сказки Старого Вильнюса','Макс Фрай',480),(5,'Реверс','Сергей Лукьяненко, Александр Громов',353);
/*!40000 ALTER TABLE `Books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Addresses`
--

DROP TABLE IF EXISTS `Addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Addresses` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(30) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `postcode` int(6) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  CONSTRAINT `Addresses_Customers_id_fk` FOREIGN KEY (`userId`) REFERENCES `Customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Addresses`
--

LOCK TABLES `Addresses` WRITE;
/*!40000 ALTER TABLE `Addresses` DISABLE KEYS */;
INSERT INTO `Addresses` VALUES (1,'Москва','Ленинский проспект 68 - 34',119296),(2,'Москва','Хавская 3 - 128',115162),(3,'Санкт-Петербург','Тамбовская - 47',192007);
/*!40000 ALTER TABLE `Addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `bookId` int(11) DEFAULT NULL,
  `dateOrder` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`),
  KEY `Orders_Books_fk` (`bookId`),
  KEY `Orders_Customers_fk` (`userId`),
  CONSTRAINT `Orders_Books_fk` FOREIGN KEY (`bookId`) REFERENCES `Books` (`bookId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Orders_Customers_fk` FOREIGN KEY (`userId`) REFERENCES `Customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (1,1,1,'2013-04-18 14:56:00'),(2,2,2,'2013-02-11 09:18:00'),(3,2,3,'2013-02-25 19:44:00'),(4,1,4,'0013-05-02 14:12:00'),(5,1,5,'2013-03-12 08:25:00'),(6,3,1,'2013-04-12 12:56:00'),(7,3,2,'2013-04-14 10:11:00');
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-27 20:28:17
