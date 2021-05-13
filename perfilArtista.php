<?php 
require_once __DIR__.'/includes/config.php';
$artist = $_GET['artist'];
$tituloPagina = $artist." - ";

$mostrador = new es\ucm\fdi\aw\MostradorPerfilArtista($artist);
$MostradorPerfilArtista = $mostrador->muestra();

$contenidoPrincipal=<<<EOS
$MostradorPerfilArtista
EOS;

require __DIR__.'/includes/plantillas/layout1.php';