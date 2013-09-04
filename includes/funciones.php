<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */


function cargarClases($ruta) { 
    // abrir un directorio y listarlo recursivo
    if (is_dir($ruta)) {
        if ($dh = opendir($ruta)) {
            while (($file = readdir($dh)) !== false) {
                if (is_dir($ruta.$file) && $file != "." && $file != "..") {
                    if (strstr($file, "clases")) {
                        //echo $ruta.$file;
                        $clases = opendir($ruta.$file);
                        while ($clase = readdir($clases)) {
                            if (preg_match('/class\.php$/',$clase)) {
                                include_once($ruta.$file.'/'.$clase);
                                //echo $ruta.$file.'/'.$clase.'<br/>';
                            }
                        }
                    }//solo si el archivo es un directorio, distinto que "." y ".."

                    cargarClases($ruta.$file."/");
                }
            }
            closedir($dh);
        }
    }
}



function deldir($dir){
    $current_dir = opendir($dir);
    while($entryname = readdir($current_dir)){
        if(is_dir("$dir/$entryname") and ($entryname != "." and $entryname!="..")){
            deldir("${dir}/${entryname}");
        }elseif($entryname != "." and $entryname!=".."){
            unlink("${dir}/${entryname}");
        }
    }
    closedir($current_dir);
    rmdir(${'dir'});
}

function comparar($a, $b){
        if ($a->orden == $b->orden){
            return 0;
        }
        else if ($a->orden > $b->orden){
            return -1;
        }
        else{
            return 1;
        }
    }

?>
