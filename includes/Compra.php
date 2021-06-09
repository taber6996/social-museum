<?php
namespace es\ucm\fdi\aw;

class Compra
{

	/*   ATRIBUTOS   */
	
	private $id;
    private $idArticulo;
    private $idUsuario;
    
    
	
	/*   CONSTRUCTOR   */
	
	private function __construct($idA, $idU)
    {
        $this->idArticulo = $idA;
		$this->idUsuario = $idU;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function idArticulo(){return $this->idArticulo;}
	public function idUsuario(){return $this->idUsuario;}
	
	/*   FUNCIONES CRUD   */
	
	public static function crea($idA,  $idU)
    {
        /*$dibujo = self::buscaDibujo($titulo,$id_autor);
        if ($dibujo) {
            return false;
        }*/
        $compra = new Compra($idA,  $idU);
        return self::guarda($compra);
    }
	
    public static function buscaDibujo($idA, $idU)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Compras O WHERE O.id_articulo = '%s' AND O.id_usuario = %d",$conn->real_escape_string($idA),$idU);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $compra = new Compra($fila['id_articulo'], $fila['id_usuario']);
                
                $compra->id = $fila['id'];
                $result = $compra;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
	
	 public static function buscaCompraPorId($id)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Compra O WHERE O.id = %d",$id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $compra = new Compra($fila['id_articulo'], $fila['id_usuario']);
                
                $dibujo->id = $fila['id'];
                $result = $compra;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function guarda($compra)
    {
        if ($compra->id !== null) {
            return self::actualiza($compra);
        }
        return self::inserta($compra);
    }
    
    private static function inserta($compra)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Compras(id_articulo, id_usuario) VALUES('%s', %d)"
            , $conn->real_escape_string($compra->idArticulo)
			, $compra->idUsuario);
        if ( $conn->query($query) ) {
            $compra->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $compra;
    }
    
/*   private static function actualiza($dibujo)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Dibujos O SET titulo = '%s', id_autor=%d WHERE O.id=%i"
            , $conn->real_escape_string($dibujo->titulo)
            , $dibujo->id_autor
            , $dibujo->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar la obra: " . $dibujo->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $dibujo;
    }
*/	
/*	public static function tarjeta($id){
		$dibujo = self::buscaDibujoPorId($id);
		$id_dibujo = $dibujo->id();
		$titulo = $dibujo->titulo();
		$path = "img/dibujos/usuario_".$dibujo->id_autor()."/".$id_dibujo.".jpg";
		
		if($obra instanceof bool){
			return false;
		}
		
        $html = <<<EOF
            <h2>$titulo</h2>
            <img id="publicacion" src=$path>
EOF;
        return $html;
	}
*/	
	public static function comprasUsuario($id_usuario){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT id FROM Compras WHERE id_usuario = %d", $id_usuario);
        $rs = $conn->prepare($query);
        $rs->execute();
        $compras = $rs->get_result();
		return $compras;
	}
}
