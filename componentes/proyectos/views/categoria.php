<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

?>
<?
if($app->accion == 'categoria' && $app->id == '2'){ //Comprobamos si la categoria es logo
    mostrarComponente('proyectos','logo');
}
else{
    mostrarComponente('proyectos');
}


?>