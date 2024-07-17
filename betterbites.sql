-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 09:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `betterbites`
--

-- --------------------------------------------------------

--
-- Table structure for table `donatefood`
--

CREATE TABLE `donatefood` (
  `id` int(11) NOT NULL,
  `image` blob NOT NULL,
  `foodtype` varchar(20) NOT NULL,
  `price` int(50) NOT NULL,
  `location` mediumtext NOT NULL,
  `dailyactive` varchar(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `time` datetime(6) NOT NULL,
  `filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donatefood`
--

INSERT INTO `donatefood` (`id`, `image`, `foodtype`, `price`, `location`, `dailyactive`, `username`, `time`, `filename`) VALUES
(1, '', 'vegetarian', 0, '\nIndigo Restaurant\n5th Floor, 6th Block, Elite Building, Industrial Layout, Jyoti Nivas College Road, Koramangala 5th Block, Bangalore, Bengaluru, Karnataka', 'yes', 'tankgunjan531@gmail.com', '2024-07-10 07:25:59.000000', 'heroo.png'),
(3, '', 'vegetarian', 0, '66, 14th Main, Kammagondanhalli,\n\nJalahalli (West),\n\nBangalore-560015', 'yes', 'tankgunjan531@gmail.com', '2024-07-10 07:27:21.000000', 'food.jpg'),
(4, '', 'vegetarian', 10, 'Radisson Blu Hotel,Near Panchvati Cross Roads, Off C.G. Road, Ambawadi, Ahmedabad, Gujarat', 'no', 'amitofficial@gmail.com', '2024-07-10 08:44:10.000000', 'foood.jpg'),
(6, '', 'vegetarian', 0, 'banglore', 'no', 'tankgunjan531@gmail.com', '2024-07-11 09:13:52.000000', 'freefood.jpg'),
(7, '', 'non vegetarian', 10, 'banglore', 'no', 'tankgunjan531@gmail.com', '2024-07-11 09:17:40.000000', 'nonveg.jpg'),
(8, '', 'vegetarian', 0, 'gamapipaliya', 'no', 'tankgunjan531@gmail.com', '2024-07-11 09:52:38.000000', 'food.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(25) NOT NULL,
  `city` varchar(100) NOT NULL,
  `contact` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`name`, `email`, `password`, `city`, `contact`) VALUES
('Amit', 'amitofficial@gmail.com', '12345', 'Ahmedabad', 91),
('Gunjan', 'tankgunjan531@gmail.com', '@ghj4569', 'banglore', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donatefood`
--
ALTER TABLE `donatefood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donatefood`
--
ALTER TABLE `donatefood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
