<?php 

class enlacesController extends controller{
    //Acción estándar en el caso de que no haya ninguna acción en la llamada
    public function indexAction(){ 
        global $app;
        $this->addModel($app->seccion);
        
        $l = new enlaces();
        
        $this->renderAdminWithLayout('index.php',$l);
        
        
    }

}