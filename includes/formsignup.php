<?php

require_once __DIR__.'/config.php';
require_once __DIR__.'/formlib.php';
require_once __DIR__.'/UsuarioBD.php';

function formularioSignup() {
  formulario('signup', 'generaFormularioSignup', 'procesaFormularioSignup', 'signup.php');
}

function generaFormularioSignup($datos) {
  //$user = 'user@example.org';
  //$pass = '12345';
  /*if ($datos) {
    $user = isset($datos['user']) ? $datos['user'] : 'user@example.org';
    $pass = isset($datos['pass']) ? $datos['pass'] : '12345';
  }*/
  
  $html = <<<EOS
  <p><label for="email">Email:</label><input type="text" name="email" id="email" value placeholder="user@example.org" /></p>
  <p><label for="user">Usuario:</label><input type="text" name="user" id="user" value placeholder="nickname99" /></p>
  <p><label for="pass">Contraseña:</label><input type="text" name="pass" id="pass" value placeholder="password" /></p>
  <p><label for="name">Nombre completo:</label><input type="text" name="name" id="name" value placeholder="Juan Pérez" /></p>
  <p><label for="artista">Selecciona la casilla para crear una cuenta de artista </label><input type="checkbox" name="artista" id="artista" /></p>
  <p><button type="submit" name="signup">Sign up</button>
EOS;
  return $html;
}

//define('HTML5_EMAIL_REGEXP', '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/');

function procesaFormularioSignup($params) {
  sleep(3);
  $result = array();
  $ok = TRUE;

  $email = isset($params['email']) ? $params['email'] : null ;
  
  $user = isset($params['user']) ? $params['user'] : null ;
  /*if ( !$user || ! preg_match(HTML5_EMAIL_REGEXP, $user) ) {
    $result[] = 'El nombre de usuario no es válido';
    $ok = FALSE;
  }
*/
  $pass = isset($params['pass']) ? $params['pass'] : null ;
  if ( ! $pass ||  strlen($pass) < 4 ) {
    $result[] = 'La contraseña no es válida';
    $ok = FALSE;
  }
  
  $name = isset($params['name']) ? $params['name'] : null ;
  
  $artista = isset($params['artista']) ? $params['artista'] : null ;
  if($artista)
	  $artista = 1;
  else
	  $artista = 0;

  if ( $ok ) {
    /*if ( $user == "user@example.org" && $pass == "12345" ) {
      // SEGURIDAD: Forzamos que se genere una nueva cookie de sesión por si la han capturado antes de hacer login
      session_regenerate_id(true);
      $_SESSION['user'] = $user;
      $result = EJEMPLO;
    }*/
	$usuarioObj = Usuario::signup($email, $user, $pass, $name, $artista);
	
    if(!$usuarioObj){
		$result[] = 'El usuario no se ha podido crear';
	}
	else {
      session_regenerate_id(true);
      $_SESSION['user'] = $usuarioObj;
      $_SESSION['login'] = true;
      //header('Location: index.php');
      $result = 'index.php';
    }
  }
  return $result;
}
?>