-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 09:24 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_models`
--

CREATE TABLE `kategori_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_models`
--

INSERT INTO `kategori_models` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Produk Terbaru', NULL, NULL),
(2, 'Produk Terlaris', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_11_08_214740_add_paid_to_users', 1),
(4, '2021_11_09_152613_create_produks_table', 1),
(5, '2021_11_10_113516_create_transaksis_table', 1),
(6, '2021_11_10_113637_create_transaksi_details_table', 1),
(8, '2021_11_13_205710_add_paid_to_transaksis', 2),
(9, '2021_11_15_152942_add_pain_to_users_table', 3),
(10, '2021_11_21_213318_add_pain_to_transaksis_table', 4),
(11, '2021_11_22_143717_add_paid_to_produks_table', 5),
(13, '2021_11_25_230532_add_paid_to_produks_table', 6),
(14, '2021_11_25_230841_add_paid_to_users_table', 7),
(15, '2021_11_27_104856_add_paid_to_users_table', 8),
(16, '2021_11_28_015756_add_paid_to_produks_table', 9),
(17, '2021_11_30_035456_create_kategori_models_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stok` int(20) NOT NULL,
  `berat` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `views` int(11) DEFAULT NULL,
  `nama_toko` varchar(123) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `name`, `harga`, `deskripsi`, `kategori_id`, `image`, `created_at`, `updated_at`, `stok`, `berat`, `user_id`, `views`, `nama_toko`) VALUES
(1, 'Baju rajut', '65000', 'Rajut', 1, '122021121422513-bajurajut.jpg', '2021-12-12 06:47:23', '2021-12-12 08:44:50', 1, 0, 17, NULL, 'Lady Fashion'),
(2, 'Wiska oneset', '135000', 'Katun', 6, '122021121457631-wiskaoneset.jpg', '2021-12-12 06:47:57', '2021-12-12 08:44:50', 1, 0, 17, NULL, 'Lady Fashion'),
(3, 'Pokita dress', '95000', 'Wolfis', 6, '122021121427972-pokitadress.jpg', '2021-12-12 06:48:27', '2021-12-12 08:44:50', 1, 0, 17, NULL, 'Lady Fashion'),
(4, 'Baggy pants', '75000', 'American drill', 1, '122021121457369-baggypants.jpg', '2021-12-12 06:48:57', '2021-12-12 08:44:50', 1, 0, 17, NULL, 'Lady Fashion'),
(5, 'Lulu shirt', '120000', 'Knit mix katun', 1, '122021121401404-lulushirt.jpg', '2021-12-12 06:52:01', '2021-12-12 08:44:50', 1, 0, 16, NULL, 'Hijacu Hijab'),
(6, 'Nala tunik', '13000', 'Rayon printing', 3, '122021121432555-nalatunik.jpg', '2021-12-12 06:52:32', '2021-12-12 08:44:50', 1, 0, 16, NULL, 'Hijacu Hijab'),
(7, 'Kemaja flannel', '125000', 'Flannel impor', 2, '122021121458518-kemejaflannel.jpg', '2021-12-12 06:52:58', '2021-12-12 08:44:50', 2, 0, 16, NULL, 'Hijacu Hijab'),
(8, 'Belle shirt', '120000', 'Crepe', 1, '122021121426330-belleshirt.jpg', '2021-12-12 06:53:26', '2021-12-12 08:44:50', 4, 0, 16, NULL, 'Hijacu Hijab'),
(9, 'Kemeja oversize', '140000', 'Banboo', 2, '122021121430762-kemejaoversize.jpg', '2021-12-12 06:56:30', '2021-12-12 08:44:50', 10, 0, 15, NULL, 'Irliana Shop'),
(10, 'Pocket jaket', '120000', 'Crinckle', 5, '122021121404236-jaketpocket.jpg', '2021-12-12 06:57:04', '2021-12-12 08:44:50', 3, 0, 15, NULL, 'Irliana Shop'),
(11, 'Kemeja burberry', '14000', 'Katun', 2, '122021121442110-kemejaburberry.jpg', '2021-12-12 06:57:42', '2021-12-12 08:44:50', 12, 0, 15, NULL, 'Irliana Shop'),
(12, 'Outer serut', '120000', 'Crinckle', 1, '122021121414380-outerserut.jpg', '2021-12-12 06:58:14', '2021-12-12 08:44:50', 2, 0, 15, NULL, 'Irliana Shop'),
(13, 'Jaket jeans', '110000', 'Jeans premium', 5, '122021121517831-jaketjeans.jpg', '2021-12-12 07:00:17', '2021-12-12 08:44:50', 3, 0, 14, NULL, 'Yuki Hijab'),
(14, 'Kemeja kotak', '129000', 'Katun', 2, '122021121510968-kemejakotak.jpg', '2021-12-12 07:01:10', '2021-12-12 08:44:50', 4, 0, 14, NULL, 'Yuki Hijab'),
(15, 'Kemeja kotak', '99000', 'Jeans premium', 2, '122021121544115-kulotjeans.jpg', '2021-12-12 07:01:44', '2021-12-12 08:44:50', 2, 0, 14, NULL, 'Yuki Hijab'),
(16, 'Blouse', '129000', 'Katun', 5, '122021121508879-blouse.jpg', '2021-12-12 07:02:08', '2021-12-12 08:44:50', 5, 0, 14, NULL, 'Yuki Hijab'),
(17, 'Jilbab plisket', '40000', 'Ceruty babydoll', 3, '122021121545346-pasminaplisket.jpg', '2021-12-12 07:03:45', '2022-01-23 03:59:19', 0, 0, 13, NULL, 'Nurul Hijab'),
(18, 'Annisa hijab', '45000', 'Jersey premium', 3, '122021121537324-Annisainstan.jpg', '2021-12-12 07:04:37', '2022-01-23 04:53:33', 0, 0, 13, NULL, 'Nurul Hijab'),
(19, 'Pasmina inner', '40000', 'Ceruty babydoll', 3, '122021121513665-pasminaceruty.jpg', '2021-12-12 07:05:13', '2021-12-12 08:57:35', 3, 0, 13, NULL, 'Nurul Hijab'),
(20, 'Hijab voal watersplash', '45000', 'Voal', 3, '12202112154297-hijabvoal.jpg', '2021-12-12 07:05:42', '2021-12-12 08:57:35', 4, 0, 13, NULL, 'Nurul Hijab'),
(24, 'gamis plisket', '95000', 'bahan : moscrape\r\nukuran : all size fit to L', 6, '012022160850276-gamisplisket.PNG', '2022-01-16 01:47:50', '2022-01-16 01:47:50', 6, 1, 17, NULL, 'Lady Fashion'),
(25, 'gamis pokita', '95000', 'bahan : moscrape\r\nukuran : all size fit to L', 6, '012022160822334-gamispokita.PNG', '2022-01-16 01:49:22', '2022-01-16 01:49:22', 10, 1, 17, NULL, 'Lady Fashion'),
(26, 'gamis rayon motif', '110000', 'bahan : rayon\r\nukuran : all size fit to xl', 6, '012022160852536-gamisrayonmotif.PNG', '2022-01-16 01:50:52', '2022-01-16 01:50:52', 7, 1, 17, NULL, 'Lady Fashion'),
(27, 'gamis susun renda', '95000', 'bahan : moscrape\r\nukuran : all size fit to L', 6, '012022160821438-gamissusunrenda.PNG', '2022-01-16 01:52:21', '2022-01-16 01:52:21', 9, 1, 17, NULL, 'Lady Fashion'),
(28, 'gamis adelia', '110000', 'bahan : moscrape\r\nukuran : all size fit to L', 6, '012022160808561-gamis.PNG', '2022-01-16 01:54:08', '2022-01-16 01:54:08', 6, 1, 17, NULL, 'Lady Fashion'),
(29, 'oneset viscos', '130000', 'bahan : rayon\r\nukuran : all size fit to L', 6, '012022160828936-oneset.PNG', '2022-01-16 01:55:28', '2022-01-16 01:55:28', 4, 1, 17, NULL, 'Lady Fashion'),
(30, 'deena top', '109000', 'bahan : kit mix denim\r\nukuran : all size fit to XL', 1, '012022160856387-deenatop,109rb,knitmixdenim,fittoXL.PNG', '2022-01-16 01:57:56', '2022-01-16 01:57:56', 6, 1, 16, NULL, 'Hijacu Hijab'),
(31, 'keenan midi dress', '140000', 'bahan : rayon printing\r\nukuran : all size fit to XL', 6, '012022160816722-keenanmididress,140rb,rayonprinting,fittoXL.PNG', '2022-01-16 01:59:16', '2022-01-16 01:59:16', 5, 1, 16, NULL, 'Hijacu Hijab'),
(32, 'midi dress polka', '145000', 'bahan : catton\r\nukuran : all size fit to L', 6, '012022160924464-mididresspolka,145rb,catton,fittoL.PNG', '2022-01-16 02:00:24', '2022-01-16 02:00:24', 6, 1, 16, NULL, 'Hijacu Hijab'),
(33, 'kemeja naya', '105000', 'bahan : cornskin\r\nukuran : all size fit to XL', 2, '012022160959437-kemejanaya105rbbahancornskinfittoxl.PNG', '2022-01-16 02:01:59', '2022-01-16 02:01:59', 7, 1, 16, NULL, 'Hijacu Hijab'),
(34, 'milana dress', '145000', 'bahan : rayon premium\r\nukuran : all size fit to XL', 6, '01202216090253-milanadress,premiumcattonrayon,145rb,fittoXL.PNG', '2022-01-16 02:03:02', '2022-01-16 02:03:02', 10, 1, 16, NULL, 'Hijacu Hijab'),
(35, 'nola basic tunik', '125000', 'bahan : knit\r\nukuran : all size fit to XL', 6, '012022160920269-nolabasictunik,125rb,knit,fittoXL.PNG', '2022-01-16 02:05:20', '2022-01-16 02:05:20', 10, 1, 16, NULL, 'Hijacu Hijab'),
(36, 'amelia oneset', '145000', 'bahan : katun\r\nukuran : all size fit to L', 6, '012022160917671-ameliaoneset,145rb,katun,fittoL.PNG', '2022-01-16 02:22:17', '2022-01-16 02:22:17', 6, 1, 15, NULL, 'Irliana Shop'),
(37, 'gamis', '170000', 'bahan : katun\r\nukuran : all size fit to XL', 6, '012022160955562-gamis,katun,170rb,fittoXL.PNG', '2022-01-16 02:22:55', '2022-01-16 02:22:55', 12, 1, 15, NULL, 'Irliana Shop'),
(38, 'kemeja motif', '105000', 'bahan : katun\r\nukuran : all size fit to L', 2, '01202216095316-kemejamotif,105rb,katunrayon,fittoL.PNG', '2022-01-16 02:24:53', '2022-01-16 02:24:53', 6, 1, 15, NULL, 'Irliana Shop'),
(39, 'kemeja', '105000', 'bahan : katun\r\nukuran : all size fit to L', 2, '01202216095490-kemeja,105rb,katunrayon,fittoL.PNG', '2022-01-16 02:25:54', '2022-01-16 02:25:54', 6, 1, 15, NULL, 'Irliana Shop'),
(40, 'midi dress', '160000', 'bahan : katun\r\nukuran : all size fit to XL', 6, '012022160946566-mididress,160rb,katun,fitttoXL.PNG', '2022-01-16 02:26:46', '2022-01-16 02:26:46', 12, 1, 15, NULL, 'Irliana Shop'),
(41, 'tunik polka', '120000', 'bahan : katun\r\nukuran : all size fit to XL', 6, '012022160942897-tunikpolka,120rb,katun,fittoXL.PNG', '2022-01-16 02:27:42', '2022-01-16 02:27:42', 6, 1, 15, NULL, 'Irliana Shop'),
(42, 'manset', '35000', 'bahan : jersey\r\nukuran : all size fit to L', 4, '012022160926970-IMG-20220111-WA0021.jpg', '2022-01-16 02:30:26', '2022-01-16 02:30:26', 12, 1, 13, NULL, 'Nurul Hijab'),
(43, 'hijab sport', '35000', 'bahan : katun\r\nukuran : m', 3, '012022160901955-IMG-20220111-WA0023.jpg', '2022-01-16 02:32:01', '2022-01-16 02:32:01', 12, 1, 13, NULL, 'Nurul Hijab'),
(44, 'hijab motif', '45000', 'hijab motif', 3, '012022160959563-IMG-20220111-WA0029.jpg', '2022-01-16 02:33:59', '2022-01-16 02:33:59', 12, 1, 13, NULL, 'Nurul Hijab'),
(45, 'ciput inner', '25000', 'ciput inner', 3, '012022160909556-IMG-20220111-WA0033.jpg', '2022-01-16 02:35:09', '2022-01-16 02:35:09', 12, 1, 13, NULL, 'Nurul Hijab'),
(46, 'manset leher', '25000', 'manset leher', 4, '012022160912387-IMG-20220111-WA0031.jpg', '2022-01-16 02:36:12', '2022-01-16 02:36:12', 12, 1, 13, NULL, 'Nurul Hijab'),
(47, 'hijab bella square', '25000', 'bella square', 3, '01202216091431-IMG-20220111-WA0024.jpg', '2022-01-16 02:37:14', '2022-01-16 02:37:14', 20, 1, 13, NULL, 'Nurul Hijab'),
(48, 'bella square', '25000', 'bella square', 3, '012022160916638-IMG-20220111-WA0002.jpg', '2022-01-16 02:39:16', '2022-01-16 02:39:16', 20, 1, 14, NULL, 'Yuki Hijab'),
(49, 'hijab sport', '35000', 'hujab sport', 3, '012022160954747-IMG-20220111-WA0008.jpg', '2022-01-16 02:39:54', '2022-01-16 02:39:54', 12, 1, 14, NULL, 'Yuki Hijab'),
(50, 'bella square motif', '35000', 'bella square motif', 3, '012022160957784-IMG-20220111-WA0018.jpg', '2022-01-16 02:40:57', '2022-01-16 02:40:57', 12, 1, 14, NULL, 'Yuki Hijab'),
(51, 'kulot jeans', '135000', 'kulot jeans', 1, '012022160951246-IMG-20220111-WA0012.jpg', '2022-01-16 02:41:51', '2022-01-16 02:41:51', 6, 1, 14, NULL, 'Yuki Hijab'),
(52, 'jeans', '135000', 'jeans', 1, '012022160931559-IMG-20220111-WA0014.jpg', '2022-01-16 02:42:31', '2022-01-16 02:42:31', 6, 1, 14, NULL, 'Yuki Hijab'),
(53, 'hijab syar\'i', '45000', 'hijab syar\'i', 3, '01202216093396-IMG-20220111-WA0017.jpg', '2022-01-16 02:43:33', '2022-01-16 02:43:33', 6, 1, 14, NULL, 'Yuki Hijab');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kode_payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_item` int(10) UNSIGNED NOT NULL,
  `total_harga` bigint(20) UNSIGNED NOT NULL,
  `kode_unik` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jasa_pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkir` int(10) UNSIGNED NOT NULL,
  `total_transfer` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toko_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `user_id`, `kode_payment`, `kode_trx`, `total_item`, `total_harga`, `kode_unik`, `status`, `resi`, `kurir`, `phone`, `name`, `detail_lokasi`, `deskripsi`, `metode`, `expired_at`, `created_at`, `updated_at`, `jasa_pengiriman`, `ongkir`, `total_transfer`, `bank`, `bukti_transfer`, `toko_id`) VALUES
(3, 19, 'INV/PYM/2022-01-12/330', 'INV/PYM/2022-01-12/982', 1, 40000, 268, 'SELESAI', NULL, 'JNE', '0912793712', 'Dewi Astuti', 'Kos, Palopo, 91911, (Jl. Salobulo)', NULL, NULL, '2022-01-13 05:49:45', '2022-01-12 05:49:45', '2022-01-12 06:13:59', 'CTC', 6000, 46000, 'Bank BRI', '012022121218787-1641991813388_croppedImg.jpg', 13),
(4, 20, 'INV/PYM/2022-01-13/176', 'INV/PYM/2022-01-13/865', 1, 65000, 637, 'DIBAYAR', NULL, 'POS', '085296744230', 'Nur', 'Rumah, Palopo, 91911, (Jl. Jendral sudirman)', NULL, NULL, '2022-01-13 20:32:15', '2022-01-12 20:32:15', '2022-01-12 20:33:20', 'Paket Kilat Khusus', 7000, 72000, 'Bank Mandiri', '012022130320428-1642044795060_croppedImg.jpg', 17),
(5, 20, 'INV/PYM/2022-01-16/389', 'INV/PYM/2022-01-16/271', 1, 65000, 343, 'BATAL', NULL, 'TIKI', '085296744230', 'Nur', 'Rumah, Palopo, 91911, (Jl. Jendral sudirman)', NULL, NULL, '2022-01-16 17:27:37', '2022-01-15 17:27:37', '2022-01-15 17:29:26', 'REG', 6000, 71000, 'Bank BRI', NULL, 17),
(6, 20, 'INV/PYM/2022-01-17/566', 'INV/PYM/2022-01-17/327', 1, 25000, 277, 'SELESAI', NULL, 'POS', '085296744230', 'Nur', 'Rumah, Palopo, 91911, (Jl. Jendral sudirman)', NULL, NULL, '2022-01-18 14:41:01', '2022-01-17 14:41:01', '2022-01-17 14:50:55', 'Pos Instan Barang', 10000, 35000, 'Bank BRI', '012022172153913-1642455720233_croppedImg.jpg', 13),
(7, 20, 'INV/PYM/2022-01-18/749', 'INV/PYM/2022-01-18/220', 1, 45000, 458, 'DIBAYAR', NULL, 'JNE', '085296744230', 'Nur', 'Rumah, Palopo, 91911, (Jl. Jendral sudirman)', NULL, NULL, '2022-01-19 04:50:08', '2022-01-18 04:50:08', '2022-01-18 04:51:13', 'CTC', 6000, 51000, 'Bank BRI', '012022181113100-1642506651537_croppedImg.jpg', 15),
(12, 19, 'INV/PYM/2022-01-23/353', 'INV/PYM/2022-01-23/480', 4, 160000, 574, 'MENUNGGU', NULL, 'POS', '0912793712', 'Dewi Astuti', 'Kos, Palopo, 91911, (Jl. Salobulo)', NULL, NULL, '2022-01-24 03:59:19', '2022-01-23 03:59:19', '2022-01-23 03:59:19', 'Paket Kilat Khusus', 7000, 167000, 'Bank Mandiri', NULL, 13),
(13, 19, 'INV/PYM/2022-01-23/550', 'INV/PYM/2022-01-23/580', 1, 45000, 229, 'MENUNGGU', NULL, 'JNE', '0912793712', 'Dewi Astuti', 'Kos, Palopo, 91911, (Jl. Salobulo)', NULL, NULL, '2022-01-24 04:10:49', '2022-01-23 04:10:49', '2022-01-23 04:10:49', 'CTC', 6000, 51000, 'Bank BRI', NULL, 13),
(14, 19, 'INV/PYM/2022-01-23/344', 'INV/PYM/2022-01-23/528', 1, 45000, 775, 'MENUNGGU', NULL, 'JNE', '0912793712', 'Dewi Astuti', 'Kos, Palopo, 91911, (Jl. Salobulo)', NULL, NULL, '2022-01-24 04:53:33', '2022-01-23 04:53:33', '2022-01-23 04:53:33', 'CTC', 6000, 51000, 'Bank Mandiri', NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_details`
--

CREATE TABLE `transaksi_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL,
  `total_item` int(10) UNSIGNED NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_harga` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_details`
--

INSERT INTO `transaksi_details` (`id`, `transaksi_id`, `produk_id`, `total_item`, `catatan`, `total_harga`, `created_at`, `updated_at`) VALUES
(2, 2, 17, 2, 'Ceruty babydoll', 80000, '2022-01-12 05:36:50', '2022-01-12 05:36:50'),
(3, 3, 17, 1, 'Ceruty babydoll', 40000, '2022-01-12 05:49:45', '2022-01-12 05:49:45'),
(4, 4, 1, 1, 'Rajut', 65000, '2022-01-12 20:32:15', '2022-01-12 20:32:15'),
(5, 5, 1, 1, 'Rajut', 65000, '2022-01-15 17:27:37', '2022-01-15 17:27:37'),
(6, 6, 47, 1, 'bella square', 25000, '2022-01-17 14:41:01', '2022-01-17 14:41:01'),
(7, 7, 18, 1, 'Jersey premium', 45000, '2022-01-18 04:50:08', '2022-01-18 04:50:08'),
(8, 12, 17, 4, 'Ceruty babydoll', 160000, '2022-01-23 03:59:19', '2022-01-23 03:59:19'),
(9, 13, 18, 1, 'Jersey premium', 45000, '2022-01-23 04:10:49', '2022-01-23 04:10:49'),
(10, 14, 18, 1, 'Jersey premium', 45000, '2022-01-23 04:53:33', '2022-01-23 04:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `fcm`, `alamat`, `nama_toko`, `user_id`, `image`, `views`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$10$/YyOst8hRSq2BcL8bu47QubfFyDbe9MUTKL2zlJPkVB.sBfWXmPZ6', NULL, '2021-11-25 16:35:48', '2022-01-16 04:58:11', '09187231', NULL, 'Palopo', 'Bibit Singapura', 'admin', NULL, NULL),
(12, 'Adi M', 'adi@gmail.com', NULL, '$2y$10$/H9ReNZ6gmSPpYKPxmRVjOhDUhBPhLZeQ5AZwN7ha1.e5oHqY4AXK', NULL, '2021-12-01 22:25:48', '2021-12-01 22:25:48', '081236715273', 'fKKomZmjRsu1m_dfQuxJe4:APA91bHnzTcWjVMQfOcGyZks1QerpfbWglvNZUIOrT9-stFiypdnltXFcbQb6UlGThOmH076048fewgQcX9Q44KjXFbPrPd13ISbXx0OMwAqEuDO2_FavAZddpoDZDnkwSZSHrxAEUpe', 'jl. Pongsimpin', NULL, 'user', NULL, NULL),
(13, 'Nurul Hijab', 'nurulhijab@gmail.com', NULL, '$2y$10$UIx1DHblr2bWhr8Dd2WppeDJgtE9vNBtQqNumGh3aH9Sarh7aavK6', NULL, '2021-12-12 06:17:40', '2022-01-23 03:30:49', '08172351223', NULL, 'jl. Pongsimpin', 'Nurul Hijab', 'seller', '122021291042438-nurulhijablogo.jpg', NULL),
(14, 'Yuki Hijab', 'yukihijab@gmail.com', NULL, '$2y$10$Ol786rxzFZx7KGZa2yxRa.JMg.1rP27Tw/6hsZ5FfB0roFEkSi00C', NULL, '2021-12-12 06:22:14', '2022-01-16 02:38:11', '081263712', NULL, 'jl. Ahmad dahlan no.73', 'Yuki Hijab', 'seller', '122021291356373-yukihijablogo.png', NULL),
(15, 'Irliana Shop', 'irlianashop@gmail.com', NULL, '$2y$10$tRluV0JyAG3VvhdARaEDQe6GPV3agPmJ4bqf.W7idxaU5kZHURHCq', NULL, '2021-12-12 06:23:34', '2022-01-16 02:15:01', '08126312', NULL, 'jl. Kelapa', 'Irliana Shop', 'seller', '12202129140970-irlianalogo.jpg', NULL),
(16, 'Hijacu Hijab', 'hijacuhijab@gmail.com', NULL, '$2y$10$rDhEA4aMUUk/qwFChgA3Mu5pXoVknE40sqWWe75KzRif5WB7zyuTi', NULL, '2021-12-12 06:24:37', '2022-01-16 01:56:34', '0812361827', NULL, 'jl. Merdeka', 'Hijacu Hijab', 'seller', '122021291450285-hijacuhijablogo.jpg', NULL),
(17, 'Lady Fashion', 'ladyfashion@gmail.com', NULL, '$2y$10$RFD/xhxp5p2DjLhxXEdJv./9IOBpsCCOC9ODCrwpEID8QH.YYhLqq', NULL, '2021-12-12 06:25:36', '2022-01-17 05:40:31', '0812376182', NULL, 'jl. Kartini', 'Lady Fashion', 'seller', '122021291417550-ladyfashionlogo.jpg', NULL),
(19, 'Adi Murdayani', 'adi123@gmail.com', NULL, '$2y$10$J238AkuOa9AZSaG3pvXiFeHBHwYiVFr288TGxDdrMhIZR4qrGDBHa', NULL, '2022-01-12 05:35:05', '2022-01-12 05:35:05', '08126317872', 'eW2w7-RQRle4BT3z8X-2M3:APA91bHw8MWjX5xE3PZ-PVeC4-DCkDgvS56agdYVQ6llkq3dJyWNLzcKsBnR5RKJKnM5zKadfjm8o16UtFZoZP7suW0j59ftwip7Ax-pfejU53c8uGoIgefMlf-e3JtV6GflIP3EMTHm', NULL, NULL, 'user', NULL, NULL),
(20, 'nur', 'basrinurmiati@gmail.com', NULL, '$2y$10$nW1hPExDfEEj6LSMc4F8T.wVP.6C2ejB8o4z8pYYom3OTosSxBSG2', NULL, '2022-01-12 20:29:56', '2022-01-12 20:29:56', '085296744230', 'cexTMGxmT7aV0SBz6UVpmU:APA91bFx-ULtqx9JaeWq_kuvVYUo7ziaVsfQsSo1ngzjwNw6iWz2XYROQDCao76zhmpW78XBiTfFjaGZ4_jzzyBTb4_7XLIWaxoefq5s5ZIaI13IEi2A7U-DlgTFmXOXxMD_p77w33_K', NULL, NULL, 'user', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_models`
--
ALTER TABLE `kategori_models`
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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_details`
--
ALTER TABLE `transaksi_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_models`
--
ALTER TABLE `kategori_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaksi_details`
--
ALTER TABLE `transaksi_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
