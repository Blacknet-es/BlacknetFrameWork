<?php

global $menu;

$acciones = new acciones("Acciones");
$acciones->btn_eliminar = true;
$acciones->btn_destacado = false;


//creamos añadimos las secciones del menu
$sec = new seccion("enlaces", "enlaces",'icon-globe');
$menu->addSeccion($sec);


