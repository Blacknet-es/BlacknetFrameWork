<?php
class blog extends component
{
    public $title;
    public $description;
    public $image;
    public $metades;
    public $metatag;
    
    public function config()
    {
        parent::config();
        $this->addWidget('title', 'inputtext', array('classes' => 'input-lg'));
        $this->addWidget('image', 'imgupload');
        $this->addWidget('description', 'textarea', array('order' => 11));
        $this->addWidget('order', 'hidden', array('nobd' => true));
    }
}
