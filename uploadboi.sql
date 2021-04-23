-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 02:11 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uploadboi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'tejastg007@gmail.com', 'tejas@123');

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(10) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `broadcast`
--

CREATE TABLE `broadcast` (
  `id` int(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `broadcast`
--

INSERT INTO `broadcast` (`id`, `message`, `date`) VALUES
(1, 'this is testing message from the database', '2021-04-22'),
(2, 'Max file upload size has been changed to 1024 MB for the logged in users and 100 for non-logged in users.', '2021-04-22'),
(3, 'this is testing message from the admin panel', '2021-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `deletefiles`
--

CREATE TABLE `deletefiles` (
  `deletedfiles` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deletefiles`
--

INSERT INTO `deletefiles` (`deletedfiles`) VALUES
(5);

-- --------------------------------------------------------

--
-- Table structure for table `filedata`
--

CREATE TABLE `filedata` (
  `id` int(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `size` varchar(10) NOT NULL,
  `uploaddate` date NOT NULL,
  `expirydate` date NOT NULL,
  `hits` int(10) NOT NULL,
  `tomail` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filedata`
--

INSERT INTO `filedata` (`id`, `code`, `filename`, `extension`, `size`, `uploaddate`, `expirydate`, `hits`, `tomail`, `status`, `user`) VALUES
(1, '2407028', 'Screenshot_20200624-134114.png', 'png', '0.15', '2021-04-20', '2021-05-18', 10, '', 'public', ''),
(2, '8876177', 'Screenshot_20200430-023812.png', 'png', '0.39', '2021-04-21', '2022-04-21', 0, '', 'public', 'dipak'),
(8, '2365932', 'course-e-book-website-v2.0.pdf', 'pdf', '0.46', '2021-04-22', '2022-04-22', 0, '', 'public', 'dipak'),
(9, '2425686', 'course-e-book-website-v2.0.pdf', 'pdf', '0.46', '2021-04-22', '2021-05-20', 0, 'tejastg007@gmail.com', 'public', ''),
(10, '4952575', 'course-e-book-website-v2.0.pdf', 'pdf', '0.46', '2021-04-22', '2022-04-22', 0, 'tejastg007@gmail.com', 'public', 'dipak'),
(11, '9184093', 'course-e-book-website-v2.0.pdf', 'pdf', '0.46', '2021-04-22', '2021-05-20', 0, 'tejastg007@gmail.com', 'public', ''),
(12, '9693056', 'assignment2.pkt', 'pkt', '0.1', '2021-04-22', '2022-04-22', 0, 'tejastg007@gmail.com', 'public', 'dipak');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `username`, `name`, `message`, `email`, `date`, `status`) VALUES
(1, 'dipak', 'dipak patil', 'testing contact us message', 'dipak.22020252@viit.ac.in', '2021-04-22', 'solved'),
(2, 'dipak', 'dipak patil', 'this is second testing contact us after some updates', 'dipak.22020252@viit.ac.in', '2021-04-22', 'solved');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `maxfilesize` int(10) NOT NULL,
  `maxfilesizenl` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `maxfilesize`, `maxfilesizenl`) VALUES
(1, 1024, 100);

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `joindate` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `username`, `email`, `joindate`, `password`) VALUES
(1, 'dipak', 'dipak.22020252@viit.ac.in', '2021-04-20', 'dipak1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `broadcast`
--
ALTER TABLE `broadcast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filedata`
--
ALTER TABLE `filedata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `broadcast`
--
ALTER TABLE `broadcast`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `filedata`
--
ALTER TABLE `filedata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
