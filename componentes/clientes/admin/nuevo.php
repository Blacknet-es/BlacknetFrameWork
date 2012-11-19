<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?
if ($app->accion == 'nuevo') {
    $p = new cliente('');
    //$p->guardar();
}
elseif($app->accion == 'editar'){
    $p = new cliente($_GET['id']);
}

$acciones->titulo = ucfirst($app->accion) . ' cliente';
?>
<? echo $acciones->mostrarHtml(); ?>

<div class="ui-corner-all ui-widget-content" id="form" >
    <form  class="form" name="form" method="post" action="<? echo $app->ruta_admin; ?>/index.php?seccion=<? echo $app->seccion; ?>&amp;accion=procesar" enctype="multipart/form-data">
        
<table width="100%">
  <tr>
    <td id="bloque-form">
            <input type="hidden" name="id" value="<? echo $p->id; ?>" />
            <input type="hidden" name="accion" value="<? echo $app->accion; ?>" />
            <div>Empresa</div>
            <input type="text" class="titulo ui-widget-content ui-corner-all" name="empresa" id="empresa" value="<? echo $p->empresa; ?>" />
            <br/>

            

           

            <div>Contacto</div>
            <input type="text" class="ui-widget-content ui-corner-all" name="contacto" id="contacto" value="<? echo $p->contacto; ?>" />
            <br/>

            <div>Mail</div>
            <input type="text" class="ui-widget-content ui-corner-all" name="mail" id="mail" value="<? echo $p->mail; ?>" />
            <br/>


            <input type="submit" class="ui-button ui-state-default ui-corner-all" name="guardar" id="guardar" value="Publicar" />
        

    </td>

   
</tr>
</table>
    </form>
</div>