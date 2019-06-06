-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2019 at 09:25 AM
-- Server version: 8.0.16
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iot_cn`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `id` int(11) NOT NULL,
  `name` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sensorview`
--

CREATE TABLE `sensorview` (
  `serial` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `sensorId` int(11) NOT NULL,
  `unit` varchar(256) NOT NULL,
  `logo` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `switchview`
--

CREATE TABLE `switchview` (
  `serial` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `code` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `logo` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `usertype` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensorview`
--
ALTER TABLE `sensorview`
  ADD PRIMARY KEY (`serial`),
  ADD KEY `sensorId` (`sensorId`);

--
-- Indexes for table `switchview`
--
ALTER TABLE `switchview`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sensorview`
--
ALTER TABLE `sensorview`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `switchview`
--
ALTER TABLE `switchview`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sensorview`
--
ALTER TABLE `sensorview`
  ADD CONSTRAINT `sensorId` FOREIGN KEY (`sensorId`) REFERENCES `sensors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
