<?php
require_once __DIR__.'/includes/config.php';

//Doble seguridad: unset + destroy
unset($_SESSION["login"]);
unset($_SESSION["esAdmin"]);
unset($_SESSION["nombre"]);


session_destroy();

$tituloPagina = 'Logout - ';

header('Location: index.php');

require __DIR__.'/includes/plantillas/layout1.php';