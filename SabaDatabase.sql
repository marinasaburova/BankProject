- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2022 at 03:18 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `acctNum` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `acctType` varchar(10) NOT NULL,
  `balance` decimal(14,2) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customerID` int(10) UNSIGNED ZEROFILL NOT NULL,
  PRIMARY KEY (`acctNum`),
  UNIQUE KEY `acctNum` (`acctNum`),
  KEY `customerID` (`customerID`)
) ENGINE=MyISAM AUTO_INCREMENT=1000000011 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acctNum`, `acctType`, `balance`, `dateCreated`, `customerID`) VALUES
(1000000000, 'checking', '1046.36', '2022-03-18 21:50:14', 1111111111),
(1000000001, 'savings', '727.50', '2022-03-18 21:50:43', 1111111111),
(1000000002, 'checking', '1252.12', '2022-03-18 21:51:18', 1111111112),
(1000000003, 'savings', '300.00', '2022-03-18 21:51:31', 1111111112),
(1000000005, 'checking', '10348.44', '2022-03-20 01:53:43', 1111111113),
(1000000006, 'savings', '12000.00', '2022-03-22 00:55:23', 1111111113),
(1000000007, 'savings', '0.00', '2022-03-22 00:56:20', 1111111113),
(0100000021, 'checking', '1200.00', '2022-04-10 23:14:20', 1111111120),
(1000000008, 'checking', '0.00', '2022-04-11 01:58:19', 1111111120),
(1000000009, 'checking', '812.00', '2022-04-11 02:12:24', 1111111121),
(1000000010, 'savings', '150.00', '2022-04-11 02:48:48', 1111111122);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `addr` varchar(60) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `pin` char(4) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customerID`),
  UNIQUE KEY `customerID` (`customerID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=1111111123 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstName`, `lastName`, `username`, `email`, `phone`, `addr`, `password`, `pin`, `dateCreated`) VALUES
(1111111111, 'Marina', 'Saburova', 'marina', 'marinas@gmail.com', '9082406937', '1 Normal Ave, Montclair NJ 07043', '1234', '1234', '2022-03-18 12:00:00'),
(1111111112, 'Kat', 'Saburova', 'kats', 'kats@gmail.com', NULL, '', '1234', '1234', '2022-03-18 12:00:00'),
(1111111113, 'Sharpay', 'Evans', 'sharpay', 'sharpay@gmail.com', NULL, '', '1234', '1234', '2022-03-20 01:41:52'),
(1111111114, 'Liv', 'Rooney', 'liv', 'livrooney@gmail.com', NULL, '', '1234', '1234', '2022-03-20 01:49:37'),
(1111111116, 'Maddie', 'Rooney', 'maddie', 'maddie@gmail.com', '1829080147', '1 Cheese Ave, Stevens Point, WI', '1234', '1234', '2022-03-29 23:14:07'),
(1111111120, 'Saba', 'Syed', 'sabasyed', 'sabasyed1199@gmail.com', NULL, NULL, 'password', '1234', '2022-04-10 21:15:28'),
(1111111121, 'SYed', 'Sabeeh', 'sabihshah62', 'sabihshah62@gmail.com', '8624520638', '27 Edison Street Bloomfield NJ', 'password', '1234', '2022-04-11 01:55:30'),
(1111111122, 'Test First NAme', 'Test Last Name', 'Testing', 'Testing@gmail.com', '8624520638', '27 Edison Street Bloomfield NJ', 'password', '1234', '2022-04-11 02:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employeeID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `pin` char(4) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`employeeID`),
  UNIQUE KEY `employeeID` (`employeeID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `Customer_Name` char(30) NOT NULL,
  `Transaction_Amount` decimal(12,2) NOT NULL,
  `Transfer_Description` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`Customer_Name`, `Transaction_Amount`, `Transfer_Description`) VALUES
('Menna Elzomor', '115.00', 'Supplies');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `Transaction` int(100) NOT NULL AUTO_INCREMENT,
  `Amount` decimal(12,2) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Vendor` varchar(60) NOT NULL,
  `AccountNum` char(10) NOT NULL,
  PRIMARY KEY (`Transaction`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`Transaction`, `Amount`, `Type`, `Timestamp`, `Vendor`, `AccountNum`) VALUES
(1, '12.00', 'deposit', '2022-04-11 02:24:31', 'Syed', '1000000009'),
(2, '12.00', 'deposit', '2022-04-11 02:25:09', 'Syed', '1000000009'),
(3, '1000.00', 'deposit', '2022-04-11 02:43:52', 'Syed', '1000000009'),
(4, '800.00', 'withdraw', '2022-04-11 02:44:12', 'Syed', '1000000009'),
(5, '1000.00', 'deposit', '2022-04-11 02:46:37', 'Syed', '1000000009'),
(6, '200.00', 'withdraw', '2022-04-11 02:46:57', 'Transfer to *0009', '1000000009'),
(7, '1000.00', 'deposit', '2022-04-11 02:49:16', 'Syed', '1000000010'),
(8, '800.00', 'withdraw', '2022-04-11 02:49:40', 'Saba', '1000000010'),
(9, '50.00', 'withdraw', '2022-04-11 02:50:30', 'Transfer to *0010', '1000000010');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

DROP TABLE IF EXISTS `transfer`;
CREATE TABLE IF NOT EXISTS `transfer` (
  `Customer_Name` char(30) NOT NULL,
  `Transfer_Amount` decimal(12,2) NOT NULL,
  `Transfer_Description` varchar(30) NOT NULL,
  `AccountNum` decimal(20,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`Customer_Name`, `Transfer_Amount`, `Transfer_Description`, `AccountNum`) VALUES
('Menna Elzomor', '345.00', 'School', '432.00'),
('Menna Elzomor', '345.00', 'Foods', '44323.00'),
('joe', '250.00', 'supplies', '1000000000.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
