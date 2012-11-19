<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */


$i = new foto($_GET['nombre'],$_GET['ruta']);
$i->generarMiniatura(200,200);