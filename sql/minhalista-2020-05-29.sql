-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 29-Maio-2020 às 04:36
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minhalista`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` tinytext NOT NULL,
  `userEmail` tinytext NOT NULL,
  `userPassword` longtext NOT NULL,
  `userPermissions` int(1) DEFAULT '0',
  `userAvatar` longblob,
  `userBanner` longblob,
  `userBannerList` longblob,
  `userAbout` text,
  `userGender` int(1) NOT NULL DEFAULT '0',
  `userBirthday` date DEFAULT NULL,
  `userLocalization` tinytext,
  `userDate` date NOT NULL,
  `userOnlineStatus` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userBanStatus` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
