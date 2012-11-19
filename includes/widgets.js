/* CONFIGURACION JAVASCRIPT PARA LOS WIDGETS GENÉRICOS REQUIERE JQUERY  */

$(document).ready(function (){
    //Validar formularios

    if($("#form").length){
        if($("#pass").length){
            $("#form form").validate({
                rules: {
                    pass: {
                        minlength: 5
                    },
                    pass2: {
                        minlength: 5,
                        equalTo: "#pass"
                    }
                }
            });
        }
        else{
            $("#form form").validate();
        }

        
    }
   

    //ColorPicker
    $(".widget-color").ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).val("#" + hex);
            $(el).ColorPickerHide();
            $(el).css("background", $(el).val());
        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor(this.value);
        }
    })
    .bind('keyup', function(){
        $(this).ColorPickerSetColor(this.value);
    });
    

    //Botones
    $(".boton, input[type='submit'], input[type='button']").button();


    //Jcrop Dialogo
    $("#jcrop-dialog").dialog(
    {
        autoOpen: false,
        width: 965,
        height: 545,
        modal: true
    }
);
    $(".jcrop-open").click(function (){
        $("#jcrop-dialog").dialog('open');
    });

    $('#cropbox').Jcrop({
            onChange: showPreview,
            onSelect:    showPreview,
            aspectRatio: 1.569444
    });

    $(".ui-dialog").resize(function(){
        //alert("illo");
        $("#jcrop-dialog iframe").width($("#jcrop-dialog").width());
        $("#jcrop-dialog iframe").height($("#jcrop-dialog").height());
    });

   $("#solapas, .tab").tabs();

});


/* ABRE EL DIALOGO PARA EL RECORTE DE IMAGENES */
function jcropOpen(ruta){
    $("#jcrop-dialog").dialog('open');
    $src = $("#jcrop-ruta").text() + ruta;    
    $("#jcrop-dialog iframe").attr('src', $src);

}

function showPreview(coords)
            {
                if (parseInt(coords.w) > 0)
                {

                    var rx = 226 / coords.w;
                    var ry = 144 / coords.h;

                    var w = $('#cropbox').attr('width');
                    var h = $('#cropbox').attr('height');

                    $('#x').val(coords.x);
                    $('#y').val(coords.y);
                    $('#x2').val(coords.x2);
                    $('#y2').val(coords.y2);
                    $('#w').val(coords.w);
                    $('#h').val(coords.h);

                    jQuery('#preview').css({
                        width: Math.round(rx * w) + 'px',
                        height: Math.round(ry * h) + 'px',
                        marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                        marginTop: '-' + Math.round(ry * coords.y) + 'px'
                    });
                }
            }

function mostrar_mensaje(tipo, mensaje){
    if(tipo == 2){
        Cabecera = "Error";
        estilo = "ui-state-error";
    }
    else{
        Cabecera = "Info";
        estilo = "ui-state-highlight";
    }
    $.jGrowl(mensaje, {
	header: Cabecera,
        theme: estilo
    });
}
