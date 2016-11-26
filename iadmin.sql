-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2016 at 06:06 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE IF NOT EXISTS `admin_log` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `MapData`
--

CREATE TABLE IF NOT EXISTS `MapData` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `lattitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `MapData`
--

INSERT INTO `MapData` (`id`, `name`, `description`, `lattitude`, `longitude`) VALUES
(19, 'hyder', 'Birla Mandir<br>\nHill Fort Rd, Hyderabad, Telangana 500004<br>', '17.406287', '78.469095'),
(20, 'hyderabad', '<img src="http://www.keenthemes.com/preview/metronic/theme/assets/global/plugins/jcrop/demos/demo_files/image1.jpg" height="70" width="140"><br><p class="text-warning text-capitalize">hi lakshmaji</p>Mobile<strong>88888</strong><br><div class="label label-primary">OPENS AT :7:50</div><div class="label label-success">CLOSED AT :9:59</div>', '17.454576', '78.384980'),
(29, 'hyder', '<img src="http://www.keenthemes.com/preview/metronic/theme/assets/global/plugins/jcrop/demos/demo_files/image1.jpg" width="140" height="70"><br><p class="text-warning text-capitalize">fghd</p>Mobile<strong>ddgh</strong><br><div class="label label-primary">OPENS AT :dfghdfh</div><div class="label label-success">CLOSED AT :dgh</div>', '17.450473', '78.380979');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`, `address`) VALUES
(2, 'your name goes here', 'address hurry'),
(3, 'its me my name', 'and here is my address. Is it works or ..........How it works??web test completed.'),
(7, 'hi1', 'hi1'),
(8, 'hi2', 'hi2'),
(9, 'hi3', 'hi3'),
(10, 'h6', 'h6'),
(11, 'hu7', 'hu7'),
(12, 'lakshmaji ', 'here is text area which is auto generate');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
