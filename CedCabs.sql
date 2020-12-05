-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2020 at 03:29 PM
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
(5, 'Faizabad', '100', 0),
(6, 'Basti', '150', 1),
(7, 'Gorakhpur', '210', 1),
(13, 'Prayagraj', '300', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `ride_id` int(10) NOT NULL,
  `ride_date` datetime NOT NULL,
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
(68, '2020-11-26 00:00:00', 'Indira Nagar', 'Prayagraj', '290', 'CedSUV', '', '3980', 2, '14'),
(73, '2020-11-25 00:00:00', 'Basti', 'BBD', '120', 'CedSUV', '122', '2357', 0, '12'),
(77, '2020-12-01 00:00:00', 'Barabanki', 'Faizabad', '40', 'CedMini', '12', '785', 2, '17'),
(78, '2020-12-01 00:00:00', 'Indira Nagar', 'Faizabad', '90', 'CedMicro', '', '1091', 0, '12'),
(81, '2020-11-28 00:00:00', 'BBD', 'Basti', '120', 'CedRoyal', '111', '1987', 2, '12'),
(82, '2020-11-28 00:00:00', 'Basti', 'Faizabad', '50', 'CedMini', '1', '865', 2, '17'),
(86, '2020-11-27 00:00:00', 'Charbagh', 'Prayagraj', '300', 'CedSUV', '111', '4495', 2, '29'),
(112, '2020-11-29 00:00:00', 'Indira Nagar', 'Gorakhpur', '200', 'CedRoyal', '25', '2895', 2, '12'),
(113, '2020-12-02 00:00:00', 'Indira Nagar', 'Faizabad', '90', 'CedSUV', '15', '1761', 0, '29'),
(114, '2020-11-29 00:00:00', 'Gorakhpur', 'BBD', '180', 'CedMicro', '', '1975', 0, '31'),
(115, '2020-12-03 00:00:00', 'Faizabad', 'Prayagraj', '200', 'CedSUV', '5', '3045', 2, '29'),
(119, '2020-12-04 00:00:00', 'Indira Nagar', 'Faizabad', '90', 'CedRoyal', '111', '1621', 2, '14'),
(120, '2020-12-04 00:00:00', 'Charbagh', 'Barabanki', '60', 'CedMicro', '', '785', 0, '12'),
(121, '2020-12-04 00:00:00', 'Indira Nagar', 'Basti', '140', 'CedSUV', '', '2221', 2, '31'),
(122, '2020-12-05 00:00:00', 'Indira Nagar', 'Prayagraj', '290', 'CedMicro', '', '2910', 1, '14'),
(123, '2020-12-05 00:00:00', 'Indira Nagar', 'Charbagh', '10', 'CedMicro', '', '185', 0, '14'),
(124, '2020-12-05 00:00:00', 'Barabanki', 'BBD', '30', 'CedMini', '44', '755', 1, '14'),
(125, '2020-12-05 00:00:00', 'BBD', 'Gorakhpur', '180', 'CedRoyal', '12', '2585', 1, '29'),
(126, '2020-12-05 00:00:00', 'Charbagh', 'Prayagraj', '300', 'CedMini', '9999', '3595', 0, '14'),
(127, '2020-12-05 00:00:00', 'Charbagh', 'Prayagraj', '300', 'CedMini', '9999', '3595', 1, '14');

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
(12, 'sam', 'Sameer Khan', '2020-12-05 17:31:35', '1234567890', 0, '332532dcfaa1cbf61e2a266bd723612c', 0),
(13, 'admin', 'admin', '2020-11-25 15:58:33', '8960406682', 1, '827ccb0eea8a706c4c34a16891f84e7b', 1),
(14, 'thepsb', 'Pradeep Singh Bisht', '2020-12-02 10:57:56', '8960406682', 1, '81dc9bdb52d04dc20036dbd8313ed055', 0),
(17, 'avi', 'avinash', '2020-11-30 12:12:10', '8933877097', 0, '202cb962ac59075b964b07152d234b70', 0),
(29, 'sak', 'Sakeena', '2020-12-05 17:32:20', '9999999999', 1, 'd09b9d3cb4f7cbef107bef0425ca8eaf', 0),
(31, 'raj', 'Rajiv', '2020-12-05 17:32:38', '8960406689', 1, '202cb962ac59075b964b07152d234b70', 0);

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
  MODIFY `ride_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
