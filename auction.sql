-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 16, 2024 at 12:18 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE IF NOT EXISTS `privilege` (
  `id` int NOT NULL AUTO_INCREMENT,
  `privilege` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `privilege`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `stamp`
--

DROP TABLE IF EXISTS `stamp`;
CREATE TABLE IF NOT EXISTS `stamp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `creation_date` date NOT NULL,
  `color` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `stamp_condition` enum('Parfaite','Excellente','Bonne','Moyenne','Endommagé') NOT NULL,
  `print_run` int NOT NULL,
  `dimensions` varchar(50) NOT NULL,
  `certified` enum('Oui','Non') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stamp`
--

INSERT INTO `stamp` (`id`, `name`, `creation_date`, `color`, `country`, `stamp_condition`, `print_run`, `dimensions`, `certified`) VALUES
(1, 'Te-n na hui', '2019-05-22', 'Bleu', 'France', 'Excellente', 500, '25x35mm', ''),
(2, 'Sam idi', '2019-05-22', 'Rouge', 'Allemagne', 'Bonne', 500, '25x35mm', '');

-- --------------------------------------------------------

--
-- Table structure for table `stamp_images`
--

DROP TABLE IF EXISTS `stamp_images`;
CREATE TABLE IF NOT EXISTS `stamp_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stamp_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT '0',
  `image_order` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `stamp_id` (`stamp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stamp_images`
--

INSERT INTO `stamp_images` (`id`, `stamp_id`, `image_path`, `is_main`, `image_order`) VALUES
(6, 1, 'https://via.placeholder.com/100x100?text=Stamp+1+Image+1', 0, 2),
(5, 1, 'https://via.placeholder.com/400x400?text=Stamp+1+Main', 1, 1),
(7, 1, 'https://via.placeholder.com/100x100?text=Stamp+1+Image+2', 0, 3),
(8, 1, 'https://via.placeholder.com/100x100?text=Stamp+1+Image+3', 0, 4),
(9, 2, 'https://via.placeholder.com/400x400?text=Stamp+2+Main', 1, 1),
(10, 2, 'https://via.placeholder.com/100x100?text=Stamp+2+Image+1', 0, 2),
(11, 2, 'https://via.placeholder.com/100x100?text=Stamp+2+Image+2', 0, 3),
(12, 2, 'https://via.placeholder.com/100x100?text=Stamp+2+Image+3', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `privilege_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_privilege_id` (`privilege_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `username`, `password`, `email`, `privilege_id`, `created_at`) VALUES
(13, 'Dionis', 'Cebanu', 'dionis@gmail.com', '$2y$10$EoIL1KIMEJO2T/5ns8uIAOODr4QlOAK8gwZrnqEn9zFAMZdGEZeIW', 'dionis@gmail.com', 1, '2024-09-14 20:47:31'),
(12, 'alexei', 'banaga', 'alexei@gmail.com', '$2y$10$.i1DQuq7bEy.bHAUEyzBWeomdImCKXk62qXFJDJwjkuBt3xxhX6g.', 'alexei@gmail.com', 1, '2024-09-13 19:47:49'),
(11, 'Dioniska', 'Cebanu', 'dioniska@gmail.com', '$2y$10$QNOeMeLHpDCSJUFne69RyuksEzDRyrm1W3RqdEkz38ZS6MuJ92xBW', 'dioniska@gmail.com', 2, '2024-09-13 18:17:52'),
(15, 'Cristina', 'Alionka', 'cristina@gmail.com', '$2y$10$cNNrTlolN2M8iUoAZdXvrOqdf4fc0tB7.iJe/YmU2sKP5RpmEoddi', 'cristina@gmail.com', 2, '2024-09-14 21:24:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
