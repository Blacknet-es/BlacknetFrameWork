<?php
class widget 
{
    private $original;
    private $procesed;
    private $template;
    private $options;
    
    public function __construct($original = null, $options = array())
    {
        $this->original = $original;
        $this->options = $options;
        $this->template = array(
            'js' => array(),
            'css' => array(),
            'html' => 'basic.html',
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
        global $app;
        $file = $app->ruta_absoluta_admin.'/widgets/'.get_class($this).'/'.$this->template['html'];
        
        if (!file_exists($file)) {
            $file = $app->ruta_absoluta_admin.'/widgets/basic.html';
        }
        
        $html = file_get_contents($file);
        $tags = '/\{(\w+)\}/i';
        $flags = array();
        preg_match_all($tags, $html, $flags);
        
        foreach ($flags[1] as $f) {
            if ($f != 'VALUE') {
                if (isset($this->options[strtolower($f)])) {
                    $html = str_replace('{'.$f.'}', $this->options[strtolower($f)], $html);
                } else {
                    $html = str_replace('{'.$f.'}', '', $html);
                }
            }
        }
        
        var_dump($html);
        
        if ($this->original != null) {
            $html = str_replace('{VALUE}', $this->getValue(), $html);
        } else {
            $html = str_replace('{VALUE}', '', $html);
        }

        return $html;
    }
}
