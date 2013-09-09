<h4>Listado de <?=$app->seccion?></h4>

<table class="table table-striped table-hover table-bordered table-condensed">
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>VINCULO</th>
        <th>ACCIONES</th>
    </tr>
    <? foreach ($app->data->elementos as $e): ?>
    <tr>
        <td><?=$e->id?></td>
        <td><?=$e->nombre?></td>
        <td><?=$e->vinculo?></td>
        <td class="acciones btn-group">
            <a title="editar" class="btn btn-mini btn-primary" href="#"><i class="icon-pencil"></i></a>
            <a title="eliminar" class="btn btn-mini btn-danger" href="#"><i class="icon-remove"></i></a>
        </td>
    </tr>
    <? endforeach; ?>
</table>