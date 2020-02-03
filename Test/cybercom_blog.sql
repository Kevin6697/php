-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 05:40 PM
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
-- Database: `cybercom_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `parentCatId` int(11) DEFAULT NULL,
  `catTitle` varchar(255) NOT NULL,
  `catUrl` text NOT NULL,
  `catMetaTitle` varchar(255) NOT NULL,
  `catContent` text NOT NULL,
  `catFile` text NOT NULL,
  `catCreatedAt` date NOT NULL,
  `catUpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postId` int(11) NOT NULL,
  `custId` int(11) NOT NULL,
  `postTitle` text NOT NULL,
  `postUrl` text NOT NULL,
  `postContent` text NOT NULL,
  `postImage` text NOT NULL,
  `postPublishedAt` date NOT NULL,
  `postCreatedAt` date NOT NULL,
  `postUpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `post_categoryId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `custId` int(11) NOT NULL,
  `custPrefix` varchar(10) NOT NULL,
  `custFirstName` varchar(200) NOT NULL,
  `custLastName` varchar(200) NOT NULL,
  `custMobile` bigint(10) NOT NULL,
  `custEmail` varchar(255) NOT NULL,
  `custPwd` text NOT NULL,
  `custLastLogin` date NOT NULL,
  `custInformation` text NOT NULL,
  `custCreatedAt` date NOT NULL,
  `custUpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`custId`, `custPrefix`, `custFirstName`, `custLastName`, `custMobile`, `custEmail`, `custPwd`, `custLastLogin`, `custInformation`, `custCreatedAt`, `custUpdatedAt`) VALUES
(2, 'Mrs.', 'abcxyz', 'xyz', 1234567890, 'abc@gmail.com', '202cb962ac59075b964b07152d234b70', '0000-00-00', 'wwq', '0000-00-00', '2020-02-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`),
  ADD UNIQUE KEY `catUrl` (`catUrl`) USING HASH,
  ADD KEY `parentCatId` (`parentCatId`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postId`),
  ADD KEY `custId` (`custId`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`post_categoryId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`custId`),
  ADD UNIQUE KEY `custEmail` (`custEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `post_categoryId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `custId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parentCatId`) REFERENCES `category` (`catId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`custId`) REFERENCES `user` (`custId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `post` (`postId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`catId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
