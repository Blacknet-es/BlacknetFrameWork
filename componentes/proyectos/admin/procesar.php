<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

global $usuario;
$p = new proyecto($_POST['id']);

$p->nombre = $_POST['nombre'];
$p->txt1 = $_POST['txt1'];
$p->txt2 = $_POST['txt2'];
$p->enlace = $_POST['enlace'];
$p->metades = $_POST['metades'];
$p->metatags = $_POST['metatags'];
$p->color = $_POST['color'];
$p->anio = $_POST['anio'];
$p->id_cliente = $_POST['cliente'];


$servicios = explode(',', $_POST['servicios']);
$i=0;
$p->servicios = array();
foreach ($servicios as $s) {
    $p->servicios[] = $s;
}

$cat = $_POST['cat'];
foreach ($cat as $c){
    $cate = new categoria($c);
    //echo "ueueueu".$cate->nombre;
    $p->categorias[] = $cate;
}

$p->guardar();

if($_POST['accion'] == "nuevo"){
    $accion = "creado";
}
elseif($_POST['accion'] == "editar"){
    $accion = "editado";
}


$r = new registro($usuario->id, "$accion el proyecto <i>$p->nombre</i>");
$r->guardar();
mostrarComponenteAdmin($app->seccion);