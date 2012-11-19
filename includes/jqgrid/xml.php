<?php

/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */


function generarFiltro(jqgrid $j) {
    $wh = "";
    if (isset($_REQUEST['_search'])) {
        $searchOn = Strip($_REQUEST['_search']);
        if ($searchOn == 'true') {
            $sarr = Strip($_REQUEST);
            foreach ($sarr as $k => $v) {
                foreach ($j->campos as $campo) {
                    if ($campo->nombreTabla == $k && $campo->busqueda == true) {
                        $wh .= " AND $k LIKE '%$v%'";
                        //busqueda dentro del mismo modelo misma tabla SQL
                    }                     
                }
            }
        }
    }

    return $wh;
}

function generarOrdenacion(jqgrid $j) {

    if (isset($_GET['sidx'])):
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
    else:
        $sidx = $j->sortName;
    endif;

    if (isset($_GET['sord'])):
        $sord = $_GET['sord']; // get the direction
    else:
        $sord = $j->sortOrder;
    endif;
    
    return " ORDER BY $sidx $sord";
}

function generarPaginacion(jqgrid $j) { //solo si no hay relaciones 1-* *-*
    if (isset($_GET['page'])):
        $page = $_GET['page']; // get the requested page
    else:
        $page = 1;
    endif;

    if (isset($_GET['rows'])):
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
    else:
        $limit = $j->rowNum;
    endif;

    $start = ($page - 1) * $limit;

    if ($start == 0): $start = 0;
    endif;

    return " LIMIT " . $start . " , " . $limit . "";
}

function generarXML(jqgrid $j, listado $listadoCompleto) {

    //Filtramos los valores que buscamos dentro de otras tablas 1-*
    if (isset($_REQUEST['_search'])) {
        $searchOn = Strip($_REQUEST['_search']);
        if ($searchOn == 'true') {
            $sarr = Strip($_REQUEST);
            foreach ($sarr as $k => $v) {
                foreach ($j->campos as $campo) {
                    if ($campo->index == $k && $campo->busqueda == true) {
                        //Si el campo que buscamos es igual a alguno de los indices
                        
                        $i = 0;
                        
                        foreach($listadoCompleto->elementos as $e){
                            if(is_array($e->{$campo->nombreTabla})){
                                foreach($e->{$campo->nombreTabla} as $x){
                                    if(!stristr($x,$v)){
                                        unset($listadoCompleto->elementos[$i]);                                        
                                    }                                    
                                }                                 
                            }
                            else{
                                if(!stristr($e->{$campo->nombreTabla},$v)){
                                    unset($listadoCompleto->elementos[$i]);
                                }                                
                                   
                            }
                             $i++;
                        }
                        //buscamos si en los objetos asociados hay alguno
                        //que cumpla con el valor buscado
                        //Si no lo eliminamos con un pop del array
                        //busqueda dentro del mismo modelo misma tabla SQL
                    }
                }
            }
        }
    }

    /* COMPROBAMOS SI ESTAMOS FILTRANDO POR CATEGORÍA Y
     * MOSTRAMOS SOLO LOS ELEMENTOS PERTINENTES 
    if (isset($_GET['categorias'])){
        $i = 0;
        foreach($listadoCompleto->elementos as $e){
            if (is_array($e->categoria)){
                foreach($e->categoria as $c){
                    if ($_GET['categorias'] != $c->id){
                        unset($listadoCompleto->elementos[$i]);
                    }
                }
            }
            $i++;
        }
    }

    if (isset($_GET['categoria'])){
        $i = 0;
        foreach($listadoCompleto->elementos as $e){
            if ($_GET['categoria'] != $e->categoria){
                unset($listadoCompleto->elementos[$i]);
            }
            $i++;
        }
    }

    /* FINAL DE FILTRADO POR CATEGORIAS*/

    if (isset($_GET['page'])):
        $page = $_GET['page']; // obteniene la pagina
    else:
        $page = 1;
    endif;

    if (isset($_GET['rows'])):
        $limit = $_GET['rows']; // obtiene el numero de filas que se muestran pro pagina
    else:
        $limit = $j->rowNum; //valor por defecto de filar por pagina
    endif;

    $start = ($page - 1) * $limit;

    if ($start == 0): $start = 0;
    endif;

    $count = $listadoCompleto->numeroElementos();

    if ($count > 0) {
        $total_pages = ceil($count / $limit);
    } else {
        $total_pages = 0;
    }

    if ($page > $total_pages): $page = $total_pages;
    endif;

    $start = $limit * $page - $limit; // do not put $limit*($page - 1)
    if ($start == 0): $start = 1;
    endif;

    $listadoCompleto->elementos = array_slice($listadoCompleto->elementos, $start-1, $limit);


    $data = "<rows>
";
    $data .= "<page>" . $page . "</page>
";
    $data .= "<total>" . $total_pages . "</total>
";
    $data .= "<records>" . $count . "</records>
";

    $i = 1;

// be sure to put text data in CDATA
    foreach ($listadoCompleto->elementos as $e) {
        $data .= "<row id='" . $e->id . "'>
            ";
        foreach ($j->campos as $campo) {
            if ($e->existePropiedad($campo->nombreTabla)) {
                if ($campo->tipo == 'string') {
                    $data .= "<cell><![CDATA[ " . $e->{$campo->nombreTabla} . " ]]></cell>
                    ";
                }
                elseif($campo->tipo == 'array'){
                    $data .= "<cell><![CDATA[ ";
                    
                    foreach($e->{$campo->nombreTabla} as $c){ $data .= $c.','; }
                    $data = substr($data, 0,-1);
                    $data.=" ]]></cell>
                    ";
                }
                elseif($campo->nombreTabla == 'destacado' || $campo->nombreTabla == 'activo'){
                    if($e->{$campo->nombreTabla} == 1){
                        $data .= "<cell><![CDATA[<span class=\"ui-icon ui-icon-star\"></span>]]></cell>
                        ";
                    }
                    else{
                        $data .= "<cell><![CDATA[  ]]></cell>
                        ";
                    }

                }
                elseif ($campo->tipo == 'int') {
                    $data .= "<cell>" . $e->{$campo->nombreTabla} . "</cell>
                    ";
                }
            }
        }
        $i++;
        $data .= "</row>
    ";
    }

    $data .= "</rows>
";

    //header('Content-Type: text/xml');
    return $data;
}

function Strip($value) {
    if (get_magic_quotes_gpc() != 0) {
        if (is_array($value))
            if (array_is_associative($value)) {
                foreach ($value as $k => $v)
                    $tmp_val[$k] = stripslashes($v);
                $value = $tmp_val;
            }
            else
                for ($j = 0; $j < sizeof($value); $j++)
                    $value[$j] = stripslashes($value[$j]);
        else
            $value = stripslashes($value);
    }
    return $value;
}

function array_is_associative($array) {
    if (is_array($array) && !empty($array)) {
        for ($iterator = count($array) - 1; $iterator; $iterator--) {
            if (!array_key_exists($iterator, $array)) {
                return true;
            }
        }
        return!array_key_exists(0, $array);
    }
    return false;
}

