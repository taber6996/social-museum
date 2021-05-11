<?php
namespace es\ucm\fdi\aw;
class MostradorArtistas{
    public function __construct() {}
    public function muestra(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT correo FROM usuarios WHERE rol = 'artist'");
        $rs = $conn->prepare($query);
        $rs->execute();
        $artistas = $rs->get_result();
        $filas = $artistas->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay artistas! </p>
            EOF;
        }
        else{
            foreach($artistas as $artista){
                $correo = $artista['correo'] ?? null;
                    $html .= Usuario::tarjeta($correo);
                }
            }
            return $html;
        }
}



?>