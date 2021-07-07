<?php

namespace App\Libs;

class Request
{
    public $url;

    private $exploded_url;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        // print_r($this->url);
        $this->exploded_url = array_slice(explode("/", $this->url), 1);   
    }

    public function dispatch()
    {
        // print_r("gggg");
        // print_r($this->action());
        call_user_func([$this->controller(), $this->action()]);
    }

    public function controller()
    {
        $controller = $this->exploded_url[0];
        if ($controller === "" || $controller === "index" || $controller === "home") {
            $controller = "home";
        }

        $controller = ucfirst($controller) . 'Controller';
        $class = "App\\Controllers\\$controller";
        return new $class;
    }

    public function action()
    {
        if (count($this->exploded_url) == 1) {
            $action = "index";
        }elseif ($this->exploded_url[1] == "" || $this->exploded_url[1] == null) {
            $action = "index";
        } else {
            $action = $this->exploded_url[1];
        }
        return $action;
    }

    public function params()
    {
        return array_splice($this->exploded_url, 2);
    }
}