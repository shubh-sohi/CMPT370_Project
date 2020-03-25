-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Generation Time: Dec 04, 2018 at 11:50 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shubh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Dumping data for table `job`
-- 
INSERT INTO `job` (`category`, `title`, `job_description`, `amount`, `job_address`, `job_province`, `job_city`, `job_postal`, `job_phone`, `job_status`) 
VALUES
('IT', 'Need a website', 'A wordpress portfolio website needs to be build for my Business.','750', '110 Reid Rd', 'Saskatchewan', 'Saskatoon', '3063063067', 'S7N S7N', 'open'),
('Household', 'Need to clean my backyard', 'only for students. approximate 2 hours job.', '50', '110 Reid Rd', 'Saskatchewan', 'Saskatoon', '3063063067','S7N S7N', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--


CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL UNIQUE,
  `phone` bigint(12) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` ( `first_name`, `last_name`, `password`, `email`, `phone`) VALUES
('Alavi', 'Sharar', MD5('12345'), 'ask172@usask.ca', 6399160971),
('MD', 'Talukder', MD5('12345'), 'mdt014@usask.ca', 3062033669);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--

CREATE TABLE `postedjobs` (
  `user_id` int,
  `job_id` int,
  FOREIGN KEY (user_id) REFERENCES user(user_id),
  FOREIGN KEY (job_id) REFERENCES job(job_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `requestedjobs` (
  `user_id` int,
  `job_id` int,
  `is_assigned` BOOL NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(user_id),
  FOREIGN KEY (job_id) REFERENCES job(job_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;