<?php
namespace es\ucm\fdi\aw;
class MostradorConcursos{
    public function __construct() {}
    public function muestra(){
		$eventos = Evento::nombresEventos();
        $filas = $eventos->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay eventos! </p>
            EOF;
        }
        else{
            foreach($eventos as $evento){
                $nombre = $evento['nombre'] ?? null;
                $html .= self::muestraConcurso($nombre, 'Concurso');
                }
            }
            return $html;
        }
		
	public function muestraConcurso($nombre){
		$evento = Evento::buscaEvento($nombre, 'Concurso');
        if($evento instanceof bool){
            return false;
        }
        $descripcion = $evento->descripcion();
        $fechaI = $evento->fecha_ini();
        $fechaF = $evento->fecha_fin();
        $precio = $evento->precio();
            $html = <<<EOF
            <div class="product-info">
            <div class="product-text">
            <h1>$nombre</h1>
            <p>$descripcion </p>
            <p>Fecha inicio: $fechaI </p>
            <p>Fecha fin: $fechaF </p>
            </div>
            <div class="product-price-btn">
            <p><span>$precio</span>$</p>
            <button type="button">¡Compra tu entrada ahora!</button>
            </div>
            </div>
            EOF;
        return $html; 
	}
}

?>