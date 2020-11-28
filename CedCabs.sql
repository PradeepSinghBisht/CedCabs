-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2020 at 03:01 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CedCabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `distance` varchar(50) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `distance`, `is_available`) VALUES
(1, 'Charbagh', '0', 1),
(2, 'Indira Nagar', '10', 1),
(3, 'BBD', '30', 1),
(4, 'Barabanki', '60', 1),
(5, 'Faizabad', '100', 1),
(6, 'Basti', '150', 1),
(7, 'Gorakhpur', '210', 1),
(13, 'Prayagraj', '300', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `ride_id` int(10) NOT NULL,
  `ride_date` date NOT NULL,
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `total_distance` varchar(50) NOT NULL,
  `cab_type` varchar(10) NOT NULL,
  `luggage` varchar(50) NOT NULL,
  `total_fare` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  `customer_user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`ride_id`, `ride_date`, `from`, `to`, `total_distance`, `cab_type`, `luggage`, `total_fare`, `status`, `customer_user_id`) VALUES
(39, '2020-11-25', 'Indira Nagar', 'BBD', '20', '', '1', '545', 1, '12'),
(44, '2020-11-26', 'Indira Nagar', 'Gorakhpur', '200', '', '', '2145', 2, '12'),
(48, '2020-11-27', 'Charbagh', 'Indira Nagar', '10', '', '1', '345', 0, '14'),
(49, '2020-11-27', 'Charbagh', 'Prayagraj', '300', '', '1', '3445', 2, '14'),
(50, '2020-11-27', 'Charbagh', 'Faizabad', '100', '', '1', '1593', 0, '14'),
(51, '2020-11-27', 'Charbagh', 'Indira Nagar', '10', '', '', '185', 2, '14'),
(53, '2020-11-28', 'BBD', 'Indira Nagar', '20', 'CedRoyal', '11', '595', 2, '14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dateofsignup` datetime NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `isblock` tinyint(1) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `is_admin`) VALUES
(12, 'sam', 'Sameer Khan', '2020-11-25 15:56:24', '89898988912', 1, '332532dcfaa1cbf61e2a266bd723612c', 0),
(13, 'admin', 'admin', '2020-11-25 15:58:33', '8960406682', 1, '1b80c66fa2d7186a462020c33d639557', 1),
(14, 'thepsb', 'Pradeep Singh Bisht', '2020-11-25 15:59:52', '89604066823', 1, '202cb962ac59075b964b07152d234b70', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ride`
--
ALTER TABLE `ride`
  ADD PRIMARY KEY (`ride_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `ride_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
