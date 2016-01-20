-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2016 at 12:33 AM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rgk`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='authors' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES
(1, 'Lev', 'Tolstoj'),
(2, 'Agata', 'Kristi'),
(3, 'Iliya', 'Ilf'),
(4, 'Eugenij', 'Petrov');

-- --------------------------------------------------------

--
-- Table structure for table `authors_books_relation`
--

CREATE TABLE IF NOT EXISTS `authors_books_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_author` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `authors_books_relation_ibfk_1` (`id_book`),
  KEY `id_author` (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='relation between authors and books' AUTO_INCREMENT=15 ;

--
-- Dumping data for table `authors_books_relation`
--

INSERT INTO `authors_books_relation` (`id`, `id_author`, `id_book`) VALUES
(8, 3, 4),
(9, 4, 4),
(10, 2, 5),
(12, 2, 3),
(14, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `preview` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='books' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `date_create`, `date_update`, `date`, `preview`) VALUES
(2, 'War and Peace', '2016-01-18 23:00:00', '2016-01-19 17:16:57', '1869-01-01', '1.jpg'),
(3, 'Murder on the Orient Express', '2016-01-19 18:37:28', '2016-01-20 22:44:21', '1934-01-01', '2.jpg'),
(4, '12 chairs', '2016-01-18 23:00:00', '2016-01-19 20:52:10', '1927-06-11', '3.jpeg'),
(5, 'The A.B.C. Murders\r\n', '2016-01-19 23:00:00', '2016-01-20 21:29:26', '1936-01-06', '5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1453144485),
('m130524_201442_init', 1453144705);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test1', 'hQOhKC0nu9RSdzrhwoQxSO3i2k10Y1cT', '$2y$13$GkYsJPuZSQ.qDE7FFDHDxeb1YfxhoCe/bcgSe7ggWEzLQSmf7mviG', NULL, 'aa@ya.ru', 10, 1453144825, 1453144825);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors_books_relation`
--
ALTER TABLE `authors_books_relation`
  ADD CONSTRAINT `authors_books_relation_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authors_books_relation_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
