-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2016 at 02:39 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor`, `time`, `userId`) VALUES
(5, 'm.ganchew@gmail.com', '24/03/2015-12:00', 1),
(7, 'm.ganchew@gmail.com', '01/01/2015-08:00', 1),
(8, 'm.ganchew@gmail.com', '04/01/2015-12:00', 1),
(9, 'm.ganchew@gmail.com', '04/01/2015-08:00', 1),
(10, 'm.ganchew@gmail.com', '04/01/2015-18:00', 1),
(11, 'm.ganchew@gmail.com', '04/01/2015-14:00', 1),
(12, 'm.ganchew@gmail.com', '04/01/2015-19:00', 1),
(13, 'm.ganchew@gmail.com', '04/01/2015-17:00', 1),
(14, 'wska.bby.93@gmail.com', '06/09/2015-10:00', 1),
(15, 'wska.bby.93@gmail.com', '06/09/2015-11:00', 1),
(16, 'sux88@gmail.com', '06/09/2015-12:00', 1),
(17, 'wska.bby.93@gmail.com', '06/09/2015-13:00', 2),
(18, 'wska.bby.93@gmail.com', '06/09/2015-14:00', 1),
(19, 'wska.bby.93@gmail.com', '10/09/2015-15:00', 1),
(20, '', '01/01/2015-08:00', 1),
(21, 'wska.bby.93@gmail.com', '13/09/2015-13:00', 1),
(22, 'wska.bby.93@gmail.com', '13/09/2015-10:00', 1),
(23, 'wska.bby.93@gmail.com', '18/06/2015-15:00', 1),
(24, 'wska.bby.93@gmail.com', '13/05/2015-16:00', 1),
(25, 'wska.bby.93@gmail.com', '16/05/2015-18:00', 1),
(26, 'wska.bby.93@gmail.com', '09/06/2015-14:00', 1),
(27, 'wska.bby.93@gmail.com', '05/05/2015-17:00', 1),
(28, 'wska.bby.93@gmail.com', '19/06/2015-18:00', 1),
(29, 'wska.bby.93@gmail.com', '01/06/2015-17:00', 1),
(30, 'wska.bby.93@gmail.com', '01/01/2015-19:00', 1),
(31, 'wska.bby.93@gmail.com', '12/11/2015-08:00', 1),
(32, 'wska.bby.93@gmail.com', '01/01/2015-08:00', 1),
(33, 'sux88@gmail.com', '01/01/2015-08:00', 1),
(34, 'sux88@gmail.com', '18/01/2015-08:00', 1),
(35, 'sux88@gmail.com', '21/01/2015-08:00', 1),
(36, 'wska.bby.93@gmail.com', '27/12/2015-14:00', 34),
(37, 'wska.bby.93@gmail.com', '11/05/2015-08:00', 1),
(38, 'wska.bby.93@gmail.com', '27/12/2015-16:00', 1),
(39, 'wska.bby.93@gmail.com', '09/04/2016-08:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `specId` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userInfo` text NOT NULL,
  `workAddress` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `fName`, `lName`, `email`, `specId`, `password`, `userInfo`, `workAddress`) VALUES
(1, 'Veselina', 'Ivanova', 'wska.bby.93@gmail.com', 3, 'joroedebel123', 'short description', 'Plovdiv, Center'),
(2, 'Gancho', 'Ganchev', 'sux88@gmail.com', 7, 'qwerty', '', ''),
(3, 'Mladen', 'Ganchev', 'sux88@gmail.com', 1, 'tupsiwe', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `file`, `doctor`) VALUES
(5, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/Regular Expressions Cookbook.pdf', 'wska.bby.93@gmail.com'),
(8, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/Regular Expressions Cookbook.pdf', 'wska.bby.93@gmail.com'),
(9, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/Modern PHP.pdf', 'wska.bby.93@gmail.com'),
(10, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/', 'wska.bby.93@gmail.com'),
(11, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/Regular Expressions Cookbook.pdf', 'sux88@gmail.com'),
(12, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/', 'sux88@gmail.com'),
(13, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/zona earth.pdf', 'wska.bby.93@gmail.com'),
(14, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/Modern PHP.pdf', 'wska.bby.93@gmail.com'),
(15, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/', 'wska.bby.93@gmail.com'),
(16, '/var/www/git.projects/Doctor-REST-API/site/view/uploads/Modern PHP.pdf', 'wska.bby.93@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE IF NOT EXISTS `specs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `specs`
--

INSERT INTO `specs` (`id`, `name`) VALUES
(1, 'Ортопедия'),
(2, 'Кардиология'),
(3, 'Дерматология'),
(4, 'Вътрешни болести'),
(5, 'Гастроентерология'),
(6, 'ПЕдиатрия'),
(7, 'Неврология'),
(8, 'Акушерство и генекология'),
(9, 'Урология');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `userInfo` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fName`, `lName`, `userInfo`) VALUES
(1, 'm.ganchew@gmail.com', 'tupsiwe', 'Mladen', 'Ganchev', 'This is a user info and will be very very long some day. we need to handle it properly or we will suffer'),
(2, 'ev0nappy@gmail.com', 'tupsiwe', 'Mladen', 'Ganchev', ''),
(3, 'wska.bby.93@gmail.com', 'joroedebel123', 'Veselina', 'Ivanova', 'short description'),
(4, 'testuser@gmail.com', 'qwerty', 'test', 'testuser', ''),
(25, 'test@gmail.com', 'qwerty', 'testuser', 'testing', ''),
(26, 'testing@gmail.com', 'qwerty', 'Mladen', 'Ganchev', ''),
(27, 'test@test.bg', 'qwerty', 'Mladen', 'Ganchev', ''),
(28, 'admin@email.com', 'qwerty', 'Mladen', 'Ganchev', ''),
(29, 'abv@abv.bg', 'qwerty', 'Veselina', 'Ivanova', ''),
(30, 'asd@gmail.com', '123456', 'qwerty', '12345', ''),
(33, 'finaltest@gmail.com', 'qwerty', 'final', 'test', ''),
(34, 'g.ganch3v@gmail.com', 'a46d45c3', 'asdasd', 'asdasd', ''),
(35, '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
