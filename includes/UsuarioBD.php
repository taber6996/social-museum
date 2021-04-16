<?php

require_once __DIR__.'/config.php';


class Usuario
{

  public static function login($username, $password)
  {
    $user = self::buscaUsuario($username);
    if ($user && $user->compruebaPassword($password)) {
      /*$conn = getConexionBD();
      $query = sprintf("SELECT R.nombre FROM RolesUsuario RU, Roles R WHERE RU.rol = R.id AND RU.usuario=%s", $conn->real_escape_string($user->id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) { 
          $user->addRol($fila['nombre']);
        }
        $rs->free();
      }
	  Obtencion de rol mediante array. Borrar si no se va a utilizar*/
      return $user;
    }
    else{
      print "La contraseña es incorrecta.";
    }
    return false;
  }

  public static function signup($email, $username, $password, $name, $artista){
    $user = self::buscaUsuario($email);
    if(!$user){
      $conn = getConexionBD();
	  $query = sprintf("SELECT * FROM usuario");
	  $rs = $conn->query($query);
	  $id = $rs->num_rows + 1;	//Quizas es ineficiente y habria que buscar solo al ultimo ID?
	  //$id = 57;	//PRUEBA
	  
      $query = sprintf("INSERT INTO usuario (id_usuario, nick, passwd, nombre, email, es_admin, es_artista, es_premium, es_juez) VALUES ('%d', '%s', '%s', '%s', '%s', NULL, '%b', NULL, NULL);", $id, $username, $password, $name, $email, $artista);
      $rs = $conn->query($query);
      print "Usuario introducido correctamente.";
      return new Usuario($id, $username, $password, $name, $email, null, $artista, null, null);
    }
    else{
      print "Ya hay un usuario registrado con esos datos!";
      return false;
    }
    

  }


  public static function buscaUsuario($username)
  {
    $conn = getConexionBD();
    $query = sprintf("SELECT * FROM usuario WHERE email='%s'", $conn->real_escape_string($username));		//realmente se hace login con email, no username
	
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['id_usuario'], $fila['nick'], $fila['passwd'], $fila['nombre'], $fila['email'], $fila['es_admin'], $fila['es_artista'], $fila['es_premium'], $fila['es_juez']);
      $rs->free();

      return $user;
    }
    /*else{
      print "No se encontro el usuario.";
    }*/
    return false;
  }


/*public static function buscaUsuarioSignup($email){
  $conn = getConexionBD();
  $query = sprintf("SELECT * FROM usuario WHERE email='%s'", $conn->real_escape_string($email));
  $rs = $conn->query($query);
  if($rs->num_rows > 0){
    $rs->free();
    return true;
  }
  else{
    $fila = $rs->fetch_assoc();
    //$user = new Usuario($fila['id_usuario'], $fila['nombre'], $fila['passwd']);
    $rs->free();
    return false;
  }
}*/

  private $id;

  private $username;

  private $password;
  
  private $nombre;

  private $email;
  
  private $admin;
  
  private $artista;
  
  private $premium;
  
  private $juez;

  //private $roles;

  private function __construct($id, $username, $password, $nombre, $email, $admin, $artista, $premium, $juez)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->nombre = $nombre;
    $this->email = $email;
    $this->admin = $admin;
    $this->artista = $artista;
    $this->premium = $premium;
    $this->juez = $juez;
    //$this->roles = [];
  }

  public function getId()
  {
    return $this->id;
  }

  /*public function addRol($role)
  {
    $this->roles[] = $role;
  }

  public function roles()
  {
    return $this->roles;
  }*/

  public function getUsername()
  {
    return $this->username;
  }
  
  public function getNombre()
  {
    return $this->nombre;
  }
  
  public function getEmail()
  {
    return $this->email;
  }
  
  public function getArtista()
  {
	  return $this->artista;
  }
  
  public function getPremium()
  {
	  return $this->premium;
  }

  public function compruebaPassword($password)
  {
   // $comp = $password == $this->password;
    //print "$comp";
    //return password_verify($password, $this->password);
    return ($password == $this->password);
  }

  public function cambiaPassword($nuevoPassword)
  {
    $this->password = password_hash($nuevoPassword, PASSWORD_DEFAULT);
  }
}
