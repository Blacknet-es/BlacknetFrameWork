<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$prin = 0;
if(isset($_GET['principal'])){
   $prin = $_GET['principal'];
}

$id_imagen = '';
$nombre = '';
$descripcion = '';
if(isset($_GET['id_imagen'])){
    $id_imagen = $_GET['imagen'];
    $i = new imgproyecto($_GET['id_imagen']);
    $nombre = $i->nombre;
    $descripcion = $i->descripcion;

    //$i->eliminar();
}

?>


<input type="hidden" name="principal" value="<? echo $prin; ?>" />
<input type="hidden" name="id_proyecto" value="<? echo $_GET['id_proyecto']; ?>" />
<input type="hidden" name="id_imagen" value="<? echo $id_imagen; ?>" />
Nombre: <input type="text" name="nombre" value="<? echo $nombre; ?>" /><br/><br/>
Descripcion:<br/><textarea class="ckeditor" cols="10" rows="10" name="descripcion"><? echo $descripcion; ?></textarea><br/><br/>