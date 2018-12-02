-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2018 at 10:42 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webstore`
--
CREATE DATABASE  IF NOT EXISTS webstore;

use webstore;
-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(8) NOT NULL,
  `customerEmail` varchar(50) NOT NULL,
  `customerPassword` varchar(100) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `admin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerEmail`, `customerPassword`, `customerName`, `admin`) VALUES
(681875, 'a@a.com', 'a', 'Pablo', 'a'),
(736010, 'johnwick@gmail.com', 'password', 'John', 'na');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(10) NOT NULL,
  `itemName` varchar(128) NOT NULL,
  `itemPrice` float NOT NULL,
  `itemDescription` varchar(1000) NOT NULL,
  `amount` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `itemName`, `itemPrice`, `itemDescription`, `amount`) VALUES
(1267, 'coca-coler', 1.29, 'Enjoy this refreshing beverage', 3338),
(1368, 'Deadshot Daiquiri', 3.99, 'Tasty, probably. Refrigerate please', 998),
(2347, 'Secret Sauce', 0.59, 'It''s a sauce made with secrets', 997),
(3345, 'Speed Cola', 1.99, 'Speedy drink', 997),
(3627, 'Mountain Water', 0.99, 'It''s water', 997),
(5427, 'Bepis', 1.59, 'Enjoy this refreshing beverage', 999),
(5789, 'Nuka-Cola', 9.99, 'Brought to you by vault-tec.', 999),
(7829, 'Winter''s Wail', 9.99, 'It''s alcohol. Don''t order on Sunday', 999),
(8768, 'Timeslip Soda', 5.99, 'Makes mysterbox and packapunch go faster.', 998),
(9823, 'Phd Slider', 2.99, 'Slides are fun', 997);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `orderId` int(6) NOT NULL,
  `userId` int(6) NOT NULL,
  `itemId` int(6) NOT NULL,
  `amount` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`orderId`, `userId`, `itemId`, `amount`) VALUES
(614044, 681875, 2347, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`orderId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
