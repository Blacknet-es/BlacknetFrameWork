<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */
?>
<?
if ($app->seccion == 'proyectos' && $app->accion != 'ver'):
    echo mostrarComponente('proyectos', 'intro');
endif;
if ($app->seccion == 'proyectos' && $app->accion == 'ver'):
    echo mostrarComponente('proyectos', 'barra');
endif;
if ($app->seccion == 'info' && $app->accion == 'contacto'):
    echo mostrarComponente('info', 'contactoBarra');
endif;

if ($app->seccion == 'inicio'):
    echo mostrarComponente('inicio', 'inicioBarra');
endif;

?>

<h3>Contacto</h3>
<a class="icono contacto primero" href="<? echo $app->ruta_base; ?>/info/contacto">Contacto</a>
<a class="icono blog" href="#">Teléfono</a>
<h3>Redes sociales</h3>
<a class="icono facebook primero" href="http://www.facebook.com/#!/pages/Difusion-Grafica/316668360443" target="_blank">Facebook</a>
<a class="icono twitter" href="http://twitter.com/#!/difusiongrafica" target="_blank">Twitter</a>



    <hr/>
    
    <script language="javascript" type="text/javascript">
	//<![CDATA[
     
        document.write('<fb:fan profile_id="316668360443" width="270" height="585" connections="15" stream="true" css="<?=$app->ruta_componentes?>/barra/css/f.css?11" header="false"></fb:fan>');

     //]]>
     </script>
     
    
    
