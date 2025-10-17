<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;

class Student {

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    public function all() {
        $statement = $this->pdo->query('SELECT * FROM students');
        return $statement->fetchAll();
    }

    public function add($studentID, $fullName, $email, $gender, $address, $gradeLevel) {
        $statement = $this->pdo->prepare("INSERT INTO students (student_id, full_name, email, gender, address, grade_level) VALUES 
        (:student_id, :full_name, :email, :gender, :address, :grade_level)
        "); 

        $statement->execute([
            ':student_id' => $studentID,
            ':full_name' => $fullName,
            ':email' => $email,
            ':gender' => $gender,
            ':address' => $address,
            ':grade_level' => $gradeLevel
        ]);
    }

    public function findByStudentID($studentID) {
        $statement = $this->pdo->prepare("SELECT * FROM students WHERE student_id = :studentID");
        $statement->execute([':studentID' => $studentID]);
        return $statement->fetch();
    }

    public function findByStudentName($fullName) {
        $statement = $this->pdo->prepare("SELECT * FROM students WHERE full_name = :fullName");
        $statement->execute([':fullName' => $fullName]);
        return $statement->fetch();
    }

    public function deleteStudent(string $studentID) {
        $statement = $this->pdo->prepare("DELETE FROM students WHERE student_id = :studentID");
        $statement->execute([':studentID' => $studentID]);
    }
}