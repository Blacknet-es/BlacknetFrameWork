<?php
/**
 * Esta clase generaliza todos los componentes que se agregaran.
 * Cada componente debe extender de este.
 *
 * @author Jesús Muriel
 */
class component {
    
    var $id;
    var $orden;
    var $table;
    var $nombre;
    var $metades;
    var $metatags;
    var $created_at;
    var $updated_at;
    private $config;
    
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
    
    private function addWidget($var, $widget = 'inputtext')
    {
        $this->config[$var] = array (
            'widget' => $widget,
        );
    }
    
    private function getValue($field, $value)
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
}
