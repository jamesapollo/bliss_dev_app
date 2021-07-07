<?php

namespace App\Controllers;

use App\Libs\DB;

class PatientController
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }


    public function list()
    {

    }


    public function add()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
       
        $result = [
            'data' => $this->db->insertPatient($data),
            'success' => true,
        ];
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    
}