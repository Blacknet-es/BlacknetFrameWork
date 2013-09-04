<div class="ui-widget" id="login">
    <h3 class="ui-widget-header ui-corner-top">Login de usuario</h3>
    <form id="form-login" class="ui-widget-content ui-corner-bottom" method="post" action="<? echo $app->ruta_admin; ?>/entorno.php?seccion=login&amp;accion=enviardatos">
        <table>
            <tr>
                <td width="30%"> Nick:</td>
                <td><input type="text" class="ui-widget-content ui-corner-all" name="nick" /></td>
            </tr>
            <tr>
                <td>Pass:</td>
                <td><input type="password" class="ui-widget-content ui-corner-all" name="pass" /></td>
            </tr>
        </table>
        <input type="button" id="enviar-login" value="Enviar" />
    </form>
</div>