<?php
namespace es\ucm\fdi\aw;

class Producto
{

    public static function buscaProducto($nombre)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		//$query = sprintf("SELECT * FROM Productos P WHERE P.nombre = '%s',$conn->real_escape_string($nombre));
		$query = sprintf("SELECT * FROM Productos P WHERE P.nombre = '%s'", $conn->real_escape_string($nombre));

        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
				$producto = new Producto($fila['nombre'], $fila['descripcion'], $fila['precio'], $fila['unidades']);
                $producto->id = $fila['id'];
                $result = $producto;
            }
            $rs->free();

        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function crea($nombre, $descripcion, $precio, $unidades)
    {
        $producto = self::buscaProducto($nombre);
        if ($producto) {
            return false;
        }
        $producto = new Producto($nombre, $descripcion, $precio, $unidades);
        return self::guarda($producto);
    }
    
   
    
    public static function guarda($producto)
    {
        if ($producto->id !== null) {
            return self::actualiza($producto);
        }
        return self::inserta($producto);
    }
    
    private static function inserta($producto)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Productos(nombre, descripcion, precio, unidades) VALUES('%s', '%s', %d, %d)"
            , $conn->real_escape_string($producto->nombre)
            , $conn->real_escape_string($producto->descripcion)
			, $conn->real_escape_string($producto->precio)
			, $conn->real_escape_string($producto->unidades));
        if ( $conn->query($query) ) {
            $producto->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $producto;
    }
    
    private static function actualiza($producto)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Productos P SET nombre = '%s', descripcion='%s', precio=%d, unidades=%d WHERE P.id=%i"
            , $conn->real_escape_string($producto->nombre)
            , $conn->real_escape_string($producto->descripcion)
            , $conn->real_escape_string($producto->precio)
			, $conn->real_escape_string($producto->unidades)
            , $producto->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el producto: " . $producto->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $producto;
    }

    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
	private $unidades;

    private function __construct($nombre, $descripcion, $precio, $unidades)
    {
        $this->nombre= $nombre;
        $this->descripcion = $descripcion;
		$this->precio = $precio;
		$this->unidades = $unidades;
    }

    public function id()
    {
        return $this->id;
    }
	
	public function precio()
    {
        return $this->precio;
    }

    public function nombre()
    {
        return $this->nombre;
    }

    public function descripcion()
    {
        return $this->descripcion;
    }
	
	 public function unidades()
    {
        return $this->unidades;
    }
	
	public static function nombresTodosProductos(){
		$query = sprintf("SELECT nombre FROM Productos P");
		$productos = self:: consulta($query);
		return $productos;
	}
	
	public static function todosProductos(){
		$query = sprintf("SELECT * FROM Productos WHERE unidades > 0");
		$productos = self:: consulta($query);
		return $productos;
	}
	
	private static function consulta($query){
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $rs = $conn->prepare($query);
        $rs->execute();
		return $rs->get_result();
	}

}
