-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2025 at 01:53 PM
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
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `degree` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `image`, `birthday`, `website`, `phone`, `city`, `age`, `degree`, `email`) VALUES
(1, 'Raihan Elsar Kusuma, S.T., M.Pd.', 'Raihan Elsar is a Bachelor of Computer Engineering graduate from Telkom University who is currently pursuing a Masters in Educational Technology at Muhammadiyah University Jakarta.', 'up_68a2d9652d059.png', '2000-01-25', 'raihanelsar.github.io', '+62 813 6338 2729', 'Jakarta', 25, 'Master', 'raihan.elsar25@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `map_embed` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `address`, `phone`, `email`, `map_embed`) VALUES
(1, 'Petamburan IV, Tanah Abang, Jakarta Pusat', '+62 813 6338 2729', 'raihan.elsar25@gmail.com', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.509602302258!2d106.80436427587564!3d-6.1962926607053666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f69817d77da5%3A0xb4768f48e870a64c!2sJl.%20Petamburan%20IV%2C%20Petamburan%2C%20Kecamatan%20Tanah%20Abang%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1755442950853!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `category` enum('app','card','web') DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `category`, `title`, `description`, `image`, `link`) VALUES
(1, 'app', 'BMI Calculator', 'A BMI (Body Mass Index) calculator is a tool used to calculate a person\'s body mass index. This calculation is based on weight and height to provide an estimate of body fat. The BMI calculation can help determine a person\'s weight category, such as underweight, ideal weight, overweight, or obese.', '1755306682_calculator.png', 'https://kalkulatorbmi.vercel.app/'),
(2, 'web', 'Dapoer R2', 'Landing Page Dapoer R2', '1755307553_landingpage.png', 'https://dapurr2landingpage.vercel.app/'),
(3, 'web', 'Re Shoot', 'Landing Page Photography', '1755308371_REShoot.png', 'https://reshootproject.vercel.app/'),
(5, 'card', 'Nexcent Landing Page', 'Nexcent Landing Page', '1755309212_image_2025-08-16_085330826.png', 'https://portofolio-angkatan3-2025.vercel.app/'),
(6, 'app', 'Music Player', 'Bye Bye Bye\r\nDeadpool & Wolverine', '1755309644_deadpool.jpg', 'https://musicplayerrek.vercel.app');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `id` int(11) NOT NULL,
  `section_type` enum('education','organization','experience','certification') DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `year_start` year(4) DEFAULT NULL,
  `year_end` year(4) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resume`
--

INSERT INTO `resume` (`id`, `section_type`, `title`, `subtitle`, `year_start`, `year_end`, `description`, `link`) VALUES
(1, 'education', 'Masters of Educational Technology', 'Muhammadiyah University Jakarta', '2025', '2026', 'Final Project:', ''),
(2, 'education', 'Bachelor of Computer Engineering', 'Telkom University, Bandung, Jawa Barat', '2017', '2024', 'Final Project: \r\nE-Voting Application Development', 'https://openlibrary.telkomuniversity.ac.id/home/catalog/id/215125/slug/pengembangan-aplikasi-e-voting-dalam-bentuk-buku-karya-ilmiah.html'),
(3, 'organization', 'KSR PMI Telkom University', 'Telkom University', '2017', '2024', 'Public Relation Department Staff - 2018\r\nDeputy Head of Public Relation Department - 2019', 'https://drive.google.com/file/d/1V611eKQsh0Poptos81JsGDdKSKrFmMiT/view?usp=drive_link'),
(4, 'organization', 'LDK Al-Fath Telkom University', 'Telkom University', '2020', '2021', 'Syiar Department Staff', ''),
(5, 'experience', 'Junior Software Engineer', 'Telkom Indonesia', '2022', '2022', 'Create a website-based network monitoring application using Laravel\r\nComNet | Network Monitoring Application', ''),
(9, 'certification', 'RevoU Software Engineering Fundamental Course', 'RevoU', '2024', '2024', 'Intro to Software Engineering', 'https://drive.google.com/file/d/1PRzS6TFKOHA4zhPbi_Awzfdteg7Hebt3/view?usp=drive_link'),
(10, 'certification', 'Coding Studio', 'Coding Studio', '2024', '2024', 'Front-End Web', 'https://drive.google.com/file/d/1n90BohD_Cktv4r_FtDO1yJTJkyiQ2i0x/view?usp=drive_link');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `icon`, `title`, `description`) VALUES
(1, 'bi bi-code-slash', 'Web Development', 'Web development services encompass a wide range of services related to the creation, maintenance, and enhancement of websites and web applications. These services can include website design, development, testing, and maintenance, as well as additional services such as cybersecurity, consulting, and custom CMS solutions.'),
(2, 'bi bi-camera', 'Photography', 'Photography services provide professional photography for various purposes, including personal events, business events, and other needs. These services include photographing, editing, and delivering the photos to clients.');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `ig` varchar(100) NOT NULL,
  `linkedin` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `phone`, `address`, `logo`, `twitter`, `fb`, `ig`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 'raihan.elsar25@gmail.com', '6281363382729', 'Jl. Petamburan IV No.17', '1755444278-RE-putih.png', 'https://x.com', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.linkedin.com/feed', '2025-08-17 15:19:36', '2025-08-17 15:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `percentage` int(11) DEFAULT NULL,
  `subcategory` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `category`, `percentage`, `subcategory`) VALUES
(11, 'HTML', 'Programming', 100, 'Front-End'),
(12, 'CSS', 'Programming', 90, 'Front-End'),
(13, 'Canva', 'Design', 85, NULL),
(14, 'Git', 'Tools', 70, NULL),
(15, 'Leadership', 'Soft Skills', 80, NULL),
(16, 'JavaScript', 'Programming', 90, 'Front-End'),
(17, 'PHP', 'Programming', 75, 'Back-End'),
(18, 'Python', 'Programming', 60, 'Back-End'),
(19, 'C', 'Programming', 65, ''),
(20, 'C++', 'Programming', 65, ''),
(21, 'Teamwork', 'Soft Skills', 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `icon`, `value`, `label`) VALUES
(1, 'bi bi-journal-code', 7, 'Projects'),
(3, 'bi bi-person-fill', 5, 'Hard Workers'),
(4, 'bi bi-emoji-smile', 5, 'Happy Clients'),
(6, 'bi bi-headset', 5, 'Hours of Support');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `update_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '2025-08-15 16:17:31', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resume`
--
ALTER TABLE `resume`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
