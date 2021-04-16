<?php
require_once __DIR__.'/includes/UsuarioBD.php';
require_once __DIR__.'/includes/ObraBD.php';

if(!isset($_SESSION)){
	session_start();
}

$obras = Obra::obtenerObras($_SESSION['user']->getId());
	for ($i = 0; $i < Obra::obtenerNumObras($_SESSION['user']->getId()); $i++)
	{
		$dirObras[$i] = "img/obras"."/".$_SESSION["user"]->getEmail()."/".$obras[$i]->getImg().".jpg";
	}
$tituloPagina = 'Social Museum';
if(isset($obras)){
$contenidoPrincipal=<<<EOS
		<p>Aqui se muestran las obras ya subidas por el artista.</p>
		<img src="<?php echo $dirObras[0]; ?>" width='300px' height='300px'>
		<p>{$obras[0]->getTitulo()}</p>
		<p><?= echo $obras[0]->getDescripcion(); ?></p>
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
EOS;}
else{
	$contenidoPrincipal=<<<EOS
		<p>no hay obras que mostrar.</p>
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
	EOS;
}
		require __DIR__.'/includes/comun/layout.php';	

	
	


	