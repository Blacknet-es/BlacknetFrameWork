<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$usuario = new usuario();
$p = new proyecto($_GET['id']);

if($p->destacado == 1){
    $p->destacado = 0;
    
}
else{
    $p->destacado = 1;
}

$p->guardar();

$r = new registro($usuario->id, "destacado el proyecto <i>$p->nombre</i>");
$r->guardar();