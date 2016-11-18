-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2010 at 02:57 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `clock`
--
CREATE DATABASE `clock` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `clock`;

-- --------------------------------------------------------

--
-- Table structure for table `tblclocks`
--

CREATE TABLE IF NOT EXISTS `tblclocks` (
  `intclkid` int(11) NOT NULL AUTO_INCREMENT,
  `intempid` int(11) NOT NULL,
  `intclktype` int(11) NOT NULL,
  `datclkdate` date NOT NULL,
  `datclktime` time NOT NULL,
  PRIMARY KEY (`intclkid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblclocks`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE IF NOT EXISTS `tblemployee` (
  `intempid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txtempfname` char(30) NOT NULL,
  `txtempmname` char(20) NOT NULL,
  `txtemplname` char(40) NOT NULL,
  `txtempclkid` char(15) NOT NULL,
  `intsupvid` int(11) DEFAULT NULL,
  PRIMARY KEY (`intempid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblemployee`
--

