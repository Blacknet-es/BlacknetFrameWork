<?php
class registros extends collection 
{
    public function __construct($limit = "") {
        global $app;
        $c = new mysql($app);
        $res = $c->consulta("SELECT * FROM registro ORDER BY fecha DESC $limit");

        while ($row = $c->extarerArray($res)){
            $l = new registro($row['id_usuario'], $row['accion']);
            $l->fecha = $row['fecha'];
            $this->listado[] = $l;
        }
    }

    public function listarUsuario($id_usuario){
        foreach ($listado as $l) {
            if($l->id_usuario == $id_usuario){
                $lista[] = $l;
            }
        }

        return $lista;
    }
}

class registro {
    var $id_usuario;
    var $accion;
    var $fecha;

    function  __construct($id_usuario, $accion) {
        $this->accion = $accion;
        $this->id_usuario = $id_usuario;
        $this->fecha = time();
    }

    function guardar(){
        global $app;
        $c = new mysql($app);
        $c->consulta("INSERT INTO registro (id_usuario,accion,fecha) VALUES ('$this->id_usuario','$this->accion',NOW())");
    }

    function verNombreUsuario(){
        global $app;
        $c = new mysql($app);

        $res = $c->consulta("SELECT * FROM usuario WHERE ID = $this->id_usuario");

        $row = $c->extarerArray($res);

        return $row['nombre'];

    }
}
