-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 06:21 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--

--

-- --------------------------------------------------------

--
-- Table structure for table `pdf_gen`
--

CREATE TABLE `pdf_gen` (
  `slno` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` int(12) NOT NULL,
  `comment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdf_gen`
--

INSERT INTO `pdf_gen` (`slno`, `name`, `email`, `mobile`, `comment`) VALUES
(1, 'milan panuya', 'milanpanuya2015@gmail.com', 2147483647, 'hi this is my first pdf gen'),
(2, '', '', 0, ''),
(3, 'milan panuya', 'milanpanuya2015@gmail.com', 2147483647, 'hi this is my first pdf gen'),
(4, 'milan panuya', 'milanpanuya2015@gmail.com', 2147483647, 'hi this is my first pdf gen'),
(5, '', '', 0, ''),
(6, 'milan panuya', 'milanpanuya2015@gmail.com', 2147483647, 'hi this is my first pdf gen'),
(7, '', '', 0, ''),
(8, 'milan panuya', 'milanpanuya2015@gmail.com', 2147483647, 'hi this is my first pdf gen'),
(9, 'milan panuya', 'milanpanuya2015@gmail.com', 2147483647, 'hi this is my first pdf gen'),
(10, 'milan panuya', 'milanpanuya2015@gmail.com', 2147483647, 'hi this is my first pdf gen'),
(11, 'milan panuya', 'milanpanuya2015@gmail.com', 2147483647, 'hi this is my first pdf gen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pdf_gen`
--
ALTER TABLE `pdf_gen`
  ADD PRIMARY KEY (`slno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pdf_gen`
--
ALTER TABLE `pdf_gen`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
