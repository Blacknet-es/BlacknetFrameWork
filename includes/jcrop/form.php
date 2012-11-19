<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of jcrop
 *
 * @author javi
 */

include('../../config.php');
/* Incñuimos la clase app y creamos el objeto principal app */
include('../../app.class.php');
$app = new app($nombre_app, $metades, $metatags, $default_lan, $plantilla, $db_host, $db_name, $db_user, $db_pass, $carpeta);

/* Cargamos la clase para generar consultas MySQL */
include($app->ruta_absoluta.'/clases/mysql.class.php');

/* Cargamos las funciones principales */
include ($app->ruta_absoluta.'/includes/funciones.php');
include ($app->ruta_absoluta.'/includes/cadenas.php');

/* Incluimos la clase componente de donde heredaran los demás componentes */
include($app->ruta_absoluta.'/clases/componente.class.php');
include($app->ruta_absoluta.'/clases/imagen.class.php');
/* Incluimos las demás clases de los componentes */
cargarClases($app->ruta_absoluta.'/componentes/');


/* Incluimos las clases de admin */
cargarClases($app->ruta_absoluta_admin.'/');

$img = $_GET['ruta'];
$seccion = $_GET['seccion'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<? echo $app->default_lan; ?>" lang="<? echo $app->default_lan; ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="shortcut icon" href="<? echo $app->ruta_img; ?>/favicon.ico" />

        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_include; ?>/jquery-ui/css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_include; ?>/jcrop/css/jquery.Jcrop.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_include; ?>/jqgrid/css/ui.jqgrid.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="<? echo $app->ruta_include; ?>/colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_admin; ?>/plantillas/admin/css/admin.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_admin; ?>/plantillas/admin/css/form.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_plantilla; ?>/css/estilo.css" />
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jquery-ui/js/jquery.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jquery-ui/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jcrop/js/jquery.Jcrop.min.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/fg.menu.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jqgrid/js/i18n/grid.locale-es.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jqgrid/js/jquery.jqGrid.min.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/colorpicker/js/colorpicker.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jquery-validate/jquery.validate.pack.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/widgets.js"></script>
    </head>
    <body>
        <h2>Rellene los campos relativos a la imagen</h2>

        <div class="ui-corner-all form_block" id="form">
            <form class="form" name="form" method="post" action="<? echo $app->ruta_admin.'/entorno.php?seccion='.$seccion.'&amp;accion=recorte'?>" enctype="multipart/form-data" >
                <input type="hidden" name="ruta" value="<? echo $img; ?>" />
                <input type="hidden" name="seccion" value="<? echo $seccion; ?>" />

                <? 
                if (file_exists($app->ruta_absoluta . '/componentes/' . $seccion . '/admin/jcrop.php')):
                    include ($app->ruta_absoluta . '/componentes/' . $seccion . '/admin/jcrop.php');
                endif;

                ?>

                <input type="file" name="imagen" /><br/><br/>
                <input type="submit" class="ui-button ui-state-default ui-corner-all" name="siguiente" id="siguiente" value="Siguiente" />

            </form>

        </div>
    </body>
</html>