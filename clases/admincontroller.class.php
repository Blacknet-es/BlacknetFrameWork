<?php
class adminController extends controller
{
    private $actions;
    private $jqgrid;
    private $config;
    private $menu;
    
    public function __construct()
    {
        parent::__construct();
        //Load menu
        $this->menu = new menu();
        
        //Load Admin Component Configurations
        $this->loadConfig();

        //Load User
        $usuario = new usuario();
        
        //Set actions and jqgrid options
        if (isset ($this->config[$this->app->seccion]['actions'])) {
            $this->actions = $this->config[$this->app->seccion]['actions'];
        }
        $this->jqgrid = $this->config[$this->app->seccion]['jqgrid'];
    }
    public function indexAction()
    {
        $this->app->renderAdminAction($this->app->seccion);
    }
    
    public function addAction()
    {
    
    }
    
    public function editAction($id)
    {
    
    }
    
    public function deleteAction($id)
    {
    
    }
    
    private function loadConfig()
    {
        $ruta = $this->app->ruta_absoluta . '/componentes/';
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
}
