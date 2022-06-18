-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 18 Jun 2022 pada 19.12
-- Versi server: 10.3.34-MariaDB-cll-lve
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ilhampah_pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_barang`
--

CREATE TABLE `m_barang` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `diskon` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_barang`
--

INSERT INTO `m_barang` (`id`, `kode`, `nama`, `harga`, `diskon`) VALUES
(1, 'B-001', 'Barang 1', '200000', '30'),
(3, 'B-002', 'Barang 2', '125000', '20'),
(4, 'B-004', 'Barang 4', '125000', '0'),
(5, 'B-005', 'Barang 5', '350000', '15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_customer`
--

CREATE TABLE `m_customer` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_customer`
--

INSERT INTO `m_customer` (`id`, `kode`, `name`, `telp`) VALUES
(1, 'C-001', 'ilham', '1231'),
(12, 'C-002', 'Ilhamp', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_sales`
--

CREATE TABLE `t_sales` (
  `id` int(11) NOT NULL,
  `kode` varchar(15) NOT NULL,
  `tgl` varchar(15) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  `ongkir` decimal(10,0) NOT NULL,
  `total_bayar` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_sales`
--

INSERT INTO `t_sales` (`id`, `kode`, `tgl`, `cust_id`, `subtotal`, `diskon`, `ongkir`, `total_bayar`) VALUES
(6, '202206-0001', '2022-06-18', 12, '820000', '0', '0', '820000'),
(7, '202206-0007', '2022-06-18', 1, '895000', '0', '0', '895000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_sales_det`
--

CREATE TABLE `t_sales_det` (
  `sales_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga_bandrol` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon_pct` decimal(10,0) NOT NULL,
  `diskon_nilai` decimal(10,0) NOT NULL,
  `harga_diskon` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `no_transaksi` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_sales_det`
--

INSERT INTO `t_sales_det` (`sales_id`, `barang_id`, `harga_bandrol`, `qty`, `diskon_pct`, `diskon_nilai`, `harga_diskon`, `total`, `no_transaksi`) VALUES
(18, 5, '350000', 2, '15', '52500', '297500', '595000', '202206-0001'),
(19, 4, '125000', 1, '0', '0', '125000', '125000', '202206-0001'),
(20, 3, '125000', 1, '20', '25000', '100000', '100000', '202206-0001'),
(21, 5, '350000', 2, '15', '52500', '297500', '595000', '202206-0007'),
(22, 3, '125000', 3, '20', '25000', '100000', '300000', '202206-0007');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_customer`
--
ALTER TABLE `m_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_sales`
--
ALTER TABLE `t_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_sales_det`
--
ALTER TABLE `t_sales_det`
  ADD PRIMARY KEY (`sales_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `m_customer`
--
ALTER TABLE `m_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `t_sales`
--
ALTER TABLE `t_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `t_sales_det`
--
ALTER TABLE `t_sales_det`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
