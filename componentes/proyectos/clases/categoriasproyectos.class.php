<?php

class categoria extends component 
{
    var $id;
    var $nombre;
    var $alias;
    var $orden;
    var $descripcion;
    var $servicio;


    public function  __construct($id = null) 
    {
        parent::__construct($id);
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

