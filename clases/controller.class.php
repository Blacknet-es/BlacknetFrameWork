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
    
    public function render($file)
    {              
        include($this->app->ruta_absoluta.'/componentes/'.$this->component.'/views/'.$file);
    }
    
    public function renderWithLayout($file)
    {
        $this->app->view = $this->app->ruta_absoluta.'/componentes/'.$this->app->seccion.'/views/'.$file;
        
        include ($this->app->ruta_absoluta.'/plantillas/'.$this->app->plantilla.'/index.php');
    }
    
    public function renderHeader()
    {
        include($this->app->ruta_absoluta.'/componentes/'.$this->component.'/views/header.php');
    }
    
    public function renderAdmin($file)
    {
        $general = $rutaGeneral = $this->app->ruta_absoluta.'/admin/generalviews/'.$file;
        $ruta = $this->app->ruta_absoluta.'/componentes/'.$this->component.'/admin/views/'.$file;
        
        if (file_exists($ruta)) {
            include($ruta);
        } else {
            include($general);
        }
        
    }
    
    public function renderAdminWithLayout($file = null)
    {
        if (!$file) {
            $file = $this->app->accion.'.php';
        }
        
        $ruta = $this->app->ruta_absoluta.'/componentes/'.$this->app->seccion.'/admin/views/'.$file;
        $rutaGeneral = $this->app->ruta_absoluta.'/admin/generalviews/'.$file;
        
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
    
    public function addData($name, $data)
    {
        $this->app->data[$name] = $data;
        return $this;
    }
    
    public function addJs ($file)
    {
        $this->app->js[] = $file;
        return $this;
    }
    
    public function addCss ($file)
    {
        $this->app->css[] = $file;
        return $this;
    }
}

