<? header('Content-Type: text/html; charset=UTF-8');?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="<?=$this->app->ruta_img; ?>/favicon.ico" />

        <link rel="stylesheet" type="text/css" href="<?=$this->app->ruta_include; ?>/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?=$this->app->ruta_admin; ?>/plantillas/admin/css/admin.css" />
        <link rel="stylesheet" type="text/css" href="<?=$this->app->ruta_admin; ?>/plantillas/admin/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?=$this->app->ruta_admin; ?>/plantillas/admin/css/pie.css" />

        <meta name="title" content="Panel de administración | <?=$this->app->nombre_app; ?>" />

        <title>Panel de administración | <?=$this->app->nombre_app; ?></title>
    </head>

    <body>
        <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?=$this->app->nombre_app?></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <?=$menu->mostrarHtml(); // Opciones de menu ?>
              <li><a href="#contact">Ayuda</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="./">opciones de usuario</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
        
        <div class="container-fluid" id="contenedor">
            <?=$this->app->renderComponent(); ?>                    
        </div>
                
            <div class="navbar navbar-inverse navbar-fixed-bottom" id="pie">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <?=$this->app->renderAdminAction("pie"); ?>
                    </div>                                      
                </div>
            </div>
                

    

    <script type="text/javascript" src="<?=$this->app->ruta_include; ?>/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$this->app->ruta_include; ?>/bootstrap/js/bootstrap.min.js"></script>    
    <? //include $this->app->ruta_absoluta.'/includes/widgets.php'; ?>
    </body>
</html>
