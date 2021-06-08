<?php
namespace es\ucm\fdi\aw;


class MostradorArtista {
    public function __construct($artist) {
		 $this->usuarioArista = Usuario::buscaUsuario($artist);
	}
	
	private $usuarioArista;
	
	public function muestraPerfil(){
		$html="";
		$html.=self::muestra_avatar();
		$nombre = $this->usuarioArista->nombre();
		$biografia = $this->usuarioArista->bio();
		$numMecenazgos = $this->usuarioArista->numMecenazgos();
		$numObras = $this->usuarioArista->numObras();
		$numExpos = $this->usuarioArista->numExpos();
		$html .= <<<EOS
		<div id="texto">
			<h2 id="nombre">$nombre</h2>
			<div id="numbers">
				<div class="val">
					<h4>Seguidores</h4><p id="numMecenazgos">$numMecenazgos</p>
				</div>
				<div class="val">
					<h4><a href="#seccionObras">Obras</a></h4>$numObras
				</div>
				<div class="val">
					<h4><a href="#seccionExpos">Expos</a></h4>$numExpos
				</div>
			</div>
			
			<div id="bio_artista">
				<p>$biografia</p>
			</div>
		</div>
EOS;
		if (isset($_SESSION["login"]) && $_SESSION["login"]) {
			$html .= <<<EOS
			<div id="botones">
EOS;
			if (isset($_SESSION["nick"]) && $_SESSION["nick"]!=$this->usuarioArista->nick()) {
				$id_a = $this->usuarioArista->id();
				$id_u = $_SESSION['user']->id();
				$nick = $this->usuarioArista->nick();
				if(!($_SESSION["user"]->esMecenas($id_a))){
					$html .= <<<EOS
				<form action="perfilArtista.php?artist=$nick" method="POST">
					<input class="control" type="hidden" name="follow" value=true contenteditable="false" />
					<button type="submit">SER MECENAS</button>
				</form>				
EOS;
				}
				else{
					$html .= <<<EOS
				<form action="perfilArtista.php?artist=$nick" method="POST">
					<input class="control" type="hidden" name="unfollow" value=true contenteditable="false" />
					<button type="submit">DEJAR DE SER MECENAS</button>
				</form>				
EOS;
				}
				if (isset($_SESSION["premium"]) && $_SESSION["premium"]) {
					$html .= <<<EOS
					<button type="button" oncli>ENVIAR MENSAJE</button>
EOS;
				}
			}
			$html .= <<<EOS
			</div>
EOS;
		}
		return $html;
	}
	
	private function muestra_avatar(){
		$html="";
		$id = $this->usuarioArista->id();
		if(($this->usuarioArista->avatar())==1){
			//$path = "img/avatares/".$user->id().".jpg";
			$path = "img/avatares/".$id.".jpg";
			$html .= <<<EOS
				
			<img id="avatar" src=$path height="150" width="150">
EOS;
		}else{
			$path = "img/avatares/no_avatar.jpg";
			$html .= <<<EOS
				
			<img id="avatar" src=$path height="150" width="150">
EOS;
		}
		return $html;
	}
	
	public function muestraObras(){
		$id_autor = $this->usuarioArista->id();
		$obras = Obra::obrasAutor($id_autor);
        $filas = $obras->num_rows;
        $html = "";
		$html .= <<<EOF
			<section id=seccionObras>
EOF;
        if($filas == 0){
            $html .= <<<EOF
                <p> ¡No hay obras! </p>
EOF;
        }
        else{
			
            foreach($obras as $obra){
                $id = $obra['id'] ?? null;
                $obra = Obra::buscaObraPorId($id);
				$numlikes = $obra->numLikes();
				$numComentarios = $obra->numComentarios();
				$id_obra = $obra->id();
				$titulo = $obra->titulo();
				$path = "img/obras/artista_".$obra->id_autor()."/".$id_obra.".jpg";
				
				$html .= <<<EOF
				<div class="obraTarjeta">
					<h3 class="titulo_oba" >$titulo</h3>
					<img id="publicacion" src=$path>
					<div class="inter">
						<p>$numlikes likes  $numComentarios comentarios</p>
							<a href="verObra.php?obra=$id_obra">Ver</a>
					</div>
				</div>
			
EOF;
                }
            }
			$html .= <<<EOF
			</section>
EOF;
            return $html;
        }
		
		public function muestraExpos(){
		$id_autor = $this->usuarioArista->id();
		$expos = Evento::exposAutor($id_autor);
        $filas = $expos->num_rows;
        $html = "";
		 $html .= <<<EOF
                <section id="seccionExpos">
EOF;
        if($filas == 0){
            $html .= <<<EOF
                <p> ¡No hay expos! </p>
EOF;
        }
        else{
			
			foreach($expos as $expo){
                $nombre = $expo['nombre'] ?? null;
                $html .= self::muestraExpo($nombre);
                }
            }
			 $html .= <<<EOF
               </section>
EOF;
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
        return $html; 
	}

}
?>