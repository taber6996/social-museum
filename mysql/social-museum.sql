-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2021 a las 21:39:17
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
(8, 'Aficionado de los cómics. Estos garabatos son lo mejor que hago.'),
(9, 'Estoy aprendiendo a dibujar. Los animales me inspiran, ¿y a ti que te inspira?'),
(11, 'Mi obra abarca la pintura de caballete y mural, el grabado y el dibujo.'),
(14, 'Con mi cámara allá a donde vaya.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buzon`
--

CREATE TABLE `buzon` (
  `id` int(11) NOT NULL,
  `id_desde` int(11) NOT NULL,
  `id_para` int(11) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `buzon`
--

INSERT INTO `buzon` (`id`, `id_desde`, `id_para`, `asunto`, `mensaje`, `fecha`) VALUES
(1, 1, 3, 'Prueba de admin', 'Hola, esto es un mensaje de prueba desde el admin', '2021-06-09 12:47:30'),
(2, 2, 2, 'Redundante', 'Hola, me puedo enviar un correo a mi mismo? Así es.', '2021-06-09 12:51:28'),
(3, 2, 2, 'Prueba', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac ex a est volutpat dignissim. Curabitur urna tellus, iaculis sed augue vel, vulputate imperdiet lorem. Nunc tincidunt magna eu leo dignissim cursus. Sed commodo, odio pharetra mollis euismod, nunc elit rutrum tortor, auctor blandit massa nibh eget erat. Morbi blandit efficitur felis ac consectetur. Proin gravida, eros in consequat aliquam, diam ex dapibus velit, vitae mollis justo felis quis ipsum. Sed ullamcorper augue sit amet tellus ullamcorper tristique. Quisque vitae erat nibh. In posuere lorem ante, in consectetur odio tempor interdum. Nullam commodo urna at nunc pretium, in hendrerit leo feugiat. Praesent mollis erat nec mi porta, vitae aliquet nulla ultricies. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam id dapibus ante, sed posuere mauris. Phasellus consectetur pharetra dictum. Cras posuere iaculis nunc non ullamcorper. Donec laoreet ultricies nisl, sed ullamcorper nibh vestibulum quis.\r\n\r\nVivamus vehicula quis ipsum sit amet dictum. Mauris commodo tellus vitae libero varius, vel ultricies metus efficitur. Donec erat arcu, suscipit et justo in, iaculis iaculis est. Phasellus sed fermentum felis. Proin porta eleifend gravida. Curabitur in tincidunt sapien. Nunc dui nunc, placerat non vehicula ut, elementum nec sapien. Proin non elit neque. Maecenas sodales, lacus vel euismod finibus, eros nisl vehicula diam, in lacinia risus arcu a magna. Duis tempus ornare ornare. Nulla volutpat metus vitae ligula interdum volutpat. Aliquam tempus tincidunt risus nec fermentum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi varius molestie faucibus. Integer quis finibus nisi.\r\n\r\nAliquam malesuada, neque id sagittis accumsan, nisl diam tincidunt mauris, id porttitor felis velit sit amet est. Donec quam augue, vulputate eu aliquet vitae, dapibus at arcu. Pellentesque porttitor consequat metus, quis hendrerit nisl rutrum vitae. Vivamus ac fringilla sapien. Donec aliquam bibendum euismod. Phasellus congue pharetra nulla ut pulvinar. Cras id aliquam orci. Morbi ullamcorper tellus vel nibh placerat, vitae mollis diam suscipit. Aliquam erat volutpat. Duis aliquam orci ut nibh bibendum ultrices. Etiam vel tincidunt urna. Phasellus quis ultricies orci.\r\n\r\nSed fermentum odio nisi, sit amet gravida quam bibendum id. Nullam cursus mi quis tortor fermentum congue. Pellentesque vel neque libero. Nunc ac diam sit amet ipsum varius vehicula. Pellentesque eu luctus dolor. Etiam ac erat odio. Vestibulum mollis libero finibus, suscipit tellus eu, vehicula odio. Aenean eget maximus augue, ac varius lacus.\r\n\r\nNunc metus nibh, ornare sed tortor ac, aliquet tristique lectus. Vivamus ac condimentum dolor. In tincidunt, ante vel semper sagittis, odio velit varius quam, pretium condimentum neque lectus consectetur justo. Maecenas molestie ligula sit amet tempus ultricies. Nunc cursus, lacus et iaculis laoreet, tellus augue consectetur nunc, et convallis massa quam et turpis. In rutrum mi suscipit orci eleifend sodales. Etiam non efficitur est, eu porttitor nulla. Vestibulum iaculis semper posuere.', '2021-06-09 14:22:22'),
(4, 7, 8, 'Hola amigo', '¿Cómo estás?', '2021-06-09 14:33:01'),
(5, 11, 9, 'Asunto super importante', 'a', '2021-06-09 14:48:49'),
(6, 12, 7, 'Disculpe las molestias...', 'Hola, disculpe si le molesto pues no es esa mi intención. Pero de verdad que no consigo entender absolutamente nada de su obra. ¿Podría dar una pequeña charla razonando el por qué de esos garabatos?', '2021-06-09 14:49:15'),
(7, 7, 9, 'Clase', 'Podriamos apuntarnos a clase de pintura juntos', '2021-06-09 16:05:59');

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
(1, 11, 'Me encanta!', '2021-06-03 01:20:07'),
(14, 7, 'Que bonito!', '2021-06-09 13:43:29'),
(14, 3, 'Te ha quedado genial :D', '2021-06-09 14:02:08'),
(31, 3, '¿donde es estooo? que chulo', '2021-06-09 14:02:46'),
(10, 17, 'Me encanta, ¿lo haces con rotu?', '2021-06-09 20:10:23'),
(16, 17, 'Se parece a mi gato', '2021-06-09 20:10:41'),
(34, 17, 'Lo pondría en mi cuarto, es tan bonito', '2021-06-09 20:11:11'),
(36, 17, 'No se si me gusta', '2021-06-09 20:11:24'),
(5, 18, 'Es iconico', '2021-06-09 20:13:46'),
(14, 18, 'El caballo es mi favorito', '2021-06-09 20:14:00'),
(8, 18, 'es original la verdad', '2021-06-09 20:14:13'),
(31, 18, 'wow ', '2021-06-09 20:14:23'),
(5, 19, 'Me da muchos recuerdos buenos y malos', '2021-06-09 20:16:44'),
(30, 19, 'vaya fotos haces', '2021-06-09 20:17:02'),
(30, 19, 'mirad mi perfil tambien porfa', '2021-06-09 20:17:11'),
(49, 15, 'jajajajajajaj', '2021-06-09 20:18:32'),
(50, 3, 'que divertido', '2021-06-09 20:26:07');

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
(13, 1, 3),
(14, 2, 3),
(15, 2, 3);

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
(37, 20),
(38, 3),
(38, 20),
(39, 20);

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
(38, 'Goya y su esplendor', 'Expo', 'Los mejores cuadros de Goya', '2021-06-09', '2021-09-29', 5),
(39, 'Flores', 'Expo', 'Mas y mas flores', '2021-06-09', '2021-07-07', 5),
(40, 'Comics', 'Expo', 'Comics muy divertidos', '2021-06-10', '2021-06-10', 2.5),
(41, 'Perrete', 'Expo', 'Perros graciosos de nuestra nueva artista', '2021-06-11', '2021-07-09', 5.99);

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
(38, 35),
(39, 45),
(39, 46),
(39, 47),
(39, 48),
(40, 8),
(41, 49),
(41, 50),
(41, 51),
(41, 52),
(41, 53);

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
(4, 3),
(4, 4),
(4, 7),
(4, 16),
(4, 17),
(5, 3),
(5, 7),
(5, 18),
(5, 20),
(6, 3),
(6, 19),
(7, 3),
(7, 7),
(7, 20),
(8, 17),
(8, 18),
(9, 17),
(10, 17),
(12, 17),
(13, 3),
(13, 18),
(14, 3),
(14, 7),
(14, 17),
(14, 18),
(16, 3),
(16, 7),
(16, 17),
(17, 3),
(17, 17),
(20, 20),
(21, 17),
(22, 17),
(22, 20),
(25, 3),
(25, 7),
(25, 17),
(26, 3),
(26, 19),
(26, 20),
(28, 3),
(29, 3),
(30, 3),
(30, 19),
(30, 20),
(31, 3),
(31, 18),
(31, 20),
(32, 17),
(32, 20),
(33, 20),
(34, 17),
(35, 17),
(35, 20),
(37, 18),
(38, 18),
(40, 18),
(42, 18),
(49, 15),
(50, 3),
(50, 15),
(51, 15),
(52, 3),
(52, 15),
(53, 15);

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
(3, 9),
(3, 11),
(7, 9),
(7, 10),
(7, 14),
(14, 7),
(16, 7),
(16, 9),
(16, 10),
(16, 11),
(17, 7),
(17, 8),
(18, 8),
(18, 14),
(18, 17),
(19, 8),
(20, 7),
(20, 11);

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
(36, 7, 'El sueño', 'Mujer que descansa tranquilamente'),
(37, 17, 'Un grito', 'Casi como el grito'),
(38, 17, 'Una monalisa', 'Casi como la monalisa'),
(39, 18, 'Comic 1', '1'),
(40, 18, 'Comic 2', '2'),
(41, 18, 'Comic 3', '3'),
(42, 18, 'Comic 4', '4'),
(43, 18, 'Comic 5', '5'),
(44, 18, 'Comic 6', '6'),
(45, 19, 'Flores 1', 'Flores'),
(46, 19, 'Flores 2', 'Flores y flores'),
(47, 19, 'Flores 3', 'Flores para siempre'),
(48, 19, 'Flores 4', 'Mas flores'),
(49, 15, 'Dog 1', '1'),
(50, 15, 'Dog 2', '2'),
(51, 15, 'Dog 3', '3'),
(52, 15, 'Dog 4', '4'),
(53, 15, 'Dog 5', '5');

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
(2, 'Lapices', 'Lapices de colores', 1, 150),
(3, 'Paraguas', 'Bonito paraguas negro y azul', 15, 25),
(5, 'Pulsera', 'Pulsera multicolor', 2, 100),
(6, 'Taza', 'Wifi taza', 5, 50),
(7, 'Cojin', 'Cojin de colores', 15, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pujas`
--

CREATE TABLE `pujas` (
  `id` int(11) NOT NULL,
  `id_obra` int(11) NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `precio_inicial` float NOT NULL DEFAULT 0,
  `precio_actual` float NOT NULL,
  `id_comprador_actual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_obra`, `fecha_finalizacion`, `precio_inicial`, `precio_actual`, `id_comprador_actual`) VALUES
(1, 4, '2021-12-28', 10500, 10500, NULL),
(2, 5, '2021-07-21', 100000, 100000, NULL),
(3, 9, '2021-08-04', 350, 350, NULL),
(4, 10, '2021-08-18', 899.99, 899.99, NULL),
(5, 11, '2021-07-19', 555.55, 555.55, NULL),
(6, 12, '2021-05-26', 1000, 1000, NULL),
(7, 13, '2021-08-26', 15, 15, NULL),
(8, 14, '2021-07-26', 15, 15, NULL),
(9, 15, '2021-07-26', 15, 15, NULL),
(10, 16, '2021-07-26', 15, 15, NULL),
(11, 36, '2021-09-01', 1000, 1000, NULL),
(12, 37, '2021-06-30', 25, 25, NULL),
(13, 38, '2021-06-30', 30, 30, NULL),
(14, 45, '2021-07-10', 100, 100, NULL);

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
(3, 'user', 'Usuario', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG', 'user', 0, 0),
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
(15, 'dulaPeep', 'Dua', '$2y$10$7Cbkio5LtTx6gkLLVFqSO.C8JbImJ0xX5NMKSsGDZs3Nms40a4ztm', 'artist', 1, 1),
(16, 'isa99', 'Isabel', '$2y$10$sZX4yCv6zRs706xPTXa9O.szWcnnpR7DXTl9IoWuJtSpMi4Hi55Wa', 'user', 0, 1),
(17, 'niki', 'Nicole', '$2y$10$qr7A7czlldrBGpWDPZ8kuOth.7vNZzfDj0T6p2TsEa1bSSH8owVYm', 'artist', 1, 1),
(18, 'comicMan', 'Damion', '$2y$10$bn3L8iAEaZjH1p/bdDTli.6HqWytll1riXW57rfsqkKRf8PAChfXS', 'artist', 1, 1),
(19, 'flowerPop', 'Cinder', '$2y$10$ctkRYBGtBMyWcyFk/3OS.OkwU7VPkSfJHdpA3qys7U3yHknaYGwW.', 'artist', 1, 1),
(20, 'elenaM', 'Elena Maldonado', '$2y$10$WyF0esJ8bLRgUwBR5ii1p.eZHeJWf0QU3P5T6VDSASrzX0jbH4G9y', 'user', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biografias`
--
ALTER TABLE `biografias`
  ADD PRIMARY KEY (`id_autor`);

--
-- Indices de la tabla `buzon`
--
ALTER TABLE `buzon`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `pujas_comprador` (`id_comprador_actual`),
  ADD KEY `pujas_obra` (`id_obra`);

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
-- AUTO_INCREMENT de la tabla `buzon`
--
ALTER TABLE `buzon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `dibujos`
--
ALTER TABLE `dibujos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pujas`
--
ALTER TABLE `pujas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
