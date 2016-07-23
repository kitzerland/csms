/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50625
Source Host           : 127.0.0.1:3306
Source Database       : scms

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2016-07-23 06:34:29
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
  `Category` varchar(300) DEFAULT '0',
  `Comment` varchar(300) DEFAULT '0',
  `AccountID` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblcashbook
-- ----------------------------

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
-- Records of tblsettingcategories
-- ----------------------------

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
-- Records of tblstock
-- ----------------------------

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
-- Records of tblstockmanager
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblstudentachievement
-- ----------------------------
INSERT INTO `tblstudentachievement` VALUES ('1', '8', 'abcde', 'dsfdf', 0x736466736466, '0000-00-00', '2016-07-23', '1');
INSERT INTO `tblstudentachievement` VALUES ('2', '9', 'sfsdf', 'sfsdf', 0x736466736466, '2016-07-13', '2016-07-23', '1');

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
  `Date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblstudentpayment
-- ----------------------------
INSERT INTO `tblstudentpayment` VALUES ('46', '8', '150.00', '0.00', 'sfbc', '2016-07-23 02:22:55');

-- ----------------------------
-- Table structure for tblstudents
-- ----------------------------
DROP TABLE IF EXISTS `tblstudents`;
CREATE TABLE `tblstudents` (
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblstudents
-- ----------------------------
INSERT INTO `tblstudents` VALUES ('8', 'abc', 'def', 'adr', 'bla', '', '', '', '', '2016-07-22');
INSERT INTO `tblstudents` VALUES ('9', 'abcc', 'deff', 'addr', 'blab', '', '', '', '', '2016-07-22');

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

-- ----------------------------
-- Records of tblusers
-- ----------------------------
INSERT INTO `tblusers` VALUES ('1', 'hello', '', '');
