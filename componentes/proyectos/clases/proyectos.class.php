<?php
class proyectos extends collection {

    var $proyecto = array();

    public function __construct($id_categoria = '', $id_cliente = '', $destacado = '', $filtro = '') {
        global $app;
        $c = new mysql($app);
        $consulta = 'SELECT DISTINCT id FROM proyecto WHERE 1=1 ';

        if($id_categoria != ''){
            $consulta .= ' AND proyectoscategorias.id_categoria = '.$id_categoria;
        }

        if($id_cliente != ''){
            $consulta .= ' AND id_cliente = '.$id_cliente;
        }

        if($destacado != ''){
            $consulta .= ' AND destacado = '.$destacado;
        }

        if($filtro != ''){
            $consulta .= $filtro;
        }
        else{
            $consulta .= ' ORDER BY proyecto.order ASC ';
        }
        //echo $consulta.'<br/>';
        $res = $c->consulta($consulta);
        
        var_dump($res->fetchOne()); exit;

        while ($row = $c->extarerArray($res)) {
            $p = new proyecto($row['id']);
            $this->proyecto[] = $p;
        }

        $this->elementos = $this->proyecto;
    }

    
}
