<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?
if ($app->accion == 'nuevo') {
    $p = new categoria('');
    //$p->guardar();
}
elseif($app->accion == 'editar'){
    $p = new categoria($_GET['id']);
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
            <div>Nombre</div>
            <input type="text" class="titulo ui-widget-content ui-corner-all" name="nombre" id="nombre" value="<? echo $p->nombre; ?>" />
            <br/>

            

           

            <div>Servicio</div>
            <input type="text" class="ui-widget-content ui-corner-all" name="servicio" id="servicio" value="<? echo $p->servicio; ?>" />
            <br/>

            <fieldset class="ui-widget-content ui-corner-all">
                <legend>
                    Optimización posicionamiento buscadores
                </legend>

                <div>
                    Descripción META (optimización para buscadores)
                </div>
                <input type="text" class="ui-widget-content ui-corner-all" name="metades" id="metades" value="<? echo $p->metades; ?>" />

                <div>
                    Etiquetas meta separadas por comas (optimización para buscadores)
                </div>
                <input  type="text" class="ui-widget-content ui-corner-all" name="metatags" id="metatags" value="<? echo $p->metatags; ?>" />
                <br/>
            </fieldset>

            <div>Descripción</div>
            <textarea name="descripcion" class="ckeditor ui-widget-content ui-corner-all" rows="8" cols="66" id="descripcion"><? echo $p->descripcion; ?></textarea>
            <br/>
            <br/>


            <input type="submit" class="ui-button ui-state-default ui-corner-all" name="guardar" id="guardar" value="Publicar" />
        

    </td>

   
</tr>
</table>
    </form>
</div>