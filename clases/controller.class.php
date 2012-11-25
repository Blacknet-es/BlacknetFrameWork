<?php
/*
 * Clase genérica del controlador principal.
 * Se define la clase controlador y sus funciones generales.
 * 
 */

class controller{
    
    
    /* funciones generales de la clase controlador */
    public function addModel($name,$component = null){
        global $app;
        if ($component != null){
            
            $fich = $app->ruta_absoluta.'/componentes/'.$component.'/clases/'.$name.'.class.php';
        }
        else{
            $fich = $app->ruta_absoluta.'/componentes/'.$app->seccion.'/clases/'.$name.'.class.php';
        }
        
        if(!include_once($fich)){
            $app->debug_error[] = 'Controller: El fichero "'.$fich.'" no existe;';
        }
    }
    
    public function render($file){
        global $app;        
              
        $app->view->renderAction($this->seccion,$file);
    }
}

?>
