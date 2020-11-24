DROP TABLE IF EXISTS `sorteo_premios`;

CREATE TABLE `sorteo_premios` (
  `numero` varchar(5) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  premio integer
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sorteo_premios`
--

INSERT INTO `sorteo_premios` (`numero`, `fecha`, premio ) VALUES
('10000', '2020-11-01', 1000 );

INSERT INTO `sorteo_premios` (`numero`, `fecha`, premio ) VALUES
('10000', '2020-10-10', 1000 );

INSERT INTO `sorteo_premios` (`numero`, `fecha`, premio ) VALUES
('10000', '2020-15-05', 1000 );

INSERT INTO `sorteo_premios` (`numero`, `fecha`, premio ) VALUES
('10000', '2020-10-12', 1000 );

