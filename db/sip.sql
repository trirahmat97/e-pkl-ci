-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2020 at 06:31 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sip`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dospem`
--

CREATE TABLE `dospem` (
  `dosen_id` int(11) NOT NULL,
  `pkl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kd_jurusan` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `kd_jurusan`) VALUES
(1, 'Ekonomi dan Bisnis', '1'),
(2, 'Perkebunan', '2');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `npm` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `npm`, `nama`, `prodi_id`, `user_id`) VALUES
(1, 15753070, 'Tri Rahmat Aribowo', 1, 1),
(2, 18753056, 'Rio Hermawan', 1, 1),
(3, 75784, 'Leonardo', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mhs_pkl`
--

CREATE TABLE `mhs_pkl` (
  `pkl_id` int(11) NOT NULL,
  `mhs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `di` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telphon` varchar(15) NOT NULL,
  `provinsi` varchar(225) NOT NULL,
  `kabupaten` varchar(225) NOT NULL,
  `kecamatan` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pkl`
--

CREATE TABLE `pkl` (
  `id` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `tanggal_pkl` date NOT NULL,
  `thn_ajaran` varchar(4) NOT NULL,
  `createAt` date NOT NULL,
  `status_daftar` enum('0','1','2','3','4') NOT NULL,
  `status_val` enum('0','1','2') NOT NULL,
  `status_pkl` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kd_prodi` varchar(2) NOT NULL,
  `jurusan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`, `kd_prodi`, `jurusan_id`) VALUES
(1, 'Manajement Informatika', '1', 1),
(2, 'Akuntansi', '2', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `showmhs`
-- (See below for the actual view)
--
CREATE TABLE `showmhs` (
`id` int(11)
,`user_id` int(11)
,`npm` int(11)
,`nama` varchar(50)
,`nama_prodi` varchar(30)
,`nama_jurusan` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `level` enum('00','01','11') NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`, `parent`, `email`) VALUES
(1, 'tra', '81dc9bdb52d04dc20036dbd8313ed055', '11', NULL, ''),
(2, 'deny', '81dc9bdb52d04dc20036dbd8313ed055', '11', 1, ''),
(3, 'rio', '81dc9bdb52d04dc20036dbd8313ed055', '00', 1, ''),
(4, 'tra26', '81dc9bdb52d04dc20036dbd8313ed055', '11', NULL, 'tradeveloper97@gmail.com'),
(5, 'huuu', '81dc9bdb52d04dc20036dbd8313ed055', '11', NULL, 'hah@gmail.com');

-- --------------------------------------------------------

--
-- Structure for view `showmhs`
--
DROP TABLE IF EXISTS `showmhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `showmhs`  AS  select `a`.`id` AS `id`,`a`.`user_id` AS `user_id`,`a`.`npm` AS `npm`,`a`.`nama` AS `nama`,`p`.`nama` AS `nama_prodi`,`j`.`nama` AS `nama_jurusan` from ((`mahasiswa` `a` join `prodi` `p`) join `jurusan` `j`) where ((`a`.`prodi_id` = `p`.`id`) and (`p`.`jurusan_id` = `j`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `dospem`
--
ALTER TABLE `dospem`
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `pkl_id` (`pkl_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mhs_pkl`
--
ALTER TABLE `mhs_pkl`
  ADD KEY `pkl_id` (`pkl_id`),
  ADD KEY `mhs_id` (`mhs_id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`di`);

--
-- Indexes for table `pkl`
--
ALTER TABLE `pkl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perusahaan_id` (`perusahaan_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `di` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pkl`
--
ALTER TABLE `pkl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `dospem`
--
ALTER TABLE `dospem`
  ADD CONSTRAINT `dospem_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dospem_ibfk_2` FOREIGN KEY (`pkl_id`) REFERENCES `pkl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mhs_pkl`
--
ALTER TABLE `mhs_pkl`
  ADD CONSTRAINT `mhs_pkl_ibfk_1` FOREIGN KEY (`pkl_id`) REFERENCES `pkl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_pkl_ibfk_2` FOREIGN KEY (`mhs_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pkl`
--
ALTER TABLE `pkl`
  ADD CONSTRAINT `pkl_ibfk_1` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`di`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
