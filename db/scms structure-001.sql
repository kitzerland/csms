/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50625
Source Host           : 127.0.0.1:3306
Source Database       : scms

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2016-08-23 21:16:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tblcashbook
-- ----------------------------
DROP TABLE IF EXISTS `tblcashbook`;
CREATE TABLE `tblcashbook` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Debt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Category` int(11) NOT NULL,
  `Group` int(11) NOT NULL,
  `Comment` varchar(300) DEFAULT '0',
  `AccountID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tblcategorysettings
-- ----------------------------
DROP TABLE IF EXISTS `tblcategorysettings`;
CREATE TABLE `tblcategorysettings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Group` int(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tblsettingcategories
-- ----------------------------
DROP TABLE IF EXISTS `tblsettingcategories`;
CREATE TABLE `tblsettingcategories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Type` int(11) NOT NULL DEFAULT '0',
  `TypeName` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tblstock
-- ----------------------------
DROP TABLE IF EXISTS `tblstock`;
CREATE TABLE `tblstock` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ItemName` varchar(200) NOT NULL DEFAULT '0',
  `Brand` varchar(200) NOT NULL DEFAULT '0',
  `Price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Description` varchar(300) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tblstockmanager
-- ----------------------------
DROP TABLE IF EXISTS `tblstockmanager`;
CREATE TABLE `tblstockmanager` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ItemID` int(11) NOT NULL DEFAULT '0',
  `Credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ItemPrice` int(11) NOT NULL DEFAULT '0',
  `TransactionCategory` int(11) NOT NULL DEFAULT '0',
  `Debt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tblstudentachievement
-- ----------------------------
DROP TABLE IF EXISTS `tblstudentachievement`;
CREATE TABLE `tblstudentachievement` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(300) NOT NULL DEFAULT '0',
  `Description` text NOT NULL,
  `ImageURL` varbinary(300) NOT NULL DEFAULT '0',
  `AchievmentDate` date DEFAULT NULL,
  `CreatedDate` date NOT NULL,
  `PublisherID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tblstudentpayment
-- ----------------------------
DROP TABLE IF EXISTS `tblstudentpayment`;
CREATE TABLE `tblstudentpayment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) NOT NULL DEFAULT '0',
  `Credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Debt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Comment` varchar(300) NOT NULL DEFAULT '0',
  `PaymentMonth` date NOT NULL,
  `Date` datetime NOT NULL,
  `PublisherID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tblstudents
-- ----------------------------
DROP TABLE IF EXISTS `tblstudents`;
CREATE TABLE `tblstudents` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Index` varchar(50) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Address` varchar(300) DEFAULT NULL,
  `OfficeAddress` varchar(300) DEFAULT NULL,
  `NameOfTheSchool` varchar(300) DEFAULT NULL,
  `ReferenceInformation` varchar(50) DEFAULT NULL,
  `Grade` varchar(50) DEFAULT NULL,
  `GuardianName` varchar(100) NOT NULL,
  `PhotoURL` varchar(300) DEFAULT NULL,
  `GuardianContact` varchar(100) NOT NULL,
  `MotherName` varchar(300) NOT NULL,
  `Occupation` varchar(300) NOT NULL,
  `ContactNumber` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `RegisteredDate` date NOT NULL,
  `SiblingsID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Index` (`Index`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tblusers
-- ----------------------------
DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE `tblusers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(300) NOT NULL DEFAULT '',
  `Password` varchar(300) NOT NULL DEFAULT '',
  `IsActive` bit(1) DEFAULT b'0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
