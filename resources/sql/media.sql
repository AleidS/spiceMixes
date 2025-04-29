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

INSERT INTO `media` VALUES (1,'App\\Models\\Mixes',1,'bc61e163-4f61-406a-8894-175302ca17af','avatars','Hugo','Hugo.png','image/png','public','public',167842,'[]','[]','[]','[]',1,'2025-02-08 15:32:03','2025-02-08 15:32:03'),(7,'App\\Models\\Mixes',4,'62e5095f-0616-4f35-a0fd-d01bb8d6676b','avatars','italy-spices-cook-italian-preview','italy-spices-cook-italian-preview.jpg','image/jpeg','public','public',67536,'[]','[]','[]','[]',2,'2025-04-16 08:54:40','2025-04-16 08:54:40'),(8,'App\\Models\\Mixes',4,'04f8a79e-997c-4a45-941e-d260f558f2d6','avatars','italy-spices-cook-italian-preview','italy-spices-cook-italian-preview.jpg','image/jpeg','public','public',67536,'[]','[]','[]','[]',3,'2025-04-16 08:54:56','2025-04-16 08:54:56'),(9,'App\\Models\\Mixes',5,'ce7e9875-7ad4-45c0-b187-b43bdcb5752d','avatars','garam_masala','garam_masala.jpg','image/jpeg','public','public',220133,'[]','[]','[]','[]',2,'2025-04-17 05:15:08','2025-04-17 05:15:08'),(10,'App\\Models\\Mixes',5,'1122adbb-6201-4cc3-bdc9-54177b3e6452','avatars','garam_masala','garam_masala.jpg','image/jpeg','public','public',220133,'[]','[]','[]','[]',3,'2025-04-17 05:15:23','2025-04-17 05:15:23'),(11,'App\\Models\\Mixes',7,'ce1f81ee-c7f9-479d-8069-d8c87b79de5f','avatars','mexican-2456038_1280','mexican-2456038_1280.jpg','image/jpeg','public','public',159875,'[]','[]','[]','[]',1,'2025-04-17 05:35:33','2025-04-17 05:35:33'),(12,'App\\Models\\Mixes',8,'2674e11f-16f1-4934-a2c4-3573b43c8628','avatars','pexels-rdne-5737571','pexels-rdne-5737571.jpg','image/jpeg','public','public',111736,'[]','[]','[]','[]',1,'2025-04-17 06:28:30','2025-04-17 06:28:30'),(13,'App\\Models\\Mixes',9,'db17c8ae-c93d-41ad-9506-7936b4861663','avatars','ramen-7187810_1280','ramen-7187810_1280.jpg','image/jpeg','public','public',388085,'[]','[]','[]','[]',1,'2025-04-17 06:52:43','2025-04-17 06:52:43'),(15,'App\\Models\\Mixes',11,'1ba7649b-f306-4cb2-8cfc-36f2ca65cf5b','avatars','Crudites_en_Provence','Crudites_en_Provence.jpg','image/jpeg','public','public',216599,'[]','[]','[]','[]',1,'2025-04-17 08:21:46','2025-04-17 08:21:46'),(16,'App\\Models\\Mixes',13,'ffeb17dc-af6b-44d7-a2d1-6bb1561e621a','avatars','pexels-enginakyurt-2673353','pexels-enginakyurt-2673353.jpg','image/jpeg','public','public',1680779,'[]','[]','[]','[]',1,'2025-04-17 08:28:06','2025-04-17 08:28:06'),(17,'App\\Models\\Mixes',14,'0194a3b8-2a25-4acd-ae58-d8c961b7033e','avatars','pexels-vanmalidate-842142 (1)','pexels-vanmalidate-842142-(1).jpg','image/jpeg','public','public',125269,'[]','[]','[]','[]',1,'2025-04-17 08:34:13','2025-04-17 08:34:13'),(18,'App\\Models\\Mixes',15,'933ab19d-8584-48ad-bb87-93839e851257','avatars','curry-7249247_1280','curry-7249247_1280.jpg','image/jpeg','public','public',337286,'[]','[]','[]','[]',1,'2025-04-17 08:44:16','2025-04-17 08:44:16'),(19,'App\\Models\\Mixes',16,'29a2d71c-6936-4a94-aa9f-3d9b35425bab','avatars','spices-tell-stories-stockcake','spices-tell-stories-stockcake.jpg','image/jpeg','public','public',71838,'[]','[]','[]','[]',1,'2025-04-17 08:52:26','2025-04-17 08:52:26'),(21,'App\\Models\\Mixes',2,'7b8dd2b3-e057-40ff-9edf-9e54533b5ad2','avatars','download (1)','download-(1).png','image/png','public','public',539195,'[]','[]','[]','[]',1,'2025-04-26 17:55:47','2025-04-26 17:55:47'),(22,'App\\Models\\Mixes',21,'d92da2ba-8512-4de8-bda3-ada90766a5bb','avatars','pexels-pixabay-248469','pexels-pixabay-248469.jpg','image/jpeg','public','public',260931,'[]','[]','[]','[]',1,'2025-04-27 10:45:18','2025-04-27 10:45:18'),(23,'App\\Models\\Mixes',22,'601a8d78-b85d-4249-b144-cc05eecdf99f','avatars','pexels-rdne-8523126 (1)','pexels-rdne-8523126-(1).jpg','image/jpeg','public','public',174590,'[]','[]','[]','[]',1,'2025-04-27 10:51:20','2025-04-27 10:51:20'),(24,'App\\Models\\Mixes',23,'ec506787-9ea5-4098-8158-01caf1bb3099','avatars','pexels-markus-winkler-1430818-9862286','pexels-markus-winkler-1430818-9862286.jpg','image/jpeg','public','public',187311,'[]','[]','[]','[]',1,'2025-04-27 10:58:10','2025-04-27 10:58:10'),(27,'App\\Models\\Mixes',25,'e7446214-fe06-4b9c-9a76-b9efe44194b8','avatars','baguette-1378049_1920','baguette-1378049_1920.jpg','image/jpeg','public','public',561389,'[]','[]','[]','[]',1,'2025-04-27 12:38:42','2025-04-27 12:38:42'),(28,'App\\Models\\Mixes',26,'6a6694ab-4609-4e74-8920-03e942bcfc8d','avatars','salad-2756467_1920','salad-2756467_1920.jpg','image/jpeg','public','public',1234758,'[]','[]','[]','[]',1,'2025-04-27 13:12:49','2025-04-27 13:12:49'),(29,'App\\Models\\Mixes',27,'7b7767b7-372b-443e-8443-e582ad1cf3f9','avatars','fried-rice-7708486_1920','fried-rice-7708486_1920.jpg','image/jpeg','public','public',757172,'[]','[]','[]','[]',1,'2025-04-27 13:18:00','2025-04-27 13:18:00'),(30,'App\\Models\\Mixes',24,'e12d4c60-7367-4b3c-b67c-ee782e6584bb','avatars','harissa-4075853_1920','harissa-4075853_1920.jpg','image/jpeg','public','public',909514,'[]','[]','[]','[]',1,'2025-04-27 13:28:32','2025-04-27 13:28:32'),(31,'App\\Models\\Mixes',29,'67a4feb8-872b-4267-88f2-1e7ee7db6cdc','avatars','spiced-bisquit-952512_1920','spiced-bisquit-952512_1920.jpg','image/jpeg','public','public',688710,'[]','[]','[]','[]',1,'2025-04-29 14:57:46','2025-04-29 14:57:46');
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
