<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$img = new imgproyecto();
$img->descripcion = $_POST['descripcion'];
$img->nombre = $_POST['nombre'];
$img->ruta = $_POST['ruta'];
$img->principal = $_POST['principal'];
$img->id_proyecto = $_POST['id_proyecto'];
$img->guardar();

if ($_FILES['imagen']['tmp_name'] != "") {
    $origen = $_FILES['imagen']['tmp_name'];
    $nombre = $app->ruta_absoluta.'/'.$img->ruta.'/'.$img->id.'.jpg';;
}

move_uploaded_file($origen, $nombre);
$img_info = getimagesize($nombre); //informacion de la imagen
        //Obtencion de medidas para la imagen principal max de anchura 800 maximo de altura 600;
$destino_temporal = tempnam($app->ruta_absoluta . "/img/tmp/", "tmp");
$img_final = aspectoImg($img_info, 1600, 900);
redimensionar_jpeg($nombre, $destino_temporal, $img_final[0], $img_final[1], 80);
copy($destino_temporal, $nombre);

$img->ruta = $app->ruta_base.'/'.$img->ruta.'/'.$img->id.'.jpg';
$img->guardar();
$ruta = $img->ruta;



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
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/widgets.js"></script>
    </head>
    <body>
        <h2>Rellene los campos relativos a la imagen</h2>

        <div class="ui-corner-all form_block" id="form">
            <form id="form" class="form" name="form" method="post" action="<? echo $app->ruta_admin.'/entorno.php?seccion='.$app->seccion.'&amp;accion=guardarimagen'?>" enctype="multipart/form-data" >
            <input type="hidden" name="id" value="<? echo $img->id; ?>" />
            
            <? include($app->ruta_absoluta.'/includes/jcrop/jcrop.php'); ?><br/><br/>
            <input type="submit" value="Guardar recorte" />
            </form>
        </div>
    </body>
</html>