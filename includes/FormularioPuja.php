<?php
namespace es\ucm\fdi\aw;

class FormularioPuja extends Form
{
    public function __construct() {
        parent::__construct('formPuja');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $puja_actual =$datos['precio_actual'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
       

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <fieldset>
            $htmlErroresGlobales
            <p><label>Puja:</label> <input type="number" name="puja" value="$puja_actual"/></p>
            <button type="submit" name="pujar">Pujar</button>
        </fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $puja_a_formalizar =$datos['puja'] ?? null;
        $id_puja = $datos['id_puja']; 
        $id_comprador_actual = $SESSION["user"]->id();    
        if ( empty($puja_a_formalizar) ) {
            $result['puja'] = "Tienes que pujar";
        }
        
        if (count($result) === 0) {
            $puja = Puja::buscaPujaPorId($id_puja);
            if ( ! $puja ) {
                // No se da pistas a un posible atacante
                $result[] = "Esa puja no existe";
            } else {
                if($puja_a_formalizar > $puja->precio_actual()){
                    $result[] = actualiza($id_puja, $puja_a_formalizar, $id_comprador_actual);
                }
                else{
                    $result[] = "La puja tiene que ser mayor al valor actual";
                }
            }
        }
        return $result;
    }
}