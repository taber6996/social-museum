<header>
	<div id ="logo">
		<a href="index.php"> 
			<!-- <img src="img/logo.jpg" > -->
			<img id= "logoSVG" src="img/logo.svg" alt="Social Museum Logo" />
		</a>
	</div>
	<?php
	if (!isset($menuArtistas, $menuExpos, $menuTienda, $menuEventos, $menuCuenta))
	{
		$menuArtistas = "";
		$menuExpos = "";
		$menuTienda = "";
		$menuEventos = "";
		$menuCuenta = "";
	}
	?>
	<nav id="menu-principal">
		<!-- <li> <img src="img/busca.jpg" width="15px" height="15px"> </li> --> 
		<a href="artistas.php" class = <?= $menuArtistas ?> >Artistas</a>
		<a href="expos.php?momento=presente" class = <?= $menuExpos ?> >Expos</a>
		<a href="tienda.php" class = <?= $menuTienda ?> >Tienda</a>
		<a href="canvas.php">Dibujar</a>
		<a href="subastas.php">Subastas</a>
		<a href="eventos.php?tipo=expo" class = <?= $menuEventos ?> >Eventos</a>
		<?php if(isset($_SESSION['login']) && $_SESSION['login']) : ?>
			<a href="cuenta.php" class = <?= $menuCuenta ?> >Cuenta</a>
		<?php else : ?>
			<a href="login.php"> Log In </a>
			<a href="signup.php"> Sign Up </a>
		<?php endif; ?>
		<!-- <li> | <img src="img/spanish.jpg" width="15px" height="15px"> </li> -->
	</nav>	
</header>
