-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2022 at 08:31 PM
-- Server version: 5.7.31
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tvseries`
--

-- --------------------------------------------------------

--
-- Table structure for table `tv_series`
--

DROP TABLE IF EXISTS `tv_series`;
CREATE TABLE IF NOT EXISTS `tv_series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) NOT NULL,
  `channel` varchar(191) NOT NULL,
  `gender` enum('male','female','rather not say') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tv_series`
--

INSERT INTO `tv_series` (`id`, `title`, `channel`, `gender`) VALUES
(1, 'Game of Thrones', 'FOX NEWS', 'male'),
(2, 'Lies and Lust', 'Africa Magic', 'female'),
(3, 'Rejection', 'CNN', 'male'),
(4, 'Riot', 'Ibaka TV', 'female'),
(5, 'Hitman Bodyguard', 'Bollywood', 'rather not say'),
(6, 'Colony of Great Nation', 'Netflix', 'male'),
(7, 'Rail Fight', 'CNN', 'female'),
(8, 'Riot in Bank', 'Ibaka TV', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `tv_series_intervals`
--

DROP TABLE IF EXISTS `tv_series_intervals`;
CREATE TABLE IF NOT EXISTS `tv_series_intervals` (
  `id` int(191) NOT NULL AUTO_INCREMENT,
  `id_tv_series` int(191) NOT NULL,
  `week_day` varchar(191) NOT NULL,
  `show_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tv_series_intervals`
--

INSERT INTO `tv_series_intervals` (`id`, `id_tv_series`, `week_day`, `show_time`) VALUES
(1, 1, 'Thursday', '18:33:43'),
(2, 2, 'Thursday', '17:33:43'),
(3, 3, 'Friday', '17:30:00'),
(4, 4, 'Saturday', '11:33:21'),
(5, 5, 'Monday', '18:33:43'),
(6, 6, 'Tuesday', '17:33:43'),
(7, 7, 'Wednesday', '17:30:00'),
(8, 8, 'Tuesday', '11:33:21'),
(9, 2, 'Monday', '23:33:43'),
(10, 3, 'Tuesday', '12:33:43'),
(11, 6, 'Wednesday', '19:30:00'),
(12, 5, 'Saturday', '21:33:21'),
(13, 4, 'Friday', '17:30:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
