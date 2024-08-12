-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
INSERT INTO `client` (`school_id`, `firstname`, `middlename`, `lastname`, `type`, `department`, `contact`, `date`) VALUES

-- --------------------------------------------------------

-- Table structure for table `history`
CREATE TABLE IF NOT EXISTS `history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `action` varchar(100) NOT NULL,
  `data` varchar(100) NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=131;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;

-- Insert data into table `item`
INSERT INTO `item` (`item_id_id`, `item_name`, `item_brand`, `item_description`, `item_qty`, `item_price`, `item_type`, `date`) VALUES
(93254, 'g', 'g', 'g', 91, 876, 'Consumable', NOW()),
(2359878, 'k', 'k', 'k', 111, 875, 'Non-Consumable', NOW()),
(53673456, 'aaa', 'aaa', 'aaa', 25, 110, 'Non-Consumable', NOW()),
(1, 'Aricon Remote Control', 'Hitachi', 'Air-conditioner', 1, 5000, 'Non-Consumable', NOW());

-- --------------------------------------------------------

-- Table structure for table `original_qty`
CREATE TABLE IF NOT EXISTS `original_qty` (
  `original_qty_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  PRIMARY KEY (`original_qty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;

-- Insert data into table `original_qty`
INSERT INTO `original_qty` (`item_id`, `item_qty`) VALUES
(1, 91),
(2, 111),
(3, 25),
(4, 1);

-- --------------------------------------------------------

-- Table structure for table `release_details`
CREATE TABLE IF NOT EXISTS `release_details` (
  `release_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `release_status` varchar(100) NOT NULL,
  `date_return` datetime NOT NULL,
  PRIMARY KEY (`release_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

-- Insert data into table `release_details`
INSERT INTO `release_details` (`item_id`, `release_id`, `release_status`, `date_return`) VALUES
(4, 1, 'returned', NOW());

-- --------------------------------------------------------

-- Table structure for table `release_qty`
CREATE TABLE IF NOT EXISTS `release_qty` (
  `release_qty_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`release_qty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

-- Insert data into table `release_qty`
INSERT INTO `release_qty` (`item_id`, `release_id`, `client_id`) VALUES
(4, 1, 1);

-- --------------------------------------------------------

-- Table structure for table `tbl_release`
CREATE TABLE IF NOT EXISTS `tbl_release` (
  `release_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `date_borrow` datetime NOT NULL,
  PRIMARY KEY (`release_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

-- Insert data into table `tbl_release`
INSERT INTO `tbl_release` (`client_id`, `date_borrow`) VALUES
(1, NOW());

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=137;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
