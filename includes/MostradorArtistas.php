<?php
namespace es\ucm\fdi\aw;
class MostradorArtistas{
    public function __construct() {}
    public function muestra(){
		$artistas = Usuario::todosArtistas();
        $filas = $artistas->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay artistas! </p>
            EOF;
        }
        else{
            foreach($artistas as $artista){
                $nick = $artista['nick'] ?? null;
                $artista = self::muestraArtista($nick);
					
                $html .= <<<EOF
                <a href="perfilArtista.php?artist=$nick">$artista</a>
             EOF;	
                }
            }
            return $html;
        }
		
	public function muestraArtista($nick){
		$artista = Usuario::buscaUsuario($nick);
        if($artista instanceof bool){
            return false;
        }
		$path = "img/avatares/".$artista->id().".jpg";
        $html = "";
        if(!file_exists($path)){
            $path = "img/avatares/no_avatar.jpg";
        }

        $nombre = $artista->nombre();
        $html = "";
        $html .= <<<EOF
            <img id="avatar" src=$path>
            <h3>$nombre</h3>
            <p>@$nick </p>
            EOF;
        return $html;
	}
	
	public function muestraMisArtistas($user){
		$artistas = Usuario::misArtistas($user);
        $filas = $artistas->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay artistas! </p>
            EOF;
        }
        else{
            foreach($artistas as $artista){
                $nick = $artista['nick'] ?? null;
                $artista = self::muestraArtista($nick);
					
                $html .= <<<EOF
                <a href="perfilArtista.php?artist=$nick">$artista</a>
             EOF;	
                }
            }
            return $html;
	}
}

?>