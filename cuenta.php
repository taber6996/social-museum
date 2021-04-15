<?php
require_once __DIR__.'/includes/UsuarioBD.php';
	if(!isset($_SESSION)){
		session_start();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Social Museum</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
</head>

<body>

	<?php
	require('header.php');
	require('aside.php');
	?>
	
	<main>
	 
	 <?php
	 //$_SESSION["login"] = false; //para pruebas
	 //$_SESSION["esArtista"] = true;//para pruebas
	 //$_SESSION["nombre"] = "Isabel"; //para pruebas
	 //$_SESSION["rol"] = "Artista"; //para pruebas
	 //echo $_SESSION['user']->getNombre();
	 
	 if(isset($_SESSION["login"]) && ($_SESSION["login"]==true)){
		 require('header_cuenta.php');
		 
		 if($_SESSION['user']->getArtista()){
			 require('aside_artista.php');
		 }
		 else
			 require('aside_usuario.php');
		 
	 }
	 else{
		 //mandar al usuario a abrir sesion
		 header("Location: login.php");
	 }
	 
	 
	 
	 /*
	 $login=true; //PARA PRUEBAS -- QUITAR
	 $es_artista=true;
	 $es_admin=false;
			if($login==true){
				if($es_admin==true){} //admin
				
				
				
				else if($es_artista){ //artista
				
				require('header_cuenta.php');
				require('aside_artista.php');
				
					
					
				}
				
				
				else{ //regular user
					echo "<section id='info usuario'> <img src='img/user.jpg' width='50px' height='50px'> Nombre Usuario - Tipo usuario </section>"; //aqui hay que obtener foto, nombre y rol de la base de datos
					echo '<nav id="Menu Usuario">';
					echo '<ul id="lista2">';
						echo '<li> <a href="general.php">General</a></li>';
						echo '<li> <a href="subscrpciones.php">Subscripciones</a></li>';
						echo '<li> <a href="entradas.php">Entradas</a></li>';
						echo '<li> <a href="estudio.php">Mi estudio</a></li>';
						echo '<li> <a href="compras.php">Compras</a></li>';
						echo '<li> <a href="buzon.php">Buzón</a></li>';
						echo '<li> <a href="logout.php">Cerrar sesión</a></li>';
					echo '</ul>';
					echo '</nav>';		
				}
			
					
			}
			else{
				header("Location: login.php");
			}*/
	?>
	</main>
	
	<footer>
		
	</footer>

</body>
</html>