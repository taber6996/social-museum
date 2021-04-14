<?php 
	session_start();
?>

<header>
	<!-- Indice de vinculos -->
		<nav class="navigation">
			<ul>
				<li><a href="index.php">Index</a></li>
				<li><a href="bocetos.php">Bocetos</a></li>
				<li><a href="contacto.php">Contacto</a></li>
				<li><a href="detalles.php">Detalles</a></li>
				<li><a href="miembros.php">Miembros</a></li>
				<li><a href="planificacion.php">Planificacion</a></li>
				<?php 
					if(isset($_SESSION['login'])){
						print "<li><a href='logout.php'>Log out</a></li>";
					}
					else{
						print "<li><a href='login.php'>Log in</a></li>";
						print "<li><a href='signup.php'>Sign up</a></li>";
					}
				?>
			</ul> 
	
		</nav>
		<h1>Social Museum</h1>
</header>