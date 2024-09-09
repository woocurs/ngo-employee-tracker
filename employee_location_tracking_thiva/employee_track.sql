-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 07:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_track`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone_number`, `password`, `status`) VALUES
(1, 'admin', 'adminngo@gmail.com', 771234567, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone_number`, `password`, `status`) VALUES
(1, 'admin', 'adminngo@gmail.com', '0123456789', '12345', 1),
(2, 'Thiva', 'thiva@gmail.com', '771234567', '123', 1),
(10, 'Mathu', 'mathu@gmail.com', '771234098', 'aaa', 1),
(13, 'Thivya', 'thivi@gmail.com', '78123456', 'zzzz', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_tracking`
--

CREATE TABLE `employee_tracking` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `sign_in_time` datetime DEFAULT NULL,
  `sign_in_location` varchar(255) DEFAULT NULL,
  `sign_in_latitude` varchar(100) NOT NULL,
  `sign_in_longitude` varchar(100) NOT NULL,
  `sign_out_time` datetime DEFAULT NULL,
  `sign_out_location` varchar(255) DEFAULT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tracking`
--

INSERT INTO `employee_tracking` (`id`, `employee_id`, `sign_in_time`, `sign_in_location`, `sign_in_latitude`, `sign_in_longitude`, `sign_out_time`, `sign_out_location`, `latitude`, `longitude`) VALUES
(1, 1, '0000-00-00 00:00:00', '6.88128, 79.8818304', '', '', '0000-00-00 00:00:00', NULL, '', ''),
(3, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(4, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(5, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(6, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(7, 1, '0000-00-00 00:00:00', '', '', '', NULL, NULL, '', ''),
(8, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(9, 2, '0000-00-00 00:00:00', '', '', '', NULL, NULL, '', ''),
(10, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(11, 1, '0000-00-00 00:00:00', '', '', '', NULL, NULL, '', ''),
(12, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(13, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(14, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(15, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(16, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', '7.1335936', '79.8851072', NULL, NULL, '', ''),
(17, 10, '2024-08-27 18:10:53', '', '', '', NULL, NULL, '', ''),
(18, 2, '2024-08-27 18:12:04', '8.8178688, 81.0778624', '8.8178688', '81.0778624', NULL, NULL, '', ''),
(19, 1, '2024-09-03 23:19:44', '', '', '', NULL, NULL, '', ''),
(20, 1, '2024-09-04 03:33:34', '', '', '', NULL, NULL, '', ''),
(21, 1, '2024-09-04 03:34:16', '', '', '', NULL, NULL, '', ''),
(22, 1, '2024-09-04 03:35:09', '', '', '', NULL, NULL, '', ''),
(23, 1, '2024-09-04 03:36:29', '', '', '', NULL, NULL, '', ''),
(24, 1, '2024-09-04 03:36:34', '', '', '', NULL, NULL, '', ''),
(25, 1, '2024-09-04 10:16:10', '', '', '', NULL, NULL, '', ''),
(26, 1, '2024-09-04 10:16:26', '', '', '', NULL, NULL, '', ''),
(27, 1, '2024-09-04 10:21:46', '', '', '', NULL, NULL, '', ''),
(28, 1, '2024-09-04 10:22:30', '', '', '', NULL, NULL, '', ''),
(29, 1, '2024-09-04 10:22:42', '', '', '', NULL, NULL, '', ''),
(30, 1, '2024-09-04 10:26:19', '', '', '', NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `employee_tracking`
--
ALTER TABLE `employee_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employee_tracking`
--
ALTER TABLE `employee_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_tracking`
--
ALTER TABLE `employee_tracking`
  ADD CONSTRAINT `employee_tracking_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
