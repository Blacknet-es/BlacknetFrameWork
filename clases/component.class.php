<?php
/**
 * Esta clase generaliza todos los componentes que se agregaran.
 * Cada componente debe extender de este.
 *
 * @author Jesús Muriel
 */
class component {
    
    var $id;
    var $order;
    var $name;
    var $metades;
    var $metatags;
    var $created_at;
    var $updated_at;
    private $config;
    var $table;
    
    public function __construct ($id = null)
    {
        $this->table = get_class($this);
        if ($id != null) {
            $this->id = $id;
            $this->loadData();            
        }
    }

    public function existePropiedad($propiedad){
        return property_exists($this, $propiedad);
    }
    
    private function config ()
    {
        $vars = get_class_vars(get_class($this));
        
        foreach ($vars as $v) {
            if (!isset($config[$v])) {
                $this->addWidget($v);
            }
        }
    }
    
    private function addWidget($var, $widget = 'inputtext', $options = array())
    {
        $this->config[$var] = array (
            'widget' => $widget,
            'options' => $options
        );
    }
    
    public function createTable ()
    {
        //make in the future
    }
    
    public function updateTable ()
    {
        //make in the future
    }
    
    public function save ()
    {
    
    }
    
    private function loadData()
    {
        $mysql = new mysql();
        $row = $mysql->query("SELECT * FROM $this->table WHERE id = $id");
        $vars = get_class_vars(get_class($this));
        
        foreach ($vars as $v) {
            if (isset($row->{$v})) {
                $this->{$v} = $this->getValue($v, $row->{$v});
            }
        }
    }
    
    private function getValue ($var, $value)
    {
        $direct_values = array ('inputtext', 'textarea');
        $dates_values = array ('date', 'datetime');
        
        //Direct Values
        if (in_array($this->config[$var], $direct_values)) {
            return $value;
        }
        
        //Dates Values
        if (in_array($this->config[$var], $dates_values) || strstr($var, '_at') || strstr($var, 'date') ) {
            return new DateTime($value);
        }
        
        return $value;
    }
}
