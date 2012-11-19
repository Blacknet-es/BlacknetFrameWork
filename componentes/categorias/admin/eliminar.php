<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
global $usuario;
$id = $_GET['id'];

$p = new categoria($id);
$r = new registro($usuario->id, "eliminado la categoria <i>$p->empresa</i>");
$r->guardar();
$p->eliminar();


$r->guardar();
