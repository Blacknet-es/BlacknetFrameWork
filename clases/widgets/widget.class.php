<?php
class widget 
{
    private $original;
    private $procesed;
    private $template;
    
    public function __construct($original)
    {
        $this->original = $original;
        $this->template = array(
            'js' => array(),
            'css' => array(),
            'html' => 'inputtext.html',
        );
    }
    
    public function getValue ()
    {
        $this->procesed = $this->original;
        return $this->procesed;
    }
    
    public function setValue ($value)
    {
        return $value;
    }
    
    public function getTemplate()
    {
        return $this->template;
    }
}
