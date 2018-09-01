-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2018 at 07:51 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afichastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(45) DEFAULT NULL,
  `activation_token` varchar(255) DEFAULT NULL,
  `aktif` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `gambar`, `alamat`, `telepon`, `activation_token`, `aktif`) VALUES
(3, 'Edi Siswanto', 'edisiswanto.ti8.poliwangi@gmail.com', '$2y$10$yWTdbzvFoEfWR/XzaFf5SuG1kON81BMvNIbZOdQTuwG.ZvxO1poS2', 'NneRlcVVPGEgDjHRXKAXKyNwrOaVj5vQC71tSjDTDCJqTQg5gP6r51vyFcvG', '2018-03-31', '2018-06-03', 'edi-siswanto.jpg', 'Banyuwangi', '082302002407', '7jp01h1bwDxTWJKq6sQsHIKg09z0vIiy3ygTjboQm404xTYRgqG72KaJuvakGpQepKJ736ktgsABNXtyBM7y70vgmHKZtjg8CoqqI31vjttmXJ4ugL3ktoGVxDYZpl3ntpyLeWwLpBWam1P23fmMD90KApk3CCR4WNZueJUj3T4m3H2cC4xocdKZg8tav48mfOTbQuTrU60J0lRpeKGikx1ff0TjiCCwrXThK4jepqpMI6dSUvHCLCnCwGNkzDW', 1),
(4, 'Wildan', 'kursuswebid@gmail.com', '$2y$10$oGKUaqoV3WYUvPwfUssG.OuHwhxmxLkfSzCiq30lDMLLBz.r5NuKO', 'nKAXn963IG8ACnrgQ9z1iZbkj1v0ZMl39yP78k5ho2x1navB4Ch5WDYzxEVo', '2018-06-03', '2018-06-28', 'wildan.jpg', 'Banyuwangi', '081123456789', 'cA8VAvdPQJhCxGCVkG2gkd0pDHcRtOrbFXsUa7ltVTaWAAyUS3iVzU7KmSxqGN8AWA1FD4wWTGL7pz1UCA9cIDX9aH6IvIfKge3p6qAc2b6FAlOauewV7Lt52tw5DS04ogLF3VPYWJ2C8IkCpjgf6AYGO5Yz4FbOrxywohPUupUBFfGHRxhOVkBe3OKCFTnRZoNzqvB8ODiKJpUayT5mRIrjeIX9Eb4ws4PAAYctE2AjmzqDUazFowjG8VGdaj9', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(5) NOT NULL,
  `sebagai` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `provinsi` int(3) NOT NULL,
  `kabupaten` int(5) NOT NULL,
  `n_kabupaten` varchar(100) NOT NULL,
  `n_provinsi` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`id`, `pelanggan_id`, `sebagai`, `nama`, `telepon`, `kode_pos`, `provinsi`, `kabupaten`, `n_kabupaten`, `n_provinsi`, `alamat`) VALUES
(13, 9, 'Alamat Rumah', 'Raharjo', '08112345678', '1234567', 1, 128, 'Gianyar', 'Bali', 'ds. bali - bali utara dekat pom'),
(14, 9, 'tes ongkir', 'jember', '12345678', '123456', 11, 160, 'Jember', 'Jawa Timur', 'jember');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id` int(11) NOT NULL,
  `pemesanan_id` int(5) NOT NULL,
  `produk_id` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `size` varchar(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id`, `pemesanan_id`, `produk_id`, `jumlah`, `size`, `keterangan`) VALUES
(25, 24, 1, 3, 'L', 'KOSONG'),
(26, 24, 5, 1, 'L', 'KOSONG'),
(27, 25, 1, 1, 'L', 'KOSONG'),
(28, 25, 4, 1, 'L', 'KOSONG'),
(29, 25, 5, 1, 'L', 'KOSONG'),
(30, 26, 4, 3, 'L', 'KOSONG');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(45) DEFAULT NULL,
  `tipe` varchar(45) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `link` varchar(110) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date NOT NULL,
  `tampil` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `tipe`, `nama`, `link`, `judul`, `created_at`, `updated_at`, `tampil`) VALUES
(1, NULL, NULL, 'Baju', 'baju', NULL, '2018-05-05', '2018-05-05', 1),
(10, NULL, NULL, 'Sepatu', 'sepatu', NULL, '2018-05-04', '2018-05-04', 1),
(14, NULL, NULL, 'Celana', 'celana', NULL, '2018-05-05', '2018-05-05', 1),
(15, NULL, NULL, 'Rok', 'rok', NULL, '2018-05-05', '2018-05-05', 1),
(16, NULL, NULL, 'Tas', 'tas', NULL, '2018-05-08', '2018-05-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id` int(5) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `invoice` int(6) NOT NULL,
  `gambar` varchar(20) DEFAULT NULL,
  `konfirmasi` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id`, `created_at`, `updated_at`, `invoice`, `gambar`, `konfirmasi`) VALUES
(1, '2018-05-24', '2018-05-24', 164123, '164123.jpg', 1),
(2, '2018-06-26', '2018-06-26', 164764, '164764.jpg', 1),
(3, '2018-06-26', '2018-06-26', 868438, '868438.jpg', 0),
(4, '2018-07-11', '2018-07-11', 41870, '41870.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text,
  `teks` text,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `deskripsi`, `teks`, `alamat`, `telepon`, `email`, `facebook`, `website`, `gambar`) VALUES
(1, 'Aficha Store', 'Butik Aficha Melayani penjualan  Busana Bagus  Modern, Aman dan terpercaya.  Butik Aficha bertempat di sanggar kabupaten Banyuwangi.', '<p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel.</p>\r\n\r\n<p>Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>\r\n\r\n<p>Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue.</p>\r\n\r\n<p>Nam elit agna,endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl.</p>\r\n', 'Sanggar - Banyuwangi', '081123456789', 'web.cikagoid@gmail.com', 'afichastore.id', 'afichastore.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_18_125623_entrust_setup_tables', 2),
(4, '2018_03_26_162203_add_activation_columund_to_user', 3),
(5, '2018_05_09_012156_create_shoppingcart_table', 3),
(6, '2018_05_19_064321_create_provinsi_table', 3),
(7, '2018_05_19_065608_create_provinces_table', 4),
(8, '2018_05_19_064541_create_cities_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('edisiswanto.ti8.poliwangi@gmail.com', '2fc1fcae6ec37e06d9839e2a6f389676b6a57a8cc1e084d783fb451dd657986c', '2018-05-23 22:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(5) NOT NULL,
  `invoice` varchar(10) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `pelanggan_id` int(5) DEFAULT NULL,
  `alamat_id` int(3) DEFAULT NULL,
  `jumlah` int(10) DEFAULT '0',
  `total` int(50) DEFAULT '0',
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `ongkir` int(11) NOT NULL,
  `kurir` varchar(50) DEFAULT NULL,
  `layanan` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `konfirmasi` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `invoice`, `created_at`, `updated_at`, `pelanggan_id`, `alamat_id`, `jumlah`, `total`, `kabupaten`, `provinsi`, `ongkir`, `kurir`, `layanan`, `keterangan`, `konfirmasi`) VALUES
(24, '41870', '2018-07-11', '2018-07-11', 9, 13, 4, 3100000, NULL, NULL, 25000, 'pos', 'Paket Kilat Khusus(Paket Kilat Khusus)', '', 1),
(25, '973022', '2018-07-11', '2018-07-11', 9, 13, 3, 1200000, NULL, NULL, 25000, 'pos', 'Paket Kilat Khusus(Paket Kilat Khusus)', '', 0),
(26, '498474', '2018-07-11', '2018-07-11', 9, 14, 3, 3000, NULL, NULL, 38000, 'pos', 'Paket Kilat Khusus(Paket Kilat Khusus)', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `teks` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `berat` float NOT NULL,
  `harga` int(11) DEFAULT '0',
  `dilihat` int(11) DEFAULT NULL,
  `tampil` int(11) DEFAULT '1',
  `kategori_id` int(11) DEFAULT NULL,
  `stok` int(5) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `link`, `judul`, `teks`, `created_at`, `updated_at`, `gambar`, `berat`, `harga`, `dilihat`, `tampil`, `kategori_id`, `stok`) VALUES
(1, 'Gaun Pengantin', 'gaun-pengantin', 'Gaun Pengantin', '<p><strong>Khimar Arzetta</strong>&nbsp;merupakan Produk terhits saat ini. Hadir dengan gaya simpel, syari, dan stylish. Cocok bagi wanita karir dan kaula muda. Dengan kombinasi warna yang mudah dipadu-padankan, membuat Anda tampil serasi dalam penampilan sehari-hari. Dengan jahitan halus dibagian kening, membuat Anda tampil rapi dan berkelas. Ciptakanlah daya tarik tersendiri ketika Anda menggunakannya. Perbedaan warna 5-10% dari foto akibatMenggunakan Jahitan Halus di bagian keningnya</p>\r\n\r\n<ul>\r\n	<li>Khimar ini menutup punggung Anda</li>\r\n	<li>Simple, syari, dan stylish</li>\r\n	<li>Instan Langsung Pakai</li>\r\n	<li>Ringan dan elegan</li>\r\n</ul>\r\n\r\n<p><strong>Detail Produk</strong></p>\r\n\r\n<ul>\r\n	<li>Menggunakan Jahitan Halus di bagian keningnya</li>\r\n	<li>Khimar ini menutup punggung Anda</li>\r\n	<li>Simple, syari, dan stylish</li>\r\n	<li>Perbedaan warna 5-10% dari foto akibat pencahayaan</li>\r\n</ul>\r\n', '2018-05-04', '2018-07-11', 'gaun-pengantin.jpg', 1500, 1000000, 18, 1, 1, 5),
(4, 'Gaun Pengantin Pria', 'gaun-pengantin-pria', 'Gaun Pengantin', '<p>Bahan tricot&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Set kimono dan dress</li>\r\n	<li>Lingkar dada dress 78 melar sampai 110</li>\r\n</ol>\r\n\r\n<p>Tersedia&nbsp;<br />\r\nwarna&nbsp;</p>\r\n\r\n<ul>\r\n	<li>hitam renda hitam , merah cabe, marun, biru</li>\r\n</ul>\r\n\r\n<p>List renda berubah ubah&nbsp;<br />\r\nCantumkan warna pd pesanan dan warna alternatif jika kosong ya<br />\r\nAtau tanyakan stok&nbsp;<br />\r\nTerima kasih..<br />\r\nSatu ukuran Allsize muat sampai xl</p>\r\n', '2018-05-05', '2018-07-11', 'gaun-pengantin-pria.jpg', 1300, 1000, 8, 1, 1, 3),
(5, 'Tas Eropa', 'tas-eropa', 'Tas Eropa', '<p>teks</p>\r\n', '2018-05-08', '2018-07-11', 'tas-eropa.jpg', 1000, 100000, 1, 1, 16, 7),
(6, 'Baju Pesta', 'baju-pesta', 'Baju Pesta', '<p>Baju Pesta</p>\r\n', '2018-05-09', '2018-07-11', 'baju-pesta.jpg', 1400, 100000, 2, 1, 1, 10),
(7, 'tes', 'tes', 'Gaun Pengantin', '<p>adasdasdsad</p>\r\n', '2018-07-11', '2018-07-11', 'tes.jpg', 500, 1000000, NULL, 1, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telepon` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8_unicode_ci,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gambar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `telepon`, `alamat`, `password`, `remember_token`, `created_at`, `updated_at`, `gambar`, `status`, `activation_token`) VALUES
(1, 'Edi Siswanto     ', 'edisiswanto.ti8.poliwangi@gmail.com', '081123456789', 'Sanggar, Banyuwangi', '$2y$10$wsZV2AlH4SXA0/K4mnZwrevhfmCcxLoYS7p3GpFQ0yxc7HC00qqua', 'rS79xYYZ6yCKnM60kzCHipZXHD9M6dQWGwb0qMVWPxTGnHLEncYyCrb7Y52r', '2018-03-27 23:30:15', '2018-05-23 21:14:38', 'edi-siswanto.jpg', 1, 'lxIiYTVsIE2mNXgKutKtwVZfX5yKL2h3qwhZqsYAEQvWr6ohJ5fGKVNuWdTAyM1XlUTZn8EjMPf3kxWKQjGs6njShnmar2leelzY4Z2Hx91K8u3fM72Q05B8EOkgAksbVe7hj2Y10cHSLDWLMIQJ0RIAgjT4ARMbFNBBsvFuTKZvt7SPG7LSneT8yZvv4AglsepJMggNGCwnbGHWminWW6ewqRzrsq9fZUt1VKgQefhrLyes6PSsONUyznBOA5z'),
(9, 'Antonio      ', 'kursuswebid@gmail.com', '081123456789', NULL, '$2y$10$ochmFZHb6UOXZRLxXGErzO.lt91GEX2fzRGedond9xcv5V6cnMLtO', '4tSVrc55UacO8QpreTmPqSRr8V0STSUU61Ihlts75Q0kYviYTtBZf8COV64C', '2018-06-26 00:20:51', '2018-07-11 10:37:27', 'antonio.jpg', 1, 'ODIzvapCNQLEg1ZEiu5NST8ju7t6s5LDtLC4wayTHX1Srw9j8fiwTKIjyATyqgPXxVn2RH3CNUDRund28uHsRsaZ6FXA2rUwnx4STFhde4l2z9Y2pihfdkoExjeDG9otourRUkkYduiNdpw0w7QZ2FKf9EdNFcnnGmsYX5s8sqT2yRaqodjBbbfNuvbyyBjDTpjRhvxOK5SVOO3D23Tu1CaqQ8nfLUH0TYuFF77hPB8Pm0b6qoCeTBdvuNInAt9'),
(11, 'cobapelanggan', 'cobapelanggan@gmail.com', '666', NULL, '$2y$10$twhA5wS8AG9ltbfVzwd4FufSUbq/crG47RAThvhnSH9AKidzl.KdS', NULL, '2018-06-28 09:26:51', '2018-06-28 09:30:03', NULL, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice` (`invoice`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
