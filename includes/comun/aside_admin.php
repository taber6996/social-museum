<?php
	if (!isset($menuSGeneral, $menuSProducto, $menuSEvento, $menuSSugerencias))
	{
		$menuSGeneral = "";
		$menuSProducto = "";
		$menuSEvento = "";
		$menuSSugerencias = "";
	}
?>
<aside>
	<nav id="menu-secundario">
		<a href="general_admin.php" class = <?= $menuSGeneral ?> >General</a>
		<a href="subir_producto.php" class = <?= $menuSProducto ?> >Subir producto</a>
		<a href="crear_evento.php" class = <?= $menuSEvento ?> >Crear evento</a>
		<a href="sugerencias.php" class = <?= $menuSSugerencias ?> >Sugerencias</a>
		<a href="logout.php">Log Out</a>
	</ul>
	</nav>	
</aside>
