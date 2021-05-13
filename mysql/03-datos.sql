TRUNCATE TABLE `Usuarios`;
TRUNCATE TABLE `Obras`;
TRUNCATE TABLE `Productos`;

/*
  user@gmail.com: userpass
  admin@gmail.com: adminpass
  artist@gmail.com: artistpass
  
*/
INSERT INTO `Usuarios` (`id`, `correo`, `nombre`, `rol`, `password`, `avatar`) VALUES
(1, 'admin@gmail.com', 'Administrador', 'admin', '$2y$10$j3gDDnUmICg/rvP0lmz8Duv2FcE1Ufi0tDQpIqx5cKcbqtkBOxhfS',0),
(2, 'artist@gmail.com', 'Artista', 'artist', '$2y$10$rYYIYCUzVJqTAFEhRZV7R.4DZF6hOGuVezEP592V/Su4Jq1D1.KEa',0),
(3, 'user@gmail.com', 'Usuario', 'user', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG',0);

INSERT INTO `Obras` (`id`, `id_autor`, `titulo`, `descripcion`, `likes`) VALUES
(1, 2, 'Perro', 'Perro jugando', 25),
(2, 2, 'Fuego', 'Bola de fuego', 8);

INSERT INTO `Productos` (`id`, `nombre`, `descripcion`, `precio`, `unidades`) VALUES
(1, 'Camiseta', 'Camiseta de algodón con logo', 15, 85),
(2, 'Lapices', 'Lapices de colores', 1, 150);
