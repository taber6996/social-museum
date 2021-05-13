<?php 
	require_once __DIR__.'/includes/config.php';

	$tituloPagina = 'Social Museum';

	$contenidoPrincipal=<<<EOS
	<h3>Subscripciones</h3>
		<p>aqui se mostraran las subscripciones</p>
	EOS;

	require __DIR__.'/includes/plantillas/layout2.php';
