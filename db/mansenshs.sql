-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 08:57 AM
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
-- Database: `mansenshs`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `ID` int(10) NOT NULL,
  `task` varchar(5000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`ID`, `task`) VALUES
(2557, 'admin block/unblock student On 2024-03-11 08:38:48'),
(2558, 'admin Assigned Class and House to Student On 2024-03-11 08:39:06'),
(2556, 'admin block/unblock student On 2024-03-11 08:38:37'),
(2554, 'admin Deleted House On 2024-03-11 08:37:36'),
(2555, 'admin Added New Class On 2024-03-11 08:37:48'),
(2553, 'admin Edited house data On 2024-03-11 08:37:28'),
(2551, 'admin Open Academic Session On 2024-03-11 08:36:51'),
(2552, 'admin Added New House On 2024-03-11 08:37:11'),
(2550, 'admin deleted session On 2024-03-11 08:36:11'),
(2548, 'admin Added New House On 2024-03-11 08:35:50'),
(2549, 'admin Added New House On 2024-03-11 08:36:02'),
(2547, 'admin Assigned Class and House to Student On 2024-03-11 08:34:55'),
(2546, 'admin Assigned Class and House to Student On 2024-03-11 08:34:09'),
(2545, 'admin Assigned Class and House to Student On 2024-03-11 08:30:53'),
(2544, 'admin logged in On 2024-03-11 08:17:02'),
(2543, 'ABDUL MAJID DRAMANI Edited his personal data On 2024-03-08 20:27:57'),
(2542, 'ABDUL MAJID DRAMANI Edited his photo On 2024-03-08 20:27:06'),
(2541, '60101200123 logged in On 2024-03-08 20:25:52'),
(2540, 'admin uploaded New prospectus On 2024-03-08 20:19:21'),
(2539, 'admin uploaded New prospectus On 2024-03-08 20:19:01'),
(2538, 'admin uploaded student list On 2024-03-08 20:17:31'),
(2537, 'admin Uploaded student list On 2024-03-08 20:17:31'),
(2536, 'admin block/unblock User On 2024-03-08 20:16:38'),
(2535, 'admin block/unblock User On 2024-03-08 20:16:33'),
(2534, 'TEACHER1 Added New User On 2024-03-08 20:16:16'),
(2533, 'admin Added website details On 2024-03-08 20:14:09'),
(2532, 'admin Open Academic Session On 2024-03-08 20:13:02'),
(2531, 'admin logged in On 2024-03-08 20:08:17'),
(2530, 'admin logged in On 2024-03-08 20:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `school_session`
--

CREATE TABLE `school_session` (
  `ID` int(5) NOT NULL,
  `current_session` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `school_session`
--

INSERT INTO `school_session` (`ID`, `current_session`) VALUES
(23, '2023/2024');

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `ID` int(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`ID`, `name`) VALUES
(2, 'JSS1Aswe'),
(3, 'JSS1B'),
(4, 'JSS2');

-- --------------------------------------------------------

--
-- Table structure for table `tbldept`
--

CREATE TABLE `tbldept` (
  `ID` int(4) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblgroup`
--

CREATE TABLE `tblgroup` (
  `ID` int(5) NOT NULL,
  `groupname` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblgroup`
--

INSERT INTO `tblgroup` (`ID`, `groupname`) VALUES
(9, 'Admin'),
(8, 'Principal'),
(7, 'Super Admin'),
(11, 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `tblhouse`
--

CREATE TABLE `tblhouse` (
  `ID` int(4) NOT NULL,
  `name` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblhouse`
--

INSERT INTO `tblhouse` (`ID`, `name`) VALUES
(2, 'Manioo'),
(4, 'HOUSE OF JOY'),
(5, 'HOUSE OF PEACE');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `ID` int(5) NOT NULL,
  `referenceID` varchar(22) NOT NULL,
  `index_no` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(111) NOT NULL,
  `school` varchar(60) NOT NULL,
  `payment_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`ID`, `referenceID`, `index_no`, `amount`, `phone`, `email`, `school`, `payment_date`) VALUES
(14, 'shs244149435', '60101200123', '45', '08067361023', 'newleastpaysolution@gmail.com', 'mansen senior high school', '2024-03-08 20:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `tblprospectus`
--

CREATE TABLE `tblprospectus` (
  `ID` int(5) NOT NULL,
  `prospectus_type` varchar(20) NOT NULL,
  `filename` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblprospectus`
--

INSERT INTO `tblprospectus` (`ID`, `prospectus_type`, `filename`) VALUES
(23, 'DAY STUDENT', 'https___cssps.gov_day.pdf'),
(24, 'BOARDER', 'https___cssps.gov_boarder.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tblschools`
--

CREATE TABLE `tblschools` (
  `ID` int(6) NOT NULL,
  `name` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `logo` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblschools`
--

INSERT INTO `tblschools` (`ID`, `name`, `state`, `phone`, `logo`) VALUES
(3, 'Abakrampa Senior High Technical', 'Kumasi', '090056445234', 'uploadImage/School/abakrampa-senior-high-technical.webp'),
(5, 'Abeadze State College', 'Kumasi', '090', 'uploadImage/School/abeadze-state-college.webp'),
(6, 'Mansen Senior High School', 'Kumasi', '0903434434', 'uploadImage/School/mansen-senior-high (1).webp');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `ID` int(6) NOT NULL,
  `index_no` varchar(12) NOT NULL,
  `fullname` varchar(300) NOT NULL,
  `sex` varchar(15) NOT NULL,
  `programme` varchar(40) NOT NULL,
  `class` varchar(30) NOT NULL,
  `boarding_status` varchar(20) NOT NULL,
  `aggregate` varchar(11) NOT NULL,
  `raw_score` varchar(3) NOT NULL,
  `enrollment_code` varchar(10) NOT NULL,
  `jhs_attended` varchar(140) NOT NULL,
  `jhs_type` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `father_occupation` varchar(60) NOT NULL,
  `mother_name` varchar(150) NOT NULL,
  `mother_occupation` varchar(60) NOT NULL,
  `guardian_name` varchar(150) NOT NULL,
  `residential_telephone` varchar(15) NOT NULL,
  `status` int(1) NOT NULL,
  `photo` varchar(5000) NOT NULL,
  `school_session` varchar(11) NOT NULL,
  `house` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`ID`, `index_no`, `fullname`, `sex`, `programme`, `class`, `boarding_status`, `aggregate`, `raw_score`, `enrollment_code`, `jhs_attended`, `jhs_type`, `phone`, `email`, `father_name`, `father_occupation`, `mother_name`, `mother_occupation`, `guardian_name`, `residential_telephone`, `status`, `photo`, `school_session`, `house`) VALUES
(1584, '60101200123', 'ABDUL MAJID DRAMANI', 'MALE', 'GENERAL ARTS', 'JSS1B', 'BOARDING', '33', '33', '4545454545', 'LUTHERAN HIGH SCHOOLF', 'PRIVATE', '08067361023', 'XXXXX@GMAIL.COM', 'NONSO', 'FARMER', 'ARIT', 'TEACHER', 'NIL', '0902', 1, 'uploadImage/Profile/uhyt.jpg', '2023/2024', 'MANIOO'),
(1585, '060119200323', 'ABDUL RAZAK SAMIRATU', 'FEMALE', 'GENERAL SCIENCE', 'To be Assigned Later', 'BOARDING', '22', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'uploadImage/Profile/default.png', '2023/2024', 'To be Assigned Later'),
(1586, '060701100123', 'ABIBATA SADICK', 'FEMALE', 'GENERAL ARTS', 'To be Assigned Later', 'BOARDING', '32', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'uploadImage/Profile/default.png', '2023/2024', 'To be Assigned Later'),
(1587, '062601100123', 'ABISTUA MARY', 'FEMALE', 'GENERAL ARTS', 'To be Assigned Later', 'BOARDING', '30', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'uploadImage/Profile/default.png', '2023/2024', 'To be Assigned Later'),
(1588, '060803700323', 'ABUBAKAR SADIQUE', 'MALE', 'GENERAL ARTS', 'JSS1B', 'BOARDING', '30', '', '', '', '', '', '', '', '', '', '', '', '', 1, 'uploadImage/Profile/default.png', '2023/2024', 'HOUSE OF JOY'),
(1589, '060805200123', 'ABUGRI SAFIA', 'FEMALE', 'VISUAL ARTS', 'JSS1B', 'BOARDING', '23', '', '', '', '', '', '', '', '', '', '', '', '', 1, 'uploadImage/Profile/default.png', '2023/2024', 'MANIOO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(4) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `lastaccess` varchar(22) NOT NULL,
  `status` int(1) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `groupname` varchar(33) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `fullname`, `email`, `lastaccess`, `status`, `photo`, `groupname`) VALUES
(28, 'admin', 'admin123', 'Ndueso Walter', 'newleastpaysolution@gmail.com', '2024-03-08 20:08:16', 1, 'uploadImage/Profile/default.png', 'Super Admin'),
(31, 'TEACHER1', '11111111', 'ASAMOAH MENSAH', 'MEN@GMAIL.COM', 'Nill', 1, 'uploadImage/Profile/default.png', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `schoolname` varchar(150) NOT NULL,
  `headmaster` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `state` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `url` varchar(100) NOT NULL,
  `email_server` varchar(60) NOT NULL,
  `email_username` varchar(50) NOT NULL,
  `app_password` varchar(40) NOT NULL,
  `email_port` varchar(6) NOT NULL,
  `admission_fee` varchar(30) NOT NULL,
  `publickey` varchar(60) NOT NULL,
  `secretkey` varchar(60) NOT NULL,
  `logo` varchar(4000) NOT NULL,
  `box` varchar(5) NOT NULL,
  `reportdate` varchar(19) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`schoolname`, `headmaster`, `address`, `state`, `email`, `phone`, `url`, `email_server`, `email_username`, `app_password`, `email_port`, `admission_fee`, `publickey`, `secretkey`, `logo`, `box`, `reportdate`) VALUES
('MANSEN SENIOR HIGH SCHOOL', 'MRS NATHANIEL MENSAH', 'FACTORY RD', 'KUMASI', 'NEWLEASTPAYSOLUTION@GMAIL.COM', '08009856954', 'WWW.MENSAH.EDU', 'SMTP.GMAIL.COM', 'ADMISSION.MANSENSHS@GMAIL.COM', 'XMVLDREPYHGKJFKF', '465', '45', 'pk_test_4e6365d2b61274f73faffc1c697d4a5a9afada00', 'sk_test_156019e6c4398cb3b268fe4063bbf57e930c4164', 'uploadImage/Logo/logo.png', '190', '2024-03-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `school_session`
--
ALTER TABLE `school_session`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbldept`
--
ALTER TABLE `tbldept`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblgroup`
--
ALTER TABLE `tblgroup`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblhouse`
--
ALTER TABLE `tblhouse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblprospectus`
--
ALTER TABLE `tblprospectus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblschools`
--
ALTER TABLE `tblschools`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`schoolname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2559;

--
-- AUTO_INCREMENT for table `school_session`
--
ALTER TABLE `school_session`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbldept`
--
ALTER TABLE `tbldept`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblgroup`
--
ALTER TABLE `tblgroup`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblhouse`
--
ALTER TABLE `tblhouse`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblprospectus`
--
ALTER TABLE `tblprospectus`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblschools`
--
ALTER TABLE `tblschools`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1590;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
