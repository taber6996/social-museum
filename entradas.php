<?php 
	require_once __DIR__.'/includes/config.php';

	$tituloPagina = 'Social Museum';

	$contenidoPrincipal=<<<EOS
	<h3>Entradas</h3>
		<p>aqui se mostraran las entradas</p>
	EOS;

	require __DIR__.'/includes/plantillas/layout1.php';