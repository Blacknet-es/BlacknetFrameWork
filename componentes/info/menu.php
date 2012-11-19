<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

?>
<div id="submenu">
        <a <? if($app->accion == 'el-estudio' || $app->accion == 'index'): ?>class="active"<? endif; ?> href="<? echo $app->ruta_base; ?>/<? echo $app->seccion; ?>/el-estudio">El estudio</a>
        <span class="separador">&nbsp;</span>
        
        <a <? if($app->accion == 'enlaces'): ?>class="active"<? endif; ?> href="<? echo $app->ruta_base; ?>/<? echo $app->seccion; ?>/enlaces">Enlaces</a>
        <span class="separador">&nbsp;</span>
        <a <? if($app->accion == 'contacto'): ?>class="active"<? endif; ?> href="<? echo $app->ruta_base; ?>/<? echo $app->seccion; ?>/contacto">Contacto</a>
        <hr/>
</div>