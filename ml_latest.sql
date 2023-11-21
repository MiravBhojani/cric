-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 06:44 AM
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

CREATE TABLE `login_attempts`
(
	`id`         int(11) UNSIGNED NOT NULL,
	`ip_address` varchar(45)  NOT NULL,
	`login`      varchar(100) NOT NULL,
	`time`       int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`)
VALUES (7, '::1', 'makuno.biz@gmail.com', 1700545408),
	   (8, '::1', 'mirav.bhojani@strathmore.edu', 1700545413);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches`
(
	`id`        int(11) NOT NULL,
	`hometeam`  int(11) DEFAULT NULL,
  `awayteam` int(11) DEFAULT NULL,
  `dateplayed` varchar(300) NOT NULL,
  `homeground` varchar(300) NOT NULL,
  `userid` varchar(300) NOT NULL,
  `completed` int(11) NOT NULL DEFAULT 0,
  `lastupdated` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
						 `activation_code`             varchar(255) DEFAULT NULL,
						 `forgotten_password_selector` varchar(255) DEFAULT NULL,
						 `forgotten_password_code`     varchar(255) DEFAULT NULL,
						 `forgotten_password_time`     int(11) UNSIGNED DEFAULT NULL,
						 `remember_selector`           varchar(255) DEFAULT NULL,
						 `remember_code`               varchar(255) DEFAULT NULL,
						 `created_on`                  int(11) UNSIGNED NOT NULL,
						 `last_login`                  int(11) UNSIGNED DEFAULT NULL,
						 `active`                      tinyint(1) UNSIGNED DEFAULT NULL,
						 `first_name`                  varchar(50)  DEFAULT NULL,
						 `last_name`                   varchar(50)  DEFAULT NULL,
						 `company`                     varchar(100) DEFAULT NULL,
						 `phone`                       varchar(20)  DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`,
					 `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`,
					 `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`,
					 `last_name`, `company`, `phone`)
VALUES (1, '127.0.0.1', 'administrator', '$2y$10$C3ESQE4p6skAOwx2EBOVrOyG9tG6SOwLfYGUPmI/32GGD2ibL8rEO',
		'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1700545417, 1, 'Admin', 'istrator',
		'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups`
(
	`id`       int(11) UNSIGNED NOT NULL,
	`user_id`  int(11) UNSIGNED NOT NULL,
	`group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`)
VALUES (1, 1, 1),
	   (2, 1, 2);

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
	MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
	MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
	MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
	MODIFY `id` int (11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
	MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_players`
--
ALTER TABLE `match_players`
	MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
	MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s1`
--
ALTER TABLE `s1`
	MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

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
	MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
	MODIFY `id` int (11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
	MODIFY `id` int (11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
