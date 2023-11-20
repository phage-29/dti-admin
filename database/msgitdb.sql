-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 10.20.12.32    Database: msgitdb
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'ICT Equipment Services'),(2,'Network Services'),(3,'Software/ System/ Application'),(4,'Activity-Based Assistance'),(5,'Account Management'),(6,'Others');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divisions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Division` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'ORD'),(2,'CPD'),(3,'IDD'),(4,'BDD'),(5,'FAD'),(6,'DTI Aklan'),(7,'DTI Antique'),(8,'DTI Capiz'),(9,'DTI Guimaras'),(10,'DTI Iloilo'),(11,'DTI Negros Occidental');
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Equipment` varchar(255) NOT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Brand` varchar(100) DEFAULT NULL,
  `Model` varchar(100) DEFAULT NULL,
  `SerialNumber` varchar(50) DEFAULT NULL,
  `DatePurchased` date DEFAULT NULL,
  `Warranty` date DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'In Storage',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpdesks`
--

DROP TABLE IF EXISTS `helpdesks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpdesks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `RequestNo` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `DivisionID` int NOT NULL,
  `DateRequested` date NOT NULL,
  `RequestType` enum('ICT Helpdesk','ICT Maintenance') DEFAULT 'ICT Helpdesk',
  `PropertyNo` varchar(45) DEFAULT NULL,
  `CategoryID` int NOT NULL,
  `SubCategoryID` int NOT NULL,
  `Complaints` text NOT NULL,
  `DateReceived` date DEFAULT NULL,
  `ReceivedBy` int DEFAULT NULL,
  `DateScheduled` date DEFAULT NULL,
  `RepairType` enum('Minor','Major') DEFAULT 'Minor',
  `DatetimeStarted` datetime DEFAULT NULL,
  `DatetimeFinished` datetime DEFAULT NULL,
  `Diagnosis` text,
  `Remarks` text,
  `ServicedBy` int DEFAULT NULL,
  `ApprovedBy` int DEFAULT NULL,
  `Status` enum('Pending','On Going','Completed','Denied','Cancelled','Unserviceable') DEFAULT 'Pending',
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DatePreferred` date DEFAULT NULL,
  `TimePreferred` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `RequestNo_UNIQUE` (`RequestNo`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks`
--

LOCK TABLES `helpdesks` WRITE;
/*!40000 ALTER TABLE `helpdesks` DISABLE KEYS */;
INSERT INTO `helpdesks` VALUES (1,'REQ-2307-00001','Anelyn ','Apiag','misr6.dti@gmail.com',10,'2023-07-11','ICT Helpdesk','',1,3,'Printing problem','2023-07-11',1,'2023-07-11','Minor','2023-07-11 00:00:00','2023-07-11 00:00:00','Check the printer setting','done',1,1,'Completed','2023-07-10 16:00:00','2023-11-20 06:19:59',NULL,NULL),(2,'REQ-2307-00002','Ariane','Reyes','misr6.dti@gmail.com',2,'2023-07-27','ICT Helpdesk','',1,1,'Logging PC','2023-07-27',1,'2023-07-27','Minor','2023-07-27 00:00:00','2023-07-27 00:00:00','Upgrading to SSD','Done & Functional',1,1,'Completed','2023-07-26 16:00:00','2023-11-20 04:53:26',NULL,NULL),(3,'REQ-2307-00003','Aurora Teresa','Alisen','AuroraTeresaAlisen@dti.gov.ph',3,'2023-07-31','ICT Helpdesk','',1,1,'Display freezing an start up','2023-07-31',1,'2023-07-31','Minor','2023-07-31 00:00:00','2023-07-31 00:00:00','Loose RAM and hard disk apply erasure an RAM \'s pin','done',1,1,'Completed','2023-07-30 16:00:00','2023-11-20 04:53:26',NULL,NULL),(4,'REQ-2307-00004','Bella','Bonto','BellaBonto@dti.gov.ph',5,'2023-07-11','ICT Helpdesk','',4,17,'Excel','2023-07-11',1,'2023-07-11','Minor','2023-07-11 00:00:00','2023-07-11 00:00:00','Adjust for printing and scanning','done',1,1,'Completed','2023-07-10 16:00:00','2023-11-20 06:19:59',NULL,NULL),(5,'REQ-2307-00005','Bella','Bonto','BellaBonto@dti.gov.ph',5,'2023-07-18','ICT Helpdesk','',4,17,'Excel','2023-07-18',1,'2023-07-18','Minor','2023-07-18 00:00:00','2023-07-18 00:00:00','Adjust printing range for printing','done',1,1,'Completed','2023-07-17 16:00:00','2023-11-20 06:19:59',NULL,NULL),(6,'REQ-2307-00006','Cathy','Pascua','CathyPascua@dti.gov.ph',3,'2023-07-17','ICT Helpdesk','',1,1,'Need assistance for pre-recorded message of ARD Rachel','2023-07-17',1,'2023-07-17','Minor','2023-07-17 00:00:00','2023-07-17 00:00:00','Set-up camera and record wioth the help of Ma\'am Judy sajo','done',1,1,'Completed','2023-07-16 16:00:00','2023-11-20 04:53:26',NULL,NULL),(7,'REQ-2307-00007','Cathy','Pascua','CathyPascua@dti.gov.ph',3,'2023-07-07','ICT Helpdesk','',1,1,'keyboard keys not working and printer Installation','2023-07-07',1,'2023-07-07','Minor','2023-07-07 00:00:00','2023-07-07 00:00:00','Explore keyboard and reinstall driver','done',1,1,'Completed','2023-07-06 16:00:00','2023-11-20 04:53:26',NULL,NULL),(8,'REQ-2307-00008','Ma. Dorita','Chavez','MaDoritaChavez@dti.gov.ph',10,'2023-07-31','ICT Helpdesk','',1,1,'Low Battery','2023-07-31',1,'2023-07-31','Minor','2023-07-31 00:00:00','2023-07-31 00:00:00','Turn off the UPS when not using','done',1,1,'Completed','2023-07-30 16:00:00','2023-11-20 04:53:26',NULL,NULL),(9,'REQ-2307-00009','Elain Angel','Dagang','misr6.dti@gmail.com',10,'2023-07-26','ICT Helpdesk','',1,1,'Unserviciable Network drivers, office application, services and undetected network adapters','2023-07-26',1,'2023-07-26','Minor','2023-07-26 00:00:00','2023-07-26 00:00:00','Tried to reinsatll drivers but failed, cloned the files, install new\n and transfer the files, install the necessary applictaions','done',1,1,'Completed','2023-07-25 16:00:00','2023-11-20 04:53:26',NULL,NULL),(10,'REQ-2307-00010','Elain Angel','Dagang','misr6.dti@gmail.com',10,'2023-07-31','ICT Helpdesk','',1,1,'Unserviciable Network drivers, office application, services and undetected network adapters','2023-07-31',1,'2023-07-31','Minor','2023-07-31 00:00:00','2023-07-31 00:00:00','','',1,1,'Completed','2023-07-30 16:00:00','2023-11-20 04:53:26',NULL,NULL),(11,'REQ-2307-00011','Glecita ','Sojonia','misr6.dti@gmail.com',5,'2023-07-25','ICT Helpdesk','',1,1,'Mouse','2023-07-25',1,'2023-07-25','Minor','2023-07-25 00:00:00','2023-07-25 00:00:00','Replace new mouse','done',1,1,'Completed','2023-07-24 16:00:00','2023-11-20 04:53:26',NULL,NULL),(12,'REQ-2307-00012','Glecita ','Sojonia','misr6.dti@gmail.com',5,'2023-07-11','ICT Helpdesk','',1,1,'Paper jammed','2023-07-11',1,'2023-07-11','Minor','2023-07-11 00:00:00','2023-07-11 00:00:00','Check and removed the jammep paper','done',1,1,'Completed','2023-07-10 16:00:00','2023-11-20 04:53:26',NULL,NULL),(13,'REQ-2307-00013','Glenda','Loloy','misr6.dti@gmail.com',3,'2023-07-07','ICT Helpdesk','',1,1,'Printer','2023-07-07',1,'2023-07-07','Minor','2023-07-07 00:00:00','2023-07-07 00:00:00','Transfer and ste-up','done',1,1,'Completed','2023-07-06 16:00:00','2023-11-20 04:53:26',NULL,NULL),(14,'REQ-2307-00014','Jeryl','Glory','misr6.dti@gmail.com',10,'2023-07-12','ICT Helpdesk','',1,1,'OS and defectivez HDD','2023-07-12',1,'2023-07-12','Minor','2023-07-12 00:00:00','2023-07-12 00:00:00','Reformat and add a separate HDD for OS','done',1,1,'Completed','2023-07-11 16:00:00','2023-11-20 04:53:26',NULL,NULL),(15,'REQ-2307-00015','Jeryl','Glory','misr6.dti@gmail.com',10,'2023-07-28','ICT Helpdesk','',1,1,'Setuo PCA for online appluication and fix network','2023-07-28',1,'2023-07-28','Minor','2023-07-28 00:00:00','2023-07-28 00:00:00','Connect all cables and ibnsert network adapter','done',1,1,'Completed','2023-07-27 16:00:00','2023-11-20 04:53:26',NULL,NULL),(16,'REQ-2307-00016','Johna Raf','Montalvo','misr6.dti@gmail.com',4,'2023-07-09','ICT Helpdesk','',1,1,'Inaccessible Folder','2023-07-09',1,'2023-07-09','Minor','2023-07-09 00:00:00','2023-07-09 00:00:00','Scan drive, fix drive, duplication files to the root folder','done',1,1,'Completed','2023-07-08 16:00:00','2023-11-20 04:53:26',NULL,NULL),(17,'REQ-2307-00017','Johna Raf','Montalvo','misr6.dti@gmail.com',4,'2023-07-24','ICT Helpdesk','',1,1,'Ink notification shows no ink','2023-07-24',1,'2023-07-24','Minor','2023-07-24 00:00:00','2023-07-24 00:00:00','Reset ink notification','done',1,1,'Completed','2023-07-23 16:00:00','2023-11-20 04:53:26',NULL,NULL),(18,'REQ-2307-00018','Joy Ann ','Erazo','JoyAnnErazo@dti.gov.ph',10,'2023-07-08','ICT Helpdesk','',1,1,'No booitable device dected','2023-07-08',1,'2023-07-08','Minor','2023-07-08 00:00:00','2023-07-08 00:00:00','Open lid and tighten the chord, rearrnge and transfer the unit','done',1,1,'Completed','2023-07-07 16:00:00','2023-11-20 04:53:26',NULL,NULL),(19,'REQ-2307-00019','Judith','Kelly','JudithKelly@dti.gov.ph',3,'2023-07-26','ICT Helpdesk','',1,1,'Broken parts on printer feeder','2023-07-26',1,'2023-07-26','Minor','2023-07-26 00:00:00','2023-07-26 00:00:00','Replace broken parts with span parts stached','done',1,1,'Completed','2023-07-25 16:00:00','2023-11-20 04:53:26',NULL,NULL),(20,'REQ-2307-00020','Ma. Kristine','Rosaldes','MaKristineRosaldes@dti.gov.ph',5,'2023-07-17','ICT Helpdesk','',1,1,'eNgas-Installation','2023-07-17',1,'2023-07-17','Minor','2023-07-17 00:00:00','2023-07-17 00:00:00','eNgas-Installation','done',1,1,'Completed','2023-07-16 16:00:00','2023-11-20 04:53:26',NULL,NULL),(21,'REQ-2307-00021','Ma. Dorita','Chavez','MaDoritaChavez@dti.gov.ph',10,'2023-07-08','ICT Helpdesk','',1,1,'No signal or No Display','2023-07-08',1,'2023-07-08','Minor','2023-07-08 00:00:00','2023-07-08 00:00:00','Move the  VGA from built in to the video card','done',1,1,'Completed','2023-07-07 16:00:00','2023-11-20 04:53:26',NULL,NULL),(22,'REQ-2307-00022','May Ann ','Arca','misr6.dti@gmail.com',4,'2023-07-26','ICT Helpdesk','',1,1,'Printer unrecognized and pauesd activity','2023-07-26',1,'2023-07-26','Minor','2023-07-26 00:00:00','2023-07-26 00:00:00','Reinstall driver and configure printer preference','done',1,1,'Completed','2023-07-25 16:00:00','2023-11-20 04:53:26',NULL,NULL),(23,'REQ-2307-00023','Rhea Jeppee','Legario','RheaJepeeLegario@dti.gov.ph',10,'2023-07-06','ICT Helpdesk','',1,1,'Printer softhware problem Epson scan 2 unavaible','2023-07-06',1,'2023-07-06','Minor','2023-07-06 00:00:00','2023-07-06 00:00:00','Restart, Reinstall scanner and initialize','done',1,1,'Completed','2023-07-05 16:00:00','2023-11-20 04:53:26',NULL,NULL),(24,'REQ-2307-00024','Rhea Jeppee','Legario','RheaJepeeLegario@dti.gov.ph',10,'2023-07-26','ICT Helpdesk','',1,1,'Low Battery','2023-07-26',1,'2023-07-26','Minor','2023-07-26 00:00:00','2023-07-26 00:00:00','Change new battery /Turn oof the UPS the when not using','done',1,1,'Completed','2023-07-25 16:00:00','2023-11-20 04:53:26',NULL,NULL),(25,'REQ-2307-00025','Rgeyzia Marie','Elgario','misr6.dti@gmail.com',10,'2023-07-14','ICT Helpdesk','',1,1,'Prinetr don\'t print color magenta','2023-07-14',1,'2023-07-14','Minor','2023-07-14 00:00:00','2023-07-14 00:00:00','Flash clean the printer head','done',1,1,'Completed','2023-07-13 16:00:00','2023-11-20 04:53:26',NULL,NULL),(26,'REQ-2307-00026','Rodolfo','Genillo','misr6.dti@gmail.com',10,'2023-07-31','ICT Helpdesk','',1,1,'Detective adapter','2023-07-31',1,'2023-07-31','Minor','2023-07-31 00:00:00','2023-07-31 00:00:00','Replace adapter','done',1,1,'Completed','2023-07-30 16:00:00','2023-11-20 04:53:26',NULL,NULL),(27,'REQ-2308-00001','Sherlyn','Canales','misr6.dti@gmail.com',10,'2023-08-20','ICT Helpdesk','',1,1,'Printing problem','2023-08-20',1,'2023-08-20','Minor','2023-08-20 00:00:00','2023-08-20 00:00:00','Check the printer setting','done',1,1,'Completed','2023-08-19 16:00:00','2023-11-20 04:53:26',NULL,NULL),(28,'REQ-2308-00002','Sherlyn','Canales','misr6.dti@gmail.com',10,'2023-08-19','ICT Helpdesk','',1,1,'Logging PC','2023-08-19',1,'2023-08-19','Minor','2023-08-19 00:00:00','2023-08-19 00:00:00','Upgrading to SSD','Done & Functional',1,1,'Completed','2023-08-18 16:00:00','2023-11-20 04:53:26',NULL,NULL),(29,'REQ-2308-00003','Sherlyn','Canales','misr6.dti@gmail.com',10,'2023-08-18','ICT Helpdesk','',1,1,'Display freezing an start up','2023-08-18',1,'2023-08-18','Minor','2023-08-18 00:00:00','2023-08-18 00:00:00','Loose RAM and hard disk apply erasure an RAM \'s pin','done',1,1,'Completed','2023-08-17 16:00:00','2023-11-20 04:53:26',NULL,NULL),(30,'REQ-2308-00004','Sherlyn','Canales','misr6.dti@gmail.com',10,'2023-08-05','ICT Helpdesk','',1,1,'Excel','2023-08-05',1,'2023-08-05','Minor','2023-08-05 00:00:00','2023-08-05 00:00:00','Adjust for printing and scanning','done',1,1,'Completed','2023-08-04 16:00:00','2023-11-20 04:53:26',NULL,NULL),(31,'REQ-2308-00005','Therese Grace','Marla','ThereseGraceMarla@dti.gov.ph',2,'2023-08-26','ICT Helpdesk','',1,1,'Excel','2023-08-26',1,'2023-08-26','Minor','2023-08-26 00:00:00','2023-08-26 00:00:00','Adjust printing range for printing','done',1,1,'Completed','2023-08-25 16:00:00','2023-11-20 04:53:26',NULL,NULL),(32,'REQ-2308-00006','Anna Theodora','Panim','misr6.dti@gmail.com',10,'2023-08-16','ICT Helpdesk','',1,1,'Need assistance for pre-recorded message of ARD Rachel','2023-08-16',1,'2023-08-16','Minor','2023-08-16 00:00:00','2023-08-16 00:00:00','Set-up camera and record wioth the help of Ma\'am Judy sajo','done',1,1,'Completed','2023-08-15 16:00:00','2023-11-20 04:53:26',NULL,NULL),(33,'REQ-2308-00007','Ariane','Reyes','misr6.dti@gmail.com',2,'2023-08-09','ICT Helpdesk','',1,1,'keyboard keys not working and printer Installation','2023-08-09',1,'2023-08-09','Minor','2023-08-09 00:00:00','2023-08-09 00:00:00','Explore keyboard and reinstall driver','done',1,1,'Completed','2023-08-08 16:00:00','2023-11-20 04:53:26',NULL,NULL),(34,'REQ-2308-00008','Bella','Bonto','BellaBonto@dti.gov.ph',5,'2023-08-01','ICT Helpdesk','',1,1,'Low Battery','2023-08-01',1,'2023-08-01','Minor','2023-08-01 00:00:00','2023-08-01 00:00:00','Turn off the UPS when not using','done',1,1,'Completed','2023-07-31 16:00:00','2023-11-20 04:53:26',NULL,NULL),(35,'REQ-2308-00009','Bella','Bonto','BellaBonto@dti.gov.ph',5,'2023-08-31','ICT Helpdesk','',1,1,'Unserviciable Network drivers, office application, services and undetected network adapters','2023-08-31',1,'2023-08-31','Minor','2023-08-31 00:00:00','2023-08-31 00:00:00','Tried to reinsatll drivers but failed, cloned the files, install new\n and transfer the files, install the necessary applictaions','done',1,1,'Completed','2023-08-30 16:00:00','2023-11-20 04:53:26',NULL,NULL),(36,'REQ-2308-00010','Bella','Bonto','BellaBonto@dti.gov.ph',5,'2023-08-01','ICT Helpdesk','',1,1,'Unserviciable Network drivers, office application, services and undetected network adapters','2023-08-01',1,'2023-08-01','Minor','2023-08-01 00:00:00','2023-08-01 00:00:00','','',1,1,'Completed','2023-07-31 16:00:00','2023-11-20 04:53:26',NULL,NULL),(37,'REQ-2308-00011','Dorita','Chavez','MaDoritaChavez@dti.gov.ph',10,'2023-08-07','ICT Helpdesk','',1,1,'Mouse','2023-08-07',1,'2023-08-07','Minor','2023-08-07 00:00:00','2023-08-07 00:00:00','Replace new mouse','done',1,1,'Completed','2023-08-06 16:00:00','2023-11-20 04:53:26',NULL,NULL),(38,'REQ-2308-00012','Jeryll','Glory','misr6.dti@gmail.com',10,'2023-08-07','ICT Helpdesk','',1,1,'Paper jammed','2023-08-07',1,'2023-08-07','Minor','2023-08-07 00:00:00','2023-08-07 00:00:00','Check and removed the jammep paper','done',1,1,'Completed','2023-08-06 16:00:00','2023-11-20 04:53:26',NULL,NULL),(39,'REQ-2308-00013','Johna Raf','Montalvo','misr6.dti@gmail.com',4,'2023-08-22','ICT Helpdesk','',1,1,'Printer','2023-08-22',1,'2023-08-22','Minor','2023-08-22 00:00:00','2023-08-22 00:00:00','Transfer and ste-up','done',1,1,'Completed','2023-08-21 16:00:00','2023-11-20 04:53:26',NULL,NULL),(40,'REQ-2308-00014','Joy Ann ','Erazo','JoyAnnErazo@dti.gov.ph',10,'2023-08-07','ICT Helpdesk','',1,1,'OS and defectivez HDD','2023-08-07',1,'2023-08-07','Minor','2023-08-07 00:00:00','2023-08-07 00:00:00','Reformat and add a separate HDD for OS','done',1,1,'Completed','2023-08-06 16:00:00','2023-11-20 04:53:26',NULL,NULL),(41,'REQ-2308-00015','Joy Ann ','Erazo','JoyAnnErazo@dti.gov.ph',10,'2023-08-22','ICT Helpdesk','',1,1,'Setuo PCA for online appluication and fix network','2023-08-22',1,'2023-08-22','Minor','2023-08-22 00:00:00','2023-08-22 00:00:00','Connect all cables and ibnsert network adapter','done',1,1,'Completed','2023-08-21 16:00:00','2023-11-20 04:53:26',NULL,NULL),(42,'REQ-2308-00016','Joy Ann ','Erazo','JoyAnnErazo@dti.gov.ph',10,'2023-08-22','ICT Helpdesk','',1,1,'Inaccessible Folder','2023-08-22',1,'2023-08-22','Minor','2023-08-22 00:00:00','2023-08-22 00:00:00','Scan drive, fix drive, duplication files to the root folder','done',1,1,'Completed','2023-08-21 16:00:00','2023-11-20 04:53:26',NULL,NULL),(43,'REQ-2308-00017','May Ann ','Arca','misr6.dti@gmail.com',4,'2023-08-23','ICT Helpdesk','',1,1,'Ink notification shows no ink','2023-08-23',1,'2023-08-23','Minor','2023-08-23 00:00:00','2023-08-23 00:00:00','Reset ink notification','done',1,1,'Completed','2023-08-22 16:00:00','2023-11-20 04:53:26',NULL,NULL),(44,'REQ-2308-00018','Mia','Aujero','misr6.dti@gmail.com',2,'2023-08-15','ICT Helpdesk','',1,1,'No booitable device dected','2023-08-15',1,'2023-08-15','Minor','2023-08-15 00:00:00','2023-08-15 00:00:00','Open lid and tighten the chord, rearrnge and transfer the unit','done',1,1,'Completed','2023-08-14 16:00:00','2023-11-20 04:53:26',NULL,NULL),(45,'REQ-2308-00019','Mia','Aujero','misr6.dti@gmail.com',2,'2023-08-29','ICT Helpdesk','',1,1,'Broken parts on printer feeder','2023-08-29',1,'2023-08-29','Minor','2023-08-29 00:00:00','2023-08-29 00:00:00','Replace broken parts with span parts stached','done',1,1,'Completed','2023-08-28 16:00:00','2023-11-20 04:53:26',NULL,NULL),(46,'REQ-2308-00020','Shyne Mae','Bernales','misr6.dti@gmail.com',10,'2023-08-22','ICT Helpdesk','',1,1,'eNgas-Installation','2023-08-22',1,'2023-08-22','Minor','2023-08-22 00:00:00','2023-08-22 00:00:00','eNgas-Installation','done',1,1,'Completed','2023-08-21 16:00:00','2023-11-20 04:53:26',NULL,NULL),(47,'REQ-2309-00001','Bleessed Grace','Penaflodia','misr6.dti@gmail.com',10,'2023-09-05','ICT Helpdesk','',1,1,'No internet Access','2023-09-05',1,'2023-09-05','Minor','2023-09-05 00:00:00','2023-09-05 00:00:00','Connect to the network Internet','done',1,1,'Completed','2023-08-19 16:00:00','2023-11-20 04:53:26',NULL,NULL),(48,'REQ-2309-00002','Jeanne Renee','Nedula','misr6.dti@gmail.com',1,'2023-09-28','ICT Helpdesk','',1,1,'Monitor no display','2023-09-28',1,'2023-09-28','Minor','2023-09-28 00:00:00','2023-09-28 00:00:00','Cord connect again','done',1,1,'Completed','2023-08-18 16:00:00','2023-08-18 16:00:00',NULL,NULL),(49,'REQ-2309-00003','Faith ','Cercado','misr6.dti@gmail.com',3,'2023-09-11','ICT Helpdesk','',1,1,'Lost connection monitor','2023-09-11',1,'2023-09-11','Minor','2023-09-11 00:00:00','2023-09-11 00:00:00','remove the connector and return again to the system units','done',1,1,'Completed','2023-08-17 16:00:00','2023-11-20 04:53:26',NULL,NULL),(50,'REQ-2309-00004','Jonathan','Benedicto','misr6.dti@gmail.com',5,'2023-09-18','ICT Helpdesk','',1,1,'DTR','2023-09-18',1,'2023-09-18','Minor','2023-09-18 00:00:00','2023-09-18 00:00:00','DTR Enrollment of driver','done',1,1,'Completed','2023-08-04 16:00:00','2023-11-20 04:53:26',NULL,NULL),(51,'REQ-2309-00005','Jonathan','Tejida','JonathanTejida@dti.gov.ph',10,'2023-09-13','ICT Helpdesk','',1,1,'Require attention','2023-09-13',1,'2023-09-13','Minor','2023-09-13 00:00:00','2023-09-13 00:00:00','Troubleshot printer','done',1,1,'Completed','2023-08-25 16:00:00','2023-11-20 04:53:26',NULL,NULL),(52,'REQ-2309-00006','Judy ','Sajo','JudySajo@dti.gov.ph',1,'2023-09-05','ICT Helpdesk','',1,1,'Technical asssistance presconference with regional director','2023-09-05',1,'2023-09-05','Minor','2023-09-05 00:00:00','2023-09-05 00:00:00','Technical asssistance presconference with regional director','done',1,1,'Completed','2023-08-15 16:00:00','2023-08-15 16:00:00',NULL,NULL),(53,'REQ-2309-00007','Lyndy Exyle','Miranda','LyndyExzyleDemegillo@dti.gov.ph',5,'2023-09-19','ICT Helpdesk','',1,1,'Print Banding','2023-09-19',1,'2023-09-19','Minor','2023-09-19 00:00:00','2023-09-19 00:00:00','Power Flash','done',1,1,'Completed','2023-08-08 16:00:00','2023-11-20 04:53:26',NULL,NULL),(54,'REQ-2309-00008','Lyndy Exyle','Miranda','LyndyExzyleDemegillo@dti.gov.ph',5,'2023-09-26','ICT Helpdesk','',1,1,'Print Banding','2023-09-26',1,'2023-09-26','Minor','2023-09-26 00:00:00','2023-09-26 00:00:00','Power Flash','done',1,1,'Completed','2023-07-31 16:00:00','2023-11-20 04:53:26',NULL,NULL),(55,'REQ-2309-00009','Dorita','Chavez','MaDoritaChavez@dti.gov.ph',10,'2023-09-23','ICT Helpdesk','',1,1,'Damaged hinge holder','2023-09-23',1,'2023-09-23','Minor','2023-09-23 00:00:00','2023-09-23 00:00:00','Repair the damaged plastic mold by apply epoxy qand wit until ,it harded','done',1,1,'Completed','2023-08-30 16:00:00','2023-11-20 04:53:26',NULL,NULL),(56,'REQ-2309-00010','May Ann ','Arca','misr6.dti@gmail.com',4,'2023-09-14','ICT Helpdesk','',1,1,'Keyboard detected','2023-09-14',1,'2023-09-14','Minor','2023-09-14 00:00:00','2023-09-14 00:00:00','Restart pc and insert keyboard','done',1,1,'Completed','2023-07-31 16:00:00','2023-11-20 04:53:26',NULL,NULL),(57,'REQ-2309-00011','May Ann ','Arca','misr6.dti@gmail.com',4,'2023-09-14','ICT Helpdesk','',1,1,'keyboard not detected','2023-09-14',1,'2023-09-14','Minor','2023-09-14 00:00:00','2023-09-14 00:00:00','Format PC','done',1,1,'Completed','2023-08-06 16:00:00','2023-11-20 04:53:26',NULL,NULL),(58,'REQ-2309-00012','May Ann ','Arca','misr6.dti@gmail.com',4,'2023-09-14','ICT Helpdesk','',1,1,'Inaccessible keyboard and maintenance','2023-09-14',1,'2023-09-14','Minor','2023-09-14 00:00:00','2023-09-14 00:00:00','Reset settings and apps and uninstall unnecessary application lastly optimized and the setup','done',1,1,'Completed','2023-08-06 16:00:00','2023-11-20 04:53:26',NULL,NULL),(59,'REQ-2309-00013','Rhea Jeppee','Legario','RheaJepeeLegario@dti.gov.ph',10,'2023-09-28','ICT Helpdesk','',1,1,'No Power','2023-09-28',1,'2023-09-28','Minor','2023-09-28 00:00:00','2023-09-28 00:00:00','Low Voltage Battery','done',1,1,'Completed','2023-08-21 16:00:00','2023-11-20 04:53:26',NULL,NULL),(60,'REQ-2309-00014','Rheyzia Maria','Elgario','misr6.dti@gmail.com',10,'2023-09-18','ICT Helpdesk','',1,1,'DTR','2023-09-18',1,'2023-09-18','Minor','2023-09-18 00:00:00','2023-09-18 00:00:00','DTR Enrollment of DMO','done',1,1,'Completed','2023-08-06 16:00:00','2023-11-20 04:53:26',NULL,NULL),(61,'REQ-2309-00015','Yollanda','Gallenero','YollandaGallenero@dti.gov.ph',4,'2023-09-20','ICT Helpdesk','',1,1,'No internet connection','2023-09-20',1,'2023-09-20','Minor','2023-09-20 00:00:00','2023-09-20 00:00:00','Troubleshot internet connection','done',1,1,'Completed','2023-08-21 16:00:00','2023-11-20 04:53:26',NULL,NULL),(62,'REQ-2310-00001','Anelyn ','Apiag','misr6.dti@gmail.com',10,'2023-10-03','ICT Helpdesk','',1,1,'No printing driver','2023-10-03',1,'2023-10-03','Minor','2023-10-03 09:15:00','2023-10-03 09:15:00','Installing printer driver','done',1,1,'Completed','2023-10-02 16:00:00','2023-11-20 04:53:26',NULL,NULL),(63,'REQ-2310-00002','Analyn','Apiag','misr6.dti@gmail.com',10,'2023-10-03','ICT Helpdesk','',1,1,'No printer driver','2023-10-03',1,'2023-10-03','Minor','2023-10-03 00:00:00','2023-10-03 00:00:00','No printer driver/ installing priter driver install printer driver','done',1,1,'Completed','2023-10-02 16:00:00','2023-11-20 04:53:26',NULL,NULL),(64,'REQ-2310-00003','Anne','Tortal','misr6.dti@gmail.com',10,'2023-10-16','ICT Helpdesk','',1,1,'System update','2023-10-16',1,'2023-10-16','Minor','2023-10-16 00:00:00','2023-10-16 00:00:00','Update the system','done',1,1,'Completed','2023-10-15 16:00:00','2023-11-20 04:53:26',NULL,NULL),(65,'REQ-2310-00004','Anne','Tortal','misr6.dti@gmail.com',10,'2023-10-03','ICT Helpdesk','',1,1,'No internet','2023-10-03',1,'2023-10-03','Minor','2023-10-03 00:00:00','2023-10-03 00:00:00','Connected to Wifi but no internet connection/Reset the Wifi driver','done',1,1,'Completed','2023-10-02 16:00:00','2023-11-20 04:53:26',NULL,NULL),(66,'REQ-2310-00005','Bleessed Grace','Penaflodia','misr6.dti@gmail.com',10,'2023-10-13','ICT Helpdesk','',1,1,'No portable device','2023-10-13',1,'2023-10-13','Minor','2023-10-13 00:00:00','2023-10-13 00:00:00','install new Windows','done',1,1,'Completed','2023-10-12 16:00:00','2023-11-20 04:53:26',NULL,NULL),(67,'REQ-2310-00006','Bleessed Grace','Penaflodia','misr6.dti@gmail.com',10,'2023-10-13','ICT Helpdesk','',1,1,'PC update','2023-10-13',1,'2023-10-13','Minor','2023-10-13 00:00:00','2023-10-13 00:00:00','Update windiows','done',1,1,'Completed','2023-10-12 16:00:00','2023-11-20 04:53:26',NULL,NULL),(68,'REQ-2310-00007','Jeanne Renee','Nedula','misr6.dti@gmail.com',1,'2023-10-05','ICT Helpdesk','',1,1,'Paper jammed','2023-10-05',1,'2023-10-05','Minor','2023-10-05 00:00:00','2023-10-05 00:00:00','Remove the jammed paper','done',1,1,'Completed','2023-10-04 16:00:00','2023-10-04 16:00:00',NULL,NULL),(69,'REQ-2310-00008','Emily','Pasaporte','EmilyPasaporte.dti@gmail.com',5,'2023-10-04','ICT Helpdesk','',2,5,'Error Payroll','2023-10-04',1,'2023-10-04','Minor','2023-10-04 00:00:00','2023-10-04 00:00:00','Realign the IP address of the payroll system ','done',1,1,'Completed','2023-10-03 16:00:00','2023-11-20 04:56:40',NULL,NULL),(70,'REQ-2310-00009','Joy Ann ','Erazo','JoyAnnErazo@dti.gov.com',10,'2023-10-19','ICT Helpdesk','',1,3,'Missing color','2023-10-19',1,'2023-10-19','Minor','2023-10-19 00:00:00','2023-10-19 00:00:00','Uninstalled old driver and place, multiple head cleaning using epson resetter','done',1,1,'Completed','2023-10-18 16:00:00','2023-11-20 04:56:40',NULL,NULL),(71,'REQ-2310-00010','Lyndy Exyle','Miranda','LyndyExzyleDemegillo@dti.gov.ph',5,'2023-10-23','ICT Helpdesk','',1,2,'Updating of operating system and other drivers','2023-10-23',1,'2023-10-23','Minor','2023-10-23 00:00:00','2023-10-23 00:00:00','Updated operating system and the driver','done',1,1,'Completed','2023-10-22 16:00:00','2023-11-20 04:56:40',NULL,NULL),(72,'REQ-2310-00011','Ma. Kristine','Rosaldes','MaKristineRosaldes@dti.gov.ph',5,'2023-10-04','ICT Helpdesk','',1,3,'Printer error ','2023-10-04',1,'2023-10-04','Minor','2023-10-04 00:00:00','2023-10-04 00:00:00','Foreign object inside the printer/Remove the foreign object abnd test the printer for functionality','done',1,1,'Completed','2023-10-03 16:00:00','2023-11-20 04:56:40',NULL,NULL),(73,'REQ-2310-00012','Ma. Kristine','Rosaldes','MaKristineRosaldes@dti.gov.ph',5,'2023-10-19','ICT Helpdesk','',3,13,'Notation of forticlient VPN','2023-10-19',1,'2023-10-19','Minor','2023-10-19 00:00:00','2023-10-19 00:00:00','Reinstall forticlient VPN connect account for VPN ','done',1,1,'Completed','2023-10-18 16:00:00','2023-11-20 04:56:40',NULL,NULL),(74,'REQ-2310-00013','Ma. Rose','Jayona','misr6.dti@gmail.com',10,'2023-10-11','ICT Helpdesk','',1,3,'Outdate printer driver','2023-10-11',1,'2023-10-11','Minor','2023-10-11 00:00:00','2023-10-11 00:00:00','Update the printer driver','done',1,1,'Completed','2023-10-10 16:00:00','2023-11-20 04:56:40',NULL,NULL),(75,'REQ-2310-00014','Ma. Rose','Jayona','misr6.dti@gmail.com',10,'2023-10-10','ICT Helpdesk','',1,1,'Deteched push button of the unit system','2023-10-10',1,'2023-10-10','Minor','2023-10-10 00:00:00','2023-10-10 00:00:00','Reconnect the button by applying epoxy','done',1,1,'Completed','2023-10-09 16:00:00','2023-11-20 04:53:26',NULL,NULL),(76,'REQ-2310-00015','Rossel ','Virtouso','misr6.dti@gmail.com',3,'2023-10-20','ICT Helpdesk','',3,13,'Setup and installation of bitdefender AVS','2023-10-20',1,'2023-10-20','Minor','2023-10-20 00:00:00','2023-10-20 00:00:00','Install Bitdefender and generate BELARC','done',1,1,'Completed','2023-10-19 16:00:00','2023-11-20 04:56:40',NULL,NULL),(77,'REQ-2310-00016','Thea Grace','Cuer','misr6.dti@gmail.com',10,'2023-10-26','ICT Helpdesk','',2,5,'No internet','2023-10-26',1,'2023-10-26','Minor','2023-10-26 00:00:00','2023-10-26 00:00:00','Install wifi adapter','done',1,1,'Completed','2023-10-25 16:00:00','2023-11-20 05:34:31',NULL,NULL),(78,'REQ-2310-00017','Rheyzia Maria','Elgario','misr6.dti@gmail.com',10,'2023-10-10','ICT Helpdesk','',1,3,'Dirty and Clogged printer head','2023-10-10',1,'2023-10-10','Minor','2023-10-10 00:00:00','2023-10-10 00:00:00','Clean the nozzle and ink flushing','done',1,1,'Completed','2023-10-09 16:00:00','2023-11-20 05:34:31',NULL,NULL),(79,'REQ-2310-00018','Judy ','Sajo','JudySajo@dti.gov.ph',1,'2023-10-11','ICT Helpdesk','',4,17,'QR code','2023-10-11',1,'2023-10-11','Minor','2023-10-11 00:00:00','2023-10-11 00:00:00','Generate  QR code for online flip book','done',1,1,'Completed','2023-10-10 16:00:00','2023-11-20 05:34:31',NULL,NULL),(80,'REQ-2310-00019','Judy ','Sajo','JudySajo@dti.gov.ph',1,'2023-10-05','ICT Helpdesk','',1,3,'Printer','2023-10-05',1,'2023-10-05','Minor','2023-10-05 00:00:00','2023-10-05 00:00:00','Printer asssistance','done',1,1,'Completed','2023-10-04 16:00:00','2023-11-20 05:34:31',NULL,NULL),(81,'REQ-2310-00020','May Ann ','Arca','misr6.dti@gmail.com',4,'2023-10-09','ICT Helpdesk','',4,17,'Setup AVR','2023-10-09',1,'2023-10-09','Minor','2023-10-09 00:00:00','2023-10-09 00:00:00','Setup AVR','done',1,1,'Completed','2023-10-08 16:00:00','2023-11-20 05:34:31',NULL,NULL),(82,'REQ-2311-00001','R6','PMU','r6_pmu@negosyocenter.gov.ph',4,'2023-11-14','ICT Helpdesk','',4,14,'tnk logo psd','2023-11-14',1,'2023-11-14','Minor','2023-11-14 14:58:00','2023-11-14 14:58:00','Created PSD  for TNK Logo','done',1,1,'Completed','2023-11-14 06:58:00','2023-11-20 05:34:31',NULL,NULL),(83,'REQ-2311-00002','Maria Victoria','Aspera','MariaVictoriaAspera@dti.gov.ph',5,'2023-11-06','ICT Helpdesk','',6,17,'The monitor did not function','2023-11-06',1,'2023-11-06','Minor','2023-11-06 00:00:00','2023-11-06 00:00:00','Change the monitor','done',1,1,'Completed','2023-11-05 16:00:00','2023-11-20 05:34:31',NULL,NULL),(84,'REQ-2311-00003','Ma. Kristine','Rosaldes','MaKristineRosaldes@dti.gov.ph',5,'2023-11-03','ICT Helpdesk','',2,5,'Connected with noi internet connection','2023-11-03',1,'2023-11-03','Minor','2023-11-03 00:00:00','2023-11-03 00:00:00','DNS problem, set to statistic','done',1,1,'Completed','2023-11-02 16:00:00','2023-11-20 05:34:31',NULL,NULL),(85,'REQ-2311-00004','Maria Victoria','Aspera','MariaVictoriaAspera@dti.gov.ph',5,'2023-11-10','ICT Helpdesk','',1,1,'Power Supply and connectivity to PC','2023-11-10',1,'2023-11-10','Minor','2023-11-11 00:00:00','2023-11-11 00:00:00','Check the power cord and chech all related parts and check the printer connection','done',1,1,'Completed','2023-11-10 16:00:00','2023-11-20 04:53:26',NULL,NULL),(86,'REQ-2311-00005','Sherlyn','Canales','misr6.dti@gmail.com',10,'2023-11-03','ICT Helpdesk','',2,5,'Connected with no internet connection','2023-11-03',1,'2023-11-03','Minor','2023-11-03 00:00:00','2023-11-03 00:00:00','DNS Problem','done',1,1,'Completed','2023-11-02 16:00:00','2023-11-20 05:34:31',NULL,NULL),(87,'REQ-2311-00006','Johna Raf','Montalvo','misr6.dti@gmail.com',4,'2023-11-03','ICT Helpdesk','',2,5,'DNS','2023-11-03',1,'2023-11-03','Minor','2023-11-03 00:00:00','2023-11-03 00:00:00','DNS problem','done',1,1,'Completed','2023-11-02 16:00:00','2023-11-20 05:34:31',NULL,NULL),(88,'REQ-2311-00007','Francine','Demasis','misr6.dti@gmail.com',10,'2023-11-03','ICT Helpdesk','',1,1,'Cell do not generate','2023-11-03',1,'2023-11-03','Minor','2023-11-03 00:00:00','2023-11-03 00:00:00','Vlookup function also modified, re entered the function','done',1,1,'Completed','2023-11-02 16:00:00','2023-11-20 04:53:26',NULL,NULL),(89,'REQ-2311-00008','Francine','Demasis','misr6.dti@gmail.com',10,'2023-11-13','ICT Helpdesk','',1,1,'DTR','2023-11-13',1,'2023-11-13','Minor','2023-11-13 00:00:00','2023-11-13 00:00:00','Request DTR for DTI iloilo','done',1,1,'Completed','2023-11-12 16:00:00','2023-11-20 04:53:26',NULL,NULL),(90,'REQ-2311-00009','Ariane','Reyes','misr6.dti@gmail.com',2,'2023-11-13','ICT Helpdesk','',1,1,'Keyboard in laptop connot function','2023-11-13',1,'2023-11-13','Minor','2023-11-13 00:00:00','2023-11-13 00:00:00','Go to device manager and update the keyboard','done',1,1,'Completed','2023-11-12 16:00:00','2023-11-20 04:53:26',NULL,NULL),(91,'REQ-2311-00010','Mary Ann','Alteros','misr6.dti@gmail.com',10,'2023-11-16','ICT Helpdesk','',1,1,'Logging PC','2023-11-16',1,'2023-11-16','Minor','2023-11-16 00:00:00','2023-11-16 00:00:00','Defragment and clean all recyle bin, installing microsoft office 16','done',1,1,'Completed','2023-11-15 16:00:00','2023-11-20 04:53:26',NULL,NULL),(92,'REQ-2311-00011','Mary Ann','Alteros','misr6.dti@gmail.com',10,'2023-11-14','ICT Helpdesk','',1,1,'No black ink','2023-11-14',1,'2023-11-14','Minor','2023-11-14 00:00:00','2023-11-14 00:00:00','No black ink and end of life service pump the ink tube to relaese the stack ink, reset','done',1,1,'Completed','2023-11-13 16:00:00','2023-11-20 04:53:26',NULL,NULL),(93,'REQ-2311-00012','Dan Alfrei','Fuerte','dace.phage@gmail.com',1,'2023-11-20','ICT Helpdesk','',1,3,'No Ink',NULL,NULL,NULL,'Minor',NULL,NULL,NULL,NULL,NULL,NULL,'Pending','2023-11-20 05:40:05','2023-11-20 05:40:05',NULL,NULL),(94,'REQ-2311-00013','Dan Alfrei','Fuerte','dace.phage@gmail.com',2,'2023-11-20','ICT Helpdesk','',1,1,'awts',NULL,NULL,NULL,'Minor',NULL,NULL,NULL,NULL,NULL,NULL,'Pending','2023-11-20 05:56:25','2023-11-20 05:56:25','2023-11-20','13:56:00'),(95,'REQ-2311-00014','Tiny','Fuerte','dace.phage@gmail.com',1,'2023-11-20','ICT Helpdesk','',1,2,'asdawda',NULL,NULL,NULL,'Minor',NULL,NULL,NULL,NULL,NULL,NULL,'Pending','2023-11-20 05:59:53','2023-11-20 05:59:53','2023-11-20','13:59:00'),(96,'REQ-2311-00015','Sealbia ','Quilino','sealbiaquilino@dti.gov.ph',7,'2023-11-20','ICT Helpdesk','',3,13,'Install MS Access for Transmittal','2023-11-20',2,NULL,'Minor','2023-11-20 11:18:00','2023-11-20 11:44:00','','MS Access successfully installed',3,2,'Completed','2023-11-20 08:17:04','2023-11-20 08:20:39','2023-11-20','11:00:00');
/*!40000 ALTER TABLE `helpdesks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hosts`
--

DROP TABLE IF EXISTS `hosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hosts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Host` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hosts`
--

LOCK TABLES `hosts` WRITE;
/*!40000 ALTER TABLE `hosts` DISABLE KEYS */;
INSERT INTO `hosts` VALUES (1,'Judith Guillo'),(2,'Ermelinda Pollentes');
/*!40000 ALTER TABLE `hosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ZoomNo` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `OfficeID` int NOT NULL,
  `DivisionID` int NOT NULL,
  `DateRequested` date NOT NULL,
  `Topic` text NOT NULL,
  `DateSchedule` date NOT NULL,
  `TimeStart` time NOT NULL,
  `TimeEnd` time NOT NULL,
  `HostID` int DEFAULT NULL,
  `MeetingID` varchar(45) DEFAULT NULL,
  `Passcode` varchar(45) DEFAULT NULL,
  `ZoomLink` text,
  `GeneratedBy` int DEFAULT NULL,
  `Remarks` text,
  `Status` enum('Pending','Scheduled','Unavailable','Cancelled') DEFAULT 'Pending',
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `ZoomNo_UNIQUE` (`ZoomNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `CategoryID` int NOT NULL,
  `SubCategory` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,1,'Desktop'),(2,1,'Laptop'),(3,1,'Printer'),(4,1,'Others'),(5,2,'Internet Access'),(6,2,'LAN'),(7,2,'Network Sharing'),(8,2,'NAS'),(9,2,'Others'),(10,3,'O365 Account'),(11,3,'IHRIS'),(12,3,'eNGAS'),(13,3,'Others'),(14,4,'Graphics'),(15,4,'Video Editing'),(16,4,'Pitch deck/PPT Presentation'),(17,4,'Others');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role` enum('Admin','Staff','Student') NOT NULL DEFAULT 'Student',
  `ChangePassword` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Dan Alfrei','Celestial','Fuerte','dace.phage@gmail.com','09818098637','Iloilo City','MIS_Fuerte','$2y$10$x.MVSTG2t568RBDpQ/OOaO5fk0MHz0J0U7NISgryX/ZqFYaKX1M8i','Admin',NULL),(2,'Angelo','G.','Patrimonio','angelopatrimonio@dti.gov.ph','09123456789','Iloilo City','MIS_Ghelo','$2y$10$XUBbkqJMSrfqeKC1O27omeEsz.Jucxz3DkcvkvFyTrCgFfiOemaLu','Admin',NULL),(3,'Bemy John',NULL,'Collado','bemyjohncollado@dti.gov.ph','09123456789','Iloilo City','MIS_Collado','$2y$10$XUBbkqJMSrfqeKC1O27omeEsz.Jucxz3DkcvkvFyTrCgFfiOemaLu','Admin',NULL),(4,'Kristopher Gerard',NULL,'Jovero','kristophergerard13@gmail.com','09123456789','Iloilo City','MIS_Jovero','$2y$10$XUBbkqJMSrfqeKC1O27omeEsz.Jucxz3DkcvkvFyTrCgFfiOemaLu','Staff',NULL),(5,'Ana Grace',NULL,'Barba','barbaanagrace98@gmail.com','09123456789','Iloilo City','GIP_Ana','$2y$10$XUBbkqJMSrfqeKC1O27omeEsz.Jucxz3DkcvkvFyTrCgFfiOemaLu','Staff',NULL);
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

-- Dump completed on 2023-11-20 17:30:19
