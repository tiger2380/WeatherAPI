-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2021 at 07:51 AM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WeatherAPI`
--

-- --------------------------------------------------------

--
-- Table structure for table `ApiToken`
--

CREATE TABLE `ApiToken` (
  `id` int NOT NULL,
  `Token` varchar(255) NOT NULL,
  `UsageCount` int DEFAULT 0,
  `LastUsedOn` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ApiToken`
--

INSERT INTO `ApiToken` (`id`, `Token`, `UsageCount`, `LastUsedOn`) VALUES
(1, 'QkgAVGXuebE9beJEV6iaMKRWf4eDAtALwi9FibuXvR37HYqEJuQKmVdv9eUEyx88', 0, NULL),
(2, '3o2fQgpAfxmQhPDsvhDThhyDMZZ7bRh7VcUGAn24UYJWnjVFDtnfZk77Go6NxB62', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ApiToken`
--
ALTER TABLE `ApiToken`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ApiToken`
--
ALTER TABLE `ApiToken`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
