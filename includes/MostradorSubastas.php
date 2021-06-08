<?php
namespace es\ucm\fdi\aw;
class MostradorSubastas{
    public function __construct() {}
    public function muestra(){
	   $pujas = Puja::todasPujas();
        $filas = $pujas->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay subastas! </p>
            EOF;
        }
        else{
            foreach($pujas as $puja){
                $id_obra = $puja['id_obra'] ?? null;
                $puja = self::muestraPuja($id_obra);;
					
					$html .= <<<EOF
					<div class="puja">
						$puja;
						<button type="button">pujar</button>
						</div>
EOF;
					
					
                }
            }
            return $html;
        }
		
	public function muestraPuja($id_obra){
		$puja = Puja::buscaPuja($id_obra);
		$obra = Obra::buscaObraPorId($id_obra);
		$id = $obra->id();
		$titulo = $obra->titulo();
		$path = "img/obras/artista_".$obra->id_autor()."/".$id.".jpg";
		$autor = Usuario::buscaUsuarioPorId($obra->id_autor());
		$autorObra = $autor->nombre();
        $fecha_limite = $puja->fecha_finalizacion();
		$puja_inicial = $puja->precio_inicial();
        $puja_actual = $puja->precio_actual();
		
		$comprador = $puja->id_comprador_actual();
		
		
        if($puja instanceof bool){
            return false;
        }
        
        $html = <<<EOF
		<h2>$titulo</h2>
		<img src=$path height="420" width="420">
		<p>Autor: $autorObra </p>
		<p>Fecha finalizacion: $fecha_limite </p>
		<div class="product-price-btn">
		<p><span>Precio inicial: $puja_actual</span>$</p>
		<p><span>Puja actual: $puja_inicial</span>$</p>
		<p><span>Comprador: $comprador</span></p>
		</div>
EOF;
        return $html;
	}
}

?>