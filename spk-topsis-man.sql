-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2021 at 02:25 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-topsis-man`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon_penerimas`
--

CREATE TABLE `calon_penerimas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kepala_keluarga` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan_kepala_keluarga` int(11) NOT NULL,
  `jumlah_tanggungan` tinyint(4) NOT NULL,
  `pekerjaan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`berkas`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calon_penerimas`
--

INSERT INTO `calon_penerimas` (`id`, `nik`, `no_ktp`, `nama_kepala_keluarga`, `no_hp`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `pendapatan_kepala_keluarga`, `jumlah_tanggungan`, `pekerjaan`, `alamat`, `berkas`) VALUES
(7, '6402061008970007', '3174096112900001', 'Rusandi', '081247356555', '1980-07-31', 'Islam', '1', 1200000, 3, 'Petani', 'Jl. Birang', '{\"ktp\":\"calon_penerima\\/foto_ktp\\/FotGb2GRa4OOBLtJKasblbN3J3do7sGiVyZBIU00.png\",\"kk\":\"calon_penerima\\/foto_kk\\/w8Poe0m3EhXgwLjnc2levRPNFdQSamMT9Zlo8QQp.jpg\"}'),
(8, '6408013048414008', '3174096112900002', 'Irawan', '081247356523', '1979-08-22', 'Islam', '1', 2300000, 6, 'Karyawan', 'Jl. Birang', '{\"ktp\":\"calon_penerima\\/foto_ktp\\/wJA06ot5Y6q03hzcNzxW8xNr5WYwoaP6ttn6xPMJ.jpg\",\"kk\":\"calon_penerima\\/foto_kk\\/hWNS7S2tdfv2nl8XW7U3OC6N68wAqZJCgv0xIHO7.jpg\"}'),
(9, '6718131208474012', '3174096112900003', 'Tahir', '081247352345', '1969-06-18', 'Islam', '1', 550000, 4, 'Karyawan', 'Jl.Birang', '{\"ktp\":\"calon_penerima\\/foto_ktp\\/V4z3RvyvM47pwncufT94dZ5HFCruuRPHraY4jqpj.jpg\",\"kk\":\"calon_penerima\\/foto_kk\\/5EKU7XpBoDFH8IDcP4OCCU6rNUQrecB7J1aYxLeA.jpg\"}'),
(10, '6718131208474012', '3174096112900005', 'Hasan Ashuri', '081247355467', '1977-05-18', 'Islam', '1', 200000, 6, 'Pedagang', 'Jl.Birang', '{\"ktp\":\"calon_penerima\\/foto_ktp\\/BqVOkrebMlV8d9ZawjtyczbYI0wuN7pO5gUCL0BN.jpg\",\"kk\":\"calon_penerima\\/foto_kk\\/lzdZ2cjvg7F9BWIgGchc2hj6fq3Dd6z2L6chRkOJ.jpg\"}');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` enum('benefit','cost') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` double(2,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriterias`
--

INSERT INTO `kriterias` (`id`, `kode`, `nama`, `tipe`, `bobot`) VALUES
(1, 'C1', 'Pendapatan Kepala Keluarga Per Bulan', 'cost', 0.30),
(2, 'C2', 'Jumlah Tanggungan', 'benefit', 0.25),
(3, 'C3', 'Pekerjaan', 'benefit', 0.25),
(4, 'C4', 'Umur', 'cost', 0.20);

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
(4, '2021_07_17_020855_create_kriterias_table', 1),
(5, '2021_07_17_020908_create_subkriterias_table', 1),
(6, '2021_07_17_021210_create_calon_penerimas_table', 1),
(7, '2021_07_17_021217_create_nilai_calons_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_calons`
--

CREATE TABLE `nilai_calons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_calon_penerima` bigint(20) UNSIGNED NOT NULL,
  `C1` bigint(20) UNSIGNED DEFAULT NULL,
  `C2` bigint(20) UNSIGNED DEFAULT NULL,
  `C3` bigint(20) UNSIGNED DEFAULT NULL,
  `C4` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_calons`
--

INSERT INTO `nilai_calons` (`id`, `id_calon_penerima`, `C1`, `C2`, `C3`, `C4`) VALUES
(3, 7, 4, 7, 9, 15),
(4, 8, 4, 6, 12, 15),
(5, 9, 2, 7, 12, 14),
(6, 10, 1, 6, 11, 15);

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
-- Table structure for table `subkriterias`
--

CREATE TABLE `subkriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kriteria` bigint(20) UNSIGNED NOT NULL,
  `kondisi` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subkriterias`
--

INSERT INTO `subkriterias` (`id`, `kode`, `id_kriteria`, `kondisi`, `nilai`) VALUES
(1, 'C11', 1, '< 300,000', '100'),
(2, 'C12', 1, '300,000 - 599,999', '80'),
(3, 'C13', 1, '600,000 - 999,999', '60'),
(4, 'C14', 1, '> 999,999', '50'),
(5, 'C21', 2, '> 6 Orang', '100'),
(6, 'C22', 2, '5 - 6 Orang', '80'),
(7, 'C23', 2, '3 - 4 Orang', '60'),
(8, 'C24', 2, '1 - 2 Orang', '50'),
(9, 'C31', 3, 'Petani', '100'),
(10, 'C32', 3, 'Buruh', '80'),
(11, 'C33', 3, 'Pedagang', '60'),
(12, 'C34', 3, 'Karyawan', '50'),
(13, 'C41', 4, '> 60 Tahun', '100'),
(14, 'C42', 4, '50 - 59 Tahun', '80'),
(15, 'C43', 4, '40 - 49 Tahun', '60'),
(16, 'C44', 4, '< 30 Tahun', '50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`) VALUES
(1, 'Admin', '1', 'admin@admin.com', '$2y$10$wwsxFdEMDpfg15j0rCaSauY8nsBf5gvsROTE9aUxPN3z.drOObise');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon_penerimas`
--
ALTER TABLE `calon_penerimas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_calons`
--
ALTER TABLE `nilai_calons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_calons_id_calon_penerima_foreign` (`id_calon_penerima`),
  ADD KEY `nilai_calons_c1_foreign` (`C1`),
  ADD KEY `nilai_calons_c2_foreign` (`C2`),
  ADD KEY `nilai_calons_c3_foreign` (`C3`),
  ADD KEY `nilai_calons_c4_foreign` (`C4`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `subkriterias`
--
ALTER TABLE `subkriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subkriterias_id_kriteria_foreign` (`id_kriteria`);

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
-- AUTO_INCREMENT for table `calon_penerimas`
--
ALTER TABLE `calon_penerimas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_calons`
--
ALTER TABLE `nilai_calons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subkriterias`
--
ALTER TABLE `subkriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai_calons`
--
ALTER TABLE `nilai_calons`
  ADD CONSTRAINT `nilai_calons_c1_foreign` FOREIGN KEY (`C1`) REFERENCES `subkriterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_calons_c2_foreign` FOREIGN KEY (`C2`) REFERENCES `subkriterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_calons_c3_foreign` FOREIGN KEY (`C3`) REFERENCES `subkriterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_calons_c4_foreign` FOREIGN KEY (`C4`) REFERENCES `subkriterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_calons_id_calon_penerima_foreign` FOREIGN KEY (`id_calon_penerima`) REFERENCES `calon_penerimas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subkriterias`
--
ALTER TABLE `subkriterias`
  ADD CONSTRAINT `subkriterias_id_kriteria_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
