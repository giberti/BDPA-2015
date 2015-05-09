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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bicycles`
--

LOCK TABLES `bicycles` WRITE;
/*!40000 ALTER TABLE `bicycles` DISABLE KEYS */;
INSERT INTO `bicycles` VALUES (1,1,'Giant','Road',12,27,''),(2,2,'Mongoose','Mountain',18,26,''),(3,3,'Huffy','Fixie',1,27,''),(4,4,'Specialized','Fixie',1,26,''),(5,5,'Mongoose','Mountain',24,26,''),(6,6,'Bianchi','BMX',1,20,''),(7,7,'Huffy','Cyclocross',12,27,''),(8,8,'Surly','Mountain',12,27,''),(9,9,'Mongoose','Cyclocross',12,27,''),(10,10,'Surly','Fixie',1,26,''),(11,11,'Bianchi','Cruiser',16,27,''),(12,12,'Trek','Mountain',18,27,''),(13,13,'Huffy','Fixie',1,26,''),(14,14,'Huffy','Mountain',10,26,''),(15,15,'Surly','Cruiser',16,27,''),(16,16,'Giant','Road',16,27,''),(17,17,'Mongoose','Cruiser',12,27,''),(18,18,'Surly','Fixie',1,26,''),(19,19,'Surly','BMX',1,20,''),(20,20,'Huffy','Fixie',1,26,''),(21,21,'Mongoose','Mountain',16,27,''),(22,22,'Trek','Fixie',1,26,''),(23,11,'Specialized','Road',24,27,''),(24,14,'Specialized','Cruiser',10,27,''),(25,16,'Specialized','Road',12,26,''),(26,5,'Specialized','BMX',1,20,''),(27,16,'Trek','BMX',1,20,''),(28,1,'Specialized','Cyclocross',10,27,''),(29,9,'Mongoose','Fixie',1,27,''),(30,10,'Mongoose','Cruiser',18,26,''),(31,22,'Giant','Fixie',1,27,''),(32,5,'Trek','Road',10,27,''),(33,21,'Trek','Fixie',1,26,''),(34,14,'Bianchi','Fixie',1,26,''),(35,4,'Mongoose','Cyclocross',16,27,''),(36,4,'Surly','Road',12,27,''),(37,9,'Specialized','Road',10,26,''),(38,7,'Giant','BMX',1,20,''),(39,19,'Specialized','Cruiser',18,26,''),(40,14,'Surly','Mountain',12,26,''),(41,19,'Huffy','Cruiser',18,27,''),(42,15,'Huffy','Cruiser',12,26,''),(43,22,'Mongoose','Cyclocross',18,26,''),(44,20,'Huffy','Cruiser',24,26,''),(45,21,'Mongoose','Fixie',1,27,'');
/*!40000 ALTER TABLE `bicycles` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (1,1,'Douglas Trail','This trail stretches from Olmsted County to Goodhue. It\'s a paved trail that works it\'s way through woodlands and fields along an old railroad bed. It\'s a mostly flat trail.',12.5,'Easy','Paved Trail','images/routes/douglas-trail.png','0000-00-00 00:00:00','2015-05-08 21:51:12'),(2,1,'Cascade Lake Trail','A beautiful paved trail winding through Cascade lakes and wildflower prairie. Provides easy access to Cascade river trail and downtown as well as northwest rochester via the newly constructed pedestrian and bicycle bridge over Highway-14. Can be combined with the West Circle Drive and the US-52 to make a nice loop.',2.5,'Easy','Paved Trail','images/routes/cascade-lake.png','0000-00-00 00:00:00','2015-05-08 22:27:45');
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tips`
--

LOCK TABLES `tips` WRITE;
/*!40000 ALTER TABLE `tips` DISABLE KEYS */;
INSERT INTO `tips` VALUES (1,22,'Safety','Remember to always wear your helmet when riding!','2015-05-08 12:16:54'),(2,6,'Endurance','Bring a granola bar for rides over 1 hour','2015-05-08 15:19:17'),(3,9,'Safety','Wear reflective clothing and use a headlight and tail light when riding at night','2015-05-08 17:24:04'),(4,3,'Safety','Stay on the right side of the road','2015-05-08 02:24:55'),(5,7,'Safety','Check your tire pressures before every ride and set to the appropriate level before leaving.','2015-05-08 12:05:28'),(6,10,'Safety','Watch for drivers who may suddenly open their door when riding alongside parked cars. They might open doors when your least expect it.','2015-05-08 03:18:55'),(7,12,'Safety','Stay alert, keep an eye out for obstacles in your path.','2015-05-08 19:27:48'),(8,8,'Safety','Use hand signals to tell other cyclists and cars what your intentions are at intersections or when deviating from your current direction','2015-05-08 11:11:23'),(9,16,'Safey','Obey all traffic signals and signs. Bicycles have to follow the same rules of the road as cars!','2015-05-08 11:18:08'),(10,16,'Safey','Don\'t be distracted while riding. Cellphones and music can divert your attention and cause accidents.','2015-05-08 15:25:05'),(11,7,'Saftey','Plan your route in advance! Check out our routes if you need help','2015-05-08 20:09:43'),(12,8,'Safey','If riding alone, make sure someone knows where you are going and when you expect to be back','2015-05-08 13:39:35'),(13,18,'Equipment','A cyclo-computer is a great way to keep track of your distance and time riding as well as your current speed. ','2015-05-08 17:04:34'),(14,6,'Equipment','Saddle bags are great for keeping a spare tire tube and some basic tools. If it\'s big enough, you might be able to stick a snack in it too and leave the backpack at home!','2015-05-08 08:29:55'),(15,21,'Maintenance','Nylon tire levers are better than metal ones. Metal can damage the wheel more easily.','2015-05-08 23:44:31'),(16,6,'Maintenance','Always keep your tires properly inflated for easier riding and less wear on the tire','2015-05-08 22:55:27'),(17,7,'Maintenance','Clean and lube your chain once a month or after a particularly dirty ride. It will last longer and so will your shifters.','2015-05-08 05:35:28'),(18,4,'Equipment','A bike light is nice if you ride before sunrise and after sunset. In addition to seeing where you are going, it helps others see you! Don\'t forget to buy a rear light too!','2015-05-08 00:34:11'),(19,18,'Equipment','It may not seem necessary but a cycling jersey is nice. It has pockets on the back to hold snacks and things like cell phones where they won\'t obstruct your legs or fall out when riding','2015-05-08 17:55:49'),(20,7,'Equipment','Buy a water bottle if you plan to ride more than a couple of miles at a time. ','2015-05-08 13:24:22'),(21,10,'Equipment','Gloves can be nice if riding in cooler weather. Most cycling gloves also have padding in the palm and wrist which reduces fatigue from riding.','2015-05-08 11:57:12');
/*!40000 ALTER TABLE `tips` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'James','Tube','jtube@bdpastudents.com',15,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','19 Timetrial Ln.','Rochester','MN','55904','5075554491','','2015-05-05 21:15:13'),(2,'Ava','Chain','achain@bdpastudents.com',11,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','36 4th Ave','Rochester','MN','55903','5075555832','','2015-05-08 22:52:02'),(3,'Susane','Spoke','sspoke@bdpastudents.com',10,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','242 4th Ave','Rochester','MN','55902','5075555913','','2015-05-08 22:52:02'),(4,'Ahmed','Shoes','ashoes@bdpastudents.com',10,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','194 Center St.','Rochester','MN','55903','5075552798','','2015-05-08 22:52:02'),(5,'Dan','Shoes','dshoes@bdpastudents.com',12,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','130 6th Ave','Rochester','MN','55904','5075554710','','2015-05-08 22:52:02'),(6,'Emily','Crank','ecrank@bdpastudents.com',10,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','17 3rd Ave','Rochester','MN','55902','5075554921','','2015-05-08 22:52:02'),(7,'Ethan','Handlebar','ehandlebar@bdpastudents.com',17,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','54 10th Ave.','Rochester','MN','55903','5075556388','','2015-05-08 22:52:02'),(8,'Ahmed','Pedal','apedal@bdpastudents.com',13,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','70 3rd Ave','Rochester','MN','55904','5075555337','','2015-05-08 22:52:02'),(9,'Kim','Jersey','kjersey@bdpastudents.com',16,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','80 5th Ave','Rochester','MN','55904','5075551260','','2015-05-08 22:52:02'),(10,'Dan','Crank','dcrank@bdpastudents.com',12,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','131 Mayowood Tr.','Rochester','MN','55901','5075559631','','2015-05-08 22:52:02'),(11,'Emily','Sprocket','esprocket@bdpastudents.com',16,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','197 Peleton Way','Rochester','MN','55902','5075552502','','2015-05-08 22:52:02'),(12,'Mia','Seatpost','mseatpost@bdpastudents.com',18,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','252 3rd Ave','Rochester','MN','55904','5075554916','','2015-05-08 23:01:21'),(13,'Susane','Pedal','spedal@bdpastudents.com',13,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','178 5th Ave','Rochester','MN','55903','5075556318','','2015-05-08 23:01:21'),(14,'Alex','Handlebar','ahandlebar@bdpastudents.com',12,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','88 Singletrack Ln.','Rochester','MN','55901','5075554011','','2015-05-08 23:01:21'),(15,'Kristy','Shoes','kshoes@bdpastudents.com',16,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','252 3rd Ave','Rochester','MN','55904','5075556446','','2015-05-08 23:01:21'),(16,'James','Crank','jcrank@bdpastudents.com',12,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','73 Chainbreaker Ct.','Rochester','MN','55902','5075552850','','2015-05-08 23:01:21'),(17,'Mark','Sprocket','msprocket@bdpastudents.com',14,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','223 2nd Ave.','Rochester','MN','55904','5075558571','','2015-05-08 23:01:21'),(18,'Joe','Sunscreen','jsunscreen@bdpastudents.com',18,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','84 2nd Ave.','Rochester','MN','55902','5075555932','','2015-05-08 23:01:21'),(19,'Chris','Tube','ctube@bdpastudents.com',17,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','229 9th Ave','Rochester','MN','55902','5075557146','','2015-05-08 23:01:21'),(20,'Dan','Pedal','dpedal@bdpastudents.com',18,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','76 10th Ave.','Rochester','MN','55902','5075559208','','2015-05-08 23:01:21'),(21,'Matt','Chain','mchain@bdpastudents.com',14,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','199 1st Ave.','Rochester','MN','55901','5075557333','','2015-05-08 23:01:21'),(22,'Brian','Shorts','bshorts@bdpastudents.com',10,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','73 9th Ave','Rochester','MN','55902','5075558525','','2015-05-08 23:01:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-08 23:44:07
