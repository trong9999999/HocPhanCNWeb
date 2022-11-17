-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 07:18 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(150) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminID`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'trong', 'trongadmin', 'trong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(23, 'trung', 'trung', 'trung@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(3, 'Royal Canin'),
(4, 'Không');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `ssId` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `status_cart` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `ssId`, `quantity`, `customer_id`, `productId`, `status_cart`) VALUES
(207, 'd8ughjsfbsof732mkbuvkj1uop', 4, 3, 33, 1),
(208, 'd8ughjsfbsof732mkbuvkj1uop', 7, 3, 21, 1),
(209, 'd8ughjsfbsof732mkbuvkj1uop', 5, 9, 33, 1),
(210, 'd8ughjsfbsof732mkbuvkj1uop', 3, 9, 27, 1),
(211, 'd8ughjsfbsof732mkbuvkj1uop', 1, 3, 22, 1),
(213, 'd8ughjsfbsof732mkbuvkj1uop', 1, 3, 21, 1),
(214, 'd8ughjsfbsof732mkbuvkj1uop', 1, 3, 23, 1),
(215, 'd8ughjsfbsof732mkbuvkj1uop', 1, 3, 21, 1),
(216, 'l7etaog27vs13ttgi15kitrdd8', 3, 0, 21, 1),
(217, 'l7etaog27vs13ttgi15kitrdd8', 4, 0, 27, 1),
(218, 'l7etaog27vs13ttgi15kitrdd8', 2, 9, 27, 1),
(219, 'l7etaog27vs13ttgi15kitrdd8', 1, 9, 34, 1),
(220, 'l7etaog27vs13ttgi15kitrdd8', 1, 9, 22, 1),
(221, 'l7etaog27vs13ttgi15kitrdd8', 1, 9, 27, 1),
(222, 'l7etaog27vs13ttgi15kitrdd8', 3, 9, 32, 1),
(223, 'l7etaog27vs13ttgi15kitrdd8', 4, 9, 22, 1),
(224, 'l7etaog27vs13ttgi15kitrdd8', 1, 9, 33, 1),
(225, 'l7etaog27vs13ttgi15kitrdd8', 1, 3, 22, 1),
(226, 'l7etaog27vs13ttgi15kitrdd8', 1, 3, 34, 1),
(227, 'l7etaog27vs13ttgi15kitrdd8', 4, 13, 22, 1),
(228, 'l7etaog27vs13ttgi15kitrdd8', 1, 13, 27, 1),
(229, 'l7etaog27vs13ttgi15kitrdd8', 3, 13, 27, 1),
(230, 'l7etaog27vs13ttgi15kitrdd8', 1, 13, 22, 1),
(231, 'u7r0asvo2gtv5duiuh9fn83oaa', 3, 13, 21, 1),
(232, 'u7r0asvo2gtv5duiuh9fn83oaa', 4, 13, 24, 1),
(233, 'u7r0asvo2gtv5duiuh9fn83oaa', 1, 13, 22, 1),
(234, 'u7r0asvo2gtv5duiuh9fn83oaa', 3, 13, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(18, 'Chậu nuôi cá'),
(19, 'Chuồng nuôi thú'),
(20, 'Cá Kiển'),
(21, 'Chó kiển'),
(22, 'Mèo kiển'),
(23, 'Thức ăn');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_1` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `sodienthoai` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `name`, `email`, `password_1`, `diachi`, `sodienthoai`) VALUES
(3, 'Nguyễn Thanh Trọng', 'trong113@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hưng Thạnh Cái Răng Cần Thơ', 986164034),
(9, 'Nguyễn Bùng Bình', 'trong117@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'KV3 Cái Răng Cần Thơ', 999888222),
(10, 'Nguyễn Trong', 'trong117@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Cần Thơ', 214748640),
(11, 'Trần Truyen', 'trong117@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vĩnh Long', 563534540),
(12, 'Lê Thanh', 'trong110@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hậu Giang', 126232332),
(13, 'Nguyễn Thanh Tèo', 'Trongb1910321@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'CÁI RĂNG, TP CẦN THƠ', 987652340);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `date_order` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `status` int(6) NOT NULL DEFAULT 0,
  `cartId` int(11) NOT NULL,
  `adminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `date_order`, `status`, `cartId`, `adminID`) VALUES
(185, '2022-11-06 08:56:33.828452', 2, 207, 2),
(186, '2022-11-06 08:56:33.901046', 1, 208, 2),
(187, '2022-11-06 08:57:17.473422', 2, 209, 2),
(188, '2022-11-06 08:57:17.630421', 2, 210, 2),
(189, '2022-11-06 09:38:49.475330', 2, 211, 2),
(190, '2022-11-06 09:38:49.654896', 2, 213, 2),
(191, '2022-11-06 09:38:49.721242', 1, 214, 2),
(192, '2022-11-06 09:38:49.798740', 1, 215, 2),
(193, '2022-11-06 10:29:38.030123', 0, 216, 0),
(194, '2022-11-06 10:29:38.267439', 0, 217, 0),
(195, '2022-11-06 10:29:38.333904', 0, 218, 0),
(196, '2022-11-06 10:29:47.298791', 0, 219, 0),
(197, '2022-11-06 10:33:36.229020', 0, 220, 0),
(198, '2022-11-06 10:33:36.339372', 0, 221, 0),
(199, '2022-11-06 10:33:36.405723', 2, 222, 2),
(200, '2022-11-06 10:33:50.314276', 2, 223, 2),
(201, '2022-11-06 10:46:21.994768', 2, 224, 2),
(202, '2022-11-06 10:48:34.708163', 2, 225, 2),
(203, '2022-11-06 10:48:51.806515', 0, 226, 0),
(204, '2022-11-06 11:15:39.496408', 0, 227, 0),
(205, '2022-11-06 11:15:47.695572', 2, 228, 2),
(206, '2022-11-06 11:29:09.494721', 0, 229, 0),
(207, '2022-11-06 11:29:09.673102', 0, 230, 0),
(208, '2022-11-06 12:53:35.060279', 0, 231, 0),
(209, '2022-11-06 12:53:35.182990', 0, 232, 0),
(210, '2022-11-06 12:53:43.655898', 2, 233, 1),
(211, '2022-11-06 12:54:16.501388', 2, 234, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` text NOT NULL,
  `productdesc` text NOT NULL,
  `type_1` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `brandId` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `catId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `productdesc`, `type_1`, `price`, `image_1`, `brandId`, `adminID`, `catId`) VALUES
(21, 'Mèo anh lông dài', '<p>Mèo Anh là m&ocirc;̣t trong những gi&ocirc;́ng mèo được ưa chu&ocirc;ng&nbsp; nh&acirc;́t ở Vi&ecirc;̣t Nam và tr&ecirc;n th&ecirc;́ giới.</p>', 1, '100000', 'bf7855f81a.jpg', 4, 0, 22),
(22, 'Chó Tây Tạng', '<p>Chó T&acirc;y Tạng đ&ocirc;̣t bi&ecirc;́n là m&ocirc;̣t loại chó v&ocirc; cùng quý hi&ecirc;́m tr&ecirc;n th&ecirc;́ giới.</p>', 1, '5000000', 'f3563e870b.jpg', 4, 0, 21),
(23, 'Cá Rồng', '<p>Cá R&ocirc;̀ng r&acirc;́t được giới trẻ ưu chu&ocirc;̣ng vào những năm 2012 đ&ecirc;́n t&acirc;̣n ngày nay.</p>', 2, '1000000', '489cb3f764.jpg', 4, 0, 20),
(24, 'Thức ăn chó', '<p>Là thức ăn dành cho thú cưng ph&ocirc;̉ c&acirc;̣p với giá v&ocirc; cùng hợp lí.</p>', 2, '10000', 'ec4182c69d.jpg', 3, 0, 23),
(25, 'Chó Bắc Kinh ', '<p>Là loài chó y&ecirc;u chu&ocirc;̣ng nh&acirc;́t Bắc Kinh và r&acirc;́t d&ecirc;̃ nu&ocirc;i.</p>', 2, '3000000', '12054ec85a.jpg', 4, 0, 21),
(27, 'Cá Dĩa', '<p>M&ocirc;̣t trong những loại cái gi&ocirc;́ng cái dĩa nh&acirc;́t tr&ecirc;n th&ecirc;́ giới.</p>', 1, '550000', '287f9350fa.jpg', 4, 0, 20),
(29, 'Chó Lông Xù Mỹ', '<p>Chó L&ocirc;ng Xù Mỹ là m&ocirc;̣t gi&ocirc;́ng ch1 đ&ecirc;́n từ khu vực Bắc Mỹ, r&acirc;́t d&ecirc;̃ nu&ocirc;i và sinh sản t&ocirc;́t.</p>', 1, '34000', 'eaca0ce13d.jpg', 4, 0, 21),
(31, 'Chuồng loại cao', '<p>Chó và mèo là 2 loại thú cưng c&acirc;̀n có l&ocirc;̀ng đ&ecirc;̉ nu&ocirc;i, chình vì th&ecirc;́ l&ocirc;̀ng nu&ocirc;i loại caao dùng đ&ecirc;̉nu&ocirc;i chúng cách an toàn.</p>', 1, '354000', '9c60557d6e.jpg', 4, 0, 19),
(32, 'Chuồng nuôi  có đèn', '<p>Chu&ocirc;̀ng nu&ocirc;i có đèn giúp thú cưng có cảm giác thoải mái, và căn nhà của chúng sẽ trở n&ecirc;n đẹp hơn đặc bi&ecirc;̣t là v&ecirc;̀ đ&ecirc;m.</p>', 2, '30000', '63a12995ec.jpg', 4, 0, 19),
(33, 'Chậu vuông', '<p>Rt&acirc;́ phù hợp đ&ecirc;̉ nu&ocirc;i t&acirc;́t cả loại cá từ nhỏ đ&ecirc;́n l&ocirc;́n, n&ecirc;n bạn hãy y&ecirc;n t&acirc;m vì đ&acirc;y là sự lựa chọn t&ocirc;́t.</p>', 1, '150000', '11e20f98b7.jpg', 4, 0, 18),
(34, 'Chậu thủy tinh tròn', '<p>Rt&acirc;́ thích họp đ&ecirc;̉ nu&ocirc;i những loại cá nhỏ nhắn, xinh xắn, trang bị trong phòng học và phòng khách.</p>', 1, '125000', '1a1e7e28c2.jpg', 4, 0, 18),
(35, 'Thức ăn mèo', '<p>Là loại thức ăn đ&ecirc;́n từ ch&acirc;u Mỹ, n&ecirc;n r&acirc;́t ch&acirc;́t lượng và phù hợp giá ti&ecirc;̀n.</p>', 1, '190000', '869c297ec8.jpg', 3, 0, 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
