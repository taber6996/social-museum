<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = "Cuenta - ";

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "active";

$contenidoPrincipal = <<<EOS
<h1>Mi cuenta</h1>
<p>Aquí estarían contenido de la cuenta de un administrador</p>
EOS;
		
require ("includes/plantillas/layout2.php");
