SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

CREATE TABLE IF NOT EXISTS `amphur` (
  `am_id` varchar(4) NOT NULL,
  `am_thainame` varchar(100) NOT NULL,
  `am_engname` varchar(100) NOT NULL,
  `am_proid` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `degree` (
  `degree_id` int(11) NOT NULL COMMENT 'รหัสหลักสูตร',
  `degree_levelid` int(11) NOT NULL COMMENT 'รหัสระดับการศึกษา',
  `degree_level_name` varchar(50) NOT NULL COMMENT 'ชื่อระดับการศึกษา',
  `degree_name` varchar(80) NOT NULL COMMENT 'ชื่อหลักสูตร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ชื่อหลักสูตร';

CREATE TABLE IF NOT EXISTS `district` (
  `dis_id` varchar(6) NOT NULL,
  `dis_thainame` varchar(100) NOT NULL,
  `dis_engname` varchar(100) NOT NULL,
  `dis_zipcode` varchar(5) NOT NULL,
  `dis_amid` varchar(4) NOT NULL,
  `dis_proid` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `faculty` (
  `fa_id` int(11) NOT NULL,
  `fa_thainame` varchar(50) NOT NULL,
  `fa_engname` varchar(50) NOT NULL,
  `fa_logo` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `major` (
  `ma_faculty` int(11) NOT NULL,
  `ma_id` int(11) NOT NULL,
  `ma_thainame` varchar(150) NOT NULL,
  `ma_engname` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `occupation` (
  `oc_id` int(11) NOT NULL,
  `oc_desc` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `province` (
  `pro_id` int(11) NOT NULL,
  `pro_thainame` varchar(30) NOT NULL,
  `pro_engname` varchar(100) NOT NULL,
  `pro_geocode` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `staff` (
  `stf_username` varchar(50) NOT NULL,
  `stf_fullname` varchar(50) NOT NULL,
  `stf_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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


