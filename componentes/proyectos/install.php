<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 * Instalador del componente proyectos
 */


$tablaProyectos = 'CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `servicios` text COLLATE utf8_spanish_ci NOT NULL,
  `txt1` text COLLATE utf8_spanish_ci NOT NULL,
  `txt2` text COLLATE utf8_spanish_ci NOT NULL,
  `enlace` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;';

$tablaCategorias = 'CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;';

$tablaProyectosCategorias = 'CREATE TABLE IF NOT EXISTS `proyectoscategorias` (
  `id_proyecto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_proyecto`,`id_categoria`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
';

/* Creamos las tablas de la base de datos */
$c = new mysql($app);
$c->consulta($tablaProyectos);
$c->consulta($tablaCategorias);
$c->consulta($tablaProyectosCategorias);


/* Creamos las carpetas y le damos los permisos */
mkdir($app->ruta_absoluta.'/img/proyectos');
chmod($app->ruta_absoluta.'/img/proyectos',0777);


