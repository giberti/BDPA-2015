-- MySQL dump 10.13  Distrib 5.5.25a, for osx10.6 (i386)
--
-- Host: localhost    Database: BDPAFinalProject
-- ------------------------------------------------------
-- Server version	5.5.25a

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
-- Table structure for table `bicycles`
--

DROP TABLE IF EXISTS `bicycles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bicycles` (
  `BicycleID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Manufacturer` varchar(30) DEFAULT NULL,
  `Type` varchar(20) DEFAULT NULL,
  `Speeds` int(11) DEFAULT NULL,
  `TireSizeInches` int(11) DEFAULT NULL,
  `ImageUrl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`BicycleID`),
  KEY `UserIDType` (`UserID`,`Type`),
  KEY `Type` (`Type`,`BicycleID`),
  KEY `ManufacturerType` (`Manufacturer`,`Type`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routes` (
  `RouteID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(10) unsigned NOT NULL,
  `Name` varchar(128) DEFAULT NULL,
  `Description` text,
  `Distance` float DEFAULT NULL,
  `Difficulty` varchar(10) DEFAULT NULL,
  `Type` varchar(15) DEFAULT NULL,
  `MapImageURL` varchar(255) DEFAULT NULL,
  `DateRidden` datetime NOT NULL,
  `DateAdded` datetime NOT NULL,
  PRIMARY KEY (`RouteID`),
  KEY `RouteRideOrder` (`DateRidden`,`DateAdded`,`RouteID`),
  KEY `TypeName` (`Type`,`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tips`
--

DROP TABLE IF EXISTS `tips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tips` (
  `TipID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Text` mediumtext,
  `DateAdded` datetime NOT NULL,
  PRIMARY KEY (`TipID`),
  KEY `UserID` (`UserID`,`TipID`),
  KEY `DateAdded` (`DateAdded`),
  KEY `Type` (`Type`,`DateAdded`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UserID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `EmailAddress` varchar(128) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `PasswordHash` varchar(40) DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(30) DEFAULT NULL,
  `State` varchar(2) DEFAULT NULL,
  `ZipCode` varchar(10) DEFAULT NULL,
  `PhoneNumber` varchar(10) DEFAULT NULL,
  `PhotoURL` varchar(255) DEFAULT NULL,
  `DateAdded` datetime NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `LastFirstNames` (`LastName`,`FirstName`),
  KEY `EmailAddress` (`EmailAddress`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-06 19:48:24
