<?php

$url = '';
if (isset($app->get['categoria'])) {
    $url = $app->ruta_admin.'/entorno.php?seccion='.$app->seccion.'&accion=list&categoria='.$app->get['categoria'];
}

$acciones = new acciones("Acciones");
$acciones->btn_destacado = true;
//creamos añadimos las secciones del menu
$sec = new seccion("Proyectos", "proyectos", 'ui-icon-folder-collapsed');

$this->config['proyectos']['acctions'] = $acciones;

//creamos añadimos las secciones del menu
$this->menu->addSeccion($sec);
