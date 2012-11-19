<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$usuario = new usuario();
$p = new cliente($_GET['id']);

if($p->activo == 1){
    $p->activo = 0;
    $accion = 'desactivado';
}
else{
    $p->activo = 1;
     $accion = 'activado';
}

$p->guardar();

$r = new registro($usuario->id, "$accion el proyecto <i>$p->nombre</i>");
$r->guardar();