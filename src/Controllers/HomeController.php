<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Libs\DB;

class HomeController extends Controller
{
    public function index()
    {
        $db = new DB();

        $patients = $db->getAllPatients();
        $genders = $db->getAllGender();
        $services = $db->getAllServices();

        return $this->render("index", [
            'patients' => $patients,
            'genders' => $genders,
            'services' => $services
        ]);
    }
}