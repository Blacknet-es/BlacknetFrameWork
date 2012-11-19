
    $(document).ready(function(){
        $("* .elemento, * .imagen").click(	function()	{
            $("* .elemento, * .imagen").removeClass("ui-state-hover");
            $("* .elemento, * .imagen").removeClass("activo");
            $(this).addClass("ui-state-hover");
            $(this).addClass("activo");
        }
    );

        $("* .elemento, * .imagen").dblclick(function(){
            texto = $("* .activo p").text();
            if (texto != "volver") {
                if ($("* .activo").hasClass("elemento")) {
                    window.open("<? echo $app->ruta_base; ?>/index.php?seccion=<? echo $app->seccion; ?>&galeria=" + $("* .activo").attr("id"), "_self");
                }
                if ($("* .activo").hasClass("imagen")) {
                    imagen = $("* .activo img").attr("src");
                    window.open(imagen, 'Previsualizacion de imagen', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=500,height=500');
                }
            }
            else {
                if ($("* .aliasPadre").text() != "") {
                    window.open("<? echo $app->ruta_base; ?>/index.php?seccion=<? echo $app->seccion; ?>&galeria=" + $("* .aliasPadre").text(), "_self");
                }
                else {
                    window.open("<? echo $app->ruta_base; ?>/index.php?seccion=<? echo $app->seccion; ?>", "_self");
                }
            }
        });

        $("* .eliminar").click( function(){
            selected = $("* .activo p").html();
            if (selected == null || selected == "volver"){
                mostrar_mensaje(2,'ERROR: debe seleccionar una imagen para eliminarla');
            }
            else
            {
                if ($("* .activo").hasClass("elemento")){
                    mostrar_mensaje(2,'ERROR: El elemento seleccionado no es una imagen');
                }
                else{
                    $('#borrarEl').html("&iquest;Est&aacute; seguro de que desea eliminar la imagen <i>" + selected + "</i>?");
                    $('#borrarEl').dialog('open')
                    return false;
                }
            }
            selected = "";
        });

        $("* .eliminarGal").click( function(){
            selected = $("* .activo p").html();
            if (selected == null || selected == "volver"){
                mostrar_mensaje(2,'ERROR: debe seleccionar una galeria para eliminarla');
            }
            else
            {
                if ($("* .activo").hasClass("imagen")){
                    mostrar_mensaje(2,'ERROR: El elemento seleccionado no es una galeria');
                }
                else{
                    $('#borrarEl').html("&iquest;Est&aacute; seguro de que desea eliminar la galeria <i>" + selected + "</i>?");
                    $('#borrarEl').dialog('open')
                    return false;
                }
            }
            selected = "";
        });


        $("* .editar").click( function(){
            selected = $("* .activo p").html();
            if (selected == null || selected == "volver"){
                mostrar_mensaje(2,'ERROR: debe seleccionar una imagen para editarla');
            }
            else
            {
                if ($("* .activo").hasClass("elemento")){
                    mostrar_mensaje(2,'ERROR: El elemento seleccionado no es una imagen');
                }
                else{
                    id = $("* .activo").attr("id");
                    window.open("<? echo $app->ruta_base; ?>/index.php?seccion=imagenes&accion=editar&galeria=<? echo $_GET['galeria']; ?>" + "&id=" + id,"_self" );
                    return false;
                }
            }
            selected = "";
        });

        $("* .editarGal").click( function(){
            selected = $("* .activo p").html();
            if (selected == null || selected == "volver"){
                mostrar_mensaje(2,'ERROR: debe seleccionar una galeria para editarla');
            }
            else
            {
                if ($("* .activo").hasClass("imagen")){
                    mostrar_mensaje(2,'ERROR: El elemento seleccionado no es una galeria');
                }
                else{
                    id = $("* .activo").attr("id");
                    window.open("<? echo $app->ruta_base; ?>/index.php?seccion=<? echo $app->seccion; ?>&accion=editar&galeria=<? echo $_GET['galeria']; ?>" + "&id=" + id,"_self" );
                    return false;
                }
            }
            selected = "";
        });

        //ABRE LA PANTALLA
        $('#borrarEl').dialog({
            autoOpen: false,
            width: 600,
            modal: true,
            buttons: {
                "Eliminar": function()
                {
                    idImg = $("* .activo").attr("id");

                    if ($("* .activo").hasClass("imagen"))
                    {
                        $.ajax(
                        {
                            url: "<? echo $app->ruta_base; ?>/entorno.php" ,
                            data: "seccion=imagenes&accion=borrar2&id=" + idImg +"",
                            type: "GET",
                            success: function(){
                                window.open("<? echo $app->ruta_base; ?>/index.php?seccion=<? echo $app->seccion; ?>&galeria=<? echo $_GET['galeria']; ?>","_self" );

                            }
                        }
                    );
                    }
                    else
                    {

                        $.ajax(
                        {

                            url: "<? echo $app->ruta_base; ?>/entorno.php" ,
                            data: "seccion=galerias&accion=borrar2&id=" + idImg +"",
                            type: "GET",
                            success: function(){
                                window.open("<? echo $app->ruta_base; ?>/index.php?seccion=<? echo $app->seccion; ?>","_self" );

                            }
                        }
                    );
                    }
                    $(this).dialog("close");

                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            }
        });

        /* ORDENACION DE ELEMENTOS */
        $(function() {
            $("#galery").sortable(
            {
                items: 'div:not(.volver)',
                update : function ()
                {
                    var orden = $(this).sortable('serialize');
                    $("#capa").load("<? echo $app->ruta_base; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&accion=ordenar&" + orden);
                    mostrar_mensaje(1,"La ordenación se ha completado correctamente");
                }

            }
        );
        });

        $(function() {
            $("#images").sortable(
            {
                items: 'div:not(.volver)',
                update : function ()
                {
                    var orden2 = $(this).sortable('serialize');
                    $("#capa").load("<? echo $app->ruta_base; ?>/entorno.php?seccion=imagenes&accion=ordenar&" + orden2);
                    mostrar_mensaje(1,"La ordenación se ha completado correctamente");
                }

            }
        );
        });
