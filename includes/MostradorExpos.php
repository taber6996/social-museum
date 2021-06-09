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
		$id = $evento->id();
            $html = <<<EOF
            <div class="product-info">
            <div class="product-text">
            <h1>$nombre</h1>
            <p>$descripcion </p>
            </div>
           
EOF;
			if(isset($_GET["momento"]) && $_GET["momento"] == "presente"){
				 $html .= <<<EOF
				 <p>Fecha fin: $fechaF </p>
				 <a href="visitaExpo.php?expo=$id">Visitar</a>
            </div>
EOF;
			}
			if(isset($_GET["momento"]) && $_GET["momento"] == "futuras"){
				 $html .= <<<EOF
				 <p>Fecha inicio: $fechaI </p>
EOF;
				if ((isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]) || (isset($_SESSION["esArtist"]) && $_SESSION["esArtist"]) || isset($_SESSION["premium"]) && $_SESSION["premium"]) {
					$html .= <<<EOF
					<a href="visitaExpo.php?expo=$id">Visitar</a>
					</div>
					</div>
EOF;
				}
				
				else{
				
				$user = $_SESSION['user'];
				if($user->tieneEntrada($id)){
					$html .= <<<EOF
					<p>¡Ya tienes entrada! Pronto podrás visitar la expo.</p>
					</div>
					</div>
EOF;
	
				}else{
				$html .= <<<EOF
				 <a href="compraEntrada.php?expo=$id">¡Compra tu entrada ahora!</a>
				</div>
				</div>
EOF;
				}
			}

			}
			
			
			
			
            
        return $html; 
	}
	
	public function muestraInfoExpo($id_expo){
		$evento = Evento:: buscaEventoPorId($id_expo);
		$nombre_expo = $evento->nombre();
		$descripcion = $evento->descripcion();
        $fechaI = $evento->fecha_ini();
        $fechaF = $evento->fecha_fin();
        $precio = $evento->precio();
            $html = <<<EOF
            <div class="product-info">
            <div class="product-text">
            <h1>$nombre_expo</h1>
            <p>$descripcion </p>
			<p>Fecha inicio: $fechaI </p>
			<p>Fecha fin: $fechaF </p>
			<p>$precio $</p>
            </div>
EOF;
		return $html;
	}
	
	
	
}



?>