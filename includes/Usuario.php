<?php
namespace es\ucm\fdi\aw;

class Usuario
{
	
	/*   ATRIBUTOS   */
	
	private $id;
    private $correo;
    private $nombre;
    private $password;
    private $rol;
	private $avatar;
	
	/*   CONSTRUCTOR   */
	
	 private function __construct($correo, $nombre, $password, $rol)
    {
        $this->correo= $correo;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function nombre(){return $this->nombre;}
	public function rol(){return $this->rol;}
	public function correo(){return $this->correo;}
	public function avatar(){return $this->avatar;}
	
	/*   SETTERS   */
	
	 public function cambiaPassword($nuevoPassword){
        $this->password = self::hashPassword($nuevoPassword);
		//self::actualiza($this);
    }
	
	public function cambiaNombre($nuevoNombre){
        $this->nombre = $nuevoNombre;
		//self::actualiza($this);
    }
	
	public function cambiaCorreo($nuevoEmail){
		$this->correo=$nuevoEmail;
	}
	
	public function cambiaAvatar(){
		$this->avatar = 1;
	}
	
	/*   FUNCIONES CRUD   */
	
	public static function crea($correo, $nombre, $password, $rol)
    {
        $user = self::buscaUsuario($correo);
        if ($user) {
            return false;
        }
        $user = new Usuario($correo, $nombre, self::hashPassword($password), $rol);
        return self::guarda($user);
    }
	
	public static function buscaUsuario($correo)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.correo = '%s'", $conn->real_escape_string($correo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['correo'], $fila['nombre'], $fila['password'], $fila['rol']);
                $user->avatar = $fila['avatar'];
				$user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
	
	public static function guarda($usuario)
    {
        if ($usuario->id !== null) {
            return self::actualiza($usuario);
        }
        return self::inserta($usuario);
    }
	
	private static function inserta($usuario)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Usuarios(correo, nombre, password, rol, avatar) VALUES('%s', '%s', '%s', '%s', %d)"
            , $conn->real_escape_string($usuario->correo)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol)
			, 0);
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
	

	public static function actualiza($usuario)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		
        $query=sprintf("UPDATE Usuarios U SET correo = '%s', nombre='%s', password='%s', avatar=%d WHERE U.id=%d"
            , $conn->real_escape_string($usuario->correo)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
	    , $usuario->avatar
            , $usuario->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
	
	//FALTA BORRAR USUARIO
	
	
	/*   FUNCIONES DE USUARIO   */
	
	 public static function login($correo, $password)
    {
        $user = self::buscaUsuario($correo);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }
	
	public static function tarjeta($correo){
        $artista = self::buscaUsuario($correo);
        if($artista instanceof bool){
            return false;
        }
        $nombre = $artista->nombre();
        $html = <<<EOF
            <h3>$nombre</h3>
            <p>$correo </p>
            EOF;
        return $html;
    }
	
	public static function datosPersonales(){
		$user = $_SESSION['user'];
		$html = <<<EOS
		<h2>Datos personales</h2>
		EOS;
		
		if($_SESSION['avatar']){
			$path = "img/avatares/".$user->id().".jpg";
			$html .= <<<EOS
				
			<img src=$path height="150" width="150">
EOS;
		}else{
			$path = "img/avatares/no_avatar.jpg";
			$html .= <<<EOS
				
			<img src=$path height="150" width="150">
EOS;
		}
		
		$html .= <<<EOS
		<h4>Nombre</h4>
		$user->nombre
		<h4>Correo</h4>
		$user->correo
		<p><a href="cambiarDatosUsuario.php">Editar datos</a></p>
		EOS;
		
		
		return $html;
	}
	
	/*   FUNCIONES AUXILIARES   */
	
	public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }
	
	private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
	
}
