<?php
namespace es\ucm\fdi\aw;

class GestionMezenazgo extends Form
{
    public function __construct($artist_nick) {
        parent::__construct('formMecenazgo');
		$this->artist = Usuario::buscaUsuario($artist_nick);
    }
	
	private $artist;
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$htmlErroresGlobales = self::generaListaErroresGlobales($errores);
		$errorSinObras = self::createMensajeError($errores, 'num', 'span', array('class' => 'error'));
		if($this->artist){
			//$nick = $this->artist_nick->nombre();
		}else{
			$nick = $errores['artist_nick'];
		}
		
		if(){
			$html .= <<<EOS
					<input class="control" type="hidden" name="follow" value=true contenteditable="false" />
					<input class="control" type="hidden" name="artist_nick" value=$nick contenteditable="false" />
					<button type="submit">SER MECENAS</button>
							
EOS;
		}else{
			
		}
		
		
		
        $html = <<<EOF
		<h3>Expo $nombreExpo</h3>
		<p>Añade las obras que quieras en la expo</p>
		$errorSinObras
        <fieldset>
        <input class="control" type="hidden" name="expo" value=$nombreExpo contenteditable="false" />

EOF;

		$obras = Obra::todasObras();
		$filas = $obras->num_rows;
		  if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay obras! </p>
            EOF;
        }
        else{
            foreach($obras as $obra){
                $id = $obra['id'] ?? null;
                $obra = Obra::tarjeta($id);
				$html .= <<<EOF
				$obra
				<label>ID: $id </label><input class="control" type="checkbox" name=$id />
				EOF;	
                }
            }
		$html .= <<<EOF
        <button type="submit" name="crear_expo">Aceptar</button>
        </fieldset>
EOF;
        return $html;
    }
	

    protected function procesaFormulario($datos)
    {
        $result = array();
        if (count($result) === 0) {
			$obras = Obra::todasObras();
			$filas = $obras->num_rows;
			if($filas == 0){
				$html = <<<EOF
				<p> ¡No hay obras! </p>
EOF;
			}
			else{
				$nombreExpo = $datos['expo'];
				$expo = Evento:: buscaEvento($nombreExpo,'Expo');
				$contador = 0;
				foreach($obras as $obra){
					$id_obra = $obra['id'] ?? null;
					$o = isset($datos[$id_obra]) ? $datos[$id_obra] : null ;
					if($o){	
						$expo->insertaObra($id_obra);	
					}	
                }
				if($contador >0){
					$result = 'expos.php';
				}
				else{
					$result['expo'] = $nombreExpo;
					$result['num'] = "Tienes que añadir por lo menos una obra a la exposición."; 
				}
				
            }
        }
        return $result;
    }
}


if(isset($_POST["follow"]) && $_POST["follow"]){
	$user = $_SESSION["user"];
	$nick = $_POST["artist_nick"];
	$artist = Usuario::buscaUsuario($nick);
	$user->serMecenas($artist);
	header("Location: perfilArtista.php?artist=$nick");
}

if(isset($_POST["unfollow"]) && $_POST["unfollow"]){
	$user = $_SESSION["user"];
	$artist = $_POST["artist"];
	$user->dejarDeSerMecenas($artist);
	$nick = $artist->nick();
	header("Location: perfilArtista.php?artist=$nick");
}







