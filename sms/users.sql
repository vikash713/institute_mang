-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2023 at 02:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `coursedetails`
--

CREATE TABLE `coursedetails` (
  `courseId` int(10) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `courseDuration` varchar(100) NOT NULL,
  `courseFee` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursedetails`
--

INSERT INTO `coursedetails` (`courseId`, `courseName`, `courseDuration`, `courseFee`) VALUES
(221, 'PHP', '2 Months', 21000),
(222, 'JAVA', '3 Months', 18000),
(223, 'SQLi', '6 Months', 24000),
(225, 'QA', '2 Months', 20000),
(226, 'Cotline', '1 Months', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `studentsdetail`
--

CREATE TABLE `studentsdetail` (
  `rollno` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(12) NOT NULL,
  `courseid` int(10) NOT NULL,
  `subscriptions` varchar(10) NOT NULL,
  `id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentsdetail`
--

INSERT INTO `studentsdetail` (`rollno`, `name`, `email`, `contact`, `courseid`, `subscriptions`, `id`) VALUES
(12345, 'Manish', 'manish@gmail.com', 2147483647, 222, 'true', 5),
(34567, 'Anid', 'anid@gmail.com', 2147483647, 225, 'false', 6),
(123456, 'chootu', 'chootu@gmail.com', 67889065, 222, 'true', 7);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionsdetail`
--

CREATE TABLE `subscriptionsdetail` (
  `rollno` int(10) NOT NULL,
  `subscriptionName` varchar(100) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptionsdetail`
--

INSERT INTO `subscriptionsdetail` (`rollno`, `subscriptionName`, `amount`) VALUES
(101, '221', 21000),
(102, '222', 18000),
(103, '223', 24000),
(104, '225', 20000),
(106, '226', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `id`) VALUES
('saurav', '12345', 1),
('saurav@gmail.com', '12345', 7),
('saurav1@gmail.com', '123', 9),
('saurav2@gmail.com', '123456', 13),
('saurav@gmail.com', '1234', 14),
('rahul@gmail.com', '7677479005', 15);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `rollno` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `courseid` int(10) NOT NULL,
  `subscription` tinyint(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`rollno`, `name`, `email`, `courseid`, `subscription`, `id`) VALUES
(0, '', '', 0, 0, 0),
(1, '', 'saurav@gmail.com', 0, 0, 0),
(102, 'saurav1', 'saurav1@gmail.com', 0, 0, 0),
(103, 'saurav new', 'saurav2@gmail.com', 0, 0, 0),
(104, 'saurav', 'saurav@gmail.com', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursedetails`
--
ALTER TABLE `coursedetails`
  ADD PRIMARY KEY (`courseId`);

--
-- Indexes for table `studentsdetail`
--
ALTER TABLE `studentsdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`rollno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentsdetail`
--
ALTER TABLE `studentsdetail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
