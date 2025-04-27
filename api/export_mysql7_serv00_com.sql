-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql7.serv00.com
-- Waktu pembuatan: 27 Apr 2025 pada 18.05
-- Versi server: 8.0.39
-- Versi PHP: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m5329_admin`
--
CREATE DATABASE IF NOT EXISTS `m5329_admin` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `m5329_admin`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `Admin`
--

CREATE TABLE `Admin` (
  `Id_admin` int NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Nomor_telpon` varchar(15) DEFAULT NULL,
  `Alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `Admin`
--

INSERT INTO `Admin` (`Id_admin`, `Nama`, `Email`, `Nomor_telpon`, `Alamat`) VALUES
(1, 'Avril', 'admin@gmail.com', '+6285776065561', 'Jl. Langgar no. 109, Bogor'),
(2, 'Admin', 'tabletmito.t35@gmail.com', '0894643433', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `Keranjang`
--

CREATE TABLE `Keranjang` (
  `Id_keranjang` varchar(20) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Kategori` varchar(10) DEFAULT NULL,
  `Jumlah_pesanan` int NOT NULL,
  `Harga` decimal(15,2) NOT NULL,
  `Deskripsi` varchar(100) DEFAULT NULL,
  `Gambar` varchar(255) DEFAULT NULL,
  `Id_pelanggan` varchar(20) NOT NULL,
  `Id_kue` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `Keranjang`
--

INSERT INTO `Keranjang` (`Id_keranjang`, `Nama`, `Kategori`, `Jumlah_pesanan`, `Harga`, `Deskripsi`, `Gambar`, `Id_pelanggan`, `Id_kue`) VALUES
('KRN_67ee1d0e4ee2b', 'Black Forest', '0', 1, 20000.00, 'Enak Murah', 'https://keylachan.serv00.net/api/assets/1000445514_1743560106.jpg', '67ee1c958034a', 'K007'),
('KRN_67ef6a5487ea5', 'Black Forest', '0', 1, 20000.00, 'Enak Murah', 'https://keylachan.serv00.net/api/assets/1000445514_1743560106.jpg', '67ee22532e5aa', 'K007'),
('KRN_67f4b85e05ae0', 'Brownies Coklat', '0', 1, 50000.00, 'Brownies lembut 44', 'https://keylachan.serv00.net/api/assets/wet_cake1.png', '67ee1c958034a', 'K001'),
('KRN_67f7a40cbc92b', 'Tiramisu', '0', 1, 60000.00, 'Kue kopi keju', 'https://keylachan.serv00.net/api/assets/wet_cake2.png', '67f7a3ea6f6f1', 'K003'),
('KRN_67fe11dab8a94', 'Brownies Keju Meses', '0', 1, 40000.00, 'Topping campuran', 'https://keylachan.serv00.net/api/assets/wet_cake5.png', '67fd47f46bbc5', 'K005'),
('KRN_67fe3953c9b3a', 'Birthday cake', '0', 1, 90000.00, 'Brownies ', 'https://keylachan.serv00.net/api/assets/compressed_1744616918438_1744616920.jpeg', '67dd491b35fed', 'K009'),
('KRN_67ff378b03545', 'Black Forest', '0', 1, 60000.00, 'Enak Murah, ', 'https://keylachan.serv00.net/api/assets/1000445514_1743560106.jpg', '67dd491b35fed', 'K007'),
('KRN_68026d809173f', 'Brownies Almond', '0', 1, 35000.00, 'Brownies topping kac', 'https://keylachan.serv00.net/api/assets/dry_cake2.png', '67fef8d71d165', 'K004'),
('KRN_68030bfe84c14', 'Birthday cake', '0', 1, 90000.00, 'Brownies ', 'https://keylachan.serv00.net/api/assets/compressed_1744616918438_1744616920.jpeg', '67f3726e0ac9b', 'K009'),
('KRN_68030c0649e9b', 'Brownies Keju Meses', '0', 1, 40000.00, 'Topping campuran', 'https://keylachan.serv00.net/api/assets/wet_cake5.png', '67f3726e0ac9b', 'K005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `Kue`
--

CREATE TABLE `Kue` (
  `Id_kue` varchar(20) NOT NULL,
  `Nama_kue` varchar(20) NOT NULL,
  `Harga` decimal(15,2) NOT NULL,
  `Kategori` varchar(50) NOT NULL,
  `Deskripsi` varchar(50) DEFAULT NULL,
  `Gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `Kue`
--

INSERT INTO `Kue` (`Id_kue`, `Nama_kue`, `Harga`, `Kategori`, `Deskripsi`, `Gambar`) VALUES
('K001', 'Brownies ceres keju', 40000.00, 'Wet', 'Brownies toping cere', 'https://keylachan.serv00.net/api/assets/wet_cake1.png'),
('K002', 'Brownies', 35000.00, 'Dry', 'Brownies topping kej', 'https://keylachan.serv00.net/api/assets/dry_cake1.png'),
('K003', 'Brownies chocochips', 35000.00, 'Dry', 'Topping choco chip', 'https://keylachan.serv00.net/api/assets/wet_cake2.png'),
('K004', 'Brownies Almond', 35000.00, 'Dry', 'Brownies topping kac', 'https://keylachan.serv00.net/api/assets/dry_cake2.png'),
('K005', 'Brownies Keju Meses', 40000.00, 'Dry', 'Topping campuran', 'https://keylachan.serv00.net/api/assets/wet_cake5.png'),
('K006', 'Brownies Keju', 30000.00, 'Wet', 'Nikmat Sekali Hehe, ', 'https://keylachan.serv00.net/api/assets/1000444982_1743468219.jpg'),
('K007', 'Black Forest', 60000.00, 'Wet', 'Enak Murah, ', 'https://keylachan.serv00.net/api/assets/1000445514_1743560106.jpg'),
('K009', 'Birthday cake', 90000.00, 'Wet', 'Brownies ', 'https://keylachan.serv00.net/api/assets/compressed_1744616918438_1744616920.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `Login_Admin`
--

CREATE TABLE `Login_Admin` (
  `Username_Email` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `Login_Admin`
--

INSERT INTO `Login_Admin` (`Username_Email`, `Password`) VALUES
('admin@gmail.com', 'loginadmin'),
('tabletmito.t35@gmail.com', 'ab');

-- --------------------------------------------------------

--
-- Struktur dari tabel `Login_Pelanggan`
--

CREATE TABLE `Login_Pelanggan` (
  `Username_Email` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `Login_Pelanggan`
--

INSERT INTO `Login_Pelanggan` (`Username_Email`, `Password`) VALUES
('admin@gmail.com', 'a'),
('ani@gmail.com', 'ab'),
('avrilauriza.21@gmail.com', 'avril'),
('gammasamuderaindonesia22@gmail', 'gamma'),
('rizzalzein@gmail.com', 'rizzal'),
('sipbilly@gmail.com', 'B1lly128'),
('tabletmito.t35@gmail.com', 'ab'),
('tes@gmail.com', 'tes123'),
('wahyuningsihekasafitri02@gmail', 'ekasafitri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `Pelanggan`
--

CREATE TABLE `Pelanggan` (
  `Id_pelanggan` varchar(20) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Nomor_telpon` varchar(15) DEFAULT NULL,
  `Alamat` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `Pelanggan`
--

INSERT INTO `Pelanggan` (`Id_pelanggan`, `Nama`, `Email`, `Nomor_telpon`, `Alamat`) VALUES
('67dd491b35fed', 'Keyla Chanw', 'tabletmito.t35@gmail.com', '08959929296758', 'Jalan N0 8 Ahmad s'),
('67e9240a7404f', 'ee', 'admin@gamil.com', 'ss', 'Jalan N0 8 Ahmad s'),
('67ee1c958034a', 'tes', 'tes@gmail.com', '085315085220', 'Jalan N0 8 Ahmad s'),
('67ee22532e5aa', 'Ani chan', 'ani@gmail.com', '08946464', 'Jalan N0 8 Ahmad s'),
('67f3726e0ac9b', 'rizal zaen', 'rizzalzein@gmail.com', '085710663955', 'Jalan N0 8 Ahmad s'),
('67f7a3ea6f6f1', 'Saiful Bilad Zain', 'sipbilly@gmail.com', '081938312345', 'Jalan N0 8 Ahmad s'),
('67fd47f46bbc5', 'eka safitri', 'wahyuningsihekasafitri02@gmail', '085710663955', ''),
('67fef8d71d165', 'Gamma', 'gammasamuderaindonesia22@gmail', '+6285892707914', ''),
('6803126445f91', 'avril', 'avrilauriza.21@gmail.com', '085776065661', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `Pesanan`
--

CREATE TABLE `Pesanan` (
  `Id_pesanan` varchar(20) NOT NULL,
  `Id_pelanggan` varchar(20) NOT NULL,
  `Id_kue` varchar(20) NOT NULL,
  `Jumlah_kue` int NOT NULL,
  `Tanggal_Pengiriman` date DEFAULT NULL,
  `Status_pesanan` varchar(10) DEFAULT NULL,
  `Total_harga` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `Pesanan`
--

INSERT INTO `Pesanan` (`Id_pesanan`, `Id_pelanggan`, `Id_kue`, `Jumlah_kue`, `Tanggal_Pengiriman`, `Status_pesanan`, `Total_harga`) VALUES
('ORD_67e92420333d2', '67e9240a7404f', 'null', 1, '2025-03-08', 'Selesai', 55000.00),
('ORD_67fb7e14575b2', '67f3726e0ac9b', 'null', 3, '2025-04-15', 'Selesai', 195000.00);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`Id_admin`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indeks untuk tabel `Keranjang`
--
ALTER TABLE `Keranjang`
  ADD PRIMARY KEY (`Id_keranjang`);

--
-- Indeks untuk tabel `Kue`
--
ALTER TABLE `Kue`
  ADD PRIMARY KEY (`Id_kue`);

--
-- Indeks untuk tabel `Login_Admin`
--
ALTER TABLE `Login_Admin`
  ADD PRIMARY KEY (`Username_Email`);

--
-- Indeks untuk tabel `Login_Pelanggan`
--
ALTER TABLE `Login_Pelanggan`
  ADD PRIMARY KEY (`Username_Email`);

--
-- Indeks untuk tabel `Pelanggan`
--
ALTER TABLE `Pelanggan`
  ADD PRIMARY KEY (`Id_pelanggan`);

--
-- Indeks untuk tabel `Pesanan`
--
ALTER TABLE `Pesanan`
  ADD PRIMARY KEY (`Id_pesanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `Admin`
--
ALTER TABLE `Admin`
  MODIFY `Id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
