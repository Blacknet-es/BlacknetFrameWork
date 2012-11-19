<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */
mostrarComponente($app->seccion,'menu');
$clientes = new clientes("AND activo = 1 ORDER BY orden ASC");
?>
<? $contador = 0; ?>
<? foreach ($clientes->elementos as $p): ?>
        <div class="proyecto <? if (($contador % 3) == 0): ?>primero<? endif; ?>">
            <p><? echo $p->empresa; ?></p>
        </div>
<? $contador++; ?>
<? if (($contador % 3) == 0): ?><div style="clear: both;"></div><? endif; ?>
<? endforeach; ?>
