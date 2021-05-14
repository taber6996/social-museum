TRUNCATE TABLE `Usuarios`;
TRUNCATE TABLE `Obras`;
TRUNCATE TABLE `Productos`;

/*
  user@gmail.com: userpass
  admin@gmail.com: adminpass
  artist@gmail.com: artistpass
  sergioRamos@gmail.com : sergiopass
  ana@ucm.es : 12345
  pepito@gmail.com : 12345
  picasso@gmail : picassopass
  raymond@gmail.com : password
  lupita@gmail.com : 12345		
*/
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
(10, 'soff@gmail.com', 'Sofonisba Angui', '$2y$10$Dh1vSq6GnM0TUO2neFsPUOlMdayjIH2AwZJQmsvSG.dJtcSQhh4bW', 'artist', 1);


INSERT INTO `obras` (`id`, `id_autor`, `titulo`, `descripcion`, `likes`) VALUES
(1, 2, 'Perro', 'Perro jugando', 25),
(2, 2, 'Fuego', 'Bola de fuego', 8),
(4, 7, 'Chicafrenteaunespejo', 'Chica frente a un espejo', 0),
(5, 7, 'Guernica', 'Guernica', 0),
(6, 7, 'LassenoritasdeAvignon', 'Las seÃ±oritas de Avignon', 0),
(7, 7, 'Elviejoguitarristaciego', 'El viejo guitarrista ciego', 0),
(8, 8, 'Freedom', 'Fight for freedom', 0),
(9, 8, 'Player', 'American Player', 0),
(10, 8, 'Wave', 'Big Blue Wave', 0),
(11, 8, 'Woman', 'Woman\'s Thoughts', 0),
(12, 8, 'Murder', 'Secret Murder', 0),
(13, 9, 'Pajaro', 'Pajaro a lapiz', 0),
(14, 9, 'Caballo', 'Caballo a lapiz', 0),
(15, 9, 'Jirafas', 'Jirafas a lapiz', 0),
(16, 9, 'Gato', 'Gato a lapiz', 0);

INSERT INTO `Productos` (`id`, `nombre`, `descripcion`, `precio`, `unidades`) VALUES
(1, 'Camiseta', 'Camiseta de algodón con logo', 15, 85),
(2, 'Lapices', 'Lapices de colores', 1, 150);

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