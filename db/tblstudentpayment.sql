-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.5072
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for scms
CREATE DATABASE IF NOT EXISTS `scms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `scms`;

-- Dumping structure for table scms.tblstudentpayment
CREATE TABLE IF NOT EXISTS `tblstudentpayment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) NOT NULL DEFAULT '0',
  `Credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Debt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Comment` varchar(300) NOT NULL DEFAULT '0',
  `Date` datetime NOT NULL,
  `PublisherID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

-- Dumping data for table scms.tblstudentpayment: 56 rows
DELETE FROM `tblstudentpayment`;
/*!40000 ALTER TABLE `tblstudentpayment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstudentpayment` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
