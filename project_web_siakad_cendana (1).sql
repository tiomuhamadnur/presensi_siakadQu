-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2022 at 10:28 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_web_siakad_cendana`
--

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
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2022_06_08_135159_create_users_table', 1),
(9, '2022_06_08_135733_create_tbl_classes_table', 1),
(10, '2022_06_08_140957_create_tbl_courses_table', 1),
(11, '2022_06_08_141227_create_trans_courses_table', 1),
(12, '2022_06_08_141228_create_trans_presents_table', 1);

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
-- Table structure for table `tbl_classes`
--

CREATE TABLE `tbl_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_guider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_classes`
--

INSERT INTO `tbl_classes` (`id`, `code`, `name`, `teacher_guider_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '001', 'IX', 1, '2020-08-25 08:13:29', '2020-06-04 08:18:22', NULL),
(2, '002', 'IX-B', 1, '2022-06-11 10:58:56', '2022-06-11 11:21:31', NULL),
(3, '003', 'IX-C', 4, '2022-06-11 11:03:18', '2022-06-11 11:03:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

CREATE TABLE `tbl_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`id`, `name`, `teacher_id`, `class_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fisika', 1, 1, '2022-06-12 11:14:28', '2022-06-12 11:14:28', NULL),
(2, 'Kimia', 4, 1, '2022-06-12 13:25:31', '2022-06-12 13:25:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trans_courses`
--

CREATE TABLE `trans_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `mid_score` double(8,2) NOT NULL DEFAULT 0.00,
  `quiz_score` double(8,2) NOT NULL DEFAULT 0.00,
  `assesment_score` double(8,2) NOT NULL DEFAULT 0.00,
  `final_score` double(8,2) NOT NULL DEFAULT 0.00,
  `total_score` float NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trans_courses`
--

INSERT INTO `trans_courses` (`id`, `class_id`, `course_id`, `student_id`, `mid_score`, `quiz_score`, `assesment_score`, `final_score`, `total_score`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 3, 92.00, 90.00, 80.00, 98.00, 94, '2020-06-18 06:03:33', '2022-06-12 13:24:40', NULL),
(2, 1, 1, 3, 0.00, 0.00, 0.00, 0.00, 0, '2022-06-12 12:59:59', '2022-06-12 13:21:57', '2022-06-12 13:21:57'),
(3, 1, 2, 3, 0.00, 0.00, 80.00, 0.00, 0, '2022-06-12 13:25:42', '2022-06-12 13:25:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trans_presents`
--

CREATE TABLE `trans_presents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `trans_course_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `on` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guru','siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_phone` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `class_id`, `name`, `email`, `password`, `nip`, `phone`, `gender`, `role`, `nisn`, `father_name`, `parent_phone`, `address`, `photo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Fiki Guru', 'fiki@gmail.com', '$2y$10$6P8QVV1GMDUHoZs8JVMU9.t7C35FlN7Ip4weitA.s1GYFTEggP3W6', NULL, '085846087071', 'Laki-laki', 'guru', NULL, NULL, NULL, 'Sukabumi', NULL, 1, '2022-06-08 14:32:10', '2022-06-10 23:32:48', NULL),
(2, NULL, 'Fiki Admin', 'fiki@admin.com', '$2y$10$6P8QVV1GMDUHoZs8JVMU9.t7C35FlN7Ip4weitA.s1GYFTEggP3W6', NULL, '085846087071', 'Laki-laki', 'admin', NULL, NULL, NULL, NULL, NULL, 1, '2022-06-08 07:45:35', '2022-06-08 07:45:35', NULL),
(3, 1, 'fikis siswa', 'fikiirmansyah@gmail.com', '$2y$10$4FRt4tAAmP/730yle39N9OoN/9wNIo2VXmsyTSBUvW8hisCyLDInW', NULL, '093840983', 'Laki-laki', 'siswa', '34242', 'ayahku', '093840938', 'ads', NULL, 1, '2022-06-10 19:44:30', '2022-06-10 20:35:23', NULL),
(4, NULL, 'Drs. Durjandai, M.Pd.', 'nurjandai', '$2y$10$3jKiS0IgdW6TXX8Do5U2NuHdL2NJZEdQEsgcZyO2oT42PpfEIe/qm', NULL, '038392894289', 'Perempuan', 'guru', NULL, NULL, NULL, 'Cijati', NULL, 1, '2022-06-10 23:40:58', '2022-06-10 23:40:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_classes`
--
ALTER TABLE `tbl_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_classes_teacher_guider_id_foreign` (`teacher_guider_id`);

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_courses_teacher_id_foreign` (`teacher_id`),
  ADD KEY `tbl_courses_class_id_foreign` (`class_id`);

--
-- Indexes for table `trans_courses`
--
ALTER TABLE `trans_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trans_courses_class_id_foreign` (`class_id`),
  ADD KEY `trans_courses_course_id_foreign` (`course_id`),
  ADD KEY `trans_courses_student_id_foreign` (`student_id`);

--
-- Indexes for table `trans_presents`
--
ALTER TABLE `trans_presents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trans_presents_student_id_foreign` (`student_id`),
  ADD KEY `trans_presents_trans_course_id_foreign` (`trans_course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_classes`
--
ALTER TABLE `tbl_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trans_courses`
--
ALTER TABLE `trans_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trans_presents`
--
ALTER TABLE `trans_presents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_classes`
--
ALTER TABLE `tbl_classes`
  ADD CONSTRAINT `tbl_classes_teacher_guider_id_foreign` FOREIGN KEY (`teacher_guider_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD CONSTRAINT `tbl_courses_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `tbl_classes` (`id`),
  ADD CONSTRAINT `tbl_courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trans_courses`
--
ALTER TABLE `trans_courses`
  ADD CONSTRAINT `trans_courses_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `tbl_classes` (`id`),
  ADD CONSTRAINT `trans_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `tbl_courses` (`id`),
  ADD CONSTRAINT `trans_courses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trans_presents`
--
ALTER TABLE `trans_presents`
  ADD CONSTRAINT `trans_presents_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `trans_presents_trans_course_id_foreign` FOREIGN KEY (`trans_course_id`) REFERENCES `trans_courses` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `tbl_classes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
