-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2021 at 04:24 AM
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
(2, '9144359', 'course-e-book-website-v2.0.pdf', 'pdf', '0.46', '2021-04-15', '2022-04-15', 10, '', 'public', 'tejastg'),
(5, '7180291', 'Thumbnail~.jpg', 'jpg', '0.31', '2021-04-15', '2022-04-15', 7, '', 'public', 'tejastg'),
(10, '6975687', 'signup.php', 'php', '0.1', '2021-04-15', '2022-04-15', 10, '', 'public', 'tejastg'),
(35, '8986615', 'detect js.html', 'html', '0.1', '2021-04-17', '2022-04-17', 0, '', 'public', 'soniya'),
(36, '7750545', 'ISMPublished.pdf', 'pdf', '0.92', '2021-04-17', '2021-05-15', 0, '', 'public', ''),
(37, '9226449', 'detect js.html', 'html', '0.1', '2021-04-17', '2022-04-17', 13, 'soniya@gmail.com', 'private', 'tejastg'),
(38, '9961317', 'ISMPublished.pdf', 'pdf', '0.92', '2021-04-17', '2022-04-17', 0, '', 'public', 'soniya');

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
(1, 'tejastg', 'tejastg007@gmail.com', '2021-04-14', '123'),
(2, 'yogeshyg', 'yogeshyg@gmail.com', '2021-04-14', '123'),
(3, 'dipak', 'deepak@gmail.com', '2021-04-14', '123'),
(4, 'minal', 'minalpatil@gmail.com', '2021-04-14', '123'),
(5, 'soniya', 'soniya@gmail.com', '2021-04-14', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filedata`
--
ALTER TABLE `filedata`
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
-- AUTO_INCREMENT for table `filedata`
--
ALTER TABLE `filedata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
