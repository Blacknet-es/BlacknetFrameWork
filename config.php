<?
/***********************************************************
*           CONFIGURACION Blacknet Framework 0.11          *
* En este fichero encontraremos todos los datos relativos  *
* a la base de datos y otros parámetros de configuración   *
* necesarios para el correcto funcionamiento de la web.    *
* NO MODIFIQUE NADA SI NO TIENE CONOCIMIENTOS DE LO QUE    *
* ESTÁ HACIENDO                                            *
************************************************************/

//Reducir este fichero únicamente a los datos de la configuración de la BD
//Lo demás lo debe controlar la clase app o desde la base de datos

// GENERAL DESCRIPCION Y KEYWORDS

$nombre_app = "InterBarcelona";
$metades = "";
$metatags = "";
$debug = true; //Activamos modo debug

// IDIOMA POR DEFECTO

$default_lan = "es";

//PLANTILLA A CARGAR

$plantilla = "ibarcelona";

// BASE DE DATOS

if ($_SERVER['SERVER_ADDR'] == '192.168.1.103') { //DETECTA SI TRABAJAMOS EN LOCAL O EN REMOTO Y CARGA UNA U OTRA BASE DE DATOS

  //CARPETA PARA CARGA LOCAL
  $carpeta = "/ibarceona";

  $db_host='localhost'; // Host al que conectar, habitualmente es el ‘localhost’
  $db_name='interbarcelona'; // Nombre de la Base de Datos que se desea utilizar
  $db_user='root';   // Nombre del usuario con permisos para acceder
  $db_pass='j090482';  // Contraseña de dicho usuario

} else {

  $carpeta = "/ibarcelona";

  $db_host='localhost'; // Host al que conectar, habitualmente es el ‘localhost’
  $db_name='interbarcelona'; // Nombre de la Base de Datos que se desea utilizar
  $db_user='root';   // Nombre del usuario con permisos para acceder
  $db_pass='j090482'; // Contraseña de dicho usuario
}

// FIN BASE DE DATOS
