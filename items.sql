-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2022 at 05:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `photo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `photo`, `description`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Chocolat', 2500, 'chocolat_item_632f091032f97.jpg', NULL, 2, '2022-09-24 07:11:36', '2022-09-24 07:12:30'),
(2, 'America No', 5000, 'america no_item_632f092c7c675.jpg', NULL, 1, '2022-09-24 07:12:04', '2022-09-24 07:12:04'),
(3, 'Humbuger', 5000, 'humbuger_item_632f096e7d084.jpg', NULL, 5, '2022-09-24 07:13:10', '2022-09-24 07:13:10'),
(4, 'Lemon', 3000, 'lemon_item_632f098d04032.jpg', NULL, 3, '2022-09-24 07:13:41', '2022-09-24 07:13:41'),
(5, 'French Fires', 3500, 'french fires_item_632f09a186b79.jpg', NULL, 5, '2022-09-24 07:14:01', '2022-09-24 07:14:01'),
(6, 'Mountain', 5000, 'mountain_item_632f09becdd52.jpg', NULL, 4, '2022-09-24 07:14:30', '2022-09-24 07:14:30'),
(7, 'Orange', 3000, 'orange_item_632f09d49d1ee.jpg', NULL, 3, '2022-09-24 07:14:52', '2022-09-24 07:14:52'),
(8, 'Kitty', 10000, 'kitty_item_632f09eea5ceb.jpg', NULL, 2, '2022-09-24 07:15:18', '2022-09-24 07:15:18'),
(9, 'Co Co', 5000, 'co co_item_632f0a154fc67.jpg', NULL, 1, '2022-09-24 07:15:57', '2022-09-24 07:15:57'),
(10, 'Ice Mico', 4000, 'ice mico_item_632f0a373252f.jpg', NULL, 3, '2022-09-24 07:16:31', '2022-09-24 07:16:31'),
(11, 'Milk', 5000, 'milk_item_632f0a519b4fe.jpg', NULL, 2, '2022-09-24 07:16:57', '2022-09-24 07:16:57'),
(12, 'Yellow', 5000, 'yellow_item_632f0a91e59cf.jpg', NULL, 4, '2022-09-24 07:18:01', '2022-09-24 07:18:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
