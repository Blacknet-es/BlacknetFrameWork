<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class usuario extends component 
{
    var $id;
    var $nombre;
    var $nick;
    var $pass;
    var $mail;

    function  __construct() {
        
        $cookie = '';
        if (isset ($_COOKIE['diff_admin'])){
            $cookie = $_COOKIE['diff_admin'];
        }        

        $c = new mysql();
        $consulta = "SELECT * FROM usuario WHERE SHA1(ID) = '$cookie'";
        $res = $c->consulta($consulta);

        if ($c->numRows()){
            $row = $c->extarerArray($res);
            $this->id = $row['ID'];
            $this->nombre = $row['nombre'];
            $this->nick = $row['nick'];
            $this->pass = $row['pass'];
            $this->mail = $row['mail'];
        
            return 1;
        }

        else{
            $this->id = 0;
            $this->nombre = "Anónimo";

            return 0;
        }
    }

    function login($usuario,$clave){
        global $app;
        $c = new mysql($app);

        $cript = sha1($clave);
        $consulta = "SELECT * FROM usuario WHERE nick = '$usuario' AND pass = '$cript'";
        $res = $c->consulta($consulta);
        
        if($c->numFilas($res) > 0){
            $row = $c->extarerArray($res);
            $this->id = $row['ID'];
            $this->nombre = $row['nombre'];
            $this->nick = $row['nick'];
            $this->pass = $row['pass'];
            $this->mail = $row['mail'];

            //Creamos cookies segura
            $cript = sha1($this->id);
            setcookie('diff_admin', $cript);            

            return 1;
        }

        else{
            $this->id = 0;
            $this->nombre = "Anónimo";

            return 0;
        }
    }

    function logout(){
         
         setcookie('diff_admin', '000');
         unset($_COOKIE['diff_admin']);
    }
    function verAcciones(){
        
    }
}
