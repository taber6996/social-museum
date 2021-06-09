<?php
namespace es\ucm\fdi\aw;

class FormularioExpo extends Form
{
    public function __construct($nombreExpo) {
        parent::__construct('formExpo');
		$this->expo = Evento::buscaEvento($nombreExpo,'Expo');
    }
	
	private $expo;
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$htmlErroresGlobales = self::generaListaErroresGlobales($errores);
		$errorSinObras = self::createMensajeError($errores, 'num', 'span', array('class' => 'error'));
		if($this->expo){
			$nombreExpo = $this->expo->nombre();
		}else{
			$nombreExpo = $errores['expo'];
		}
        $html = <<<EOF
		<h3>Expo $nombreExpo</h3>
		<p>Añade las obras que quieras en la expo</p>
		$errorSinObras
        
        <input class="control" type="hidden" name="expo" value=$nombreExpo contenteditable="false" />

EOF;

		$obras = Obra::todasObras();
		$filas = $obras->num_rows;
		  if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay obras! </p>
            EOF;
        }
        else{
			$html .= <<<EOF
			<div class="obrasSelection">
			
				<div class="o">
EOF;
			
            foreach($obras as $obra){
                $id = $obra['id'] ?? null;
                $obra = self::muestraObra($id);
				$html .= <<<EOF
				$obra
				<label></label><input class="control" type="checkbox" name=$id />
				</div>
EOF;			

                }
				$html .= <<<EOF
				</div>
				</div>
EOF;
            }
		$html .= <<<EOF
        <button type="submit" name="crear_expo">Aceptar</button>
        
EOF;
        return $html;
    }
	
	private function muestraObra($id){
		$obra = Obra::buscaObraPorId($id);
		$titulo = $obra->titulo();
		$id_obra = $obra->id();
		$path = "img/obras/artista_".$obra->id_autor()."/".$id_obra.".jpg"; 
		
		$html = <<<EOF
			<div class="opcion">
				$titulo
				<img class="obra" src=$path>
				
EOF;
		return $html;
	}
	

    protected function procesaFormulario($datos)
    {
        $result = array();
        if (count($result) === 0) {
			$obras = Obra::todasObras();
			$filas = $obras->num_rows;
			if($filas == 0){
				$html = <<<EOF
				<p> ¡No hay obras! </p>
EOF;
			}
			else{
				$nombreExpo = $datos['expo'];
				$expo = Evento:: buscaEvento($nombreExpo,'Expo');
				$contador = 0;
				foreach($obras as $obra){
					$id_obra = $obra['id'] ?? null;
					$o = isset($datos[$id_obra]) ? $datos[$id_obra] : null ;
					if($o){	
						$expo->insertaObra($id_obra);	
					}	
                }
				if($contador >0){
					$result = 'expos.php';
				}
				else{
					$result['expo'] = $nombreExpo;
					$result['num'] = "Tienes que añadir por lo menos una obra a la exposición."; 
				}
				
            }
        }
        return $result;
    }
}
