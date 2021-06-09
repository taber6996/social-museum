<?php
namespace es\ucm\fdi\aw;

class Correo
{
	
	/*   ATRIBUTOS   */
	
	private $id_desde;
	private $id_para;
	private $asunto;
	private $mensaje;
	
	/*   CONSTRUCTOR   */
	
	private function __construct($id_desde, $id_para, $asunto, $mensaje)
    {
        $this->id_desde= $id_desde;
		$this->id_para=$id_para;
        $this->asunto = $asunto;
		$this->mensaje = $mensaje;
    }
	
	/*   GETTERS   */
	
	public function id_desde(){return $this->id_desde;}
	public function id_para(){return $this->id_para;}
	public function asunto(){return $this->asunto;}
	public function mensaje(){return $this->mensaje;}
	
	/*   SETTERS   */
	
	/* FUNCIONES CRUD   */
	
	public static function crea($id_desde, $id_para, $asunto, $mensaje)
    {
        $correo = new Correo($id_desde, $id_para, $asunto, $mensaje);
        return self::inserta($correo);
    }
    
    private static function inserta($correo)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Buzon(id_desde, id_para, asunto, mensaje) VALUES(%d, %d, '%s', '%s')"
			, $correo->id_desde
            , $correo->id_para
			, $conn->real_escape_string($correo->asunto)
			, $conn->real_escape_string($correo->mensaje));
		$conn->query($query);
        return $correo;
    }

	/* Buscadores en BBDD */
	public static function correosRecibidos($id_user)
	{
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Buzon WHERE id_para = '$id_user' ORDER BY fecha");
        $rs = $conn->query($query);
		if ($rs)
		{
			$recibidos = $rs->fetch_all(MYSQLI_ASSOC);
			$rs->free();
		}
		else
		{
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
		return $recibidos;
	}
	
	public static function correosEnviados($id_user)
	{
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Buzon WHERE id_desde = '$id_user' ORDER BY fecha");
        $rs = $conn->query($query);
		if ($rs)
		{
			$enviados = $rs->fetch_all(MYSQLI_ASSOC);
			$rs->free();
		}
		else
		{
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
		return $enviados;
	}
    
}