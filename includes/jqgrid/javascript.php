<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */


function generarJavascript(jqgrid $j){
    global $app;
    $js = '<script type="text/javascript"  language="javascript">
        //<![CDATA[
        ';

    $js .= 'jQuery(document).ready(
    function(){
    ';

    $js .="jQuery('* #list').jqGrid({
            url:'$j->url',
            datatype: 'xml',
            mtype: 'GET',
            ";

    $js .= generarTitulos($j);
    $js .= generarCampos($j);

    $js .= generarPaginador($j);

    $js .= "rowNum: $j->rowNum,      
            autowidth: true,
            height: '100%',            
            pager: jQuery('#pager'),
            sortname: '$j->sortName',
            viewrecords: true,
            sortorder: '$j->sortOrder',
            toolbar : [true, 'top'],
            editurl: '$j->editUrl',
            caption: '$app->seccion',
        }).navGrid('#pager',{edit:false,add:false,del:false,search:false,refresh:false});

     ";
    
    $js .= "jQuery('#t_list').hide().filterGrid('list',{gridModel:true,gridToolbar:true});
        ";


    if($j->ordenable){
        $js .= '
    jQuery("#list").sortableRows({
        update: function(){
                    $listaIds = jQuery("#list").getDataIDs();
                    $.post("'.$app->ruta_admin.'/entorno.php?seccion='.$app->seccion.'&accion=ordenarfila",{lista: $listaIds}, function(data){
                    mostrar_mensaje(1,"La entrada se ha ordenado correctamente");
                });
        }

    });
    ';
    }

    $js .='
    jQuery("#bsdata").click
	(
	 function(){
	 	if(jQuery("#t_list").css("display")=="none") {
			jQuery("#t_list").css("display","");
			jQuery("#sg_retail_active").attr("value", "");
			jQuery("#sg_wholesale_active").attr("value", "");
		} else {
			jQuery("#t_list").css("display","none");
		}
	 }
	);

$("* #list").click(function(){
		var gr = jQuery("#list").getGridParam("selrow");
		if (gr != ""){
			$("#editar").attr("href","'.$app->ruta_admin.'?seccion='.$app->seccion.'&accion=editar&id=" + gr);
			$("#editar").removeAttr("onClick");
                        $("#eliminar").removeAttr("onClick");
                        $("#destacar").removeAttr("onClick");
                        //$("#eliminar").attr("onClick","$(\'#borrar\').dialog(\'open\')");
                        //$("#eliminarId").val(gr);
		}
});

$("#eliminar").click(function(){
		 var gr = jQuery("#list").getGridParam("selrow");
		 if( gr != null ){ 
                    $("* #list").delGridRow(gr,{reloadAfterSubmit: true, url: "'.$app->ruta_admin.'/entorno.php?seccion='.$app->seccion.'&accion=eliminar&id=" + gr });
                    mostrar_mensaje(1,"El elemento ha sido eliminado correctamente");
                }
});

$("#destacar").click(function(){
		 var gr = jQuery("#list").getGridParam("selrow");
		 if( gr != null ){
                    $.ajax({
                    type: "POST",
                    url: "'.$app->ruta_admin.'/entorno.php?seccion='.$app->seccion.'&accion=destacar&id=" + gr,
                    success: function(msg){
                        jQuery("#list").trigger("reloadGrid"); //recargamos el grid
                        mostrar_mensaje(1, "La entrada se ha destacado correctamente"); //Mostramos el mensaje de que se ha eliminado correctamente                        
                    }

                 });
                 
                }
});



$("* #publicar").click(function(){ $("form").submit(); });';

    $js .= "});
        //]]>
        </script>";

    return $js;

}

function generarPaginador(jqgrid $j){
    $lista = 'rowList:[';
    
    foreach ($j->rowList as $l){
        $lista .= "$l,";
    }
    $lista = substr($lista,0, -1);

    $lista .= '],
    ';

    return $lista;
}

function generarTitulos(jqgrid $j){
    $nombres = "colNames:[";

    foreach($j->campos as $campo){
       $nombres .= "'$campo->nombreColumna',";
   }
   $nombres = substr($nombres,0, -1);

    $nombres .= "],
    ";

    return $nombres;
}

function generarCampos(jqgrid $j){
   $model = 'colModel:[
   ';
   foreach($j->campos as $campo){
       if ($campo->busqueda){
           $buscar = "search: true";
       }
       else{
           $buscar = "search: false";
       }

       if($campo->editOptions != ''){
            $edit = "editoptions: $campo->editOptions";
       }
       else{
           $edit = '';
       }

       $imagen = '';
       if($campo->nombreTabla == 'destacado' || $campo->nombreTabla == 'activo'){
           $imagen = "align: 'center',";
       }
       
       $model .= "{name:'$campo->nombreTabla',index:'$campo->index', width: $campo->ancho, $imagen $buscar  $edit},
       ";
   }
                
   $model .= '],
   ';

   return $model;
}