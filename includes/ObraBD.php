<?php

require_once __DIR__.'/config.php';


class Obra
{

  public static function insertarObra($titulo, $autor, $descripcion, $img){
      $conn = getConexionBD();
      $query = sprintf("INSERT INTO obra (id_obra, titulo, id_autor, descripcion, likes, id_exposicion, img) VALUES (NULL, '%s', '%s', '%s', 0, NULL, '%s');", $titulo, $autor, $descripcion, $img);
      $rs = $conn->query($query);
      print "Obra subida correctamente.";
      return true;
    }
	
	public static function obtenerNumObras($autor)
	{
		$conn = getConexionBD();
		$query = sprintf("SELECT * FROM obra WHERE id_autor='%s'", $conn->real_escape_string($autor));
		$rs = $conn->query($query);
		
		$numObras = $rs->num_rows;
		$rs->free();
		return $numObras;
	}
	
	public static function obtenerObras($autor)
	{
		$conn = getConexionBD();
		$query = sprintf("SELECT * FROM obra WHERE id_autor='%s'", $conn->real_escape_string($autor));
		$rs = $conn->query($query);
		if ($rs && $rs->num_rows > 0) {
			for($i = 0; $i < $rs->num_rows; $i++)
			{
				$fila = $rs->fetch_assoc();
				$obras[$i] = new Obra($fila['id_obra'], $fila['id_autor'], $fila['titulo'], $fila['descripcion'], $fila['img']);
			}
			$rs->free();
		}
		return $obras;
	}
	
  private $id;

  private $autor;

  private $titulo;

  private $descripcion;
  
  private $img;

  private function __construct($id, $autor, $titulo, $descripcion, $img)
  {
    $this->id = $id;
    $this->autor = $autor;
    $this->titulo = $titulo;
    $this->descripcion = $descripcion;
	$this->img = $img;
  }

  public function id()
  {
    return $this->id;
  }

  public function autor()
  {
    return $this->autor;
  }

  public function getTitulo()
  {
    return $this->titulo;
  }
  
   public function getDescripcion()
  {
    return $this->descripcion;
  }
  
  public function getImg()
  {
	  return $this->img;
  }
}
