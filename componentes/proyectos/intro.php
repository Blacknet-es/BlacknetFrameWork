<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */
if ($app->accion == 'index'){
    $cat = 3;
}
else{
    $cat = $app->id;
}

$c = new categoria($cat);
?>
<? if ($c->id != 7): ?>
<h3><? echo $c->servicio; ?></h3>

<? echo $c->descripcion; ?>
<? endif; ?>