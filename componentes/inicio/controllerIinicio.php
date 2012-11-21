<?php 

class InicioController extends controller{
    //Acción estándar en el caso de que no haya ninguna acción en la llamada
    public function indexAction(){
        $app->renderView('index.php');
    }
}