<?

/* LIVE CONTROL DE CADENAS v0.1 */
/* LAS SIGUENTES FUNCIONES CONTROLAN */
/* EL FORMATO DE LAS CADENAS DE CARACTERES */

function protegerComillas($cadena) {
    return str_replace('"', '&quot;', $cadena);
}

function urlAmigable($url) {

// Tranformamos todo a minusculas

    $url = strtolower($url);
    if (strlen($url) > 100) {
        $url = substr($url, 0, 100);
    }

//Rememplazamos caracteres especiales latinos

    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

    $repl = array('a', 'e', 'i', 'o', 'u', 'n');

    $url = str_replace($find, $repl, $url);


// Añaadimos los guiones

    $find = array(' ', '&', '\r\n', '\n', '+');
    $url = str_replace($find, '-', $url);

// Eliminamos y Reemplazamos demás caracteres especiales

    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

    $repl = array('', '-', '');

    $url = preg_replace($find, $repl, $url);

    return $url;
}

function url2http($url) {

    if(strstr($url, 'http://www.')){
        return $url; 
    }

    $in = array('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si', '`((?<!--//)(www\.\S+[[:alnum:]]/?))`si');
    $out = array('$1', 'http://$1');
    return preg_replace($in, $out, $url);
    
    
}

// Funccion para cortar el texto sin cortar las palabras a la mitad.
function truncarTexto($string, $limit, $break=" ", $pad="[...]") {
    // return with no change if string is shorter than $limit
    $string = strip_tags($string);
    if (strlen($string) <= $limit)
        return $string;

    // is $break present between $limit and the end of the string?
    if (false !== ($breakpoint = strpos($string, $break, $limit))) {
        if ($breakpoint < strlen($string) - 1) {
            $string = substr($string, 0, $breakpoint) . $pad;
        }
    }
    return $string;
}

// Funccion para cortar el texto cortando palabras
function truncarCadena($string, $limit, $pad="...") {
    // return with no change if string is shorter than $limit
    $string = strip_tags($string);
    if (strlen($string) <= $limit)
        return $string;

    return substr($string, 0, $limit) . $pad;
}

function verFecha2($fecha, $lan) {
    $l['es'][0] = "es_ES";
    $l['en'][0] = "en_EN";
    $l['fr'][0] = "fr_FR";
    $l['it'][0] = "it_IT";
    $l['de'][0] = "de_DE";
    $l['de'][1] = 'de_DE@euro';
    $l['de'][2] = 'de_DE';
    $l['de'][3] = 'deu_deu';
    @ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $MiTimesTamp = mktime(0, 0, 0, $mifecha[2], $mifecha[3], $mifecha[1]);

    setlocale(LC_ALL, $l[$lan][0] . ".UTF-8");
    switch ($lan):
        case "es":
        case "it":
        case "fr":
            return strftime("%e ", $MiTimesTamp) . "" . ucfirst(strftime("%B ", $MiTimesTamp)) . "" . strftime("%Y", $MiTimesTamp);
        case "en":
            $cola = date('S', $MiTimesTamp);
            return strftime("%e" . $cola . " %B %Y", $MiTimesTamp);
        case "de":
            return strftime("%e. %B %Y", $MiTimesTamp);
        default:
            return strftime("%e %B %Y", $MiTimesTamp);
    endswitch;
}

function cambiaFecha($fecha) { //Cambia la fecha de formato SQL a formate legible.
    return preg_replace(
            "/([0-9]{4})-([0-9]{2})-([0-9]{2}) (\d{1,2}):(\d{1,2}):(\d{1,2})/i",
            "$3/$2/$1, $4:$5:$6",
            $fecha);
}

function aspectoImg($img_info, $ancho_max, $alto_max) {
    $proporcion = $img_info[0] / $img_info[1];

    if ($img_info[0] > $ancho_max || $img_info[1] > $alto_max) { //Comprobamos si supera los limites
        if ($ancho_max < ($alto_max * $proporcion)) { //La imagen es mas ancha que alta
            $alto_final = (int) ($ancho_max / $proporcion);
            $ancho_final = (int) $ancho_max;
        } else {// la imagen sigue siendo mas alta de lo permitido
            $ancho_final = (int) ($alto_max * $proporcion);
            $alto_final = (int) $alto_max;
        }
    } else {
        $alto_final = (int) $img_info[1];
        $ancho_final = (int) $img_info[0];
    }
    $img_final[0] = $ancho_final;
    $img_final[1] = $alto_final;
    return $img_final;
}

function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad) {
    // crear una imagen desde el original
    $img = ImageCreateFromJPEG($img_original);
    // crear una imagen nueva
    $thumb = imagecreatetruecolor($img_nueva_anchura, $img_nueva_altura);

    // redimensiona la imagen original copiandola en la imagen
    ImageCopyResampled($thumb, $img, 0, 0, 0, 0, $img_nueva_anchura, $img_nueva_altura, ImageSX($img), ImageSY($img));
    // guardar la nueva imagen redimensionada donde indicia $img_nueva
    ImageJPEG($thumb, $img_nueva, $img_nueva_calidad);

    ImageDestroy($img);
}

?>