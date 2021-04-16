<?php
require_once __DIR__.'/includes/UsuarioBD.php';
require_once __DIR__.'/includes/ObraBD.php';

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
		require('header_cuenta.php');
		require('aside_artista.php');
	?>
	
		<p>Aqui se muestran las obras ya subidas por el artista.</p>
		<?php
			$obras = Obra::obtenerObras($_SESSION['user']->getId());
			for ($i = 0; $i < Obra::obtenerNumObras($_SESSION['user']->getId()); $i++)
			{
				$dirObras[$i] = "img/obras"."/".$_SESSION["user"]->getEmail()."/".$obras[$i]->getImg().".jpg";
			}
		?>
		
		<img src="<?php echo $dirObras[0]; ?>" width='300px' height='300px'>
		<p><?php echo $obras[0]->getTitulo(); ?></p>
		<p><?php echo $obras[0]->getDescripcion(); ?></p>
		
		<form action="procesarObra.php" method="POST" enctype="multipart/form-data">
			<fieldset>
			<legend> Subir nueva obra </legend>
			<div><label>Titulo</label>
			<input type="text" name="titulo" /></div>
			<div><label>Descripcion</label>
			<textarea name="descripcion" rows=4 cols=50>Escribe una descripcion de tu obra</textarea></div>
			
			 <p><label for="archivo">Archivo:</label><input type="file" name="archivo" id="archivo" /></p>
	
			<button type="submit">Subir</button>
			</fieldset>
		
		</form>
	</main>
	
	<footer>
		
	</footer>

</body>
</html>