-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 02:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_siswa` bigint(20) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('hadir','izin','sakit','alpa') NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_siswa`, `id_jadwal`, `tanggal`, `status`, `keterangan`) VALUES
(2, 23, 3, '2024-08-29', 'hadir', ''),
(3, 23, 3, '2024-08-30', 'hadir', '');

-- --------------------------------------------------------

--
-- Table structure for table `akun_guru`
--

CREATE TABLE `akun_guru` (
  `id_akun` int(11) NOT NULL,
  `id_guru` bigint(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_guru`
--

INSERT INTO `akun_guru` (`id_akun`, `id_guru`, `username`, `password`) VALUES
(6, 6, '90909090', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `akun_orang_tua`
--

CREATE TABLE `akun_orang_tua` (
  `id_akun` int(11) NOT NULL,
  `id_orang_tua` bigint(11) NOT NULL,
  `user_akun_1` varchar(200) NOT NULL,
  `user_akun_2` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_orang_tua`
--

INSERT INTO `akun_orang_tua` (`id_akun`, `id_orang_tua`, `user_akun_1`, `user_akun_2`, `password`) VALUES
(2, 1, '1270011285', '1921681182', '25d55ad283aa400af464c76d713c07ad'),
(3, 7, '87654321', '987654321', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `akun_siswa`
--

CREATE TABLE `akun_siswa` (
  `id_akun` int(11) NOT NULL,
  `id_siswa` bigint(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_siswa`
--

INSERT INTO `akun_siswa` (`id_akun`, `id_siswa`, `username`, `password`) VALUES
(2, 23, '22106693', '5e8667a439c68f5145dd2fcbecf02209');

-- --------------------------------------------------------

--
-- Table structure for table `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id_data_kelas` int(11) NOT NULL,
  `id_siswa` bigint(20) DEFAULT NULL,
  `id_ruang_belajar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kelas`
--

INSERT INTO `data_kelas` (`id_data_kelas`, `id_siswa`, `id_ruang_belajar`) VALUES
(46, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` bigint(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `gelar_depan` varchar(100) DEFAULT NULL,
  `gelar_belakang` varchar(100) DEFAULT NULL,
  `nuptk` int(20) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kelurahan` varchar(150) NOT NULL,
  `kecamatan` varchar(150) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(150) NOT NULL,
  `tempat_lahir` varchar(150) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` enum('Islam','Kristen','Hindu','Buddha','Konghucu') DEFAULT NULL,
  `gender` enum('Pria','Wanita') DEFAULT NULL,
  `umur` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama`, `gelar_depan`, `gelar_belakang`, `nuptk`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `tempat_lahir`, `tanggal_lahir`, `agama`, `gender`, `umur`) VALUES
(1, 'Fulan', 'Drs.', 'M.Si', 1234567891, 'Jalan Kartini no.4', 'banjar', 'siantar barat', 'pematangsiantar', 'sumatera utara', 'pematangsiantar', '1999-11-12', 'Islam', 'Pria', 24),
(6, 'Alan', 'Drs.', '', 2147483647, 'Jalan Batu Kapur no.19', 'bah kapul', 'siantar sitalasari', 'pematangsiantar', 'sumatera utara', 'pematangsiantar', '1990-10-12', 'Islam', 'Pria', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_ruang_belajar` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `id_guru` bigint(20) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `status_presensi` enum('Aktif','Nonaktif') DEFAULT 'Nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_ruang_belajar`, `id_mata_pelajaran`, `id_guru`, `hari`, `waktu_mulai`, `waktu_selesai`, `status_presensi`) VALUES
(3, 1, 1, 6, 'Senin', '07:15:00', '08:15:00', 'Aktif'),
(4, 1, 1, 1, 'Senin', '19:37:00', '20:37:00', 'Nonaktif');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_belajar`
--

CREATE TABLE `jadwal_belajar` (
  `id_jadwal` int(11) NOT NULL,
  `id_guru` bigint(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `id_ruang_belajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mata_pelajaran` int(11) NOT NULL,
  `kode_mapel` varchar(15) NOT NULL,
  `nama_mapel` varchar(120) NOT NULL,
  `semester` enum('1','2','3','4','5','6') NOT NULL,
  `kategori` enum('Ilmu Alam','Ilmu Sosial','Ilmu Umum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `kode_mapel`, `nama_mapel`, `semester`, `kategori`) VALUES
(1, 'FIS-1', 'Fisika-1', '1', 'Ilmu Alam'),
(2, 'FIS-3', 'Fisika-3', '3', 'Ilmu Alam'),
(3, 'B-IND-1', 'Bahasa Indonesia I', '1', 'Ilmu Umum'),
(4, 'BIO-1', 'Biologi-1', '1', 'Ilmu Alam'),
(5, 'KIM-1', 'Kimia-1', '1', 'Ilmu Alam'),
(6, 'MAT-1', 'Matematika-1', '1', 'Ilmu Alam'),
(8, 'MAT-5', 'Matematika-5', '5', 'Ilmu Alam'),
(9, 'MAT-EKO-1', 'Matematika Ekonomi I', '1', 'Ilmu Sosial'),
(10, 'MAT-EKO-3', 'Matematika Ekonomi III', '3', 'Ilmu Sosial'),
(11, 'MAT-EKO-5', 'Matematika Ekonomi V', '5', 'Ilmu Sosial'),
(12, 'B-IND-3', 'Bahasa Indonesia III', '3', 'Ilmu Umum'),
(13, 'B-IND-5', 'Bahasa Indonesia V', '5', 'Ilmu Umum');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id_orang_tua` bigint(20) NOT NULL,
  `nama_suami` varchar(200) NOT NULL,
  `nama_istri` varchar(200) NOT NULL,
  `nik_suami` varchar(25) NOT NULL,
  `nik_istri` varchar(25) NOT NULL,
  `tempat_lahir_suami` varchar(150) NOT NULL,
  `tanggal_lahir_suami` date NOT NULL,
  `tempat_lahir_istri` varchar(150) NOT NULL,
  `tanggal_lahir_istri` date NOT NULL,
  `pekerjaan_suami` varchar(150) NOT NULL,
  `pekerjaan_istri` varchar(150) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_telefon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id_orang_tua`, `nama_suami`, `nama_istri`, `nik_suami`, `nik_istri`, `tempat_lahir_suami`, `tanggal_lahir_suami`, `tempat_lahir_istri`, `tanggal_lahir_istri`, `pekerjaan_suami`, `pekerjaan_istri`, `alamat`, `nomor_telefon`) VALUES
(1, 'Zaidi', 'Zaida', '1272070607820001', '1272070607820002', 'Pematangsiantar', '1980-10-12', 'Pematangsiantar', '1980-10-12', 'Tentara', 'Dokter', '', ''),
(2, 'Trisdi', 'Trisda', '1272070606850001', '1272070607820003', 'Pematangsiantar', '1985-10-10', 'Pematangsiantar', '1987-06-06', 'Polisi', 'PNS', '', ''),
(3, 'Redico', 'Redica', '1272070204880001', '1272070605860002', 'Pematangsiantar', '1980-06-10', 'Pematangsiantar', '1986-05-06', 'Mahasiswa', 'Mahasiswi', '', ''),
(6, 'Mukidi', 'Mukodi', '127001128511', '1921681182', 'Malang', '2024-08-23', 'Malang', '2024-08-23', 'Dokter', 'Dokter Gigi', '', ''),
(7, 'Pardi', 'Parduy', '87654321', '987654321', 'Malang', '2024-08-31', 'Malang', '2024-08-31', 'Tentara', 'Presiden', 'Jl Jalan11', '0817887827221');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran_diampu_guru`
--

CREATE TABLE `pelajaran_diampu_guru` (
  `id_ampu` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `id_guru` bigint(11) NOT NULL,
  `id_ruang_belajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran_siswa`
--

CREATE TABLE `pelajaran_siswa` (
  `id_pelajaran_siswa` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `id_siswa` bigint(11) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `total_waktu` int(11) NOT NULL,
  `id_ruang_belajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruang_belajar`
--

CREATE TABLE `ruang_belajar` (
  `id_ruang_belajar` int(11) NOT NULL,
  `kode_ruang_belajar` varchar(25) NOT NULL,
  `sifat_semester` enum('Semester Awal','Semester Menengah','Semester Akhir') DEFAULT NULL,
  `jumlah_muatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruang_belajar`
--

INSERT INTO `ruang_belajar` (`id_ruang_belajar`, `kode_ruang_belajar`, `sifat_semester`, `jumlah_muatan`) VALUES
(1, '1-IPA-1', 'Semester Awal', 30),
(3, '1-IPA-3', 'Semester Awal', 30),
(4, '1-IPS-1', 'Semester Awal', 30),
(5, '1-IPS-2', 'Semester Awal', 30),
(8, '1-IPA-2', 'Semester Awal', 30);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` bigint(11) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `nisn` varchar(25) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kelurahan` varchar(150) NOT NULL,
  `kecamatan` varchar(150) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `provinsi` varchar(150) NOT NULL,
  `tempat_lahir` varchar(150) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` enum('Islam','Kristen','Hindu','Buddha','Konghucu') NOT NULL,
  `semester` enum('1','2','3','4','5','6') NOT NULL,
  `id_orang_tua_siswa` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `nisn`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `tempat_lahir`, `tanggal_lahir`, `agama`, `semester`, `id_orang_tua_siswa`) VALUES
(1, 'Siswa-A', '2147483647', 'Jalan Kartini no.4', 'Bah Kapul', 'Siantar Sitalasari', 'Pematangsiantar', 'Sumatera Utara', 'Pematangsiantar', '1999-12-12', 'Islam', '1', 1),
(9, 'Siswa-B', '123345456189', 'Jalan Kartini no.4', 'Bah Kapul', 'Siantar Sitalasari', 'Pematangsiantar', 'Sumatera Utara', 'Pematangsiantar', '1999-10-10', 'Islam', '1', 1),
(12, 'Siswa-C', '123345456722', 'Jalan Batu Kapur no.19', 'Bah Kapul', 'Siantar Sitalasari', 'Pematangsiantar', 'Sumatera Utara', 'Pematangsiantar', '1999-12-12', 'Islam', '1', 1),
(23, 'Udin', '22106693', 'Jalan', 'Jalan', 'Jalan', 'Jalan', 'Malang', 'Malang', '2024-08-29', 'Islam', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `super_users`
--

CREATE TABLE `super_users` (
  `id_super_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_users`
--

INSERT INTO `super_users` (`id_super_user`, `username`, `password`, `status_aktif`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `akun_guru`
--
ALTER TABLE `akun_guru`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `akun_orang_tua`
--
ALTER TABLE `akun_orang_tua`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `fk_akun_orang_tua` (`id_orang_tua`);

--
-- Indexes for table `akun_siswa`
--
ALTER TABLE `akun_siswa`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `fk_akun_siswa` (`id_siswa`);

--
-- Indexes for table `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id_data_kelas`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_ruang_belajar` (`id_ruang_belajar`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_ruang_belajar` (`id_ruang_belajar`),
  ADD KEY `id_mata_pelajaran` (`id_mata_pelajaran`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `jadwal_belajar`
--
ALTER TABLE `jadwal_belajar`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_jadwal_mapel` (`id_mata_pelajaran`) USING BTREE,
  ADD KEY `fk_jadwal_guru` (`id_guru`) USING BTREE,
  ADD KEY `fk_jadwal_ruang` (`id_ruang_belajar`) USING BTREE;

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mata_pelajaran`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id_orang_tua`);

--
-- Indexes for table `pelajaran_diampu_guru`
--
ALTER TABLE `pelajaran_diampu_guru`
  ADD PRIMARY KEY (`id_ampu`),
  ADD KEY `fk_ampu_mapel` (`id_mata_pelajaran`),
  ADD KEY `fk_ampu_guru` (`id_guru`),
  ADD KEY `fk_ampu_ruang` (`id_ruang_belajar`);

--
-- Indexes for table `pelajaran_siswa`
--
ALTER TABLE `pelajaran_siswa`
  ADD PRIMARY KEY (`id_pelajaran_siswa`),
  ADD KEY `fk_pelajaran_mapel` (`id_mata_pelajaran`),
  ADD KEY `fk_siswa_belajar` (`id_siswa`),
  ADD KEY `fk_pelajaran_ruang` (`id_ruang_belajar`);

--
-- Indexes for table `ruang_belajar`
--
ALTER TABLE `ruang_belajar`
  ADD PRIMARY KEY (`id_ruang_belajar`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `fk_orang_tua_siswa` (`id_orang_tua_siswa`);

--
-- Indexes for table `super_users`
--
ALTER TABLE `super_users`
  ADD PRIMARY KEY (`id_super_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `akun_guru`
--
ALTER TABLE `akun_guru`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `akun_orang_tua`
--
ALTER TABLE `akun_orang_tua`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `akun_siswa`
--
ALTER TABLE `akun_siswa`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id_data_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal_belajar`
--
ALTER TABLE `jadwal_belajar`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mata_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id_orang_tua` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelajaran_diampu_guru`
--
ALTER TABLE `pelajaran_diampu_guru`
  MODIFY `id_ampu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelajaran_siswa`
--
ALTER TABLE `pelajaran_siswa`
  MODIFY `id_pelajaran_siswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruang_belajar`
--
ALTER TABLE `ruang_belajar`
  MODIFY `id_ruang_belajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `super_users`
--
ALTER TABLE `super_users`
  MODIFY `id_super_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`);

--
-- Constraints for table `akun_guru`
--
ALTER TABLE `akun_guru`
  ADD CONSTRAINT `fk_akun_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `akun_orang_tua`
--
ALTER TABLE `akun_orang_tua`
  ADD CONSTRAINT `fk_akun_orang_tua` FOREIGN KEY (`id_orang_tua`) REFERENCES `orang_tua` (`id_orang_tua`);

--
-- Constraints for table `akun_siswa`
--
ALTER TABLE `akun_siswa`
  ADD CONSTRAINT `fk_akun_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD CONSTRAINT `data_kelas_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_kelas_ibfk_2` FOREIGN KEY (`id_ruang_belajar`) REFERENCES `ruang_belajar` (`id_ruang_belajar`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_ruang_belajar`) REFERENCES `ruang_belajar` (`id_ruang_belajar`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_mata_pelajaran`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_belajar`
--
ALTER TABLE `jadwal_belajar`
  ADD CONSTRAINT `fk_jadwal_belajar_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `fk_jadwal_belajar_mapel` FOREIGN KEY (`id_mata_pelajaran`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `fk_jadwal_belajar_ruang` FOREIGN KEY (`id_ruang_belajar`) REFERENCES `ruang_belajar` (`id_ruang_belajar`);

--
-- Constraints for table `pelajaran_diampu_guru`
--
ALTER TABLE `pelajaran_diampu_guru`
  ADD CONSTRAINT `fk_ampu_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `fk_ampu_mapel` FOREIGN KEY (`id_mata_pelajaran`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `fk_ampu_ruang` FOREIGN KEY (`id_ruang_belajar`) REFERENCES `ruang_belajar` (`id_ruang_belajar`);

--
-- Constraints for table `pelajaran_siswa`
--
ALTER TABLE `pelajaran_siswa`
  ADD CONSTRAINT `fk_pelajaran_mapel` FOREIGN KEY (`id_mata_pelajaran`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `fk_pelajaran_ruang` FOREIGN KEY (`id_ruang_belajar`) REFERENCES `ruang_belajar` (`id_ruang_belajar`),
  ADD CONSTRAINT `fk_siswa_belajar` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_orang_tua_siswa` FOREIGN KEY (`id_orang_tua_siswa`) REFERENCES `orang_tua` (`id_orang_tua`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
