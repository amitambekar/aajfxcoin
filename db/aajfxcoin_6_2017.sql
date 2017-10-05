-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 06, 2017 at 02:48 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aajfxcoin`
--

-- --------------------------------------------------------

--
-- Table structure for table `coin_master`
--

CREATE TABLE `coin_master` (
  `coin_id` int(255) NOT NULL,
  `coins` double(255,4) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coin_master`
--

INSERT INTO `coin_master` (`coin_id`, `coins`, `created_date`) VALUES
(3, 1000.0000, '2017-09-30 23:14:16'),
(4, 1000.0000, '2017-09-30 23:14:36'),
(6, 10.0000, '2017-09-30 23:16:33'),
(7, 100.0000, '2017-09-30 23:16:46'),
(8, 100.0000, '2017-09-30 23:17:01'),
(9, 50000000.0000, '2017-10-02 21:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `coin_price`
--

CREATE TABLE `coin_price` (
  `coin_price_id` bigint(255) NOT NULL,
  `coin_price` double(255,4) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coin_price`
--

INSERT INTO `coin_price` (`coin_price_id`, `coin_price`, `mode`, `created_date`) VALUES
(1, 1.0000, '', '2017-09-30 23:44:26'),
(2, 2.0000, '', '2017-09-30 23:44:37'),
(3, 1.0000, '', '2017-10-01 00:04:29'),
(4, 20.0000, '', '2017-10-01 00:06:04'),
(5, 10.0000, 'admin', '2017-10-01 00:10:28'),
(6, 2.0000, 'admin', '2017-10-01 01:11:48'),
(7, 2.0600, 'admin', '2017-10-01 01:12:50'),
(8, 2.1218, 'admin', '2017-10-01 01:18:00'),
(9, 2.1855, 'admin', '2017-10-01 01:19:02'),
(10, 2.2000, 'admin', '2017-10-01 01:20:31'),
(11, 2.5000, 'admin', '2017-10-01 01:21:26'),
(12, 4.0000, 'admin', '2017-10-01 02:37:47'),
(13, 20.0000, 'admin', '2017-10-05 00:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contactus_id` bigint(255) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `enquiry` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `direct_comm`
--

CREATE TABLE `direct_comm` (
  `id` bigint(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `direct_comm_from_userid` bigint(255) NOT NULL,
  `amount` double(255,4) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news_master`
--

CREATE TABLE `news_master` (
  `news_id` int(255) NOT NULL,
  `news_heading` text NOT NULL,
  `news_desc` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(255) NOT NULL,
  `packages` varchar(255) NOT NULL,
  `notification` text NOT NULL,
  `notification_email` text NOT NULL,
  `notification_status` varchar(255) NOT NULL,
  `notification_created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referral_income`
--

CREATE TABLE `referral_income` (
  `referral_income_id` bigint(255) NOT NULL,
  `userid` bigint(255) NOT NULL,
  `from_user` bigint(255) NOT NULL,
  `coin_price` double(255,4) NOT NULL,
  `coins` double(255,4) NOT NULL,
  `payment_details` text,
  `payment_type` text,
  `description` text,
  `status` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `acceptance_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referral_income`
--

INSERT INTO `referral_income` (`referral_income_id`, `userid`, `from_user`, `coin_price`, `coins`, `payment_details`, `payment_type`, `description`, `status`, `created_date`, `acceptance_date`) VALUES
(1, 1, 2, 10.0000, 3500.0000, NULL, NULL, 'Referral income level 1', 'Credit', '2017-10-06 01:23:14', NULL),
(2, 1, 1, 20.0000, 1.0000, 'sdf', 'BTC', 'dfgfdg', 'Debit', '2017-10-06 01:27:34', '2017-10-06 02:03:15'),
(3, 1, 1, 20.0000, 1.0000, 'sdf', 'BTC', 'dfgfdg', 'Debit', '2017-10-06 01:28:27', '2017-10-06 02:03:19'),
(4, 1, 1, 20.0000, 8.0000, 'sdf', 'BTC', 'dfgfdg', 'Debit', '2017-10-06 01:29:24', '2017-10-06 02:03:23'),
(5, 1, 1, 20.0000, 10.0000, 'sdfsdfsdf', 'Bank', 'dfgfdg', 'Debit', '2017-10-06 01:38:45', '2017-10-06 02:03:32'),
(6, 1, 1, 20.0000, 10.0000, 'hjghj', 'Neteller', 'dfgfdg', 'Debit', '2017-10-06 01:50:31', '2017-10-06 02:03:36'),
(7, 1, 1, 20.0000, 3465.0000, 'dfg', 'Bank', NULL, 'Debit Request', '2017-10-06 01:59:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `userid` bigint(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `pancard` varchar(20) NOT NULL,
  `pancard_image` text NOT NULL,
  `aadhaar_card` varchar(20) NOT NULL,
  `aadhaar_card_image` text NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_account_holder_name` varchar(255) NOT NULL,
  `branch` text NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`userid`, `address`, `city`, `state`, `country`, `pincode`, `dateofbirth`, `gender`, `mobile`, `pancard`, `pancard_image`, `aadhaar_card`, `aadhaar_card_image`, `bank_name`, `bank_account_holder_name`, `branch`, `account_number`, `ifsc_code`, `last_updated`) VALUES
(1, '', '', '', '', '', '2017-06-29', '', '9987610222', 'uiouiou', '1506625648_1176_Screenshot_from_2017-06-11_16-52-50.png', 'u', '', '', '', '', '', '', '2017-09-28 19:07:28'),
(2, '', '', '', '', '', '0000-00-00', '', '123123', '', '', '', '', '', '', '', '', '', '2017-10-02 15:54:36'),
(3, '', '', '', '', '', '0000-00-00', '', '123123543', '', '', '', '', '', '', '', '', '', '2017-10-02 17:03:40'),
(4, '', '', '', '', '', '0000-00-00', '', '432423', '', '', '', '', '', '', '', '', '', '2017-10-02 17:04:00'),
(5, '', '', '', '', '', '0000-00-00', '', '4325435634', '', '', '', '', '', '', '', '', '', '2017-10-02 17:07:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` bigint(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `sponsorid` bigint(255) NOT NULL,
  `placementid` bigint(255) NOT NULL,
  `placement` varchar(50) NOT NULL,
  `leftmember` bigint(255) NOT NULL,
  `rightmember` bigint(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` text NOT NULL,
  `forgot_password_token` text NOT NULL,
  `verification_otp` text NOT NULL,
  `verified` varchar(50) NOT NULL,
  `role_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entry` int(10) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `sponsorid`, `placementid`, `placement`, `leftmember`, `rightmember`, `firstname`, `middlename`, `lastname`, `email`, `profile_image`, `forgot_password_token`, `verification_otp`, `verified`, `role_id`, `status`, `entry`, `last_login`, `created_date`) VALUES
(1, 'amitjain', '6fa2f1215e9366a6372b0ac54bb05823', 0, 0, '', 2, 0, 'Amit', 'Afghfg', 'Jain', 'amitmsi999@gmail.com', '1506962802_5022_Screenshot_from_2017-06-11_16-52-50.png', '5ac542a585b4dbcbbdc34755d4df329d', '205300', 'no', '1', 'active', 0, '2017-10-06 00:14:59', '2017-08-07 00:00:00'),
(2, 'amit1', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 'left', 3, 0, '', '', '', 'amit1@oti.com', '', '', '517357', 'no', '', 'active', 0, '2017-10-06 01:17:01', '2017-10-02 21:24:36'),
(3, 'amit2', 'e10adc3949ba59abbe56e057f20f883e', 2, 2, 'left', 4, 0, '', '', '', 'amit2@oti.com', '', '', '205454', 'no', '', 'active', 0, NULL, '2017-10-02 22:33:40'),
(4, 'amit3', 'e10adc3949ba59abbe56e057f20f883e', 3, 3, 'left', 5, 0, '', '', '', 'amit3@oti.com', '', '', '391596', 'no', '', 'active', 0, NULL, '2017-10-02 22:34:00'),
(5, 'amit4', 'e10adc3949ba59abbe56e057f20f883e', 4, 4, 'left', 0, 0, '', '', '', 'amit4@oti.com', '', '', '908048', 'no', '', 'active', 0, NULL, '2017-10-02 22:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_coins`
--

CREATE TABLE `user_coins` (
  `id` bigint(255) NOT NULL,
  `userid` bigint(255) NOT NULL,
  `amount` double(255,4) NOT NULL,
  `coin_price` double(255,4) NOT NULL,
  `coins` double(255,4) NOT NULL,
  `payment_details` text NOT NULL,
  `payment_type` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `acceptance_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_coins`
--

INSERT INTO `user_coins` (`id`, `userid`, `amount`, `coin_price`, `coins`, `payment_details`, `payment_type`, `description`, `status`, `purchase_date`, `acceptance_date`) VALUES
(1, 1, 5000.0000, 5.0000, 1000.0000, 'df', 'Neteller', '', 'accepted', '2017-10-06 00:22:38', '2017-10-06 00:22:58'),
(3, 1, 2500.0000, 5.0000, 500.0000, '', '', 'Bonus Coins', 'Bonus', '2017-10-06 00:22:58', '2017-10-06 00:22:58'),
(4, 1, 500.0000, 5.0000, 100.0000, '', '', '', 'Credit', '2017-10-06 00:00:00', '2017-10-06 00:00:00'),
(6, 1, 50.0000, 5.0000, 10.0000, 'ghjj', 'Bank', 'ghjgj', 'Debit', '2017-10-06 00:33:45', '2017-10-06 00:36:16'),
(14, 1, 50.0000, 5.0000, 10.0000, 'fgh', 'Bank', '', 'Debit', '2017-10-06 01:00:53', '0000-00-00 00:00:00'),
(15, 1, 790.0000, 10.0000, 79.0000, 'gfh', 'Neteller', 'ghjhgj', 'Debit', '2017-10-06 01:03:36', '2017-10-06 01:10:52'),
(16, 1, 10.0000, 10.0000, 1.0000, 'gfh', 'Neteller', 'hjkh', 'Debit', '2017-10-06 01:09:35', '2017-10-06 01:11:12'),
(17, 2, 500000.0000, 10.0000, 50000.0000, 'fghfgh', 'BTC', '', 'accepted', '2017-10-06 01:17:16', '2017-10-06 01:23:14'),
(20, 2, 250000.0000, 10.0000, 25000.0000, '', '', 'Bonus Coins', 'Bonus', '2017-10-06 01:23:14', '2017-10-06 01:23:14'),
(21, 1, 20000.0000, 20.0000, 1000.0000, 'dffdg', 'Neteller', '', 'accepted', '2017-10-06 02:08:16', '2017-10-06 02:08:48'),
(22, 1, 10000.0000, 20.0000, 500.0000, '', '', 'Bonus Coins', 'Bonus', '2017-10-06 02:08:48', '2017-10-06 02:08:48'),
(23, 1, 400.0000, 20.0000, 20.0000, 'asd', 'asd', 'dfg', 'Credit', '2017-10-06 00:00:00', '2017-10-06 00:00:00'),
(24, 1, 200.0000, 20.0000, 10.0000, 'ghnhgn', 'Bank', '', 'Debit Request', '2017-10-06 02:11:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `userid` bigint(255) NOT NULL,
  `user_alignment` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`userid`, `user_alignment`) VALUES
(1, 'left'),
(2, 'left'),
(3, 'left'),
(4, 'left'),
(5, 'left');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coin_master`
--
ALTER TABLE `coin_master`
  ADD PRIMARY KEY (`coin_id`);

--
-- Indexes for table `coin_price`
--
ALTER TABLE `coin_price`
  ADD PRIMARY KEY (`coin_price_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contactus_id`);

--
-- Indexes for table `direct_comm`
--
ALTER TABLE `direct_comm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_master`
--
ALTER TABLE `news_master`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `referral_income`
--
ALTER TABLE `referral_income`
  ADD PRIMARY KEY (`referral_income_id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_coins`
--
ALTER TABLE `user_coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coin_master`
--
ALTER TABLE `coin_master`
  MODIFY `coin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `coin_price`
--
ALTER TABLE `coin_price`
  MODIFY `coin_price_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contactus_id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `direct_comm`
--
ALTER TABLE `direct_comm`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news_master`
--
ALTER TABLE `news_master`
  MODIFY `news_id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referral_income`
--
ALTER TABLE `referral_income`
  MODIFY `referral_income_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `userid` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_coins`
--
ALTER TABLE `user_coins`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `userid` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
