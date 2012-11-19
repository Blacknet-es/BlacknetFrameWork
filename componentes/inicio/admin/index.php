<div class="clear"></div>
<table id="inicio" width="100%" class="ui-widget">
    <tr>
        <td width="40%" valign="top" class="ui-widget-content ui-corner-all">
            <div class="ui-widget-header ui-corner-all">
                <h3>Panel de control</h3>
            </div>
            <div class="panel">
                <div id="estadisticas">
                    <h4>Sumario</h4>
                    <p class="ui-widget ui-widget-header ui-corner-all">
                        <? $ps = new proyectos(); echo count($ps->elementos);?> proyectos
                        <span class="ui-icon ui-icon-folder-collapsed"></span>
                    </p>
                    
                    <p class="ui-widget ui-widget-header ui-corner-all">
                        <? $ps = new clientes(); echo count($ps->elementos);?> clientes
                        <span class="ui-icon ui-icon-person"></span>
                    </p>
                    
                    <p class="ui-widget ui-widget-header ui-corner-all">
                        <? $ps = new categorias(); echo count($ps->elementos);?> categorías
                        <span class="ui-icon ui-icon-bookmark"></span>
                    </p>
                    
                    <p class="ui-widget ui-widget-header ui-corner-all">
                        <? $ps = new enlaces(); echo count($ps->elementos);?> enlaces
                        <span class="ui-icon ui-icon-link"></span>
                    </p>

                    <p class="ui-widget ui-widget-header ui-corner-all">
                        <? $ps = new registros(); echo count($ps->listado);?> operaciones
                        <span class="ui-icon ui-icon-script"></span>
                    </p>
                </div>
                <div class="clear"><br/></div>
                <hr/>
                
            </div>
        </td>

        <td valign="top">
            <div id="solapas" >
                <ul>
                    <li><a href="#tabs-1">Introducci&oacute;n</a></li>
                    <li><a href="#tabs-2">Registro</a></li>                    
                    <li><a href="#tabs-4">Acerca de</a></li>
                </ul>
                <div id="tabs-1">
                    <h3>Panel de administraci&oacute;n</h3>
                    <p>Mediante este panel de administraci&oacute;n podr&aacute; introducir y actualizar todo el contenido din&aacute;mico de su web a tiempo real.</p>
                    <p>A trav&eacute;s del menu superior o del panel de iconos podr&aacute; acceder a las distintas secciones y administrar desde all&iacute; su contenido.</p>
                    <p>Para realizar cualquier acci&oacute;n permitida por el panel s&oacute;lo tendr&aacute; que presionar en el icono correspondiente del panel de acciones.</p>
                    <p>Para notificar de cualquier tipo de error puede hacerlo a trav&eacute;s del icono eviar reporte. Las ventajas de utilizar este m&eacute;todo es que adem&aacute;s de ser m&aacute;s r&aacute;pido que una llamada telef&oacute;nica, se enviar&aacute; a nuestro departamento t&eacute;cnico informaci&oacute;n adiccional sobre como ha ocurrido el error.</p>
                </div>
                <div id="tabs-2">
                    <? echo mostrarComponenteAdmin("inicio","registro"); ?>
                </div>               
                <div id="tabs-4">
                    <p>Panel de administraci&oacute;n.</p>
                    <p>Este panel ha sido dise&ntilde;ado y desarrollado por <a href="http://www.difusiongrafica.com" target="_blank">Difusi&oacute;n Gr&aacute;fica</a> usando las &uacute;ltimas tecnonog&iacute;as web y las pautas de seguridad establecidas.</p>
                    <p></p>
                </div>
            </div>
        </td>

    </tr>

    
</table>