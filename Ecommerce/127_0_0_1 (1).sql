-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 06:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_custom_mvc`
--
CREATE DATABASE IF NOT EXISTS `php_custom_mvc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `php_custom_mvc`;

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `adminId` int(11) NOT NULL,
  `adminEmail` varchar(250) NOT NULL,
  `adminPassword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`adminId`, `adminEmail`, `adminPassword`) VALUES
(1, 'admin@gmail.com', 'e6e061838856bf47e1de730719fb2609');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryUrlKey` text NOT NULL,
  `categoryImage` text NOT NULL,
  `categoryStatus` int(11) NOT NULL,
  `categoryDescription` text DEFAULT NULL,
  `parentCategory` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `categoryUrlKey`, `categoryImage`, `categoryStatus`, `categoryDescription`, `parentCategory`, `createdAt`, `updatedAt`) VALUES
(1, 'Electronics', 'electronics', 'electronics.jpg', 1, NULL, NULL, '2015-02-20 01:29:21', '2015-02-20 03:38:26'),
(2, 'Sports Accessories', 'sports-accessories', 'sports-accessories-1482641.jpg', 1, NULL, NULL, '2015-02-20 02:46:44', '0000-00-00 00:00:00'),
(3, 'Furniture', 'furniture', 'littrell-upholstered-platform-bed-1533046851.jpg', 1, NULL, NULL, '2015-02-20 02:47:14', '2015-02-20 03:33:43'),
(4, 'Mobiles', 'mobiles', 'mobiles.webp', 1, NULL, 1, '2015-02-20 02:48:08', '2015-02-20 03:32:22'),
(5, 'Clothes', 'clothes', 'online-clothes-shops-hero.jpg', 1, NULL, NULL, '2015-02-20 02:48:32', '2015-02-20 03:32:10'),
(6, 'Laptops', 'laptops', 'images.jpg', 1, NULL, 1, '2017-02-20 04:11:04', '0000-00-00 00:00:00'),
(7, 'Consoles', 'consoles', 'game-console-5200.jpg', 1, NULL, 1, '2017-02-20 04:11:58', '0000-00-00 00:00:00'),
(8, 'Headphones', 'headphones', 'headphones-final-img_500x.webp', 1, NULL, 1, '2017-02-20 04:13:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `cmsPagesId` int(11) NOT NULL,
  `cmsPageTitle` varchar(250) NOT NULL,
  `cmsPageUrlKey` text NOT NULL,
  `cmsPageStatus` int(5) NOT NULL,
  `cmsPageContent` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`cmsPagesId`, `cmsPageTitle`, `cmsPageUrlKey`, `cmsPageStatus`, `cmsPageContent`, `createdAt`, `updatedAt`) VALUES
(1, 'Home Page', 'home-page', 1, 'home page', '2017-02-20 11:42:02', '2017-02-20 01:15:58'),
(2, 'About Us', 'about-us', 1, 'about us page ', '2017-02-20 02:36:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `postTitle` varchar(255) NOT NULL,
  `postContent` text NOT NULL,
  `postCreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `postTitle`, `postContent`, `postCreatedAt`) VALUES
(1, 'First posts', 'this is a first post', '2020-02-12 14:31:42'),
(2, 'Second posts', 'This is a second post', '2020-02-12 14:31:42'),
(3, 'Third posts', 'this is a third post', '2020-02-12 16:27:30'),
(4, 'Fourth posts', 'this is a fourth post', '2020-02-12 16:30:16'),
(5, 'Fifth posts ', 'this is a fifth post', '2020-02-13 11:29:17'),
(6, 'Sixth posts', 'this is a sixth post', '2020-02-14 11:38:56'),
(7, 'Seventh posts', 'this is a seventh post', '2020-02-14 12:06:10'),
(8, 'Eighth posts', 'this is a eight post', '2020-02-14 12:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productSKU` int(11) NOT NULL,
  `productUrlKey` text NOT NULL,
  `productImage` text NOT NULL,
  `productDescription` text NOT NULL,
  `productShortDescription` varchar(255) NOT NULL,
  `productPrice` int(6) NOT NULL,
  `productStock` int(11) NOT NULL,
  `productStatus` int(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `productSKU`, `productUrlKey`, `productImage`, `productDescription`, `productShortDescription`, `productPrice`, `productStock`, `productStatus`, `createdAt`, `updatedAt`) VALUES
(1, 'One Plus 7', 80, 'one-plus-7', '61P6u9SWzRL._SX679_.jpg', '', 'This is an One plus  product', 36000, 10, 1, '2015-02-20 05:31:39', '2017-02-20 06:09:13'),
(2, 'Denim Jeans for Mens', 100, 'denim-jeans-for-mens', 'mens-jeans-1565006057-5032521.jpeg', '', 'this is a blue color jeans ', 1000, 50, 1, '2015-02-20 05:44:34', '0000-00-00 00:00:00'),
(3, 'JBL TUNE 750BTNC', 80, 'jbl-tune-750btnc', 'JBL_LIVE650BTNC_Product-Image_Hero_Black_071_x1-1605x1605px.webp', '', '', 6000, 6, 1, '2017-02-20 04:51:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `productsCategoriesId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`productsCategoriesId`, `productId`, `categoryId`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 2, 5),
(4, 3, 1),
(5, 3, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`),
  ADD UNIQUE KEY `categoryUrlKey` (`categoryUrlKey`) USING HASH,
  ADD KEY `parentCategory` (`parentCategory`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`cmsPagesId`),
  ADD UNIQUE KEY `cmsPageUrlKey` (`cmsPageUrlKey`) USING HASH;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`),
  ADD UNIQUE KEY `postTitle` (`postTitle`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`productsCategoriesId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `cmsPagesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `productsCategoriesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parentCategory`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `products_categories_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_categories_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
