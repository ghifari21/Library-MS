-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 06:34 AM
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
-- Database: `db_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `author_code`, `name`, `email`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'A1', 'Alief', 'alief@gmail.com', NULL, '2022-05-03 19:16:48', '2022-05-23 19:17:08'),
(4, 'A2', 'Hilman Fauzi', 'hilmanfauzi@gmail.com', NULL, '2022-06-10 07:55:24', '2022-06-10 07:55:24'),
(5, 'A5', 'Johnny Depp', 'rashmase2125@gmail.com', NULL, '2022-06-10 07:55:32', '2022-06-10 07:55:32'),
(6, 'A6', 'Alex', 'alex@gmail.com', NULL, '2022-06-10 07:55:41', '2022-06-10 07:55:41'),
(7, 'A7', 'Dicky', 'dicky@gmail.com', NULL, '2022-06-10 07:56:50', '2022-06-10 07:56:50'),
(8, 'A8', 'Farhan', 'farhan@gmail.com', NULL, '2022-06-10 07:57:22', '2022-06-10 07:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `bibliographies`
--

CREATE TABLE `bibliographies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `publisher_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_year` year(4) NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bibliographies`
--

INSERT INTO `bibliographies` (`id`, `book_code`, `author_id`, `publisher_id`, `category_id`, `isbn`, `title`, `published_year`, `language`, `stock`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'B1', 1, 1, 1, '42647164124', 'Programming is EZ', 2022, 'English', 1, NULL, '2022-06-01 13:10:50', '2022-06-12 08:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'C1', 'Programming', '2022-05-30 05:38:12', '2022-05-30 05:38:12'),
(2, 'C2', 'Fiction', '2022-05-30 05:38:12', '2022-05-30 05:38:12'),
(3, 'C3', 'Science', '2022-05-30 05:38:15', '2022-05-30 05:38:12'),
(7, 'C4', 'Romance', '2022-06-10 07:40:04', '2022-06-10 07:40:04'),
(8, 'C8', 'Horror', '2022-06-10 07:40:18', '2022-06-10 07:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `circulations`
--

CREATE TABLE `circulations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `borrowed_date` date NOT NULL,
  `returned_date` date DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `return_deadline` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Borrowed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `circulations`
--

INSERT INTO `circulations` (`id`, `transaction_code`, `member_id`, `collection_id`, `borrowed_date`, `returned_date`, `duration`, `return_deadline`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TR-001-001', 1, 1, '2022-05-04', NULL, 3, '2022-05-31', 'Borrowed', NULL, NULL),
(2, 'TC-10062022-2', 2, 2, '2022-06-11', '2022-06-10', 14, '2022-06-25', 'Returned', '2022-06-10 01:45:50', '2022-06-10 02:06:07'),
(5, 'TC-10062022-3', 2, 2, '2022-06-11', '2022-06-10', 3, '2022-06-14', 'Returned', '2022-06-10 05:36:17', '2022-06-10 05:38:49'),
(6, 'TC-10062022-6', 2, 2, '2022-06-10', '2022-06-10', 7, '2022-06-17', 'Returned', '2022-06-10 08:52:19', '2022-06-10 08:52:35'),
(7, 'TC-11062022-7', 1, 2, '2022-06-12', '2022-06-11', 7, '2022-06-19', 'Returned', '2022-06-10 22:23:00', '2022-06-10 22:25:02'),
(8, 'TC-11062022-8', 1, 2, '2022-06-11', '2022-06-11', 14, '2022-06-25', 'Returned', '2022-06-11 08:20:33', '2022-06-11 08:21:39'),
(9, 'TC-12062022-9', 1, 2, '2022-06-12', '2022-06-12', 3, '2022-06-15', 'Returned', '2022-06-12 08:41:37', '2022-06-12 08:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registry_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bibliography_id` bigint(20) UNSIGNED NOT NULL,
  `stored_shelf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `collection_code`, `registry_number`, `bibliography_id`, `stored_shelf`, `condition`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 'CC1', 'R1', 1, 'RK1', 'Good', 0, NULL, NULL),
(2, 'CC2', 'R-09062022-2', 1, 'RK1', 'Fine', 1, '2022-06-09 07:59:49', '2022-06-12 08:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_code`, `user_id`, `nik`, `phone`, `address`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'M1', 2, '3204252510010006', '08126432471', 'Jl. Eka Rasmi No. 9\r\nMedan Johor', 'members/uuTdHXudDnWLb8tbh5oilbxGu6T30uWm3mG2ctet.png', '2022-05-30 05:40:05', '2022-06-12 08:42:46'),
(2, 'M2', 3, '3204252510010004', '081264324955', 'Jl. Eka Rasmi No. 9\r\nMedan Johor', NULL, '2022-05-30 05:40:48', '2022-05-30 05:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_28_063531_create_members_table', 1),
(6, '2022_05_30_035343_create_authors_table', 1),
(7, '2022_05_30_035527_create_publishers_table', 1),
(8, '2022_05_30_040431_create_categories_table', 1),
(9, '2022_05_30_044029_create_bibliographies_table', 1),
(10, '2022_05_30_055456_create_collections_table', 1),
(11, '2022_05_30_063250_create_circulations_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publisher_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `publisher_code`, `name`, `email`, `phone`, `address`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'P1', 'PT. Elex Media', 'elex@gmail.com', '021-4275421', 'jakarta', NULL, '2022-05-03 14:00:57', '2022-05-19 14:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `account_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ghifari Octaverin', 'ghifariocta@upi.edu', 'ghifari21', '$2y$10$U6RC.GeOPB0qIfYzLIg91O9NIA3SVpzajMrHBF3gPsHFy2cLfmXi.', 'admin', NULL, '2022-05-30 05:38:12', '2022-05-30 05:38:12'),
(2, 'Giga Chad', 'rashmase2125@gmail.com', 'gigachad', '$2y$10$Zk6oADvOp34NkL.a1QGUC.CLOaHygcEHFFzueGTJUeFnupr3NBgk6', 'member', NULL, '2022-05-30 05:40:05', '2022-06-12 08:42:46'),
(3, 'Jojo', 'loathing2125@gmail.com', 'jotaro', '$2y$10$f0dynDAEVOVSoPgAROXNROMem71wLugkpPbKial1N6.Eqf35dZKnG', 'member', NULL, '2022-05-30 05:40:48', '2022-05-30 05:40:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `authors_author_code_unique` (`author_code`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bibliographies`
--
ALTER TABLE `bibliographies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bibliographies_book_code_unique` (`book_code`),
  ADD UNIQUE KEY `bibliographies_isbn_unique` (`isbn`),
  ADD KEY `bibliographies_author_id_foreign` (`author_id`),
  ADD KEY `bibliographies_publisher_id_foreign` (`publisher_id`),
  ADD KEY `bibliographies_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_code_unique` (`category_code`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `circulations`
--
ALTER TABLE `circulations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `circulations_transaction_code_unique` (`transaction_code`),
  ADD KEY `circulations_member_id_foreign` (`member_id`),
  ADD KEY `circulations_collection_id_foreign` (`collection_id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `collections_collection_code_unique` (`collection_code`),
  ADD UNIQUE KEY `collections_registry_number_unique` (`registry_number`),
  ADD KEY `collections_bibliography_id_foreign` (`bibliography_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_member_code_unique` (`member_code`),
  ADD UNIQUE KEY `members_nik_unique` (`nik`),
  ADD UNIQUE KEY `members_phone_unique` (`phone`),
  ADD KEY `members_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publishers_publisher_code_unique` (`publisher_code`),
  ADD UNIQUE KEY `publishers_name_unique` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bibliographies`
--
ALTER TABLE `bibliographies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `circulations`
--
ALTER TABLE `circulations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bibliographies`
--
ALTER TABLE `bibliographies`
  ADD CONSTRAINT `bibliographies_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bibliographies_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bibliographies_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `circulations`
--
ALTER TABLE `circulations`
  ADD CONSTRAINT `circulations_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `circulations_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_bibliography_id_foreign` FOREIGN KEY (`bibliography_id`) REFERENCES `bibliographies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
