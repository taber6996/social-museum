<?php
namespace es\ucm\fdi\aw;

class MostradorDibujos {
    public function __construct() {}

    public function muestra(){
	$dibujos = Dibujo::todosDibujos();
	$filas = $dibujos->num_rows;
    $html = "";
    if($filas == 0){
        $html = <<<EOF
            <p> ¡No hay dibujos en la web! </p>
        EOF;
    }
    else{
        foreach($dibujos as $dibujo){
            $id = $dibujo['id'] ?? null;
            if(!empty($id)){
                $html .= self::muestraDibujoPorID($id);
            }
            }
        }
	
    return $html;
    }
	
    public function muestraMisDibujos($user){
        $dibujos = Dibujo::dibujosAutor($user);
        $filas = $dibujos->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay compras! </p>
            EOF;
        }
        else{
            foreach($dibujos as $dibujo){
                $id = $dibujo['id'] ?? null;
                $html .= self::muestraDibujoPorID($id);
                }
            }
            return $html;
	}

    public function muestraDibujoPorID($id){
        $dibujo = Dibujo::buscaDibujoPorId($id);
        if($dibujo instanceof bool){
            return false;
        }
        $titulo = $dibujo->titulo();
       
        $path = "img/dibujos/autor_".$dibujo->id_autor()."/".$dibujo->id().".jpg";
            $html = <<<EOF
            <div class="product-text">
            <img src=$path height="420" width="420">
            <h1>$titulo</h1>
            </div>
            
EOF;

        return $html;
    }

}
?>