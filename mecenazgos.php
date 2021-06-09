<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Social Museum';

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "active";

$mostrador = new es\ucm\fdi\aw\MostradorArtistas();
$htmlMostradorArtistas = $mostrador->muestraMisArtistas($_SESSION["user"]);

$contenidoPrincipal=<<<EOS
<h3>Mecenazgos</h3>
		$htmlMostradorArtistas
EOS;

require __DIR__.'/includes/plantillas/layout2.php';
