-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 03:06 PM
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
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `date_of_joining` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `mobile`, `address`, `salary`, `date_of_joining`) VALUES
(1, 'Devansh Agrawal', '7225032698', '225, Chaman Ganj, Sipri Bazar, Jhansi, U.P', 100000.00, '2024-06-01'),
(2, 'Devansh Agrawal', '7225032698', '225, Chaman Ganj, Sipri Bazar, Jhansi, U.P', 100000.00, '2024-06-01'),
(3, 'Rohan Agrawal', '8694662256', '225, Chaman Ganj, Sipri Bazar, Jhansi, U.P', 200000.00, '2024-07-01'),
(4, 'Rohan Agrawal', '8694662256', '225, Chaman Ganj, Sipri Bazar, Jhansi, U.P', 200000.00, '2024-07-01'),
(6, 'Sakshi Singhal', '8569862564', 'flat no. 1501, Sky towers, Jhansi', 500000.00, '2022-01-05'),
(7, 'Aviral Singhal', '8599689256', '54, juhu, Mumbai', 400000.00, '2024-07-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
