-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 12:13 PM
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
-- Database: `employee_tracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `phone_number` varchar(10) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `gender`, `position`, `salary`, `join_date`, `phone_number`, `password`, `status`) VALUES
(1, 'admin', 'adminngo@gmail.com', NULL, NULL, NULL, NULL, '0123456789', '12345', 1),
(2, 'fathi', 'fathimasafrina@woocurs.com', 'Female', 'ceo', 60000.00, '2024-08-22', '456789099', 'saf123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_tracking`
--

CREATE TABLE `employee_tracking` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `sign_in_time` datetime DEFAULT NULL,
  `sign_in_location` varchar(255) DEFAULT NULL,
  `sign_out_time` datetime DEFAULT NULL,
  `sign_out_location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tracking`
--

INSERT INTO `employee_tracking` (`id`, `employee_id`, `sign_in_time`, `sign_in_location`, `sign_out_time`, `sign_out_location`, `latitude`, `longitude`) VALUES
(2, 2, '2024-08-25 02:36:00', 'Office', NULL, NULL, 12.34567800, 98.76543200);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employee_tracking`
--
ALTER TABLE `employee_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
