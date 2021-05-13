<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = "Cuenta - ";

$contenidoPrincipal = <<<EOS
<nav id="menu-secundario">
<a href="general_admin.php">General</a></li>
<a href="productos.php">Subir producto</a></li>
<a href="lista_eventos.php">Crear evento</a></li>
<a href="logout.php">Cerrar sesión</a></li>
</nav>
<h1>Mi cuenta</h1>
<p>Aquí estarían contenido de la cuenta de un administrador</p>
EOS;
		
require ("includes/plantillas/layout1.php");