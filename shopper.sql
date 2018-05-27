-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2015 at 05:36 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopper`
--
CREATE DATABASE IF NOT EXISTS `shopper` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shopper`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `addressid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `contact` varchar(20) NOT NULL,
  PRIMARY KEY (`addressid`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressid`, `email`, `street`, `city`, `state`, `pin`, `contact`) VALUES
(1, 'cachme07@gmail.com', 'gali no. 123', 'karnal', 'haryana', '132001', '9855755834'),
(2, 'cachme07@gmail.com', 'gali no. 234', 'patiala', 'punjab', '147001', '9416055834'),
(3, 'cachme07@gmail.com', 'gali', 'city', 'state', '324', '5436'),
(4, 'cachme07@gmail.com', 'tryuhj', 'kgfd', 'fghj', '9876', '6789'),
(5, 'amrish_goel15@yahoo.com', '120 atam nagar', 'ludhiana', 'punjab', '141001', '9888509419'),
(6, 'parulshalini17@gmail.com', 'rtyuio', 'fghjkl', 'ghjio', '56789', '67890');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `email` varchar(50) NOT NULL,
  `mobile_hash` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cartid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cartid`),
  KEY `email` (`email`,`mobile_hash`),
  KEY `mobile_hash` (`mobile_hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `company` varchar(50) NOT NULL,
  `mobile_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`company`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company`, `mobile_count`) VALUES
('iphone', 3),
('LG', 2),
('micromax', 0),
('motorola', 0),
('samsung', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobiles`
--

CREATE TABLE IF NOT EXISTS `mobiles` (
  `company` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `mobile_hash` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `sold` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mobile_hash`),
  KEY `company` (`company`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobiles`
--

INSERT INTO `mobiles` (`company`, `mobile`, `price`, `count`, `mobile_hash`, `description`, `image`, `hits`, `sold`) VALUES
('LG', 'nexus', 4500, 27, '23456', 'bekaar', 'uploads/11110304_853480828045241_1848010344995944448_n.jpg', 1, 1),
('samsung', 'guru', 56000, 74, '3456', 'dual sim', 'uploads/shina.jpg', 3, 1),
('iphone', 'motog', 56000, 39, '7865', 'gazzab hai phone', 'uploads/g8.jpg', 21, 0),
('LG', 'galaxy', 9890, 143, '789', 'nice phone', 'uploads/talli.jpg', 30, 0),
('iphone', 'rtyu', 234, 12, 'fghj', 'ghj', 'uploads/frompixlr.jpg', 0, 0),
('iphone', 'jgjh', 34566, 15, 'ghjghghj', 'ghjg', 'uploads/basketball_bn.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`name`, `email`, `password`) VALUES
('amrish', 'amrish_goel15@yahoo.com', 'amrish'),
('Piyush Gupta', 'cachme07@gmail.com', '#ambivert33'),
('parul', 'parulshalini17@gmail.com', 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `wishid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `mobile_hash` varchar(100) NOT NULL,
  PRIMARY KEY (`wishid`),
  KEY `email` (`email`,`mobile_hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`email`) REFERENCES `register` (`email`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`email`) REFERENCES `register` (`email`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`mobile_hash`) REFERENCES `mobiles` (`mobile_hash`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `mobiles`
--
ALTER TABLE `mobiles`
  ADD CONSTRAINT `mobiles_ibfk_1` FOREIGN KEY (`company`) REFERENCES `company` (`company`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`email`) REFERENCES `register` (`email`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
