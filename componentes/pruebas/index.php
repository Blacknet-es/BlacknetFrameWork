<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// http://difusion.serveftp.org/diff3/img/proyectos/1/principal.jpg
/*
$g = new galeria("img",$app->ruta_absoluta);


examinarGaleria($g);

print_r($g->elementos);

function examinarGaleria($g) {
    global $app;
    foreach ($g->elementos as $f) {
        if ($f->galeria() == false) {
            echo '<img src="' . $app->ruta_base . '/entorno.php?seccion=pruebas&amp;accion=miniatura&amp;nombre=' . $f->nombre . '&amp;ruta=' . $f->ruta . '" alt="" />';
        } else {
            echo '<div style="padding-left:10px;"><h3>' . $f->nombre . '</h3>';
            examinarGaleria($f);
            echo '</div>';
        }
    }
}
*/


/* FUNCION PARA URLS */

$u1 = "http://www.difusiongrafica.com";

$u2 = "www.difusiongrafica.org";

$u3 = "http://lacasaroja.es.bonita";


$u4 = "lacasaroja.es.bonita";


echo $u1.' => '.url2http($u1).' | OK <br/>';
echo $u2.' => '.url2http($u2).' | OK <br/>';
echo $u3.' => '.url2http($u3).' | OK <br/>';
echo $u4.' => '.url2http($u4).' | MAL <br/>';

?>