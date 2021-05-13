<?php
namespace es\ucm\fdi\aw;

class FormularioObra extends Form
{
    public function __construct() {
        parent::__construct('formObra');
    }
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$titulo = $datos['titulo'] ?? '';
		$descripcion = $datos['descripcion'] ?? '';
		
		$puja = 0;
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorTitulo = self::createMensajeError($errores, 'titulo', 'span', array('class' => 'error'));
        $errorDescripcion = self::createMensajeError($errores, 'descripcion', 'span', array('class' => 'error'));
        $errorArchivo = self::createMensajeError($errores, 'archivo', 'span', array('class' => 'error'));

        $html = <<<EOF
        <fieldset>
            $htmlErroresGlobales
            <p><label>Titulo:</label> <input type="text" name="titulo" value="$titulo"/>$errorTitulo</p>
            <p><label>Descripcion:</label> <input type="text" name="descripcion" value="$descripcion"/>$errorDescripcion</p>
            <p><label for="archivo">Archivo:</label><input type="file" name="archivo" id="archivo" /></p>
			<p><label>Activar Subasta: </label> <input type="checkbox" name="subasta"/>
			<p><label>Puja inicial:</label> <input type="number" name="puja" value="$puja"/></p>
			<p><label>Fecha limite(minimo una hora mas de la hora actual):</label> <input type="datetime-local" name="fecha" value="$puja"/></p>
            <button type="submit" name="subir_obra">Subir</button>
        </fieldset>
EOF;
        return $html;
    }
	

    protected function procesaFormulario($datos)
    {
        $result = array();
		
        $titulo = $datos['titulo'] ?? null;
		$subasta = $datos['subasta'];
        if ( empty($titulo)) {
            $result['titulo'] = "El titulo de la obra no puede estar vacío.";
        }
        $descripcion = $datos['descripcion'] ?? null;
        if ( empty($descripcion)) {
            $result['descripcion'] = "La descripcion de la obra no puede estar vacía.";
        }
        if (count($result) === 0) {
			if($subasta){
				$puja_inicial = $datos['puja'];
				$fecha_limite = strtotime($datos['fecha']);
				$result[] = self::subirObraySubasta($titulo,$descripcion,$_SESSION['user']->id(), $puja_inicial, $fecha_limite);
			}
			else{
				$result = self::subirObra($titulo,$descripcion,$_SESSION['user']->id());
		}	
        }
	
        return $result;
    }
	
	
	protected function subirObra($titulo,$descripcion,$id_autor)
	{
		global $EXTENSIONES_PERMITIDAS;
		
		$ok = count($_FILES) == 1 && $_FILES['archivo']['error'] == UPLOAD_ERR_OK;
		if ( $ok ) {
			$archivo = $_FILES['archivo'];
			$nombre = $_FILES['archivo']['name'];
			$ok = self::check_file_uploaded_name($nombre) && self::check_file_uploaded_length($nombre) ;
			$ok = $ok && in_array(pathinfo($nombre, PATHINFO_EXTENSION), $EXTENSIONES_PERMITIDAS);
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $_FILES['archivo']['tmp_name']);
			$ok = preg_match('/image\/*./', $mimeType);
			finfo_close($finfo);
			if ( $ok ) {
				$tmp_name = $_FILES['archivo']['tmp_name'];
					
				$dir_subida = "img/obras/artista_".$id_autor."/";
				if (!file_exists($dir_subida))	//Si es la primera subida de archivo, la carpeta no esta creada todavia
					mkdir($dir_subida, 0777, true);		//Se crea la carpeta
					
				$obra = Obra::crea($titulo, $descripcion, $id_autor);	
				if ( ! $obra ) {
					
					$result[] = "Ya existe una obra tuya con ese título";
				}
				else{
					$fichero_subido = $dir_subida.$titulo.".jpg";
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

	protected function subirObraySubasta($titulo,$descripcion,$id_autor, $puja_inicial, $fecha_limite)
	{
		global $EXTENSIONES_PERMITIDAS;
		
		$ok = count($_FILES) == 1 && $_FILES['archivo']['error'] == UPLOAD_ERR_OK;
		if ( $ok ) {
			$archivo = $_FILES['archivo'];
			$nombre = $_FILES['archivo']['name'];
			$ok = self::check_file_uploaded_name($nombre) && self::check_file_uploaded_length($nombre) ;
			$ok = $ok && in_array(pathinfo($nombre, PATHINFO_EXTENSION), $EXTENSIONES_PERMITIDAS);
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $_FILES['archivo']['tmp_name']);
			$ok = preg_match('/image\/*./', $mimeType);
			finfo_close($finfo);
			if ( $ok ) {
				$tmp_name = $_FILES['archivo']['tmp_name'];
					
				$dir_subida = "img/obras/artista_".$id_autor."/";
				if (!file_exists($dir_subida)){	//Si es la primera subida de archivo, la carpeta no esta creada todavia
					mkdir($dir_subida, 0777, true);	}	//Se crea la carpeta
				if($puja_inicial > 0){
					if($fecha_limite >= time()+60*60){ //timepo del server mas 1 hora
						$fecha_parse = new \DateTime();
						
						$fecha_limite_aux = $fecha_parse->createFromFormat("U", $fecha_limite);
						//printr($fecha_limite_aux );
						$fecha_limite = $fecha_limite_aux->format("Y-m-d H:i:s");
						echo $fecha_limite;
						//printr($fecha_limite_aux );
						$obra = Obra::crea($titulo, $descripcion, $id_autor);
						if($obra){
							$subasta = Puja::crea($obra->id(), $puja_inicial, $fecha_limite);
						}
						else{
							$result[] = "No se pudo subir la obra";
						}
						
				if ( ! $obra ) {
					
					$result[] = "Ya existe una obra tuya con ese título";
				}
				if(!$subasta){
					$result[] = "No se pudo crear la subasta";
				}
				else{
					$fichero_subido = $dir_subida.$titulo.".jpg";
					if ( !move_uploaded_file($tmp_name, $fichero_subido) ) {
						$result[] = 'Error al mover el archivo';
					}else{
						$result = 'cuenta.php'; //mostrar obra en grande?
					}
				}
					}
					else{
						$result[] = "Fecha introducida no es válida.";
					}
				}
				else{
					$result[] = "Valor de la puja no es valido.";
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



