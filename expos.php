<?php 
	require_once __DIR__.'/includes/config.php';

	$tituloPagina = 'Expos - ';

	/* VARIABLES PARA DEJAR MARCADO EL MENU */
	$menuArtistas = "";
	$menuExpos = "active";
	$menuTienda = "";
	$menuEventos = "";
	$menuCuenta = "";

	$mostrador = new es\ucm\fdi\aw\MostradorExpos();
	$htmlMostradorExpos = $mostrador->muestra();
	
	
	$contenidoPrincipal=<<<EOS
		<aside>
		<nav id="menu-secundario">
		<a href="expos.php?momento=pasadas">Exposiciones pasadas</a>
		<a href="expos.php?momento=presente">Exposiciones presente</a>
		<a href="expos.php?momento=futuras">Exposiciones futuras</a>
		<a href="expos.php">Todas</a>
		</nav>
		</aside>	
		$htmlMostradorExpos
		EOS;

	require __DIR__.'/includes/plantillas/layout1.php';