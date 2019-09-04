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
-- Table structure for table `tbl_payment_gst_customer_credits`
--

CREATE TABLE `tbl_payment_gst_customer_credits` (
  `credit_gst_id` int(200) NOT NULL,
  `firmid` varchar(200) NOT NULL,
  `c_firm_name` varchar(200) NOT NULL,
  `credit_date` varchar(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `total_payment` int(200) NOT NULL,
  `credit_amount` varchar(200) NOT NULL,
  `payment_status` varchar(200) NOT NULL,
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
-- Dumping data for table `tbl_payment_gst_customer_credits`
--

INSERT INTO `tbl_payment_gst_customer_credits` (`credit_gst_id`, `firmid`, `c_firm_name`, `credit_date`, `customer_name`, `total_payment`, `credit_amount`, `payment_status`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '30', '1^Bawana', '08/08/2018', '1', 10000, '936', 'Excess Payment', '1', '08/08/2018 18:53:23', '1', '18-08-08', 'A', '1', '1', '5', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_payment_gst_customer_credits`
--
ALTER TABLE `tbl_payment_gst_customer_credits`
  ADD PRIMARY KEY (`credit_gst_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_payment_gst_customer_credits`
--
ALTER TABLE `tbl_payment_gst_customer_credits`
  MODIFY `credit_gst_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
