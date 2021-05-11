<?php
namespace es\ucm\fdi\aw;

class MostradorProductos {
    public function __construct() {}

    public function muestra(){
    $app = Aplicacion::getInstance();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT nombre FROM productos P");
    $rs = $conn->prepare($query);
    $rs->execute();
    $productos = $rs->get_result();
    $filas = $productos->num_rows;
    $html = "";
    if($filas == 0){
        $html = <<<EOF
            <p> ¡No hay productos en la tienda! </p>
        EOF;
    }
    else{
        foreach($productos as $producto){
            $nombre = $producto['nombre'] ?? null;
            if(!empty($nombre)){
                $html .= Producto::tarjeta($nombre);
            }
            }
        }
        return $html;
    }

}
?>