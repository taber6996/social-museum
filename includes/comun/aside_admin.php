<?php
	if (!isset($menuSGeneral, $menuSCanvas, $menuSProducto, $menuSEvento, $menuSSugerencias))
	{
		$menuSGeneral = "";
		$menuSCanvas = "";
		$menuSProducto = "";
		$menuSEvento = "";
		$menuSSugerencias = "";
	}
?>
<aside>
	<nav id="menu-secundario">
		<a href="general_admin.php" class = <?= $menuSGeneral ?> >General</a>
		<a href="canvas.php" class = <?= $menuSCanvas ?> >Canvas</a>
		<a href="subir_producto.php" class = <?= $menuSProducto ?> >Subir producto</a>
		<a href="crear_evento.php" class = <?= $menuSEvento ?> >Crear evento</a>
		<a href="sugerencias.php" class = <?= $menuSSugerencias ?> >Sugerencias</a>
		<a href="logout.php">Log Out</a>
	</ul>
	</nav>	
</aside>
