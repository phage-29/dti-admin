-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: msgitdb
-- ------------------------------------------------------
-- Server version	8.0.34

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
INSERT INTO `categories` VALUES (1,'ICT Equipment Services'),(2,'Network Services'),(3,'Software/ System/ Application'),(4,'Account Management'),(5,'Activity-Based Assistance'),(6,'Others');
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
  UNIQUE KEY `id_UNIQUE` (`id`),
  CONSTRAINT `equipment_chk_1` CHECK ((`Status` in (_utf8mb4'In Use',_utf8mb4'Out of Order',_utf8mb4'In Repair',_utf8mb4'In Storage')))
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `RequestNo_UNIQUE` (`RequestNo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks`
--

LOCK TABLES `helpdesks` WRITE;
/*!40000 ALTER TABLE `helpdesks` DISABLE KEYS */;
INSERT INTO `helpdesks` VALUES (1,'REQ-2311-00001','Dan Alfrei','Fuerte','dace.phage@gmail.com',1,'2023-11-16','ICT Helpdesk','',1,3,'WALA GAGANA',NULL,NULL,NULL,'Minor',NULL,NULL,NULL,NULL,NULL,NULL,'Pending','2023-11-16 09:04:40','2023-11-16 09:04:40');
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
INSERT INTO `subcategories` VALUES (1,1,'Desktop'),(2,1,'Laptop'),(3,1,'Printer'),(4,1,'Others'),(5,2,'Payroll'),(6,2,'eNGAS'),(7,2,'HR System'),(8,2,'DTR System'),(9,2,'Others'),(10,3,'O365 Account'),(11,3,'IHRIS'),(12,3,'eNGAS'),(13,3,'Others'),(14,4,'Graphics'),(15,4,'Video Editing'),(16,4,'Pitch deck/PPT Presentation'),(17,4,'Others');
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
INSERT INTO `users` VALUES (1,'Dan Alfrei','Celestial','Fuerte','dace.phage@gmail.com','09818098637','Iloilo City','MIS_Fuerte','$2y$10$x.MVSTG2t568RBDpQ/OOaO5fk0MHz0J0U7NISgryX/ZqFYaKX1M8i','Staff',NULL),(2,'Angelo','G.','Patrimonio','angelopatrimonio@dti.gov.ph','09123456789','Iloilo City','MIS_Ghelo','$2y$10$XUBbkqJMSrfqeKC1O27omeEsz.Jucxz3DkcvkvFyTrCgFfiOemaLu','Admin',NULL),(3,'Bemy John',NULL,'Collado','bemyjohncollado@dti.gov.ph','09123456789','Iloilo City','MIS_Collado','$2y$10$XUBbkqJMSrfqeKC1O27omeEsz.Jucxz3DkcvkvFyTrCgFfiOemaLu','Admin',NULL),(4,'Kristopher Gerard',NULL,'Jovero','kristophergerard13@gmail.com','09123456789','Iloilo City','MIS_Jovero','$2y$10$XUBbkqJMSrfqeKC1O27omeEsz.Jucxz3DkcvkvFyTrCgFfiOemaLu','Staff',NULL),(5,'Ana Grace',NULL,'Barba','barbaanagrace98@gmail.com','09123456789','Iloilo City','GIP_Ana','$2y$10$XUBbkqJMSrfqeKC1O27omeEsz.Jucxz3DkcvkvFyTrCgFfiOemaLu','Staff',NULL);
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

-- Dump completed on 2023-11-16 17:27:10
