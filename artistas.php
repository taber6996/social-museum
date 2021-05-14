<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Artistas - ';

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas ="active";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "";

$mostrador = new es\ucm\fdi\aw\MostradorArtistas();
$htmlMostradorArtistas = $mostrador->muestra();

$contenidoPrincipal=<<<EOS
<div class = "tarjetasArtistas">
$htmlMostradorArtistas
</div>
EOS;

require __DIR__.'/includes/plantillas/layout1.php';