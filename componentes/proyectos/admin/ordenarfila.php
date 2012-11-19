<?php

/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$lista = $_POST['lista'];

foreach ($lista as $num => $id) {
    $p = new proyecto($id);
    $p->orden = $num;
    $p->guardar();
}