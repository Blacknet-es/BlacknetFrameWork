<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

?>

<script type="text/javascript" src="<? echo $app->ruta_base; ?>/swfobject.js"></script>
<script type="text/javascript">

ancho = 618;
alto = 410;

var params = {};
params.base=".";
params.allowFullScreen="true";
params.bgColor="#000000";
params.wmode="transparent";

var flashvars={};
flashvars.dynamicUrl="true";
flashvars.imagesXmlPath="T_images.php";
flashvars.setupXmlPath="T_setup.xml";
swfobject.embedSWF("<? echo $app->ruta_base; ?>/T01.swf","myGallery",ancho,alto,"9.0.28.0", false, flashvars, params);
</script>