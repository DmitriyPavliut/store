-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 26 2021 г., 22:58
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

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullPrice` decimal(19,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `carts`:
--

--
-- Дамп данных таблицы `carts`
--

INSERT INTO `carts` (`id`, `name`, `secondName`, `street`, `home`, `flat`, `fullPrice`, `created_at`, `updated_at`) VALUES
(18, 'Тестовый', 'Тостер', 'тестовая улица', '33', '33', '1470.00', '2021-06-26 17:41:44', '2021-06-26 17:41:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, 'Платья', 'platya', '2021-06-23 10:23:15', '2021-06-25 08:43:30', 2),
(6, 'Летние', 'letnie', '2021-06-23 10:48:04', '2021-06-25 08:43:34', 4),
(7, 'Обувь', 'obuv', '2021-06-23 13:58:54', '2021-06-25 08:43:39', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, '2021_06_25_184434_create_carts_table', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_permissions`
--

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `model_has_permissions`:
--   `permission_id`
--       `permissions` -> `id`
--

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_roles`
--

CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `model_has_roles`:
--   `role_id`
--       `roles` -> `id`
--

--
-- Дамп данных таблицы `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_products_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `orders`:
--   `product_id`
--       `products` -> `id`
--

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `cart_id`, `product_id`, `count`, `created_at`, `updated_at`) VALUES
(12, 17, 5, 1, '2021-06-26 17:22:48', '2021-06-26 17:22:48'),
(13, 18, 9, 2, '2021-06-26 17:41:44', '2021-06-26 17:41:44'),
(14, 18, 5, 1, '2021-06-26 17:41:44', '2021-06-26 17:41:44');

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
-- Структура таблицы `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `permissions`:
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titleID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(19,2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `products`:
--   `category_id`
--       `categories` -> `id`
--

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `titleID`, `description`, `price`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(5, 'тестовый товар 1', 'testovyi-tovar-1', '<p>Приталенный силуэт и заостренные лацканы подчеркивают линию талии, визуально корректируя фигуру до желанной всем \"песочные часы\". Классика женского смокинга, которую одобрил бы сам Ив Сен Лоран. Состав: 98% шерсть, 2% эластан, отделка шелком</p>', '342.00', 1, 4, '2021-06-24 16:20:23', '2021-06-25 16:44:51'),
(6, 'тестовый товар 2', 'testovyi-tovar-2', '<p>Приталенный силуэт и заостренные лацканы подчеркивают линию талии, визуально корректируя фигуру до желанной всем \"песочные часы\".&nbsp;</p>', '11.00', 1, 7, '2021-06-24 16:54:14', '2021-06-26 07:38:05'),
(8, 'тестовый товар 4', 'testovyi-tovar-4', '<p>Классическтй комплект со смокингом и желетом</p>', '533.00', 1, 3, '2021-06-24 16:55:15', '2021-06-25 16:47:51'),
(9, 'тестовый товар 5', 'testovyi-tovar-5', '<p>Приталенный силуэт и заостренные лацканы подчеркивают линию талии, визуально корректируя фигуру до желанной всем \"песочные часы\". Классика женского смокинга, которую одобрил бы сам Ив Сен Лоран. Состав: 98% шерсть, 2% эластан, отделка шелком</p>', '564.00', 1, 6, '2021-06-24 16:55:46', '2021-06-25 17:15:04'),
(10, 'тестовый товар 6', 'testovyi-tovar-6', '<p>Классическтй комплект со смокингом и желетом</p>', '567.00', 1, 2, '2021-06-24 16:56:00', '2021-06-25 16:48:29'),
(12, 'тестовый товар 3', 'testovyi-tovar-3', '<p>Приталенный силуэт и заостренные лацканы подчеркивают линию талии, визуально корректируя фигуру до желанной всем \"песочные часы\".</p>', '5544.00', 1, 3, '2021-06-25 16:49:32', '2021-06-26 07:37:23'),
(13, 'тестовый товар 7', 'testovyi-tovar-7', '<p>Приталенный силуэт и заостренные лацканы подчеркивают линию талии, визуально корректируя фигуру до желанной всем \"песочные часы\". Классика женского смокинга, которую одобрил бы сам Ив Сен Лоран. Состав: 98% шерсть, 2% эластан, отделка шелком</p>', '664.00', 1, 6, '2021-06-25 16:50:25', '2021-06-26 04:19:59'),
(15, 'тестовый неактивный товар', 'testovyi-neaktivnyi-tovar', '<pre>тестовый неактивный товар</pre>', '33.44', NULL, 4, '2021-06-26 17:29:19', '2021-06-26 17:33:37');

-- --------------------------------------------------------

--
-- Структура таблицы `products_has_properties`
--

CREATE TABLE IF NOT EXISTS `products_has_properties` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `property_value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_has_properties_product_id_foreign` (`product_id`),
  KEY `products_has_properties_property_value_id_foreign` (`property_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `products_has_properties`:
--   `product_id`
--       `products` -> `id`
--   `property_value_id`
--       `properties_values` -> `id`
--

-- --------------------------------------------------------

--
-- Структура таблицы `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `product_images`:
--   `product_id`
--       `products` -> `id`
--

--
-- Дамп данных таблицы `product_images`
--

INSERT INTO `product_images` (`id`, `img`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 'files/elean474083.png', 5, '2021-06-24 16:20:23', '2021-06-25 16:44:51'),
(3, 'files/101.png', 6, '2021-06-24 16:54:14', '2021-06-26 07:38:05'),
(5, 'files/elean477961.png', 8, '2021-06-24 16:55:15', '2021-06-25 16:47:51'),
(6, 'files/loginImg.png', 9, '2021-06-24 16:55:46', '2021-06-25 17:15:04'),
(7, 'files/elean474083.png', 10, '2021-06-24 16:56:00', '2021-06-25 16:48:29'),
(9, 'files/image7.png', 12, '2021-06-25 16:49:32', '2021-06-26 07:37:23'),
(10, 'files/1651.png', 13, '2021-06-25 16:50:25', '2021-06-26 04:19:59'),
(11, 'files/controls.png', 15, '2021-06-26 17:29:19', '2021-06-26 17:33:37');

-- --------------------------------------------------------

--
-- Структура таблицы `product_properties`
--

CREATE TABLE IF NOT EXISTS `product_properties` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_properties_category_id_foreign` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `product_properties`:
--   `category_id`
--       `categories` -> `id`
--

-- --------------------------------------------------------

--
-- Структура таблицы `properties_values`
--

CREATE TABLE IF NOT EXISTS `properties_values` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `properties_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_values_properties_id_foreign` (`properties_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `properties_values`:
--   `properties_id`
--       `product_properties` -> `id`
--

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `roles`:
--

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user', 'web', '2021-06-21 08:03:20', '2021-06-21 08:03:20'),
(2, 'admin', 'web', '2021-06-21 08:03:25', '2021-06-21 08:03:25');

-- --------------------------------------------------------

--
-- Структура таблицы `role_has_permissions`
--

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `role_has_permissions`:
--   `permission_id`
--       `permissions` -> `id`
--   `role_id`
--       `roles` -> `id`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `users`:
--

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `accepted`) VALUES
(1, 'admin', 'admin@admin.ru', NULL, '$2y$10$C7wPsjOefvo/j3Xo.blujuL3/MMN4rNVB2jrt4mW72HzSWBeJJJ4O', NULL, NULL, NULL, '2021-06-21 08:07:06', '2021-06-21 08:07:06', 0),
(8, 'afasdf', 'asdsa@asd.ru', NULL, '$2y$10$nCFWZdWDh4E0nGCqPrQ4mesxMSeZRnbiw84cDD8jQrWd42JO9uDCW', NULL, NULL, NULL, '2021-06-23 11:22:42', '2021-06-23 11:22:42', 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_products_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `products_has_properties`
--
ALTER TABLE `products_has_properties`
  ADD CONSTRAINT `products_has_properties_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_has_properties_property_value_id_foreign` FOREIGN KEY (`property_value_id`) REFERENCES `properties_values` (`id`);

--
-- Ограничения внешнего ключа таблицы `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_properties`
--
ALTER TABLE `product_properties`
  ADD CONSTRAINT `product_properties_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `properties_values`
--
ALTER TABLE `properties_values`
  ADD CONSTRAINT `properties_values_properties_id_foreign` FOREIGN KEY (`properties_id`) REFERENCES `product_properties` (`id`);

--
-- Ограничения внешнего ключа таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
