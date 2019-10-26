-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2019 at 08:17 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(255) NOT NULL,
  `admindate` date NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `added_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `admindate`, `name`, `username`, `password`, `added_by`) VALUES
(1, '2019-10-20', 'ANUBHAV', 'admin', 'admin123', 'KENNY'),
(2, '2019-10-23', 'KENNY', 'adminkenny', 'adminkenny123', 'ANUBHAV'),
(3, '2019-10-23', 'AAVEZ', 'adminaavez', 'adminaavez123', 'ANUBHAV'),
(4, '2019-10-23', 'RYAN', 'adminryan', 'adminryan123', 'ANUBHAV');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `catdate` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catdate`, `name`, `owner`) VALUES
(4, '2019-10-21', 'HARDWARE', 'ANUBHAV'),
(5, '2019-10-24', 'Gaming', 'ANUBHAV'),
(6, '2019-10-24', 'Nano CPU', 'ANUBHAV');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(255) NOT NULL,
  `commentdate` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(5000) NOT NULL,
  `status` varchar(255) NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `post_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `commentdate`, `email`, `comment`, `status`, `approved_by`, `post_id`) VALUES
(9, '2019-10-24', 'sinanu1998@gmail.com', 'POST-1 COMMENT', 'approved', 'KENNY', 6),
(10, '2019-10-24', 'ryangonzo@gmail.com', 'POST-2 COMMENT\r\n', 'approved', 'KENNY', 7),
(11, '2019-10-24', 'gonsalveskenny@gmail.com', 'POST-3 COMMENT', 'unapprove', 'ANUBHAV', 8),
(12, '2019-10-24', 'aavezahmed@gmail.com', 'POST-4 COMMENT', 'unapprove', 'ANUBHAV', 9),
(13, '2019-10-24', 'sinanu1998@gmail.com', 'POST-5 COMMENT', 'unapprove', 'ANUBHAV', 10),
(14, '2019-10-24', 'aavez@gmail.com', 'hi', 'approved', 'RYAN', 6);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(255) NOT NULL,
  `contactdate` date NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `contactdate`, `name`, `email`, `phone`, `message`) VALUES
(4, '2019-10-24', 'AAVEZ AHMED ', 'aavezahmed@gmail.com', '7218450969', 'Hi teamalphacode, I want to publish one article on your Blog');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(255) NOT NULL,
  `postDate` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `postDate`, `title`, `category_name`, `author`, `image`, `content`) VALUES
(6, '2019-10-24', 'I9 Processor', 'HARDWARE', 'ANUBHAV', '81t4McdI7PL._SL1500_.jpg', 'In 2008 Intel announced it range of superior processors which were said to revolutionize the Processors for generations to come, The i7 becoming the high end of its processor range. However these processors had 4 cores and 8 threads which doesn\'t really add up. 9 years later, Intel announced the latest of its processor being the I9! and although the I9 sounds like a futuristic name given to a super car, Intel has decided to call its latest set of Processors CORE I9 which doesn\'t come as a shock considering how fast they are estimated on paper. Unlike mainstream, Intel schemes the core I9 featured 10 cores on its lowest end, with models going from 12,14,16 and even 18 cores! and they all feature hyper threading, simply meaning the can go blog from 20 threads to 36 threads.\r\n\r\nIntel has introduced these chips for a term called \"Mega Tasking\" which was defined by Intel\'s marketing team which mean, Simultaneously running multi threaded hard hitting work load such as gaming, streaming and recording on multiple monitor at once or even content creation like video ,audio and image editing at Once!. The Intel I9 increases the bandwidth for more hardware extensions like more graphics slots, more processor and ram capacities , more extensions like the Thunderbolt 3. Of course all of these amazing processor speeds are coming your way with the lowest price starting from 70,000 rupees and the highest being 1,40,000 rupees, a big price but for the best performance. For the common folks reading this the i9 is not else but a fancy sedan you see while taking a walk on a sunny afternoon, like most cars it can take you to your destination, Only faster and in style !'),
(7, '2019-10-24', 'What Is the Difference Between 4K UHD and HDR', 'Gaming', 'KENNY', '24-014-466-V07.jpg', '4K and UHD (which stands for ultra-high-definition) simply refer to the resolution of the screen, which affects the sharpness of the image. On the other hand, HDR (high-dynamic-range) enhances the contrast ratio, which is the luminance difference between the brightest part and darkest part of one image.\r\n\r\nWith its larger contrast ratio, HDR reveals more details in very bright and dark scenes, delivering pristinely bright whites, superbly deep blacks, and intensely saturated and vibrant colours. All this results in HDR images that appear more realistic and vividly stand out.\r\n\r\nHDR enhances the brightness, contrast, colour, and detail performance of displays independently from the monitorâ€™s resolution. HD, FHD, QHD, and 4K UHD can all support HDR, but only when they meet the minimum technical specifications in terms of contrast ratio and brightness according to HDR standards.'),
(8, '2019-10-24', 'Raspberry Pi 4 Model B', 'Nano CPU', 'ANUBHAV', 'raspberry-pi-4-board-SOURCE-Raspberrypi_org.jpg', 'THE RASPBERRY PI is a computer the size of a credit card that is aimed at do-it-yourselfers. The cheap and tiny device costs less than you\'d pay for a few drinks in San Francisco, so it\'s already proven to be a hit among hobbyists who want to add light computing or internet connectivity to their projects. But the newest version of this little board has some additional features that make it capable enough to possibly replace your desktop PC.\r\n\r\nWith the Raspberry Pi 4, the one-size-fits all approach of previous releases is gone. It\'s available with either 1, 2, or 4 gigabytes of RAM. (This is the first time it\'s been possible to get a Pi with more than 1 GB of memory.) The extra RAM opens a new world of functionality for the Pi, including running desktop softwareâ€”but the Raspberry Pi 4 is still the same great little DIY machine.'),
(9, '2019-10-24', 'Is the NVIDIA GTX 1050 good for gaming?', 'Gaming', 'RYAN', '5711723_sd.jpg', 'NVIDIA\'s 10-series GPUs are a serious step up from what came before it. It\'s not just a case of \"oh, new graphics card better than old one, more at 11.\" The Pascal cards are a true generational leap forward at both the top and bottom end of the range.\r\n\r\nBut while it\'s easy to get wide-eyed for the GTX 1080 Ti or the $3,000 Titan V, we shouldn\'t forget the mass market cards at the lower end of the price bracket.\r\n\r\nThe new entry-level for gaming from NVIDIA is the GTX 1050, and the slightly beefed up 1050 Ti. Is it worth your time? That depends on what you want to do with it.'),
(10, '2019-10-24', 'ARDUINO UNO', 'Nano CPU\'s', 'ANUBHAV', '0J7808.1200.jpg', 'The Arduino Uno is an open-source microcontroller board based on the Microchip ATmega328P microcontroller and developed by Arduino.cc. The board is equipped with sets of digital and analog input/output (I/O) pins that may be interfaced to various expansion boards (shields) and other circuits.[1] The board has 14 Digital pins, 6 Analog pins, and programmable with the Arduino IDE (Integrated Development Environment) via a type B USB cable. It can be powered by the USB cable or by an external 9-volt battery, though it accepts voltages between 7 and 20 volts. It is also similar to the Arduino Nano and Leonardo. The hardware reference design is distributed under a Creative Commons Attribution Share-Alike 2.5 license and is available on the Arduino website. Layout and production files for some versions of the hardware are also available.\r\n\r\nThe word \"uno\" means \"one\" in Italian and was chosen to mark the initial release of the Arduino Software. The Uno board is the first in a series of USB-based Arduino boards, and it and version 1.0 of the Arduino IDE were the reference versions of Arduino, now evolved to newer releases. The ATmega328 on the board comes preprogrammed with a bootloader that allows uploading new code to it without the use of an external hardware programmer.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
