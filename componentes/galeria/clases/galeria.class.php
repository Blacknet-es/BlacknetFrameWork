<?
/* DIFF 3.0 DINAMIC PHP FRAMEWORK */
/* CLASES PARA CONTROLAR GALERÍA DE IMÁGENES
 * SIN BASE DE DATOS*/

class galeria {

    var $nombre;
    var $ruta;
    var $padre; /* galería padre enlace a tipo galería */

    var $elementos = array();

    public function __construct($nombre, $ruta, $padre = null) {
        $this->nombre = $nombre;
        $this->ruta = $ruta;
        $this->padre = $padre;

        $ruta_completa = $this->ruta.'/'.$nombre;
        $current_dir = @opendir($ruta_completa);

        while ($entryname = @readdir($current_dir)) {
            if (!preg_match('/^\./',$entryname)) { //ignoramos todos los ficheros y directorios que comiencen por .
                if (is_dir($ruta_completa . '/' . $entryname)) {
                    $this->elementos[] = new galeria($entryname,$ruta_completa,  $this);
                    
                } else {
                    $this->elementos[] = new foto($entryname,$ruta_completa,$this);
                   
                }
            }
        }
    }

    public function buscarGaleria($nombre, $ruta) {
        $r = null;
        if ($this->nombre == $nombre && $this->ruta == $ruta) {            
            return $this;
        } else {
            foreach ($this->elementos as $e) {
                if ($e->galeria()) {                    
                    $r = $e->buscarRecFinal($nombre, $ruta,$r);
                    //return $r;
                }
            }            
        }
        return $r;
    }    

    private function buscarRecFinal($nombre, $ruta, $r){
        if ($this->nombre == $nombre && $this->ruta == $ruta) {
            $r = $this;
        }
        else{
            foreach ($this->elementos as $e) {
                if ($e->galeria()) {
                    $r = $e->buscarRecFinal($nombre, $ruta,$r);
                    //return $r;
                }
            }
        }

        return $r;
    }

    public function subgalerias(){
        $i = 0;
        foreach ($this->elementos as $e){
            if ($e->galeria()){
                $i++;
            }
        }
        return $i;
    }

    public function imagenes(){
        $i = 0;
        foreach ($this->elementos as $e){
            if (!$e->galeria()){
                $i++;
            }
        }
        return $i;
    }

    public function galeria(){
        return true;
    }

    public function examinarGaleria() {
    global $app;
    foreach ($this->elementos as $f) {
        if ($f->galeria()): ?>
            <li class="elemento galeria ui-state-default ui-corner-all tipcontent" ondblclick="abrirGaleria('<? echo $f->nombre; ?>','<? echo $f->ruta; ?>');">
                <img class="tipobject" src="<? echo $app->ruta_img; ?>/carpeta.png" alt="" style="border:none;" />
                <p><b>[<? echo truncarCadena($f->nombre,10); ?>]</b></p>
                <div class="tippopup ui-widget ui-widget-content ui-corner-all">
                    <h3>Galería</h3>
                    <img class="tipobject" src="<? echo $app->ruta_img; ?>/carpeta.png" alt="" />
                    <? echo "Nombre galería: ".$f->nombre; ?><br/>
                    Subgalerías: <? echo $f->subgalerias(); ?><br/>
                    Imágenes: <? echo $f->imagenes(); ?><br/>
                </div>
            </li>
        <? endif;
    }

    foreach ($this->elementos as $f) {
        if ($f->galeria() == false): ?>
            <li class="elemento foto ui-state-default ui-corner-all tipcontent" >
                <img class="tipobject" src="<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion;?>&amp;accion=miniatura&amp;nombre=<? echo $f->nombre; ?>&amp;ruta=<? echo $f->ruta; ?>" alt="" />

                <p><? echo truncarCadena($f->nombre,10); ?></p>
                <div class="tippopup ui-widget ui-widget-content ui-corner-all">
                    <h3>Imagen</h3>
                    <a href="<? echo $f->verUrl(); ?>" rel="shadowbox" title="<? echo $f->nombre; ?>">
                       <img src="<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion;?>&amp;accion=preview&amp;nombre=<? echo $f->nombre; ?>&amp;ruta=<? echo $f->ruta; ?>" alt="" />
                    </a>
                    <? echo "Nombre fichero: ".$f->nombre; ?><br/>
                    Tipo: <? echo $f->mime; ?><br/>
                    Ancho: <? echo $f->ancho; ?>px<br/>
                    Alto: <? echo $f->alto; ?>px<br/>
                    <i>Pulsa en la imagen para agrandarla</i>

                </div>
            </li>
        <? endif;
    }
}
}

class foto{
    var $nombre;
    var $ruta;
    var $galeria;
    var $url;
    var $alto;
    var $ancho;
    var $mime;

    public function  __construct($nombre, $ruta, $galeria = null) {
        global $app;

        $this->nombre = $nombre;
        $this->ruta = $ruta;
        $this->galeria = $galeria;

        //Calculamos la url de la imagen
        $inicio_dominio = strlen($app->ruta_absoluta); //quitamos lo que mide la ruta absoluta y listo
        $this->url = $app->ruta_base.substr($this->ruta,$inicio_dominio).'/'.$this->nombre;

        list($width, $height, $type, $attr) = getimagesize($ruta.'/'.$nombre);

        $img_info = getimagesize($ruta.'/'.$nombre);

        $this->ancho = $width;
        $this->alto = $height;
        $this->mime = $img_info['mime'];
        
    }

    public function verImagen($alt = ""){

        if ($alt == ""){
            $alt = $this->nombre;
        }

        echo '<img src="'.$this->url.'" alt="'.$alt.'" width="'.$this->ancho.'" height="'.$this->alto.'" />';
    }


    public function verUrl(){
        return $this->url;
    }


    public function generarMiniatura($alto = 100, $ancho = 100){
        $img_info = getimagesize($this->ruta.'/'.$this->nombre);
        //Depende de cadenas.php que se encuentra en la carpeta includes
        $tam_final = aspectoImg($img_info, $ancho, $alto);

        //cabecera png de la imagen
        header('Content-Type: image/png');

        //detectamos el tipo mime y hacemos una copia de la imagen para trabajar con ella
        if($this->mime == 'image/jpeg'){
            $img_r = imagecreatefromjpeg($this->ruta.'/'.$this->nombre);
        }
        else if($this->mime == 'image/png'){            
            $img_r = imagecreatefrompng($this->ruta.'/'.$this->nombre);
            imagealphablending($img_r, true); // setting alpha blending on
            imagesavealpha($img_r, true); // save alphablending setting (important)
        }
        else if($this->mime == 'image/gif'){
            $img_r = imagecreatefromgif($this->ruta.'/'.$this->nombre);
        }

        //Generamos una imagen transparente con el tamaño de la miniatura
        $dst_r = ImageCreateTrueColor($tam_final['0'], $tam_final['1']); 
        $transparencia = imagecolorallocatealpha($dst_r, 0, 0, 0, 127);
        imagefill($dst_r, 0, 0, $transparencia);

        //metemos la redimension en la imagen de destino
        imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, $tam_final['0'], $tam_final['1'], $this->ancho, $this->alto); //insertamos la imagen en la nueva con las coordenadas especificadas.
        imagesavealpha($dst_r, true); // save alphablending setting (important)

        //Mostramos a imagen
        imagepng($dst_r);

        //Liberamos la memoria
        imagedestroy($dst_r);
        flush($dst_r);
        
    }

    public function galeria(){
        return false;
    }
}