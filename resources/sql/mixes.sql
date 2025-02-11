-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2025 at 02:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelsvelteinertia`
--

-- --------------------------------------------------------

--
-- Table structure for table `mixes`
--

-- CREATE TABLE `mixes` (
--   `id` bigint(20) UNSIGNED NOT NULL,
--   `name` varchar(255) NOT NULL,
--   `ingredients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`ingredients`)),
--   `description` varchar(255) NOT NULL,
--   `user_id` int(11) DEFAULT NULL,
--   `cuisine` int(11) NOT NULL,
--   `photo_url` varchar(255) NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mixes`
--

INSERT INTO `mixes` (`id`, `name`, `ingredients`, `description`, `user_id`, `cuisine_id`, `photo_url`, `created_at`, `updated_at`) VALUES
(2, 'Curry', '{\"name\":\"John\", \"age\":30, \"car\":null}', '1', 1, 2, 'abc.com', '2025-02-08 20:55:31', '2025-02-08 20:55:31'),
(3, 'Taco Spices', '{\"name\":\"John\", \"age\":30, \"car\":null}', '123', 1, 2, 'abc.com', '2025-02-08 20:59:05', '2025-02-08 20:59:05'),
(4, 'Chicken', '{\"name\":\"John\", \"age\":30, \"car\":null}', '123', 1, 2, 'abc.com', '2025-02-08 21:38:11', '2025-02-08 21:38:11'),
(5, 'GrillKryder', '{\"name\":\"John\", \"age\":30, \"car\":null}', '123', 1, 2, 'abc.com', '2025-02-09 12:11:01', '2025-02-09 12:11:01'),
(6, 'List', '[{\"name\":\"John\", \"age\":30, \"car\":null}]', '123', 1, 2, 'abc.com', '2025-02-09 17:50:39', '2025-02-09 17:50:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mixes`
--
-- ALTER TABLE `mixes`
--   ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mixes`
--
-- ALTER TABLE `mixes`
--   MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
