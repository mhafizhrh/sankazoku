-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2021 pada 08.39
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_smm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `my_table`
--

CREATE TABLE `my_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admins`
--

CREATE TABLE `tb_admins` (
  `admin_id` int(25) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(999) NOT NULL,
  `ip_address` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_deposit`
--

CREATE TABLE `tb_deposit` (
  `deposit_id` int(225) NOT NULL,
  `method` varchar(100) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `user_id` int(225) NOT NULL,
  `from_number` varchar(30) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `total_deposit` int(225) NOT NULL,
  `total_balance` int(225) NOT NULL,
  `note` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_info`
--

CREATE TABLE `tb_info` (
  `id` int(225) NOT NULL,
  `date_time` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `contents` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order_history`
--

CREATE TABLE `tb_order_history` (
  `order_id` int(225) NOT NULL,
  `user_id` int(225) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `target` varchar(1000) NOT NULL,
  `quantity` int(225) NOT NULL,
  `price` int(225) NOT NULL,
  `price_provider` int(225) NOT NULL,
  `start_count` int(225) NOT NULL,
  `status` enum('Pending','Processing','Partial','Error','Success') NOT NULL,
  `custom_comments` text NOT NULL,
  `custom_link` text NOT NULL,
  `remains` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_services`
--

CREATE TABLE `tb_services` (
  `id` int(225) NOT NULL,
  `category` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(225) NOT NULL,
  `min` int(225) NOT NULL,
  `max` int(225) NOT NULL,
  `note` text NOT NULL,
  `custom` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ticket`
--

CREATE TABLE `tb_ticket` (
  `id` int(225) NOT NULL,
  `ticket_id` int(225) NOT NULL,
  `admin_id` int(225) NOT NULL DEFAULT 0,
  `user_id` int(225) NOT NULL DEFAULT 0,
  `subject` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(225) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(999) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(999) NOT NULL,
  `balance` varchar(100) NOT NULL DEFAULT '0',
  `reg_date` varchar(30) NOT NULL,
  `ip_address` varchar(11) NOT NULL DEFAULT '0',
  `api_key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `my_table`
--
ALTER TABLE `my_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_admins`
--
ALTER TABLE `tb_admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `tb_deposit`
--
ALTER TABLE `tb_deposit`
  ADD PRIMARY KEY (`deposit_id`);

--
-- Indeks untuk tabel `tb_info`
--
ALTER TABLE `tb_info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_order_history`
--
ALTER TABLE `tb_order_history`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `tb_services`
--
ALTER TABLE `tb_services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_ticket`
--
ALTER TABLE `tb_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admins`
--
ALTER TABLE `tb_admins`
  MODIFY `admin_id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_deposit`
--
ALTER TABLE `tb_deposit`
  MODIFY `deposit_id` int(225) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_info`
--
ALTER TABLE `tb_info`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_order_history`
--
ALTER TABLE `tb_order_history`
  MODIFY `order_id` int(225) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_services`
--
ALTER TABLE `tb_services`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_ticket`
--
ALTER TABLE `tb_ticket`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(225) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
