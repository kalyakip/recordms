-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2015 at 04:49 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Create the database if it does not exist
CREATE DATABASE IF NOT EXISTS `rms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rms`;

-- --------------------------------------------------------

-- Table structure for table `client`
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;

-- Insert data into table `client`
INSERT INTO `client` (`client_id`, `school_id`, `firstname`, `middlename`, `lastname`, `type`, `department`, `contact`, `date`) VALUES

-- --------------------------------------------------------

-- Table structure for table `history`
CREATE TABLE IF NOT EXISTS `history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `action` varchar(100) NOT NULL,
  `data` varchar(100) NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=82;

-- Insert data into table `history`
-- (No data provided in the dump)

-- --------------------------------------------------------

-- Table structure for table `item`
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_brand` varchar(100) NOT NULL,
  `item_description` varchar(100) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

-- Insert data into table `item`
INSERT INTO `item` (`item_id`, `item_id_id`, `item_name`, `item_brand`, `item_description`, `item_qty`, `item_price`, `item_type`, `date`) VALUES
(1, 21002340, 'Xtyle Optical Mouse', 'Mac', 'Optical Mouse', 60, 200, 'Consumable', '2015-11-17 13:35:08'),
(2, 23508020, 'USB Cord', 'Samsung', 'USB Cord 3.0', 35, 180, 'Non-Consumable', '2015-11-18 15:44:13'),
(3, 82458334, 'Mouse Pad', 'Acer', 'Mouse Pad Duo', 46, 50, 'Non-Consumable', '2015-11-20 13:37:30');

-- --------------------------------------------------------

-- Table structure for table `release_details`
CREATE TABLE IF NOT EXISTS `release_details` (
  `release_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `release_status` varchar(100) NOT NULL,
  `date_return` datetime NOT NULL,
  PRIMARY KEY (`release_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------

-- Table structure for table `tbl_release`
CREATE TABLE IF NOT EXISTS `tbl_release` (
  `release_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `date_borrow` datetime NOT NULL,
  PRIMARY KEY (`release_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------

-- Table structure for table `transaction_history`
CREATE TABLE IF NOT EXISTS `transaction_history` (
  `transaction_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `client_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`transaction_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=10;

-- Insert data into table `transaction_history`
-- (No data provided in the dump)

-- --------------------------------------------------------

-- Table structure for table `user`
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;

-- Insert data into table `user`
-- (No data provided in the dump)

-- End of SQL dump
