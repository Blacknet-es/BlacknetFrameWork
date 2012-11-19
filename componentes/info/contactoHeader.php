<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$app->nombre_app = 'Contacta con nosotros | Difusión Gráfica';
$app->metades = 'Rellene el formulario con su consulta o propuesta y le ofreceremos la solución que más se adapte a su necesidad.';


?>
<script type="text/javascript" src="<? echo $app->ruta_include; ?>/jquery-validate/jquery.validate.pack.js"></script>

<script type="text/javascript" >
    $(document).ready(function(){        

        $("#contactForm").validate();

/*
        $("#tabs div").hide();

        $("#tab-1").show();

        $("#consulta").live("change", function(){
            $tab = "#tab-" + $(this).val();
            $("#tabs div").hide();
            $($tab).show();
            //alert($("#subcategoria").attr("value"));
        });
*/
    });
</script>