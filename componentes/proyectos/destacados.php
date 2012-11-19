<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

$proyectos = new proyectos('','',1); /* Seleccionamos los proyectos destacados*/
?>
<ul class="thumbnails" id="destacados">
    
<? foreach ($proyectos->proyecto as $p): ?>
    <li style="background-color: <? echo $p->color; ?>;" class="span4 thumbnail">
    <img class="span12" src="<? echo $app->ruta_base; ?>/entorno.php?seccion=proyectos&amp;accion=recorte&amp;id=<? echo $p->img_principal; ?>" alt="<?=$p->metades?>"/>
    <div>
    <a href="<? echo $app->ruta_base; ?>/proyectos/ver/<? echo $p->id; ?>/<? echo urlAmigable($p->metades); ?>" class="bloque-img">
        
    </a>
    <div class="megusta">
    <script language="javascript" type="text/javascript">
	//<![CDATA[     
        document.write('<fb:like width="100" href="<? echo $app->ruta_base; ?>/proyectos/ver/<? echo $p->id; ?>/<? echo urlAmigable($p->metades); ?>" layout="button_count"></fb:like>');
	//]]>
    </script>        
    </div>
    
    <h3><? echo $p->verNombreCliente(); ?></h3>
    <p class="proyecto"><? echo htmlentities($p->nombre,ENT_QUOTES,"UTF-8"); ?></p>
    <div class="txt"><? echo truncarTexto($p->txt1,320); ?></div>
    <a class="btn" href="<? echo $app->ruta_base; ?>/proyectos/ver/<? echo $p->id; ?>/<? echo urlAmigable($p->metades); ?>">ver más</a>
    </div>
    </li>

<? endforeach; ?>
</ul>
<hr/>