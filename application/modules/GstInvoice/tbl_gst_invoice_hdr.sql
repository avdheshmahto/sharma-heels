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
-- Table structure for table `tbl_gst_invoice_hdr`
--

CREATE TABLE `tbl_gst_invoice_hdr` (
  `gst_inv_id` int(200) NOT NULL,
  `firm_id` varchar(200) NOT NULL,
  `c_firm_name` varchar(200) NOT NULL,
  `inv_date` varchar(200) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `total` varchar(200) NOT NULL,
  `total_billamt` int(200) NOT NULL,
  `gst_amt` varchar(200) NOT NULL,
  `grand_total` varchar(200) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` varchar(200) NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_gst_invoice_hdr`
--
ALTER TABLE `tbl_gst_invoice_hdr`
  ADD PRIMARY KEY (`gst_inv_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_gst_invoice_hdr`
--
ALTER TABLE `tbl_gst_invoice_hdr`
  MODIFY `gst_inv_id` int(200) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
