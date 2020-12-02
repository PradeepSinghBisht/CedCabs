-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2020 at 02:48 PM
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
(39, '2020-11-25', 'Indira Nagar', 'BBD', '20', 'CedRoyal', '1', '545', 0, '12'),
(44, '2020-11-26', 'Indira Nagar', 'Gorakhpur', '200', 'CedMicro', '', '2145', 2, '12'),
(50, '2020-11-27', 'Charbagh', 'Faizabad', '100', 'CedRoyal', '1', '1593', 0, '14'),
(53, '2020-11-28', 'BBD', 'Indira Nagar', '20', 'CedRoyal', '11', '595', 2, '14'),
(54, '2020-11-30', 'BBD', 'Basti', '120', 'CedRoyal', '22', '1987', 2, '12'),
(59, '2020-11-30', 'Indira Nagar', 'BBD', '20', 'CedMicro', '', '305', 0, '14'),
(61, '2020-11-30', 'Barabanki', 'Basti', '90', 'CedRoyal', '123', '1621', 1, '14'),
(68, '2020-11-30', 'Indira Nagar', 'Prayagraj', '290', 'CedSUV', '', '3980', 2, '14'),
(73, '2020-11-30', 'Basti', 'BBD', '120', 'CedSUV', '122', '2357', 2, '12'),
(76, '2020-11-30', 'Charbagh', 'Basti', '150', 'CedMicro', '', '1703', 0, '12'),
(77, '2020-12-01', 'Barabanki', 'Faizabad', '40', 'CedMini', '12', '785', 2, '17'),
(78, '2020-12-01', 'Indira Nagar', 'Faizabad', '90', 'CedMicro', '', '1091', 0, '12'),
(81, '2020-12-01', 'BBD', 'Basti', '120', 'CedRoyal', '111', '1987', 1, '12'),
(82, '2020-12-01', 'Basti', 'Faizabad', '50', 'CedMini', '1', '865', 2, '19'),
(86, '2020-12-01', 'Charbagh', 'Prayagraj', '300', 'CedSUV', '111', '4495', 1, '14'),
(88, '2020-12-02', 'Gorakhpur', 'Prayagraj', '90', 'CedMicro', '', '1091', 1, '14');

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
(12, 'sam', 'Sameer Khan', '2020-11-30 20:02:31', '8989989882', 1, '332532dcfaa1cbf61e2a266bd723612c', 0),
(13, 'admin', 'admin', '2020-11-25 15:58:33', '8960406682', 1, '1b80c66fa2d7186a462020c33d639557', 1),
(14, 'thepsb', 'Pradeep Singh Bisht', '2020-12-02 10:57:56', '8960406682', 1, '202cb962ac59075b964b07152d234b70', 0),
(17, 'avi', 'avinash', '2020-11-30 12:12:10', '8933877097', 0, '202cb962ac59075b964b07152d234b70', 0);

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
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `ride_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
