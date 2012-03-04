-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2012 at 04:01 PM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chatroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE IF NOT EXISTS `chat_messages` (
  `msg_id` bigint(14) NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(10) NOT NULL,
  `to_enroll` int(8) NOT NULL,
  `to_user` varchar(30) NOT NULL,
  `from_enroll` int(8) NOT NULL,
  `from_user` varchar(30) NOT NULL,
  `msg` text NOT NULL,
  `time` bigint(14) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- Table structure for table `chat_session`
--

CREATE TABLE IF NOT EXISTS `chat_session` (
  `chat_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `from_enroll` int(8) NOT NULL,
  `to_enroll` int(8) NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `to_user` (`to_enroll`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `stud_data`
--

CREATE TABLE IF NOT EXISTS `stud_data` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(25) NOT NULL,
  `usr_roll` int(10) NOT NULL,
  `usr_pass` varchar(36) NOT NULL,
  `online` varchar(3) NOT NULL,
  `time` bigint(18) NOT NULL COMMENT 'this time get updated via script show_online.php when the user is online',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE IF NOT EXISTS `user_status` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `enroll` int(8) NOT NULL,
  `writing` varchar(3) NOT NULL DEFAULT 'no',
  `time` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enroll` (`enroll`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
