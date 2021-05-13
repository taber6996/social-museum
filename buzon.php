<?php 
	require_once __DIR__.'/includes/config.php';

	$tituloPagina = 'Social Museum';

	$contenidoPrincipal=<<<EOS
	<h3>Buzón</h3>
		<p>aqui se mostrara el buzon</p>
	EOS;

	require __DIR__.'/includes/plantillas/layout2.php';
