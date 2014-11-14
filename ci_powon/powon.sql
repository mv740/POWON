-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2014 at 04:54 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `powon`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `powon_id` int(11) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `name`, `powon_id`, `description`) VALUES
(1, 'Dat Group', 1, 'First group'),
(2, 'Mah Group', 5, 'So cool!\r\n'),
(3, 'awdaw', 5, 'dawdawd');

-- --------------------------------------------------------

--
-- Table structure for table `join_request`
--

CREATE TABLE IF NOT EXISTS `join_request` (
  `group_id` int(11) NOT NULL,
  `powon_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`powon_id`),
  KEY `fk_group_has_member1_member1_idx` (`powon_id`),
  KEY `fk_group_has_member1_group1_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `join_request`
--

INSERT INTO `join_request` (`group_id`, `powon_id`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `powon_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `address` mediumtext NOT NULL,
  `email` varchar(45) NOT NULL,
  `dob` date NOT NULL,
  `description` longtext,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `privilege` enum('member','admin') NOT NULL DEFAULT 'member',
  PRIMARY KEY (`powon_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `powon_id_UNIQUE` (`powon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`powon_id`, `username`, `password`, `first_name`, `last_name`, `address`, `email`, `dob`, `description`, `status`, `privilege`) VALUES
(1, 'Jason', 'Sotzky', 'jason', 'sotzky', 'awdawdawd', 'awdawd@hotmail.com', '1990-02-27', 'akwmdkawdawdawd', 'active', 'member'),
(2, 'Daniel', 'Hackle', 'Daniel', 'Hackle', 'awdawdawdawdawd', 'awdawdawd', '1990-02-27', 'awdawdawd', 'active', 'member'),
(3, 'Michal', 'Wozniak', 'Michal', 'Wozniak', 'awdawdawdawdawd', 'awdawdawdawd', '1992-02-12', NULL, 'active', 'member'),
(4, 'Francis', 'Bayard', 'Francis', 'Bayard', 'awdawdjawdkakwdkawdk', 'akwdkakdkawdkakd', '1990-03-22', 'awdawdafff', 'active', 'member'),
(5, 'Sebastian', 'Shah', 'Sebastian', 'Shah', '91j2e91m2e09', '11111', '1990-02-22', 'd1212d13443awd', 'active', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `member_has_thread_access`
--

CREATE TABLE IF NOT EXISTS `member_has_thread_access` (
  `powon_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `restriction` enum('restricted','unrestricted_comment','unrestricted_no_comment') NOT NULL DEFAULT 'unrestricted_no_comment',
  PRIMARY KEY (`powon_id`,`thread_id`),
  KEY `fk_member_has_thread_thread1_idx` (`thread_id`),
  KEY `fk_member_has_thread_member1_idx` (`powon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member_of_group`
--

CREATE TABLE IF NOT EXISTS `member_of_group` (
  `group_id` int(11) NOT NULL,
  `powon_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`powon_id`),
  KEY `fk_group_has_member_member1_idx` (`powon_id`),
  KEY `fk_group_has_member_group1_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_of_group`
--

INSERT INTO `member_of_group` (`group_id`, `powon_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 5),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `member_relates_member`
--

CREATE TABLE IF NOT EXISTS `member_relates_member` (
  `powon_id` int(11) NOT NULL,
  `relates_powon_id` int(11) NOT NULL,
  `family` tinyint(1) NOT NULL DEFAULT '0',
  `friend` tinyint(1) NOT NULL DEFAULT '0',
  `colleague` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`powon_id`,`relates_powon_id`),
  KEY `fk_member_has_member_member2_idx` (`relates_powon_id`),
  KEY `fk_member_has_member_member1_idx` (`powon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_relates_member`
--

INSERT INTO `member_relates_member` (`powon_id`, `relates_powon_id`, `family`, `friend`, `colleague`) VALUES
(1, 2, 0, 1, 1),
(1, 3, 1, 0, 1),
(1, 4, 0, 1, 1),
(2, 4, 1, 1, 0),
(3, 1, 1, 1, 1),
(5, 3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_recieved`
--

CREATE TABLE IF NOT EXISTS `message_recieved` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `date` datetime NOT NULL,
  `reciever_powon_id` int(11) NOT NULL,
  `sender_powon_id` int(11) NOT NULL,
  PRIMARY KEY (`message_id`,`reciever_powon_id`),
  KEY `fk_message_recieved_member1_idx` (`reciever_powon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `message_recieved`
--

INSERT INTO `message_recieved` (`message_id`, `content`, `date`, `reciever_powon_id`, `sender_powon_id`) VALUES
(3, '0', '0000-00-00 00:00:00', 2, 1),
(5, '0', '0000-00-00 00:00:00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_sent`
--

CREATE TABLE IF NOT EXISTS `message_sent` (
  `message_sent_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `date` datetime DEFAULT NULL,
  `sender_powon_id` int(11) NOT NULL,
  `reciever_powon_id` int(11) NOT NULL,
  PRIMARY KEY (`message_sent_id`,`sender_powon_id`),
  KEY `fk_message_sent_member1_idx` (`sender_powon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `date` datetime NOT NULL,
  `powon_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`powon_id`,`thread_id`),
  KEY `fk_post_member1_idx` (`powon_id`),
  KEY `fk_post_thread1_idx` (`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `public_post`
--

CREATE TABLE IF NOT EXISTS `public_post` (
  `public_post_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `date` datetime NOT NULL,
  `powon_id` int(11) NOT NULL,
  PRIMARY KEY (`public_post_id`,`powon_id`),
  KEY `fk_public_post_member1_idx` (`powon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `thead_name` varchar(75) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `powon_id` int(11) NOT NULL,
  PRIMARY KEY (`thread_id`,`group_id`,`powon_id`),
  KEY `fk_thread_group1_idx` (`group_id`),
  KEY `fk_thread_member1_idx` (`powon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `join_request`
--
ALTER TABLE `join_request`
  ADD CONSTRAINT `fk_group_has_member1_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_has_member1_member1` FOREIGN KEY (`powon_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `member_has_thread_access`
--
ALTER TABLE `member_has_thread_access`
  ADD CONSTRAINT `fk_member_has_thread_member1` FOREIGN KEY (`powon_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_member_has_thread_thread1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`thread_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `member_of_group`
--
ALTER TABLE `member_of_group`
  ADD CONSTRAINT `fk_group_has_member_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_has_member_member1` FOREIGN KEY (`powon_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `member_relates_member`
--
ALTER TABLE `member_relates_member`
  ADD CONSTRAINT `fk_member_has_member_member1` FOREIGN KEY (`powon_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_member_has_member_member2` FOREIGN KEY (`relates_powon_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `message_recieved`
--
ALTER TABLE `message_recieved`
  ADD CONSTRAINT `fk_message_recieved_member1` FOREIGN KEY (`reciever_powon_id`) REFERENCES `member` (`powon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message_sent`
--
ALTER TABLE `message_sent`
  ADD CONSTRAINT `fk_message_sent_member1` FOREIGN KEY (`sender_powon_id`) REFERENCES `member` (`powon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_member1` FOREIGN KEY (`powon_id`) REFERENCES `member` (`powon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_thread1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`thread_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `public_post`
--
ALTER TABLE `public_post`
  ADD CONSTRAINT `fk_public_post_member1` FOREIGN KEY (`powon_id`) REFERENCES `member` (`powon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `fk_thread_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_thread_member1` FOREIGN KEY (`powon_id`) REFERENCES `member` (`powon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
