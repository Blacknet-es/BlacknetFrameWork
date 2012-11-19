<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */
mostrarComponente($app->seccion,'menu');
?>
<form  id="contactForm" action="<? echo $app->ruta_base; ?>/info/contactoEnviar" method="post" enctype="multipart/form-data">
    <label>Tipo de consulta: </label>
    <select name="consulta" id="consulta">
        <option value="2">Solicitud de presupuesto</option>
        <option value="1">Solicitud de empleo</option>        
        <option value="3">Consulta técnica</option>
        <option value="4">Información sobre productos o servicios</option>
    </select>
    <br/><br/>
    <label style="width: 46px;">Nombre: </label>
    <input class="required" type="text" name="nombre" style="width: 218px; margin-right: 50px;" />

    
    <label style="width: 60px;">Empresa: </label>
    <input class="required" type="text" name="empresa" style="width: 204px;" />

    <br/><br/>
    <label style="width: 118px;">Teléfono de contacto: </label>
    <input class="required number" type="text" name="telefono" style="width: 146px; margin-right: 50px;" />

    
    <label style="width: 46px;">Email: </label>
    <input class="required email" type="text" name="mail" style="width: 218px;" />

    <br/><br/>
    <label style="width: 56px;">Provincia: </label>
    <input class="required" type="text" name="provincia" style="width: 208px; margin-right: 50px;" />

    
    <label style="width: 62px;">Población: </label>
    <input class="required" type="text" name="poblacion" style="width: 202px;" />
    
    <br/><br/>
    <label>Archivo adjunto: </label>
    <input class="" type="file" name="adjunto" />

    
    <br/><br/>
    <label>Mensaje: </label>
    <textarea cols="80" rows="12" class="required" name="texto"></textarea>

    
    
    <input type="submit" value="Enviar" />

</form>