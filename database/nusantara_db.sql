-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2017 at 11:41 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nusantara`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch_office`
--

CREATE TABLE `branch_office` (
  `id` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `side_description` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `thumbnail` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `office_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `is_active` int(1) DEFAULT NULL,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branch_office`
--

INSERT INTO `branch_office` (`id`, `title`, `slug`, `side_description`, `description`, `thumbnail`, `office_name`, `address`, `is_active`, `meta_title`, `meta_keyword`, `meta_description`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'Nusantara BMW', 'nusantara-bmw', 'BMW Banjarmasin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'bmw-nusantara.jpg', 'BMW', 'Jl. A. Yani km 4,5 No. 330, Banjarmasin, Tlp : 0511 – 3275000', 1, 'Nusantara BMW', 'Nusantara BMW', 'Nusantara BMW', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(2, 'Nusantara Daihatsu', 'nusantara-daihatsu', 'Daihatsu Banjarmasin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'daihatsu.jpg', 'DAIHATSU', 'Jl. A. Yani km 4 No 323, Banjarmasin, Tlp : 0511-3264500', 1, 'Nusantara Daihatsu', 'Nusantara Daihatsu', 'Nusantara Daihatsu', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(3, 'Nusantara Ford', 'nusantara-ford', 'Ford Banjarmasin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ford.jpg', 'FORD', 'Jl. A. Yani km. 5,8 No. 499, Banjarmasin, Tlp : 0511 – 3271000', 1, 'Nusantara Ford', 'Nusantara Ford', 'Nusantara Ford', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(4, 'Nusantara KIA', 'nusantara-kia', 'Nusantara KIA Banjarmasin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'nusantara-kia-motors.jpg', 'KIA', 'Jl. A. Yani km. 7, Banjarmasin, Tlp : 0511 – 3268000', 1, 'Nusantara KIA', 'Nusantara KIA', 'Nusantara KIA', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(5, 'GM CHEVROLET', 'nusantara-gm-chevrolet', 'Nusantara Auto World Banjarmasin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'GM_CHEVROLET.jpg', 'CHEVROLET', 'Jl. A. Yani km. 7, Banjarmasin, Tlp : 0511 – 3268000', 1, 'GM CHEVROLET', 'GM CHEVROLET', 'GM CHEVROLET', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(6, 'HYUNDAI', 'nusantara-hyundai', 'Hyundai Banjarmasin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'hyundai.jpg', 'HYUNDAI', 'Jl. A. Yani km 6,8, Banjarmasin, Tlp : 0511 – 7480899', 1, 'HYUNDAI', 'HYUNDAI', 'HYUNDAI', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(7, 'MAZDA', 'nusantara-mazda', 'Mazda Banjarmasin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'mazda.jpg', 'MAZDA', 'Jl. A. Yani km 4,5 No. 330, Banjarmasin, Tlp : 0511 – 3275000', 1, 'MAZDA', 'MAZDA', 'MAZDA', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(8, 'MINI COOPER', 'nusantara-mini-cooper', 'Mini Cooper Jakarta Selatan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'MINI.jpg', 'MINI COOPER', 'Jl. Sultan Iskandar Muda No. 16 Arteri Pondok Indah Kebayoran Lama Jakarta Selatan', 1, 'Mini Cooper Jakarta Selatan', 'Mini Cooper Jakarta Selatan', 'Mini Cooper Jakarta Selatan', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(9, 'BODY REPAIR', 'nusantara-body-repair', 'Nusantara Bodyshop Palembang', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Nusantara_Bodyshop.jpg', 'BODY REPAIR', 'Jl.Tanjung Api Api no 99A, Palembang, Tlp : 0711 – 421930', 1, 'Nusantara Bodyshop Palembang', 'Nusantara Bodyshop Palembang', 'Nusantara Bodyshop Palembang', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `branch_office_images`
--

CREATE TABLE `branch_office_images` (
  `id` int(5) NOT NULL,
  `images` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_id` int(2) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(1) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branch_office_images`
--

INSERT INTO `branch_office_images` (`id`, `images`, `office_id`, `create_at`, `create_by`, `update_at`) VALUES
(57, '1.jpg', 1, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(58, '2.jpg', 1, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(59, '3.jpg', 1, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(60, '4.jpg', 1, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(61, '1.jpg', 2, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(62, '2.jpg', 2, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(63, '3.jpg', 2, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(64, '4.jpg', 2, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(65, '1.jpg', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(66, '2.jpg', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(67, '3.jpg', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(68, '4.jpg', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(69, '1.jpg', 4, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(70, '2.jpg', 4, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(71, '3.jpg', 4, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(72, '4.jpg', 4, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(73, '1.jpg', 5, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(74, '2.jpg', 5, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(75, '3.jpg', 5, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(76, '4.jpg', 5, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `branch_office_trans`
--

CREATE TABLE `branch_office_trans` (
  `id` int(5) NOT NULL,
  `title_description` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `latitude` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_office_id` int(5) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(1) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branch_office_trans`
--

INSERT INTO `branch_office_trans` (`id`, `title_description`, `address`, `latitude`, `longitude`, `branch_office_id`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'BMW Banjarmasin', 'Jl. A. Yani km 4,5 No. 330, Banjarmasin, Tlp : 0511 – 3275000', '-3.325843', '114.606069', 1, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(2, 'Daihatsu Banjarmasin', 'Jl. A. Yani km 4 No 323, Banjarmasin, Tlp : 0511-3264500', '-3.357053', '114.631762', 2, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(3, 'Ford Banjarmasin', 'Jl. A. Yani km. 5,8 No. 499, Banjarmasin, Tlp : 0511 – 3271000', '-3.328462', '114.608758', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(4, 'Ford Banjarbaru', 'Jl. A. Yani Km. 33 Banjarbaru Kalimantan Selatan Tlp. : 0511-7083000/740110', '-3.328462', '114.608758', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(5, 'Ford Balikpapan', 'Jl. Ruhuy Rahayu No.1 Ring Road, Balikpapan, Tlp : 0542 – 872788', '-1.240661', '116.875599', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(6, 'Ford Samarinda', 'Jl. M. Yamin No. 80, Samarinda, Tlp : 0541 - 737 070', '-0.463431', '117.150401', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(7, 'Ford Tanjung', 'Jl. Mabuun Raya No. 54 Tanjung Tlp : 0526 – 2021084', '3.408497', '101.198891', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(8, 'Ford Palangkaraya', 'Jl. Cilik Riwut KM 6, Palangkaraya Tlp: 0536-3231777', '-2.186860', '113.894756', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(9, 'Ford Jakarta Timur', 'Jl. MT. Haryono kav 29-30 Jakarta Timur 12820, Tlp: 021-8300313', '-6.242481', '106.860422', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(10, 'Ford Pemuda', 'Jl. Pemuda no 62, Rawamangun, Jakarta Timur, Tlp: 021-47880077', '-6.193081', '106.889924', 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(11, 'Ford Bekasi', 'Jl. A.Yani no 1, Bekasi Barat, Tlp: 021-34178000', NULL, NULL, 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(12, 'Ford Pontianak', 'Jl. Arteri Supadjo km.2, Pontianak, Tlp : 0561 – 723241', NULL, NULL, 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(13, 'Ford Bontang', 'Jl. Brigjend Katamso No. 30 Bontang, Tlp. 0548-26734', NULL, NULL, 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(14, 'Ford Batu Kajang', 'Jl. Negara Km. 145 Batu Kajang Kalimantan Timur', NULL, NULL, 3, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(15, 'Nusantara KIA Banjarmasin', 'Jl. A. Yani km. 7, Banjarmasin, Tlp : 0511 – 3268000', NULL, NULL, 4, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(16, 'Nusantara KIA Balikpapan', 'Jl. MT. Haryono No.88 Ring Road, Balikpapan, Tlp : 0542 – 877600', NULL, NULL, 4, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(17, 'Nusantara KIA Samarinda', 'Jl. Wahid Hasyim No. 40 Sempaja, Samarinda, Tlp : 0541 – 7100238', NULL, NULL, 4, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(18, 'Nusantara KIA Palangkaraya ', 'Jl. Tjilik Riwut km 2,5 Palangkaraya Tlp : 0536 – 3311361', NULL, NULL, 4, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(19, 'Nusantara Auto World Banjarmasin', 'Jl. A. Yani km. 7, Banjarmasin, Tlp : 0511 – 3268000', NULL, NULL, 5, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(20, 'Nusantara Auto World Balikpapan', 'Jl. MT. Haryono No.88 Ring Road, Balikpapan, Tlp : 0542 – 877600', NULL, NULL, 5, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(21, 'Nusantara Auto World Samarinda', 'Jl. A.W. Syahrani No.18 Samarinda, Tlp : 0541 – 7100238', NULL, NULL, 5, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(22, 'Nusantara Auto World Pluit', 'Jl. Raya Pluit Selatan No. 56-57 Jakarta Utara, Tlp : 021 - 6695377', NULL, NULL, 5, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(23, 'Hyundai Banjarmasin', 'Jl. A. Yani km 6,8, Banjarmasin, Tlp : 0511 – 7480899', NULL, NULL, 6, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(24, 'Hyundai Samarinda', 'Jl. M Yamin RT 27, Samarinda Timur, Tlp : 0541 - 797 2345', NULL, NULL, 6, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(25, 'Mazda Banjarmasin', 'Jl. A. Yani km 4,5 No. 330, Banjarmasin, Tlp : 0511 – 3275000', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Mazda Banjarmasin', 'Jl. A. Yani km 4,5 No. 330, Banjarmasin, Tlp : 0511 – 3275000', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(27, 'Mazda Banjarmasin', '(Pal 17) Jl. A. Yani km 17 Banjarmasin Tlp : 0511 – 6168082', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(28, 'Mazda Banjarbaru', 'Jl. A. Yani km 35,5 Banjarmasin, Tlp : 0511 – 7456622', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(29, 'Mazda Balikpapan', 'Jl. MT. Haryono No.88 Ring Road, Balikpapan, Tlp : 0542 – 877600', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(30, 'Mazda Palembang', 'JL. R. Sukamto No. 1336, Palembang, Tlp : 0711 – 825861', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(31, 'Mazda Palangkaraya', 'Jl. Cilik Riwut KM 3 Palangkaraya, Tlp:0536 - 3364321', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(32, 'Mazda Pacenongan', 'Jl. Pecenongan 32, Jakarta Pusat-10120, Tlp : 021 – 33212307', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(33, 'Mazda Suryopranoto', 'Jl. Suryapranoto no 77-79, Jakarta Pusat Tlp: 021-3840999', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(34, 'Mazda Serpong', 'Jl. Raya Serpong no 30 Pondok Jagung, Tangerang Tlp: 021- 32306234', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(35, 'Mazda Bintaro', 'Jl. Boulevard Bintaro Jaya Sektor 7 blok B7/D-02', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(36, 'Mazda BSD', 'Jl. Raya Serpong No.8 BSD Tlp: 021-5384455', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(37, 'Mazda Tangerang', 'Jl. MH. Thamrin No.9 Cikokol Tangerang, Banten Tlp: 021-55740099', NULL, NULL, 7, '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `company_award`
--

CREATE TABLE `company_award` (
  `id` int(5) NOT NULL,
  `office_name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `thumbnail` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `images` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_award`
--

INSERT INTO `company_award` (`id`, `office_name`, `thumbnail`, `images`, `is_active`, `meta_title`, `meta_keyword`, `meta_description`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'CHEVROLET', 'images.png', 'awards-banner.jpg', 1, 'GM CHEVROLET', 'GM CHEVROLET', 'GM CHEVROLET', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(2, 'KIA MOTOR', 'images.jpg', 'banner-awards-1.jpg', 1, 'KIA MOTOR', 'KIA MOTOR', 'KIA MOTOR', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `company_award_trans`
--

CREATE TABLE `company_award_trans` (
  `id` int(10) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `awards_id` int(5) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_award_trans`
--

INSERT INTO `company_award_trans` (`id`, `description`, `awards_id`, `create_at`, `update_at`) VALUES
(1, 'YEAR 2002 : 3RD WINNER OF THE BIG FINISH CONTEST', 1, '2016-12-26 04:30:32', '2016-12-26 04:30:32'),
(2, 'YEAR 2003 : 2ND WINNER OF THE BEST DEALER IN SALES OPERATION', 1, '2016-12-26 04:30:32', '2016-12-26 04:30:32'),
(3, 'YEAR 2003 : 2ND WINNER OF THE BIG FINISH CONTEST', 1, '2016-12-26 04:30:32', '2016-12-26 04:30:32'),
(4, 'YEAR 2004 : 2ND WINNER OF THE BEST DEALER IN FINANCE & ADMINISTRATION', 1, '2016-12-26 04:30:32', '2016-12-26 04:30:32'),
(5, 'YEAR 2004 : 2ND WINNER OF THE BEST DEALER IN SERVICE', 1, '2016-12-26 04:30:32', '2016-12-26 04:30:32'),
(6, 'YEAR 2004 : 3RD WINNER OF THE BEST DEALER IN SALES OPERATION', 1, '2016-12-26 04:30:32', '2016-12-26 04:30:32'),
(7, 'YEAR 2004 : 3RD WINNER OF THE GRAND MASTER', 1, '2016-12-26 04:30:32', '2016-12-26 04:30:32'),
(8, 'YEAR 2004 : 2ND WINNER OF THE BIG FINISH CONTEST', 1, '2016-12-26 04:30:32', '2016-12-26 04:30:32'),
(9, 'THE BEST SALES OF OUTSIDE JAVA DEALERS FOR YEAR 2001, 2002, 2003, 2004.', 2, '2016-12-26 04:30:32', '2016-12-26 04:30:32'),
(10, 'THE BEST IN SERVICE OPERATION YEAR 2003', 2, '2016-12-26 04:30:32', '2016-12-26 04:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `company_history`
--

CREATE TABLE `company_history` (
  `id` int(5) NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `side_description` text COLLATE utf8_unicode_ci,
  `year` int(4) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_history`
--

INSERT INTO `company_history` (`id`, `title`, `side_description`, `year`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'Sejarah Perusahaan 1975', NULL, 1975, 'Nusantara Indah Group memulai usahanya sebagai importir mobil dengan merk Morina, Chevrolet, Citroen, dan Alfra Romeo.', 'Sejarah Perusahaan 1975', 'Sejarah Perusahaan 1975', 'Sejarah Perusahaan 1975', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(2, 'Sejarah Perusahaan 1981', '', 1981, 'Nusantara Indah Group terpilih sebagai dealer resmi Mazda untuk Kalimantan Selatan dan Tengah dengan nama UD. Nusantara Indah', 'Sejarah Perusahaan 1981', 'Sejarah Perusahaan 1981', 'Sejarah Perusahaan 1981', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(3, 'Sejarah Perusahaan 1982', NULL, 1982, 'Nusantara Indah Group terpilih sebagai dealer resmi Isuzu untuk Kalimantan Selatan dan Tengah dengan nama PT. Surya Nusantara', 'Sejarah Perusahaan 1982', 'Sejarah Perusahaan 1982', 'Sejarah Perusahaan 1982', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(4, 'Sejarah Perusahaan 1985', NULL, 1985, 'Nusantara Indah Group terpilih sebagai dealer resmi utk Daihatsu di Kalimantan Selatan.', 'Sejarah Perusahaan 1985', 'Sejarah Perusahaan 1985', 'Sejarah Perusahaan 1985', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32'),
(5, 'Sejarah Perusahaan 1996', NULL, 1996, 'Nusantara Indah Group memutuskan untuk menjadi dealer utama Mobil Timor untuk kawasan Indonesia Timur  dibawah nama PT Putra Borneo Nusantara Indah. Kita juga membentuk perusahaan keuangan untuk mensupport pembelian mobil baru bagi para pemilik kendaraan bermotor', 'Sejarah Perusahaan 1996', 'Sejarah Perusahaan 1996', 'Sejarah Perusahaan 1996', '2016-12-26 04:30:32', 1, '2016-12-26 04:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `id` int(1) NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `side_description` text CHARACTER SET utf8,
  `description` text COLLATE utf8_unicode_ci,
  `images` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(1) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id`, `title`, `introduction`, `side_description`, `description`, `images`, `meta_title`, `meta_keyword`, `meta_description`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'Profil Perusahaan', 'Nusantara group adalah kumpulan perusahaan yang bergerak dibidang otomotif  Kami memiliki outlet-outlet yang tersebar diseluruh Indonesia  Brand yang kami bawa mulai dari Daihatsu, KIA, Ford, Mazda, Hyundai, BMW, Chevrolet, Mini dan Mitsubishi', 'Sebagai perusahaan yang bergerak dibidang otomotif, kami telah banyak mendapat kepercayaan untuk memasarkan berbagai merk dan jenis kendaraan bermotor untuk berbagai macam kegunaan dan keperluan.\n\nKesuksesan pemasaran kami didasari oleh sistem yang terkoordinasi dan ditunjang oleh sebuah team yang kompak dalam usaha untuk terus mengejar image produk yang baik serta strategi - strategi dalam mencapai tingkat kepuasan yang terus disesuaikan dengan harapan pelanggan dan kebutuhan pasar.\n\nUsaha – usaha tersebut telah membuahkan hasil berupa nama baik yang terus melekat kepada nama Grup kami sebagai agen / pemasar kendaraan bermotor yang cukup agresif.\n\nBerpegang pada pepatah bahwa pengalaman adalah guru yang berharga, Manajemen menyadari bahwa tidak ada satupun produk tangguh dapat memberikan performa yang maksimal tanpa adanya perawatan dan perbaikan yang disesuaikan dengan standar yang ada, oleh karena itu pelayanan purnajual (aftersales) telah menjadi prioritas kami dalam memberikan pelayanan yang terbaik bagi pelanggan.', 'Pelayanan untuk perawatan dan perbaikan kendaraan serta kemudahan penjualan suku cadang asli yang didukung oleh tenaga-tenaga profesional menjadi dasar bagi kami untuk memberikan pelayanan yang berorientasi pada kualitas hasil pekerjaan (quality), ketepatan waktu pengerjaan (speed), pelayanan pelanggan (<i>customer service</i>), kecepatan tanggap (<i>respon time</i>) dan harga yang bersaing (<i>reasonable price</i>) dimana hal tersebut sudah menjadi standar resmi di semua cabang kami.\n<p>\nNamun hal itu saja belumlah cukup, manajemen sadar betul bahwa pengembangan dan perbaikan secara berkesinambungan wajib dan harus terus dilakukan di semua divisi dan semua lini sehingga harapan kami untuk terus menjadi pemimpin di era kompetisi yang cukup tajam ini bisa terwujud.Salah satu yang cukup dapat dibanggakan adalah jaringan purnajual (<i>aftersales</i>) kami yang begitu banyak dikembangkan dan disesuaikan dengan standar-standar internasional. Ditambah lagi, pada tiga tahun terakhir kami terus mengembangkan sistem tehnologi informasi yang terintegrasi untuk keseluruhan proses yang ada, sehingga monitor hasil pekerjaan dapat dilakukan dengan lebih sempurna agar alur kerja standar dapat terus diterapkan.\nDisinilah salah satu tolak ukur kunci sukses kami dimana kepuasan konsumen selalu terjaga dan tidak terhenti pada saat selesai membeli produk saja. Kepuasan itu akan terus dirasakan oleh pelanggan pada saat pemakaian kendaraan selanjutnya.</p>', 'banner-company-profile2.jpg', 'Profil Perusahaan', 'Profil Perusahaan, Nusantara Group', 'Nusantara group adalah kumpulan perusahaan yang bergerak dibidang otomotif \nKami memiliki outlet-outlet yang tersebar diseluruh Indonesia \nBrand yang kami bawa mulai dari Daihatsu, KIA, Ford, Mazda, Hyundai, BMW, Chevrolet, Mini dan Mitsubishi', '2016-12-25 05:11:42', 1, '2016-12-25 05:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile_images`
--

CREATE TABLE `company_profile_images` (
  `id` int(10) NOT NULL,
  `images` varchar(100) DEFAULT NULL,
  `company_profile_id` int(5) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(10) NOT NULL,
  `firstname` varchar(15) DEFAULT NULL,
  `lastname` varchar(15) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `subject` varchar(15) DEFAULT NULL,
  `message` varchar(45) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `firstname`, `lastname`, `email`, `subject`, `message`, `updated_at`, `created_at`) VALUES
(1, 'Firstname', 'Lastname', 'kiki@gmail.com', 'Subject', 'Message', '2016-12-19 08:21:11', '2016-12-19 08:21:11'),
(2, 'Firstname', 'Lastname', 'kiki@gmail.com', 'Subject', 'Message', '2016-12-19 08:22:28', '2016-12-19 08:22:28'),
(3, 'Firstname', 'Lastname', 'sheqbo@gmail.com', 'Subject', 'Message', '2016-12-19 08:53:33', '2016-12-19 08:53:33'),
(4, 'Firstname', 'Lastname', 'sheqbo@gmail.com', 'Subject', 'Message', '2016-12-19 08:54:43', '2016-12-19 08:54:43'),
(5, 'Firstname', 'Lastname', 'user@gmail.com', 'Subject', 'Message', '2016-12-19 09:05:00', '2016-12-19 09:05:00'),
(6, 'Firstname', 'Lastname', 'user@gmail.com', 'Subject', 'Message', '2016-12-19 09:06:39', '2016-12-19 09:06:39'),
(7, 'Firstname', 'Lastname', 'rndra68@gmail.com', 'Subject', 'Message', '2016-12-19 09:10:04', '2016-12-19 09:10:04'),
(8, 'Firstname', 'Lastname', 'user@gmail.com', 'Subject', 'dfhyudfydsfry', '2016-12-19 09:11:24', '2016-12-19 09:11:24'),
(9, 'Firstname', 'Lastname', 'user@gmail.com', 'Subject', 'dfhydfyhdfy', '2016-12-19 09:12:05', '2016-12-19 09:12:05'),
(10, 'Firstname', 'Lastname', 'user@gmail.com', 'Subject', 'Message', '2016-12-19 09:13:08', '2016-12-19 09:13:08'),
(11, 'Firstname', 'Lastname', 'kiki@gmail.com', 'Subject', 'yugyutuyfg', '2016-12-19 09:14:34', '2016-12-19 09:14:34'),
(12, 'Firstname', 'Lastname', 'user@gmail.com', 'Subject', 'iuhuiyt87g78', '2016-12-19 09:16:15', '2016-12-19 09:16:15'),
(13, 'Firstname', 'Lastname', 'haqiqi@y7mail.com', 'Subject', 'Validator', '2016-12-22 08:48:53', '2016-12-22 08:48:53'),
(14, 'Firstname', 'Lastname', 'user@gmail.com', 'Subject', 'Validator', '2016-12-22 08:49:48', '2016-12-22 08:49:48'),
(15, 'Firstname', 'Lastname', 'rndra68@gmail.com', 'Subject', 'getData', '2016-12-22 08:51:03', '2016-12-22 08:51:03'),
(16, 'Firstname', 'Lastname', 'kiki@gmail.com', 'Subject', '$item', '2016-12-22 08:51:46', '2016-12-22 08:51:46'),
(17, 'Firstname', 'Lastname', 'tokajat@gmail.com', 'Subject', '$item', '2016-12-22 08:52:14', '2016-12-22 08:52:14'),
(18, 'Firstname', 'Lastname', 'rndra68@gmail.com', 'Subject', 'this.getData();', '2016-12-22 08:55:32', '2016-12-22 08:55:32'),
(19, 'Firstname', 'Lastname', 'rndra68@gmail.com', 'Subject', 'sfgasfg', '2016-12-22 09:05:13', '2016-12-22 09:05:13'),
(20, 'Firstname', 'Lastname', 'kiki@gmail.com', 'Subject', 'degedgadsg', '2016-12-22 09:06:07', '2016-12-22 09:06:07'),
(21, 'ajat', 'kurniawan', 'tokajat@gmail.com', 'test', 'test', '2016-12-24 05:33:57', '2016-12-24 05:33:57'),
(22, 'kiki', 'kurniawan', 'kiki@gmail.com', 'test', 'test', '2016-12-24 05:36:33', '2016-12-24 05:36:33'),
(23, 'Firstname', 'Lastname', 'kiki@gmail.com', 'Subject', 'dsgysdfgs', '2016-12-24 05:37:47', '2016-12-24 05:37:47'),
(24, 'Firstname', 'Lastname', 'kiki@gmail.com', 'Subject', 'test', '2016-12-24 05:39:12', '2016-12-24 05:39:12'),
(25, 'ajat', 'kurniawan', 'kiki@gmail.com', 'Subject', 'vdffvf', '2016-12-24 11:46:31', '2016-12-24 11:46:31'),
(26, 'Firstname', 'Lastname', 'kiki@gmail.com', 'Subject', 'ad', '2016-12-24 11:53:01', '2016-12-24 11:53:01'),
(27, 'Firstname', 'Lastname', 'kiki@gmail.com', 'Subject', 'sdrgswegwe', '2016-12-24 12:13:37', '2016-12-24 12:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_page`
--

CREATE TABLE `contact_us_page` (
  `id` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `call_center` text COLLATE utf8_unicode_ci,
  `mail` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_show_on_page` int(1) DEFAULT NULL,
  `longitute` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_us_page`
--

INSERT INTO `contact_us_page` (`id`, `title`, `subtitle`, `address`, `call_center`, `mail`, `is_show_on_page`, `longitute`, `latitude`, `meta_title`, `meta_keyword`, `meta_description`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'Contact us', 'sontact us page', 'Jl. Suryopranoto No 77-79, Jakarta Pusat', 'Tlp : 021-3510 888', 'helpdesk@nas.co.id', 1, '-6.170164', '106.816069', 'contact us nusantara group', 'contact us nusantara group', 'contact us nusantara group', '2016-12-24 04:35:03', 1, '2016-12-24 04:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `footer_page`
--

CREATE TABLE `footer_page` (
  `id` int(11) NOT NULL,
  `footer_box_left` text CHARACTER SET utf8,
  `footer_box_center` text CHARACTER SET utf8,
  `footer_box_right` text CHARACTER SET utf8,
  `facebook_link` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tweeter_link` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_link` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail_link` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscribe_content` text CHARACTER SET utf8,
  `is_active` int(1) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(1) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `footer_page`
--

INSERT INTO `footer_page` (`id`, `footer_box_left`, `footer_box_center`, `footer_box_right`, `facebook_link`, `instagram_link`, `tweeter_link`, `google_link`, `mail_link`, `subscribe_content`, `is_active`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'Pages', 'PT. Nusantara Batavia Motor. \nJl. Suryopranoto No 77-79, Jakarta Pusat \nPhone : 021-3510 888 \nFax : 021-38901081', 'PT. Nusantara Indah. \nJl. A.Yani Km.4,5 No.330 Lt.2 \nBanjarmasin \nPhone : (0511) 3253553, 7252687 \nFax : (0511) 3255377', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.tweeter.com', 'https://www.google.com', 'https://www.mail.google.com', 'Subscribe', 1, '2016-12-24 17:00:00', 1, '2016-12-24 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `id` bigint(10) NOT NULL,
  `job_position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `pos_code` int(6) DEFAULT NULL,
  `phone_number` bigint(15) DEFAULT NULL,
  `religion` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identity_number` int(20) DEFAULT NULL,
  `height` int(3) DEFAULT NULL,
  `weight` int(3) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_information`
--

CREATE TABLE `job_information` (
  `id` int(5) NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `side_description` text COLLATE utf8_unicode_ci,
  `banner_images` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_banner`
--

CREATE TABLE `main_banner` (
  `id` int(11) NOT NULL,
  `images` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `create_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_by` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_by` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main_banner`
--

INSERT INTO `main_banner` (`id`, `images`, `title`, `is_active`, `create_at`, `create_by`, `update_by`) VALUES
(5, 'triton-slider-rev-2_232301_161846.jpg', 'Main Banner Titile', 1, '2016-12-25 17:04:03', '1', '2016-12-25 17:04:03'),
(6, 'triton-slider-rev-2_232301_161846.jpg', 'Main Banner Titile', 1, '2016-12-25 17:04:03', '1', '2016-12-25 17:04:03'),
(7, 'triton-slider-rev-2_232301_161846.jpg', 'Main Banner Titile', 1, '2016-12-25 17:04:03', '1', '2016-12-25 17:04:03'),
(8, 'triton-slider-rev-2_232301_161846.jpg', 'Main Banner Titile', 1, '2016-12-25 17:04:03', '1', '2016-12-25 17:04:03');

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
(3, '2016_12_07_040502_create_news', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `side_description` text COLLATE utf8_unicode_ci,
  `quote_description` text COLLATE utf8_unicode_ci,
  `description` text CHARACTER SET utf8,
  `images` text CHARACTER SET utf8,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8,
  `is_active` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `create_by` int(1) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `side_description`, `quote_description`, `description`, `images`, `meta_title`, `meta_keyword`, `meta_description`, `is_active`, `created_at`, `create_by`, `updated_at`) VALUES
(1, 'Mazda Tangerang', 'Dealer Mazda Tangerang yang baru saja diresmikan hari senin 30 maret 2015. Dengan layanan dan fasilitasnya terbilang lengkap, mulai penjualan, perbaikan, dan layanan suku cadang.', '"Di dealer Mazda Tangerang ini dalam waktu dekat juga akan hadir body repair and paint workshop," ujar Operational Director PT Nusantara Batavia Motor, Agung Dewanto saat ditemui di Tangerang, Senin (30/3).', 'President Director PT Mazda Motor Indonesia, Keizo Okue mengatakan, Tangerang memiliki potensi bisnis yang menjanjikan sehingga Mazda menghadirkan dealer di kawasan ini.', 'http://img1.beritasatu.com/data/media/images/medium/1427693183.jpg', 'Mazda Tangerang', 'Mazda Tangerang', 'Mazda Tangerang', 1, '2016-12-25 04:43:19', 1, '2016-12-25 04:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `side_description` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `service_category_id` int(5) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `images`, `introduction`, `side_description`, `description`, `service_category_id`, `is_active`, `meta_title`, `meta_keyword`, `meta_description`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'The New WAY to Feel ALIVE', 'the-new-way-to-feel-alive', 'the-new-way-to-feel-alive.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed feugiat dolor. Cras nec rhoncus nisi, ac feugiat sapien. Nunc rutrum ultricies nibh, ac pellentesque tellus commodo et.', 'Yang terhormat pelanggan MAZDA BSD, Dari Periode 23 Oktober 2014 s/d 26 Oktober 2014, ', 'Dari Periode 23 Oktober 2014 s/d 26 Oktober 2014, Nusantara MAZDA BSD mengadakan campaign "New WAY to Feel ALIVE" Cukup dengan menunjukkan Voucher Diskon atau SMS undangan, Pelanggan akan mendapatkan : - Discount Jasa    : 20% - Discount Part      : 10% - Free Check Up Segera kunjungi Nusantara MAZDA  di Jl. Raya Serpong No.8 , Tengerang Selatan Info : 021-5384455', 1, 1, 'The New WAY to Feel ALIVE', 'The New WAY to Feel ALIVE', 'The New WAY to Feel ALIVE', '2016-12-25 10:04:03', 1, '2016-12-25 10:04:03'),
(2, 'Nusantara BMW "PROMO IMLEK"', 'nusantara-bmw-promo-imlek', 'nusantara-bmw-promo-imlek.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed feugiat dolor. Cras nec rhoncus nisi, ac feugiat sapien. Nunc rutrum ultricies nibh, ac pellentesque tellus commodo et.', 'Yang terhormat pelanggan Nusantara BMW, Menyambut datangnya Tahun Baru Imlek ke-2565', 'Dari Periode 23 Oktober 2014 s/d 26 Oktober 2014, Nusantara MAZDA BSD mengadakan campaign "New WAY to Feel ALIVE" Cukup dengan menunjukkan Voucher Diskon atau SMS undangan, Pelanggan akan mendapatkan : - Discount Jasa    : 20% - Discount Part      : 10% - Free Check Up Segera kunjungi Nusantara MAZDA  di Jl. Raya Serpong No.8 , Tengerang Selatan Info : 021-5384455', 1, 1, 'Nusantara BMW "PROMO IMLEK"', 'Nusantara BMW "PROMO IMLEK"', 'Nusantara BMW "PROMO IMLEK"', '2016-12-25 10:04:03', 1, '2016-12-25 10:04:03'),
(3, 'Nusantara DAIHATSU "PROMO IMLEK"', 'nusantara-daihatsu-promo-imlek', 'nusantara-daihatsu-promo-imlek.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed feugiat dolor. Cras nec rhoncus nisi, ac feugiat sapien. Nunc rutrum ultricies nibh, ac pellentesque tellus commodo et.', 'Yang terhormat pelanggan Nusantara DAIHATSU, Menyambut datangnya Tahun Baru Imlek ke-2565,', 'Dari Periode 23 Oktober 2014 s/d 26 Oktober 2014, Nusantara MAZDA BSD mengadakan campaign "New WAY to Feel ALIVE" Cukup dengan menunjukkan Voucher Diskon atau SMS undangan, Pelanggan akan mendapatkan :<br/> \n\n<table class="table table-striped">\n<tr>\n<td>Discount Jasa:</td><td>20%</td>\n</tr>\n<tr>\n<td>Discount Part</td><td>10%</td>\n</tr>\n<tr>\n<td>Free Check Up</td><td></td>\n</tr>\n</table>\n\n<p>Segera kunjungi Nusantara MAZDA  di Jl. Raya Serpong No.8 , Tengerang Selatan</p>\n<br/> Info : 021-5384455', 1, 1, 'Nusantara DAIHATSU "PROMO IMLEK"', 'Nusantara DAIHATSU "PROMO IMLEK"', 'Nusantara DAIHATSU "PROMO IMLEK"', '2016-12-25 10:04:03', 1, '2016-12-25 10:04:03'),
(5, 'Menggati Ban Bocor', 'menggati-ban-bocor', 'menggati-ban-bocor.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed feugiat dolor. Cras nec rhoncus nisi, ac feugiat sapien. Nunc rutrum ultricies nibh, ac pellentesque tellus commodo et.', 'Menggati Ban Bocor   Ketika mobil ban mobil kita bocor atau kempes, ada kalanya kita harus menggantinya sendiri karena kondisi yang mendesak. Ada beberapa tips untuk mengganti ban', 'Dari Periode 23 Oktober 2014 s/d 26 Oktober 2014, Nusantara MAZDA BSD mengadakan campaign "New WAY to Feel ALIVE" Cukup dengan menunjukkan Voucher Diskon atau SMS undangan, Pelanggan akan mendapatkan :<br/> \n\n<table class="table table-striped">\n<tr>\n<td>Discount Jasa:</td><td>20%</td>\n</tr>\n<tr>\n<td>Discount Part</td><td>10%</td>\n</tr>\n<tr>\n<td>Free Check Up</td><td></td>\n</tr>\n</table>\n\n<p>Segera kunjungi Nusantara MAZDA  di Jl. Raya Serpong No.8 , Tengerang Selatan</p>\n<br/> Info : 021-5384455', 2, 1, 'Menggati Ban Bocor', 'Menggati Ban Bocor', 'Menggati Ban Bocor', '2016-12-25 10:04:03', 1, '2016-12-25 10:04:03'),
(6, 'Safety Driving On The Road', 'safety-driving-on-the-road', 'safety-driving-on-the-road.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed feugiat dolor. Cras nec rhoncus nisi, ac feugiat sapien. Nunc rutrum ultricies nibh, ac pellentesque tellus commodo et.', 'Di era modern ini, setiap aspek kehidupan membutuhkan kecepatan dan ketepatan. Waktu menjadi sesuatu yang pantas untuk diperjuangkan agar efektifitas hidup semakin tinggi.', 'Di era modern ini, setiap aspek kehidupan membutuhkan kecepatan dan ketepatan. Waktu menjadi sesuatu yang pantas untuk diperjuangkan agar efektifitas hidup semakin tinggi. Salah satu cara dalam meng-efektifkaan kehidupan adalah dengan menggunakan kendaraan. Namun sangat disayangkan, kendaraan yang banyak digunakan masyarakat ini, ternyata juga menduduki peringkat terbesar kecelakaan di jalan raya. Punya keahlian berkendara yang baik adalah suatu cara yang ideal untuk menekan tingkat kecelakaan kendaraan roda empat yang terjadi saat di perjalanan. Berikut ini ada beberapa cara mengemudi mobil yang baik: Gunakan sabuk pengaman (safety belt) atau seatbelt dapat melindungi penggunanya dari cedera yang lebih parah dalam suatu kecelakaan. Sekali lagi bukan masalah jenis mobil, mobil pribadi, yang penting menggunakan sabuk pengaman. Kaca Spion. Kebanyakan pengemudi tidak menyesuaikan kaca spionnya dan tidak memanfaatkannya seoptimal mungkin dengan terlalu banyak melihat sisi kendaraannya sendiri saja. Pengemudi yang baik harus mampu mengemudikan kendaraannya dengan tenang (tidak tegang). Serta mampu meng-antisipasi situasi kondisi lalu lintas di depannya. Gangguan Dalam Berkendara. Mengemudi adalah pekerjaan yang berbahaya, untuk itu dibutuhkan konsentrasi penuh pada saat kita mengemudi.', 2, 1, 'Safety Driving On The Road', 'Safety Driving On The Road', 'Safety Driving On The Road', '2016-12-25 10:04:03', 1, '2016-12-25 10:04:03'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_category`
--

CREATE TABLE `service_category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `slug` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_category`
--

INSERT INTO `service_category` (`id`, `name`, `slug`, `is_active`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'Acara dan Program', 'acara-dan-program', 1, '2016-12-25 10:04:03', 1, '2016-12-25 10:04:03'),
(2, 'Tips Perawatan', 'tips-perawatan', 1, '2016-12-25 10:04:03', 1, '2016-12-25 10:04:03'),
(3, 'Merchandise', 'merchandise', 1, '2016-12-25 10:04:03', 1, '2016-12-25 10:04:03'),
(4, 'Suku Cadang', 'suku-cadang', 1, '2016-12-25 10:04:03', 1, '2016-12-25 10:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `service_images`
--

CREATE TABLE `service_images` (
  `id` int(11) NOT NULL,
  `banner_images` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `services_id` int(10) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_images`
--

INSERT INTO `service_images` (`id`, `banner_images`, `services_id`, `create_at`, `update_at`) VALUES
(13, 'banner.jpg', 1, '2016-12-25 10:04:03', '2016-12-25 10:04:03'),
(14, 'banner2.jpg', 1, '2016-12-25 10:04:03', '2016-12-25 10:04:03'),
(25, 'banner.jpg', 2, '2016-12-25 10:04:03', '2016-12-25 10:04:03'),
(26, 'banner2.jpg', 2, '2016-12-25 10:04:03', '2016-12-25 10:04:03'),
(27, 'banner.jpg', 3, '2016-12-25 10:04:03', '2016-12-25 10:04:03'),
(28, 'banner2.jpg', 3, '2016-12-25 10:04:03', '2016-12-25 10:04:03'),
(31, 'banner.jpg', 5, '2016-12-25 10:04:03', '2016-12-25 10:04:03'),
(32, 'banner2.jpg', 5, '2016-12-25 10:04:03', '2016-12-25 10:04:03'),
(33, 'banner.jpg', 6, '2016-12-25 10:04:03', '2016-12-25 10:04:03'),
(34, 'banner2.jpg', 6, '2016-12-25 10:04:03', '2016-12-25 10:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `service_releted`
--

CREATE TABLE `service_releted` (
  `id` int(10) NOT NULL,
  `service_releted_id` int(10) DEFAULT NULL,
  `service_id` int(10) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `static_page`
--

CREATE TABLE `static_page` (
  `id` int(5) NOT NULL,
  `site_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo_images` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `favicon_images` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `og_title` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `og_images` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `og_description` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `box_wrapper_left` text COLLATE utf8_unicode_ci,
  `box_wrapper_center` text COLLATE utf8_unicode_ci,
  `box_wrapper_right` text COLLATE utf8_unicode_ci,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `is_active` int(1) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `static_page`
--

INSERT INTO `static_page` (`id`, `site_title`, `logo_images`, `site_name`, `favicon_images`, `og_title`, `og_images`, `og_description`, `box_wrapper_left`, `box_wrapper_center`, `box_wrapper_right`, `meta_title`, `meta_keyword`, `meta_description`, `is_active`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'Nusantara Group', 'logo-nusantara.png', 'Nusantara Group', 'favicon.png', 'Nusantara Group', 'mini-chooper.jpg', 'Nusantara Group', '<p>Nikmati pelayanan perjanjian yang mudah dan efisien secara online. </p>', '<p>Jadwalkan kehadiran di showroom kami untuk mendapatkan test kendaraan idaman anda gratis.. </p>', '<p>Temukan mobil impian mu dengan harga yang relatif murah dengan kualitas tinggi dan mewah.   </p>', 'Nusantara Group', 'Nusantara Group', 'Nusantara Group', 1, '2016-12-24 17:00:00', 1, '2016-12-24 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` bigint(10) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `email`, `updated_at`, `created_at`) VALUES
(1, 'kiki@gmail.com', '2016-12-25 10:03:17', '2016-12-25 10:03:17'),
(2, 'rndra68@gmail.com', '2016-12-25 10:03:43', '2016-12-25 10:03:43'),
(3, 'user@gmail.com', '2016-12-25 10:07:29', '2016-12-25 10:07:29'),
(4, 'sheqbo@gmail.com', '2016-12-25 21:52:01', '2016-12-25 21:52:01'),
(5, 'rndra68@gmail.com', '2016-12-25 21:53:15', '2016-12-25 21:53:15'),
(6, 'kiki@gmail.com', '2017-01-11 23:29:19', '2017-01-11 23:29:19'),
(7, 'kiki@gmail.com', '2017-01-11 23:29:31', '2017-01-11 23:29:31'),
(8, 'user@gmail.com', '2017-01-17 08:40:43', '2017-01-17 08:40:43'),
(9, 'user@gmail.com', '2017-01-17 09:10:33', '2017-01-17 09:10:33'),
(10, 'user@gmail.com', '2017-01-17 09:31:56', '2017-01-17 09:31:56'),
(11, 'kiki@gmail.com', '2017-01-24 22:46:15', '2017-01-24 22:46:15'),
(12, 'sheqbo@gmail.com', '2017-01-28 03:53:29', '2017-01-28 03:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `side_description` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `meta_keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visi_misi`
--

INSERT INTO `visi_misi` (`id`, `title`, `images`, `side_description`, `description`, `meta_keyword`, `meta_title`, `meta_description`, `create_at`, `create_by`, `update_at`) VALUES
(1, 'Visi & Misi', 'http://www.nusantara-group.co.id/images/header/visi_misi.jpg', 'There no happiness except in the realization \nthat we have accomplished something By Henry Ford', 'VISI\n\nMenjadi rekanan bisnis terpercaya di tunjang oleh manajemen yang profesional serta manfaat yang prima bagi para stake holder.\n\nMISI\n\nMemberikan pelayanan yang beorientasi kepada kebutuhan pelanggan.\nMemiliki integritas yang tinggi serta sikap proaktif dilandasi paradigma yang positif.\nPertumbuhan modal kerja yang konsisten baik secara financial dan intelektual.\nPengembangan sumber daya manusia dan teknologi yang berkesinambungan untuk menyesuaikan dinamika pasar.', 'Visi & Misi', 'Visi & Misi', 'Visi & Misi', '2016-12-26 05:05:04', 1, '2016-12-26 05:05:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch_office`
--
ALTER TABLE `branch_office`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug_UNIQUE` (`slug`);

--
-- Indexes for table `branch_office_images`
--
ALTER TABLE `branch_office_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_branch_office_images_1_idx` (`office_id`);

--
-- Indexes for table `branch_office_trans`
--
ALTER TABLE `branch_office_trans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_branch_office_trans_1_idx` (`branch_office_id`);

--
-- Indexes for table `company_award`
--
ALTER TABLE `company_award`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_award_trans`
--
ALTER TABLE `company_award_trans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_award_trans_1_idx` (`awards_id`);

--
-- Indexes for table `company_history`
--
ALTER TABLE `company_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_profile_images`
--
ALTER TABLE `company_profile_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us_page`
--
ALTER TABLE `contact_us_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_page`
--
ALTER TABLE `footer_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identity_number_UNIQUE` (`identity_number`),
  ADD UNIQUE KEY `phone_number_UNIQUE` (`phone_number`);

--
-- Indexes for table `job_information`
--
ALTER TABLE `job_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_banner`
--
ALTER TABLE `main_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug_UNIQUE` (`slug`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`),
  ADD KEY `fk_services_1_idx` (`service_category_id`);

--
-- Indexes for table `service_category`
--
ALTER TABLE `service_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug_UNIQUE` (`slug`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `service_images`
--
ALTER TABLE `service_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_service_images_1_idx` (`services_id`);

--
-- Indexes for table `service_releted`
--
ALTER TABLE `service_releted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_page`
--
ALTER TABLE `static_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch_office`
--
ALTER TABLE `branch_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `branch_office_images`
--
ALTER TABLE `branch_office_images`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `branch_office_trans`
--
ALTER TABLE `branch_office_trans`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `company_award`
--
ALTER TABLE `company_award`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `company_award_trans`
--
ALTER TABLE `company_award_trans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `company_history`
--
ALTER TABLE `company_history`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `company_profile_images`
--
ALTER TABLE `company_profile_images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `contact_us_page`
--
ALTER TABLE `contact_us_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `footer_page`
--
ALTER TABLE `footer_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `job_application`
--
ALTER TABLE `job_application`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_information`
--
ALTER TABLE `job_information`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `main_banner`
--
ALTER TABLE `main_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `service_category`
--
ALTER TABLE `service_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `service_images`
--
ALTER TABLE `service_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `service_releted`
--
ALTER TABLE `service_releted`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_page`
--
ALTER TABLE `static_page`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch_office_images`
--
ALTER TABLE `branch_office_images`
  ADD CONSTRAINT `fk_branch_office_images_1` FOREIGN KEY (`office_id`) REFERENCES `branch_office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branch_office_trans`
--
ALTER TABLE `branch_office_trans`
  ADD CONSTRAINT `fk_branch_office_trans_1` FOREIGN KEY (`branch_office_id`) REFERENCES `branch_office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company_award_trans`
--
ALTER TABLE `company_award_trans`
  ADD CONSTRAINT `fk_company_award_trans_1` FOREIGN KEY (`awards_id`) REFERENCES `company_award` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_services_1` FOREIGN KEY (`service_category_id`) REFERENCES `service_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `service_images`
--
ALTER TABLE `service_images`
  ADD CONSTRAINT `fk_service_images_1` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
