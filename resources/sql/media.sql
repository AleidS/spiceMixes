-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 05:49 PM
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
(1, 'App\\Models\\Mixes', 1, 'bc61e163-4f61-406a-8894-175302ca17af', 'avatars', 'Hugo', 'Hugo.png', 'image/png', 'public', 'public', 167842, '[]', '[]', '[]', '[]', 1, '2025-02-08 17:32:03', '2025-02-08 17:32:03'),
(2, 'App\\Models\\Mixes', 2, 'a3efedaf-4460-4356-b051-cf7646372bfd', 'avatars', 'pexels-shantanu-pal-938952-2679501', 'pexels-shantanu-pal-938952-2679501.jpg', 'image/jpeg', 'public', 'public', 942263, '[]', '[]', '[]', '[]', 1, '2025-02-08 19:55:31', '2025-02-08 19:55:31'),
(7, 'App\\Models\\Mixes', 4, '62e5095f-0616-4f35-a0fd-d01bb8d6676b', 'avatars', 'italy-spices-cook-italian-preview', 'italy-spices-cook-italian-preview.jpg', 'image/jpeg', 'public', 'public', 67536, '[]', '[]', '[]', '[]', 2, '2025-04-16 12:54:40', '2025-04-16 12:54:40'),
(8, 'App\\Models\\Mixes', 4, '04f8a79e-997c-4a45-941e-d260f558f2d6', 'avatars', 'italy-spices-cook-italian-preview', 'italy-spices-cook-italian-preview.jpg', 'image/jpeg', 'public', 'public', 67536, '[]', '[]', '[]', '[]', 3, '2025-04-16 12:54:56', '2025-04-16 12:54:56'),
(9, 'App\\Models\\Mixes', 5, 'ce7e9875-7ad4-45c0-b187-b43bdcb5752d', 'avatars', 'garam_masala', 'garam_masala.jpg', 'image/jpeg', 'public', 'public', 220133, '[]', '[]', '[]', '[]', 2, '2025-04-17 09:15:08', '2025-04-17 09:15:08'),
(10, 'App\\Models\\Mixes', 5, '1122adbb-6201-4cc3-bdc9-54177b3e6452', 'avatars', 'garam_masala', 'garam_masala.jpg', 'image/jpeg', 'public', 'public', 220133, '[]', '[]', '[]', '[]', 3, '2025-04-17 09:15:23', '2025-04-17 09:15:23'),
(11, 'App\\Models\\Mixes', 7, 'ce1f81ee-c7f9-479d-8069-d8c87b79de5f', 'avatars', 'mexican-2456038_1280', 'mexican-2456038_1280.jpg', 'image/jpeg', 'public', 'public', 159875, '[]', '[]', '[]', '[]', 1, '2025-04-17 09:35:33', '2025-04-17 09:35:33'),
(12, 'App\\Models\\Mixes', 8, '2674e11f-16f1-4934-a2c4-3573b43c8628', 'avatars', 'pexels-rdne-5737571', 'pexels-rdne-5737571.jpg', 'image/jpeg', 'public', 'public', 111736, '[]', '[]', '[]', '[]', 1, '2025-04-17 10:28:30', '2025-04-17 10:28:30'),
(13, 'App\\Models\\Mixes', 9, 'db17c8ae-c93d-41ad-9506-7936b4861663', 'avatars', 'ramen-7187810_1280', 'ramen-7187810_1280.jpg', 'image/jpeg', 'public', 'public', 388085, '[]', '[]', '[]', '[]', 1, '2025-04-17 10:52:43', '2025-04-17 10:52:43'),
(15, 'App\\Models\\Mixes', 11, '1ba7649b-f306-4cb2-8cfc-36f2ca65cf5b', 'avatars', 'Crudités_en_Provence', 'Crudités_en_Provence.jpg', 'image/jpeg', 'public', 'public', 216599, '[]', '[]', '[]', '[]', 1, '2025-04-17 12:21:46', '2025-04-17 12:21:46'),
(16, 'App\\Models\\Mixes', 13, 'ffeb17dc-af6b-44d7-a2d1-6bb1561e621a', 'avatars', 'pexels-enginakyurt-2673353', 'pexels-enginakyurt-2673353.jpg', 'image/jpeg', 'public', 'public', 1680779, '[]', '[]', '[]', '[]', 1, '2025-04-17 12:28:06', '2025-04-17 12:28:06'),
(17, 'App\\Models\\Mixes', 14, '0194a3b8-2a25-4acd-ae58-d8c961b7033e', 'avatars', 'pexels-vanmalidate-842142 (1)', 'pexels-vanmalidate-842142-(1).jpg', 'image/jpeg', 'public', 'public', 125269, '[]', '[]', '[]', '[]', 1, '2025-04-17 12:34:13', '2025-04-17 12:34:13'),
(18, 'App\\Models\\Mixes', 15, '933ab19d-8584-48ad-bb87-93839e851257', 'avatars', 'curry-7249247_1280', 'curry-7249247_1280.jpg', 'image/jpeg', 'public', 'public', 337286, '[]', '[]', '[]', '[]', 1, '2025-04-17 12:44:16', '2025-04-17 12:44:16'),
(19, 'App\\Models\\Mixes', 16, '29a2d71c-6936-4a94-aa9f-3d9b35425bab', 'avatars', 'spices-tell-stories-stockcake', 'spices-tell-stories-stockcake.jpg', 'image/jpeg', 'public', 'public', 71838, '[]', '[]', '[]', '[]', 1, '2025-04-17 12:52:26', '2025-04-17 12:52:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
-- --
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
--   MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
