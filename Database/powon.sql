-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2014 at 03:45 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `date` datetime NOT NULL,
  `sender_powon_id` int(11) NOT NULL,
  `reciever_powon_id` int(11) NOT NULL,
  `sent_visibility` tinyint(1) DEFAULT '1',
  `recieved_visibility` tinyint(1) DEFAULT '1',
  `gift` tinyint(1) NOT NULL DEFAULT '0',
  `gift_content` longtext,
  PRIMARY KEY (`message_id`,`reciever_powon_id`,`sender_powon_id`),
  KEY `fk_message_recieved_member1_idx` (`reciever_powon_id`),
  KEY `fk_message_sender_member2_idx` (`sender_powon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `name`, `owner_id`, `description`) VALUES
(1, '123', 1, '123');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `powon_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address` mediumtext,
  `email` varchar(45) NOT NULL,
  `dob` date NOT NULL,
  `description` longtext,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `privilege` enum('member','admin') NOT NULL DEFAULT 'member',
  `first_name_visibility` enum('public','group','private') NOT NULL DEFAULT 'public',
  `last_name_visibility` enum('public','group','private') NOT NULL DEFAULT 'public',
  `email_visibility` enum('public','group','private') NOT NULL DEFAULT 'public',
  `address_visibility` enum('public','group','private') NOT NULL DEFAULT 'public',
  `dob_visibility` enum('public','group','private') NOT NULL DEFAULT 'public',
  `description_visibility` enum('public','group','private') NOT NULL DEFAULT 'public',
  `profession` enum('n/a','student','teacher','manager','doctor','fireman','astronaut') NOT NULL DEFAULT 'n/a',
  PRIMARY KEY (`powon_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `powon_id_UNIQUE` (`powon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`powon_id`, `username`, `password`, `first_name`, `last_name`, `address`, `email`, `dob`, `description`, `status`, `privilege`, `first_name_visibility`, `last_name_visibility`, `email_visibility`, `address_visibility`, `dob_visibility`, `description_visibility`, `profession`) VALUES
(1, 'Robert', 'pass123', 'Robert', 'Jillian', 'Rob street', 'Rob@hotmail.com', '2000-01-01', 'I am a working engineer at Microsoft I hope to meet cool people.', 'active', 'admin', 'public', 'public', 'public', 'public', 'public', 'public', 'n/a'),
(2, 'Sebastian', 'qwerty', 'Seb', 'Shah', 'Seb street', 'Seb@hotmail.com', '2000-01-01', 'Hey I just started my school semester and am looking to make new friends.', 'active', 'admin', 'public', 'public', 'public', 'public', 'public', 'public', 'n/a'),
(3, 'Jake', '999', 'Jake', 'Wilson', 'Jake street', 'Jake@hotmail.com', '2000-01-01', 'Well my name is Jake Wilson and I am a magician.', 'active', 'member', 'public', 'public', 'public', 'public', 'public', 'public', 'n/a'),
(4, 'Alice', 'password', 'Alice', 'Dupres', 'Alice street', 'Alice@hotmail.com', '2000-01-01', 'I am a POWON enthusiast, I love all things POWON!', 'active', 'member', 'public', 'public', 'public', 'public', 'public', 'public', 'n/a'),
(5, 'Jason', 'database', 'Jason', 'Sotzky', 'Jason street', 'Jason@hotmail.com', '2000-01-01', 'I am Jason and am an avid ventriloquist.', 'active', 'member', 'public', 'public', 'public', 'public', 'public', 'public', 'n/a'),
(6, 'Mike', 'monkey', 'Mike', 'Terrance', 'Mike Street', 'Mike@hotmail.com', '2000-01-01', 'I eat a lot of fastfood.', 'inactive', 'member', 'public', 'public', 'public', 'public', 'public', 'public', 'n/a'),
(7, 'Lyla', 'montreal', 'Lyla', 'Shah', 'Lyla street', 'Lyla@hotmail.com', '2000-01-01', 'This site is pretty kewl!!', 'inactive', 'member', 'public', 'public', 'public', 'public', 'public', 'public', 'n/a'),
(8, 'Michal', 'wozniak', 'Michal', 'Wozniak', 'Michal street', 'Michal@hotmail.com', '2000-01-01', 'I am a lonely man. ', 'suspended', 'member', 'public', 'public', 'public', 'public', 'public', 'public', 'n/a');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member_interests`
--

CREATE TABLE IF NOT EXISTS `member_interests` (
  `powon_id` int(11) NOT NULL,
  `interests` tinytext NOT NULL,
  PRIMARY KEY (`powon_id`,`interests`(1)),
  KEY `fk_member_has_member_interests_member1_idx` (`powon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_of_group`
--

INSERT INTO `member_of_group` (`group_id`, `powon_id`) VALUES
(1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `date` datetime NOT NULL,
  `author_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `upload` longtext,
  `upload_type` longtext,
  PRIMARY KEY (`post_id`,`author_id`,`thread_id`),
  KEY `fk_post_member1_idx` (`author_id`),
  KEY `fk_post_thread1_idx` (`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `public_post`
--

CREATE TABLE IF NOT EXISTS `public_post` (
  `public_post_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `date` datetime NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`public_post_id`,`admin_id`),
  KEY `fk_public_post_member1_idx` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`thread_id`,`group_id`,`author_id`),
  KEY `fk_thread_group1_idx` (`group_id`),
  KEY `fk_thread_member1_idx` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `fk_message_recieved_member100` FOREIGN KEY (`reciever_powon_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_message_sender_member20` FOREIGN KEY (`sender_powon_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
-- Constraints for table `member_interests`
--
ALTER TABLE `member_interests`
  ADD CONSTRAINT `fk_member_has_member_interests_member1` FOREIGN KEY (`powon_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_member1` FOREIGN KEY (`author_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_thread1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`thread_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `public_post`
--
ALTER TABLE `public_post`
  ADD CONSTRAINT `fk_public_post_member1` FOREIGN KEY (`admin_id`) REFERENCES `member` (`powon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `fk_thread_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_thread_member1` FOREIGN KEY (`author_id`) REFERENCES `member` (`powon_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
