<? header('Content-Type: text/html; charset=UTF-8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<? echo $app->default_lan; ?>" lang="<? echo $app->default_lan; ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="shortcut icon" href="<? echo $app->ruta_img; ?>/favicon.ico" />

        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_include; ?>/jquery-ui/css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_include; ?>/jqgrid/css/ui.jqgrid.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="<? echo $app->ruta_include; ?>/colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="<? echo $app->ruta_include; ?>/jgrowl/jquery.jgrowl.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="<? echo $app->ruta_include; ?>/tips/tips.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="<? echo $app->ruta_include; ?>/shadowbox/shadowbox.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_admin; ?>/plantillas/admin/css/admin.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_admin; ?>/plantillas/admin/css/form.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_admin; ?>/plantillas/admin/css/pie.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_plantilla; ?>/css/estilo.css" />
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jquery-ui/js/jquery.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jquery-ui/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jquery.livequery.min.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jcrop/js/jquery.Jcrop.min.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jgrowl/jquery.jgrowl_minimized.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/fg.menu.js"></script>        
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/shadowbox/shadowbox.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jqgrid/js/i18n/grid.locale-es.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jqgrid/js/jquery.jqGrid.min.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/colorpicker/js/colorpicker.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jquery-validate/jquery.validate.pack.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/widgets.js"></script>
        <? include $app->ruta_absoluta.'/includes/widgets.php'; ?>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/tips/tips.js"></script>

        <? echo mostrarCabeceraAdmin(); ?>
        <? echo mostrarCabeceraAdmin("pie"); ?>
        <? echo $menu->mostrarJavascript(); ?>
       
        
        <meta name="title" content="Panel de administración | <? echo $app->nombre_app; ?>" />

        <title>Panel de administración | <? echo $app->nombre_app; ?></title>
    </head>

    <body>
        <a name="top"></a>
        <div id="contenedor" align="center">
            <div id="contenido" align="center">
                <div id="cabecera">
                    <h1 id="logo"><? echo $app->nombre_app; ?></h1>
                    <div id="menu"><? echo $menu->mostrarHtml(); ?></div>
                    <div class="clear"></div>
                    <? echo mostrarContenidoAdmin(); ?>
                    <div id="pie">
                        <? echo mostrarComponenteAdmin("pie"); ?>
                    </div>
                </div>
                <!-- fin contenido -->
            </div>
            <!-- fin contenedor -->
        </div>

        <div id="jcrop-dialog" title="Herramienta para subir y recortar imagenes">
            <iframe src="" frameborder="0" width="950" height="500"></iframe>
        </div>
        <div id="jcrop-ruta"><? echo $app->ruta_include; ?>/jcrop/form.php?seccion=<? echo $app->seccion; ?>&ruta=</div>
    </body>
</html>