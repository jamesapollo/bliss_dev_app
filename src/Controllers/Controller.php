<?php

namespace App\Controllers;

class Controller
{
    public function render($filename, $data = [])
    {
        extract($data);
        ob_start();
        $class = explode("\\", get_class($this));        
        $folder = ucfirst(str_replace('Controller', '', end($class)));   
        require(ROOT . "Views/" . $folder . "/" . $filename . ".php");
        // ob_get_clean();
    }
}