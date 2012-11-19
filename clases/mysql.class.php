<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mysql
 * Clase para generar y controlar las consultas
 *
 * @author Difusion Gráfica
 */
class mysql {

    private $conexion;
    private $total_consultas;

    public function mysql($app) {
        global $app;
        if (!isset($this->conexion)) {
            $this->conexion = (mysql_connect($app->db_host, $app->db_user, $app->db_pass)) or die(mysql_error());
            mysql_select_db($app->db_name, $this->conexion) or die(mysql_error());
            mysql_set_charset('utf8');
            mysql_query ("SET NAMES 'utf8'");
        }
    }

    public function consulta($consulta) {
        $this->total_consultas++;
        $resultado = mysql_query($consulta, $this->conexion);
        mysql_query ("SET NAMES 'utf8'");
         mysql_set_charset('utf8');
        if (!$resultado) {
            echo 'MySQL Error: ' . mysql_error() . '<br/>' . $consulta;
            exit;
        }
        
        return $resultado;
    }

    public function extarerArray($consulta) {
        return mysql_fetch_array($consulta);
    }

    public function numFilas($consulta) {
        return mysql_num_rows($consulta);
    }

    public function totalConsultas() {
        return $this->total_consultas;
    }

}
?>