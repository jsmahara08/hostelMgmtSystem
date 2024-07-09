-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 06:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  `image` varchar(225) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `role` enum('admin','manager') NOT NULL DEFAULT 'admin',
  `status` varchar(512) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `image`, `phone`, `role`, `status`) VALUES
(6, 'admin', 'admin@gmail.com', '$2y$10$xecpIYeN.dWFeZVJZZ6cxe8Fo/kHcN.Mz2vkSYlpcXmhCogV9fZ2K', 'img-15-04-2024-1713194426.png', 9762796238, 'admin', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `province_id`, `name`) VALUES
(1, 1, 'BHOJPUR'),
(2, 1, 'DHANKUTA'),
(3, 1, 'ILAM'),
(4, 1, 'JHAPA'),
(5, 1, 'KHOTANG'),
(6, 1, 'MORANG'),
(7, 1, 'OKHALDHUNGA'),
(8, 1, 'PANCHTHAR'),
(9, 1, 'SANKHUWASABHA'),
(10, 1, 'SOLUKHUMBU'),
(11, 1, 'SUNSARI'),
(12, 1, 'TAPLEJUNG'),
(13, 1, 'TERHATHUM'),
(14, 1, 'UDAYAPUR'),
(15, 2, 'BARA'),
(16, 2, 'DHANUSA'),
(17, 2, 'MAHOTTARI'),
(18, 2, 'PARSA'),
(19, 2, 'RAUTAHAT'),
(20, 2, 'SAPTARI'),
(21, 2, 'SARLAHI'),
(22, 2, 'SIRAHA'),
(23, 3, 'BHAKTAPUR'),
(24, 3, 'CHITAWAN'),
(25, 3, 'DHADING'),
(26, 3, 'DOLAKHA'),
(27, 3, 'KATHMANDU'),
(28, 3, 'KAVREPALANCHOK'),
(29, 3, 'LALITPUR'),
(30, 3, 'MAKWANPUR'),
(31, 3, 'NUWAKOT'),
(32, 3, 'RAMECHHAP'),
(33, 3, 'RASUWA'),
(34, 3, 'SINDHULI'),
(35, 3, 'SINDHUPALCHOK'),
(36, 4, 'BAGLUNG'),
(37, 4, 'GORKHA'),
(38, 4, 'KASKI'),
(39, 4, 'LAMJUNG'),
(40, 4, 'MANANG'),
(41, 4, 'MUSTANG'),
(42, 4, 'MYAGDI'),
(43, 4, 'NAWALPARASI EAST'),
(44, 4, 'PARBAT'),
(45, 4, 'SYANGJA'),
(46, 4, 'TANAHU'),
(47, 5, 'ARGHAKHANCHI'),
(48, 5, 'BANKE'),
(49, 5, 'BARDIYA'),
(50, 5, 'DANG'),
(51, 5, 'GULMI'),
(52, 5, 'KAPILBASTU'),
(53, 5, 'NAWALPARASI WEST'),
(54, 5, 'PALPA'),
(55, 5, 'PYUTHAN'),
(56, 5, 'ROLPA'),
(57, 5, 'RUKUM EAST'),
(58, 5, 'RUPANDEHI'),
(59, 6, 'DAILEKH'),
(60, 6, 'DOLPA'),
(61, 6, 'HUMLA'),
(62, 6, 'JAJARKOT'),
(63, 6, 'JUMLA'),
(64, 6, 'KALIKOT'),
(65, 6, 'MUGU'),
(66, 6, 'RUKUM WEST'),
(67, 6, 'SALYAN'),
(68, 6, 'SURKHET'),
(69, 7, 'ACHHAM'),
(70, 7, 'BAITADI'),
(71, 7, 'BAJHANG'),
(72, 7, 'BAJURA'),
(73, 7, 'DADELDHURA'),
(74, 7, 'DARCHULA'),
(75, 7, 'DOTI'),
(76, 7, 'KAILALI'),
(77, 7, 'KANCHANPUR');

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `name`) VALUES
(1, 'Ground Floor'),
(2, 'First Floor'),
(3, 'Second Floor'),
(4, 'Third Floor'),
(5, 'Fourth Floor'),
(6, 'Fifth Floor');

-- --------------------------------------------------------

--
-- Table structure for table `municipalities`
--

CREATE TABLE `municipalities` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `municipalities`
--

INSERT INTO `municipalities` (`id`, `district_id`, `name`) VALUES
(1, 1, 'Aamchowk Rural Municipality'),
(2, 1, 'Arun Rural Municipality'),
(3, 1, 'Bhojpur Municipality'),
(4, 1, 'Hatuwagadhi Rural Municipality'),
(5, 1, 'Pauwadungma Rural Municipality'),
(6, 1, 'Ramprasad Rai Rural Municipality'),
(7, 1, 'Salpasilichho Rural Municipality'),
(8, 1, 'Shadananda Municipality'),
(9, 1, 'Temkemaiyung Rural Municipality'),
(10, 2, 'Chaubise Rural Municipality'),
(11, 2, 'Chhathar Jorpati Rural Municipality'),
(12, 2, 'Dhankuta Municipality'),
(13, 2, 'Mahalaxmi Municipality'),
(14, 2, 'Pakhribas Municipality'),
(15, 2, 'Sangurigadhi Rural Municipality'),
(16, 2, 'Shahidbhumi Rural Municipality'),
(17, 3, 'Chulachuli Rural Municipality'),
(18, 3, 'Deumai Municipality'),
(19, 3, 'Fakphokthum Rural Municipality'),
(20, 3, 'Illam Municipality'),
(21, 3, 'Mai Municipality'),
(22, 3, 'Maijogmai Rural Municipality'),
(23, 3, 'Mangsebung Rural Municipality'),
(24, 3, 'Rong Rural Municipality'),
(25, 3, 'Sandakpur Rural Municipality'),
(26, 3, 'Suryodaya Municipality'),
(27, 4, 'Arjundhara Municipality'),
(28, 4, 'Barhadashi Rural Municipality'),
(29, 4, 'Bhadrapur Municipality'),
(30, 4, 'Birtamod Municipality'),
(31, 4, 'Buddhashanti Rural Municipality'),
(32, 4, 'Damak Municipality'),
(33, 4, 'Gauradhaha Municipality'),
(34, 4, 'Gauriganj Rural Municipality'),
(35, 4, 'Haldibari Rural Municipality'),
(36, 4, 'Jhapa Rural Municipality'),
(37, 4, 'Kachankawal Rural Municipality'),
(38, 4, 'Kamal Rural Municipality'),
(39, 4, 'Kankai Municipality'),
(40, 4, 'Mechinagar Municipality'),
(41, 4, 'Shivasataxi Municipality'),
(42, 5, 'Ainselukhark Rural Municipality'),
(43, 5, 'Barahapokhari Rural Municipality'),
(44, 5, 'Diktel Rupakot Majhuwagadhi Municipality'),
(45, 5, 'Diprung Chuichumma Rural Municipality'),
(46, 5, 'Halesi Tuwachung Municipality'),
(47, 5, 'Jantedhunga Rural Municipality'),
(48, 5, 'Kepilasagadhi Rural Municipality'),
(49, 5, 'Khotehang Rural Municipality'),
(50, 5, 'Rawa Besi Rural Municipality'),
(51, 5, 'Sakela Rural Municipality'),
(52, 6, 'Belbari Municipality'),
(53, 6, 'Biratnagar Metropolitian City'),
(54, 6, 'Budhiganga Rural Municipality'),
(55, 6, 'Dhanpalthan Rural Municipality'),
(56, 6, 'Gramthan Rural Municipality'),
(57, 6, 'Jahada Rural Municipality'),
(58, 6, 'Kanepokhari Rural Municipality'),
(59, 6, 'Katahari Rural Municipality'),
(60, 6, 'Kerabari Rural Municipality'),
(61, 6, 'Letang Municipality'),
(62, 6, 'Miklajung Rural Municipality'),
(63, 6, 'Patahrishanishchare Municipality'),
(64, 6, 'Rangeli Municipality'),
(65, 6, 'Ratuwamai Municipality'),
(66, 6, 'Sundarharaicha Municipality'),
(67, 6, 'Sunwarshi Municipality'),
(68, 6, 'Uralabari Municipality'),
(69, 7, 'Champadevi Rural Municipality'),
(70, 7, 'Chisankhugadhi Rural Municipality'),
(71, 7, 'Khijidemba Rural Municipality'),
(72, 7, 'Likhu Rural Municipality'),
(73, 7, 'Manebhanjyang Rural Municipality'),
(74, 7, 'Molung Rural Municipality'),
(75, 7, 'Siddhicharan Municipality'),
(76, 7, 'Sunkoshi Rural Municipality'),
(77, 8, 'Falelung Rural Municipality'),
(78, 8, 'Falgunanda Rural Municipality'),
(79, 8, 'Hilihang Rural Municipality'),
(80, 8, 'Kummayak Rural Municipality'),
(81, 8, 'Miklajung Rural Municipality'),
(82, 8, 'Phidim Municipality'),
(83, 8, 'Tumbewa Rural Municipality'),
(84, 8, 'Yangwarak Rural Municipality'),
(85, 9, 'Bhotkhola Rural Municipality'),
(86, 9, 'Chainpur Municipality'),
(87, 9, 'Chichila Rural Municipality'),
(88, 9, 'Dharmadevi Municipality'),
(89, 9, 'Khandbari Municipality'),
(90, 9, 'Madi Municipality'),
(91, 9, 'Makalu Rural Municipality'),
(92, 9, 'Panchakhapan Municipality'),
(93, 9, 'Sabhapokhari Rural Municipality'),
(94, 9, 'Silichong Rural Municipality'),
(95, 10, 'Khumbupasanglahmu Rural Municipality'),
(96, 10, 'Likhupike Rural Municipality'),
(97, 10, 'Maapya Dudhkoshi Rural Municipality'),
(98, 10, 'Mahakulung Rural Municipality'),
(99, 10, 'Nechasalyan Rural Municipality'),
(100, 10, 'Solududhakunda Municipality'),
(101, 10, 'Sotang Rural Municipality'),
(102, 10, 'Thulung Dudhkoshi Rural Municipality'),
(103, 11, 'Barahchhetra Municipality'),
(104, 11, 'Barju Rural Municipality'),
(105, 11, 'Bhokraha Narsing Rural Municipality'),
(106, 11, 'Dewanganj Rural Municipality'),
(107, 11, 'Dharan Sub-Metropolitian City'),
(108, 11, 'Duhabi Municipality'),
(109, 11, 'Gadhi Rural Municipality'),
(110, 11, 'Harinagar Rural Municipality'),
(111, 11, 'Inaruwa Municipality'),
(112, 11, 'Itahari Sub-Metropolitian City'),
(113, 11, 'Koshi Rural Municipality'),
(114, 11, 'Ramdhuni Municipality'),
(115, 12, 'Aathrai Tribeni Rural Municipality'),
(116, 12, 'Maiwakhola Rural Municipality'),
(117, 12, 'Meringden Rural Municipality'),
(118, 12, 'Mikwakhola Rural Municipality'),
(119, 12, 'Pathivara Yangwarak Rural Municipality'),
(120, 12, 'Phaktanglung Rural Municipality'),
(121, 12, 'Phungling Municipality'),
(122, 12, 'Sidingba Rural Municipality'),
(123, 12, 'Sirijangha Rural Municipality'),
(124, 13, 'Aathrai Rural Municipality'),
(125, 13, 'Chhathar Rural Municipality'),
(126, 13, 'Laligurans Municipality'),
(127, 13, 'Menchayam Rural Municipality'),
(128, 13, 'Myanglung Municipality'),
(129, 13, 'Phedap Rural Municipality'),
(130, 14, 'Belaka Municipality'),
(131, 14, 'Chaudandigadhi Municipality'),
(132, 14, 'Katari Municipality'),
(133, 14, 'Limchungbung Rural Municipality'),
(134, 14, 'Rautamai Rural Municipality'),
(135, 14, 'Tapli Rural Municipality'),
(136, 14, 'Triyuga Municipality'),
(137, 14, 'Udayapurgadhi Rural Municipality'),
(138, 15, 'Adarshkotwal Rural Municipality'),
(139, 15, 'Baragadhi Rural Municipality'),
(140, 15, 'Bishrampur Rural Municipality'),
(141, 15, 'Devtal Rural Municipality'),
(142, 15, 'Jitpur Simara Sub-Metropolitian City'),
(143, 15, 'Kalaiya Sub-Metropolitian City'),
(144, 15, 'Karaiyamai Rural Municipality'),
(145, 15, 'Kolhabi Municipality'),
(146, 15, 'Mahagadhimai Municipality'),
(147, 15, 'Nijgadh Municipality'),
(148, 15, 'Pacharauta Municipality'),
(149, 15, 'Parwanipur Rural Municipality'),
(150, 15, 'Pheta Rural Municipality'),
(151, 15, 'Prasauni Rural Municipality'),
(152, 15, 'Simraungadh Municipality'),
(153, 15, 'Suwarna Rural Municipality'),
(154, 16, 'Aaurahi Rural Municipality'),
(155, 16, 'Bateshwor Rural Municipality'),
(156, 16, 'Bideha Municipality'),
(157, 16, 'Chhireshwornath Municipality'),
(158, 16, 'Dhanauji Rural Municipality'),
(159, 16, 'Dhanusadham Municipality'),
(160, 16, 'Ganeshman Charnath Municipality'),
(161, 16, 'Hansapur Municipality'),
(162, 16, 'Janaknandani Rural Municipality'),
(163, 16, 'Janakpurdham Sub-Metropolitian City'),
(164, 16, 'Kamala Municipality'),
(165, 16, 'Lakshminiya Rural Municipality'),
(166, 16, 'Mithila Bihari Municipality'),
(167, 16, 'Mithila Municipality'),
(168, 16, 'Mukhiyapatti Musarmiya Rural Municipality'),
(169, 16, 'Nagarain Municipality'),
(170, 16, 'Sabaila Municipality'),
(171, 16, 'Sahidnagar Municipality'),
(172, 17, 'Aurahi Municipality'),
(173, 17, 'Balwa Municipality'),
(174, 17, 'Bardibas Municipality'),
(175, 17, 'Bhangaha Municipality'),
(176, 17, 'Ekdanra Rural Municipality'),
(177, 17, 'Gaushala Municipality'),
(178, 17, 'Jaleswor Municipality'),
(179, 17, 'Loharpatti Municipality'),
(180, 17, 'Mahottari Rural Municipality'),
(181, 17, 'Manra Siswa Municipality'),
(182, 17, 'Matihani Municipality'),
(183, 17, 'Pipra Rural Municipality'),
(184, 17, 'Ramgopalpur Municipality'),
(185, 17, 'Samsi Rural Municipality'),
(186, 17, 'Sonama Rural Municipality'),
(187, 18, 'Bahudaramai Municipality'),
(188, 18, 'Bindabasini Rural Municipality'),
(189, 18, 'Birgunj Metropolitian City'),
(190, 18, 'Chhipaharmai Rural Municipality'),
(191, 18, 'Dhobini Rural Municipality'),
(192, 18, 'Jagarnathpur Rural Municipality'),
(193, 18, 'Jirabhawani Rural Municipality'),
(194, 18, 'Kalikamai Rural Municipality'),
(195, 18, 'Pakahamainpur Rural Municipality'),
(196, 18, 'Parsagadhi Municipality'),
(197, 18, 'Paterwasugauli Rural Municipality'),
(198, 18, 'Pokhariya Municipality'),
(199, 18, 'SakhuwaPrasauni Rural Municipality'),
(200, 18, 'Thori Rural Municipality'),
(201, 19, 'Baudhimai Municipality'),
(202, 19, 'Brindaban Municipality'),
(203, 19, 'Chandrapur Municipality'),
(204, 19, 'Dewahhi Gonahi Municipality'),
(205, 19, 'Durga Bhagwati Rural Municipality'),
(206, 19, 'Gadhimai Municipality'),
(207, 19, 'Garuda Municipality'),
(208, 19, 'Gaur Municipality'),
(209, 19, 'Gujara Municipality'),
(210, 19, 'Ishanath Municipality'),
(211, 19, 'Katahariya Municipality'),
(212, 19, 'Madhav Narayan Municipality'),
(213, 19, 'Maulapur Municipality'),
(214, 19, 'Paroha Municipality'),
(215, 19, 'Phatuwa Bijayapur Municipality'),
(216, 19, 'Rajdevi Municipality'),
(217, 19, 'Rajpur Municipality'),
(218, 19, 'Yemunamai Rural Municipality'),
(219, 20, 'Agnisair Krishna Savaran Rural Municipality'),
(220, 20, 'Balan Bihul Rural Municipality'),
(221, 20, 'Bishnupur Rural Municipality'),
(222, 20, 'Bode Barsain Municipality'),
(223, 20, 'Chhinnamasta Rural Municipality'),
(224, 20, 'Dakneshwori Municipality'),
(225, 20, 'Hanumannagar Kankalini Municipality'),
(226, 20, 'Kanchanrup Municipality'),
(227, 20, 'Khadak Municipality'),
(228, 20, 'Mahadeva Rural Municipality'),
(229, 20, 'Rajbiraj Municipality'),
(230, 20, 'Rajgadh Rural Municipality'),
(231, 20, 'Rupani Rural Municipality'),
(232, 20, 'Saptakoshi Rural Municipality'),
(233, 20, 'Shambhunath Municipality'),
(234, 20, 'Surunga Municipality'),
(235, 20, 'Tilathi Koiladi Rural Municipality'),
(236, 20, 'Tirahut Rural Municipality'),
(237, 21, 'Bagmati Province Municipality'),
(238, 21, 'Balara Municipality'),
(239, 21, 'Barahathawa Municipality'),
(240, 21, 'Basbariya Rural Municipality'),
(241, 21, 'Bishnu Rural Municipality'),
(242, 21, 'Bramhapuri Rural Municipality'),
(243, 21, 'Chakraghatta Rural Municipality'),
(244, 21, 'Chandranagar Rural Municipality'),
(245, 21, 'Dhankaul Rural Municipality'),
(246, 21, 'Godaita Municipality'),
(247, 21, 'Haripur Municipality'),
(248, 21, 'Haripurwa Municipality'),
(249, 21, 'Hariwan Municipality'),
(250, 21, 'Ishworpur Municipality'),
(251, 21, 'Kabilasi Municipality'),
(252, 21, 'Kaudena Rural Municipality'),
(253, 21, 'Lalbandi Municipality'),
(254, 21, 'Malangawa Municipality'),
(255, 21, 'Parsa Rural Municipality'),
(256, 21, 'Ramnagar Rural Municipality'),
(257, 22, 'Arnama Rural Municipality'),
(258, 22, 'Aurahi Rural Municipality'),
(259, 22, 'Bariyarpatti Rural Municipality'),
(260, 22, 'Bhagawanpur Rural Municipality'),
(261, 22, 'Bishnupur Rural Municipality'),
(262, 22, 'Dhangadhimai Municipality'),
(263, 22, 'Golbazar Municipality'),
(264, 22, 'Kalyanpur Municipality'),
(265, 22, 'Karjanha Municipality'),
(266, 22, 'Lahan Municipality'),
(267, 22, 'Laxmipur Patari Rural Municipality'),
(268, 22, 'Mirchaiya Municipality'),
(269, 22, 'Naraha Rural Municipality'),
(270, 22, 'Nawarajpur Rural Municipality'),
(271, 22, 'Sakhuwanankarkatti Rural Municipality'),
(272, 22, 'Siraha Municipality'),
(273, 22, 'Sukhipur Municipality'),
(274, 23, 'Bhaktapur Municipality'),
(275, 23, 'Changunarayan Municipality'),
(276, 23, 'Madhyapur Thimi Municipality'),
(277, 23, 'Suryabinayak Municipality'),
(278, 24, 'Bharatpur Metropolitian City'),
(279, 24, 'Ichchhyakamana Rural Municipality'),
(280, 24, 'Kalika Municipality'),
(281, 24, 'Khairahani Municipality'),
(282, 24, 'Madi Municipality'),
(283, 24, 'Rapti Municipality'),
(284, 24, 'Ratnanagar Municipality'),
(285, 25, 'Benighat Rorang Rural Municipality'),
(286, 25, 'Dhunibesi Municipality'),
(287, 25, 'Gajuri Rural Municipality'),
(288, 25, 'Galchi Rural Municipality'),
(289, 25, 'Gangajamuna Rural Municipality'),
(290, 25, 'Jwalamukhi Rural Municipality'),
(291, 25, 'Khaniyabash Rural Municipality'),
(292, 25, 'Netrawati Dabjong Rural Municipality'),
(293, 25, 'Nilakantha Municipality'),
(294, 25, 'Rubi Valley Rural Municipality'),
(295, 25, 'Siddhalek Rural Municipality'),
(296, 25, 'Thakre Rural Municipality'),
(297, 25, 'Tripura Sundari Rural Municipality'),
(298, 26, 'Baiteshwor Rural Municipality'),
(299, 26, 'Bhimeshwor Municipality'),
(300, 26, 'Bigu Rural Municipality'),
(301, 26, 'Gaurishankar Rural Municipality'),
(302, 26, 'Jiri Municipality'),
(303, 26, 'Kalinchok Rural Municipality'),
(304, 26, 'Melung Rural Municipality'),
(305, 26, 'Sailung Rural Municipality'),
(306, 26, 'Tamakoshi Rural Municipality'),
(307, 27, 'Budhanilakantha Municipality'),
(308, 27, 'Chandragiri Municipality'),
(309, 27, 'Dakshinkali Municipality'),
(310, 27, 'Gokarneshwor Municipality'),
(311, 27, 'Kageshwori Manahora Municipality'),
(312, 27, 'Kathmandu Metropolitian City'),
(313, 27, 'Kirtipur Municipality'),
(314, 27, 'Nagarjun Municipality'),
(315, 27, 'Shankharapur Municipality'),
(316, 27, 'Tarakeshwor Municipality'),
(317, 27, 'Tokha Municipality'),
(318, 28, 'Banepa Municipality'),
(319, 28, 'Bethanchowk Rural Municipality'),
(320, 28, 'Bhumlu Rural Municipality'),
(321, 28, 'Chaurideurali Rural Municipality'),
(322, 28, 'Dhulikhel Municipality'),
(323, 28, 'Khanikhola Rural Municipality'),
(324, 28, 'Mahabharat Rural Municipality'),
(325, 28, 'Mandandeupur Municipality'),
(326, 28, 'Namobuddha Municipality'),
(327, 28, 'Panauti Municipality'),
(328, 28, 'Panchkhal Municipality'),
(329, 28, 'Roshi Rural Municipality'),
(330, 28, 'Temal Rural Municipality'),
(331, 29, 'Bagmati Province Rural Municipality'),
(332, 29, 'Godawari Municipality'),
(333, 29, 'Konjyosom Rural Municipality'),
(334, 29, 'Lalitpur Metropolitian City'),
(335, 29, 'Mahalaxmi Municipality'),
(336, 29, 'Mahankal Rural Municipality'),
(337, 30, 'Bagmati Province Rural Municipality'),
(338, 30, 'Bakaiya Rural Municipality'),
(339, 30, 'Bhimphedi Rural Municipality'),
(340, 30, 'Hetauda Sub-Metropolitian City'),
(341, 30, 'Indrasarowar Rural Municipality'),
(342, 30, 'Kailash Rural Municipality'),
(343, 30, 'Makawanpurgadhi Rural Municipality'),
(344, 30, 'Manahari Rural Municipality'),
(345, 30, 'Raksirang Rural Municipality'),
(346, 30, 'Thaha Municipality'),
(347, 31, 'Belkotgadhi Municipality'),
(348, 31, 'Bidur Municipality'),
(349, 31, 'Dupcheshwar Rural Municipality'),
(350, 31, 'Kakani Rural Municipality'),
(351, 31, 'Kispang Rural Municipality'),
(352, 31, 'Likhu Rural Municipality'),
(353, 31, 'Myagang Rural Municipality'),
(354, 31, 'Panchakanya Rural Municipality'),
(355, 31, 'Shivapuri Rural Municipality'),
(356, 31, 'Suryagadhi Rural Municipality'),
(357, 31, 'Tadi Rural Municipality'),
(358, 31, 'Tarkeshwar Rural Municipality'),
(359, 32, 'Doramba Rural Municipality'),
(360, 32, 'Gokulganga Rural Municipality'),
(361, 32, 'Khadadevi Rural Municipality'),
(362, 32, 'Likhu Tamakoshi Rural Municipality'),
(363, 32, 'Manthali Municipality'),
(364, 32, 'Ramechhap Municipality'),
(365, 32, 'Sunapati Rural Municipality'),
(366, 32, 'Umakunda Rural Municipality'),
(367, 33, 'Amachodingmo Rural Municipality'),
(368, 33, 'Gosaikunda Rural Municipality'),
(369, 33, 'Kalika Rural Municipality'),
(370, 33, 'Naukunda Rural Municipality'),
(371, 33, 'Uttargaya Rural Municipality'),
(372, 34, 'Dudhouli Municipality'),
(373, 34, 'Ghanglekh Rural Municipality'),
(374, 34, 'Golanjor Rural Municipality'),
(375, 34, 'Hariharpurgadhi Rural Municipality'),
(376, 34, 'Kamalamai Municipality'),
(377, 34, 'Marin Rural Municipality'),
(378, 34, 'Phikkal Rural Municipality'),
(379, 34, 'Sunkoshi Rural Municipality'),
(380, 34, 'Tinpatan Rural Municipality'),
(381, 35, 'Balefi Rural Municipality'),
(382, 35, 'Barhabise Municipality'),
(383, 35, 'Bhotekoshi Rural Municipality'),
(384, 35, 'Chautara SangachokGadhi Municipality'),
(385, 35, 'Helambu Rural Municipality'),
(386, 35, 'Indrawati Rural Municipality'),
(387, 35, 'Jugal Rural Municipality'),
(388, 35, 'Lisangkhu Pakhar Rural Municipality'),
(389, 35, 'Melamchi Municipality'),
(390, 35, 'Panchpokhari Thangpal Rural Municipality'),
(391, 35, 'Sunkoshi Rural Municipality'),
(392, 35, 'Tripurasundari Rural Municipality'),
(393, 36, 'Badigad Rural Municipality'),
(394, 36, 'Baglung Municipality'),
(395, 36, 'Bareng Rural Municipality'),
(396, 36, 'Dhorpatan Municipality'),
(397, 36, 'Galkot Municipality'),
(398, 36, 'Jaimuni Municipality'),
(399, 36, 'Kanthekhola Rural Municipality'),
(400, 36, 'Nisikhola Rural Municipality'),
(401, 36, 'Taman Khola Rural Municipality'),
(402, 36, 'Tara Khola Rural Municipality'),
(403, 37, 'Aarughat Rural Municipality'),
(404, 37, 'Ajirkot Rural Municipality'),
(405, 37, 'Barpak Sulikot Rural Municipality'),
(406, 37, 'Bhimsenthapa Rural Municipality'),
(407, 37, 'Chum Nubri Rural Municipality'),
(408, 37, 'Dharche Rural Municipality'),
(409, 37, 'Gandaki Province Rural Municipality'),
(410, 37, 'Gorkha Municipality'),
(411, 37, 'Palungtar Municipality'),
(412, 37, 'Sahid Lakhan Rural Municipality'),
(413, 37, 'Siranchok Rural Municipality'),
(414, 38, 'Annapurna Rural Municipality'),
(415, 38, 'Machhapuchchhre Rural Municipality'),
(416, 38, 'Madi Rural Municipality'),
(417, 38, 'Pokhara Metropolitian City'),
(418, 38, 'Rupa Rural Municipality'),
(419, 39, 'Besishahar Municipality'),
(420, 39, 'Dordi Rural Municipality'),
(421, 39, 'Dudhpokhari Rural Municipality'),
(422, 39, 'Kwholasothar Rural Municipality'),
(423, 39, 'MadhyaNepal Municipality'),
(424, 39, 'Marsyangdi Rural Municipality'),
(425, 39, 'Rainas Municipality'),
(426, 39, 'Sundarbazar Municipality'),
(427, 40, 'Chame Rural Municipality'),
(428, 40, 'Manang Ingshyang Rural Municipality'),
(429, 40, 'Narpa Bhumi Rural Municipality'),
(430, 40, 'Narshon Rural Municipality'),
(431, 41, 'Gharapjhong Rural Municipality'),
(432, 41, 'Lo-Ghekar Damodarkunda Rural Municipality'),
(433, 41, 'Lomanthang Rural Municipality'),
(434, 41, 'Thasang Rural Municipality'),
(435, 41, 'Waragung Muktikhsetra Rural Municipality'),
(436, 42, 'Annapurna Rural Municipality'),
(437, 42, 'Beni Municipality'),
(438, 42, 'Dhaulagiri Rural Municipality'),
(439, 42, 'Malika Rural Municipality'),
(440, 42, 'Mangala Rural Municipality'),
(441, 42, 'Raghuganga Rural Municipality'),
(442, 43, 'Baudeekali Rural Municipality'),
(443, 43, 'Binayee Tribeni Rural Municipality'),
(444, 43, 'Bulingtar Rural Municipality'),
(445, 43, 'Devchuli Municipality'),
(446, 43, 'Gaidakot Municipality'),
(447, 43, 'Hupsekot Rural Municipality'),
(448, 43, 'Kawasoti Municipality'),
(449, 43, 'Madhyabindu Municipality'),
(450, 44, 'Bihadi Rural Municipality'),
(451, 44, 'Jaljala Rural Municipality'),
(452, 44, 'Kushma Municipality'),
(453, 44, 'Mahashila Rural Municipality'),
(454, 44, 'Modi Rural Municipality'),
(455, 44, 'Painyu Rural Municipality'),
(456, 44, 'Phalebas Municipality'),
(457, 45, 'Aandhikhola Rural Municipality'),
(458, 45, 'Arjunchaupari Rural Municipality'),
(459, 45, 'Bhirkot Municipality'),
(460, 45, 'Biruwa Rural Municipality'),
(461, 45, 'Chapakot Municipality'),
(462, 45, 'Galyang Municipality'),
(463, 45, 'Harinas Rural Municipality'),
(464, 45, 'Kaligandagi Rural Municipality'),
(465, 45, 'Phedikhola Rural Municipality'),
(466, 45, 'Putalibazar Municipality'),
(467, 45, 'Waling Municipality'),
(468, 46, 'Anbukhaireni Rural Municipality'),
(469, 46, 'Bandipur Rural Municipality'),
(470, 46, 'Bhanu Municipality'),
(471, 46, 'Bhimad Municipality'),
(472, 46, 'Byas Municipality'),
(473, 46, 'Devghat Rural Municipality'),
(474, 46, 'Ghiring Rural Municipality'),
(475, 46, 'Myagde Rural Municipality'),
(476, 46, 'Rhishing Rural Municipality'),
(477, 46, 'ShuklaGandaki Province Municipality'),
(478, 47, 'Bhumekasthan Municipality'),
(479, 47, 'Chhatradev Rural Municipality'),
(480, 47, 'Malarani Rural Municipality'),
(481, 47, 'Panini Rural Municipality'),
(482, 47, 'Sandhikharka Municipality'),
(483, 47, 'Sitganga Municipality'),
(484, 48, 'Baijanath Rural Municipality'),
(485, 48, 'Duduwa Rural Municipality'),
(486, 48, 'Janki Rural Municipality'),
(487, 48, 'Khajura Rural Municipality'),
(488, 48, 'Kohalpur Municipality'),
(489, 48, 'Narainapur Rural Municipality'),
(490, 48, 'Nepalgunj Sub-Metropolitian City'),
(491, 48, 'Rapti Sonari Rural Municipality'),
(492, 49, 'Badhaiyatal Rural Municipality'),
(493, 49, 'Bansagadhi Municipality'),
(494, 49, 'Barbardiya Municipality'),
(495, 49, 'Geruwa Rural Municipality'),
(496, 49, 'Gulariya Municipality'),
(497, 49, 'Madhuwan Municipality'),
(498, 49, 'Rajapur Municipality'),
(499, 49, 'Thakurbaba Municipality'),
(500, 50, 'Babai Rural Municipality'),
(501, 50, 'Banglachuli Rural Municipality'),
(502, 50, 'Dangisharan Rural Municipality'),
(503, 50, 'Gadhawa Rural Municipality'),
(504, 50, 'Ghorahi Sub-Metropolitian City'),
(505, 50, 'Lamahi Municipality'),
(506, 50, 'Rajpur Rural Municipality'),
(507, 50, 'Rapti Rural Municipality'),
(508, 50, 'Shantinagar Rural Municipality'),
(509, 50, 'Tulsipur Sub-Metropolitian City'),
(510, 51, 'Chandrakot Rural Municipality'),
(511, 51, 'Chatrakot Rural Municipality'),
(512, 51, 'Dhurkot Rural Municipality'),
(513, 51, 'Gulmidarbar Rural Municipality'),
(514, 51, 'Isma Rural Municipality'),
(515, 51, 'KaliGandaki Province Rural Municipality'),
(516, 51, 'Madane Rural Municipality'),
(517, 51, 'Malika Rural Municipality'),
(518, 51, 'Musikot Municipality'),
(519, 51, 'Resunga Municipality'),
(520, 51, 'Ruru Rural Municipality'),
(521, 51, 'Satyawati Rural Municipality'),
(522, 52, 'Banganga Municipality'),
(523, 52, 'Bijayanagar Rural Municipality'),
(524, 52, 'Buddhabhumi Municipality'),
(525, 52, 'Kapilbastu Municipality'),
(526, 52, 'Krishnanagar Municipality'),
(527, 52, 'Maharajgunj Municipality'),
(528, 52, 'Mayadevi Rural Municipality'),
(529, 52, 'Shivaraj Municipality'),
(530, 52, 'Suddhodhan Rural Municipality'),
(531, 52, 'Yashodhara Rural Municipality'),
(532, 53, 'Bardaghat Municipality'),
(533, 53, 'Palhi Nandan Rural Municipality'),
(534, 53, 'Pratappur Rural Municipality'),
(535, 53, 'Ramgram Municipality'),
(536, 53, 'Sarawal Rural Municipality'),
(537, 53, 'Sunwal Municipality'),
(538, 53, 'Susta Rural Municipality'),
(539, 54, 'Bagnaskali Rural Municipality'),
(540, 54, 'Mathagadhi Rural Municipality'),
(541, 54, 'Nisdi Rural Municipality'),
(542, 54, 'Purbakhola Rural Municipality'),
(543, 54, 'Rainadevi Chhahara Rural Municipality'),
(544, 54, 'Rambha Rural Municipality'),
(545, 54, 'Rampur Municipality'),
(546, 54, 'Ribdikot Rural Municipality'),
(547, 54, 'Tansen Municipality'),
(548, 54, 'Tinau Rural Municipality'),
(549, 55, 'Ayirabati Rural Municipality'),
(550, 55, 'Gaumukhi Rural Municipality'),
(551, 55, 'Jhimruk Rural Municipality'),
(552, 55, 'Mallarani Rural Municipality'),
(553, 55, 'Mandavi Rural Municipality'),
(554, 55, 'Naubahini Rural Municipality'),
(555, 55, 'Pyuthan Municipality'),
(556, 55, 'Sarumarani Rural Municipality'),
(557, 55, 'Sworgadwary Municipality'),
(558, 56, 'Gangadev Rural Municipality'),
(559, 56, 'Lungri Rural Municipality'),
(560, 56, 'Madi Rural Municipality'),
(561, 56, 'Pariwartan Rural Municipality'),
(562, 56, 'Rolpa Municipality'),
(563, 56, 'Runtigadi Rural Municipality'),
(564, 56, 'Sunchhahari Rural Municipality'),
(565, 56, 'Sunil Smriti Rural Municipality'),
(566, 56, 'Thawang Rural Municipality'),
(567, 56, 'Tribeni Rural Municipality'),
(568, 57, 'Bhume Rural Municipality'),
(569, 57, 'Putha Uttarganga Rural Municipality'),
(570, 57, 'Sisne Rural Municipality'),
(571, 58, 'Butwal Sub-Metropolitian City'),
(572, 58, 'Devdaha Municipality'),
(573, 58, 'Gaidahawa Rural Municipality'),
(574, 58, 'Kanchan Rural Municipality'),
(575, 58, 'Kotahimai Rural Municipality'),
(576, 58, 'Lumbini Sanskritik Municipality'),
(577, 58, 'Marchawari Rural Municipality'),
(578, 58, 'Mayadevi Rural Municipality'),
(579, 58, 'Omsatiya Rural Municipality'),
(580, 58, 'Rohini Rural Municipality'),
(581, 58, 'Sainamaina Municipality'),
(582, 58, 'Sammarimai Rural Municipality'),
(583, 58, 'Siddharthanagar Municipality'),
(584, 58, 'Siyari Rural Municipality'),
(585, 58, 'Sudhdhodhan Rural Municipality'),
(586, 58, 'Tillotama Municipality'),
(587, 59, 'Aathabis Municipality'),
(588, 59, 'Bhagawatimai Rural Municipality'),
(589, 59, 'Bhairabi Rural Municipality'),
(590, 59, 'Chamunda Bindrasaini Municipality'),
(591, 59, 'Dullu Municipality'),
(592, 59, 'Dungeshwor Rural Municipality'),
(593, 59, 'Gurans Rural Municipality'),
(594, 59, 'Mahabu Rural Municipality'),
(595, 59, 'Narayan Municipality'),
(596, 59, 'Naumule Rural Municipality'),
(597, 59, 'Thantikandh Rural Municipality'),
(598, 60, 'Chharka Tangsong Rural Municipality'),
(599, 60, 'Dolpo Buddha Rural Municipality'),
(600, 60, 'Jagadulla Rural Municipality'),
(601, 60, 'Kaike Rural Municipality'),
(602, 60, 'Mudkechula Rural Municipality'),
(603, 60, 'Shey Phoksundo Rural Municipality'),
(604, 60, 'Thuli Bheri Municipality'),
(605, 60, 'Tripurasundari Municipality'),
(606, 61, 'Adanchuli Rural Municipality'),
(607, 61, 'Chankheli Rural Municipality'),
(608, 61, 'Kharpunath Rural Municipality'),
(609, 61, 'Namkha Rural Municipality'),
(610, 61, 'Sarkegad Rural Municipality'),
(611, 61, 'Simkot Rural Municipality'),
(612, 61, 'Tanjakot Rural Municipality'),
(613, 62, 'Barekot Rural Municipality'),
(614, 62, 'Bheri Municipality'),
(615, 62, 'Chhedagad Municipality'),
(616, 62, 'Junichande Rural Municipality'),
(617, 62, 'Kuse Rural Municipality'),
(618, 62, 'Nalagad Municipality'),
(619, 62, 'Shiwalaya Rural Municipality'),
(620, 63, 'Chandannath Municipality'),
(621, 63, 'Guthichaur Rural Municipality'),
(622, 63, 'Hima Rural Municipality'),
(623, 63, 'Kanakasundari Rural Municipality'),
(624, 63, 'Patrasi Rural Municipality'),
(625, 63, 'Sinja Rural Municipality'),
(626, 63, 'Tatopani Rural Municipality'),
(627, 63, 'Tila Rural Municipality'),
(628, 64, 'Khandachakra Municipality'),
(629, 64, 'Mahawai Rural Municipality'),
(630, 64, 'Naraharinath Rural Municipality'),
(631, 64, 'Pachaljharana Rural Municipality'),
(632, 64, 'Palata Rural Municipality'),
(633, 64, 'Raskot Municipality'),
(634, 64, 'Sanni Tribeni Rural Municipality'),
(635, 64, 'Subha Kalika Rural Municipality'),
(636, 64, 'Tilagufa Municipality'),
(637, 65, 'Chhayanath Rara Municipality'),
(638, 65, 'Khatyad Rural Municipality'),
(639, 65, 'Mugum Karmarong Rural Municipality'),
(640, 65, 'Soru Rural Municipality'),
(641, 66, 'Aathbiskot Municipality'),
(642, 66, 'Banfikot Rural Municipality'),
(643, 66, 'Chaurjahari Municipality'),
(644, 66, 'Musikot Municipality'),
(645, 66, 'Sani Bheri Rural Municipality'),
(646, 66, 'Tribeni Rural Municipality'),
(647, 67, 'Bagchaur Municipality'),
(648, 67, 'Bangad Kupinde Municipality'),
(649, 67, 'Chhatreshwori Rural Municipality'),
(650, 67, 'Darma Rural Municipality'),
(651, 67, 'Kalimati Rural Municipality'),
(652, 67, 'Kapurkot Rural Municipality'),
(653, 67, 'Kumakh Rural Municipality'),
(654, 67, 'Sharada Municipality'),
(655, 67, 'Siddha Kumakh Rural Municipality'),
(656, 67, 'Tribeni Rural Municipality'),
(657, 68, 'Barahtal Rural Municipality'),
(658, 68, 'Bheriganga Municipality'),
(659, 68, 'Birendranagar Municipality'),
(660, 68, 'Chaukune Rural Municipality'),
(661, 68, 'Chingad Rural Municipality'),
(662, 68, 'Gurbhakot Municipality'),
(663, 68, 'Lekbeshi Municipality'),
(664, 68, 'Panchpuri Municipality'),
(665, 68, 'Simta Rural Municipality'),
(666, 69, 'Bannigadhi Jayagadh Rural Municipality'),
(667, 69, 'Chaurpati Rural Municipality'),
(668, 69, 'Dhakari Rural Municipality'),
(669, 69, 'Kamalbazar Municipality'),
(670, 69, 'Mangalsen Municipality'),
(671, 69, 'Mellekh Rural Municipality'),
(672, 69, 'Panchadewal Binayak Municipality'),
(673, 69, 'Ramaroshan Rural Municipality'),
(674, 69, 'Sanphebagar Municipality'),
(675, 69, 'Turmakhad Rural Municipality'),
(676, 70, 'Dasharathchanda Municipality'),
(677, 70, 'Dilasaini Rural Municipality'),
(678, 70, 'Dogadakedar Rural Municipality'),
(679, 70, 'Melauli Municipality'),
(680, 70, 'Pancheshwar Rural Municipality'),
(681, 70, 'Patan Municipality'),
(682, 70, 'Purchaudi Municipality'),
(683, 70, 'Shivanath Rural Municipality'),
(684, 70, 'Sigas Rural Municipality'),
(685, 70, 'Surnaya Rural Municipality'),
(686, 71, 'Bithadchir Rural Municipality'),
(687, 71, 'Bungal Municipality'),
(688, 71, 'Chabispathivera Rural Municipality'),
(689, 71, 'Durgathali Rural Municipality'),
(690, 71, 'JayaPrithivi Municipality'),
(691, 71, 'Kedarseu Rural Municipality'),
(692, 71, 'Khaptadchhanna Rural Municipality'),
(693, 71, 'Masta Rural Municipality'),
(694, 71, 'SaiPaal Rural Municipality'),
(695, 71, 'Surma Rural Municipality'),
(696, 71, 'Talkot Rural Municipality'),
(697, 71, 'Thalara Rural Municipality'),
(698, 72, 'Badimalika Municipality'),
(699, 72, 'Budhiganga Municipality'),
(700, 72, 'Budhinanda Municipality'),
(701, 72, 'Gaumul Rural Municipality'),
(702, 72, 'Himali Rural Municipality'),
(703, 72, 'Jagannath Rural Municipality'),
(704, 72, 'Khaptad Chhededaha Rural Municipality'),
(705, 72, 'Swami Kartik Khaapar Rural Municipality'),
(706, 72, 'Tribeni Municipality'),
(707, 73, 'Ajaymeru Rural Municipality'),
(708, 73, 'Alital Rural Municipality'),
(709, 73, 'Amargadhi Municipality'),
(710, 73, 'Bhageshwar Rural Municipality'),
(711, 73, 'Ganayapdhura Rural Municipality'),
(712, 73, 'Nawadurga Rural Municipality'),
(713, 73, 'Parashuram Municipality'),
(714, 74, 'Apihimal Rural Municipality'),
(715, 74, 'Byas Rural Municipality'),
(716, 74, 'Dunhu Rural Municipality'),
(717, 74, 'Lekam Rural Municipality'),
(718, 74, 'Mahakali Municipality'),
(719, 74, 'Malikaarjun Rural Municipality'),
(720, 74, 'Marma Rural Municipality'),
(721, 74, 'Naugad Rural Municipality'),
(722, 74, 'Shailyashikhar Municipality'),
(723, 75, 'Adharsha Rural Municipality'),
(724, 75, 'Badikedar Rural Municipality'),
(725, 75, 'Bogtan Foodsil Rural Municipality'),
(726, 75, 'Dipayal Silgadi Municipality'),
(727, 75, 'Jorayal Rural Municipality'),
(728, 75, 'K I Singh Rural Municipality'),
(729, 75, 'Purbichauki Rural Municipality'),
(730, 75, 'Sayal Rural Municipality'),
(731, 75, 'Shikhar Municipality'),
(732, 76, 'Bardagoriya Rural Municipality'),
(733, 76, 'Bhajani Municipality'),
(734, 76, 'Chure Rural Municipality'),
(735, 76, 'Dhangadhi Sub-Metropolitian City'),
(736, 76, 'Gauriganga Municipality'),
(737, 76, 'Ghodaghodi Municipality'),
(738, 76, 'Godawari Municipality'),
(739, 76, 'Janaki Rural Municipality'),
(740, 76, 'Joshipur Rural Municipality'),
(741, 76, 'Kailari Rural Municipality'),
(742, 76, 'Lamkichuha Municipality'),
(743, 76, 'Mohanyal Rural Municipality'),
(744, 76, 'Tikapur Municipality'),
(745, 77, 'Bedkot Municipality'),
(746, 77, 'Belauri Municipality'),
(747, 77, 'Beldandi Rural Municipality'),
(748, 77, 'Bhimdatta Municipality'),
(749, 77, 'Krishnapur Municipality'),
(750, 77, 'Laljhadi Rural Municipality'),
(751, 77, 'Mahakali Municipality'),
(752, 77, 'Punarbas Municipality'),
(753, 77, 'Shuklaphanta Municipality');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `expiration_time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rent` double(100,2) NOT NULL,
  `paidAmount` double(100,2) DEFAULT NULL,
  `dueAmount` double(100,2) NOT NULL,
  `status` varchar(225) NOT NULL DEFAULT 'Unpaid',
  `year` varchar(225) NOT NULL,
  `month` varchar(225) NOT NULL,
  `billGeneratedDate` varchar(225) NOT NULL,
  `additionalCharge` double(100,2) DEFAULT NULL,
  `remarks` varchar(512) DEFAULT NULL,
  `paymentMethod` varchar(225) DEFAULT NULL,
  `paymentDate` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(3, 'Bagmati Province'),
(4, 'Gandaki Province'),
(6, 'Karnali Province'),
(1, 'Koshi Province'),
(5, 'Lumbini Province'),
(2, 'Madhesh Province'),
(7, 'Sudurpashchim Province');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `item` varchar(225) NOT NULL,
  `billNumber` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `unit` varchar(225) NOT NULL,
  `rate` double(30,2) NOT NULL,
  `totalAmount` double(30,2) NOT NULL,
  `paidAmount` double(30,2) NOT NULL,
  `dueAmount` double(30,2) NOT NULL,
  `purchaseDate` varchar(225) NOT NULL,
  `paymentDate` varchar(225) DEFAULT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `roomNumber` int(11) NOT NULL,
  `bedPerRoom` int(11) NOT NULL,
  `rentPerBed` bigint(20) NOT NULL,
  `floor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomNumber`, `bedPerRoom`, `rentPerBed`, `floor_id`) VALUES
(17, 101, 2, 14000, 2),
(18, 102, 2, 14000, 2),
(19, 103, 3, 12000, 2),
(20, 104, 1, 14000, 2),
(21, 105, 2, 13000, 2),
(22, 106, 1, 15000, 2),
(23, 107, 1, 13000, 2),
(24, 201, 2, 14000, 3),
(25, 202, 2, 14000, 3),
(26, 203, 3, 12000, 3),
(27, 204, 1, 14000, 3),
(28, 205, 2, 14000, 3),
(29, 206, 3, 13000, 3),
(30, 301, 2, 14000, 4),
(31, 302, 2, 14000, 4),
(32, 303, 3, 12000, 4),
(33, 304, 1, 14000, 4),
(34, 305, 2, 14000, 4),
(35, 306, 3, 13000, 4),
(36, 401, 2, 14000, 5),
(37, 402, 2, 14000, 5),
(38, 403, 3, 12000, 5),
(39, 404, 1, 14000, 5),
(40, 405, 2, 14000, 5),
(41, 406, 3, 13000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) DEFAULT 'N/A',
  `lastName` varchar(50) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `caste` varchar(50) DEFAULT 'N/A',
  `religion` varchar(50) DEFAULT 'N/A',
  `nationality` varchar(50) DEFAULT 'N/A',
  `bloodGroup` varchar(5) DEFAULT 'N/A',
  `fatherName` varchar(100) NOT NULL,
  `fatherMobile` varchar(20) DEFAULT 'N/A',
  `fatherEducation` varchar(100) DEFAULT 'N/A',
  `fatherProfession` varchar(100) DEFAULT 'N/A',
  `MotherName` varchar(50) DEFAULT NULL,
  `motherMobile` varchar(20) DEFAULT 'N/A',
  `motherEducation` varchar(100) DEFAULT 'N/A',
  `motherProfession` varchar(100) DEFAULT 'N/A',
  `profession` varchar(100) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `userPost` varchar(100) NOT NULL,
  `hostelJoinDate` date NOT NULL,
  `room_id` int(11) NOT NULL,
  `guardianName` varchar(100) NOT NULL,
  `guardianPhone` varchar(20) NOT NULL,
  `relationWithGuardian` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `district_id` int(11) NOT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `wardNumber` varchar(20) DEFAULT NULL,
  `tole` varchar(100) NOT NULL,
  `status` varchar(125) NOT NULL DEFAULT 'active',
  `leaveDate` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `vendorName` varchar(225) NOT NULL,
  `vendorContactPerson` varchar(225) NOT NULL,
  `vendorContact` bigint(20) NOT NULL,
  `vendorGmail` varchar(225) NOT NULL,
  `vendorAddress` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
