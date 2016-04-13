-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2016 at 05:43 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `messages_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users` int(11) NOT NULL,
  `watched` int(2) NOT NULL,
  `conversation_name` varchar(50) NOT NULL,
  `last_sender` int(11) NOT NULL,
  `last_message` varchar(60) NOT NULL,
  `last_date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Table structure for table `joined_conversations`
--

CREATE TABLE IF NOT EXISTS `joined_conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `joined_date` varchar(20) NOT NULL,
  `conversationid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conversationid` (`conversationid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

-- --------------------------------------------------------

--
-- Table structure for table `messsages`
--

CREATE TABLE IF NOT EXISTS `messsages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversationid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `sent_date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conversationid` (`conversationid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=180 ;

-- --------------------------------------------------------

--
-- Table structure for table `personalaccount`
--

CREATE TABLE IF NOT EXISTS `personalaccount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `pictureurl` varchar(200) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `website` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `birthday` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `addrline1` varchar(200) NOT NULL,
  `addrline2` varchar(200) NOT NULL,
  `citytown` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `associatedwithorganizer` varchar(200) NOT NULL,
  `verified` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL,
  `verification_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `joined_conversations`
--
ALTER TABLE `joined_conversations`
  ADD CONSTRAINT `conversationid` FOREIGN KEY (`conversationid`) REFERENCES `conversations` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
