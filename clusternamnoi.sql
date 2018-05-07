-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2018 at 12:38 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clusternamnoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `o_id` int(5) NOT NULL COMMENT 'รหัสการสั่งซื้อ',
  `p_id` int(5) NOT NULL COMMENT 'รหัสสินค้า',
  `f_id` int(5) NOT NULL COMMENT 'รหัสชาวบ้าน',
  `amount_making` int(10) NOT NULL COMMENT 'จำนวนสินค้าที่จอง',
  `total_time` int(2) NOT NULL COMMENT 'ระยะเวลารวมของการผลิต'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `consignment`
--

CREATE TABLE `consignment` (
  `con_id` int(5) NOT NULL COMMENT 'รหัสสถานะ',
  `s_id` int(5) NOT NULL COMMENT 'รหัสร้านค้า',
  `f_id` int(5) NOT NULL COMMENT 'รหัสชาวบ้าน',
  `p_id` int(5) NOT NULL COMMENT 'รหัสสินค้า',
  `con_price` int(9) NOT NULL COMMENT 'ราคาสินค้า ณ จุดขาย',
  `con_amount` int(9) NOT NULL COMMENT 'จำนวนสินค้าฝากขายรวม',
  `con_date_time` date NOT NULL COMMENT 'วันที่ฝากขาย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(5) NOT NULL COMMENT 'รหัสลูกค้า',
  `c_name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อลูกค้า',
  `c_address` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'ที่อยู่',
  `c_district` varchar(25) CHARACTER SET utf8 NOT NULL COMMENT 'ตำบล',
  `c_amphur` varchar(25) CHARACTER SET utf8 NOT NULL COMMENT 'อำเภอ',
  `c_province` varchar(25) CHARACTER SET utf8 NOT NULL COMMENT 'จังหวัด',
  `c_zip_code` int(5) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `c_phone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `c_email` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'อีเมล',
  `u_type` char(1) NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ลูกค้า';

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_address`, `c_district`, `c_amphur`, `c_province`, `c_zip_code`, `c_phone`, `c_email`, `u_type`) VALUES
(1, 'ซุฟยาน ฮะอุรา', '23 53 เพชรเกษม', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', 90110, '831684598', 'sufyanl@gmail.com', 'C'),
(27, 'ซุฟยาน ฮะอุรา', '23 53 เพชรเกษม', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', 90110, '0831684598', 'sufyanlp@gmail.com', 'C'),
(28, 'ซุฟยาน ฮะอุรา', '23 53 เพชรเกษม', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', 90110, '0831684598', 'sufyan@gmail.com', 'C'),
(29, 'ซุฟยาน ฮะอุรา', '23 53 เพชรเกษม', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', 90110, '0831684598', 'sufyannn@gmail.com', 'C'),
(51, 'pop', 'pop', 'pop', 'หาดใหญ่', 'สงขลา', 90110, '0831684598', 'pop@email.com', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `environment`
--

CREATE TABLE `environment` (
  `e_id` int(10) NOT NULL,
  `e_price` int(10) NOT NULL,
  `e_name` varchar(50) NOT NULL COMMENT 'คำอธิบาย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `environment`
--

INSERT INTO `environment` (`e_id`, `e_price`, `e_name`) VALUES
(1, 50, 'EMS'),
(2, 30, 'ลงทะเบียน'),
(3, 10, 'ต้นทุนการดำเนินงาน');

-- --------------------------------------------------------

--
-- Table structure for table `folk`
--

CREATE TABLE `folk` (
  `f_id` int(5) NOT NULL COMMENT 'รหัสสถานะ',
  `username` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(50) NOT NULL COMMENT 'รหัสผ่าน',
  `f_name` varchar(50) NOT NULL COMMENT 'ชื่อชาวบ้าน',
  `f_pictures` varchar(200) NOT NULL COMMENT 'รูปชาวบ้าน',
  `f_phone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ชาวบ้าน';

--
-- Dumping data for table `folk`
--

INSERT INTO `folk` (`f_id`, `username`, `password`, `f_name`, `f_pictures`, `f_phone`) VALUES
(2, 'folk', 'd2de8d09d12b1b965a5808350ad2eff9b466b8990b7bb5535f', 'sufyan haura', '1521141933-IMG7644.jpg', '0831684598'),
(3, 'folks', 'ed225612d1d0b117d12566694395b1a580cd87e7c979f54ca2', 'folks', '1521174600-IMG7644.jpg', '0831684598');

-- --------------------------------------------------------

--
-- Table structure for table `identity`
--

CREATE TABLE `identity` (
  `iden_id` int(5) NOT NULL COMMENT 'รหัสสถานะ',
  `username` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(250) NOT NULL COMMENT 'รหัสผ่าน',
  `type` varchar(1) NOT NULL DEFAULT 'C' COMMENT 'ประเภท User (C,F,A,S)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตรวจสอบสถานะผู้ใช้งาน';

--
-- Dumping data for table `identity`
--

INSERT INTO `identity` (`iden_id`, `username`, `password`, `type`) VALUES
(56, '', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', ''),
(43, '123456789', '00a580a334321ea63b52654270ab2d5be37b138f2bfd155b2673a96987afa004', 'S'),
(12, 'admin', '00a580a334321ea63b52654270ab2d5be37b138f2bfd155b2673a96987afa004', 'A'),
(49, 'folk', 'd2de8d09d12b1b965a5808350ad2eff9b466b8990b7bb5535f5445e3a04ce222', 'F'),
(50, 'folks', 'ed225612d1d0b117d12566694395b1a580cd87e7c979f54ca2b84ffcb212963a', 'F'),
(40, 'nasr@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(54, 'pop@email.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(52, 'shop', 'c9e7d8aaded94105d0faf1059b3805d8d773195243a319d1d9760b3f9e8bfbf2', 'S'),
(53, 'shops', 'b7f4fc1387d7f4e65aacb047b979a8498d84b8fb9696ab18fe2cfbd6bff9f998', 'S'),
(54, 'shopss', '6dbbfdb8ebbbdb08f3a562d617eeca708006f860ea56d730bebaf24734c45d2c', 'S'),
(55, 'shopsss', 'dbc60b8f9d1438aab171b597decacf8b08fb00c78329ee50956405728276619c', 'S'),
(1, 'sufyan', '00a580a334321ea63b52654270ab2d5be37b138f2bfd155b2673a96987afa004', 'C'),
(2, 'sufyan3738', '00a580a334321ea63b52654270ab2d5be37b138f2bfd155b2673a96987afa004', 'C'),
(28, 'sufyan@gmail.com', '00a580a334321ea63b52654270ab2d5be37b138f2bfd155b2673a96987afa004', 'C'),
(35, 'sufyanl@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(27, 'sufyanlp@gmail.com', '402ce846c55a4f550e21514bbbad9cad5ac665bd36e19e7638ae62641defda2b', 'C'),
(29, 'sufyannn@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(58, 'sufyanlp@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(59, 'sufyan@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(60, 'sufyannn@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(61, 'sufyan@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(62, 'sufyanlp@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(63, 'sufyannn@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(64, 'sufyanlp@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C'),
(65, 'sufyanlp@gmail.com', '13ca5f9b10043dc9c8a1b1baace0836910e2fb35312f72043e5765dc63894c32', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `con_id` int(5) NOT NULL COMMENT 'รหัสฝากขาย',
  `p_id` int(5) NOT NULL COMMENT 'รหัสสินค้า',
  `L_amount` int(9) NOT NULL COMMENT 'รายการทั้งหมด',
  `con_amount` int(9) NOT NULL COMMENT 'จำนวนฝากขายรวม',
  `balance` int(9) NOT NULL COMMENT 'คงเหลือ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pay_list`
--

CREATE TABLE `pay_list` (
  `con_id` int(5) NOT NULL COMMENT 'รหัสฝากขาย',
  `p_id` int(5) NOT NULL COMMENT 'รหัสสินค้า',
  `p2f_id` int(5) NOT NULL COMMENT 'รหัสการจ่ายเงินให้ชาวบ้าน',
  `L_amount` int(9) NOT NULL COMMENT 'จำนวนทั้งหมดในList',
  `p_price` int(9) NOT NULL COMMENT 'ราคาสินค้าต่อรายการ',
  `p_price_consignment` int(9) NOT NULL COMMENT 'ราคาสินค้าฝากขาย',
  `p_price_shipping` int(9) NOT NULL COMMENT 'จำนวนเงินค่าขนส่ง',
  `operational_cost` int(9) NOT NULL COMMENT 'ต้นทุนการดำเนินงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pay_to_folk`
--

CREATE TABLE `pay_to_folk` (
  `p2f_id` int(5) NOT NULL COMMENT 'รหัสการจ่ายเงินให้ชาวบ้าน',
  `s_id` int(5) NOT NULL COMMENT 'รหัสร้านค้า',
  `f_id` int(5) NOT NULL COMMENT 'รหัสชาวบ้าน',
  `p2f_price` int(9) NOT NULL COMMENT 'รวมเงินที่ต้องจ่ายต่อรายการ',
  `p2f_amount` int(9) NOT NULL COMMENT 'รวมเงินที่ต้องจ่ายทั้งหมด',
  `p2f_date_time` date NOT NULL COMMENT 'วันที่จ่ายเงินให้กับชาวบ้าน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(5) NOT NULL COMMENT 'รหัสสินค้่า',
  `t_id` varchar(3) NOT NULL COMMENT 'รหัสประเภท',
  `s_id` int(2) NOT NULL COMMENT 'รหัสร้าน',
  `p_name` varchar(50) NOT NULL COMMENT 'ชื่อสินค้า',
  `p_pictures` varchar(200) NOT NULL COMMENT 'รูปภาพสินค้า',
  `p_video_demo` varchar(200) DEFAULT NULL COMMENT 'วีดีโอสินค้า',
  `p_color` varchar(20) DEFAULT NULL COMMENT 'สีของสินค้า',
  `p_size` varchar(100) NOT NULL COMMENT 'ขนาดของสินค้า',
  `p_unit` varchar(50) NOT NULL COMMENT 'หน่วยสินค้า',
  `p_weight_perunit` int(10) NOT NULL COMMENT 'น้ำหนักสินค้าต่อหน่วย',
  `p_price` int(11) NOT NULL,
  `p_price_consignment` int(11) NOT NULL,
  `p_amount` int(10) DEFAULT NULL COMMENT 'ราคาขาย+ค่าดำเนินงาน(ไม่เข้าใจ)',
  `p_date_time` datetime DEFAULT NULL COMMENT 'วันที่นำเข้าสินค้า',
  `p_count` int(10) NOT NULL DEFAULT '0' COMMENT 'จำนวนสินค้า',
  `description` varchar(255) DEFAULT NULL COMMENT 'คำอธิบายรายละเอียด',
  `exp` varchar(20) DEFAULT NULL,
  `p_time` varchar(20) NOT NULL COMMENT 'เวลาในการผลิต',
  `buy` int(11) NOT NULL DEFAULT '0' COMMENT 'ยอดขาย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `t_id`, `s_id`, `p_name`, `p_pictures`, `p_video_demo`, `p_color`, `p_size`, `p_unit`, `p_weight_perunit`, `p_price`, `p_price_consignment`, `p_amount`, `p_date_time`, `p_count`, `description`, `exp`, `p_time`, `buy`) VALUES
(1, 'NUT', 0, 'หมวกของกู', '1521910553-Win!!.jpg', '', 'แดง', '12', 'นิ้ว', 15, 250, 0, 123, NULL, 0, 'อะไรก็ไม่รู้', NULL, '15', 5),
(3, 'HAT', 3, 'ถั่วคั้ว', '1521984286-pat.jpg', '', 'ไม่มี', 'ไม่มี', 'ถุง', 20, 15, 0, 75, NULL, 0, 'ถั่วนะสัส', '0', '1', 4),
(4, 'NUT', 1, 'ถั่วคั้วอีกแล้ว', '1521984780-fms.jpg', '', 'ไม่มี', 'ไม่มี', 'ถุง', 20, 15, 0, 54, NULL, 0, '123456789', 'exp', '1 วัน', 12),
(5, 'NUT', 3, 'ถั่วคั้วอีกแล้ว', '1521984854-fms.jpg', '', 'ไม่มี', 'ไม่มี', 'ถุง', 20, 15, 10, 78, NULL, 0, '123456789', 'exp', '1 วัน', 9),
(6, 'NUT', 3, 'ถั่วคั้วนะงับ', '1521985035-cabin.png', '', 'ไม่มี', 'ไม่มี', 'ถุง', 20, 15, 10, 3, NULL, 0, 'หกดฟหฟดหด', '1 เดือน', '1 วัน', 17);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `r_id` int(5) NOT NULL COMMENT 'รหัสสถานะ',
  `p_id` int(5) NOT NULL COMMENT 'รหัสสินค้า',
  `s_id` int(5) NOT NULL COMMENT 'รหัสร้านค้า',
  `c_id` int(5) NOT NULL COMMENT 'รหัสลูกค้า',
  `o_id` int(5) NOT NULL COMMENT 'รหัสใบสั่งซื้อ',
  `date_time` date NOT NULL COMMENT 'วันที่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `s_id` int(2) NOT NULL COMMENT 'รหัสร้านค้า',
  `username` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(50) NOT NULL COMMENT 'รหัสผ่าน',
  `s_pictures` varchar(200) NOT NULL COMMENT 'รูปร้านค้า',
  `s_address` varchar(255) NOT NULL COMMENT 'ที่อยู่ร้านค้า',
  `s_district` varchar(50) NOT NULL COMMENT 'ตำบลร้านค้า',
  `s_amphur` varchar(50) NOT NULL COMMENT 'อำเภอ',
  `s_province` varchar(50) NOT NULL COMMENT 'จังหวัด',
  `s_zip_code` int(5) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `s_phone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `s_latitude` double NOT NULL COMMENT 'ละติจูด',
  `s_longitude` double NOT NULL COMMENT 'ลองจิจูด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`s_id`, `username`, `password`, `s_pictures`, `s_address`, `s_district`, `s_amphur`, `s_province`, `s_zip_code`, `s_phone`, `s_latitude`, `s_longitude`) VALUES
(1, '123456789', '00a580a334321ea63b52654270ab2d5be37b138f2bfd155b26', '1521133200-29186203.jpg', '23 53 เพชรเกษม', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', 90110, '831684598', 1231231231, 1231231321),
(3, 'shop', 'c9e7d8aaded94105d0faf1059b3805d8d773195243a319d1d9', '1521175058-29186203.jpg', '23 53 เพชรเกษม', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', 90110, '831684598', 1231231231, 1231231321),
(4, 'shops', 'b7f4fc1387d7f4e65aacb047b979a8498d84b8fb9696ab18fe', '1521176157-Win!!!.jpg', '23 53 เพชรเกษม', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', 90110, '831684598', 1231231231, 1231231321),
(5, 'shopss', '6dbbfdb8ebbbdb08f3a562d617eeca708006f860ea56d730be', '1521176215-ภาษาไทย.jpg', '23 53 เพชรเกษม', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', 90110, '831684598', 1231231231, 1231231321),
(6, 'shopsss', 'dbc60b8f9d1438aab171b597decacf8b08fb00c78329ee5095', '1521176291-ชนะ.jpg', '23 53 เพชรเกษม', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', 90110, '831684598', 1231231231, 1231231321);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `t_id` varchar(3) NOT NULL,
  `t_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`t_id`, `t_name`) VALUES
('HAT', 'หมวก'),
('MAT', 'หกากดิยกนพ'),
('NUT', 'ถั่ว');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`o_id`,`p_id`,`f_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `consignment`
--
ALTER TABLE `consignment`
  ADD PRIMARY KEY (`con_id`,`s_id`,`f_id`,`p_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `environment`
--
ALTER TABLE `environment`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `folk`
--
ALTER TABLE `folk`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`con_id`,`p_id`),
  ADD UNIQUE KEY `con_id` (`con_id`,`p_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `pay_list`
--
ALTER TABLE `pay_list`
  ADD PRIMARY KEY (`con_id`,`p_id`,`p2f_id`),
  ADD KEY `p2f_id` (`p2f_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `pay_to_folk`
--
ALTER TABLE `pay_to_folk`
  ADD PRIMARY KEY (`p2f_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`,`t_id`,`s_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`r_id`,`p_id`,`s_id`,`c_id`,`o_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consignment`
--
ALTER TABLE `consignment`
  MODIFY `con_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสถานะ';

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสลูกค้า', AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `environment`
--
ALTER TABLE `environment`
  MODIFY `e_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `folk`
--
ALTER TABLE `folk`
  MODIFY `f_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสถานะ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pay_to_folk`
--
ALTER TABLE `pay_to_folk`
  MODIFY `p2f_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการจ่ายเงินให้ชาวบ้าน';

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้่า', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `r_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสถานะ';

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `s_id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'รหัสร้านค้า', AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`f_id`) REFERENCES `folk` (`f_id`);

--
-- Constraints for table `consignment`
--
ALTER TABLE `consignment`
  ADD CONSTRAINT `consignment_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `folk` (`f_id`),
  ADD CONSTRAINT `consignment_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`),
  ADD CONSTRAINT `consignment_ibfk_3` FOREIGN KEY (`s_id`) REFERENCES `shop` (`s_id`);

--
-- Constraints for table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`con_id`) REFERENCES `consignment` (`con_id`),
  ADD CONSTRAINT `list_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Constraints for table `pay_list`
--
ALTER TABLE `pay_list`
  ADD CONSTRAINT `pay_list_ibfk_1` FOREIGN KEY (`con_id`) REFERENCES `consignment` (`con_id`),
  ADD CONSTRAINT `pay_list_ibfk_2` FOREIGN KEY (`p2f_id`) REFERENCES `pay_to_folk` (`p2f_id`),
  ADD CONSTRAINT `pay_list_ibfk_3` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Constraints for table `pay_to_folk`
--
ALTER TABLE `pay_to_folk`
  ADD CONSTRAINT `pay_to_folk_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `folk` (`f_id`),
  ADD CONSTRAINT `pay_to_folk_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `shop` (`s_id`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`),
  ADD CONSTRAINT `receipt_ibfk_3` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`),
  ADD CONSTRAINT `receipt_ibfk_4` FOREIGN KEY (`s_id`) REFERENCES `shop` (`s_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
