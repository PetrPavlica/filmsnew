-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 05:32 AM
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
(1, 'Test', '2022-10-17 11:30:04', 0),
(2, 'Petr Pavlica', '2022-10-17 15:10:06', 0),
(4, 'test', '2022-10-21 05:48:12', 0),
(5, 'test', '2022-10-21 06:01:53', 0),
(13, 'vanoce', '2022-11-03 06:34:11', 0),
(14, 'test', '2022-10-31 04:31:11', 0),
(15, 'test cropu', '2022-11-03 13:49:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `storyboards_pictures`
--

CREATE TABLE `storyboards_pictures` (
  `id` int(11) NOT NULL,
  `storyboards_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `seconds` float NOT NULL,
  `text` text NOT NULL,
  `text_aboute` text NOT NULL,
  `picture` varchar(255) NOT NULL,
  `file_ext` varchar(10) NOT NULL,
  `max_width` int(11) DEFAULT 1024,
  `max_height` int(11) NOT NULL DEFAULT 768,
  `pos_left` float DEFAULT NULL,
  `pos_top` float DEFAULT NULL,
  `pos_with` int(11) NOT NULL DEFAULT 320,
  `pos_height` int(11) NOT NULL DEFAULT 230,
  `use_crop` tinyint(1) NOT NULL DEFAULT 0,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `storyboards_pictures`
--

INSERT INTO `storyboards_pictures` (`id`, `storyboards_id`, `position`, `minutes`, `seconds`, `text`, `text_aboute`, `picture`, `file_ext`, `max_width`, `max_height`, `pos_left`, `pos_top`, `pos_with`, `pos_height`, `use_crop`, `date_create`) VALUES
(7, 2, 2, 0, 0.4, '', '', '7resize.jpeg', '.jpeg', 737, 553, NULL, NULL, 320, 230, 0, '2022-10-17 15:10:34'),
(8, 2, 1, 0, 1.3, 'test presahu test presahutest presahutest test presahutest presahutest presahutest presahutest presahu', 'test presahu test presahutest presahutest test presahutest presahutest presahutest presahutest presahu', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-18 15:53:13'),
(9, 2, 3, 0, 1.6, '', '', '9resize.jpeg', '.jpeg', 848, 476, NULL, NULL, 320, 230, 0, '2022-10-18 15:56:15'),
(10, 2, 4, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-18 16:10:02'),
(11, 2, 5, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-18 16:10:23'),
(12, 2, 6, 0, 1, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-18 16:10:48'),
(13, 1, 1, 0, 0, '', '', '13resize.jpeg', '.jpeg', 705, 396, NULL, NULL, 339, 189, 1, '2022-10-20 15:49:42'),
(14, 1, 2, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-20 15:49:54'),
(15, 1, 3, 0, 0.3, '', '', '15resize.jpeg', '.jpeg', 735, 413, 193, 144, 561, 313, 1, '2022-10-20 17:10:26'),
(16, 1, 4, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-20 17:12:49'),
(17, 3, 1, 0, 0, '', '', '17.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 05:09:12'),
(18, 3, 2, 0, 0, '', '', '18.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 05:10:07'),
(19, 3, 3, 0, 0.2, '', '', '19.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 05:35:57'),
(20, 3, 4, 0, 0, '', '', '20.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 05:36:37'),
(21, 4, 1, 0, 0.1, '', '', '21.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 05:48:16'),
(22, 4, 2, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-21 05:58:44'),
(23, 4, 3, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-21 06:00:26'),
(24, 4, 4, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-21 06:01:09'),
(25, 5, 1, 0, 0.1, '', '', '25.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 06:01:57'),
(26, 5, 2, 0, 0.3, '', '', '26.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 06:04:34'),
(27, 5, 3, 0, 0, '', '', '27.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 06:37:49'),
(28, 5, 4, 0, 0.3, '', '', '28.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 07:04:41'),
(29, 6, 1, 0, 0.4, '', '', '29.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 07:23:59'),
(30, 6, 2, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-21 07:25:57'),
(31, 6, 3, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-21 07:26:26'),
(32, 6, 4, 0, 0, '', '', '32.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-21 07:40:57'),
(33, 7, 1, 0, 0.1, '', '', '33.jpeg', '.jpeg', 1024, 576, NULL, NULL, 630, 352, 0, '2022-10-21 16:45:26'),
(34, 7, 2, 0, 0.1, '', '', '34resize.jpeg', '.jpeg', 758, 426, NULL, NULL, 445, 248, 0, '2022-10-21 18:52:21'),
(35, 7, 3, 0, 0.1, '', '', '35resize.jpeg', '.jpeg', 882, 495, 438, 63, 639, 357, 1, '2022-10-21 19:05:59'),
(36, 7, 4, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-21 19:09:24'),
(37, 8, 1, 0, 0.1, 'První řádek ', 'Dlouhý text  text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text ', '37.jpeg', '.jpeg', 808, 454, NULL, NULL, 565, 314, 1, '2022-10-23 03:40:39'),
(38, 8, 2, 0, 0, '', '', '38.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-23 05:50:41'),
(39, 8, 3, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-23 05:50:54'),
(48, 13, 1, 0, 3, 'Proč dáváme lidem dárky?', 'Je Štědrý večer, rodina je v obýváku u stromečku. Táta mámě předává dárek, děti to s úsměvem pozorují. Kamera je v mírném pohybu.', '48.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-22 13:59:34'),
(49, 13, 2, 0, 2, 'Přece kvůli tomu pohledu.', 'Maminka rozbalí dárek a kamera se přiblíží na detail jejího obličeje. Záběr se zpomalí a světlo se mírně změní. Ve velkém detailu nyní vidíme pocity maminky těsně po rozbalení dárku. Vidíme radost v očích a rozzářený obličej.', '49.jpeg', '.jpeg', 1024, 576, 435, 294, 320, 230, 0, '2022-10-22 13:59:37'),
(50, 13, 3, 0, 2, 'Každý ho má', 'Zůstáváme v detailu a dostáváme se do jiné situace - do jiného domu. Vidíme mladou ženu opět těsně po rozbalení dárku od kamarádky. Kamera zabírá detail obličeje a vidíme pobavení, radost, souznění mezi kamarádkami. Záběr je zpomalen.', '50.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-22 13:59:38'),
(51, 13, 4, 0, 2, 'trochu jiný.', 'Střihneme do další situace předání dárku. Zde mladý muž okolo 25 let rozbalil dárek od přítelkyně. V detailu obličeje vidíme radost, zamilovanost, překvapení. Záběr je zpomalen.', '51.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-22 13:59:39'),
(52, 13, 5, 0, 2, 'Ale pro každého,', 'Starší žena v tradičně zařízeném pokoji. V jejím pohledu je souznění a pochopení - i po mnoha letech je k ní manžel stále pozorný. Záběr je zpomalený.', '52.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-22 13:59:40'),
(53, 13, 6, 0, 2, 'Najdete něco u nás.', 'Vidíme holčičku okolo 9 let, rozbalí dárek a má nefalšovanou dětskou radost, vidíme v detailu jejího obličeje nadšení z prvního „dospělého“ dárku. Záběr je zpomalen.', '53.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-22 13:59:46'),
(54, 13, 7, 0, 2, 'Na Notínu.', '…a nakonec jsme opět u první rodinky, záběr se vrátí do normální rychlosti a dojatá maminka obejme tatínka. Kamera je v mírném pohybu.', '54.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-22 13:59:47'),
(55, 13, 8, 0, 3, 'Nyní doprava na vše zdarma.', 'Ukážeme aktuální nabídku', '55.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-22 14:03:38'),
(56, 13, 9, 0, 2, 'Notíno.', '', '56.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-10-22 14:03:59'),
(57, 8, 4, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-27 06:11:09'),
(58, 8, 5, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-27 06:23:22'),
(59, 8, 6, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-27 23:00:26'),
(60, 14, 2, 0, 0, '', '', '60.jpeg', '.jpeg', 1024, 669, NULL, NULL, 320, 230, 0, '2022-10-31 04:31:19'),
(61, 14, 1, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-31 04:31:39'),
(62, 14, 3, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-10-31 04:32:01'),
(63, 14, 4, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-11-01 03:51:44'),
(64, 14, 5, 0, 0, '', '', '', '', 1024, 768, NULL, NULL, 320, 230, 0, '2022-11-01 03:56:06'),
(65, 13, 10, 0, 0.1, '', '', '65.jpeg', '.jpeg', 1024, 669, NULL, NULL, 320, 230, 0, '2022-11-03 07:59:48'),
(66, 13, 11, 0, 0.3, 'test', 'test', '66.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-11-03 07:59:53'),
(67, 13, 12, 0, 0.6, 'test jedeme', 'jedeme', '67.jpeg', '.jpeg', 1024, 576, NULL, NULL, 320, 230, 0, '2022-11-03 08:01:01'),
(68, 15, 1, 0, 0.7, 'Test', 'Test', '68.jpeg', '.jpeg', 422, 237, 48, 53, 398, 222, 1, '2022-11-03 13:49:45');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `storyboards_pictures`
--
ALTER TABLE `storyboards_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
