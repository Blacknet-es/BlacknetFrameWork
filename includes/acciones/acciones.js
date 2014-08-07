$(document).ready(function()
{
    $(document).on('click', "*[data-action!='']", function() {
        $button = $(this);
        
        $action = 'action_' + $button.data('action');
        
        window[$action]();
    });
});

function action_new()
{
    url = document.URL;
    url += '&accion=add';
    
    window.location.href = url;
}