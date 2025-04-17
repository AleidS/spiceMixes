-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 05:46 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelsvelteinertia`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

-- CREATE TABLE `ingredients` (
--   `id` bigint(20) UNSIGNED NOT NULL,
--   `name` varchar(255) NOT NULL,
--   `mixes_id` bigint(20) UNSIGNED NOT NULL,
--   `measure_id` bigint(20) UNSIGNED NOT NULL,
--   `optional` tinyint(1) NOT NULL DEFAULT 0,
--   `quantity` double NOT NULL,
--   `show_alternatives` tinyint(1) NOT NULL DEFAULT 1,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `mixes_id`, `measure_id`, `optional`, `quantity`, `show_alternatives`, `created_at`, `updated_at`) VALUES
(2, 'parsley', 4, 1, 1, 1, 1, '2025-04-16 12:54:40', '2025-04-16 12:54:40'),
(3, 'Basil', 4, 1, 0, 1, 1, '2025-04-16 12:54:40', '2025-04-16 12:54:40'),
(4, 'Thyme', 4, 1, 0, 1, 1, '2025-04-16 12:54:40', '2025-04-16 12:54:40'),
(5, 'Oregano', 4, 1, 0, 2, 1, '2025-04-16 12:54:40', '2025-04-16 12:54:40'),
(6, 'Red pepper flakes', 4, 1, 1, 1, 1, '2025-04-16 12:54:40', '2025-04-16 12:54:40'),
(7, 'Marjoram', 4, 1, 0, 1, 1, '2025-04-16 12:54:40', '2025-04-16 12:54:40'),
(8, 'Ground cumin', 5, 1, 0, 1, 1, '2025-04-17 09:15:08', '2025-04-17 09:15:08'),
(9, 'Ground coriander', 5, 2, 0, 2, 1, '2025-04-17 09:15:08', '2025-04-17 09:15:08'),
(10, 'Ground cardamom', 5, 2, 0, 1.5, 1, '2025-04-17 09:15:08', '2025-04-17 09:15:08'),
(11, 'Ground black pepper', 5, 2, 0, 1.5, 1, '2025-04-17 09:15:08', '2025-04-17 09:15:08'),
(12, 'Ground cinnamon', 5, 2, 0, 1, 1, '2025-04-17 09:15:08', '2025-04-17 09:15:08'),
(13, 'Mace powder', 5, 2, 1, 0.25, 1, '2025-04-17 09:15:08', '2025-04-17 09:15:08'),
(14, 'Ground nutmeg', 5, 2, 0, 0.5, 1, '2025-04-17 09:15:08', '2025-04-17 09:15:08'),
(15, 'ground cloves', 5, 2, 1, 0.5, 1, '2025-04-17 09:15:08', '2025-04-17 09:15:08'),
(16, 'Bay leaf', 5, 1, 1, 2, 1, '2025-04-17 09:15:08', '2025-04-17 09:16:12'),
(28, 'Smoked Paprika', 7, 2, 0, 1.5, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(29, 'Garlic powder', 7, 2, 0, 1, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(30, 'Onion powder', 7, 2, 0, 1, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(31, 'Chili powder', 7, 2, 0, 1, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(32, 'Ground cumin', 7, 2, 0, 1, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(33, 'Ground Oregano', 7, 2, 1, 1, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(34, 'Black pepper', 7, 2, 1, 0.5, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(35, 'Cinnamon', 7, 2, 1, 0.25, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(36, 'Ground cloves', 7, 3, 1, 1, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(37, 'Salt', 7, 2, 0, 0.5, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(38, 'Crushed red pepper flakes', 7, 2, 0, 0.5, 1, '2025-04-17 09:34:38', '2025-04-17 09:34:38'),
(39, 'Garlic powder', 8, 2, 0, 1, 1, '2025-04-17 10:28:19', '2025-04-17 10:28:19'),
(40, 'Paprika', 8, 2, 0, 1, 1, '2025-04-17 10:28:19', '2025-04-17 10:28:19'),
(41, 'Onion powder', 8, 2, 0, 1, 1, '2025-04-17 10:28:19', '2025-04-17 10:28:19'),
(42, 'Ground Cumin', 8, 2, 0, 1, 1, '2025-04-17 10:28:19', '2025-04-17 10:28:19'),
(43, 'Dried oregano', 8, 2, 0, 1, 1, '2025-04-17 10:28:19', '2025-04-17 10:28:19'),
(44, 'Ground black pepper', 8, 2, 0, 1, 1, '2025-04-17 10:28:19', '2025-04-17 10:28:19'),
(45, 'Ground ginger', 8, 2, 0, 1, 1, '2025-04-17 10:28:19', '2025-04-17 10:28:19'),
(46, 'Ground nutmeg', 8, 2, 1, 1, 1, '2025-04-17 10:28:19', '2025-04-17 10:28:19'),
(47, 'Bouillon cubes', 9, 10, 0, 2, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(48, 'Garlic powder', 9, 2, 0, 1, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(49, 'Onion Powder', 9, 2, 0, 1, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(50, 'Dried Parsley', 9, 2, 0, 1, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(51, 'Ground cumin', 9, 2, 0, 0.5, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(52, 'Ground ginger', 9, 2, 0, 0.5, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(53, 'Cayenne pepper', 9, 2, 0, 0.25, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(54, 'Salt', 9, 2, 0, 0.5, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(55, 'Dried green onions', 9, 1, 1, 1, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(56, 'Sugar', 9, 1, 1, 1, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(57, 'Paprika', 9, 2, 1, 1, 1, '2025-04-17 10:52:16', '2025-04-17 10:52:16'),
(69, 'Dried Rosemary', 11, 1, 0, 1, 1, '2025-04-17 12:19:07', '2025-04-17 12:19:07'),
(70, 'Dried Thyme', 11, 2, 0, 1, 1, '2025-04-17 12:19:07', '2025-04-17 12:19:07'),
(71, 'Dried Marjoram', 11, 2, 1, 2, 1, '2025-04-17 12:19:07', '2025-04-17 12:19:07'),
(72, 'dried parsley', 11, 2, 1, 2, 1, '2025-04-17 12:19:07', '2025-04-17 12:19:07'),
(73, 'dried oregano', 11, 1, 0, 1, 1, '2025-04-17 12:19:07', '2025-04-17 12:19:07'),
(74, 'Savory', 11, 1, 0, 1, 1, '2025-04-17 12:19:07', '2025-04-17 12:19:07'),
(75, 'basil', 11, 1, 1, 1, 1, '2025-04-17 12:19:07', '2025-04-17 12:19:07'),
(76, 'food-grade! dried lavender seeds', 11, 2, 1, 1, 1, '2025-04-17 12:19:07', '2025-04-17 12:19:07'),
(84, 'Paprika', 13, 1, 0, 1, 1, '2025-04-17 12:27:32', '2025-04-17 12:27:32'),
(85, 'dried oregano', 13, 1, 0, 1, 1, '2025-04-17 12:27:32', '2025-04-17 12:27:32'),
(86, 'garlic powder', 13, 2, 0, 1, 1, '2025-04-17 12:27:32', '2025-04-17 12:27:32'),
(87, 'onion powder', 13, 2, 0, 1, 1, '2025-04-17 12:27:32', '2025-04-17 12:27:32'),
(88, 'salt', 13, 2, 0, 1, 1, '2025-04-17 12:27:32', '2025-04-17 12:27:32'),
(89, 'cayenne pepper', 13, 2, 0, 0.5, 1, '2025-04-17 12:27:32', '2025-04-17 12:27:32'),
(90, 'black pepper', 13, 2, 0, 1, 1, '2025-04-17 12:27:32', '2025-04-17 12:27:32'),
(91, 'smoked paprika', 14, 2, 0, 2, 1, '2025-04-17 12:33:35', '2025-04-17 12:33:35'),
(92, 'mustard powder', 14, 2, 1, 1, 1, '2025-04-17 12:33:35', '2025-04-17 12:33:35'),
(93, 'ground clove', 14, 2, 0, 0.25, 1, '2025-04-17 12:33:35', '2025-04-17 12:33:35'),
(94, 'cayenne pepper', 14, 3, 1, 1, 1, '2025-04-17 12:33:35', '2025-04-17 12:33:35'),
(95, 'black pepper', 14, 2, 0, 0.5, 1, '2025-04-17 12:33:35', '2025-04-17 12:33:35'),
(96, 'garlic powder', 14, 2, 0, 1, 1, '2025-04-17 12:33:35', '2025-04-17 12:33:35'),
(97, 'dried parsley', 14, 1, 0, 1, 1, '2025-04-17 12:33:35', '2025-04-17 12:33:35'),
(98, 'tumeric', 15, 1, 0, 2, 1, '2025-04-17 12:43:49', '2025-04-17 12:43:49'),
(99, 'ground coriander', 15, 1, 0, 2, 1, '2025-04-17 12:43:49', '2025-04-17 12:43:49'),
(100, 'ground cumin', 15, 1, 0, 0.5, 1, '2025-04-17 12:43:49', '2025-04-17 12:43:49'),
(101, 'ground black pepper', 15, 2, 0, 1, 1, '2025-04-17 12:43:49', '2025-04-17 12:43:49'),
(102, 'garlic powder', 15, 2, 0, 1, 1, '2025-04-17 12:43:49', '2025-04-17 12:43:49'),
(103, 'cinnamon', 15, 2, 0, 0.5, 1, '2025-04-17 12:43:49', '2025-04-17 12:43:49'),
(104, 'ground ginger', 15, 2, 0, 1, 1, '2025-04-17 12:43:49', '2025-04-17 12:43:49'),
(105, 'Star anise', 16, 2, 0, 1.5, 1, '2025-04-17 12:51:37', '2025-04-17 12:51:37'),
(106, 'Fennel seeds', 16, 2, 0, 0.5, 1, '2025-04-17 12:51:37', '2025-04-17 12:51:37'),
(107, 'Cloves', 16, 2, 0, 0.5, 1, '2025-04-17 12:51:37', '2025-04-17 12:51:37'),
(108, '(chinese) Cinnamon', 16, 2, 0, 1, 1, '2025-04-17 12:51:37', '2025-04-17 12:51:37'),
(109, 'Sichuan or Bleck Pepper', 16, 2, 0, 0.5, 1, '2025-04-17 12:51:37', '2025-04-17 12:51:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredients`
--
-- ALTER TABLE `ingredients`
--   ADD PRIMARY KEY (`id`),
--   ADD KEY `ingredients_mixes_id_foreign` (`mixes_id`),
--   ADD KEY `ingredients_measure_id_foreign` (`measure_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredients`
--
-- ALTER TABLE `ingredients`
--   MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

-- --
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
-- ALTER TABLE `ingredients`
--   ADD CONSTRAINT `ingredients_measure_id_foreign` FOREIGN KEY (`measure_id`) REFERENCES `measures` (`id`),
--   ADD CONSTRAINT `ingredients_mixes_id_foreign` FOREIGN KEY (`mixes_id`) REFERENCES `mixes` (`id`) ON DELETE CASCADE;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
