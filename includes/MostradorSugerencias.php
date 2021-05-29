<?php
namespace es\ucm\fdi\aw;

class MostradorSugerencias {
    public function __construct() {}

    public function muestra(){
    $html = Sugerencia::muestraTodos();
    return $html;
    }
}
?>