<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = '';

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas ="";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "";

$contenidoPrincipal=<<<EOS

<!-- <img src="img/c1.jpg" width="75%" height="400px">-->
<div class="galeria">
    <input type="radio" name="navegacion" id="_1" checked>
    <input type="radio" name="navegacion" id="_2">
    <input type="radio" name="navegacion" id="_3">
    <input type="radio" name="navegacion" id="_4"> 
    <img src="img/c1.jpg" width="960" height="480" alt="Galeria CSS 1" />
    <img src="img/c2.jpg" width="960" height="480" alt="Galeria CSS 2"  />
    <img src="img/c3.jpg" width="960" height="480" alt="Galeria CSS 3" />
    <img src="img/c4.jpg" width="960" height="480" alt="Galeria CSS 4" />
</div>
EOS;

require __DIR__.'/includes/plantillas/layout1.php';