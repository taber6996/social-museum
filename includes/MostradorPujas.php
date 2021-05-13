<?php
namespace es\ucm\fdi\aw;

class MostradorPujas {
    public function __construct() {}

    public function muestra(){
    $app = Aplicacion::getInstance();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT id_obra FROM pujas P");
    $rs = $conn->prepare($query);
    $rs->execute();
    $pujas = $rs->get_result();
    
    $filas = $pujas->num_rows;
    $html = "";
    if($filas == 0){
        $html = <<<EOF
            <p> ¡No hay subastas activas! </p>
        EOF;
    }
    else{
        foreach($pujas as $puja){
            $id_obra = $puja["id_obra"] ?? null;
            if(!empty($id_obra)){
                $html .= Puja::tarjeta($id_obra);
            }
            }
        }
        return $html;
    }

}
?>