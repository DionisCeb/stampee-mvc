-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 25, 2024 at 04:02 AM
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
-- Table structure for table `auctions`
--

DROP TABLE IF EXISTS `auctions`;
CREATE TABLE IF NOT EXISTS `auctions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `starting_price` decimal(10,2) NOT NULL,
  `stamp_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stamp_id` (`stamp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`id`, `start_date`, `end_date`, `starting_price`, `stamp_id`) VALUES
(5, '2024-10-20', '2024-11-05', 300.00, 6),
(4, '2024-10-15', '2024-10-30', 250.00, 4),
(3, '2024-10-10', '2024-10-25', 200.00, 3),
(2, '2024-10-05', '2024-10-20', 150.00, 2),
(1, '2024-10-01', '2024-10-15', 100.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

DROP TABLE IF EXISTS `favourite`;
CREATE TABLE IF NOT EXISTS `favourite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `auction_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `auction_id` (`auction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id`, `user_id`, `auction_id`, `created_at`) VALUES
(14, 2, 1, '2024-09-25 04:02:09');

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
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stamp`
--

INSERT INTO `stamp` (`id`, `name`, `creation_date`, `color`, `country`, `stamp_condition`, `print_run`, `dimensions`, `certified`, `user_id`) VALUES
(5, 'Timbre Napoléon', '2018-09-30', 'Bleu, Rouge', 'France', 'Endommagé', 1500, '20x30', 'Non', 2),
(2, 'Timbre Tour Eiffel', '2021-07-10', 'Vert, Jaune', 'France', 'Excellente', 3000, '25x35', 'Non', 2),
(3, 'Timbre Louis XIV', '2020-08-01', 'Noir, Blanc', 'France', 'Bonne', 2000, '28x38', 'Oui', 2),
(4, 'Timbre Château de Versailles', '2019-11-22', 'Or, Violet', 'France', 'Moyenne', 1000, '35x45', 'Non', 2),
(1, 'Timbre Marianne', '2022-05-14', 'Rouge, Bleu', 'France', 'Parfaite', 5000, '30x40', 'Oui', 2),
(6, 'Timbre Ancien Italie', '1905-05-01', 'Vert', 'Italie', 'Parfaite', 3000, '45x30', 'Oui', 1),
(7, 'Timbre Vintage Canada', '1950-07-15', 'Bleu', 'Canada', 'Excellente', 5000, '40x25', 'Non', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stamp_images`
--

INSERT INTO `stamp_images` (`id`, `stamp_id`, `image_path`, `is_main`, `image_order`) VALUES
(117, 2, 'uploads/stamps/placeholder.png', 0, 4),
(134, 7, 'uploads/stamps/placeholder.png', 0, 4),
(122, 4, 'uploads/stamps/placeholder.png', 0, 3),
(123, 4, 'uploads/stamps/placeholder.png', 0, 4),
(124, 5, 'uploads/stamps/placeholder.png', 0, 2),
(125, 5, 'uploads/stamps/placeholder.png', 0, 3),
(126, 5, 'uploads/stamps/placeholder.png', 0, 4),
(127, 6, 'uploads/stamps/stamp_6.jpg', 1, 1),
(128, 7, 'uploads/stamps/stamp_7.jpg', 1, 1),
(129, 6, 'uploads/stamps/placeholder.png', 0, 2),
(130, 6, 'uploads/stamps/placeholder.png', 0, 3),
(131, 6, 'uploads/stamps/placeholder.png', 0, 4),
(132, 7, 'uploads/stamps/placeholder.png', 0, 2),
(133, 7, 'uploads/stamps/placeholder.png', 0, 3),
(121, 4, 'uploads/stamps/placeholder.png', 0, 2),
(120, 3, 'uploads/stamps/placeholder.png', 0, 4),
(119, 3, 'uploads/stamps/placeholder.png', 0, 3),
(118, 3, 'uploads/stamps/placeholder.png', 0, 2),
(116, 2, 'uploads/stamps/placeholder.png', 0, 3),
(115, 2, 'uploads/stamps/placeholder.png', 0, 2),
(114, 1, 'uploads/stamps/placeholder.png', 0, 4),
(113, 1, 'uploads/stamps/placeholder.png', 0, 3),
(112, 1, 'uploads/stamps/placeholder.png', 0, 2),
(4, 4, 'uploads/stamps/stamp_4.jpg', 1, 1),
(5, 5, 'uploads/stamps/stamp_5.jpg', 1, 1),
(2, 2, 'uploads/stamps/stamp_2.png', 1, 1),
(3, 3, 'uploads/stamps/stamp_3.jpg', 1, 1),
(1, 1, 'uploads/stamps/stamp_1.jpg', 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `username`, `password`, `email`, `privilege_id`, `created_at`) VALUES
(1, 'Dionis', 'Cebanu', 'dionis@gmail.com', '$2y$10$EoIL1KIMEJO2T/5ns8uIAOODr4QlOAK8gwZrnqEn9zFAMZdGEZeIW', 'dionis@gmail.com', 1, '2024-09-14 20:47:31'),
(2, 'Lord', 'Stampee', 'stampee@gmail.com', '$2y$10$dxPp4T/ePOBqTKmt8kaEn.heQ1qlJfy2mkqjCmQPbv8WCIIEPSuFa', 'stampee@gmail.com', 1, '2024-09-24 23:54:30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
