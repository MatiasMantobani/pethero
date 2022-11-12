-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2022 at 07:24 PM
-- Server version: 10.4.21-MariaDB
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `adress_update` (IN `Userid` INT(11), IN `Street` VARCHAR(50), IN `Number` VARCHAR(50), IN `Floor` VARCHAR(50), IN `Department` VARCHAR(15), IN `Postalcode` VARCHAR(15))   BEGIN
UPDATE adresses
SET	street=Street, number=Number, floor=Floor, department=Department, postalcode=Postalcode
WHERE
        adresses.userid=Userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chat_update_status` (IN `Senderid` INT(11), IN `Receiverid` INT(11), IN `Status` VARCHAR(50))   BEGIN
UPDATE chat
SET	status=Status
WHERE
        chat.senderid=Senderid AND chat.receiverid=Receiverid OR chat.senderid=Receiverid AND chat.receiverid=Senderid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getReserveByDay` (IN `KeeperUserId` INT(11), IN `Date` DATE)   SELECT reserve.petid FROM reserve WHERE (reserve.receiverid = KeeperUserId AND Date BETWEEN reserve.firstdate AND reserve.lastdate)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `images_add` (IN `Name` VARCHAR(100), IN `userid` INT(11))   BEGIN
    INSERT INTO user_images
    	(name, userid)
	VALUES
		(name, userid);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `images_update` (IN `Name` VARCHAR(100), IN `Userid` INT(11))   BEGIN
    UPDATE user_images
    SET	name=Name
	WHERE
		 user_images.userid=Userid;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `keeper_pricing_update` (IN `Userid` INT(11), IN `Pricing` INT(11))   BEGIN
UPDATE keepers
SET	pricing=Pricing
WHERE
        keepers.userid=Userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `keeper_status_update` (IN `Userid` INT(11), IN `Status` INT(11))   BEGIN
UPDATE keepers
SET	status=Status
WHERE
        keepers.userid=Userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `payment_update` (IN `Paymentid` INT(11))   BEGIN
UPDATE payments
SET	payed="1"
WHERE
        payments.paymentid=Paymentid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pet_delete` (IN `Petid` INT(11))   BEGIN
UPDATE pet
SET	status=0
WHERE
        pet.petid=Petid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pet_images_add` (IN `Name` VARCHAR(100), IN `Petid` INT(11))   BEGIN
INSERT INTO pet_images
(name, petid)
VALUES
(Name, Petid);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pet_images_update` (IN `Name` VARCHAR(100), IN `Petid` INT(11))   BEGIN
UPDATE pet_images
SET name=Name
WHERE
pet_images.petid=Petid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pet_update` (IN `Petid` INT(11), IN `Name` VARCHAR(100), IN `Observations` VARCHAR(200))   BEGIN
UPDATE pet
SET	name=Name, observations=Observations
WHERE
        pet.petid=Petid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reserve_update_status` (IN `Reserveid` INT(11), IN `Status` VARCHAR(45))   BEGIN
UPDATE reserve
SET	status=Status
WHERE
        reserve.reserveid=Reserveid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_available_dates_by_userid_dates_and_breed` (IN `KeeperId` INT(11), IN `FechaInicio` DATE, IN `FechaFin` DATE, IN `BreedId` INT(11))   UPDATE availabledates
SET availabledates.available = breedid
WHERE (availabledates.available = 0 AND availabledates.userid = keeperid AND (availabledates.date >= fechainicio AND availabledates.date <= fechafin))$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_status_update` (IN `Userid` INT(11), IN `Status` INT(11))   BEGIN
UPDATE users
SET status=Status
WHERE
users.userid=Userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_update` (IN `Userid` INT(11), IN `Name` VARCHAR(50), IN `Surname` VARCHAR(50), IN `Phone` VARCHAR(50))   BEGIN
UPDATE users
SET	name=Name, surname=Surname, phone=Phone
WHERE
        users.userid=Userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `vacunation_images_add` (IN `Name` VARCHAR(50), IN `Petid` INT(11))   BEGIN
INSERT INTO vacunation_images
(name, petid)
VALUES
(Name, Petid);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `vacunation_images_update` (IN `Name` VARCHAR(100), IN `Petid` INT(11))   BEGIN
UPDATE vacunation_images
SET name=Name
WHERE
petid=Petid;
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
(1, 'marconi', '1990', '', '', '7600'),
(2, 'Colon', '4000', '', '', '7600'),
(3, 'Colon', '7890', '9', 'A', '7600'),
(5, 'San Luis', '2050', '', '', '7600'),
(8, 'Salta', '2502', '9', 'K', '7600'),
(11, 'Rivadavia', '2586', '4', '8', '7600'),
(14, 'marconi', '1990', '', '', '7600');

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
(349, 14, '2022-11-01', 0),
(350, 14, '2022-11-02', 0),
(351, 14, '2022-11-03', 0),
(352, 14, '2022-11-04', 0),
(353, 14, '2022-11-05', 0),
(354, 14, '2022-11-06', 0),
(355, 14, '2022-11-07', 0),
(356, 14, '2022-11-08', 0),
(357, 14, '2022-11-09', 0),
(358, 14, '2022-11-10', 0),
(359, 14, '2022-11-11', 0),
(360, 14, '2022-11-12', 0),
(361, 14, '2022-11-13', 0),
(362, 14, '2022-11-14', 0),
(363, 14, '2022-11-15', 0),
(364, 14, '2022-11-16', 0),
(365, 14, '2022-11-17', 0),
(366, 14, '2022-11-18', 0),
(367, 14, '2022-11-19', 0),
(368, 14, '2022-11-20', 0),
(369, 14, '2022-11-21', 0),
(370, 14, '2022-11-22', 0),
(371, 14, '2022-11-23', 0),
(372, 14, '2022-11-24', 0),
(373, 14, '2022-11-25', 0),
(374, 14, '2022-11-26', 0),
(375, 14, '2022-11-27', 0),
(376, 14, '2022-11-28', 0),
(377, 14, '2022-11-29', 0),
(378, 14, '2022-11-30', 0),
(426, 2, '2022-12-01', 18),
(427, 2, '2022-12-02', 18),
(428, 2, '2022-12-03', 18),
(429, 2, '2022-12-04', 18),
(430, 2, '2022-12-05', 18),
(431, 2, '2022-12-06', 27),
(432, 2, '2022-12-07', 27),
(433, 2, '2022-12-08', 0);

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
(18, 'gato1', 1, 1),
(19, 'gato2', 1, 1),
(20, 'gato3', 1, 1),
(21, 'perro1 S', 1, 2),
(22, 'perro2 S', 1, 2),
(23, 'perro3 S', 1, 2),
(24, 'perro4 M', 2, 2),
(25, 'perro5 M', 2, 2),
(26, 'perro6 M', 2, 2),
(27, 'perro7 L', 3, 2),
(28, 'perro8 L', 3, 2),
(29, 'perro9 L', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `idmessage` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `text` varchar(280) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'sent',
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `senderid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`idmessage`, `receiverid`, `text`, `status`, `time`, `senderid`) VALUES
(1, 2, 'Hola, como estas?', 'read', '2022-11-12 13:00:08', 1),
(2, 1, 'Todo bien!', 'read', '2022-11-12 13:00:25', 2),
(3, 2, 'Me alegro', 'read', '2022-11-12 13:23:23', 1),
(4, 2, 'JOJO', 'read', '2022-11-12 13:23:43', 1),
(5, 2, 'Que bueno que esta funcionando', 'read', '2022-11-12 13:24:38', 1),
(10, 8, '??', 'sent', '2022-11-12 13:40:35', 1),
(11, 1, 'Que te pasa gil?', 'sent', '2022-11-12 13:41:35', 8),
(12, 10, 'Que onda pa?', 'sent', '2022-11-12 13:44:22', 1),
(16, 1, 'Probando el visto', 'read', '2022-11-12 14:13:17', 2),
(17, 1, 'Hola', 'read', '2022-11-12 15:10:26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `keepers`
--

CREATE TABLE `keepers` (
  `keeperid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` double NOT NULL DEFAULT 0,
  `pricing` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT 'Se crea por defecto en 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keepers`
--

INSERT INTO `keepers` (`keeperid`, `userid`, `rating`, `pricing`, `status`) VALUES
(1, 2, 0, 100, 1),
(2, 14, 0, 500, 1),
(3, 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentid` int(11) NOT NULL,
  `transmitterid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `reserveid` int(11) NOT NULL,
  `monto` float NOT NULL,
  `qr` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `payed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentid`, `transmitterid`, `receiverid`, `reserveid`, `monto`, `qr`, `date`, `payed`) VALUES
(7, 1, 2, 43, 400, 'qr.png', '2022-11-11', 1),
(8, 1, 2, 45, 500, 'qr.png', '2022-11-12', 1),
(9, 1, 2, 45, 500, 'qr.png', '2022-11-12', 0),
(10, 1, 2, 43, 400, 'qr.png', '2022-11-12', 0),
(11, 1, 2, 46, 500, 'qr.png', '2022-11-12', 1),
(12, 1, 2, 47, 200, 'qr.png', '2022-11-12', 1),
(13, 1, 2, 48, 200, 'qr.png', '2022-11-12', 1);

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
(39, 1, 0, 18, 'gato', 'asd'),
(40, 1, 0, 25, 'perro', 'asd'),
(41, 1, 1, 18, 'Kitty', ''),
(42, 1, 1, 27, 'Esteban', 'Le gusta jugar a las escondidas');

-- --------------------------------------------------------

--
-- Table structure for table `pet_images`
--

CREATE TABLE `pet_images` (
  `imageid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `petid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_images`
--

INSERT INTO `pet_images` (`imageid`, `name`, `petid`) VALUES
(8, 'pexels-pixabay-160722.jpg', 26),
(9, 'pexels-apunto-group-agencia-de-publicidad-7752793.jpg', 34),
(10, 'pexels-pixabay-160722.jpg', 35),
(11, 'pexels-craig-adderley-1715092.jpg', 37),
(12, 'pexels-alexas-fotos-2173872.jpg', 38);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `reserveid` int(11) NOT NULL,
  `transmitterid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `petid` int(11) NOT NULL,
  `firstdate` date NOT NULL,
  `lastdate` date NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'await'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`reserveid`, `transmitterid`, `receiverid`, `petid`, `firstdate`, `lastdate`, `amount`, `status`) VALUES
(43, 1, 2, 41, '2022-12-01', '2022-12-04', 400, 'completed & reviewed'),
(44, 1, 2, 41, '2022-12-01', '2022-12-05', 500, 'rejected'),
(45, 1, 2, 41, '2022-12-01', '2022-12-05', 500, 'completed & reviewed'),
(46, 1, 2, 41, '2022-12-01', '2022-12-05', 500, 'completed & reviewed'),
(47, 1, 2, 42, '2022-12-06', '2022-12-07', 200, 'completed & reviewed'),
(48, 1, 2, 42, '2022-12-05', '2022-12-06', 200, 'completed & reviewed');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewid` int(11) NOT NULL,
  `emitterid` int(11) NOT NULL,
  `receptorid` int(11) NOT NULL,
  `reserveid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewid`, `emitterid`, `receptorid`, `reserveid`, `rating`, `comment`) VALUES
(4, 1, 2, 43, 5, 'Muy bueno todo!'),
(5, 1, 2, 44, 5, 'Excelente'),
(6, 1, 2, 45, 4, 'Gracias'),
(7, 1, 2, 46, 3, 'Medio sucio'),
(8, 1, 2, 47, 1, 'No le jugo a las escondidas :('),
(10, 1, 2, 48, 0, 'Pesimo');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `userid` int(11) NOT NULL,
  `small` tinyint(1) NOT NULL DEFAULT 0,
  `medium` tinyint(1) NOT NULL DEFAULT 0,
  `large` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`userid`, `small`, `medium`, `large`) VALUES
(2, 1, 1, 1),
(4, 1, 1, 1),
(10, 0, 1, 0),
(11, 1, 0, 1),
(14, 1, 1, 1);

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
  `phone` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `password`, `type`, `dni`, `cuit`, `name`, `surname`, `phone`, `status`) VALUES
(1, 'qwe', 'qwe', 'D', '13092520', '21474836497', 'Matias', 'Mantovani', '2235820553', 1),
(2, 'asd', 'asd', 'G', '13092514', '23130925148', 'Romina', 'Schurzmann', '4803662', 1),
(3, 'usuario3@gmail.com', '123456', 'G', '38005813', '23380058139', 'Cesar', 'Millan', '4802259', 0),
(4, 'usuario4@gmail.com', '123456', 'G', '38456789', '20384567899', 'Nazareno', 'Gomez', '2147483647', 0),
(5, 'usuario5@gmail.com', '123456', 'D', '32814777', '20328147779', 'Karen', 'Ditomasso', '4802694', 0),
(8, 'usuario6@gmail.com', '123456', 'G', '32645987', '20326459874', 'Matias', 'Mantovani', '4802556', 0),
(9, 'usuario7@gmail.com', '123456', 'D', '23456123', '20234561236', 'Juan', 'Gomez', '4805549', 0),
(10, 'usuario10@gmail.com', '123456', 'G', '32885331', '20328853318', 'Julian', 'Moreno', '4557896', 0),
(11, 'usuario11@gmail.com', '123456', 'G', '24456123', '23244561239', 'Ricardo', 'Montalbano', '2235820559', 0),
(13, 'asddd@gmail.com', '123456', 'D', '12345678', '20123456785', 'hkljhkjhkjh', 'kjhkjhjkhkjh', '456789', 0),
(14, 'aaa', '123456', 'G', '456456', '456546546', 'fds', 'fsdf', '4564', 0);

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
(9, 'pexels-yuri-manei-3211476.jpg', 1),
(10, 'pexels-da-capture-14036568.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vacunation_images`
--

CREATE TABLE `vacunation_images` (
  `imageid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `petid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacunation_images`
--

INSERT INTO `vacunation_images` (`imageid`, `name`, `petid`) VALUES
(2, 'carnetVacunacion.jpg', 26),
(3, 'carnetVacunacion.jpg', 35),
(4, 'carnetVacunacion.jpg', 37),
(5, 'carnetVacunacion.jpg', 34),
(6, 'carnetVacunacion.jpg', 38);

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
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idmessage`);

--
-- Indexes for table `keepers`
--
ALTER TABLE `keepers`
  ADD PRIMARY KEY (`keeperid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`petid`);

--
-- Indexes for table `pet_images`
--
ALTER TABLE `pet_images`
  ADD PRIMARY KEY (`imageid`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`reserveid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewid`);

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
-- Indexes for table `vacunation_images`
--
ALTER TABLE `vacunation_images`
  ADD PRIMARY KEY (`imageid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availabledates`
--
ALTER TABLE `availabledates`
  MODIFY `availabledatesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=434;

--
-- AUTO_INCREMENT for table `breed`
--
ALTER TABLE `breed`
  MODIFY `breedid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `keepers`
--
ALTER TABLE `keepers`
  MODIFY `keeperid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `petid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pet_images`
--
ALTER TABLE `pet_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `reserveid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vacunation_images`
--
ALTER TABLE `vacunation_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
