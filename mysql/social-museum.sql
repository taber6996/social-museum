-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2021 a las 13:33:31
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

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
-- Estructura de tabla para la tabla `biografias`
--

CREATE TABLE `biografias` (
  `id_autor` int(11) NOT NULL,
  `bio` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `biografias`
--

INSERT INTO `biografias` (`id_autor`, `bio`) VALUES
(7, 'Soy un pintor español'),
(8, 'Aficionado de los cómics. Estos garabatos son lo mejor que hago.\r\n                                  '),
(9, 'Estoy aprendiendo a dibujar. Los animales me inspiran, ¿y a ti que te inspira?'),
(11, 'Mi obra abarca la pintura de caballete y mural, el grabado y el dibujo.'),
(14, 'Con mi cámara allá a donde vaya.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_obra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` varchar(200) DEFAULT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_obra`, `id_usuario`, `comentario`, `fecha`) VALUES
(12, 6, 'Qué adorable!', '2021-06-07 01:19:35'),
(1, 11, 'Me encanta!', '2021-06-03 01:20:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_articulo`, `id_usuario`) VALUES
(1, 1, 3),
(12, 1, 2),
(13, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concursos`
--

CREATE TABLE `concursos` (
  `id_concurso` int(11) NOT NULL,
  `id_ganador` int(11) DEFAULT NULL,
  `premio_dinero` int(11) DEFAULT NULL,
  `premio_producto` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `concursos`
--

INSERT INTO `concursos` (`id_concurso`, `id_ganador`, `premio_dinero`, `premio_producto`) VALUES
(4, NULL, 50, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dibujos`
--

CREATE TABLE `dibujos` (
  `id` int(11) NOT NULL,
  `id_autor` int(11) DEFAULT NULL,
  `titulo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id_evento`, `id_usuario`) VALUES
(37, 3),
(38, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `precio` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `nombre`, `tipo`, `descripcion`, `fecha_ini`, `fecha_fin`, `precio`) VALUES
(2, 'Flores de Primavera', 'Expo', 'Una exposición del pasado', '2021-03-11', '2021-03-31', 5),
(4, 'Concurso 1', 'Concurso', 'El primer concurso de Social Museum', '2021-05-12', '2021-08-14', 2),
(37, 'Los Paisajes de Michael', 'Expo', 'Las mejores fotografías de paisajes del nuevo artista Michael M.', '2021-05-26', '2021-07-31', 4),
(38, 'Goya y su esplendor', 'Expo', 'Los mejores cuadros de Goya', '2021-06-09', '2021-09-29', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expos`
--

CREATE TABLE `expos` (
  `id_expo` int(11) NOT NULL,
  `id_obra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `expos`
--

INSERT INTO `expos` (`id_expo`, `id_obra`) VALUES
(2, 8),
(2, 9),
(2, 12),
(37, 26),
(37, 27),
(37, 28),
(37, 29),
(37, 30),
(37, 31),
(38, 32),
(38, 33),
(38, 34),
(38, 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id_obra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id_obra`, `id_usuario`) VALUES
(1, 3),
(1, 4),
(1, 5),
(4, 4),
(4, 7),
(4, 16),
(5, 3),
(5, 7),
(6, 3),
(7, 7),
(14, 7),
(16, 7),
(25, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mecenas`
--

CREATE TABLE `mecenas` (
  `id_usuario` int(11) NOT NULL,
  `id_artista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mecenas`
--

INSERT INTO `mecenas` (`id_usuario`, `id_artista`) VALUES
(3, 7),
(7, 9),
(7, 10),
(7, 14),
(14, 2),
(14, 7),
(16, 7),
(16, 9),
(16, 10),
(16, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

CREATE TABLE `obras` (
  `id` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `titulo` varchar(25) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `obras`
--

INSERT INTO `obras` (`id`, `id_autor`, `titulo`, `descripcion`) VALUES
(1, 2, 'Perro', 'Perro jugando'),
(2, 2, 'Fuego', 'Bola de fuego'),
(4, 7, 'Chica frente a un espejo', 'Chica frente a un espejo'),
(5, 7, 'Guernica', 'Guernica'),
(6, 7, 'Las señoritas de Avignon', 'Las señoritas de Avignon'),
(7, 7, 'El viejo guitarrista cieg', 'El guitarrista ciego'),
(8, 8, 'Freedom', 'Fight for freedom'),
(9, 8, 'Player', 'American Player'),
(10, 8, 'Wave', 'Big Blue Wave'),
(11, 8, 'Woman', 'Womans Thoughts'),
(12, 8, 'Murder', 'Secret Murder'),
(13, 9, 'Pajaro', 'Pajaro a lapiz'),
(14, 9, 'Caballo', 'Caballo a lapiz'),
(15, 9, 'Jirafas', 'Jirafas a lapiz'),
(16, 9, 'Gato', 'Gato a lapiz'),
(17, 11, 'El Rapto De Europa', '	El rapto de Europa'),
(18, 11, 'El sueño de San José', 'El sueño de San José'),
(19, 11, 'Piedad', 'Piedad'),
(20, 11, 'La Caida', 'La caída'),
(21, 11, 'Procesion Rural', 'Procesión rural'),
(22, 11, 'Tobías y el ángel', 'Tobías y el ángel'),
(25, 7, 'Autorretrato', 'Esto es un autorretrato'),
(26, 14, 'Playa', 'Paisaje de playa'),
(27, 14, 'Campo', 'Paisaje de campo'),
(28, 14, 'Montañas', 'Paisaje de montañas'),
(29, 14, 'Lago', 'Paisaje de lago'),
(30, 14, 'Atardecer', 'Paisaje de atardecer'),
(31, 14, 'Congelado', 'Paisaje Congelado'),
(32, 11, 'La maja desnuda', 'La maja desnuda es una de las obras más conocidas del pintor español Francisco de Goya.'),
(33, 11, 'Los fusilamientos de 2 de', 'Cuadro del  de Mayo'),
(34, 11, 'El Quita Sol', 'Pareja en verano'),
(35, 11, 'Familia Real', 'Retrato de la Familia Real'),
(36, 7, 'El sueño', 'Mujer que descansa tranquilamente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` float NOT NULL DEFAULT 0,
  `unidades` int(11) NOT NULL DEFAULT 0
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
  `id_obra` int(11) NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `precio_inicial` float NOT NULL DEFAULT 0,
  `precio_actual` float NOT NULL,
  `id_comprador_actual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id_obra`, `fecha_finalizacion`, `precio_inicial`, `precio_actual`, `id_comprador_actual`) VALUES
(4, '2021-12-28', 10500, 10500, NULL),
(5, '2021-07-21', 100000, 100000, NULL),
(9, '2021-08-04', 350, 350, NULL),
(10, '2021-08-18', 899.99, 899.99, NULL),
(11, '2021-07-19', 555.55, 555.55, NULL),
(12, '2021-05-26', 1000, 1000, NULL),
(13, '2021-08-26', 15, 15, NULL),
(14, '2021-07-26', 15, 15, NULL),
(15, '2021-07-26', 15, 15, NULL),
(16, '2021-07-26', 15, 15, NULL),
(36, '2021-09-01', 1000, 1000, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerencias`
--

CREATE TABLE `sugerencias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `correo` varchar(25) DEFAULT NULL,
  `tipo` varchar(25) DEFAULT NULL,
  `contenido` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sugerencias`
--

INSERT INTO `sugerencias` (`id`, `nombre`, `correo`, `tipo`, `contenido`) VALUES
(20, 'Carlota', 'carlota@gmail.com', 'evaluacion', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"'),
(21, 'Javier', 'javier@gmail.com', 'criticas', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nick` varchar(40) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(10) NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nick`, `nombre`, `password`, `rol`, `premium`, `avatar`) VALUES
(1, 'admin', 'Administrador', '$2y$10$j3gDDnUmICg/rvP0lmz8Duv2FcE1Ufi0tDQpIqx5cKcbqtkBOxhfS', 'admin', 0, 0),
(2, 'artist', 'Artista', '$2y$10$rYYIYCUzVJqTAFEhRZV7R.4DZF6hOGuVezEP592V/Su4Jq1D1.KEa', 'artist', 1, 0),
(3, 'user', 'Usuario', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG', 'user', 1, 0),
(4, 'sergioRamos', 'Sergio', '$2y$10$b2ZEmBjoBfnGqi8Kruyi2uByOaItEaYt45b7iNalrFDzvLsLb.302', 'user', 1, 1),
(5, 'ana', 'Ana Martinez', '$2y$10$nC3.49ySiJanNkO3VTOd6eZPcrfaXGaBP3mXMojdUeXsd0t7EsqH2', 'user', 0, 1),
(6, 'pepito', 'Pepito', '$2y$10$c6N1O.toQCs3nbg7VCC7s.5veeUfwNHeahn0ERLrppOJi/7Fv4fXW', 'user', 0, 0),
(7, 'picasso', 'Picasso', '$2y$10$VbAU9zsMosCjfhs4laHY3uFmmOtOTaqQ1Z2ll68GYzd5ZCOJ.H10u', 'artist', 1, 1),
(8, 'raymond', 'Raymond', '$2y$10$isqo0bEJi5.OypoDE.PJKOHeG8pqrLyfvRRParSdrABU3EcPTboWm', 'artist', 1, 1),
(9, 'lupita', 'Lupita', '$2y$10$f9hD3d2NaxmAGsgv.TP9M.tGCX2.r5lpXe9pjMuNr4MnWny5.BO3O', 'artist', 1, 1),
(10, 'soff', 'Sofonisba Angui', '$2y$10$Dh1vSq6GnM0TUO2neFsPUOlMdayjIH2AwZJQmsvSG.dJtcSQhh4bW', 'artist', 1, 1),
(11, 'goya', 'Francisco Goya', '$2y$10$nC3.49ySiJanNkO3VTOd6eZPcrfaXGaBP3mXMojdUeXsd0t7EsqH2', 'artist', 1, 1),
(12, 'abel99', 'Abel Ford', '$2y$10$qu5EZsZP/xQNGPHL6R5/w.A99.jLjEZaFv.m0BSG1eaZkTS2TwIHm', 'user', 0, 1),
(14, 'mikkk', 'Michael', '$2y$10$WCLIri0w/ULuN6cUrM/CRuJwLuoeP5QGAb3/cJ7Oyjn6gsY98jcIG', 'artist', 1, 1),
(15, 'dulaPeep', 'Dua', '$2y$10$7Cbkio5LtTx6gkLLVFqSO.C8JbImJ0xX5NMKSsGDZs3Nms40a4ztm', 'artist', 1, 0),
(16, 'isa99', 'Isabel', '$2y$10$sZX4yCv6zRs706xPTXa9O.szWcnnpR7DXTl9IoWuJtSpMi4Hi55Wa', 'user', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biografias`
--
ALTER TABLE `biografias`
  ADD PRIMARY KEY (`id_autor`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `concursos`
--
ALTER TABLE `concursos`
  ADD PRIMARY KEY (`id_concurso`),
  ADD KEY `concursos_ganador` (`id_ganador`),
  ADD KEY `concursos_premio` (`premio_producto`);

--
-- Indices de la tabla `dibujos`
--
ALTER TABLE `dibujos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id_evento`,`id_usuario`),
  ADD KEY `entradas_usuario` (`id_usuario`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `expos`
--
ALTER TABLE `expos`
  ADD PRIMARY KEY (`id_expo`,`id_obra`),
  ADD KEY `expos_obra` (`id_obra`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_obra`,`id_usuario`),
  ADD KEY `likes_usuario` (`id_usuario`);

--
-- Indices de la tabla `mecenas`
--
ALTER TABLE `mecenas`
  ADD PRIMARY KEY (`id_usuario`,`id_artista`),
  ADD KEY `mecenas_artista` (`id_artista`);

--
-- Indices de la tabla `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD PRIMARY KEY (`id_obra`),
  ADD KEY `pujas_comprador` (`id_comprador_actual`);

--
-- Indices de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
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
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `dibujos`
--
ALTER TABLE `dibujos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `biografias`
--
ALTER TABLE `biografias`
  ADD CONSTRAINT `biografias_autor` FOREIGN KEY (`id_autor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `concursos`
--
ALTER TABLE `concursos`
  ADD CONSTRAINT `concursos_evento` FOREIGN KEY (`id_concurso`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `concursos_ganador` FOREIGN KEY (`id_ganador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `concursos_premio` FOREIGN KEY (`premio_producto`) REFERENCES `productos` (`nombre`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_evento` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entradas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `expos`
--
ALTER TABLE `expos`
  ADD CONSTRAINT `expos_expo` FOREIGN KEY (`id_expo`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expos_obra` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_obra` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mecenas`
--
ALTER TABLE `mecenas`
  ADD CONSTRAINT `mecenas_artista` FOREIGN KEY (`id_artista`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mecenas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `pujas_comprador` FOREIGN KEY (`id_comprador_actual`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pujas_obra` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

