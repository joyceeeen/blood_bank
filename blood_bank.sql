-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2017 at 01:08 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood`
--

CREATE TABLE IF NOT EXISTS `blood` (
`blood_id` int(11) NOT NULL,
  `call_number` varchar(500) NOT NULL,
  `blood_type` int(1) NOT NULL,
  `place_of_acquisition` varchar(50) NOT NULL,
  `donor` varchar(30) NOT NULL,
  `incharge` varchar(30) NOT NULL,
  `expiration_date` varchar(15) NOT NULL,
  `remarks` int(1) NOT NULL,
  `recipient` varchar(50) NOT NULL,
  `one_week_before_expire` varchar(15) NOT NULL,
  `date_entered` varchar(15) NOT NULL,
  `age` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood`
--

INSERT INTO `blood` (`blood_id`, `call_number`, `blood_type`, `place_of_acquisition`, `donor`, `incharge`, `expiration_date`, `remarks`, `recipient`, `one_week_before_expire`, `date_entered`, `age`) VALUES
(1, '2016-BLOOD-1', 3, 'Red Cross Alabang', 'Josh', 'Katsu', '2016-05-29', 1, 'jason lopez', '2016-05-22', '2016-03-01', '1'),
(2, '2016-BLOOD-2', 5, 'CAvite', 'Lourrey', 'Bryan', '2016-05-29', 1, 'joyce potestades', '2016-05-22', '2016-03-01', '19');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_accounts`
--

CREATE TABLE IF NOT EXISTS `catalog_accounts` (
`account_id` int(11) NOT NULL,
  `account_email` varchar(20) NOT NULL,
  `account_password` varchar(100) NOT NULL,
  `account_firstname` varchar(20) NOT NULL,
  `account_lastname` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `account_civil_status` varchar(11) NOT NULL,
  `account_birthday` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `account_contact_number` varchar(11) NOT NULL,
  `account_address` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catalog_accounts`
--

INSERT INTO `catalog_accounts` (`account_id`, `account_email`, `account_password`, `account_firstname`, `account_lastname`, `type`, `account_civil_status`, `account_birthday`, `gender`, `account_contact_number`, `account_address`) VALUES
(1, 'admin_main@gmail.com', 'f16fe9b27206060c06aaf42a6edadd5b', 'Glenwin', 'Bernabe', 'main', 'Single', '1996-09-18', 'male', '09358217701', 'Any address'),
(2, 'sub_admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Sub First Name', 'Sub Last Name', 'sub', '', '', '', '', ''),
(6, 'kelly_c@yahoo.com', 'ae074a5692dfb7c26aae5147e52ceb40', 'Hillary', 'Clarkson', 'sub', 'Single', '1980-03-20', 'female', '09289561334', 'sa bahay ni kelly'),
(8, 'mor.rufa@gmail.com', '01738775a7541d8943768635f81cb715', 'Mordecai', 'Rufa', 'sub', 'Single', '1996-07-01', 'male', '09289615634', 'Block 606 Lot 104 Phase 6, Hummingbird Street, Heritages Homes');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`notif_id` int(11) NOT NULL,
  `has_read` int(3) NOT NULL,
  `notif_message` varchar(500) NOT NULL,
  `notif_type_message` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notif_id`, `has_read`, `notif_message`, `notif_type_message`, `type`) VALUES
(1, 1, '<b>Successfully Created A New Admin</b><br>Email :mor.rufa@gmail.com<br>Password: mor', 'success', 'admin'),
(2, 1, '<b>Inserted A Blood Donor</b><br>Blood Donor : Josh', 'notice', 'admin'),
(3, 1, '<b>Inserted A Blood Donor</b><br>Blood Donor : Josh', 'notice', 'sub'),
(4, 1, '<b>Added New Blood</b><br>Blood Type : B+', 'notice', 'admin'),
(5, 1, '<b>Added New Blood</b><br>Blood Type : B+', 'notice', 'sub'),
(6, 1, '<b>Inserted A Blood Donor</b><br>Blood Donor : Lourrey', 'notice', 'admin'),
(7, 1, '<b>Inserted A Blood Donor</b><br>Blood Donor : Lourrey', 'notice', 'sub'),
(8, 1, '<b>Added New Blood</b><br>Blood Type : AB+', 'notice', 'admin'),
(9, 1, '<b>Added New Blood</b><br>Blood Type : AB+', 'notice', 'sub'),
(10, 0, '<b>Someone Claimed a blood</b><br>Blood Type : B+<br>Recipient : jason lopez', 'success', 'admin'),
(11, 1, '<b>Someone Claimed a blood</b><br>Blood Type : B+<br>Recipient : jason lopez', 'success', 'sub'),
(12, 0, '<b>Someone Claimed a blood</b><br>Blood Type : AB+<br>Recipient : joyce potestades', 'success', 'admin'),
(13, 1, '<b>Someone Claimed a blood</b><br>Blood Type : AB+<br>Recipient : joyce potestades', 'success', 'sub');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood`
--
ALTER TABLE `blood`
 ADD PRIMARY KEY (`blood_id`);

--
-- Indexes for table `catalog_accounts`
--
ALTER TABLE `catalog_accounts`
 ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`notif_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood`
--
ALTER TABLE `blood`
MODIFY `blood_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `catalog_accounts`
--
ALTER TABLE `catalog_accounts`
MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
