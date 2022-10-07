-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2022 at 12:53 PM
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
(1, 'test image', '2022-10-03 10:37:58', 0),
(2, 'test crop', '2022-10-05 10:24:20', 0);

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
  `file_ext` varchar(10) NOT NULL,
  `max_width` int(11) DEFAULT 1024,
  `max_height` int(11) NOT NULL DEFAULT 768,
  `pos_left` float DEFAULT NULL,
  `pos_top` float DEFAULT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `storyboards_pictures`
--

INSERT INTO `storyboards_pictures` (`id`, `storyboards_id`, `position`, `minutes`, `seconds`, `text`, `picture`, `file_ext`, `max_width`, `max_height`, `pos_left`, `pos_top`, `date_create`) VALUES
(1, 1, 1, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 10:37:41'),
(2, 1, 2, 0, 0, '', '2.jpeg', '', 1024, 576, NULL, NULL, '2022-10-03 10:38:37'),
(3, 1, 3, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 10:38:47'),
(4, 1, 4, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 10:50:31'),
(5, 1, 5, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 11:31:48'),
(6, 1, 6, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 11:34:01'),
(7, 1, 7, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 11:45:15'),
(8, 1, 8, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 12:38:33'),
(9, 1, 9, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 12:47:05'),
(10, 1, 10, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 12:47:55'),
(11, 1, 11, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 12:49:35'),
(12, 1, 12, 0, 0, '', '12.jpeg', '', 1024, 576, NULL, NULL, '2022-10-03 12:51:35'),
(13, 1, 13, 0, 0, '', '13.jpeg', '', 1024, 576, NULL, NULL, '2022-10-03 13:01:22'),
(14, 1, 14, 0, 0, '', '14.jpeg', '', 1024, 576, NULL, NULL, '2022-10-03 13:21:04'),
(15, 1, 15, 0, 0, '', '15.jpeg', '', 1024, 576, 270, -341, '2022-10-03 13:21:18'),
(16, 1, 16, 0, 0, '', '', '', 1024, 576, NULL, NULL, '2022-10-03 13:54:24'),
(17, 2, 1, 0, 0, '', '17.jpeg', '.jpeg', 1024, 768, 207, -232, '2022-10-05 10:24:24'),
(18, 2, 2, 0, 0, '', '18.jpeg', '.jpeg', 1024, 768, 40, -534, '2022-10-05 10:24:30'),
(19, 2, 3, 0, 0, '', '', '', 1024, 768, NULL, NULL, '2022-10-05 10:59:04'),
(20, 2, 4, 0, 0, '', '', '', 1024, 768, NULL, NULL, '2022-10-05 10:59:31');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `storyboards_pictures`
--
ALTER TABLE `storyboards_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
