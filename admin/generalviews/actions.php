<!-- Modal windows -->
<div class="modal fade" id="delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Eliminar Elemento</h4>
      </div>
      <div class="modal-body">
        <p>¿Está seguro de eliminar el elemento seleccionado?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" data-action="delete">Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="btn-group btn-group-justified block-actions">
  <div class="btn-group">
    <button type="button" class="btn btn-success" data-action="new">
        <i class="fa fa-plus"></i>
        Nuevo
    </button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-warning disabled edit" data-action="" data-id="">
        <i class="fa fa-edit"></i>
        Editara
    </button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-danger disabled delete" data-action="" data-id="">
        <i class="fa fa-eraser"></i>
        Eliminar
    </button>
  </div>
</div>
