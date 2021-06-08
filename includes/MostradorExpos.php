<?php
namespace es\ucm\fdi\aw;
class MostradorExpos{
    public function __construct() {}
    public function muestra(){
        $moment = false;
        if(isset($_GET["momento"])){
            $moment = $_GET["momento"];
        }
	   $expos = Evento::exposPorFecha($moment);
        $filas = $expos->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay exposiciones! </p>
            EOF;
        }
        else{
            foreach($expos as $expo){
                $nombre = $expo['nombre'] ?? null;
                $html .= self::muestraExpo($nombre);
                }
            }
            return $html;
        }
		
	public function muestraExpo($nombre){
		$evento = Evento::buscaEvento($nombre, 'Expo');
        if($evento instanceof bool){
            return false;
        }
        $descripcion = $evento->descripcion();
        $fechaI = $evento->fecha_ini();
        $fechaF = $evento->fecha_fin();
        $precio = $evento->precio();
        $html = "";
        if($fechaF < date('Y-m-d') && $fechaI < date('Y-m-d')){
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
            </div>
            </div>
            EOF;
        }
        else {
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
        }
            
        return $html; 
	}
}



?>