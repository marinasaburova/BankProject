-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2022 at 08:29 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `account` (
  `acctNum` int(10) UNSIGNED ZEROFILL NOT NULL,
  `acctType` varchar(10) NOT NULL,
  `balance` decimal(14,2) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `customerID` int(10) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acctNum`, `acctType`, `balance`, `dateCreated`, `customerID`) VALUES
(1000000000, 'checking', '1046.36', '2022-03-18 13:50:14', 1111111111),
(1000000001, 'savings', '727.50', '2022-03-18 13:50:43', 1111111111),
(1000000002, 'checking', '1252.12', '2022-03-18 13:51:18', 1111111112),
(1000000003, 'savings', '300.00', '2022-03-18 13:51:31', 1111111112),
(1000000005, 'checking', '10348.44', '2022-03-19 17:53:43', 1111111113),
(1000000006, 'savings', '12000.00', '2022-03-21 16:55:23', 1111111113),
(1000000007, 'savings', '0.00', '2022-03-21 16:56:20', 1111111113);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `addr` varchar(60) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `pin` char(4) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstName`, `lastName`, `username`, `email`, `phone`, `addr`, `password`, `pin`, `dateCreated`) VALUES
(1111111111, 'Marina', 'Saburova', 'marina', 'marinas@gmail.com', '9082406937', '1 Normal Ave, Montclair NJ 07043', '1234', '1234', '2022-03-18 04:00:00'),
(1111111112, 'Kat', 'Saburova', 'kats', 'kats@gmail.com', NULL, '', '1234', '1234', '2022-03-18 04:00:00'),
(1111111113, 'Sharpay', 'Evans', 'sharpay', 'sharpay@gmail.com', NULL, '', '1234', '1234', '2022-03-19 17:41:52'),
(1111111114, 'Liv', 'Rooney', 'liv', 'livrooney@gmail.com', NULL, '', '1234', '1234', '2022-03-19 17:49:37'),
(1111111116, 'Maddie', 'Rooney', 'maddie', 'maddie@gmail.com', '1829080147', '1 Cheese Ave, Stevens Point, WI', '1234', '1234', '2022-03-29 15:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `pin` char(4) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `type` varchar(10) NOT NULL,
  `vendor` varchar(60) NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime(),
  `acctNum` int(10) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `amount`, `type`, `vendor`, `date`, `time`, `acctNum`) VALUES
(0000000001, '45.00', 'withdraw', 'Hollister', '2022-03-18', '10:02:11', 1000000000),
(0000000002, '289.00', 'deposit', 'AAE Payroll', '2022-03-18', '10:06:57', 1000000000),
(0000000003, '132.19', 'deposit', 'AAE Payroll', '2022-02-18', '10:07:47', 1000000000),
(0000000005, '20.00', 'withdraw', 'Sephora', '2022-03-25', '15:25:52', 1000000000),
(0000000006, '20.00', 'withdraw', 'Chipotle', '2022-03-25', '15:26:40', 1000000000),
(0000000007, '20.00', 'withdraw', 'Grumpy Bobas', '2022-03-25', '15:41:35', 1000000000),
(0000000008, '5.00', 'withdraw', 'Starbucks', '2022-03-25', '15:43:51', 1000000000),
(0000000009, '5.00', 'withdraw', 'Dunkin Donuts', '2022-03-25', '15:44:18', 1000000000),
(0000000010, '5.00', 'withdraw', 'Dunkin Donuts', '2022-03-25', '15:45:48', 1000000000),
(0000000011, '5.00', 'withdraw', 'Dunkin Donuts', '2022-03-25', '15:45:48', 1000000000),
(0000000012, '10.00', 'withdraw', 'Ulta Beauty', '2022-03-25', '15:46:41', 1000000000),
(0000000013, '10.00', 'withdraw', 'Ulta Beauty', '2022-03-25', '15:46:42', 1000000000),
(0000000014, '12.00', 'withdraw', 'Sun Bum', '2022-03-25', '15:47:51', 1000000000),
(0000000016, '121.90', 'deposit', 'AAE Payroll', '2022-03-25', '15:53:11', 1000000000),
(0000000017, '121.90', 'deposit', 'AAE Payroll', '2022-03-25', '15:53:40', 1000000000),
(0000000018, '12782.12', 'deposit', 'Weekly Allowance from Daddy', '2022-03-25', '17:21:55', 1000000005),
(0000000019, '235.12', 'withdraw', 'Prada', '2022-03-25', '17:22:26', 1000000005),
(0000000020, '2198.56', 'withdraw', 'Chanel', '2022-03-25', '17:22:47', 1000000005),
(0000000022, '81.12', 'deposit', 'Venmo', '2022-03-26', '10:14:18', 1000000000),
(0000000023, '30.00', 'deposit', 'Allowance', '2022-03-26', '10:14:46', 1000000001),
(0000000024, '20.00', 'deposit', 'Venmo from Kat', '2022-03-26', '10:37:07', 1000000001),
(0000000025, '12000.00', 'deposit', 'Allowance from Daddy', '2022-03-26', '11:22:32', 1000000006),
(0000000026, '300.00', 'withdraw', 'Transfer to 1000000001', '2022-03-27', '09:45:33', 1000000000),
(0000000027, '300.00', 'deposit', 'Transfer from 1000000000', '2022-03-27', '09:45:33', 1000000001),
(0000000028, '126.12', 'deposit', 'AAE Payroll', '2022-03-27', '20:08:57', 1000000000),
(0000000029, '50.00', 'withdraw', 'Transfer to 1000000001', '2022-03-27', '20:10:55', 1000000000),
(0000000030, '50.00', 'deposit', 'Transfer from 1000000000', '2022-03-27', '20:10:56', 1000000001),
(0000000031, '100.00', 'withdraw', 'Transfer to *0001', '2022-03-28', '10:43:14', 1000000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acctNum`),
  ADD UNIQUE KEY `acctNum` (`acctNum`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `customerID` (`customerID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`),
  ADD UNIQUE KEY `employeeID` (`employeeID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionID`),
  ADD UNIQUE KEY `transactionID` (`transactionID`),
  ADD KEY `acctNum` (`acctNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acctNum` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000008;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111111117;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`acctNum`) REFERENCES `account` (`acctNum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
