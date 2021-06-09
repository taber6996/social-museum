<?php
namespace es\ucm\fdi\aw;
class MostradorCorreos{
    public function __construct() {}
	
    public function muestraRecibidos($id_usuario)
	{
		$recibidos = Correo::correosRecibidos($id_usuario);
		$filas = count($recibidos);
		$html = "";
		if ($filas == 0)
		{
			$html .= <<<EOS
			<p>No tienes mensajes</p>
EOS;
		}
		else
		{
			$html .= <<<EOS
			<div id="correos">
			<table id="indice-correos">
			<caption>Mensajes: $filas</caption>
			<tr class="titulos">
			<td>Desde</td>
			<td>Asunto</td>
			<td>Fecha</td>
			</tr>
			
EOS;
			foreach($recibidos as $correo)
			{
				$html .= <<<EOS
				<tr class="mensaje">
EOS;
				$nombreDesde = Usuario::buscaUsuarioPorId($correo['id_desde'])->nombre();
				$asunto = $correo['asunto'];
				$mensaje = $correo['mensaje'];
				$fecha = $correo['fecha'];
				$id = $correo['id'];
				
				if(isset($_GET["show"]))
				{
					$show = $_GET["show"];
					
					if ($id == $show)
					{
						$html .= <<<EOS
						<p id="mensaje-abierto">$mensaje</p>
EOS;
					}
				}
				
				$html .= <<<EOS
				<td>$nombreDesde</td>
				<td><a href="buzon.php?ver=recibidos&show=$id">$asunto</a></td>
				<td>$fecha</td>
				</tr>
EOS;
			}
			$html .= <<<EOS
			</table>
			</div>
EOS;
		}
		return $html;
	}
	
	public function muestraEnviados($id_usuario)
	{
		$enviados = Correo::correosEnviados($id_usuario);
		$filas = count($enviados);
		$html = "";
		if ($filas == 0)
		{
			$html .= <<<EOS
			<p>No tienes mensajes</p>
EOS;
		}
		else
		{
			$html .= <<<EOS
			<div id="correos">
			<table id="indice-correos">
			<caption>Mensajes: $filas</caption>
			<tr class="titulos">
			<td>Para</td>
			<td>Asunto</td>
			<td>Fecha</td>
			</tr>
			
EOS;
			foreach($enviados as $correo)
			{
				$html .= <<<EOS
				<tr class="mensaje">
EOS;
				$nombreDesde = Usuario::buscaUsuarioPorId($correo['id_para'])->nombre();
				$asunto = $correo['asunto'];
				$mensaje = $correo['mensaje'];
				$fecha = $correo['fecha'];
				$id = $correo['id'];
				
				if(isset($_GET["show"]))
				{
					$show = $_GET["show"];
					
					if ($id == $show)
					{
						$html .= <<<EOS
						<p id="mensaje-abierto">$mensaje</p>
EOS;
					}
				}
				
				$html .= <<<EOS
				<td>$nombreDesde</td>
				<td><a href="buzon.php?ver=enviados&show=$id">$asunto</a></td>
				<td>$fecha</td>
				</tr>
EOS;
			}
			$html .= <<<EOS
			</table>
			</div>
EOS;
		}
		return $html;
	}
	
	public function redactar($id_usuario)
	{
		
	}
}

?>