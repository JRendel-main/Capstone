-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 09:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth`
--

CREATE TABLE `tbl_auth` (
  `auth_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `acc_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_auth`
--

INSERT INTO `tbl_auth` (`auth_id`, `username`, `password`, `category`, `acc_status`) VALUES
(4, 'carlos', '123', '1', 1),
(5, 'rendel', '123', '2', 1),
(6, 'tutee', '123', '3', 1),
(7, 'tutor', '123', '2', 1),
(8, 'moderator', '123', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `logid` int(10) NOT NULL,
  `peerid` int(10) NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`logid`, `peerid`, `action`, `timestamp`) VALUES
(1, 6, '0', '2023-05-08 14:21:55'),
(2, 6, '0', '2023-05-08 14:22:54'),
(3, 6, '0', '2023-05-08 14:23:36'),
(4, 6, '0', '2023-05-08 14:25:28'),
(5, 6, '0', '2023-05-08 16:14:30'),
(6, 6, '0', '2023-05-08 16:24:51'),
(7, 6, '0', '2023-05-08 16:37:51'),
(8, 6, '0', '2023-05-08 16:38:22'),
(9, 6, '0', '2023-05-08 16:42:03'),
(10, 7, '0', '2023-05-08 16:42:43'),
(11, 7, '0', '2023-05-08 16:42:49'),
(12, 7, '0', '2023-05-08 16:42:54'),
(13, 7, '0', '2023-05-08 16:43:29'),
(14, 7, '0', '2023-05-08 16:43:38'),
(15, 7, '0', '2023-05-08 16:50:51'),
(16, 7, '0', '2023-05-08 16:51:33'),
(17, 7, '0', '2023-05-08 16:51:49'),
(18, 6, '0', '2023-05-08 16:56:41'),
(19, 6, '0', '2023-05-08 16:57:48'),
(20, 7, '0', '2023-05-08 16:57:55'),
(21, 6, '0', '2023-05-18 15:10:15'),
(22, 6, '1', '2023-05-18 15:25:18'),
(23, 6, '0', '2023-05-18 15:25:21'),
(24, 6, '1', '2023-05-18 15:31:41'),
(25, 7, '0', '2023-05-18 15:31:46'),
(26, 7, '1', '2023-05-18 15:31:48'),
(27, 6, '0', '2023-05-18 15:31:51'),
(28, 6, '1', '2023-05-18 15:33:22'),
(29, 8, '0', '2023-05-18 15:33:26'),
(30, 8, '1', '2023-05-18 15:33:39'),
(31, 6, '0', '2023-05-18 15:33:45'),
(32, 6, '1', '2023-05-18 15:35:57'),
(33, 6, '0', '2023-05-18 15:38:49'),
(34, 6, '1', '2023-05-18 15:39:39'),
(35, 6, '0', '2023-05-18 15:39:56'),
(36, 6, '1', '2023-05-18 15:40:47'),
(37, 6, '0', '2023-05-18 15:43:05'),
(38, 6, '1', '2023-05-18 15:44:16'),
(39, 6, '0', '2023-05-18 15:44:31'),
(40, 6, '1', '2023-05-18 15:46:23'),
(41, 6, '0', '2023-05-22 08:04:24'),
(42, 6, '1', '2023-05-22 08:04:29'),
(43, 7, '0', '2023-05-22 08:04:33'),
(44, 7, '1', '2023-05-22 08:04:39'),
(45, 6, '0', '2023-05-22 08:04:45'),
(46, 6, '1', '2023-05-22 08:06:40'),
(47, 6, '0', '2023-05-22 08:06:58'),
(48, 6, '1', '2023-05-22 08:08:33'),
(49, 7, '0', '2023-05-22 08:08:36'),
(50, 7, '1', '2023-05-22 08:10:38'),
(51, 6, '0', '2023-05-22 08:25:32'),
(52, 6, '1', '2023-05-22 08:33:13'),
(53, 7, '0', '2023-05-22 08:47:46'),
(54, 7, '1', '2023-05-22 08:48:00'),
(55, 6, '0', '2023-05-22 08:48:04'),
(56, 6, '1', '2023-05-22 08:49:58'),
(57, 6, '0', '2023-05-22 08:50:01'),
(58, 6, '1', '2023-05-22 08:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peerinfo`
--

CREATE TABLE `tbl_peerinfo` (
  `peerid` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `studentNumber` varchar(20) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `auth_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_peerinfo`
--

INSERT INTO `tbl_peerinfo` (`peerid`, `firstname`, `middlename`, `lastname`, `dob`, `sex`, `email`, `year`, `course`, `studentNumber`, `category`, `auth_id`) VALUES
(6, 'Carlos', 'Mari', 'Ellerma', '2023-05-22', '          ', 'carlos@gmail.com', 1, 'COC', '4512311', '1', 4),
(7, 'Rendel', 'San', 'Luis', '2023-05-09', 'Male', 'rendel@gmail.com', 4, 'CICT', '5512313', '2', 5),
(8, 'tutee', 'tutee', 'tutee', '2023-04-30', 'Male', 'tutee@gmail.com', 2, 'COE', '6623424', '3', 6),
(9, 'tutor', 'tutor', 'tutor', '2023-05-01', 'Male', 'tutor@gmail.com', 2, 'CON', '7783435', '2', 7),
(10, 'mod', 'mod', 'mod', '2023-05-25', 'Male', 'moderator@gmail.com', 3, 'CPADM', '234225241', '4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutorinfo`
--

CREATE TABLE `tbl_tutorinfo` (
  `tutorinfoid` int(10) NOT NULL,
  `peerid` int(10) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `expertiseid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutorprofile`
--

CREATE TABLE `tbl_tutorprofile` (
  `tpid` int(10) NOT NULL,
  `tutorid` int(10) NOT NULL,
  `bio` text NOT NULL,
  `expertiseid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tutorprofile`
--

INSERT INTO `tbl_tutorprofile` (`tpid`, `tutorid`, `bio`, `expertiseid`) VALUES
(1, 9, 'Proficient in Python', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_auth`
--
ALTER TABLE `tbl_auth`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `tbl_peerinfo`
--
ALTER TABLE `tbl_peerinfo`
  ADD PRIMARY KEY (`peerid`);

--
-- Indexes for table `tbl_tutorprofile`
--
ALTER TABLE `tbl_tutorprofile`
  ADD PRIMARY KEY (`tpid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_auth`
--
ALTER TABLE `tbl_auth`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `logid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_peerinfo`
--
ALTER TABLE `tbl_peerinfo`
  MODIFY `peerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_tutorprofile`
--
ALTER TABLE `tbl_tutorprofile`
  MODIFY `tpid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
