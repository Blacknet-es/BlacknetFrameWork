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

    private $tabla;
    private $where;
    private $order;
    private $order_mode;
    private $limit_first;
    private $limit_count;
    private $conexion;

    public function mysql($app) {
        global $app;
        if (!isset($this->conexion)) {
            $this->conexion = (mysql_connect($app->db_host, $app->db_user, $app->db_pass)) or die(mysql_error());
            mysql_select_db($app->db_name, $this->conexion) or die(mysql_error());
            mysql_set_charset('utf8');
            mysql_query ("SET NAMES 'utf8'");
        }
    }
    
    public function select($tabla){
        $this->tabla = $tabla;
        return $this;
    }
    
    public function where($where){
        $this->where = $where;
    }
    
    public function order($order,$order_mode){
        $this->order = $order;
        $this->order_mode = $order_mode;
    }
    
    public function limit ($first,$count){
        $this->limit_first = $first;
        $this->limit_count = $count;
    }

    public function consulta($consulta) {
        $resultado = mysql_query($consulta, $this->conexion);
        mysql_query ("SET NAMES 'utf8'");
         mysql_set_charset('utf8');
        if (!$resultado) {
            echo 'MySQL Error: ' . mysql_error() . '<br/>' . $consulta;
            exit;
        }
        
        return $resultado;
    }

    //corrección del error tipográfico
    public function extarerArray($consulta) {
        $this->extraerArray($consulta);
    }
    
    public function extraerArray($consulta){
        return mysql_fetch_array($consulta);
    }

    public function numFilas($consulta) {
        return mysql_num_rows($consulta);
    }

}
?>