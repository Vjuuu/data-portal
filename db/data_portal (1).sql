-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 27, 2026 at 04:01 PM
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
  `business_email` varchar(255) DEFAULT NULL,
  `business_phone` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `address` text,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pin_code` varchar(20) DEFAULT NULL,
  `permanent_address` text,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

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
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `payment_status` varchar(20) NOT NULL DEFAULT 'unpaid',
  `paid_at` timestamp NULL DEFAULT NULL,
  `plan_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `role`, `is_visible`, `payment_status`, `paid_at`, `plan_amount`, `created_at`) VALUES
(1, 'vijay salve', '9168585280', 'vijaysalve8080@gmail.com', '$2y$10$1iEuwOBmQTqM3Uwqr8jhXeARk4wRbcWE5MkvU6D/aqQ6Phw03J8QK', 'user', 1, 'unpaid', NULL, NULL, '2026-07-14 17:29:50'),
(2, 'sandeep', '9168585280', 'vijaysalve@gmail.com', '$2y$10$QIoGC3nRKKxyADhxDVHloOfJfA6FCQFpQRiIR/w.3lujofU6HzhEC', 'user', 1, 'unpaid', NULL, NULL, '2026-07-16 17:14:00'),
(3, 'Kiran', '9865325698', 'kiran@gmail.com', '$2y$10$DQlnD7QSfXDleKVKvNIcEu3Evhg8g7S6mI8B7DXPrcOWcqhGTw.a6', 'user', 1, 'unpaid', NULL, NULL, '2026-07-20 14:13:15'),
(4, 'Super Admin', '9876543210', 'admin@dataportal.com', '$2y$10$QIoGC3nRKKxyADhxDVHloOfJfA6FCQFpQRiIR/w.3lujofU6HzhEC', 'admin', 1, 'paid', NULL, 5999.00, '2026-08-30 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '5999.00',
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `status` varchar(50) NOT NULL DEFAULT 'created',
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_response` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`),
  KEY `payment_id` (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family_members`
--
ALTER TABLE `family_members`
  ADD CONSTRAINT `family_members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

