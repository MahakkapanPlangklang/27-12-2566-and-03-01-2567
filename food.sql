-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 07:43 AM
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
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `DishID` int(11) NOT NULL,
  `DishName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`DishID`, `DishName`) VALUES
(1, 'ข้าวผัดกุ้ง');

-- --------------------------------------------------------

--
-- Table structure for table `dishingredients`
--

CREATE TABLE `dishingredients` (
  `DishID` int(11) NOT NULL,
  `IngredientID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `MeasurementUnit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dishingredients`
--

INSERT INTO `dishingredients` (`DishID`, `IngredientID`, `Quantity`, `MeasurementUnit`) VALUES
(1, 10, 3, 'ถ้วยตวง'),
(1, 11, 20, 'ตัว'),
(1, 12, 8, 'กลีบ'),
(1, 13, 4, 'ช้อนโต๊ะ'),
(1, 14, 1, 'ช้อนโต๊ะ'),
(1, 15, 2, 'ฟอง'),
(1, 16, 1, 'ช้อนโต๊ะ'),
(1, 17, 1, 'ช้อนโต๊ะ'),
(1, 18, 1, 'ต้น');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `IngredientID` int(11) NOT NULL,
  `IngredientName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`IngredientID`, `IngredientName`) VALUES
(1, 'ข้าว'),
(2, 'กุ้ง'),
(9, 'ต้นหอมซอย'),
(10, 'ข้าวสวย'),
(11, 'กุ้งขาวแกะเปลือกผ่าหลัง'),
(12, 'กระเทียมสับ'),
(13, 'แครอทหั่นเต๋าเล็ก'),
(14, 'น้ำมันพืช'),
(15, 'ไข่ไก่'),
(16, 'น้ำมันหอย'),
(17, 'ซีอิ๊วขาว'),
(18, 'ต้นหอมซอย'),
(19, 'แตงกวา'),
(20, 'ต้นหอม'),
(21, 'ผักชี'),
(22, 'มะนาวหั่นซีก');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`DishID`);

--
-- Indexes for table `dishingredients`
--
ALTER TABLE `dishingredients`
  ADD PRIMARY KEY (`DishID`,`IngredientID`),
  ADD KEY `IngredientID` (`IngredientID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`IngredientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `DishID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `IngredientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dishingredients`
--
ALTER TABLE `dishingredients`
  ADD CONSTRAINT `dishingredients_ibfk_1` FOREIGN KEY (`DishID`) REFERENCES `dishes` (`DishID`),
  ADD CONSTRAINT `dishingredients_ibfk_2` FOREIGN KEY (`IngredientID`) REFERENCES `ingredients` (`IngredientID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
