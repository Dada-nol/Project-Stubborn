-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 sep. 2024 à 16:23
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stubborn_project`
--
CREATE DATABASE IF NOT EXISTS `stubborn_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `stubborn_project`;

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BA388B7A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `user_id`) VALUES
(2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE IF NOT EXISTS `cart_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `sweatshirt_id` int NOT NULL,
  `quantity` int NOT NULL,
  `stock_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0FE25271AD5CDBF` (`cart_id`),
  KEY `IDX_F0FE2527A143AB7B` (`sweatshirt_id`),
  KEY `IDX_F0FE2527DCD6110` (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sweat_shirt_id` int NOT NULL,
  `size_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B365660B8E23E05` (`sweat_shirt_id`),
  KEY `IDX_4B365660498DA827` (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `sweat_shirt_id`, `size_id`, `quantity`) VALUES
(36, 22, 1, 2),
(37, 22, 2, 2),
(38, 22, 3, 2),
(39, 22, 4, 2),
(40, 22, 5, 2),
(41, 23, 1, 2),
(42, 23, 2, 2),
(43, 23, 3, 2),
(44, 23, 4, 2),
(45, 23, 5, 2),
(46, 24, 1, 2),
(47, 24, 2, 2),
(48, 24, 3, 2),
(49, 24, 4, 2),
(50, 24, 5, 2),
(51, 25, 1, 2),
(52, 25, 2, 2),
(53, 25, 3, 2),
(54, 25, 4, 2),
(55, 25, 5, 2),
(56, 26, 1, 2),
(57, 26, 2, 2),
(58, 26, 3, 2),
(59, 26, 4, 2),
(60, 26, 5, 2),
(61, 27, 1, 2),
(62, 27, 2, 2),
(63, 27, 3, 2),
(64, 27, 4, 2),
(65, 27, 5, 2),
(66, 28, 1, 2),
(67, 28, 2, 2),
(68, 28, 3, 2),
(69, 28, 4, 2),
(70, 28, 5, 2),
(71, 29, 1, 2),
(72, 29, 2, 2),
(73, 29, 3, 2),
(74, 29, 4, 2),
(75, 29, 5, 2),
(76, 30, 1, 2),
(77, 30, 2, 2),
(78, 30, 3, 2),
(79, 30, 4, 2),
(80, 30, 5, 2),
(81, 31, 1, 2),
(82, 31, 2, 2),
(83, 31, 3, 2),
(84, 31, 4, 2),
(85, 31, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `sweat_shirts`
--

DROP TABLE IF EXISTS `sweat_shirts`;
CREATE TABLE IF NOT EXISTS `sweat_shirts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_promoted` tinyint(1) NOT NULL,
  `image_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sweat_shirts`
--

INSERT INTO `sweat_shirts` (`id`, `name`, `price`, `is_promoted`, `image_filename`) VALUES
(22, 'Pokeball', 45.00, 1, 'Pokeball-66e49ec6dff05.jpg'),
(23, 'PinkLady', 29.90, 0, 'PinkLady-66e49ef2923eb.jpg'),
(24, 'Snow', 32.00, 0, 'Snow-66e49f0a7ca68.jpg'),
(25, 'Greyback', 28.50, 0, 'Greyback-66e49f2ed19e0.jpg'),
(26, 'BlueCloud', 45.00, 0, 'BlueCloud-66e49f4c00449.jpg'),
(27, 'BornInUsa', 59.90, 1, 'BornInUsa-66e49f6980f4d.jpg'),
(28, 'GreenSchool', 42.20, 0, 'GreenSchool-66e49f804221a.jpg'),
(29, 'Street', 34.50, 0, 'Street-66e49fd889572.jpg'),
(30, 'BlueBelt', 29.90, 0, 'BlueBelt-66e4a0104d9f2.jpg'),
(31, 'Blackbelt', 29.90, 1, 'Blackbelt-66e4a04503ee7.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `taille_sweat`
--

DROP TABLE IF EXISTS `taille_sweat`;
CREATE TABLE IF NOT EXISTS `taille_sweat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `taille_sweat`
--

INSERT INTO `taille_sweat` (`id`, `size`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `roles`, `password`, `is_verified`) VALUES
(5, 'Darren', 'nardol.darren@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$zVdVGenK7nZ/6nUkjLOgiONyFmxsaOHCcctR45004cgIozKIywlSi', 1),
(7, 'Jhon', 'dorimonitenz@gmail.com', '[\"ROLE_USER\"]', '$2y$13$N0y2HGnSOzquu9cmadiQg.lCqheC5OQEjDXEwpnmFEtDOSJTS11.q', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `FK_F0FE25271AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_F0FE2527A143AB7B` FOREIGN KEY (`sweatshirt_id`) REFERENCES `sweat_shirts` (`id`),
  ADD CONSTRAINT `FK_F0FE2527DCD6110` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_4B365660498DA827` FOREIGN KEY (`size_id`) REFERENCES `taille_sweat` (`id`),
  ADD CONSTRAINT `FK_4B365660B8E23E05` FOREIGN KEY (`sweat_shirt_id`) REFERENCES `sweat_shirts` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
