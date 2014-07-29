<?php
/*
 * Clase genérica del controlador principal.
 * Se define la clase controlador y sus funciones generales.
 * 
 */

class controller
{
    private $component;
    protected $app;
    
    public function __construct($component = null)
    {
        global $app;
        $this->app = &$app;
        
        if ($component === null) {
            $this->component = $app->seccion;
        } else{
            $this->component = $component;
        }
    }
    
    /* funciones generales de la clase controlador */
    public function addModel($name, $component = null)
    {
        if ($component != null) {            
            $fich = $this->app->ruta_absoluta.'/componentes/'.$component.'/clases/'.$name.'.class.php';
        } else {
            $fich = $this->app->ruta_absoluta.'/componentes/'.$this->app->seccion.'/clases/'.$name.'.class.php';
        }
        
        if (!include_once($fich)) {
            $this->app->debug_error[] = 'Controller: El fichero "'.$fich.'" no existe;';
        }
    }
    
    public function addWidget ($widget)
    {
        if ($widget) {
            $this->app->includeFile('classes/widget', $widget.'.class.php');
        }
    }
    
    public function render($file, $data = null)
    {              
        include($this->app->ruta_absoluta.'/componentes/'.$this->component.'/views/'.$file);
    }
    
    public function renderWithLayout($file, $data = null)
    {
        $this->app->data = $data;
        $this->app->view = $this->app->ruta_absoluta.'/componentes/'.$this->app->seccion.'/views/'.$file;
        
        include ($this->app->ruta_absoluta.'/plantillas/'.$this->app->plantilla.'/index.php');
    }
    
    public function renderHeader()
    {
        include($this->app->ruta_absoluta.'/componentes/'.$this->component.'/views/header.php');
    }
    
    public function renderAdmin($file, $data = null)
    {
        include($this->app->ruta_absoluta.'/componentes/'.$this->component.'/admin/views/'.$file);
    }
    
    public function renderAdminWithLayout($file, $data = null)
    {
        global $menu;
        
        $ruta = $this->app->ruta_absoluta.'/componentes/'.$app->seccion.'/admin/views/'.$file;
        $rutaGeneral = $this->app->ruta_absoluta.'/admin/generalviews/'.$file;
        $this->app->data = $data;
        
        if (file_exists($ruta)) {
            $this->app->view = $this->app->ruta_absoluta.'/componentes/'.$this->app->seccion.'/admin/views/'.$file;
        } else {
            $this->app->view = $rutaGeneral;
        }
        
        include ($this->app->ruta_absoluta.'/admin/plantillas/admin/index.php');
    }
    
    public function renderAdminHeader()
    {
        include($this->app->ruta_absoluta.'/componentes/'.$this->component.'/admin/views/header.php');
    }
}

