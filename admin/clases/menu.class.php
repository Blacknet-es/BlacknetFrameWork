<?php
class menu
{
    var $secciones = array();
    
    public function __construct()
    {
        $this->cargarMenu();
    }

    function addSeccion(seccion $c){
         
        $flag = false;
        foreach ($this->secciones as $seccion) {
            if($seccion->seccion == $c->seccion){
                $flag = true;
            }
        }
        if (!$flag){
             $this->secciones[] = $c;
        }
       
    }

    
    function mostrarHtml() {
        global $app;

        $html = '';
        
        $secciones = usort($this->secciones, array('seccion','comparar'));

         foreach ($this->secciones as $seccion) {
              if(count($seccion->subsecciones) > 0) {
                    $html .= '<li><a href="#'.$seccion->seccion.'" id="'.$seccion->seccion.'">'.ucfirst($seccion->titulo).'</a>            
                    <ul class="">';
                    foreach ($seccion->subsecciones as $subseccion){
                        $html .= '
                    <li>
                        <a  href="'.$app->ruta_admin.'?seccion='.$subseccion->seccion.'">'.ucfirst($subseccion->titulo).'</a>
                    </li>';
                    }

                    $html .= '</ul></li>';
            } else {
                $html .= '
        <li>
            <a id="'.$seccion->seccion.'"  href="'.$app->ruta_admin.'?seccion='.$seccion->seccion.'" class="">'.ucfirst($seccion->titulo).'</a>
        </li>';
            }
         }  


        return $html;
    }

    function cargarMenu()
    {
        global $app;
    }

    static function comparar($a, $b)
    {
        if ($a->orden == $b->orden) {
            return 0;
        } else if ($a->orden > $b->orden) {
            return -1;
        } else{
            return 1;
        }
    }
    
}

class seccion 
{
    var $titulo;
    var $seccion;
    var $atributos;
    var $icono;
    var $orden;
    var $subsecciones = array();

    function  __construct($titulo, $seccion,$icono = 'icon-th-list',$orden = 2, $atributos = '')
    {
        $this->titulo = $titulo;
        $this->seccion = $seccion;
        $this->icono = $icono;
        $this->atributos = $atributos;
        $this->orden = $orden;
    }

    function addSubseccion(subseccion $c)
    {
        $this->subsecciones[] = $c;
    }

    static  function comparar($a, $b)
    {
        if ($a->orden == $b->orden){
            //echo " $a->orden es igual a $b->orden :: ";
            return 0;
        }
        else if ($a->orden < $b->orden){
            //echo "mayor";
            return -1;
        }
        else{
            //echo "menor";
            return 1;
        }
    }
}

class subseccion 
{
    var $titulo;
    var $seccion;
    var $icono;
    var $orden;
    var $atributos;

     function  __construct($titulo, $seccion,$icono = 'ui-icon-document',$orden = 2, $atributos = '')
     {
        $this->titulo = $titulo;
        $this->seccion = $seccion;
        $this->icono = $icono;
        $this->orden = $orden;
        $this->atributos = $atributos;
    }

    static function comparar($a, $b)
    {
        if ($a->orden == $b->orden){
            return 0;
        }
        else if ($a->orden > $b->orden){
            return -1;
        }
        else{
            return 1;
        }
    }
}
