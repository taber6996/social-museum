<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Dibujos - ';

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuDibujos = "active";
$menuEventos = "";
$menuCuenta = "";

$mostrador = new es\ucm\fdi\aw\MostradorDibujos();
$htmlMostradorDibujos = $mostrador->muestra();

$contenidoPrincipal=<<<EOS
<div class="tarjetasSubastas">
$htmlMostradorDibujos
</div>
EOS;

require __DIR__.'/includes/plantillas/layout1.php';
