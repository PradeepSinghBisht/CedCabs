-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 07:17 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cedcabs`
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
(13, 'Prayagraj', '300', 1),
(19, 'Hapur', '120', 1);

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
(54, '2020-11-30', 'BBD', 'Basti', '120', 'CedRoyal', '22', '1987', 2, '12'),
(59, '2020-11-30', 'Indira Nagar', 'BBD', '20', 'CedMicro', '', '305', 1, '14'),
(61, '2020-11-27', 'Barabanki', 'Basti', '90', 'CedRoyal', '123', '1621', 1, '12'),
(68, '2020-11-26', 'Indira Nagar', 'Prayagraj', '290', 'CedSUV', '', '3980', 2, '14'),
(73, '2020-11-25', 'Basti', 'BBD', '120', 'CedSUV', '122', '2357', 1, '12'),
(77, '2020-12-01', 'Barabanki', 'Faizabad', '40', 'CedMini', '12', '785', 2, '17'),
(78, '2020-12-01', 'Indira Nagar', 'Faizabad', '90', 'CedMicro', '', '1091', 0, '12'),
(81, '2020-11-28', 'BBD', 'Basti', '120', 'CedRoyal', '111', '1987', 1, '12'),
(82, '2020-11-28', 'Basti', 'Faizabad', '50', 'CedMini', '1', '865', 2, '19'),
(86, '2020-11-27', 'Charbagh', 'Prayagraj', '300', 'CedSUV', '111', '4495', 1, '29'),
(112, '2020-11-29', 'Indira Nagar', 'Gorakhpur', '200', 'CedRoyal', '25', '2895', 2, '29'),
(113, '2020-12-02', 'Indira Nagar', 'Faizabad', '90', 'CedSUV', '15', '1761', 0, '29'),
(114, '2020-11-29', 'Gorakhpur', 'BBD', '180', 'CedMicro', '', '1975', 0, '31'),
(115, '2020-12-03', 'Faizabad', 'Prayagraj', '200', 'CedSUV', '5', '3045', 2, '29'),
(119, '2020-12-04', 'Indira Nagar', 'Faizabad', '90', 'CedRoyal', '111', '1621', 2, '14'),
(120, '2020-12-04', 'Charbagh', 'Barabanki', '60', 'CedMicro', '', '785', 0, '12'),
(121, '2020-12-04', 'Indira Nagar', 'Basti', '140', 'CedSUV', '', '2221', 2, '14');

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
(17, 'avi', 'avinash', '2020-11-30 12:12:10', '8933877097', 0, '202cb962ac59075b964b07152d234b70', 0),
(29, 'sak', 'Sakeena', '2020-12-03 08:46:24', '1234567890', 1, 'd09b9d3cb4f7cbef107bef0425ca8eaf', 0),
(31, 'raj', 'Rajiv', '2020-12-03 09:03:03', '1234567890', 0, '65a1223dae83b8092c4edba0823a793c', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `ride_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;