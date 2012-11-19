<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clientes
 *
 * @author javi
 */
class enlaces extends listado {

    public function __construct($filtro = '') {
        global $app;
        $c = new mysql($app);
        $consulta = 'SELECT id FROM enlaces WHERE 1=1 ';

        if($filtro != ''){
            $consulta .= $filtro;
        }

        $res = $c->consulta($consulta);

        while ($row = $c->extarerArray($res)) {
            $p = new enlace($row['id']);
            $this->elementos[] = $p;
        }
    }

    

}

class enlace extends componente {

    var $id;
    var $nombre;
    var $vinculo;
    var $descripcion;
    var $orden;

    public function __construct($id) {
        global $app;
        $c = new mysql($app);
        if ($id != '') {
            $consulta = "SELECT * FROM enlaces WHERE id = $id";

            $res = $c->consulta($consulta);

            $row = $c->extarerArray($res);

            $this->id = $id;
            $this->nombre = $row['nombre'];
            $this->vinculo = $row['vinculo'];
            $this->descripcion = $row['descripcion'];
            $this->orden = $row['orden'];
            
        } else {
            
            $this->id = '';
        }
    }

    public function __toString() {
        return $this->nombre;
    }


    public function guardar(){
        global $app;
        $c = new mysql($app);


        if ($this->id != ''){
             
            $c->consulta("UPDATE enlaces SET nombre = '$this->nombre', vinculo = '$this->vinculo', descripcion = '$this->descripcion', orden = '$this->orden' WHERE id = $this->id");
            
        }
        else{
           
            $res = $c->consulta("SELECT MAX(id) as max FROM enlaces");
            $row = $c->extarerArray($res);
            $max = $row['max'] + 1;
            $this->id = $max;
            $c->consulta("INSERT INTO enlaces (id,nombre,vinculo,descripcion) VALUES ('$max','$this->nombre','$this->vinculo','$this->descripcion')");
            
        }
        
    }

    public function eliminar(){
        global $app;
        $c = new mysql($app);
        $c->consulta("DELETE FROM enlaces WHERE id = '$this->id'");
    }

}

?>
