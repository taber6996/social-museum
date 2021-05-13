<?php
namespace es\ucm\fdi\aw;

class FormularioCambiaDatosUsuario extends Form
{
    public function __construct() {
        parent::__construct('formCambiaDatosUsuario');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$user = $_SESSION['user'];
        $correo = $user->correo();
        $nombre = $user->nombre();

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorCorreo = self::createMensajeError($errores, 'correo', 'span', array('class' => 'error'));
        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
        $errorPassword = self::createMensajeError($errores, 'password', 'span', array('class' => 'error'));
        $errorPassword2 = self::createMensajeError($errores, 'password2', 'span', array('class' => 'error'));

        $html = <<<EOF
            <fieldset>
                $htmlErroresGlobales
                <div class="grupo-control">
                    <label>Correo:</label> <input class="control" type="text" name="correo" value="$correo" />$errorCorreo
                </div>
                <div class="grupo-control">
                    <label>Nombre:</label> <input class="control" type="text" name="nombre" value="$nombre" />$errorNombre
                </div>
                <div class="grupo-control">
                    <label>Password:</label> <input class="control" type="password" name="password" />$errorPassword
                </div>
                <div class="grupo-control">
                    <label>Vuelve a introducir el Password:</label> <input class="control" type="password" name="password2" />$errorPassword2
                </div>
                <div class="grupo-control"><button type="submit" name="registro">Aceptar</button></div>
            </fieldset>
        EOF;
        return $html;
    }
	
	
	protected function procesaFormulario($datos)
    {
        $result = array();
        
        $correo = $datos['correo'] ?? null;
        if ( empty($correo) || mb_strlen($correo) < 5 ) { //TODO contiene @?
            $result['correo'] = "El correo tiene que ser válido.";
        }
        
        $nombre = $datos['nombre'] ?? null;
        if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
            $result['nombre'] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $password = $datos['password'] ?? null;
        if ( empty($password) || mb_strlen($password) < 5 ) {
            $result['password'] = "El password tiene que tener una longitud de al menos 5 caracteres.";
        }
        $password2 = $datos['password2'] ?? null;
        if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
            $result['password2'] = "Los passwords deben coincidir";
        }
		
	   
        if (count($result) === 0) {
			$usuario = $_SESSION['user'];
			$usuarioBBDD = Usuario::buscaUsuario($correo);
			
			if ($usuarioBBDD && ($usuarioBBDD->id() != $usuario->id())) {
				$result[] = "El usuario ya existe";
			}else{
				$usuario->cambiaNombre($nombre);
				$usuario->cambiaCorreo($correo);
				$usuario->cambiaPassword($password);
				$_SESSION['user'] = Usuario::actualiza($usuario);
				
				$_SESSION['correo'] = $correo;
				$_SESSION['nombre'] = $nombre;
				$result = 'cuenta.php';
			}
		}
        return $result;
    }
    
}