<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

global $usuario;
$p = new enlace($_POST['id']);

if(isset($_POST['nombre'])){
    $p->nombre = $_POST['nombre'];
}

if(isset($_POST['vinculo'])){
    $p->vinculo = $_POST['vinculo'];
}

if(isset($_POST['descripcion'])){
    $p->descripcion = $_POST['descripcion'];
}

$p->guardar();

if($_POST['accion'] == "nuevo"){
    $accion = "creado";
}
elseif($_POST['accion'] == "editar"){
    $accion = "editado";
}

$r = new registro($usuario->id, "$accion el enlace <i>$p->nombre</i>");
$r->guardar();
mostrarComponenteAdmin($app->seccion);