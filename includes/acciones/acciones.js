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
    url = url.split('&')[0];
    url += '&accion=add';
    
    window.location.href = url;
}

function action_form_save()
{
    submit_url = document.URL;
    submit_url = submit_url.split('&')[0];
    list_url = submit_url + '&accion=index';
    submit_url += '&accion=save';
    
    console.log($("#admin-form").serialize());
    
    $.ajax({
        type: "POST",
        url: submit_url,
        data: $("#admin-form").serialize(),
        success: function()
        {
            window.location.href = list_url;
        }
    });
}