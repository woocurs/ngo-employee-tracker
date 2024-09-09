-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 12:06 PM
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
  `sign_in_latitude` decimal(10,8) NOT NULL,
  `sign_in_longitude` decimal(11,8) NOT NULL,
  `sign_out_latitude` decimal(10,8) DEFAULT NULL,
  `sign_out_longitude` decimal(11,8) DEFAULT NULL,
  `sign_out_time` datetime DEFAULT NULL,
  `sign_out_location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tracking`
--

INSERT INTO `employee_tracking` (`id`, `employee_id`, `sign_in_time`, `sign_in_location`, `sign_in_latitude`, `sign_in_longitude`, `sign_out_latitude`, `sign_out_longitude`, `sign_out_time`, `sign_out_location`, `latitude`, `longitude`) VALUES
(1, 1, '0000-00-00 00:00:00', '6.88128, 79.8818304', 0.00000000, 0.00000000, NULL, NULL, '0000-00-00 00:00:00', NULL, 0.00000000, 0.00000000),
(3, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(4, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(5, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(6, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(7, 1, '0000-00-00 00:00:00', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(8, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(9, 2, '0000-00-00 00:00:00', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(10, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(11, 1, '0000-00-00 00:00:00', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(12, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(13, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(14, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(15, 2, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(16, 1, '0000-00-00 00:00:00', '7.1335936, 79.8851072', 7.13359360, 79.88510720, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(17, 10, '2024-08-27 18:10:53', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(18, 2, '2024-08-27 18:12:04', '8.8178688, 81.0778624', 8.81786880, 81.07786240, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(19, 1, '2024-09-03 23:19:44', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(20, 1, '2024-09-04 03:33:34', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(21, 1, '2024-09-04 03:34:16', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(22, 1, '2024-09-04 03:35:09', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(23, 1, '2024-09-04 03:36:29', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(24, 1, '2024-09-04 03:36:34', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(25, 1, '2024-09-04 10:16:10', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(26, 1, '2024-09-04 10:16:26', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(27, 1, '2024-09-04 10:21:46', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(28, 1, '2024-09-04 10:22:30', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(29, 1, '2024-09-04 10:22:42', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(30, 1, '2024-09-04 10:26:19', '', 0.00000000, 0.00000000, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(31, 13, '2024-09-09 14:26:16', '6.848512, 79.9178752', 6.84851200, 79.91787520, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(32, 13, '2024-09-09 15:17:00', '6.848512, 79.9178752', 6.84851200, 79.91787520, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(33, 13, '2024-09-09 15:25:01', '6.848512, 79.9178752', 6.84851200, 79.91787520, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(34, 13, '2024-09-09 15:29:35', '6.848512, 79.9178752', 6.84851200, 79.91787520, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000),
(35, 13, '2024-09-09 15:31:58', '6.848512, 79.9178752', 6.84851200, 79.91787520, NULL, NULL, NULL, NULL, 0.00000000, 0.00000000);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
