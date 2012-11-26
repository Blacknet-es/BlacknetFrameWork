<?php

/**
 * Description of app class
 * Esta clase define las variables iniciales con las que trabajara el sistema
 * Tambien las funciones básicas del controlador principal
 *
 * @author difusiongrafica
 */
class app {
    /* Variables de ruta */

    var $ruta_base;
    var $ruta_absoluta;
    var $ruta_admin;
    var $ruta_absoluta_admin;
    var $ruta_img;
    var $ruta_plantilla;
    var $ruta_include;
    var $ruta_componentes;
    /* variables de control */
    var $seccion;
    var $accion;
    var $id;
    /* Datos de la aplicacion */
    var $nombre_app;
    var $metades;
    var $metatags;
    var $default_lan;
    var $plantilla;
    /* Base de datos */
    var $db_host;
    var $db_name;
    var $db_user;
    var $db_pass;
    /* MVC */
    var $data;
    var $view;
    var $controller;
    /* DEBUG */
    var $debug_mode;
    var $debug_info = array();
    var $debug_error = array();

    public function __construct($nombre_app, $metades, $metatags, $default_lan, $plantilla, $db_host, $db_name, $db_user, $db_pass, $carpeta) {
        $this->nombre_app = $nombre_app;
        $this->metades = $metades;
        $this->metatags = $metatags;
        if ($default_lan != '') {
            $this->default_lan = $default_lan;
        } else {
            $this->default_lan = 'es'; //Utilizar siempre codigo ISO
        }
        $this->plantilla = $plantilla;

        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;

        $this->ruta_absoluta = dirname(__FILE__); //ruta absoluta del sitio
        $this->ruta_base = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . '://' . $_SERVER['SERVER_NAME'] . $carpeta; //direccion base CAMBIAR SOLO SI LA WEB NO ESTA EN LA CARPETA RAIZ

        $this->ruta_admin = $this->ruta_base . '/admin';
        $this->ruta_absoluta_admin = $this->ruta_absoluta . '/admin';

        $this->ruta_img = $this->ruta_base . '/img';
        $this->ruta_include = $this->ruta_base . '/includes';
        $this->ruta_componentes = $this->ruta_base . '/componentes';

        $this->ruta_plantilla = $this->ruta_base . '/plantillas/' . $this->plantilla;

        if (isset($_GET['seccion'])) {
            $this->seccion = $_GET['seccion'];
        } else {
            $this->seccion = 'inicio';
        }

        if (isset($_GET['accion'])) {
            $this->accion = $_GET['accion'];
        } else {
            $this->accion = 'index';
        }

        if (isset($_GET['id'])) {
            $this->id = $_GET['id'];
        } else {
            $this->id = '0';
        }

        //Inclusión de clases generales
        /* Cargamos la clase para generar consultas MySQL */
        $this->includeFile('/clases/', 'mysql.class.php');

        /* Cargamos las funciones principales */
        $this->includeFile('/includes/','funciones.php');
        $this->includeFile('/includes/','cadenas.php');
        
        /* Cargamos la clase que se encarga de manejar las vistas */
        $this->includeFile('/clases/','view.class.php');        
        $this->view = new view();

        
    }
    
    public function loadModel(){
        /* Esta función carga los modelos generalizados */
        
        /* Incluimos la clase componente de donde heredaran los demás componentes */
        $this->includeFile('/clases/','componente.class.php'); /* Cargamos el modelo generalizado */
                
        /* Cargamos la clase genérica de imagen */
        $this->includeFile('/clases/', 'imagen.class.php');
    }
    
    public function executeController(){
        $this->includeFile('/clases/', 'controller.class.php'); /* Cargamos el controlador general */
        
        /* Cargamos el controlador del componente */
        $controlador = 'controller'.ucfirst($this->seccion).'.php';
        $carpeta = '/componentes/'.$this->seccion.'/';
        
        $this->includeFile($carpeta,$controlador);
        $class = $this->seccion.'Controller';
        
        $this->controller = new $class();
        
        $this->controller->{$this->accion.'Action'}();
    }
    
    public function renderAction($component, $action = 'index'){
        //funcion que ejecuta un modulo de un componente concreto
        //Posiblemente dentro de un bloque
        
        $controlador = 'controller'.ucfirst($component).'.php';
        $carpeta = '/componentes/'.$component.'/';
        
        $this->includeFile($carpeta,$controlador);
        $class = $component.'Controller';
        
        $controller = new $class($component);
        $controller->{$action.'Action'}();
    }
    
    public function renderComponent(){
        global $app;
        $data = $this->data;
        include($this->view);
    }


    public function includeFile($carpeta,$fichero){
        global $app;
        $ruta = $this->ruta_absoluta.$carpeta.$fichero;
        
        if (!include_once ($ruta)){
            $this->debug_error[] = "APP: No se puede incluir el fichero: ".$ruta;
        }
    }

    private function strleft($s1, $s2) {
        return substr($s1, 0, strpos($s1, $s2));
    }

}

?>
