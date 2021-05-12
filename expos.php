<?php 
	require_once __DIR__.'/includes/config.php';

	$tituloPagina = 'Expos - ';

	$mostrador = new es\ucm\fdi\aw\MostradorExpos();
	$htmlMostradorExpos = $mostrador->muestra();
	
	
	$contenidoPrincipal=<<<EOS
		<nav id="menu-principal">
		<!-- <li> <img src="img/busca.jpg" width="15px" height="15px"> </li> --> 
		<a href="expos.php?momento=pasadas">Exposiciones pasadas</a>
		<a href="expos.php?momento=presente">Exposiciones presente</a>
		<a href="expos.php?momento=futuras">Exposiciones futuras</a>
		<a href="expos.php">Todas</a>
		<!-- <li> | <img src="img/spanish.jpg" width="15px" height="15px"> </li> -->
		</nav>	
		$htmlMostradorExpos
		EOS;

	require __DIR__.'/includes/plantillas/layout1.php';