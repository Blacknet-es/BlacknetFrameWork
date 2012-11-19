<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 * Archivo de configuracion para componente.
 */

global $menu;
$url = '';


if($app->seccion == 'clientes'){
//Creamos un elemento jqgrid que nos ayudará a crear el javascript
$j = new jqgrid($url, 20, '', 'orden', 'asc', '', '');

//añadimos los campos que va a tener jqgrid
$j->addCampo(new campo());
$j->addCampo(new campo('Contacto', 'contacto','string', '50', true, true, false, ''));
$j->addCampo(new campo('Empresa', 'empresa','string', '50', true, true, false, ''));
$j->addCampo(new campo('Activo', 'activo','int', '20', true, true, false, ''));
$j->ordenable = true;


$acciones = new acciones("Acciones");
$acciones->btn_eliminar = false;
$acciones->btn_destacado = true;
}

//creamos añadimos las secciones del menu
$sec = new seccion("clientes", "clientes",'ui-icon-person');

$sub1 = new subseccion("prueba", "prueba");
$sub2 = new subseccion("prueba2", "prueba2");
/*
$sec->addSubseccion($sub1);
$sec->addSubseccion($sub2);*/

$menu->addSeccion($sec);

