-- -------------------------------------------------------------
-- TablePlus 5.3.0(486)
--
-- https://tableplus.com/
--
-- Database: invoice_generator
-- Generation Time: 2023-02-14 22:21:26.6190
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_due_date` timestamp NOT NULL,
  `invoice_receiver_name` varchar(250) NOT NULL,
  `invoice_receiver_company` varchar(500) DEFAULT NULL,
  `invoice_receiver_street` varchar(500) NOT NULL,
  `invoice_receiver_city` varchar(500) NOT NULL,
  `invoice_receiver_state` varchar(200) NOT NULL,
  `invoice_receiver_country` varchar(300) NOT NULL,
  `invoice_receiver_zip` varchar(10) NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `invoice_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

CREATE TABLE `invoice_item` (
  `invoice_item_id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `invoice_item_desc` text NOT NULL,
  `invoice_item_hours` int NOT NULL,
  `invoice_item_hr_rate` int NOT NULL,
  `invoice_item_amount` int NOT NULL,
  PRIMARY KEY (`invoice_item_id`),
  KEY `invoice_id` (`invoice_id`),
  CONSTRAINT `invoice_item_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=409 DEFAULT CHARSET=latin1;

CREATE TABLE `invoice_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2011 DEFAULT CHARSET=latin1;

CREATE TABLE `workscope` (
  `workscope_id` bigint NOT NULL AUTO_INCREMENT,
  `workscope_client` varchar(100) NOT NULL,
  `workscope_company` varchar(255) NOT NULL,
  `workscope_city` varchar(255) NOT NULL,
  `workscope_totalCost` int NOT NULL,
  `workscope_initialAmtPercent` int NOT NULL,
  `workscope_scope` text NOT NULL,
  `workscope_notes` text NOT NULL,
  `user_id` int NOT NULL,
  `workscope_date` timestamp NOT NULL,
  PRIMARY KEY (`workscope_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `workscope_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `invoice_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `invoice` (`invoice_id`, `user_id`, `invoice_date`, `invoice_due_date`, `invoice_receiver_name`, `invoice_receiver_company`, `invoice_receiver_street`, `invoice_receiver_city`, `invoice_receiver_state`, `invoice_receiver_country`, `invoice_receiver_zip`) VALUES
(30, 2010, '2023-02-13 23:36:40', '2023-03-08 00:00:00', 'aflds', 'ljafsd', 'lakd', 'laf', 'lakds', 'lafd', '2409');

INSERT INTO `invoice_item` (`invoice_item_id`, `invoice_id`, `invoice_item_desc`, `invoice_item_hours`, `invoice_item_hr_rate`, `invoice_item_amount`) VALUES
(407, 30, 'alsdf', 324, 234, 234),
(408, 30, '234', 32, 324, 324);

INSERT INTO `invoice_user` (`id`, `email`, `password`, `first_name`, `last_name`, `admin`) VALUES
(1, 'root@gmail.com', '$2y$10$ys9C1/VE28xGZ7w3EoICyukWQEB7e5YMkg/RvZU5fDQugayKiElMW', 'Raiqa', 'Rasool', b'1'),
(2009, 'rabban@gmail.com', '$2y$10$mcvJlYNHnDDSmdWey99Oluqcs2/OB85DjKzdduKxWqkfQp6/LdAdO', 'Rabban', 'Ali', b'0'),
(2010, 'rida@gmail.com', '$2y$10$6mg9tIC3dweg/z2M5WRPfu0vAubRg3hoP7vftIrXXKpotzam4n7.y', 'Rida', 'Rasool', b'1');

INSERT INTO `workscope` (`workscope_id`, `workscope_client`, `workscope_company`, `workscope_city`, `workscope_totalCost`, `workscope_initialAmtPercent`, `workscope_scope`, `workscope_notes`, `user_id`, `workscope_date`) VALUES
(6, 'afds', 'asfd', 'adsf', 21, 1, '&lt;ol&gt;\\r\\n&lt;li&gt;2&lt;/li&gt;\\r\\n&lt;li&gt;133&lt;/li&gt;\\r\\n&lt;li&gt;asdf&lt;/li&gt;\\r\\n&lt;/ol&gt;', '&lt;p&gt;asd here&lt;/p&gt;', 1, '2023-01-31 00:00:00');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;