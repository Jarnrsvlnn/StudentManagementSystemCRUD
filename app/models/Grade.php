<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;

class Grade {

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    public function create(int $subjectID, int $studentID, float $grade, string $remarks) 
    {
        $statement = $this->pdo->prepare("INSERT INTO student_grades (subject_id, student_id, grade, remarks) VALUES 
                                            (:subject_id, :student_id, :grade, :remarks)");
        $statement->execute([
            ':subject_id' => $subjectID,
            ':student_id' => $studentID,
            ':grade' => $grade,
            ':remarks' => $remarks
        ]);
    }

    public function read()
    {
        $statement = $this->pdo->query("SELECT * FROM student_grades");
        return $statement->fetchAll();
    }

    public function update(int $studentID, float $grade) 
    {
        $statement = $this->pdo->prepare("UPDATE student_grades SET
                                        grade = :grade
                                        WHERE student_id = :student_id");
        $statement->execute([
            ':grade' => $grade,
            ':student_id' => $studentID
        ]);
    }

    public function delete(int $studentID) 
    {
        $statement = $this->pdo->prepare("DELETE FROM student_grades WHERE student_id = :student_id");
        $statement->execute([':student_id' => $studentID]);
    }
}