<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mysql
 * Clase para generar y controlar las consultas
 *
 * @author Jesus Muriel
 */
class mysql {

    private $tabla = "";
    private $where = "";
    private $order = "";
    private $order_mode = "";
    private $limit_first = "";
    private $limit_count = "";
    private $mysqli;
    private $result;

    public function __construct() {
        global $app;
        $this->mysqli = new mysqli($app->db_host, $app->db_user, $app->db_pass, $app->db_name);
        if ($this->mysqli->connect_errno) {
            throw new Exception ("Connect failed: %s\n", $this->mysqli->connect_error);
        }
        $this->mysqli->query("SET NAMES 'utf8'");
    }
    
    public function select($tabla){
        $this->tabla = $tabla;
        return $this;
    }
    
    public function where($where){
        $this->where = $where;
        return $this;
    }
    
    public function order($order, $order_mode = "DESC"){
        $this->order = $order;
        $this->order_mode = $order_mode;
        return $this;
    }
    
    public function limit ($first, $count = null){
        $this->limit_first = $first;
        $this->limit_count = $count;
        return $this;
    }
    
    public function exec()
    {
        $query = "";
        if ($this->tabla != "") {
            $query .= "SELECT * FROM $this->tabla ";
        } else {
            return false;
        }
        
        if ($this->where != "") {
            $query .= " WHERE $this->where ";
        }
        
        if ($this->order != "") {
            $query .= " ORDER BY $this->order $this->order_mode";
        }
        
        if ($this->limit_first != "" && $this->limit_count == null) {
            $query .= " LIMIT $this->limit_fisrt";
        } elseif ($this->limit_first != "" && $this->limit_count != "") {
            $query .= " LIMIT $this->limit_fisrt, $this->limit_count";
        }
        
        return $this->query($query);
    }
    
    public function query($query)
    {
        return $this->consulta($query);
    }

    public function consulta($consulta) {
        $result = $this->mysqli->query($consulta, MYSQLI_USE_RESULT);
        if (!$result) {
            throw new Exception ('MySQL Error: ' . $this->mysqli->error . '<br/>' . $consulta);
        }
        $this->numRows = $result->num_rows;
        $this->result = $result;
        return $this;
    }
    
    public function fetchOne()
    {
        return $this->result->fetch_object();
    }
    
    public function fetchAll()
    {
        $res = array();
        
        while ($obj = $this->result->fetch_object()) {
            $res[] = $obj;
        }
        return $res;
    }
    
    public function numRows()
    {
        return $this->numRows;
    }

}
?>
