-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 17, 2024 at 08:35 PM
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
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stamp`
--

INSERT INTO `stamp` (`id`, `name`, `creation_date`, `color`, `country`, `stamp_condition`, `print_run`, `dimensions`, `certified`, `user_id`) VALUES
(2, 'German Stamp', '2019-05-22', 'Rouge', 'Allemagne', 'Bonne', 500, '25x35mm', '', 0),
(8, 'Egyptian Stamp', '2024-09-27', '', '', 'Parfaite', 24, '25 * 45', '', 0),
(9, 'UK Stamp', '2024-10-03', '', '', 'Parfaite', 22, '22*22', '', 11),
(10, 'Canadian Stamp', '2024-10-03', '', '', 'Parfaite', 22, '22*22', '', 11),
(11, 'US Stamp', '2024-09-27', '', '', 'Parfaite', 22, '22*22', '', 11);

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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stamp_images`
--

INSERT INTO `stamp_images` (`id`, `stamp_id`, `image_path`, `is_main`, `image_order`) VALUES
(6, 1, 'https://via.placeholder.com/100x100?text=Stamp+1+Image+1', 0, 2),
(5, 1, 'https://via.placeholder.com/400x400?text=Stamp+1+Main', 1, 1),
(7, 1, 'https://via.placeholder.com/100x100?text=Stamp+1+Image+2', 0, 3),
(8, 1, 'https://via.placeholder.com/100x100?text=Stamp+1+Image+3', 0, 4),
(9, 2, 'https://images.pexels.com/photos/8002490/pexels-photo-8002490.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 1, 1),
(10, 2, 'https://via.placeholder.com/100x100?text=Stamp+2+Image+1', 0, 2),
(11, 2, 'https://via.placeholder.com/100x100?text=Stamp+2+Image+2', 0, 3),
(12, 2, 'https://via.placeholder.com/100x100?text=Stamp+2+Image+3', 0, 4),
(21, 8, 'https://img.freepik.com/free-vector/flat-design-postage-stamp_23-2150496924.jpg?t=st=1726587732~exp=1726591332~hmac=7a66b126ed517394f3e97ac32812708f06124ab36b1e35fdc4ec778ca5abdb64&w=1800', 1, 1),
(22, 8, 'https://img.freepik.com/free-vector/set-city-stamps-flat-style_23-2147780766.jpg?t=st=1726587755~exp=1726591355~hmac=350ae7ead25cf4622526b3a818fa60204132f50c29266f3c0053b9a3839b4c8c&w=1380', 0, 2),
(23, 8, 'https://img.freepik.com/free-vector/hand-drawn-christmas-stamp-collection_23-2148743671.jpg?t=st=1726587767~exp=1726591367~hmac=851c003b7817df61f5257cab257ce28915c4cf13423f1a3ee576a6dcac82a729&w=1380', 0, 3),
(24, 8, 'https://img.freepik.com/free-vector/set-landmark-stamps-flat-style_23-2147781078.jpg?t=st=1726587780~exp=1726591380~hmac=ce3fce8052532994b53ddd16ba6828e735e51e8971941f46529b68dd77399847&w=1380', 0, 4),
(25, 9, 'https://images.pexels.com/photos/248993/pexels-photo-248993.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 1, 1),
(26, 9, 'https://via.placeholder.com/100x100?text=Stamp+9+Image+1', 0, 2),
(27, 9, 'https://via.placeholder.com/100x100?text=Stamp+9+Image+2', 0, 3),
(28, 9, 'https://via.placeholder.com/100x100?text=Stamp+9+Image+3', 0, 4),
(29, 10, 'https://images.pexels.com/photos/7790254/pexels-photo-7790254.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 1, 1),
(30, 10, 'https://via.placeholder.com/100x100?text=Stamp+10+Image+1', 0, 2),
(31, 10, 'https://via.placeholder.com/100x100?text=Stamp+10+Image+2', 0, 3),
(32, 10, 'https://via.placeholder.com/100x100?text=Stamp+10+Image+3', 0, 4),
(33, 11, 'https://images.unsplash.com/photo-1609387433510-d2ca76dd0259?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGNvaW5zfGVufDB8fDB8fHww', 1, 1),
(34, 11, 'https://images.unsplash.com/photo-1521897258701-21e2a01f5e8b?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 0, 2),
(35, 11, 'https://images.unsplash.com/photo-1521897258701-21e2a01f5e8b?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 0, 3),
(36, 11, 'https://images.unsplash.com/photo-1521897258701-21e2a01f5e8b?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 0, 4);

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
(11, 'Dionisulikca', 'Cebanu', 'dioniska@gmail.com', '$2y$10$/.PXwoEsQj7dU/UvOU762.fhFTha3uNal6Jjad6vKGJKBA7tpXrf.', 'dioniska@gmail.com', 2, '2024-09-13 18:17:52'),
(15, 'Cristina', 'Alionka', 'cristina@gmail.com', '$2y$10$cNNrTlolN2M8iUoAZdXvrOqdf4fc0tB7.iJe/YmU2sKP5RpmEoddi', 'cristina@gmail.com', 2, '2024-09-14 21:24:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
