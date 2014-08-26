<?php $app->renderAdminAction($app->seccion, 'actions'); ?>

<h4>Listado de <?=$app->seccion?></h4>

<?php if (isset ($app->data['elements']) && !empty ($app->data['elements'])): ?>
<table id="admin-list" class="table table-striped table-hover table-bordered table-condensed">
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th class="acciones">ACCIONES</th>
    </tr>
    <?php foreach ($app->data['elements'] as $e): ?>
    <tr data-action="select" data-id="<?=$e->id?>">
        <td><?=$e->id?></td>
        <td><?=$e->title?></td>
        <td class="text-right">
            <a title="editar" class="btn btn-xs btn-warning" data-action="edit" data-id="<?=$e->id?>"  href="#"><i class="fa fa-edit"></i></a>
            <a title="eliminar" class="btn btn-xs btn-danger" data-action="delete_modal" data-id="<?=$e->id?>" href="#"><i class="fa fa-eraser"></i></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
There are not elements in database.
<?php endif; ?>