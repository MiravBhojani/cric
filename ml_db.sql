-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 06:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ml`
--

-- --------------------------------------------------------

--
-- Table structure for table `battingleaderboard`
--

CREATE TABLE `battingleaderboard` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `player_name` varchar(200) NOT NULL,
  `matches` int(11) DEFAULT NULL,
  `wickets_taken` int(11) NOT NULL DEFAULT 0,
  `runs` int(11) DEFAULT NULL,
  `bowls` int(11) DEFAULT NULL,
  `outs` int(11) DEFAULT NULL,
  `overs_bowled` int(11) NOT NULL DEFAULT 0,
  `average` double DEFAULT NULL,
  `performanceruns5` int(11) DEFAULT NULL,
  `performanceruns4` int(11) DEFAULT NULL,
  `performanceruns3` int(11) DEFAULT NULL,
  `performanceruns2` int(11) DEFAULT NULL,
  `performanceruns1` int(11) DEFAULT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bowlingreport`
--

CREATE TABLE `bowlingreport` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `player_name` varchar(200) NOT NULL,
  `match_id` int(11) NOT NULL,
  `matches` int(11) DEFAULT NULL,
  `oversbowled` int(11) DEFAULT NULL,
  `bowls` int(11) DEFAULT NULL,
  `runsgiven` int(11) DEFAULT NULL,
  `wicketstaken` int(11) DEFAULT NULL,
  `economy` double DEFAULT NULL,
  `average` double(8,2) DEFAULT NULL,
  `performancewickets5` int(11) DEFAULT NULL,
  `performancewickets4` int(11) DEFAULT NULL,
  `performancewickets3` int(11) DEFAULT NULL,
  `performancewickets2` int(11) DEFAULT NULL,
  `performancewickets1` int(11) DEFAULT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `clubname` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `homeground` varchar(300) NOT NULL,
  `userid` varchar(300) NOT NULL,
  `lastupdated` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `clubname`, `email`, `homeground`, `userid`, `lastupdated`) VALUES
(1, 'nairobi', 'info@nairobi.co.ke', 'gymkhana nairobi', '2', '2023-11-06 08:54:07'),
(2, 'mombasa', 'info@mombasa.com', 'mombasa', '1', '2023-11-06 08:56:03'),
(3, 'Kanbis', 'miravbhojani@gmail.com', 'Eastleigh', '1', '2023-11-07 05:49:30'),
(4, 'Swamibapa', 'mirav.bhojani@strathmore.edu', 'Jamhuri', '1', '2023-11-10 10:15:12'),
(5, 'Simba Union', 'makuno.biz@gmail.com', 'Sikh Union', '1', '2023-11-16 12:57:00'),
(6, 'Kabarage', 'makuno.biz@gmail.com', 'Hapa kule', '3', '2023-11-16 18:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'clubadmin', 'club admin');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `hometeam` int(11) DEFAULT NULL,
  `awayteam` int(11) DEFAULT NULL,
  `dateplayed` varchar(300) NOT NULL,
  `homeground` varchar(300) NOT NULL,
  `userid` varchar(300) NOT NULL,
  `completed` int(11) NOT NULL DEFAULT 0,
  `lastupdated` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `hometeam`, `awayteam`, `dateplayed`, `homeground`, `userid`, `completed`, `lastupdated`) VALUES
(10, 1, 2, '2023-11-16', 'gymkhana nairobi', '1', 1, '2023-11-15 11:13:26'),
(11, 2, 1, '2023-11-30', 'mombasa', '1', 1, '2023-11-16 09:55:52'),
(12, 5, 3, '2023-11-22', 'Sikh Union', '1', 0, '2023-11-16 13:01:52'),
(13, 4, 3, '2023-11-21', 'Jamhuri', '1', 0, '2023-11-16 13:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `match_players`
--

CREATE TABLE `match_players` (
  `id` int(11) NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `s1_id` int(11) NOT NULL,
  `home_away` varchar(200) NOT NULL,
  `toss_winner` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `batting` int(11) NOT NULL DEFAULT 0,
  `runs` int(11) NOT NULL DEFAULT 0,
  `balls_faced` int(11) NOT NULL DEFAULT 0,
  `in_out` int(11) NOT NULL DEFAULT 0,
  `bowled` int(11) NOT NULL DEFAULT 0,
  `overs_bowled` int(11) NOT NULL DEFAULT 0,
  `runs_given` int(11) NOT NULL DEFAULT 0,
  `wickets_taken` int(11) NOT NULL DEFAULT 0,
  `economy` double NOT NULL DEFAULT 0,
  `completed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `dob` varchar(300) NOT NULL,
  `batting_style` varchar(300) NOT NULL,
  `bowling_style` varchar(300) NOT NULL,
  `userid` varchar(300) NOT NULL,
  `lastupdated` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `club_id`, `name`, `dob`, `batting_style`, `bowling_style`, `userid`, `lastupdated`) VALUES
(1, 2, 'ed', '2023-11-16', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(2, 2, 'Aarav Sharma', '1995-01-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(3, 2, 'Ishaan Patel', '1994-02-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(4, 2, 'Aahana Singh', '1993-03-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(5, 2, 'Siya Reddy', '1992-04-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(6, 2, 'Aaradhya Kumar', '1991-05-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(7, 2, 'Virat Chauhan', '1980-12-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(8, 2, 'Riya Gupta', '1990-06-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(9, 2, 'Advait Dubey', '1998-07-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(10, 2, 'Aditi Mishra', '1999-08-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(11, 2, 'Anaya Basu', '2002-09-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(12, 1, 'Arnav Iyer', '2005-10-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(13, 1, 'Amita Menon', '1993-11-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(14, 1, 'Amita Menon', '1993-11-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(15, 1, 'Ishika Khanna', '2003-01-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(16, 1, 'Vihaan Ahuja', '2000-02-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(17, 1, 'Kavya Nair', '2006-03-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(18, 1, 'Arjun Verma', '1998-04-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(19, 1, 'Meera Singh', '2007-05-01', 'Right Hand Batting', 'Right Arm Off-Spin', '1', '2023-11-06 10:07:10'),
(20, 1, 'Jignesh Hirani', '1993-06-15', 'Right Hand Batting', 'Left Arm Orthodox', '1', '2023-11-07 06:28:21'),
(21, 1, 'Bhavesh Varsani', '2004-05-19', 'Right Hand Batting', 'Left Arm Chinaman', '1', '2023-11-10 11:00:04'),
(22, 1, 'Simon Njenga', '2023-11-15', 'Right Hand Batting', 'Left Arm Orthodox', '2', '2023-11-15 09:06:58'),
(23, 4, 'Mirav Bhojani', '2013-06-12', 'Right Hand Batting', 'Right Arm Off-Spin', '2', '2023-11-16 13:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `s1`
--

CREATE TABLE `s1` (
  `id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `toss_winner` int(11) NOT NULL,
  `after_toss` int(11) NOT NULL,
  `completed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s2`
--

CREATE TABLE `s2` (
  `id` int(11) NOT NULL,
  `s1_id` int(11) NOT NULL,
  `completed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s3`
--

CREATE TABLE `s3` (
  `id` int(11) NOT NULL,
  `s1_id` int(11) NOT NULL,
  `completed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s4`
--

CREATE TABLE `s4` (
  `id` int(11) NOT NULL,
  `s1_id` int(11) NOT NULL,
  `completed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$C3ESQE4p6skAOwx2EBOVrOyG9tG6SOwLfYGUPmI/32GGD2ibL8rEO', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1700155556, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'mirav.bhojani@strathmore.edu', '$2y$10$AqUhmu.woT8VJCIjsmwnK.ZzWkZRxUwpUXA3hdL6aWzTOCmqgdf3m', 'mirav.bhojani@strathmore.edu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1699607712, 1700145709, 1, 'Swamibapa', 'Club', 'Club', '0706784933'),
(3, '::1', 'makuno.biz@gmail.com', '$2y$10$mJedSoMfNcwAaWnby.WT..r2W4IeG/T6hOWVdjTKMq6e1SvP5lD92', 'makuno.biz@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1700135820, 1700156390, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(6, 2, 3),
(7, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `battingleaderboard`
--
ALTER TABLE `battingleaderboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bowlingreport`
--
ALTER TABLE `bowlingreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_players`
--
ALTER TABLE `match_players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s1`
--
ALTER TABLE `s1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s2`
--
ALTER TABLE `s2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s3`
--
ALTER TABLE `s3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s4`
--
ALTER TABLE `s4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `battingleaderboard`
--
ALTER TABLE `battingleaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bowlingreport`
--
ALTER TABLE `bowlingreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `match_players`
--
ALTER TABLE `match_players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `s1`
--
ALTER TABLE `s1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s2`
--
ALTER TABLE `s2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s3`
--
ALTER TABLE `s3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s4`
--
ALTER TABLE `s4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
