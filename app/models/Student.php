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

    public function add(string $studentID, string $fullName, string $email, string $gender, string $address, int $sectionID, int $gradeLevelID) {
        $statement = $this->pdo->prepare("INSERT INTO students (student_id, full_name, email, gender, address, section_id, grade_level_id) VALUES 
        (:student_id, :full_name, :email, :gender, :address, :section_id, :grade_level_id)
        "); 

        $statement->execute([
            ':student_id' => $studentID,
            ':full_name' => $fullName,
            ':email' => $email,
            ':gender' => $gender,
            ':address' => $address,
            ':section_id' => $sectionID,
            ':grade_level_id' => $gradeLevelID
        ]);
    }

    public function findByStudentID(string $studentID) {
        $statement = $this->pdo->prepare("SELECT * FROM students WHERE student_id = :studentID");
        $statement->execute([':studentID' => $studentID]);
        return $statement->fetch();
    }

    public function findByStudentName(string $fullName) {
        $statement = $this->pdo->prepare("SELECT * FROM students WHERE full_name = :fullName");
        $statement->execute([':fullName' => $fullName]);
        return $statement->fetch();
    }

    public function delete(string $studentID) {
        $statement = $this->pdo->prepare("DELETE FROM students WHERE student_id = :studentID");
        $statement->execute([':studentID' => $studentID]);
    }

    public function update(string $studentID, string $fullName, string $email, string $gender, string $address, int $sectionID, int $gradeLevelID) {
        $statement = $this->pdo->prepare("UPDATE students SET 
                                            full_name = :fullName,
                                            email = :email,
                                            address = :address,
                                            gender = :gender,
                                            section_id = :sectionID,
                                            grade_level_id = :gradeLevelID
                                            WHERE student_id = :studentID
        ");
        
        $statement->execute([
            ':fullName' => $fullName,
            ':email' => $email,
            ':address' => $address,
            ':gender' => $gender,
            ':sectionID' => $sectionID,
            ':gradeLevelID' => $gradeLevelID,
            ':studentID' => $studentID
        ]);
    }
}