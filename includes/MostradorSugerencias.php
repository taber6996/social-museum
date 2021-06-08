<?php
namespace es\ucm\fdi\aw;

class MostradorSugerencias {
    public function __construct() {}

    public function muestra(){
	$sugerencias = Sugerencia:: todasSugerencias();
	$filas = $sugerencias->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay sugerencias! </p>
            EOF;
        }
        else{
            foreach($sugerencias as $sugerencia){
                $id = $sugerencia['id'] ?? null;
                if(!empty($id)){
					$instancia = Sugerencia:: buscaPorId($id);
                    $html .= self::muestraSugerencia($instancia);
                }
                }
            }
    return $html;
    }
	
	public function muestraSugerencia($instancia){
		$correo = $instancia->correo();
            $nombre = $instancia->nombre();
            $tipo = $instancia->tipo();
            $id = $instancia->id();
            $contenido = $instancia->contenido();
                $html = <<<EOF
                <div class="sugerencia">
                <div class="sugerencia-izq">
                <h6>$tipo</h6>
                <h2>$nombre</h2>
                <a href="https://www.gmail.com">$correo</a>
                </div>
                <div class="sugerencia-der">
                <h6>ID: #$id</h6>
                <p>$contenido</p>
                </div>
                </div>

                EOF;
            return $html;
	}
}
?>