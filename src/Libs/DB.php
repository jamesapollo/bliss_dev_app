<?php

namespace App\Libs;

class DB
{
    private $conn;

    public function __construct()
    {
        $db_host = Config::get('db_host');
        $db_username = Config::get('db_username');
        $db_pass = Config::get('db_password');
        $db_name = Config::get('db_name');

        $this->conn =  mysqli_connect($db_host, $db_username, $db_pass, $db_name);
    }

    public function getAllPatients()
    {
        $sql = "SELECT p.pk_id AS id, p.patient_name, p.date_of_birth, 
        p.general_comment, g.gender AS gender, s.service_type AS service
        FROM tbl_patient AS p JOIN tbl_gender AS g ON g.pk_id = p.fk_gender 
        JOIN tbl_service AS s ON s.pk_id = p.fk_service;";

        $result = $this->conn->query($sql);
        if (!$result) {
            print_r($this->conn->error);
        } else{
            
            if (mysqli_num_rows($result) > 0) {
                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $rows[] = $row;
                }
                return $rows;
            } 
            return [];
        }
    }

    public function insertPatient($data)
    {        
        $sql = "INSERT INTO tbl_patient(patient_name, date_of_birth, fk_gender,
        fk_service, general_comment) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->conn->prepare($sql);
        $statement->bind_param("sssss", $data['patient_name'], $data['date_of_birth'], $data['fk_gender'], $data['fk_service'], $data['general_comment']);
        $statement->execute();
        return $this->getPatientById($this->conn->insert_id);
    }

    public function getPatientById($id)
    {
        $sql = "SELECT p.pk_id AS id, p.patient_name, p.date_of_birth, 
        p.general_comment, g.gender AS gender, s.service_type AS service
        FROM tbl_patient AS p JOIN tbl_gender AS g ON g.pk_id = p.fk_gender 
        JOIN tbl_service AS s ON s.pk_id = p.fk_service WHERE p.pk_id = $id";

        $result = $this->conn->query($sql);
        if (!$result) {
            print_r($this->conn->error);
        } else{
            
            // while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            //     $rows[] = $row;
            // }
            return $result->fetch_array(MYSQLI_ASSOC);
        }
    }

    public function getAllGender()
    {
        $sql = "SELECT pk_id AS id, gender FROM tbl_gender;";

        $result = $this->conn->query($sql);
        if (!$result) {
            print_r($this->conn->error);
        } else{
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public function getAllServices()
    {
        $sql = "SELECT pk_id AS id, service_type FROM tbl_service;";

        $result = $this->conn->query($sql);
        if (!$result) {
            print_r($this->conn->error);
        } else{
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

}