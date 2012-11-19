$(document).ready(function(){

    // ACCIONES GENERALES PARA TODAS LAS SECCIONES

    /* REPORTE DE ERROR */

    /* Ventana de dialogo */
    $('#reporte').dialog({
        autoOpen: false,
        width: 600,
        modal: true,
        buttons: {
            "Enviar": function(){
                document.getElementById("reporte_form").submit();
                $(this).dialog("close");
            },
            "Cancelar": function(){
                $(this).dialog("close");
            }
        }
    });    


    /* Evento y accion */
    $('#reporte_link').click(function(){
        $('#reporte').dialog('open');
        return false;
    });

    /* FIN REPORTE ERROR */



    /* DEFINICION DE LOS BOTONES DE LA BARRA DE ACCIONES */

    /* Transformamos todos los enlaces a botones jQuery ui */
    $("#barra_acciones a").button(); //Botones generales

    /* Iconos para acciones básicas */
    $("#publicar2, #nuevo").button({
        icons: {
            primary: 'ui-icon-plus'
        }
    });

    $("#editar").button({
        icons: {
            primary: 'ui-icon-pencil'
        }
    });

    $("#bsdata").button({
        icons: {
            primary: 'ui-icon-search'
        }
    });

    $("#destacar").button({
        icons: {
            primary: 'ui-icon-star'
        }
    });

    $("#eliminar, .eliminar").button({
        icons: {
            primary: 'ui-icon-close'
        }
    });
    

    $("#actualizar, .actualizar").button({
        icons: {
            primary: 'ui-icon-refresh'
        }
    });

    /* Boton de barra de acciones */
    $("#reporte_link").button({
        icons: {
            primary: 'ui-icon-alert'
        }
    });

    /* FIN DE DEFINICION DE BOTONES */
  


    

    // Dialog
    $('* #borrar').dialog({
        autoOpen: false,
        width: 600,
        modal: true,
        buttons: {
            "Eliminar": function(){
                $.ajax({
                    type: "POST",
                    url: $("#eliminarEntrada").attr("action"),
                    data: $("#eliminarEntrada").serialize(),
                    success: function(msg){
                        mostrarMensaje(1, "La entrada se ha eliminado correctamente"); //Mostramos el mensaje de que se ha eliminado correctamente
                        $("list").jqGrid.trigger("reloadGrid"); //recargamos el grid
                    }

                });
                $(this).dialog("close");
            },
            "Cancelar": function(){
                $(this).dialog("close");
            }
        }
    });

    // Dialog Link
    $('* #borrar_link').click(function(){
        $('* #borrar').dialog('open')
        return false;
    });
    
});