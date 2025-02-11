-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2025 at 03:10 PM
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
-- Table structure for table `media`
--

-- CREATE TABLE `media` (
--   `id` bigint(20) UNSIGNED NOT NULL,
--   `model_type` varchar(255) NOT NULL,
--   `model_id` bigint(20) UNSIGNED NOT NULL,
--   `uuid` char(36) DEFAULT NULL,
--   `collection_name` varchar(255) NOT NULL,
--   `name` varchar(255) NOT NULL,
--   `file_name` varchar(255) NOT NULL,
--   `mime_type` varchar(255) DEFAULT NULL,
--   `disk` varchar(255) NOT NULL,
--   `conversions_disk` varchar(255) DEFAULT NULL,
--   `size` bigint(20) UNSIGNED NOT NULL,
--   `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
--   `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
--   `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
--   `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
--   `order_column` int(10) UNSIGNED DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Mixes', 1, 'bc61e163-4f61-406a-8894-175302ca17af', 'avatars', 'Hugo', 'Hugo.png', 'image/png', 'public', 'public', 167842, '[]', '[]', '[]', '[]', 1, '2025-02-08 18:32:03', '2025-02-08 18:32:03'),
(2, 'App\\Models\\Mixes', 2, 'a3efedaf-4460-4356-b051-cf7646372bfd', 'avatars', 'pexels-shantanu-pal-938952-2679501', 'pexels-shantanu-pal-938952-2679501.jpg', 'image/jpeg', 'public', 'public', 942263, '[]', '[]', '[]', '[]', 1, '2025-02-08 20:55:31', '2025-02-08 20:55:31'),
(3, 'App\\Models\\Mixes', 3, 'cfd81282-63d2-4496-84b8-af39939c9306', 'avatars', 'pexels-caricatte-2336674', 'pexels-caricatte-2336674.jpg', 'image/jpeg', 'public', 'public', 1136408, '[]', '[]', '[]', '[]', 1, '2025-02-08 20:59:05', '2025-02-08 20:59:05'),
(4, 'App\\Models\\Mixes', 4, '71dd4afc-3591-4952-9fc2-87b351518f79', 'avatars', 'pexels-enginakyurt-2673353', 'pexels-enginakyurt-2673353.jpg', 'image/jpeg', 'public', 'public', 1680779, '[]', '[]', '[]', '[]', 1, '2025-02-08 21:38:11', '2025-02-08 21:38:11'),
(5, 'App\\Models\\Mixes', 5, 'f98006fe-d087-426a-8d45-b035083cb427', 'avatars', 'pexels-pixabay-533325', 'pexels-pixabay-533325.jpg', 'image/jpeg', 'public', 'public', 1216560, '[]', '[]', '[]', '[]', 1, '2025-02-09 12:11:01', '2025-02-09 12:11:01'),
(6, 'App\\Models\\Mixes', 6, '72ae26a7-8a4a-4752-a28a-56b6b28fc566', 'avatars', 'pexels-pixabay-533325', 'pexels-pixabay-533325.jpg', 'image/jpeg', 'public', 'public', 1216560, '[]', '[]', '[]', '[]', 1, '2025-02-09 17:50:39', '2025-02-09 17:50:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--
-- ALTER TABLE `media`
--   ADD PRIMARY KEY (`id`),
--   ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
--   ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
--   ADD KEY `media_order_column_index` (`order_column`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `media`
--
-- ALTER TABLE `media`
--   MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
