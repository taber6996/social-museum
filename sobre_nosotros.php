<?php 
require_once __DIR__.'/includes/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sobre Nosotros - Social Museum</title>
	<link rel="stylesheet" type="text/css" href="<?= RUTA_CSS.'/estilo.css'?>" />
	<meta charset="UTF-8">
</head>

<body>

	<?php
    require("includes/comun/header.php");
	?>

	<main>
            <h1>Miembros</h1>
		 
	   <nav class="navigation-miembros" style="margin-bottom: 15px;">
			<ul style="list-style-type: none; margin: 0;  padding: 0; width: 100%; " >
				<li style="display: inline"><a href="#andres">Andrés Saumell Caminos</a></li>
				<li style="display: inline"><a href="#gonzalo">Gonzalo Martín del Río</a></li>
				<li style="display: inline"><a href="#alejandro">Alejandro Tabernero Pérez</a></li>
				<li style="display: inline"><a href="#isabel">Isabel Román Mikkilä</a></li>
			</ul> 
        </nav>
    
        <section class="miembro" id="andres" style="text-align: center;">
          <div class ="foto" >
			<img src="img/nosotros/andy.jpg" alt="andy">
          </div>
          <div class="informacion" >
            <h1>Andrés Saumell Caminos</h1>
            <h2>andresau@ucm.es</h2>
            <p>Amante de la electrónica, videojuegos, la música y el mundo del motor.</p>
        </section>

        <section class="miembro" id="gonzalo" style="text-align: center;">
            <div class="foto" >
                <img src="img/nosotros/gonzalo.jpg" alt="gonzalo">
            </div>
            <div class="informacion" >
                <h1>Gonzalo Martín del Río</h1>
                <h2>gomart03@ucm.es</h2>
                <p>Aficionado al cine y el rugby.</p>
            </div>
        </section>

        <section class="miembro" id="alejandro" style="text-align: center;">
            <div class="foto" >
                <img src="img/nosotros/alex.jpg" alt="alex">
            </div>
            <div class="informacion" >
                <h1>Alejandro Tabernero Pérez</h1>
                <h2>aletab01@ucm.es</h2>
                <p>Disfruto con la fotografía, la música, los videojuegos y el modelismo</p>
            </div>
            
        </section>

         <section class="miembro" id="isabel" style="text-align: center;">
          <div class ="foto" >
          <img src="img/nosotros/isa.jpg" alt="isa">
          </div>
          <div class="informacion" >
            <h1>Isabel Román Mikkilä</h1>
            <h2>iroman02@ucm.es</h2>
            <p>Mis aficiones incluyen el cine, la pintura y los deportes. También me gusta viajar para conocer diferentes culturas
				         y gastronomías. En mi tiempo libre me gusta ver películas y series, practicar yoga y hacer repostería. Disfruto mucho 
				         de la naturaleza y adoro los animales. Mis deportes favoritos son la natación y el esquí.</p>

        </section>
	</main>
	
	<?php
	require("includes/comun/footer.php");
	?>
</body>

</html>