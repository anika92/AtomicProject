-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2016 at 01:39 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `atomicprojectb20`
--

-- --------------------------------------------------------

--
-- Table structure for table `birthday`
--

CREATE TABLE IF NOT EXISTS `birthday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `deleted_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `birthday`
--

INSERT INTO `birthday` (`id`, `name`, `date`, `deleted_at`) VALUES
(9, 'd', '2016-06-03', '1467149330'),
(10, 'f', '2016-06-06', '1467149331'),
(11, 'dd', '2016-07-11', NULL),
(12, 'hh', '2016-07-04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `without_html` text NOT NULL,
  `deleted_at` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `description`, `without_html`, `deleted_at`) VALUES
(31, 's', '<p>s</p>', '', '1468954776'),
(32, 'aa', '<p>aaaa</p>', 'aaaa', NULL),
(33, 'a', '<p><strong>a</strong></p>', '', NULL),
(34, 'ss', '<p><strong>ssss</strong></p>', '', NULL),
(35, 'aa', '<p><strong>aaaa</strong></p>', 'aaaa', NULL),
(36, 'aa', '<p><strong>aaa</strong></p>', 'aaa', NULL),
(37, 'h', '<p>helllllppppp</p>', 'helllllppppp', NULL),
(38, 'h', '<p>helllllppppp</p>', 'helllllppppp', NULL),
(39, 'tst', '<p><strong>test</strong></p>', 'test', NULL),
(40, 'tst', '<p><strong>test</strong></p>', 'test', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `deleted_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `city`, `deleted_at`) VALUES
(5, 'f', 'Chittagong', '1468177648'),
(6, 'f', 'Rajshahi', '1468177650'),
(7, 'd', 'Chittagong', NULL),
(8, 'd', 'Noakhali', NULL),
(9, 'f', 'Rajshahi', NULL),
(10, 'g', 'Comilla', NULL),
(11, 'f', '', NULL),
(12, 'x', '', NULL),
(13, 'f', 'Dhaka', NULL),
(14, 'f', 'Dhaka', NULL),
(15, 'd', '', NULL),
(16, 'v', '', NULL),
(17, 'j', '', NULL),
(18, 'h', '', NULL),
(19, 'f', '', NULL),
(20, 'd', '', NULL),
(21, 'x', '', NULL),
(22, 'x', 'Dhaka', NULL),
(23, 'f', '', NULL),
(24, 'f', '', NULL),
(25, 'd', '', NULL),
(26, 'a', '', NULL),
(27, 'a', '', NULL),
(28, 'd', '', NULL),
(29, 'g', '', NULL),
(30, 'g', '', NULL),
(31, 'x', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `deleted_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `name`, `email`, `deleted_at`) VALUES
(7, '', ' nn', '1466188526'),
(8, '', ' gg', '1466190117'),
(9, 'f', ' nc1', NULL),
(10, '', ' ss', NULL),
(13, 'n', 'h', NULL),
(14, ' m,', 'nm', NULL),
(15, ' nn', 'mm', NULL),
(16, ' h', 'g', NULL),
(19, ' w', 'w', NULL),
(20, ' f', 'f', NULL),
(21, ' d', 'd', NULL),
(22, ' a', 'abc@gmail.com', NULL),
(25, ' a', 'anikacste@gmail.com', NULL),
(32, ' a', 'anikanstu@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `deleted_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`, `gender`, `deleted_at`) VALUES
(9, 's', 'male', NULL),
(10, 'f', '', NULL),
(11, 'f', '', NULL),
(12, 'f', '', NULL),
(13, 'f', '', NULL),
(14, 'f', '', NULL),
(15, 'f', '', NULL),
(16, 's', '', NULL),
(17, '', '', NULL),
(18, '', '', NULL),
(19, '', '', NULL),
(20, '', '', NULL),
(21, 'd', 'female', NULL),
(22, 'd', 'female', NULL),
(23, 'name', 'gender', NULL),
(24, 'd', 'female', NULL),
(25, 'd', 'female', NULL),
(26, 'd', 'male', NULL),
(27, 'd', 'male', NULL),
(28, 'd', 'male', NULL),
(29, 'anika', 'female', NULL),
(30, 's', 'male', '1467366933');

-- --------------------------------------------------------

--
-- Table structure for table `hobby`
--

CREATE TABLE IF NOT EXISTS `hobby` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `deleted_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `hobby`
--

INSERT INTO `hobby` (`id`, `name`, `hobbies`, `deleted_at`) VALUES
(11, '', 'on,on', ''),
(12, 'an5', 'Book reading,Gardening', ''),
(13, 'an6', 'Gardening,Teaching', ''),
(14, 'f', 'Playing Cricket,Teaching', ''),
(23, 'ss', 'Coding,Browsing', ''),
(25, '', '', ''),
(26, '', '', ''),
(27, '', '', ''),
(28, '', '', ''),
(29, '', '', ''),
(30, '', '', ''),
(31, '', '', ''),
(32, '', '', ''),
(33, '', '', ''),
(34, '', '', ''),
(35, '', '', ''),
(36, 'd', '', ''),
(37, 'd', '', ''),
(38, '', '', ''),
(39, '', '', ''),
(40, '', '', ''),
(41, '', '', ''),
(42, 'a', 'Teaching', ''),
(43, 'z', '', ''),
(44, 'f', '', ''),
(45, 'hh', '', ''),
(46, 'f', '', ''),
(47, 'a', '', ''),
(48, 'a', '', ''),
(49, 'd', 'Book reading', ''),
(50, 'g', '', ''),
(51, 'f', 'Playing Cricket', ''),
(53, 's', '', ''),
(54, 'd', '', ''),
(55, 'a', '', ''),
(56, 'f', 'Gardening', ''),
(57, 'd', 'Teaching', ''),
(58, 'g', '', ''),
(59, 'f', 'Playing Cricket', ''),
(60, 'd', 'Book reading', ''),
(61, 's', '', ''),
(62, 'd', '', ''),
(63, 'd', '', ''),
(64, 'd', '', ''),
(65, 'g', '', ''),
(66, 'g', '', ''),
(67, 'd', '', ''),
(68, 'd', 'Playing Cricket,Coding,Browsing,Book reading,Gardening,Teaching', ''),
(69, 'd', 'Playing Cricket', ''),
(70, 'd', '', ''),
(71, 'd', '', ''),
(72, 'd', '', ''),
(73, 'f', 'Gardening', ''),
(74, 'f', 'Playing Cricket', ''),
(75, 'd', 'Coding', ''),
(76, 'd', 'Gardening', ''),
(77, 'd', 'Playing Cricket,Coding', ''),
(78, 'a', 'Coding', ''),
(79, 'a', 'Playing Cricket', ''),
(80, 'd', 'Playing Cricket', ''),
(81, 's', 'Book reading', ''),
(82, '', '', ''),
(83, 'f', '', ''),
(84, 'f', '', ''),
(85, 'd', 'Playing Cricket', ''),
(86, 'f', '', ''),
(87, 'g', '', ''),
(88, 'd', '', ''),
(89, 'd', '', ''),
(90, '', '', ''),
(91, 'g', '', ''),
(92, 'g', '', ''),
(93, 'g', 'Playing Cricket', ''),
(94, 'g', 'Playing Cricket', ''),
(95, 's', 'Teaching', ''),
(96, 'f', 'Playing Cricket', ''),
(97, 'd', 'Book reading', ''),
(98, 'a', '', ''),
(99, 'f', 'Playing Cricket', ''),
(101, 'f', 'on', ''),
(102, 'an', ',on', ''),
(103, 'an', ',on', ''),
(104, 'an', ',on', ''),
(105, 'an', ',on', ''),
(106, 'an', ',on', ''),
(107, 'r', 'Playing Cricket', NULL),
(108, 's', 'Coding', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profilepicture`
--

CREATE TABLE IF NOT EXISTS `profilepicture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `active` varchar(50) DEFAULT NULL,
  `deleted_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `profilepicture`
--

INSERT INTO `profilepicture` (`id`, `name`, `images`, `active`, `deleted_at`) VALUES
(10, 'd', '1468265680bitm.jpg', NULL, NULL),
(11, 'anika', '1468265721P_20160315_095936.jpg', '1468988269', NULL),
(12, 'a', '1468353108P_20160315_095936.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE IF NOT EXISTS `summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `summary` text NOT NULL,
  `without_html` varchar(1024) NOT NULL,
  `deleted_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `summary`
--

INSERT INTO `summary` (`id`, `name`, `summary`, `without_html`, `deleted_at`) VALUES
(2, 'v', 'nv s', '', NULL),
(3, 'bmn', ',m m,', '', NULL),
(4, 'knj', 'kjn', '', NULL),
(5, 'b', 'v', '', NULL),
(6, 'anika', '<p>anika...............</p>', 'anika...............', NULL),
(8, 'an', '<p><strong>anika</strong></p>', 'anika', NULL),
(9, 'aa', '<p>aa</p>', '', NULL),
(10, 'aa', '<p>aaaaa</p>', '', NULL),
(11, 'aa', '<p><strong>aaaa</strong></p>', 'aaaa', NULL),
(12, 'aaa', '<p>kndvsl klvndKLvL;.Q;L,d,f lk ls dm asvlma lfdml bslfmb</p>', 'kndvsl klvndKLvL;.Q;L,d,f lk ls dm asvlma lfdml bslfmb', NULL),
(13, 'xas ', '<p>csalmlM,L,LMFLSMDLF LFMW MFLWM;LW M;LQMW;LQM RG;LLML;MG ML MQHLMLEQM</p>', 'csalmlM,L,LMFLSMDLF LFMW MFLWM;LW M;LQMW;LQM RG;LLML;MG ML MQHLMLEQM', NULL),
(14, 'anika', '<p>Ni=oakhal &nbsp;sb sdnmncdxcm</p>', 'Ni=oakhal &nbsp;sb sdnmncdxcm', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
