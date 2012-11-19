<?php

/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 * Archivo de configuracion para componente.
 */
global $menu;
if ($app->seccion == 'galeria') {

    $acciones = new acciones("Explorador de imágenes"); //Generar las acciones para las galerías
    $acciones->btn_destacado = false;
    $acciones->btn_edit = false;
    $acciones->btn_nuevo = false;

    $a = new accion("prueba", "ere to chungo", 'ui-icon-star', 'right', '1');
    
    if(!$a->addAccionPrincipal('onClick', "alert('probando!!');")){
        die("ERROR!!!!");
    }

    $acciones->addAccion($a);
}
//creamos añadimos las secciones del menu
$sec = new seccion("Galerias", "galeria", 'ui-icon-image');

$menu->addSeccion($sec);
