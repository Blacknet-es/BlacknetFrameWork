<?php

class proyecto extends componente 
{
    var $id;
    var $nombre;
    var $servicios = array();
    var $enlace;
    var $txt1;
    var $txt2;
    var $id_cliente;
    var $cliente;
    var $color;
    var $categorias = array();
    var $anio;
    var $orden;
    var $destacado;
    var $img_principal;
    var $img = array();

    function  __construct($id = '') {
        global $app;
        if ($id != '') {
            $c = new mysql($app);
            $res = $c->consulta("SELECT * FROM proyectos WHERE id = $id");
            $row = $c->extarerArray($res);

            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->servicios = explode(',', $row['servicios']);
            $this->enlace = $row['enlace'];
            $this->txt1 = $row['txt1'];
            $this->txt2 = $row['txt2'];
            $this->id_cliente = $row['id_cliente'];
            $this->color = $row['color'];
            $this->id = $row['id'];
            $this->anio = $row['anio'];
            $this->orden = $row['orden'];
            $this->destacado = $row['destacado'];
            //heredados de la clase componente
            $this->metades = $row['metades'];
            $this->metatags = $row['metatags'];

            $cli = new cliente($this->id_cliente);
            $this->cliente = $cli;

            $res = $c->consulta("SELECT * FROM proyectoscategorias where id_proyecto = $id");
            while ($row = $c->extarerArray($res)) {
                $cat = new categoria($row['id_categoria']);
                $this->categorias[] = $cat;
            }

            $res = $c->consulta("SELECT * FROM proyectosimagenes where id_proyecto = $id AND principal = 1");
            while ($row = $c->extarerArray($res)) {
                $cat = $row['id'];
                $this->img_principal = $cat;
            }

            $res = $c->consulta("SELECT * FROM proyectosimagenes where id_proyecto = $id AND principal != 1");
            while ($row = $c->extarerArray($res)) {
                $cat = $row['id'];
                $this->img[] = $cat;
            }
        }
        else{
            $c = new mysql($app);
            $res = $c->consulta("SELECT MAX(id) as maxi FROM proyectos");
            $row = $c->extarerArray($res);

            $this->id = $row['maxi'] +1;

            @mkdir($app->ruta_absoluta.'/img/proyectos/'.$this->id);
            chmod ($app->ruta_absoluta.'/img/proyectos/'.$this->id,0777);
        }
        
    }

    function  __toString() {
        return $this->nombre;
    }

    function verNombreCliente(){
        global $app;
        $c = new mysql($app);
        $res = $c->consulta("SELECT empresa FROM clientes WHERE id = $this->id_cliente");
        $row = $c->extarerArray($res);

        return $row['empresa'];
    }

    function numServicios(){
        $i = 0;
        foreach ($this->servicios as $s) {
            if($s != ''){
                $i++;
            }            
        }
        return $i;
    }

    function verServicios(){
        $listado = '';
        foreach ($this->servicios as $s) {
            if ($s != ''){
                $listado .= $s.',';
            }
        }

        $listado = substr($listado, 0, -1);
        return $listado;
    }

    function buscarCategoria($c){
        foreach ($this->categorias as $cat) {
            if ($cat->nombre == $c){
                return true;
            }
        }
        return false;
    }

    function verCategorias(){
        foreach ($this->categorias as $cat) {
            $c = $cat->nombre.', ';
        }
        return substr($c, 0, -2);
    }

    function guardar(){
        global $app;
        $c = new mysql($app);
        $servicios = '';
        foreach ($this->servicios as $s) {
            $servicios .= $s.',';
        }
        $servicios = substr($servicios,0, -1);
        $c->consulta("DELETE FROM proyectoscategorias WHERE id_proyecto = '$this->id'");
        

        if ($this->id != ''){
            $c->consulta("UPDATE proyectos SET id_cliente = '$this->id_cliente', nombre = '$this->nombre', servicios = '$servicios', txt1 = '$this->txt1', txt2 = '$this->txt2', enlace = '$this->enlace', color = '$this->color', destacado = '$this->destacado', orden = '$this->orden', metades = '$this->metades',metatags = '$this->metatags', anio = '$this->anio'  WHERE id = $this->id");
   
        }
        else{
            $res = $c->consulta("SELECT MAX(id) as max FROM proyectos");
            $row = $c->extarerArray($res);
            $max = $row['max'] + 1;
            $this->id = $max;
            $c->consulta("INSERT INTO proyectos (id,id_cliente,nombre,servicios,txt1,txt2,enlace,color,destacado,orden,metades,metatags,anio) VALUES ('$max','$this->id_cliente','$this->nombre','$servicios','$this->txt1','$this->txt2','$this->enlace','$this->color','$this->destacado','$this->orden','$this->metades','$this->metatags','$this->anio')");
        }
         
        foreach ($this->categorias as $categoria){
            $c->consulta("INSERT IGNORE INTO proyectoscategorias (id_proyecto,id_categoria) VALUES ('$this->id','$categoria->id')");
        }
        
    }

    public function eliminar(){
        global $app;
        $c = new mysql($app);
        $c->consulta("DELETE FROM proyectos WHERE id = '$this->id'");
        $c->consulta("DELETE FROM proyectoscategorias WHERE id_proyecto = '$this->id'");
        $c->consulta("DELETE FROM proyectosimagenes WHERE id_proyecto = '$this->id'");

        if ($this->id != ''){
            deldir($app->ruta_absoluta.'/img/proyectos/'.$this->id);
            deldir($app->ruta_absoluta.'/img/proyectos/'.$this->id.'crop');
        }
        
    }

}


class categorias extends listado {

    var $categoria = array();

    public function __construct($filtro = '') {
        global $app;
        $c = new mysql($app);
        $consulta = 'SELECT id FROM categorias WHERE 1=1 ';

        if($filtro != ''){
            $consulta .= $filtro;
        }
        else{
            $consulta .= ' ORDER BY categorias.orden ASC ';
        }

        $res = $c->consulta($consulta);

        while ($row = $c->extarerArray($res)) {
            $p = new categoria($row['id']);
            $this->categoria[] = $p;
        }

        $this->elementos = $this->categoria;
    }

    public function buscarNombre($nombre){
        foreach ($this->categoria as $c){
            if ($c->nombre == $nombre){
                return $c->id;
            }
            return 0;
        }
    }

}

