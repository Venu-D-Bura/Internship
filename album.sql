-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2020 at 05:58 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `album`
--

-- --------------------------------------------------------

--
-- Table structure for table `album_size`
--

CREATE TABLE `album_size` (
  `album_size` varchar(20) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album_size`
--

INSERT INTO `album_size` (`album_size`, `price`) VALUES
('12*12', 2500),
('16*16', 3000),
('4*4', 1000),
('8*8', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `album_type`
--

CREATE TABLE `album_type` (
  `album_type_name` varchar(20) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album_type`
--

INSERT INTO `album_type` (`album_type_name`, `price`) VALUES
('canverra', 15000),
('gold metallic', 40000),
('karizma', 12000),
('matt finish', 35000),
('photo', 10000),
('wedding', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` bigint(20) NOT NULL,
  `payment_id` bigint(20) NOT NULL,
  `installment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `installment` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installments`
--

INSERT INTO `installments` (`id`, `payment_id`, `installment_date`, `installment`) VALUES
(10, 24, '2020-01-21 22:43:17', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) NOT NULL,
  `order_id` bigint(10) NOT NULL,
  `album_type` varchar(20) NOT NULL,
  `album_size` varchar(10) NOT NULL,
  `page_quality` varchar(20) NOT NULL,
  `no_of_pages` int(5) NOT NULL,
  `album_photo` text NOT NULL,
  `ordered_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_date` varchar(20) NOT NULL,
  `advance_payment` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `album_type`, `album_size`, `page_quality`, `no_of_pages`, `album_photo`, `ordered_date`, `delivery_date`, `advance_payment`) VALUES
(10, 24, 'canverra', '4*4', 'Luster 200', 100, '1.jpeg', '2020-01-21 22:43:17', '2020-01-25', 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `page_quality`
--

CREATE TABLE `page_quality` (
  `page_quality` varchar(20) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page_quality`
--

INSERT INTO `page_quality` (`page_quality`, `price`) VALUES
('Luster 200 ', 150),
('Luster 450', 200),
('Matt 300', 300),
('Matte 120', 40),
('McCoy Silk Cover', 100),
('Premium 150', 100),
('Semi-Gloss 300', 300),
('Silk 120', 50),
('Textured I-tone', 500);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) NOT NULL,
  `payment_id` bigint(20) NOT NULL,
  `ordered_date` varchar(20) NOT NULL,
  `advance_payment` float(10,2) NOT NULL,
  `remaining_payment` float(10,2) NOT NULL,
  `total_bill` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `payment_id`, `ordered_date`, `advance_payment`, `remaining_payment`, `total_bill`) VALUES
(10, 24, '2020-01-21 22:43:17', 10000.00, 21000.00, 31000.00);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` bigint(20) NOT NULL,
  `photo` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `photo`, `name`, `email`, `phone_no`) VALUES
(10, '9888899999.png', 'Hemant Dyavarkonda', 'hemant@gmail.com', '9888899999');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album_size`
--
ALTER TABLE `album_size`
  ADD PRIMARY KEY (`album_size`);

--
-- Indexes for table `album_type`
--
ALTER TABLE `album_type`
  ADD PRIMARY KEY (`album_type_name`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `page_quality`
--
ALTER TABLE `page_quality`
  ADD PRIMARY KEY (`page_quality`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
