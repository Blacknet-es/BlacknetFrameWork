<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$id = $_GET['id'];
$imagenes = new imagenesproyecto($id); ?>
<hr/>

<h4>Listado de imágenes</h4><br/>
<ul>
<? foreach ($imagenes->elementos as $imagen): ?>
    <li class="ui-widget ui-widget-content ui-state-default ui-corner-all <? if($imagen->principal): ?>principal<? endif; ?>" id="item_<? echo $imagen->id; ?>">
        <? echo $imagen->nombre; ?>
        <a class="boton eliminar_adjunto" href="#imagenes" id="imagenes_<? echo $imagen->id; ?>"><span class="ui-icon ui-icon-close"></span></a>
        <a class="boton editar_adjunto" href="#imagenes" id="imagenes_<? echo $imagen->id; ?>"><span class="ui-icon ui-icon-pencil"></span></a>
    </li>
<? endforeach; ?>
</ul>
