-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2022 a las 21:07:22
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `keeper_update` (IN `Userid` INT(11), IN `Pricing` INT(11))   BEGIN
UPDATE keepers
SET	pricing=Pricing
WHERE
        keepers.userid=Userid;
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
(1, 'Marconi', '2050', '7', 'H', '7600'),
(2, 'Colon', '4000', '', '', '7600'),
(3, 'Colon', '7890', '9', 'A', '7600'),
(5, 'San Luis', '2050', '', '', '7600'),
(8, 'Salta', '2502', '9', 'K', '7600'),
(9, 'Rioja', '4199', '8', 'J', '7600'),
(11, 'Rivadavia', '2586', '4', '8', '7600');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `availabledates`
--

CREATE TABLE `availabledates` (
  `availabledatesid` int(11) NOT NULL,
  `userid` int(11) NOT NULL COMMENT 'id del cuidador',
  `date` date NOT NULL COMMENT 'fecha que pone el guardian para cuidar',
  `available` int(11) NOT NULL COMMENT '0 = libre, sino el breedid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `availabledates`
--

INSERT INTO `availabledates` (`availabledatesid`, `userid`, `date`, `available`) VALUES
(128, 2, '2022-11-10', 0);

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
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `messages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keepers`
--

CREATE TABLE `keepers` (
  `keeperid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` double NOT NULL,
  `pricing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE `message` (
  `idmessage` int(11) NOT NULL,
  `chatidentifier` int(11) NOT NULL,
  `text` varchar(280) NOT NULL,
  `read` int(11) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `sender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

CREATE TABLE `payment` (
  `paymentid` int(11) NOT NULL,
  `transmitterid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `reserveid` int(11) NOT NULL,
  `monto` float NOT NULL,
  `qr` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(26, 1, 0, 4, 'Bolita', 'Toma medicacion'),
(34, 1, 1, 17, 'Roco', 'Toma medicacion'),
(36, 1, 0, 5, 'Luna', 'Le gusta el pescado'),
(37, 1, 1, 1, 'Kitty', 'Toma medicaciones'),
(38, 1, 1, 3, 'Dixie', 'Toma medicacion');

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
(8, 'pexels-pixabay-160722.jpg', 26),
(9, 'pexels-apunto-group-agencia-de-publicidad-7752793.jpg', 34),
(10, 'pexels-pixabay-160722.jpg', 35),
(11, 'pexels-craig-adderley-1715092.jpg', 37),
(12, 'pexels-alexas-fotos-2173872.jpg', 38);

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
  `isconfirmed` int(11) DEFAULT NULL,
  `paymentid` int(11) NOT NULL,
  `ispayed` int(11) DEFAULT NULL,
  `iscompleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sizes`
--

CREATE TABLE `sizes` (
  `userid` int(11) NOT NULL,
  `small` tinyint(1) DEFAULT NULL,
  `medium` tinyint(1) DEFAULT NULL,
  `large` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sizes`
--

INSERT INTO `sizes` (`userid`, `small`, `medium`, `large`) VALUES
(2, 0, 1, 0),
(4, 1, 0, 1),
(10, 0, 1, 0),
(11, 1, 0, 1);

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
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userid`, `email`, `password`, `type`, `dni`, `cuit`, `name`, `surname`, `phone`) VALUES
(1, 'usuario1@gmail.com', '123456', 'D', '13092520', '21474836497', 'Matias', 'Mantovani', '2235820553'),
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
(9, 'pexels-yuri-manei-3211476.jpg', 1),
(10, 'pexels-da-capture-14036568.jpg', 2);

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
(2, 'carnetVacunacion.jpg', 26),
(3, 'carnetVacunacion.jpg', 35),
(4, 'carnetVacunacion.jpg', 37),
(5, 'carnetVacunacion.jpg', 34),
(6, 'carnetVacunacion.jpg', 38);

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
  ADD PRIMARY KEY (`idchat`);

--
-- Indices de la tabla `keepers`
--
ALTER TABLE `keepers`
  ADD PRIMARY KEY (`keeperid`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idmessage`);

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
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
  MODIFY `availabledatesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de la tabla `breed`
--
ALTER TABLE `breed`
  MODIFY `breedid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `keepers`
--
ALTER TABLE `keepers`
  MODIFY `keeperid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pet`
--
ALTER TABLE `pet`
  MODIFY `petid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `pet_images`
--
ALTER TABLE `pet_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reserve`
--
ALTER TABLE `reserve`
  MODIFY `reserveid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `reviewid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `user_images`
--
ALTER TABLE `user_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vacunation_images`
--
ALTER TABLE `vacunation_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
