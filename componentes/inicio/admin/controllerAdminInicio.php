<?php 

class inicioController extends adminController 
{
    //Acción estándar en el caso de que no haya ninguna acción en la llamada
    public function indexAction(){       
        $this->renderAdminWithLayout('index.php');
    }

}
