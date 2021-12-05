-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2017 at 01:43 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--
CREATE DATABASE IF NOT EXISTS `pos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pos`;

-- --------------------------------------------------------

--
-- Table structure for table `pos_access`
--

CREATE TABLE `pos_access` (
  `id` int(11) NOT NULL,
  `access_details` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_access`
--

INSERT INTO `pos_access` (`id`, `access_details`) VALUES
(3, 'accounting'),
(1, 'admin'),
(4, 'audit'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `pos_action`
--

CREATE TABLE `pos_action` (
  `id` int(11) NOT NULL,
  `action_name` varchar(50) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `dt_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_action`
--

INSERT INTO `pos_action` (`id`, `action_name`, `added_by`, `dt_added`) VALUES
(1, 'Completed', 1, '2017-03-25 00:00:00'),
(2, 'Cancelled', 1, '2017-03-25 00:00:00'),
(3, 'Re-Completed', 1, '2017-03-25 00:00:00'),
(4, 'View', 1, '2017-03-25 00:00:00'),
(5, 'Reprint', 1, '2017-03-25 00:00:00'),
(6, 'Print List', 1, '2017-03-25 00:00:00'),
(7, 'Export Excel', 1, '2017-03-25 00:00:00'),
(8, 'Search', 1, '2017-03-25 00:00:00'),
(9, 'Advance Search', 1, '2017-03-25 00:00:00'),
(10, 'Add', 1, '2017-03-25 00:00:00'),
(11, 'Update Price', 1, '2017-03-25 00:00:00'),
(12, 'Modify', 1, '2017-03-25 00:00:00'),
(13, 'Delete', 1, '2017-03-25 00:00:00'),
(14, 'Re-Activate', 1, '2017-03-25 00:00:00'),
(15, 'Re-Confirmed', 1, '2017-03-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pos_buyer`
--

CREATE TABLE `pos_buyer` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_buyer_status`
--

CREATE TABLE `pos_buyer_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_buyer_status`
--

INSERT INTO `pos_buyer_status` (`id`, `status`) VALUES
(1, 'ACTIVE'),
(2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `pos_dept`
--

CREATE TABLE `pos_dept` (
  `id` int(11) NOT NULL,
  `dept_code` varchar(5) DEFAULT NULL,
  `dept_name` varchar(60) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `dt_added` varchar(30) NOT NULL DEFAULT '',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `dt_updated` varchar(30) NOT NULL DEFAULT '',
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_dept`
--

INSERT INTO `pos_dept` (`id`, `dept_code`, `dept_name`, `added_by`, `dt_added`, `updated_by`, `dt_updated`, `status_id`) VALUES
(1, 'MIG', 'Management Information Group', 0, '', 0, '', 1),
(2, 'PUR', 'Purchasing', 0, '', 0, '', 1),
(3, 'ADM', 'Administration', 0, '', 0, '', 1),
(4, 'FIN', 'FINANCE', 0, '', 0, '', 1),
(5, 'ACCT', 'ACCOUNTING', 0, '', 0, '', 1),
(6, 'CLIN', 'CLINIC', 0, '', 0, '', 1),
(7, 'AUD', 'AUDIT', 0, '', 0, '', 1),
(8, 'HRD', 'Human Resource Department', 0, '', 0, '', 1),
(9, 'CAS', 'CASHIER', 0, '', 0, '', 1),
(10, 'PAY', 'PAYROLL', 0, '', 0, '', 1),
(11, 'DEC', 'DECK', 1, '2016-03-27 09:17:43 AM', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_discount`
--

CREATE TABLE `pos_discount` (
  `id` int(11) NOT NULL,
  `discount_type` varchar(50) NOT NULL,
  `dt_created` varchar(30) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_module`
--

CREATE TABLE `pos_module` (
  `id` int(11) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `dt_added` datetime NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_module`
--

INSERT INTO `pos_module` (`id`, `module_name`, `added_by`, `dt_added`, `status_id`) VALUES
(1, 'Transaction', 1, '2017-03-25 00:00:00', 1),
(2, 'Product', 1, '2017-03-25 00:00:00', 1),
(3, 'Receiving', 1, '2017-03-25 00:00:00', 1),
(4, 'UOM', 1, '2017-03-25 00:00:00', 1),
(5, 'Supplier', 1, '2017-03-25 00:00:00', 1),
(6, 'Sold Item', 1, '2017-03-25 00:00:00', 1),
(7, 'Buyer Type', 1, '2017-05-30 00:00:00', 1),
(8, 'Pricing', 1, '2017-05-30 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_price`
--

CREATE TABLE `pos_price` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `dt_updated` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_product`
--

CREATE TABLE `pos_product` (
  `id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_uom` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_discount`
--

CREATE TABLE `pos_product_discount` (
  `id` int(11) NOT NULL,
  `discount_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_product_discount`
--

INSERT INTO `pos_product_discount` (`id`, `discount_type`) VALUES
(1, 'Percentage'),
(3, 'Total Price'),
(2, 'Unit Price');

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_status`
--

CREATE TABLE `pos_product_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_product_status`
--

INSERT INTO `pos_product_status` (`id`, `status`) VALUES
(1, 'ACTIVE'),
(2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `pos_sale`
--

CREATE TABLE `pos_sale` (
  `id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `tran_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT '1.00',
  `buyer_id` int(11) NOT NULL DEFAULT '0',
  `current_price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_type` int(11) NOT NULL DEFAULT '0',
  `discount_qty` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_sale_status`
--

CREATE TABLE `pos_sale_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_sale_status`
--

INSERT INTO `pos_sale_status` (`id`, `status`) VALUES
(1, 'COMPLETED'),
(2, 'CANCELLED');

-- --------------------------------------------------------

--
-- Table structure for table `pos_sale_temp`
--

CREATE TABLE `pos_sale_temp` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT '1.00',
  `buyer_id` int(11) NOT NULL DEFAULT '0',
  `current_price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_type` int(11) NOT NULL DEFAULT '0',
  `discount_qty` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total` decimal(20,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_stock`
--

CREATE TABLE `pos_stock` (
  `id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT '1.00',
  `supplier_id` int(11) NOT NULL,
  `received_by` int(11) NOT NULL,
  `dt_encoded` varchar(30) NOT NULL,
  `dt_cancelled` varchar(30) DEFAULT NULL,
  `cancelled_by` int(11) DEFAULT NULL,
  `cancelled_reason` text,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_stock_status`
--

CREATE TABLE `pos_stock_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_stock_status`
--

INSERT INTO `pos_stock_status` (`id`, `status`) VALUES
(1, 'CONFIRMED'),
(2, 'CANCELLED');

-- --------------------------------------------------------

--
-- Table structure for table `pos_supplier`
--

CREATE TABLE `pos_supplier` (
  `id` int(11) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_trail`
--

CREATE TABLE `pos_trail` (
  `id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `module_id` int(11) NOT NULL DEFAULT '0',
  `action_id` int(11) NOT NULL DEFAULT '0',
  `particular` text NOT NULL,
  `remarks` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_trail_login`
--

CREATE TABLE `pos_trail_login` (
  `id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `local_ip` varchar(64) DEFAULT NULL,
  `public_ip` varchar(64) DEFAULT NULL,
  `computer_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_trail_price`
--

CREATE TABLE `pos_trail_price` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `dt_created` varchar(30) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_trail_stock`
--

CREATE TABLE `pos_trail_stock` (
  `id` int(11) NOT NULL,
  `dt` varchar(30) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_trail_transaction`
--

CREATE TABLE `pos_trail_transaction` (
  `id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `tran_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_transaction`
--

CREATE TABLE `pos_transaction` (
  `id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `subtotal` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_type` int(11) NOT NULL DEFAULT '0',
  `discount_qty` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `tran_cash` decimal(20,2) NOT NULL DEFAULT '0.00',
  `tran_change` decimal(20,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) NOT NULL,
  `remarks` text,
  `dt_cancelled` datetime DEFAULT NULL,
  `cancelled_by` int(11) NOT NULL DEFAULT '0',
  `cancelled_reason` text,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_transaction_discount`
--

CREATE TABLE `pos_transaction_discount` (
  `id` int(11) NOT NULL,
  `discount_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_transaction_discount`
--

INSERT INTO `pos_transaction_discount` (`id`, `discount_type`) VALUES
(2, 'Amount'),
(1, 'Percentage');

-- --------------------------------------------------------

--
-- Table structure for table `pos_transaction_status`
--

CREATE TABLE `pos_transaction_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_transaction_status`
--

INSERT INTO `pos_transaction_status` (`id`, `status`) VALUES
(1, 'COMPLETED'),
(2, 'CANCELLED');

-- --------------------------------------------------------

--
-- Table structure for table `pos_uom`
--

CREATE TABLE `pos_uom` (
  `id` int(11) NOT NULL,
  `uom` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_uom`
--

INSERT INTO `pos_uom` (`id`, `uom`, `description`) VALUES
(1, 'KG', 'kilo');

-- --------------------------------------------------------

--
-- Table structure for table `pos_user`
--

CREATE TABLE `pos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL DEFAULT '',
  `dept_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `access_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_user`
--

INSERT INTO `pos_user` (`id`, `username`, `password`, `fname`, `lname`, `mname`, `dept_id`, `email`, `access_id`, `status_id`, `added_by`, `date_added`) VALUES
(1, 'jaypee.hindang', '$2y$12$fxFfMSKyotrXlft3a.12kOF1LLRiuKRxKV0QCbSKm3.DwPtDcIJCu', 'jaypee', 'hindang', '', 1, 'eujay_29@yahoo.com.ph', 1, 1, 1, '2015-06-10'),
(2, 'kelly.activa', '$2y$12$J5jcaPsh/SOCburUeEBOPO/5vAOoZsDRogTMbREEXHOq.Of8gxRJK', 'Kelly', 'Activa', '', 1, NULL, 1, 1, 1, '2016-06-26'),
(10, 'audit', '$2y$12$1ZMYdbKxpAtE0R3T2xCFW.dqyx8JGfXIMHwOEfo3szAz7xyW6uktW', 'Audit', 'Department', '', 8, NULL, 4, 1, 1, '2016-06-26'),
(11, 'accounting', '$2y$12$1ZMYdbKxpAtE0R3T2xCFW.dqyx8JGfXIMHwOEfo3szAz7xyW6uktW', 'Accounting', 'Department', '', 4, '', 3, 1, 1, '2016-06-26'),
(12, 'trinnee.audit', '$2y$12$cnqbGOz/697F1XVplTdV6OggVxDPYo1o7Q0AtjAQY8R14RJNO.iQy', 'Trinnee', 'Pecundo', '', 10, '', 4, 1, 1, '2016-07-29'),
(13, 'timekeeper', '$2y$12$t3.htAt0mGtdL77tcGCHuuLe3FJZ8qctxnbkC5MlpoHV.QGbh/VvS', 'timekeeper', 'production', '', 10, '', 9, 1, 1, '2016-07-29'),
(14, 'user', '$2y$12$e5jDU9UMzXn9qMXPx.AMP.WCSBCRAZuH7ib/tl3sbhjFxrO./05Ae', 'user', 'user', '', 3, '', 2, 1, 1, '2016-11-07'),
(15, 'melvin.ebesate', '$2y$12$wJej9i.nzkRkM.yZYQKko.NFbyhu7dnD3cvNMt8KCSd55FCuFKHZa', 'Melvin', 'Ebesate', '', 1, '', 1, 1, 1, '2016-12-20'),
(16, 'test2', '$2y$12$uOpqwVSl9DCtSw1533.qverxDUfVMQ0R6PkB5WSjEl.ciCrz4YlbW', 'test2', 'test2', '', 3, '', 3, 1, 1, '2016-12-20'),
(17, 'admin', '$2y$12$hAqAkUzogX01pCf510wuh.b1Q4/mDfYXcQtaWgqwM59h6WR/2Zcs.', 'ADMIN', 'ADMIN', '', 3, '', 2, 1, 1, '2017-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `pos_user_status`
--

CREATE TABLE `pos_user_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_user_status`
--

INSERT INTO `pos_user_status` (`id`, `status`) VALUES
(1, 'ACTIVE'),
(2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qoutes`
--

CREATE TABLE `tbl_qoutes` (
  `id` int(11) NOT NULL,
  `qoutes` text NOT NULL,
  `author` varchar(100) NOT NULL DEFAULT '',
  `dt_added` varchar(30) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_qoutes`
--

INSERT INTO `tbl_qoutes` (`id`, `qoutes`, `author`, `dt_added`, `added_by`, `status_id`) VALUES
(1, 'Ability is what you''re capable of doing. \r\nMotivation determines what you do. \r\nAttitude determines how well you do it.', 'Lou Holtz', '2016-08-17 09:45:00 PM', 1, 1),
(2, 'A great attitude becomes a great day, which becomes a great month, which becomes a great year, which becomes a great life.', 'Mandy Hale', '2016-08-17 09:45:00 PM', 1, 1),
(3, 'All our dreams can come true - if we have the courage to pursue them.', 'Walt Disney', '2016-08-17 09:45:00 PM', 1, 1),
(4, 'All things are difficult before they are easy.', 'Thomas Fuller', '2016-08-17 09:45:00 PM', 1, 1),
(5, 'Always be a first-rate version of yourself, instead of a second-rate version of somebody else.', 'Judy Garland', '2016-08-17 09:45:00 PM', 1, 1),
(6, 'Always dream and shoot higher than you know you can do. Don''t bother just to be better than your contemporaries or predecessors. Try to be better than yourself.', 'William Faulkner', '2016-08-17 09:45:00 PM', 1, 1),
(7, 'Always remember: \r\nYou''re braver than you believe, \r\nstronger than you seem, \r\nand smarter than you think.', 'A.A. Milne - Christopher Robin to Pooh', '2016-08-17 09:45:00 PM', 1, 1),
(8, 'A man is but of product of his thought. \r\nWhat he thinks he becomes.', 'Mahatma Gandhi', '2016-08-17 09:45:00 PM', 1, 1),
(9, 'And will you succeed? Yes indeed, yes indeed! Ninety-eight and three-quarters percent guaranteed!', 'Dr. Seuss', '2016-08-17 09:45:00 PM', 1, 1),
(10, 'Anyone who has never made a mistake has never tried anything new', 'Albert Einstein', '2016-08-17 09:45:00 PM', 1, 1),
(11, 'A person will only leave their comfort zone once they decide that magic and adventure outweigh complete certainty and security.', 'Doe Zantamata', '2016-08-17 09:45:00 PM', 1, 1),
(12, 'A problem is a chance for you to do your best.', 'Duke Ellington', '2016-08-17 09:45:00 PM', 1, 1),
(13, 'A ship in harbor is safe - but that is not what ships are built for.', 'John A. Shedd', '2016-08-17 09:45:00 PM', 1, 1),
(14, 'Beautiful pictures are developed from negatives in a dark room. So if you see darkness in your life be reassured that a beautiful picture is being prepared.', 'Author Unknown', '2016-08-17 10:00:00 PM', 1, 1),
(15, 'Confidence is contagious. So is lack of confidence.', 'Vince Lombardi', '2016-08-17 10:00:00 PM', 1, 1),
(16, 'Courage is very important. Like a muscle, it is strengthened by use.', 'Ruth Gordon', '2016-08-17 10:00:00 PM', 1, 1),
(17, 'Don''t be afraid to give your best to what seemingly are small jobs. Every time you conquer one it makes you that much stronger. If you do the little jobs well, the big ones will tend to take care of themselves.', 'Dale Carnegie', '2016-08-17 10:00:00 PM', 0, 1),
(18, 'Don''t cry because it''s over. Smile because it happened.', 'Dr. Seuss', '2016-08-17 10:00:00 PM', 0, 1),
(19, 'Don''t give up. I believe in you all. \r\nA person''s a person no matter how small.', 'Dr. Seuss', '2016-08-17 10:00:00 PM', 1, 1),
(20, 'They say you only fall in love once, but that can''t be true. Every time I look at you, I fall in love all over again.', 'Anonymous', '2016-08-17 10:00:00 PM', 1, 1),
(21, 'Every love story is beautiful but ours is my favorite.', 'Anonymous', '2016-08-17 10:00:00 PM', 1, 1),
(22, 'When I saw you, I was afraid to meet you. When I met you, I was afraid to kiss you. When I kissed you, I was afraid to love you. Now that I love you, I''m afraid to lose you.', 'Rene Yasenek', '2016-08-17 10:00:00 PM', 1, 1),
(23, 'The best way to not get your heart broken, is pretending you don''t have one.', 'Charlie Sheen', '2016-08-17 10:00:00 PM', 1, 1),
(24, 'A true friend knows your weaknesses but shows you your strengths; feels your fears but fortifies your faith; sees your anxieties but frees your spirit; recognizes your disabilities but emphasizes your possibilities.', 'William Arthur Ward', '2016-08-17 10:00:00 PM', 1, 1),
(25, 'If I could give you one thing in life, I would give you the ability to see yourself through my eyes, only then will you realize how special you are to me.', 'Anonymous', '2016-08-17 10:00:00 PM', 1, 1),
(26, 'Some people are like clouds. When they go away, it''s a brighter day.', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(27, 'Don''t know where your kids are in the house? Turn off the internet and they''ll show up quickly.', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(28, 'I changed my password everywhere to ''incorrect.'' That way when I forget it, it always reminds me, ''Your password is incorrect.''', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(29, 'When you wake up at 6 in the morning, you close your eyes for 5 minutes and it''s already 6:45. When you''re at work and it''s 2:30, you close your eyes for 5 minutes and it''s 2:31.', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(30, 'A best friend is like a four leaf clover, hard to find, lucky to have.', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(31, 'I know the voices in my head aren''t real..... but sometimes their ideas are just absolutely awesome!', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(32, 'I don''t need a hair stylist, my pillow gives me a new hairstyle every morning. ', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(33, 'I don''t need a hair stylist, my pillow gives me a new hairstyle every morning. ', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(34, 'I miss the days when you could just push someone in the swimming pool without worrying about their cell phone.', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(35, 'I''m not running away from hard work, I''m too lazy to run.', 'Anonymous', '2016-08-17 10:13:00 PM', 0, 1),
(36, 'Dear humans, in case you forgot, I used to be your Internet. Sincerely, The Library.  ', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(37, 'For you, I would swim across the ocean. LOL, just kidding, there are sharks in there.', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(38, 'Never wrestle with a pig. You''ll both get dirty, and the pig likes it.', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(39, 'Your eyes water when you yawn because you miss your bed and it makes you sad. ', 'Anonymous', '2016-08-17 10:13:00 PM', 1, 1),
(40, 'Reporter: "Excuse me, may I interview you?" \r\nMan: "Yes!" \r\nReporter: "Name?" \r\nMan: "Abdul Al-Rhazim." \r\nReporter: "Sex?" \r\nMan: "Three to five times a week." \r\nReporter: "No no! I mean male or female?" \r\nMan: "Yes, male, female... sometimes camel." \r\nReporter: "Holy cow!" \r\nMan: "Yes, cow, sheep... animals in general." \r\nReporter: "But isn''t that hostile?" \r\nMan: "Yes, horse style, dog style, any style." \r\nReporter: "Oh dear!" \r\nMan: "No, no deer. Deer run too fast. Hard to catch."', 'anonymous', '2016-10-20 04:01:00 PM', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pos_access`
--
ALTER TABLE `pos_access`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_details` (`access_details`);

--
-- Indexes for table `pos_action`
--
ALTER TABLE `pos_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_buyer`
--
ALTER TABLE `pos_buyer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `pos_buyer_status`
--
ALTER TABLE `pos_buyer_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `pos_dept`
--
ALTER TABLE `pos_dept`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dept_code` (`dept_code`,`dept_name`);

--
-- Indexes for table `pos_discount`
--
ALTER TABLE `pos_discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_module`
--
ALTER TABLE `pos_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_price`
--
ALTER TABLE `pos_price`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buyer_id` (`buyer_id`,`product_id`);

--
-- Indexes for table `pos_product`
--
ALTER TABLE `pos_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `pos_product_discount`
--
ALTER TABLE `pos_product_discount`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `discount_type` (`discount_type`);

--
-- Indexes for table `pos_product_status`
--
ALTER TABLE `pos_product_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `pos_sale`
--
ALTER TABLE `pos_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_sale_status`
--
ALTER TABLE `pos_sale_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_sale_temp`
--
ALTER TABLE `pos_sale_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_stock`
--
ALTER TABLE `pos_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_stock_status`
--
ALTER TABLE `pos_stock_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_supplier`
--
ALTER TABLE `pos_supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier` (`supplier`);

--
-- Indexes for table `pos_trail`
--
ALTER TABLE `pos_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_trail_login`
--
ALTER TABLE `pos_trail_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_trail_price`
--
ALTER TABLE `pos_trail_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_trail_stock`
--
ALTER TABLE `pos_trail_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_trail_transaction`
--
ALTER TABLE `pos_trail_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_transaction`
--
ALTER TABLE `pos_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_transaction_discount`
--
ALTER TABLE `pos_transaction_discount`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `discount_type` (`discount_type`);

--
-- Indexes for table `pos_transaction_status`
--
ALTER TABLE `pos_transaction_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_uom`
--
ALTER TABLE `pos_uom`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uom` (`uom`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `pos_user`
--
ALTER TABLE `pos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pos_user_status`
--
ALTER TABLE `pos_user_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_qoutes`
--
ALTER TABLE `tbl_qoutes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pos_access`
--
ALTER TABLE `pos_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pos_action`
--
ALTER TABLE `pos_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pos_buyer`
--
ALTER TABLE `pos_buyer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_buyer_status`
--
ALTER TABLE `pos_buyer_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos_dept`
--
ALTER TABLE `pos_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pos_discount`
--
ALTER TABLE `pos_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_module`
--
ALTER TABLE `pos_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pos_price`
--
ALTER TABLE `pos_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_product`
--
ALTER TABLE `pos_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_product_discount`
--
ALTER TABLE `pos_product_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pos_product_status`
--
ALTER TABLE `pos_product_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos_sale`
--
ALTER TABLE `pos_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_sale_status`
--
ALTER TABLE `pos_sale_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos_sale_temp`
--
ALTER TABLE `pos_sale_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_stock`
--
ALTER TABLE `pos_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_stock_status`
--
ALTER TABLE `pos_stock_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos_supplier`
--
ALTER TABLE `pos_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_trail`
--
ALTER TABLE `pos_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_trail_login`
--
ALTER TABLE `pos_trail_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_trail_price`
--
ALTER TABLE `pos_trail_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_trail_stock`
--
ALTER TABLE `pos_trail_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_trail_transaction`
--
ALTER TABLE `pos_trail_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_transaction`
--
ALTER TABLE `pos_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_transaction_discount`
--
ALTER TABLE `pos_transaction_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos_transaction_status`
--
ALTER TABLE `pos_transaction_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos_uom`
--
ALTER TABLE `pos_uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pos_user`
--
ALTER TABLE `pos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pos_user_status`
--
ALTER TABLE `pos_user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_qoutes`
--
ALTER TABLE `tbl_qoutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
