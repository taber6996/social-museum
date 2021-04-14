<!DOCTYPE html>
 
<html lang="es">
	<head>
		<title>Bocetos</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/practica1.css">
	</head>
	
	<body>
	<!-- Indice de vinculos -->
    <?php
            
            require('includes\comun\cabecera.php');
    ?>

<!-- Imagenes de bocetos y explicaciones -->
<div class="">
 <h2>1. Pantalla de inicio</h2>
 <img src="img/p1.jpg" alt="pantalla_inicio">
 <p>Esta es la pantalla principal. En ella hay una serie de imágenes que van cambiando relacionadas con obras, 
 artistas o exposiciones actuales del museo. Desde la pantalla principal el usuario puede acceder a cualquiera 
 de las opciones del menú en la parte superior: Buscador, Artistas, Expos, Tienda, Eventos, Cuenta e Idioma. 
 Este menú esta presenta en la web en todo momento. En la parte inferior también puede acceder a Sobre nosotros y a Contacto.
Se puede volver a esta pantalla de inicio en cualquier momento pinchando en el nombre o logo de la web.</p>

<h2>2. Buscador</h2>
 <p>Al pinchar la lupa en el menú desde cualquier pantalla, aparece esta página en la que aparecen los resultados 
 que coincidan con lo escrito por el usuario. La búsqueda abarca cualquier artista, exposición, evento o artículo 
 de la tienda. El usuario puede pinchar el resultado que le interese de la lista de resultados.</p>

<h2>3. Artistas</h2>
<img src="img/p3.jpg" alt="pantalla_artistas">
<p>Si el usuario pincha Artistas en en el menú desde cualquier pantalla aparece esta página. 
En ella aparece una lista con todos los artistas registrados en la web. El usuario puede pinchar el nombre de cualquier 
artista para entrar en su perfil.</p>
 
<h2>3.1 Perfil artista</h2>
<img src="img/p3_1.jpg" alt="pantalla_perfil_artista">
<p>Al pinchar en el nombre de cualquier artista en la pantalla Perfil artista se abre el esta pantalla. En ella hay una 
foto de perfil del artista, una pequeña biografía, el numero de seguidores y de obras que tiene y dos botones: uno para 
subscribirse/desubscribirse y otro para mandar un mensaje (solo funciona a los ya subscritos). Debajo hay una galería de 
imágenes con las obras del artista, que pueden ser pinchadas para ver con más detalle. También están las exposiciones actuales 
del museo en las que aparece alguna obra del artista, si se pincha una de ellas se abre la página de dicha exposición.</p>
 
<h2>3.1.1 Detalles Obra - Artista</h2>
<img src="img/p3_1_1.jpg" alt="pantalla_detalle_obra_artista">
<p>Si el usuario pincha una obra desde la pantalla Perfil artista podemos ver una imagen mucho más grande de la obra con la 
descripción aportada por el artista. Los usuarios registrados pueden dar like a la obra y dejar comentarios en el foro. Si pincha 
el nombre del artista vuelve a su perfil, la pantalla Perfil artista.</p>

<h2>4. Expos</h2>
<img src="img/p4.jpg" alt="pantalla_expos">
<p>Se llega a esta página pinchando Expos en el menú desde cualquier pantalla. Primero aparecen las exposiciones que están en curso 
en el museo (una imagen representativa, el nombre y si se trata de una exposición para clientes premium en exclusiva). El usuario 
puede pinchar la exposición que quiera visitar. Debajo aparecen exposiciones futuras y exposiciones pasadas a modo de información 
(no se pueden pinchar).</p>
 
<h2>4.1.a Salas Exposición</h2>
<img src="img/p4_1_a.jpg" alt="pantalla_salas_exposicion">
<p>Cuando el usuario selecciona la exposición que quiere visitar desde la pantalla Expos se abre esta página. En ella se puede ver 
el nombre de la exposición con las diferentes salas que se pueden visitar pinchándolas.</p>

<h2>4.1.b Abrir sesión - Expo</h2>
<img src="img/p4_1_b.jpg" alt="pantalla_abrir_sesion_expo">
<p>Esta página aparece cuando un el usuario no ha abierto sesión y quiere visitar una exposición con acceso premium. Hay un campo 
de texto para introducir el email y otro para la contraseña. También hay una imagen representativa de la expo.</p>

<h2>4.1.1 Detalles Obra - Expo</h2>
<img src="img/p4_1_1.jpg" alt="pantalla_detalles_obra_expo">
<p>Esta pantalla es muy similar a la pantalla Detalles Obra. Se diferencia en que además de la descripción aportada por el artista, 
hay un texto explicativo redactado por el museo sobre la obra y su aportación a la exposición en la que se muestra. Además de los 
likes y comentarios, el cliente puede pinchar en las flechas para cambiar de obra dentro de la misma sala.</p>

<h2>5. Tienda</h2>
<img src="img/p5.jpg" alt="pantalla_tienda">
<p>Pinchando la opción tienda del menú principal llegamos a esta pantalla. En ella se muestran todos los artículos que vende el 
propio museo. Al pinchar en Comprar el articulo se añade al carrito de compra del usuario.</p>
 
<h2>6. Eventos</h2>
<img src="img/p6.jpg" alt="pantalla_eventos">
<p>Al pinchar Eventos en el menú principal el usuario llega a esta pantalla. En un primer momento aparece un calendario junto con los 
eventos más próximos. El usuario puede pinchar cualquier fecha en el calendario para consultar los eventos en ese día concreto. Los 
eventos pueden pincharse para ser dirigidos a sus respectivas páginas.</p>
 
<h2>6.1.a Puja</h2>
<img src="img/p6_1_a.jpg" alt="pantalla_puja">
<p>Si el usuario pincha en la pantalla Eventos una puja, se abre esta pantalla. En ella aparecen imágenes con el nombre de las obras, 
el precio actual y un botón para que el cliente pueda pujar.</p>

<h2>6.1.b Abrir sesión - Puja</h2>
<img src="img/p6_1_b.jpg" alt="pantalla_abrir_sesion_puja">
<p>Similar a la pantalla Abrir Sesión - Expo, en esta pantalla el usuario puede introducir sus datos para confirmar que es un cliente 
premium o un cliente regular con entrada, ya que solo ellos tiene acceso a este tipo de evento.</p>
 
<h2>6.2 Concurso</h2>
<img src="img/p6_2.jpeg" alt="pantalla_concurso">
<p>Los usuarios tendrán la opción de votar por los dibujos que se presenten a algún concurso.</p>

<h2>7.a Abrir sesion - Cuenta</h2>
<p>Llegamos a esta página al seleccionar Cuenta en el menú principal y no tenemos la sesión bierta</p>

<h2>7.b General</h2>
<img src="img/p7_1.jpg" alt="pantalla_cuenta_general">
<p>Si tenemos la sesión abierta y seleccionamos Cuenta en el menú principal se abre esta página. En ella están los datos personales 
y los datos de cuenta del usuario. Puede editar sus datos.</p>

<h2>7.c General (exclusivo de Artista)</h2>
<img src="img/p7_1_art.jpg" alt="pantalla_cuenta_general_artista">
<p>Si la cuenta desde la que iniciamos sesión es de un artista, mostrará más información referente al artista como su biografía, rol, datos de cobro, mecenazgo...</p>

<h2>7.2 Subscripciones</h2>
<img src="img/p7_2.jpg" alt="pantalla_cuenta_subscripciones">
<p>Aparece una lista con los artistas a los que el usiario es fan o mecenar. Con los botones puede cancelar su subscrpción o mandar un 
mensaje.</p>

<h2>7.3 Entradas</h2>
<img src="img/p7_3.jpg" alt="pantalla_cuenta_entradas">
<p>Lista de entradas compradas por el usuario.</p>

<h2>7.4 Mi estudio</h2>
<img src="img/p7_4.jpg" alt="pantalla_cuenta_estudio">
<p>Espacio creativo para el usuario. Tiene tres opciones: ver sus dibujos en la galería, hacer un nuevo dibujo o consular los concursos.</p>

<h2>7.4.a Mi estudio (exclusivo de Artista)</h2>
<img src="img/p7_4_art.jpg" alt="pantalla_cuenta_estudio_artista">
<p>Además de las opciones que tiene un usuario simple, se añaden las opciones de subir una nueva obra y crear una nueva reunión para suscriptores.</p>

<h2>7.4.1 Mi galería</h2>
<img src="img/p7_4_1.jpg" alt="pantalla_cuenta_galeria">
<p>Galería con los dibujos del usuario. Puede pinchar los dibujos.</p>

<h2>7.4.1.1 Dibujo</h2>
<img src="img/p7_4_1_1.jpg" alt="pantalla_cuenta_dibujo">
<p>Si el usuario pincha un dibujo en Mi galería aparece esta pantalla con el dibujo mas grande y con dos opciones: editar y borrar.</p>

<h2>7.4.2 Lienzo</h2>
<img src="img/p7_4_2.jpg" alt="pantalla_cuenta_lienzo">
<p>Herramienta de dibujo para el usuario.</p>

<h2>7.4.3 Concursos</h2>
<img src="img/p7_4_3.jpg" alt="pantalla_cuenta_concursos">
<p>Lista de concursos con dos opciones que se pueden seleccionar: ver y participar.</p>

<h2>7.4.4 Nueva obra (exclusivo de Artista)</h2>
<img src="img/p7_4_4.jpg" alt="pantalla_cuenta_nueva_obra">
<p>Se habilita la herramienta de subida de archivos para nuevas obras.</p>

<h2>7.4.5 Crear reunión (exclusivo de Artista)</h2>
<img src="img/p7_4_5.jpg" alt="pantalla_cuenta_crear_reunion">
<p>Se habilita una pantalla para crear una reunión por Google Meet para los mecenas del artista, suscriptores y suscriptores premium.</p>

<h2>7.5 Compras</h2>
<img src="img/p7_5.jpg" alt="pantalla_cuenta_compras">
<p>Lista de artículos comprados en la tienda por el usuario.</p>

<h2>7.6 Buzón</h2>
<img src="img/p7_6.jpg" alt="pantalla_cuenta_buzon">
<p>Bandeja de entrada con los mensajes y notificaciones recibidos por el usuario. Tambien hay un boton para redactar un nuevo mensaje. 
El usuario puede pinchar en un mensaje o notificacion para leerlo.</p>

<h2>7.6.1 Leer mensaje</h2>
<img src="img/p7_6_1.jpg" alt="pantalla_cuenta_leer_mensaje">
<p>Si el usuario pincha en un mensaje en su bandeja de entrada aparece esta página. Hay un botón para responder al mensaje.</p>

<h2>7.6.2 Redactar mensaje</h2>
<img src="img/p7_6_2.jpg" alt="pantalla_cuenta_redactar_mensaje">
<p>Espacio para redactar un mensaje y enviarlo.</p>


<h2>8. Sobre nosotros</h2>
<img src="img/p8.jpg" alt="pantalla_sobre_nosotros">
<p>Para llegar a esta pantalla el usuario pincha Sobre nosotros en Pantalla de inicio. En esta pantalla aparece una breve descripción 
del sitio web y sus creadores.</p>
 
<h2>9. Contacto</h2>
<img src="img/p9.jpg" alt="pantalla_contacto">
<p>Si el usuario selecciona Contacto en Pantalla de inicio se abre esta página. Hay una serie de formas de contacto con la información 
correspondiente (teléfono, mail, dirección…). 
</p>
 
</div>

</body>
</html>
