-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2023 at 09:43 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `legal_scheduling`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(2, 'maxwell', 'max@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `complaint` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `time` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `name`, `category`, `complaint`, `date`, `time`, `status`) VALUES
(2, 'max pat maigari', 'civil law', 'overtake', '', '', 'pending'),
(5, 'max pat maigari', 'family law', 'cheating', '', '', 'approved'),
(26, 'max pat maigari', 'Corperate law', 'takeover', '10/23/2023', '9:17 PM', 'pending'),
(27, 'samuel eli', 'Corperate law', 'i am looking to for an attorney to structure my new venture', '10/16/2023', '11:00 AM', 'pending'),
(28, 'max pat maigari', 'Family law', 'devious', '11/06/2023', '11:05 AM', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `attorneys`
--

CREATE TABLE `attorneys` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `practise` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attorneys`
--

INSERT INTO `attorneys` (`id`, `name`, `email`, `address`, `password`, `practise`) VALUES
(1, 'Dom Ceasar', 'CeasarD@gmail.com', 'no 23 aje street barnawa,kaduna', 'c5c1b11f61f474c5d1377dafe47dc6fe1a03e1c1c3a9cd16f9682fb70f5c764c', 'Business law'),
(3, 'Maxwell Bright', 'maxbright@gmail.com', 'no 4 hayin banki kawo,Kaduna', '0de3fff69df0c6677946cf4e10a363d438e449a1b56ceb84a74b540bd0c65fad', 'Civil Law'),
(4, 'Michael Okpara', 'mike@gmail.com', 'block C NNPC quarters high cost kaduna', '783f4ae9eadd7aaed913ffcf90708b47e2d64ed2d7ab722345b0c155088fc4de', 'Criminal Law'),
(5, 'Suzan Dama', 'suzzydama@gmail.com', '11 ungwan yelwa sabo,Kaduna', '435225387468c2292caa39fefff16484cea92ae4c49107d5a47e66d8ce20658c', 'Family Law'),
(6, 'Harriet Silva', 'HSilva@gmail.com', '17 yoruba road karji,kaduna', '47efebb1a2ed3803c439f6893d43a1d504298b5bde2c562bc87c64306cdf7cf6', 'Corperate law');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `email`, `address`, `password`) VALUES
(16, 'max pat maigari', 'max@gmail.com', '5453 4553 sabo', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(17, 'christopher markus', 'markuschris@gmail.com', 'line 3 ugwan pama kaduna', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(18, 'samuel eli', 'sam@gmail.com', 'garki abuja', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f');

-- --------------------------------------------------------

--
-- Table structure for table `pend`
--

CREATE TABLE `pend` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `complaint` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `AOR` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `time` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pend`
--

INSERT INTO `pend` (`id`, `name`, `complaint`, `AOR`, `date`, `time`, `status`) VALUES
(3, 'max pat maigari', 'takeover', 'Michael Okpara', '10/23/2023', '9:17 PM', 'pending'),
(5, 'max pat maigari', 'cheating', 'Dom Ceasar', '', '', 'pending'),
(6, 'max pat maigari', 'overtake', 'Suzan Dama', '', '', 'Accepted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attorneys`
--
ALTER TABLE `attorneys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pend`
--
ALTER TABLE `pend`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `attorneys`
--
ALTER TABLE `attorneys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pend`
--
ALTER TABLE `pend`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
