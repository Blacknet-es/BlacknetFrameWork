<? header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html >
<html lang="<? echo $app->default_lan; ?>">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_include; ?>/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_include; ?>/bootstrap/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_plantilla; ?>/css/estilo.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_plantilla; ?>/css/menu.css" />

        <link rel="shortcut icon" href="<? echo $app->ruta_plantilla; ?>/img/bn.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="revisit-after" content="1 days" />
        <meta name="robots" content="index, follow" />        

        <? echo mostrarCabecera(); ?>

        <meta name="title" content="<? echo $app->nombre_app; ?>" />
        <meta name="description" content="<? echo $app->metades; ?>" />
        <meta name="keywords" content="<? echo $app->metatags; ?>" />
        <title><? echo $app->nombre_app; ?></title>


    </head>

    <body>     
        <? mostrarComponente('menu'); ?>
        
        <? mostrarComponente('inicio','carrusel'); ?>
        <hr/>
        <div id="contenedor" class="container-fluid">
            <div id="contenido" class="row-fluid">
                <div class="span12"><? mostrarContenido(); ?></div>
            </div><!-- fin contenido -->
        </div><!-- fin contenedor -->
        <div id="pie" class="container-fluid"><? mostrarComponente('pie'); ?></div>

        <!-- carga de javascripts -->
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/jquery-ui/js/jquery.js"></script>
        <script type="text/javascript" src="<? echo $app->ruta_include; ?>/bootstrap/js/bootstrap.min.js"></script>        
        <script type="text/javascript" src="<? echo $app->ruta_plantilla; ?>/js/efectos.js"></script>
        <script>
                !function ($) {
                $(function(){
                    // carousel demo
                    $('#myCarousel').carousel();
                    
                })
            }(window.jQuery)
        </script>
    </body>
</html>