-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 04:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sleept`
--

-- --------------------------------------------------------

--
-- Table structure for table `sleep_history`
--

CREATE TABLE `sleep_history` (
  `ID` varchar(50) DEFAULT NULL,
  `START` datetime DEFAULT NULL,
  `END` datetime DEFAULT NULL,
  `DURATION` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sleep_history`
--

INSERT INTO `sleep_history` (`ID`, `START`, `END`, `DURATION`) VALUES
('6BZKR0', NULL, NULL, NULL),
('HV1DBC', '2025-04-04 09:11:00', '2025-04-04 06:50:00', '21:39:00'),
('HV1DBC', '2025-04-04 09:11:00', '2025-04-04 06:50:00', '21:39:00'),
('8P96JZ', '2025-04-04 23:11:00', '2025-04-04 06:23:00', '07:12:00'),
('5JEU51', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` varchar(50) NOT NULL,
  `UNAME` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UNAME`, `PASSWORD`) VALUES
('5JEU51', '11@gmail.com', '$2y$10$4gv.IBRM11oWh7FE6dkjjuqz6yUp.JI9kIFiJ7EV4yCHyYA0PVwsi'),
('6BZKR0', 'k12@gmail.com', '$2y$10$AokapFucaTa35No4EXjd2eoiXvvyA2W3lN3y15InP0dOjyrV34Oau'),
('8P96JZ', 'admin12@gmail.com', '$2y$10$MbU06K6Kd9zGTX1X5jBLrek4j8Tq30GlfrfALcLfyDzsIbto.MmM.'),
('HV1DBC', 'k123@gmail.com', '$2y$10$2tsqLdCKdQjfrKV5hh7fC.oEgwMlno3f6k4vs.VqwPY/wtkjHEGQe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
