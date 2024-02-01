-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 09:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2022-12-30 18:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `BrandName` varchar(255) NOT NULL,
  `CreationDate` date NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `BrandName`, `CreationDate`, `UpdationDate`) VALUES
(13, 'Audi', '2022-12-20', '2023-01-03'),
(14, 'BMW', '2022-12-21', '2023-01-03'),
(15, 'Peugeot', '2022-12-21', '2023-01-03'),
(16, 'Tesla', '2022-12-23', '2023-01-03'),
(17, 'Fiat', '2022-12-24', '2023-01-03'),
(18, 'Hyundai', '2022-12-25', '2023-01-03'),
(19, 'Opel', '2022-12-26', '2023-01-03'),
(20, 'Citroen', '2023-01-03', '2023-01-03'),
(21, 'Toyota', '2023-01-03', '2023-01-03'),
(22, 'Volskwagen', '2023-01-03', '2023-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `car_brand_id` int(11) NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `car_dprice` int(5) NOT NULL,
  `car_modelyear` int(5) NOT NULL,
  `car_seatingcapacity` int(11) NOT NULL,
  `car_fueltype` varchar(255) NOT NULL,
  `car_status` varchar(255) NOT NULL,
  `car_img1` varchar(255) NOT NULL,
  `car_img2` varchar(255) NOT NULL,
  `car_img3` varchar(255) NOT NULL,
  `car_img4` varchar(255) NOT NULL,
  `car_img5` varchar(255) NOT NULL,
  `car_regdate` date NOT NULL DEFAULT current_timestamp(),
  `car_updationdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_brand_id`, `car_model`, `car_dprice`, `car_modelyear`, `car_seatingcapacity`, `car_fueltype`, `car_status`, `car_img1`, `car_img2`, `car_img3`, `car_img4`, `car_img5`, `car_regdate`, `car_updationdate`) VALUES
(21, 19, 'Vectra', 275, 2007, 4, 'Petrol', 'available', '2006-opel-vectra-sedan-01.jpg', '2006-opel-vectra-sedan-05.jpg', '2006-opel-vectra-sedan-07.jpg', '2006-opel-vectra-sedan-111.jpg', '', '2023-01-03', '2023-01-03'),
(22, 19, 'Vectra', 290, 2008, 4, 'Petrol', 'available', '2006-opel-vectra-sw-01.jpg', '2006-opel-vectra-sw-03.jpg', '2006-opel-vectra-sw-06.jpg', '2006-opel-vectra-sw-10.jpg', '', '2023-01-03', '2023-01-03'),
(23, 13, 'A3', 350, 2021, 4, 'Petrol', 'available', '2021-audi-a3-sedan-01.jpg', '2021-audi-a3-sedan-05.jpg', '2021-audi-a3-sedan-06.jpg', '2021-audi-a3-sedan-111.jpg', '', '2023-01-03', '2023-01-03'),
(24, 21, 'Corolla', 175, 2010, 4, 'Petrol', 'available', '2010-toyota-corolla-sedan-04.jpg', '2010-toyota-corolla-sedan-11.jpg', '2010-toyota-corolla-sedan-12.jpg', '2010-toyota-corolla-sedan-15.jpg', '', '2023-01-03', '2023-01-03'),
(25, 20, 'C5', 105, 2005, 4, 'Diesel', 'available', '2005-citroen-c5-sedan-02.jpg', '2005-citroen-c5-sedan-07.jpg', '2005-citroen-c5-sedan-11.jpg', '2005-citroen-c5-sedan-12.jpg', '', '2023-01-03', '2023-01-03'),
(26, 14, '320I', 550, 2022, 4, 'Petrol', 'available', '2019-bmw-3-serisi-02.jpg', '2019-bmw-3-serisi-03.jpg', '2019-bmw-3-serisi-05.jpg', '2019-bmw-3-serisi-06.jpg', '', '2023-01-03', '2023-01-03'),
(27, 22, 'Arteon', 335, 2017, 4, 'Petrol', 'available', '2017-vw-arteon-r-line-05.jpg', '2017-vw-arteon-r-line-111.jpg', '2017-vw-arteon-r-line-03.jpg', '2017-vw-arteon-r-line-04.jpg', '', '2023-01-03', '2023-01-03'),
(28, 22, 'Touareg', 315, 2014, 5, 'Diesel', 'available', '2014-volkswagen-touareg-suv-01.jpg', '2014-volkswagen-touareg-suv-02.jpg', '2014-volkswagen-touareg-suv-07.jpg', '2014-volkswagen-touareg-suv-08.jpg', '', '2023-01-03', '2023-01-03'),
(29, 13, 'Q5', 405, 2013, 5, 'Diesel', 'available', '2013-audi-q5-suv-09.jpg', '2013-audi-q5-suv-10.jpg', '2013-audi-q5-suv-11.jpg', '2013-audi-q5-suv-25.jpg', '', '2023-01-03', '2023-01-03'),
(30, 16, 'Model Y', 495, 2019, 4, 'Electric', 'available', '2022_tesla_model-y_4dr-suv_long-range_tds2_evox_2_1280x855.webp', '2022_tesla_model-y_4dr-suv_long-range_tds3_evox_2_1280x855.webp', 'images (2).jfif', 'images (3).jfif', '', '2023-01-03', '2023-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `contactusinfo`
--

CREATE TABLE `contactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext NOT NULL,
  `EmailId` varchar(120) NOT NULL,
  `ContactNo` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactusinfo`
--

INSERT INTO `contactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'deu', 'deu_rac@gmail.com', '02321234567');

-- --------------------------------------------------------

--
-- Table structure for table `contactusquery`
--

CREATE TABLE `contactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `EmailId` varchar(120) NOT NULL,
  `ContactNumber` char(11) NOT NULL,
  `Message` longtext NOT NULL,
  `PostingDate` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactusquery`
--

INSERT INTO `contactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(9, 'CEMIL DALAR', '43dalar@gmail.com', '05459233576', 'I want to rent a car. I\'m curious about something, I\'d appreciate it if you could answer it. What should we do after booking a car. Should I wait?', '2022-12-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `CarId` int(11) DEFAULT NULL,
  `FromDate` date DEFAULT NULL,
  `ToDate` date DEFAULT NULL,
  `TotalAmount` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `userEmail`, `CarId`, `FromDate`, `ToDate`, `TotalAmount`, `Status`, `PostingDate`) VALUES
(16, '43dalar@gmail.com', 25, '2023-01-04', '2023-01-07', 315, 1, '2023-01-03 19:47:35'),
(17, '43dalar@gmail.com', 21, '2023-01-06', '2023-01-08', 550, 2, '2023-01-03 19:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) NOT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `Dbo` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FullName`, `EmailId`, `Password`, `ContactNo`, `Dbo`, `Address`, `City`, `Country`, `RegDate`, `UpdationDate`) VALUES
(22, 'Cemil Dalar', '43dalar@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '5459233576', '11/05/2001', '', '', '', '2022-12-25 19:15:39', '2023-01-03 19:16:38'),
(23, 'Halil Sapuk', 'halil@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0545123456', '09/05/1995', '', '', '', '2022-12-28 19:17:26', '2023-01-03 19:19:55'),
(24, 'Enver Kara', 'enver@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '5461234567', '08/07/2003', NULL, NULL, NULL, '2023-01-03 19:21:28', '2023-01-03 19:22:15'),
(26, 'CEM?L DALAR', '123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '5459233576', NULL, NULL, NULL, NULL, '2023-01-03 20:53:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `car_brand_id` (`car_brand_id`);

--
-- Indexes for table `contactusinfo`
--
ALTER TABLE `contactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactusquery`
--
ALTER TABLE `contactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_ibfk_1` (`CarId`),
  ADD KEY `reservations_ibfk_2` (`userEmail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EmailId` (`EmailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contactusinfo`
--
ALTER TABLE `contactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contactusquery`
--
ALTER TABLE `contactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`car_brand_id`) REFERENCES `brands` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`CarId`) REFERENCES `cars` (`car_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`userEmail`) REFERENCES `users` (`EmailId`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
