<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */
mostrarComponente($app->seccion,'menu');
$enlaces = new enlaces("ORDER BY orden ASC");
?>
<? $contador = 0; ?>
<? foreach ($enlaces->elementos as $p): ?>
        <div class="proyecto <? if (($contador % 3) == 0): ?>primero<? endif; ?>">
            <p><a target="_blank" href="<? echo url2http($p->vinculo); ?>" title="<? echo $p->descripcion; ?>"><? echo $p->nombre; ?></a></p>
        </div>
<? $contador++; ?>
<? if (($contador % 3) == 0): ?><div style="clear: both;"></div><? endif; ?>
<? endforeach; ?>



