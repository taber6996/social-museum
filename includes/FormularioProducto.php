<?php
namespace es\ucm\fdi\aw;

class FormularioProducto extends Form
{
    public function __construct() {
        parent::__construct('formProducto');
    }
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
       $nombre = $datos['nombre'] ?? '';
       $descripcion = $datos['descripcion'] ?? '';
	   $precio = $datos['precio'] ?? '';
	   $unidades = $datos['unidades'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
        $errorDescripcion = self::createMensajeError($errores, 'descripcion', 'span', array('class' => 'error'));
        $errorPrecio = self::createMensajeError($errores, 'precio', 'span', array('class' => 'error'));
        $errorUnidades = self::createMensajeError($errores, 'unidades', 'span', array('class' => 'error'));

        $html = <<<EOF
        <fieldset>
            $htmlErroresGlobales
            <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"/>$errorNombre</p>
            <p><label>Descripcion:</label> <input type="text" name="descripcion" value="$descripcion"/>$errorDescripcion</p>
            <p><label>Precio:</label> <input type="number" step="0.01" min="0" name="precio" value="$precio"/>$errorPrecio</p>
            <p><label>Unidades:</label> <input type="text" name="unidades" value="$unidades"/>$errorUnidades</p>
			<p><label for="archivo">Imagen del producto:</label><input type="file" name="archivo" id="archivo" /></p>
            <button type="submit" name="subir_producto">Subir</button>
        </fieldset>
EOF;
        return $html;
    }
	

    protected function procesaFormulario($datos)
    {
        $result = array();
        $nombre = $datos['nombre'] ?? null;
        if ( empty($nombre)) {
            $result['nombre'] = "El nombre del producto no puede estar vacío.";
        }
        $descripcion = $datos['descripcion'] ?? null;
        if ( empty($descripcion)) {
            $result['descripcion'] = "La descripcion del producto no puede estar vacía.";
        }
		$precio = $datos['precio'] ?? null;
		 if ( empty($precio) || $precio <= 0) {
            $result['precio'] = "El precio del producto tiene que ser mayor que 0 €.";
        }
		$unidades = $datos['unidades'] ?? null;
		 if ( empty($unidades) || $unidades < 1) {
            $result['unidades'] = "El numero de unidades del producto tiene que ser por lo menos 1.";
        }
        if (count($result) === 0) {
			$result = self::subirProducto($nombre,$descripcion,$precio,$unidades);	
        }
        return $result;
    }
	
	
	protected function subirProducto($nombre,$descripcion,$precio,$unidades)
	{
		global $EXTENSIONES_PERMITIDAS;
		
		$ok = count($_FILES) == 1 && $_FILES['archivo']['error'] == UPLOAD_ERR_OK;
		if ( $ok ) {
			$archivo = $_FILES['archivo'];
			$nombreAr = $_FILES['archivo']['name'];
			$ok = self::check_file_uploaded_name($nombreAr) && self::check_file_uploaded_length($nombreAr) ;
			$ok = $ok && in_array(pathinfo($nombreAr, PATHINFO_EXTENSION), $EXTENSIONES_PERMITIDAS);
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $_FILES['archivo']['tmp_name']);
			$ok = preg_match('/image\/*./', $mimeType);
			finfo_close($finfo);
			if ( $ok ) {
				$tmp_name = $_FILES['archivo']['tmp_name'];
					
				$dir_subida = "img/productos/";
				
				$producto = Producto::crea($nombre, $descripcion, $precio, $unidades);	
				if ( ! $producto ) {
					
					$result[] = "Ya existe un producto con ese nombre";
				}
				else{
					$fichero_subido = $dir_subida.$nombre.".jpg";
					if ( !move_uploaded_file($tmp_name, $fichero_subido) ) {
						$result[] = 'Error al mover el archivo';
					}else{
						$result = 'cuenta.php'; //mostrar obra en grande?
					}
				}
				
			}else {
			$result[] ='El archivo tiene un nombre o tipo no soportado';
			}
		} else {
			$result[] = 'Error al subir el archivo.';
		}
			return $result;
	}
    
	function check_file_uploaded_name ($filename) {
		return (bool) ((mb_ereg_match('/^[0-9A-Z-_\.]+$/i',$filename) === 1) ? true : false );
	}
	
	function check_file_uploaded_length ($filename) {
		return (bool) ((mb_strlen($filename,'UTF-8') < 250) ? true : false);
	}
	
	function sanitize_file_uploaded_name($filename) {
		$newName = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
		$newName = mb_ereg_replace("([\.]{2,})", '', $newName);
		return $newName;
	}
}
