<?php

require_once __DIR__.'/config.php';
require_once __DIR__.'/formlib.php';
require_once __DIR__.'/UsuarioBD.php';

function formularioSignup() {
  formulario('signup', 'generaFormularioSignup', 'procesaFormularioSignup', 'signup.php');
}

function generaFormularioSignup($datos) {
  $user = 'user@example.org';
  $pass = '12345';
  if ($datos) {
    $user = isset($datos['user']) ? $datos['user'] : 'user@example.org';
    $pass = isset($datos['pass']) ? $datos['pass'] : '12345';
  }
  
  $html = <<<EOS
  <p><label for="user">Usuario:</label><input type="text" name="user" id="user" value="$user" /></p>
  <p><label for="pass">Contraseña:</label><input type="text" name="pass" id="pass" value="$pass" /></p>
  <p><button type="submit" name="signup">Sign up</button>
EOS;
  return $html;
}

define('HTML5_EMAIL_REGEXP', '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/');

function procesaFormularioSignup($params) {
  sleep(3);
  $result = array();
  $ok = TRUE;

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

  if ( $ok ) {
    /*if ( $user == "user@example.org" && $pass == "12345" ) {
      // SEGURIDAD: Forzamos que se genere una nueva cookie de sesión por si la han capturado antes de hacer login
      session_regenerate_id(true);
      $_SESSION['user'] = $user;
      $result = EJEMPLO;
    }*/
    if(Usuario::signup($user, $pass)){
      session_regenerate_id(true);
      $_SESSION['user'] = $user;
      $_SESSION['login'] = true;
      //header('Location: index.php');
      $result = 'index.php';
    }
  }
  return $result;
}
?>