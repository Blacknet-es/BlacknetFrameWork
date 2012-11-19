<div id="win_eliminar" class="ui-corner-all ui-state-default" style="height:40px; width: 500px; position: absolute; top: 50%; left: 50%; margin-left: -250px; z-index: 9999; display: none;">
</div>

<div id="barra_acciones" class="ui-corner-all ui-widget-content ui-jqgrid-hdiv">
    <h1><? echo $this->titulo; ?></h1>

    <? if ($app->accion == "nuevo" || $app->accion == "editar"): ?>
    <!-- acciones para cuando se crea o edita un elemento -->
        <a href="#" class="ui-widget-content izq" id="publicar2">Publicar</a>
    <? else: ?>

        <? if (!isset($izqda)): ?>

            <? if($this->tipo == 'listado'): ?>
            <!-- acciones de la izquierda para componentes de tipo listado -->

                <? if ($this->btn_nuevo): ?>
                    <a class="izq" id="nuevo" href="<? echo $app->ruta_admin; ?>?seccion=<? echo $app->seccion; ?>&amp;accion=nuevo">Nueva</a>
                <? endif; ?>

                <? if ($this->btn_edit): ?>
                    <a class="izq" href="#" id="editar" onclick="mostrar_mensaje(2,'Seleccione una entrada para editarla');">Editar</a>
                <? endif; ?>

                <a class="izq" href="#" id="bsdata">Buscar</a>

                <? if ($this->btn_destacado): ?>
                    <a class="izq destacar" href="#" id="destacar" onclick="mostrar_mensaje(2,'Seleccione una entrada para destacarla');" >Destacar</a>
                <? endif; ?>

                <? if ($this->btn_eliminar): ?>
                    <a href="#" class="izq eliminar" id="eliminar" onclick="mostrar_mensaje(2,'Seleccione una entrada para eliminarla');">Eliminar</a>
                <? endif; ?>

            <? endif; ?>
        <? else: ?>
        <!-- acciones de la izquierda para componentes de tipo galería -->

            <? if ($_GET['galeria'] != ""): //Mostramos los iconos de las imagenes si no estamos en la raiz ?>
                <? if ($g->padre == null): ?>
                    <a href="<? echo $app->ruta_base; ?>?seccion=<? echo $app->seccion; ?>&amp;accion=nuevo&amp;ruta=<? echo $g->ruta; ?>/<? echo $g->nombre; ?>" class="ui-widget-content izq">Subir imagen</a>

                    <? if ($numImg != 0): //Mostramos las opciones para editar y eliminar unicamente si hay imagenes ?>
                        <a href="#" id="editar" class="ui-widget-content izq editar">Editar imagen</a>
                        <a href="#" class="ui-widget-content izq eliminar" id="eliminar">Eliminar imagen</a>
                    <? endif; ?>
                <? endif; ?>
            <? endif; ?>

            <? if ($_GET['galeria'] == ""): ?>

                <a href="<? echo $GB_RUTA_BASE; ?>?seccion=<? echo $seccion; ?>&amp;accion=nuevo&amp;galeria=<? echo $g->ruta; ?>/<? echo $g->nombre; ?>" class="ui-widget-content izq">Crear Subgaler&iacute;a</a>

            <? endif; ?>
            <? if ($total != 0): //Mostramos las opciones para editar y eliminar unicamente si hay imagenes ?>
                <a href="#" id="editarGal" class="ui-widget-content izq editarGal">Editar galer&iacute;a</a>
                <a href="#" class="ui-widget-content izq eliminarGal" id="eliminarGal">Eliminar galer&iacute;a</a>
            <? endif; ?>

        <? endif; ?>
    <? endif; ?>

    <!-- Elementos de la parte derecha -->
    <a class="drcha" href="#" id="reporte_link">Reportar error</a>
    <a class="drcha" href="#" id="actualizar" onclick="location.reload();">Actualizar</a>
</div>


<div id="reporte" title="Enviar Reporte de error">
    <h2>Informe de error</h2>
    <table width="100%">
        <tr>
            <td width="50%">Aplicaci&oacute;n</td>
            <td><? echo $app->nombre_app; ?></td>
        </tr>
        <tr>
            <td width="50%">Secci&oacute;n</td>
            <td><? echo ucfirst($app->seccion); ?></td>
        </tr>

        <tr>
            <td width="50%">Acci&oacute;n</td>
            <td><? echo ucfirst($app->accion); ?></td>
        </tr>

    </table>

    Descripci&oacute;n:
    <form method="post" action="<? echo $app->ruta_admin; ?>/entorno.php?seccion=reportes" id="reporte_form">
        <input type="hidden" name="app" value="<? echo $app->nombre_app; ?>" />
        <input type="hidden" name="seccion" value="<? echo $app->seccion; ?>" />
        <input type="hidden" name="accion" value="<? echo $app->accion; ?>" />
        <textarea id="reporte_text" class="ui-corner-all ui-state-default" name="descripcion" style="width:550px; height: 80px;">
        </textarea>
    </form>
</div>


<div id="borrar" title="Eliminar entrada" style="display:none;">
    <form id="eliminarEntrada" action="<? echo $app->ruta_admin; ?>/entorno.php?seccion=<? echo $app->seccion; ?>&amp;accion=eliminar" method="post">
        <input type="hidden" name="id" id="eliminarId" value="" />
    </form>
    &iquest;Est&aacute; seguro de eliminar la entrada?
</div>

<div id="borrarEl" title="Eliminar entrada" style="display:none;">
&iquest;Est&aacute; seguro de eliminar la entrada?
</div>