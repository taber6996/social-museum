<?php
namespace es\ucm\fdi\aw;

class FormularioLogin extends Form
{
    public function __construct() {
        parent::__construct('formLogin');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nick =$datos['nick'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNick = self::createMensajeError($errores, 'nick', 'span', array('class' => 'error'));
        $errorPassword = self::createMensajeError($errores, 'password', 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <fieldset>
            $htmlErroresGlobales
            <p><label>Nick:</label> <input type="text" name="nick" value="$nick"/>$errorNick</p>
            <p><label>Password:</label> <input type="password" name="password" />$errorPassword</p>
            <button type="submit" name="login">Entrar</button>
        </fieldset>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $nick =$datos['nick'] ?? null;
                
        if ( empty($nick) ) {
            $result['nick'] = "El nick no puede estar vacío";
        }
        
        $password = $datos['password'] ?? null;
        if ( empty($password) ) {
            $result['password'] = "El password no puede estar vacío.";
        }
        
        if (count($result) === 0) {
            $usuario = Usuario::login($nick, $password);
            if ( ! $usuario ) {
                // No se da pistas a un posible atacante
                $result[] = "El usuario o el password no coinciden";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nick'] = $nick;
                $_SESSION['esAdmin'] = strcmp($usuario->rol(), 'admin') == 0 ? true : false;
				$_SESSION['esArtist'] = strcmp($usuario->rol(), 'artist') == 0 ? true : false;
				$_SESSION['user'] = $usuario;
				$_SESSION['avatar'] = $usuario->avatar();
				$_SESSION['premium'] = $usuario->premium();
                $result = 'cuenta.php';
            }
        }
        return $result;
    }
}
