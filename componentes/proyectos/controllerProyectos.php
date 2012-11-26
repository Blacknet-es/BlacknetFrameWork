<?php 

class proyectosController extends controller{
    //Acción estándar en el caso de que no haya ninguna acción en la llamada
    public function indexAction(){
        $this->addModel('proyectos','proyectos');
        
        $this->render('index.php');
    }
    
    public function destacadosAction(){
        $this->addModel('proyectos','proyectos');
        
        $p = new proyectos('','',1); /* Seleccionamos los proyectos destacados*/
        
        $this->render('destacados.php',$p);
    }
}