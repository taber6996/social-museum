-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2021 a las 13:11:15
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `social-museum`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `tipo` varchar(25) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `nombre`, `tipo`, `descripcion`, `fecha_ini`, `fecha_fin`, `precio`) VALUES
(1, 'Exposición Goya', 'Expo', 'Los mejores cuadros de Goya', '2021-05-12', '2021-06-30', 10),
(2, 'Exposición Pasado', 'Expo', 'Una exposición del pasado', '2021-03-11', '2021-03-31', 5),
(3, 'Exposición futuro', 'Expo', 'Una exposición del futuro', '2021-06-24', '2021-09-16', 1),
(4, 'Concurso 1', 'Concurso', 'El primer concurso de Social Museum', '2021-05-12', '2021-08-14', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mecenas`
--

CREATE TABLE `mecenas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_artista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

CREATE TABLE `obras` (
  `id` int(11) NOT NULL,
  `id_autor` int(11) DEFAULT NULL,
  `titulo` varchar(25) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `obras`
--

INSERT INTO `obras` (`id`, `id_autor`, `titulo`, `descripcion`, `likes`) VALUES
(1, 2, 'Perro', 'Perro jugando', 25),
(2, 2, 'Fuego', 'Bola de fuego', 8),
(4, 7, 'Chicafrenteaunespejo', 'Chica frente a un espejo', 0),
(5, 7, 'Guernica', 'Guernica', 0),
(6, 7, 'LassenoritasdeAvignon', 'Las señoritas de Avignon', 0),
(7, 7, 'Elviejoguitarristaciego', 'El viejo guitarrista ciego', 0),
(8, 8, 'Freedom', 'Fight for freedom', 0),
(9, 8, 'Player', 'American Player', 0),
(10, 8, 'Wave', 'Big Blue Wave', 0),
(11, 8, 'Woman', 'Woman\'s Thoughts', 0),
(12, 8, 'Murder', 'Secret Murder', 0),
(13, 9, 'Pajaro', 'Pajaro a lapiz', 0),
(14, 9, 'Caballo', 'Caballo a lapiz', 0),
(15, 9, 'Jirafas', 'Jirafas a lapiz', 0),
(16, 9, 'Gato', 'Gato a lapiz', 0),
(17, 11, 'ElRaptoDeEuropa', '	El rapto de Europa', 0),
(18, 11, 'ElsuenodeSanJosé', 'El sueño de San José', 0),
(19, 11, 'Piedad', 'Piedad', 0),
(20, 11, 'LaCaida', 'La caída', 0),
(21, 11, 'ProcesionRural', 'Procesión rural', 0),
(22, 11, 'Tobíasyelángel', 'Tobías y el ángel', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `unidades`) VALUES
(1, 'Camiseta', 'Camiseta de algodón con logo', 15, 85),
(2, 'Lapices', 'Lapices de colores', 1, 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pujas`
--

CREATE TABLE `pujas` (
  `id` int(11) NOT NULL,
  `id_obra` int(11) DEFAULT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `precio_inicial` float DEFAULT NULL,
  `precio_actual` float DEFAULT NULL,
  `id_comprador_actual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_obra`, `fecha_finalizacion`, `precio_inicial`, `precio_actual`, `id_comprador_actual`) VALUES
(2, 4, '2021-12-28', 10500, 10500, NULL),
(3, 5, '2021-07-21', 100000, 100000, NULL),
(4, 9, '2021-08-04', 350, 350, NULL),
(5, 10, '2021-08-18', 899.99, 899.99, NULL),
(6, 11, '2021-07-19', 555.55, 555.55, NULL),
(7, 12, '2021-05-26', 1000, 1000, NULL),
(8, 13, '2021-08-26', 15, 15, NULL),
(9, 14, '2021-07-26', 15, 15, NULL),
(10, 15, '2021-07-26', 15, 15, NULL),
(11, 16, '2021-07-26', 15, 15, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(10) NOT NULL,
  `avatar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `nombre`, `password`, `rol`, `avatar`) VALUES
(1, 'admin@gmail.com', 'Administrador', '$2y$10$j3gDDnUmICg/rvP0lmz8Duv2FcE1Ufi0tDQpIqx5cKcbqtkBOxhfS', 'admin', 0),
(2, 'artist@gmail.com', 'Artista', '$2y$10$rYYIYCUzVJqTAFEhRZV7R.4DZF6hOGuVezEP592V/Su4Jq1D1.KEa', 'artist', 0),
(3, 'user@gmail.com', 'Usuario', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG', 'user', 0),
(4, 'sergioRamos@gmail.com', 'Sergio', '$2y$10$b2ZEmBjoBfnGqi8Kruyi2uByOaItEaYt45b7iNalrFDzvLsLb.302', 'user', 1),
(5, 'ana@ucm.es', 'Ana Martinez', '$2y$10$nC3.49ySiJanNkO3VTOd6eZPcrfaXGaBP3mXMojdUeXsd0t7EsqH2', 'user', 1),
(6, 'pepito@gmail.com', 'Pepito', '$2y$10$c6N1O.toQCs3nbg7VCC7s.5veeUfwNHeahn0ERLrppOJi/7Fv4fXW', 'user', 0),
(7, 'picasso@gmail.com', 'Picasso', '$2y$10$VbAU9zsMosCjfhs4laHY3uFmmOtOTaqQ1Z2ll68GYzd5ZCOJ.H10u', 'artist', 1),
(8, 'raymond@gmail.com', 'Raymond', '$2y$10$isqo0bEJi5.OypoDE.PJKOHeG8pqrLyfvRRParSdrABU3EcPTboWm', 'artist', 1),
(9, 'lupita@gmail.com', 'Lupita', '$2y$10$f9hD3d2NaxmAGsgv.TP9M.tGCX2.r5lpXe9pjMuNr4MnWny5.BO3O', 'artist', 1),
(10, 'soff@gmail.com', 'Sofonisba Angui', '$2y$10$Dh1vSq6GnM0TUO2neFsPUOlMdayjIH2AwZJQmsvSG.dJtcSQhh4bW', 'artist', 1),
(11, 'goya@gmail.com', 'Francisco Goya', '$2y$10$sLXHOHgnFNMInJPEdiFrmOiwZ1zAch/.gVBtwe/r5vvlrS/lNgmFG', 'artist', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mecenas`
--
ALTER TABLE `mecenas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mecenas`
--
ALTER TABLE `mecenas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pujas`
--
ALTER TABLE `pujas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
