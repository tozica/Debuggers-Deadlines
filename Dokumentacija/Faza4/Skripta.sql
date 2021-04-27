CREATE DATABASE  IF NOT EXISTS `baza` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `baza`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: baza
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `alarm`
--

DROP TABLE IF EXISTS `alarm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alarm` (
  `idAlarm` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vreme` time NOT NULL,
  `idTask` int(11) NOT NULL,
  PRIMARY KEY (`idAlarm`),
  KEY `idTask_idx` (`idTask`),
  CONSTRAINT `idTask` FOREIGN KEY (`idTask`) REFERENCES `task` (`idtask`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alarm`
--

LOCK TABLES `alarm` WRITE;
/*!40000 ALTER TABLE `alarm` DISABLE KEYS */;
/*!40000 ALTER TABLE `alarm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `korisnik` (
  `idkorisnik` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `korisnickoIme` varchar(45) NOT NULL,
  `sifra` varchar(45) NOT NULL,
  `tip` int(11) NOT NULL,
  PRIMARY KEY (`idkorisnik`),
  UNIQUE KEY `korisnickoIme_UNIQUE` (`korisnickoIme`),
  UNIQUE KEY `mail_UNIQUE` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labela`
--

DROP TABLE IF EXISTS `labela`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `labela` (
  `idlabela` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `bojaTaga` varchar(45) NOT NULL,
  PRIMARY KEY (`idlabela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labela`
--

LOCK TABLES `labela` WRITE;
/*!40000 ALTER TABLE `labela` DISABLE KEYS */;
/*!40000 ALTER TABLE `labela` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labela_task`
--

DROP TABLE IF EXISTS `labela_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `labela_task` (
  `idlabela` int(11) NOT NULL,
  `idtaskk` int(11) NOT NULL,
  KEY `idlabela_idx` (`idlabela`),
  KEY `idTask_idx` (`idtaskk`),
  CONSTRAINT `idlabela` FOREIGN KEY (`idlabela`) REFERENCES `labela` (`idlabela`) ON UPDATE CASCADE,
  CONSTRAINT `idtaskk` FOREIGN KEY (`idtaskk`) REFERENCES `task` (`idtask`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labela_task`
--

LOCK TABLES `labela_task` WRITE;
/*!40000 ALTER TABLE `labela_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `labela_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obavestenja`
--

DROP TABLE IF EXISTS `obavestenja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obavestenja` (
  `idobavestenja` int(11) NOT NULL AUTO_INCREMENT,
  `sadrzaj` varchar(45) NOT NULL,
  `idkorisnik` int(11) DEFAULT NULL,
  PRIMARY KEY (`idobavestenja`),
  UNIQUE KEY `idobavestenja_UNIQUE` (`idobavestenja`),
  KEY `idkorisnik_idx` (`idkorisnik`),
  CONSTRAINT `idkorisnik` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obavestenja`
--

LOCK TABLES `obavestenja` WRITE;
/*!40000 ALTER TABLE `obavestenja` DISABLE KEYS */;
/*!40000 ALTER TABLE `obavestenja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `premium`
--

DROP TABLE IF EXISTS `premium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `premium` (
  `idkorisnika` int(11) NOT NULL AUTO_INCREMENT,
  `datumisteka` datetime NOT NULL,
  `brojKartice` int(11) NOT NULL,
  `datumIstekaKartice` datetime NOT NULL,
  `cvc` int(11) NOT NULL,
  PRIMARY KEY (`idkorisnika`),
  UNIQUE KEY `brojKartice_UNIQUE` (`brojKartice`),
  CONSTRAINT `idkorisnika` FOREIGN KEY (`idkorisnika`) REFERENCES `korisnik` (`idkorisnik`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `premium`
--

LOCK TABLES `premium` WRITE;
/*!40000 ALTER TABLE `premium` DISABLE KEYS */;
/*!40000 ALTER TABLE `premium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projekat`
--

DROP TABLE IF EXISTS `projekat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projekat` (
  `idProjekat` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `tip` int(11) NOT NULL,
  `arhiviran` tinyint(4) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  PRIMARY KEY (`idProjekat`),
  KEY `idKorisnik_idx` (`idKorisnik`),
  CONSTRAINT `idKorisnikProjekat` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projekat`
--

LOCK TABLES `projekat` WRITE;
/*!40000 ALTER TABLE `projekat` DISABLE KEYS */;
/*!40000 ALTER TABLE `projekat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projekat_task`
--

DROP TABLE IF EXISTS `projekat_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projekat_task` (
  `idPro` int(11) NOT NULL,
  `idTaskPro` int(11) NOT NULL,
  KEY `idPro_idx` (`idPro`),
  KEY `idTaskPro_idx` (`idTaskPro`),
  CONSTRAINT `idPro` FOREIGN KEY (`idPro`) REFERENCES `projekat` (`idProjekat`) ON UPDATE CASCADE,
  CONSTRAINT `idTaskPro` FOREIGN KEY (`idTaskPro`) REFERENCES `task` (`idtask`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projekat_task`
--

LOCK TABLES `projekat_task` WRITE;
/*!40000 ALTER TABLE `projekat_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `projekat_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task` (
  `idtask` int(11) NOT NULL AUTO_INCREMENT,
  `sadrzaj` varchar(45) NOT NULL,
  `datum` datetime NOT NULL,
  `prioritet` int(11) NOT NULL,
  `idkorisnik` int(11) NOT NULL,
  PRIMARY KEY (`idtask`),
  KEY `idkorisnik_idx` (`idkorisnik`),
  CONSTRAINT `idKorisnikTask` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-23 21:57:24
