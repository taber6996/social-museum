<?php
namespace es\ucm\fdi\aw;

class MostradorProductos {
    public function __construct() {}

    public function muestra(){
    $html = Producto::muestraTodos();
    return $html;
    }
}
?>