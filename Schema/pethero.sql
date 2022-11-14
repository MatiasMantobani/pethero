-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 06:20 PM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_login` (IN `Email` VARCHAR(100), IN `Password` VARCHAR(100))   BEGIN
SELECT * from users
WHERE (users.email=Email AND users.password=Password);
END$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `pet_status_update` (IN `Petid` INT(11), IN `Status` INT(11))   BEGIN
UPDATE pet
SET	status=Status
WHERE
        pet.petid=Petid;
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
(2, 'Colon', '405', '', '', '7600'),
(3, 'Colon', '7890', '9', 'A', '7600'),
(5, 'San Luis', '2050', '', '', '7600'),
(8, 'Salta', '2502', '9', 'K', '7600'),
(11, 'Rivadavia', '2586', '4', '8', '7600'),
(14, 'marconi', '1990', '', '', '7600'),
(15, 'gamora', '1995', '2', '2', '7602');

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
(8, 'Husky', 3, 2),
(9, 'Golden retriever', 3, 2),
(10, 'Caniche', 1, 2),
(11, 'Pastor aleman', 3, 2),
(12, 'Yorkshire', 1, 2),
(13, 'Dalmata', 2, 2),
(14, 'Boxer', 2, 2),
(15, 'Chihuahua', 1, 2),
(16, 'Bulldog', 1, 2),
(17, 'Beagle', 2, 2),
(18, 'Mestizo', 1, 1),
(19, 'Perro Chico', 1, 2),
(20, 'Perro Mediano', 2, 2),
(21, 'Perro Grande', 3, 2);

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
(53, 1, 1, 19, 'asd', '');

-- --------------------------------------------------------

--
-- Table structure for table `pet_images`
--

CREATE TABLE `pet_images` (
  `imageid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `petid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'qwe', 'qwe', 'D', '13092520', '21474836497', 'Matias', 'Mantovani', '2235820553', 0),
(2, 'asd', 'asd', 'G', '13092514', '23130925148', 'Romina', 'Schurzmann', '4803662', 0),
(3, 'usuario3@gmail.com', '123456', 'G', '38005813', '23380058139', 'Cesar', 'Millan', '4802259', 0),
(4, 'usuario4@gmail.com', '123456', 'G', '38456789', '20384567899', 'Nazareno', 'Gomez', '2147483647', 0),
(5, 'usuario5@gmail.com', '123456', 'D', '32814777', '20328147779', 'Karen', 'Ditomasso', '4802694', 0),
(8, 'usuario6@gmail.com', '123456', 'G', '32645987', '20326459874', 'Matias', 'Mantovani', '4802556', 0),
(9, 'usuario7@gmail.com', '123456', 'D', '23456123', '20234561236', 'Juan', 'Gomez', '4805549', 0),
(10, 'usuario10@gmail.com', '123456', 'G', '32885331', '20328853318', 'Julian', 'Moreno', '4557896', 0),
(11, 'usuario11@gmail.com', '123456', 'G', '24456123', '23244561239', 'Ricardo', 'Montalbano', '2235820559', 0),
(13, 'asddd@gmail.com', '123456', 'D', '12345678', '20123456785', 'hkljhkjhkjh', 'kjhkjhjkhkjh', '456789', 0),
(14, 'aaa', '123456', 'G', '456456', '456546546', 'fds', 'fsdf', '4564', 0),
(15, 'paola1995@hotmail.com', '1234', 'D', '95574638', '23955746384', 'maria paola', 'perez ', '1132660561', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `imageid` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  MODIFY `availabledatesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;

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
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `petid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pet_images`
--
ALTER TABLE `pet_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `reserveid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vacunation_images`
--
ALTER TABLE `vacunation_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
