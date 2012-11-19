<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$filtro = generarFiltro($j);
$filtro .= generarOrdenacion($j);

$listadoC = new categorias($filtro);

$xml = generarXML($j, $listadoC);


header('Content-Type: text/xml');
echo $xml;


