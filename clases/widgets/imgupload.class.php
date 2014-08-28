<?php

class imgupload extends widget
{
    public $valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    public $max_size; // max file size
    public $path = 'img/';
    
    public function __construct($original = null, $options = array()) 
    {
        parent::__construct($original, $options);
        $this->template = array(
            'js' => array(),
            'css' => array(),
            'html' => 'imgupload.html',
        );
        
        $this->max_size = 200 * 1024;
    }
    
    public function ajaxSubmit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if( ! empty($_FILES['image']) ) {
                // get uploaded file extension
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                // looking for format and size validity
                if (in_array($ext, $this->valid_exts) AND $_FILES['image']['size'] < $this->max_size) {
                    $this->path = $this->path . uniqid(). '.' .$ext;
                    // move uploaded file from temp to uploads directory
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $this->path)) {
                        echo "<img src='$this->path' />";
                    }
                } else {
                    echo 'Invalid file!';
                }
            } else {
                echo 'File not uploaded!';
            }
        } else {
            echo 'Bad request!';
        }
    }
}
