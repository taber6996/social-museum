<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = "Cuenta - ";
$contenidoPrincipal = <<<EOS
<nav id="Menu Artista">
<a href="general_artist.php">General</a></li>
<a href="subscrpciones.php">Subscripciones</a></li>
<a href="entradas.php">Entradas</a></li>
<a href="mis_obras.php">Mis obras</a></li>
<a href="compras.php">Compras</a></li>
<a href="buzon.php">Buzón</a></li>
<a href="logout.php">Cerrar sesión</a></li>
</nav>
EOS;	
$contenidoPrincipal .= <<<EOS
<h1>Mi cuenta</h1>
<p>Aquí estarían contenido de la cuenta de un artista</p>
EOS;
		
require ("includes/plantillas/layout1.php");