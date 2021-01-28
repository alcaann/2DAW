-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2020 a las 14:54:15
-- Versión del servidor: 10.4.14-MariaDB-log
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdf_facturas`
--

CREATE TABLE `pdf_facturas` (
  `FACTURA_ID` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `EMPRESA_NIF` varchar(10) NOT NULL,
  `EMPRESA_NOMBRE` varchar(10) NOT NULL,
  `EMPRESA_DIRECCION` varchar(50) NOT NULL,
  `EMPRESA_CP` varchar(50) NOT NULL,
  `EMPRESA_LOCALIDAD` varchar(50) NOT NULL,
  `CLIENTE_NIF` varchar(10) NOT NULL,
  `CLIENTE_NOMBRE` varchar(10) NOT NULL,
  `CLIENTE_DIRECCION` varchar(50) NOT NULL,
  `CLIENTE_CP` varchar(50) NOT NULL,
  `CLIENTE_LOCALIDAD` varchar(50) NOT NULL,
  `TOTAL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pdf_facturas`
--

INSERT INTO `pdf_facturas` (`FACTURA_ID`, `FECHA`, `EMPRESA_NIF`, `EMPRESA_NOMBRE`, `EMPRESA_DIRECCION`, `EMPRESA_CP`, `EMPRESA_LOCALIDAD`, `CLIENTE_NIF`, `CLIENTE_NOMBRE`, `CLIENTE_DIRECCION`, `CLIENTE_CP`, `CLIENTE_LOCALIDAD`, `TOTAL`) VALUES
(1, '2016-12-05', '22222222K', 'SOLCON SL', 'C. LA PAZ, 17', '20000', 'MURCIA', '33333333L', 'SOLCON SL', 'AV LA PARRA, 78', '20000', 'ALCANTARILLA', 1000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pdf_facturas`
--
ALTER TABLE `pdf_facturas`
  ADD PRIMARY KEY (`FACTURA_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2020 a las 14:55:11
-- Versión del servidor: 10.4.14-MariaDB-log
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdf_lineas_factura`
--

CREATE TABLE `pdf_lineas_factura` (
  `LINEA_FACTURA_ID` int(11) NOT NULL,
  `FACTURA_ID` int(11) DEFAULT NULL,
  `CONCEPTO_ID` int(11) NOT NULL,
  `CONCEPTO` varchar(50) DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT NULL,
  `PVP` float DEFAULT NULL,
  `IMPORTE` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pdf_lineas_factura`
--

INSERT INTO `pdf_lineas_factura` (`LINEA_FACTURA_ID`, `FACTURA_ID`, `CONCEPTO_ID`, `CONCEPTO`, `CANTIDAD`, `PVP`, `IMPORTE`) VALUES
(1, 1, 245, 'ANTENA GRID', 2, 200, 400),
(2, 1, 245, 'ROUTER', 2, 200, 400);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pdf_lineas_factura`
--
ALTER TABLE `pdf_lineas_factura`
  ADD PRIMARY KEY (`LINEA_FACTURA_ID`),
  ADD KEY `FACTURA_ID` (`FACTURA_ID`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pdf_lineas_factura`
--
ALTER TABLE `pdf_lineas_factura`
  ADD CONSTRAINT `pdf_lineas_factura_ibfk_1` FOREIGN KEY (`FACTURA_ID`) REFERENCES `pdf_facturas` (`FACTURA_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

