-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Des 2024 pada 09.05
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metopark_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(3, 'administrator', 'Administrator'),
(4, 'user', 'User'),
(5, 'kemahasiswaan', 'Divisi Kemahasiswaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(3, 2),
(3, 7),
(3, 8),
(4, 3),
(4, 4),
(4, 9),
(5, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Agustiaja', 5, '2024-11-30 09:55:06', 0),
(2, '::1', 'Agustiaja', 5, '2024-11-30 09:55:12', 0),
(3, '::1', 'Agustiaja3', 7, '2024-11-30 09:55:29', 0),
(4, '::1', 'Agustiaja3', 7, '2024-11-30 09:58:39', 0),
(5, '::1', 'Agustiaja3', 7, '2024-11-30 09:58:48', 0),
(6, '::1', 'Agustiaja3', NULL, '2024-11-30 09:58:54', 0),
(7, '::1', 'gintama3@gmail.com', 7, '2024-11-30 10:01:37', 1),
(8, '::1', 'gintama3@gmail.com', 7, '2024-11-30 10:03:19', 1),
(9, '::1', 'agusti@gmail.com', 2, '2024-11-30 12:40:42', 1),
(10, '::1', 'gintama3@gmail.com', 7, '2024-11-30 12:41:55', 1),
(11, '::1', 'agusti@gmail.com', 2, '2024-11-30 12:43:28', 1),
(12, '::1', 'gintama3@gmail.com', 7, '2024-11-30 12:44:06', 1),
(13, '::1', 'gintama10@gmail.com', 9, '2024-11-30 12:49:32', 1),
(14, '::1', 'gintama3@gmail.com', 7, '2024-11-30 16:13:49', 1),
(15, '::1', 'gintama10@gmail.com', 9, '2024-11-30 17:39:41', 1),
(16, '::1', 'Agusti', NULL, '2024-11-30 17:40:53', 0),
(17, '::1', 'Agusti', NULL, '2024-11-30 17:41:01', 0),
(18, '::1', 'gintama3@gmail.com', 7, '2024-11-30 17:42:59', 1),
(19, '::1', 'gintama10@gmail.com', 9, '2024-11-30 18:17:59', 1),
(20, '::1', 'Agustiaja3', NULL, '2024-11-30 18:19:29', 0),
(21, '::1', 'gintama3@gmail.com', 7, '2024-11-30 18:19:34', 1),
(22, '::1', 'gintama3@gmail.com', 7, '2024-11-30 18:24:41', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashedValidator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'App\\Database\\Migrations\\CreateAuthTables', 'default', 'App', 1732896488, 1),
(2, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1732956593, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reports`
--

CREATE TABLE `reports` (
  `id` int NOT NULL,
  `image_id` varchar(255) NOT NULL,
  `violation_status` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','diterima','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `reports`
--

INSERT INTO `reports` (`id`, `image_id`, `violation_status`, `description`, `created_at`, `status`) VALUES
(10, '2024-11-26_09-43-45_esp32-cam.jpg', 'Peringatan nih! Ada aktivitas dalam kegiatan kuliah pagi di parkiran, jangan bilang itu kamu yang telat!', 'Esp32 cam', '2024-11-30 18:53:00', 'pending'),
(11, '2024-11-13_15-30-52_esp32-cam.jpg', 'Peringatan nih! Ada aktivitas dalam kegiatan kuliah siang di parkiran, buru-buru mau pulang?', 'Esp32 cam', '2024-11-30 18:53:40', 'diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `status_message` text,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa','kemahasiswaan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reset_at` timestamp NULL DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `active`, `status_message`, `password_hash`, `reset_hash`, `reset_expires`, `full_name`, `role`, `nim`, `department`, `status`, `created_at`, `updated_at`, `reset_at`, `activate_hash`, `deleted_at`) VALUES
(2, 'Agusti', 'agusti@gmail.com', 0, NULL, '$2y$10$ZDY5eXF0NYia0sULLLW94Oy5XHy9I.duK3Ga6kGOxSFtVHJKNA29u', NULL, NULL, '', 'admin', NULL, NULL, 'active', '2024-11-30 02:33:50', '2024-11-30 17:41:30', NULL, NULL, NULL),
(3, 'Rizky Agusti', 'rizkyagusti7@gmail.com', 1, NULL, '$2y$10$Gu59Kb/FIy6FD7d7a3j6BOy64sla/4qs9Mk.ARvRlFguMLNvdIIoa', NULL, NULL, '', 'admin', NULL, NULL, 'active', '2024-11-30 02:34:14', '2024-11-30 10:37:11', NULL, '9f988b487b24b752054f4aab729391da', NULL),
(4, 'Agusti Aja', 'backupnyagus@gmail.com', 1, NULL, '$2y$10$wP6TgqHKhM5.eFhEgOKqSef5j05OkO/Cv.NfNVwsdAqIDuSrNh7Dq', NULL, NULL, '', 'admin', NULL, NULL, 'active', '2024-11-30 02:45:52', '2024-11-30 02:45:52', NULL, '1b75ea73e739e4267b3236a7bccc0f4d', NULL),
(5, 'Agustiaja', 'gintama@gmail.com', 1, NULL, '$2y$10$3IPLbyEmoOfYZEJ69TX8OOu9m3mVq5PlwehmKWWxQYGyFgSa1bI66', NULL, NULL, '', 'admin', NULL, NULL, 'active', '2024-11-30 02:48:51', '2024-11-30 02:48:51', NULL, '1ab522cec4df30ce64dcc71b48e899f4', NULL),
(6, 'Agustiaja2', 'gintama2@gmail.com', 1, NULL, '$2y$10$1nHlCZ5c50xQ7FtOIyLa6.XBOj3kHR1H9qyOH3PTCjz8d3pnuBj7m', NULL, NULL, '', 'admin', NULL, NULL, 'active', '2024-11-30 02:50:39', '2024-11-30 02:50:39', NULL, '2bd1c660dd8e39cb7b1960fc094e4bc6', NULL),
(7, 'Agustiaja3', 'gintama3@gmail.com', 1, NULL, '$2y$10$F69QZ/Lw8jJ/9zecsqrkQes5Rl4fO2izs9GXvWogLkgtMVAdmYquS', NULL, NULL, '', 'admin', NULL, NULL, 'active', '2024-11-30 02:52:26', '2024-11-30 02:52:26', NULL, 'f7a1fe79cd663631452da126c118a870', NULL),
(8, 'iki', 'gintama5@gmail.com', 1, NULL, '$2y$10$uzBm4TXrfb/jIYZ8iY.oyum6wIfp5iry4f/Zs9l4odM7g4LFDG0eS', NULL, NULL, '', 'admin', NULL, NULL, 'active', '2024-11-30 05:45:54', '2024-11-30 05:45:54', NULL, 'ea77d67d02593988000a435159d83d57', NULL),
(9, 'ikiaja', 'gintama10@gmail.com', 1, NULL, '$2y$10$ZDY5eXF0NYia0sULLLW94Oy5XHy9I.duK3Ga6kGOxSFtVHJKNA29u', NULL, NULL, '', 'admin', NULL, NULL, 'active', '2024-11-30 05:48:42', '2024-11-30 05:48:42', NULL, '549e1f4653875bcd3aaee70193fa4ef1', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
