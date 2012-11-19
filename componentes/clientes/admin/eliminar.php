<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
global $usuario;
$id = $_GET['id'];

$p = new cliente($id);
$r = new registro($usuario->id, "eliminado el cliente <i>$p->empresa</i>");
$p->eliminar();


$r->guardar();
