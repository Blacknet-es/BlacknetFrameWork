<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
global $usuario;
$id = $_POST['id'];

$p = new proyecto($id);
$r = new registro($usuario->id, "eliminado el proyecto <i>$p->empresa</i>");
$r->guardar();
$p->eliminar();
