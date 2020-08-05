-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2020 at 08:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organic_roots`
--

-- --------------------------------------------------------

--
-- Table structure for table `or_address`
--

CREATE TABLE `or_address` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `landmark` text NOT NULL,
  `lat` text NOT NULL,
  `long` text NOT NULL,
  `city` text NOT NULL,
  `district` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `postcode` text NOT NULL,
  `is_default` enum('Y','N') NOT NULL DEFAULT 'Y',
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `or_admin`
--

CREATE TABLE `or_admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `password` text NOT NULL,
  `rest_code` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `or_admin`
--

INSERT INTO `or_admin` (`id`, `first_name`, `last_name`, `email`, `phone`, `image`, `password`, `rest_code`, `date_added`) VALUES
(1, 'test', 'acc', 'or@yopmail.com', '', '', '5f4dcc3b5aa765d61d8327deb882cf99', '0', '2020-07-20 14:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `or_banners`
--

CREATE TABLE `or_banners` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `thumb` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A =active ,I= inactive',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `or_banners`
--

INSERT INTO `or_banners` (`id`, `name`, `image`, `thumb`, `status`, `date_added`) VALUES
(3, 'dfrersss', '867e37f47c6aabee14f69452ad2ad226.jpg', '867e37f47c6aabee14f69452ad2ad226.jpg', 'I', '2020-07-23 16:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `or_cart`
--

CREATE TABLE `or_cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `or_categories`
--

CREATE TABLE `or_categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `is_home` enum('Y','N') NOT NULL DEFAULT 'Y',
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A =active ,I= inactive',
  `image` text NOT NULL,
  `thumb` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `or_categories`
--

INSERT INTO `or_categories` (`id`, `parent_id`, `name`, `is_home`, `status`, `image`, `thumb`, `date_added`) VALUES
(2, 1, 'test sub', 'Y', 'A', '36814b1a07df374ef642bfcb8fdb4017.jpg', '36814b1a07df374ef642bfcb8fdb4017.jpg', '2020-07-24 16:34:14'),
(4, 0, 'test 23', 'N', 'A', 'fb458d63d0ffa720085cb51e91c7551c.jpg', 'fb458d63d0ffa720085cb51e91c7551c.jpg', '2020-07-26 13:12:58'),
(5, 4, 'fruits', 'Y', 'A', '915fdef7371a32cd0deb94f508c0c9de.jpg', '915fdef7371a32cd0deb94f508c0c9de.jpg', '2020-07-26 13:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `or_customers`
--

CREATE TABLE `or_customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `thumb` text NOT NULL,
  `password` text NOT NULL,
  `token` text NOT NULL,
  `rest_code` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `or_customers`
--

INSERT INTO `or_customers` (`id`, `first_name`, `last_name`, `email`, `phone`, `image`, `thumb`, `password`, `token`, `rest_code`, `status`, `date_added`) VALUES
(1, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(2, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(3, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(4, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(5, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(6, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(7, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(8, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(9, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(10, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(11, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(12, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(13, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(14, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(15, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(16, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(17, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(18, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(19, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(20, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(21, 'irshad', 'mv', 'mv.irshad7@gmail.com', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42'),
(22, 'irshad', 'mv', 'mv.irshad7@gmail.com1', '9961262027', '51a77d95a926792540dfd82e95ea37de.jpg', '51a77d95a926792540dfd82e95ea37de.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'A', '2020-08-01 12:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `or_farmers`
--

CREATE TABLE `or_farmers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `thumb` text NOT NULL,
  `product_code` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `or_farmers`
--

INSERT INTO `or_farmers` (`id`, `name`, `image`, `thumb`, `product_code`, `status`, `date_added`) VALUES
(2, 'ram', '9a36df2f34a166d9430f56f1853413f0.jpg', '9a36df2f34a166d9430f56f1853413f0.jpg', 'saasa', 'A', '2020-07-29 22:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `or_information`
--

CREATE TABLE `or_information` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `or_order`
--

CREATE TABLE `or_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `postcode` text NOT NULL,
  `city` text NOT NULL,
  `district` text NOT NULL,
  `state` text NOT NULL,
  `landmark` text NOT NULL,
  `lat` text NOT NULL,
  `long` text NOT NULL,
  `shipping_charge` float NOT NULL,
  `offer_price` float NOT NULL,
  `subtotal` float NOT NULL,
  `total` float NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `order_status` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `or_order_product`
--

CREATE TABLE `or_order_product` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `amount` float NOT NULL,
  `option_name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `or_order_status`
--

CREATE TABLE `or_order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `or_order_status`
--

INSERT INTO `or_order_status` (`id`, `name`, `status`, `date_added`) VALUES
(1, 'Received', 'A', '2020-07-18 21:22:50'),
(2, 'Processing', 'A', '2020-07-18 21:22:50'),
(3, 'Deliverd', 'A', '2020-07-18 21:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `or_postcodes`
--

CREATE TABLE `or_postcodes` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `postcode` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `or_products`
--

CREATE TABLE `or_products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `image` text NOT NULL,
  `thumb` text NOT NULL,
  `qty` int(11) NOT NULL,
  `offer_percentage` float NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `or_product_images`
--

CREATE TABLE `or_product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` enum('A','I') NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `or_product_options`
--

CREATE TABLE `or_product_options` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `price_prefix` varchar(1) NOT NULL,
  `status` enum('A','I') NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `or_product_to_category`
--

CREATE TABLE `or_product_to_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `or_address`
--
ALTER TABLE `or_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_admin`
--
ALTER TABLE `or_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_banners`
--
ALTER TABLE `or_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_cart`
--
ALTER TABLE `or_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_categories`
--
ALTER TABLE `or_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_customers`
--
ALTER TABLE `or_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_farmers`
--
ALTER TABLE `or_farmers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_information`
--
ALTER TABLE `or_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_order`
--
ALTER TABLE `or_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_order_product`
--
ALTER TABLE `or_order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_order_status`
--
ALTER TABLE `or_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_postcodes`
--
ALTER TABLE `or_postcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_products`
--
ALTER TABLE `or_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_product_images`
--
ALTER TABLE `or_product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_product_options`
--
ALTER TABLE `or_product_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_product_to_category`
--
ALTER TABLE `or_product_to_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `or_address`
--
ALTER TABLE `or_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `or_admin`
--
ALTER TABLE `or_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `or_banners`
--
ALTER TABLE `or_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `or_cart`
--
ALTER TABLE `or_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `or_categories`
--
ALTER TABLE `or_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `or_customers`
--
ALTER TABLE `or_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `or_farmers`
--
ALTER TABLE `or_farmers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `or_information`
--
ALTER TABLE `or_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `or_order`
--
ALTER TABLE `or_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `or_order_product`
--
ALTER TABLE `or_order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `or_order_status`
--
ALTER TABLE `or_order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `or_postcodes`
--
ALTER TABLE `or_postcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `or_products`
--
ALTER TABLE `or_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `or_product_images`
--
ALTER TABLE `or_product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `or_product_options`
--
ALTER TABLE `or_product_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `or_product_to_category`
--
ALTER TABLE `or_product_to_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
