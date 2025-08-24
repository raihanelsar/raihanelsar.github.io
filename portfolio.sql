-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2025 at 04:34 AM
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
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` enum('app','card','web') NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `title`, `category`, `description`, `image`, `link`, `tags`, `created_at`, `updated_at`) VALUES
(1, 'Music Player', 'app', 'Deadpool and Wolverine\r\nOST Bye Bye Bye', '1755533704_deadpool.jpg', 'https://musicplayerrek.vercel.app', 'html, css, js', '2025-08-18 16:15:04', '2025-08-19 11:15:15'),
(2, 'Dapoer R2', 'web', 'Landing Page Dapoer R2', '1755537335_landingpage.png', 'https://dapurr2landingpage.vercel.app/', 'html, css, js', '2025-08-18 17:15:35', '2025-08-18 17:15:35'),
(3, 'Nexcent Landing Page', 'web', 'Tugas 1 Landing Page', '1755602176_nexcent.png', 'https://portofolio-angkatan3-2025.vercel.app/', 'html, css, js', '2025-08-19 11:16:16', '2025-08-19 11:16:16'),
(4, 'BMI Calculator', 'app', 'The Body Mass Index (BMI) Calculator can be used to calculate BMI value and corresponding weight status while taking age into consideration. Use the \"Metric Units\" tab for the International System of Units or the \"Other Units\" tab to convert units into either US or metric units. Note that the calculator also computes the Ponderal Index in addition to BMI, both of which are discussed below in detail.', '1755602258_calculator.png', 'https://kalkulatorbmi.vercel.app/', 'html, css, js', '2025-08-19 11:17:38', '2025-08-19 11:17:38'),
(5, 'RE Shoot', 'web', 'Landing Page Photography', '1755961234_REShoot.png', 'https://reshootproject.vercel.app/', 'html, css, js', '2025-08-23 15:00:34', '2025-08-23 15:00:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
