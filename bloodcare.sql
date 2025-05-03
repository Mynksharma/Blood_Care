-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 01:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hosid` int(3) NOT NULL,
  `email` varchar(60) NOT NULL,
  `hosname` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `state` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `availbloodtype` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hosid`, `email`, `hosname`, `password`, `state`, `contact`, `availbloodtype`) VALUES
(8, 'gb123@gmail.com', 'G.B. Pant Hospital', '555ba1ef34cf40d43073ed336cf40a50', 'Delhi', '9818260355', 'A+,A-'),
(9, 'shreya123@gmail.com', 'Shreya Hospital', '555ba1ef34cf40d43073ed336cf40a50', 'Uttar Pradesh', '9971078115', 'AB+,A+'),
(10, 'osho123@gmail.com', 'Osho Hospital', '7dc62c54adbc11d358a4a08fe317def2', 'Kerala', '9971078118', 'AB-,AB+,A+');

-- --------------------------------------------------------

--
-- Table structure for table `receiver`
--

CREATE TABLE `receiver` (
  `recid` int(3) NOT NULL,
  `email` varchar(60) NOT NULL,
  `recname` varchar(30) NOT NULL,
  `address` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `bloodtype` enum('A+','B+','AB-','AB+','B-','A-') NOT NULL,
  `contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(3) NOT NULL,
  `hosid` int(3) NOT NULL,
  `recid` int(3) NOT NULL,
  `requestbloodtype` enum('A+','A-','B+','B-','AB+','AB-') NOT NULL,
  `resolved` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hosid`);

--
-- Indexes for table `receiver`
--
ALTER TABLE `receiver`
  ADD PRIMARY KEY (`recid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hosid` (`hosid`),
  ADD KEY `recid` (`recid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hosid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `receiver`
--
ALTER TABLE `receiver`
  MODIFY `recid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`recid`) REFERENCES `receiver` (`recid`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`hosid`) REFERENCES `hospital` (`hosid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
