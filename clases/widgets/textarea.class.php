<?php

/**
 * Description of textarea
 *
 * @author jesus
 */
class textarea extends widget
{
    public function __construct($original = null, $options = array()) {
        parent::__construct($original, $options);
        $this->template = array(
            'js' => array(),
            'css' => array(),
            'html' => 'textarea.html',
        );
    }
}
