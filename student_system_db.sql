-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2026 at 06:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `interests` varchar(255) NOT NULL,
  `student_class` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `marks` int(11) NOT NULL,
  `aadhaar_file` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `date_of_birth`, `gender`, `qualification`, `interests`, `student_class`, `subject`, `marks`, `aadhaar_file`, `role`) VALUES
(1, 'NANNURI RAKESH REDDY', '22211a0239@bvrit.ac.in', '$2y$10$kwnlhuoBslEmRkq6IV3dke0bFyrPV/sFgQa85BNgHXWFlmXBQdSh.', '2006-06-08', 'Male', 'B.Tech', 'Coding, Sports', 'B.tech', 'maths', 100, 'aadhaar_6ac6ed78675204.32376845.pdf', 'student'),
(2, 'Laxmi Narasimha Reddy', 'lachu.rocksz@gmail.com', '$2y$10$HxK2cFeQWQ4TAl5CU2eibOU7Q1EPSq3uArENon5RPlVkG3F7hyCgu', '2003-10-12', 'Male', 'B.Tech', 'Coding, Sports', 'B.tech', 'maths,science', 90, 'aadhaar_6ac70372a819f5.11003414.pdf', 'student'),
(3, 'Administrator', 'admin@gmail.com', '$2y$10$458NY3ylXOfNO7ls9oCDlO4ty9BM9.MJQzsnrUOqvF86p3EDpY57G', '2000-01-01', 'Other', 'Admin', '', 'Admin', 'Admin', 0, '', 'admin'),
(7, 'raja', 'raja@gmail.com', '$2y$10$xLSSqJ6rLmsIkJGx9w6.3.Qs1HQLvaFDYUB0rCvGTHrDtX7O/2l6C', '1995-10-08', 'Male', 'B.Com', 'Sports', 'MBA', 'Meical subjects', 100, 'aadhaar_6ac71373d1f5c0.42268045.pdf', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
