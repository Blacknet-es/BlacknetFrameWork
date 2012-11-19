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
class clientes extends listado {

    public function __construct($filtro = '') {
        global $app;
        $c = new mysql($app);
        $consulta = 'SELECT id FROM clientes WHERE 1=1 ';

        if($filtro != ''){
            $consulta .= $filtro;
        }

        $res = $c->consulta($consulta);

        while ($row = $c->extarerArray($res)) {
            $p = new cliente($row['id']);
            $this->elementos[] = $p;
        }
    }

    

}

class cliente extends componente {

    var $id;
    var $empresa;
    var $contacto;
    var $mail;
    var $activo;
    var $orden;

    public function __construct($id) {
        global $app;
        $c = new mysql($app);
        if ($id != '') {
            $consulta = "SELECT * FROM clientes WHERE id = $id";

            $res = $c->consulta($consulta);

            $row = $c->extarerArray($res);

            $this->id = $id;
            $this->empresa = $row['empresa'];
            $this->contacto = $row['contacto'];
            $this->mail = $row['mail'];
            $this->activo = $row['activo'];
        } else {
            
            $this->id = '';
        }
    }

    public function __toString() {
        return $this->empresa;
    }


    public function guardar(){
        global $app;
        $c = new mysql($app);


        if ($this->id != ''){
             
            $c->consulta("UPDATE clientes SET empresa = '$this->empresa', contacto = '$this->contacto', mail = '$this->mail', activo = '$this->activo', orden= '$this->orden' WHERE id = $this->id");

        }
        else{
           
            $res = $c->consulta("SELECT MAX(id) as max FROM clientes");
            $row = $c->extarerArray($res);
            $max = $row['max'] + 1;
            $this->id = $max;
            $c->consulta("INSERT INTO clientes (id,empresa,contacto,mail,activo) VALUES ('$max','$this->empresa','$this->contacto','$this->mail','1')");
        }
        
    }

    public function eliminar(){
        global $app;
        $c = new mysql($app);
        $c->consulta("DELETE FROM clientes WHERE id = '$this->id'");
    }

}

?>
