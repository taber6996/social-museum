<?php
namespace es\ucm\fdi\aw;

class FormularioSugerencias extends Form
{
    public function __construct() {
        parent::__construct('formSugerencias');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {
        $nombre = $datos['nombre'] ?? '';
        $email = $datos['email'] ?? '';
	    $tipo = $datos['tipo'] ?? '';
        $contenido = $datos['contenido'] ?? '';
        $terminos = $datos['terminos'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
        $errorEmail = self::createMensajeError($errores, 'email', 'span', array('class' => 'error'));
		$errorTipo = self::createMensajeError($errores, 'tipo', 'span', array('class' => 'error'));
        $errorContenido = self::createMensajeError($errores, 'contenido', 'span', array('class' => 'error'));
        $errorTerminos = self::createMensajeError($errores, 'terminos', 'span', array('class' => 'error'));

        $html = <<<EOF
            $htmlErroresGlobales
            <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"/>$errorNombre</p>
            <p><label>Email:</label> <input type="text" name="email" value="$email"/>$errorEmail</p>
            <p><label>Motivo de la consulta:</label>$errorTipo</p>
            <input type="radio" name="tipo" value="evaluacion" checked /> Evaluación
            <input type="radio" name="tipo" value="sugerencias" /> Sugerencias
            <input type="radio" name="tipo" value="criticas" /> Críticas
            <br/>
            <p><label>Escriba su consulta:</label>$errorContenido</p> 
            <textarea name="contenido" rows="4" cols="50" value="$contenido"></textarea>
            <br/>
            <button type="submit" name="crear_sugerencia">Enviar</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario($datos)
    {
        $result = array();
        $nombre = $datos['nombre'] ?? null;
        if ( empty($nombre)) {
            $result['nombre'] = "El nombre no puede estar vacío.";
        }
        $email = $datos['email'] ?? null;
        if ( empty($email)) {
            $result['email'] = "El email no puede estar vacío";
        }
		$tipo = $datos['tipo'] ?? null;
		 if ( empty($tipo)) {
            $result['tipo'] = "Tienes que elegir algo tipo de evento.";
        }
        $contenido = $datos['contenido'] ?? null;
        if(empty($contenido)){
            $result['contenido'] = "Por favor, inserta un mensaje.";
        }
        
		
        if (count($result) === 0) {
			
			$sugerencia = Sugerencia::crea($email,$nombre,$tipo,$contenido);
            header("Location: index.php");
        }
		 
        return $result;
    }
}