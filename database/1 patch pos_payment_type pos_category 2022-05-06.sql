-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: May 05, 2022 at 10:32 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `pos_category`
--

DROP TABLE IF EXISTS `pos_category`;
CREATE TABLE IF NOT EXISTS `pos_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_category_status`
--

DROP TABLE IF EXISTS `pos_category_status`;
CREATE TABLE IF NOT EXISTS `pos_category_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_category_status`
--

INSERT INTO `pos_category_status` (`id`, `status`) VALUES
(1, 'ACTIVE'),
(2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `pos_discount`
--

DROP TABLE IF EXISTS `pos_discount`;
CREATE TABLE IF NOT EXISTS `pos_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_type` varchar(50) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_discount`
--

INSERT INTO `pos_discount` (`id`, `discount_type`, `dt_created`, `created_by`, `status_id`) VALUES
(1, 'EMPLOYEE', '2022-04-02 23:40:21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_payment_type`
--

DROP TABLE IF EXISTS `pos_payment_type`;
CREATE TABLE IF NOT EXISTS `pos_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(20) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_type` (`payment_type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_payment_type`
--

INSERT INTO `pos_payment_type` (`id`, `payment_type`, `status_id`) VALUES
(1, 'Cash', 1),
(2, 'eftPOS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_payment_type_status`
--

DROP TABLE IF EXISTS `pos_payment_type_status`;
CREATE TABLE IF NOT EXISTS `pos_payment_type_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_payment_type_status`
--

INSERT INTO `pos_payment_type_status` (`id`, `status`) VALUES
(1, 'ACTIVE'),
(2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_discount`
--

DROP TABLE IF EXISTS `pos_product_discount`;
CREATE TABLE IF NOT EXISTS `pos_product_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `discount_type` (`discount_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_product_discount`
--

INSERT INTO `pos_product_discount` (`id`, `discount_type`) VALUES
(1, 'Percentage'),
(3, 'Total Price'),
(2, 'Unit Price');

-- --------------------------------------------------------

--
-- Table structure for table `pos_transaction_discount`
--

DROP TABLE IF EXISTS `pos_transaction_discount`;
CREATE TABLE IF NOT EXISTS `pos_transaction_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `discount_type` (`discount_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_transaction_discount`
--

INSERT INTO `pos_transaction_discount` (`id`, `discount_type`) VALUES
(2, 'Amount'),
(1, 'Percentage');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
