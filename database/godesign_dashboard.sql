-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2022 at 06:58 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

--
-- Database: `godesign_dashboard`
--
-- --------------------------------------------------------

--
-- Table structure for table `invoice_user`
--

CREATE TABLE `invoice_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `invoice_user`
AUTO_INCREMENT=1;


-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_due_date` timestamp NOT NULL,
  `invoice_receiver_name` varchar(250) NOT NULL,
  `invoice_receiver_company` varchar(500) DEFAULT NULL,
  `invoice_receiver_street` varchar(500) NOT NULL,
  `invoice_receiver_city` varchar(500) NOT NULL,
  `invoice_receiver_state` varchar(200) NOT NULL,
  `invoice_receiver_country` varchar(300) NOT NULL,
  `invoice_receiver_zip` varchar(10) NOT NULL,
  PRIMARY KEY(`invoice_id`),
  FOREIGN KEY (`user_id`) REFERENCES `invoice_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
AUTO_INCREMENT=1;

--
-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `invoice_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `invoice_item_desc` text NOT NULL,
  `invoice_item_hours` int(11) NOT NULL,
  `invoice_item_hr_rate` int(11) NOT NULL,
  `invoice_item_amount` int(11) NOT NULL,
  PRIMARY KEY(`invoice_item_id`),
  FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--


--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
AUTO_INCREMENT=1;

--
--
-- Dumping data for table `invoice_user`
--

INSERT INTO `invoice_user` (`email`, `password`, `first_name`, `last_name`, `admin`)
		VALUES('root@gmail.com', '$2y$10$WUeF3Cbu82iQO65ncTPb7u6LS0fMRFp.mAIfQI2.BI9GRG6gnIn6G', 'Raiqa', 'Rasool', 1);
		-- --------------------------------------------------------
		--
		COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
