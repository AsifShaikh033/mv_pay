-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2025 at 11:59 AM
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
-- Database: `mv_pay`
--

-- --------------------------------------------------------

--
-- Table structure for table `circles`
--

CREATE TABLE `circles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `circlecode` int(11) DEFAULT NULL,
  `circlename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `circles`
--

INSERT INTO `circles` (`id`, `circlecode`, `circlename`, `created_at`, `updated_at`) VALUES
(1, 36, 'ANDAMAN AND NICOBAR ISLANDS', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(2, 1, 'Andhra Pradesh', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(3, 26, 'ARUNACHAL PRADESH', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(4, 2, 'Assam', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(5, 3, 'Bihar', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(6, 42, 'Bihar and Jharkhand', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(7, 4, 'Chennai', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(8, 27, 'CHHATTISGARH', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(9, 41, 'DADRA AND NAGAR', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(10, 40, 'DAMAN AND DIU', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(11, 5, 'Delhi', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(12, 28, 'GOA', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(13, 6, 'Gujarat', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(14, 7, 'Haryana', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(15, 8, 'Himachal Pradesh', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(16, 9, 'Jammu & Kashmir', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(17, 24, 'Jharkhand', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(18, 10, 'Karnataka', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(19, 11, 'Kerala', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(20, 12, 'Kolkata', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(21, 39, 'LAKSHADWEEP', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(22, 14, 'MADHYA PRADESH CHHATTISGARH', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(23, 13, 'Maharashtra', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(24, 29, 'MANIPUR', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(25, 30, 'MEGHALAYA', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(26, 31, 'MIZORAM', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(27, 15, 'Mumbai', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(28, 32, 'NAGALAND', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(29, 16, 'North East', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(30, 17, 'Odisha', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(31, 38, 'PUDUCHERRY', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(32, 18, 'Punjab', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(33, 19, 'Rajasthan', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(34, 33, 'SIKKIM', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(35, 20, 'Tamil Nadu', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(36, 37, 'TELANGANA', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(37, 25, 'TRIPURA', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(38, 34, 'UTTAR PRADESH', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(39, 21, 'Uttar Pradesh - East', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(40, 22, 'Uttar Pradesh - West', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(41, 35, 'UTTARAKHAND', '2025-02-01 06:20:34', '2025-02-01 06:20:34'),
(42, 23, 'West Bengal', '2025-02-01 06:20:34', '2025-02-01 06:20:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `circles`
--
ALTER TABLE `circles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `circles`
--
ALTER TABLE `circles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
