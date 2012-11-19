<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

class menu{
    var $secciones = array();

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

    function mostrarJavascript(){
        global $app;
       
        $js = '
        <script type="text/javascript" language="javascript">
        //<![CDATA[
         $(function(){
        // BUTTONS
        $("#menu .fg-button").hover(function(){
            $(this).removeClass("ui-state-default").addClass("ui-state-focus");
        }, function(){
            $(this).removeClass("ui-state-focus").addClass("ui-state-default");
        });
        ';
        
         foreach ($this->secciones as $seccion){
              if(count($seccion->subsecciones) > 0){
                $js.= '
                $("#'.$seccion->seccion.'").menu({
                content: $("#'.$seccion->seccion.'").next().html(), // grab content from this page
                showSpeed: 400
                });';
            }
            else{
                $js .=  '$("#'.$seccion->seccion.'").button({ icons: { primary: "'.$seccion->icono.'"}});';
            }
        }

        $js .='
        });
        //]]>
        </script>
        ';

    
        return $js;
    }

    function mostrarHtml(){
        global $app;

        $html = '<table><tr>';
        
        $secciones = usort($this->secciones,array('seccion','comparar'));

         foreach ($this->secciones as $seccion){
              if(count($seccion->subsecciones) > 0){
                    $html .= '<td> <a tabindex="0" href="#'.$seccion->seccion.'" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="'.$seccion->seccion.'"><span class="ui-icon ui-icon-triangle-1-s">&nbsp;</span>'.$seccion->titulo.'</a>
            <div class="fg-menu-container ui-widget ui-widget-content ui-corner-all
            hidden">
            <ul class="fg-menu ui-corner-all">';
                    foreach ($seccion->subsecciones as $subseccion){
                        $html .= '
                     <li>
                        <a  href="'.$app->ruta_admin.'?seccion='.$subseccion->seccion.'">'.$subseccion->titulo.'</a>
                    </li>';
                    }

                    $html .= '</ul></div></td>';
            }
            else{
                $html .= '
        <td>
            <a id="'.$seccion->seccion.'"  href="'.$app->ruta_admin.'?seccion='.$seccion->seccion.'" class="boton ui-widget ui-state-default ui-corner-all">'.$seccion->titulo.'</a>
        </td>';
            }
         }  




    $html .='</tr></table>';

        return $html;
    }

    function cargarMenu() {
        global $app;
        $ruta = $app->ruta_absoluta . '/componentes/';
        if (is_dir($ruta)) {
            if ($dh = opendir($ruta)) {
                while (($file = readdir($dh)) !== false) {
                    if (is_dir($ruta . $file) && $file != "." && $file != "..") {
                        if (file_exists($ruta . $file . '/admin/config.php')) {

                            include_once($ruta . $file . '/admin/config.php');
                        }
                    }
                }//solo si el archivo es un directorio, distinto que "." y ".."
            }
        }
        closedir($dh);
    }

    static function comparar($a, $b){
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

class seccion{
    var $titulo;
    var $seccion;
    var $atributos;
    var $icono;
    var $orden;
    var $subsecciones = array();

    function  __construct($titulo, $seccion,$icono = 'ui-icon-document',$orden = 2, $atributos = '') {
        $this->titulo = $titulo;
        $this->seccion = $seccion;
        $this->icono = $icono;
        $this->atributos = $atributos;
        $this->orden = $orden;
    }

    function addSubseccion(subseccion $c){
        $this->subsecciones[] = $c;
    }

    static  function comparar($a, $b){
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

class subseccion{
    var $titulo;
    var $seccion;
    var $icono;
    var $orden;
    var $atributos;

     function  __construct($titulo, $seccion,$icono = 'ui-icon-document',$orden = 2, $atributos = '') {
        $this->titulo = $titulo;
        $this->seccion = $seccion;
        $this->icono = $icono;
        $this->orden = $orden;
        $this->atributos = $atributos;
    }

    static function comparar($a, $b){
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