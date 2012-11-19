<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$app->nombre_app = 'Diseños web, proyectos gráficos, logos y experiencias | Difusión Gráfica';
$app->metades = 'En nuestro catálogo de proyectos podrá ver una muestra de nuestros diseños web, trabajos y conocer así nuestra forma de trabajar.';

    
    if ($app->accion == 'categoria'){
        $c = new categoria($app->id);
        if ($c->metades != ''){
            $app->nombre_app = $c->nombre.' | Difusión Gráfica';
            $app->metades = $c->metades;
        }
    }

      if ($app->accion == 'ver'){
        $p = new proyecto($app->id);
        if ($p->metades != ''){
            $app->nombre_app = $p->nombre.' para '.$p->verNombreCliente().' | Difusión Gráfica';
            $app->metades = $p->metades;
        }
    }




?>
<link rel="stylesheet" type="text/css" media="screen" href="<? echo $app->ruta_componentes; ?>/proyectos/css/estilo.css" />