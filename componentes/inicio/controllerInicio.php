<?php 

class inicioController extends controller{
    //Acción estándar en el caso de que no haya ninguna acción en la llamada
    public function indexAction(){
        $this->addModel('proyectos','proyectos');
        
        $this->render('index.php');
    }
}