$(document).ready(function() {
	var l = $('#imgupload_loader'); // loder.gif image
	var p = $('#imgupload_preview'); // preview area
});

function imgupload_ajax_submit()
{
    // implement with ajaxForm Plugin
    f.ajaxForm({
        beforeSend: function(){
            l.show();
            $button.attr('disabled', 'disabled');
            p.fadeOut();
        },
        success: function(e){
            l.hide();
            f.resetForm();
            $button.removeAttr('disabled');
            p.html(e).fadeIn();
        },
        error: function(e){
            $button.removeAttr('disabled');
            p.html(e).fadeIn();
        }
    });
}
