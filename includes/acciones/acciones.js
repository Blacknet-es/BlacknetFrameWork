var elem_selected;
var $button;

$(document).ready(function()
{
    elem_selected = 0;
    $('body').on('click', "[data-action]", function() {
        $button = $(this);
        
        if ($(this).data('id') !== undefined) {
            elem_selected = $(this).data('id');
        }
        
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

function action_edit()
{
    url = document.URL;
    url = url.split('&')[0];
    url += '&accion=edit&id=' + elem_selected;
    
    window.location.href = url;
}

function action_delete()
{
    submit_url = document.URL;
    submit_url = submit_url.split('&')[0];
    list_url = submit_url + '&accion=index';
    submit_url += '&accion=delete&id=' + elem_selected;
    
    $.ajax({
        url: submit_url,
        success: function()
        {
            window.location.href = list_url;
        }
    });
}

function action_delete_modal()
{
    $('#delete-modal').modal('show');
}

function action_form_save()
{
    submit_url = document.URL;
    submit_url = submit_url.split('&')[0];
    list_url = submit_url + '&accion=index';
    submit_url += '&accion=save';
    
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

function action_select()
{
    $('.info').removeClass('info');
    $button.addClass('info');
    
    $('.block-actions .edit').removeClass('disabled');
    $('.block-actions .edit').data('action', 'edit');
    $('.block-actions .edit').data('id', elem_selected);
    
    $('.block-actions .delete').removeClass('disabled');
    $('.block-actions .delete').data('action', 'delete_modal');
    $('.block-actions .delete').data('id', elem_selected);
}