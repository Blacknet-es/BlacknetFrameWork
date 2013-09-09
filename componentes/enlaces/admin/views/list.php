<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$filtro = generarFiltro($j);
$filtro .= generarOrdenacion($j);

$listadoF = new enlaces($filtro);

$xml = generarXML($j,$listadoF);

header('Content-Type: text/xml');
echo $xml;


