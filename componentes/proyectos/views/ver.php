<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */


$p = new proyecto($app->id);
$categorias = new categorias();
$num = count($categorias->categoria);
$i = 1;

/* MENU ACTIVO */
$active = '';
foreach ($p->categorias as $cat){
    foreach ($categorias->categoria as $c){
        if ($cat == $c->nombre){
            $active = $c->id;
        }
    }
}


?>
<div id="submenu"><? foreach ($categorias->categoria as $c): ?>
        <a <? if($active == $c->id): ?>class="active"<? endif; ?> href="<? echo $app->ruta_base; ?>/<? echo $app->seccion; ?>/categoria/<? echo $c->id; ?>/<? echo urlencode($c->nombre); ?>"><? echo $c->nombre; ?></a>
        <? if ($i != $num): ?><span class="separador">&nbsp;</span><? endif; ?>
    <? $i++; endforeach; ?>
        <hr/>
</div>

<div id="proyecto">
	<?
       

        if(file_exists($app->ruta_absoluta.'/img/proyectos/'.$p->id.'/'.$p->img_principal.'.jpg')){
            $ruta_img = $app->ruta_base.'/img/proyectos/'.$p->id.'/'.$p->img_principal.'.jpg';
        }
        else{
            $ruta_img = $app->ruta_base.'/img/proyectos/'.$p->id.'/'.$p->img_principal.'.png';
        }

        ?>
    <img src="<? echo $ruta_img; ?>" alt="" width="618" />
    
    <? if (strlen($p->txt1) > 1): ?>
    <h2>Descripción:</h2>
    <div class="texto"><? echo $p->txt1; ?></div>
    <? endif; ?>
    
    <? if (count($p->img) > 0): ?>
    <div id="miniaturas">
    <? $contador = 1; ?>
    <? foreach($p->img as $i): ?>
        <?
        $img = new imgproyecto($i);

        if(file_exists($app->ruta_absoluta.'/img/proyectos/'.$p->id.'/'.$i.'.jpg')){
            $ruta_img = $app->ruta_base.'/img/proyectos/'.$p->id.'/'.$i.'.jpg';
        }
        else{
            $ruta_img = $app->ruta_base.'/img/proyectos/'.$p->id.'/'.$i.'.png';
        }

        ?>
        <a title="<? echo $img->nombre; ?>" class=" <? if (($contador % 3) == 1): ?>primero<? endif; ?>" href="<? echo $ruta_img ?>" rel="shadowbox[slide]" >
            <img src="<? echo $app->ruta_base; ?>/entorno.php?seccion=proyectos&amp;accion=recorte2&amp;id=<? echo $i; ?>" alt="" width="190" /><br/>
            <? echo $img->nombre; ?>
        </a>
    <? $contador++; ?>
    <? endforeach; ?>
    </div>
    <? endif; ?>
    <div class="texto"><? echo $p->txt2; ?></div>
     <p>
     <script language="javascript" type="text/javascript">
	//<![CDATA[     
    document.write('<fb:like show_faces="false" width="620" href="<? echo $app->ruta_base; ?>/proyectos/ver/<? echo $p->id; ?>/<? echo urlAmigable($p->metades); ?>"></fb:like>');
	//]]>
    </script>       
    </p><br/>
     
     <br/><br/>
</div>