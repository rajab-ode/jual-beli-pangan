-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2022 pada 21.24
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hasilpertanian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout`
--

CREATE TABLE `checkout` (
  `idcheckout` int(11) NOT NULL,
  `noktp` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `alamat_pengiriman` varchar(255) NOT NULL,
  `jenis_pengiriman` varchar(35) NOT NULL,
  `tgl_checkout` date NOT NULL,
  `wkt_checkout` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `checkout`
--

INSERT INTO `checkout` (`idcheckout`, `noktp`, `nama`, `notelp`, `kodepos`, `alamat`, `alamat_pengiriman`, `jenis_pengiriman`, `tgl_checkout`, `wkt_checkout`) VALUES
(1, '121212132321321', 'wkt_upload', '3213213', '2215', 'Balige', '				', 'JNT', '2022-05-29', '05:53:43'),
(2, '121212132321321', 'wkt_upload', '3213213', '2215', 'Balige', '	sdsd			', 'NINJA', '2022-05-29', '05:54:21'),
(3, '121212132321321', 'id_ongkir', '3213213', '2215', 'Balige', '	dsadsad			', 'JNE', '2022-05-29', '06:13:05'),
(4, '1121213232', 'Adef', '08999665656', '22213', '	Pancuran			', '		Pancuran		', 'POS INDONESIA', '2022-05-29', '06:15:13'),
(5, '121212132321321', 'ddddd', '231321321', '2321321', '		sdadsa		', '	sadasdsa			', 'JNE', '2022-05-29', '06:38:44'),
(6, '121212132321321', 'id_ongkir', '082277654318', 'ss', '	adasda			', '	dsdsd			', 'JNT', '2022-05-29', '06:44:01'),
(8, '', '', '', '', '				', '				', '', '2022-05-30', '06:53:15'),
(9, 'dasda', 'dsadsa', 'dsasd', 'dadadsadsa', '	dsadsa			', '		dasa		', 'JNT', '2022-05-30', '18:38:26'),
(10, '12111222234000002', 'Alex Leo Nardo Sipayung', '082277654318', '22215', 'Sidikalang', 'Sidikalang', 'JNT', '2022-06-02', '10:52:20'),
(11, 'sadsadsa', 'dsadsa', 'dsadsad', 'dsadsadsa', 'dsadsadsa', 'sadsadsa', '', '2022-06-02', '11:57:33'),
(12, 'dddd', 'dsadsa', 'dddd', 'sdad', 'adssad', 'dsadsad', 'NINJA', '2022-06-02', '12:04:08'),
(13, 'sadsad', 'adsa', 'dsadsad', 'sadsad', 'sadsadsa', 'dsadsa', 'JNT', '2022-06-03', '08:48:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'JNE', 3000),
(3, 'J&T', 1500),
(4, 'POS INDONESIA', 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(2, 'febrysiregar3@yahoo.com', 'arif', 'arif', '08227654318', 'jogja'),
(6, 'nikita@gmail.com', 'nikita', 'Nikita', '087765431234', 'Balige, Sumatera Utara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(29, 134, 'aeae', 'bri', 17500, '2022-06-24', '2022062409231220220622114202Laporan.png'),
(30, 138, 'rajab', 'bri', 320000, '2022-06-24', '2022062409503620220603184601Drawing10.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `id_penjual`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(132, 13, 1, 15, '2022-06-21', 35000, 'JNE', 6000, 'eaa', 'Pending', ''),
(133, 13, 1, 15, '2022-06-21', 38000, 'JNE', 6000, 'eeee', 'Pending', ''),
(134, 25, 1, 23, '2022-06-24', 17500, 'JNE', 3000, 'c', 'barang dikirim', '12345'),
(135, 25, 1, 23, '2022-06-24', 17500, 'JNE', 3000, 'c', 'Pending', ''),
(136, 25, 1, 23, '2022-06-24', 17500, 'JNE', 3000, 'jakarta\r\n', 'Pending', ''),
(137, 25, 1, 23, '2022-06-24', 17500, 'JNE', 3000, 'jakarta', 'Pending', ''),
(138, 25, 1, 15, '2022-06-24', 32000, 'JNE', 6000, 'wakatobi', 'sudah kirim bukti pembayaran', ''),
(139, 25, 1, 15, '2022-06-24', 40000, 'JNE', 9000, 'wakatobi', 'Pending', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `product_id`, `jumlah`) VALUES
(112, 129, 7, 2),
(113, 129, 6, 2),
(114, 129, 5, 1),
(115, 130, 7, 2),
(116, 130, 5, 1),
(117, 130, 6, 1),
(118, 131, 7, 1),
(119, 132, 7, 2),
(120, 133, 7, 1),
(121, 133, 6, 1),
(122, 0, 14, 1),
(123, 0, 14, 1),
(124, 134, 7, 1),
(125, 135, 7, 1),
(126, 136, 7, 1),
(127, 137, 7, 1),
(128, 138, 14, 1),
(129, 138, 5, 1),
(130, 139, 7, 1),
(131, 139, 14, 1),
(132, 139, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL,
  `jenis_bank` varchar(50) NOT NULL,
  `no_rekening` varchar(25) NOT NULL,
  `level` enum('admin','penjual','pembeli') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_name`, `username`, `password`, `admin_telp`, `admin_email`, `admin_address`, `jenis_bank`, `no_rekening`, `level`) VALUES
(6, 'Yose Silalahi', 'yose', '123', '087765431222', 'yoseantonius@yahoo.com', 'Pekanbaru', 'BRI', '1194-112-232-332', 'admin'),
(7, 'Alex Leo Nardo Sipayung', 'Alex', 'alex', '082277654318', '', 'Sidikalang, Bongbongan', 'BRI', '', ''),
(8, 'Alex Leo Nardo Sipayung', 'Alex', 'alex', '082277654318', 'alexleo11@yahoo.com', 'Sidikalang, Bongbongan No 58 Belang Malum', 'BRI', '', ''),
(9, 'Alex Leo Nardo Sipayung', 'Alex', 'alex', '082277654318', 'alexleo11@yahoo.com', 'Sidikalang, Bongbongan No 58 Belang Malum', 'BRI', '019401064654505', ''),
(15, 'rajab', 'oode', '123', '6285220832295', 'rajab@gmail.com', 'wakatobi', 'bri', '1111000111999', 'penjual'),
(23, 'rajab', 'rajab', '123', '6285220832295', 'rajab@gmail.com', 'wakatobi', 'BRI', '999111191111', 'penjual'),
(25, 'fadil', 'fadil', '123', '6285220832295', 'fadil@gmail.com', 'jakarta', '', '', 'pembeli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`) VALUES
(8, 'PERTANIAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE `tb_login` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','penjual') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'febry', 'febry', '9e6c7aa46d753cd6216c616bf06ec573', 'penjual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjual`
--

CREATE TABLE `tb_penjual` (
  `penjual_id` int(11) NOT NULL,
  `penjual_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `penjual_telp` varchar(20) NOT NULL,
  `penjual_email` varchar(50) NOT NULL,
  `penjual_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penjual`
--

INSERT INTO `tb_penjual` (`penjual_id`, `penjual_name`, `username`, `password`, `penjual_telp`, `penjual_email`, `penjual_address`) VALUES
(1, '', '', '', '', '', ''),
(2, 'Alex', '', 'alex11', '082277654318', 'alex@gmail.com', 'Sidikalang'),
(3, 'Febry Siregar', 'febry', 'febry', '082260934706', 'febrysiregar3@gmail.com', 'Sidikalang'),
(4, 'Lisa', 'lisa', 'ed14f4a4d7ecddb6dae8e54900300b1e', '08222999909', 'lisa@gmail.com', 'sdad');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `penjual_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `berat_produk` varchar(100) NOT NULL,
  `stok_produk` int(5) NOT NULL,
  `product_descrption` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `alamat_pemilik` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `category_id`, `penjual_id`, `product_name`, `product_price`, `berat_produk`, `stok_produk`, `product_descrption`, `product_image`, `alamat_pemilik`, `no_telepon`, `product_status`, `date_created`) VALUES
(2, 8, 15, 'Ubi Jalar', 9000, '1 KG', 65, '<p>Ubi Jalar Dengan Harga Satuan ( Kg )</p>\r\n', 'produk1656071439.jpg', 'Balige', 'https://api.whatsapp.com/send?phone=6285220832295 &text= Hai, saya tertarik dengan produk Anda.', 1, '2022-06-24 18:57:01'),
(4, 8, 15, 'Kacang Tanah', 18000, '1 KG', 300, '<p>Kacang Tanah Kualitas Bagus Dengan Harga Satuan ( Kg )</p>\r\n', 'produk1656056083.jpg', 'Balige', 'https://api.whatsapp.com/send?phone=6285220832295 &text= Hai, saya tertarik dengan produk Anda.', 1, '2022-06-24 18:57:06'),
(5, 8, 15, 'Kedelai', 18500, '1 KG', 88, '<p>Kacang Kedelai Berkualitas Dengan Harga Satuan ( Kg )</p>\r\n', 'produk1656056069.jpg', 'Balige', 'https://api.whatsapp.com/send?phone=6285220832295 &text= Hai, saya tertarik dengan produk Anda.', 1, '2022-06-24 18:57:12'),
(6, 8, 15, 'Beras Putih', 17500, '1 Kg', 95, '<p>Beras Putih Berkualitas Dengan Harga Satuan ( Kaleng )</p>\r\n', 'produk1656071427.jpg', 'Balige', 'https://api.whatsapp.com/send?phone=6285220832295 &text= Hai, saya tertarik dengan produk Anda.', 1, '2022-06-24 18:57:16'),
(7, 8, 23, 'Bawang Merah', 14500, '1 Kg', 1599, '<p>Bawang Merah Berkualitas Dengan Harga Satuan ( Kg )</p>\r\n', 'produk1656069269.jpg', '', 'https://api.whatsapp.com/send?phone=6285220832295 &text= Hai, saya tertarik dengan produk Anda.', 1, '2022-06-24 18:57:19'),
(14, 8, 23, 'Cabe Merah', 7500, '1 Kg', 2999, 'Cabai merah harga satuan per Kg', 'produk1656008547.jpg', '', 'https://api.whatsapp.com/send?phone=6285220832295 &text= Hai, saya tertarik dengan produk Anda.', 1, '2022-06-24 18:57:21'),
(21, 8, 15, 'qwq', 12, '12', 12, '<p>weq</p>\r\n', 'produk1656098022.jpg', '', 'https://api.whatsapp.com/send?phone=6285220832295 &text= Hai, saya tertarik dengan produk Anda.', 1, '2022-06-24 19:13:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','penjual') NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `level`, `nama_lengkap`, `no_telepon`, `email`, `alamat`) VALUES
(1, 'Alexsipayung', 'alex', 'admin', 'Alex Leo Nardo Sipayung', '082277654318', 'alexsipayung00@gmail.com', 'Sidikalang'),
(2, 'Febry Sukanita', 'user', 'penjual', 'Febry Sukanita Siregar', '082260934706', 'febrysiregar3@gmail.com', 'Balige'),
(3, 'Febry', 'febry', 'penjual', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`idcheckout`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_penjual`
--
ALTER TABLE `tb_penjual`
  ADD PRIMARY KEY (`penjual_id`);

--
-- Indeks untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `checkout`
--
ALTER TABLE `checkout`
  MODIFY `idcheckout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_penjual`
--
ALTER TABLE `tb_penjual`
  MODIFY `penjual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
