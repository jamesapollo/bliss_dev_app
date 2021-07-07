<?php

namespace App\Controllers;

use App\Libs\DB;

class ApiController
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }


    public function getPatients()
    {        
        header('Content-Type: application/json');
        echo json_encode($this->db->getAllPatients());
    }

    public function getGender()
    {
        header('Content-Type: application/json');
        echo json_encode($this->db->getAllGender());    
    }

    public function getServices()
    {
        header('Content-Type: application/json');
        echo json_encode($this->db->getAllServices());    
    }
}