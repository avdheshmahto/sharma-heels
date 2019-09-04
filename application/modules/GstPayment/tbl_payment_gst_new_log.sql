-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2018 at 02:10 PM
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
-- Table structure for table `tbl_payment_gst_new_log`
--

CREATE TABLE `tbl_payment_gst_new_log` (
  `payment_gst_dtl_id` int(200) NOT NULL,
  `payment_hdr_id` varchar(200) NOT NULL,
  `inv_no` varchar(200) NOT NULL,
  `inv_amt` varchar(200) NOT NULL,
  `amount_due` varchar(200) NOT NULL,
  `payment` varchar(200) NOT NULL,
  `payment_status` varchar(200) NOT NULL,
  `pay_status` varchar(200) NOT NULL,
  `inv_date` varchar(200) DEFAULT NULL,
  `zone_id` varchar(225) NOT NULL,
  `brnh_id` varchar(225) NOT NULL,
  `divn_id` varchar(225) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` varchar(200) NOT NULL,
  `author_date` date NOT NULL,
  `comp_id` varchar(200) NOT NULL,
  `author_id` varchar(225) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_payment_gst_new_log`
--
ALTER TABLE `tbl_payment_gst_new_log`
  ADD PRIMARY KEY (`payment_gst_dtl_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_payment_gst_new_log`
--
ALTER TABLE `tbl_payment_gst_new_log`
  MODIFY `payment_gst_dtl_id` int(200) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
