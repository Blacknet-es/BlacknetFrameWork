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
        if (in_array($var, $dates_values) || strstr($var, 'date') ) {
            $widget = 'datepicker';
        }
        
        $global_options = array(
            'name' => $var,
            'id' => $var,
            'block' => 'main',
        );
        
        if ($var == 'id' || strstr($var, '_at')) {
            $options['type'] = 'hidden';
            $widget = 'hidden';
        } else {
            $options['type'] = 'text';
        }
        
        $options = array_merge($global_options, $options);
        
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
        if ($this->exists($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
        
        return $this;
    }
    
    private function exists($id)
    {
        if ($this->id == null || $this->id == 0) {
            return false;
        }
        
        $sql = new mysql();
        $sql->query("SELECT id FROM $this->table WHERE id = $this->id");
        
        if ($this->numRows) {
            return true;
        }
        
        return false;       
    }
    
    private function getArrayValues()
    {
        $vars = array_keys(get_class_vars(get_class($this)));
        
        $values = array();
        
        foreach ($vars as $v) {
            if ($this->isBdValue($v)) {
                $values[$v] = "'".$this->{$v}."'";
            }
        }
        
        if (isset ($values['id'])) {
            $values['updated_at'] = 'NOW()';
        } else {
            $values['updated_at'] = 'NULL';
            $values['created_at'] = 'NOW()';
        }
        
        foreach ($values as $key => $val) {
            if ($val == null) {
                $values[$key] = 'NULL';
            }
        }
        
        return $values;
    }
    
    private function isBdValue($value)
    {
        $no_bd_properties = array ('table', 'config');
        if (in_array($value, $no_bd_properties)) {
            return false;
        }
        
        if ($value == 'id' && !$this->exists($this->id)) {
            return false;
        }
        
        $config = $this->config[$value]['options'];
        
        if (isset($config['nobd']) && $config['nobd'] === true) {
            return false;
        }
        
        return true;
    }
    
    private function update()
    {
        $sql = new mysql();
        $query = "UPDATE $this->table SET ";
        
        $values = $this->getArrayValues();
        
        $query .= implode(', ', $values);
        
        $query .= " WHERE id = $this->id";
        
        $sql->query($query);
    }
    
    private function insert()
    {
        $sql = new mysql();
        
        $values = $this->getArrayValues();
        
        $query = "INSERT INTO $this->table ";
        
        $query .= '( '. implode (', ', array_keys($values)). ' ) ';
        $query .= 'VALUES ( '. implode (', ', array_values($values)). ' ) ';
        
        $sql->query($query);
        
    }
    
    private function loadData()
    {
        $mysql = new mysql();
        $row = $mysql->query("SELECT * FROM $this->table WHERE id = $id");
        $vars = array_keys(get_class_vars(get_class($this)));
        
        foreach ($vars as $v) {
            if (isset($row->{$v})) {
                $this->{$v} = $this->setValue($v, $row->{$v});
            }
        }
    }
    
    public function getValue ($var, $value)
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
    
    public function setValue ($var, $value)
    {
        $this->{$var} = $value;
    }
    
    public function getFrom($block = 'main')
    {
        $html = '';
        $protected = array ('config', 'table');
        foreach ($this->config as $key => $field) {
            if (!in_array($key, $protected)) {
                $widget = $field['widget'];
                $options = $field['options'];
                
                if ($options['block'] === $block) {
                    $html .= $this->getWidget($widget, $this->{$key}, $options)->getTemplate();
                }
            }
        }
        
        return $html;
    }
    
    public function getWidget($field, $value, $options = array())
    {
        $widget = new $field($value, $options);
        return $widget;
    }
}
