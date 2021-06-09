<?php
namespace es\ucm\fdi\aw;

class FormularioCorreo extends Form
{
    public function __construct() {
        parent::__construct('formCorreo');
    }
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$para_usuario = $datos['para_usuario'] ?? '';
		$asunto = $datos['asunto'] ?? '';
		$mensaje = $datos['mensaje'] ?? '';
		
		
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorUsuario = self::createMensajeError($errores, 'para_usuario', 'span', array('class' => 'error'));
        $errorAsunto = self::createMensajeError($errores, 'asunto', 'span', array('class' => 'error'));
        $errorMensaje = self::createMensajeError($errores, 'mensaje', 'span', array('class' => 'error'));

        $html = <<<EOF
        <fieldset>
            $htmlErroresGlobales
            <p><label>Destino:</label> <input type="text" name="para_usuario" value="$para_usuario"/>$errorUsuario</p>
            <p><label>Asunto:</label> <input type="text" name="asunto" value="$asunto"/>$errorAsunto</p>
			
			<p><label>Mensaje:</label>$errorMensaje</p>
			<textarea name="mensaje" rows="10" cols="115" value="$mensaje"></textarea>
			
            <button type="submit" name="enviar">Enviar mensaje</button>
        </fieldset>
EOF;
        return $html;
    }
	

    protected function procesaFormulario($datos)
    {
        $result = array();
		
        $para_usuario = $datos['para_usuario'] ?? null;
        if ( empty($para_usuario)) {
            $result['para_usuario'] = "El usuario destino no puede estar vacío.";
        }
		else if (!Usuario::buscaUsuario($para_usuario))
			$result['para_usuario'] = "El usuario no existe. Intenta escribir otra vez el nick.";
		
        $asunto = $datos['asunto'] ?? null;
        if ( empty($asunto)) {
            $result['asunto'] = "El asunto del mensaje no puede estar vacío.";
        }
		
		$mensaje = $datos['mensaje'] ?? null;
        if ( empty($mensaje)) {
            $result['mensaje'] = "El mensaje no puede estar vacío.";
        }
		
		if (count($result) === 0) {
			Correo::crea($_SESSION["user"]->id(), Usuario::buscaUsuario($para_usuario)->id(), $asunto, $mensaje);
			$result = 'buzon.php';
		}
		
        return $result;
    }
}
