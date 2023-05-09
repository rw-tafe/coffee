-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2022 at 03:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rosscoscoffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(10) NOT NULL,
  `coffeeID` int(11) NOT NULL,
  `cartStatus` varchar(256) DEFAULT NULL,
  `userID` int(10) NOT NULL,
  `coffeeQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `coffeeID`, `cartStatus`, `userID`, `coffeeQuantity`) VALUES
(24, 5, 'paid', 2, 1),
(25, 1, 'paid', 2, 1),
(26, 5, 'paid', 2, 1),
(27, 8, 'paid', 2, 1),
(28, 7, 'paid', 2, 1),
(31, 8, 'paid', 1, 1),
(32, 6, 'paid', 1, 1),
(33, 7, 'paid', 1, 1),
(34, 1, 'paid', 1, 1),
(35, 6, 'paid', 1, 1),
(36, 8, 'paid', 1, 1),
(37, 1, 'unpaid', 3, 1),
(38, 8, 'unpaid', 3, 1),
(40, 6, 'unpaid', 3, 1),
(41, 8, 'unpaid', 3, 1),
(42, 2, 'unpaid', 3, 1),
(43, 6, 'unpaid', 3, 1),
(44, 6, 'unpaid', 3, 1),
(45, 6, 'unpaid', 3, 1),
(46, 6, 'unpaid', 3, 1),
(50, 8, 'paid', 2, 1),
(52, 3, 'paid', 2, 1),
(53, 6, 'paid', 2, 1),
(56, 5, 'paid', 2, 1),
(57, 5, 'paid', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coffee`
--

CREATE TABLE `coffee` (
  `coffeeID` int(10) NOT NULL,
  `coffeeName` varchar(256) NOT NULL,
  `coffeeDescription` text NOT NULL,
  `coffeePrice` decimal(10,2) NOT NULL,
  `coffeePhoto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coffee`
--

INSERT INTO `coffee` (`coffeeID`, `coffeeName`, `coffeeDescription`, `coffeePrice`, `coffeePhoto`) VALUES
(1, 'Cappuccino', 'A cappuccino is an espresso-based coffee drink that originated in Italy and is prepared with steamed milk foam.', '4.59', 'cappuccino.png'),
(2, 'Latte', 'Caffè latte, often shortened to just latte in English, is a coffee beverage of Italian origin made with espresso and steamed milk.', '4.69', 'latte.png'),
(3, 'Long black', 'A long black is a style of coffee commonly found in Australia and New Zealand.', '3.89', 'long-black.png'),
(4, 'Mocha', 'A caffè mocha, also called mocaccino, is a chocolate-flavoured warm beverage that is a variant of a caffè latte, commonly served in a glass rather than a mug. ', '4.99', 'mocha.png'),
(5, 'Hot chocolate', 'Hot chocolate, also known as hot cocoa or drinking chocolate, is heated chocolate milk. ', '5.99', 'hot-chocolate.png'),
(6, 'Flat white', 'A flat white is a coffee drink consisting of espresso with microfoam (steamed milk with small, fine bubbles and a glossy or velvety consistency).', '4.99', 'flat-white.png'),
(7, 'Matcha latte', 'A matcha latte consists of three simple ingredients: matcha powder, water and/or milk, and an optional sweetener. ', '6.29', 'matcha-latte.png'),
(8, 'Sakura latte', 'Sakura latte is a sweet and creamy warm drink that blends milk with cherry blossom powder. ', '6.29', 'sakura-latte.png'),
(11, 'Super Coffee', 'Super Coffee keeps you awake more than 24 hours!!!', '99.49', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `orderID` int(10) NOT NULL,
  `orderItems` text NOT NULL,
  `orderPrice` decimal(10,2) NOT NULL,
  `orderTime` datetime NOT NULL,
  `userID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`orderID`, `orderItems`, `orderPrice`, `orderTime`, `userID`) VALUES
(10, 'Hot chocolate x 1 Cappuccino x 1 ', '10.58', '2022-08-22 11:11:47', 2),
(12, 'Sakura latte x 1<br/>Matcha latte x 1<br/>Hot chocolate x 1<br/>', '18.57', '2022-08-22 11:58:20', 2),
(13, 'Super Coffee x 1<br/>Sakura latte x 2<br/>Matcha latte x 1<br/>Flat white x 2<br/>Cappuccino x 1<br/>', '133.39', '2022-08-23 01:04:38', 1),
(14, 'Sakura latte x 1<br/>Long black x 1<br/>Hot chocolate x 2<br/>Flat white x 1<br/>', '27.15', '2022-08-23 09:08:09', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `firstName` varchar(256) DEFAULT NULL,
  `lastName` varchar(256) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `email`, `username`, `password`, `salt`) VALUES
(1, 'admin', 'admin', 'admin@test.com', 'admin', '616ce14c61e7244968adabb0919afe5f688ffcb7848630b5f5348f8cfca2a659', 'f87de62de9899f9758c31df48e62346f'),
(2, 'user1', 'test', 'user1test@test.com', 'user1', '4d554c87f38d573e24e74bc7ddb640fc198831eb6e9b867d965a97be6595f7c2', '0af80f2f8e4496ace8bdc939d960ae15'),
(3, 'user2', 'test', 'user2test@test.com', 'user2', 'f2c0d0b8b4cfed354d9067d9740fda156731e1e84e851509a7764d0a02d4f4fb', '7c39e51ac74b9153c5982ba928e65cfe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `coffeeID` (`coffeeID`);

--
-- Indexes for table `coffee`
--
ALTER TABLE `coffee`
  ADD PRIMARY KEY (`coffeeID`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `coffee`
--
ALTER TABLE `coffee`
  MODIFY `coffeeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `orderID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`coffeeID`) REFERENCES `coffee` (`coffeeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
