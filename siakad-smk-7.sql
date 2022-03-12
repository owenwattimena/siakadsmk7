-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `dbs`;
CREATE TABLE `dbs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `semester_jurusan_id` bigint(20) unsigned NOT NULL,
  `siswa_nis` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paket_semester` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dbs_semester_jurusan_id_foreign` (`semester_jurusan_id`),
  KEY `dbs_siswa_nis_foreign` (`siswa_nis`),
  CONSTRAINT `dbs_semester_jurusan_id_foreign` FOREIGN KEY (`semester_jurusan_id`) REFERENCES `semester_jurusan` (`id`),
  CONSTRAINT `dbs_siswa_nis_foreign` FOREIGN KEY (`siswa_nis`) REFERENCES `siswa` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dbs` (`id`, `semester_jurusan_id`, `siswa_nis`, `created_at`, `updated_at`, `paket_semester`) VALUES
(1,	1,	2966,	'2022-01-29 11:30:34',	'2022-01-29 11:30:34',	1),
(2,	1,	4185,	'2022-01-29 11:30:34',	'2022-01-29 11:30:34',	1);

DROP TABLE IF EXISTS `dbs_detail`;
CREATE TABLE `dbs_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dbs_id` bigint(20) unsigned NOT NULL,
  `bobot_nilai` double(8,2) DEFAULT NULL,
  `predikat` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dbs_detail_dbs_id_foreign` (`dbs_id`),
  KEY `dbs_detail_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `dbs_detail_dbs_id_foreign` FOREIGN KEY (`dbs_id`) REFERENCES `dbs` (`id`),
  CONSTRAINT `dbs_detail_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dbs_detail` (`id`, `dbs_id`, `bobot_nilai`, `predikat`, `kelas_id`, `created_at`, `updated_at`) VALUES
(1,	1,	40.00,	'B',	1,	'2022-01-29 11:30:54',	'2022-01-29 11:30:54'),
(2,	1,	NULL,	NULL,	2,	'2022-01-29 11:30:55',	'2022-01-29 11:30:55'),
(3,	1,	NULL,	NULL,	3,	'2022-01-29 11:30:55',	'2022-01-29 11:30:55'),
(4,	1,	NULL,	NULL,	4,	'2022-01-29 11:30:55',	'2022-01-29 11:30:55'),
(5,	1,	40.00,	'B',	5,	'2022-01-29 11:30:55',	'2022-01-29 11:30:55'),
(6,	1,	NULL,	NULL,	6,	'2022-01-29 11:30:55',	'2022-01-29 11:30:55'),
(7,	1,	NULL,	NULL,	7,	'2022-01-29 11:30:55',	'2022-01-29 11:30:55'),
(8,	1,	NULL,	NULL,	8,	'2022-01-29 11:30:55',	'2022-01-29 11:30:55'),
(9,	1,	NULL,	NULL,	9,	'2022-01-29 11:30:56',	'2022-01-29 11:30:56'),
(10,	1,	NULL,	NULL,	10,	'2022-01-29 11:30:56',	'2022-01-29 11:30:56'),
(11,	1,	NULL,	NULL,	11,	'2022-01-29 11:30:56',	'2022-01-29 11:30:56'),
(12,	1,	NULL,	NULL,	12,	'2022-01-29 11:30:56',	'2022-01-29 11:30:56'),
(13,	1,	NULL,	NULL,	13,	'2022-01-29 11:30:56',	'2022-01-29 11:30:56'),
(14,	1,	NULL,	NULL,	14,	'2022-01-29 11:30:56',	'2022-01-29 11:30:56'),
(15,	1,	NULL,	NULL,	15,	'2022-01-29 11:30:56',	'2022-01-29 11:30:56'),
(16,	1,	NULL,	NULL,	16,	'2022-01-29 11:30:57',	'2022-01-29 11:30:57'),
(17,	1,	NULL,	NULL,	17,	'2022-01-29 11:30:57',	'2022-01-29 11:30:57'),
(18,	1,	NULL,	NULL,	18,	'2022-01-29 11:30:57',	'2022-01-29 11:30:57'),
(19,	2,	0.00,	'E',	1,	'2022-01-29 11:30:57',	'2022-01-29 11:30:57'),
(20,	2,	NULL,	NULL,	2,	'2022-01-29 11:30:57',	'2022-01-29 11:30:57'),
(21,	2,	NULL,	NULL,	3,	'2022-01-29 11:30:57',	'2022-01-29 11:30:57'),
(22,	2,	NULL,	NULL,	4,	'2022-01-29 11:30:57',	'2022-01-29 11:30:57'),
(23,	2,	NULL,	NULL,	5,	'2022-01-29 11:30:57',	'2022-01-29 11:30:57'),
(24,	2,	NULL,	NULL,	6,	'2022-01-29 11:30:58',	'2022-01-29 11:30:58'),
(25,	2,	NULL,	NULL,	7,	'2022-01-29 11:30:58',	'2022-01-29 11:30:58'),
(26,	2,	NULL,	NULL,	8,	'2022-01-29 11:30:58',	'2022-01-29 11:30:58'),
(27,	2,	NULL,	NULL,	9,	'2022-01-29 11:30:58',	'2022-01-29 11:30:58'),
(28,	2,	NULL,	NULL,	10,	'2022-01-29 11:30:58',	'2022-01-29 11:30:58'),
(29,	2,	NULL,	NULL,	11,	'2022-01-29 11:30:58',	'2022-01-29 11:30:58'),
(30,	2,	NULL,	NULL,	12,	'2022-01-29 11:30:59',	'2022-01-29 11:30:59'),
(31,	2,	NULL,	NULL,	13,	'2022-01-29 11:30:59',	'2022-01-29 11:30:59'),
(32,	2,	NULL,	NULL,	14,	'2022-01-29 11:30:59',	'2022-01-29 11:30:59'),
(33,	2,	NULL,	NULL,	15,	'2022-01-29 11:30:59',	'2022-01-29 11:30:59'),
(34,	2,	NULL,	NULL,	16,	'2022-01-29 11:30:59',	'2022-01-29 11:30:59'),
(35,	2,	NULL,	NULL,	17,	'2022-01-29 11:30:59',	'2022-01-29 11:30:59'),
(36,	2,	NULL,	NULL,	18,	'2022-01-29 11:30:59',	'2022-01-29 11:30:59');

DROP TABLE IF EXISTS `dbs_nilai`;
CREATE TABLE `dbs_nilai` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dbs_detail_id` bigint(20) unsigned NOT NULL,
  `nilai_pengetahuan` double(8,2) NOT NULL,
  `nilai_ketrampilan` double(8,2) NOT NULL,
  `nilai_akhir` double(8,2) NOT NULL,
  `kehadiran` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dbs_nilai` (`id`, `dbs_detail_id`, `nilai_pengetahuan`, `nilai_ketrampilan`, `nilai_akhir`, `kehadiran`, `created_at`, `updated_at`) VALUES
(3,	1,	70.00,	65.00,	70.00,	100.00,	NULL,	NULL),
(4,	19,	0.00,	0.00,	0.00,	0.00,	NULL,	NULL),
(5,	5,	70.00,	65.00,	70.00,	100.00,	NULL,	NULL);

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nign` int(11) NOT NULL,
  `nip` bigint(20) DEFAULT NULL,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guru_nign_unique` (`nign`),
  UNIQUE KEY `guru_nip_unique` (`nip`),
  KEY `guru_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `guru_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `guru` (`id`, `nign`, `nip`, `nama`, `jurusan_id`, `created_at`, `updated_at`) VALUES
(1,	12345601,	196009201990032006,	'Catji Latuhihin, S. PAK',	2,	'2022-01-29 10:56:57',	'2022-01-29 10:56:57'),
(2,	12345604,	NULL,	'Marlin Malwewan, S.Pd',	2,	'2022-01-29 11:40:16',	'2022-01-29 11:40:16'),
(3,	12345606,	198201032010012020,	'Sitti Kemhay, S. PdI',	2,	'2022-01-29 11:41:51',	'2022-01-29 11:41:51'),
(4,	12345608,	194612061984111001,	'Donal Patian, S.Pd',	2,	'2022-01-29 11:42:51',	'2022-01-29 11:42:51'),
(5,	12345610,	198106132008022019,	'Martha Chr. Noya, S.Pd',	2,	'2022-01-29 11:44:10',	'2022-01-29 11:44:10'),
(6,	12345612,	198612172010012012,	'Fadilha Anjarang, S.Pd',	2,	'2022-01-29 11:45:16',	'2022-01-29 11:45:16'),
(7,	12345614,	NULL,	'Kristina A. Titawael, SE',	2,	'2022-01-29 11:46:07',	'2022-01-29 11:46:07'),
(8,	12345617,	1985080320102019,	'Sulce Sapulette, S.Pd',	2,	'2022-01-29 11:47:02',	'2022-01-29 11:47:02');

DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jurusan_kode_unique` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `jurusan` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(2,	'TKJ',	'TEKNIK KOMPUTER DAN JARINGAN',	'2022-01-29 04:32:01',	'2022-01-29 04:32:01');

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mapel_kuri_id` bigint(20) unsigned NOT NULL,
  `guru_id` bigint(20) unsigned DEFAULT NULL,
  `semester_jurusan_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas_mapel_kuri_id_foreign` (`mapel_kuri_id`),
  KEY `kelas_guru_id_foreign` (`guru_id`),
  KEY `kelas_semester_jurusan_id_foreign` (`semester_jurusan_id`),
  CONSTRAINT `kelas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`),
  CONSTRAINT `kelas_mapel_kuri_id_foreign` FOREIGN KEY (`mapel_kuri_id`) REFERENCES `matapelajarankurikulum` (`id`),
  CONSTRAINT `kelas_semester_jurusan_id_foreign` FOREIGN KEY (`semester_jurusan_id`) REFERENCES `semester_jurusan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kelas` (`id`, `nama`, `mapel_kuri_id`, `guru_id`, `semester_jurusan_id`, `created_at`, `updated_at`) VALUES
(1,	'A',	1,	1,	1,	'2022-01-29 11:30:52',	'2022-01-29 11:37:12'),
(2,	'A',	2,	2,	1,	'2022-01-29 11:30:52',	'2022-01-29 11:49:44'),
(3,	'A',	3,	3,	1,	'2022-01-29 11:30:52',	'2022-01-29 11:50:03'),
(4,	'A',	11,	4,	1,	'2022-01-29 11:30:52',	'2022-01-29 11:50:26'),
(5,	'A',	12,	5,	1,	'2022-01-29 11:30:52',	'2022-01-29 11:50:40'),
(6,	'A',	14,	6,	1,	'2022-01-29 11:30:53',	'2022-01-29 11:50:55'),
(7,	'A',	16,	7,	1,	'2022-01-29 11:30:53',	'2022-01-29 11:51:13'),
(8,	'A',	18,	8,	1,	'2022-01-29 11:30:53',	'2022-01-29 11:51:24'),
(9,	'A',	20,	1,	1,	'2022-01-29 11:30:53',	'2022-02-12 10:30:41'),
(10,	'A',	22,	NULL,	1,	'2022-01-29 11:30:53',	'2022-01-29 11:30:53'),
(11,	'A',	24,	NULL,	1,	'2022-01-29 11:30:53',	'2022-01-29 11:30:53'),
(12,	'A',	26,	NULL,	1,	'2022-01-29 11:30:53',	'2022-01-29 11:30:53'),
(13,	'A',	28,	NULL,	1,	'2022-01-29 11:30:53',	'2022-01-29 11:30:53'),
(14,	'A',	30,	NULL,	1,	'2022-01-29 11:30:54',	'2022-01-29 11:30:54'),
(15,	'A',	31,	NULL,	1,	'2022-01-29 11:30:54',	'2022-01-29 11:30:54'),
(16,	'A',	33,	NULL,	1,	'2022-01-29 11:30:54',	'2022-01-29 11:30:54'),
(17,	'A',	35,	NULL,	1,	'2022-01-29 11:30:54',	'2022-01-29 11:30:54'),
(18,	'A',	37,	NULL,	1,	'2022-01-29 11:30:54',	'2022-01-29 11:30:54');

DROP TABLE IF EXISTS `kurikulum`;
CREATE TABLE `kurikulum` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jurusan_kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kurikulum_jurusan_kode_foreign` (`jurusan_kode`),
  CONSTRAINT `kurikulum_jurusan_kode_foreign` FOREIGN KEY (`jurusan_kode`) REFERENCES `jurusan` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kurikulum` (`id`, `jurusan_kode`, `tahun`, `nama`, `created_at`, `updated_at`) VALUES
(2,	'TKJ',	2013,	'SMK 2013',	'2022-01-29 04:59:46',	'2022-01-29 04:59:46');

DROP TABLE IF EXISTS `level`;
CREATE TABLE `level` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `level` (`id`, `level`, `created_at`, `updated_at`) VALUES
(1,	'superadmin',	NULL,	NULL),
(2,	'admin',	NULL,	NULL),
(3,	'admin',	NULL,	NULL),
(4,	'guru',	NULL,	NULL),
(5,	'siswa',	NULL,	NULL);

DROP TABLE IF EXISTS `matapelajarankurikulum`;
CREATE TABLE `matapelajarankurikulum` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurikulum_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `semester` tinyint(4) NOT NULL,
  `skm` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matapelajarankurikulum_kurikulum_id_foreign` (`kurikulum_id`),
  CONSTRAINT `matapelajarankurikulum_kurikulum_id_foreign` FOREIGN KEY (`kurikulum_id`) REFERENCES `kurikulum` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `matapelajarankurikulum` (`id`, `nama`, `kurikulum_id`, `created_at`, `updated_at`, `semester`, `skm`) VALUES
(1,	'Pendidikan Agama Kristen',	2,	'2022-01-29 05:05:07',	'2022-01-29 05:17:41',	1,	0),
(2,	'Pendidikan Agama Kristen Katolik',	2,	'2022-01-29 05:19:02',	'2022-01-29 05:19:02',	1,	0),
(3,	'Pendidikan Agama Islam',	2,	'2022-01-29 05:19:39',	'2022-01-29 05:19:39',	1,	0),
(4,	'Pendidikan Agama Kristen',	2,	'2022-01-29 05:19:59',	'2022-01-29 05:19:59',	2,	0),
(5,	'Pendidikan Agama Kristen Katolik',	2,	'2022-01-29 05:20:16',	'2022-01-29 05:20:16',	2,	0),
(6,	'Pendidikan Agama Islam',	2,	'2022-01-29 05:20:29',	'2022-01-29 05:20:29',	2,	0),
(7,	'Pkn',	2,	'2022-01-29 05:21:13',	'2022-01-29 05:21:13',	5,	0),
(8,	'Pkn',	2,	'2022-01-29 05:21:32',	'2022-01-29 05:21:32',	6,	0),
(9,	'Bahasa Indonesia',	2,	'2022-01-29 05:22:02',	'2022-01-29 05:22:02',	3,	0),
(10,	'Bahasa Indonesia',	2,	'2022-01-29 05:22:13',	'2022-01-29 05:22:13',	4,	0),
(11,	'Pkn',	2,	'2022-01-29 05:23:11',	'2022-01-29 05:23:11',	1,	0),
(12,	'Bahasa Indonesia',	2,	'2022-01-29 05:27:29',	'2022-01-29 05:27:29',	1,	0),
(13,	'Bahasa Indonesia',	2,	'2022-01-29 05:27:41',	'2022-01-29 05:27:41',	2,	0),
(14,	'Matematika',	2,	'2022-01-29 05:28:07',	'2022-01-29 05:28:07',	1,	0),
(15,	'Matematika',	2,	'2022-01-29 05:28:16',	'2022-01-29 05:28:16',	2,	0),
(16,	'Ilmu pengetahuan Sosial',	2,	'2022-01-29 05:28:41',	'2022-01-29 05:28:41',	1,	0),
(17,	'Ilmu pengetahuan Sosial',	2,	'2022-01-29 05:30:40',	'2022-01-29 05:30:40',	2,	0),
(18,	'Bahasa Inggris',	2,	'2022-01-29 05:30:52',	'2022-01-29 05:30:52',	1,	0),
(19,	'Bahasa Inggris',	2,	'2022-01-29 05:31:01',	'2022-01-29 05:31:01',	2,	0),
(20,	'PJOK',	2,	'2022-01-29 05:31:27',	'2022-01-29 05:31:27',	1,	0),
(21,	'PJOK',	2,	'2022-01-29 05:31:47',	'2022-01-29 05:31:47',	2,	0),
(22,	'Fisika',	2,	'2022-01-29 05:32:10',	'2022-01-29 05:32:10',	1,	0),
(23,	'Fisika',	2,	'2022-01-29 05:32:18',	'2022-01-29 05:32:18',	2,	0),
(24,	'Kimia',	2,	'2022-01-29 05:32:37',	'2022-01-29 05:32:37',	1,	0),
(25,	'Kimia',	2,	'2022-01-29 05:32:45',	'2022-01-29 05:32:45',	2,	0),
(26,	'Simulasi dan Komunikasi Digital',	2,	'2022-01-29 05:33:12',	'2022-01-29 05:33:12',	1,	0),
(27,	'Simulasi dan Komunikasi Digital',	2,	'2022-01-29 05:33:33',	'2022-01-29 05:33:33',	2,	0),
(28,	'Seni Budaya',	2,	'2022-01-29 05:34:05',	'2022-01-29 05:34:05',	1,	0),
(29,	'Seni Budaya',	2,	'2022-01-29 05:34:14',	'2022-01-29 05:34:14',	2,	0),
(30,	'Sistem Komputer',	2,	'2022-01-29 05:35:29',	'2022-01-29 05:35:29',	1,	0),
(31,	'Sistem Komputer',	2,	'2022-01-29 05:35:30',	'2022-01-29 05:35:30',	1,	0),
(32,	'Sistem Komputer',	2,	'2022-01-29 05:35:47',	'2022-01-29 05:35:47',	2,	0),
(33,	'Pemrograman Dasar',	2,	'2022-01-29 05:36:00',	'2022-01-29 05:36:00',	1,	0),
(34,	'Pemrograman Dasar',	2,	'2022-01-29 05:36:11',	'2022-01-29 05:36:11',	2,	0),
(35,	'Komputer dan Jaringan Dasar',	2,	'2022-01-29 05:36:34',	'2022-01-29 05:36:34',	1,	0),
(36,	'Komputer dan Jaringan Dasar',	2,	'2022-01-29 05:36:44',	'2022-01-29 05:36:44',	2,	0),
(37,	'Dasar-dasar Design Grafis',	2,	'2022-01-29 05:37:43',	'2022-01-29 05:37:43',	1,	0),
(38,	'Dasar-dasar Design Grafis',	2,	'2022-01-29 05:37:54',	'2022-01-29 05:37:54',	2,	0),
(39,	'Pendidikan Agama Kristen',	2,	'2022-01-29 05:39:47',	'2022-01-29 05:39:47',	3,	0),
(40,	'Pendidikan Agama Kristen',	2,	'2022-01-29 05:39:57',	'2022-01-29 05:39:57',	4,	0),
(41,	'Pendidikan Agama Kristen Katolik',	2,	'2022-01-29 05:40:28',	'2022-01-29 05:40:28',	3,	0),
(42,	'Pendidikan Agama Kristen Katolik',	2,	'2022-01-29 05:40:37',	'2022-01-29 05:40:37',	4,	0),
(43,	'Pendidikan Agama Islam',	2,	'2022-01-29 05:40:49',	'2022-01-29 05:40:49',	3,	0),
(44,	'Pendidikan Agama Islam',	2,	'2022-01-29 05:41:05',	'2022-01-29 05:41:05',	4,	0),
(45,	'Pkn',	2,	'2022-01-29 05:42:17',	'2022-01-29 05:42:17',	3,	0),
(46,	'Pkn',	2,	'2022-01-29 05:42:26',	'2022-01-29 05:42:26',	4,	0),
(47,	'Matematika',	2,	'2022-01-29 05:42:57',	'2022-01-29 05:42:57',	3,	0),
(48,	'Matematika',	2,	'2022-01-29 05:43:06',	'2022-01-29 05:43:06',	4,	0),
(49,	'Bahasa Inggris',	2,	'2022-01-29 05:43:34',	'2022-01-29 05:43:34',	3,	0),
(50,	'Bahasa Inggris',	2,	'2022-01-29 05:43:48',	'2022-01-29 05:43:48',	4,	0),
(51,	'PJOK',	2,	'2022-01-29 05:44:25',	'2022-01-29 05:44:25',	3,	0),
(52,	'PJOK',	2,	'2022-01-29 05:44:31',	'2022-01-29 05:44:31',	4,	0),
(53,	'Teknologi Jaringan Berbasis Luas',	2,	'2022-01-29 05:46:54',	'2022-01-29 05:46:54',	3,	0),
(54,	'Teknologi Jaringan Berbasis Luas',	2,	'2022-01-29 05:47:04',	'2022-01-29 05:47:04',	4,	0),
(55,	'Administrasi Infrastruktur Jaringan',	2,	'2022-01-29 05:47:20',	'2022-01-29 05:47:20',	3,	0),
(56,	'Administrasi Infrastruktur Jaringan',	2,	'2022-01-29 05:47:28',	'2022-01-29 05:47:28',	4,	0),
(57,	'Administrasi Sistem Jaringan',	2,	'2022-01-29 05:47:44',	'2022-01-29 05:47:44',	3,	0),
(58,	'Administrasi Sistem Jaringan',	2,	'2022-01-29 05:47:54',	'2022-01-29 05:47:54',	4,	0),
(59,	'Teknologi Layanan Jaringan',	2,	'2022-01-29 05:48:11',	'2022-01-29 05:48:11',	3,	0),
(60,	'Teknologi Layanan Jaringan',	2,	'2022-01-29 05:48:25',	'2022-01-29 05:48:25',	4,	0),
(61,	'Produk Kreatif dan Kewirausahaan',	2,	'2022-01-29 05:48:47',	'2022-01-29 05:48:47',	3,	0),
(62,	'Produk Kreatif dan Kewirausahaan',	2,	'2022-01-29 05:48:56',	'2022-01-29 05:48:56',	4,	0),
(63,	'Pendidikan Agama Kristen',	2,	'2022-01-29 05:49:47',	'2022-01-29 05:49:47',	5,	0),
(64,	'Pendidikan Agama Kristen',	2,	'2022-01-29 05:49:57',	'2022-01-29 05:49:57',	6,	0),
(65,	'Pendidikan Agama Kristen Katolik',	2,	'2022-01-29 05:50:23',	'2022-01-29 05:50:23',	5,	0),
(66,	'Pendidikan Agama Kristen Katolik',	2,	'2022-01-29 05:50:32',	'2022-01-29 05:50:32',	6,	0),
(67,	'Pendidikan Agama Islam',	2,	'2022-01-29 05:50:45',	'2022-01-29 05:50:45',	5,	0),
(68,	'Pendidikan Agama Islam',	2,	'2022-01-29 05:51:00',	'2022-01-29 05:51:00',	6,	0),
(69,	'Pkn',	2,	'2022-01-29 05:51:49',	'2022-01-29 05:51:49',	2,	0),
(70,	'Bahasa Indonesia',	2,	'2022-01-29 05:52:23',	'2022-01-29 05:52:23',	5,	0),
(71,	'Bahasa Indonesia',	2,	'2022-01-29 05:52:32',	'2022-01-29 05:52:32',	6,	0),
(72,	'Matematika',	2,	'2022-01-29 05:53:27',	'2022-01-29 05:53:27',	5,	0),
(73,	'Matematika',	2,	'2022-01-29 05:53:37',	'2022-01-29 05:53:37',	6,	0),
(74,	'Bahasa Inggris',	2,	'2022-01-29 05:53:48',	'2022-01-29 05:53:48',	5,	0),
(75,	'Bahasa Inggris',	2,	'2022-01-29 05:53:57',	'2022-01-29 05:53:57',	6,	0),
(76,	'Produk Kreatif dan Kewirausahaan',	2,	'2022-01-29 05:54:55',	'2022-01-29 05:54:55',	5,	0),
(77,	'Produk Kreatif dan Kewirausahaan',	2,	'2022-01-29 05:55:06',	'2022-01-29 05:55:06',	6,	0),
(78,	'Administrasi Infrastruktur Jaringan',	2,	'2022-01-29 05:55:20',	'2022-01-29 05:55:20',	5,	0),
(79,	'Administrasi Infrastruktur Jaringan',	2,	'2022-01-29 05:55:30',	'2022-01-29 05:55:30',	6,	0),
(80,	'Administrasi Sistem Jaringan',	2,	'2022-01-29 05:55:40',	'2022-01-29 05:55:40',	5,	0),
(81,	'Administrasi Sistem Jaringan',	2,	'2022-01-29 05:55:50',	'2022-01-29 05:55:50',	6,	0),
(82,	'Teknologi Layanan Jaringan',	2,	'2022-01-29 05:56:38',	'2022-01-29 05:56:38',	5,	0),
(83,	'Teknologi Layanan Jaringan',	2,	'2022-01-29 05:56:48',	'2022-01-29 05:56:48',	6,	0);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_04_30_161340_create_roles_table',	1),
(2,	'2014_10_12_000000_create_users_table',	1),
(3,	'2014_10_12_100000_create_password_resets_table',	1),
(4,	'2019_08_19_000000_create_failed_jobs_table',	1),
(5,	'2021_12_07_144451_create_semesters_table',	1),
(6,	'2021_12_07_144517_create_jurusans_table',	1),
(7,	'2021_12_07_144518_create_gurus_table',	1),
(8,	'2021_12_07_144621_create_siswas_table',	1),
(9,	'2021_12_07_144629_create_semester_jurusans_table',	1),
(10,	'2021_12_09_085444_create_kurikulums_table',	1),
(11,	'2021_12_09_102829_create_matapelajarankurikulums_table',	1),
(12,	'2021_12_09_150943_create_kelas_table',	1),
(13,	'2021_12_12_120102_create_dbs_table',	1),
(14,	'2021_12_12_121623_create_dbsdetails_table',	1),
(15,	'2021_12_12_125549_create_dbsnilais_table',	1),
(16,	'2021_12_18_030555_alter_mapelkur_drop_semester',	1),
(17,	'2021_12_19_020751_add_column_to_semester',	1),
(18,	'2021_12_19_140734_add_status_aktif_to_siswa',	1),
(19,	'2021_12_20_132714_add_column_kelompok_siswa',	1),
(20,	'2021_12_20_141442_add_column_paket_semester',	1),
(21,	'2021_12_24_080337_rename_jurusan_kode_to_id',	1),
(22,	'2021_12_25_092723_add_semester_and_skm_column',	1),
(23,	'2021_12_26_033743_add_kurikulum_id_to_siswa',	1),
(24,	'2022_01_29_194537_change_column_nip_guru_table',	2),
(25,	'2022_02_01_221043_create_pengumuman_table',	3),
(26,	'2022_02_07_193827_create_saran_masukan_table',	4);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE `pengumuman` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kelas_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengumuman_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `pengumuman_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pengumuman` (`id`, `kelas_id`, `judul`, `isi`, `created_at`, `updated_at`) VALUES
(2,	5,	'Ulangan Harian',	'Di infokan kepada siswa XA bahwa pada hari senin akan dilaksanakan ulangan harian bahasa indonesia. Harap mempersiapkan diri, tx',	'2022-02-04 22:38:40',	'2022-02-04 22:38:40'),
(3,	1,	'ulangan',	'ulngan agama',	'2022-02-12 09:59:16',	'2022-02-12 09:59:16');

DROP TABLE IF EXISTS `saran_masukan`;
CREATE TABLE `saran_masukan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `saran_masukan_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `saran_masukan_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `saran_masukan` (`id`, `siswa_id`, `judul`, `isi`, `created_at`, `updated_at`) VALUES
(3,	2,	'Laporan Guru Malas',	'Guru Bahasa Indonesia Tidak pernah mengajar',	'2022-02-09 11:14:03',	'2022-02-09 11:14:03');

DROP TABLE IF EXISTS `semester`;
CREATE TABLE `semester` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `tahun_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis_semester` tinyint(4) NOT NULL,
  `is_aktif` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `semester` (`id`, `tanggal_mulai`, `tanggal_selesai`, `tahun_pelajaran`, `nama_semester`, `created_at`, `updated_at`, `jenis_semester`, `is_aktif`) VALUES
(1,	'2022-01-01',	'2022-06-30',	'2022/2023',	'2022/Ganjil',	'2022-01-29 11:19:26',	'2022-01-29 11:19:26',	1,	1);

DROP TABLE IF EXISTS `semester_jurusan`;
CREATE TABLE `semester_jurusan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) unsigned NOT NULL,
  `tanggal_mulai_semester` date NOT NULL,
  `tanggal_selesai_semester` date NOT NULL,
  `tanggal_mulai_input_nilai` date NOT NULL,
  `tanggal_selesai_input_nilai` date NOT NULL,
  `status_aktif` tinyint(4) NOT NULL DEFAULT 1,
  `jurusan_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `semester_jurusan_semester_id_foreign` (`semester_id`),
  KEY `semester_jurusan_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `semester_jurusan_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`),
  CONSTRAINT `semester_jurusan_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `semester_jurusan` (`id`, `semester_id`, `tanggal_mulai_semester`, `tanggal_selesai_semester`, `tanggal_mulai_input_nilai`, `tanggal_selesai_input_nilai`, `status_aktif`, `jurusan_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2022-01-01',	'2022-06-30',	'2022-02-18',	'2022-06-30',	1,	2,	'2022-01-29 11:23:48',	'2022-02-19 02:31:53');

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nis` bigint(20) NOT NULL,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_aktif` tinyint(4) NOT NULL DEFAULT 1,
  `kelompok` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` bigint(20) unsigned NOT NULL,
  `kurikulum_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswa_nis_unique` (`nis`),
  KEY `siswa_jurusan_kode_foreign` (`jurusan_kode`),
  KEY `siswa_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `siswa_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`),
  CONSTRAINT `siswa_jurusan_kode_foreign` FOREIGN KEY (`jurusan_kode`) REFERENCES `jurusan` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `siswa` (`id`, `nis`, `nama`, `jurusan_kode`, `angkatan`, `created_at`, `updated_at`, `status_aktif`, `kelompok`, `jurusan_id`, `kurikulum_id`) VALUES
(1,	4185,	'Juanuarius Pessiwarissa',	'TKJ',	2022,	'2022-01-29 11:29:24',	'2022-01-29 11:29:24',	1,	'A',	2,	2),
(2,	2966,	'Owen Wattimena',	'TKJ',	2022,	'2022-01-29 11:30:23',	'2022-01-29 11:30:23',	1,	'A',	2,	2);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `nign` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_level_id_foreign` (`level_id`),
  CONSTRAINT `users_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `nis`, `nign`, `remember_token`, `level_id`, `created_at`, `updated_at`) VALUES
(1,	'Owen Wattimena',	'wentoxwtt@gmail.com',	'wentoxwtt',	NULL,	'$2y$10$CyjlK9hqyg.iQrWMFDuHquL3zluisNTgHaWwH46tZQcWAgPwQsp7a',	NULL,	NULL,	NULL,	1,	NULL,	NULL),
(2,	'Catji Latuhihin, S. PAK',	NULL,	'12345601',	NULL,	'$2y$10$8J61KO/aCByifb5g3e8gE.3ks1Zf4/BzaEKZYuxLzhDFOnUa/w0EK',	NULL,	12345601,	NULL,	3,	'2022-01-29 10:56:57',	'2022-01-29 10:56:57'),
(3,	'Juanuarius Pessiwarissa',	'Juanuarius@gmail.com',	'4185',	NULL,	'$2y$10$tFlI1QFoypqfnwb6aHYpSezFFvTLVF2VTv17pqD9OUbEF/wxd5RRG',	4185,	NULL,	NULL,	4,	'2022-01-29 11:29:24',	'2022-01-29 11:29:24'),
(4,	'Owen Wattimena',	'wentoxwtt@gmail.com',	'2966',	NULL,	'$2y$10$DHrsF/pLXpFAYEKNTfqi/OG64SY0ayRg3F2oWIUQz5YQaO0dwL/yC',	2966,	NULL,	NULL,	4,	'2022-01-29 11:30:23',	'2022-01-29 11:30:23'),
(5,	'Marlin Malwewan, S.Pd',	NULL,	'12345604',	NULL,	'$2y$10$IHTSMNEaO4FuLbuO97Oufuz3nfs0B7c2/eLDoCkKdnbFoVaZNnlQC',	NULL,	12345604,	NULL,	3,	'2022-01-29 11:40:16',	'2022-01-29 11:40:16'),
(6,	'Sitti Kemhay, S. PdI',	NULL,	'12345606',	NULL,	'$2y$10$RUUmCr05k6mtDHhZRlFQ7uuBDOmq.XpwrxZo7si9yGK6zQ02m6YmO',	NULL,	12345606,	NULL,	3,	'2022-01-29 11:41:51',	'2022-01-29 11:41:51'),
(7,	'Donal Patian, S.Pd',	NULL,	'12345608',	NULL,	'$2y$10$HYkMmH4uxXyz/dMfzPeh4eskZNbQbrtSFX/ICOmXMhE7vCUEmdwX2',	NULL,	12345608,	NULL,	3,	'2022-01-29 11:42:51',	'2022-01-29 11:42:51'),
(8,	'Martha Chr. Noya, S.Pd',	NULL,	'12345610',	NULL,	'$2y$10$x4oWFfOU03vrKR7IHVmbFe38hHQxs0/Lw8RbXLYW/uo.LpzKKaH6K',	NULL,	12345610,	NULL,	3,	'2022-01-29 11:44:10',	'2022-01-29 11:44:10'),
(9,	'Fadilha Anjarang, S.Pd',	NULL,	'12345612',	NULL,	'$2y$10$ROjJjCTmZlgvOdzzt66nfOJdqce2i3xyLfE3Km.9iVsG1AAC8Y/QC',	NULL,	12345612,	NULL,	3,	'2022-01-29 11:45:16',	'2022-01-29 11:45:16'),
(10,	'Kristina A. Titawael, SE',	NULL,	'12345614',	NULL,	'$2y$10$TB9IWhMfZjGddIB/3f6AFu.eaRbrNrPiO4SeFeIeD1O3K2f160FL.',	NULL,	12345614,	NULL,	3,	'2022-01-29 11:46:08',	'2022-01-29 11:46:08'),
(11,	'Sulce Sapulette, S.Pd',	NULL,	'12345617',	NULL,	'$2y$10$ngre7nQdZHKnOtg7vbRoJuBWqsnK.K4GQfjlpTmM87NS2xUYZvm6u',	NULL,	12345617,	NULL,	3,	'2022-01-29 11:47:03',	'2022-01-29 11:47:03');

-- 2022-02-23 11:36:54
