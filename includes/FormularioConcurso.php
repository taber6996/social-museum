<?php
namespace es\ucm\fdi\aw;

class FormularioConcurso extends Form
{
    public function __construct($nombreConcurso) {
        parent::__construct('formConcurso');
		$this->concurso = Evento::buscaEvento($nombreConcurso,'Concurso');
    }
	
	private $concurso;
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorPremio = self::createMensajeError($errores, 'premio', 'span', array('class' => 'error'));
		if($this->concurso){
			$nombreConcurso = $this->concurso->nombre();
		}else{
			$nombreConcurso = $errores['concurso'];
		}
        $html = <<<EOF
		<h3>Concurso $nombreConcurso</h3>
		<p>Elige un premio para el concurso</p>
        <fieldset>
        <input class="control" type="hidden" name="concurso" value=$nombreConcurso contenteditable="false" />
		<p><label>Premio en €:</label> <input type="number" step="1" min="0" name="premio_dinero" />$errorPremio</p>

EOF;

		$productos = Producto::todosProductos();
		$filas = $productos->num_rows;
		  if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay productos! </p>
            EOF;
        }
        else{
            foreach($productos as $producto){
                $nombre = $producto['nombre'] ?? null;
                $product = Producto::buscaProducto($nombre);
				$path = "img/productos/".$nombre.".jpg";
				$html .= <<<EOF
				<img src=$path height="420" width="420">
				<label>Producto: $nombre </label><input class="control" type="radio" name="premio_producto" value=$nombre />
				EOF;	
                }
            }
		$html .= <<<EOF
        <button type="submit" name="crear_concurso">Aceptar</button>
        </fieldset>
EOF;
        return $html;
    }
	

    protected function procesaFormulario($datos)
    {
        $result = array();	
		$nombreConcurso = $datos['concurso'];
		$premio_dinero = $datos['premio_dinero'] ?? null;
		$premio_producto = $datos['premio_producto'] ?? null;
		if ( empty($premio_dinero) && empty($premio_producto)) {
			$result['concurso'] = $nombreConcurso;
			$result['premio'] = "Tienes que elegir un premio";
        }
        
		if (count($result) === 0) {
			$concurso = Evento:: buscaEvento($nombreConcurso,'Concurso');
			$concurso->insertaPremio($premio_dinero,$premio_producto);
			$result = 'concursos.php';
        }
        return $result;
    }
}
