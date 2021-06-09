<?php 
	require_once __DIR__.'/includes/config.php';

	$tituloPagina = "Nuevo mensaje - ";

	$menuArtistas = "";
	$menuExpos = "";
	$menuTienda = "";
	$menuDibujos = "";
	$menuEventos = "";
	$menuCuenta = "active";
	
	$menuSGeneral = "";
	$menuSMecenazgos = "";
	$menuSEntradas = "";
	$menuSCanvas = "";
	$menuSCompras = "";
	$menuSBuzon = "active";
	
	$menuSGeneral = "";
	$menuSMecenazgos = "";
	$menuSEntradas = "";
	$menuSCanvas = "";
	$menuSMisObras = "";
	$menuSCompras = "";
	$menuSBuzon = "active";
	
	$form = new es\ucm\fdi\aw\FormularioCorreo();
	$htmlFormularioCorreo = $form->gestiona();

	$contenidoPrincipal=<<<EOS
	<nav id="menu-secundario">
	<a href="redactarCorreo.php">Redactar</a>
	<a href="buzon.php?ver=recibidos">Recibidos</a>
	<a href="buzon.php?ver=enviados">Enviados</a>
	</nav>
	$htmlFormularioCorreo
	EOS;

	require __DIR__.'/includes/plantillas/layout2.php';
?>