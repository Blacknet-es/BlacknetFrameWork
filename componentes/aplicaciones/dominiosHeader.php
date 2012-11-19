<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */
?>
<style type="text/css">
    input.dominio{
        width: 580px;
        font-size: 16px;
        padding: 5px 20px;

        -moz-box-shadow: inset 0 3px 8px rgba(0,0,0,.4);
        -webkit-box-shadow: inset 0 3px 8px rgba(0,0,0,.4);
        box-shadow: inset 0 3px 8px rgba(0,0,0,.24);
        -moz-border-radius: 100px;
	-webkit-border-radius: 100px;

    }

</style>



<script type="text/javascript">
    var runningRequest = false;
    var request;

    $(document).ready(function(){
        
        $("#dominio").keyup(function(e){
            e.preventDefault();
            var $q = $(this);

            //request.abort();

            $web = $q.val();

            if(runningRequest){
                request.abort();
            }


            runningRequest=true;
            request = $.ajax({
                url: '<? echo $app->ruta_base; ?>/entorno.php?seccion=aplicaciones&accion=dominios_ajax&web='+$web,
                success: function(data){
                    $("#disponibles").html(data);
                    runningRequest=false;
                }
            });

        });        
    });
    

</script>