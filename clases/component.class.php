<?php
/**
 * Esta clase generaliza todos los componentes que se agregaran.
 * Cada componente debe extender de este.
 *
 * @author Jesús Muriel
 */
class component {
    
    var $id;
    var $created_at;
    var $updated_at;
    var $order;
    public $config;
    var $table;
    
    public function __construct ($id = null)
    {
        $this->table = get_class($this);
        if ($id != null) {
            $this->id = $id;
            $this->loadData();            
        }
        
        $this->config();
    }

    public function existePropiedad($propiedad){
        return property_exists($this, $propiedad);
    }
    
    public function config()
    {
        $vars = array_keys(get_class_vars(get_class($this)));
        
        $order = 10;
        
        foreach ($vars as $v) {                
            $options = array(
                'order' => $order,
            );

            $this->addWidget($v, 'inputtext', $options);
            $order += 10;
        }
    }
    
    protected function addWidget($var, $widget = 'inputtext', $options = array())
    {
        $dates_values = array ('date', 'datetime');
        
        //Dates Values
        if (in_array($var, $dates_values) || strstr($var, '_at') || strstr($var, 'date') ) {
            $widget = 'datepicker';
        }
        
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
    
    public function getFrom()
    {
        foreach ($this->config as $key => $field) {
            $widget = $field['widget'];
            $options = $field['options'];
            $this->getWidget($widget, $this->{$key}, $options)->getTemplate();
        }
    }
    
    public function getWidget($field, $value, $options = array())
    {
        $widget = new $field($value, $options);
        return $widget;
    }
}
