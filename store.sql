-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 03 2021 г., 23:00
-- Версия сервера: 10.4.19-MariaDB
-- Версия PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `store`
--
CREATE DATABASE IF NOT EXISTS `store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `store`;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titleID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `categories`:
--   `parent_id`
--       `categories` -> `id`
--

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `titleID`, `created_at`, `updated_at`, `parent_id`) VALUES
(1, 'Мужское', 'muzskoe', '2021-06-23 09:49:37', '2021-06-25 08:43:13', NULL),
(2, 'Женское', 'zenskoe', '2021-06-23 09:51:04', '2021-06-25 08:43:16', NULL),
(3, 'Куртки', 'kurtki', '2021-06-23 10:22:57', '2021-06-25 08:43:26', 1),
(7, 'Обувь', 'obuv', '2021-06-23 13:58:54', '2021-06-25 08:43:39', 1),
(11, 'Майки', 'maiki', '2021-07-02 15:33:21', '2021-07-02 15:33:21', 1),
(12, 'Брюки', 'bryuki', '2021-07-02 15:37:34', '2021-07-02 15:37:34', 2),
(13, 'Верхняя одежда', 'verxnyaya-odezda', '2021-07-02 15:43:23', '2021-07-02 15:43:23', 2),
(14, 'Пальто', 'palto', '2021-07-02 15:43:30', '2021-07-02 15:43:30', 13),
(15, 'Плащи', 'plashhi', '2021-07-02 15:46:03', '2021-07-02 15:46:03', 13),
(16, 'Свитшоты', 'svitsoty', '2021-07-02 15:50:52', '2021-07-02 15:50:52', 2),
(17, 'Мантии', 'mantii', '2021-07-02 15:57:13', '2021-07-02 15:57:13', 2),
(18, 'Костюмы', 'kostyumy', '2021-07-02 16:06:48', '2021-07-02 16:06:48', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `failed_jobs`:
--

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `migrations`:
--

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_06_21_110016_create_permission_tables', 2),
(6, '2021_06_22_115131_create_categories_table', 3),
(7, '2021_06_23_114900_create_products_table', 4),
(8, '2021_06_23_120551_create_product_images_table', 5),
(9, '2021_06_24_162138_create_product_properties_table', 6),
(10, '2021_06_24_163809_create_properties_values_table', 7),
(11, '2021_06_24_164232_create_products_has_properties_table', 8),
(12, '2021_06_24_133443_create_orders_table', 9),
(13, '2021_06_25_184434_create_carts_table', 10),
(14, '2021_06_30_085827_create_category_has_property_table', 11),
(15, '2018_08_08_100000_create_telescope_entries_table', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `password_resets`:
--

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admin.ru', '$2y$10$MBSb2yTn8BcbPPL/eUrtOO7Kt5u6RNRVZWEg92NdbWwTV5kTksVSG', '2021-06-22 13:10:54');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `users`:
--

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `accepted`) VALUES
(1, 'admin', 'admin@admin.ru', NULL, '$2y$10$C7wPsjOefvo/j3Xo.blujuL3/MMN4rNVB2jrt4mW72HzSWBeJJJ4O', NULL, NULL, NULL, '2021-06-21 08:07:06', '2021-06-21 08:07:06', 0),
(8, 'afasdf', 'asdsa@asd.ru', NULL, '$2y$10$nCFWZdWDh4E0nGCqPrQ4mesxMSeZRnbiw84cDD8jQrWd42JO9uDCW', NULL, NULL, NULL, '2021-06-23 11:22:42', '2021-06-23 11:22:42', 1),
(9, 'qwerty', 'qwertg@mail.ru', NULL, '$2y$10$ks32z2nuQWkurzUD1t/seOvhlHpttmVvtaiVW0eGoEkBlsQyBJ5ZW', NULL, NULL, NULL, '2021-06-29 03:28:28', '2021-06-29 03:28:28', 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
