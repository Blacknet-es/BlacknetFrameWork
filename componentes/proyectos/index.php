<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

if ($app->accion == 'index') {
    $cat = 3;
} else {
    $cat = $app->id;
}


$categorias = new categorias();

$proyectos = new proyectos($cat);
$num = count($categorias->categoria);
$i = 1;
?>
<div id="submenu"><? foreach ($categorias->categoria as $c): ?>
        <a <? if($cat == $c->id): ?>class="active"<? endif; ?> href="<? echo $app->ruta_base; ?>/<? echo $app->seccion; ?>/categoria/<? echo $c->id; ?>/<? echo urlencode($c->nombre); ?>"><? echo $c->nombre; ?></a>
        <? if ($i != $num): ?><span class="separador">&nbsp;</span><? endif; ?>
    <? $i++; endforeach; ?>
        <hr/>
</div>
<? $contador = 0; ?>
<? foreach ($proyectos->proyecto as $p): ?>
        <div class="proyecto <? if (($contador % 3) == 0): ?>primero<? endif; ?>">
                <a class="img" href="<? echo $app->ruta_base; ?>/proyectos/ver/<? echo $p->id; ?>/<? echo urlAmigable($p->metades); ?>">
                    <img src="<? echo $app->ruta_base; ?>/entorno.php?seccion=proyectos&amp;accion=recorte2&amp;id=<? echo $p->img_principal; ?>" alt="" height="121" width="190" />
                </a>            
                <h3 style="color: <? echo $p->color; ?>"><? echo $p->verNombreCliente(); ?></h3>
                <p class="titulo"><? echo htmlentities($p->nombre,ENT_QUOTES,"UTF-8"); ?></p>
            </div>
<? $contador++; ?>
<? if (($contador % 3) == 0): ?><div style="clear: both;"></div><? endif; ?>
<? endforeach; ?>
