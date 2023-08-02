-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: mysql
-- Thời gian đã tạo: Th8 02, 2023 lúc 03:39 PM
-- Phiên bản máy phục vụ: 8.0.34
-- Phiên bản PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `demo_php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Room A', '123123', 'huhuhuhu', '2023-07-31 11:24:40', '2023-07-31 11:24:40'),
(2, 'Room B', '12344444', 'hahahaha', '2023-07-31 11:27:27', '2023-07-31 11:27:27'),
(3, 'Room C', '1111222', 'adadadadada', '2023-08-01 02:04:05', '2023-08-01 02:05:11'),
(4, 'Room H', '1122331122', 'tran manh hung 18', '2023-08-02 03:34:59', '2023-08-02 03:34:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotel`
--

CREATE TABLE `hotel` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_max` float(100,2) NOT NULL,
  `price_min` float(100,2) NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `sale_day` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(2555) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `code`, `price_max`, `price_min`, `category_id`, `sale_day`, `created_at`, `updated_at`, `image`) VALUES
(2, 'Room B', '123123123', 24000.00, 23000.00, 2, '2023-08-12', '2023-08-01 04:12:19', '2023-08-02 15:18:48', '1690989528.png'),
(3, 'Hotel C', 'bq2022', 122222.00, 23000.00, 1, '2023-08-02', '2023-08-01 05:12:38', '2023-08-02 15:20:00', '1690989600.jpg'),
(4, 'Hotel A', '1231231', 123123.00, 22333.00, 2, '2023-08-10', NULL, '2023-08-02 15:23:50', '1690989830.png'),
(5, 'Hotel B', '123123', 123444.00, 22334.00, 2, '2023-08-03', NULL, '2023-08-02 15:25:20', '1690989920.jpg'),
(6, 'Hotel C', '12312312', 123333.00, 22222.00, 3, '2023-08-24', NULL, '2023-08-02 15:26:51', '1690990011.png'),
(7, 'Hotel A', '12345', 12222.00, 12000.00, 3, '2023-08-03', '2023-08-01 07:21:38', '2023-08-02 15:27:46', '1690990066.jpg'),
(8, 'Hotel C', '123123123', 3000000.00, 1500000.00, 1, '2023-08-03', NULL, '2023-08-02 15:29:00', '1690990140.png'),
(9, 'Hotel C', '1234123123sdfsdfsd', 300000000.00, 150000000.00, 3, '2023-08-03', NULL, '2023-08-02 15:29:58', '1690990198.jpg'),
(10, 'Hotel A', 'bq2022', 500000000.00, 250000000.00, 2, '2023-08-04', '2023-08-01 18:14:57', '2023-08-02 15:30:53', '1690990253.png'),
(11, 'Hotel H', '112233665522', 15222010880.00, 15000.00, 4, '2023-08-11', '2023-08-02 03:36:31', '2023-08-02 15:33:04', '1690990384.jpg'),
(12, 'Hotel A', '112233665522', 500000000.00, 12000.00, 4, '2023-08-10', '2023-08-02 07:33:40', '2023-08-02 15:35:16', '1690990516.png'),
(13, 'Hotel A', '12345', 22333.00, 12000.00, 4, '2023-08-18', '2023-08-02 08:27:31', '2023-08-02 15:36:52', '1690990612.png'),
(14, 'Hotel A', 'bq2022', 500000000.00, 12000.00, 4, '2023-09-01', '2023-08-02 09:30:23', '2023-08-02 15:31:52', '1690990312.jpg'),
(15, 'Hotel A', 'bq2022', 500000000.00, 1222222.00, 4, '2023-08-19', '2023-08-02 10:54:29', '2023-08-02 10:54:29', '1690974140.png'),
(16, 'Hotel B', 'bq2022', 22333.00, 12000.00, 4, '2023-09-10', '2023-08-02 11:24:12', '2023-08-02 11:24:12', '1690975450.jpg'),
(17, 'Hotel C', 'bq2022', 15222010880.00, 500000000.00, 4, '2023-08-20', '2023-08-02 11:29:23', '2023-08-02 11:29:23', '1690975762.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2023_07_21_093828_create_nhan_vien_table', 1),
(24, '2023_07_25_021925_create_posts_table', 2),
(25, '2023_07_26_161047_create_users_table', 2),
(26, '2023_07_27_020401_create_categories_table', 2),
(27, '2023_07_27_020651_vp_post', 2),
(28, '2023_07_27_021441_profiles', 2),
(34, '2023_07_28_090428_create_category_table', 3),
(38, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(39, '2023_07_27_033132_create_product_table', 4),
(40, '2023_07_27_033158_create_attr_table', 4),
(41, '2023_07_27_033229_create_attr_product_table', 4),
(42, '2023_07_28_092200_create_category_table', 4),
(43, '2023_07_28_092241_create_hotel_table', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
