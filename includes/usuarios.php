<?php

function saludo() {
  $html = '';

  $raizApp = RUTA_APP;
	if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
		$html = "Bienvenido, ${_SESSION['nombre']} <a href='${raizApp}logout.php'>(salir)</a>";

	} else {
		$html = "Usuario desconocido. <a href='${raizApp}login.php'>Login</a>";
	}

  return $html;
}

function checkLogin() {
  $username = isset($_POST["username"]) ? $_POST["username"] : null;
  $password = isset($_POST["password"]) ? $_POST["password"] : null;

  $usuario = Usuario::login($username, $password);

  if ($usuario) {
    if ($usuario->username()==="user") {
      $_SESSION["login"] = true;
      $_SESSION["nombre"] = "Usuario";
    } else {
      $_SESSION["login"] = true;
      $_SESSION["nombre"] = "Administrador";
      $_SESSION["esAdmin"] = true;
    }
  }
}

function logout() {
  //Doble seguridad: unset + destroy
  unset($_SESSION["login"]);
  unset($_SESSION["esAdmin"]);
  unset($_SESSION["nombre"]);


  session_destroy();
  session_start();
}
