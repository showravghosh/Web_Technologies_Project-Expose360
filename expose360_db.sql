-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2026 at 08:57 AM
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
-- Database: `expose360_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Master','Admin') DEFAULT 'Admin',
  `status` enum('Active','Inactive','Deleted') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`admin_id`, `full_name`, `email`, `phone`, `gender`, `password`, `role`, `status`, `created_at`) VALUES
(6, 'Showrav Ghosh', 'showrav@gmail.com', '01307674911', 'Male', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Active', '2026-01-21 03:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_admin`
--

CREATE TABLE `deleted_admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Master','Admin') NOT NULL,
  `status` enum('Deleted') DEFAULT 'Deleted',
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_admin`
--

INSERT INTO `deleted_admin` (`admin_id`, `full_name`, `email`, `phone`, `gender`, `password`, `role`, `status`, `deleted_at`) VALUES
(1, 'Test Admin', 'admin@test.com', '01812345678', 'Male', 'admin123', 'Admin', 'Deleted', '2026-01-20 15:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_emp`
--

CREATE TABLE `deleted_emp` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `date_joined` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `status` enum('Deleted') DEFAULT 'Deleted',
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_emp`
--

INSERT INTO `deleted_emp` (`emp_id`, `full_name`, `date_joined`, `salary`, `phone`, `gender`, `status`, `deleted_at`) VALUES
(6, 'Showrav Ghosh', '2026-01-20', 6.00, '01307674911', 'Male', 'Deleted', '2026-01-21 04:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_user`
--

CREATE TABLE `deleted_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `address` text NOT NULL,
  `division` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `photo` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `status` enum('Deleted') DEFAULT 'Deleted',
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_user`
--

INSERT INTO `deleted_user` (`id`, `full_name`, `birth_date`, `address`, `division`, `postal_code`, `phone`, `email`, `gender`, `photo`, `document`, `status`, `deleted_at`) VALUES
(1, 'user', '0000-00-00', '122', '12', '', '', '12', '', '', '', 'Deleted', '2026-01-20 05:34:10'),
(3, 'Test User', '1990-01-01', 'Dhaka', 'Dhaka', '1200', '01712345678', 'user@test.com', 'Male', 'user_3_1768914712.png', '', 'Deleted', '2026-01-20 15:44:40'),
(5, 'Tanvir Ahmed', '2026-01-22', 'Basundhara R/A , Dhaka', 'Dhaka', '2900', '+8801798402146', 'itachi@gmail.com', 'Male', '', '', 'Deleted', '2026-01-18 18:38:21'),
(6, 'MST. TONDRA', '2026-01-20', 'Basundhara R/A , Dhaka', 'Dhaka', '2900', '+8801827513311', 'silviafroz8@gmail.com', 'Female', 'user_6_1768887507.jpeg', '1768761639_Git Lab Manual Final 1.pdf', 'Deleted', '2026-01-20 13:21:49'),
(8, 'Tanvir Ahmed', '2002-03-26', 'Basundhara R/A , Dhaka', 'Dhaka', '2900', '+88017938402146', 'tanvir.cse2004@gmail.com', 'Male', '1768855113_Tanvir.jpeg', '1768855113_Database.pdf', 'Deleted', '2026-01-20 17:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `emp_account`
--

CREATE TABLE `emp_account` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `date_joined` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `phone` varchar(20) NOT NULL DEFAULT 'none',
  `gender` enum('Male','Female','Other') NOT NULL,
  `status` enum('Active','Inactive','Deleted') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_account`
--

INSERT INTO `emp_account` (`emp_id`, `full_name`, `date_joined`, `salary`, `phone`, `gender`, `status`, `created_at`) VALUES
(1, 'TANVIR AHMED', '2026-01-01', 5555.00, '', 'Male', 'Deleted', '2026-01-18 18:38:41'),
(3, 'Tanvir Ahmed', '2026-01-01', 6747566.00, '01307674922', 'Male', 'Active', '2026-01-19 14:03:43'),
(7, 'Showrav Ghosh', '2026-01-14', 3434.00, '01307674911', 'Male', 'Active', '2026-01-20 17:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected','Deleted') DEFAULT 'Pending',
  `is_visible` enum('Yes','No') DEFAULT 'Yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `content`, `photo`, `status`, `is_visible`, `created_at`) VALUES
(3, 8, 'sdfaf', '', 'Pending', 'Yes', '2026-01-19 20:57:09'),
(8, 10, 'this is 1st post', '', 'Pending', 'Yes', '2026-01-20 19:49:41'),
(9, 13, 'This is my first post', '', 'Pending', 'Yes', '2026-01-21 05:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `address` text NOT NULL,
  `division` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `photo` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Deleted') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `full_name`, `birth_date`, `address`, `division`, `postal_code`, `phone`, `email`, `password`, `gender`, `photo`, `document`, `status`, `created_at`, `updated_at`) VALUES
(1, 'user', '0000-00-00', '122', '12', '', '', '12', '111111', '', '', '', 'Deleted', '2026-01-16 17:40:44', '2026-01-20 05:34:10'),
(3, 'Test User', '1990-01-01', 'Dhaka', 'Dhaka', '1200', '01712345678', 'user@test.com', '123456', 'Male', 'user_3_1768914712.png', '', 'Deleted', '2026-01-16 18:30:49', '2026-01-20 15:44:40'),
(5, 'Tanvir Ahmed', '2026-01-22', 'Basundhara R/A , Dhaka', 'Dhaka', '2900', '+8801798402146', 'itachi@gmail.com', '123123', 'Male', '', '', 'Deleted', '2026-01-18 11:18:14', '2026-01-18 18:38:21'),
(6, 'MST. TONDRA', '2026-01-20', 'Basundhara R/A , Dhaka', 'Dhaka', '2900', '+8801827513311', 'silviafroz8@gmail.com', '111222', 'Female', 'user_6_1768887507.jpeg', '1768761639_Git Lab Manual Final 1.pdf', 'Deleted', '2026-01-18 18:40:39', '2026-01-20 13:21:49'),
(8, 'Tanvir Ahmed', '2002-03-26', 'Basundhara R/A , Dhaka', 'Dhaka', '2900', '+88017938402146', 'tanvir.cse2004@gmail.com', '11221122', 'Male', '1768855113_Tanvir.jpeg', '1768855113_Database.pdf', 'Deleted', '2026-01-19 20:38:33', '2026-01-20 17:03:19'),
(13, 'Showrav Ghosh', '2002-09-30', 'Jhenaidah', 'Khulna', '4073', '01307674911', 'showrav@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '1768966195_1676260801782.jpg', '1768966195_Output Trace Practice.pdf', 'Active', '2026-01-21 03:29:55', '2026-01-21 03:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `verification_req`
--

CREATE TABLE `verification_req` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_gmail` varchar(100) NOT NULL,
  `request_type` varchar(100) NOT NULL,
  `priority` enum('Low','Medium','High') NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL,
  `request_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `deleted_admin`
--
ALTER TABLE `deleted_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `deleted_emp`
--
ALTER TABLE `deleted_emp`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `deleted_user`
--
ALTER TABLE `deleted_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_account`
--
ALTER TABLE `emp_account`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `verification_req`
--
ALTER TABLE `verification_req`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deleted_admin`
--
ALTER TABLE `deleted_admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deleted_emp`
--
ALTER TABLE `deleted_emp`
  MODIFY `emp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `deleted_user`
--
ALTER TABLE `deleted_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emp_account`
--
ALTER TABLE `emp_account`
  MODIFY `emp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `verification_req`
--
ALTER TABLE `verification_req`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
