<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// http://difusion.serveftp.org/diff3/img/proyectos/1/principal.jpg

$galeria_principal = "img";
$ruta_principal = $app->ruta_absoluta;

if(isset($_GET['ruta']) && isset($_GET['galeria'])){
    $galeria_actual = $_GET['galeria'];
    $ruta_actual = $_GET['ruta'];
}
else{
    $galeria_actual = $galeria_principal;
    $ruta_actual = $ruta_principal;
}

$gp = new galeria($galeria_principal, $ruta_principal);

$llamadas = 0;

$g = $gp->buscarGaleria($galeria_actual,$ruta_actual);


?>


<? if($g->padre != null): ?>
    <? $padre = $g->padre; ?>
       <li class="elemento galeria ui-state-default ui-corner-all tipcontent" ondblclick="abrirGaleria('<? echo $padre->nombre; ?>','<? echo $padre->ruta; ?>');">
                <img class="tipobject" src="<? echo $app->ruta_img; ?>/carpeta.png" alt="" style="border:none;" />
                <p><b>[Volver]</b></p>
                <div class="tippopup ui-widget ui-widget-content ui-corner-all">
                    <h3>Galería</h3>
                    <img class="tipobject" src="<? echo $app->ruta_img; ?>/carpeta.png" alt="" />
                    <? echo "Nombre galería: ".$padre->nombre; ?><br/>
                    Subgalerías: <? echo $padre->subgalerias(); ?><br/>
                    Imágenes: <? echo $padre->imagenes(); ?><br/>
                </div>
            </li>
    <? endif; ?>
<? if ($g != null){ $g->examinarGaleria(); } ?>
<script type="text/javascript" src="<? echo $app->ruta_include; ?>/tips/tips.js"></script>
<script type="text/javascript" src="<? echo $app->ruta_include; ?>/shadowbox/shadowbox.js"></script>
<script type="text/javascript">
    Shadowbox.init();
</script>
<div class="clear"></div>