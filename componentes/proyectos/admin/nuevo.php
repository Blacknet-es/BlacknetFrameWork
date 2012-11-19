<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?
if ($app->accion == 'nuevo') {
    $p = new proyecto('');
    $p->guardar();
}
elseif($app->accion == 'editar'){
    $p = new proyecto($_GET['id']);
}

$acciones->titulo = ucfirst($app->accion) . ' proyecto';
?>
<? echo $acciones->mostrarHtml(); ?>

<div class="ui-corner-all ui-widget-content" id="form" >
    <form  class="form" name="form" method="post" action="<? echo $app->ruta_admin; ?>/index.php?seccion=<? echo $app->seccion; ?>&amp;accion=procesar" enctype="multipart/form-data">
        
<table width="100%">
  <tr>
    <td id="bloque-form">
            <input type="hidden" name="id" value="<? echo $p->id; ?>" />
            <input type="hidden" name="accion" value="<? echo $app->accion; ?>" />

            <div>Nombre del proyecto</div>
            <input type="text" class="titulo ui-widget-content ui-corner-all" name="nombre" id="nombre" value="<? echo $p->nombre; ?>" />
            <br/>

            <div>Texto 1:</div>
            <textarea name="txt1" class="ckeditor ui-widget-content ui-corner-all" rows="8" cols="66" id="txt1"><? echo $p->txt1; ?></textarea>
            <br/>
            <br/>

            <div>Texto 2 (Opcional):</div>
            <textarea name="txt2" class="ckeditor ui-widget-content ui-corner-all" rows="8" cols="66" id="txt2"><? echo $p->txt2; ?></textarea>
            <br/>
            <br/>

            <div>Servicios (separados por comas)</div>
            <input type="text" class="ui-widget-content ui-corner-all" name="servicios" id="servicios" value="<? echo $p->verServicios(); ?>" />
            <br/>

             <div>Enlace (Sin http)</div>
            <input type="text" class="ui-widget-content ui-corner-all" name="enlace" id="enlace" value="<? echo $p->enlace; ?>" />
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

            <fieldset class="ui-widget-content ui-corner-all">
                <legend>
                    Imagen principal
                </legend>
                <table width="100%">
                    <tr>
                        <td>
                            <a href="javascript:void(0)" id="imagen" class="boton" onclick="jcropOpen('img/proyectos/<? echo $p->id; ?>&amp;principal=1&amp;id_proyecto=<? echo $p->id; ?>')">Subir Imagen principal</a>
                        </td>
                        <td><img src="<? echo $app->ruta_img; ?>/productos/<? echo $p->id; ?>/principal.jpg" height="200"   alt="" /></td>
                    </tr>
                </table>
            </fieldset>

            <input type="submit" class="ui-button ui-state-default ui-corner-all" name="guardar" id="guardar" value="Publicar" />
        

    </td>

    <td id="barra-widgets">

        <!-- WIDGET SUBCATEGORIA -->
        <div id="categoria" class="ui-widget">
            <h3 class="ui-widget-header ui-corner-top ">Categorias</h3>
            <div class="ui-widget-content ui-corner-bottom ">
                Elija la categoría y subcategoría del producto<br/><br/>
                <table width="100%">
                <?
                $categorias = new categorias();
                foreach ($categorias->elementos as $c):
                ?>
                    <tr><td><? echo $c->nombre; ?>:</td><td> <input name="cat[]" type="checkbox" <? if($p->buscarCategoria($c->nombre)): ?>checked="checked"<? endif; ?> value="<? echo $c->id; ?>" /></td></tr>
                <? endforeach; ?>
                </table>
            </div>
        </div>
        <!-- FIN WIDGET SUBCATEGORIA -->

        <!-- WIDGET Cliente -->
        <div id="cliente" class="ui-widget">
            <h3 class="ui-widget-header ui-corner-top ">Clientes</h3>
            <div class="ui-widget-content ui-corner-bottom ">
                Elija el cliente asociado al producto<br/><br/>
                <select name="cliente">
                <?
                $clientes = new clientes();
                foreach ($clientes->elementos as $c):
                ?>
                    <option <? if($c->id == $p->id_cliente): ?>selected="selected"<? endif; ?> value="<? echo $c->id; ?>"><? echo $c->empresa; ?></option>
                <? endforeach; ?>
                </select>
            </div>
        </div>
        <!-- FIN WIDGET cliente -->

         <!-- WIDGET COLOR -->
        <div id="color" class="ui-widget">
            <h3 class="ui-widget-header ui-corner-top ">Color</h3>
            <div class="ui-widget-content ui-corner-bottom ">
                Elija el color que reprersentará al proyecto<br/><br/>
                <input type="text" value="<? echo $p->color; ?>" name="color" class="widget-color"  />
               
            </div>
        </div>
        <!-- FIN WIDGET COLOR -->

        <!-- WIDGET ANIO -->
        <div id="anio" class="ui-widget">
            <h3 class="ui-widget-header ui-corner-top ">Año</h3>
            <div class="ui-widget-content ui-corner-bottom ">
               Intruduzca el año en el que se realizó el proyecto<br/><br/>
               <input type="text" value="<? echo $p->anio; ?>" name="anio" />
            </div>
        </div>
        <!-- FIN WIDGET AÑO -->

        <!-- WIDGET IMAGENES -->
        <div id="imagenes" class="ui-widget">
            <h3 class="ui-widget-header ui-corner-top ">Imágenes</h3>
            <div class="ui-widget-content ui-corner-bottom ">
               Introduzca las imágenes del proyecto<br/><br/>
               <a href="javascript:void(0)" id="imagen" class="boton" onclick="jcropOpen('img/proyectos/<? echo $p->id; ?>&amp;id_proyecto=<? echo $p->id; ?>')">Subir Imagen de detalle</a>
               <div id="lista_imagenes" class="lista">
                   <hr/>
                   <h4>Listado de imágenes</h4><br/>
                   <? $imagenes = new imagenesproyecto($p->id); ?>
                   <ul>
                       <? foreach($imagenes->elementos as $imagen): ?>
                       <li class="ui-widget ui-widget-content ui-state-default ui-corner-all <? if($imagen->principal): ?>principal<? endif; ?>" id="item_<? echo $imagen->id; ?>">
                               <? echo $imagen->nombre;  ?>
                               <a class="boton eliminar_adjunto" href="javascript:void(0)" id="imagenes_<? echo $imagen->id; ?>"><span class="ui-icon ui-icon-close"></span></a>
                             <!--  <a class="boton" href="#imagenes" onclick="jcropOpen('img/proyectos/<? echo $p->id; ?>&amp;id_proyecto=<? echo $p->id; ?>&amp;id_imagen=<? echo $imagen->id; ?>')" id="imagenes_<? echo $imagen->id; ?>"><span class="ui-icon ui-icon-pencil"></span></a> -->
                       </li>
                       <? endforeach; ?>
                   </ul>
               </div>
            </div>
        </div>
        <!-- FIN WIDGET IMAGENES -->

    </td>
</tr>
</table>
    </form>
</div>