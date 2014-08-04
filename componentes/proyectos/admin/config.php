<?php

$url = '';
if (isset($app->get['categoria'])) {
    $url = $app->ruta_admin.'/entorno.php?seccion='.$app->seccion.'&accion=list&categoria='.$app->get['categoria'];
}

//Creamos un elemento jqgrid que nos ayudará a crear el jav
$j = new jqgrid($url, 40, '', 'orden', 'asc', '', '');

//añadimos los campos que va a tener jqgrid
$j->addCampo(new campo());
$j->addCampo(new campo('Nombre', 'nombre','string', '40', true, true, false, ''));
$j->addCampo(new campo('Destacado', 'destacado','int', '10', true, true, false, ''));
$j->addCampo(new campo('Cliente', 'cliente','string', '15', true, true, false, '','id_cliente'));
$j->addCampo(new campo('Categoria', 'categorias','array', '15', true, false, false, '','proyectoscayegorias'));
$j->ordenable = true;

$acciones = new acciones("Acciones");
$acciones->btn_destacado = true;
//creamos añadimos las secciones del menu
$sec = new seccion("Proyectos", "proyectos", 'ui-icon-folder-collapsed');

$this->config['proyectos']['jqgrid'] = $j;
$this->config['proyectos']['acctions'] = $acciones;

//creamos añadimos las secciones del menu
$this->menu->addSeccion($sec);
