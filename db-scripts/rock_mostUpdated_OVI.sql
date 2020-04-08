-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2020 at 01:49 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rock`
--

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `job_description` text NOT NULL,
  `amount` varchar(50) NOT NULL,
  `job_address` varchar(100) NOT NULL,
  `job_province` varchar(50) NOT NULL,
  `job_city` varchar(50) NOT NULL,
  `job_postal` varchar(50) NOT NULL,
  `job_phone` varchar(50) NOT NULL,
  `job_status` varchar(50) NOT NULL,
  `poster_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `category`, `title`, `job_description`, `amount`, `job_address`, `job_province`, `job_city`, `job_postal`, `job_phone`, `job_status`, `poster_email`) VALUES
(1, 'IT', 'Need a website', 'A wordpress portfolio website needs to be build for my Business.', '750', '110 Reid Rd', 'Saskatchewan', 'Saskatoon', '3063063067', 'S7N S7N', 'open', ''),
(2, 'Household', 'Need to clean my backyard', 'only for students. approximate 2 hours job.', '50', '110 Reid Rd', 'Saskatchewan', 'Saskatoon', '3063063067', 'S7N S7N', 'open', ''),
(1223705352, 'Whatever 10', 'lol', 'juju', '32', 'BOX:83,103 CUMBERLAND AVENUE SOUTH', '12', 'Saskatoon', 'S7N 5E8', '3062033669', 'open', 'adi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `postedjobs`
--

CREATE TABLE `postedjobs` (
  `user_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postedjobs`
--

INSERT INTO `postedjobs` (`user_id`, `job_id`) VALUES
(1, 1),
(2, 2),
(2, 2),
(2, 2),
(2, 2),
(3, 1223705352);

-- --------------------------------------------------------

--
-- Table structure for table `requestedjobs`
--

CREATE TABLE `requestedjobs` (
  `user_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `is_assigned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `password`, `email`, `phone`) VALUES
(1, 'Alavi', 'Sharar', '827ccb0eea8a706c4c34a16891f84e7b', 'ask172@usask.ca', 6399160971),
(2, 'MD', 'Talukder', '827ccb0eea8a706c4c34a16891f84e7b', 'mdt014@usask.ca', 3062033669),
(3, 'Alavi', 'khan', '827ccb0eea8a706c4c34a16891f84e7b', 'adi@gmail.com', 6399160971),
(4, 'Md', 'Talukder', '827ccb0eea8a706c4c34a16891f84e7b', 'adi2@gmail.com', 306),
(5, 'MD', 'TALUKDER', '827ccb0eea8a706c4c34a16891f84e7b', 'adi4@gmail.com', 3062033669);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `postedjobs`
--
ALTER TABLE `postedjobs`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `requestedjobs`
--
ALTER TABLE `requestedjobs`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1223705353;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `postedjobs`
--
ALTER TABLE `postedjobs`
  ADD CONSTRAINT `postedjobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `postedjobs_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`);

--
-- Constraints for table `requestedjobs`
--
-- ALTER TABLE `requestedjobs`
--   ADD CONSTRAINT `requestedjobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
--   ADD CONSTRAINT `requestedjobs_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`);
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
