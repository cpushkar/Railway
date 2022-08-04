-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 03, 2022 at 06:37 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railway`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('abhinav.shambharkar19@vit.edu', 'abhi#2227');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pnr` varchar(100) NOT NULL,
  `trainnumber` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `seat_no` varchar(100) NOT NULL,
  `fare` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `email`, `pnr`, `trainnumber`, `name`, `age`, `class`, `seat_no`, `fare`) VALUES
(1, 'ashambharkar04@gmail.com', '104157027', '12859', 'Abhinav Shambharkar', '20', 'AC 2-Tier', 'A35', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `email`, `number`, `message`) VALUES
(1, 'ashambharkar04@gmail.com', '98821677', 'hii  i am abhinav ');

-- --------------------------------------------------------

--
-- Table structure for table `fare`
--

CREATE TABLE `fare` (
  `id` int(100) NOT NULL,
  `trainnumber` int(100) NOT NULL,
  `General` varchar(100) NOT NULL,
  `AC1` varchar(100) NOT NULL,
  `AC2` varchar(100) NOT NULL,
  `FC` varchar(100) NOT NULL,
  `SLP` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fare`
--

INSERT INTO `fare` (`id`, `trainnumber`, `General`, `AC1`, `AC2`, `FC`, `SLP`) VALUES
(1, 12859, '700 Rs', '2000 Rs', '1500 Rs', '1000 Rs', '800 Rs');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `email`, `datetime`, `message`, `status`) VALUES
(3, 'ashambharkar04@gmail.com', '2021-12-24 15:30:48', 'Your Ticket For PNR Number8672753832is cancelled.', 1),
(5, 'ashambharkar04@gmail.com', '2021-12-24 21:29:59', 'Your Ticket For PNR Number 733774 is cancelled.', 0),
(7, 'ashambharkar04@gmail.com', '2021-12-24 21:39:30', 'Your Train Ticket booking is successfull !!!', 1),
(8, 'ashambharkar04@gmail.com', '2021-12-24 21:40:47', 'Your Ticket For PNR Number 127391183 is cancelled.', 1),
(9, 'ashambharkar04@gmail.com', '2021-12-27 20:42:42', 'Your Train Ticket booking is successfull !!!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `otp` varchar(100) NOT NULL,
  `is_expired` int(100) NOT NULL,
  `Timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `email`, `otp`, `is_expired`, `Timestamp`) VALUES
(1, 'abhinav.shambharkar19@vit.edu', '918345', 0, '2021-10-22 23:32:55'),
(2, 'ashambharkar04@gmail.com', '160483', 0, '2021-10-22 23:43:50'),
(3, 'abhinav.shambharkar19@vit.edu', '603080', 0, '2021-10-23 00:19:27'),
(4, 'abhinav.shambharkar19@vit.edu', '128064', 0, '2021-10-23 00:21:17'),
(5, 'abhinav.shambharkar19@vit.edu', '671117', 1, '2021-10-23 00:22:46'),
(6, 'abhinav.shambharkar19@vit.edu', '400623', 1, '2021-10-23 00:29:20'),
(7, 'abhinav.shambharkar19@vit.edu', '275979', 1, '2021-12-25 02:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `trainnumber` int(100) NOT NULL,
  `trainname` varchar(100) NOT NULL,
  `trainfrom` varchar(100) NOT NULL,
  `trainto` varchar(100) NOT NULL,
  `departure` varchar(100) NOT NULL,
  `reaches` varchar(100) NOT NULL,
  `general` varchar(100) NOT NULL,
  `AC1` varchar(100) NOT NULL,
  `AC2` varchar(100) NOT NULL,
  `FC` varchar(100) NOT NULL,
  `SLP` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trains`
--

INSERT INTO `trains` (`id`, `date`, `trainnumber`, `trainname`, `trainfrom`, `trainto`, `departure`, `reaches`, `general`, `AC1`, `AC2`, `FC`, `SLP`) VALUES
(1, '2021-12-20', 12859, 'GITANJALI EXPRESS', 'Nagpur', 'Pune Jn', '12:10 pm ', '6:30 am', '30', '54', '27', '7', '1'),
(2, '2021-10-21', 11345, 'Howrah Express', 'Bhandara', 'Mumbai', '3:00 pm', '1:00 am', '23', '34', '45', '56', '14');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `fullname`, `email`, `phonenumber`, `state`, `address`, `DOB`, `photo`, `password`) VALUES
(1, 'Abhinav Shambharkar', 'ashambharkar04@gmail.com', '9860215374', 'Maharashtra', 'Bhandara', '10/12/2001', 'abhi.png', 'qazwsxedc'),
(2, 'Kshitij Taley', 'kshitij.taley19@vit.edu', '9766726823', 'Maharashtra', 'Akola', '23/6/2001', 'Screenshot (1).png', 'kshitij'),
(3, 'Shreyash mendhekar', 'shreyash.mendhekar19@vit.edu', '8647679364', 'Maharashtra', 'pune', '5//8/2001', 'Screenshot (6).png', 'shreyash'),
(4, 'vallabh Niturkar', 'vallabh.niturkar19@vit.edu', '864766879', 'Maharashtra', 'parbhani', '2/7/2001', 'Screenshot (4).png', 'vallabh'),
(5, 'sanika salunkhe', 'sanika.saunkhe19@vit.edu', '562171829', 'Maharashtra', 'pune', '12/1/2001', 'Screenshot (15).png', 'sanika'),
(10, 'Abhinav Shambharkar', 'abhinav.shambharkar19@vit.edu', '546787987', 'Maharashtra', 'hjnmmb', '', 'abhi.png', 'abhi123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fare`
--
ALTER TABLE `fare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fare`
--
ALTER TABLE `fare`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trains`
--
ALTER TABLE `trains`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
