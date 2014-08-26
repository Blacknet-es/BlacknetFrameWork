<?php
class collection 
{
    var $class;
    var $elements = array();
    
    public function __construct($class, $options = array())
    {
        if (!$class) {
            throw new Exception('Invalid name of class '.$class);
        }
        $this->class = $class;
        
        $sql = new mysql();
        
        $query = "SELECT * FROM $this->class";
        
        if (isset($options['filter'])) {
            $query .= " WHERE ".$options['filter'];
        }
        
        if (isset($options['order'])) {
            $query .= " ORDER BY ".$options['order'];
        } else {
            $query .= " ORDER BY created_at DESC";
        }
        
        $sql->query($query);
        
        $all = $sql->fetchAll();
        
        foreach ($all as $one) {
            $this->elements[] = new $this->class($one->id, array('data' => $one));
        }
    }

    public function countElements()
    {
        return count($this->elementos);
    }

    public function PropertyExists ($property) 
    {
        return property_exists($this, $propiedad);
    }
}
