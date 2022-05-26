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
  `paket_semester` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dbs_semester_jurusan_id_foreign` (`semester_jurusan_id`),
  KEY `dbs_siswa_nis_foreign` (`siswa_nis`),
  CONSTRAINT `dbs_semester_jurusan_id_foreign` FOREIGN KEY (`semester_jurusan_id`) REFERENCES `semester_jurusan` (`id`),
  CONSTRAINT `dbs_siswa_nis_foreign` FOREIGN KEY (`siswa_nis`) REFERENCES `siswa` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `dbs_detail`;
CREATE TABLE `dbs_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dbs_id` bigint(20) unsigned NOT NULL,
  `n_raport_pengetahuan` double(8,2) DEFAULT NULL,
  `predikat_pengetahuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_raport_ketrampilan` double(8,2) DEFAULT NULL,
  `predikat_ketrampilan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dbs_detail_dbs_id_foreign` (`dbs_id`),
  KEY `dbs_detail_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `dbs_detail_dbs_id_foreign` FOREIGN KEY (`dbs_id`) REFERENCES `dbs` (`id`),
  CONSTRAINT `dbs_detail_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `dbs_nilai`;
CREATE TABLE `dbs_nilai` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dbs_detail_id` bigint(20) unsigned NOT NULL,
  `kd1` double(8,2) NOT NULL,
  `kd2` double(8,2) NOT NULL,
  `kd3` double(8,2) NOT NULL,
  `kd4` double(8,2) NOT NULL,
  `kd5` double(8,2) NOT NULL,
  `kd6` double(8,2) NOT NULL,
  `kd7` double(8,2) NOT NULL,
  `kd8` double(8,2) NOT NULL,
  `kd9` double(8,2) NOT NULL,
  `kd10` double(8,2) NOT NULL,
  `rata_rata_kd` double(8,2) NOT NULL,
  `pts` double(8,2) NOT NULL,
  `pas` double(8,2) NOT NULL,
  `kinerja1` double(8,2) NOT NULL,
  `kinerja2` double(8,2) NOT NULL,
  `rata_rata_kinerja` double(8,2) NOT NULL,
  `proyek1` double(8,2) NOT NULL,
  `proyek2` double(8,2) NOT NULL,
  `rata_rata_proyek` double(8,2) NOT NULL,
  `portofolio1` double(8,2) NOT NULL,
  `portofolio2` double(8,2) NOT NULL,
  `rata_rata_portofolio` double(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `detail_tugas`;
CREATE TABLE `detail_tugas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint(20) unsigned NOT NULL,
  `tugas_id` bigint(20) unsigned NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_tugas_siswa_id_foreign` (`siswa_id`),
  KEY `detail_tugas_tugas_id_foreign` (`tugas_id`),
  CONSTRAINT `detail_tugas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`),
  CONSTRAINT `detail_tugas_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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


DROP TABLE IF EXISTS `galeri`;
CREATE TABLE `galeri` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_galeri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(3,	'guru',	NULL,	NULL),
(4,	'siswa',	NULL,	NULL);

DROP TABLE IF EXISTS `matapelajarankurikulum`;
CREATE TABLE `matapelajarankurikulum` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurikulum_id` bigint(20) unsigned NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `skm` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matapelajarankurikulum_kurikulum_id_foreign` (`kurikulum_id`),
  CONSTRAINT `matapelajarankurikulum_kurikulum_id_foreign` FOREIGN KEY (`kurikulum_id`) REFERENCES `kurikulum` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `visi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `misi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
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


DROP TABLE IF EXISTS `semester`;
CREATE TABLE `semester` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `tahun_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_semester` tinyint(4) NOT NULL,
  `is_aktif` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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


DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nis` bigint(20) NOT NULL,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` int(11) NOT NULL,
  `kelompok` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_aktif` tinyint(4) NOT NULL DEFAULT 1,
  `jurusan_id` bigint(20) unsigned NOT NULL,
  `kurikulum_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswa_nis_unique` (`nis`),
  KEY `siswa_jurusan_id_foreign` (`jurusan_id`),
  KEY `siswa_jurusan_kode_foreign` (`jurusan_kode`),
  CONSTRAINT `siswa_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`),
  CONSTRAINT `siswa_jurusan_kode_foreign` FOREIGN KEY (`jurusan_kode`) REFERENCES `jurusan` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tugas`;
CREATE TABLE `tugas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kelas_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tugas_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `tugas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
(1,	'Administrator',	'admin@gmail.com',	'admin',	NULL,	'$2y$10$BIdUDHw/xh6ZD3dKgHTjaeMjqnWdaL/ltT5vWdYEW4OXs4tqD/3Gi',	NULL,	NULL,	NULL,	1,	NULL,	NULL),
(2,	'SEMOL. Chr. TALLANE',	NULL,	'12345601',	NULL,	'$2y$10$tb97cUvnzniwRBuHNNAU3.7zT1FE9UXYqd5XLMwl4x4i9zYHllpsu',	NULL,	12345601,	NULL,	3,	'2022-04-16 04:15:52',	'2022-04-16 04:15:52'),
(3,	'Samuel Matitale',	NULL,	'1234',	NULL,	'$2y$10$G6WSuYbN67ADGhGagX6TlOAv0YY3BKjIsRKYdSVXw6PDzuwBF.6gG',	1234,	NULL,	NULL,	4,	'2022-04-16 04:19:44',	'2022-04-16 04:19:44'),
(4,	'Ongen Lattuheru',	'',	'1235',	NULL,	'$2y$10$ZXasHLGz4iy56WEFQD.ZUuIEHokEWSs1iexwLUnZwNqIgwHId3ywW',	1235,	NULL,	NULL,	4,	'2022-04-16 04:22:59',	'2022-04-16 04:22:59'),
(5,	'Siti',	'',	'1236',	NULL,	'$2y$10$eQXSEQFpeWjaJPQtbi//VeO8Aym5CCfjv3spVTJSTLHZMDdXkG45K',	1236,	NULL,	NULL,	4,	'2022-04-16 04:22:59',	'2022-04-16 04:22:59'),
(6,	'Robert',	'',	'1241',	NULL,	'$2y$10$j1hJKcwXxBtENOQaM1..reHIFrPuzs4bf2VxHc3TeeVlMzaJpYgSq',	1241,	NULL,	NULL,	4,	'2022-04-16 04:26:39',	'2022-04-16 04:26:39'),
(7,	'Pandu',	'',	'1242',	NULL,	'$2y$10$YXrl1YI/Cs6fBhqbBSv1Gud4Ra87hhIpYsHE3d9nbMqoWQpt/WvAy',	1242,	NULL,	NULL,	4,	'2022-04-16 04:26:40',	'2022-04-16 04:26:40');

-- 2022-04-20 12:47:20
