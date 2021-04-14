
 <!DOCTYPE html>
 <html lang="es">
 <head>
	 <meta charset="UTF-8">
	 <title>Contacto</title>
	 <link rel="stylesheet" href="css/practica1.css">
 </head>
 <body>
	<!-- Indice de vinculos -->
    <?php
            
            require('comun/includes/cabecera.php');
    ?>
	
	<!-- Area de formulario de contacto -->
	<form action="mailto:infoSocialMuseum@gmail.com" method="post">
		Escribe tu nombre:
		<input type="text" name="nombre" value="" placeholder="Ej: Juan" />
		<br/>
		
		Escribe tu email:
		<input type="email" name="email" value="" placeholder="Ej: juan@correo.com" />
		<br/>
		
		Motivo de la consulta:
		<br/>
		<input type="radio" name="motivo" value="evaluacion" checked /> Evaluación
		<input type="radio" name="motivo" value="sugerencias" /> Sugerencias
		<input type="radio" name="motivo" value="criticas" /> Críticas
		<br/>
		
		Marque esta casilla para aceptar nuestros términos y condiciones: 
		<input type="checkbox" name="terminos" value="terminos" checked />
		<br/>
		<br/>
		
		Escriba su consulta:
		<br/>
		<textarea name="consulta" rows="4" cols="50"></textarea>
		<br/>
		
		<input type="submit" value="Enviar" />
	</form>
 
 </body>
 </html> 
 