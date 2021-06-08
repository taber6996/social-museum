<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';

global $EXTENSIONES_PERMITIDAS;
//$file =fopen("datavalues.txt", "w");
$data = $_POST['content'];
//fwrite($file, $_SESSION['user']->id());
$titulo = $_POST["titulo"];
$data_string = str_replace("data:image/png;base64,", "", $data);
//fwrite($file, $data_string);
$data = base64_decode($data_string);
//fwrite($file, $data);
//fclose($file);
$root_dir = str_replace("/htdocs", "", $_SERVER['DOCUMENT_ROOT']);
file_put_contents($root_dir.'/tmp/image.png', $data);
/*$prueba="";
$file =fopen("postvalues.txt", "w");
foreach($_POST as $campo => $valor){
	$prueba=$prueba. "- ". $campo ." = ". $valor."\n";
  }
fwrite($file, $prueba);
fclose($file);*/
require __DIR__.'/includes/subidaDibujo.php';