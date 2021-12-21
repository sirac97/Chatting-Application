-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 07, 2021 at 09:05 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

DROP TABLE IF EXISTS `bookmark`;
CREATE TABLE IF NOT EXISTS `bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `url` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `title`, `url`, `note`, `owner`, `created`) VALUES
(1, 'Introduction to Game Programming', 'https://www.codingame.com/', 'Nice website on game programming', 45, '2021-04-07 17:44:55'),
(3, 'Free 3D Modelling', 'https://www.cgtrader.com/free-3d-models', '1000s of free 3D Models', 45, '2021-04-07 17:47:09'),
(4, 'Webmail at Bilkent', 'https://webmail.bilkent.edu.tr/', 'Mail client of Bilkent University', 45, '2021-04-07 17:47:09'),
(5, 'English - Turkish Dictionary', 'https://www.seslisozluk.net/', 'A decent dictionary', 45, '2021-04-07 17:48:51'),
(6, 'Materialize CSS Framework', 'https://materializecss.com/', 'To copy/paste template codes', 45, '2021-04-07 17:48:51'),
(7, 'Moodle @ Bilkent', 'https://moodle.bilkent.edu.tr/2020-2021-spring/login/index.php', 'All lectures are on moodle', 47, '2021-04-07 17:50:37'),
(8, 'Online Video Editing Tool', 'https://www.kapwing.com/', 'Very functional online tool', 47, '2021-04-07 17:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `bday` date DEFAULT NULL,
  `profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `bday`, `profile`) VALUES
(45, 'Seçkin TERZİ', 'seckin@gmail.com', '$2y$10$e9R6tXnaL37a7cB263Y8Lu18Lml11q97AW4ffBGJuNHoedaC3rUPO', '1995-03-24', NULL),
(47, 'Özge TÜREL', 'ozge@gmail.com', '$2y$10$AypTN3/RLeV9vhRBysl9wuXoTZ8XlBtAXMRDbILRQlFrTk.kLnk0G', '1999-04-16', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
