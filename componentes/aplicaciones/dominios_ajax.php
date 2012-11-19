<?php

/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$webb = strtolower($_GET['web']);
$dominios[] = '.com';
$dominios[] = '.net';
$dominios[] = '.org';
$dominios[] = '.es';



if (strlen($webb) > 3) {
    foreach ($dominios as $d) {

        $pagina = 'http://www.' . $webb . $d;

        if (@fopen($pagina, "r")) {
            echo'La pagina con el dominio ' . $pagina . ' esta ocupado<br>';
        } else {
            echo'El Dominio ' . $pagina . '  esta disponible<br>';
        }        
    }
}
?>
