<? header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html >
<html lang="<?=$this->app->default_lan; ?>">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

        <link rel="stylesheet" type="text/css" media="screen" href="<?=$this->app->ruta_include; ?>/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?=$this->app->ruta_plantilla; ?>/css/general.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?=$this->app->ruta_plantilla; ?>/css/menu.css" />
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" href="<?=$this->app->ruta_plantilla; ?>/img/bn.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <? $this->renderHeader(); ?>

        <meta name="title" content="<?=$this->app->nombre_app; ?>" />
        <meta name="description" content="<?=$this->app->metades; ?>" />
        <meta name="keywords" content="<?=$this->app->metatags; ?>" />
        <title><?=$this->app->nombre_app; ?></title>

    </head>

    <body>     
        <? $this->app->renderAction('menu') ?>
        
        <div id="contenedor" class="container-fluid">
            <? $this->app->renderComponent(); ?>
        </div><!-- fin contenedor -->
        
        <div id="pie" class="container-fluid"><? $this->app->renderAction('pie'); ?></div>

        <!-- carga de javascripts -->
        <script type="text/javascript" src="<?=$this->app->ruta_include; ?>/jquery.min.js"></script>
        <script type="text/javascript" src="<?=$this->app->ruta_include; ?>/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
