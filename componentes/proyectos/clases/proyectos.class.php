<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of proyectos
 *
 * @author Difusion Gráfica
 */


class proyectos extends listado {

    var $proyecto = array();

    public function __construct($id_categoria = '', $id_cliente = '', $destacado = '', $filtro = '') {
        global $app;
        $c = new mysql($app);
        $consulta = 'SELECT DISTINCT id FROM proyectos,proyectoscategorias WHERE proyectos.id = proyectoscategorias.id_proyecto ';

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
            $consulta .= ' ORDER BY proyectos.orden ASC ';
        }
        //echo $consulta.'<br/>';
        $res = $c->consulta($consulta);

        while ($row = $c->extarerArray($res)) {
            $p = new proyecto($row['id']);
            $this->proyecto[] = $p;
        }

        $this->elementos = $this->proyecto;
    }

    
}


class proyecto extends componente {
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


class categoria extends componente {
    var $id;
    var $nombre;
    var $alias;
    var $orden;
    var $descripcion;
    var $servicio;


    public function  __construct($id) {
        global $app;

        if ($id != '') {
            $c = new mysql($app);
            $res = $c->consulta("SELECT * FROM categorias WHERE id = $id");
            $row = $c->extarerArray($res);

            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->servicio = $row['servicio'];
            $this->alias = $row['alias'];
            $this->orden = $row['orden'];
            $this->metades = $row['metades'];
            $this->metatags = $row['metatags'];
        }
    }

     public function __toString() {
        return $this->nombre;
    }

    public function guardar(){
        global $app;
        $c = new mysql($app);
        if ($this->id != ''){
            $c->consulta("UPDATE categorias SET nombre = '$this->nombre', descripcion = '$this->descripcion', servicio = '$this->servicio', alias = '$this->alias', orden = '$this->orden', metades = '$this->metades',metatags = '$this->metatags'  WHERE id = $this->id");
        }
        else{
            $c->consulta("INSERT INTO categorias (nombre,servicio,descripcion,alias,orden,metades,metatags) VALUES ('$this->nombre','$this->servicio','$this->descripcion','$this->alias','$this->orden','$this->metades','$this->metatags')");
        }
    }

    public function eliminar(){
        global $app;
        $c = new mysql($app);

        $c->consulta("DELETE FROM categorias WHERE id = '$this->id'");
    }
}


class imagenesproyecto extends listado{
     
    public function __construct($id_proyecto = '') {
        global $app;
        $c = new mysql($app);
        $consulta = "SELECT id FROM proyectosimagenes WHERE id_proyecto = $id_proyecto";

        $res = $c->consulta($consulta);

        while ($row = $c->extarerArray($res)) {
            $p = new imgproyecto($row['id']);
            $this->elementos[] = $p;
        }        
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

class imgproyecto extends imagen{
    var $id;
    var $id_proyecto;
    var $nombre;
    var $descripcion;
    var $principal;

    public function __construct($id = '') {
        global $app;
        if ($id != '') {
            $c = new mysql($app);
            $consulta = "SELECT * FROM proyectosimagenes WHERE id = '$id'";

            $res = $c->consulta($consulta);
            $row = $c->extarerArray($res);

            $this->id = $id;
            $this->nombre = $row['nombre'];            
            $this->id_proyecto = $row['id_proyecto'];
            $this->descripcion = $row['descripcion'];
            $this->principal = $row['principal'];
            $this->ruta = $row['ruta'];
            $this->w = $row['w'];
            $this->h = $row['h'];
            $this->x = $row['x'];
            $this->y = $row['y'];
            $this->x2 = $row['x2'];
            $this->y2 = $row['y2'];
        }
    }

    public function guardar(){
        global $app;
        $c = new mysql($app);
        if ($this->id != ''){
            $c->consulta("UPDATE proyectosimagenes SET nombre = '$this->nombre', descripcion = '$this->descripcion', principal = '$this->principal', id_proyecto = '$this->id_proyecto', ruta = '$this->ruta', x='$this->x', y='$this->y', x2='$this->x2', y2='$this->y2', w='$this->w', h='$this->h' WHERE id = $this->id");
        }
        else{
            $res = $c->consulta("SELECT MAX(id) as maxi FROM proyectosimagenes");
            $row = $c->extarerArray($res);
            $this->id = $row['maxi'] + 1;
            $c->consulta("INSERT INTO proyectosimagenes (id,id_proyecto,nombre,ruta,descripcion,principal,x,y,x2,y2,w,h) VALUES ('$this->id','$this->id_proyecto','$this->nombre','$this->ruta','$this->descripcion','$this->principal','$this->x','$this->y','$this->x2','$this->y2','$this->w','$this->h')");
        }
        return 1;
    }

    public function eliminar(){
        global $app;
        $c = new mysql($app);

        $c->consulta("DELETE FROM proyectosimagenes WHERE id = '$this->id'");
        @unlink($app->ruta_absoluta.'/img/proyectos/'.$this->id_proyecto.'/'.$this->id.'.jpg');
        @unlink($app->ruta_absoluta.'/img/proyectos/'.$this->id_proyecto.'/'.$this->id.'.png');
        @unlink($app->ruta_absoluta.'/img/proyectos/'.$this->id_proyecto.'crop/'.$this->id.'.jpg');
        @unlink($app->ruta_absoluta.'/img/proyectos/'.$this->id_proyecto.'crop/'.$this->id.'.png');
    }
    

}
?>