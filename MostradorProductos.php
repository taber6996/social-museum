<?php
namespace es\ucm\fdi\aw;

class MostradorProductos {
    public function __construct() {}

    public function muestra(){
	$productos = Producto::todosProductos();
	$filas = $productos->num_rows;
    $html = "";
    if($filas == 0){
        $html = <<<EOF
            <p> ¡No hay productos en la tienda! </p>
        EOF;
    }
    else{
        foreach($productos as $producto){
            $id = $producto['id'] ?? null;
            if(!empty($id)){
                $html .= self::muestraProductoPorID($id);
            }
            }
        }
	
    return $html;
    }
	
    public function muestraMisCompras($user){
        $compras = Usuario::misCompras($user);
        $filas = $compras->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay compras! </p>
            EOF;
        }
        else{
            foreach($compras as $compra){
                $id = $compra['id_articulo'] ?? null;
                $html .= self::muestraProductoPorIDsinOpcionACompra($id);
                }
            }
            return $html;
	}

    public function muestraProductoPorID($id){
        $product = Producto::buscaProductoID($id);
        if($product instanceof bool){
            return false;
        }
        $descripcion = $product->descripcion();
        $precio = $product->precio();
        $nombre = $product->nombre();
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
            
EOF;
			if (isset($_SESSION["login"]) && $_SESSION["login"]) {
				$html .= <<<EOF
				<form action="compras.php?producto=$id" method="POST">
            <input class="control" type="hidden" name="compra" value=true contenteditable="false" />
				<button type="submit">Compra ahora!</button>
				</form>
EOF;
			}	
            $html .= <<<EOF
            </div>
            </div>
            EOF;
        return $html;
    }

    public function muestraProductoPorIDsinOpcionACompra($id){
        $product = Producto::buscaProductoID($id);
        if($product instanceof bool){
            return false;
        }
        $descripcion = $product->descripcion();
        $precio = $product->precio();
        $nombre = $product->nombre();
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
            </div>
            </div>
            EOF;
        return $html;
    }

    //Esta funcion no se usa, puede sernos util en el futuro
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