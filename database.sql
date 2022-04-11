-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2022 at 10:52 PM
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
  `customerID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acctNum`, `acctType`, `balance`, `dateCreated`, `customerID`, `status`) VALUES
(1000000000, 'checking', '1046.36', '2022-03-18 13:50:14', 1111111111, 'active'),
(1000000001, 'savings', '727.50', '2022-03-18 13:50:43', 1111111111, 'active'),
(1000000002, 'checking', '1252.12', '2022-03-18 13:51:18', 1111111112, 'active'),
(1000000003, 'savings', '300.00', '2022-03-18 13:51:31', 1111111112, 'active'),
(1000000005, 'checking', '10348.44', '2022-03-19 17:53:43', 1111111113, 'active'),
(1000000006, 'savings', '12000.00', '2022-03-21 16:55:23', 1111111113, 'active'),
(1000000007, 'savings', '0.00', '2022-03-21 16:56:20', 1111111113, 'active'),
(1000000011, 'checking', '-10.00', '2022-03-31 19:22:26', 1111111119, 'active'),
(1000000012, 'savings', '0.00', '2022-03-31 19:43:15', 1111111119, 'active'),
(1000000013, 'checking', '0.00', '2022-03-31 20:59:24', 1111111120, 'active'),
(1000000016, 'checking', '0.00', '2022-03-31 21:03:50', 1111111122, 'active'),
(1000000017, 'checking', '0.00', '2022-03-31 21:08:52', 1111111123, 'pending'),
(1000000018, 'savings', '0.00', '2022-03-31 21:08:59', 1111111123, 'pending'),
(1000000019, 'savings', '0.00', '2022-03-31 21:17:51', 1111111111, 'pending'),
(1000000020, 'checking', '0.00', '2022-04-07 18:51:14', 1111111117, 'pending'),
(1000000022, 'checking', '0.00', '2022-04-11 18:22:32', 1111111111, 'pending');

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
(1111111111, 'Marina', 'Saburova', 'marina', 'marinas@gmail.com', '9082400000', '1 Normal Ave, Montclair NJ 07043', '1234', '1234', '2022-03-18 04:00:00'),
(1111111112, 'Kat', 'Saburova', 'kats', 'kats@gmail.com', '1289120391', '1 Normal Ave', '1234', '1234', '2022-03-18 04:00:00'),
(1111111113, 'Sharpay', 'Evans', 'sharpay', 'sharpay@gmail.com', '1284930099', '1 Normal Ave', '1234', '1234', '2022-03-19 17:41:52'),
(1111111114, 'Liv', 'Rooney', 'liv', 'livrooney@gmail.com', '1899992938', '1 Normal Ave', '1234', '1234', '2022-03-19 17:49:37'),
(1111111116, 'Maddie', 'Rooney', 'maddie', 'maddie@gmail.com', '1829080147', '1 Cheese Ave, Stevens Point, WI', '1234', '1234', '2022-03-29 15:14:07'),
(1111111117, 'London', 'Tipton', 'london', 'london@tipton.com', '1282191203', '1 Money Ave, Chicago ', '1234', '1234', '2022-03-31 18:48:13'),
(1111111119, 'Cody', 'Martin', 'codymartin', 'codymartin@tipton.com', '1282191203', '1 Money Ave, Chicago ', '1234', '1234', '2022-03-31 18:49:05'),
(1111111120, 'KC', 'Cooper', 'kccooper', 'kccooper@gmail.com', '1291234102', '1 Normal Ave', '1234', '1234', '2022-03-31 20:48:27'),
(1111111121, 'Hannah', 'Montana', 'hannamontana', 'hannamontana@gmail.com', '1292302401', '1 Normal Ave', '1234', '1234', '2022-03-31 21:00:20'),
(1111111122, 'Steven', 'Rash', 'steven', 'stevenrash@gmail.com', '1293120123', '1 Normal Ave', '1234', '1234', '2022-03-31 21:02:26'),
(1111111123, 'Paul', 'Saburov', 'pinout', 'pinout@gmail.com', '1291291021', '1 Normal Ave', '1234', '1234', '2022-03-31 21:08:49');

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

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `firstName`, `lastName`, `username`, `email`, `password`, `pin`, `dateCreated`) VALUES
(1111111111, 'Steve', 'Stevens', 'steve', 'steve@gmail.com', '1234', '1234', '2022-04-11 12:53:51');

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
(0000000031, '100.00', 'withdraw', 'Transfer to *0001', '2022-03-28', '10:43:14', 1000000000),
(0000000033, '10.00', 'withdraw', 'Transfer to *0012', '2022-03-31', '15:47:37', 1000000011);

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
  MODIFY `acctNum` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000023;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111111124;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111111112;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
