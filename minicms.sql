-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 05:26 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minicms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `adminEmail` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `adminName`, `adminEmail`, `password`) VALUES
(2, 'admin', 'admin@gmail.com', '$2y$10$HBi8L1n.15NdryNMtAYeYe61CuFK62K1u2Xpp1C0VNa4MjgG2UgBK');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityID` int(11) NOT NULL,
  `cityName` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityID`, `cityName`) VALUES
(1, 'Banja Luka'),
(2, 'Beograd'),
(3, 'Sarajevo'),
(4, 'Tuzla');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservationID` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `guestNumber` int(11) NOT NULL,
  `date` date NOT NULL,
  `timeZone` text NOT NULL,
  `phone` text NOT NULL,
  `comment` mediumtext NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationID`, `restaurantID`, `userID`, `firstName`, `lastName`, `guestNumber`, `date`, `timeZone`, `phone`, `comment`, `postingDate`) VALUES
(1, 1, 1, 'Reservation', 'One', 4, '2023-08-12', '12:00 - 16:00', '123321', 'a', '2021-05-20 23:27:10'),
(2, 1, 3, 'Zlatan', 'Kahriman', 3, '2021-05-22', '16:00 - 20:00', '63866035', 'Molimo rusku salatu.', '2021-05-21 15:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurantID` int(11) NOT NULL,
  `restaurantName` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `restaurantAddress` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `freeSlots` int(11) DEFAULT NULL,
  `cityID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurantID`, `restaurantName`, `restaurantAddress`, `freeSlots`, `cityID`) VALUES
(1, 'Divlja Ruza', 'Rade Vranjesevic 107', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userNickname` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `userEmail` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `userName` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `userPw` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userNickname`, `userEmail`, `userName`, `userPw`) VALUES
(1, 'test', 'test@gmail.com', 'testName', '$2y$10$huWMhykmhaWVKSJmTy3t/Ov6Sj3FmqucXYkM0xqp65VkXAPiBvASO'),
(2, 'Test2', 'test@gmail22.com', 'Test2', '$2y$10$hGNaaMrMGRJmfw4HYhLv9uzDxuMEPgCecHDQ7yd1W1VN0sHlJ5G9e'),
(3, 'zKah', 'zlatan.kahriman@blc.edu.ba', 'Zlatan', '$2y$10$BiA58b.T.tEMi0v3kIF1aON1z04sgYlXhjqj374/9QEtbPNWKDChe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `reservation_ibfk_1` (`userID`),
  ADD KEY `reservation_ibfk_2` (`restaurantID`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurantID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `restaurantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`restaurantID`) REFERENCES `restaurant` (`restaurantID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
