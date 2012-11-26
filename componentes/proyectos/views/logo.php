<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

if ($app->accion == 'index') {
    $cat = 1;
} else {
    $cat = $app->id;
}


$categorias = new categorias();

$proyectos = new proyectos($cat);
$num = count($categorias->categoria);
$i = 1;
?>
<div id="submenu"><? foreach ($categorias->categoria as $c): ?>
        <a <? if($app->id == $c->id): ?>class="active"<? endif; ?> href="<? echo $app->ruta_base; ?>/<? echo $app->seccion; ?>/categoria/<? echo $c->id; ?>/<? echo urlencode($c->nombre); ?>"><? echo $c->nombre; ?></a>
        <? if ($i != $num): ?><span class="separador">&nbsp;</span><? endif; ?>
    <? $i++; endforeach; ?>
        <hr/>
</div>
<? $contador = 0; ?>
<? foreach ($proyectos->proyecto as $p): ?>
        <div class="proyecto <? if (($contador % 3) == 0): ?>primero<? endif; ?>" style="background: none;">
                <a class="img" href="<? echo $app->ruta_base; ?>/proyectos/ver/<? echo $p->id; ?>/<? echo urlAmigable($p->metades); ?>">
                    <img style="border: none;" src="<? echo $app->ruta_base; ?>/entorno.php?seccion=proyectos&amp;accion=recorte2&amp;id=<? echo $p->img_principal; ?>" alt="" height="121" width="190" />
                </a>

            </div>
<? $contador++; ?>
<? if (($contador % 3) == 0): ?><div style="clear: both;"></div><? endif; ?>
<? endforeach; ?>
