-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2018 at 10:26 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sph`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_gst_hdr_new`
--

CREATE TABLE `tbl_payment_gst_hdr_new` (
  `payment_gst_id` int(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `c_firm_name` varchar(200) NOT NULL,
  `firmid` varchar(200) NOT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `invoices` varchar(200) NOT NULL,
  `total_amount` varchar(200) NOT NULL,
  `dates` varchar(200) NOT NULL,
  `zone_id` varchar(225) NOT NULL,
  `brnh_id` varchar(225) NOT NULL,
  `divn_id` varchar(225) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` varchar(200) NOT NULL,
  `author_date` date NOT NULL,
  `comp_id` varchar(200) NOT NULL,
  `author_id` varchar(225) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment_gst_hdr_new`
--

INSERT INTO `tbl_payment_gst_hdr_new` (`payment_gst_id`, `customer_name`, `c_firm_name`, `firmid`, `payment_mode`, `invoices`, `total_amount`, `dates`, `zone_id`, `brnh_id`, `divn_id`, `maker_id`, `maker_date`, `author_date`, `comp_id`, `author_id`, `status`) VALUES
(1, '1', '1^Bawana', '30', 'Bank', 'INV015,', '132', '09/08/2018', '1', '5', '1', '1', '09/08/2018 13:01:37', '2018-08-09', '1', '1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_payment_gst_hdr_new`
--
ALTER TABLE `tbl_payment_gst_hdr_new`
  ADD PRIMARY KEY (`payment_gst_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_payment_gst_hdr_new`
--
ALTER TABLE `tbl_payment_gst_hdr_new`
  MODIFY `payment_gst_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;