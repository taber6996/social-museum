<?php
namespace es\ucm\fdi\aw;


class MostradorExpo {
    public function __construct($id_expo) {
		
		 $this->expo = Evento::buscaEventoPorId($id_expo);
	}
	
	private $expo;
	
	public function muestraExpo(){
		
		$html="";
		
		$html.=<<<EOS
	
		<div class="slideshow">
		
			<div class="slides">
EOS;
			$obras = Evento:: obrasExpo($this->expo->id());
			foreach($obras as $obra){
				$id = $obra['id_obra'] ?? null;
                $obra = Obra::buscaObraPorId($id);
				$id_obra = $obra->id();
				$titulo = $obra->titulo();
				$path = "img/obras/artista_".$obra->id_autor()."/".$id_obra.".jpg";
				$html.=<<<EOS
			<img id="publicacion" src=$path>
EOS;
			}
			$html.=<<<EOS
			
			</div>
		
		</div>
		
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="js/jquery.slides.js"></script>
		
		<script>
		$(function(){
  $(".slides").slidesjs({
    play: {
      active: true,
        // [boolean] Generate the play and stop buttons.
        // You cannot use your own buttons. Sorry.
      effect: "slide",
        // [string] Can be either "slide" or "fade".
      interval: 5000,
        // [number] Time spent on each slide in milliseconds.
      auto: true,
        // [boolean] Start playing the slideshow on load.
      swap: true,
        // [boolean] show/hide stop and play buttons
      pauseOnHover: false,
        // [boolean] pause a playing slideshow on hover
      restartDelay: 2500
        // [number] restart delay on inactive slideshow
    }
  });
});
		</script>
		
EOS;
		
       return $html; 
	}

}
?>