<?php
namespace es\ucm\fdi\aw;
require_once 'config.php';

if(isset($_SESSION['login'])){
   
    $puja = Puja::buscaPujaPorId($id_puja);
    if($puja){
        if ( empty($valor_puja)) {
            echo $valor_puja."-Prueba a introducir un valor.";
        }
        else{
            if($valor_puja > $puja->precio_actual()){
                $puja->actualiza_campos($valor_puja, $_SESSION['user']->id());
                Puja::guarda($puja);
                header("Location: subastas.php") ;
            }
            else{
                echo "La puja debe ser mayor al precio actual: ". $puja->precio_actual();
            }
        }
    }
    else{
        echo $id_puja."-puja no encontrada" ;
    }
}
else{
    echo "tienes que hacer log in";
}


 
	
	