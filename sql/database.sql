-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2020 at 01:29 AM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inveniet`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(32) NOT NULL,
  `uncr_pass` varchar(32) NOT NULL,
  `verify` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `backup_devices`
--

CREATE TABLE IF NOT EXISTS `backup_devices` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` varchar(16) NOT NULL,
  `device_id` varchar(64) NOT NULL,
  `last_ip` varchar(64) NOT NULL,
  `instant` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `fingerprint` varchar(32) NOT NULL,
  `all_info` varchar(256) NOT NULL,
  `imprint` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `backup_targets`
--

CREATE TABLE IF NOT EXISTS `backup_targets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` varchar(16) NOT NULL,
  `target_id` varchar(32) NOT NULL,
  `target_real` varchar(64) NOT NULL,
  `target_desc` varchar(512) NOT NULL,
  `link` varchar(64) NOT NULL,
  `last_ip` varchar(64) NOT NULL,
  `instant` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `fingerprint` varchar(32) NOT NULL,
  `all_info` varchar(256) NOT NULL,
  `imprint` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `target_id` (`target_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `backup_targets_group`
--

CREATE TABLE IF NOT EXISTS `backup_targets_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` varchar(16) NOT NULL,
  `target_id` varchar(32) NOT NULL,
  `target_real` varchar(64) NOT NULL,
  `target_desc` varchar(512) NOT NULL,
  `link` varchar(64) NOT NULL,
  `last_ip` varchar(64) NOT NULL,
  `instant` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `fingerprint` varchar(32) NOT NULL,
  `all_info` varchar(256) NOT NULL,
  `imprint` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fingerprint` (`fingerprint`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` varchar(16) NOT NULL,
  `device_id` varchar(64) NOT NULL,
  `last_ip` varchar(64) NOT NULL,
  `instant` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `fingerprint` varchar(32) NOT NULL,
  `all_info` varchar(256) NOT NULL,
  `imprint` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `devices_blocked`
--

CREATE TABLE IF NOT EXISTS `devices_blocked` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` varchar(16) NOT NULL,
  `device_id` varchar(64) NOT NULL,
  `instant` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE IF NOT EXISTS `system_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` varchar(16) NOT NULL,
  `mode` varchar(4) NOT NULL,
  `time_of_renewal` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE IF NOT EXISTS `targets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` varchar(16) NOT NULL,
  `target_id` varchar(32) NOT NULL,
  `target_real` varchar(64) NOT NULL,
  `target_desc` varchar(512) NOT NULL,
  `link` varchar(64) NOT NULL,
  `last_ip` varchar(64) NOT NULL,
  `instant` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `fingerprint` varchar(32) NOT NULL,
  `all_info` varchar(256) NOT NULL,
  `imprint` varchar(128) NOT NULL,
  `imprint_status` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `target_id` (`target_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Table structure for table `targets_group`
--

CREATE TABLE IF NOT EXISTS `targets_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` varchar(16) NOT NULL,
  `target_id` varchar(32) NOT NULL,
  `target_real` varchar(64) NOT NULL,
  `target_desc` varchar(512) NOT NULL,
  `link` varchar(256) NOT NULL,
  `last_ip` varchar(64) NOT NULL,
  `instant` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `fingerprint` varchar(32) NOT NULL,
  `all_info` varchar(256) NOT NULL,
  `imprint` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fingerprint` (`fingerprint`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
