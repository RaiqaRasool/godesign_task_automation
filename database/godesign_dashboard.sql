-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2022 at 06:58 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `godesign_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_due_date` timestamp NOT NULL,
  `invoice_receiver_name` varchar(250) NOT NULL,
  `invoice_receiver_company` varchar(500) DEFAULT NULL,
  `invoice_receiver_street` varchar(500) NOT NULL,
  `invoice_receiver_city` varchar(500) NOT NULL,
  `invoice_receiver_state` varchar(200) NOT NULL,
  `invoice_receiver_country` varchar(300) NOT NULL,
  `invoice_receiver_zip` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `user_id`, `invoice_date`, `invoice_due_date`, `invoice_receiver_name`, `invoice_receiver_company`, `invoice_receiver_street`, `invoice_receiver_city`, `invoice_receiver_state`, `invoice_receiver_country`, `invoice_receiver_zip`) VALUES
(6, 2000, '2022-08-19 11:47:43', '2022-08-20 19:00:00', 'Rida', 'Raiqa\'s Company', 'Ugoki', 'Sialkot', 'Punjab', 'Pakistan', '5130'),
(8, 2000, '2022-08-19 11:55:40', '2022-08-18 19:00:00', 'Rida', 'Rida\'s Company', 'Ugoki', 'Sialkot', 'Punjab', 'Pakistan', '5130');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `invoice_item_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `invoice_item_desc` text NOT NULL,
  `invoice_item_hours` int(11) NOT NULL,
  `invoice_item_hr_rate` int(11) NOT NULL,
  `invoice_item_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`invoice_item_id`, `invoice_id`, `invoice_item_desc`, `invoice_item_hours`, `invoice_item_hr_rate`, `invoice_item_amount`) VALUES
(11, 8, 'First Updation', 20, 200, 900),
(12, 6, 'asfd', 53, 434, 3);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_user`
--

CREATE TABLE `invoice_user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_user`
--

INSERT INTO `invoice_user` (`id`, `email`, `password`, `first_name`, `last_name`, `admin`) VALUES
(2000, 'rasoolraiqa@gmail.com', '$2y$10$WUeF3Cbu82iQO65ncTPb7u6LS0fMRFp.mAIfQI2.BI9GRG6gnIn6G', 'Raiqa', 'Rasool', b'1'),
(2005, 'ridarasool@gmail.com', '$2y$10$YfFSRgzWNAt24cVcZvbYo.RzhmPoekC8xPPbJBWO3VDnZLLSXABxK', 'Rida', 'Rasool', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_created_by` int(11) NOT NULL,
  `user_last_update_by` int(11) DEFAULT NULL,
  `user_full_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_gender` enum('Male','Female') NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL,
  `user_role` enum('Admin','User') NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_created_at` datetime NOT NULL,
  `user_updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_created_by`, `user_last_update_by`, `user_full_name`, `user_email`, `user_gender`, `user_status`, `user_role`, `user_password`, `user_created_at`, `user_updated_at`) VALUES
(1, 1, 1, 'Raiqa', 'rasoolraiqa@gmail.com', 'Female', 'Active', 'Admin', 'mysql', '2020-06-21 02:08:08', '2020-07-22 00:24:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`invoice_item_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `invoice_user`
--
ALTER TABLE `invoice_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `invoice_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `invoice_user`
--
ALTER TABLE `invoice_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2006;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `invoice_user` (`id`);

--
-- Constraints for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD CONSTRAINT `invoice_item_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
