-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: 192.168.1.31
-- Generation Time: Apr 19, 2019 at 03:23 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kaewruamchor`
--

-- --------------------------------------------------------

--
-- Table structure for table `amphur`
--

CREATE TABLE IF NOT EXISTS `amphur` (
  `am_id` varchar(4) NOT NULL,
  `am_thainame` varchar(100) NOT NULL,
  `am_engname` varchar(100) NOT NULL,
  `am_proid` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE IF NOT EXISTS `degree` (
  `degree_id` int(11) NOT NULL COMMENT 'รหัสหลักสูตร',
  `degree_levelid` int(11) NOT NULL COMMENT 'รหัสระดับการศึกษา',
  `degree_level_name` varchar(50) NOT NULL COMMENT 'ชื่อระดับการศึกษา',
  `degree_name` varchar(80) NOT NULL COMMENT 'ชื่อหลักสูตร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ชื่อหลักสูตร';

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `dis_id` varchar(6) NOT NULL,
  `dis_thainame` varchar(100) NOT NULL,
  `dis_engname` varchar(100) NOT NULL,
  `dis_zipcode` varchar(5) NOT NULL,
  `dis_amid` varchar(4) NOT NULL,
  `dis_proid` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `fa_id` int(11) NOT NULL,
  `fa_thainame` varchar(50) NOT NULL,
  `fa_engname` varchar(50) NOT NULL,
  `fa_logo` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE IF NOT EXISTS `major` (
  `ma_faculty` int(11) NOT NULL,
  `ma_id` int(11) NOT NULL,
  `ma_thainame` varchar(150) NOT NULL,
  `ma_engname` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

CREATE TABLE IF NOT EXISTS `occupation` (
  `oc_id` int(11) NOT NULL,
  `oc_desc` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `pro_id` int(11) NOT NULL,
  `pro_thainame` varchar(30) NOT NULL,
  `pro_engname` varchar(100) NOT NULL,
  `pro_geocode` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `stf_username` varchar(50) NOT NULL,
  `stf_fullname` varchar(50) NOT NULL,
  `stf_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `stu_id` varchar(20) NOT NULL COMMENT 'รหัสนักศึกษา',
  `stu_prefix` varchar(100) NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `stu_fname` varchar(50) NOT NULL COMMENT 'ชื่อ',
  `stu_lname` varchar(50) NOT NULL COMMENT 'นามสกุล',
  `stu_password` varchar(100) NOT NULL,
  `stu_birthday` date NOT NULL COMMENT 'วันเกิด',
  `stu_facultyid` int(11) NOT NULL COMMENT 'รหัสคณะ',
  `stu_majorid` int(11) NOT NULL COMMENT 'รหัสสาขา',
  `stu_degreeid` int(11) NOT NULL COMMENT 'รหัสหลักสูตร',
  `stu_levelid` int(11) NOT NULL COMMENT 'รหัสระดับชั้น',
  `stu_catid` int(11) NOT NULL COMMENT 'รหัสประเภท',
  `stu_gen` int(11) NOT NULL COMMENT 'รุ่น',
  `stu_sec` int(11) NOT NULL DEFAULT '1' COMMENT 'หมู่เรียน',
  `stu_year` int(11) NOT NULL COMMENT 'ปีที่เข้าศึกษา',
  `stu_engfname` varchar(80) NOT NULL COMMENT 'ชื่ออังกฤษ',
  `stu_englname` varchar(80) NOT NULL COMMENT 'นามสกุลอังกฤษ',
  `stu_job` varchar(50) NOT NULL COMMENT 'อาชีพ',
  `stu_status` tinyint(1) DEFAULT '1' COMMENT 'สถานะการมีชีวิต',
  `stu_housenumber` varchar(20) NOT NULL COMMENT 'บ้านเลขที่',
  `stu_moo` varchar(3) NOT NULL COMMENT 'หมู่',
  `stu_alley` varchar(50) NOT NULL COMMENT 'ซอย',
  `stu_street` varchar(50) NOT NULL COMMENT 'ถนน',
  `stu_district` varchar(50) NOT NULL COMMENT 'แขวง/ตำบล',
  `stu_amphur` varchar(50) NOT NULL COMMENT 'เขต/อำเภอ',
  `stu_province` varchar(50) NOT NULL COMMENT 'จังหวัด',
  `stu_zipcode` varchar(6) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `stu_phonenumber` varchar(15) NOT NULL COMMENT 'เบอร์โทร',
  `stu_email` varchar(50) NOT NULL COMMENT 'อีเมล',
  `stu_facebook` varchar(50) NOT NULL COMMENT 'เฟสบุ๊ค',
  `stu_line` varchar(30) NOT NULL COMMENT 'ไลน์',
  `stu_latitude` varchar(50) NOT NULL COMMENT 'ละติจูด',
  `stu_longtitude` varchar(50) NOT NULL COMMENT 'ลองติจูด',
  `stu_photo` mediumblob COMMENT 'ภาพประจำตัว',
  `stu_evidence` mediumblob COMMENT 'หลักฐานการเป็นนักศึกษา',
  `stu_approved` tinyint(1) DEFAULT '0' COMMENT 'ผ่านการตรวจสอบการสมัครสมาชิกแล้ว',
  `stu_createdatetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เพิ่มข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_import`
--

CREATE TABLE IF NOT EXISTS `student_import` (
  `stu_id` varchar(20) NOT NULL COMMENT 'รหัสนักศึกษา',
  `stu_prefix` varchar(100) NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `stu_fname` varchar(50) NOT NULL COMMENT 'ชื่อ',
  `stu_lname` varchar(50) NOT NULL COMMENT 'นามสกุล',
  `stu_birthday` date NOT NULL COMMENT 'วันเกิด',
  `stu_facultyid` int(11) NOT NULL COMMENT 'รหัสคณะ',
  `stu_majorid` int(11) NOT NULL COMMENT 'รหัสสาขา',
  `stu_degreeid` int(11) NOT NULL COMMENT 'รหัสหลักสูตร',
  `stu_levelid` int(11) NOT NULL COMMENT 'รหัสระดับชั้น',
  `stu_catid` int(11) NOT NULL COMMENT 'รหัสประเภท',
  `stu_gen` int(11) NOT NULL COMMENT 'รุ่น',
  `stu_sec` int(11) NOT NULL DEFAULT '1' COMMENT 'หมู่เรียน',
  `stu_year` int(11) NOT NULL COMMENT 'ปีที่เข้าศึกษา',
  `flag_insert` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'สถานะการนำเข้าแล้ว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sys_config`
--

CREATE TABLE IF NOT EXISTS `sys_config` (
  `config_id` int(1) NOT NULL,
  `open_debug` tinyint(1) NOT NULL,
  `version_ios` varchar(30) NOT NULL,
  `version_android` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `web_sessions`
--

CREATE TABLE IF NOT EXISTS `web_sessions` (
  `session_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_expires` int(10) unsigned NOT NULL DEFAULT '0',
  `session_data` text,
  `username` varchar(100) DEFAULT NULL,
  `client_ip` varchar(15) DEFAULT NULL,
  `create_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amphur`
--
ALTER TABLE `amphur`
  ADD PRIMARY KEY (`am_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD UNIQUE KEY `degree_idx1` (`degree_id`,`degree_levelid`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`dis_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fa_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`ma_faculty`,`ma_id`);

--
-- Indexes for table `occupation`
--
ALTER TABLE `occupation`
  ADD UNIQUE KEY `occ_idx` (`oc_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD UNIQUE KEY `stf_username` (`stf_username`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `student_import`
--
ALTER TABLE `student_import`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `sys_config`
--
ALTER TABLE `sys_config`
  ADD UNIQUE KEY `sys_config_idx` (`config_id`);

--
-- Indexes for table `web_sessions`
--
ALTER TABLE `web_sessions`
  ADD PRIMARY KEY (`session_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
