-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20260426.ddf4e99390
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 20, 2026 at 02:57 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `asesis`
--

CREATE TABLE `asesis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `skema_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asesors`
--

CREATE TABLE `asesors` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kompetensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `aksi`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 3, 'Update Status Pendaftaran', 'Status diubah dari pending ke diterima (ID: 13)', '2026-04-29 06:15:08', '2026-04-29 06:15:08'),
(2, 3, 'Update Status Pendaftaran', 'Status diubah dari pending ke diterima (ID: 16)', '2026-05-18 04:51:01', '2026-05-18 04:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id` bigint UNSIGNED NOT NULL,
  `pendaftaran_id` bigint UNSIGNED NOT NULL,
  `nama_berkas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `skema_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_10_084420_create_asesis_table', 2),
(5, '2026_04_10_084613_create_asesors_table', 3),
(6, '2026_04_10_084741_create_skemas_table', 3),
(7, '2026_04_11_115841_add_skema_id_to_asesis', 3),
(8, '2026_04_18_122236_add_role_to_users_table', 4),
(9, '2026_04_18_141200_create_pendaftarans_table', 5),
(10, '2026_04_21_091311_add_validation_fields_to_pendaftarans', 6),
(11, '2026_04_21_182032_add_no_sertifikat_to_pendaftarans', 7),
(12, '2026_04_23_000001_add_google_id_to_users_table', 8),
(13, '2026_04_23_164409_create_berkas_table', 9),
(14, '2026_04_25_190240_add_notifikasi_to_pendaftarans_table', 10),
(15, '2026_04_25_195704_add_is_read_to_pendaftarans_table', 11),
(16, '2026_04_28_193141_create_audit_logs_table', 11),
(17, '2026_04_28_212130_add_nilai_to_pendaftarans_table', 12),
(18, '2026_04_28_215932_create_kriterias_table', 13),
(19, '2026_04_28_220014_create_nilai_kriterias_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriterias`
--

CREATE TABLE `nilai_kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `pendaftaran_id` bigint UNSIGNED NOT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `nilai` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftarans`
--

CREATE TABLE `pendaftarans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `skema_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validated_by` bigint UNSIGNED DEFAULT NULL,
  `validated_at` timestamp NULL DEFAULT NULL,
  `no_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notifikasi` text COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint(1) DEFAULT '0',
  `nilai` int DEFAULT NULL,
  `asesor_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendaftarans`
--

INSERT INTO `pendaftarans` (`id`, `user_id`, `skema_id`, `status`, `created_at`, `updated_at`, `validated_by`, `validated_at`, `no_sertifikat`, `notifikasi`, `is_read`, `nilai`, `asesor_id`) VALUES
(15, 4, 4, 'pending', '2026-05-16 12:38:23', '2026-05-16 12:38:23', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(16, 4, 5, 'diterima', '2026-05-18 04:49:56', '2026-05-18 04:51:01', 3, '2026-05-18 04:51:01', NULL, 'Pendaftaran Anda diterima', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2WUM8l333nOeag7UlAXZ8lME8rIhJh60ncL9okmz', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMEl3all1Y1d1UzRnOUF3ZHdza2E1NlhDVXJFSjMwWjN5WGFBSmJvWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1776925388),
('dH5ae68j5YqQ5rnWQjmiQ0UjoGY6hN7lGZKwb6EY', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTzdpdGlISjdIbndxd0dnZ3hjeGtRQzVEaHZ5MG9CVktBck9KQ0o0TyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1776925813),
('Jy4X9ZaLqmFvgCqfKA3ka2cpLN56PEVwONxgcTxA', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ3ptMnhhWjhWcTBiTjdkUHE5WG5yc2xIR3lUb25FZ295RFJDaU0zWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1776931136),
('xkbOTy2adbvpkOIhQImRzY9acZ1Va3A9UrRcoiAv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0FnUTZyMGdzRjBzMUcxOGY1cHJNNU9mTDQwSGJkazNPYzRQUXpXQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776925342);

-- --------------------------------------------------------

--
-- Table structure for table `skemas`
--

CREATE TABLE `skemas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_skema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skemas`
--

INSERT INTO `skemas` (`id`, `nama_skema`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 'Skema Sertifikasi Okupasi Pelaksana Inventarisasi Hutan/Pelaksana Inventarisasi Hutan Menyeluruh Berkala (IHMB)', '(Keputusan Menteri Tenaga Kerja dan Transmigrasi Republik Indonesia Nomor KEP.59 /MEN/III/2009 tentang Penetapan Standar Kompetensi Kerja Nasional Indonesia Sektor Sub Sektor Bidang Perencanaan, Pemanfaatan, serta Reboisasi dan Rehabilitasi Hutan Perencanaan Hutan.\r\nUNIT KOMPETENSI \r\n1. KHT.RC02.001.01 | Melaksanakan Inventarisasi Tegakan Hutan', '2026-05-16 12:25:58', '2026-05-16 12:25:58'),
(5, 'Skema Sertifikasi Okupasi Penyusun Rencana Inventarisasi Tegakan Hutan/Penyusun Rencana Inventarisasi Hutan Menyeluruh Berkala (IHMB)', '(Keputusan Menteri Tenaga Kerja dan Transmigrasi Republik Indonesia Nomor KEP.59/MEN/III/2009 tentang Penetapan Standar Kompetensi Kerja Nasional Indonesia Sektor Sub Sektor Bidang Perencanaan, Pemanfaatan, serta Reboisasi dan Rehabilitasi Hutan Perencanaan Hutan)\r\nUNIT KOMPETENSI \r\n1. KHT.RC02.001.01 : Melaksanakan Inventarisasi Tegakan Hutan\r\n2. KHT.RC02.002.01 : Menyusun Laporan Hasil Pelaksanaan Inventarisasi Tegakan Hutan \r\n3. KHT.RC02.003.01 : Menyusun Rencana Inventarisasi Tegakan Hutan', '2026-05-16 12:26:30', '2026-05-16 12:26:30'),
(6, 'Skema Sertifikasi Okupasi Pelaksana Evaluasi (Evaluator) Tegakan/ Inventarisasi Hutan Menyeluruh Berkala Inventarisasi (IHMB)', '(Keputusan Menteri Tenaga Kerja dan Transmigrasi Republik Indonesia Nomor KEP.59/MEN/III/2009 tentang Penetapan Standar Kompetensi Kerja Nasional Indonesia Sektor Sub Sektor Bidang Perencanaan, Pemanfaatan, serta Reboisasi dan Rehabilitasi Hutan Perencanaan Hutan)\r\nUNIT KOMPETENSI\r\n1. KHT.RC02.001.01 : Melaksanakan Inventarisasi Tegakan Hutan \r\n2. KHT.RC02.002.01 : Menyusun Laporan Hasil Pelaksanaan Inventarisasi Tegakan Hutan\r\n3. KHT.RC02.003.01 : Menyusun Rencana Inventarisasi Tegakan Hutan \r\n4. KHT.RC03.001.01 : Melaksanakan Evaluasi Hasil Inventarisasi Tegakan Hutan', '2026-05-16 12:27:03', '2026-05-16 12:27:03'),
(7, 'Skema Sertifikasi Okupasi Penguji Kayu Gergajian', '(Keputusan Menteri Tenaga Kerja dan Transmigrasi Republik Indonesia Nomor KEP.59/MEN/II1/2009 tentang Penetapan Standar Kompetensi Kerja Nasional Indonesia Sektor Sub Sektor Bidang Perencanaan, Pemanfaatan, serta Reboisasi dan Rehabilitasi Hutan Perencanaan Hutan.\r\nUNIT KOMPETENSI \r\n1. KHT.PH02.001.01 : Menetapkan Nama Jenis Kayu \r\n2. KHT.PH02.005.01 : Menetapkan Volume Kayu Gergajian \r\n3. KHT.PHO2.006.01 : Menetapkan Mutu Penampilan Kayu Gergajian', '2026-05-16 12:27:48', '2026-05-16 12:27:48'),
(8, 'Skema Sertifikasi Okupasi Penguji Kayu Bundar Tenaga Kerja dan Transmigrasi Republik', '(Keputusan Menteri Indonesia Nomor KEP.59/MEN/II/2009 tentang Penetapan Standar Kompetensi Kerja Nasional Indonesia Sektor Sub Sektor Bidang Perencanaan, Pemanfaatan, serta Reboisasi dan Rehabilitasi Hutan Perencanaan Hutan)\r\nUNIT KOMPETENSI\r\n1. KHT.PH02.001.01 : Menetapkan Nama Jenis Kayu \r\n2. KHT.PH02.002.01 : Menetapkan Volume Kayu Bundar \r\n3. KHT.PH02.003.01 : Menetapkan Volume Tumpukan Kayu Bundar Kecil \r\n4. KHT.PH02.004.01 : Menetapkan Mutu Penampilan Kayu Bundar', '2026-05-16 12:28:44', '2026-05-16 12:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(3, 'Admin', 'admin@gmail.com', NULL, NULL, '$2y$12$vdzLTc9Fch2/sbLmMI36U.QTGm3OPU2lLZ4RZ6mUT8Ey4VAsTIcXa', NULL, '2026-04-18 06:27:54', '2026-04-18 06:27:54', 'admin'),
(4, 'Asesi', 'asesi@gmail.com', NULL, NULL, '$2y$12$H26z9882zvCtnuGyWNvLVuE6V3CNC3DLGnOmSuguMnwq1Ziwcel4O', 'RvGsrDnGzR4KUTZPryUCCckEz53T9Df3NvYpJ0RUYMlwxyTZnFhS5S82pEkC', '2026-04-21 01:06:13', '2026-04-21 01:06:13', 'asesi'),
(6, 'Super Admin', 'superadmin@gmail.com', NULL, NULL, '$2y$12$DmiP5g5giERJzSaEov4R7.5QViVHsg4SMUNOgtBFnT7DzE/WIjRG6', NULL, '2026-04-28 13:37:09', '2026-04-28 13:37:09', 'superadmin'),
(7, 'Asesor 1', 'asesor@gmail.com', NULL, NULL, '$2y$12$8nVrtI5g10yWYj/XqgfFOetHEIbTcbZPApWw5oQiEVvcZ77ZXf/l6', NULL, '2026-04-28 13:37:22', '2026-04-28 13:37:22', 'asesor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asesis`
--
ALTER TABLE `asesis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asesis_skema_id_foreign` (`skema_id`);

--
-- Indexes for table `asesors`
--
ALTER TABLE `asesors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berkas_pendaftaran_id_foreign` (`pendaftaran_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriterias_skema_id_foreign` (`skema_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_kriterias`
--
ALTER TABLE `nilai_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_kriterias_pendaftaran_id_foreign` (`pendaftaran_id`),
  ADD KEY `nilai_kriterias_kriteria_id_foreign` (`kriteria_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pendaftarans`
--
ALTER TABLE `pendaftarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftarans_user_id_foreign` (`user_id`),
  ADD KEY `pendaftarans_skema_id_foreign` (`skema_id`),
  ADD KEY `pendaftarans_validated_by_foreign` (`validated_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skemas`
--
ALTER TABLE `skemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asesis`
--
ALTER TABLE `asesis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asesors`
--
ALTER TABLE `asesors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nilai_kriterias`
--
ALTER TABLE `nilai_kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftarans`
--
ALTER TABLE `pendaftarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `skemas`
--
ALTER TABLE `skemas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asesis`
--
ALTER TABLE `asesis`
  ADD CONSTRAINT `asesis_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `berkas`
--
ALTER TABLE `berkas`
  ADD CONSTRAINT `berkas_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftarans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD CONSTRAINT `kriterias_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_kriterias`
--
ALTER TABLE `nilai_kriterias`
  ADD CONSTRAINT `nilai_kriterias_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_kriterias_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftarans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftarans`
--
ALTER TABLE `pendaftarans`
  ADD CONSTRAINT `pendaftarans_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftarans_validated_by_foreign` FOREIGN KEY (`validated_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
