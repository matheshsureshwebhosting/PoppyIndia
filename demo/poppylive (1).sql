-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 07:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poppylive`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `short_desc` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `short_desc`, `parent_id`, `sort_order`) VALUES
(1, 'Grand Series', '', 0, 1),
(2, 'Rubberized Coir Series', '', 0, 2),
(3, 'PU Foam Series', '', 0, 3),
(4, 'Premium Series', '', 0, 4),
(5, 'Medico Series', '', 0, 5),
(6, 'Excuber', 'Meet comfort & style', 1, 1),
(7, 'Grand', 'Turn Your Bedroom Into Luxury Vacations', 1, 2),
(12, 'Selene', 'Mattress That Don\'t Pinch', 4, 1),
(13, 'Luxe', 'Sleep With Comfort', 4, 2),
(14, 'Pillow', '', 0, 6),
(15, 'Accessories', '', 0, 7),
(16, 'Cuddle Buddy', '', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `discount_type` enum('flat','percentage') NOT NULL DEFAULT 'flat',
  `discount_value` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `coupon_code`, `description`, `discount_type`, `discount_value`, `start_date`, `expire_date`) VALUES
(20, 'ABCD', '', 'flat', 10, '2021-01-01', '2021-01-08'),
(22, 'CUDDLE25', '', 'percentage', 25, '2021-04-18', '2021-06-30'),
(23, 'ABCD', '', 'flat', 10, '2021-01-01', '2021-01-08'),
(24, 'ABCD', '', 'flat', 10, '2021-01-01', '2021-01-08'),
(25, 'ABCD', '', 'flat', 10, '2021-01-01', '2021-01-08'),
(26, 'ABCD', '', 'flat', 10, '2021-01-01', '2021-01-08'),
(27, 'ABCD', '', 'flat', 10, '2021-01-01', '2021-01-08'),
(28, 'ABCD', '', 'flat', 10, '2021-01-01', '2021-01-08'),
(29, 'ABCD', '', 'flat', 10, '2021-01-01', '2021-01-08'),
(30, 'ABCD', '', 'flat', 10, '2021-01-01', '2021-01-08');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `otp` int(11) NOT NULL,
  `join_date` datetime NOT NULL,
  `last_visited` datetime NOT NULL,
  `subscription` enum('yes','no','unsubscribe') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `mobileno`, `emailid`, `userpassword`, `address`, `city`, `state`, `pincode`, `otp`, `join_date`, `last_visited`, `subscription`) VALUES
(9, 'Yuvaraj V', '9677378582', 'hi.sendmeamail@gmail.com', '0a9ca5f55a938e7dbda3bc01a50d08f2', '', '', 'Tamil Nadu', '', 0, '2020-07-22 11:31:08', '0000-00-00 00:00:00', 'no'),
(14, 'Vignesh', '8838844815', 'vickykkdi99@gmail.com', 'c5a753d093043bbebf3a31d409400f19', '', '', '', '', 0, '2020-08-04 15:27:23', '0000-00-00 00:00:00', 'yes'),
(15, 'Rajkumar', '9843211441', 'imraj1798@gmail.com', 'NDY089', '', '', '', '', 0, '2020-08-07 10:50:10', '0000-00-00 00:00:00', 'yes'),
(16, 'Nallamalai Pandi', '9488456136', 'vakkilpandi@gmail.com', '0d6ae75cb5376b99c1db0137a7283722', '', '', '', '', 0, '2020-08-15 16:47:19', '0000-00-00 00:00:00', 'yes'),
(17, 'Masanam', '9787408610', 'Masanam241978@gmail.com', '7eabd0027a9421647b31d6df5a7f226d', '', '', '', '', 0, '2020-08-18 19:55:49', '0000-00-00 00:00:00', 'yes'),
(18, 'Navaneetha Krishnan', '9566330303', 'techaveo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 0, '2020-08-21 17:52:08', '0000-00-00 00:00:00', 'yes'),
(19, 'Jeg', '9894074069', '', '5475491f08c5fa47a69892576aae743d', '', '', '', '', 0, '2020-08-21 20:15:45', '0000-00-00 00:00:00', 'yes'),
(20, 'test', '9999999999', 'test@test123.com', 'VU0NPQ', '', '', '', '', 0, '2020-08-27 17:10:30', '0000-00-00 00:00:00', 'yes'),
(21, 'test', '0999999999', 'test@test123.com', 'XS15UV', '', '', '', '', 0, '2020-08-28 09:28:37', '0000-00-00 00:00:00', 'yes'),
(22, 'Senthil Kumar.C.A', '0960096966', 'mahisenthil23@gmail.com', 'OUIQL4', '', '', '', '', 0, '2020-09-01 15:51:49', '0000-00-00 00:00:00', 'yes'),
(23, 'Haris Jebaraj B', '9019544425', 'b.haris@gmail.com', '2e33e4ebacbd618d58e264c54b5fc86b', '', '', '', '', 0, '2020-09-02 12:22:06', '0000-00-00 00:00:00', 'yes'),
(24, 'A M S Raja', '9705850795', 'amsmukeshraja@gmail.com', 'ed8a82b04f76b251a90fb64a9d3cfdd9', '', '', '', '', 0, '2020-09-05 12:11:48', '0000-00-00 00:00:00', 'yes'),
(25, 'Sivakumar', '9790394916', 'narmatha89@gmail.com', '4420e3caf7c1b20763e3bff1b0b48d17', '', '', '', '', 0, '2020-09-07 19:31:29', '0000-00-00 00:00:00', 'no'),
(26, 'k jeyaraj', '9948840404', 'jeyarajbhuvi@gmail.com', 'GNWIEQ', '', '', '', '', 0, '2020-09-12 10:21:31', '0000-00-00 00:00:00', 'yes'),
(27, 'Navaneetha Krishnan', '0956633030', 'techaveo@gmail.com', 'R83QHN', '', '', '', '', 0, '2020-09-12 11:31:42', '0000-00-00 00:00:00', 'yes'),
(28, 'ILAYARAJA', '8124518689', 'ilaya123raja@gmail.com', '26d4a96adaeb9bcf172f4143c83c4c9b', '3/43 MADATHUKADU', 'NAGAPPATTINAM', 'Tamil Nadu', '614806', 0, '2020-09-17 09:11:42', '0000-00-00 00:00:00', 'yes'),
(29, 'Abdul samadhu', '8807262803', 'samadhuar.as.as@gmail.com', '13d76284998df06764f45670556e96d8', '', '', '', '', 0, '2020-09-18 13:53:31', '0000-00-00 00:00:00', 'yes'),
(30, 'Senthil kumar', '9489080004', 'csthirukutty6@gmail.com', '7b013aade91eea07d8e6ef73e7abd0dd', '', '', '', '', 0, '2020-10-01 13:36:33', '0000-00-00 00:00:00', 'yes'),
(31, 'Geevarghese', '9633693913', 'g.simri.pcm@gmail.com', 'YQN3RG', '', '', '', '', 0, '2020-10-03 09:21:04', '0000-00-00 00:00:00', 'yes'),
(32, 'Sreekanth', '9176042988', '', '681e02fdfd70df510407df7609b9dc41', '', '', '', '', 0, '2020-10-03 20:56:08', '0000-00-00 00:00:00', 'yes'),
(33, 'Solomon', '9443133995', 'abrahamsolomon.j@gmail.com', 'XLVY25', '', '', '', '', 0, '2020-10-05 20:53:12', '0000-00-00 00:00:00', 'yes'),
(34, 'Karthikeyan', '9962617741', 'kartiee@ymail.com', '3ac3b4c1859cd362a74c86506ae4f581', '', '', '', '', 0, '2020-10-17 16:37:37', '0000-00-00 00:00:00', 'yes'),
(35, 'Vinoth', '9791222882', 'svinoth520@gmail.com', 'e86fdc2283aff4717103f2d44d0610f7', '', '', '', '', 0, '2020-10-20 17:12:48', '0000-00-00 00:00:00', 'yes'),
(36, 'xxx ysfa', '0845295364', 'moneyflex94@gmail.com', '6CESFI', '', '', '', '', 0, '2020-10-21 16:58:04', '0000-00-00 00:00:00', 'yes'),
(37, 'DINESH R', '7094462394', 'rssdinesh@gmail.com', 'ec40fcd965a20eaa7bbc55f27f07ba3f', '', '', '', '', 0, '2020-10-22 16:35:28', '0000-00-00 00:00:00', 'yes'),
(38, 'Unni krishnan', '7358984020', 'Ukpillai01@gmail.com', 'f033cb112f5b29102b043a38d51a3eb6', '', '', '', '', 0, '2020-10-24 21:42:02', '0000-00-00 00:00:00', 'yes'),
(39, 'Ashiq mohamed', '9677612291', 'ashiqraja61@yahoo.com', '82ef3f7c51ae5f5a3fad35bab34bb70d', '', '', '', '', 0, '2020-10-25 08:31:03', '0000-00-00 00:00:00', 'yes'),
(40, 'RANCHINI JAYARAMAN', '8754060408', 'ranchinij@gmail.com', 'eceed623d9f8046c5d478cff4f9a2b0d', '', '', '', '', 0, '2020-10-26 12:05:00', '0000-00-00 00:00:00', 'yes'),
(41, 'Samundeeswaran', '8489822969', 'samundeeswaran.91@gmail.com', 'bdbdb6962bd3407f55322209ed51b3ff', '', '', '', '', 0, '2020-10-29 16:51:43', '0000-00-00 00:00:00', 'yes'),
(42, 'SUDHARSANAN D', '9840870125', 'sivasankarisudharsan@gmail.con', 'a78ad13f3919812fb7cdc59034557f1f', '', '', '', '', 0, '2020-10-30 22:40:30', '0000-00-00 00:00:00', 'yes'),
(43, 'Rameeza Begum', '9176068890', 'rameezabegum365@gmail.com', '174e4d2c131b8c040dfe3da8fe503325', '', '', '', '', 0, '2020-11-04 23:39:30', '0000-00-00 00:00:00', 'yes'),
(44, 'Nagasubramanyam', '7845105322', 'ns.nagak@gmail.com', 'a41b0989b39b3b444bb0adef987728cd', '', '', '', '', 0, '2020-11-06 09:45:35', '0000-00-00 00:00:00', 'yes'),
(45, 'Anil kumar', '9444425300', 'SRAKAECS@GMAIL.COM', '185fbaea4fcfe5b82a1f0a9b2431276e', '', '', '', '', 0, '2020-11-08 12:25:47', '0000-00-00 00:00:00', 'yes'),
(46, 'Rakesh', '9791225333', '', '8T0AKV', '', '', '', '', 0, '2020-11-12 18:48:53', '0000-00-00 00:00:00', 'yes'),
(47, 'thanalekshmi', '9626652775', 'ponrishab@gmail.com', 'UPE4YI', '', '', '', '', 0, '2020-11-15 11:51:05', '0000-00-00 00:00:00', 'yes'),
(48, 'VIGNESH RAJA', '8428070497', 'vigneshr4100@gmail.com', '548767e1b3ff26331d9bf31070e46838', '', '', '', '', 0, '2020-11-15 13:22:54', '0000-00-00 00:00:00', 'no'),
(49, 'D.Thenthuli', '9443953949', 'thenthulid@gmail.com ', '5b7f7b7d556fec84ec564482c935d00b', '', '', '', '', 0, '2020-11-16 17:48:05', '0000-00-00 00:00:00', 'yes'),
(50, 'SKM Brothers furniture', '9600603819', 'Sk.mohamad89@Gmail.com', '423d6a01cabc6451597dab79169f67a7', '', '', '', '', 0, '2020-11-17 17:51:54', '0000-00-00 00:00:00', 'yes'),
(51, 'Venkatesh ', '9412880893', 'venkateshkutty@gmail.com ', '3048c1f0675f1ec1e3d25c46299d1661', '', '', '', '', 0, '2020-11-25 12:26:36', '0000-00-00 00:00:00', 'yes'),
(52, 'Manikandan.T', '9944370110', 'moneykandan1990@gmail.com', 'f8c2d361979140c6c2e92fb18fd1b608', '', '', '', '', 0, '2020-12-02 20:52:43', '0000-00-00 00:00:00', 'yes'),
(53, 'Ostin Marshal', '8428464429', 'marshalostin@gmail.com', 'CZ5JH7', '', '', '', '', 0, '2020-12-04 14:19:23', '0000-00-00 00:00:00', 'yes'),
(54, 'Subba Raja Raaman', '9487849547', 'aolavinashi@gmail.com', 'TMSFPR', '', '', '', '', 0, '2020-12-06 21:48:57', '0000-00-00 00:00:00', 'yes'),
(55, 'Udhaya Shanker', '8807116862', 'shankerudhaya7373@gmail.com', 'b3abd7b7261dd64c33a975d7f0e161ee', '', '', '', '', 0, '2020-12-09 09:33:26', '0000-00-00 00:00:00', 'yes'),
(56, 'A .JAINUDEEN', '7904055301', 'jainudeen62@yahoo.in', 'NH8593', '', '', '', '', 0, '2020-12-15 22:48:52', '0000-00-00 00:00:00', 'yes'),
(57, 'Akash Goyal', '9166303640', 'akashgoyal371@gmail.com', 'I13WO6', '', '', '', '', 0, '2020-12-22 13:54:17', '0000-00-00 00:00:00', 'yes'),
(58, 'sathya', '9944149907', 'sathyasatya0005@gmail.com', 'c3481df35e34f97a568bc4d9d5f91fc9', '', '', '', '', 0, '2020-12-22 14:17:20', '0000-00-00 00:00:00', 'yes'),
(59, 'ajbhdbd mndbwhdb', '8786354892', 'dkcnjkhd@vjn.com', 'M4KJB6', '', '', '', '', 0, '2020-12-31 13:59:33', '0000-00-00 00:00:00', 'yes'),
(60, 'Manikandan', '8940112349', 'manikandan16497@gmail.com', '98563fb698ee74fdd94d354bb4141046', '', '', '', '', 0, '2020-12-31 18:43:10', '0000-00-00 00:00:00', 'yes'),
(61, 'Senthilprabhu', '9894181419', 'senthilprabhu.asp@gmail.com', 'VDGUCO', '', '', '', '', 0, '2021-01-02 18:48:07', '0000-00-00 00:00:00', 'yes'),
(62, 'Senthilprabhu', '9677037714', 'senthilprabhu.asp@gmail.com', 'U07GEO', '', '', '', '', 0, '2021-01-02 18:56:20', '0000-00-00 00:00:00', 'yes'),
(63, 'M THAMOTHARAN', '9442290434', 'mthamut@gmail.com', '3H5E1O', '', '', '', '', 0, '2021-01-04 14:03:30', '0000-00-00 00:00:00', 'yes'),
(64, 'V. N. Muhammad ashiq ilahi', '9944205466', 'Mohamedilahiasik3344@gmail.com ', '73404fda317824ed985c153641d6ffb0', '', '', '', '', 0, '2021-01-11 16:15:48', '0000-00-00 00:00:00', 'yes'),
(65, 'Varun', '7397450311', 'MLR7559@GMAIL.COM', 'D8V2IN', '', '', '', '', 0, '2021-01-13 19:02:55', '0000-00-00 00:00:00', 'yes'),
(66, 'Suryanarayan Satpathy', '7978735162', 'satpathy453@gmail.com', '853a7dd6d2c844f92df9d181a3db65b1', '', '', '', '', 0, '2021-01-13 21:11:32', '0000-00-00 00:00:00', 'yes'),
(67, 'Pavithra', '7811036382', 'pavithrakanagaraj66@gmail.com', '4LK2A7', '', '', '', '', 0, '2021-01-13 21:27:37', '0000-00-00 00:00:00', 'yes'),
(68, 'Ravichandran rc', '9750099961', 'rcrr182001@gmail.com', 'FVOT5B', '', '', '', '', 0, '2021-01-15 14:38:31', '0000-00-00 00:00:00', 'yes'),
(69, 'Anuprakash', '7904648685', 'anuprakashkct28@gmail.com', '77eb73d0d04cd96d4e4f596fcf85e09c', '', '', '', '', 0, '2021-01-18 00:34:06', '0000-00-00 00:00:00', 'yes'),
(70, 'VENKATARAMANI S', '9443577127', 'ramani523@gmail.com', '9943c6f24d04b971940c86fd60417206', '', '', '', '', 0, '2021-01-29 14:13:51', '0000-00-00 00:00:00', 'yes'),
(71, 'Arockia Doss A', '9884876500', 'arockiadoss.a@gmail.com', 'OGTP9Q', '', '', '', '', 0, '2021-01-29 19:28:46', '0000-00-00 00:00:00', 'yes'),
(72, 'vadivel', '9791348913', 'asdsds@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 0, '2021-02-03 14:44:05', '0000-00-00 00:00:00', 'yes'),
(73, 'dvjbh kjdfbv', '0987678574', 'sdvjn@dvjj.com', 'PK0WBY', '', '', '', '', 0, '2021-02-06 19:51:45', '0000-00-00 00:00:00', 'yes'),
(74, 'Vignesh', '9952845757', '', 'L3I25K', '', '', '', '', 0, '2021-02-10 18:34:42', '0000-00-00 00:00:00', 'yes'),
(75, 'SOLOMON MATHANLAL D', '8189899799', 'srswealthmanagement02@gmail.com', '11bfd04082e10e2732c6dcd46c359b9f', '', '', '', '', 0, '2021-02-12 18:18:51', '0000-00-00 00:00:00', 'yes'),
(76, 'Ufa', '7810896212', 'udaykrishnamoorthy79@gmail.com', '8WJ6FC', '', '', '', '', 0, '2021-02-17 19:19:57', '0000-00-00 00:00:00', 'yes'),
(77, 'Karthick K', '9791283708', 'kkarthick82@gmail.com', '5WYDNM', '', '', '', '', 0, '2021-02-23 14:07:30', '0000-00-00 00:00:00', 'yes'),
(78, 'Karthick K', '9791672570', 'kkarthick82@gmail.com', 'PETN87', '', '', '', '', 0, '2021-02-23 20:00:53', '0000-00-00 00:00:00', 'yes'),
(79, 'Rajagopal ', '9629340239', 'rajabayaa03@gmail.com ', '21b95a0f90138767b0fd324e6be3457b', '', '', '', '', 0, '2021-02-27 08:01:56', '0000-00-00 00:00:00', 'yes'),
(80, 'Udaya Singh', '9789219215', 'udayasingh69@yahoo.in', '5df04043129da34114b747f8863e7d9d', '', '', '', '', 0, '2021-02-27 17:38:49', '0000-00-00 00:00:00', 'yes'),
(81, 'Nagendran', '9843789843', 'mailtonagendran@gmail.com', '8cb554127837a4002338c10a299289fb', '', '', '', '', 0, '2021-03-02 18:42:11', '0000-00-00 00:00:00', 'yes'),
(82, 'JOHNSON.G', '9443432392', 'johnsong9886@gmail.com', '58c2bd8a8be6198468412a24a56acf0b', '', '', '', '', 0, '2021-03-16 14:19:02', '0000-00-00 00:00:00', 'yes'),
(83, 'mrb', '6379441672', 'balajijoswa@mail.com', '670a97bef0be23162006cd8941f7e830', '', '', '', '', 0, '2021-03-26 23:07:34', '0000-00-00 00:00:00', 'yes'),
(84, 'Apple4 A4', '0987654321', 'Apple4@mail.com', 'VT7256', '', '', '', '', 0, '2021-03-30 15:24:10', '0000-00-00 00:00:00', 'yes'),
(85, 'Arulventhan', '8754596261', 'arulventhan.s1969@gmail.com', 'ddee46b2d2d0ac7ab09dfda836bc329e', '', '', '', '', 0, '2021-04-01 15:55:49', '0000-00-00 00:00:00', 'yes'),
(86, 'Arputhavalan', '8870181485', 'bernicevalan76@gmail.com', '72bc2bde1c7a868b70e927481c9a77c7', '', '', '', '', 0, '2021-04-08 18:58:08', '0000-00-00 00:00:00', 'yes'),
(87, 'Malhotra', '8447436555', 'sejalmalhotra4310@gmail.com', 'fda4b2dba861020f0e2e0d27fba07c88', '', '', '', '', 0, '2021-04-15 12:21:16', '0000-00-00 00:00:00', 'yes'),
(88, 'Mani Kamal Singha Roy', '6291808812', 'manikamalsingharoy82@gmail.com', '581712dc0541a2cb019c8b2df1485aa6', '', '', '', '', 0, '2021-04-15 19:21:10', '0000-00-00 00:00:00', 'yes'),
(89, 'balaji', '6379441172', 'balaji.hdt@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4', '', '', '', '', 0, '2021-05-04 10:47:36', '0000-00-00 00:00:00', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `parent_id`, `location_name`, `sort_order`) VALUES
(1, 0, 'Andhra Pradesh', 5),
(17, 0, 'Karnataka', 3),
(18, 0, 'Kerala', 2),
(29, 0, 'Tamil Nadu', 1),
(37, 0, 'Telangana', 6),
(38, 0, 'Arunachal Pradesh	', 7),
(39, 0, 'Assam', 8),
(40, 0, 'Bihar', 9),
(41, 0, 'Chhattisgarh', 10),
(42, 0, 'Goa', 11),
(43, 0, 'Gujarat', 12),
(44, 0, 'Haryana', 13),
(45, 0, 'Himachal Pradesh', 14),
(46, 0, 'Jharkhand', 15),
(47, 0, 'Madhya Pradesh', 16),
(48, 0, 'Maharashtra', 17),
(49, 0, 'Manipur', 18),
(50, 0, 'Meghalaya', 19),
(51, 0, 'Mizoram', 20),
(52, 0, 'Nagaland', 21),
(53, 0, 'Odisha', 22),
(54, 0, 'Punjab', 23),
(55, 0, 'Rajasthan', 24),
(56, 0, 'Sikkim', 25),
(57, 0, 'Tripura', 26),
(58, 0, 'Uttar Pradesh	', 27),
(59, 0, 'Uttarakhand', 28),
(60, 0, 'West Bengal', 29);

-- --------------------------------------------------------

--
-- Table structure for table `miscellaneous`
--

CREATE TABLE `miscellaneous` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `type_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `miscellaneous`
--

INSERT INTO `miscellaneous` (`id`, `type_name`, `type_value`) VALUES
(1, 'Top Feed', '\"CUDDLE BUDDY\" LAUNCHING OFFER Use Code CUDDLE25 to avail FLAT 25% Off, Delivery Dates may differ depending on the Covid restriction.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_id` varchar(20) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `mobileno_alt` varchar(10) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `order_notes` text NOT NULL,
  `sub_total` int(11) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `net_amount` int(11) NOT NULL,
  `status` enum('pending','verification-process','process','dispatch','out-for-delivery','delivered','cancel-request','cancelled','initiated') NOT NULL DEFAULT 'initiated',
  `order_date` datetime NOT NULL,
  `cancel_date` datetime DEFAULT NULL,
  `cancel_reason` text NOT NULL,
  `razorpay_order_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_id`, `userid`, `name`, `mobileno`, `mobileno_alt`, `emailid`, `address`, `city`, `state`, `pincode`, `order_notes`, `sub_total`, `coupon_code`, `coupon_value`, `net_amount`, `status`, `order_date`, `cancel_date`, `cancel_reason`, `razorpay_order_id`) VALUES
(100232, '', 9, 'Yuvaraj V', '9677378582', '9677378582', '', 'RA.17, Naval Airforce Enclave, Behind Siva Hospital, Athipalayam Pirivu, Ganapathy,Coimbatore - 641006', 'coimbatore', 'Tamil Nadu', 641006, '', 0, '', 0, 0, 'cancelled', '2020-07-25 19:47:32', '0000-00-00 00:00:00', '', ''),
(100240, '', 9, 'Yuvaraj V', '9677378582', '', '', 'Hhh', 'Coimbatore', 'Tamil Nadu', 641006, '', 0, '', 0, 0, 'cancelled', '2020-07-25 20:07:24', '0000-00-00 00:00:00', '', ''),
(100244, '', 15, 'Rajkumar', '9843211441', '', 'imraj1798@gmail.com', 'B1 amasaveni apt', 'Karur', 'Tamil Nadu', 639001, '', 0, '', 0, 0, 'delivered', '2020-08-07 10:50:10', '0000-00-00 00:00:00', '', ''),
(100245, '', 17, 'Masanam', '9787408610', '9080961437', 'Masanam241978@gmail.com', 'Manjolai 1st street', 'Ilanji', 'Tamil Nadu', 627805, '', 0, '', 0, 0, 'initiated', '2020-08-18 19:56:41', '0000-00-00 00:00:00', '', ''),
(100246, '', 9, 'Yuvaraj V', '9677378582', '', 'hi.sendmeamail@gmail.com', 'RA.17, Naval Airforce Enclave, Behind Siva Hospital, Athipalayam Pirivu, Ganapathy,Coimbatore - 641006', 'coimbatore', 'Tamil Nadu', 641006, '', 0, '', 0, 0, 'cancelled', '2020-08-19 16:18:16', '0000-00-00 00:00:00', '', ''),
(100247, '', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'verification-process', '2020-08-21 18:20:43', '0000-00-00 00:00:00', '', ''),
(100248, '', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-21 18:21:39', '0000-00-00 00:00:00', '', ''),
(100249, '', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-21 18:21:41', '0000-00-00 00:00:00', '', ''),
(100250, '', 15, 'Rajkumar', '9843211441', '', 'imraj1798@gmail.com', 'S.F.No.283/1b , Sukkampatti , Karur - 639003', 'karur', 'Tamil Nadu', 639003, '', 0, '', 0, 0, 'initiated', '2020-08-22 11:32:34', '0000-00-00 00:00:00', '', ''),
(100251, '', 8, 'yuvaraj', '9677378582', '', 'hi.sendmeamail@gmail.com', 'RA.17, Naval Airforce Enclave, Behind Siva Hospital, Athipalayam Pirivu, Ganapathy,Coimbatore - 641006', 'coimbatore', 'Tamil Nadu', 641006, '', 0, '', 0, 0, '', '2020-08-22 11:35:46', '0000-00-00 00:00:00', '', ''),
(100252, '', 15, 'Rajkumar', '9843211441', '', 'imraj1798@gmail.com', 'S.F.No.283/1b , Sukkampatti , Karur - 639003', 'karur', 'Tamil Nadu', 639003, '', 0, '', 0, 0, 'initiated', '2020-08-22 11:38:10', '0000-00-00 00:00:00', '', ''),
(100253, '', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, '', '2020-08-27 13:56:06', '0000-00-00 00:00:00', '', ''),
(100254, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'process', '2020-08-27 14:07:36', '0000-00-00 00:00:00', '', ''),
(100255, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:13:40', '0000-00-00 00:00:00', '', ''),
(100256, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:13:51', '0000-00-00 00:00:00', '', ''),
(100257, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:14:49', '0000-00-00 00:00:00', '', ''),
(100258, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:15:40', '0000-00-00 00:00:00', '', ''),
(100259, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:19:05', '0000-00-00 00:00:00', '', ''),
(100260, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:20:09', '0000-00-00 00:00:00', '', ''),
(100261, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:20:09', '0000-00-00 00:00:00', '', ''),
(100262, '', 18, '', '', '', '', '', '', '', 0, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:20:39', '0000-00-00 00:00:00', '', ''),
(100263, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:21:47', '0000-00-00 00:00:00', '', ''),
(100264, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-08-27 14:22:24', '0000-00-00 00:00:00', '', ''),
(100265, '', 20, 'test', '9999999999', '', 'test@test123.com', 'tsrgfdsawsrcghvbhjbhugytrrytsdxgvhj', 'bangalore', 'Karnataka', 560017, '', 0, '', 0, 0, 'initiated', '2020-08-27 17:10:30', '0000-00-00 00:00:00', '', ''),
(100266, '', 21, 'test', '0999999999', '', 'test@test123.com', 'tsrgfdsawsrcghvbhjbhugytrrytsdxgvhj', 'bangalore', 'Karnataka', 560017, '', 0, '', 0, 0, 'initiated', '2020-08-28 09:28:37', '0000-00-00 00:00:00', '', ''),
(100267, '', 21, 'test', '4499999999', '9999999999', 'test@test123.com', 'tsrgfdsawsrcghvbhjbhugytrrytsdxgvhj', 'bangalore', 'Karnataka', 560017, '', 0, '', 0, 0, 'initiated', '2020-08-28 09:29:13', '0000-00-00 00:00:00', '', ''),
(100268, '', 21, 'test', '9999999988', '', 'test@test123.com', 'tsrgfdsawsrcghvbhjbhugytrrytsdxgvhj dsvsdfds sdfdsf sfdsf', 'bangalore', 'Karnataka', 560017, '', 0, '', 0, 0, 'initiated', '2020-08-28 09:31:02', '0000-00-00 00:00:00', '', ''),
(100269, '', 21, 'test', '0999999998', '0999999998', 'test@test123.com', 'tsrgfdsawsrcghvbhjbhugytrrytsdxgvhj dsvsdfds sdfdsf sfdsf', 'bangalore', 'Karnataka', 560017, '', 0, '', 0, 0, 'initiated', '2020-08-28 09:31:38', '0000-00-00 00:00:00', '', ''),
(100270, '', 22, 'Senthil Kumar.C.A', '0960096966', '', 'mahisenthil23@gmail.com', '#31, Mahizham,sivasakthi colony near Rajam hospital Sidco industrial estate post Coimbatore', 'Coimbatore', 'Tamil Nadu', 641021, '', 0, '', 0, 0, 'initiated', '2020-09-01 15:51:49', '0000-00-00 00:00:00', '', ''),
(100271, '', 22, 'Senthil Kumar.C.A', '0960096966', '', 'mahisenthil23@gmail.com', '#31mahizham,Siva Sakthi colony\r\nNear Rajam hospital, Sidco industrial estate post, Coimbatore-641021', 'Coimbatore', 'Tamil Nadu', 641021, '', 0, '', 0, 0, 'initiated', '2020-09-01 15:55:02', '0000-00-00 00:00:00', '', ''),
(100272, '', 22, 'Senthil Kumar.C.A', '0960096966', '', 'mahisenthil23@gmail.com', '#31, Mahizham,sivasakthi colony near Rajam hospital Sidco industrial estate post Coimbatore', 'Coimbatore', 'Tamil Nadu', 641021, '', 0, '', 0, 0, 'initiated', '2020-09-01 16:01:22', '0000-00-00 00:00:00', '', ''),
(100273, '', 22, 'Senthil Kumar.C.A', '0960096966', '9003777555', 'mahisenthil23@gmail.com', '#31, Mahizham,sivasakthi colony near Rajam hospital Sidco industrial estate post Coimbatore', 'Coimbatore', 'Tamil Nadu', 641021, '', 0, '', 0, 0, 'initiated', '2020-09-01 16:03:30', '0000-00-00 00:00:00', '', ''),
(100274, '', 9, 'Yuvaraj V', '9677378582', '', 'hi.sendmeamail@gmail.com', 'Hhh', 'Coimbatore', 'Tamil Nadu', 641006, '', 0, '', 0, 0, 'initiated', '2020-09-02 18:24:09', '0000-00-00 00:00:00', '', ''),
(100275, '', 9, 'Yuvaraj V', '9677378582', '', 'hi.sendmeamail@gmail.com', 'Hhh', 'Coimbatore', 'Tamil Nadu', 641006, '', 0, '', 0, 0, 'initiated', '2020-09-02 18:24:40', '0000-00-00 00:00:00', '', ''),
(100276, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-09-02 18:40:52', '0000-00-00 00:00:00', '', ''),
(100277, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-09-02 18:49:04', '0000-00-00 00:00:00', '', ''),
(100278, '', 9, 'Yuvaraj V', '9677378582', '', '', 'Hhh', 'Coimbatore', 'Tamil Nadu', 641006, '', 0, '', 0, 0, 'initiated', '2020-09-02 18:58:54', '0000-00-00 00:00:00', '', ''),
(100279, '', 9, 'Yuvaraj V', '9677378582', '', '', 'Hhh', 'Coimbatore', 'Tamil Nadu', 641006, '', 0, '', 0, 0, 'initiated', '2020-09-02 18:59:12', '0000-00-00 00:00:00', '', ''),
(100280, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-09-02 19:01:14', '0000-00-00 00:00:00', '', ''),
(100281, '', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 645120, '', 0, '', 0, 0, 'initiated', '2020-09-02 19:02:11', '0000-00-00 00:00:00', '', ''),
(100282, '', 9, 'Yuvaraj V', '9677378582', '', 'hi.sendmeamail@gmail.com', 'Hhh', 'Coimbatore', 'Tamil Nadu', 641006, '', 0, '', 0, 0, '', '2020-09-02 19:05:04', '0000-00-00 00:00:00', '', ''),
(100283, 'PM100283', 26, 'k jeyaraj', '9948840404', '9791240404', 'jeyarajbhuvi@gmail.com', 'flot no 26, balaji nagar', 'nellore', 'Andhra Pradesh', 524002, '', 9219, '', 0, 9219, 'delivered', '2020-09-12 10:21:31', '0000-00-00 00:00:00', '', ''),
(100284, '', 18, 'Navaneetha Krishnan', '0956633030', '0956633030', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-09-12 11:31:08', '0000-00-00 00:00:00', '', ''),
(100285, '', 27, 'Navaneetha Krishnan', '0956633030', '0956633030', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2020-09-12 11:31:42', '0000-00-00 00:00:00', '', ''),
(100286, 'PM100286', 27, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, '', '2020-09-12 11:32:20', '0000-00-00 00:00:00', '', 'order_Fc0pNnarkSeyYV'),
(100287, 'PM100287', 27, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'cancelled', '2020-09-12 11:35:49', '0000-00-00 00:00:00', '', 'order_Fc0t3WLx0FgRVV'),
(100288, 'PM100288', 9, 'Yuvaraj V', '9677378582', '', 'hi.sendmeamail2@gmail.com', 'RA.17, Naval Airforce Enclave, Behind Siva Hospital, Athipalayam Pirivu, Ganapathy,Coimbatore - 641006', 'coimbatore', 'Tamil Nadu', 641006, '', 8622, '', 0, 8622, 'process', '2020-09-12 11:54:24', '0000-00-00 00:00:00', '', 'order_Fc1CgYWUh5PPVb'),
(100289, 'PM100289', 9, 'Yuvaraj V', '9677378582', '', 'hi.sendmeamail2@gmail.com', 'RA.17, Naval Airforce Enclave, Behind Siva Hospital, Athipalayam Pirivu, Ganapathy,Coimbatore - 641006', 'coimbatore', 'Tamil Nadu', 641006, '', 5310, '', 0, 5310, 'initiated', '2020-09-12 11:59:19', '0000-00-00 00:00:00', '', 'order_Fc1HswfCM0x6jT'),
(100290, 'PM100290', 8, 'Krishnan', '9566330303', '', '', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'initiated', '2020-09-12 12:02:54', '0000-00-00 00:00:00', '', 'order_Fc1LfgWGgFuo7E'),
(100291, 'PM100291', 8, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, '', '2020-09-12 12:03:06', '0000-00-00 00:00:00', '', 'order_Fc1LsSni5XvZxU'),
(100292, 'PM100292', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'TIrupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'initiated', '2020-09-12 12:04:29', '0000-00-00 00:00:00', '', 'order_Fc1NM0DFVAoGEr'),
(100293, 'PM100293', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'initiated', '2020-09-12 12:09:56', '0000-00-00 00:00:00', '', 'order_Fc1T5r7VhYSMQS'),
(100294, 'PM100294', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'initiated', '2020-09-12 12:09:56', '0000-00-00 00:00:00', '', 'order_Fc1T6RG2Zun4YZ'),
(100295, 'PM100295', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'initiated', '2020-09-12 12:09:58', '0000-00-00 00:00:00', '', 'order_Fc1T84kuOlJOmT'),
(100296, 'PM100296', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'verification-process', '2020-09-12 12:11:53', '0000-00-00 00:00:00', '', 'order_Fc1V9XCaGJGK8Y'),
(100297, 'PM100297', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 9219, '', 0, 9219, 'initiated', '2020-09-12 13:29:02', '0000-00-00 00:00:00', '', 'order_Fc2oevuFT8GfwV'),
(100298, 'PM100298', 9, 'Yuvaraj V', '9677378582', '', 'hi.sendmeamail@gmail.com', 'RA.17, Naval Airforce Enclave, Behind Siva Hospital, Athipalayam Pirivu, Ganapathy,Coimbatore - 641006', 'coimbatore', 'Tamil Nadu', 641006, '', 5310, 'stayhome', 637, 4673, 'cancelled', '2020-09-12 17:45:28', '0000-00-00 00:00:00', '', 'order_Fc7BXEmoE8UqTa'),
(100299, 'PM100299', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupru', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'initiated', '2020-09-14 21:31:30', '0000-00-00 00:00:00', '', 'order_Fcy6X59TOEP4QW'),
(100300, 'PM100300', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'initiated', '2020-09-15 12:05:50', '0000-00-00 00:00:00', '', 'order_FdD08LjUCitTsG'),
(100301, 'PM100301', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 12654, '', 0, 12654, 'initiated', '2020-09-15 12:15:32', '0000-00-00 00:00:00', '', 'order_FdDANhjzc2kQ7H'),
(100302, 'PM100302', 31, 'Geevarghese', '9633693913', '', 'g.simri.pcm@gmail.com', 'Asset homes Jawahar nagar', 'Ernakulam', 'Kerala', 682020, '', 18882, '', 0, 18882, '', '2020-10-03 09:21:04', '0000-00-00 00:00:00', '', 'order_FkHoFucyd7PL7t'),
(100303, 'PM100303', 32, 'Rajeswari', '9791124566', '9176042988', 'padmasree404@gmail.com', 'H.No. 10/6, Ground floor, Griffith 2nd Street, E-Pallavaram.\r\nLandmark: Behind Therasa school', 'Chennai', 'Tamil Nadu', 600043, '', 15863, 'Cricket20', 2379, 13484, 'delivered', '2020-10-04 12:45:48', '0000-00-00 00:00:00', '', 'order_Fkjpedx5QGbSOF'),
(100304, 'PM100304', 33, 'Solomon', '9443133995', '9080844496', 'abrahamsolomon.j@gmail.com', 'Malathi\r\nMariyamman koil 2nd Street,\r\nBurma Colony,\r\nMathur Roundana\r\nTrichy-7', 'Trichy', 'Tamil Nadu', 620007, '', 16350, '', 0, 16350, 'delivered', '2020-10-05 20:53:12', '0000-00-00 00:00:00', '', 'order_FlGfc54MRkHskl'),
(100305, 'PM100305', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupru', 'Tirupur', 'Tamil Nadu', 641666, 'This is testing', 13410, '', 0, 13410, 'initiated', '2020-10-14 00:16:32', '0000-00-00 00:00:00', '', 'order_FoUPMxgKMUKeZV'),
(100306, 'PM100306', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 13410, '', 0, 13410, 'initiated', '2020-10-19 18:34:34', '0000-00-00 00:00:00', '', 'order_FqlmrHx7zro07c'),
(100307, 'PM100307', 36, 'xxx ysfa', '0845295364', '', 'moneyflex94@gmail.com', 'shgod ouypd\r\nsgvhxahah', 'Mumbai', 'Kerala', 400018, '', 40095, '', 0, 40095, 'initiated', '2020-10-21 16:58:04', '0000-00-00 00:00:00', '', 'order_FrXDAJddcDtDfg'),
(100308, 'PM100308', 15, 'Rajkumar', '9843211441', '', 'imraj1798@gmail.com', 'b1', 'Karur', 'Tamil Nadu', 639001, '', 9324, '', 0, 9324, 'initiated', '2020-10-22 09:32:53', '0000-00-00 00:00:00', '', 'order_FroA1QKmlgCkt5'),
(100309, 'PM100309', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, 'Order Testing by navaneetha krishnan', 13410, '', 0, 13410, 'initiated', '2020-10-23 04:22:53', '0000-00-00 00:00:00', '', 'order_Fs7PfWoqjRNeAQ'),
(100310, 'PM100310', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 13410, '', 0, 13410, '', '2020-10-23 04:23:37', '0000-00-00 00:00:00', '', 'order_Fs7QSClbGGiomc'),
(100311, 'PM100311', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 13410, '', 0, 13410, '', '2020-10-23 04:25:28', '0000-00-00 00:00:00', '', 'order_Fs7SPEQ8LgOdP1'),
(100312, 'PM100312', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, 'This is testing by Navaneetha Krishnan', 13410, '', 0, 13410, 'initiated', '2020-10-23 04:29:17', '0000-00-00 00:00:00', '', 'order_Fs7WQcsDlZ2JEs'),
(100313, 'PM100313', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641006, 'Testing by Navaneethan', 13410, '', 0, 13410, 'initiated', '2020-10-23 04:33:59', '0000-00-00 00:00:00', '', 'order_Fs7bOs9Cg9yXAT'),
(100314, 'PM100314', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, 'Testing by Navaneethan', 13410, '', 0, 13410, '', '2020-10-23 04:38:44', '0000-00-00 00:00:00', '', 'order_Fs7gPeYMabe3Qa'),
(100315, 'PM100315', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, 'This is testing', 13410, '', 0, 13410, '', '2020-10-23 04:39:44', '0000-00-00 00:00:00', '', 'order_Fs7hT3Ao9oudJR'),
(100316, 'PM100316', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, 'This is testing', 13410, '', 0, 13410, '', '2020-10-23 04:41:57', '0000-00-00 00:00:00', '', 'order_Fs7jokE4rgtw1s'),
(100317, 'PM100317', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'TIrupur', 'Tamil Nadu', 641652, 'This is testing', 13410, '', 0, 13410, '', '2020-10-23 04:44:58', '0000-00-00 00:00:00', '', 'order_Fs7n04SHz1O82U'),
(100318, 'PM100318', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupru', 'Tamil Nadu', 641652, 'This is testing by Navaneetha Krishnan (Development Team)', 13410, '', 0, 13410, 'verification-process', '2020-10-23 04:47:56', '0000-00-00 00:00:00', '', 'order_Fs7q8hOC6zBroU'),
(100319, 'PM100319', 8, 'webmaster', '0967737858', '', 'hi.sendmeamail2@gmail.com', 'Test', 'Coimbatore', 'Tamil Nadu', 641006, '', 13410, '', 0, 13410, '', '2020-10-23 11:33:58', '0000-00-00 00:00:00', '', 'order_FsEl37mbItJTXe'),
(100320, 'PM100320', 8, 'webmaster', '0967737858', '', 'hi.sendmeamail2@gmail.com', 'cbee', 'Coimbatore', 'Tamil Nadu', 641006, '', 13410, '', 0, 13410, '', '2020-10-23 11:35:41', '0000-00-00 00:00:00', '', 'order_FsEmqihnupFSDc'),
(100321, 'PM100321', 18, 'Navaneetha Krishnan', '0956633030', '', 'techaveo@gmail.com', '7C Radius Avenue\r\nNesevalar colony, Thirumurugan poondi', 'Tirupur', 'Tamil Nadu', 641652, '', 26820, '', 0, 26820, '', '2020-10-23 12:40:51', '0000-00-00 00:00:00', '', 'order_FsFthC5GvMLklN'),
(100322, 'PM100322', 15, 'Rajkumar', '9843211441', '', 'imraj1798@gmail.com', 'b1', 'Karur', 'Tamil Nadu', 639001, '', 19050, '', 0, 19050, '', '2020-10-23 12:41:41', '0000-00-00 00:00:00', '', 'order_FsFuZj1RikZByP'),
(100323, 'PM100323', 38, 'Unni krishnan', '7358984020', '8750272722', 'Ukpillai01@gmail.com', 'Q. NO.  A- 236 CISF RTC SURAKSHA CAMP, THAKKOLAM, ARAKKONAM', 'ARAKKONAM', 'Tamil Nadu', 631152, '', 15156, 'HAPPYSLEEP', 3031, 12125, '', '2020-10-24 21:59:40', '0000-00-00 00:00:00', '', 'order_Fsnx6rODSzive2'),
(100324, 'PM100324', 38, 'Unni krishnan', '7358984020', '8750272722', 'Ukpillai01@gmail.com', '236-A, Type -2 quarters,CISF RTC SURAKSHA CAMP, THAKKOLAM', 'Arakkonam', 'Tamil Nadu', 631152, '', 15156, 'HAPPYSLEEP', 3031, 12125, '', '2020-10-24 22:10:09', '0000-00-00 00:00:00', '', 'order_Fso8B6x5gdvL19'),
(100325, 'PM100325', 38, 'Unni krishnan', '7358984020', '8750272722', 'Ukpillai01@gmail.com', 'Q. NO. 236 A,TYPE-2, CISF RTC SURAKSHA CAMP, THAKKOLAM, ARAKKONAM', 'Arakkonam, Thakkolam', 'Tamil Nadu', 631152, '', 15156, 'HAPPYSLEEP', 3031, 12125, 'delivered', '2020-10-25 14:05:04', '0000-00-00 00:00:00', '', 'order_Ft4Ou6VHXrE9LA'),
(100326, 'PM100326', 43, 'Rameeza Begum', '9176068890', '7092599580', 'rameezabegum365@gmail.com', 'No.10/116, 5th Street, Agatheeshwara Nagar Pozhichalur, Chennai 600074', 'Chennai', 'Tamil Nadu', 600074, 'Please deliver as soon as possible. Deliver between 9AM to 1 PM.', 22815, 'HAPPYSLEEP', 4563, 18252, 'delivered', '2020-11-04 23:47:10', '0000-00-00 00:00:00', '', 'order_FxBezyNfeiQOT4'),
(100327, 'PM100327', 44, 'Nagasubramanyam', '7845105322', '8184952384', 'ns.nagak@gmail.com', 'Argent Tower,Room No 305,pbel city,kelambakkam,603103,land mark velammal new gen school', 'Kelambakkam', 'Tamil Nadu', 603103, '', 29556, '', 0, 29556, '', '2020-11-06 09:48:26', '0000-00-00 00:00:00', '', 'order_FxkRFwj8GT6kt7'),
(100328, 'PM100328', 44, 'Nagasubramanyam', '7845105322', '8184952384', 'ns.nagak@gmail.com', 'Room No 305,Argent Tower, Pbel City,\r\nKelambakkam,chennai.', 'Kelambakkam', 'Tamil Nadu', 603103, '', 37008, 'HAPPYSLEEP', 7402, 29606, '', '2020-11-06 10:08:28', '0000-00-00 00:00:00', '', 'order_FxkmQBiU1TRT3z'),
(100329, 'PM100329', 44, 'Nagasubramanyam', '7845105322', '8184952384', 'ns.nagak@gmail.com', 'Room No 305,Argent Tower,Pbel City,Kelambakkam,Chennai', 'Kelambakkam', 'Tamil Nadu', 603103, '', 37008, 'HAPPYSLEEP', 7402, 29606, 'delivered', '2020-11-06 10:13:02', '0000-00-00 00:00:00', '', 'order_FxkrEwvGLy4fdM'),
(100330, 'PM100330', 46, 'Rakesh', '9791225333', '', '', '12 b', 'Madurai', 'Tamil Nadu', 625001, '', 6828, '', 0, 6828, 'verification-process', '2020-11-12 18:48:53', '0000-00-00 00:00:00', '', 'order_G0GqsY7524FEDu'),
(100331, 'PM100331', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, '', 13410, '', 0, 13410, '', '2020-11-12 22:33:24', '0000-00-00 00:00:00', '', 'order_G0Kg2vvLcIgbcG'),
(100332, 'PM100332', 47, 'thanalekshmi', '9626652775', '6380572297', 'ponrishab@gmail.com', 'no:8,jaman nagar\r\nrajagopalapuram post', 'Pudukkottai', 'Tamil Nadu', 622003, '', 12700, 'HAPPYDIWALI', 3175, 9525, '', '2020-11-15 11:51:05', '0000-00-00 00:00:00', '', 'order_G1LKth9arkGlsk'),
(100333, 'PM100333', 51, 'Venkatesh', '0877808047', '8778080478', 'venkateshfir@gmail.com', 'H no 3/401\r\nNehru Nagar1 kangyampalayam PO and village, Land mark SBI and  Near Lemon sports', 'Coimbatore', 'Tamil Nadu', 641401, '', 14040, 'POPPYSLEEP', 2106, 11934, '', '2020-11-25 12:38:58', '0000-00-00 00:00:00', '', 'order_G5JUgU0bC2wisp'),
(100334, 'PM100334', 51, 'Venkatesh', '9412880893', '8778080478', 'venkateshkutty@gmail.com', 'HOUSE NO 3/401 NEHRU NAGAR 1, KANAGAYAMPALAYAM PO AND VILL , TIRCHY ROAD , SULUR VIA , \r\nLAND MARK STATE BANK OF INDIA , AIR FORCE STATION SULUR,', 'COIMBATORE', 'Tamil Nadu', 641401, '', 14040, 'POPPYSLEEP', 2106, 11934, 'delivered', '2020-11-25 16:24:40', '0000-00-00 00:00:00', '', 'order_G5NL5bYSyR6gmD'),
(100335, 'PM100335', 53, 'Ostin Marshal', '8428464429', '', 'marshalostin@gmail.com', 'No.1, bank colony first street (extension), Madhavaram, Chennai - 600060', 'Chennai', 'Tamil Nadu', 600060, '', 98709, '', 0, 98709, '', '2020-12-04 14:19:23', '0000-00-00 00:00:00', '', 'order_G8u0qinAv9ZR2X'),
(100336, 'PM100336', 54, 'Subba Raja Raaman', '9487849547', '', 'aolavinashi@gmail.com', 'Committiyar Colony', 'Avinashi', 'Tamil Nadu', 641654, '', 12700, 'POPPYSLEEP', 1905, 10795, '', '2020-12-06 21:48:57', '0000-00-00 00:00:00', '', 'order_G9ojygAippdynl'),
(100337, 'PM100337', 55, 'Udhaya Shanker', '8807116862', '7010877645', 'shankerudhaya7373@gmail.com', '2/553 B Thiruvalluvar Nagar,\r\nMalumichampatti', 'Coimbatore', 'Tamil Nadu', 641050, '', 12415, 'POPPYSLEEP', 1862, 10553, '', '2020-12-09 09:47:29', '0000-00-00 00:00:00', '', 'order_GAo3EPcdd3VwQk'),
(100338, 'PM100338', 55, 'Udhaya Shanker', '7010877645', '7010877645', 'shankerudhaya7373@gmail.com', '2/553 B Thiruvalluvar Nagar,\r\nMalumichampatti', 'Coimbatore', 'Tamil Nadu', 641050, '', 12415, 'POPPYSLEEP', 1862, 10553, '', '2020-12-09 10:27:54', '0000-00-00 00:00:00', '', 'order_GAojug6ijeK90z'),
(100339, 'PM100339', 56, 'A .JAINUDEEN', '7904055301', '9443174066', 'jainudeen62@yahoo.in', '38/A 7.MULLAI NAGAR..       DASAMPALAYAM ROAD', 'METTUPALAYAM ..COIMBATORE DISTRICT', 'Tamil Nadu', 641305, '', 19422, 'POPPYSLEEP', 2913, 16509, '', '2020-12-15 22:48:52', '0000-00-00 00:00:00', '', 'order_GDOZLZMNet10rr'),
(100340, 'PM100340', 56, 'A .JAINUDEEN', '7904055301', '9443174066', 'jainudeen62@yahoo.in', '38/A 7.MULLAI NAGAR.   .    DASAMPALAYAM ROAD', 'METTUPALAYAM    .COIMBATORE DISTRICT', 'Tamil Nadu', 641305, 'Cash on delivary', 19422, 'POPPYSLEEP', 2913, 16509, '', '2020-12-15 22:54:08', '0000-00-00 00:00:00', '', 'order_GDOeuMNJfGjMsH'),
(100341, 'PM100341', 57, 'Akash Goyal', '9166303640', '', 'akashgoyal371@gmail.com', 'Madras Atomic Power Station', 'Kalpakkam', 'Tamil Nadu', 603102, '', 9563, 'poppy2021', 1434, 8129, '', '2020-12-22 13:54:17', '0000-00-00 00:00:00', '', 'order_GG1CUlFV1hY5ih'),
(100342, 'PM100342', 57, 'Akash Goyal', '9166303640', '', 'akashgoyal371@gmail.com', 'Madras Atomic Power Station', 'Kalpakkam', 'Tamil Nadu', 603102, '', 9563, 'poppy2021', 1434, 8129, 'initiated', '2020-12-22 14:44:52', '0000-00-00 00:00:00', '', 'order_GG23vdRPTE67Ck'),
(100343, 'PM100343', 59, 'ajbhdbd mndbwhdb', '8786354892', '', 'dkcnjkhd@vjn.com', 'hdss skns kss', 'pune', 'Tamil Nadu', 411001, '', 51912, '', 0, 51912, 'initiated', '2020-12-31 13:59:33', '0000-00-00 00:00:00', '', 'order_GJa69YglTfi2lO'),
(100344, 'PM100344', 61, 'Senthilprabhu', '9894181419', '9677037714', 'senthilprabhu.asp@gmail.com', 'No 86, VDS Garden City, \r\n2nd Main Road \r\nSathumadurai \r\nVellore - 632011', 'Vellore', 'Tamil Nadu', 632011, '', 6425, '', 0, 6425, '', '2021-01-02 18:48:07', '0000-00-00 00:00:00', '', 'order_GKS5CvAydLHjKh'),
(100345, 'PM100345', 62, 'Senthilprabhu', '9677037714', '9894181419', 'senthilprabhu.asp@gmail.com', 'No:86, VDS Garden City, \r\n2nd Main road, \r\nSathumadurai', 'Vellore', 'Tamil Nadu', 632011, '', 6425, 'POPPY2021', 964, 5461, '', '2021-01-02 18:56:20', '0000-00-00 00:00:00', '', 'order_GKSDsu9cOC3GUA'),
(100346, '', 62, 'Senthilprabhu', '9677037714', '9894181419', 'senthilprabhu.asp@gmail.com', 'No:86, VDS Garden city \r\n2nd Main Road \r\nSathumadurai', 'Vellore', 'Tamil Nadu', 632011, '', 0, '', 0, 0, 'initiated', '2021-01-02 19:02:08', '0000-00-00 00:00:00', '', ''),
(100347, 'PM100347', 62, 'Senthilprabhu', '9677037714', '9894181419', 'senthilprabhu.asp@gmail.com', 'No: 86, VDS Garden City \r\n2nd Main road \r\nSathumadurai', 'Vellore', 'Tamil Nadu', 632011, '', 6425, 'POPPY2021', 964, 5461, '', '2021-01-02 19:03:56', '0000-00-00 00:00:00', '', 'order_GKSLvAF2nDumFQ'),
(100348, 'PM100348', 62, 'Senthilprabhu', '9677037714', '9894181419', 'senthilprabhu.asp@gmail.com', 'No: 86, VDS Garden City \r\n2nd Main road \r\nSathumadurai', 'Vellore', 'Tamil Nadu', 632011, '', 6425, 'POPPY2021', 964, 5461, 'cancelled', '2021-01-02 19:05:51', '0000-00-00 00:00:00', '', 'order_GKSNwWkjy7bw2t'),
(100349, 'PM100349', 63, 'M THAMOTHARAN', '9442290434', '6379253080', 'mthamut@gmail.com', '1B, second floor, CHIDAMBARA NAGAR 4 th street,Tuticorin', 'Tuticorin', 'Tamil Nadu', 628002, '', 12192, 'POPPY2021', 1829, 10363, '', '2021-01-04 14:03:30', '0000-00-00 00:00:00', '', 'order_GLAInLrwlmfRW5'),
(100350, 'PM100350', 65, 'Varun', '7397450311', '0956600604', 'MLR7559@GMAIL.COM', '7/20,Kandan Kudhil Flat C1,Neithal Street, Fathima nagar, Valsarwakkam,Chennai', 'CHENNAI', 'Tamil Nadu', 600087, '', 6969, 'POPPY2021', 1045, 5924, 'initiated', '2021-01-13 19:02:55', '0000-00-00 00:00:00', '', 'order_GOoDA1b1eNnKoG'),
(100351, 'PM100351', 67, 'Pavithra', '7811036382', '', 'pavithrakanagaraj66@gmail.com', '6/789 bharathi nagar 1st street,\r\nKalingarayanpalayam', 'Erode', 'Tamil Nadu', 638301, '', 23288, 'POPPY2021', 3493, 19795, '', '2021-01-13 21:27:37', '0000-00-00 00:00:00', '', 'order_GOqg0whp7dwRW9'),
(100352, 'PM100352', 68, 'Ravichandran rc', '9750099961', '6385586294', 'rcrr182001@gmail.com', 'Mettuppatti', 'Pudukkottai', 'Tamil Nadu', 622303, '', 9324, '', 0, 9324, '', '2021-01-15 14:38:31', '0000-00-00 00:00:00', '', 'order_GPWm7FNKuhyyYB'),
(100353, 'PM100353', 68, 'Ravichandran rc', '9750099961', '6385586294', 'rcrr182001@gmail.com', 'Mettuppatti', 'Pudukkottai', 'Tamil Nadu', 622303, '', 9324, '', 0, 9324, 'initiated', '2021-01-15 14:41:53', '0000-00-00 00:00:00', '', 'order_GPWpfLrsNMdOjY'),
(100354, 'PM100354', 68, 'Ravichandran rc', '6385586294', '6385586294', 'rcrr182001@gmail.com', 'Mettuppatti', 'Pudukkottai', 'Tamil Nadu', 622303, '', 9324, '', 0, 9324, '', '2021-01-15 14:51:49', '0000-00-00 00:00:00', '', 'order_GPX09U8G7uRxZ1'),
(100355, 'PM100355', 68, 'Ravichandran rc', '6385586294', '', 'rcrr182001@gmail.com', 'Mettuppatti', 'Pudukkottai', 'Tamil Nadu', 622303, '', 9324, '', 0, 9324, '', '2021-01-15 14:53:35', '0000-00-00 00:00:00', '', 'order_GPX2214FfG6X1Z'),
(100356, 'PM100356', 70, 'VENKATARAMANI S', '0944357712', '7010659728', 'ramani523@gmail.com', 'No.10,Fifth Street Extn., \r\nSanjeevi Rayan Pettai,\r\nTindivanam', 'Tindivanam', 'Tamil Nadu', 604001, 'Pl.check properly,before sending.', 15216, 'POPPYSLEEP', 2282, 12934, '', '2021-01-29 15:11:35', '0000-00-00 00:00:00', '', 'order_GV4oj89eyVGbOM'),
(100357, 'PM100357', 71, 'Arockia Doss A', '9884876500', '', 'arockiadoss.a@gmail.com', 'Door 55, Muthamil Nagar, Veerapandi Pirivu, Coimbatore 641019', 'Coimbatore', 'Tamil Nadu', 641019, '', 5508, 'POPPYSLEEP', 826, 4682, '', '2021-01-29 19:28:46', '0000-00-00 00:00:00', '', 'order_GV9COjNdlbF2dK'),
(100358, 'PM100358', 72, 'vadivel', '9791348913', '9797487875', 'asdsds@gmail.com', 'sdfkdj 45\r\nkarur 6396203', 'karur', 'Tamil Nadu', 639003, '', 13410, '', 0, 13410, 'cancelled', '2021-02-03 14:44:05', '0000-00-00 00:00:00', '', 'order_GX31H6noHn9P3i'),
(100359, 'PM100359', 72, 'Vadivel', '9791348913', '9345621551', 'vadivel1522@gmail.com', '15 subdsfu', 'karur', 'Tamil Nadu', 639203, '', 47448, 'POPPYSLEEP', 7117, 40331, 'delivered', '2021-02-04 10:35:40', '0000-00-00 00:00:00', '', 'order_GXNJzGtYeqiwjN'),
(100360, 'PM100360', 72, 'vadivel', '9791348913', '', 'vadivel1522@gmail.com', '109, Golden Nagar,\r\nEsanatham PO\r\nAravakurichi TK', 'KARUR', 'Tamil Nadu', 639209, '', 13410, 'POPPYSLEEP', 2012, 11398, 'dispatch', '2021-02-04 16:34:42', '0000-00-00 00:00:00', '', 'order_GXTREsr8m6emL6'),
(100361, 'PM100361', 18, 'Navaneetha Krishnan', '9566330303', '', 'ramkumar.cbe89@gmail.com', '7C Radius Avenue', 'Miami', 'Tamil Nadu', 331293, '', 15192, '', 0, 15192, 'verification-process', '2021-02-05 00:10:40', '0000-00-00 00:00:00', '', 'order_GXbCtEmasb76a8'),
(100362, 'PM100362', 73, 'dvjbh kjdfbv', '0987678574', '', 'sdvjn@dvjj.com', '23 dvh dvkjdv\r\nsdkdvnvsd', 'Bangaluru', 'Karnataka', 411013, '', 26820, '', 0, 26820, 'initiated', '2021-02-06 19:51:45', '0000-00-00 00:00:00', '', 'order_GYJreguNyMezwW'),
(100363, 'PM100363', 74, 'Vignesh', '9952845757', '', '', '2/536 Bajaji nagar malumichampatti', 'Coimbatore', 'Tamil Nadu', 641050, '', 19710, 'POPPYSLEEP ', 2957, 16753, '', '2021-02-10 18:34:42', '0000-00-00 00:00:00', '', 'order_GZsgjnQumQHRHy'),
(100364, 'PM100364', 76, 'Ufa', '7810896212', '9087523536', 'udaykrishnamoorthy79@gmail.com', '1/487 ESA essaki ammn Kovil street narayanamangalam', 'Tuticorin', 'Tamil Nadu', 628151, '', 20052, '', 0, 20052, '', '2021-02-17 19:19:57', '0000-00-00 00:00:00', '', 'order_GcfCNLE2f3Otxu'),
(100365, 'PM100365', 77, 'Karthick K', '9791283708', '9791283708', 'kkarthick82@gmail.com', 'III/17 Seshsayee Nagar\r\nRaman Nagar\r\nMettur Dam', 'Salem', 'Tamil Nadu', 636403, '', 22815, '', 0, 22815, '', '2021-02-23 14:07:30', '0000-00-00 00:00:00', '', 'order_Gex52pZ2Qn5Q2L'),
(100366, 'PM100366', 77, 'Karthick K', '9791283708', '9791672570', 'kkarthick82@gmail.com', 'III/17 Seshasayee Nagar\r\nRaman Nagar \r\nMettur Dam', 'Salem', 'Tamil Nadu', 636403, '', 22815, 'POPPYSLEEP', 3422, 19393, 'initiated', '2021-02-23 14:09:09', '0000-00-00 00:00:00', '', 'order_Gex6n0RYNUPH7B'),
(100367, 'PM100367', 78, 'Karthick K', '9791672570', '9791283708', 'kkarthick82@gmail.com', 'III/17 Seshasayee Nagar\r\nRaman Nagar\r\nMettur Dam', 'Salem', 'Tamil Nadu', 636403, '', 22815, 'POPPYSLEEP', 3422, 19393, 'dispatch', '2021-02-23 20:00:53', '0000-00-00 00:00:00', '', 'order_Gf36KcKxFqUOkB'),
(100368, 'PM100368', 77, 'Karthick K', '9791283708', '', '', '3/17 shesasai colony Raman nagar\r\nMettur', 'Salem', 'Tamil Nadu', 636403, '', 25623, 'POPPYSLEEP', 3843, 21780, 'initiated', '2021-03-01 19:26:30', '0000-00-00 00:00:00', '', 'order_GhPijLoFpuxdt5'),
(100369, 'PM100369', 83, 'company 1', '0987654321', '0987654321', 'companya@mail.com', 'fghhfg\r\nfghfhfh', 'Amli', 'Tamil Nadu', 789789, '', 36450, '', 0, 36450, '', '2021-03-26 23:09:40', '0000-00-00 00:00:00', '', 'order_GrMsUZSbKev4T5'),
(100370, 'PM100370', 83, 'Apple6 A6', '0987654321', '0987654321', 'Apple6@mail.com', 'fghhfg\r\nfghfhfh', 'Dera Gopipur', 'Tamil Nadu', 789789, '', 77995, '', 0, 77995, '', '2021-03-26 23:14:15', '0000-00-00 00:00:00', '', 'order_GrMxKAPUcLPW9h'),
(100371, 'PM100371', 84, 'Apple4 A4', '0987654321', '0987654321', 'Apple4@mail.com', 'fghhfg\r\nfghfhfh', 'Daulatpur', 'Tamil Nadu', 789789, '', 5095, '', 0, 5095, '', '2021-03-30 15:24:10', '0000-00-00 00:00:00', '', 'order_Gsp5Fu8xW421qO'),
(100372, 'PM100372', 83, 'company 1', '6379441172', '6379441172', 'company@gmail.com', 'fghhfg\r\nfghfhfh', 'Amli', 'Tamil Nadu', 789789, '', 13410, '', 0, 13410, '', '2021-03-30 20:15:09', '0000-00-00 00:00:00', '', 'order_Gsu2cvID17iuTR'),
(100373, '', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2021-04-19 01:53:30', NULL, '', ''),
(100374, '', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, '', 0, '', 0, 0, 'initiated', '2021-04-19 01:54:49', NULL, '', ''),
(100375, 'PM100375', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, '', 20989, '', 0, 20989, 'initiated', '2021-04-19 01:57:42', NULL, '', 'order_H0W1lscngGSjV9'),
(100376, 'PM100376', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'TIrupur', 'Tamil Nadu', 641652, '', 20989, '', 0, 20989, 'initiated', '2021-04-19 02:05:32', NULL, '', 'order_H0WA2JGpRyCVNq'),
(100377, 'PM100377', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupru', 'Tirupur', 'Tamil Nadu', 641652, '', 20989, '', 0, 20989, 'verification-process', '2021-04-19 02:08:50', NULL, '', 'order_H0WDWR4k3dByAJ'),
(100378, 'PM100378', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, '', 20989, '', 0, 20989, 'verification-process', '2021-04-19 02:11:38', NULL, '', 'order_H0WGThv2KfWuyD'),
(100379, 'PM100379', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, '', 20989, '', 0, 20989, 'verification-process', '2021-04-19 02:13:37', NULL, '', 'order_H0WIZeMS5bv8ya'),
(100380, 'PM100380', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'TIrupur', 'Tamil Nadu', 641652, '', 20989, '', 0, 20989, 'cancelled', '2021-04-19 02:16:33', NULL, '', 'order_H0WLgVJiYP2EnQ'),
(100381, 'PM100381', 18, 'Navaneetha Krishnan', '9566330303', '', 'techaveo@gmail.com', 'Tirupur', 'Tirupur', 'Tamil Nadu', 641652, '', 20989, '', 0, 20989, 'process', '2021-04-19 02:45:23', NULL, '', 'order_H0Wq8uKSCYMN9X'),
(100382, 'PM100382', 8, 'vadivel', '0979134891', '', 'vadivel1522@gmail.com', 'Esanatham', 'KARUR', 'Tamil Nadu', 639003, '', 20989, 'cuddle25', 5247, 15742, 'initiated', '2021-04-19 09:46:05', NULL, '', 'order_H0e0XDJ3zO2NNy'),
(100383, 'PM100383', 8, 'Vadivel Thangavel', '9791348913', '', 'vadivel1522@gmail.com', 'esanatham', 'KARUR', 'Tamil Nadu', 639003, '', 20989, 'cuddle25', 5247, 15742, 'initiated', '2021-04-19 09:48:35', NULL, '', 'order_H0e3ALSYLzIusM'),
(100384, 'PM100384', 15, 'RAJKUMAR', '9843211441', '', 'IMRAJ1798@GMAIL.COM', 'B 1 AMASAVENI APT', 'Karur', 'Tamil Nadu', 639001, '', 61989, 'CUDDLE25', 15497, 46492, 'initiated', '2021-04-19 10:08:22', NULL, '', 'order_H0eO4g2GXU3rsr'),
(100385, 'PM100385', 72, 'VADIVEL', '9791348913', '', '1221@gmail.com', 'karur', 'karur', 'Tamil Nadu', 639003, '', 95978, 'cuddle25', 23995, 71983, 'initiated', '2021-04-19 11:39:13', NULL, '', 'order_H0fw2KR3bmDjp6'),
(100386, 'PM100386', 0, 'gffjnyjy', '9047044737', '9047044737', 'wyhwuw@gmail.com', 'fhwrw\r\nshwe\r\nshwethh', 'Karur', 'Tamil Nadu', 639001, '', 61989, 'CUDDLE25 ', 15497, 46492, 'initiated', '2021-04-20 11:32:03', NULL, '', 'order_H14LbJpZRO4Afl'),
(100387, 'PM100387', 0, 'Test', '6388387654', '8765438976', 'Test@poppymattress.com', 'Karur ,india', 'Karur', 'Tamil Nadu', 639005, '', 25989, '', 0, 25989, 'initiated', '2021-04-20 11:35:20', NULL, '', 'order_H14P3sKGX4E3Qq'),
(100388, 'PM100388', 8, 'Raj', '0984321144', '', 'info@poppyindia.com', '283/1B, Sukkamapptti karur', 'Karur', 'Tamil Nadu', 639003, '', 20989, '', 0, 20989, 'initiated', '2021-04-23 10:21:33', NULL, '', 'order_H2EkU4EDETzHpw');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cover_image` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_height` int(11) NOT NULL,
  `product_type` enum('normal','custom','free') NOT NULL DEFAULT 'normal',
  `custom_length` int(11) NOT NULL,
  `custom_width` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `order_id`, `product_id`, `cover_image`, `category`, `product_name`, `product_size`, `product_height`, `product_type`, `custom_length`, `custom_width`, `price`, `qty`, `amount`) VALUES
(5, 100209, 9, 'pu-foam-series/soffty/1.png', 'PU Foam Series', 'Soffty', 'Twin - 72 x 30 in | 1829 x 762 mm', 0, '', 0, 0, 4425, 3, 13275),
(6, 100209, 2, 'grand-series/exuber/exuber-pt/1.png', 'Grand Series / Excuber', 'Exuber PT', 'Twin - 75 x 30 in | 1905 x 762 mm', 0, '', 0, 0, 11940, 2, 23880),
(7, 100210, 1, 'grand-series/exuber/exuber/3.png', 'Grand Series / Excuber', 'Exuber', 'Twin - 72 x 30 in | 1829 x 762 mm', 0, '', 0, 0, 10545, 3, 31635),
(8, 100211, 2, 'grand-series/exuber/exuber-pt/1.png', 'Grand Series / Excuber', 'Exuber PT', 'Twin - 72 x 30 in | 1829 x 762 mm', 0, '', 0, 0, 11940, 2, 23880),
(9, 100213, 1, 'grand-series/exuber/exuber/3.png', 'Grand Series / Excuber', 'Exuber', 'Custom Size : 70 in X 72 in', 6, 'custom', 70, 72, 24605, 2, 49210),
(10, 100213, 1, 'grand-series/exuber/exuber/3.png', 'Grand Series / Excuber', 'Exuber', 'Twin - 72 x 30 in | 1829 x 762 mm  X 6', 6, 'normal', 70, 72, 10545, 3, 31635),
(12, 100215, 3, 'grand-series/grand/grandeur/1.png', 'Grand Series / Grand', 'Grandeur', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20400, 1, 20400),
(13, 100215, 18, 'micro-fiber-pillow.jpg', 'Pillow', 'Micro Fiber Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(14, 100215, 22, 'bedspread.jpg', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(15, 100215, 21, 'protector.jpg', 'Accessories', 'Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(16, 100216, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Double - 75 x 42 in | 1905 x 1067 mm  X 6', 6, 'normal', 0, 0, 15382, 1, 15382),
(17, 100216, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(18, 100216, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(19, 100217, 12, 'premium-series/selene/tight-top/1.png', 'Premium Series / Selene', 'Selene TT', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 8622, 1, 8622),
(20, 100217, 17, 'polyster-fibre-pillow.png', 'Pillow', 'Polyester Fiber Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(21, 100217, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(22, 100218, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(23, 100218, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(24, 100218, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(25, 100220, 4, 'grand-series/grand/grand-master/1.png', 'Grand Series / Grand', 'Grand Master', 'King - 78 x 72 in | 1981 x 1829 mm  X ', 0, 'normal', 0, 0, 93132, 1, 93132),
(26, 100220, 18, 'micro-fiber-pillow.png', 'Pillow', 'Micro Fiber Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(27, 100220, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(28, 100220, 21, 'protector.png', 'Accessories', 'Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(29, 100286, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(30, 100286, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(31, 100286, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(32, 100287, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(33, 100287, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(34, 100287, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(35, 100288, 12, 'premium-series/selene/tight-top/1.png', 'Premium Series / Selene', 'Selene TT', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 8622, 1, 8622),
(36, 100288, 17, 'polyster-fibre-pillow.png', 'Pillow', 'Polyester Fiber Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(37, 100288, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(38, 100289, 9, 'pu-foam-series/soffty/1.png', 'PU Foam Series', 'Soffty', 'Single - 72 x 36 in | 1829 x 915 mm  X 4', 4, 'normal', 0, 0, 5310, 1, 5310),
(39, 100290, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(40, 100290, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(41, 100290, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(42, 100291, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(43, 100291, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(44, 100291, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(45, 100292, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(46, 100292, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(47, 100292, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(48, 100293, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(49, 100293, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(50, 100293, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(51, 100294, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(52, 100294, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(53, 100294, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(54, 100295, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(55, 100295, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(56, 100295, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(57, 100296, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(58, 100296, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(59, 100296, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(60, 100283, 9, 'pu-foam-series/soffty/1.png', 'PU Foam Series', 'Soffty', 'Queen - 75 x 60 in | 1905 x 1524 mm  X 4', 4, 'normal', 0, 0, 9219, 1, 9219),
(61, 100298, 9, 'pu-foam-series/soffty/1.png', 'PU Foam Series', 'Soffty', 'Single - 72 x 36 in | 1829 x 915 mm  X 4', 4, 'normal', 0, 0, 5310, 1, 5310),
(62, 100299, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(63, 100299, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(64, 100299, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(65, 100300, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(66, 100300, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(67, 100300, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(68, 100301, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 12654, 1, 12654),
(69, 100301, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(70, 100301, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(71, 100302, 16, 'medico-series/the-guardianz/1.png', 'Medico Series', 'The Guardianz - Bonnel Spring with Memory Foam', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 18882, 1, 18882),
(72, 100302, 23, 'neck-defender.png', 'Accessories', 'Neck Defender', '', 0, 'free', 0, 0, 0, 2, 0),
(73, 100302, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(74, 100303, 7, 'rubberized-coir-series/saffron-plus/1.png', 'Rubberized Coir Series', 'Saffron Plus', 'King - 75 x 72 in | 1905 x 1829 mm  X 5', 5, 'normal', 0, 0, 15863, 1, 15863),
(75, 100303, 17, 'polyster-fibre-pillow.png', 'Pillow', 'Polyester Fiber Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(76, 100303, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(77, 100304, 10, 'pu-foam-series/soffty-plus/1.png', 'PU Foam Series', 'Soffty Plus', 'Queen - 72 x 60 in | 1829 x 1524 mm  X 6', 6, 'normal', 0, 0, 16350, 1, 16350),
(78, 100305, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(79, 100305, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(80, 100305, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(81, 100306, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(82, 100306, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(83, 100306, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(84, 100307, 15, 'premium-series/luxe/euro-top/1.png', 'Premium Series / Luxe', 'Luxe ET', 'Queen - 72 x 66 in | 1829 x 1676 mm  X 10', 10, 'normal', 0, 0, 40095, 1, 40095),
(85, 100307, 17, 'polyster-fibre-pillow.png', 'Pillow', 'Polyester Fiber Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(86, 100307, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(87, 100308, 10, 'pu-foam-series/soffty-plus/1.png', 'PU Foam Series', 'Soffty Plus', 'Single - 72 x 36 in | 1829 x 915 mm  X 5', 5, 'normal', 0, 0, 9324, 1, 9324),
(88, 100309, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(89, 100309, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(90, 100309, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(91, 100310, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(92, 100310, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(93, 100310, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(94, 100311, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(95, 100311, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(96, 100311, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(97, 100312, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(98, 100312, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(99, 100312, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(100, 100313, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(101, 100313, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(102, 100313, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(103, 100314, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(104, 100314, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(105, 100314, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(106, 100315, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(107, 100315, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(108, 100315, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(109, 100316, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(110, 100316, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(111, 100316, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(112, 100317, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(113, 100317, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(114, 100317, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(115, 100318, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(116, 100318, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(117, 100318, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(118, 100319, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(119, 100319, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(120, 100319, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(121, 100320, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(122, 100320, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(123, 100320, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(124, 100321, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'King - 72 x 72 in | 1829 x 1829 mm  X 6', 6, 'normal', 0, 0, 26820, 1, 26820),
(125, 100321, 24, 'pu-foam-pillows.png', 'Pillow', 'PU foam pillows', '', 0, 'free', 0, 0, 0, 2, 0),
(126, 100321, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(127, 100322, 12, 'premium-series/selene/tight-top/1.png', 'Premium Series / Selene', 'Selene TT', 'King - 75 x 72 in | 1905 x 1829 mm  X 6', 6, 'normal', 0, 0, 19050, 1, 19050),
(128, 100322, 17, 'polyster-fibre-pillow.png', 'Pillow', 'Polyester Fiber Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(129, 100322, 22, 'bedspread.png', 'Accessories', 'Bedspreads', '', 0, 'free', 0, 0, 0, 1, 0),
(130, 100323, 9, 'pu-foam-series/soffty/1.png', 'PU Foam Series', 'Soffty', 'King - 72 x 72 in | 1829 x 1829 mm  X 5', 5, 'normal', 0, 0, 15156, 1, 15156),
(131, 100324, 9, 'pu-foam-series/soffty/1.png', 'PU Foam Series', 'Soffty', 'King - 72 x 72 in | 1829 x 1829 mm  X 5', 5, 'normal', 0, 0, 15156, 1, 15156),
(132, 100325, 9, 'pu-foam-series/soffty/1.png', 'PU Foam Series', 'Soffty', 'King - 72 x 72 in | 1829 x 1829 mm  X 5', 5, 'normal', 0, 0, 15156, 1, 15156),
(133, 100326, 13, 'premium-series/selene/pillow-top/1.png', 'Premium Series / Selene', 'Selene PT', 'King - 78 x 72 in | 1981 x 1829 mm  X 6', 6, 'normal', 0, 0, 22815, 1, 22815),
(134, 100326, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(135, 100326, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(136, 100327, 15, 'premium-series/luxe/euro-top/1.png', 'Premium Series / Luxe', 'Luxe ET', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 14778, 2, 29556),
(137, 100327, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 4, 0),
(138, 100327, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 2, 0),
(139, 100328, 15, 'premium-series/luxe/euro-top/1.png', 'Premium Series / Luxe', 'Luxe ET', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 18504, 2, 37008),
(140, 100328, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 4, 0),
(141, 100328, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 2, 0),
(142, 100329, 15, 'premium-series/luxe/euro-top/1.png', 'Premium Series / Luxe', 'Luxe ET', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 18504, 2, 37008),
(143, 100329, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 4, 0),
(144, 100329, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 2, 0),
(145, 100330, 5, 'rubberized-coir-series/desire/1.png', 'Rubberized Coir Series', 'Desire', 'Double - 72 x 48 in | 1829 x 1219 mm  X 4', 4, 'normal', 0, 0, 6828, 1, 6828),
(146, 100330, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(147, 100331, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(148, 100331, 18, 'micro-fiber-pillow.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(149, 100331, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(150, 100332, 12, 'premium-series/selene/tight-top/1.png', 'Premium Series / Selene', 'Selene TT', 'Double - 75 x 48 in | 1905 x 1219 mm  X 6', 6, 'normal', 0, 0, 12700, 1, 12700),
(151, 100332, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(152, 100332, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(153, 100333, 13, 'premium-series/selene/pillow-top/1.png', 'Premium Series / Selene', 'Selene PT', 'Double - 72 x 48 in | 1829 x 1219 mm  X 6', 6, 'normal', 0, 0, 14040, 1, 14040),
(154, 100333, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(155, 100333, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(156, 100334, 13, 'premium-series/selene/pillow-top/1.png', 'Premium Series / Selene', 'Selene PT', 'Double - 72 x 48 in | 1829 x 1219 mm  X 6', 6, 'normal', 0, 0, 14040, 1, 14040),
(157, 100334, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(158, 100334, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(159, 100335, 4, 'grand-series/grand/grand-master/1.png', 'Grand Series / Grand', 'Grand Master', 'King - 78 x 72 in | 1981 x 1829 mm  X 12', 12, 'normal', 0, 0, 98709, 1, 98709),
(160, 100335, 23, 'neck-defender.png', 'Accessories', 'Neck Defender', '', 0, 'free', 0, 0, 0, 2, 0),
(161, 100335, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(162, 100335, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(163, 100336, 12, 'premium-series/selene/tight-top/1.png', 'Premium Series / Selene', 'Selene TT', 'Double - 75 x 48 in | 1905 x 1219 mm  X 6', 6, 'normal', 0, 0, 12700, 1, 12700),
(164, 100336, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(165, 100336, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(166, 100337, 6, 'rubberized-coir-series/saffron/1.png', 'Rubberized Coir Series', 'Saffron', 'Queen - 78 x 60 in | 1981 x 1524 mm  X 5', 5, 'normal', 0, 0, 12415, 1, 12415),
(167, 100337, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(168, 100338, 6, 'rubberized-coir-series/saffron/1.png', 'Rubberized Coir Series', 'Saffron', 'Queen - 78 x 60 in | 1981 x 1524 mm  X 5', 5, 'normal', 0, 0, 12415, 1, 12415),
(169, 100338, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(170, 100339, 8, 'rubberized-coir-series/saffron-dlx/1.png', 'Rubberized Coir Series', 'Saffron DLX', 'King - 78 x 72 in | 1981 x 1829 mm  X 5', 5, 'normal', 0, 0, 19422, 1, 19422),
(171, 100339, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(172, 100339, 18, 'micro-fiber-pillow.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(173, 100340, 8, 'rubberized-coir-series/saffron-dlx/1.png', 'Rubberized Coir Series', 'Saffron DLX', 'King - 78 x 72 in | 1981 x 1829 mm  X 5', 5, 'normal', 0, 0, 19422, 1, 19422),
(174, 100340, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(175, 100340, 18, 'micro-fiber-pillow.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(176, 100341, 6, 'rubberized-coir-series/saffron/1.png', 'Rubberized Coir Series', 'Saffron', 'Queen - 75 x 60 in | 1905 x 1524 mm  X 4', 4, 'normal', 0, 0, 9563, 1, 9563),
(177, 100341, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(178, 100342, 6, 'rubberized-coir-series/saffron/1.png', 'Rubberized Coir Series', 'Saffron', 'Queen - 75 x 60 in | 1905 x 1524 mm  X 4', 4, 'normal', 0, 0, 9563, 1, 9563),
(179, 100342, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(180, 100343, 3, 'grand-series/grand/grandeur/1.png', 'Grand Series / Grand', 'Grandeur', 'King - 72 x 72 in | 1829 x 1829 mm  X 8', 8, 'normal', 0, 0, 51912, 1, 51912),
(181, 100343, 18, 'micro-fiber-pillow.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(182, 100343, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(183, 100343, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(184, 100344, 5, 'rubberized-coir-series/desire/1.png', 'Rubberized Coir Series', 'Desire', 'Double - 75 x 44 in | 1905 x 1118 mm  X 4', 4, 'normal', 0, 0, 6425, 1, 6425),
(185, 100344, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(186, 100345, 5, 'rubberized-coir-series/desire/1.png', 'Rubberized Coir Series', 'Desire', 'Double - 75 x 44 in | 1905 x 1118 mm  X 4', 4, 'normal', 0, 0, 6425, 1, 6425),
(187, 100345, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(188, 100347, 5, 'rubberized-coir-series/desire/1.png', 'Rubberized Coir Series', 'Desire', 'Double - 75 x 44 in | 1905 x 1118 mm  X 4', 4, 'normal', 0, 0, 6425, 1, 6425),
(189, 100347, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(190, 100348, 5, 'rubberized-coir-series/desire/1.png', 'Rubberized Coir Series', 'Desire', 'Double - 75 x 44 in | 1905 x 1118 mm  X 4', 4, 'normal', 0, 0, 6425, 1, 6425),
(191, 100348, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(192, 100349, 12, 'premium-series/selene/tight-top/1.png', 'Premium Series / Selene', 'Selene TT', 'Double - 72 x 48 in | 1829 x 1219 mm  X 6', 6, 'normal', 0, 0, 12192, 1, 12192),
(193, 100349, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(194, 100349, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(195, 100350, 5, 'rubberized-coir-series/desire/1.png', 'Rubberized Coir Series', 'Desire', 'Double - 75 x 48 in | 1905 x 1219 mm  X 4', 4, 'normal', 0, 0, 6969, 1, 6969),
(196, 100350, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(197, 100351, 10, 'pu-foam-series/soffty-plus/1.png', 'PU Foam Series', 'Soffty Plus', 'King - 75 x 72 in | 1905 x 1829 mm  X 6', 6, 'normal', 0, 0, 23288, 1, 23288),
(198, 100351, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(199, 100352, 10, 'pu-foam-series/soffty-plus/1.png', 'PU Foam Series', 'Soffty Plus', 'Double - 72 x 48 in | 1829 x 1219 mm  X 5', 5, 'normal', 0, 0, 9324, 1, 9324),
(200, 100352, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(201, 100353, 10, 'pu-foam-series/soffty-plus/1.png', 'PU Foam Series', 'Soffty Plus', 'Double - 72 x 48 in | 1829 x 1219 mm  X 5', 5, 'normal', 0, 0, 9324, 1, 9324),
(202, 100353, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(203, 100354, 10, 'pu-foam-series/soffty-plus/1.png', 'PU Foam Series', 'Soffty Plus', 'Single - 72 x 36 in | 1829 x 915 mm  X 5', 5, 'normal', 0, 0, 9324, 1, 9324),
(204, 100354, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(205, 100355, 10, 'pu-foam-series/soffty-plus/1.png', 'PU Foam Series', 'Soffty Plus', 'Single - 72 x 36 in | 1829 x 915 mm  X 5', 5, 'normal', 0, 0, 9324, 1, 9324),
(206, 100355, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(207, 100356, 14, 'premium-series/luxe/tight-top/1.png', 'Premium Series / Luxe', 'Luxe TT', 'Double - 72 x 48 in | 1829 x 1219 mm  X 6', 6, 'normal', 0, 0, 15216, 1, 15216),
(208, 100356, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(209, 100356, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(210, 100357, 6, 'rubberized-coir-series/saffron/1.png', 'Rubberized Coir Series', 'Saffron', 'Single - 72 x 36 in | 1829 x 915 mm  X 4', 4, 'normal', 0, 0, 5508, 1, 5508),
(211, 100357, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(212, 100358, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(213, 100358, 18, 'micro-fiber-pillow.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(214, 100358, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(215, 100359, 12, 'premium-series/selene/tight-top/1.png', 'Premium Series / Selene', 'Selene TT', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 9144, 3, 27432),
(216, 100359, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 6, 0),
(217, 100359, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 3, 0),
(218, 100359, 16, 'medico-series/the-guardianz/1.png', 'Medico Series', 'The Guardianz - Bonnel Spring with Memory Foam', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 20016, 1, 20016),
(219, 100359, 23, 'neck-defender.png', 'Accessories', 'Neck Defender', '', 0, 'free', 0, 0, 0, 2, 0),
(220, 100359, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(221, 100360, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(222, 100360, 18, 'micro-fiber-pillow.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(223, 100360, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(224, 100361, 2, 'grand-series/exuber/exuber-pt/1.png', 'Grand Series / Excuber', 'Exuber PT & ET', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 15192, 1, 15192),
(225, 100361, 18, 'micro-fiber-pillow.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(226, 100361, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(227, 100362, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 2, 26820),
(228, 100362, 18, 'micro-fiber-pillow.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 4, 0),
(229, 100362, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 2, 0),
(230, 100363, 13, 'premium-series/selene/pillow-top/1.png', 'Premium Series / Selene', 'Selene PT', 'Queen - 72 x 60 in | 1829 x 1524 mm  X 8', 8, 'normal', 0, 0, 19710, 1, 19710),
(231, 100363, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(232, 100363, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(233, 100364, 2, 'grand-series/exuber/exuber-pt/1.png', 'Grand Series / Excuber', 'Exuber PT & ET', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20052, 1, 20052),
(234, 100364, 18, 'micro-fiber-pillow.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(235, 100364, 21, 'protector.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(236, 100365, 13, 'premium-series/selene/pillow-top/1.png', 'Premium Series / Selene', 'Selene PT', 'King - 78 x 72 in | 1981 x 1829 mm  X 6', 6, 'normal', 0, 0, 22815, 1, 22815),
(237, 100365, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(238, 100365, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(239, 100366, 13, 'premium-series/selene/pillow-top/1.png', 'Premium Series / Selene', 'Selene PT', 'King - 78 x 72 in | 1981 x 1829 mm  X 6', 6, 'normal', 0, 0, 22815, 1, 22815),
(240, 100366, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(241, 100366, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(242, 100367, 13, 'premium-series/selene/pillow-top/1.png', 'Premium Series / Selene', 'Selene PT', 'King - 78 x 72 in | 1981 x 1829 mm  X 6', 6, 'normal', 0, 0, 22815, 1, 22815),
(243, 100367, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(244, 100367, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(245, 100368, 13, 'premium-series/selene/pillow-top/1.png', 'Premium Series / Selene', 'Selene PT', 'King - 78 x 72 in | 1981 x 1829 mm  X 8', 8, 'normal', 0, 0, 25623, 1, 25623),
(246, 100368, 17, 'polyster-fibre-pillow.png', 'Pillow', '17X27 - Sleepy pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(247, 100368, 22, 'bedspread.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(248, 100369, 4, 'grand-series/grand/grand-master/1.png', 'Grand Series / Grand', 'Grand Master', 'Single - 72 x 36 in | 1829 x 915 mm  X 10', 10, 'normal', 0, 0, 36450, 1, 36450),
(249, 100369, 23, 'neck_defender_img.png', 'Accessories', 'Neck Defender', '', 0, 'free', 0, 0, 0, 2, 0),
(250, 100369, 22, 'beds_img.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 1, 0),
(251, 100369, 21, 'prod_img.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(252, 100370, 4, 'grand-series/grand/grand-master/1.png', 'Grand Series / Grand', 'Grand Master', 'Single - 72 x 36 in | 1829 x 915 mm  X 10', 10, 'normal', 0, 0, 36450, 2, 72900),
(253, 100370, 23, 'neck_defender_img.png', 'Accessories', 'Neck Defender', '', 0, 'free', 0, 0, 0, 4, 0),
(254, 100370, 22, 'beds_img.png', 'Accessories', 'Alicia bedspread', '', 0, 'free', 0, 0, 0, 2, 0),
(255, 100370, 21, 'prod_img.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 2, 0),
(256, 100370, 5, 'rubberized-coir-series/desire/1.png', 'Rubberized Coir Series', 'Desire', 'Single - 72 x 36 in | 1829 x 915 mm  X 4', 4, 'normal', 0, 0, 5095, 1, 5095),
(257, 100370, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(258, 100371, 5, 'rubberized-coir-series/desire/1.png', 'Rubberized Coir Series', 'Desire', 'Single - 72 x 36 in | 1829 x 915 mm  X 4', 4, 'normal', 0, 0, 5095, 1, 5095),
(259, 100371, 28, 'polyster-fibre-pillow.png', 'Pillow', '16X24- Sleepy pillow', '', 0, 'free', 0, 0, 0, 1, 0),
(260, 100372, 1, 'grand-series/exuber/exuber/1.png', 'Grand Series / Excuber', 'Exuber', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 13410, 1, 13410),
(261, 100372, 18, 'micro-fiber.png', 'Pillow', ' Snoozy Pillow', '', 0, 'free', 0, 0, 0, 2, 0),
(262, 100372, 21, 'prod_img.png', 'Accessories', 'Malevals Protector', '', 0, 'free', 0, 0, 0, 1, 0),
(263, 100375, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(264, 100376, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(265, 100377, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(266, 100377, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(267, 100378, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(268, 100378, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(269, 100379, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(270, 100379, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(271, 100380, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(272, 100380, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(273, 100381, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(274, 100381, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(275, 100382, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(276, 100383, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989),
(277, 100384, 30, 'cuddle-buddy/latex/1.jpg', 'Cuddle Buddy', 'Organic Latex', 'King - 75 x 72 in | 1905 x 1829 mm  X 6', 6, 'normal', 0, 0, 61989, 1, 61989),
(278, 100385, 30, 'cuddle-buddy/latex/1.jpg', 'Cuddle Buddy', 'Organic Latex', 'King - 72 x 72 in | 1829 x 1829 mm  X 6', 6, 'normal', 0, 0, 61989, 1, 61989),
(279, 100385, 30, 'cuddle-buddy/latex/1.jpg', 'Cuddle Buddy', 'Organic Latex', 'Single - 72 x 36 in | 1829 x 915 mm  X 6', 6, 'normal', 0, 0, 33989, 1, 33989),
(280, 100386, 30, 'cuddle-buddy/latex/1.jpg', 'Cuddle Buddy', 'Organic Latex', 'King - 75 x 72 in | 1905 x 1829 mm  X 6', 6, 'normal', 0, 0, 61989, 1, 61989),
(281, 100387, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Double - 72 x 48 in | 1829 x 1219 mm  X 8', 8, 'normal', 0, 0, 25989, 1, 25989),
(282, 100388, 29, 'cuddle-buddy/hybrid/1.jpg', 'Cuddle Buddy', 'Organic Luxury Hybrid', 'Single - 72 x 36 in | 1829 x 915 mm  X 8', 8, 'normal', 0, 0, 20989, 1, 20989);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `html_code` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `html_code`, `sort_order`) VALUES
(1, 'Home', '<title>Beds, Mattress and Pillows with premium quality | Poppy</title>\r\n  <meta name=\"description\" content=\"Buy the premium quality beds from the house of poppy mattress. The best online store to purchase the premium quality mattress and pillows | Poppy\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com\">\r\n<meta property=\"og:title\" content=\"Buy Spring, Coir, PU Foam and Latex mattress online | Poppy\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/\">\r\n<meta property=\"og:description\" content=\"Poppy India | The best online store for buy spring, rubberized coir, PU Foam and natural latex mattress with memory foam online\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/demo/images/main-slider/9965_a.jpg\">', 1),
(2, 'FAQ', '<title>FAQ : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 8),
(3, 'Warrenty', '<title>Warrenty : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 9),
(4, 'About us', '<title>About Us : Buy Mattress Online | Poppy India</title>\r\n<meta name=\"description\" content=\"Buy the premium quality mattress, pillows and bedding accessories online. POPPY | The best place for buy mattress online.\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/aboutus.php\">\r\n<meta property=\"og:title\" content=\"About Us | Poppy\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/aboutus.php\">\r\n<meta property=\"og:description\" content=\"Poppy India | The best online store for buy spring, rubberized coir, PU Foam and natural latex mattress with memory foam online\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/grand-series/exuber/exuber-pt/1.png\">', 2),
(5, 'Cart', '<title>Cart : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 14),
(6, 'Checkout', '<title>Checkout : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 15),
(7, 'Forgot Password', '<title>Forgot Password : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 16),
(8, 'Login', '<title>Login : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 12),
(9, 'Signup', '<title>Signup : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 13),
(10, 'Tracking', '<title>Tracking : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 17),
(11, 'Terms & Conditions', '<title>Terms & Conditions : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 10),
(12, 'Return Policy', '<title>Return Policy : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 11),
(13, 'Grand Series', '<title>Grand Series : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 3),
(14, 'Premium Series', '<title>Premium Series : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 4),
(15, 'Medico Series', '<title>Medico Series : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 5),
(16, 'PU Foam Series', '<title>PU Foam Series : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 6),
(17, 'Rubberized Coir Series', '<title>Rubberized Coir Series : Buy Mattress Online - India&#039;s Best Mattress Brand</title>', 7);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `url_slug` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `html_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category`, `product_name`, `product_price`, `mrp_price`, `sort_order`, `cover_image`, `url_slug`, `short_description`, `meta_title`, `meta_keywords`, `meta_description`, `html_code`) VALUES
(1, 6, 'Exuber', 13410, 0, 1, 'grand-series/exuber/exuber/1.png', 'grand-series-exuber-tight-top-spring-mattress', 'A luxury pocketed spring mattress that can make you feel relaxed and best suitable for the late-night binge-watching and card games. ', '', '', '', '<title>Buy Grand series exuber tight top spring mattress online</title>\r\n<meta name=\"description\" content=\"The poppy grand series exuber mattress constructed by pocketed spring, PU super soft layer, quilt with super soft foam and mélange knitted fabric | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/grand-series-exuber-tight-top-spring-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - The Grand Series - Exuber\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/grand-series-exuber-tight-top-spring-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/grand-series/exuber/exuber/1.png\">'),
(2, 6, 'Exuber PT & ET', 15192, 0, 2, 'grand-series/exuber/exuber-pt/1.png', 'gs-exuber-pillow-top-spring-mattress', 'A luxury pocketed spring mattress that can make you feel relaxed and best suitable for the late-night binge-watching and card games. ', 'Grand Series Excuber Exuber PT & ET : Buy Mattress Online - India\'s Best Mattress Brand', '', '', '<title>Buy Grand series exuber pillow top spring mattress online</title>\r\n<meta name=\"description\" content=\"The grand series exuber pillow top mattress consist of pocketed spring, PU super soft layer, quilt with 30 mm super soft foam | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/gs-exuber-pillow-top-spring-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - The Grand Series - Exuber - Pillow Top\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/gs-exuber-pillow-top-spring-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/grand-series/exuber/exuber-pt/1.png\">'),
(3, 7, 'Grandeur', 25956, 0, 2, 'grand-series/grand/grandeur/1.png', 'grandeur-pocketed-spring-with-natural-latex-mattress', 'The grand series comes with the combination of pocketed spring mattresses with latex. The weight is equally distributed across the surface and hence promotes restful nights.', '', '', '', '<title>Buy Grandeur latex spring mattress online</title>\r\n<meta name=\"description\" content=\"The grand series grandeur mattress with natural latex made of pocketed spring, PU super soft layer, quilt with 30 mm super soft foam | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/grandeur-pocketed-spring-with-natural-latex-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - The Grand Series - Grandeur\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/grandeur-pocketed-spring-with-natural-latex-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/grand-series/grand/grandeur/1.png\">'),
(4, 7, 'Grand Master', 36450, 0, 1, 'grand-series/grand/grand-master/1.png', 'grand-series-grand-master-latex-mattress', 'You will fall in love with the three secret ingredients of your sleep. The grandmaster series is featured with pocketed spring, latex, and memory foam', '', '', '', '<title>Buy Grand master spring mattress with natural latex online</title>\r\n<meta name=\"description\" content=\"The grand series grand master mattress with natural latex made of pocketed spring, two PU super soft layer, quilt with memory foam | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/grand-series-grand-master-latex-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - The Grand Series - Grand Master\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/grand-series-grand-master-latex-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/grand-series/grand/grand-master/1.png\">'),
(5, 2, 'Desire', 5095, 0, 1, 'rubberized-coir-series/desire/1.png', 'rubberized-coir-series-desire-mattress', 'With the smooth twill weaving fabric, get the best PU foam, and enjoy the house parties and some quality time', '', '', '', '<title>Buy Rubberized Coir Series Desire mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The Eco friendly rubberized coir series desire mattress with high density coir, super soft PU Foam quilting and tight top stiching | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/rubberized-coir-series-desire-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Rubberized Coir Series - Desire\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/rubberized-coir-series-desire-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/rubberized-coir-series/desire/1.png\">'),
(6, 2, 'Saffron', 5508, 0, 2, 'rubberized-coir-series/saffron/1.png', 'rubberized-coir-series-saffron', 'Looking for durable mattresses? Purchase Saffron from the rubberized coir series that has a surface of Woven Jacquard fabric ', '', '', '', '<title>Buy Rubberized Coir Series Saffron mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The Eco friendly rubberized coir series saffron mattress with high density coir, satin weaving viscose fabric, super soft PU Foam quilting and tight top | Poppy\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/rubberized-coir-series-saffron\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Rubberized Coir Series - Saffron\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/rubberized-coir-series-saffron\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/rubberized-coir-series/saffron/1.png\">'),
(7, 2, 'Saffron Plus', 6354, 0, 3, 'rubberized-coir-series/saffron-plus/1.png', 'rubberized-coir-series-saffron-plus-mattress', 'What do you love about the bed? Firm support, flexibility, and extreme comfort, right? Then here is what you need to check out about the Saffron Plus knitted with Satin viscose fabric', '', '', '', '<title>Buy Eco Friendly Coir Series Saffron Plus mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The Eco friendly rubberized coir series saffron plus mattress with high density coir, woven jacquard fabric, super soft PU Foam quilting and tight top | Poppy\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/rubberized-coir-series-saffron-plus-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Rubberized Coir Series - Saffron Plus\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/rubberized-coir-series-saffron-plus-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/rubberized-coir-series/saffron/1.png\">'),
(8, 2, 'Saffron DLX', 7164, 0, 4, 'rubberized-coir-series/saffron-dlx/1.png', 'rubberized-coir-series-saffron-dlx', 'Have kids to jump on the bed? Pillow fights every day at the house? Get the Saffron DLX, which is spaciously supported by PU foam padding and knitted fabric', '', '', '', '<title>Buy Rubberized Coir Saffron Dlx mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The Eco friendly rubberized coir series saffron Dlx mattress with high density coir, knitted fabric, super soft &amp; bonded foam layer and euro top stiching | Poppy\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/rubberized-coir-series-saffron-dlx\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Rubberized Coir Series - Saffron Dlx\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/rubberized-coir-series-saffron-dlx\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/rubberized-coir-series/saffron-dlx/1.png\">'),
(9, 3, 'Soffty', 6048, 0, 1, 'pu-foam-series/soffty/1.png', 'pu-foam-series-soffty', 'You will find the best place to stay on earth. Satisfied feeling soft, elegant, and comfortable mattresses', '', '', '', '<title>Buy PU Foam series soffty mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The PU Foam series soffty mattress with high density PU Foam layer, Treated knitted fabric, Finest Quilting and tight top stiching | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/pu-foam-series-soffty\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - PU Foam Series - Soffty\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/pu-foam-series-soffty\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/pu-foam-series/soffty/1.png\">'),
(10, 3, 'Soffty Plus', 9324, 0, 2, 'pu-foam-series/soffty-plus/1.png', 'pu-foam-series-soffty-plus-mattress', 'A breathable memory foam toppers with the best quality fabric. A smart way to upgrade your sleep in the most comfortable level', '', '', '', '<title>Buy PU Foam series soffty Plus mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The PU Foam series soffty plus mattress with high density PU Foam layer, Treated knitted fabric, Finest Quilting and tight top stiching | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/pu-foam-series-soffty-plus-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - PU Foam Series - Soffty Plus\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/pu-foam-series-soffty-plus-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/pu-foam-series/soffty-plus/1.png\">'),
(11, 3, 'Soffty DLX', 20538, 0, 3, 'pu-foam-series/soffty-dlx/1.png', 'pu-foam-series-soffty-dlx-mattress', 'Feel cozy with the Soffty mattresses in the foam series. We are bringing the unique version of foam with the right ingredients', '', '', '', '<title>Buy PU Foam series soffty DLX mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The PU Foam series soffty DLX mattress with high density PU Foam layer, melange knitted fabric, Artistic Quilt design with cool memory foam | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/pu-foam-series-soffty-dlx-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - PU Foam Series - Soffty Plus\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/pu-foam-series-soffty-dlx-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/pu-foam-series/soffty-dlx/1.png\">'),
(12, 12, 'Selene TT', 9144, 0, 1, 'premium-series/selene/tight-top/1.png', 'premium-series-selene-tight-top-mattress', 'With the traditional innerspring mattress Tight top model mattresses provide deep-down support and develop extra support throughout the night ', '', '', '', '<title>Buy premium series selene tight top mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The premium series selene mattress with bonnel spring, thermo bonded felt, PU super soft layer, woven fabric pu foam soft quilt | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/premium-series-selene-tight-top-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Premium Series - Selene Tight Top\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/premium-series-selene-tight-top-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/premium-series/selene/tight-top/1.png\">'),
(13, 12, 'Selene PT', 10530, 0, 2, 'premium-series/selene/pillow-top/1.png', 'premium-series-selene-pillow-top-mattress', 'Relieve yourself from the aches and pains. Your pressure points are now at ease with Pillowtop model mattresses', '', '', '', '<title>Buy premium series selene pillow top mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The selene mattress with bonnel spring, thermo bonded felt, PU super soft layer, woven fabric pu foam soft quilt | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/premium-series-selene-pillow-top-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Premium Series - Selene Pillow Top\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/premium-series-selene-pillow-top-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/premium-series/selene/pillow-top/1.png\">'),
(14, 13, 'Luxe TT', 11412, 0, 1, 'premium-series/luxe/tight-top/1.png', 'premium-series-luxe-tight-top-mattress', 'With the layers of comforts, the Tight Top model from this series holds you and sustains for the better nights and better sleep', '', '', '', '<title>Buy premium series luxe tight top mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The premium series luxe tight top mattress with bonnel spring, thermo bonded felt, PU super soft layer, knitted fabric pu foam super soft quilt | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/premium-series-luxe-tight-top-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Premium Series - Luxe Tight Top\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/premium-series-luxe-tight-top-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/premium-series/luxe/tight-top/1.png\">'),
(15, 13, 'Luxe ET', 14778, 0, 2, 'premium-series/luxe/euro-top/1.png', 'premium-series-luxe-euro-top-mattress', 'Our euro top model mattresses are real craftsmanship offer unmatched comfort and luxury sleep', '', '', '', '<title>Buy premium series luxe euro top mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The premium series luxe euro top mattress with bonnel spring, thermo bonded felt, PU super soft layer, knitted fabric pu foam super soft quilt | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/premium-series-luxe-euro-top-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Premium Series - Luxe Euro Top\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/premium-series-luxe-euro-top-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/premium-series/luxe/euro-top/1.png\">'),
(16, 5, 'The Guardianz - Bonnel Spring with Memory Foam', 20016, 0, 1, 'medico-series/the-guardianz/1.png', 'medico-series-the-guardianz-bonnell-spring-mattress', 'Get the right sleep and drop a full stop to your back pain. Wake up for the fresh morning with no aches and pain', '', '', '', '<title>Buy guardianz spring with memory foam mattress online | POPPY</title>\r\n<meta name=\"description\" content=\"The medico series guardianz mattress with bonnel spring, thermo bonded felt, PU super soft layer, knitted fabric pu foam super soft quilt | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/medico-series-the-guardianz-bonnell-spring-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - The Guardianz - Bonnel Spring with Memory Foam\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/medico-series-the-guardianz-bonnell-spring-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/medico-series/the-guardianz/1.png\">'),
(17, 14, '17X27 - Sleepy pillow', 399, 0, 1, 'polyster_fibre_pillow_img.png', 'polyester-fiber-pillow', '', '', '', '', '<title>Buy Poppy Sleepy Pillow Online</title>\r\n<meta name=\"description\" content=\"The Poppy sleepy pillow online. The ultra soft sleepy pillow made us the stress free sleep | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/polyester-fiber-pillow\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Sleepy Pillows\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/polyester-fiber-pillow\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/polyster_fibre_pillow_img.png\">'),
(18, 14, ' Snoozy Pillow', 699, 0, 2, 'micro-fiber.png', 'micro-fiber-pillow', '', '', '', '', '<title>Buy Poppy Snoozy Pillow Online</title>\r\n<meta name=\"description\" content=\"The Poppy snoozy pillow online. The super soft snoozy pillow made us the stress free sleep | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/micro-fiber-pillow\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Snoozy Pillows\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/micro-fiber-pillow\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/micro-fiber.png\">'),
(20, 15, 'Comforter', 2499, 0, 1, 'prod_com_img.png', 'comforter', '', '', '', '', '<title>Buy Poppy Comforter Online | Poppy</title>\r\n<meta name=\"description\" content=\"The Poppy fluffy soft comforter online. The poppy comforter is thick, fulffy and make us warm in the winter | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/comforter\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Comforter\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/comforter\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/prod_com_img.png\">'),
(21, 15, 'Malevals Protector', 2699, 0, 2, 'prod_img.png', 'protector', '', '', '', '', '<title>Buy Poppy Water Proof Malevals Protector Online | Poppy</title>\r\n<meta name=\"description\" content=\"Buy the poppy water proof malevals protector online. The poppy water proof malevals protector is silky and fit to the mattress | Poppy\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/protector\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Protector\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/protector\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/prod_img.png\">'),
(22, 15, 'Alicia bedspread', 1999, 0, 3, 'beds_img.png', 'bedspreads', '', '', '', '', '<title>Bedspread : Buy Mattress Online - India\'s Best Mattress Brand</title>'),
(23, 15, 'Neck Defender', 2199, 0, 4, 'neck_defender_img.png', 'neck-defender', '', '', '', '', '<title>Buy Poppy Memory Foam Neck Defender Online</title>\r\n<meta name=\"description\" content=\"The Poppy neck defender with ultra soft PU foam with memory foam | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/neck-defender\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - Memory Foam Neck Defender\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/neck-defender\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/neck_defender_img.png\">'),
(24, 14, 'PU foam pillows', 999, 0, 3, 'pu_foam_pillows_img.png', 'pu-foam-pillows', '', '', '', '', '<title>Buy Poppy PU Foam Pillow Online</title>\r\n<meta name=\"description\" content=\"The Poppy ultra soft PU foam pillow online. The ultra soft PU foam made us the sress free sleep | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/pu-foam-pillows\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - PU Foam Pillows\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/pu-foam-pillows\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/pu_foam_pillows_img.png\">'),
(25, 5, 'The Guardianz - Bonded foam with memory foam', 15174, 0, 2, 'medico-series/the-guardianz/1.png', 'medico-series-the-guardianz-memory-foam-mattress', 'Get the right sleep and drop a full stop to your back pain. Wake up for the fresh morning with no aches and pain', '', '', '', '<title>Buy guardianz bonded foam with memory foam mattress online</title>\r\n<meta name=\"description\" content=\"The medico series guardianz  mattress with bonnel spring, thermo bonded felt, PU super soft layer, knitted fabric with memory foam super soft quilt | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/medico-series-the-guardianz-memory-foam-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - The Guardianz - Bonded Foam with Memory Foam\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/medico-series-the-guardianz-memory-foam-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/medico-series/the-guardianz/1.png\">'),
(27, 5, 'The Guardianz - Latex', 16632, 0, 4, 'medico-series/the-guardianz/1.png', 'medico-series-the-guardianz-latex-mattress', 'Get the right sleep and drop a full stop to your back pain. Wake up for the fresh morning with no aches and pain', '', '', '', '<title>Buy the guardianz natural latex mattress online</title>\r\n<meta name=\"description\" content=\"The medico series guardianz mattress with natural latex, knitted fabric with memory foam super soft quilt | Poppy Mattress\">\r\n<meta name=\"robots\" content=\"index, follow\">\r\n<link rel=\"canonical\" href=\"https://poppyindia.com/medico-series-the-guardianz-latex-mattress\">\r\n<meta property=\"og:title\" content=\"Poppy Mattress - The Guardianz - Latex\">\r\n<meta property=\"og:site_name\" content=\"POPPY MATTRESS\">\r\n<meta property=\"og:url\" content=\"https://poppyindia.com/medico-series-the-guardianz-latex-mattress\">\r\n<meta property=\"og:description\" content=\"Poppy Mattress | Mattress for everyone\">\r\n<meta property=\"og:type\" content=\"product\">\r\n<meta property=\"og:image\" content=\"https://poppyindia.com/images/products/medico-series/the-guardianz/1.png\">'),
(28, 14, '16X24- Sleepy pillow', 399, 0, 1, 'polyster-fibre-pillow.png', 'polyester-fiber-pillow1', '', '', '', '', '<title>Polyster Fibre Pillow : Buy Mattress Onli...'),
(29, 16, 'Organic Luxury Hybrid', 20989, 0, 1, 'cuddle-buddy/hybrid/1.jpg', 'cuddle-buddy-natural-latex-hybrid-mattress', 'Cuddle Buddy here has a hybrid mattress range made with premium quality 100% pure cotton as top layer and Natural latex', 'Cuddle Buddy Hybrid', '', '', ''),
(30, 16, 'Organic Latex', 33989, 0, 2, 'cuddle-buddy/latex/1.jpg', 'cuddle-buddy-organic-latex-mattress', 'Pure natural Latex  mattress constructed with six inches of latex promises to improve your sleep and make it more comfortable', 'Cuddle Buddy Latex', '', '', ''),
(31, 16, 'Eco Cloud', 17989, 0, 3, 'cuddle-buddy/hrfoam/1.jpg', 'cuddle-buddy-latex-with-hrfoam-mattress', 'Being an organic latex with HR foam mattress, it offers plenty of health benefits and complete support to your back', 'Cuddle Buddy Latex with HR Foam', '', '', ''),
(32, 15, '100% Natural Latex Contour Pillow', 1899, 2899, 1, 'accessories/contour-pillow.png', 'contour-pillow.php', '', 'Contour Pillow', '', '', ''),
(33, 15, '100% Natural Latex Soap Pillow', 1999, 2999, 2, 'accessories/soap-pillow.png', 'soap-pillow.php', '', 'Soap Pillow', '', '', ''),
(34, 15, '100% Cotton Mattress Protector ', 799, 1099, 3, 'accessories/protector/1.jpg', 'mattress-protector.php', '', 'Mattress Protector', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_dimension`
--

CREATE TABLE `product_dimension` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `dimension` int(11) NOT NULL,
  `sqft_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_dimension`
--

INSERT INTO `product_dimension` (`id`, `product_id`, `dimension`, `sqft_rate`) VALUES
(1, 1, 6, 745),
(2, 1, 8, 875),
(3, 1, 10, 1080),
(4, 2, 6, 844),
(5, 2, 8, 1114),
(6, 2, 10, 1373),
(7, 3, 8, 1442),
(8, 4, 10, 2025),
(9, 4, 12, 2531),
(10, 5, 4, 0),
(11, 6, 4, 306),
(12, 6, 5, 382),
(13, 7, 4, 353),
(14, 7, 5, 440),
(15, 8, 4, 398),
(16, 8, 5, 498),
(17, 8, 6, 665),
(18, 9, 4, 336),
(19, 9, 5, 421),
(20, 10, 5, 518),
(21, 10, 6, 621),
(22, 11, 6, 1141),
(23, 11, 8, 1427),
(24, 12, 6, 508),
(25, 12, 8, 599),
(26, 12, 10, 630),
(27, 13, 6, 585),
(28, 13, 8, 657),
(29, 13, 10, 709),
(30, 14, 6, 634),
(31, 14, 8, 778),
(32, 14, 10, 906),
(33, 15, 6, 821),
(34, 15, 8, 1028),
(35, 15, 10, 1215),
(36, 16, 6, 1112),
(37, 16, 8, 1324),
(38, 25, 5, 843),
(39, 25, 6, 1011),
(40, 26, 5, 924),
(41, 27, 5, 1589),
(42, 29, 8, 0),
(43, 30, 6, 0),
(44, 31, 6, 0),
(45, 31, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_free`
--

CREATE TABLE `product_free` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `free_product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_free`
--

INSERT INTO `product_free` (`id`, `parent_id`, `free_product_id`, `qty`) VALUES
(1, 7, 17, 2),
(2, 8, 22, 1),
(3, 8, 18, 2),
(5, 12, 17, 2),
(6, 12, 22, 1),
(7, 13, 17, 2),
(8, 13, 22, 1),
(9, 14, 17, 2),
(10, 14, 21, 1),
(11, 15, 17, 2),
(12, 15, 21, 1),
(13, 16, 23, 2),
(14, 16, 21, 1),
(15, 1, 18, 2),
(16, 1, 21, 1),
(17, 2, 18, 2),
(18, 2, 21, 1),
(19, 3, 18, 2),
(20, 3, 22, 1),
(21, 3, 21, 1),
(22, 4, 23, 2),
(23, 4, 22, 1),
(24, 4, 21, 1),
(25, 25, 23, 2),
(26, 25, 21, 1),
(27, 26, 23, 2),
(28, 26, 21, 1),
(29, 27, 23, 2),
(30, 27, 21, 1),
(31, 5, 28, 1),
(32, 6, 28, 1),
(33, 9, 28, 1),
(34, 10, 17, 1),
(35, 11, 23, 2),
(36, 11, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_free_cost`
--

CREATE TABLE `product_free_cost` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_from` int(11) NOT NULL,
  `size_to` int(11) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_free_cost`
--

INSERT INTO `product_free_cost` (`id`, `product_id`, `size_from`, `size_to`, `cost`) VALUES
(1, 17, 0, 100, 399),
(2, 18, 0, 100, 699),
(3, 21, 0, 48, 1919),
(4, 21, 49, 60, 2399),
(5, 21, 61, 100, 2699),
(6, 22, 0, 60, 1549),
(7, 22, 61, 100, 1999),
(8, 23, 0, 100, 2199),
(9, 24, 0, 100, 999);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `parent_id`, `image_path`, `sort_order`) VALUES
(1, 1, 'grand-series/exuber/exuber/3.png', 1),
(2, 2, 'grand-series/exuber/exuber-pt/1.png', 1),
(3, 3, 'grand-series/grand/grandeur/1.png', 1),
(4, 4, 'grand-series/grand/grand-master/1.png', 1),
(5, 5, 'rubberized-coir-series/desire/1.png', 1),
(6, 6, 'rubberized-coir-series/saffron/1.png', 1),
(7, 7, 'rubberized-coir-series/saffron-plus/1.png', 1),
(8, 8, 'rubberized-coir-series/saffron-dlx/1.png', 1),
(9, 9, 'pu-foam-series/soffty/1.png', 1),
(10, 10, 'pu-foam-series/soffty-plus/1.png', 1),
(11, 11, 'pu-foam-series/soffty-dlx/1.png', 1),
(12, 12, 'premium-series/selene/tight-top/1.png', 1),
(13, 13, 'premium-series/selene/pillow-top/1.png', 1),
(14, 14, 'premium-series/luxe/tight-top/1.png', 1),
(15, 15, 'premium-series/luxe/euro-top/1.png', 1),
(16, 16, 'medico-series/the-guardianz/1.png', 1),
(17, 8, '7533_5801-c-jpg.jpg', 2),
(18, 8, '4274_8992-e-jpg.jpg', 3),
(19, 8, '9620_9965-a-jpg.jpg', 4),
(20, 8, '2062_slider-6-jpg.jpg', 5),
(21, 1, '7925_1-png.png', 3),
(22, 1, '1103_1-png.png', 2),
(23, 1, '5821_1-png.png', 4),
(24, 1, '7916_1-png.png', 5),
(25, 1, '1646_1-png.png', 6),
(26, 1, '8656_1-png.png', 7),
(27, 29, 'cuddle-buddy/hybrid/1.jpg', 1),
(28, 29, 'cuddle-buddy/hybrid/2.jpg', 2),
(29, 29, 'cuddle-buddy/hybrid/3.jpg', 3),
(30, 30, 'cuddle-buddy/latex/1.jpg', 1),
(31, 30, 'cuddle-buddy/latex/2.jpg', 2),
(32, 30, 'cuddle-buddy/latex/3.jpg', 3),
(33, 31, 'cuddle-buddy/hrfoam/1.jpg', 1),
(34, 31, 'cuddle-buddy/hrfoam/2.jpg', 2),
(35, 31, 'cuddle-buddy/hrfoam/3.jpg', 3),
(36, 32, 'accessories/contour-pillow.png', 1),
(37, 32, 'accessories/contour-pillow-b.png', 2),
(38, 34, 'accessories/protector/1.jpg', 1),
(39, 34, 'accessories/protector/2.jpg', 2),
(40, 34, 'accessories/protector/3.jpg', 3),
(41, 34, 'accessories/protector/4.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `dimension` int(11) NOT NULL,
  `size_mm_w` int(11) NOT NULL,
  `size_mm_b` int(11) NOT NULL,
  `size_inch_w` int(11) NOT NULL,
  `size_inch_b` int(11) NOT NULL,
  `size_sqft` float NOT NULL,
  `size_name` varchar(10) NOT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `product_id`, `dimension`, `size_mm_w`, `size_mm_b`, `size_inch_w`, `size_inch_b`, `size_sqft`, `size_name`, `product_price`) VALUES
(4, 1, 6, 1829, 915, 72, 36, 18, 'Single', 13410),
(5, 1, 8, 1829, 915, 72, 36, 18, 'Single', 15750),
(6, 1, 10, 1829, 915, 72, 36, 18, 'Single', 19440),
(7, 1, 6, 1829, 1067, 72, 42, 21, 'Double', 15645),
(8, 1, 8, 1829, 1067, 72, 42, 21, 'Double', 18375),
(9, 1, 10, 1829, 1067, 72, 42, 21, 'Double', 22680),
(10, 1, 6, 1829, 1219, 72, 48, 24, 'Double', 17880),
(11, 1, 8, 1829, 1219, 72, 48, 24, 'Double', 21000),
(12, 1, 10, 1829, 1219, 72, 48, 24, 'Double', 25920),
(13, 1, 6, 1829, 1524, 72, 60, 30, 'Queen', 22350),
(14, 1, 8, 1829, 1524, 72, 60, 30, 'Queen', 26250),
(15, 1, 10, 1829, 1524, 72, 60, 30, 'Queen', 32400),
(16, 1, 6, 1829, 1676, 72, 66, 33, 'Queen', 24585),
(17, 1, 8, 1829, 1676, 72, 66, 33, 'Queen', 28875),
(18, 1, 10, 1829, 1676, 72, 66, 33, 'Queen', 35640),
(19, 1, 6, 1829, 1829, 72, 72, 36, 'King', 26820),
(20, 1, 8, 1829, 1829, 72, 72, 36, 'King', 31500),
(21, 1, 10, 1829, 1829, 72, 72, 36, 'King', 38880),
(25, 1, 6, 1905, 915, 75, 36, 18.75, 'Single', 13969),
(26, 1, 8, 1905, 915, 75, 36, 18.75, 'Single', 16406),
(27, 1, 10, 1905, 915, 75, 36, 18.75, 'Single', 20250),
(28, 1, 6, 1905, 1067, 75, 42, 21.88, 'Double', 16301),
(29, 1, 8, 1905, 1067, 75, 42, 21.88, 'Double', 19145),
(30, 1, 10, 1905, 1067, 75, 42, 21.88, 'Double', 23630),
(31, 1, 6, 1905, 1219, 75, 48, 25, 'Double', 18625),
(32, 1, 8, 1905, 1219, 75, 48, 25, 'Double', 21875),
(33, 1, 10, 1905, 1219, 75, 48, 25, 'Double', 27000),
(34, 1, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 23281),
(35, 1, 8, 1905, 1524, 75, 60, 31.25, 'Queen', 27344),
(36, 1, 10, 1905, 1524, 75, 60, 31.25, 'Queen', 33750),
(37, 1, 6, 1905, 1676, 75, 66, 34.37, 'Queen', 25606),
(38, 1, 8, 1905, 1676, 75, 66, 34.37, 'Queen', 30074),
(39, 1, 10, 1905, 1676, 75, 66, 34.37, 'Queen', 37120),
(40, 1, 6, 1905, 1829, 75, 72, 37.5, 'King', 27938),
(41, 1, 8, 1905, 1829, 75, 72, 37.5, 'King', 32813),
(42, 1, 10, 1905, 1829, 75, 72, 37.5, 'King', 40500),
(46, 1, 6, 1981, 915, 78, 36, 19.5, 'Single', 14528),
(47, 1, 8, 1981, 915, 78, 36, 19.5, 'Single', 17063),
(48, 1, 10, 1981, 915, 78, 36, 19.5, 'Single', 21060),
(49, 1, 6, 1981, 1067, 78, 42, 22.75, 'Double', 16949),
(50, 1, 8, 1981, 1067, 78, 42, 22.75, 'Double', 19906),
(51, 1, 10, 1981, 1067, 78, 42, 22.75, 'Double', 24570),
(52, 1, 6, 1981, 1219, 78, 48, 26, 'Double', 19370),
(53, 1, 8, 1981, 1219, 78, 48, 26, 'Double', 22750),
(54, 1, 10, 1981, 1219, 78, 48, 26, 'Double', 28080),
(55, 1, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 24213),
(56, 1, 8, 1981, 1524, 78, 60, 32.5, 'Queen', 28438),
(57, 1, 10, 1981, 1524, 78, 60, 32.5, 'Queen', 35100),
(58, 1, 6, 1981, 1676, 78, 66, 35.75, 'Queen', 26634),
(59, 1, 8, 1981, 1676, 78, 66, 35.75, 'Queen', 31281),
(60, 1, 10, 1981, 1676, 78, 66, 35.75, 'Queen', 38610),
(61, 1, 6, 1981, 1829, 78, 72, 39, 'King', 29055),
(62, 1, 8, 1981, 1829, 78, 72, 39, 'King', 34125),
(63, 1, 10, 1981, 1829, 78, 72, 39, 'King', 42120),
(67, 2, 6, 1829, 915, 72, 36, 18, 'Single', 15192),
(68, 2, 8, 1829, 915, 72, 36, 18, 'Single', 20052),
(69, 2, 10, 1829, 915, 72, 36, 18, 'Single', 24714),
(70, 2, 6, 1829, 1067, 72, 42, 21, 'Double', 17724),
(71, 2, 8, 1829, 1067, 72, 42, 21, 'Double', 23394),
(72, 2, 10, 1829, 1067, 72, 42, 21, 'Double', 28833),
(73, 2, 6, 1829, 1219, 72, 48, 24, 'Double', 20256),
(74, 2, 8, 1829, 1219, 72, 48, 24, 'Double', 26736),
(75, 2, 10, 1829, 1219, 72, 48, 24, 'Double', 32952),
(76, 2, 6, 1829, 1524, 72, 60, 30, 'Queen', 25320),
(77, 2, 8, 1829, 1524, 72, 60, 30, 'Queen', 33420),
(78, 2, 10, 1829, 1524, 72, 60, 30, 'Queen', 41190),
(79, 2, 6, 1829, 1676, 72, 66, 33, 'Queen', 27852),
(80, 2, 8, 1829, 1676, 72, 66, 33, 'Queen', 36762),
(81, 2, 10, 1829, 1676, 72, 66, 33, 'Queen', 45309),
(82, 2, 6, 1829, 1829, 72, 72, 36, 'King', 30384),
(83, 2, 8, 1829, 1829, 72, 72, 36, 'King', 40104),
(84, 2, 10, 1829, 1829, 72, 72, 36, 'King', 49428),
(88, 2, 6, 1905, 915, 75, 36, 18.75, 'Single', 15825),
(89, 2, 8, 1905, 915, 75, 36, 18.75, 'Single', 20888),
(90, 2, 10, 1905, 915, 75, 36, 18.75, 'Single', 25744),
(91, 2, 6, 1905, 1067, 75, 42, 21.88, 'Double', 18467),
(92, 2, 8, 1905, 1067, 75, 42, 21.88, 'Double', 24374),
(93, 2, 10, 1905, 1067, 75, 42, 21.88, 'Double', 30041),
(94, 2, 6, 1905, 1219, 75, 48, 25, 'Double', 21100),
(95, 2, 8, 1905, 1219, 75, 48, 25, 'Double', 27850),
(96, 2, 10, 1905, 1219, 75, 48, 25, 'Double', 34325),
(97, 2, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 26375),
(98, 2, 8, 1905, 1524, 75, 60, 31.25, 'Queen', 34813),
(99, 2, 10, 1905, 1524, 75, 60, 31.25, 'Queen', 42906),
(100, 2, 6, 1905, 1676, 75, 66, 34.37, 'Queen', 29008),
(101, 2, 8, 1905, 1676, 75, 66, 34.37, 'Queen', 38288),
(102, 2, 10, 1905, 1676, 75, 66, 34.37, 'Queen', 47190),
(103, 2, 6, 1905, 1829, 75, 72, 37.5, 'King', 31650),
(104, 2, 8, 1905, 1829, 75, 72, 37.5, 'King', 41775),
(105, 2, 10, 1905, 1829, 75, 72, 37.5, 'King', 51488),
(109, 2, 6, 1981, 915, 78, 36, 19.5, 'Single', 16458),
(110, 2, 8, 1981, 915, 78, 36, 19.5, 'Single', 21723),
(111, 2, 10, 1981, 915, 78, 36, 19.5, 'Single', 26774),
(112, 2, 6, 1981, 1067, 78, 42, 22.75, 'Double', 19201),
(113, 2, 8, 1981, 1067, 78, 42, 22.75, 'Double', 25344),
(114, 2, 10, 1981, 1067, 78, 42, 22.75, 'Double', 31236),
(115, 2, 6, 1981, 1219, 78, 48, 26, 'Double', 21944),
(116, 2, 8, 1981, 1219, 78, 48, 26, 'Double', 28964),
(117, 2, 10, 1981, 1219, 78, 48, 26, 'Double', 35698),
(118, 2, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 27430),
(119, 2, 8, 1981, 1524, 78, 60, 32.5, 'Queen', 36205),
(120, 2, 10, 1981, 1524, 78, 60, 32.5, 'Queen', 44623),
(121, 2, 6, 1981, 1676, 78, 66, 35.75, 'Queen', 30173),
(122, 2, 8, 1981, 1676, 78, 66, 35.75, 'Queen', 39826),
(123, 2, 10, 1981, 1676, 78, 66, 35.75, 'Queen', 49085),
(124, 2, 6, 1981, 1829, 78, 72, 39, 'King', 32916),
(125, 2, 8, 1981, 1829, 78, 72, 39, 'King', 43446),
(126, 2, 10, 1981, 1829, 78, 72, 39, 'King', 53547),
(129, 4, 10, 1829, 915, 72, 36, 18, 'Single', 36450),
(130, 4, 12, 1829, 915, 72, 36, 18, 'Single', 45558),
(131, 4, 10, 1829, 1067, 72, 42, 21, 'Double', 42525),
(132, 4, 12, 1829, 1067, 72, 42, 21, 'Double', 53151),
(133, 4, 10, 1829, 1219, 72, 48, 24, 'Double', 48600),
(134, 4, 12, 1829, 1219, 72, 48, 24, 'Double', 60744),
(135, 4, 10, 1829, 1524, 72, 60, 30, 'Queen', 60750),
(136, 4, 12, 1829, 1524, 72, 60, 30, 'Queen', 75930),
(137, 4, 10, 1829, 1676, 72, 66, 33, 'Queen', 66825),
(138, 4, 12, 1829, 1676, 72, 66, 33, 'Queen', 83523),
(139, 4, 10, 1829, 1829, 72, 72, 36, 'King', 72900),
(140, 4, 12, 1829, 1829, 72, 72, 36, 'King', 91116),
(143, 4, 10, 1905, 915, 75, 36, 18.75, 'Single', 37969),
(144, 4, 12, 1905, 915, 75, 36, 18.75, 'Single', 47456),
(145, 4, 10, 1905, 1067, 75, 42, 21.88, 'Double', 44307),
(146, 4, 12, 1905, 1067, 75, 42, 21.88, 'Double', 55378),
(147, 4, 10, 1905, 1219, 75, 48, 25, 'Double', 50625),
(148, 4, 12, 1905, 1219, 75, 48, 25, 'Double', 63275),
(149, 4, 10, 1905, 1524, 75, 60, 31.25, 'Queen', 63281),
(150, 4, 12, 1905, 1524, 75, 60, 31.25, 'Queen', 79094),
(151, 4, 10, 1905, 1676, 75, 66, 34.37, 'Queen', 69599),
(152, 4, 12, 1905, 1676, 75, 66, 34.37, 'Queen', 86990),
(153, 4, 10, 1905, 1829, 75, 72, 37.5, 'King', 75938),
(154, 4, 12, 1905, 1829, 75, 72, 37.5, 'King', 94913),
(157, 4, 10, 1981, 915, 78, 36, 19.5, 'Single', 39488),
(158, 4, 12, 1981, 915, 78, 36, 19.5, 'Single', 49355),
(159, 4, 10, 1981, 1067, 78, 42, 22.75, 'Double', 46069),
(160, 4, 12, 1981, 1067, 78, 42, 22.75, 'Double', 57580),
(161, 4, 10, 1981, 1219, 78, 48, 26, 'Double', 52650),
(162, 4, 12, 1981, 1219, 78, 48, 26, 'Double', 65806),
(163, 4, 10, 1981, 1524, 78, 60, 32.5, 'Queen', 65813),
(164, 4, 12, 1981, 1524, 78, 60, 32.5, 'Queen', 82258),
(165, 4, 10, 1981, 1676, 78, 66, 35.75, 'Queen', 72394),
(166, 4, 12, 1981, 1676, 78, 66, 35.75, 'Queen', 90483),
(167, 4, 10, 1981, 1829, 78, 72, 39, 'King', 78975),
(168, 4, 12, 1981, 1829, 78, 72, 39, 'King', 98709),
(170, 3, 8, 1829, 915, 72, 36, 18, 'Single', 25956),
(171, 3, 8, 1829, 1067, 72, 42, 21, 'Double', 30282),
(172, 3, 8, 1829, 1219, 72, 48, 24, 'Double', 34608),
(173, 3, 8, 1829, 1524, 72, 60, 30, 'Queen', 43260),
(174, 3, 8, 1829, 1676, 72, 66, 33, 'Queen', 47586),
(175, 3, 8, 1829, 1829, 72, 72, 36, 'King', 51912),
(177, 3, 8, 1905, 915, 75, 36, 18.75, 'Single', 27038),
(178, 3, 8, 1905, 1067, 75, 42, 21.88, 'Double', 31551),
(179, 3, 8, 1905, 1219, 75, 48, 25, 'Double', 36050),
(180, 3, 8, 1905, 1524, 75, 60, 31.25, 'Queen', 45063),
(181, 3, 8, 1905, 1676, 75, 66, 34.37, 'Queen', 49562),
(182, 3, 8, 1905, 1829, 75, 72, 37.5, 'King', 54075),
(184, 3, 8, 1981, 915, 78, 36, 19.5, 'Single', 28119),
(185, 3, 8, 1981, 1067, 78, 42, 22.75, 'Double', 32806),
(186, 3, 8, 1981, 1219, 78, 48, 26, 'Double', 37492),
(187, 3, 8, 1981, 1524, 78, 60, 32.5, 'Queen', 46865),
(188, 3, 8, 1981, 1676, 78, 66, 35.75, 'Queen', 51552),
(189, 3, 8, 1981, 1829, 78, 72, 39, 'King', 56238),
(191, 5, 4, 1829, 915, 72, 36, 18, 'Single', 5095),
(192, 5, 4, 1829, 1067, 72, 42, 21, 'Double', 6011),
(193, 5, 4, 1829, 1118, 72, 44, 22, 'Double', 6297),
(194, 5, 4, 1829, 1219, 72, 48, 24, 'Double', 6828),
(195, 5, 4, 1829, 1524, 72, 60, 30, 'Queen', 8661),
(196, 5, 4, 1829, 1829, 72, 72, 36, 'King', 10399),
(198, 5, 4, 1905, 915, 75, 36, 18.75, 'Single', 5199),
(199, 5, 4, 1905, 1067, 75, 42, 21.88, 'Double', 6135),
(200, 5, 4, 1905, 1118, 75, 44, 23, 'Double', 6425),
(201, 5, 4, 1905, 1219, 75, 48, 25, 'Double', 6969),
(202, 5, 4, 1905, 1524, 75, 60, 31.25, 'Queen', 8838),
(203, 5, 4, 1905, 1829, 75, 72, 37.5, 'King', 10606),
(205, 5, 4, 1981, 915, 78, 36, 19.5, 'Single', 5407),
(206, 5, 4, 1981, 1067, 78, 42, 22.75, 'Double', 6380),
(207, 5, 4, 1981, 1118, 78, 44, 24, 'Double', 6682),
(208, 5, 4, 1981, 1219, 78, 48, 26, 'Double', 7245),
(209, 5, 4, 1981, 1524, 78, 60, 32.5, 'Queen', 9192),
(210, 5, 4, 1981, 1829, 78, 72, 39, 'King', 11030),
(213, 6, 4, 1829, 915, 72, 36, 18, 'Single', 5508),
(214, 6, 5, 1829, 915, 72, 36, 18, 'Single', 6876),
(215, 6, 4, 1829, 1067, 72, 42, 21, 'Double', 6426),
(216, 6, 5, 1829, 1067, 72, 42, 21, 'Double', 8022),
(217, 6, 4, 1829, 1118, 72, 44, 22, 'Double', 6732),
(218, 6, 5, 1829, 1118, 72, 44, 22, 'Double', 8404),
(219, 6, 4, 1829, 1219, 72, 48, 24, 'Double', 7344),
(220, 6, 5, 1829, 1219, 72, 48, 24, 'Double', 9168),
(221, 6, 4, 1829, 1524, 72, 60, 30, 'Queen', 9180),
(222, 6, 5, 1829, 1524, 72, 60, 30, 'Queen', 11460),
(223, 6, 4, 1829, 1829, 72, 72, 36, 'King', 11016),
(224, 6, 5, 1829, 1829, 72, 72, 36, 'King', 13752),
(227, 6, 4, 1905, 915, 75, 36, 18.75, 'Single', 5738),
(228, 6, 5, 1905, 915, 75, 36, 18.75, 'Single', 7163),
(229, 6, 4, 1905, 1067, 75, 42, 21.88, 'Double', 6695),
(230, 6, 5, 1905, 1067, 75, 42, 21.88, 'Double', 8358),
(231, 6, 4, 1905, 1118, 75, 44, 23, 'Double', 7038),
(232, 6, 5, 1905, 1118, 75, 44, 23, 'Double', 8786),
(233, 6, 4, 1905, 1219, 75, 48, 25, 'Double', 7650),
(234, 6, 5, 1905, 1219, 75, 48, 25, 'Double', 9550),
(235, 6, 4, 1905, 1524, 75, 60, 31.25, 'Queen', 9563),
(236, 6, 5, 1905, 1524, 75, 60, 31.25, 'Queen', 11938),
(237, 6, 4, 1905, 1829, 75, 72, 37.5, 'King', 11475),
(238, 6, 5, 1905, 1829, 75, 72, 37.5, 'King', 14325),
(241, 6, 4, 1981, 915, 78, 36, 19.5, 'Single', 5967),
(242, 6, 5, 1981, 915, 78, 36, 19.5, 'Single', 7449),
(243, 6, 4, 1981, 1067, 78, 42, 22.75, 'Double', 6962),
(244, 6, 5, 1981, 1067, 78, 42, 22.75, 'Double', 8691),
(245, 6, 4, 1981, 1118, 78, 44, 24, 'Double', 7344),
(246, 6, 5, 1981, 1118, 78, 44, 24, 'Double', 9168),
(247, 6, 4, 1981, 1219, 78, 48, 26, 'Double', 7956),
(248, 6, 5, 1981, 1219, 78, 48, 26, 'Double', 9932),
(249, 6, 4, 1981, 1524, 78, 60, 32.5, 'Queen', 9945),
(250, 6, 5, 1981, 1524, 78, 60, 32.5, 'Queen', 12415),
(251, 6, 4, 1981, 1829, 78, 72, 39, 'King', 11934),
(252, 6, 5, 1981, 1829, 78, 72, 39, 'King', 14898),
(255, 7, 4, 1829, 915, 72, 36, 18, 'Single', 6354),
(256, 7, 5, 1829, 915, 72, 36, 18, 'Single', 7920),
(257, 7, 4, 1829, 1067, 72, 42, 21, 'Double', 7413),
(258, 7, 5, 1829, 1067, 72, 42, 21, 'Double', 9240),
(259, 7, 4, 1829, 1118, 72, 44, 22, 'Double', 7766),
(260, 7, 5, 1829, 1118, 72, 44, 22, 'Double', 9680),
(261, 7, 4, 1829, 1219, 72, 48, 24, 'Double', 8472),
(262, 7, 5, 1829, 1219, 72, 48, 24, 'Double', 10560),
(263, 7, 4, 1829, 1524, 72, 60, 30, 'Queen', 10590),
(264, 7, 5, 1829, 1524, 72, 60, 30, 'Queen', 13200),
(265, 7, 4, 1829, 1829, 72, 72, 36, 'King', 12708),
(266, 7, 5, 1829, 1829, 72, 72, 36, 'King', 15840),
(269, 7, 4, 1905, 915, 75, 36, 18.75, 'Single', 6619),
(270, 7, 5, 1905, 915, 75, 36, 18.75, 'Single', 8250),
(271, 7, 4, 1905, 1067, 75, 42, 21.88, 'Double', 7724),
(272, 7, 5, 1905, 1067, 75, 42, 21.88, 'Double', 9627),
(273, 7, 4, 1905, 1118, 75, 44, 23, 'Double', 8119),
(274, 7, 5, 1905, 1118, 75, 44, 23, 'Double', 10120),
(275, 7, 4, 1905, 1219, 75, 48, 25, 'Double', 8825),
(276, 7, 5, 1905, 1219, 75, 48, 25, 'Double', 11000),
(277, 7, 4, 1905, 1524, 75, 60, 31.25, 'Queen', 11031),
(278, 7, 5, 1905, 1524, 75, 60, 31.25, 'Queen', 13750),
(279, 7, 4, 1905, 1829, 75, 72, 37.5, 'King', 13238),
(280, 7, 5, 1905, 1829, 75, 72, 37.5, 'King', 16500),
(283, 7, 4, 1981, 915, 78, 36, 19.5, 'Single', 6884),
(284, 7, 5, 1981, 915, 78, 36, 19.5, 'Single', 8580),
(285, 7, 4, 1981, 1067, 78, 42, 22.75, 'Double', 8031),
(286, 7, 5, 1981, 1067, 78, 42, 22.75, 'Double', 10010),
(287, 7, 4, 1981, 1118, 78, 44, 24, 'Double', 8472),
(288, 7, 5, 1981, 1118, 78, 44, 24, 'Double', 10560),
(289, 7, 4, 1981, 1219, 78, 48, 26, 'Double', 9178),
(290, 7, 5, 1981, 1219, 78, 48, 26, 'Double', 11440),
(291, 7, 4, 1981, 1524, 78, 60, 32.5, 'Queen', 11473),
(292, 7, 5, 1981, 1524, 78, 60, 32.5, 'Queen', 14300),
(293, 7, 4, 1981, 1829, 78, 72, 39, 'King', 13767),
(294, 7, 5, 1981, 1829, 78, 72, 39, 'King', 17160),
(298, 8, 4, 1829, 915, 72, 36, 18, 'Single', 7164),
(299, 8, 5, 1829, 915, 72, 36, 18, 'Single', 8964),
(300, 8, 6, 1829, 915, 72, 36, 18, 'Single', 11970),
(301, 8, 4, 1829, 1067, 72, 42, 21, 'Double', 8358),
(302, 8, 5, 1829, 1067, 72, 42, 21, 'Double', 10458),
(303, 8, 6, 1829, 1067, 72, 42, 21, 'Double', 13965),
(304, 8, 4, 1829, 1118, 72, 44, 22, 'Double', 8756),
(305, 8, 5, 1829, 1118, 72, 44, 22, 'Double', 10956),
(306, 8, 6, 1829, 1118, 72, 44, 22, 'Double', 14630),
(307, 8, 4, 1829, 1219, 72, 48, 24, 'Double', 9552),
(308, 8, 5, 1829, 1219, 72, 48, 24, 'Double', 11952),
(309, 8, 6, 1829, 1219, 72, 48, 24, 'Double', 15960),
(310, 8, 4, 1829, 1524, 72, 60, 30, 'Queen', 11940),
(311, 8, 5, 1829, 1524, 72, 60, 30, 'Queen', 14940),
(312, 8, 6, 1829, 1524, 72, 60, 30, 'Queen', 19950),
(313, 8, 4, 1829, 1829, 72, 72, 36, 'King', 14328),
(314, 8, 5, 1829, 1829, 72, 72, 36, 'King', 17928),
(315, 8, 6, 1829, 1829, 72, 72, 36, 'King', 23940),
(319, 8, 4, 1905, 915, 75, 36, 18.75, 'Single', 7463),
(320, 8, 5, 1905, 915, 75, 36, 18.75, 'Single', 9338),
(321, 8, 6, 1905, 915, 75, 36, 18.75, 'Single', 12469),
(322, 8, 4, 1905, 1067, 75, 42, 21.88, 'Double', 8708),
(323, 8, 5, 1905, 1067, 75, 42, 21.88, 'Double', 10896),
(324, 8, 6, 1905, 1067, 75, 42, 21.88, 'Double', 14550),
(325, 8, 4, 1905, 1118, 75, 44, 23, 'Double', 9154),
(326, 8, 5, 1905, 1118, 75, 44, 23, 'Double', 11454),
(327, 8, 6, 1905, 1118, 75, 44, 23, 'Double', 15295),
(328, 8, 4, 1905, 1219, 75, 48, 25, 'Double', 9950),
(329, 8, 5, 1905, 1219, 75, 48, 25, 'Double', 12450),
(330, 8, 6, 1905, 1219, 75, 48, 25, 'Double', 16625),
(331, 8, 4, 1905, 1524, 75, 60, 31.25, 'Queen', 12438),
(332, 8, 5, 1905, 1524, 75, 60, 31.25, 'Queen', 15563),
(333, 8, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 20781),
(334, 8, 4, 1905, 1829, 75, 72, 37.5, 'King', 14925),
(335, 8, 5, 1905, 1829, 75, 72, 37.5, 'King', 18675),
(336, 8, 6, 1905, 1829, 75, 72, 37.5, 'King', 24938),
(340, 8, 4, 1981, 915, 78, 36, 19.5, 'Single', 7761),
(341, 8, 5, 1981, 915, 78, 36, 19.5, 'Single', 9711),
(342, 8, 6, 1981, 915, 78, 36, 19.5, 'Single', 12968),
(343, 8, 4, 1981, 1067, 78, 42, 22.75, 'Double', 9055),
(344, 8, 5, 1981, 1067, 78, 42, 22.75, 'Double', 11330),
(345, 8, 6, 1981, 1067, 78, 42, 22.75, 'Double', 15129),
(346, 8, 4, 1981, 1118, 78, 44, 24, 'Double', 9552),
(347, 8, 5, 1981, 1118, 78, 44, 24, 'Double', 11952),
(348, 8, 6, 1981, 1118, 78, 44, 24, 'Double', 15960),
(349, 8, 4, 1981, 1219, 78, 48, 26, 'Double', 10348),
(350, 8, 5, 1981, 1219, 78, 48, 26, 'Double', 12948),
(351, 8, 6, 1981, 1219, 78, 48, 26, 'Double', 17290),
(352, 8, 4, 1981, 1524, 78, 60, 32.5, 'Queen', 12935),
(353, 8, 5, 1981, 1524, 78, 60, 32.5, 'Queen', 16185),
(354, 8, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 21613),
(355, 8, 4, 1981, 1829, 78, 72, 39, 'King', 15522),
(356, 8, 5, 1981, 1829, 78, 72, 39, 'King', 19422),
(357, 8, 6, 1981, 1829, 78, 72, 39, 'King', 25935),
(360, 9, 4, 1829, 915, 72, 36, 18, 'Single', 6048),
(361, 9, 5, 1829, 915, 72, 36, 18, 'Single', 7578),
(362, 9, 4, 1829, 1067, 72, 42, 21, 'Double', 7056),
(363, 9, 5, 1829, 1067, 72, 42, 21, 'Double', 8841),
(364, 9, 4, 1829, 1118, 72, 44, 22, 'Double', 7392),
(365, 9, 5, 1829, 1118, 72, 44, 22, 'Double', 9262),
(366, 9, 4, 1829, 1219, 72, 48, 24, 'Double', 8064),
(367, 9, 5, 1829, 1219, 72, 48, 24, 'Double', 10104),
(368, 9, 4, 1829, 1524, 72, 60, 30, 'Queen', 10080),
(369, 9, 5, 1829, 1524, 72, 60, 30, 'Queen', 12630),
(370, 9, 4, 1829, 1829, 72, 72, 36, 'King', 12096),
(371, 9, 5, 1829, 1829, 72, 72, 36, 'King', 15156),
(374, 9, 4, 1905, 915, 75, 36, 18.75, 'Single', 6300),
(375, 9, 5, 1905, 915, 75, 36, 18.75, 'Single', 7894),
(376, 9, 4, 1905, 1067, 75, 42, 21.88, 'Double', 7352),
(377, 9, 5, 1905, 1067, 75, 42, 21.88, 'Double', 9211),
(378, 9, 4, 1905, 1118, 75, 44, 23, 'Double', 7728),
(379, 9, 5, 1905, 1118, 75, 44, 23, 'Double', 9683),
(380, 9, 4, 1905, 1219, 75, 48, 25, 'Double', 8400),
(381, 9, 5, 1905, 1219, 75, 48, 25, 'Double', 10525),
(382, 9, 4, 1905, 1524, 75, 60, 31.25, 'Queen', 10500),
(383, 9, 5, 1905, 1524, 75, 60, 31.25, 'Queen', 13156),
(384, 9, 4, 1905, 1829, 75, 72, 37.5, 'King', 12600),
(385, 9, 5, 1905, 1829, 75, 72, 37.5, 'King', 15788),
(388, 9, 4, 1981, 915, 78, 36, 19.5, 'Single', 6552),
(389, 9, 5, 1981, 915, 78, 36, 19.5, 'Single', 8210),
(390, 9, 4, 1981, 1067, 78, 42, 22.75, 'Double', 7644),
(391, 9, 5, 1981, 1067, 78, 42, 22.75, 'Double', 9578),
(392, 9, 4, 1981, 1118, 78, 44, 24, 'Double', 8064),
(393, 9, 5, 1981, 1118, 78, 44, 24, 'Double', 10104),
(394, 9, 4, 1981, 1219, 78, 48, 26, 'Double', 8736),
(395, 9, 5, 1981, 1219, 78, 48, 26, 'Double', 10946),
(396, 9, 4, 1981, 1524, 78, 60, 32.5, 'Queen', 10920),
(397, 9, 5, 1981, 1524, 78, 60, 32.5, 'Queen', 13683),
(398, 9, 4, 1981, 1829, 78, 72, 39, 'King', 13104),
(399, 9, 5, 1981, 1829, 78, 72, 39, 'King', 16419),
(402, 10, 5, 1829, 915, 72, 36, 18, 'Single', 9324),
(403, 10, 6, 1829, 915, 72, 36, 18, 'Single', 11178),
(404, 10, 5, 1829, 1067, 72, 42, 21, 'Double', 10878),
(405, 10, 6, 1829, 1067, 72, 42, 21, 'Double', 13041),
(406, 10, 5, 1829, 1118, 72, 44, 22, 'Double', 11396),
(407, 10, 6, 1829, 1118, 72, 44, 22, 'Double', 13662),
(408, 10, 5, 1829, 1219, 72, 48, 24, 'Double', 12432),
(409, 10, 6, 1829, 1219, 72, 48, 24, 'Double', 14904),
(410, 10, 5, 1829, 1524, 72, 60, 30, 'Queen', 15540),
(411, 10, 6, 1829, 1524, 72, 60, 30, 'Queen', 18630),
(412, 10, 5, 1829, 1829, 72, 72, 36, 'King', 18648),
(413, 10, 6, 1829, 1829, 72, 72, 36, 'King', 22356),
(416, 10, 5, 1905, 915, 75, 36, 18.75, 'Single', 9713),
(417, 10, 6, 1905, 915, 75, 36, 18.75, 'Single', 11644),
(418, 10, 5, 1905, 1067, 75, 42, 21.88, 'Double', 11334),
(419, 10, 6, 1905, 1067, 75, 42, 21.88, 'Double', 13587),
(420, 10, 5, 1905, 1118, 75, 44, 23, 'Double', 11914),
(421, 10, 6, 1905, 1118, 75, 44, 23, 'Double', 14283),
(422, 10, 5, 1905, 1219, 75, 48, 25, 'Double', 12950),
(423, 10, 6, 1905, 1219, 75, 48, 25, 'Double', 15525),
(424, 10, 5, 1905, 1524, 75, 60, 31.25, 'Queen', 16188),
(425, 10, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 19406),
(426, 10, 5, 1905, 1829, 75, 72, 37.5, 'King', 19425),
(427, 10, 6, 1905, 1829, 75, 72, 37.5, 'King', 23288),
(430, 10, 5, 1981, 915, 78, 36, 19.5, 'Single', 10101),
(431, 10, 6, 1981, 915, 78, 36, 19.5, 'Single', 12110),
(432, 10, 5, 1981, 1067, 78, 42, 22.75, 'Double', 11785),
(433, 10, 6, 1981, 1067, 78, 42, 22.75, 'Double', 14128),
(434, 10, 5, 1981, 1118, 78, 44, 24, 'Double', 12432),
(435, 10, 6, 1981, 1118, 78, 44, 24, 'Double', 14904),
(436, 10, 5, 1981, 1219, 78, 48, 26, 'Double', 13468),
(437, 10, 6, 1981, 1219, 78, 48, 26, 'Double', 16146),
(438, 10, 5, 1981, 1524, 78, 60, 32.5, 'Queen', 16835),
(439, 10, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 20183),
(440, 10, 5, 1981, 1829, 78, 72, 39, 'King', 20202),
(441, 10, 6, 1981, 1829, 78, 72, 39, 'King', 24219),
(487, 12, 6, 1829, 915, 72, 36, 18, 'Single', 9144),
(488, 12, 8, 1829, 915, 72, 36, 18, 'Single', 10782),
(489, 12, 10, 1829, 915, 72, 36, 18, 'Single', 11340),
(490, 12, 6, 1829, 1067, 72, 42, 21, 'Double', 10668),
(491, 12, 8, 1829, 1067, 72, 42, 21, 'Double', 12579),
(492, 12, 10, 1829, 1067, 72, 42, 21, 'Double', 13230),
(493, 12, 6, 1829, 1219, 72, 48, 24, 'Double', 12192),
(494, 12, 8, 1829, 1219, 72, 48, 24, 'Double', 14376),
(495, 12, 10, 1829, 1219, 72, 48, 24, 'Double', 15120),
(496, 12, 6, 1829, 1524, 72, 60, 30, 'Queen', 15240),
(497, 12, 8, 1829, 1524, 72, 60, 30, 'Queen', 17970),
(498, 12, 10, 1829, 1524, 72, 60, 30, 'Queen', 18900),
(499, 12, 6, 1829, 1676, 72, 66, 33, 'Queen', 16764),
(500, 12, 8, 1829, 1676, 72, 66, 33, 'Queen', 19767),
(501, 12, 10, 1829, 1676, 72, 66, 33, 'Queen', 20790),
(502, 12, 6, 1829, 1829, 72, 72, 36, 'King', 18288),
(503, 12, 8, 1829, 1829, 72, 72, 36, 'King', 21564),
(504, 12, 10, 1829, 1829, 72, 72, 36, 'King', 22680),
(508, 12, 6, 1905, 915, 75, 36, 18.75, 'Single', 9525),
(509, 12, 8, 1905, 915, 75, 36, 18.75, 'Single', 11231),
(510, 12, 10, 1905, 915, 75, 36, 18.75, 'Single', 11813),
(511, 12, 6, 1905, 1067, 75, 42, 21.88, 'Double', 11115),
(512, 12, 8, 1905, 1067, 75, 42, 21.88, 'Double', 13106),
(513, 12, 10, 1905, 1067, 75, 42, 21.88, 'Double', 13784),
(514, 12, 6, 1905, 1219, 75, 48, 25, 'Double', 12700),
(515, 12, 8, 1905, 1219, 75, 48, 25, 'Double', 14975),
(516, 12, 10, 1905, 1219, 75, 48, 25, 'Double', 15750),
(517, 12, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 15875),
(518, 12, 8, 1905, 1524, 75, 60, 31.25, 'Queen', 18719),
(519, 12, 10, 1905, 1524, 75, 60, 31.25, 'Queen', 19688),
(520, 12, 6, 1905, 1676, 75, 66, 34.37, 'Queen', 17460),
(521, 12, 8, 1905, 1676, 75, 66, 34.37, 'Queen', 20588),
(522, 12, 10, 1905, 1676, 75, 66, 34.37, 'Queen', 21653),
(523, 12, 6, 1905, 1829, 75, 72, 37.5, 'King', 19050),
(524, 12, 8, 1905, 1829, 75, 72, 37.5, 'King', 22463),
(525, 12, 10, 1905, 1829, 75, 72, 37.5, 'King', 23625),
(529, 12, 6, 1981, 915, 78, 36, 19.5, 'Single', 9906),
(530, 12, 8, 1981, 915, 78, 36, 19.5, 'Single', 11681),
(531, 12, 10, 1981, 915, 78, 36, 19.5, 'Single', 12285),
(532, 12, 6, 1981, 1067, 78, 42, 22.75, 'Double', 11557),
(533, 12, 8, 1981, 1067, 78, 42, 22.75, 'Double', 13627),
(534, 12, 10, 1981, 1067, 78, 42, 22.75, 'Double', 14333),
(535, 12, 6, 1981, 1219, 78, 48, 26, 'Double', 13208),
(536, 12, 8, 1981, 1219, 78, 48, 26, 'Double', 15574),
(537, 12, 10, 1981, 1219, 78, 48, 26, 'Double', 16380),
(538, 12, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 16510),
(539, 12, 8, 1981, 1524, 78, 60, 32.5, 'Queen', 19468),
(540, 12, 10, 1981, 1524, 78, 60, 32.5, 'Queen', 20475),
(541, 12, 6, 1981, 1676, 78, 66, 35.75, 'Queen', 18161),
(542, 12, 8, 1981, 1676, 78, 66, 35.75, 'Queen', 21414),
(543, 12, 10, 1981, 1676, 78, 66, 35.75, 'Queen', 22523),
(544, 12, 6, 1981, 1829, 78, 72, 39, 'King', 19812),
(545, 12, 8, 1981, 1829, 78, 72, 39, 'King', 23361),
(546, 12, 10, 1981, 1829, 78, 72, 39, 'King', 24570),
(550, 13, 6, 1829, 915, 72, 36, 18, 'Single', 10530),
(551, 13, 8, 1829, 915, 72, 36, 18, 'Single', 11826),
(552, 13, 10, 1829, 915, 72, 36, 18, 'Single', 12762),
(553, 13, 6, 1829, 1067, 72, 42, 21, 'Double', 12285),
(554, 13, 8, 1829, 1067, 72, 42, 21, 'Double', 13797),
(555, 13, 10, 1829, 1067, 72, 42, 21, 'Double', 14889),
(556, 13, 6, 1829, 1219, 72, 48, 24, 'Double', 14040),
(557, 13, 8, 1829, 1219, 72, 48, 24, 'Double', 15768),
(558, 13, 10, 1829, 1219, 72, 48, 24, 'Double', 17016),
(559, 13, 6, 1829, 1524, 72, 60, 30, 'Queen', 17550),
(560, 13, 8, 1829, 1524, 72, 60, 30, 'Queen', 19710),
(561, 13, 10, 1829, 1524, 72, 60, 30, 'Queen', 21270),
(562, 13, 6, 1829, 1676, 72, 66, 33, 'Queen', 19305),
(563, 13, 8, 1829, 1676, 72, 66, 33, 'Queen', 21681),
(564, 13, 10, 1829, 1676, 72, 66, 33, 'Queen', 23397),
(565, 13, 6, 1829, 1829, 72, 72, 36, 'King', 21060),
(566, 13, 8, 1829, 1829, 72, 72, 36, 'King', 23652),
(567, 13, 10, 1829, 1829, 72, 72, 36, 'King', 25524),
(571, 13, 6, 1905, 915, 75, 36, 18.75, 'Single', 10969),
(572, 13, 8, 1905, 915, 75, 36, 18.75, 'Single', 12319),
(573, 13, 10, 1905, 915, 75, 36, 18.75, 'Single', 13294),
(574, 13, 6, 1905, 1067, 75, 42, 21.88, 'Double', 12800),
(575, 13, 8, 1905, 1067, 75, 42, 21.88, 'Double', 14375),
(576, 13, 10, 1905, 1067, 75, 42, 21.88, 'Double', 15513),
(577, 13, 6, 1905, 1219, 75, 48, 25, 'Double', 14625),
(578, 13, 8, 1905, 1219, 75, 48, 25, 'Double', 16425),
(579, 13, 10, 1905, 1219, 75, 48, 25, 'Double', 17725),
(580, 13, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 18281),
(581, 13, 8, 1905, 1524, 75, 60, 31.25, 'Queen', 20531),
(582, 13, 10, 1905, 1524, 75, 60, 31.25, 'Queen', 22156),
(583, 13, 6, 1905, 1676, 75, 66, 34.37, 'Queen', 20106),
(584, 13, 8, 1905, 1676, 75, 66, 34.37, 'Queen', 22581),
(585, 13, 10, 1905, 1676, 75, 66, 34.37, 'Queen', 24368),
(586, 13, 6, 1905, 1829, 75, 72, 37.5, 'King', 21938),
(587, 13, 8, 1905, 1829, 75, 72, 37.5, 'King', 24638),
(588, 13, 10, 1905, 1829, 75, 72, 37.5, 'King', 26588),
(592, 13, 6, 1981, 915, 78, 36, 19.5, 'Single', 11408),
(593, 13, 8, 1981, 915, 78, 36, 19.5, 'Single', 12812),
(594, 13, 10, 1981, 915, 78, 36, 19.5, 'Single', 13826),
(595, 13, 6, 1981, 1067, 78, 42, 22.75, 'Double', 13309),
(596, 13, 8, 1981, 1067, 78, 42, 22.75, 'Double', 14947),
(597, 13, 10, 1981, 1067, 78, 42, 22.75, 'Double', 16130),
(598, 13, 6, 1981, 1219, 78, 48, 26, 'Double', 15210),
(599, 13, 8, 1981, 1219, 78, 48, 26, 'Double', 17082),
(600, 13, 10, 1981, 1219, 78, 48, 26, 'Double', 18434),
(601, 13, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 19013),
(602, 13, 8, 1981, 1524, 78, 60, 32.5, 'Queen', 21353),
(603, 13, 10, 1981, 1524, 78, 60, 32.5, 'Queen', 23043),
(604, 13, 6, 1981, 1676, 78, 66, 35.75, 'Queen', 20914),
(605, 13, 8, 1981, 1676, 78, 66, 35.75, 'Queen', 23488),
(606, 13, 10, 1981, 1676, 78, 66, 35.75, 'Queen', 25347),
(607, 13, 6, 1981, 1829, 78, 72, 39, 'King', 22815),
(608, 13, 8, 1981, 1829, 78, 72, 39, 'King', 25623),
(609, 13, 10, 1981, 1829, 78, 72, 39, 'King', 27651),
(613, 14, 6, 1829, 915, 72, 36, 18, 'Single', 11412),
(614, 14, 8, 1829, 915, 72, 36, 18, 'Single', 14004),
(615, 14, 10, 1829, 915, 72, 36, 18, 'Single', 16308),
(616, 14, 6, 1829, 1067, 72, 42, 21, 'Double', 13314),
(617, 14, 8, 1829, 1067, 72, 42, 21, 'Double', 16338),
(618, 14, 10, 1829, 1067, 72, 42, 21, 'Double', 19026),
(619, 14, 6, 1829, 1219, 72, 48, 24, 'Double', 15216),
(620, 14, 8, 1829, 1219, 72, 48, 24, 'Double', 18672),
(621, 14, 10, 1829, 1219, 72, 48, 24, 'Double', 21744),
(622, 14, 6, 1829, 1524, 72, 60, 30, 'Queen', 19020),
(623, 14, 8, 1829, 1524, 72, 60, 30, 'Queen', 23340),
(624, 14, 10, 1829, 1524, 72, 60, 30, 'Queen', 27180),
(625, 14, 6, 1829, 1676, 72, 66, 33, 'Queen', 20922),
(626, 14, 8, 1829, 1676, 72, 66, 33, 'Queen', 25674),
(627, 14, 10, 1829, 1676, 72, 66, 33, 'Queen', 29898),
(628, 14, 6, 1829, 1829, 72, 72, 36, 'King', 22824),
(629, 14, 8, 1829, 1829, 72, 72, 36, 'King', 28008),
(630, 14, 10, 1829, 1829, 72, 72, 36, 'King', 32616),
(634, 14, 6, 1905, 915, 75, 36, 18.75, 'Single', 11888),
(635, 14, 8, 1905, 915, 75, 36, 18.75, 'Single', 14588),
(636, 14, 10, 1905, 915, 75, 36, 18.75, 'Single', 16988),
(637, 14, 6, 1905, 1067, 75, 42, 21.88, 'Double', 13872),
(638, 14, 8, 1905, 1067, 75, 42, 21.88, 'Double', 17023),
(639, 14, 10, 1905, 1067, 75, 42, 21.88, 'Double', 19823),
(640, 14, 6, 1905, 1219, 75, 48, 25, 'Double', 15850),
(641, 14, 8, 1905, 1219, 75, 48, 25, 'Double', 19450),
(642, 14, 10, 1905, 1219, 75, 48, 25, 'Double', 22650),
(643, 14, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 19813),
(644, 14, 8, 1905, 1524, 75, 60, 31.25, 'Queen', 24313),
(645, 14, 10, 1905, 1524, 75, 60, 31.25, 'Queen', 28313),
(646, 14, 6, 1905, 1676, 75, 66, 34.37, 'Queen', 21791),
(647, 14, 8, 1905, 1676, 75, 66, 34.37, 'Queen', 26740),
(648, 14, 10, 1905, 1676, 75, 66, 34.37, 'Queen', 31139),
(649, 14, 6, 1905, 1829, 75, 72, 37.5, 'King', 23775),
(650, 14, 8, 1905, 1829, 75, 72, 37.5, 'King', 29175),
(651, 14, 10, 1905, 1829, 75, 72, 37.5, 'King', 33975),
(655, 14, 6, 1981, 915, 78, 36, 19.5, 'Single', 12363),
(656, 14, 8, 1981, 915, 78, 36, 19.5, 'Single', 15171),
(657, 14, 10, 1981, 915, 78, 36, 19.5, 'Single', 17667),
(658, 14, 6, 1981, 1067, 78, 42, 22.75, 'Double', 14424),
(659, 14, 8, 1981, 1067, 78, 42, 22.75, 'Double', 17700),
(660, 14, 10, 1981, 1067, 78, 42, 22.75, 'Double', 20612),
(661, 14, 6, 1981, 1219, 78, 48, 26, 'Double', 16484),
(662, 14, 8, 1981, 1219, 78, 48, 26, 'Double', 20228),
(663, 14, 10, 1981, 1219, 78, 48, 26, 'Double', 23556),
(664, 14, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 20605),
(665, 14, 8, 1981, 1524, 78, 60, 32.5, 'Queen', 25285),
(666, 14, 10, 1981, 1524, 78, 60, 32.5, 'Queen', 29445),
(667, 14, 6, 1981, 1676, 78, 66, 35.75, 'Queen', 22666),
(668, 14, 8, 1981, 1676, 78, 66, 35.75, 'Queen', 27814),
(669, 14, 10, 1981, 1676, 78, 66, 35.75, 'Queen', 32390),
(670, 14, 6, 1981, 1829, 78, 72, 39, 'King', 24726),
(671, 14, 8, 1981, 1829, 78, 72, 39, 'King', 30342),
(672, 14, 10, 1981, 1829, 78, 72, 39, 'King', 35334),
(676, 15, 6, 1829, 915, 72, 36, 18, 'Single', 14778),
(677, 15, 8, 1829, 915, 72, 36, 18, 'Single', 18504),
(678, 15, 10, 1829, 915, 72, 36, 18, 'Single', 21870),
(679, 15, 6, 1829, 1067, 72, 42, 21, 'Double', 17241),
(680, 15, 8, 1829, 1067, 72, 42, 21, 'Double', 21588),
(681, 15, 10, 1829, 1067, 72, 42, 21, 'Double', 25515),
(682, 15, 6, 1829, 1219, 72, 48, 24, 'Double', 19704),
(683, 15, 8, 1829, 1219, 72, 48, 24, 'Double', 24672),
(684, 15, 10, 1829, 1219, 72, 48, 24, 'Double', 29160),
(685, 15, 6, 1829, 1524, 72, 60, 30, 'Queen', 24630),
(686, 15, 8, 1829, 1524, 72, 60, 30, 'Queen', 30840),
(687, 15, 10, 1829, 1524, 72, 60, 30, 'Queen', 36450),
(688, 15, 6, 1829, 1676, 72, 66, 33, 'Queen', 27093),
(689, 15, 8, 1829, 1676, 72, 66, 33, 'Queen', 33924),
(690, 15, 10, 1829, 1676, 72, 66, 33, 'Queen', 40095),
(691, 15, 6, 1829, 1829, 72, 72, 36, 'King', 29556),
(692, 15, 8, 1829, 1829, 72, 72, 36, 'King', 37008),
(693, 15, 10, 1829, 1829, 72, 72, 36, 'King', 43740),
(697, 15, 6, 1905, 915, 75, 36, 18.75, 'Single', 15394),
(698, 15, 8, 1905, 915, 75, 36, 18.75, 'Single', 19275),
(699, 15, 10, 1905, 915, 75, 36, 18.75, 'Single', 22781),
(700, 15, 6, 1905, 1067, 75, 42, 21.88, 'Double', 17963),
(701, 15, 8, 1905, 1067, 75, 42, 21.88, 'Double', 22493),
(702, 15, 10, 1905, 1067, 75, 42, 21.88, 'Double', 26584),
(703, 15, 6, 1905, 1219, 75, 48, 25, 'Double', 20525),
(704, 15, 8, 1905, 1219, 75, 48, 25, 'Double', 25700),
(705, 15, 10, 1905, 1219, 75, 48, 25, 'Double', 30375),
(706, 15, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 25656),
(707, 15, 8, 1905, 1524, 75, 60, 31.25, 'Queen', 32125),
(708, 15, 10, 1905, 1524, 75, 60, 31.25, 'Queen', 37969),
(709, 15, 6, 1905, 1676, 75, 66, 34.37, 'Queen', 28218),
(710, 15, 8, 1905, 1676, 75, 66, 34.37, 'Queen', 35332),
(711, 15, 10, 1905, 1676, 75, 66, 34.37, 'Queen', 41760),
(712, 15, 6, 1905, 1829, 75, 72, 37.5, 'King', 30788),
(713, 15, 8, 1905, 1829, 75, 72, 37.5, 'King', 38550),
(714, 15, 10, 1905, 1829, 75, 72, 37.5, 'King', 45563),
(718, 15, 6, 1981, 915, 78, 36, 19.5, 'Single', 16010),
(719, 15, 8, 1981, 915, 78, 36, 19.5, 'Single', 20046),
(720, 15, 10, 1981, 915, 78, 36, 19.5, 'Single', 23693),
(721, 15, 6, 1981, 1067, 78, 42, 22.75, 'Double', 18678),
(722, 15, 8, 1981, 1067, 78, 42, 22.75, 'Double', 23387),
(723, 15, 10, 1981, 1067, 78, 42, 22.75, 'Double', 27641),
(724, 15, 6, 1981, 1219, 78, 48, 26, 'Double', 21346),
(725, 15, 8, 1981, 1219, 78, 48, 26, 'Double', 26728),
(726, 15, 10, 1981, 1219, 78, 48, 26, 'Double', 31590),
(727, 15, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 26683),
(728, 15, 8, 1981, 1524, 78, 60, 32.5, 'Queen', 33410),
(729, 15, 10, 1981, 1524, 78, 60, 32.5, 'Queen', 39488),
(730, 15, 6, 1981, 1676, 78, 66, 35.75, 'Queen', 29351),
(731, 15, 8, 1981, 1676, 78, 66, 35.75, 'Queen', 36751),
(732, 15, 10, 1981, 1676, 78, 66, 35.75, 'Queen', 43436),
(733, 15, 6, 1981, 1829, 78, 72, 39, 'King', 32019),
(734, 15, 8, 1981, 1829, 78, 72, 39, 'King', 40092),
(735, 15, 10, 1981, 1829, 78, 72, 39, 'King', 47385),
(738, 16, 6, 1829, 915, 72, 36, 18, 'Single', 20016),
(739, 16, 8, 1829, 915, 72, 36, 18, 'Single', 23832),
(740, 16, 6, 1829, 1067, 72, 42, 21, 'Double', 23352),
(741, 16, 8, 1829, 1067, 72, 42, 21, 'Double', 27804),
(742, 16, 6, 1829, 1219, 72, 48, 24, 'Double', 26688),
(743, 16, 8, 1829, 1219, 72, 48, 24, 'Double', 31776),
(744, 16, 6, 1829, 1524, 72, 60, 30, 'Queen', 33360),
(745, 16, 8, 1829, 1524, 72, 60, 30, 'Queen', 39720),
(746, 16, 6, 1829, 1676, 72, 66, 33, 'Queen', 36696),
(747, 16, 8, 1829, 1676, 72, 66, 33, 'Queen', 43692),
(748, 16, 6, 1829, 1829, 72, 72, 36, 'King', 40032),
(749, 16, 8, 1829, 1829, 72, 72, 36, 'King', 47664),
(752, 16, 6, 1905, 915, 75, 36, 18.75, 'Single', 20850),
(753, 16, 8, 1905, 915, 75, 36, 18.75, 'Single', 24825),
(754, 16, 6, 1905, 1067, 75, 42, 21.88, 'Double', 24331),
(755, 16, 8, 1905, 1067, 75, 42, 21.88, 'Double', 28969),
(756, 16, 6, 1905, 1219, 75, 48, 25, 'Double', 27800),
(757, 16, 8, 1905, 1219, 75, 48, 25, 'Double', 33100),
(758, 16, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 34750),
(759, 16, 8, 1905, 1524, 75, 60, 31.25, 'Queen', 41375),
(760, 16, 6, 1905, 1676, 75, 66, 34.37, 'Queen', 38219),
(761, 16, 8, 1905, 1676, 75, 66, 34.37, 'Queen', 45506),
(762, 16, 6, 1905, 1829, 75, 72, 37.5, 'King', 41700),
(763, 16, 8, 1905, 1829, 75, 72, 37.5, 'King', 49650),
(766, 16, 6, 1981, 915, 78, 36, 19.5, 'Single', 21684),
(767, 16, 8, 1981, 915, 78, 36, 19.5, 'Single', 25818),
(768, 16, 6, 1981, 1067, 78, 42, 22.75, 'Double', 25298),
(769, 16, 8, 1981, 1067, 78, 42, 22.75, 'Double', 30121),
(770, 16, 6, 1981, 1219, 78, 48, 26, 'Double', 28912),
(771, 16, 8, 1981, 1219, 78, 48, 26, 'Double', 34424),
(772, 16, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 36140),
(773, 16, 8, 1981, 1524, 78, 60, 32.5, 'Queen', 43030),
(774, 16, 6, 1981, 1676, 78, 66, 35.75, 'Queen', 39754),
(775, 16, 8, 1981, 1676, 78, 66, 35.75, 'Queen', 47333),
(776, 16, 6, 1981, 1829, 78, 72, 39, 'King', 43368),
(777, 16, 8, 1981, 1829, 78, 72, 39, 'King', 51636),
(843, 11, 6, 1829, 915, 72, 36, 18, 'Single', 20538),
(844, 11, 8, 1829, 915, 72, 36, 18, 'Single', 25686),
(849, 11, 6, 1829, 1219, 72, 48, 24, 'Double', 27384),
(850, 11, 8, 1829, 1219, 72, 48, 24, 'Double', 34248),
(851, 11, 6, 1829, 1524, 72, 60, 30, 'Queen', 34230),
(852, 11, 8, 1829, 1524, 72, 60, 30, 'Queen', 42810),
(853, 11, 6, 1829, 1829, 72, 72, 36, 'King', 41076),
(854, 11, 8, 1829, 1829, 72, 72, 36, 'King', 51372),
(857, 11, 6, 1905, 915, 75, 36, 18.75, 'Single', 21394),
(858, 11, 8, 1905, 915, 75, 36, 18.75, 'Single', 26756),
(863, 11, 6, 1905, 1219, 75, 48, 25, 'Double', 28525),
(864, 11, 8, 1905, 1219, 75, 48, 25, 'Double', 35675),
(865, 11, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 35656),
(866, 11, 8, 1905, 1524, 75, 60, 31.25, 'Queen', 44594),
(867, 11, 6, 1905, 1829, 75, 72, 37.5, 'King', 42788),
(868, 11, 8, 1905, 1829, 75, 72, 37.5, 'King', 53513),
(871, 11, 6, 1981, 915, 78, 36, 19.5, 'Single', 22250),
(872, 11, 8, 1981, 915, 78, 36, 19.5, 'Single', 27827),
(877, 11, 6, 1981, 1219, 78, 48, 26, 'Double', 29666),
(878, 11, 8, 1981, 1219, 78, 48, 26, 'Double', 37102),
(879, 11, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 37083),
(880, 11, 8, 1981, 1524, 78, 60, 32.5, 'Queen', 46378),
(881, 11, 6, 1981, 1829, 78, 72, 39, 'King', 44499),
(882, 11, 8, 1981, 1829, 78, 72, 39, 'King', 55653),
(885, 25, 5, 1829, 915, 72, 36, 18, 'Single', 15174),
(886, 25, 6, 1829, 915, 72, 36, 18, 'Single', 18198),
(887, 25, 5, 1829, 1067, 72, 42, 21, 'Double', 17703),
(888, 25, 6, 1829, 1067, 72, 42, 21, 'Double', 21231),
(889, 25, 5, 1829, 1219, 72, 48, 24, 'Double', 20232),
(890, 25, 6, 1829, 1219, 72, 48, 24, 'Double', 24264),
(891, 25, 5, 1829, 1524, 72, 60, 30, 'Queen', 25290),
(892, 25, 6, 1829, 1524, 72, 60, 30, 'Queen', 30330),
(893, 25, 5, 1829, 1676, 72, 66, 33, 'Queen', 27819),
(894, 25, 6, 1829, 1676, 72, 66, 33, 'Queen', 33363),
(895, 25, 5, 1829, 1829, 72, 72, 36, 'King', 30348),
(896, 25, 6, 1829, 1829, 72, 72, 36, 'King', 36396),
(899, 25, 5, 1905, 915, 75, 36, 18.75, 'Single', 15806),
(900, 25, 6, 1905, 915, 75, 36, 18.75, 'Single', 18956),
(901, 25, 5, 1905, 1067, 75, 42, 21.88, 'Double', 18445),
(902, 25, 6, 1905, 1067, 75, 42, 21.88, 'Double', 22121),
(903, 25, 5, 1905, 1219, 75, 48, 25, 'Double', 21075),
(904, 25, 6, 1905, 1219, 75, 48, 25, 'Double', 25275),
(905, 25, 5, 1905, 1524, 75, 60, 31.25, 'Queen', 26344),
(906, 25, 6, 1905, 1524, 75, 60, 31.25, 'Queen', 31594),
(907, 25, 5, 1905, 1676, 75, 66, 34.37, 'Queen', 28974),
(908, 25, 6, 1905, 1676, 75, 66, 34.37, 'Queen', 34748),
(909, 25, 5, 1905, 1829, 75, 72, 37.5, 'King', 31613),
(910, 25, 6, 1905, 1829, 75, 72, 37.5, 'King', 37913),
(913, 25, 5, 1981, 915, 78, 36, 19.5, 'Single', 16439),
(914, 25, 6, 1981, 915, 78, 36, 19.5, 'Single', 19715),
(915, 25, 5, 1981, 1067, 78, 42, 22.75, 'Double', 19178),
(916, 25, 6, 1981, 1067, 78, 42, 22.75, 'Double', 23000),
(917, 25, 5, 1981, 1219, 78, 48, 26, 'Double', 21918),
(918, 25, 6, 1981, 1219, 78, 48, 26, 'Double', 26286),
(919, 25, 5, 1981, 1524, 78, 60, 32.5, 'Queen', 27398),
(920, 25, 6, 1981, 1524, 78, 60, 32.5, 'Queen', 32858),
(921, 25, 5, 1981, 1676, 78, 66, 35.75, 'Queen', 30137),
(922, 25, 6, 1981, 1676, 78, 66, 35.75, 'Queen', 36143),
(923, 25, 5, 1981, 1829, 78, 72, 39, 'King', 32877),
(924, 25, 6, 1981, 1829, 78, 72, 39, 'King', 39429),
(926, 26, 5, 1829, 915, 72, 36, 18, 'Single', 15696),
(927, 26, 5, 1829, 1067, 72, 42, 21, 'Double', 18312),
(928, 26, 5, 1829, 1219, 72, 48, 24, 'Double', 20928),
(929, 26, 5, 1829, 1524, 72, 60, 30, 'Queen', 26160),
(930, 26, 5, 1829, 1676, 72, 66, 33, 'Queen', 28776),
(931, 26, 5, 1829, 1829, 72, 72, 36, 'King', 31392),
(933, 26, 5, 1905, 915, 75, 36, 18.75, 'Single', 16350),
(934, 26, 5, 1905, 1067, 75, 42, 21.88, 'Double', 19079),
(935, 26, 5, 1905, 1219, 75, 48, 25, 'Double', 21799),
(936, 26, 5, 1905, 1524, 75, 60, 31.25, 'Queen', 27250),
(937, 26, 5, 1905, 1676, 75, 66, 34.37, 'Queen', 29971),
(938, 26, 5, 1905, 1829, 75, 72, 37.5, 'King', 32699),
(940, 26, 5, 1981, 915, 78, 36, 19.5, 'Single', 17004),
(941, 26, 5, 1981, 1067, 78, 42, 22.75, 'Double', 19838),
(942, 26, 5, 1981, 1219, 78, 48, 26, 'Double', 22672),
(943, 26, 5, 1981, 1524, 78, 60, 32.5, 'Queen', 28340),
(944, 26, 5, 1981, 1676, 78, 66, 35.75, 'Queen', 31174),
(945, 26, 5, 1981, 1829, 78, 72, 39, 'King', 34008),
(947, 27, 5, 1829, 915, 72, 36, 18, 'Single', 28602),
(949, 27, 5, 1829, 1219, 72, 48, 24, 'Double', 38136),
(950, 27, 5, 1829, 1524, 72, 60, 30, 'Queen', 47670),
(951, 27, 5, 1829, 1676, 72, 66, 33, 'Queen', 52437),
(952, 27, 5, 1829, 1829, 72, 72, 36, 'King', 57204),
(954, 27, 5, 1905, 915, 75, 36, 18.75, 'Single', 29794),
(956, 27, 5, 1905, 1219, 75, 48, 25, 'Double', 39725),
(957, 27, 5, 1905, 1524, 75, 60, 31.25, 'Queen', 49656),
(958, 27, 5, 1905, 1676, 75, 66, 34.37, 'Queen', 54614),
(959, 27, 5, 1905, 1829, 75, 72, 37.5, 'King', 59588),
(961, 27, 5, 1981, 915, 78, 36, 19.5, 'Single', 30986),
(963, 27, 5, 1981, 1219, 78, 48, 26, 'Double', 41314),
(964, 27, 5, 1981, 1524, 78, 60, 32.5, 'Queen', 51643),
(965, 27, 5, 1981, 1676, 78, 66, 35.75, 'Queen', 56807),
(966, 27, 5, 1981, 1829, 78, 72, 39, 'King', 61971),
(983, 29, 8, 1829, 915, 72, 36, 18, 'Single', 20989),
(984, 29, 8, 1829, 1219, 72, 48, 18, 'Double', 25989),
(985, 29, 8, 1829, 1524, 72, 60, 18, 'Queen', 29989),
(986, 29, 8, 1829, 1829, 72, 72, 18, 'King', 35989),
(987, 29, 8, 1905, 915, 75, 36, 18, 'Single', 20989),
(988, 29, 8, 1905, 1219, 75, 48, 18, 'Double', 25989),
(989, 29, 8, 1905, 1524, 75, 60, 18, 'Queen', 29989),
(990, 29, 8, 1905, 1829, 75, 72, 18, 'King', 35989),
(991, 29, 8, 1981, 915, 78, 36, 18, 'Single', 20989),
(992, 29, 8, 1981, 1219, 78, 48, 18, 'Double', 25989),
(993, 29, 8, 1981, 1524, 78, 60, 18, 'Queen', 29989),
(994, 29, 8, 1981, 1829, 78, 72, 18, 'King', 35989),
(995, 30, 6, 1829, 915, 72, 36, 18, 'Single', 33989),
(996, 30, 6, 1829, 1219, 72, 48, 18, 'Double', 44989),
(997, 30, 6, 1829, 1524, 72, 60, 18, 'Queen', 52989),
(998, 30, 6, 1829, 1829, 72, 72, 18, 'King', 61989),
(999, 30, 6, 1905, 915, 75, 36, 18, 'Single', 33989),
(1000, 30, 6, 1905, 1219, 75, 48, 18, 'Double', 44989),
(1001, 30, 6, 1905, 1524, 75, 60, 18, 'Queen', 52989),
(1002, 30, 6, 1905, 1829, 75, 72, 18, 'King', 61989),
(1003, 30, 6, 1981, 915, 78, 36, 18, 'Single', 33989),
(1004, 30, 6, 1981, 1219, 78, 48, 18, 'Double', 44989),
(1005, 30, 6, 1981, 1524, 78, 60, 18, 'Queen', 52989),
(1006, 30, 6, 1981, 1829, 78, 72, 18, 'King', 61989),
(1043, 31, 6, 1829, 915, 72, 36, 18, 'Single', 17989),
(1044, 31, 6, 1829, 1219, 72, 48, 18, 'Double', 21989),
(1045, 31, 6, 1829, 1524, 72, 60, 18, 'Queen', 24989),
(1046, 31, 6, 1829, 1829, 72, 72, 18, 'King', 29989),
(1047, 31, 6, 1905, 915, 75, 36, 18, 'Single', 17989),
(1048, 31, 6, 1905, 1219, 75, 48, 18, 'Double', 21989),
(1049, 31, 6, 1905, 1524, 75, 60, 18, 'Queen', 24989),
(1050, 31, 6, 1905, 1829, 75, 72, 18, 'King', 29989),
(1051, 31, 6, 1981, 915, 78, 36, 18, 'Single', 17989),
(1052, 31, 6, 1981, 1219, 78, 48, 18, 'Double', 21989),
(1053, 31, 6, 1981, 1524, 78, 60, 18, 'Queen', 24989),
(1054, 31, 6, 1981, 1829, 78, 72, 18, 'King', 29989),
(1055, 31, 8, 1829, 915, 72, 36, 18, 'Single', 21989),
(1056, 31, 8, 1829, 1219, 72, 48, 18, 'Double', 26989),
(1057, 31, 8, 1829, 1524, 72, 60, 18, 'Queen', 30989),
(1058, 31, 8, 1829, 1829, 72, 72, 18, 'King', 36989),
(1059, 31, 8, 1905, 915, 75, 36, 18, 'Single', 21989),
(1060, 31, 8, 1905, 1219, 75, 48, 18, 'Double', 26989),
(1061, 31, 8, 1905, 1524, 75, 60, 18, 'Queen', 30989),
(1062, 31, 8, 1905, 1829, 75, 72, 18, 'King', 36989),
(1063, 31, 8, 1981, 915, 78, 36, 18, 'Single', 21989),
(1064, 31, 8, 1981, 1219, 78, 48, 18, 'Double', 26989),
(1065, 31, 8, 1981, 1524, 78, 60, 18, 'Queen', 30989),
(1066, 31, 8, 1981, 1829, 78, 72, 18, 'King', 36989);

-- --------------------------------------------------------

--
-- Table structure for table `product_specification`
--

CREATE TABLE `product_specification` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `label_name` varchar(255) NOT NULL,
  `label_value` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_specification`
--

INSERT INTO `product_specification` (`id`, `product_id`, `label_name`, `label_value`, `sort_order`) VALUES
(1, 12, 'Mattress Feel', 'Soft on all sides', 1),
(2, 12, 'Mattress Material', 'Bonnell spring with PU super soft foam', 2),
(3, 12, 'Cover Material', 'Woven jacquard fabric', 3),
(4, 12, 'Warranty', '5  years warranty', 4),
(5, 12, 'Mattress Usability', 'Usable on both sides', 5),
(6, 12, 'Cover Type', 'Non-removable cover', 6),
(7, 12, 'Construction', 'Tight Top', 7),
(8, 13, 'Mattress Feel', 'Soft on all sides', 1),
(9, 13, 'Mattress Material', 'Bonnell spring with PU Super Soft foam', 2),
(10, 13, 'Cover Material', 'Woven jacquard fabric ', 3),
(11, 13, 'Warranty', '5 Years warranty', 4),
(12, 13, 'Mattress Usability', 'Usable on both sides ', 5),
(13, 13, 'Cover Type', 'Non-removable cover', 6),
(14, 13, 'Construction', 'Pillow Top', 7),
(15, 16, 'Mattress Feel', 'Soft and firm', 1),
(16, 16, 'Mattress Material', 'Bonnel Spring with Memory Foam', 2),
(17, 16, 'Cover Material', 'Treated Knitted fabric', 3),
(18, 16, 'Warranty', '10 Years warranty', 4),
(19, 16, 'Mattress Usability', 'Usable on single side', 5),
(22, 1, 'Mattress Feel', 'Soft yet quite firm on all the sides giving a balanced comfort', 1),
(23, 1, 'Mattress Material', 'Pocketed spring and PU Super Soft layer', 2),
(24, 1, 'Cover Material', 'Melange Knitted Fabric ', 3),
(25, 1, 'Warranty', '5 Years warranty', 4),
(26, 1, 'Mattress Usability', 'Usable on both sides ', 5),
(27, 1, 'Cover Type', 'Non-removable cover', 6),
(28, 1, 'Construction', 'Tight Top', 7),
(29, 2, 'Mattress Feel', 'Soft yet quite firm on all the sides giving a balanced comfort', 1),
(30, 2, 'Mattress Material', 'Pocketed spring and PU Super Soft layer', 2),
(31, 2, 'Cover Material', 'Melange Knitted Fabric ', 3),
(32, 2, 'Warranty', '5 Years warranty', 4),
(33, 2, 'Mattress Usability', 'Usable on single side', 5),
(34, 2, 'Cover Type', 'Non-removable cover', 6),
(35, 2, 'Construction', 'Pillow Top', 7),
(36, 3, 'Mattress Feel', 'Smooth and silky, the mattress feels really soft and comfortable', 1),
(37, 3, 'Mattress Material', 'Pocketed spring with special tuff quilt on natural latex', 2),
(38, 3, 'Cover Material', 'Viscose knitted fabric ', 3),
(39, 3, 'Warranty', '10 Years warranty', 4),
(40, 3, 'Mattress Usability', 'Usable on single side', 5),
(41, 3, 'Cover Type', 'Non-removable cover', 6),
(42, 3, 'Construction', 'Box Top', 7),
(43, 4, 'Mattress Feel', 'Smooth , premium ,and ROYAL', 1),
(44, 4, 'Mattress Material', 'Pocketed spring with both Memory and Latex Foam', 2),
(45, 4, 'Cover Material', 'Viscose knitted fabric with dual top stitch', 3),
(46, 4, 'Warranty', '10 Years warranty', 4),
(47, 4, 'Mattress Usability', 'Usable on Single side', 5),
(48, 4, 'Cover Type', 'Non-removable cover', 6),
(49, 4, 'Construction', 'Dual Top', 7),
(50, 5, 'Mattress Feel', 'Smooth,  and bouncy on all the sides', 1),
(51, 5, 'Mattress Material', 'High density coir with HD PU foam', 2),
(52, 5, 'Cover Material', 'Twill weaving fabric', 3),
(53, 5, 'Warranty', '24 Months warranty ', 4),
(54, 5, 'Mattress Usability', 'Usable on Single side', 5),
(55, 5, 'Cover Type', 'Non-removable cover', 6),
(56, 6, 'Mattress Feel', 'Medium soft', 1),
(57, 6, 'Mattress Material', 'High density coir with super soft foam', 2),
(58, 6, 'Cover Material', 'Satin weave viscose fabric', 3),
(59, 6, 'Warranty', '24 Months warranty ', 4),
(60, 6, 'Mattress Usability', 'Usable on Single side', 5),
(61, 6, 'Cover Type', 'Non-removable cover', 6),
(62, 7, 'Mattress Feel', 'Medium soft', 1),
(63, 7, 'Mattress Material', 'High density coir with HD super soft foam', 2),
(64, 7, 'Cover Material', 'Woven jacquard fabric', 3),
(65, 7, 'Warranty', '36 Months warranty ', 4),
(66, 7, 'Mattress Usability', 'Usable on Single side', 5),
(67, 7, 'Cover Type', 'Non-removable cover', 6),
(68, 8, 'Mattress Feel', 'Medium soft', 1),
(69, 8, 'Mattress Material', 'High density coir with with bonded and hd super soft foam', 2),
(70, 8, 'Cover Material', 'Euro top stitch with treated fabric', 3),
(71, 8, 'Warranty', '36 Months warranty ', 4),
(72, 8, 'Mattress Usability', 'Usable on Single side', 5),
(73, 8, 'Cover Type', 'Non-removable cover', 6),
(74, 9, 'Mattress Feel', 'Soft and premium', 1),
(75, 9, 'Mattress Material', 'HD PU foam with quilt PU foam', 2),
(76, 9, 'Cover Material', 'Treated Knitted fabric', 3),
(77, 9, 'Warranty', '2 Years warranty', 4),
(78, 9, 'Mattress Usability', 'Usable on Single side', 5),
(79, 9, 'Cover Type', 'Non-removable cover', 6),
(80, 10, 'Mattress Feel', 'Soft and comfortable ', 1),
(81, 10, 'Mattress Material', 'HD PU foam and Super Soft Foam Layer', 2),
(82, 10, 'Cover Material', 'Treated Knitted fabric', 3),
(83, 10, 'Warranty', '3 Years warranty', 4),
(84, 10, 'Mattress Usability', 'Usable on single side', 5),
(85, 10, 'Cover Type', 'Non-removable cover', 6),
(86, 11, 'Mattress Feel', 'Soft and firm', 1),
(87, 11, 'Mattress Material', 'High density PU foam with memory foam', 2),
(88, 11, 'Cover Material', 'Euro top stitch', 3),
(89, 11, 'Warranty', '5 Years warranty', 4),
(90, 11, 'Mattress Usability', 'Usable on single side', 5),
(91, 11, 'Cover Type', 'Non-removable cover', 6),
(92, 14, 'Mattress Feel', 'Super soft on all sides', 1),
(93, 14, 'Mattress Material', 'Bonnell spring with PU super soft foam', 2),
(94, 14, 'Cover Material', 'GSM Knitted Fabric', 3),
(95, 14, 'Warranty', '5 Years warranty', 4),
(96, 14, 'Mattress Usability', 'Usable on both sides ', 5),
(97, 14, 'Cover Type', 'Non-removable cover', 6),
(98, 14, 'Construction', 'Tight Top', 7),
(99, 15, 'Mattress Feel', 'Soft and smooth on all sides', 1),
(100, 15, 'Mattress Material', 'Bonnell spring with PU super soft foam', 2),
(101, 15, 'Cover Material', 'GSM Knitted Fabric', 3),
(102, 15, 'Warranty', '5 Years warranty', 4),
(103, 15, 'Mattress Usability', 'Usable on Single side', 5),
(104, 15, 'Cover Type', 'Non-removable cover', 6),
(105, 15, 'Construction', 'Euro Top', 7),
(106, 25, 'Mattress Feel', 'Soft and firm', 1),
(107, 26, 'Mattress Feel', 'Soft and firm', 1),
(108, 27, 'Mattress Feel', 'Soft and firm', 1),
(109, 25, 'Mattress Material', 'Bonded foam with memory foam', 2),
(110, 26, 'Mattress Material', 'High density PU Foam with HD memory foam', 2),
(111, 27, 'Mattress Material', 'Latex', 2),
(112, 25, 'Cover Material', 'Treated Knitted fabric', 3),
(113, 26, 'Cover Material', 'Treated Knitted fabric', 3),
(114, 27, 'Cover Material', 'Treated Knitted fabric', 3),
(115, 25, 'Warranty', '10 Years warranty', 4),
(116, 26, 'Warranty', '10 Years warranty', 4),
(117, 27, 'Warranty', '10 Years warranty', 4),
(118, 25, 'Mattress Usability', 'Usable on single side', 5),
(119, 26, 'Mattress Usability', 'Usable on single side', 5),
(120, 27, 'Mattress Usability', 'Usable on single side', 5),
(122, 29, 'Mattress Material', 'Oeko Tex ,Eco institute certified Natural latex with Pocketed Spring.', 2),
(123, 29, 'Cover Material', 'Cotton Knitted Fabric with 1\" Pure Cotton Wading', 3),
(124, 29, 'Warranty', '10 years', 4),
(125, 29, 'Mattress Usability', 'Single side', 5),
(126, 29, 'Cover Type', 'Non-removable', 6),
(128, 30, 'Mattress Material', 'Oeko Tex ,Eco institute certified 6\" 90 D Pincore Natural Latex.', 2),
(129, 30, 'Cover Material', 'Cotton ', 3),
(130, 30, 'Warranty', '10 years', 4),
(131, 30, 'Mattress Usability', 'Single side', 5),
(132, 30, 'Cover Type', 'Washable Zipper Cover', 6),
(134, 31, 'Mattress Material', 'Oeko Tex ,Eco institute certified Natural latex with HR Foam ', 2),
(135, 31, 'Cover Material', 'Cotton ', 3),
(136, 31, 'Warranty', '10 years', 4),
(137, 31, 'Mattress Usability', 'Single side', 5),
(138, 31, 'Cover Type', 'Washable Zipper Cover', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pu_admin`
--

CREATE TABLE `pu_admin` (
  `admin_id` int(11) NOT NULL,
  `personname` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` text NOT NULL,
  `phone_no` varchar(30) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `job_postition` varchar(50) NOT NULL,
  `join_date` date NOT NULL,
  `username` varchar(225) NOT NULL,
  `userpassword` varchar(225) NOT NULL,
  `date_added` datetime NOT NULL,
  `password_modify` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category` enum('primary_admin','employee','secondary_admin') NOT NULL DEFAULT 'employee',
  `branch` int(11) NOT NULL,
  `userrole` int(11) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pu_admin`
--

INSERT INTO `pu_admin` (`admin_id`, `personname`, `gender`, `address`, `phone_no`, `emailid`, `job_postition`, `join_date`, `username`, `userpassword`, `date_added`, `password_modify`, `category`, `branch`, `userrole`, `last_login`) VALUES
(8, 'Admin', '', '', '', '', '', '0000-00-00', 'webmaster', '533078acd91fffef2a525239de4a3dc9', '0000-00-00 00:00:00', '2021-05-01 08:22:41', 'primary_admin', 0, 0, '2018-06-13 07:46:07'),
(5, 'Navaneethan', 'male', '48 handhi raod, tirupur', '9384884839', 'arasdf@asf.com', 'Accounts', '0000-00-00', 'nava', '533078acd91fffef2a525239de4a3dc9', '2018-08-24 12:41:50', '2021-05-01 08:08:55', 'employee', 2, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pu_slider`
--

CREATE TABLE `pu_slider` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `sub_heading` varchar(50) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pu_slider`
--

INSERT INTO `pu_slider` (`id`, `image_path`, `heading`, `sub_heading`, `sort_order`) VALUES
(14, '3787_1a.jpg', '', '', 1),
(15, '7520_1.jpg', '', '', 2),
(16, '8489_2.jpg', '', '', 3),
(17, '5352_3.jpg', '', '', 4),
(18, '4093_4.jpg', '', '', 5),
(19, '3732_5.jpg', '', '', 6),
(20, '5026_6.jpg', '', '', 7),
(21, '7188_7.jpg', '', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `subscription_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `mobileno`, `emailid`, `subscription_date`) VALUES
(1, '9566330303', '', '2020-07-08 13:19:23'),
(2, '', 'techaveo@gmail.com', '2020-07-08 13:20:59'),
(3, '9791768066', '', '2020-07-27 13:21:59'),
(4, '9043200416', '', '2020-07-30 21:42:46'),
(5, '7200785782', '', '2020-08-11 01:42:04'),
(6, '', 'vakkilpandi@gmail.com', '2020-08-15 13:27:49'),
(7, '9488456136', '', '2020-08-15 16:45:40'),
(8, '', 'ajar2791@gmail.com', '2020-08-15 18:04:53'),
(9, '9677378582', '', '2020-08-16 00:12:00'),
(10, '7358633446', '', '2020-08-17 11:34:59'),
(11, '', 'sksullah@gmail.com', '2020-08-17 11:35:06'),
(12, '9944289100', '', '2020-08-21 09:33:13'),
(13, '9790117171', '', '2020-09-08 17:49:46'),
(14, '', 'ponthu1959@gmail.com', '2020-09-11 22:26:52'),
(15, '8608349335', '', '2020-09-27 22:42:41'),
(16, '9443966085', '', '2020-10-25 12:11:18'),
(17, '9951776753', '', '2020-10-31 19:27:54'),
(18, '', 'smanick2020@gmail.com', '2020-11-13 19:55:30'),
(19, '', 'thnthulid@gmail.com ', '2020-11-16 15:51:23'),
(20, '9600603819', '', '2020-11-17 17:53:46'),
(21, '9894192946', '', '2020-12-07 20:25:11'),
(22, '8807156889', '', '2020-12-15 11:36:24'),
(23, '7904055301', '', '2020-12-15 22:33:03'),
(24, '', 'subashvck143@gamil.com', '2021-01-14 20:54:30'),
(25, '9842261637', '', '2021-01-19 20:47:09'),
(26, '8682970977', '', '2021-01-28 11:57:58'),
(27, '9966689725', '', '2021-01-28 12:34:47'),
(28, '7053553838', '', '2021-01-28 19:44:42'),
(29, '', 'shersinghaad@gmail.com', '2021-01-29 08:16:19'),
(30, '9993440074', '', '2021-01-29 12:56:44'),
(31, '', 'harija1147@gmail.com', '2021-02-04 16:20:45'),
(32, '', 'dmveluseo@gmail.com', '2021-02-18 15:20:12'),
(33, '9962332297', '', '2021-03-10 15:39:26'),
(34, '9865022299', '', '2021-03-12 02:06:38'),
(35, '', 'MahendranP1988@gmail.com', '2021-03-24 19:56:28'),
(36, '9789507425', '', '2021-04-29 08:44:56'),
(37, '', 'dr.suriyaprakash16393@gmail.com', '2021-04-30 00:56:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `miscellaneous`
--
ALTER TABLE `miscellaneous`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_dimension`
--
ALTER TABLE `product_dimension`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_free`
--
ALTER TABLE `product_free`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_free_cost`
--
ALTER TABLE `product_free_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_specification`
--
ALTER TABLE `product_specification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pu_admin`
--
ALTER TABLE `pu_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `pu_slider`
--
ALTER TABLE `pu_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `miscellaneous`
--
ALTER TABLE `miscellaneous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100389;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_dimension`
--
ALTER TABLE `product_dimension`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_free`
--
ALTER TABLE `product_free`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_free_cost`
--
ALTER TABLE `product_free_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1067;

--
-- AUTO_INCREMENT for table `product_specification`
--
ALTER TABLE `product_specification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `pu_admin`
--
ALTER TABLE `pu_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pu_slider`
--
ALTER TABLE `pu_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
