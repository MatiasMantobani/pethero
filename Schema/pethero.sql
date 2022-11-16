-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 04:03:39
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pethero`
--

DELIMITER $$
--
-- Procedimientos
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_for_overlapping_reserves` (IN `Petid` INT(11), IN `Firstdate` DATE, IN `Lastdate` DATE)   BEGIN
SELECT COUNT(reserve.petid) FROM reserve WHERE ((reserve.petid = Petid) AND ((Firstdate <= reserve.lastdate) AND (Lastdate >= reserve.firstdate)) AND ((reserve.status != "rejected") AND (reserve.status != "canceled")));
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_available_by_date`(IN `Date` DATE, IN `Userid` INT)
BEGIN
DELETE FROM availabledates WHERE (availabledates.date = date AND availabledates.userid = Userid AND availabledates.available = 0);
-- Como de costumbre checkea que la fecha disponible sea 0 antes de borrarla para no borrar cuando el usuario tenga una fecha ocupada
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
-- Estructura de tabla para la tabla `adresses`
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
-- Volcado de datos para la tabla `adresses`
--

INSERT INTO `adresses` (`userid`, `street`, `number`, `floor`, `department`, `postalcode`) VALUES
(16, 'qwe', 'qwe', 'qwe', 'qwe', 'qwe'),
(17, 'asd', 'asd', 'asd', 'asd', 'asd'),
(18, 'y', 'rty', 'tryrt', 'rtrt', 'rtyrt'),
(19, 'fghfgh', 'fghfg', 'gfhfgh', 'fg', 'f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `availabledates`
--

CREATE TABLE `availabledates` (
  `availabledatesid` int(11) NOT NULL,
  `userid` int(11) NOT NULL COMMENT 'del keeper',
  `date` date NOT NULL COMMENT 'una fecha del rango de fechas disponibles elegida por un keeper',
  `available` int(11) NOT NULL COMMENT 'es 0 o breedid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `availabledates`
--

INSERT INTO `availabledates` (`availabledatesid`, `userid`, `date`, `available`) VALUES
(768, 17, '2022-12-01', 0),
(769, 17, '2022-12-02', 0),
(770, 17, '2022-12-03', 0),
(771, 17, '2022-12-04', 0),
(772, 17, '2022-12-05', 0),
(773, 17, '2022-12-06', 0),
(774, 17, '2022-12-07', 0),
(775, 17, '2022-12-08', 0),
(776, 17, '2022-12-09', 0),
(777, 17, '2022-12-10', 0),
(778, 17, '2022-12-11', 0),
(779, 17, '2022-12-12', 0),
(780, 17, '2022-12-13', 0),
(781, 17, '2022-12-14', 0),
(782, 17, '2022-12-15', 0),
(783, 17, '2022-12-16', 0),
(784, 17, '2022-12-17', 0),
(785, 17, '2022-12-18', 0),
(786, 17, '2022-12-19', 0),
(787, 17, '2022-12-20', 0),
(788, 17, '2022-12-21', 0),
(789, 17, '2022-12-22', 0),
(790, 17, '2022-12-23', 0),
(791, 17, '2022-12-24', 0),
(792, 17, '2022-12-25', 0),
(793, 17, '2022-12-26', 0),
(794, 17, '2022-12-27', 0),
(795, 17, '2022-12-28', 0),
(796, 17, '2022-12-29', 0),
(797, 17, '2022-12-30', 0),
(798, 17, '2022-12-31', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `breed`
--

CREATE TABLE `breed` (
  `breedid` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `size` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `breed`
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
-- Estructura de tabla para la tabla `chat`
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
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`idmessage`, `receiverid`, `text`, `status`, `time`, `senderid`) VALUES
(18, 17, 'hola', 'read', '2022-11-14 18:27:07', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keepers`
--

CREATE TABLE `keepers` (
  `keeperid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` double NOT NULL DEFAULT 0,
  `pricing` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT 'Se crea por defecto en 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `keepers`
--

INSERT INTO `keepers` (`keeperid`, `userid`, `rating`, `pricing`, `status`) VALUES
(4, 17, 0, 100, 1),
(5, 19, 0, 200, 1),
(6, 20, 0, 0, 0),
(7, 24, 0, 0, 0),
(8, 26, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
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
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`paymentid`, `transmitterid`, `receiverid`, `reserveid`, `monto`, `qr`, `date`, `payed`) VALUES
(20, 16, 17, 59, 100, 'qr.png', '2022-11-14', 1),
(21, 18, 17, 62, 3100, 'qr.png', '2022-11-15', 0),
(22, 16, 19, 60, 200, 'qr.png', '2022-11-15', 0),
(23, 16, 17, 61, 200, 'qr.png', '2022-11-15', 0),
(24, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0),
(25, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0),
(26, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0),
(27, 16, 17, 61, 200, 'qr.png', '2022-11-15', 0),
(28, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0),
(29, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0),
(30, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0),
(31, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0),
(32, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0),
(33, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0),
(34, 16, 17, 59, 100, 'qr.png', '2022-11-15', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet`
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
-- Volcado de datos para la tabla `pet`
--

INSERT INTO `pet` (`petid`, `userid`, `status`, `breedid`, `name`, `observations`) VALUES
(61, 18, 2, 8, 'rty', ''),
(62, 16, 2, 11, 'qwewqweq', 'qweewq'),
(63, 16, 2, 14, 'asd', ''),
(64, 18, 2, 6, 'rtyrt', ''),
(65, 16, 2, 20, 'qwe1', 'sdf'),
(66, 16, 2, 13, 'asd', 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet_images`
--

CREATE TABLE `pet_images` (
  `imageid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `petid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pet_images`
--

INSERT INTO `pet_images` (`imageid`, `name`, `petid`) VALUES
(21, '24275813_350.png', 54),
(22, '237c4da1793d0af4b745389886470b62.png', 55),
(23, '237c4da1793d0af4b745389886470b62.png', 56),
(24, '237c4da1793d0af4b745389886470b62.png', 57),
(25, '237c4da1793d0af4b745389886470b62.png', 58),
(26, '237c4da1793d0af4b745389886470b62.png', 59),
(27, '237c4da1793d0af4b745389886470b62.png', 60),
(28, '24275813_350.png', 61),
(29, '24260663_350.png', 62),
(30, '27659157_350.png', 64),
(31, '237c4da1793d0af4b745389886470b62.png', 63),
(32, '1280px-Delonix_regia_01.jpg', 66),
(33, '237c4da1793d0af4b745389886470b62.png', 65);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserve`
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
-- Volcado de datos para la tabla `reserve`
--

INSERT INTO `reserve` (`reserveid`, `transmitterid`, `receiverid`, `petid`, `firstdate`, `lastdate`, `amount`, `status`) VALUES
(65, 16, 17, 62, '2022-12-01', '2022-12-10', 1000, 'rejected'),
(66, 16, 17, 63, '2022-12-07', '2022-12-09', 300, 'rejected'),
(67, 16, 17, 62, '2022-12-02', '2022-12-08', 700, 'canceled'),
(68, 16, 17, 62, '2022-12-02', '2022-12-08', 700, 'await');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
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
-- Volcado de datos para la tabla `review`
--

INSERT INTO `review` (`reviewid`, `emitterid`, `receptorid`, `reserveid`, `rating`, `comment`) VALUES
(11, 16, 17, 59, 5, 'promocionanos profe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sizes`
--

CREATE TABLE `sizes` (
  `userid` int(11) NOT NULL,
  `small` tinyint(1) NOT NULL DEFAULT 0,
  `medium` tinyint(1) NOT NULL DEFAULT 0,
  `large` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sizes`
--

INSERT INTO `sizes` (`userid`, `small`, `medium`, `large`) VALUES
(17, 1, 1, 1),
(19, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userid`, `email`, `password`, `type`, `dni`, `cuit`, `name`, `surname`, `phone`, `status`) VALUES
(16, 'qwe', 'qwe', 'D', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 1),
(17, 'asd', 'asd', 'G', 'asd', 'asd', 'asd', 'asd', 'asd', 1),
(18, 'rty', 'rty', 'D', 'rty', 'rty', 'rty', 'rty', 'rty', 1),
(19, 'fgh', 'fgh', 'G', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', 1),
(24, 'jkl', 'jkl', 'G', 'jkl', 'jkl', 'jkl', 'jkl', 'jkl', 0),
(25, 'zxc', 'zxc', 'G', 'zxc', 'zxc', 'zxc', 'zxc', 'zxc', 0),
(26, 'eee', 'eee', 'G', 'eee', 'eee', 'eee', 'ee', 'eee', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_images`
--

CREATE TABLE `user_images` (
  `imageid` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `user_images`
--

INSERT INTO `user_images` (`imageid`, `name`, `userid`) VALUES
(12, '237c4da1793d0af4b745389886470b62.png', 16),
(13, '237c4da1793d0af4b745389886470b62.png', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunation_images`
--

CREATE TABLE `vacunation_images` (
  `imageid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `petid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vacunation_images`
--

INSERT INTO `vacunation_images` (`imageid`, `name`, `petid`) VALUES
(15, '24275813_350.png', 54),
(16, '24275813_350.png', 55),
(17, '24275813_350.png', 56),
(18, '24275813_350.png', 57),
(19, '24275813_350.png', 58),
(20, '24275813_350.png', 59),
(21, '24275813_350.png', 60),
(22, '24275813_350.png', 61),
(23, '24260663_350.png', 62),
(24, '27659157_350.png', 64),
(25, '237c4da1793d0af4b745389886470b62.png', 63),
(26, '24275813_350.png', 66),
(27, '24260663_350.png', 65);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`userid`);

--
-- Indices de la tabla `availabledates`
--
ALTER TABLE `availabledates`
  ADD PRIMARY KEY (`availabledatesid`);

--
-- Indices de la tabla `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`breedid`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idmessage`);

--
-- Indices de la tabla `keepers`
--
ALTER TABLE `keepers`
  ADD PRIMARY KEY (`keeperid`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indices de la tabla `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`petid`);

--
-- Indices de la tabla `pet_images`
--
ALTER TABLE `pet_images`
  ADD PRIMARY KEY (`imageid`);

--
-- Indices de la tabla `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`reserveid`);

--
-- Indices de la tabla `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewid`);

--
-- Indices de la tabla `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`userid`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cuit` (`cuit`);

--
-- Indices de la tabla `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`imageid`);

--
-- Indices de la tabla `vacunation_images`
--
ALTER TABLE `vacunation_images`
  ADD PRIMARY KEY (`imageid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `availabledates`
--
ALTER TABLE `availabledates`
  MODIFY `availabledatesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=799;

--
-- AUTO_INCREMENT de la tabla `breed`
--
ALTER TABLE `breed`
  MODIFY `breedid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `keepers`
--
ALTER TABLE `keepers`
  MODIFY `keeperid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `pet`
--
ALTER TABLE `pet`
  MODIFY `petid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `pet_images`
--
ALTER TABLE `pet_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `reserve`
--
ALTER TABLE `reserve`
  MODIFY `reserveid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `reviewid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `user_images`
--
ALTER TABLE `user_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `vacunation_images`
--
ALTER TABLE `vacunation_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
