-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 03:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `club_registrations`
--

-- --------------------------------------------------------

--
-- Table structure for table `club_inquiries`
--

CREATE TABLE `club_inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `roll_number` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `roll_number` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `roll_number`, `message`, `created_at`) VALUES
(3, 'Hardik', 'hardik@gmail.com', '24155627', 'hello', '2024-10-28 01:49:45'),
(4, 'Hardik', 'hardik@gmail.com', '24155627', 'hello', '2024-10-28 01:50:53'),
(7, 'wdada', 'wdawd@gmail.com', '2323232323', '23232323', '2024-10-28 01:51:24'),
(8, 'wada', 'wdad@gmail.com', '23232', '23322\r\n', '2024-10-28 01:51:46'),
(10, 'Demo', 'demo@demo.com', '241556267', 'Demo', '2024-10-28 02:00:51'),
(11, 'Demo', 'demo@demo.com', '241556267', 'Demo', '2024-10-28 02:01:48'),
(12, 'Demo', 'demo@demo.com', '241556267', 'Demo', '2024-10-28 02:02:58'),
(13, 'Demo', 'demo@demo.com', '323', '2323', '2024-10-28 02:03:46'),
(14, 'Hardik', 'hardik@gmail.com', '24155627', 'wdada', '2024-10-28 02:22:31'),
(15, 'Hardik', 'hardik@gmail.com', '24155627', 'wdada', '2024-10-28 02:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `roll_number` varchar(20) DEFAULT NULL,
  `club` varchar(50) NOT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `name`, `email`, `contact_number`, `roll_number`, `club`, `message`) VALUES
(5, 'Arushi', 'arushi@email.com', '9898989898', '23232323', 'Quotopia', '1212'),
(6, 'Arushi', 'arushi@email.com', '9898989898', '23232323', 'Quotopia', '45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club_inquiries`
--
ALTER TABLE `club_inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club_inquiries`
--
ALTER TABLE `club_inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
