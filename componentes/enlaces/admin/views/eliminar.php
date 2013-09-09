<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
global $usuario;
$id = $_GET['id'];

$p = new enlace($id);
$r = new registro($usuario->id, "eliminado el enlace <i>$p->nombre</i>");
$p->eliminar();


$r->guardar();
