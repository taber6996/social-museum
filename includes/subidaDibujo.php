<?php
namespace es\ucm\fdi\aw;

if(isset($_SESSION["user"])){
    $id_autor = $_SESSION['user']->id();
    if($id_autor){
        $tmp_name = $root_dir.'/tmp/image.png';
        $dir_subida = "img/dibujos/autor_".$id_autor."/";
        if (!file_exists($dir_subida))	//Si es la primera subida de archivo, la carpeta no esta creada todavia
            mkdir($dir_subida, 0777, true);		//Se crea la carpeta
        $dibujo = Dibujo::crea($titulo, $id_autor);
        $id_dibujo = $dibujo->id();
        if ( ! $dibujo ) {
            echo "Ya existe ese dibujo";
        }
        else{
            $fichero_subido = $dir_subida.$id_dibujo.".jpg";
            echo $tmp_name;
            if ( !copy($tmp_name, $fichero_subido) ) { // usamos copy en vez de move_uploaded_file ya que en este caso no se usa el mecanismo de subida HTTP POST de PHP
                echo 'Error al mover el archivo';
            }
        }
    }
}
else{
    echo "error no estas conectado";
}

