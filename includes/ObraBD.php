<?php

require_once __DIR__.'/config.php';


class Obra
{

  public static function insertarObra($titulo, $descripcion){
      $conn = getConexionBD();
      $query = sprintf("INSERT INTO obra (id_obra, titulo, id_autor, descripcion, likes, id_exposicion) VALUES (NULL, '%s', NULL, '%s', 0, NULL);", $titulo, $descripcion);
      $rs = $conn->query($query);
      print "Obra subida correctamente.";
      return true;
    }
	
  private $id;

  private $autor;

  private $titulo;

  private $descripcion;

  private function __construct($id, $autor, $titulo, $descripcion)
  {
    $this->id = $id;
    $this->username = $autor;
    $this->password = $titulo;
    $this->descripcion = $descripcion;
  }

  public function id()
  {
    return $this->id;
  }

  public function autor()
  {
    return $this->autor;
  }

  public function titulo()
  {
    return $this->titulo;
  }
  
   public function descripcion()
  {
    return $this->descripcion;
  }
}
