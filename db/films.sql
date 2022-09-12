-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2022 at 08:30 PM
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
-- Database: `films`
--

-- --------------------------------------------------------

--
-- Table structure for table `storyboards`
--

CREATE TABLE `storyboards` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp(),
  `del` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `storyboards`
--

INSERT INTO `storyboards` (`id`, `name`, `date_create`, `del`) VALUES
(1, 'test image', '2022-09-09 00:06:39', 0),
(2, 'test2', '2022-09-09 04:02:15', 0),
(3, 'test 3', '2022-09-11 22:37:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `storyboards_pictures`
--

CREATE TABLE `storyboards_pictures` (
  `id` int(11) NOT NULL,
  `storyboards_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `seconds` int(11) NOT NULL,
  `text` text NOT NULL,
  `picture` varchar(255) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `storyboards_pictures`
--

INSERT INTO `storyboards_pictures` (`id`, `storyboards_id`, `position`, `minutes`, `seconds`, `text`, `picture`, `date_create`) VALUES
(1, 1, 1, 0, 0, '', '1.jpeg', '2022-09-08 18:42:30'),
(2, 8, 1, 3, 6, '', '2.jpeg', '2022-09-09 00:06:47'),
(3, 8, 2, 0, 0, '', '', '2022-09-09 01:59:37'),
(4, 8, 3, 0, 0, '', '', '2022-09-09 02:43:07'),
(5, 8, 4, 0, 0, '', '', '2022-09-09 03:58:00'),
(6, 8, 5, 0, 0, '', '', '2022-09-09 03:58:19'),
(7, 8, 6, 0, 0, '', '', '2022-09-09 03:58:42'),
(8, 1, 2, 0, 0, '', '8.jpeg', '2022-09-09 03:59:16'),
(9, 1, 3, 0, 0, '', '', '2022-09-11 18:44:04'),
(10, 1, 4, 0, 0, '', '', '2022-09-11 20:05:30'),
(11, 1, 5, 0, 0, 'aaa', '', '2022-09-11 20:24:51'),
(12, 1, 6, 0, 0, 'aaa', '', '2022-09-11 20:27:44'),
(13, 1, 7, 0, 0, '', '', '2022-09-11 21:04:53'),
(14, 1, 8, 0, 0, '', '', '2022-09-11 22:30:33'),
(15, 1, 9, 0, 0, '', '', '2022-09-11 22:37:19'),
(16, 3, 1, 0, 0, '', '', '2022-09-11 22:38:47'),
(17, 3, 2, 4, 4, '', '', '2022-09-11 22:39:35'),
(18, 3, 3, 1, 5, '', '', '2022-09-11 22:39:59'),
(19, 3, 4, 0, 0, '', '', '2022-09-11 22:41:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `storyboards`
--
ALTER TABLE `storyboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storyboards_pictures`
--
ALTER TABLE `storyboards_pictures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `storyboards`
--
ALTER TABLE `storyboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `storyboards_pictures`
--
ALTER TABLE `storyboards_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
