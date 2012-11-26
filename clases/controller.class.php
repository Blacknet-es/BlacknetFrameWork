<?php
/*
 * Clase genérica del controlador principal.
 * Se define la clase controlador y sus funciones generales.
 * 
 */

class controller{
    var $component;
    
    public function __construct($component = null) {
        global $app;
        
        if ($component === null){
            $this->component = $app->seccion;
        }
        else{
            $this->component = $component;
        }
        
        
    }
    
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
    
    public function render($file, $data = null){
        global $app;        
              
        include($app->ruta_absoluta.'/componentes/'.$this->component.'/views/'.$file);
    }
    
    public function renderWithLayout($file, $data = null){
        global $app;
        $app->data = $data;
        $app->view = $app->ruta_absoluta.'/componentes/'.$app->seccion.'/views/'.$file;
        
        include ($app->ruta_absoluta.'/plantillas/'.$app->plantilla.'/index.php');
    }
    
    public function renderHeader(){
        global $app;
        include($app->ruta_absoluta.'/componentes/'.$this->component.'/views/header.php');
    }
}

?>
