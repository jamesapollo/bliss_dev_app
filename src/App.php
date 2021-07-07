<?php

namespace App;

use App\Libs\Request;

class App
{
    /**
     * App\Libs\Request $request
     */
    private $request;

    public function __construct()
    {
        $this->request = new Request();;
    }

    public function run()
    {       
        $this->request->dispatch();
    }
}