-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 08:23 PM
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
(1000000000, 'checking', '1026.36', '2022-03-18 13:50:14', 1111111111, 'active'),
(1000000001, 'savings', '527.50', '2022-03-18 13:50:43', 1111111111, 'active'),
(1000000002, 'checking', '1252.12', '2022-03-18 13:51:18', 1111111112, 'active'),
(1000000003, 'savings', '300.00', '2022-03-18 13:51:31', 1111111112, 'active'),
(1000000005, 'checking', '15648.44', '2022-03-19 17:53:43', 1111111113, 'active'),
(1000000006, 'savings', '6000.00', '2022-03-21 16:55:23', 1111111113, 'active'),
(1000000007, 'savings', '-212.00', '2022-03-21 16:56:20', 1111111113, 'active'),
(1000000011, 'checking', '-10.00', '2022-03-31 19:22:26', 1111111119, 'active'),
(1000000012, 'savings', '0.00', '2022-03-31 19:43:15', 1111111119, 'active'),
(1000000013, 'checking', '0.00', '2022-03-31 20:59:24', 1111111120, 'active'),
(1000000016, 'checking', '173.00', '2022-03-31 21:03:50', 1111111122, 'active'),
(1000000017, 'checking', '0.00', '2022-03-31 21:08:52', 1111111123, 'closed'),
(1000000018, 'savings', '0.00', '2022-03-31 21:08:59', 1111111123, 'closed'),
(1000000019, 'savings', '0.00', '2022-03-31 21:17:51', 1111111111, 'active'),
(1000000020, 'checking', '3700.00', '2022-04-07 18:51:14', 1111111117, 'active'),
(1000000022, 'checking', '200.00', '2022-04-11 18:22:32', 1111111111, 'active'),
(1000000023, 'checking', '0.00', '2022-04-14 16:35:50', 1111111111, 'denied'),
(1000000024, 'savings', '0.00', '2022-04-14 16:37:27', 1111111111, 'denied'),
(1000000025, 'checking', '0.00', '2022-04-18 19:20:38', 1111111111, 'denied'),
(1000000026, 'checking', '0.00', '2022-04-18 19:21:49', 1111111111, 'denied'),
(1000000027, 'checking', '0.00', '2022-04-18 19:22:04', 1111111111, 'denied'),
(1000000028, 'checking', '0.00', '2022-04-18 19:22:16', 1111111111, 'denied'),
(1000000029, 'checking', '0.00', '2022-04-18 19:22:51', 1111111111, 'denied'),
(1000000031, 'checking', '500.00', '2022-04-18 19:37:58', 1111111113, 'active'),
(1000000032, 'savings', '400.00', '2022-04-18 19:48:21', 1111111120, 'active'),
(1000000033, 'checking', '0.00', '2022-04-18 20:20:44', 1111111124, 'active'),
(1000000034, 'checking', '0.00', '2022-04-18 20:46:31', 1111111111, 'pending'),
(1000000035, 'savings', '0.00', '2022-04-18 21:50:36', 1111111111, 'closed'),
(1000000036, 'checking', '50.00', '2022-04-21 18:35:18', 1111111130, 'active'),
(1000000037, 'checking', '0.00', '2022-04-21 20:31:32', 1111111126, 'closed'),
(1000000038, 'checking', '0.00', '2022-04-21 20:32:20', 1111111126, 'closed'),
(1000000039, 'checking', '500.00', '2022-04-21 20:33:29', 1111111126, 'active'),
(1000000040, 'checking', '0.00', '2022-04-24 14:31:23', 1111111136, 'active'),
(1000000041, 'savings', '0.00', '2022-04-24 14:47:26', 1111111136, 'denied'),
(1000000042, 'checking', '0.00', '2022-04-25 13:05:25', 1111111137, 'pending');

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
  `phone` char(10) DEFAULT NULL,
  `addr` varchar(60) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `pin` char(4) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(15) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstName`, `lastName`, `username`, `email`, `phone`, `addr`, `password`, `pin`, `dateCreated`, `status`) VALUES
(1111111111, 'Marina', 'Saburova', 'marinas', 'marinas@gmail.com', '9082400000', '1 Normal Ave, Montclair NJ 07043', '$2y$10$oQq0Tn7.5nemyKWR.kDvwe4HLAo.020/s33R8DOeqqVhjmwask8yi', '1234', '2022-03-18 04:00:00', 'active'),
(1111111112, 'Kat', 'Saburova', 'kats', 'kats@gmail.com', '1289120391', '1 Normal Ave', '$2y$10$k.X2883.b6cJTxiTCk6FYOiOTd/vLA665GIh712u4n3cGqBdPtqpC', '1234', '2022-03-18 04:00:00', 'active'),
(1111111113, 'Sharpay', 'Evans', 'sharpay', 'sharpay@gmail.com', '1284930099', '1 Normal Ave', '$2y$10$SQMRKh2EmtYAtEWBKXEpq.ptUKBZpmnfRmv8M/BFgcz5Ut4uHAH/q', '1234', '2022-03-19 17:41:52', 'active'),
(1111111114, 'Liv', 'Rooney', 'liv', 'livrooney@gmail.com', '1899992938', '1 Normal Ave', '$2y$10$/9Co/0z6XdqdVuYuaUyo7O6PPaL69X9xOTqUIcZ9mTefskozYDhuG', '1234', '2022-03-19 17:49:37', 'active'),
(1111111116, 'Maddie', 'Rooney', 'maddie', 'maddie@gmail.com', '1829080147', '1 Cheese Ave, Stevens Point, WI', '$2y$10$Og9ioZmwOllxDfbgXeKaR.YI/3VvkiN3FyrxN4rT6ytWATJl8edy.', '1234', '2022-03-29 15:14:07', 'active'),
(1111111117, 'London', 'Tipton', 'london', 'london@tipton.com', '1282191203', '1 Money Ave, Chicago ', '$2y$10$l8C7yNR.1xpPNUwfwUcNw.U3b46qfgdBz4D3L5hTQeQWAPLAn7kdi', '1234', '2022-03-31 18:48:13', 'active'),
(1111111119, 'Cody', 'Martin', 'codymartin', 'codymartin@tipton.com', '1282191203', '1 Money Ave, Chicago ', '$2y$10$Aenuo79F3QGPz9opzyrRMeQxBCoKTKSkxeS21EVbAczdP75mL2vL6', '1234', '2022-03-31 18:49:05', 'active'),
(1111111120, 'KC', 'Cooper', 'kccooper', 'kccooper@gmail.com', '0000000000', '1 Normal Ave', '$2y$10$CjV6yCVobpJxG94UN4L/0OOkDNyF.KL0WdSdlldxovUUbMlg3VWTO', '1234', '2022-03-31 20:48:27', 'active'),
(1111111121, 'Hannah', 'Montana', 'hannamontana', 'hannamontana@gmail.com', '1292302401', '1 Normal Ave', '$2y$10$NgofmBVBoTGNbv21yyzg4ODGOMG.oeCIAoDSE/eJqyw222eZCVAlO', '1234', '2022-03-31 21:00:20', 'active'),
(1111111122, 'Steven', 'Rash', 'steven', 'stevenrash@gmail.com', '1293120123', '1 Normal Ave', '$2y$10$fxIuN8JVGu419KRzMCWXJuMmxg1MXgOxQ9bmNiB0.a9GBWySmWCpu', '1234', '2022-03-31 21:02:26', 'active'),
(1111111123, 'Paul', 'Saburov', 'pinout', 'pinout@gmail.com', '1291291021', '1 Normal Ave', '$2y$10$QDwPL/uHjAf2tLE7ibCiPeJ/y.Xd2YlNdGg1soFfRbPjM/fu6OK9K', '1234', '2022-03-31 21:08:49', 'inactive'),
(1111111124, 'Water', 'Bottle', 'water', 'water@gmail.com', '127812-490', '1 Normal Ave', '$2y$10$N9T0XONG7PgJHbhhxrIzke9dgm3CD3e1tDbIx.AER43mwI3cb0t1m', '1234', '2022-04-18 20:20:39', 'inactive'),
(1111111125, 'Trevor', 'Evor', 'trevor', 'trevor@gmail.com', '1293812931', '1 Normal Ave', '$2y$10$1knoMMQdF3GfWJLi0/e/zOGdgsZUMpyS9Bgc/GX4eKpQwajtt7uiO', '1234', '2022-04-18 22:44:19', 'inactive'),
(1111111126, 'Carly', 'Shay', 'carly', 'carly@icarly.com', '1281920394', '128 S. 28th Street, Seattle, WA', '$2y$10$wFaZtl22qUuc6.80HJ.Fn.cn0y1hMTCJVLihGIVYmhdlUEOpi4K0.', '1234', '2022-04-21 18:26:24', 'active'),
(1111111127, 'Spencer', 'Shay', 'spencer', 'spencer@icarly.com', '1234178291', '112 S. 18 Ave, Seattle, WA', '$2y$10$YXoSP8yE5am2HaCd3bcHnuUN2uj6vSLY27wRKTiKYdxF341JPVgUq', '1234', '2022-04-21 18:32:36', 'active'),
(1111111129, 'Spencer', 'Shay', 'spencer2', 'spencer2@icarly.com', '1234178291', '112 S. 18 Ave, Seattle, WA', '$2y$10$J3luZgsqnxz5vmFKDotodeHLVitLq7Up3mOjAM6qQsyiTQTQcgKkG', '1234', '2022-04-21 18:34:28', 'active'),
(1111111130, 'Spencer', 'Shay', 'spencer3', 'spencer3@icarly.com', '1234178291', '112 S. 18 Ave, Seattle, WA', '$2y$10$m49hcXm2GrwDQUZ7NSumpOhFPLrx5Ht8CfS2Uqq0fZHk5epe9gNga', '1234', '2022-04-21 18:35:10', 'active'),
(1111111131, 'Stacy', 'Holbrook', 'stacy', 'stacy@gmail.com', '1231121291', '1 Normal Ave', '$2y$10$jlrdp1ZlXV7zKKQ11k.mk.AGMxVNqMyIPftm2QUTpUMrkOA3yxN5e', '1234', '2022-04-21 20:17:20', 'active'),
(1111111136, 'Galina', 'Saburova', 'glnsbr', 'glnsbr@gmail.com', '1231211111', '1 Normal Ave', '$2y$10$qewhjlHeQPAkI7iBVinfpe3tEh3QDRVwsSNX0D7TE8QNcQtHDM8xy', '1234', '2022-04-24 14:29:24', 'active'),
(1111111137, 'Tinker', 'Bell', 'tinkerbell', 'tinkerbell@gmail.com', '1289128138', '1 Fairy Dust Way, Pixie Hollow', '$2y$10$y1fBHzTZIeJD7Jskh/W8M.AO4dpnQacrldOBTn2HE/XSkO4Z9HNK.', '1234', '2022-04-25 13:05:17', 'active');

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
  `phone` char(10) NOT NULL,
  `password` varchar(60) NOT NULL,
  `pin` char(4) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `firstName`, `lastName`, `username`, `email`, `phone`, `password`, `pin`, `dateCreated`) VALUES
(1111111111, 'Steve', 'Stevens', 'steve', 'steve@gmail.com', '1111111111', '$2y$10$BKQ.GrJ8WkKcNsQNL9OKSuM4uNeYipXcuB3zZA3VXukAzwml2kKYG', '1234', '2022-04-11 12:53:51');

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
(0000000033, '10.00', 'withdraw', 'Transfer to *0012', '2022-03-31', '15:47:37', 1000000011),
(0000000034, '192.00', 'deposit', 'IDT Payroll', '2022-04-14', '12:29:53', 1000000016),
(0000000035, '19.00', 'withdraw', 'Kumo Sushi', '2022-04-14', '12:30:13', 1000000016),
(0000000036, '500.00', 'withdraw', 'Transfer to *0005', '2022-04-14', '15:48:27', 1000000005),
(0000000037, '212.00', 'withdraw', 'Transfer to *0005', '2022-04-14', '15:48:58', 1000000007),
(0000000038, '200.00', 'withdraw', 'Transfer to *0006', '2022-04-14', '16:11:28', 1000000005),
(0000000039, '200.00', 'withdraw', 'Transfer to *0022', '2022-04-14', '16:12:34', 1000000001),
(0000000040, '200.00', 'deposit', 'Transfer from *0001', '2022-04-14', '16:12:34', 1000000022),
(0000000041, '150.00', 'withdraw', 'Transfer to *0001', '2022-04-14', '16:13:15', 1000000000),
(0000000042, '6000.00', 'withdraw', 'Transfer to *0005', '2022-04-14', '16:14:56', 1000000006),
(0000000043, '6000.00', 'deposit', 'Transfer from *0006', '2022-04-14', '16:14:56', 1000000005),
(0000000044, '80.00', 'deposit', 'Venmo', '2022-04-15', '13:10:51', 1000000000),
(0000000047, '50.00', 'withdraw', 'Transfer to *0000', '2022-04-20', '14:06:01', 1000000035),
(0000000048, '50.00', 'deposit', 'Transfer from *0035', '2022-04-20', '14:06:02', 1000000000),
(0000000049, '0.00', 'withdraw', 'Transfer to *0000', '2022-04-20', '14:08:06', 1000000035),
(0000000050, '0.00', 'deposit', 'Transfer from *0035', '2022-04-20', '14:08:06', 1000000000),
(0000000051, '0.00', 'withdraw', 'Transfer to *0000', '2022-04-20', '14:10:12', 1000000035),
(0000000052, '0.00', 'deposit', 'Transfer from *0035', '2022-04-20', '14:10:12', 1000000000),
(0000000053, '500.00', 'deposit', 'Deposit', '2022-04-21', '11:15:19', 1000000017),
(0000000054, '1829.00', 'deposit', 'Venmo', '2022-04-21', '11:15:37', 1000000017),
(0000000055, '2329.00', 'withdraw', 'Closing account withdrawal', '2022-04-21', '11:15:53', 1000000017),
(0000000056, '0.00', 'withdraw', 'Closing account withdrawal', '2022-04-21', '11:15:53', 1000000018),
(0000000057, '500.00', 'deposit', 'Initial deposit', '2022-04-21', '16:33:29', 1000000039),
(0000000058, '10000.00', 'deposit', 'Allowance', '2022-04-25', '10:44:03', 1000000020),
(0000000059, '1700.00', 'deposit', 'Birthday money', '2022-04-25', '10:44:19', 1000000020),
(0000000060, '8000.00', 'withdraw', 'Chanel', '2022-04-25', '10:44:32', 1000000020);

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
  MODIFY `acctNum` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000043;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111111138;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111111112;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
