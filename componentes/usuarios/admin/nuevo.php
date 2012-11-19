<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?
if ($app->accion == 'nuevo') {
    $p = new user('');
    //$p->guardar();
}
elseif($app->accion == 'editar'){
    $u = new usuario();
    $id = $u->id;
    $p = new user($id);
}

$acciones->titulo = ucfirst($app->accion) . ' usuario';
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
            <input type="text" class="titulo ui-widget-content ui-corner-all required" name="nombre" id="nombre" value="<? echo $p->nombre; ?>" />
            <br/>
           

            <div>Nick / nombre de usuario</div>
            <input type="text" class="ui-widget-content ui-corner-all required" name="nick" id="nick" value="<? echo $p->nick; ?>" />
            <br/>
            
            <div>Contraseña <? if ($app->accion != "nuevo"):?>(dejar en blanco si no desa cambiarla)<? endif; ?> (mínimo 5 caracteres)</div>
            <input type="password" class="ui-widget-content ui-corner-all <? if ($app->accion == "nuevo"):?>required<? endif; ?>" name="pass" id="pass" value="" />
            <br/>
            
            <div>Repetir contraseña</div
            <input type="password" class="ui-widget-content ui-corner-all <? if ($app->accion == "nuevo"):?>required<? endif; ?>" name="pass2" id="pass2" value="" />


            <div>Mail</div>
            <input type="text" class="ui-widget-content ui-corner-all required email" name="mail" id="mail" value="<? echo $p->mail; ?>" />
            <br/>


            <input type="submit" class="ui-button ui-state-default ui-corner-all" name="guardar" id="guardar" value="Publicar" />
        

    </td>

   
</tr>
</table>
    </form>
</div>