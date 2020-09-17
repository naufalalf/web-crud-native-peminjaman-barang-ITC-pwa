-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Sep 2019 pada 08.04
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_itc`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_user`, `admin_pass`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowed_equipment`
--

CREATE TABLE `borrowed_equipment` (
  `property_number` double NOT NULL,
  `employee_id` double NOT NULL,
  `date_borrowed` date NOT NULL,
  `date_returned` date NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `borrowed_equipment`
--

INSERT INTO `borrowed_equipment` (`property_number`, `employee_id`, `date_borrowed`, `date_returned`, `status`) VALUES
(5, 1, '2019-02-24', '0000-00-00', ''),
(6, 2, '2019-02-24', '0000-00-00', ''),
(5, 2, '2019-02-24', '2019-04-01', 'returned'),
(6, 2, '2019-02-24', '0000-00-00', ''),
(7, 1, '2019-02-24', '0000-00-00', ''),
(7, 1, '2019-02-24', '0000-00-00', ''),
(6, 1, '2019-02-24', '2019-07-26', 'returned'),
(7, 1, '2019-02-24', '0000-00-00', ''),
(7, 5, '2019-02-25', '0000-00-00', ''),
(5, 5, '2019-03-11', '0000-00-00', ''),
(7, 5, '2019-04-23', '0000-00-00', ''),
(5, 5, '2019-07-26', '0000-00-00', ''),
(7, 5, '2019-07-26', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowers`
--

CREATE TABLE `borrowers` (
  `employee_id` double NOT NULL,
  `employee_first_name` varchar(30) NOT NULL,
  `employee_last_name` varchar(30) NOT NULL,
  `employee_middle_name` varchar(30) NOT NULL,
  `employee_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `borrowers`
--

INSERT INTO `borrowers` (`employee_id`, `employee_first_name`, `employee_last_name`, `employee_middle_name`, `employee_status`) VALUES
(1, 'Aditya', 'Nugroho', 'Bekti', 'Permanent'),
(2, 'First', 'Last', 'Middle', 'Good'),
(5, 'naufal', 'fikri', 'al', 'student');

-- --------------------------------------------------------

--
-- Struktur dari tabel `equipment`
--

CREATE TABLE `equipment` (
  `property_number` double NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_acquired` date NOT NULL,
  `accountable_employee` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `equipment`
--

INSERT INTO `equipment` (`property_number`, `item_name`, `description`, `date_acquired`, `accountable_employee`) VALUES
(5, 'table', 'table', '2019-02-22', 'jihad '),
(6, 'Example', 'Example', '2019-02-15', 'Aditya'),
(7, 'laptop', 'acer', '2019-02-19', 'naufal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `equipment_status`
--

CREATE TABLE `equipment_status` (
  `property_number` double NOT NULL,
  `equipment_status` varchar(30) NOT NULL,
  `inspector` varchar(30) NOT NULL,
  `date_of_inspection` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_user` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_user`, `user_pass`) VALUES
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee'),
(4, 'gigih', 'd5311520c25ad6ea88a707d5e5b864bd'),
(5, 'ais', '6f0453facdfa86652de89c8d4d9299c7'),
(6, 'jihad', 'd3063ef8a14142a6f2086499ed812111');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `borrowed_equipment`
--
ALTER TABLE `borrowed_equipment`
  ADD KEY `property_number` (`property_number`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indeks untuk tabel `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indeks untuk tabel `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`property_number`) USING BTREE;

--
-- Indeks untuk tabel `equipment_status`
--
ALTER TABLE `equipment_status`
  ADD KEY `property_number_2` (`property_number`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `borrowed_equipment`
--
ALTER TABLE `borrowed_equipment`
  ADD CONSTRAINT `borrowed_equipment_ibfk_1` FOREIGN KEY (`property_number`) REFERENCES `equipment` (`property_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowed_equipment_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `borrowers` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `equipment_status`
--
ALTER TABLE `equipment_status`
  ADD CONSTRAINT `equipment_status_ibfk_1` FOREIGN KEY (`property_number`) REFERENCES `equipment` (`property_number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
