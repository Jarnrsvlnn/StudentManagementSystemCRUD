<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;

class Student {

    private PDO $db;

    public function __construct()
    {
        $this->db = Application::$app->db->pdo;
    }

    public function all() {
        $statement = $this->db->query('SELECT * FROM students');
        return $statement->fetchAll();
    }

    public function add() {
        $statement = $this->db->prepare("INSERT INTO students (student_id, full_name, email, gender, address, grade_level) VALUES 
        (:student_id, :full_name, :email, :gender, :address, :grade_level)
        "); 

        // $statement->execute([
        //     ':student_id' => ,
        //     ':full_name' => ,
        //     ':email' => ,
        //     ':gender' => ,
        //     ':address' => ,
        //     ':grade_level' =>
        // ]);
    }
}