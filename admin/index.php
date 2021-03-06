<?php

/* 
 * DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

/* INCLUIMOS EL FICHERO QUE CARGA LA CONFIG */
ini_set('error_reporting', E_ALL); //Solo en modo desarrollo
include('../config.php');



/* Incñuimos la clase app y creamos el objeto principal app */
include('../app.class.php');
$app = new app($nombre_app, $metades, $metatags, $default_lan, $plantilla, $db_host, $db_name, $db_user, $db_pass, $carpeta);

$app->debug_mode = true; //activamos para el modo depuracion

$app->loadModel(); //cargamos los modelos necesarios
$app->loadAdminClasses(); //Cargamos las clases necesarias para la admin

$app->executeAdminController(); //Ejecutamos el controlador

