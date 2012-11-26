<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class view{
    
    public function renderView($file){
        global $app;        
        $app->includeFile('/componentes/'.$this->seccion.'/views/',$file);
        
    }
    
    public function renderAction($component, $action){
        global $app;
        $app->includeFile('/componentes/'.$component.'/views/',$action.'.php');
    }
}
?>
