<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

global $usuario;
$p = new categoria($_POST['id']);

if(isset($_POST['nombre'])){
    $p->nombre = $_POST['nombre'];
    $p->alias = urlAmigable($p->nombre);
}


if(isset($_POST['servicio'])){
    $p->servicio = $_POST['servicio'];
}

if(isset($_POST['descripcion'])){
    $p->descripcion = $_POST['descripcion'];
}

if(isset($_POST['metades'])){
    $p->metades = $_POST['metades'];
}

if(isset($_POST['metatags'])){
    $p->metatags = $_POST['metatags'];
}




$p->guardar();

if($_POST['accion'] == "nuevo"){
    $accion = "creado";
}
elseif($_POST['accion'] == "editar"){
    $accion = "editado";
}

$r = new registro($usuario->id, "$accion la categoría <i>$p->nombre</i>");
$r->guardar();
mostrarComponenteAdmin($app->seccion);