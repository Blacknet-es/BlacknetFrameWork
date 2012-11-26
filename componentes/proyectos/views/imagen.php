<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
    $i = new imgproyecto($id);
    $i->verImagen();
}


?>