<?php 
	require_once __DIR__.'/includes/config.php';

	$tituloPagina = "Mi buzón - ";

	$menuArtistas = "";
	$menuExpos = "";
	$menuTienda = "";
	$menuEventos = "";
	$menuCuenta = "active";
	
	$menuSGeneral = "";
	$menuSMecenazgos = "";
	$menuSEntradas = "";
	$menuSMisObras = "";
	$menuSCompras = "";
	$menuSBuzon = "active";
	
	$menuSGeneral = "";
	$menuSMecenazgos = "";
	$menuSEntradas = "";
	$menuSCanvas = "";
	$menuSCompras = "";
	$menuSBuzon = "active";

	$mostrador = new es\ucm\fdi\aw\MostradorCorreos();
	$form = new es\ucm\fdi\aw\FormularioCorreo();
	$htmlMostradorCorreos = "";
	
	if(isset($_GET["ver"]))
	{
		$ver = $_GET["ver"];
		if($ver == "recibidos")
			$htmlMostradorCorreos = $mostrador->muestraRecibidos($_SESSION["user"]->id());
		else if($ver == "enviados")
			$htmlMostradorCorreos = $mostrador->muestraEnviados($_SESSION["user"]->id());
	}

	$contenidoPrincipal=<<<EOS
	<nav id="menu-secundario">
	<a href="redactarCorreo.php">Redactar</a>
	<a href="buzon.php?ver=recibidos">Recibidos</a>
	<a href="buzon.php?ver=enviados">Enviados</a>
	</nav>
	$htmlMostradorCorreos
	EOS;

	require __DIR__.'/includes/plantillas/layout2.php';
?>