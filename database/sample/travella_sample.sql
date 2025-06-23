-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 12:15 PM
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
-- Database: `travella`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `created_at`, `updated_at`, `icon`) VALUES
(1, 'Swimming Pool', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-water'),
(2, 'Gym', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-dumbbell'),
(3, 'Parking', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-car'),
(4, 'Elevator Access', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-elevator'),
(5, 'Private Balcony', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-mountain-sun'),
(6, 'Washer & Dryer', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-soap'),
(7, 'Smart TV', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-tv'),
(8, 'Free Wi-Fi', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-wifi'),
(9, 'Air Conditioning', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-wind'),
(10, 'Fully Equipped Kitchen', '2025-05-28 07:46:03', '2025-05-28 07:46:03', 'fas fa-utensils');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` enum('booked','cancelled','completed') NOT NULL DEFAULT 'booked',
  `availability` enum('yes','no') NOT NULL DEFAULT 'no',
  `name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `days` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `startDate`, `endDate`, `status`, `availability`, `name`, `contact_no`, `email`, `total_price`, `days`, `user_id`, `listing_id`, `created_at`, `updated_at`) VALUES
(1, '2025-06-18', '2025-06-19', 'completed', 'no', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 250.00, 1, 2, 1, '2025-06-08 14:43:41', '2025-06-22 05:36:00'),
(2, '2025-06-10', '2025-06-11', 'cancelled', 'yes', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 200.00, 1, 2, 2, '2025-06-10 02:48:01', '2025-06-10 03:07:11'),
(3, '2025-06-11', '2025-06-12', 'completed', 'no', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 250.00, 1, 2, 1, '2025-06-11 13:52:16', '2025-06-13 01:00:30'),
(4, '2025-06-11', '2025-06-12', 'completed', 'no', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 190.00, 1, 2, 3, '2025-06-11 13:55:20', '2025-06-13 01:00:30'),
(5, '2025-06-27', '2025-06-28', 'cancelled', 'yes', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 200.00, 1, 2, 2, '2025-06-11 14:06:04', '2025-06-11 14:16:00'),
(6, '2025-06-22', '2025-06-23', 'cancelled', 'yes', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 200.00, 1, 2, 2, '2025-06-11 14:06:48', '2025-06-23 05:18:51'),
(7, '2025-06-18', '2025-06-19', 'completed', 'no', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 190.00, 1, 2, 3, '2025-06-11 14:09:14', '2025-06-22 05:36:00'),
(8, '2025-06-23', '2025-06-24', 'cancelled', 'no', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 250.00, 1, 2, 1, '2025-06-11 14:41:56', '2025-06-15 13:57:45'),
(9, '2025-06-25', '2025-06-26', 'cancelled', 'yes', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 200.00, 1, 2, 2, '2025-06-11 14:46:11', '2025-06-11 15:24:16'),
(10, '2025-06-23', '2025-06-24', 'cancelled', 'yes', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 190.00, 1, 2, 3, '2025-06-11 14:59:06', '2025-06-11 15:26:19'),
(11, '2025-06-23', '2025-06-24', 'cancelled', 'yes', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 190.00, 1, 2, 3, '2025-06-23 05:18:18', '2025-06-23 06:07:19'),
(12, '2025-06-26', '2025-06-27', 'booked', 'no', 'Muhammad Abu', '0123456789', 'abu@gmail.com', 190.00, 1, 2, 3, '2025-06-23 06:06:11', '2025-06-23 06:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `state` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `title`, `description`, `price`, `location`, `user_id`, `created_at`, `updated_at`, `bedrooms`, `bathrooms`, `state`) VALUES
(1, 'Cozy Studio in Kuala Lumpur', 'A stylish urban retreat steps from KLCC, this studio offers a peaceful space to unwind after exploring the bustling city. Enjoy modern comfort with city views and quick access to public transport and dining.', 250.00, 'Kuala Lumpur', 1, '2025-05-28 05:52:02', '2025-06-23 04:59:43', 1, 1, 'active'),
(2, 'Beachside Chalet in Langkawi', 'Tucked along a quiet beach, this traditional chalet promises peace and sea breezes. A private veranda offers a perfect place to enjoy morning coffee with ocean views.', 200.00, 'Kedah', 1, '2025-05-28 05:52:02', '2025-06-18 16:46:54', 3, 2, 'active'),
(3, 'Apartment with City View in JB', 'With panoramic views of Johor Bahru’s skyline, this modern apartment offers stylish comfort for both work and play. Located near shopping malls and the causeway to Singapore.', 190.00, 'Johor', 1, '2025-05-28 05:52:02', '2025-05-28 05:52:02', 2, 2, 'active'),
(7, 'Port Dickson Beach House', 'Lovely unit close to the beach, ideal for weekend trips.', 240.00, 'Port Dickson, Negeri Sembilan', 1, '2025-06-22 12:27:51', '2025-06-22 12:28:02', 2, 1, 'active'),
(8, 'Cool Retreat in Cameron Highlands', 'Wooden house with refreshing mountain air', 220.00, 'Cameron Highlands, Pahang', 11, '2025-06-22 12:35:25', '2025-06-22 12:35:25', 2, 1, 'active'),
(9, 'Lakefront House in Taiping', 'Beautiful view of Taiping Lake Gardens', 320.00, 'Taiping, Perak', 11, '2025-06-22 12:37:59', '2025-06-22 12:37:59', 2, 2, 'active'),
(11, 'Cozy House', 'New cozy house', 250.00, 'Selangor', 1, '2025-06-23 06:09:36', '2025-06-23 06:10:03', 2, 2, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `listing_amenity`
--

CREATE TABLE `listing_amenity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `amenity_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_amenity`
--

INSERT INTO `listing_amenity` (`id`, `listing_id`, `amenity_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 8, NULL, NULL),
(7, 2, 3, NULL, NULL),
(8, 2, 8, NULL, NULL),
(9, 2, 9, NULL, NULL),
(10, 2, 5, NULL, NULL),
(11, 3, 1, NULL, NULL),
(12, 3, 3, NULL, NULL),
(13, 3, 8, NULL, NULL),
(14, 3, 9, NULL, NULL),
(15, 3, 5, NULL, NULL),
(16, 3, 7, NULL, NULL),
(24, 7, 3, NULL, NULL),
(25, 7, 8, NULL, NULL),
(26, 7, 5, NULL, NULL),
(27, 7, 7, NULL, NULL),
(28, 8, 3, NULL, NULL),
(29, 8, 8, NULL, NULL),
(30, 8, 1, NULL, NULL),
(31, 8, 7, NULL, NULL),
(32, 9, 3, NULL, NULL),
(33, 9, 8, NULL, NULL),
(34, 9, 10, NULL, NULL),
(35, 9, 7, NULL, NULL),
(40, 11, 3, NULL, NULL),
(41, 11, 8, NULL, NULL),
(42, 11, 2, NULL, NULL),
(43, 11, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_28_131140_create_users_table', 2),
(5, '2025_05_28_132845_create_listings_table', 3),
(6, '2025_05_28_140615_create_amenities_table', 4),
(7, '2025_05_28_140640_create_listing_amenity_table', 4),
(8, '2025_05_28_152720_add_bedrooms_and_bathrooms_to_listings_table', 5),
(9, '2025_05_28_160929_create_bookings_table', 6),
(10, '2025_05_28_161602_create_photos_table', 7),
(11, '2025_06_04_204324_add_icon_to_amenities_table', 8),
(12, '2025_06_08_220251_create_bookings_table', 9),
(13, '2025_06_09_192831_add_contact_no_to_users_table', 10),
(14, '2025_06_18_204328_add_state_to_listings_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `path`, `listing_id`, `created_at`, `updated_at`) VALUES
(1, 'uploads/image1.jpg', 1, '2025-05-28 22:15:23', '2025-05-28 22:15:23'),
(2, 'uploads/image2.jpg', 1, '2025-05-28 22:15:24', '2025-05-28 22:15:24'),
(3, 'uploads/image3.jpg', 1, '2025-05-28 22:15:24', '2025-05-28 22:15:24'),
(5, 'uploads/image5.jpg', 2, '2025-05-28 22:20:40', '2025-05-28 22:20:40'),
(6, 'uploads/image6.jpg', 2, '2025-05-28 22:20:40', '2025-05-28 22:20:40'),
(7, 'uploads/image7.jpg', 2, '2025-05-28 22:20:40', '2025-05-28 22:20:40'),
(8, 'uploads/image8.jpg', 3, '2025-05-29 04:51:51', '2025-05-29 04:51:51'),
(9, 'uploads/image9.jpg', 3, '2025-05-29 04:51:51', '2025-05-29 04:51:51'),
(10, 'uploads/image10.jpg', 3, '2025-05-29 04:51:51', '2025-05-29 04:51:51'),
(11, 'uploads/image11.jpg', 3, '2025-05-29 04:51:51', '2025-05-29 04:51:51'),
(22, 'uploads/1750595271_6857f6c7842eb.jpg', 7, '2025-06-22 12:27:51', '2025-06-22 12:27:51'),
(23, 'uploads/1750595271_6857f6c785098.jpg', 7, '2025-06-22 12:27:51', '2025-06-22 12:27:51'),
(24, 'uploads/1750595271_6857f6c785711.jpg', 7, '2025-06-22 12:27:51', '2025-06-22 12:27:51'),
(25, 'uploads/1750595725_6857f88da67c6.jpg', 8, '2025-06-22 12:35:25', '2025-06-22 12:35:25'),
(26, 'uploads/1750595725_6857f88da7531.jpg', 8, '2025-06-22 12:35:25', '2025-06-22 12:35:25'),
(27, 'uploads/1750595725_6857f88da7cf5.jpg', 8, '2025-06-22 12:35:25', '2025-06-22 12:35:25'),
(28, 'uploads/1750595879_6857f927ceca1.jpg', 9, '2025-06-22 12:37:59', '2025-06-22 12:37:59'),
(29, 'uploads/1750595879_6857f927cfd6d.jpg', 9, '2025-06-22 12:37:59', '2025-06-22 12:37:59'),
(30, 'uploads/1750595879_6857f927d0508.jpg', 9, '2025-06-22 12:37:59', '2025-06-22 12:37:59'),
(32, 'uploads/1750658976_6858efa087721.jpg', 11, '2025-06-23 06:09:36', '2025-06-23 06:09:36'),
(33, 'uploads/1750658976_6858efa08a9e9.jpg', 11, '2025-06-23 06:09:36', '2025-06-23 06:09:36'),
(34, 'uploads/1750658976_6858efa08c2aa.jpg', 11, '2025-06-23 06:09:36', '2025-06-23 06:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('26DBvOBWUWDB7t9AvWVlm4DGXyzNx77Grg7KiWXo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ1RCRmVIMUd0a1NDb2JRTElWUVBha2JTaktUV1U0Y2d3bFhhVVBhTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Jvb2tpbmdzL2d1ZXN0Ijt9czoxMjoicmVkaXJlY3RfdXJsIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaG9tZSI7fQ==', 1750659356),
('FSY844WieCuraYUwRzQsJPYKmadnH51zEB3PaKUz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRHQyaW1DbHZTU253QWZUbXJEbFBFR1Ixc2ZiNUswYXZ6SlM3UndicSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ib29raW5ncy9ndWVzdCI7fXM6MTI6InJlZGlyZWN0X3VybCI7czoyMjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwLyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1750656542);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `contact_no`) VALUES
(1, 'Muhammad Ali', 'ali@gmail.com', '$2y$12$1hdHDshuxcImUjxgINHlXeyG3rPQVC2PBSGDaYz826gCczeCdNxma', 'host', '2025-05-28 05:21:26', '2025-05-28 05:21:26', '0123456789'),
(2, 'Muhammad Abu', 'abu@gmail.com', '$2y$12$1hdHDshuxcImUjxgINHlXeyG3rPQVC2PBSGDaYz826gCczeCdNxma', 'guest', '2025-05-28 05:21:26', '2025-05-28 05:21:26', '0123456789'),
(9, 'Faizal bin Hassan', 'faizal.hassan93@gmail.com', '$2y$12$SHmEwDkvRXqa./0mHFI5tejoF5jZoKY6OhDzVAY5sB0UBxsA999QK', 'guest', '2025-06-22 11:38:18', '2025-06-22 11:38:18', '0128765432'),
(10, 'Nur Aisyah', 'aisyah@example.com', '$2y$12$49eztz1MsbdFYEyh.v2TUuW7UG.p5cU0GZg7mVQXKOU4TBLPYOdam', 'guest', '2025-06-22 11:39:40', '2025-06-22 11:39:40', '0145678901'),
(11, 'Zulkifli Ismail', 'zulkifli.ismail78@gmail.com', '$2y$12$UjWafC6GaRlBfq1qQfPLsuYh1MQK4QDqz0VMrg597O0qTcg585wFu', 'host', '2025-06-22 11:40:40', '2025-06-22 11:40:40', '0181234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_listing_id_foreign` (`listing_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listings_user_id_foreign` (`user_id`);

--
-- Indexes for table `listing_amenity`
--
ALTER TABLE `listing_amenity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listing_amenity_listing_id_foreign` (`listing_id`),
  ADD KEY `listing_amenity_amenity_id_foreign` (`amenity_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_listing_id_foreign` (`listing_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `listing_amenity`
--
ALTER TABLE `listing_amenity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_amenity`
--
ALTER TABLE `listing_amenity`
  ADD CONSTRAINT `listing_amenity_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listing_amenity_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
