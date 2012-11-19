<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */

class usuarios extends listado{
    public function __construct($filtro = '') {
        global $app;
        $c = new mysql($app);
        $consulta = 'SELECT id FROM usuario WHERE 1=1 ';

        if($filtro != ''){
            $consulta .= $filtro;
        }

        $res = $c->consulta($consulta);

        while ($row = $c->extarerArray($res)) {
            $p = new usuario($row['id']);
            $this->elementos[] = $p;
        }
    }    
}

class user extends componente{
    var $id;
    var $nombre;
    var $nick;
    var $pass;
    var $mail;

    public function __construct($id) {
        global $app;
        $c = new mysql($app);
        $consulta = "SELECT * FROM usuario WHERE ID = '$id'";
        $res = $c->consulta($consulta);

        if ($c->numFilas($res) > 0){
            $row = $c->extarerArray($res);
            $this->id = $row['ID'];
            $this->nombre = $row['nombre'];
            $this->nick = $row['nick'];
            $this->pass = $row['pass'];
            $this->mail = $row['mail'];

            return 1;
        }
    }

    public function guardar(){
        global $app;
        $c = new mysql($app);

        if ($this->id != ''){            
            $c->consulta("UPDATE usuario SET nombre = '$this->nombre', nick = '$this->nick', mail = '$this->mail', pass = '$this->pass' WHERE ID = $this->id");

        }
        else{

            $res = $c->consulta("SELECT MAX(id) as max FROM usuario");
            $row = $c->extarerArray($res);
            $max = $row['max'] + 1;
            $this->id = $max;
            $this->pass = sha1($this->pass);
            $c->consulta("INSERT INTO usuario (id,nombre,nick,mail,pass) VALUES ('$max','$this->nombre','$this->nick','$this->mail','$this->pass')");
        }
    }


    public function eliminar(){
        global $app;
        $c = new mysql($app);
        $c->consulta("DELETE FROM usuario WHERE id = '$this->id'");
    }
}