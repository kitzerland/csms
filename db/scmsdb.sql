-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.9 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.5016
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for scms
CREATE DATABASE IF NOT EXISTS `scms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `scms`;


-- Dumping structure for table scms.tblcashbook
CREATE TABLE IF NOT EXISTS `tblcashbook` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Debt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Category` varchar(300) DEFAULT '0',
  `Comment` varchar(300) DEFAULT '0',
  `AccountID` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table scms.tblcashbook: 0 rows
DELETE FROM `tblcashbook`;
/*!40000 ALTER TABLE `tblcashbook` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcashbook` ENABLE KEYS */;


-- Dumping structure for table scms.tblsettingcategories
CREATE TABLE IF NOT EXISTS `tblsettingcategories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Type` int(11) NOT NULL DEFAULT '0',
  `TypeName` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table scms.tblsettingcategories: 0 rows
DELETE FROM `tblsettingcategories`;
/*!40000 ALTER TABLE `tblsettingcategories` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsettingcategories` ENABLE KEYS */;


-- Dumping structure for table scms.tblstock
CREATE TABLE IF NOT EXISTS `tblstock` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ItemName` varchar(200) NOT NULL DEFAULT '0',
  `Brand` varchar(200) NOT NULL DEFAULT '0',
  `Price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Description` varchar(300) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table scms.tblstock: 0 rows
DELETE FROM `tblstock`;
/*!40000 ALTER TABLE `tblstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstock` ENABLE KEYS */;


-- Dumping structure for table scms.tblstockmanager
CREATE TABLE IF NOT EXISTS `tblstockmanager` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ItemID` int(11) NOT NULL DEFAULT '0',
  `Credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Qty` int(11) NOT NULL DEFAULT '0',
  `TransactionCategory` int(11) NOT NULL DEFAULT '0',
  `Debt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table scms.tblstockmanager: 0 rows
DELETE FROM `tblstockmanager`;
/*!40000 ALTER TABLE `tblstockmanager` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstockmanager` ENABLE KEYS */;


-- Dumping structure for table scms.tblstudentachievement
CREATE TABLE IF NOT EXISTS `tblstudentachievement` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(300) NOT NULL DEFAULT '0',
  `Description` text NOT NULL,
  `ImageURL` varbinary(300) NOT NULL DEFAULT '0',
  `AchievmentDate` date DEFAULT NULL,
  `CreatedDate` date NOT NULL,
  `PublisherID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table scms.tblstudentachievement: 0 rows
DELETE FROM `tblstudentachievement`;
/*!40000 ALTER TABLE `tblstudentachievement` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstudentachievement` ENABLE KEYS */;


-- Dumping structure for table scms.tblstudentpayment
CREATE TABLE IF NOT EXISTS `tblstudentpayment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) NOT NULL DEFAULT '0',
  `Credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Debt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Comment` varchar(300) NOT NULL DEFAULT '0',
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table scms.tblstudentpayment: 0 rows
DELETE FROM `tblstudentpayment`;
/*!40000 ALTER TABLE `tblstudentpayment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstudentpayment` ENABLE KEYS */;


-- Dumping structure for table scms.tblstudents
CREATE TABLE IF NOT EXISTS `tblstudents` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Address` varchar(300) DEFAULT NULL,
  `GuardianName` varchar(100) NOT NULL,
  `PhotoURL` varchar(300) DEFAULT NULL,
  `GuardianContact` varchar(100) NOT NULL,
  `ContactNumber` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `RegisteredDate` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table scms.tblstudents: 0 rows
DELETE FROM `tblstudents`;
/*!40000 ALTER TABLE `tblstudents` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstudents` ENABLE KEYS */;


-- Dumping structure for table scms.tblusers
CREATE TABLE IF NOT EXISTS `tblusers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(300) NOT NULL DEFAULT '0',
  `Password` varchar(300) NOT NULL DEFAULT '0',
  `IsActive` bit(1) DEFAULT b'0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table scms.tblusers: 0 rows
DELETE FROM `tblusers`;
/*!40000 ALTER TABLE `tblusers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblusers` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
