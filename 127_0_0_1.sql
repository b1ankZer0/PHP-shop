-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2023 at 12:26 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wd-my`
--
CREATE DATABASE IF NOT EXISTS `wd-my` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `wd-my`;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `note` varchar(100) NOT NULL,
  `deposit_id` varchar(20) NOT NULL,
  `deposit_amount` double(10,2) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateed_by` int(11) DEFAULT NULL,
  `updateed_on` timestamp NULL DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `note`, `deposit_id`, `deposit_amount`, `payment_type`, `transaction_id`, `added_by`, `added_on`, `updateed_by`, `updateed_on`, `status`) VALUES
(1, 'ashiksodo', '', 1000.00, 'Online', 'efvzvr45345', 1, '2023-01-14 17:22:16', 2, '2023-01-14 19:16:00', 'Accepted'),
(2, 'ashiksodo', 'DP1673719293', 2000.00, 'Online', 'efvzvr45346', 1, '2023-01-14 18:01:33', 2, '2023-01-14 19:18:10', 'Cancelled'),
(3, 'ashiksodo', 'DP1673761520', 5000.00, 'Online', 'efvzvr45347', 2, '2023-01-15 05:45:20', 2, '2023-01-15 05:45:28', 'Accepted'),
(4, 'ashiksodo', 'DP1673764321', 5000.00, 'Online', 'efvzvr45348', 2, '2023-01-15 06:32:01', 2, '2023-01-15 06:32:08', 'Accepted'),
(5, 'ashiksodo', 'DP1673764550', 5000.00, 'Online', 'efvzvr45349', 2, '2023-01-15 06:35:50', 2, '2023-01-15 06:44:02', 'Accepted'),
(6, 'ashiksodo', 'DP1673765197', 1000.00, 'Online', 'efvzvr453410', 2, '2023-01-15 06:46:37', 2, '2023-01-15 06:46:40', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `prodect_id` int(11) NOT NULL,
  `Order_number` varchar(20) NOT NULL,
  `quantity` int(8) NOT NULL,
  `number` varchar(14) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ordered_by` int(11) NOT NULL,
  `update_date` timestamp NULL DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `prodect_owner_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `dv_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `prodect_id`, `Order_number`, `quantity`, `number`, `order_date`, `ordered_by`, `update_date`, `address`, `prodect_owner_id`, `status`, `dv_status`) VALUES
(1, 5, 'ORD1673701385', 10, '01556645889', '2023-01-14 13:07:20', 1, NULL, 'mirpur,dhaka-1216', 1, 'Pending', 'Not started'),
(2, 5, 'ORD1673701678', 10, '01556645889', '2023-01-14 13:07:58', 1, NULL, 'mirpur,dhaka-1216', 1, 'Pending', 'Not started'),
(3, 5, 'ORD1673701712', 5, '01556645889', '2023-01-14 13:08:32', 1, NULL, 'mirpur,dhaka-1216', 1, 'Pending', 'Not started'),
(4, 5, 'ORD1673701754', 10, '01556645889', '2023-01-14 13:09:14', 1, NULL, 'mirpur,dhaka-1216', 1, 'Pending', 'Not started');

-- --------------------------------------------------------

--
-- Table structure for table `prodect`
--

CREATE TABLE `prodect` (
  `id` int(11) NOT NULL,
  `prodect_name` varchar(200) NOT NULL,
  `prodect_code` varchar(50) NOT NULL,
  `buying_price` double(10,2) NOT NULL,
  `selling_price` double(10,2) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `type` varchar(15) NOT NULL,
  `total_in_stock` int(10) NOT NULL DEFAULT 0,
  `description` varchar(1500) NOT NULL,
  `prodect_picture` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateed_by` int(11) DEFAULT NULL,
  `updateed_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodect`
--

INSERT INTO `prodect` (`id`, `prodect_name`, `prodect_code`, `buying_price`, `selling_price`, `discount`, `status`, `type`, `total_in_stock`, `description`, `prodect_picture`, `added_by`, `added_on`, `updateed_by`, `updateed_on`) VALUES
(4, 'dhaka', '0001', 1500.24, 1900.50, '', 'Active', 'General', 0, 'sdfgsertegerg', './asset/prodect/0001/prodect.png', 4, '2023-01-12 17:55:16', 1, NULL),
(5, 'ashik', 'sodo 1', 1500.24, 2000.50, '200', 'Active', 'General', 17, 'fgjhcfgyjcfj', './asset/prodect/sodo 1/prodect.png', 1, '2023-01-12 18:23:46', 1, '2023-01-13 19:30:18'),
(6, 'dhaka', 'sodo 2', 1600.24, 2000.50, '', 'Active', 'General', 21, 'gfdsgerszgfer', './asset/prodect/sodo 2/prodect.png', 1, '2023-01-12 18:28:28', NULL, NULL),
(7, 'ashik', 'sodo 3', 1600.24, 1900.50, '', 'Active', 'Technology', 10, 'tsygfhrth', './asset/prodect/sodo 3/prodect.png', 1, '2023-01-13 14:03:16', NULL, NULL),
(8, 'dhakar pola', 'sodo 4', 1500.24, 1900.50, '', 'Active', 'Clothing', 10, 'nhjcgjcgjg', './asset/prodect/sodo 4/prodect.png', 1, '2023-01-13 14:35:26', NULL, NULL),
(9, 'Dhaka tore', 'sodo 5', 1500.24, 1900.50, NULL, 'Active', 'General', 1, 'zrgegdfgreg', './asset/prodect/sodo 5/prodect.png', 1, '2023-01-13 17:51:43', NULL, NULL),
(10, 'dhaka', 'sodo 7', 1500.24, 1900.50, '10', 'Active', 'Food', 10, 'sfgesrgergagr', './asset/prodect/sodo 7/prodect.png', 1, '2023-01-13 18:10:32', 1, '2023-01-13 19:09:26'),
(11, 'Dhaka tore', 'ki ', 100.24, 2000.50, NULL, 'Active', 'General', 0, 'sfesfe', './asset/prodect/ki /prodect.png', 2, '2023-01-14 19:04:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `id` int(11) NOT NULL,
  `fast_name` varchar(50) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `birth_day` date NOT NULL,
  `gender` text NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `balance` double(10,2) NOT NULL DEFAULT 0.00,
  `address` varchar(200) DEFAULT NULL,
  `number` varchar(14) DEFAULT NULL,
  `reg time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateed_by` varchar(10) NOT NULL,
  `updateed_on` timestamp NULL DEFAULT NULL,
  `authority` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reg`
--

INSERT INTO `reg` (`id`, `fast_name`, `last_name`, `email`, `birth_day`, `gender`, `profile_pic`, `password`, `balance`, `address`, `number`, `reg time`, `updateed_by`, `updateed_on`, `authority`) VALUES
(1, 'MAS Ashikur Rahman', 'Hridoy', 'ashik@gmail.com', '2022-12-01', 'male', './asset/profile/ashik@gmail.com/profile.png', 'e0bc60c82713f64ef8a57c0c40d02ce24fd0141d5cc3086259c19b1e62a62bea', 0.00, 'mirpur,dhaka-1216', '01556645889', '2022-12-26 17:45:34', 'user', '2023-01-13 05:30:50', 'Sudo'),
(2, 'MAS Ashikur Rahman', 'Hridoy', 'ashik1@gmail.com', '2022-12-01', 'Male', './asset/profile/ashik1@gmail.com/profile.png', 'e0bc60c82713f64ef8a57c0c40d02ce24fd0141d5cc3086259c19b1e62a62bea', 5000.00, '', '01556645889', '2022-12-26 18:08:02', '2', '2023-01-15 06:44:02', 'Admin'),
(3, 'MAS Ashikur Rahman', 'Hridoy2', 'ashik2@gmail.com', '2022-12-01', 'Male', './asset/profile/ashik2@gmail.com/profile.png', 'e0bc60c82713f64ef8a57c0c40d02ce24fd0141d5cc3086259c19b1e62a62bea', 0.00, NULL, '0', '2022-12-26 18:41:15', '1', '2023-01-10 05:42:19', 'Moderator'),
(4, 'MAS Ashikur Rahman', 'Hridoy', 'ashik3@gmail.com', '2022-12-01', 'Male', './asset/profile/ashik3@gmail.com/profile.png', 'e0bc60c82713f64ef8a57c0c40d02ce24fd0141d5cc3086259c19b1e62a62bea', 0.00, NULL, '0', '2022-12-26 18:48:34', '1', '2023-01-03 05:39:25', 'Entrepreneur'),
(5, 'MAS Ashikur Rahman', 'Hridoy', 'ashik5@gmail.com', '2022-12-01', 'Male', './asset/profile/ashik5@gmail.com/profile.png', 'e0bc60c82713f64ef8a57c0c40d02ce24fd0141d5cc3086259c19b1e62a62bea', 0.00, NULL, '0', '2022-12-30 17:59:34', '1', '2023-01-14 03:26:37', 'Banned'),
(6, 'MAS Ashikur Rahman', 'Hridoy', 'ashik4@gmail.com', '2022-12-01', 'Male', './asset/profile/ashik4@gmail.com/profile.png', 'e0bc60c82713f64ef8a57c0c40d02ce24fd0141d5cc3086259c19b1e62a62bea', 0.00, NULL, '0', '2023-01-03 17:40:07', '1', '2023-01-04 06:13:18', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `qualification`, `profile_picture`, `birth_date`, `created_at`) VALUES
(1, 'MD. Mehedi Hasan', 'shuvo@asl.aero', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '01738923828', 'BSC in CSE', 'upload/2021-05-06.jpg', '2022-12-08', '2022-12-02 03:45:23'),
(2, 'Alauddin AKash', 'akashoneplus@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '01614237395', 'BSC in EEE', 'upload/1584954161607.jpg', '2022-12-01', '2022-12-02 03:48:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD UNIQUE KEY `deposit_id` (`deposit_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Order_number` (`Order_number`);

--
-- Indexes for table `prodect`
--
ALTER TABLE `prodect`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prodect_code` (`prodect_code`);

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prodect`
--
ALTER TABLE `prodect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reg`
--
ALTER TABLE `reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
