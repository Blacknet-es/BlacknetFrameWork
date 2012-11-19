<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

global $usuario;
$p = new cliente($_POST['id']);

if(isset($_POST['empresa'])){
    $p->empresa = $_POST['empresa'];
}

if(isset($_POST['contacto'])){
    $p->contacto = $_POST['contacto'];
}

if(isset($_POST['mail'])){
    $p->mail = $_POST['mail'];
}

$p->guardar();

if($_POST['accion'] == "nuevo"){
    $accion = "creado";
}
elseif($_POST['accion'] == "editar"){
    $accion = "editado";
}

$r = new registro($usuario->id, "$accion el cliente <i>$p->empresa</i>");
$r->guardar();
mostrarComponenteAdmin($app->seccion);