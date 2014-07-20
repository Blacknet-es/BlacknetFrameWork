<?php
class collection 
{
    var $class;
    var $elements = array();
    
    public function __construct($class)
    {
        if (!$class) {
            throw new Exception('Invalid name of class '.$class);
        }
        $this->class = $class;
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
