<?php
namespace es\ucm\fdi\aw;

class Puja
{
	/*   ATRIBUTOS   */
	
	private $id;
    private $id_obra;
    private $precio_inicial;
    private $precio_actual;
    private $id_comprador_actual;
    private $fecha_finalizacion;
	
	/*   CONSTRUCTOR   */
	
	public function __construct($id_obra = NULL, $precio_inicial = NULL, $precio_actual = NULL,$fecha_finalizacion = NULL, $id_comprador_actual = NULL)
    {
        $this->id_obra= $id_obra;
		$this->precio_inicial = $precio_inicial;
		$this->precio_actual = $precio_actual;
        $this->fecha_finalizacion = $fecha_finalizacion;
        $this->$id_comprador_actual = $id_comprador_actual;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function id_obra(){return $this->id_obra;}
	public function precio_inicial(){return $this->precio_inicial;}
	public function precio_actual(){return $this->precio_actual;}
	public function id_comprador_actual(){return $this->id_comprador_actual;}
    public function fecha_finalizacion(){return $this->fecha_finalizacion;}
	
	/*   SETTERS   */
	
	/*   FUNCIONE CRUD   */
	
	public static function crea($id_obra, $precio_inicial, $fecha_finalizacion)
    {
        $puja = self::buscaPuja($id_obra);
        if ($puja) {
            return false;
        }
        $puja = new Puja($id_obra, $precio_inicial, $precio_inicial, $fecha_finalizacion, NULL);
        return self::guarda($puja);
    }

    public static function buscaPuja($id_obra)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Pujas P WHERE P.id_obra = %d",$id_obra,$id_autor);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $puja = new Puja($fila['id_obra'], $fila['fecha_finalizacion'], $fila['precio_inicial'], $fila['precio_actual'], $fila['id_comprador_actual']);
                //$puja->precio_actual = $fila['precio_actual'];
				//$puja->id_comprador_actual = $fila['id_comprador_actual'];
                $puja->id = $fila['id'];
                $result = $puja;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function buscaPujaPorId($id)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Pujas P WHERE P.id = %d",$id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $puja = new Puja($fila['id_obra'], $fila['fecha_finalizacion'], $fila['precio_inicial'], $fila['precio_actual'], $fila['id_comprador_actual']);
                //$puja->precio_actual = $fila['precio_actual'];
				//$puja->id_comprador_actual = $fila['id_comprador_actual'];
                $puja->id = $fila['id'];
                $result = $puja;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function muestraSubastas(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Pujas");
        $rs = $conn->query($query);
        $result = [];
        if($rs){
            while($fila = $rs->fetch_assoc()){
                $result[] = new Puja($fila['id_obra'], $fila['fecha_finalizacion'], $fila['precio_inicial'], $fila['precio_actual'], $fila['id_comprador_actual']);
                echo $result;
            }
            $rs->free();
        }
        else{
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }

        return $result;
    }
    
    public static function guarda($puja)
    {
        if ($puja->id !== null) {
            return self::actualiza($puja);
        }
        return self::inserta($puja);
    }
    
    private static function inserta($puja)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Pujas(id_obra, fecha_finalizacion, precio_inicial, precio_actual) VALUES(%d, '%s', %d, %d)"
            , $puja->id_obra
            , $puja->fecha_finalizacion
			, $puja->precio_inicial
			, $puja->precio_actual);
        if ( $conn->query($query) ) {
            $puja->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $puja;
    }
    
    private static function actualiza($id, $precio_actual, $id_comprador_actual)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $result = array();
        $query=sprintf("UPDATE Pujas P SET precio_actual = %d, id_comprador_actual=%d WHERE O.id=%i"
            , $conn->real_escape_string($precio_actual)
            , $conn->real_escape_string($id_comprador_actual)
            , $id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                $result[] = "No se ha podido actualizar la puja: " . $puja->id;
                exit();
            }
            else{
                $result[] = "Puja realizada con exito";
            }
        } else {
            $result[] = "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $result;
    }

    public static function tarjeta($id_obra){
        
        if($puja instanceof bool){
            return false;
        }
        $puja = self::buscaPuja($id_obra);
        $obra = Obra::buscaObraPorId($id_obra);
        $autor = Usuario::buscaUsuarioPorId($obra->id_autor());
        $fecha_parse = new \DateTime();

        $titulo = $obra->titulo();
        $descripcion = $obra->descripcion();
        $autorObra = $autor->nombre();
        $fecha_finalizacion = $puja->fecha_finalizacion();
        $puja_inicial = $puja->precio_inicial();
        $puja_actual = $puja->precio_actual();
        
						
        $fecha_limite_aux = $fecha_parse->createFromFormat("U", $fecha_finalizacion);
        //printr($fecha_limite_aux );
        $fecha_limite = $fecha_limite_aux->format("Y-m-d H:i:s");
        $path = "img/obras/artista_".$obra->id_autor()."/".$titulo.".jpg";
       
        $html = <<<EOF
        <div class="product-info">
        <div class="product-text">
        <img src=$path height="420" width="420">
        <h1>$titulo</h1>
        <p>$descripcion </p>
        <p>Autor: $autorObra </p>
        <p>Fecha finalizacion: $fecha_limite </p>
        </div>
        <div class="product-price-btn">
        <p><span>Puja actual: $puja_actual</span>$</p>
        <p><span>Puja actual: $puja_inicial</span>$</p>
        <button type="button">pujar</button>
        </div>
        </div>
        EOF;
        return $html;
        
        
    }
    
}

