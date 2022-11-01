-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 08:04 PM
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
-- Database: `pethero`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `images_add` (IN `Name` VARCHAR(100), IN `userid` INT(11))   BEGIN
    INSERT INTO user_images
    	(name, userid)
	VALUES
		(name, userid);

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adresses`
--

CREATE TABLE `adresses` (
  `userid` int(11) NOT NULL,
  `street` varchar(50) NOT NULL COMMENT 'Calle',
  `number` varchar(50) NOT NULL COMMENT 'Altura',
  `floor` varchar(50) DEFAULT NULL COMMENT 'Piso',
  `department` varchar(15) DEFAULT NULL COMMENT 'Departamento',
  `postalcode` varchar(15) NOT NULL COMMENT 'Codigo postal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adresses`
--

INSERT INTO `adresses` (`userid`, `street`, `number`, `floor`, `department`, `postalcode`) VALUES
(1, 'Jara', '2001', '11', '', '7600BY2'),
(2, 'Champaña', '4000 w', 'en ', '...^*drop table', 'tu vieja'),
(3, 'Colon', '7890', '9', 'A', '7600'),
(5, 'San Luis', '2050', '', '', '7600'),
(8, 'Salta', '2502', '9', 'K', '7600'),
(9, 'Rioja', '4199', '8', 'J', '7600'),
(11, 'Rivadavia', '2586', '4', '8', '7600');

-- --------------------------------------------------------

--
-- Table structure for table `availabledates`
--

CREATE TABLE `availabledates` (
  `availabledatesid` int(11) NOT NULL,
  `userid` int(11) NOT NULL COMMENT 'id del cuidador',
  `date` date NOT NULL COMMENT 'fecha que pone el guardian para cuidar',
  `available` int(11) NOT NULL COMMENT '0 = libre, sino el breedid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `availabledates`
--

INSERT INTO `availabledates` (`availabledatesid`, `userid`, `date`, `available`) VALUES
(168, 2, '2022-11-04', 13),
(169, 2, '2022-11-05', 1),
(179, 2, '2022-11-01', 0),
(180, 2, '2022-11-02', 0),
(181, 2, '2022-11-03', 0),
(182, 2, '2022-11-06', 0),
(183, 2, '2022-11-07', 0),
(184, 2, '2022-11-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE `breed` (
  `breedid` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `size` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`breedid`, `name`, `size`, `type`) VALUES
(1, 'Persa', 1, 1),
(2, 'Siames', 1, 1),
(3, 'Gato ruso', 1, 1),
(4, 'Bobtail', 1, 1),
(5, 'Siberiano', 1, 1),
(6, 'Maine', 1, 1),
(7, 'Birmano', 1, 1),
(8, 'Husky', 2, 2),
(9, 'Golden retriever', 2, 2),
(10, 'Caniche', 1, 2),
(11, 'Pastor aleman', 3, 2),
(12, 'Yorkshire', 1, 2),
(13, 'Dalmata', 2, 2),
(14, 'Boxer', 2, 2),
(15, 'Chihuahua', 1, 2),
(16, 'Bulldog', 1, 2),
(17, 'Beagle', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `petid` int(11) NOT NULL,
  `userid` int(11) NOT NULL COMMENT 'A quien pertenece la mascota',
  `status` int(11) NOT NULL DEFAULT 1,
  `breedid` int(11) NOT NULL COMMENT 'debe referenciar la tabla breed as FK',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `observations` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`petid`, `userid`, `status`, `breedid`, `name`, `observations`) VALUES
(21, 1, 1, 1, 'Mishi', ''),
(24, 1, 1, 13, 'Canitoli', 'No dispone'),
(26, 1, 1, 4, 'Bolita', 'Toma medicacion'),
(31, 1, 1, 15, 'Larita', '');

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `reserveid` int(11) NOT NULL,
  `transmitterid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `petid` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `isconfirmed` int(11) DEFAULT NULL,
  `paymentid` int(11) NOT NULL,
  `ispayed` int(11) DEFAULT NULL,
  `iscompleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `userid` int(11) NOT NULL,
  `small` tinyint(1) DEFAULT NULL,
  `medium` tinyint(1) DEFAULT NULL,
  `large` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`userid`, `small`, `medium`, `large`) VALUES
(2, 0, 1, 0),
(4, 1, 0, 1),
(10, 0, 1, 0),
(11, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL COMMENT 'user id',
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(1) NOT NULL,
  `dni` varchar(50) NOT NULL,
  `cuit` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `password`, `type`, `dni`, `cuit`, `name`, `surname`, `phone`) VALUES
(1, 'usuario1@gmail.com', '123456', 'D', '13092520', '21474836497', 'Juan', 'Castro', '2147483647'),
(2, 'usuario2@gmail.com', '123456', 'G', '13092514', '23130925148', 'Romina', 'Schutz', '4803662'),
(3, 'usuario3@gmail.com', '123456', 'G', '38005813', '23380058139', 'Cesar', 'Millan', '4802259'),
(4, 'usuario4@gmail.com', '123456', 'G', '38456789', '20384567899', 'Nazareno', 'Gomez', '2147483647'),
(5, 'usuario5@gmail.com', '123456', 'D', '32814777', '20328147779', 'Karen', 'Ditomasso', '4802694'),
(8, 'usuario6@gmail.com', '123456', 'G', '32645987', '20326459874', 'Matias', 'Mantovani', '4802556'),
(9, 'usuario7@gmail.com', '123456', 'D', '23456123', '20234561236', 'Juan', 'Gomez', '4805549'),
(10, 'usuario10@gmail.com', '123456', 'G', '32885331', '20328853318', 'Julian', 'Moreno', '4557896'),
(11, 'usuario11@gmail.com', '123456', 'G', '24456123', '23244561239', 'Ricardo', 'Montalbano', '2235820559');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `imageid` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`imageid`, `name`, `userid`) VALUES
(1, 'pic.png', 1),
(2, 'Mute_OPENING-TKT-960x400px.png', 2),
(3, 'pic.png', 3),
(4, 'john-towner-JgOeRuGD_Y4-unsplash.jpg', 4),
(5, 'john-towner-JgOeRuGD_Y4-unsplash.jpg', 4),
(6, '24275813_350.png', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `availabledates`
--
ALTER TABLE `availabledates`
  ADD PRIMARY KEY (`availabledatesid`);

--
-- Indexes for table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`breedid`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`petid`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`reserveid`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cuit` (`cuit`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`imageid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availabledates`
--
ALTER TABLE `availabledates`
  MODIFY `availabledatesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `breed`
--
ALTER TABLE `breed`
  MODIFY `breedid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `petid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `reserveid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
