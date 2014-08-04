<?php
class adminController extends controller
{
    private $actions;
    private $jqgrid;
    private $config;
    
    public function __construct()
    {
        parent::__construct();
        
        //Load menu
        $menu = new menu();

        //Load User
        $usuario = new usuario();
        
        //Load components configuration
        $this->config = $config;
        
        //Set actions and jqgrid options
        $this->actions = $acciones;
        $this->jqgrid = $j;
    }
    public function indexAction()
    {
        var_dump($j);
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
}
