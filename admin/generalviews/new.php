<h1>New <?=$app->data['title']?></h1>

<form id="admin-form" role="form" method="post" action="#">
    <div class="row">
        <div class="col-md-8">
            <?=$app->data['object']->getFrom('main'); ?> 
        </div>
        <div id="right-block" class="col-md-4">
            <h3>Widgets</h3>
            <?=$app->data['object']->getFrom('right'); ?> 
        </div>
    </div> 
    
    <div class="form-group">
        <a id="save-form-action" data-action="form_save" class="btn btn-primary">Save</a>
        <a id="cancel-form-action" data-action="form_cancel" class="btn btn-danger">Cancel</a>
    </div>
    
</form>

