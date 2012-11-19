<?php
/**
 * Description of acciones
 *
 * @author javi
 */
class acciones {
    var $tipo;
    var $titulo;
    var $btn_nuevo;
    var $btn_edit;
    var $btn_destacado;
    var $btn_eliminar;
    var $acciones = array();

    public function __construct($titulo = "Acciones", $tipo = 'listado', $btn_nuevo = true, $btn_edit = true, $btn_destacado = false, $btn_eliminar = true) {
        $this->btn_nuevo = $btn_nuevo;
        $this->btn_edit = $btn_edit;
        $this->btn_destacado = $btn_destacado;
        $this->btn_eliminar = $btn_eliminar;
        $this->titulo = $titulo;
        $this->tipo = $tipo;
    }

    public function addAccion(accion $a){
        $this->acciones[] = $a;
    }

    public function mostrarJavascript(){
        global $app;
        $js = '
            <!-- JAVASCRIPT PARA ACCIONES -->
            <link rel="stylesheet" type="text/css" media="screen" href="'.$app->ruta_include.'/acciones/acciones.css" />
            <script type="text/javascript" src="'.$app->ruta_include.'/acciones/acciones.js"></script>
            <script type="text/javascript">';

        $i = 1;
        foreach ($this->acciones as $a) {
            $js .= $a->mostrarJavascript().' // codigo para '.$a->nombre;
            $i++;
        }

        $js .='</script>
            <!-- FIN JAVASCRIPT ACCIONES -->';

        return $js;
    }

    public function mostrarHtml(){
        global $app;
        include ($app->ruta_absoluta.'/includes/acciones/acciones.php');
    }
}

class accion {
    var $nombre;
    var $mensaje;
    var $evento; //href | onclick | etc. . .
    var $accion; // valor del evento
    var $evento_inical; //href | onclick | etc. . .
    var $accion_inicial; // valor del evento inicial
    var $condicion;
    var $icono;
    var $slot; //Lugar donde estara el boton de la accion izq, drcha. . .
    var $orden; //posición que ocupara dentro de su slot
    var $permitidos;
    //ej: '<a '.$this->evento.'="'.$this->accion.'">'.$this->nombre.'<span class="'.$this->icono.'"></span></a>
    
    public function  __construct($nombre = 'Nuevo', $mensaje = '', $icono = 'ui-icon-document', $slot='izq', $orden=1 ) {
        $this->nombre = $nombre;
        $this->mensaje = $mensaje;
        $this->icono = $icono;
        $this->slot = $slot;
        $this->orden = $orden;

        //Colocamos en un array los valores permitidos para el tipo de evento
        $this->permitidos = array('href','onClick','onDblClick');
    }

    public function addAccionPrincipal($tipo,$accion){
        //Añadimos la accion principal a la accion


        //comprobamos que el evento esta en el listado
        if (in_array($tipo, $this->permitidos)){
            $this->evento = $tipo;
            $this->accion = $accion;
            return 1;
        }
        else{
            return 0;
        }
        
    }

    public function addAccionInicial($condicion,$tipo,$accion){
        //comprobamos que el evento esta en el listado
        if (in_array($tipo, $this->permitidos)){
            $this->evento_inicial = $tipo;
            $this->accion_inicial = $accion;
            $this->condicion  = $condicion;
            return 1;
        }
        else{
            return 0;
        }
    }

    public function mostrarJavascript(){
        //Devuelve el javascript necesarió para efectuar la acción.
        $boton = "
                $('boton_".$this->nombre."').button({
                    icons: {
                        primary: '".$this->icono."'
                    }
                });
                ";

        $accion = "";

        if($this->condicion != ''){
            $accion = "
            $('boton_".$this->nombre."').live('mouseover',function(){
                if('boton_".$this->condicion."'){
                    $('".$this->nombre."').removeAttr('".$this->evento_inical."').attr('".$this->evento."','".$this->accion."');
                } else {
                    $('boton_".$this->nombre."').removeAttr('".$this->evento."').attr('".$this->evento_inicial."','".$this->accion_inicial."');
                }
            });

                      ";            
        }
        else{
            $accion = "
            $('boton_".$this->nombre."').live('mouseover',function(){
                $('".$this->nombre."').attr('".$this->evento."','".$this->accion."');
            });

                      ";
        }

        return $boton.$accion;
    }

    public function mostrarHtml(){
        $boton = '
             <a class="'.$this->slot.'" id="boton_'.$this->nombre.'" >'.ucfirst($this->nombre).'</a>
                 ';
    }
}


?>
