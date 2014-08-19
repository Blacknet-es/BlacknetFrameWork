<?php

class hidden extends widget
{
    public function __construct($original = null, $options = array()) {
        $this->original = $original;
        $this->options = $options;
        $this->template = array(
            'js' => array(),
            'css' => array(),
            'html' => 'hidden.html',
        );
    }
}

