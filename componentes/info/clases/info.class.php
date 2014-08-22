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
        $this->addWidget('title', 'inputtext', array('classes' => 'input-lg'));
        $this->addWidget('description', 'textarea', array('order' => 11));
        $this->addWidget('order', 'hidden', array('nobd' => true));
    }
}
