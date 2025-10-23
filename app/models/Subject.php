<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;

class Subject {

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    public function all() 
    {
        $statement = $this->pdo->query('SELECT * FROM subjects');
        return $statement->fetchAll();
    }

    public function find(string $searcher, string $value)
    {
        $statement = $this->pdo->query("SELECT * FROM subjects WHERE $searcher = $value");
        return $statement->fetch();
    } 

    public function create(string $subjectName, string $subjectCode)
    {
        $statement = $this->pdo->prepare("INSERT INTO subjects (subject_name, subject_code) VALUES 
                                        (:subject_name, :subject_code)
                                        ");
        $statement->execute([
            ':subject_name' => $subjectName,
            ':subject_code' => $subjectCode
        ]);
    }

    public function delete(string $subjectCode) 
    {
        $statement = $this->pdo->prepare("DELETE FROM subjects WHERE subject_code = :subject_code");
        $statement->execute([
            ':subject_code' => $subjectCode
        ]);
    }

    public function update(string $subjectCode, string $subjectName) 
    {
        $statement = $this->pdo->prepare("UPDATE subjects SET 
                                            subject_code = :subject_code
                                            subject_name = :subject_name 
                                            WHERE subject_code = :subject_code
                                            ");
        $statement->execute([
            ':subject_code' => $subjectCode,
            ':subject_name' => $subjectName
        ]);
    }
}