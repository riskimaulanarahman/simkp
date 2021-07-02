-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 01, 2021 at 05:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simkp`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_sendmail`
--

CREATE TABLE `log_sendmail` (
  `id_sendmail` int(11) NOT NULL,
  `module` varchar(100) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL,
  `mailto` varchar(100) NOT NULL,
  `users` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `isRead` int(5) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_approval`
--

CREATE TABLE `tbl_approval` (
  `id_approval` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `id_formkp` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_tendik` int(11) DEFAULT NULL,
  `id_koor` int(11) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `request_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berkas`
--

CREATE TABLE `tbl_berkas` (
  `id_berkas` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_mhs` int(11) DEFAULT NULL,
  `id_formkp` int(11) DEFAULT NULL,
  `module` varchar(100) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `isStatus` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bimbingan_dosen`
--

CREATE TABLE `tbl_bimbingan_dosen` (
  `id_bimbingan_dosen` int(11) NOT NULL,
  `id_formkp` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_koor` int(11) DEFAULT NULL,
  `id_tahapan` int(11) UNSIGNED NOT NULL,
  `lampiran` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `keterangan_dosen` varchar(100) DEFAULT NULL,
  `lampiran_dosen` varchar(100) DEFAULT NULL,
  `isReply` int(11) NOT NULL DEFAULT 0,
  `isAcc` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen`
--

CREATE TABLE `tbl_dosen` (
  `id_dosen` int(11) NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(60) DEFAULT NULL,
  `telepon` varchar(14) DEFAULT NULL,
  `isWali` int(11) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `isKoor` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`id_dosen`, `id_users`, `nip`, `nama`, `alamat`, `telepon`, `isWali`, `id_jurusan`, `id_prodi`, `isKoor`, `created_at`, `updated_at`) VALUES
(9, 38, '198904152018032001', 'Lovinta Happy Atrinawati', 'alamat ibu lovinta', '08123', 1, 1, 2, NULL, '2021-01-13 02:53:38', '2021-05-06 08:42:38'),
(10, 39, '199208012019031010', 'Dwi Arief Prambudi', 'alamat pak dwi', '08123', 1, 1, 2, NULL, '2021-01-13 02:55:24', '2021-05-06 08:42:28'),
(28, 44, '199405112019031010', 'Gilvy Langgawan Putra', 'alamat pak gilvy', '08123', 0, 1, 2, 1, NULL, '2021-05-06 08:42:19'),
(35, 109, '101010101010', 'Danu Fajar', 'alamat ka danu', '0812', 1, 2, 23, NULL, '2021-05-17 08:15:33', '2021-06-15 04:28:07'),
(36, 111, '101010101011', 'Achmad Fadhil', 'alamat ka fadhil', '0812', 0, 2, 23, 1, '2021-05-17 08:19:04', '2021-05-17 08:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_formkp`
--

CREATE TABLE `tbl_formkp` (
  `id_formkp` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_mhs` int(11) NOT NULL,
  `dosen_pembimbing` int(11) DEFAULT NULL,
  `isAccDosenWali` int(11) NOT NULL DEFAULT 0,
  `isAccTendik` int(11) NOT NULL DEFAULT 0,
  `isAccKoor` int(11) NOT NULL DEFAULT 0,
  `isAccPembimbing` int(11) NOT NULL DEFAULT 0,
  `isKP` int(11) NOT NULL DEFAULT 0,
  `isSidang` int(11) NOT NULL DEFAULT 0,
  `isFinal` int(11) NOT NULL DEFAULT 0,
  `isStatus` int(11) NOT NULL,
  `rejectedby` int(11) DEFAULT NULL,
  `remark_status` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_formkp` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `tanggal_sidang` datetime DEFAULT NULL,
  `isStatus` bit(1) NOT NULL,
  `isSidang` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `id_jurusan` int(10) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `isActive` bit(1) NOT NULL DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `nama_jurusan`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Jurusan Matematika dan Teknologi Informasi (JMTI)', b'1', '2020-12-18 09:19:29', '2021-03-23 08:20:28'),
(2, 'Jurusan Teknik Sipil dan Perencanaan (JTSP)', b'1', '2020-12-23 07:49:49', '2021-03-23 08:20:36'),
(17, 'Jurusan Sains, Teknologi Pangan, dan Kemaritiman (JSTPK)', b'1', '2021-03-23 08:20:44', '2021-03-23 08:20:44'),
(18, 'Jurusan Teknologi Industri dan Proses (JTIP)', b'1', '2021-03-23 08:20:49', '2021-03-23 08:20:49'),
(19, 'Jurusan Ilmu Kebumian dan Lingkungan (JIKL)', b'1', '2021-03-23 08:20:55', '2021-03-23 08:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_koordinator`
--

CREATE TABLE `tbl_koordinator` (
  `id_koor` int(11) NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(60) DEFAULT NULL,
  `telepon` varchar(14) DEFAULT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_koordinator`
--

INSERT INTO `tbl_koordinator` (`id_koor`, `id_users`, `nip`, `nama`, `alamat`, `telepon`, `id_jurusan`, `id_prodi`, `created_at`, `updated_at`) VALUES
(4, 44, '199405112019031010', 'Gilvy Langgawan Putra', 'alamat pak gilvy', '08123', 1, 2, '2021-01-13 03:22:15', '2021-05-06 08:42:19'),
(18, 111, '101010101011', 'Achmad Fadhil', 'alamat ka fadhil', '0812', 2, 23, '2021-05-17 08:19:04', '2021-05-17 08:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `id_mhs` int(11) NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `nim` varchar(10) NOT NULL,
  `tahun_angkatan` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(60) DEFAULT NULL,
  `telepon` varchar(14) DEFAULT NULL,
  `id_dosenwali` int(11) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`id_mhs`, `id_users`, `nim`, `tahun_angkatan`, `nama`, `alamat`, `telepon`, `id_dosenwali`, `id_jurusan`, `id_prodi`, `created_at`, `updated_at`) VALUES
(9, 40, '10161066', '2016', 'Naufal Hartanto', 'Makam Muslim Bds, Jl. Manunggal, Gn. Bahagia, Kecamatan Bali', '081210702979', 9, 1, 2, '2021-01-13 02:57:47', '2021-05-17 07:55:37'),
(33, 98, '10161001', '2016', 'Abdul Rasyid', 'alamat abdul rasyid', '0812', 9, 1, 2, '2021-05-06 09:00:14', '2021-05-06 09:02:46'),
(37, 110, '09161066', '2016', 'Naufal Hartanto', 'alamat naufal', '0812', 35, 2, 23, '2021-05-17 08:17:22', '2021-05-17 08:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mitrakp`
--

CREATE TABLE `tbl_mitrakp` (
  `id_mitrakp` int(11) NOT NULL,
  `id_formkp` int(11) NOT NULL,
  `nama_mitra` varchar(60) NOT NULL,
  `alamat_mitra` varchar(255) NOT NULL,
  `jenis_bidang` varchar(60) NOT NULL,
  `periodekp` date NOT NULL,
  `endperiode` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_formkp` int(11) NOT NULL DEFAULT 0,
  `id_mhs` int(11) NOT NULL,
  `lap_laporan` int(10) UNSIGNED NOT NULL,
  `lap_kinerja` int(10) UNSIGNED NOT NULL,
  `dosen_laporan` int(10) UNSIGNED NOT NULL,
  `dosen_poster` int(10) UNSIGNED NOT NULL,
  `dosen_presentasi` int(10) UNSIGNED NOT NULL,
  `laporan_kp` int(10) UNSIGNED NOT NULL,
  `isi_laporan` int(10) UNSIGNED NOT NULL,
  `pengorganisasian_laporan` int(10) UNSIGNED NOT NULL,
  `konten_poster` int(10) UNSIGNED NOT NULL,
  `desain_poster` int(10) UNSIGNED NOT NULL,
  `media_presentasi` int(10) UNSIGNED NOT NULL,
  `komunikasi_presentasi` int(10) UNSIGNED NOT NULL,
  `penguasaan_materi` int(10) UNSIGNED NOT NULL,
  `revisi_komentar` varchar(100) NOT NULL,
  `isStatus` bit(1) NOT NULL DEFAULT b'0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prodi`
--

CREATE TABLE `tbl_prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_jurusan` int(10) UNSIGNED NOT NULL,
  `nama_prodi` varchar(50) NOT NULL,
  `isActive` bit(1) NOT NULL DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prodi`
--

INSERT INTO `tbl_prodi` (`id_prodi`, `id_jurusan`, `nama_prodi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 1, 'Matematika', b'1', '2020-12-18 09:41:35', '2020-12-18 09:45:39'),
(2, 1, 'Sistem Informasi', b'1', '2020-12-18 09:48:22', '2020-12-18 09:48:22'),
(4, 1, 'Informatika', b'1', '2020-12-18 09:48:38', '2020-12-18 09:48:38'),
(21, 1, 'Ilmu Aktuaria', b'1', '2021-03-23 08:22:24', '2021-03-23 08:22:24'),
(22, 1, 'Statistika', b'1', '2021-03-23 08:22:31', '2021-03-23 08:22:31'),
(23, 2, 'Teknik Sipil', b'1', '2021-03-23 08:22:53', '2021-03-23 08:22:53'),
(24, 2, 'Perencanaan Wilayah dan Kota', b'1', '2021-03-23 08:23:04', '2021-03-23 08:23:04'),
(25, 2, 'Arsitektur', b'1', '2021-03-23 08:23:11', '2021-03-23 08:23:11'),
(26, 17, 'Fisika', b'1', '2021-03-23 08:23:23', '2021-03-23 08:23:23'),
(27, 17, 'Teknik Perkapalan', b'1', '2021-03-23 08:23:36', '2021-04-20 03:36:56'),
(28, 17, 'Teknik Kelautan', b'1', '2021-03-23 08:23:46', '2021-03-23 08:23:46'),
(29, 17, 'Teknologi Pangan', b'1', '2021-03-23 08:23:57', '2021-03-23 08:23:57'),
(30, 18, 'Teknik Mesin', b'1', '2021-03-23 08:24:15', '2021-03-23 08:24:15'),
(31, 18, 'Teknik Kimia', b'1', '2021-03-23 08:24:25', '2021-03-23 08:24:25'),
(32, 18, 'Teknik Elektro', b'1', '2021-03-23 08:24:35', '2021-03-23 08:24:35'),
(33, 18, 'Teknik Industri', b'1', '2021-03-23 08:24:46', '2021-03-23 08:24:46'),
(34, 18, 'Rekayasa Keselamatan', b'1', '2021-03-23 08:24:54', '2021-03-23 08:24:54'),
(35, 19, 'Teknik Material dan Metalurgi', b'1', '2021-03-23 08:25:02', '2021-03-23 08:25:02'),
(36, 19, 'Teknik Lingkungan', b'1', '2021-03-23 08:25:14', '2021-03-23 08:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ruang`
--

CREATE TABLE `tbl_ruang` (
  `id_ruang` int(11) NOT NULL,
  `nama_ruang` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_ruang`
--

INSERT INTO `tbl_ruang` (`id_ruang`, `nama_ruang`, `created_at`, `updated_at`) VALUES
(0, 'Belum Ada Ruangan', '2020-12-18 05:15:18', '2020-12-18 05:15:18'),
(1, 'LAB JMTI', '2020-12-18 05:15:18', '2021-01-19 23:13:56'),
(2, 'LAB JTSP', '2020-12-18 05:15:18', '2021-05-08 05:11:53'),
(3, 'LAB JSTPK', '2020-12-18 05:15:18', '2021-05-08 05:12:18'),
(4, 'LAB JTIP', '2021-05-08 05:12:51', '2021-05-08 05:12:51'),
(5, 'LAB JIKL', '2021-05-08 05:12:51', '2021-05-08 05:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahapan`
--

CREATE TABLE `tbl_tahapan` (
  `id_tahapan` int(11) NOT NULL,
  `nama_tahapan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tahapan`
--

INSERT INTO `tbl_tahapan` (`id_tahapan`, `nama_tahapan`) VALUES
(0, 'null'),
(1, 'Tahap Pelaksanaan'),
(2, 'Tahap Monitoring'),
(3, 'Tahap Pelaporan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tendik`
--

CREATE TABLE `tbl_tendik` (
  `id_tendik` int(11) NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(60) DEFAULT NULL,
  `telepon` varchar(14) DEFAULT NULL,
  `id_jurusan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tendik`
--

INSERT INTO `tbl_tendik` (`id_tendik`, `id_users`, `nip`, `nama`, `alamat`, `telepon`, `id_jurusan`, `created_at`, `updated_at`) VALUES
(3, 42, '100217046', 'Lasniah Wahyuni', 'alamat ibu wahyuni', '08123', 1, '2021-01-13 03:01:06', '2021-05-06 08:39:35'),
(13, 112, '101010101012', 'Salsabila Aghnia', 'alamat salsabila', '0812', 2, '2021-05-17 08:21:12', '2021-06-15 04:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nim` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_txt` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `nip`, `nim`, `username`, `email`, `password`, `pass_txt`, `role`, `remember_token`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL, 'admin', 'admin@gmail.com', '$2y$10$2uwOA43mdHzwVIV2m1OO3.1sxpbXdxCQLaWMpfNTwyA3TUNGrVZpe', 'admin', 'admin', 'xWFdMmgjc6b7ZBS00ywD2RLk3g09UwNc0HmutCuZ2aSJcPSKuNKNOARgJHrP', 1, NULL, '2021-01-19 20:53:43'),
(38, 'Lovinta Happy Atrinawati', '198904152018032001', NULL, 'lovinta', 'lovinta@lecturer.itk.ac', '$2y$10$yrtj6b6JG4cGkfq1PQbQBOald4UtStwH0Y5FiyOAcoR846Xz7jdNO', 'lovinta', 'dosen', 'B1EQDDS3n042djqvLNyYYktq7kITxV6MTbh4rjqt2nq0YPqt7ykGvHyHpeOO', 1, '2021-01-13 02:53:37', '2021-05-06 08:37:48'),
(39, 'Dwi Arief Prambudi', '199208012019031010', NULL, 'dwiarief', 'dwiariefprambudi@lecturer.itk.ac', '$2y$10$2Q8biu96fCXGwApSJywvUefSD7WT2N2EbT86t47yQZLjPUMLYJUti', 'dwiarief', 'dosen', 'Rj3nSafjqZK5mouYWzj0O0O4eRXoKWV3lxuMyLiUNAnSmR7W8Cr6U1PgM5j3', 1, '2021-01-13 02:55:24', '2021-05-06 08:38:54'),
(40, 'Naufal Hartanto', NULL, '10161066', '10161066', '10161066@student.itk.ac', '$2y$10$9WpOA4vF1U2f2ukui8a9cuOLwHxbAxAvwYqDMazERMlzhyijRpZ8a', '10161066', 'mahasiswa', 'XbNPdWdi1d2eTDgSi0Xqz0EkZD36fUwCNcmQZtq9UmTBQG2RhFUhdusDdQR7', 1, '2021-01-13 02:57:47', '2021-05-17 07:55:37'),
(42, 'Lasniah Wahyuni', '100217046', NULL, 'wahyuni', 'wahyuni.lasniah@staff.itk.ac', '$2y$10$xmM5WS8yJZnK1JzTXyUu2uTW.luKIy0SDOoRYNpIiKdRHr4WW8iFi', 'wahyuni', 'tendik', 'YPOMnDdwt2NmyORMzVakEbysUr3bATkMPnyUSUZP9bi9OLTKqHVO9QLTZr5i', 1, '2021-01-13 03:01:06', '2021-05-06 08:39:35'),
(44, 'Gilvy Langgawan Putra', '19940511', NULL, 'gilvy', 'gilvy.langgawan@lecturer.itk.ac', '$2y$10$zcblIKkw4CaAqPvpkpCYK.AoAb3xJLq7nC9FglRjYwhUFZPbjMwb6', 'gilvy', 'koordinator', 'wOD4cENgIAMyifeC4BzioJmmQ9s4hYkmcbZ5esZTWn8L7od3PcBQHrPHYXNF', 1, '2021-01-13 03:22:15', '2021-05-06 08:39:51'),
(98, 'Abdul Rasyid', NULL, '10161001', '10161001', '10161001@student.itk.ac', '$2y$10$8fqGHK3ZaxizRnZoDWNireAtUIHYS0XfoJKnejUayYZ.mAJA4qeN.', '10161001', 'mahasiswa', 'dw3s4ya44KsPF4P2DWScHxEdzyyqklax4Q4KyoQFjU4hPcD8aqNOHSuM8FYb', 1, '2021-05-06 09:00:14', '2021-05-06 09:00:14'),
(109, 'Danu Fajar', '101010101010', NULL, 'danufajar', 'nh.210898@gmail.com', '$2y$10$ml2NoiYqoh7DzWWFeAuK0.dRygURGfJxa4RaMDEmPvi.n7Pu8Tdxm', 'danufajar', 'dosen', '5QY3j9O7nK2C98OoMDGbtz7qddAvxXv7nMedecdazxjIKd6j3WPYXu5OEavp', 1, '2021-05-17 08:15:33', '2021-06-15 04:28:07'),
(110, 'Naufal Hartanto', NULL, '09161066', '09161066', '10161066@student.itk.ac.id', '$2y$10$pIFz9usIXoa5t4XY01Gp5OxSaogGFOnVDRVQ0LTftGl9S.Wc6WK/O', '09161066', 'mahasiswa', 'hIAD25VI8eQNkslp1JD58eUWEStWIt2f6eEN8SeNxFpEy9Uj4RPaRRAmNWUR', 1, '2021-05-17 08:17:22', '2021-05-17 08:17:22'),
(111, 'Achmad Fadhil', '101010101011', NULL, 'fadhil', 'ayhnda2108@gmail.com', '$2y$10$MND3sq4zgOYU.ah/0Dn5w.ylwWZfETHo0.DUEuXy0pSoE/8QwVI36', 'fadhil', 'koordinator', 'YBMxT2wOb1GJQ58v9ph2YPSD7WexPiNyBG03TqNbdGFQwG71HIgCqYpwK1Qu', 1, '2021-05-17 08:19:04', '2021-05-17 08:19:04'),
(112, 'Salsabila Aghnia', '101010101012', NULL, 'salsabila', '10161085@student.itk.ac.id', '$2y$10$T/qc7z7h9jdTRiTmkDFPleRU2YbUzqfNUIoaiJ9NMke5CxJGc9h1G', 'salsabila', 'tendik', 'oz9lom4nOQ08RvWnk4canp7IUPip46VxWASQAx3tNRXxRVXYYs6n7X0O0Clh', 1, '2021-05-17 08:21:12', '2021-06-15 04:26:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_sendmail`
--
ALTER TABLE `log_sendmail`
  ADD PRIMARY KEY (`id_sendmail`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191)) USING BTREE;

--
-- Indexes for table `tbl_approval`
--
ALTER TABLE `tbl_approval`
  ADD PRIMARY KEY (`id_approval`) USING BTREE,
  ADD KEY `FK_tbl_approval_tbl_formkp` (`id_formkp`);

--
-- Indexes for table `tbl_berkas`
--
ALTER TABLE `tbl_berkas`
  ADD PRIMARY KEY (`id_berkas`) USING BTREE,
  ADD KEY `FK_tbl_berkas_tbl_formkp` (`id_formkp`);

--
-- Indexes for table `tbl_bimbingan_dosen`
--
ALTER TABLE `tbl_bimbingan_dosen`
  ADD PRIMARY KEY (`id_bimbingan_dosen`) USING BTREE,
  ADD KEY `FK_tbl_bimbingan_dosen_tbl_formkp` (`id_formkp`);

--
-- Indexes for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD PRIMARY KEY (`id_dosen`) USING BTREE,
  ADD KEY `FK_tbl_dosen_users` (`id_users`) USING BTREE;

--
-- Indexes for table `tbl_formkp`
--
ALTER TABLE `tbl_formkp`
  ADD PRIMARY KEY (`id_formkp`),
  ADD KEY `FK_tbl_formkp_tbl_mahasiswa` (`id_mhs`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_jadwal`) USING BTREE,
  ADD KEY `FK_tbl_jadwal_tbl_formkp` (`id_formkp`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`id_jurusan`) USING BTREE;

--
-- Indexes for table `tbl_koordinator`
--
ALTER TABLE `tbl_koordinator`
  ADD PRIMARY KEY (`id_koor`),
  ADD KEY `FK__users` (`id_users`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`id_mhs`) USING BTREE,
  ADD KEY `id_users` (`id_users`) USING BTREE;

--
-- Indexes for table `tbl_mitrakp`
--
ALTER TABLE `tbl_mitrakp`
  ADD PRIMARY KEY (`id_mitrakp`),
  ADD KEY `FK_tbl_mitrakp_tbl_formkp` (`id_formkp`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`) USING BTREE,
  ADD KEY `FK_tbl_nilai_tbl_formkp` (`id_formkp`);

--
-- Indexes for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `FK_tbl_prodi_tbl_jurusan` (`id_jurusan`);

--
-- Indexes for table `tbl_ruang`
--
ALTER TABLE `tbl_ruang`
  ADD PRIMARY KEY (`id_ruang`) USING BTREE;

--
-- Indexes for table `tbl_tahapan`
--
ALTER TABLE `tbl_tahapan`
  ADD PRIMARY KEY (`id_tahapan`);

--
-- Indexes for table `tbl_tendik`
--
ALTER TABLE `tbl_tendik`
  ADD PRIMARY KEY (`id_tendik`),
  ADD KEY `FK_tbl_tendik_users` (`id_users`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_sendmail`
--
ALTER TABLE `log_sendmail`
  MODIFY `id_sendmail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_approval`
--
ALTER TABLE `tbl_approval`
  MODIFY `id_approval` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_berkas`
--
ALTER TABLE `tbl_berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bimbingan_dosen`
--
ALTER TABLE `tbl_bimbingan_dosen`
  MODIFY `id_bimbingan_dosen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_formkp`
--
ALTER TABLE `tbl_formkp`
  MODIFY `id_formkp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  MODIFY `id_jurusan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_koordinator`
--
ALTER TABLE `tbl_koordinator`
  MODIFY `id_koor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_mitrakp`
--
ALTER TABLE `tbl_mitrakp`
  MODIFY `id_mitrakp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_ruang`
--
ALTER TABLE `tbl_ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_tahapan`
--
ALTER TABLE `tbl_tahapan`
  MODIFY `id_tahapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_tendik`
--
ALTER TABLE `tbl_tendik`
  MODIFY `id_tendik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_approval`
--
ALTER TABLE `tbl_approval`
  ADD CONSTRAINT `FK_tbl_approval_tbl_formkp` FOREIGN KEY (`id_formkp`) REFERENCES `tbl_formkp` (`id_formkp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_berkas`
--
ALTER TABLE `tbl_berkas`
  ADD CONSTRAINT `FK_tbl_berkas_tbl_formkp` FOREIGN KEY (`id_formkp`) REFERENCES `tbl_formkp` (`id_formkp`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_bimbingan_dosen`
--
ALTER TABLE `tbl_bimbingan_dosen`
  ADD CONSTRAINT `FK_tbl_bimbingan_dosen_tbl_formkp` FOREIGN KEY (`id_formkp`) REFERENCES `tbl_formkp` (`id_formkp`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD CONSTRAINT `FK_tbl_dosen_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_formkp`
--
ALTER TABLE `tbl_formkp`
  ADD CONSTRAINT `FK_tbl_formkp_tbl_mahasiswa` FOREIGN KEY (`id_mhs`) REFERENCES `tbl_mahasiswa` (`id_mhs`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD CONSTRAINT `FK_tbl_jadwal_tbl_formkp` FOREIGN KEY (`id_formkp`) REFERENCES `tbl_formkp` (`id_formkp`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_koordinator`
--
ALTER TABLE `tbl_koordinator`
  ADD CONSTRAINT `FK__users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD CONSTRAINT `FK_tbl_mahasiswa_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mitrakp`
--
ALTER TABLE `tbl_mitrakp`
  ADD CONSTRAINT `FK_tbl_mitrakp_tbl_formkp` FOREIGN KEY (`id_formkp`) REFERENCES `tbl_formkp` (`id_formkp`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD CONSTRAINT `FK_tbl_nilai_tbl_formkp` FOREIGN KEY (`id_formkp`) REFERENCES `tbl_formkp` (`id_formkp`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  ADD CONSTRAINT `FK_tbl_prodi_tbl_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `tbl_jurusan` (`id_jurusan`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_tendik`
--
ALTER TABLE `tbl_tendik`
  ADD CONSTRAINT `FK_tbl_tendik_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
