
<table width="100%" id="registro-inicio">
    <tr>
        <th>Fecha</th>
        <th>Usuario</th>
        <th>Acción</th>
    </tr>
    <?
    $r = new registros();
    $i = 0;
    foreach ($r->listado as $e):
    ?>
    <tr class="<? if ($i % 2 == 0): ?>tabla1<? endif; ?>">
        <td><? echo cambiaFecha($e->fecha); ?></td>
        <td><? echo $e->verNombreUsuario(); ?></td>
        <td><? echo $e->accion; ?></td>
    </tr>
    <? $i++;
        endforeach; ?>
</table>