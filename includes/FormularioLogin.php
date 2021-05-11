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
        $correo =$datos['correo'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorCorreo = self::createMensajeError($errores, 'correo', 'span', array('class' => 'error'));
        $errorPassword = self::createMensajeError($errores, 'password', 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <fieldset>
            $htmlErroresGlobales
            <p><label>Correo:</label> <input type="text" name="correo" value="$correo"/>$errorCorreo</p>
            <p><label>Password:</label> <input type="password" name="password" />$errorPassword</p>
            <button type="submit" name="login">Entrar</button>
        </fieldset>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $correo =$datos['correo'] ?? null;
                
        if ( empty($correo) ) {
            $result['correo'] = "El correo no puede estar vacío";
        }
        
        $password = $datos['password'] ?? null;
        if ( empty($password) ) {
            $result['password'] = "El password no puede estar vacío.";
        }
        
        if (count($result) === 0) {
            $usuario = Usuario::login($correo, $password);
            if ( ! $usuario ) {
                // No se da pistas a un posible atacante
                $result[] = "El usuario o el password no coinciden";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['correo'] = $correo;
                $_SESSION['esAdmin'] = strcmp($usuario->rol(), 'admin') == 0 ? true : false;
				$_SESSION['esArtist'] = strcmp($usuario->rol(), 'artist') == 0 ? true : false;
				$_SESSION['user'] = $usuario;
                $result = 'cuenta.php';
            }
        }
        return $result;
    }
}