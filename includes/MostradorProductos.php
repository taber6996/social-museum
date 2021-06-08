<?php
namespace es\ucm\fdi\aw;

class MostradorProductos {
    public function __construct() {}

    public function muestra(){
	$productos = Producto::nombresTodosProductos();
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
                $html .= self::muestraProducto($nombre);
            }
            }
        }
	
    return $html;
    }
	
	public function muestraProducto($nombre){
		$product = Producto::buscaProducto($nombre);
        if($product instanceof bool){
            return false;
        }
        $descripcion = $product->descripcion();
        $precio = $product->precio();
        $path = "img/productos/".$nombre.".jpg";
            $html = <<<EOF
            <div class="product-info">
            <div class="product-text">
            <img src=$path height="420" width="420">
            <h1>$nombre</h1>
            <p>$descripcion </p>
            </div>
            <div class="product-price-btn">
            <p><span>$precio</span>$</p>
            <button type="button">Compra ahora!</button>
            </div>
            </div>
            EOF;
        return $html;
	}
}
?>