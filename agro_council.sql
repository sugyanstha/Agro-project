-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 04:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agro_council`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminname` varchar(30) NOT NULL,
  `adminpassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminname`, `adminpassword`) VALUES
(1, 'superadmin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `counsellor`
--

CREATE TABLE `counsellor` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_otp_hash` varchar(64) DEFAULT NULL,
  `reset_otp_expires_at` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counsellor`
--

INSERT INTO `counsellor` (`id`, `name`, `address`, `mobile`, `email`, `password`, `reset_otp_hash`, `reset_otp_expires_at`, `status`) VALUES
(5, 'Sanjana Shilpakar', 'Kathmandu', 9841364517, 'sanjanashilpakar@gmail.com', '$2y$10$XzYVBKhUTSRj1', NULL, NULL, 'Approved'),
(6, 'ram', 'bkt', 9800000000, 'ram@gmail.com', '$2y$10$NmNJtHtiRQ9IW53xJ4L4/uOEkiTn1UERS.M/.B3n1Cc3VNZFK7GI2', NULL, NULL, 'Approved'),
(11, 'af', 'asdg', 1111111111, 'a@gmail.com', '$2y$10$gp.Lr8tnJK71Iv60uKe5jOXelzTOH/mzvXWWllnkGniME0BTgdiNa', NULL, NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `farm`
--

CREATE TABLE `farm` (
  `fid` int(11) NOT NULL,
  `farm_area` varchar(50) NOT NULL,
  `farm_unit` varchar(20) NOT NULL,
  `farm_type` varchar(50) NOT NULL,
  `farmer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farm`
--

INSERT INTO `farm` (`fid`, `farm_area`, `farm_unit`, `farm_type`, `farmer_id`) VALUES
(14, '10', 'acre', 'pineapple farm', 14);

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_otp_hash` varchar(64) DEFAULT NULL,
  `reset_otp_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`id`, `name`, `address`, `mobile`, `email`, `password`, `reset_otp_hash`, `reset_otp_expires_at`) VALUES
(14, 'Sugyan Shrestha', 'Bhaktapur', 9843929568, 'sugyanshrestha11@gmail.com', '$2y$10$l7kPzIyZLMz7BPbRyUV2bu6r1KwoIJWPXQG3RKvijlKFeuqPEp/7e', '58260713aee2888c6eb3d06aea6b47d2d394f4e1eb60c1ccb712a5de5f42012c', '2023-11-27 10:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `guidelines`
--

CREATE TABLE `guidelines` (
  `gid` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `predicament_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `counsellor_id` int(11) NOT NULL,
  `submitted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `predicament`
--

CREATE TABLE `predicament` (
  `pid` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `submitted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `predicament`
--

INSERT INTO `predicament` (`pid`, `farmer_id`, `title`, `description`, `submitted_date`) VALUES
(30, 14, 'resources', 'seeds pugyaena\r\n', '2023-11-27 08:04:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counsellor`
--
ALTER TABLE `counsellor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `reset_otp_hash` (`reset_otp_hash`);

--
-- Indexes for table `farm`
--
ALTER TABLE `farm`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `farm_ibfk_1` (`farmer_id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `reset_otp_hash` (`reset_otp_hash`);

--
-- Indexes for table `guidelines`
--
ALTER TABLE `guidelines`
  ADD PRIMARY KEY (`gid`),
  ADD KEY `counselor_id` (`counsellor_id`),
  ADD KEY `predicament_id` (`predicament_id`);

--
-- Indexes for table `predicament`
--
ALTER TABLE `predicament`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `predicament_ibfk_1` (`farmer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `counsellor`
--
ALTER TABLE `counsellor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `farm`
--
ALTER TABLE `farm`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `guidelines`
--
ALTER TABLE `guidelines`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `predicament`
--
ALTER TABLE `predicament`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `farm`
--
ALTER TABLE `farm`
  ADD CONSTRAINT `farm_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guidelines`
--
ALTER TABLE `guidelines`
  ADD CONSTRAINT `guidelines_ibfk_1` FOREIGN KEY (`counsellor_id`) REFERENCES `counsellor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guidelines_ibfk_2` FOREIGN KEY (`predicament_id`) REFERENCES `predicament` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `predicament`
--
ALTER TABLE `predicament`
  ADD CONSTRAINT `predicament_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
