<?php
class info extends component
{
    public $title;
    public $description;
    public $metades;
    public $metatag;
    
    public function config()
    {
        parent::config();
        $options = array('order' => 11);
        $this->addWidget('description', 'textarea', $options);
    }
}
