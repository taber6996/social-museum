<?php 
require_once __DIR__.'/includes/config.php';
$artist = $_GET['artist'];
$tituloPagina = $artist." - ";

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "active";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "";

$mostradorD = new es\ucm\fdi\aw\MostradorPerfilArtista($artist);
$MostradorPerfilArtista = $mostradorD->muestra();

$mostradorO = new es\ucm\fdi\aw\MostradorObras($artist);
$MostradorObras = $mostradorO->muestra();


$contenidoPrincipal=<<<EOS
$MostradorPerfilArtista
$MostradorObras
EOS;

require __DIR__.'/includes/plantillas/layout1.php';