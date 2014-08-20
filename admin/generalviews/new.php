<h1>New <?=$app->data['title']?></h1>

<form id="admin-form" role="form">
    <div class="row">
        <div class="col-md-8">
            <?=$app->data['object']->getFrom('main'); ?> 
        </div>
        <div id="right-block" class="col-md-4">
            <h3>Widgets</h3>
            <?=$app->data['object']->getFrom('right'); ?> 
        </div>
    </div> 
</form>

