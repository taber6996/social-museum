<?php
namespace es\ucm\fdi\aw;

class FormularioEvento extends Form
{
    public function __construct() {
        parent::__construct('formEvento');
    }
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
       $nombre = $datos['nombre'] ?? '';
	   $tipo = $datos['tipo'] ?? '';
       $descripcion = $datos['descripcion'] ?? '';
	   $fecha_ini = $datos['fecha_ini'] ?? '';
	   $fecha_fin = $datos['fecha_fin'] ?? '';
	   $precio = $datos['precio'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
		$errorTipo = self::createMensajeError($errores, 'tipo', 'span', array('class' => 'error'));
        $errorDescripcion = self::createMensajeError($errores, 'descripcion', 'span', array('class' => 'error'));
		$errorFechaIni = self::createMensajeError($errores, 'fecha_ini', 'span', array('class' => 'error'));
		$errorFechaFin = self::createMensajeError($errores, 'fecha_fin', 'span', array('class' => 'error'));
        $errorPrecio = self::createMensajeError($errores, 'precio', 'span', array('class' => 'error'));

        $html = <<<EOF
        <fieldset>
            $htmlErroresGlobales
            <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"/>$errorNombre</p>
            <p><label>Tipo:</label> <select name="tipo"><option value="Expo">Expo</option><option value="Concurso">Concurso</option></select>$errorTipo</p>
            <p><label>Descripcion:</label> <input type="text" name="descripcion" value="$descripcion"/>$errorDescripcion</p>
			<p><label>Fecha de inicio :</label> <input type="date" name="fecha_ini" value="$fecha_ini"/>$errorFechaIni</p>
			<p><label>Fecha de fin :</label> <input type="date" name="fecha_fin" value="$fecha_fin"/>$errorFechaFin</p>
            <p><label>Precio:</label> <input type="number" step="0.01" min="0" name="precio" value="$precio"/>$errorPrecio</p>
            <button type="submit" name="crear_evento">Crear</button>
        </fieldset>
EOF;
        return $html;
    }
	

    protected function procesaFormulario($datos)
    {
        $result = array();
        $nombre = $datos['nombre'] ?? null;
        if ( empty($nombre)) {
            $result['nombre'] = "El nombre del evento no puede estar vacío.";
        }
        $descripcion = $datos['descripcion'] ?? null;
        if ( empty($descripcion)) {
            $result['descripcion'] = "La descripcion del evento no puede estar vacía.";
        }
		$precio = $datos['precio'] ?? null;
		 if ( empty($precio) || $precio <= 0) {
            $result['precio'] = "El precio del evento tiene que ser mayor que 0 €.";
        }
		$tipo = $datos['tipo'] ?? null;
		 if ( empty($tipo)) {
            $result['tipo'] = "Tienes que elegir algo tipo de evento.";
        }
		$fecha_ini = $datos['fecha_ini'] ?? null;
		 if ( empty($fecha_ini)) {
            $result['fecha_ini'] = "Tienes que elegir cuando empieza el evento.";
        }
		$fecha_fin = $datos['fecha_fin'] ?? null;
		 if ( empty($fecha_fin)) {
            $result['fecha_fin'] = "Tienes que elegir cuando termina el evento.";
        }
		
        if (count($result) === 0) {
			
			$evento = Evento::crea($nombre,$tipo,$descripcion,$fecha_ini,$fecha_fin,$precio);	
			
			if ( ! $evento ) {
                $result[] = "Ya existe un evento de ese tipo con ese nombre";
            } else {
				echo "Evento creado con exito "; //quitar
			}
			
        }
		 
        return $result;
    }
}
