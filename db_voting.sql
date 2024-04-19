-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2023 at 07:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `nip` varchar(10) NOT NULL,
  `id_sekolah` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `hak_akses` varchar(30) NOT NULL,
  `status` enum('Y','T') NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`nip`, `id_sekolah`, `nama`, `jk`, `jabatan`, `hak_akses`, `status`, `foto`) VALUES
('123', '001', 'Super Admin', 'L', 'Super Admin', 'Super Admin', 'Y', 'user_laki.png'),
('181131', 'S-001', 'Rini Suryani', 'P', 'Guru', 'Guru', 'Y', 'user_perempuan.png'),
('19221', 'S-001', 'Tangggu', 'L', 'Guru', 'Guru', 'Y', 'user_laki.png'),
('20131001', 'S-001', 'Dimas', 'L', 'Guru', 'Guru', 'Y', 'user_laki.png'),
('20131002', 'S-001', 'Upik', 'P', 'Guru', 'Guru', 'Y', 'user_perempuan.png'),
('A001', 'S-001', 'Rizky Fauzi Achman', 'L', 'Admin', 'Admin', 'Y', 'user_laki.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calon`
--

CREATE TABLE `tbl_calon` (
  `id_pil` varchar(10) NOT NULL,
  `id_sekolah` varchar(10) NOT NULL,
  `nama_calon` varchar(30) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `foto` text NOT NULL,
  `status` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `hak_akses` enum('Siswa','Guru','Admin','Super Admin') NOT NULL,
  `id_sekolah` varchar(10) NOT NULL,
  `mac_address` varchar(17) NOT NULL,
  `status` enum('Aktif','Pasif') NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`username`, `password`, `hak_akses`, `id_sekolah`, `mac_address`, `status`) VALUES
('123', 'b5a17eb4f3294f1317924d5e6ac91b6ae6f48043', 'Super Admin', '001', '', 'Aktif'),
('181131', 'd09aff9d36b35b98d91fdef48e5a8908bb1c8111', 'Guru', 'S-001', '', 'Aktif'),
('19221', 'd09aff9d36b35b98d91fdef48e5a8908bb1c8111', 'Guru', 'S-001', '', 'Aktif'),
('20131001', 'd09aff9d36b35b98d91fdef48e5a8908bb1c8111', 'Guru', 'S-001', '', 'Aktif'),
('20131002', 'd09aff9d36b35b98d91fdef48e5a8908bb1c8111', 'Guru', 'S-001', '', 'Aktif'),
('A001', 'd927f1406784e20193010d835df56f494cf9c7b6', 'Admin', 'S-001', '', 'Aktif'),
('A003', '5bc1d1e828901f38030dcea45cf0ed616098ddb2', 'Admin', 'S-001', '', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sekolah`
--

CREATE TABLE `tbl_sekolah` (
  `id_sekolah` varchar(10) NOT NULL,
  `nama_sekolah` text NOT NULL,
  `alamat` text NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `status` set('Y','T') NOT NULL,
  `logo` text NOT NULL,
  `frame` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sekolah`
--

INSERT INTO `tbl_sekolah` (`id_sekolah`, `nama_sekolah`, `alamat`, `tahun_ajaran`, `status`, `logo`, `frame`) VALUES
('001', 'School Voting Bandung', 'Disini', '2019', 'Y', 'logo.png', ''),
('S-001', 'SMK Angkasa Lanud Husein Sastranegara Bandung', 'Jalan Lettu Subagio No. 22 Bandung', '2019/2020', 'Y', 'S-001.png', 'S-001.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nis` varchar(10) NOT NULL,
  `id_sekolah` varchar(10) NOT NULL,
  `nama` text NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `foto` text NOT NULL,
  `status` enum('Y','T') NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vote`
--

CREATE TABLE `tbl_vote` (
  `id_vote` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `id_pil` varchar(10) NOT NULL,
  `id_sekolah` varchar(10) NOT NULL,
  `status` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `fk_admin_sekolah` (`id_sekolah`);

--
-- Indexes for table `tbl_calon`
--
ALTER TABLE `tbl_calon`
  ADD PRIMARY KEY (`id_pil`),
  ADD KEY `fk_pilihan_sekolah` (`id_sekolah`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_login_sekolah` (`id_sekolah`);

--
-- Indexes for table `tbl_sekolah`
--
ALTER TABLE `tbl_sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `fk_siswa_sekolah` (`id_sekolah`);

--
-- Indexes for table `tbl_vote`
--
ALTER TABLE `tbl_vote`
  ADD PRIMARY KEY (`id_vote`),
  ADD KEY `fk_vote_siswa` (`nis`),
  ADD KEY `fk_vote_sekolah` (`id_sekolah`),
  ADD KEY `fk_vote_calon` (`id_pil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_vote`
--
ALTER TABLE `tbl_vote`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `fk_admin_sekolah` FOREIGN KEY (`id_sekolah`) REFERENCES `tbl_sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_calon`
--
ALTER TABLE `tbl_calon`
  ADD CONSTRAINT `fk_pilihan_sekolah` FOREIGN KEY (`id_sekolah`) REFERENCES `tbl_sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `fk_login_sekolah` FOREIGN KEY (`id_sekolah`) REFERENCES `tbl_sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `fk_siswa_sekolah` FOREIGN KEY (`id_sekolah`) REFERENCES `tbl_sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_vote`
--
ALTER TABLE `tbl_vote`
  ADD CONSTRAINT `fk_vote_calon` FOREIGN KEY (`id_pil`) REFERENCES `tbl_calon` (`id_pil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vote_sekolah` FOREIGN KEY (`id_sekolah`) REFERENCES `tbl_sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vote_siswa` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
