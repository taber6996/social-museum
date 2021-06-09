<?php
	if (!isset($menuSGeneral, $menuSMecenazgos, $menuSEntradas, $menuSCanvas, $menuSMisObras, $menuSCompras, $menuSBuzon))
	{
		$menuSGeneral = "";
		$menuSMecenazgos = "";
		$menuSEntradas = "";
		$menuSCanvas = "";
		$menuSMisObras = "";
		$menuSCompras = "";
		$menuSBuzon = "";
	}
?>
<aside>
	<nav id="menu-secundario">
		<a href="general_artist.php" class = <?= $menuSGeneral ?> >General</a>
		<a href="mecenazgos.php" class = <?= $menuSMecenazgos ?> >Mecenazgos</a>
		<a href="entradas.php" class = <?= $menuSEntradas ?> >Entradas</a>
		<a href="canvas.php" class = <?= $menuSCanvas ?> >Canvas</a>
		<a href="mis_obras.php" class = <?= $menuSMisObras ?> >Mis obras</a>
		<a href="compras.php" class = <?= $menuSCompras ?> >Compras</a>
		<a href="buzon.php" class = <?= $menuSBuzon ?> >Buzón</a>
		<a href="logout.php">Log Out</a>
	</ul>
	</nav>	
</aside>
