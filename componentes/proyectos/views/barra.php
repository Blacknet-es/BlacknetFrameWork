<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$p = new proyecto($app->id);
?>


<h2 style="color: <? echo $p->color; ?>;"><? echo $p->verNombreCliente(); ?></h2>
<p><? if($p->buscarCategoria('Web')): ?>Web<? else: ?><? echo htmlentities($p->nombre,ENT_QUOTES,"UTF-8"); ?><? endif; ?></p>



<? if($p->numServicios() > 0): ?>
<h3>Servicios:</h3>
<ul>
    <? foreach ($p->servicios as $servicio): ?>
    <li><? echo $servicio; ?></li>
    <? endforeach; ?>
</ul>
<? endif; ?>


<? if ($p->enlace != ''): ?>
<h3>Sitio web:</h3>
<a class="enlace" target="_blank" href="http://<? echo $p->enlace; ?>"><? echo $p->enlace; ?></a>
<? endif; ?>


<?
$proyectosCliente = new proyectos('',$p->id_cliente);
if($proyectosCliente->numeroElementos() > 1):
?>
<h3>Proyectos relacionados</h3>
    <? $k = 0; foreach ($proyectosCliente->proyecto as $pc): ?>
        <? if ($pc->id != $app->id): ?>
            <a class="img <? if ($k % 2 == 0): ?>primero<? endif; ?>" title="<? echo $pc->verNombreCliente(); ?> | <? if($pc->buscarCategoria('Web')): ?>Web<? elseif($pc->buscarCategoria('Logo')): ?>Logotipo<? else: ?><? echo $pc->nombre; ?><? endif; ?>" href="<? echo $app->ruta_base; ?>/proyectos/ver/<? echo $pc->id; ?>/<? echo urlAmigable($pc->metades); ?>">
                <img src="<? echo $app->ruta_base; ?>/entorno.php?seccion=proyectos&amp;accion=recorte3&amp;id=<? echo $pc->img_principal; ?>" alt="" height="70" width="111" />
            </a>
        <? endif; ?>
    <? endforeach;?>
<? endif; ?>