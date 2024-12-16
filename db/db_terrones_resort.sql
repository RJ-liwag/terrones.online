-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2024 at 11:41 AM
-- Server version: 8.3.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_terrones_resort`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

DROP TABLE IF EXISTS `admin_account`;
CREATE TABLE IF NOT EXISTS `admin_account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `username`, `password`, `status`) VALUES
(1, 'Admin', '$2y$10$YBClitHD7yYG1LL6qr5gpe6pfScDZ83bpZiYv4xF2BpnuBpy3LUzK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `date_posted` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `username`, `date_posted`, `expiry_date`) VALUES
(1, 'Announcement', 'Test', 'admin', '2024-11-11 00:00:00', '2024-11-30 00:00:00'),
(2, 'Test', 'content', 'admin', '2024-02-12 00:00:00', '2024-02-12 00:00:00'),
(3, 'test', 'test', 'admin', '2024-12-31 00:00:00', '2024-12-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cottages`
--

DROP TABLE IF EXISTS `cottages`;
CREATE TABLE IF NOT EXISTS `cottages` (
  `room_id` int NOT NULL AUTO_INCREMENT,
  `room_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `max_capacity` int NOT NULL,
  `price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `room_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `room_img` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cottages`
--

INSERT INTO `cottages` (`room_id`, `room_name`, `description`, `max_capacity`, `price`, `status`, `room_status`, `room_img`, `created_date`, `updated_date`) VALUES
(1, 'Cottage 1', 'qwewqeqewqwewqeqwe', 5, '750', 'Inactive', 'Available', 'Cottage 1-20240808140240.jpg', 'August 8, 2024 | 08:02 PM', ''),
(2, 'Cottage 2', 'asdsadasdsd', 10, '1100', 'Inactive', 'Available', 'Cottage 2-20240808140254.jpg', 'August 8, 2024 | 08:02 PM', ''),
(3, 'Big Cottage', 'oqweijwqiejwqoiejqwewqe', 20, '1500', 'Inactive', 'Available', 'Big Cottage-20240808140507.jpg', 'August 8, 2024 | 08:05 PM', ''),
(4, 'Test ', 'SDFSDFSDFSDFSDFSDF', 12, '750', 'Inactive', 'Available', 'Test -20241111142839.jpg', 'November 11, 2024 | 09:28 PM', ''),
(5, 'Cottage', 'zxczxczxczxc', 23, '1200', 'Inactive', 'Available', 'Cottage-20241114142926.jpg', 'November 14, 2024 | 09:29 PM', ''),
(6, 'Cottage', 'zxczxczxczxc', 23, '1200', 'Inactive', 'Available', 'Cottage-20241114142926.jpg', 'November 14, 2024 | 09:29 PM', ''),
(7, 'Cottage', 'zxczxczxczxc', 23, '1200', 'Inactive', 'Available', 'Cottage-20241114142926.jpg', 'November 14, 2024 | 09:29 PM', ''),
(8, 'Cottage', 'zxczxczxczxc', 23, '1200', 'Inactive', 'Available', 'Cottage-20241114142927.jpg', 'November 14, 2024 | 09:29 PM', ''),
(9, 'Cottage', 'asdas', 20, '750', 'Inactive', 'Available', '', 'November 14, 2024 | 09:29 PM', ''),
(10, 'Cottage', 'asdas', 20, '750', 'Inactive', 'Available', '', 'November 14, 2024 | 09:30 PM', ''),
(11, 'Cottage', 'adsadsad', 20, '1500', 'Inactive', 'Available', 'Cottage-20241114143040.jpg', 'November 14, 2024 | 09:30 PM', ''),
(12, '', '', 0, '0', 'Inactive', 'Available', '', 'November 14, 2024 | 09:32 PM', ''),
(13, 'Cottage', 'qqwewqewqeqwe', 20, '1500', 'Inactive', 'Available', 'Cottage-20241114143732.jpg', 'November 14, 2024 | 09:37 PM', ''),
(14, 'Cottage', '12', 12, '750', 'Inactive', 'Available', 'Cottage-20241114155314.jpg', 'November 14, 2024 | 10:53 PM', ''),
(15, 'Cottage', 'asassa', 20, '750', 'Inactive', 'Available', 'Cottage-20241114155907.jpg', 'November 14, 2024 | 10:59 PM', ''),
(16, 'Cottage', '122112', 20, '750', 'Inactive', 'Available', 'Cottage-20241114160103.jpg', 'November 14, 2024 | 11:01 PM', ''),
(17, 'Cottage', 'asdadsds', 20, '750', 'Inactive', 'Available', 'Cottage-20241114161442.jpg', 'November 14, 2024 | 11:14 PM', ''),
(18, 'Cottage', '121221', 12, '750', 'Inactive', 'Available', 'Cottage-20241114164233.jpg', 'November 14, 2024 | 11:42 PM', ''),
(19, 'TEST 3333', '12', 12, '750.00', 'Active', 'Available', 'Test-20241114164943.jpg', 'November 14, 2024 | 11:49 PM', 'November 21, 2024 | 11:52 AM'),
(20, 'arujay', 'awsfga', 5, '1000.00', 'Inactive', 'Available', 'arujay-20241121010835.png', 'November 21, 2024 | 09:08 AM', '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `ref` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `comment`, `rating`, `created_at`, `ref`) VALUES
(1, 'Cj', 'qeqweqweqweqweqwe', '4', '2024-11-11 21:07:47', ''),
(2, 'Cj 2', 'qweqwewq', '5', '2024-11-11 21:07:56', ''),
(3, 'tETS', 'testsets', '5', '2024-11-21 10:00:43', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `max_capacity` int NOT NULL,
  `price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `room_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `room_img` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `updated_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `description`, `max_capacity`, `price`, `status`, `room_status`, `room_img`, `created_date`, `updated_date`) VALUES
(40, 'Room 2', 'ASDASDASDASDASD', 20, '123213', 'Inactive', 'Available', 'Room 2-20240727050419.jpg', 'July 27, 2024 | 11:04 AM', ''),
(41, 'Room 3', 'sadsadsadsadsadsa', 20, '123', 'Inactive', 'Available', 'Room 3-20240727050450.jpg', 'July 27, 2024 | 11:04 AM', ''),
(42, 'Room 9', 'ugohoihohooij', 10, '1515', 'Inactive', 'Available', 'Room 9-20240727051402.jpg', 'July 27, 2024 | 11:14 AM', ''),
(43, 'Cottage', 'Description', 6, '750', 'Inactive', 'Available', 'Cottage-20240808134042.jpg', 'August 8, 2024 | 07:40 PM', ''),
(44, 'Cottage 1', 'wuherqwehruioqhweoriuqher', 7, '750', 'Inactive', 'Available', 'Cottage 1-20240808134534.jpg', 'August 8, 2024 | 07:45 PM', ''),
(45, 'Room 1', 'wqerrwqewqerweqrqeqer', 2, '1500', 'Inactive', 'Available', 'Room 1-20240808134556.jpg', 'August 8, 2024 | 07:45 PM', ''),
(46, 'Cottage 1', 'wqeewwwqeqwwqeqe', 7, '750', 'Inactive', 'Available', 'Cottage 1-20240808140109.jpg', 'August 8, 2024 | 08:01 PM', ''),
(47, 'Room 344', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Leo sed egestas dictum nec quis placerat mi magna? Placerat suscipit odio; semper conubia aenean tortor. Eget sapien hendrerit bibendum; vulputate rhoncus sem luctus dis. Ultricies nibh cursus vehicula;', 2, '1500.00', 'Active', 'Available', 'Room 1-20240808140433.jpg', 'August 8, 2024 | 08:04 PM', 'November 21, 2024 | 11:52 AM'),
(48, 'arujay', 'afasdfasdf', 5, '1000', 'Inactive', 'Available', 'arujay-20240818042159.jpg', 'August 18, 2024 | 12:21 PM', ''),
(49, 'arujay', 'asfsfasd fasdf asfdasfnma snfjkdashfhajskdhfj hajdsfhjakshfjahs hadsjfhjadshf jhdsajfhajh jadfhj ahjfh jashf jsahjfh jadshfjsah jhdsafjhjkashf jhajksfhjaksh fjahsf jdfsh', 5, '1000', 'Inactive', 'Available', '', 'August 19, 2024 | 08:44 PM', ''),
(51, 'Room 2', 'Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample ', 20, '1500', 'Inactive', 'Available', 'Room 2-20240929081433.png', 'September 29, 2024 | 02:14 PM', ''),
(52, 'Room 2', 'qweqweqwe', 5, '700.00', 'Active', 'Available', 'Room 2-20241004073510.jpg', 'October 4, 2024 | 03:35 PM', 'November 21, 2024 | 04:54 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservations`
--

DROP TABLE IF EXISTS `tbl_reservations`;
CREATE TABLE IF NOT EXISTS `tbl_reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference_number` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `facility_id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tour_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pax` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reservation_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_date` date NOT NULL,
  `ref` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_reservations`
--

INSERT INTO `tbl_reservations` (`id`, `reference_number`, `facility_id`, `name`, `address`, `email`, `phone`, `tour_type`, `pax`, `type`, `status`, `reservation_date`, `created_date`, `ref`) VALUES
(24, 'REF-0YX6W65TT', 19, 'Test', 'aldin', 'test@gmail.com', '09672562065', 'day', '12', 'cottage', 'pending', '[\"2024-11-21\",\"2024-11-21\"]', '2024-11-21', '1'),
(23, 'REF-QPDHYUNIE', 52, 'ALdin', 'Test', 'aldin@gmail.com', '09672562065', 'day', '5', 'room', 'pending', '[\"2024-11-21\",\"2024-11-21\"]', '2024-11-21', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_inquries`
--

DROP TABLE IF EXISTS `user_inquries`;
CREATE TABLE IF NOT EXISTS `user_inquries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_mobileno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `user_inquries`
--

INSERT INTO `user_inquries` (`id`, `user_name`, `user_email`, `user_mobileno`, `user_subject`, `user_message`, `created_date`, `status`) VALUES
(1, 'Juan Dela Cruz', 'juandelacruz@gmail.com', '099917274398', 'Test', 'Test message', 'October 5, 2024 | 06:23 PM', '1'),
(2, 'asd', 'jama262001@gmail.com', '09672562065', 'weqwe', 'qweqwe', 'November 8, 2024 | 08:20 AM', '1'),
(3, 'john aldin', 'jama262001@gmail.com', '09672562065', 'qwe', 'qwe', 'November 21, 2024 | 04:02 PM', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
