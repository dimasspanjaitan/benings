-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2025 at 01:10 AM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 8.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `benings`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `status`, `title`, `slug`, `photo`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Paket Exclusive', 'paket-exclusive', 'http://127.0.0.1:8000/uploads/banners/1685028107_banner-paket-exclusive.jpg', 'Paket dasar exclusive membantu menghempaskan permasalahan flek hitam yang sulit hilang', '2023-05-18 05:24:54', '2023-05-25 15:21:47'),
(2, 1, 'Paket Acne', 'paket-acne', 'http://127.0.0.1:8000/uploads/banners/1685027985_banner-paket-acne.jpg', 'Paket Dasar Acne membantu mengatasi permasalahan jerawat di wajah', '2023-05-19 13:44:55', '2023-05-25 15:19:46'),
(3, 1, 'Paket Brightening', 'paket-brightening', 'http://127.0.0.1:8000/uploads/banners/1685029032_banner-paket-brightening.jpg', 'Paket Dasar Brightening mengatasi permasalahan kulit kusam dan juga menyamarkan bekas jerawat', '2023-05-25 15:25:29', '2023-05-25 15:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `status`, `title`, `slug`, `description`) VALUES
(1, 1, 'Paket Dasar', 'paket-dasar', 'Produk paketan dasar Bening\'s Indonesia yang terdiri dari Facial Wash, Toner, Day Cream, dan Night Cream'),
(2, 1, 'Serum', 'serum', 'Produk serum Bening\'s Indonesia yang dijjual terpisah dengan produk paketan untuk membantu menyelesaikan permasalahan kulit anda.'),
(3, 1, 'Body Care', 'body-care', 'Produk Bening\'s Indonesia yang digunakan untuk menjaga kesehatan kulit badan, kecuali wajah'),
(4, 1, 'Mother Edition', 'mother-edition', 'Produk paketan Bening\'s Indonesia khusus untuk ibu hamil dan menyusui'),
(5, 1, 'Item Satuan', 'item-satuan', 'Produk Bening\'s Indonesia yang dijual satuan (1 pcs)');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(191) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 2,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `status`, `name`, `type`, `description`) VALUES
(1, 1, 'Customer', 1, NULL),
(2, 1, 'Newbie', 2, NULL),
(3, 1, 'Junior Reseller', 2, NULL),
(4, 1, 'Senior Reseller', 2, NULL),
(5, 1, 'Junior Agen', 2, NULL),
(6, 1, 'Senior Agen', 2, NULL),
(7, 1, 'Distributor', 2, NULL),
(8, 1, 'Distributor Plus', 2, NULL),
(9, 1, 'Senior Distributor', 2, NULL),
(10, 1, 'Master Distributor', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(58, '2014_10_12_000000_create_users_table', 1),
(59, '2014_10_12_100000_create_password_resets_table', 1),
(60, '2019_08_19_000000_create_failed_jobs_table', 1),
(61, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(62, '2023_01_06_073001_create_products_table', 1),
(63, '2023_01_06_074643_create_product_details_table', 1),
(64, '2023_01_06_075122_create_purchases_table', 1),
(65, '2023_01_06_075537_create_purchase_details_table', 1),
(66, '2023_01_06_075913_create_sales_table', 1),
(67, '2023_01_06_080312_create_sale_details_table', 1),
(68, '2023_01_06_080917_create_price_levels_table', 1),
(69, '2023_01_06_081205_create_suppliers_table', 1),
(70, '2023_01_06_081444_create_categories_table', 1),
(71, '2023_01_06_081544_create_levels_table', 1),
(72, '2023_01_06_083248_create_regions_table', 1),
(73, '2023_01_17_050229_create_product_discounts_table', 1),
(74, '2023_04_26_180426_create_settings_table', 1),
(75, '2023_04_26_185614_create_product_images_table', 1),
(76, '2023_05_18_095115_create_banners_table', 2),
(78, '2023_05_26_234420_stock_view', 3),
(79, '2023_05_27_162017_create_carts_table', 4),
(80, '2023_05_27_163227_create_wishlists_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_levels`
--

CREATE TABLE `price_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_levels`
--

INSERT INTO `price_levels` (`id`, `level_id`, `product_id`, `price`) VALUES
(80, 10, 1, 0),
(79, 9, 1, 245000),
(78, 8, 1, 252000),
(77, 7, 1, 260000),
(76, 6, 1, 270000),
(75, 5, 1, 280000),
(74, 4, 1, 290000),
(73, 3, 1, 300000),
(72, 2, 1, 310000),
(71, 1, 1, 350000),
(90, 10, 2, 0),
(89, 9, 2, 245000),
(88, 8, 2, 252000),
(87, 7, 2, 260000),
(86, 6, 2, 270000),
(85, 5, 2, 280000),
(84, 4, 2, 290000),
(83, 3, 2, 300000),
(82, 2, 2, 310000),
(81, 1, 2, 350000),
(100, 10, 3, 0),
(99, 9, 3, 270000),
(98, 8, 3, 277000),
(97, 7, 3, 285000),
(96, 6, 3, 295000),
(95, 5, 3, 305000),
(94, 4, 3, 315000),
(93, 3, 3, 325000),
(92, 2, 3, 335000),
(91, 1, 3, 375000),
(31, 1, 4, 375000),
(32, 2, 4, 335000),
(33, 3, 4, 330000),
(34, 4, 4, 325000),
(35, 5, 4, 320000),
(36, 6, 4, 315000),
(37, 7, 4, 310000),
(38, 8, 4, 305000),
(39, 9, 4, 295000),
(40, 10, 4, 285000),
(41, 1, 5, 375000),
(42, 2, 5, 335000),
(43, 3, 5, 330000),
(44, 4, 5, 325000),
(45, 5, 5, 320000),
(46, 6, 5, 315000),
(47, 7, 5, 310000),
(48, 8, 5, 305000),
(49, 9, 5, 295000),
(50, 10, 5, 285000),
(460, 10, 6, 290000),
(459, 9, 6, 295000),
(458, 8, 6, 305000),
(457, 7, 6, 310000),
(456, 6, 6, 315000),
(455, 5, 6, 320000),
(454, 4, 6, 325000),
(453, 3, 6, 330000),
(452, 2, 6, 335000),
(451, 1, 6, 375000),
(110, 10, 7, 0),
(109, 9, 7, 0),
(108, 8, 7, 90000),
(107, 7, 7, 95000),
(106, 6, 7, 105000),
(105, 5, 7, 115000),
(104, 4, 7, 125000),
(103, 3, 7, 130000),
(102, 2, 7, 135000),
(101, 1, 7, 150000),
(111, 1, 8, 235000),
(112, 2, 8, 215000),
(113, 3, 8, 210000),
(114, 4, 8, 200000),
(115, 5, 8, 190000),
(116, 6, 8, 180000),
(117, 7, 8, 170000),
(118, 8, 8, 160000),
(119, 9, 8, 0),
(120, 10, 8, 0),
(121, 1, 9, 210000),
(122, 2, 9, 190000),
(123, 3, 9, 185000),
(124, 4, 9, 175000),
(125, 5, 9, 165000),
(126, 6, 9, 155000),
(127, 7, 9, 145000),
(128, 8, 9, 135000),
(129, 9, 9, 0),
(130, 10, 9, 0),
(230, 10, 10, 0),
(229, 9, 10, 0),
(228, 8, 10, 145000),
(227, 7, 10, 155000),
(226, 6, 10, 165000),
(225, 5, 10, 175000),
(224, 4, 10, 185000),
(223, 3, 10, 195000),
(222, 2, 10, 200000),
(221, 1, 10, 220000),
(240, 10, 11, 0),
(239, 9, 11, 0),
(238, 8, 11, 160000),
(237, 7, 11, 170000),
(236, 6, 11, 180000),
(235, 5, 11, 190000),
(234, 4, 11, 200000),
(233, 3, 11, 210000),
(232, 2, 11, 215000),
(231, 1, 11, 235000),
(320, 1, 12, 105000),
(319, 2, 12, 97000),
(318, 3, 12, 89000),
(317, 4, 12, 89000),
(316, 5, 12, 81000),
(315, 6, 12, 73000),
(314, 7, 12, 65000),
(313, 8, 12, 65000),
(312, 9, 12, 0),
(311, 10, 12, 0),
(300, 10, 13, 0),
(299, 9, 13, 0),
(298, 8, 13, 65000),
(297, 7, 13, 65000),
(296, 6, 13, 73000),
(295, 5, 13, 81000),
(294, 4, 13, 89000),
(293, 3, 13, 89000),
(292, 2, 13, 97000),
(291, 1, 13, 105000),
(330, 10, 14, 0),
(329, 9, 14, 0),
(328, 8, 14, 65000),
(327, 7, 14, 65000),
(326, 6, 14, 73000),
(325, 5, 14, 81000),
(324, 4, 14, 89000),
(323, 3, 14, 89000),
(322, 2, 14, 97000),
(321, 1, 14, 105000),
(480, 1, 18, 79000),
(479, 2, 18, 74000),
(478, 3, 18, 71000),
(477, 4, 18, 68000),
(476, 5, 18, 65000),
(475, 6, 18, 62000),
(474, 7, 18, 57000),
(473, 8, 18, 53000),
(472, 9, 18, 49000),
(471, 10, 18, 45000),
(341, 1, 17, 79000),
(342, 2, 17, 74000),
(343, 3, 17, 71000),
(344, 4, 17, 68000),
(345, 5, 17, 65000),
(346, 6, 17, 62000),
(347, 7, 17, 57000),
(348, 8, 17, 53000),
(349, 9, 17, 49000),
(350, 10, 17, 45000),
(351, 1, 19, 79000),
(352, 2, 19, 74000),
(353, 3, 19, 71000),
(354, 4, 19, 68000),
(355, 5, 19, 65000),
(356, 6, 19, 62000),
(357, 7, 19, 57000),
(358, 8, 19, 53000),
(359, 9, 19, 49000),
(360, 10, 19, 45000),
(361, 1, 21, 75000),
(362, 2, 21, 70000),
(363, 3, 21, 67000),
(364, 4, 21, 64000),
(365, 5, 21, 61000),
(366, 6, 21, 58000),
(367, 7, 21, 53000),
(368, 8, 21, 50000),
(369, 9, 21, 47000),
(370, 10, 21, 44000),
(371, 1, 20, 75000),
(372, 2, 20, 70000),
(373, 3, 20, 67000),
(374, 4, 20, 64000),
(375, 5, 20, 61000),
(376, 6, 20, 58000),
(377, 7, 20, 53000),
(378, 8, 20, 50000),
(379, 9, 20, 47000),
(380, 10, 20, 44000),
(381, 1, 22, 75000),
(382, 2, 22, 70000),
(383, 3, 22, 67000),
(384, 4, 22, 64000),
(385, 5, 22, 61000),
(386, 6, 22, 58000),
(387, 7, 22, 53000),
(388, 8, 22, 50000),
(389, 9, 22, 47000),
(390, 10, 22, 44000),
(391, 1, 23, 100000),
(392, 2, 23, 95000),
(393, 3, 23, 92000),
(394, 4, 23, 89000),
(395, 5, 23, 86000),
(396, 6, 23, 83000),
(397, 7, 23, 78000),
(398, 8, 23, 75000),
(399, 9, 23, 72000),
(400, 10, 23, 69000),
(401, 1, 24, 100000),
(402, 2, 24, 95000),
(403, 3, 24, 92000),
(404, 4, 24, 89000),
(405, 5, 24, 86000),
(406, 6, 24, 83000),
(407, 7, 24, 78000),
(408, 8, 24, 75000),
(409, 9, 24, 72000),
(410, 10, 24, 69000),
(411, 1, 25, 100000),
(412, 2, 25, 95000),
(413, 3, 25, 92000),
(414, 4, 25, 89000),
(415, 5, 25, 86000),
(416, 6, 25, 83000),
(417, 7, 25, 78000),
(418, 8, 25, 75000),
(419, 9, 25, 72000),
(420, 10, 25, 69000),
(421, 1, 26, 150000),
(422, 2, 26, 145000),
(423, 3, 26, 140000),
(424, 4, 26, 135000),
(425, 5, 26, 128000),
(426, 6, 26, 121000),
(427, 7, 26, 112000),
(428, 8, 26, 105000),
(429, 9, 26, 98000),
(430, 10, 26, 91000),
(431, 1, 27, 150000),
(432, 2, 27, 145000),
(433, 3, 27, 140000),
(434, 4, 27, 135000),
(435, 5, 27, 128000),
(436, 6, 27, 121000),
(437, 7, 27, 112000),
(438, 8, 27, 105000),
(439, 9, 27, 98000),
(440, 10, 27, 91000),
(441, 1, 28, 165000),
(442, 2, 28, 160000),
(443, 3, 28, 155000),
(444, 4, 28, 150000),
(445, 5, 28, 142000),
(446, 6, 28, 134000),
(447, 7, 28, 125000),
(448, 8, 28, 120000),
(449, 9, 28, 115000),
(450, 10, 28, 110000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `summary` longtext DEFAULT NULL,
  `photo` longtext DEFAULT NULL,
  `product_type` tinyint(4) NOT NULL DEFAULT 1,
  `category_id` tinyint(4) NOT NULL,
  `min_order` int(11) NOT NULL DEFAULT 1,
  `weight` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `status`, `name`, `slug`, `summary`, `photo`, `product_type`, `category_id`, `min_order`, `weight`, `description`) VALUES
(1, 1, 'Paket Acne', 'paket-acne', 'Paket Dasar Acne untuk kulit yang cenderung berjerawat dan beruntusan', 'http://127.0.0.1:8000/uploads/products/1686743000_acne.jpg', 1, 1, 1, NULL, 'Paket Dasar Acne merupakan paket skincare untuk perawatan kulit yang cenderung berjerawat dan beruntusan. Paket Dasar Acne terdiri dari 4 item, yaitu Facial Wash Acne, Toner Acne, Day Cream & Night Cream.\r\n\r\nManfaat dari Acne Series:\r\n1. Facial Wash Acne : membersihkan debu dan kotoran\r\n2. Toner Acne : mengembalikan pH wajah\r\n3. Day Cream : melindungi kulit dari paparan sinar matahari dan sinar UV\r\n4. Night Cream : meregenerasi dan memperbaiki sel-sel kulit\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia\r\n\r\nPembelian 1 paket dasar sudah disertakan mini bag (tas kecil)'),
(2, 1, 'Paket Brightening', 'paket-brightening-2306144558-516', 'Paket Dasar Brightening mampu mengatasi permasalahan kulit kusam.', 'http://127.0.0.1:8000/uploads/products/1686743158_brightening2.jpg', 1, 1, 1, NULL, 'Paket Dasar Brightening merupakan paket skincare dari Bening\'s Indonesia untuk mengatasi permasalahan kulis kusam dan juga menyamarkan bekas jerawat. Menutrisi kulit, sehingga cerah dan bening setiap hari.\r\nPaket dasar ini terdiri dari 4 item, yaitu Facial Wash Brightening. Toner Brightening, Day Cream & Night Cream.\r\n\r\n1. Facial Wash Brightening : pembersih wajah dengan busa lembut yang efektif mengangkat kotoran dan sisa riasan tanpa rasa kering.\r\n2. Toner Brightening : menyegarkan dan menghidrasi kulit secara maksimal.\r\n3. Day Cream Brightening : pelembab yang mencerahkan dan melindungi kulit dari paparan sinar UV\r\n4. Night Cream Brightening : mencerahkan, meratakan warna kulit dan menyamarkan noda hitam.\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia\r\n\r\nPembelian 1 paket dasar sudah disertakan dengan mini bag (tas kecil).'),
(3, 1, 'Paket Exclusive', 'paket-exclusive-2306144739-553', 'Paket Dasar Exclusive mengatasi flek hitam serta membantu mencerahkan dan membuat kulit wajahmu glowing.', 'http://127.0.0.1:8000/uploads/products/1686743259_exclusive2.jpg', 1, 1, 1, NULL, 'Paket Dasar Exclusive merupakan paket skincare dari Bening\'s Indonesia untuk mengatasi masalah kulit flek hitam dan mencerahkan dan membantu kulit wajahmu glowing.\r\nPaket Dasar Exclusive ini terdiri dari 4 item, yaitu Facial Wash Exclusive, Toner Exclusive, Day Cream & Night Cream.\r\n\r\nNetto per item:\r\n1. Facial Wash : 100 ml\r\n2. Toner : 100 ml\r\n3. Day Cream : 10 gr\r\n4. Night Cream : 10 gr\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia\r\n\r\nPembelian satu paket dasar sudah disertakan dengan mini bag (tas kecil).'),
(4, 1, 'Paket Mother Edition Brightening', 'paket-mother-edition-brightening', 'Paket Mother Edition Brightening mengatasi permasalahan kulit kusam yang aman digunakan untuk ibu hamil dan menyusui.', 'http://127.0.0.1:8000/uploads/products/1686746879_brightening-mother2.jpg', 1, 4, 1, NULL, 'Paket Mother Edition Brightening merupakan paket skincare dari Bening\'s Indonesia yang formulasikan dengan kandungan khusus dan aman untuk mengatasi kulit kusam pada ibu hami dan menyusui.\r\n\r\nPaket Mother Edition Brightening terdiri dari 4 item, yaitu:\r\n1. Facial Wash Mother Edition Brightening\r\n2. Toner Mother Edition Brightening\r\n3. Day Cream Mother Edition\r\n4. Night Cream Mother Edition.\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Aman untuk ibu hamil dan menyusui\r\n> Sudah dipercaya jutaan masyarakat Indonesia\r\n\r\nSetiap pembelian Paket Mother Edition sudah disertakan dengan mini bag (tas kecil).'),
(5, 1, 'Paket Mother Edition Acne', 'paket-mother-edition-acne', 'Paket Mother Edition Acne membantu mengatasi permasalahan kulit jerawat yang aman untuk ibu hamil dan menyusui.', 'http://127.0.0.1:8000/uploads/products/1686746991_acne-mother.jpg', 1, 4, 1, NULL, 'Paket Mother Edition Acne merupakan paket skincare dari Bening\'s Indonesia yang diformulasikan khusus untuk mengatasi masalah kuliat berjerawat yang aman untuk ibu hamil dan menyusui.\r\n\r\nPaket Mother Edition Acne ini terdiri dari 4 item, yaitu:\r\n1. Facial Wash Mother Edition Acne\r\n2. Toner Mother Edition Acne\r\n3. Day Cream Mother Edition\r\n4. Night Cream Mother Edition\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Aman untuk ibu hamil dan menyusui\r\n> Sudah dipercaya jutaan masyarakat Indonesia\r\n\r\nSetiap pembelian Paket Mother Edition sudah disertakan dengan mini bag (tas kecil).'),
(6, 1, 'Paket Mother Edition Exclusive', 'paket-mother-edition-exclusive', 'Paket Mother Edition Exclusive membantu mengatasi flek hitam yang aman bagi ibu hamil dan menyusui.', 'http://127.0.0.1:8000/uploads/products/1686747082_exclusive-mother.jpg', 1, 4, 1, NULL, 'Paket Mother Edition Exclusive merupakan paket skincare dari Bening\'s Indonesia yang diformulasikan dengan khusus untuk mengatasi permasalahan flek hitam yang aman digunakan untuk ibu hamil dan menyusui.\r\n\r\nPaket Mother Editiion Exclusive ini terdiri dari 4 item, yaitu:\r\n1. Facial Wash Mother Edition Exclusive\r\n2. Toner Mother Edition Exclusive\r\n3. Day Cream Exclusive\r\n4. Night Cream Exclusive\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Aman untuk ibu hamil dan menyusui\r\n> Sudah dipercaya jutaan masyarakat Indonesia\r\n\r\nSetiap pembelian Paket Mother Edition sudah disertakan dengan mini bag (tas kecil).'),
(7, 1, 'Acne Serum', 'acne-serum-2306145332-27', 'Acne Serum solusi terbaik untuk merawat kulit yang berjerawat dan berminyak.', 'http://127.0.0.1:8000/uploads/products/1686747212_acne-serum.jpg', 1, 2, 1, NULL, 'Acne Serum by Bening\'s Indonesia merupakan produk serum untuk merawat kulit yang berjerawat dan berminyak. Acne Serum mampu meredakan jerawat aktif, menutrisi kulit berjerawat dan mengurangi peradangan pada kulit.\r\nSerum ini cocok untuk #SahabatBening yang memiliki jenis kulit dengan tingkat produksi minyak tinggi, pori-pori besar, mudah tersumbat dan rentan muncul jerawat.\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(9, 1, 'Whitening Serum', 'whitening-serum', 'Whitening Serum membantu melembabkan dan mencerahkan kulit.', 'http://127.0.0.1:8000/uploads/products/1686747435_whitening-serum.jpg', 1, 2, 1, NULL, 'Whitening Serum by Bening\'s Indonesia merupakan serum perawatan untuk kulit cerah dan bening agar tampak halus dan bercahaya.\r\n\r\nWhitening Serum ini efektif untuk membantu:\r\n1. Mencerahkan kulit dari bintik-bintik hitam pada wajah\r\n2. Melembabkan dan mencerahkan kulit\r\n3. Memudarkan bekas jerawat, membantu menghilangkan prigmentasi\r\n4. Merevitalisasi kulit\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(8, 1, 'Dark Spot Serum', 'dark-spot-serum', 'Dark Spot Serum membantu memudarkan flek hitam, menyamarkan kerutan serta mengatasi tanda penuaan dini.', 'http://127.0.0.1:8000/uploads/products/1686747332_dark-spot-serum.jpg', 1, 2, 1, NULL, 'Dark Spot Serum by Bening\'s Indonesia merupakan produk serum yang dapat membantu meregenarasi kulit, menyamarkan noda hitam, dan meningkatkan kandungan kolagen pada kulit. Serum ini sangat cocok untuk menyamarkan kerutan serta mengatasi tanda penuaan dini.\r\n\r\nManfaat lain dari Dark Spot Serum:\r\n1. Mengangkat sel-sel kuliat mati dan meratakan tekstur wajah\r\n2. Mencerahkan kulit dan meratakan warna kulit\r\n3. Membantu melembabkan kulit dan menjaga skin barrier.\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(10, 1, 'Anti Aging Serum', 'anti-aging-serum', 'Anti Aging Serum membantu meregenerasi kulit dan mencegah penuaan pada kulit.', 'http://127.0.0.1:8000/uploads/products/1686747566_anti-aging-serum.jpg', 1, 2, 1, NULL, 'Anti Aging Serum by Bening\'s Indonesia merupakan serum yang membantu meregenerasi kulit, meningkatkan elastisitas, dan mengurangi kerutan serta garis halus pada kulit.\r\n\r\nAnti Aging Serum berfungsi:\r\n1. Meremajakan dan mencegah penuaan pada kulit\r\n2. Meningkatkan elastisitas\r\n3. Meregenerasi sel kulit\r\n4.  Mengurangi kerutan dan garis halus\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(11, 1, 'Gold Serum', 'gold-serum', 'Gold Serum  membantu mencerahkan kulit hingga memperkuat skin barier.', 'http://127.0.0.1:8000/uploads/products/1686747693_gold-serum.jpg', 1, 2, 1, NULL, 'Gold Serum by Bening\'s Indonesia merupakan serum yang dapat membantu mencerahkan, meningkatkan elastisitas kulit, dan meningkatkan produksi kolagen.\r\n\r\nGold Serum berfungsi:\r\n1. Mencerahkan\r\n2. Memudarkan noda hitam\r\n3. Memperbaiki skin barier\r\n4. Meningkatkan elastisitas kulit\r\n5. Meregenerasi kulit\r\n6. Meningkatkan produksi kolagen\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(12, 1, 'Chroma Body Lotion Varian Sweet', 'chroma-body-lotion-varian-sweet', 'Chroma Body Lotion Varian Sweet dengan karakter feminime dan menenangkan.', 'http://127.0.0.1:8000/uploads/products/1686747792_sweet.jpg', 1, 3, 1, NULL, 'Chroma Body Lotion dari Bening\'s Indonesia merupakan bodycare 3 in 1 (lotion, serum, dan parfum) yang berfungsi untuk memproteksi, melembabkan sekaligus mencerahkan kulit 15 kali lebih cepat. Mengandung SPF 30 untuk melindungi kulit dari paparan sinar matahari dan wangi aroma parfum tahan hingga 8 jam.\r\n\r\nVarian Sweet dengan karakter feminime dan menenangkan. Bisa menjadi mood booster, cocok untuk menemani dalam beraktivitas dan membuat orang-orang disekitarmu nyaman.\r\nSweet : Bergamot, Jasmine, Patchouly\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(13, 1, 'Chroma Body Lotion Varian Reborn', 'chroma-body-lotion-varian-reborn', 'Chroma Body Lotion Varian Reborn dengan karakter yang fresh, energizing, dan ceria.', 'http://127.0.0.1:8000/uploads/products/1686747873_reborn.jpg', 1, 3, 1, NULL, 'Chroma Body Lotion dari Bening\'s Indonesia merupakan bodycare 3 in 1 (lotion, serum, dan parfum) yang berfungsi untuk memproteksi, melembabkan sekaligus mencerahkan kulit 15 kali lebih cepat. Mengandung SPF 30 untuk melindungi kulit dari paparan sinar matahari dan wangi aroma parfum tahan hingga 8 jam.\r\n\r\nVarian Reborn dengan karakter yang fresh, energizing, dan ceria yang suka mencoba hal-hal baru dan bersemangat dalam menjalani hari.\r\nSweet : Melon, Flower Lily, Cotton Candy\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(14, 1, 'Chroma Body Lotion Varian Love', 'chroma-body-lotion-varian-love', 'Chroma Body Lotion Barian Love dengan karakter anggun, romatis, dan lembut yang memikat.', 'http://127.0.0.1:8000/uploads/products/1686747950_love.jpg', 1, 3, 1, NULL, 'Chroma Body Lotion dari Bening\'s Indonesia merupakan bodycare 3 in 1 (lotion, serum, dan parfum) yang berfungsi untuk memproteksi, melembabkan sekaligus mencerahkan kulit 15 kali lebih cepat. Mengandung SPF 30 untuk melindungi kulit dari paparan sinar matahari dan wangi aroma parfum tahan hingga 8 jam.\r\n\r\nVarian Love dengan karakter yang anggun, romantis dan lembut yang memikat. Membuat penampilanmu semakin percaya diri.\r\nSweet : Lychee, Rose, Sandalwood\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(15, 0, 'OkySlim', 'okyslim', 'OkySlim merupakan minuman kesehatan yang mengandung fiber sehingga dapat menurunkan Berat Badan.', 'http://127.0.0.1:8000/uploads/products/1686748237_okyslim.jpg', 1, 3, 1, NULL, 'OkySlim merupakan minuman kesehatan yang mengandung fiber sehingga dapat menurunkan Berat Badan dengan cara memperlancar BAB tanpa ada rasa mules dan menghancurkan lemak yang menimbun di dalam tubuh.\r\n\r\nManfaat OkySlim:\r\n1. Memperlancar pencernaan\r\n2. Sebagai antioksidan\r\n3. Sebagai penahan lapar\r\n4. Menjaga daya tahan tubuh\r\n5. Meningkatkan nutrisi pada makanan dan pencegahan infeksi usus\r\n\r\nHarga tertera per pcs, bukan perkotak.\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(16, 0, 'OkyWhite', 'okywhite-2306164912-686', 'OkyWhite minuman kesehatan yang mampu memberikan efek sebagai anti skin aging dan juga skin whitening.', 'http://127.0.0.1:8000/uploads/products/1686748117_okywhite4.jpg', 1, 3, 1, NULL, 'OkyWhite merupakan minuman kesehatan yang mengandung fish collagen sebagi anti oxidant serta mampu memberikan efek sebagai anti skin aging dan juga skin whitening. Selain itu juga mengandung tinggi kolagen dan Glutathione sehingga dapat mencerahkan kulit seluruh tubuh.\r\n\r\nManfaat OkyWhite:\r\n1. Menjaga elastisitas kulit\r\n2. Memperlambat proses penuaan kulit\r\n3. Mencerahkan dan melembabkan\r\n4. Membantu regenerasi sel\r\n5. Sebagai anti aging\r\n6. Meningkatkan peremajaan kulit\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(18, 1, 'Facial Wash Acne', 'facial-wash-acne-2306141600-291', 'Pembersih wajah dengan busa lembut untuk varian Ance', 'http://127.0.0.1:8000/uploads/products/1686750627_facial-wash-acne.jpg', 1, 5, 1, NULL, 'Facial Wash Acne merupakan sabun cuci wajah untuk mengontrol kelenjar minyak berlebih sehingga jerawat dan beruntusan dapat diatasi.\r\nMengandung Tea Tree Leaf Oil, Chamomilla.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(17, 1, 'Facial Wash Brightening', 'facial-wash-brightening', 'Pembersih wajah dengan busa lembut untuk varian Brightening', 'http://127.0.0.1:8000/uploads/products/1686742881_facial-wash-brightening.jpg', 1, 5, 1, NULL, 'Facial Wash Brightening merupakan sabun cuci wajah yang mampu mengatasi permasalahan kulit wajah kusam agar terlihat lebih cerah dan glowing.\r\nMengandung Lactic Acid.\r\n\r\nNetto: 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(21, 1, 'Toner Acne', 'toner-acne', 'Mengembalikan pH wajah untuk varian Acne', 'http://127.0.0.1:8000/uploads/products/1686751828_toner-acne.jpg', 1, 5, 1, NULL, 'Mengontrol kelenjar minyak sehingga jerawat dan beruntusan dapat diatasi.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(19, 1, 'Facial Wash Exclusive', 'facial-wash-exclusive', 'Pembersih wajah dengan busa lembut untuk varian Exclusive yang mampu membersihkan kotoran hingga ke pori-pori.', 'http://127.0.0.1:8000/uploads/products/1686750966_facial-wash-exclusive4.jpg', 1, 5, 1, NULL, 'Facial Wash Exclusive merupakan pembersih wajah yang mengatasi masalah flek, agar terlihat lebih cerah dan glowing. Menyegarkan, mengangkat sel kulit mati, dan mengembalikan pH kulit wajah.\r\nMengandung Aloe Barbadensis Leaf Juice.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(20, 1, 'Toner Brightening', 'toner-brightening', 'Menyegarkan dan menghidrasi kulit untuk varian Brightening', 'http://127.0.0.1:8000/uploads/products/1686751550_toner-brightening2.jpg', 1, 5, 1, NULL, 'Toner Brightening mampu mengatasi permasalahan kulit wajah kusam agar terlihat lebih cerah dan glowing.\r\nMengandung Lactic Acid, Hamamelis Virginiana Water.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(22, 1, 'Toner Exclusive', 'toner-exclusive', 'Menyegarkan, mengangkat sel kulit mati dan mengembalikan pH kulit wajah.', 'http://127.0.0.1:8000/uploads/products/1686752446_toner-exclusive.jpg', 1, 5, 1, NULL, 'Toner yang mengatasi masalah flek, agar terlihat lebih cerah dan glowing.\r\nMengandung Sodium Lactate, Recutita Flower Extract.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(23, 1, 'Day Cream Brightening', 'day-cream-brightening', 'Cream siang yang mampu mencerahkan dan melindungi kulit wajah dari paparan buruk sinar matahari.', 'http://127.0.0.1:8000/uploads/products/1686752578_day-cream-brightening.jpg', 1, 5, 1, NULL, 'Day Cream Brightening merupakan cream siang yang mampu mencerahkan dan melindungi kulit wajah dari paparan buruk sinar matahari.\r\nMengandung Alpha-Arbutin.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(24, 1, 'Day Cream Acne', 'day-cream-acne-2306142659-142', 'Mencerahkan dan melindungi kulit wajah dari paparan sinar buruk matahari.', 'http://127.0.0.1:8000/uploads/products/1686752638_day-cream-acne.jpg', 1, 5, 1, NULL, 'Day Cream Ance merupakan cream siang yang mampu mencerahkan dan melindungi kulit wajah dari paparan sinar buruk matahari. Dengan bahan aktif ‘Oil Free’ yang cocok untuk kulit yang berminyak dan berjerawat.\r\nMengandung Niacinamide.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(25, 1, 'Day Cream Exclusive', 'day-cream-exclusive-2306142809-483', 'Cream siang yang mengatasi masalah flek serta mencerahkan dan melindungi kulit wajah dari paparan buruk sinar matahari.', 'http://127.0.0.1:8000/uploads/products/1686752698_day-cream-exclusive.jpg', 1, 5, 1, NULL, 'Day Cream Exclusive merupakan cream siang yang mengatasi masalah flek serta mencerahkan dan melindungi kulit wajah dari paparan buruk sinar matahari.\r\nMengandung Sodium Lactate, Soluble Collagen.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(26, 1, 'Night Cream Brightening', 'night-cream-brightening', 'Cream malam yang berfungsi untuk membuat wajah terlihat cerah dan glowing.', 'http://127.0.0.1:8000/uploads/products/1686752779_night-cream-brightening.jpg', 1, 5, 1, NULL, 'Night Cream Brightening merupakan cream malam yang berfungsi untuk membuat wajah terlihat cerah dan glowing.\r\nMengandung Niacinamide, Alpha-Arbutin, Retinol Molecular, Simmondsia Chinensis Seed Oil.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(27, 1, 'Night Cream Acne', 'night-cream-acne', 'Cream malam yang dapat mengatasi permasalahan minyak berlebih sehingga jerawat dan beruntusan dapat diatasi.', 'http://127.0.0.1:8000/uploads/products/1686753027_night-cream-acne.jpg', 1, 5, 1, NULL, 'Night Cream Acne merupakan cream malam yang dapat mengatasi permasalahan minyak berlebih sehingga jerawat dan beruntusan dapat diatasi.\r\nMengandung Niacinamide, Retinol Molecular, Bee Venom.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia'),
(28, 1, 'Night Cream Exclusive', 'night-cream-exclusive', 'Cream malam yang mengatasi permasalahan flek, agar terlihat lebih cerah dan glowing.', 'http://127.0.0.1:8000/uploads/products/1686753131_night-cream-exclusive.jpg', 1, 5, 1, NULL, 'Night Cream Exclusive merupakan cream malam yang mengatasi permasalahan flek, agar terlihat lebih cerah dan glowing.\r\nMengandung Niacinamide, Alpha-Arbutin, Simmondsia Chinensis Seed Oil, Retinyl Palmitate, Retinol Molecular.\r\n\r\nNetto : 100 ml\r\n\r\n> Sudah terdaftar BPOM\r\n> Skincare Halal\r\n> Tidak membuat ketergantungan\r\n> Sudah dipercaya jutaan masyarakat Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit` varchar(191) NOT NULL DEFAULT '1',
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `url` varchar(191) NOT NULL,
  `thumbnail` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `recipient` varchar(191) NOT NULL,
  `amount` double NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `purchase_date`, `recipient`, `amount`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-06-16 04:42:58', 'admin', 26000000, NULL, NULL, '2023-06-15 21:42:58', '2023-06-15 21:42:58'),
(2, 1, '2023-06-16 04:43:49', 'admin', 26000000, NULL, NULL, '2023-06-15 21:43:49', '2023-06-15 21:43:49'),
(3, 1, '2023-06-16 04:44:16', 'admin', 28500000, NULL, NULL, '2023-06-15 21:44:16', '2023-06-15 21:44:16'),
(4, 1, '2023-06-16 04:44:42', 'admin', 3100000, NULL, NULL, '2023-06-15 21:44:42', '2023-06-15 21:44:42'),
(5, 1, '2023-06-16 04:45:03', 'admin', 3100000, NULL, NULL, '2023-06-15 21:45:03', '2023-06-15 21:45:03'),
(6, 1, '2023-06-16 04:45:19', 'admin', 6200000, NULL, NULL, '2023-06-15 21:45:19', '2023-06-15 21:45:19'),
(7, 1, '2023-06-16 04:45:55', 'admin', 1900000, NULL, NULL, '2023-06-15 21:45:55', '2023-06-15 21:45:55'),
(8, 1, '2023-06-16 04:46:25', 'admin', 2175000, NULL, NULL, '2023-06-15 21:46:25', '2023-06-15 21:46:25'),
(9, 1, '2023-06-16 04:46:50', 'admin', 1700000, NULL, NULL, '2023-06-15 21:46:50', '2023-06-15 21:46:50'),
(10, 1, '2023-06-16 04:47:09', 'admin', 775000, NULL, NULL, '2023-06-15 21:47:09', '2023-06-15 21:47:09'),
(11, 1, '2023-06-16 04:47:35', 'admin', 17000000, NULL, NULL, '2023-06-15 21:47:35', '2023-06-15 21:47:35'),
(12, 1, '2023-06-16 04:47:59', 'admin', 325000, NULL, NULL, '2023-06-15 21:47:59', '2023-06-15 21:47:59'),
(13, 1, '2023-06-16 04:48:14', 'admin', 325000, NULL, NULL, '2023-06-15 21:48:14', '2023-06-15 21:48:14'),
(14, 1, '2023-06-16 04:48:30', 'admin', 325000, NULL, NULL, '2023-06-15 21:48:30', '2023-06-15 21:48:30'),
(15, 1, '2023-06-16 04:49:51', 'admin', 1425000, NULL, NULL, '2023-06-15 21:49:51', '2023-06-15 21:49:51'),
(16, 1, '2023-06-16 04:50:12', 'admin', 1140000, NULL, NULL, '2023-06-15 21:50:12', '2023-06-15 21:50:12'),
(17, 1, '2023-06-16 04:50:33', 'admin', 1710000, NULL, NULL, '2023-06-15 21:50:33', '2023-06-15 21:50:33'),
(18, 1, '2023-06-16 04:50:56', 'admin', 530000, NULL, NULL, '2023-06-15 21:50:56', '2023-06-15 21:50:56'),
(19, 1, '2023-06-16 04:51:10', 'admin', 530000, NULL, NULL, '2023-06-15 21:51:10', '2023-06-15 21:51:10'),
(20, 1, '2023-06-16 04:51:21', 'admin', 530000, NULL, NULL, '2023-06-15 21:51:21', '2023-06-15 21:51:21'),
(21, 1, '2023-06-16 04:51:44', 'admin', 3900000, NULL, NULL, '2023-06-15 21:51:44', '2023-06-15 21:51:44'),
(22, 1, '2023-06-16 04:52:16', 'admin', 2340000, NULL, NULL, '2023-06-15 21:52:16', '2023-06-15 21:52:16'),
(23, 1, '2023-06-16 04:52:30', 'admin', 780000, NULL, NULL, '2023-06-15 21:52:30', '2023-06-15 21:52:30'),
(24, 1, '2023-06-16 04:52:51', 'admin', 7840000, NULL, NULL, '2023-06-15 21:52:51', '2023-06-15 21:52:51'),
(25, 1, '2023-06-16 04:53:03', 'admin', 5600000, NULL, NULL, '2023-06-15 21:53:03', '2023-06-15 21:53:03'),
(26, 1, '2023-06-16 04:53:16', 'admin', 12500000, NULL, NULL, '2023-06-15 21:53:16', '2023-06-15 21:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit` varchar(191) NOT NULL DEFAULT 'pcs',
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `unit`, `qty`, `price`) VALUES
(1, 1, 1, 'pcs', 100, 260000),
(2, 2, 2, 'pcs', 100, 260000),
(3, 3, 3, 'pcs', 100, 285000),
(4, 4, 4, 'pcs', 10, 310000),
(5, 5, 5, 'pcs', 10, 310000),
(6, 6, 6, 'pcs', 20, 310000),
(7, 7, 7, 'pcs', 20, 95000),
(8, 8, 9, 'pcs', 15, 145000),
(9, 9, 8, 'pcs', 10, 170000),
(10, 10, 10, 'pcs', 5, 155000),
(11, 11, 11, 'pcs', 100, 170000),
(12, 12, 12, 'pcs', 5, 65000),
(13, 13, 13, 'pcs', 5, 65000),
(14, 14, 14, 'pcs', 5, 65000),
(15, 15, 18, 'pcs', 25, 57000),
(16, 16, 17, 'pcs', 20, 57000),
(17, 17, 19, 'pcs', 30, 57000),
(18, 18, 21, 'pcs', 10, 53000),
(19, 19, 20, 'pcs', 10, 53000),
(20, 20, 22, 'pcs', 10, 53000),
(21, 21, 23, 'pcs', 50, 78000),
(22, 22, 24, 'pcs', 30, 78000),
(23, 23, 25, 'pcs', 10, 78000),
(24, 24, 26, 'pcs', 70, 112000),
(25, 25, 27, 'pcs', 50, 112000),
(26, 26, 28, 'pcs', 100, 125000);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `status`, `name`, `description`) VALUES
(1, 1, 'Medan SUMUT', NULL),
(2, 1, 'Siantar Simalungun', NULL),
(3, 1, 'Medan Amplas', NULL),
(4, 1, 'Paal Merah Jambi', NULL),
(5, 1, 'Pematang Siantar', NULL),
(6, 1, 'Pakpak Bharat', NULL),
(7, 1, 'Medan Timur', NULL),
(8, 1, 'Rantau Prapat', NULL),
(9, 1, 'Batu Bara', NULL),
(10, 1, 'Langga Payung', NULL),
(11, 1, 'Tarutung', NULL),
(12, 1, 'Langkat', NULL),
(13, 1, 'Medan Belawan', NULL),
(14, 1, 'Siantar Kota', NULL),
(15, 1, 'Medan Percut', NULL),
(16, 1, 'Marindal', NULL),
(17, 1, 'Binjai Timur', NULL),
(18, 1, 'Sei Mencirim', NULL),
(19, 1, 'Sampuran', NULL),
(20, 1, 'Pulau Burung', NULL),
(21, 1, 'Siantar Simarimbun', NULL),
(22, 1, 'Ranto Prapat', NULL),
(23, 1, 'Tiga Balata', NULL),
(24, 1, 'Martubung', NULL),
(25, 1, 'Gunung Sitoli', NULL),
(26, 1, 'Sigambal', NULL),
(27, 1, 'Perdagangan', NULL),
(28, 1, 'Klaten', NULL),
(29, 1, 'Stabat', NULL),
(30, 1, 'Saribudolok', NULL),
(31, 1, 'Nias Selatan', NULL),
(32, 1, 'Medan Selayang', NULL),
(33, 1, 'Simpang Peut Nagan Raya', NULL),
(34, 1, 'Siantar Timur', NULL),
(35, 1, 'Sidorame Medan', NULL),
(36, 1, 'Simalingkar', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `total` int(11) NOT NULL,
  `sale_date` datetime NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit` varchar(191) NOT NULL DEFAULT 'pcs',
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext NOT NULL,
  `short_des` text NOT NULL,
  `logo` varchar(191) NOT NULL,
  `logo_admin` varchar(191) DEFAULT NULL,
  `favicon` varchar(191) DEFAULT NULL,
  `photo` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `description`, `short_des`, `logo`, `logo_admin`, `favicon`, `photo`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'PT. Bening’s Indonesia merupakan perusahaan yang bergerak di bidang penjualan produk skincare maupun bodycare dan kebutuhan untuk perawatan kulit dan kecantikan lainnya dengan nama brand  Bening’s Indonesia yang didirikan pada awal tahun 2021 oleh seorang dokter kecantikan yaitu dr. Oky Pratama. PT. Bening’s Indonesia ini telah memiliki mitra di hampir seluruh Indonesia, terutama di Sumatera Utara. Di Sumatera Utara sendiri telah ada mitra PT. Bening’s Indonesia yaitu Distributor Bening’s Medan SUMUT yang sudah memiliki 40 lebih mitra yang tersebar di Provinsi Sumatera Utara bahkan ke provinsi lainnya mulai dari Kota Medan, Siantar Simalungun, Tapanuli Utara, Aceh, Jambi bahkan ke pulau Nias dan daerah lainnya.  Bening\'s Distributor Medan SUMUT sendiri dibawah naungan TEAM BRILIANT dari Distributor Karawang.\r\n\r\nBening\'s Distributor Medan SUMUT ini sendiri sudah menjadi mitra dari PT. Bening’s Indonesia sejak akhir tahun 2021 dan saat ini sudah mempunyai 44 mitra yang tersebar di daerah Sumatera Utara bahkan hingga ke Provinsi Jambi dan Aceh.\r\n\r\nBening\'s Distributor Medan SUMUT ini dibawah manajemen Digna Simbolon (ibu Geraldine) dan suaminya Ade Jhon Panjaitan (bapak Geraldine).\r\n\r\nUntuk produk segera cek di menu produk dan segera Order.\r\nUntuk info lebih lanjut mengenai kemitraan, langsung hubungi ke No. WA yang ada di menu Contact Us.\r\n\r\nBening\'s Indonesia:\r\n1. Sudah terdaftar BPOM\r\n2. Skincare Halal\r\n3. Tidak membuat ketergantungan\r\n4. Memiliki produk khusus yang aman bagi ibu hamil dan menyusui\r\n5. Sudah dipercaya jutaan masyarakat Indonesia', 'Bening\'s Distributor Medan SUMUT adalah distributor resmi terdaftar di PT. Bening\'s Indonesia yang mencakup area Medan Sumatera Utara dan sekitarnya.', 'http://127.0.0.1:8000/uploads/settings/1684940357_logo.jpg', 'http://127.0.0.1:8000/uploads/settings/1684940073_logo-admin-benings.png', 'http://127.0.0.1:8000/uploads/settings/1684940073_favicon-benings.png', 'http://127.0.0.1:8000/uploads/settings/1684939622_benings-dist-medan-sumut.jpg', 'Jl. Madio Santoso Gg. Tello No. 6 Pulo Brayan I, Kec. Medan Timur', '081916657999', 'beningsdistributormedansumut@gmail.com', NULL, '2023-06-15 20:27:50');

-- --------------------------------------------------------

--
-- Stand-in structure for view `stock_views`
-- (See below for the actual view)
--
CREATE TABLE `stock_views` (
`id` bigint(20) unsigned
,`name` varchar(191)
,`stock` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(191) NOT NULL,
  `level_id` int(11) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `status`, `name`, `level_id`, `phone`, `email`, `address`, `description`) VALUES
(1, 1, 'Pusat', 10, NULL, NULL, NULL, NULL),
(2, 1, 'Mona Batam Kepri', 8, NULL, NULL, NULL, NULL),
(3, 1, 'Distributor Karawang', 10, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `upline` int(11) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `instagram` varchar(191) DEFAULT NULL,
  `birth_place` varchar(191) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `sub_district` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `bank_number` varchar(191) DEFAULT NULL,
  `level_id` int(11) DEFAULT 1,
  `region_id` int(11) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `id_card_photo` text DEFAULT NULL,
  `id_card_number` varchar(191) DEFAULT NULL,
  `another_partner` tinyint(1) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `status`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `upline`, `phone`, `instagram`, `birth_place`, `birth_date`, `gender`, `sub_district`, `city`, `address`, `bank_name`, `bank_number`, `level_id`, `region_id`, `photo`, `id_card_photo`, `id_card_number`, `another_partner`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$TYjj.hKIa2Asty.j0wVfg.4PzccSzPreHgAM.paXV434QisHvSmTy', NULL, NULL, '081212121212', NULL, 'Medan', '2001-10-23', 'Laki-laki', 'Medan Timur', 'Medan', 'Jl. Selamat No. 41 Durian', NULL, NULL, 1, NULL, 'http://127.0.0.1:8000/uploads/users/1684677829_Fotor_AI.png', NULL, NULL, NULL, 1, NULL, '2023-06-15 20:33:54'),
(24, 1, 'User Test', 'user@gmail.com', NULL, '$2y$10$oTm7qSOOU6Md/M2FGeathOlM5.8/PHuaeV5lYikawlaf/VRWxoUrO', NULL, NULL, '081344445555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 7, NULL, NULL, NULL, NULL, 2, '2025-05-14 18:04:49', '2025-05-14 18:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banners_slug_unique` (`slug`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_index` (`product_id`),
  ADD KEY `carts_user_id_index` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `price_levels`
--
ALTER TABLE `price_levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_levels_product_id_index` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_index` (`category_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_product_id_index` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_index` (`product_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_supplier_id_index` (`supplier_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_purchase_id_index` (`purchase_id`),
  ADD KEY `purchase_details_product_id_index` (`product_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_user_id_index` (`user_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_purchase_id_index` (`sale_id`),
  ADD KEY `sale_details_product_id_index` (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_level_id_index` (`level_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_level_id_index` (`level_id`),
  ADD KEY `users_region_id_index` (`region_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_index` (`product_id`),
  ADD KEY `wishlists_cart_id_index` (`cart_id`),
  ADD KEY `wishlists_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_levels`
--
ALTER TABLE `price_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

-- --------------------------------------------------------

--
-- Structure for view `stock_views`
--
DROP TABLE IF EXISTS `stock_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock_views`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, (select sum(`purchase_details`.`qty`) from `purchase_details` where `purchase_details`.`product_id` = `pd`.`product_id`) - coalesce((select sum(`sale_details`.`qty`) from `sale_details` where `sale_details`.`product_id` = `pd`.`product_id`),0) AS `stock` FROM (`products` `p` join `purchase_details` `pd` on(`pd`.`product_id` = `p`.`id`)) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
