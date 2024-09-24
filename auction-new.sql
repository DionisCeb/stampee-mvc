-- Drop existing tables if they exist

DROP TABLE IF EXISTS `privilege`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `stamp`;
DROP TABLE IF EXISTS `stamp_images`;
DROP TABLE IF EXISTS `auction`;
DROP TABLE IF EXISTS `favorites`;

-- Create `privilege` table
CREATE TABLE IF NOT EXISTS `privilege` (
  `id` int NOT NULL AUTO_INCREMENT,
  `privilege` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Create `user` table
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `privilege_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_privilege_id` (`privilege_id`),
  FOREIGN KEY (`privilege_id`) REFERENCES `privilege`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Create `stamp` table
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
  KEY `fk_user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Create `stamp_images` table
CREATE TABLE IF NOT EXISTS `stamp_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stamp_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT '0',
  `image_order` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `stamp_id` (`stamp_id`),
  FOREIGN KEY (`stamp_id`) REFERENCES `stamp`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Create `auction` table
CREATE TABLE IF NOT EXISTS `auction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reserve_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Create `favorites` table
DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `auction_id` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
  FOREIGN KEY (`auction_id`) REFERENCES `auctions`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

