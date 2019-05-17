-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 02:19 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rvaerms_parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(64) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator', NULL, NULL, '1558045514', '1558045514'),
('auditSystem', 2, 'Auditing sytem', NULL, NULL, NULL, NULL),
('canDelete', 2, 'can delete', NULL, NULL, NULL, NULL),
('clerk', 1, 'Clerk', NULL, NULL, '1558093172', '1558093172'),
('createDistrict', 2, 'can create district', NULL, NULL, NULL, NULL),
('createMunicipal', 2, 'can create municipal', NULL, NULL, NULL, NULL),
('createRegion', 2, 'can create region', NULL, NULL, NULL, NULL),
('createStreet', 2, 'can create street', NULL, NULL, NULL, NULL),
('createTicket', 2, 'can create ticket', NULL, NULL, NULL, NULL),
('createUser', 2, 'can create user', NULL, NULL, NULL, NULL),
('createWorkArea', 2, 'can create work area', NULL, NULL, NULL, NULL),
('deleteTicket', 2, 'can delete ticket only for super admin', NULL, NULL, NULL, NULL),
('manager', 1, 'Manage the system', NULL, NULL, '1558073509', '1558077814'),
('super_admin', 1, 'Super User', NULL, NULL, '1558046459', '1558046459'),
('supervisor', 1, 'Supervisor', NULL, NULL, '1558093192', '1558093192'),
('updateDistrict', 2, 'can update district', NULL, NULL, NULL, NULL),
('updateMunicipal', 2, 'can update municipal', NULL, NULL, NULL, NULL),
('updateRegion', 2, 'can  update region', NULL, NULL, NULL, NULL),
('updateStreet', 2, 'can update street', NULL, NULL, NULL, NULL),
('updateTicket', 2, 'can update ticket', NULL, NULL, NULL, NULL),
('updateWorkArea', 2, 'can update work area', NULL, NULL, NULL, NULL),
('viewDistrict', 2, 'can view district', NULL, NULL, NULL, NULL),
('viewMunicipal', 2, 'can view municipal', NULL, NULL, NULL, NULL),
('viewRegion', 2, 'can view region', NULL, NULL, NULL, NULL),
('viewStreet', 2, 'can view street', NULL, NULL, NULL, NULL),
('viewTicket', 2, 'can view tickets', NULL, NULL, NULL, NULL),
('viewWorkArea', 2, 'can view work area', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'createUser'),
('super_admin', 'auditSystem'),
('super_admin', 'createUser');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `region` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `created_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`, `region`, `create_at`, `created_by`) VALUES
(1, 'ILALA', 1, '2019-05-17 14:21:00', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1557985128),
('m130524_201442_init', 1557985132);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_logs`
--

CREATE TABLE `mobile_logs` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `imei_no` varchar(200) NOT NULL,
  `last_logoin_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `municipal`
--

CREATE TABLE `municipal` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `region` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `municipal`
--

INSERT INTO `municipal` (`id`, `name`, `region`, `district`, `created_at`, `created_by`) VALUES
(1, 'ILALA', 1, 1, '2019-05-17 16:40:00', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `name`, `created_at`, `created_by`) VALUES
(1, 'DAR ES SALAAM', '2019-05-17 00:00:00', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `street`
--

CREATE TABLE `street` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `region` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `municipal` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `street`
--

INSERT INTO `street` (`id`, `name`, `region`, `district`, `municipal`, `created_at`, `created_by`) VALUES
(1, 'LIVINGSTONE', 1, 1, 1, '2019-05-17 12:22:22', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit`
--

CREATE TABLE `tbl_audit` (
  `id` int(11) NOT NULL,
  `activity` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `old` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `new` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transport_fees_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_audit`
--

INSERT INTO `tbl_audit` (`id`, `activity`, `module`, `action`, `old`, `new`, `maker`, `maker_time`, `transport_fees_id`) VALUES
(1, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-16:14:34:00', NULL),
(2, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-16:15:02:38', NULL),
(3, 'Ameangalia taarifa ya juan, Mmiliki wake ni 0672504802', 'User', 'View', '', '', 'admin', '2019-05-16:15:02:41', NULL),
(4, 'Ameangalia taarifa ya juan, Mmiliki wake ni 0672504802', 'User', 'View', '', '', 'admin', '2019-05-16:15:03:04', NULL),
(5, 'Ameangalia taarifa ya juan, Mmiliki wake ni 0672504802', 'User', 'View', '', '', 'admin', '2019-05-16:15:03:10', NULL),
(6, 'Ameangalia taarifa ya juan, namba zake ni 0672504802', 'User', 'View', '', '', 'admin', '2019-05-16:15:03:52', NULL),
(7, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-16:15:05:22', NULL),
(8, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-16:15:05:22', NULL),
(9, 'Ameangalia taarifa ya Manager, namba zake ni ', 'User', 'View', '', '', 'admin', '2019-05-16:15:05:29', NULL),
(10, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-16:15:06:45', NULL),
(11, 'Ameangalia taarifa ya Manager, namba zake ni ', 'User', 'View', '', '', 'admin', '2019-05-16:15:06:48', NULL),
(12, 'Ameangalia taarifa ya Manager, namba zake ni 0658499055', 'User', 'View', '', '', 'admin', '2019-05-16:15:08:09', NULL),
(13, 'Ameangalia taarifa ya juan, namba zake ni 0672504802', 'User', 'View', '', '', 'admin', '2019-05-16:15:08:58', NULL),
(14, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-16:15:10:31', NULL),
(15, 'New Login at 2019-05-16 15:26:14', 'ULG', 'login', '', '', 'admin', '2019-05-16:15:26:14', NULL),
(16, 'New Login at 2019-05-16 15:27:30', 'ULG', 'login', '', '', 'admin', '2019-05-16:15:27:30', NULL),
(17, 'New Login at 2019-05-16 15:27:49', 'ULG', 'login', '', '', 'admin', '2019-05-16:15:27:49', NULL),
(18, 'New Login at 2019-05-16 15:28:17', 'ULG', 'login', '', '', 'admin', '2019-05-16:15:28:17', NULL),
(19, 'New Login at 2019-05-16 15:31:43', 'ULG', 'login', '', '', 'admin', '2019-05-16:15:31:43', NULL),
(20, 'New Login at 2019-05-16 15:33:42', 'ULG', 'login', '', '', 'admin', '2019-05-16:15:33:42', NULL),
(21, 'New Login at 2019-05-16 15:34:29', 'ULG', 'login', '', '', 'admin', '2019-05-16:15:34:29', NULL),
(22, 'New Login at 2019-05-16 15:34:51', 'ULG', 'login', '', '', 'admin', '2019-05-16:15:34:51', NULL),
(23, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-16:15:36:17', NULL),
(24, 'New Login at 2019-05-16 15:36:51', 'ULG', 'login', '', '', 'manager', '2019-05-16:15:36:51', NULL),
(25, 'New Login at 2019-05-16 15:40:08', 'ULG', 'login', '', '', 'admin', '2019-05-16:15:40:08', NULL),
(26, 'New Login at 2019-05-16 15:41:11', 'ULG', 'Login', '', '', 'admin', '2019-05-16:15:41:12', NULL),
(27, 'New Login at 2019-05-16 15:46:39', 'ULG', 'Login', '', '', 'manager', '2019-05-16:15:46:39', NULL),
(28, 'New Login at 2019-05-16 15:47:28', 'ULG', 'Login', '', '', 'demo', '2019-05-16:15:47:28', NULL),
(29, 'New Login at 2019-05-16 16:01:41', 'ULG', 'Login', '', '', 'demo', '2019-05-16:16:01:41', NULL),
(30, 'New Login at 2019-05-16 16:06:11', 'ULG', 'Login', '', '', 'demo', '2019-05-16:16:06:11', NULL),
(31, 'New Login at 2019-05-16 17:17:37', 'ULG', 'Login', '', '', 'demo', '2019-05-16:17:17:37', NULL),
(32, 'New Login at 2019-05-16 17:17:57', 'ULG', 'Login', '', '', 'admin', '2019-05-16:17:17:57', NULL),
(33, 'New Login at 2019-05-16 17:18:30', 'ULG', 'Login', '', '', 'admin', '2019-05-16:17:18:30', NULL),
(34, 'admin Logout at 2019-05-16 17:25:52', 'ULG', 'Logout', '', '', 'admin', '2019-05-16:17:25:52', NULL),
(35, 'New Login at 2019-05-16 17:25:57', 'ULG', 'Login', '', '', 'admin', '2019-05-16:17:25:57', NULL),
(36, 'admin Logout at 2019-05-16 17:27:05', 'ULG', 'Logout', '', '', 'admin', '2019-05-16:17:27:05', NULL),
(37, 'New Login at 2019-05-16 19:19:26', 'ULG', 'Login', '', '', 'admin', '2019-05-16:19:19:26', NULL),
(38, 'New Login at 2019-05-16 20:00:49', 'ULG', 'Login', '', '', 'admin', '2019-05-16:20:00:49', NULL),
(39, 'New Login at 2019-05-16 20:12:29', 'ULG', 'Login', '', '', 'admin', '2019-05-16:20:12:29', NULL),
(40, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:01:44:21', NULL),
(41, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:02:11:07', NULL),
(42, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:02:11:57', NULL),
(43, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:02:12:30', NULL),
(44, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:02:12:38', NULL),
(45, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:02:12:44', NULL),
(46, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:02:12:52', NULL),
(47, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:02:12:59', NULL),
(48, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:02:13:56', NULL),
(49, 'New Login at 2019-05-17 09:01:26', 'ULG', 'Login', '', '', 'admin', '2019-05-17:09:01:26', NULL),
(50, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:09:06:53', NULL),
(51, 'New Login at 2019-05-17 09:12:15', 'ULG', 'Login', '', '', 'admin', '2019-05-17:09:12:15', NULL),
(52, 'admin Logout at 2019-05-17 09:12:30', 'ULG', 'Logout', '', '', 'admin', '2019-05-17:09:12:30', NULL),
(53, 'New Login at 2019-05-17 09:12:39', 'ULG', 'Login', '', '', 'manager', '2019-05-17:09:12:39', NULL),
(54, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'manager', '2019-05-17:09:17:17', NULL),
(55, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'manager', '2019-05-17:09:19:01', NULL),
(56, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:09:21:32', NULL),
(57, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:09:22:43', NULL),
(58, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:09:22:58', NULL),
(59, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:09:23:24', NULL),
(60, 'New Login at 2019-05-17 10:24:10', 'ULG', 'Login', '', '', 'manager', '2019-05-17:10:24:10', NULL),
(61, 'New Login at 2019-05-17 12:57:33', 'ULG', 'Login', '', '', 'admin', '2019-05-17:12:57:33', NULL),
(62, 'New Login at 2019-05-17 13:04:55', 'ULG', 'Login', '', '', 'admin', '2019-05-17:13:04:55', NULL),
(63, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:13:05:51', NULL),
(64, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:13:06:05', NULL),
(65, 'Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '', 'admin', '2019-05-17:13:07:13', NULL),
(66, 'New Login at 2019-05-17 13:08:18', 'ULG', 'Login', '', '', 'admin', '2019-05-17:13:08:19', NULL),
(67, 'New Login at 2019-05-17 14:20:06', 'ULG', 'Login', '', '', 'admin', '2019-05-17:14:20:06', NULL),
(68, 'New Login at 2019-05-17 14:24:02', 'ULG', 'Login', '', '', 'admin', '2019-05-17:14:24:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_transaction`
--

CREATE TABLE `ticket_transaction` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(200) NOT NULL,
  `begin_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `region` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `municipal` int(11) NOT NULL,
  `street` int(11) NOT NULL,
  `work_area` int(11) NOT NULL,
  `receipt_no` int(11) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `car_no` varchar(200) NOT NULL,
  `user` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `create_at` datetime NOT NULL,
  `created_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `municipal` int(11) NOT NULL,
  `street` int(11) NOT NULL,
  `work_area` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '10',
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `mobile`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `region`, `district`, `municipal`, `street`, `work_area`, `status`, `role`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'Salim Kondo', 'admin', '0657699266', 'Mv9kYOyisZ1Gk-CTJ3_n82PuegpsiwDY', '$2y$13$7JV6Rkg0Da3P2YFuhjZEre1FnvTB7Mr5/7A/GOI.pjAUJHbzcSnBS', 'N0R0j1cnSqRBx9PZTANSXmhbunnvndiE_1557137250', 'salim@webtechnologies', 1, 1, 1, 1, 1, '10', 'Super Administrator', 1557136974, 1557137249, '2019-05-17 14:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `work_area`
--

CREATE TABLE `work_area` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `region` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `municipal` int(11) NOT NULL,
  `street` int(11) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work_area`
--

INSERT INTO `work_area` (`id`, `name`, `amount`, `region`, `district`, `municipal`, `street`, `created_by`, `created_at`) VALUES
(1, 'KARIAKOO', '500.00', 1, 1, 1, 1, 'admin', '2019-05-17 16:21:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region` (`region`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mobile_logs`
--
ALTER TABLE `mobile_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipal`
--
ALTER TABLE `municipal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district` (`district`),
  ADD KEY `region` (`region`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `street`
--
ALTER TABLE `street`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipal` (`municipal`),
  ADD KEY `region` (`region`),
  ADD KEY `district` (`district`);

--
-- Indexes for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_transaction`
--
ALTER TABLE `ticket_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district` (`district`),
  ADD KEY `municipal` (`municipal`),
  ADD KEY `region` (`region`),
  ADD KEY `street` (`street`),
  ADD KEY `user` (`user`),
  ADD KEY `work_area` (`work_area`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `region` (`region`,`district`,`municipal`,`street`,`work_area`),
  ADD KEY `district` (`district`),
  ADD KEY `municipal` (`municipal`),
  ADD KEY `street` (`street`),
  ADD KEY `work_area` (`work_area`);

--
-- Indexes for table `work_area`
--
ALTER TABLE `work_area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district` (`district`),
  ADD KEY `municipal` (`municipal`),
  ADD KEY `region` (`region`),
  ADD KEY `street` (`street`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobile_logs`
--
ALTER TABLE `mobile_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `municipal`
--
ALTER TABLE `municipal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `street`
--
ALTER TABLE `street`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `ticket_transaction`
--
ALTER TABLE `ticket_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `work_area`
--
ALTER TABLE `work_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`region`) REFERENCES `region` (`id`);

--
-- Constraints for table `municipal`
--
ALTER TABLE `municipal`
  ADD CONSTRAINT `municipal_ibfk_1` FOREIGN KEY (`district`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `municipal_ibfk_2` FOREIGN KEY (`region`) REFERENCES `region` (`id`);

--
-- Constraints for table `street`
--
ALTER TABLE `street`
  ADD CONSTRAINT `street_ibfk_1` FOREIGN KEY (`municipal`) REFERENCES `municipal` (`id`),
  ADD CONSTRAINT `street_ibfk_2` FOREIGN KEY (`region`) REFERENCES `region` (`id`),
  ADD CONSTRAINT `street_ibfk_3` FOREIGN KEY (`district`) REFERENCES `district` (`id`);

--
-- Constraints for table `ticket_transaction`
--
ALTER TABLE `ticket_transaction`
  ADD CONSTRAINT `ticket_transaction_ibfk_1` FOREIGN KEY (`district`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `ticket_transaction_ibfk_2` FOREIGN KEY (`municipal`) REFERENCES `municipal` (`id`),
  ADD CONSTRAINT `ticket_transaction_ibfk_3` FOREIGN KEY (`region`) REFERENCES `region` (`id`),
  ADD CONSTRAINT `ticket_transaction_ibfk_4` FOREIGN KEY (`street`) REFERENCES `street` (`id`),
  ADD CONSTRAINT `ticket_transaction_ibfk_5` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `ticket_transaction_ibfk_6` FOREIGN KEY (`work_area`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`district`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`region`) REFERENCES `region` (`id`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`municipal`) REFERENCES `municipal` (`id`),
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`street`) REFERENCES `street` (`id`),
  ADD CONSTRAINT `user_ibfk_5` FOREIGN KEY (`work_area`) REFERENCES `work_area` (`id`);

--
-- Constraints for table `work_area`
--
ALTER TABLE `work_area`
  ADD CONSTRAINT `work_area_ibfk_1` FOREIGN KEY (`district`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `work_area_ibfk_2` FOREIGN KEY (`municipal`) REFERENCES `municipal` (`id`),
  ADD CONSTRAINT `work_area_ibfk_3` FOREIGN KEY (`region`) REFERENCES `region` (`id`),
  ADD CONSTRAINT `work_area_ibfk_4` FOREIGN KEY (`street`) REFERENCES `street` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
