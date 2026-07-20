-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 20, 2026 at 02:59 AM
-- Server version: 8.2.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `family_members`
--

DROP TABLE IF EXISTS `family_members`;
CREATE TABLE IF NOT EXISTS `family_members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `relation` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `education` varchar(255) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `business_nature` varchar(255) DEFAULT NULL,
  `business_address` text,
  `phone_number` varchar(20) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`id`, `user_id`, `relation`, `first_name`, `middle_name`, `last_name`, `gender`, `education`, `occupation`, `company_name`, `business_name`, `business_nature`, `business_address`, `phone_number`, `profile_photo`, `created_at`) VALUES
(1, 1, 'Wife', 'mukta', 'vijay', 'salve', 'Female', 'B.com', 'Housewife', NULL, NULL, NULL, NULL, '7854125487', NULL, '2026-07-17 04:34:10'),
(2, 1, 'Father', 'shivaji', 'ankushrao', 'salvw', 'Male', '10 th', 'Service', 'webmart', NULL, NULL, NULL, '9856325698', NULL, '2026-07-17 04:39:23'),
(4, 1, 'Self', 'vijay', 'shivaji', 'salve', 'Male', 'BCS', 'Retired', NULL, NULL, NULL, NULL, '9168585280', 'assets/uploads/504c6401197bf04eec152363edf2c693.jpg', '2026-07-17 16:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `created_at`) VALUES
(1, 'vijay salve', '9168585280', 'vijaysalve8080@gmail.com', '$2y$10$1iEuwOBmQTqM3Uwqr8jhXeARk4wRbcWE5MkvU6D/aqQ6Phw03J8QK', '2026-07-14 17:29:50'),
(2, 'sandeep', '9168585280', 'vijaysalve@gmail.com', '$2y$10$QIoGC3nRKKxyADhxDVHloOfJfA6FCQFpQRiIR/w.3lujofU6HzhEC', '2026-07-16 17:14:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family_members`
--
ALTER TABLE `family_members`
  ADD CONSTRAINT `family_members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
