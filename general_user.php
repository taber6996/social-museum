<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = "Cuenta - ";

$contenidoPrincipal = <<<EOS
<nav id="menu-secundario">
<a href="general_user.php">General</a></li>
<a href="subscrpciones.php">Subscripciones</a></li>
<a href="entradas.php">Entradas</a></li>
<a href="estudio.php">Estudio</a></li>
<a href="compras.php">Compras</a></li>
<a href="buzon.php">Buzón</a></li>
<a href="logout.php">Cerrar sesión</a></li>
</nav>
<h1>Mi cuenta</h1>
<p>Aquí estarían contenido de la cuenta</p>
EOS;
		
require ("includes/plantillas/layout1.php");