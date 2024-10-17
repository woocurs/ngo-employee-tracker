-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 04:40 PM
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
  `verification_token` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `reset_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone_number`, `password`, `verification_token`, `status`, `reset_token`) VALUES
(1, 'admin', 'adminngo@gmail.com', '12345678', '12345', NULL, 0, ''),
(2, 'Thiva', 'thiva@gmail.com', '7777777', '123', NULL, 0, ''),
(10, 'Mathu', 'mathu@gmail.com', '771234098', 'aaa', NULL, 0, ''),
(15, 'Thivya', 'thivi@gmail.com', '765123255', '111', NULL, 0, ''),
(16, 'Nihas', 'nihas@gmail.com', '75644567', '1212', NULL, 0, ''),
(17, 'Diva', 'diva@gmail.com', '78564455', 'diva', NULL, 0, ''),
(19, 'Mena', 'thivajini13@gmail.com', '7444568', 'thiva', '53bcfaf73eb0ef512296aeddfec1540e2eabd1711892739c89411fadcf1c65f987dd2613b39944eb8f25ecfc4fe85aa4521b', 0, 'e371f3c94d6001aa8e39bb99f0b54ef45c4470d15d33ce3be96f73569044936cc5906dd6bf3d47b2c1cced7d8cf9b1874f69');

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
  `longitude` varchar(100) NOT NULL,
  `sign_in_selfie` varchar(255) NOT NULL,
  `sign_out_selfie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tracking`
--

INSERT INTO `employee_tracking` (`id`, `employee_id`, `sign_in_time`, `sign_in_location`, `sign_in_latitude`, `sign_in_longitude`, `sign_out_time`, `sign_out_location`, `latitude`, `longitude`, `sign_in_selfie`, `sign_out_selfie`) VALUES
(176, 1, '2024-10-08 19:45:55', '6.848512, 79.9768576', '6.848512', '79.9768576', '2024-10-13 07:59:50', '9.8200258, 80.2289903', '9.8200258', '80.2289903', 'uploads/selfies/selfie_1_1728396955.jpeg', 'uploads/selfies/selfie_1_1728786590.jpeg'),
(177, 1, '2024-10-13 07:59:45', '9.8200258, 80.2289903', '9.8200258', '80.2289903', '2024-10-13 07:59:50', '9.8200258, 80.2289903', '9.8200258', '80.2289903', 'selfies/670b309963b81.jpeg', 'uploads/selfies/selfie_1_1728786590.jpeg'),
(178, 2, '2024-10-15 16:06:04', '7.8184448, 80.6617088', '7.8184448', '80.6617088', '2024-10-15 16:06:09', '7.8184448, 80.6617088', '7.8184448', '80.6617088', 'selfies/670e4594a95f5.jpeg', 'uploads/selfies/selfie_2_1728988569.jpeg'),
(179, 2, '2024-10-16 19:01:46', '6.8845568, 79.8949376', '6.8845568', '79.8949376', '2024-10-16 19:01:51', '6.8845568, 79.8949376', '6.8845568', '79.8949376', 'selfies/670fc0423d362.jpeg', 'uploads/selfies/selfie_2_1729085511.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `logo_path` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `linkedin_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo_path`, `name`, `facebook_link`, `youtube_link`, `twitter_link`, `linkedin_link`) VALUES
(1, 'uploads/rah1.png', 'RAHAMA', 'https://www.facebook.com/rahamainfo', 'https://www.youtube.com/@rahamasrilanka', 'https://www.twitter.com', 'https://www.linkedin.com');

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
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employee_tracking`
--
ALTER TABLE `employee_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

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
