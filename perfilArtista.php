<?php 
require_once __DIR__.'/includes/config.php';

if(isset($_GET['artist'])){
	$artist = $_GET['artist'];
	$_SESSION['perfil'] = $artist;

}else{
	$artist = $_SESSION['perfil'];
}
$tituloPagina = $artist." - ";

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "active";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "";

$mostradorA= new es\ucm\fdi\aw\MostradorArtista($artist);
$MostradorPerfilArtista = $mostradorA->muestraPerfil();
$MostradorObras = $mostradorA->muestraObras();
$MostradorExpos = $mostradorA->muestraExpos();

$contenidoPrincipal=<<<EOS

<div class="perfilArtista">
	<div id="info_artista">
	$MostradorPerfilArtista
	</div>
	<div id="obras_artista">
		<h2>OBRAS</h2>
		<div id="galeria_artista">
		$MostradorObras
		</div>
	</div>
	<div id="expos_artista">
	<h2>EXPOS</h2>
	$MostradorExpos
	</div>
</div>
EOS;

require __DIR__.'/includes/plantillas/layout1.php';