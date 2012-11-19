<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$img = new imgproyecto($_POST['id']);

$img->x = $_POST['x'];
$img->y = $_POST['y'];
$img->x2 = $_POST['x2'];
$img->y2 = $_POST['y2'];
$img->w = $_POST['w'];
$img->h = $_POST['h'];

$img->guardar();

?>


<script type="text/javascript">
        parent.mostrar_mensaje(1, "La imagen se ha guardado correctamente");
		setTimeout("parent.cerrarVentanaImagenes()",200);
</script>