<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;
use PDOException;

class Grade {

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }
    
    public function getStudentGrades(int $studentID) 
    {
        $statement = $this->pdo->prepare("SELECT * FROM student_grades WHERE student_id = :student_id");
        $statement->execute([':student_id' => $studentID]);
        return $statement->fetchAll();
    }

    public function checkSubjectExists(int $subjectID, int $studentID): bool
    {
        $studentGrades = $this->getStudentGrades($studentID);

        foreach($studentGrades as $grades) 
        {
            if ((int)$grades['subject_id'] === $subjectID) 
            {
                return true;
            }
        }

        return false;
    }

    public function create(int $subjectID, int $studentID, float $grade, string $remarks) 
    {
        try 
        {
            $statement = $this->pdo->prepare("INSERT INTO student_grades (subject_id, student_id, grade, remarks) VALUES 
                                                (:subject_id, :student_id, :grade, :remarks)");
            $statement->execute([
                ':subject_id' => $subjectID,
                ':student_id' => $studentID,
                ':grade' => $grade,
                ':remarks' => $remarks
            ]);
        } catch(PDOException $e) {
            if ($e->getCode() === '23000') {
                throw new \Exception("This student already has this $subjectID subject.");
            }

            throw $e;
        }
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
        $statement = $this->pdo->prepare("UPDATE student_grades SET 
                                            grade = NULL
                                            remarks = 'N/A'
                                            WHERE student_id = :student_id");
        $statement->execute([':student_id' => $studentID]);
    }
}