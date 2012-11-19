<script type="text/javascript">

    /* GALERIAS */
    $("#galerias .elemento").live('mousemove',function(){
        $(this).addClass("ui-state-hover");        
    });
    $("#galerias .elemento").live('mouseout',function(){
        $("#galerias .elemento").removeClass("ui-state-hover");
    });
    $("#galerias .elemento").live('click',function(){
        $("#galerias .elemento").removeClass("ui-state-active");
        $(this).addClass("ui-state-active");        
    });

    

    /* FIN GALERIAS */

    $("#form .ui-widget ul").livequery(function(){
        $(this).sortable({
            placeholder: 'ui-state-highlight',
            update: function(){
                var orden = $(this).sortable('serialize');
                $("#capa").load("<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=ordenaradjuntos&" + orden);
                mostrar_mensaje(1, "La ordenación se ha completado correctamente");
            }
        });
    });

    nuevo_adjunto();

    $(".editar_adjunto").live('click', function(){

        $elemId = $(this).attr("id");
        $valores = $elemId.split("_"); //Separamos el id del elemento seleccionado en 2 para obtener el nombre del widget y el id a eliminar
        $nombreWidget = $valores[0];
        $ideditar = $valores[1];

        $("#id_imagen").val($ideditar);

        $("#editar_imagenes_nombre").dialog("open");
    });

    $(".enviar_datos_adjunto").live('click', function(){

        $elemId = $(this).attr("id");
        $valores = $elemId.split("_"); //Separamos el id del elemento seleccionado en 2 para obtener el nombre del widget y el id a eliminar
        $nombreWidget = $valores[0];
        $ideditar = $valores[1];

        $("#id_imagen").val($ideditar);

        $("#editar_imagenes_nombre").dialog("open");
    });

    $("#imagenes_guardar_datos").live('click', function(){

        $ideditar = $("#id_imagen").val();
        $nombre = $("#nombre_imagen_editar").val();

        $.ajax({
            type: 'GET',
            url: "<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=editarimagenes&id=" + $ideditar + "&nombre="+ $nombre,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(){

                $("#lista_imagenes").load("<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=listarimagenes&id=<? echo $app->id; ?>");

                mostrar_mensaje(1, "El elemento se ha eliminado correctamente");

            },
            error: function(){
                mostrar_mensaje(2, "Se ha producido un error durante la operación");

            }
        });

        $("#nombre_imagen_editar").val("");
        $("#editar_imagenes_nombre").dialog("close");
    });



    $(".eliminar_adjunto").live('click', function(){
        
        $elemId = $(this).attr("id");
        $valores = $elemId.split("_"); //Separamos el id del elemento seleccionado en 2 para obtener el nombre del widget y el id a eliminar
        $nombreWidget = $valores[0];
        $idborrar = $valores[1];

        $.ajax({
            type: 'GET',
            url: "<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=eliminar" + $nombreWidget + "&id=" + $idborrar,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(){

                $("#lista_" + $nombreWidget).load("<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=listar" + $nombreWidget + "&id=<? echo $app->id; ?>");

                mostrar_mensaje(1, "El elemento se ha eliminado correctamente");

            },
            error: function(){
                mostrar_mensaje(2, "Se ha producido un error durante la operación");

            }
        });

    });


    $(".activar_adjunto").live('click', function(){

        $elemId = $(this).attr("id");
        $valores = $elemId.split("_"); //Separamos el id del elemento seleccionado en 2 para obtener el nombre del widget y el id a eliminar
        $nombreWidget = $valores[0];
        $idborrar = $valores[1];

        $.ajax({
            type: 'GET',
            url: "<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=activar" + $nombreWidget + "&id=" + $idborrar,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(){

                $("#lista_" + $nombreWidget).load("<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=listar" + $nombreWidget + "&id=<? echo $app->id; ?>");

                mostrar_mensaje(1, "El elemento se ha activado/desactivado correctamente");

            },
            error: function(){
                mostrar_mensaje(2, "Se ha producido un error durante la operación");

            }
        });

    });


    $(".desactivar_adjunto").live('click', function(){

        $elemId = $(this).attr("id");
        $valores = $elemId.split("_"); //Separamos el id del elemento seleccionado en 2 para obtener el nombre del widget y el id a eliminar
        $nombreWidget = $valores[0];
        $idborrar = $valores[1];

        $.ajax({
            type: 'GET',
            url: "<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=desactivar" + $nombreWidget + "&id=" + $idborrar,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(){

                $("#lista_" + $nombreWidget).load("<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=listar" + $nombreWidget + "&id=<? echo $app->id; ?>");

                mostrar_mensaje(1, "El elemento se ha activado/desactivado correctamente");

            },
            error: function(){
                mostrar_mensaje(2, "Se ha producido un error durante la operación");

            }
        });

    });


    function abrirGaleria(galeria,ruta){
        $("#galerias").load("<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=listado&galeria="+ galeria +"&ruta="+ruta);
    }

    function nuevo_adjunto(){

        $(".nuevo_elemento").click(function(){
            $botonId = $(this).attr("id");
            $valores = $botonId.split("_");
            $nombreWidget = $valores[1];

            $.ajax({
                type: 'POST',
                url: $("#form_" + $nombreWidget).attr('action'),
                data: $("#form_" + $nombreWidget).serialize(),
                // Mostramos un mensaje con la respuesta de PHP
                success: function(){
                    $id = $("#" + $nombreWidget + " .element_id").attr("value");
                    $("#form_" + $nombreWidget + ' input').attr('value','');
                    $("#" + $nombreWidget + " .element_id").attr("value",$id);
                    $("#lista_"+ $nombreWidget).load("<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=listar"+ $nombreWidget +"&id=" + $id);

                    mostrar_mensaje(1, "El elemento se ha añadido correctamente");

                },
                error: function(){
                    mostrar_mensaje(2, "Se ha producido un error durante la operación");
                }
            });
        });
    }

    function cerrarVentanaImagenes(){
        $("#jcrop-dialog").dialog('close');
        $("#lista_imagenes").load("<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=listarimagenes&id=<? echo $app->id; ?>");
    }


</script>