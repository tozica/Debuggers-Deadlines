-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2021 at 12:13 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza`
--
CREATE DATABASE IF NOT EXISTS `baza` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `baza`;

-- --------------------------------------------------------

--
-- Table structure for table `alarm`
--

DROP TABLE IF EXISTS `alarm`;
CREATE TABLE IF NOT EXISTS `alarm` (
  `idAlarm` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date DEFAULT NULL,
  `vreme` time DEFAULT NULL,
  `idTask` int(11) NOT NULL,
  PRIMARY KEY (`idAlarm`),
  KEY `idTask_idx` (`idTask`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alarm`
--

INSERT INTO `alarm` (`idAlarm`, `datum`, `vreme`, `idTask`) VALUES
(1, '2021-05-22', NULL, 3),
(2, '2021-05-27', NULL, 5),
(3, '2021-05-18', NULL, 8),
(4, '2021-05-22', NULL, 10),
(5, '2021-05-19', NULL, 11),
(6, '2021-05-24', NULL, 15),
(7, '2021-05-26', NULL, 32);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idkorisnik`, `ime`, `prezime`, `mail`, `korisnickoIme`, `sifra`, `tip`) VALUES
(2, 'Janko', 'Biorac', 'jankomail', 'janule', 'zajecarac99', 1),
(3, 'Uros', 'Jovanovic', 'uros@yahoo.com', 'urke99', 'zajecarac99', 0),
(6, 'Uros', 'Jovanovic', 'uros99@yahoo.com', 'zmurke99', 'zajecarac99', 0),
(9, '', '', '', 'hlglgug.', 'g,fgkfykfy,fu,', 1);

-- --------------------------------------------------------

--
-- Table structure for table `labela`
--

DROP TABLE IF EXISTS `labela`;
CREATE TABLE IF NOT EXISTS `labela` (
  `idlabela` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) DEFAULT NULL,
  `bojaTaga` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlabela`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labela`
--

INSERT INTO `labela` (`idlabela`, `ime`, `bojaTaga`) VALUES
(2, 'shoping', NULL),
(4, 'faks', NULL),
(5, 'grad', NULL),
(6, 'novalabela', NULL),
(7, 'novalabela2', NULL),
(8, 'teretana', NULL),
(9, 'Kafa', NULL),
(10, 'fudbal', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `labela_task`
--

DROP TABLE IF EXISTS `labela_task`;
CREATE TABLE IF NOT EXISTS `labela_task` (
  `idlabela` int(11) DEFAULT NULL,
  `idtaskk` int(11) DEFAULT NULL,
  `idLabela_task` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idLabela_task`),
  KEY `idlabela` (`idlabela`),
  KEY `idtaskk` (`idtaskk`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labela_task`
--

INSERT INTO `labela_task` (`idlabela`, `idtaskk`, `idLabela_task`) VALUES
(2, 3, 0),
(4, 5, 1),
(5, 7, 2),
(5, 8, 3),
(6, 9, 4),
(7, 9, 5),
(5, 10, 6),
(5, 11, 7),
(2, 12, 8),
(8, 15, 9),
(9, 16, 10),
(10, 32, 11);

-- --------------------------------------------------------

--
-- Table structure for table `obavestenja`
--

DROP TABLE IF EXISTS `obavestenja`;
CREATE TABLE IF NOT EXISTS `obavestenja` (
  `idobavestenja` int(11) NOT NULL AUTO_INCREMENT,
  `sadrzaj` varchar(45) NOT NULL,
  `idkorisnik` int(11) DEFAULT NULL,
  `naslov` varchar(45) NOT NULL,
  PRIMARY KEY (`idobavestenja`),
  UNIQUE KEY `idobavestenja_UNIQUE` (`idobavestenja`),
  KEY `idkorisnik_idx` (`idkorisnik`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obavestenja`
--

INSERT INTO `obavestenja` (`idobavestenja`, `sadrzaj`, `idkorisnik`, `naslov`) VALUES
(1, 'Kupi pivo u povratku', 2, 'Pivo'),
(2, 'Cips uzmite svi', NULL, 'Cips'),
(3, 'toza', NULL, 'Toza'),
(4, 'Jedno veliko toceno', 2, 'Toceno'),
(5, 'mesano meso i jagnjetina', NULL, 'rostilj'),
(6, 'Svi na teren veceras', NULL, 'Kosarka'),
(7, 'TERAJ TE SE SVI U PICKU MATERINU!!!\r\nThe <a> ', NULL, 'Poruka za sve korisnike'),
(8, 'gajba piva', NULL, 'Pivo'),
(9, 'krnjaca', 2, 'dunav'),
(10, 'Uradi VD', 2, 'Janko'),
(11, 'Write message here', NULL, 'JankoPOslePromene');

-- --------------------------------------------------------

--
-- Table structure for table `premium`
--

DROP TABLE IF EXISTS `premium`;
CREATE TABLE IF NOT EXISTS `premium` (
  `idPremium` int(11) NOT NULL AUTO_INCREMENT,
  `datumisteka` datetime NOT NULL,
  `brojKartice` int(11) NOT NULL,
  `datumIstekaKartice` datetime NOT NULL,
  `cvc` int(11) NOT NULL,
  `idkorisnikPremium` int(11) NOT NULL,
  PRIMARY KEY (`idPremium`),
  UNIQUE KEY `brojKartice_UNIQUE` (`brojKartice`),
  KEY `idkorisnikPremium` (`idkorisnikPremium`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projekat`
--

DROP TABLE IF EXISTS `projekat`;
CREATE TABLE IF NOT EXISTS `projekat` (
  `idProjekat` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `tip` int(11) NOT NULL,
  `arhiviran` tinyint(4) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  PRIMARY KEY (`idProjekat`),
  KEY `idKorisnik_idx` (`idKorisnik`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projekat`
--

INSERT INTO `projekat` (`idProjekat`, `ime`, `tip`, `arhiviran`, `idKorisnik`) VALUES
(1, 'Janko', 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `projekat_task`
--

DROP TABLE IF EXISTS `projekat_task`;
CREATE TABLE IF NOT EXISTS `projekat_task` (
  `idPro` int(11) NOT NULL,
  `idTaskPro` int(11) NOT NULL,
  `idProjekat_task` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idProjekat_task`),
  KEY `idPro_idx` (`idPro`),
  KEY `idTaskPro_idx` (`idTaskPro`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projekat_task`
--

INSERT INTO `projekat_task` (`idPro`, `idTaskPro`, `idProjekat_task`) VALUES
(1, 13, 48),
(1, 14, 49),
(1, 15, 50),
(1, 16, 51);

-- --------------------------------------------------------

--
-- Table structure for table `sekcija`
--

DROP TABLE IF EXISTS `sekcija`;
CREATE TABLE IF NOT EXISTS `sekcija` (
  `idSekcija` int(11) NOT NULL AUTO_INCREMENT,
  `idProSekcija` int(11) DEFAULT NULL,
  `Ime` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSekcija`),
  KEY `idPro_idx` (`idProSekcija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `idtask` int(11) NOT NULL AUTO_INCREMENT,
  `sadrzaj` varchar(45) NOT NULL,
  `datum` datetime DEFAULT NULL,
  `prioritet` int(11) DEFAULT NULL,
  `idkorisnik` int(11) NOT NULL,
  `vidljivost` int(11) NOT NULL,
  `idSekcija` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtask`),
  KEY `idkorisnik_idx` (`idkorisnik`),
  KEY `idSekcija_idx` (`idSekcija`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`idtask`, `sadrzaj`, `datum`, `prioritet`, `idkorisnik`, `vidljivost`, `idSekcija`) VALUES
(3, 'kupovina', '2021-05-22 00:00:00', 4, 2, 0, NULL),
(5, 'predavanja', '2021-05-27 00:00:00', -1, 2, 0, NULL),
(6, 'vezbe', '2021-05-21 07:50:16', 5, 2, 0, NULL),
(7, 'pivo', '2021-05-21 07:50:29', 5, 2, 0, NULL),
(8, 'rakija', '2021-05-18 00:00:00', 5, 2, 0, NULL),
(9, 'programiranje', '2021-05-21 14:23:12', 0, 2, 0, NULL),
(10, 'viski', '2021-05-22 05:51:16', 2, 2, 0, NULL),
(11, 'votka', '2021-05-19 00:00:00', 1, 2, 0, NULL),
(12, 'Janko', '2021-05-24 00:00:00', -1, 2, 0, NULL),
(13, 'Janko', '2021-05-24 06:05:24', -1, 2, 0, NULL),
(14, 'Janko', '2021-05-24 06:05:53', -1, 2, 0, NULL),
(15, 'Brale', '2021-05-24 06:06:12', -1, 2, 0, NULL),
(16, 'JankoPoslePromene', '2021-05-24 00:00:00', -1, 2, 0, NULL),
(17, 'votka', '2021-05-24 09:34:28', -1, 2, 0, NULL),
(18, 'Nov', '2021-05-24 00:00:00', -1, 2, 0, NULL),
(19, 'Janko', '2021-05-24 00:00:00', -1, 2, 0, NULL),
(20, 'Svetozar', '2021-05-24 00:00:00', -1, 2, 0, NULL),
(21, 'Uros', '2021-05-24 00:00:00', -1, 2, 0, NULL),
(22, 'Danas2', '2021-05-24 00:00:00', 3, 2, 0, NULL),
(23, 'Danas3', '2021-05-24 00:00:00', 5, 2, 0, NULL),
(24, 'Sutra1', '2021-05-25 00:00:00', 0, 2, 0, NULL),
(25, 'Danas4', '2021-05-25 00:00:00', 0, 2, 0, NULL),
(26, 'Danas5', '2021-05-24 00:00:00', 0, 2, 0, NULL),
(27, 'Tuesday', '2021-05-25 00:00:00', 4, 2, 0, NULL),
(28, 'Danas6', '2021-05-24 00:00:00', 0, 2, 0, NULL),
(29, 'Danas7', '2021-05-24 00:00:00', 5, 2, 0, NULL),
(30, 'Tuesday2', '2021-05-25 00:00:00', 4, 2, 0, NULL),
(31, 'Wednesday', '2021-05-26 00:00:00', 5, 2, 0, NULL),
(32, 'Liga evrope', '2021-05-26 00:00:00', 4, 2, 0, NULL),
(33, 'nesto', '2021-05-28 00:00:00', -1, 2, 0, NULL),
(34, 'nesto2', '2021-05-28 00:00:00', -1, 2, 0, NULL),
(35, 'danasjelepdan', '2021-05-28 08:19:27', 0, 2, 0, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alarm`
--
ALTER TABLE `alarm`
  ADD CONSTRAINT `idTask` FOREIGN KEY (`idTask`) REFERENCES `task` (`idtask`) ON UPDATE CASCADE;

--
-- Constraints for table `labela_task`
--
ALTER TABLE `labela_task`
  ADD CONSTRAINT `idlabela` FOREIGN KEY (`idlabela`) REFERENCES `labela` (`idlabela`) ON UPDATE CASCADE,
  ADD CONSTRAINT `idtaskk` FOREIGN KEY (`idtaskk`) REFERENCES `task` (`idtask`) ON UPDATE CASCADE;

--
-- Constraints for table `obavestenja`
--
ALTER TABLE `obavestenja`
  ADD CONSTRAINT `idkorisnik` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON UPDATE CASCADE;

--
-- Constraints for table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `idkorisnikPremium` FOREIGN KEY (`idkorisnikPremium`) REFERENCES `korisnik` (`idkorisnik`) ON UPDATE CASCADE;

--
-- Constraints for table `projekat`
--
ALTER TABLE `projekat`
  ADD CONSTRAINT `idKorisnikProjekat` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON UPDATE CASCADE;

--
-- Constraints for table `projekat_task`
--
ALTER TABLE `projekat_task`
  ADD CONSTRAINT `idPro` FOREIGN KEY (`idPro`) REFERENCES `projekat` (`idProjekat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `idTaskPro` FOREIGN KEY (`idTaskPro`) REFERENCES `task` (`idtask`) ON UPDATE CASCADE;

--
-- Constraints for table `sekcija`
--
ALTER TABLE `sekcija`
  ADD CONSTRAINT `idProSekcija` FOREIGN KEY (`idProSekcija`) REFERENCES `projekat` (`idProjekat`) ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `idKorisnikTask` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON UPDATE CASCADE,
  ADD CONSTRAINT `idSekcija` FOREIGN KEY (`idSekcija`) REFERENCES `sekcija` (`idSekcija`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
