<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

if (isset ($_GET['categoria'])){
    $categoria = $_GET['categoria'];
}
else{
    $categoria = '';
}

$filtro = generarFiltro($j); //Generamos el filtro para busquedas sin relacion con otras tablas
$filtro .= generarOrdenacion($j); //generamos la ordenación
$listadoC = new proyectos($categoria, '', '', $filtro);



$xml = generarXML($j, $listadoC);

header('Content-Type: text/xml');
echo $xml;


