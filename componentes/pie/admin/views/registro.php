<h3 class="ui-widget-header"><span> &ndash; </span>Registro de operaciones</h3>
<ul>
    <?
    $r = new registros("LIMIT 30");
    $i = 0;
    foreach ($r->listado as $e):
    ?>
    <li class="ui-widget-content <? if ($i % 2 == 0): ?>tabla1<? endif; ?>"><? echo cambiaFecha($e->fecha); ?> | <? echo $e->verNombreUsuario(); ?> ha <? echo $e->accion; ?></li>
    <? $i++;
        endforeach; ?>
</ul>