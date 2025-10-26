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

    public function getAllQuarterGrades() 
    {
        $statement = $this->pdo->query("SELECT * FROM quarter_grades");
    }
    
    public function allStudentGrades(int $studentID) 
    {
        $statement = $this->pdo->prepare("SELECT * FROM student_grades WHERE student_id = :student_id");
        $statement->execute([':student_id' => $studentID]);
        return $statement->fetchAll();
    }

    public function getStudentGrade(int $subjectID, int $studentID) 
    {
        $statement = $this->pdo->prepare("SELECT * FROM student_grades WHERE subject_id = :subject_id AND student_id = :student_id");
        $statement->execute([
            ':subject_id' => $subjectID,
            ':student_id' => $studentID
        ]);
        return $statement->fetch();
    }

    public function checkSubjectExists(int $subjectID, int $studentID): bool
    {
        $studentGrades = $this->allStudentGrades($studentID);

        foreach($studentGrades as $grades) 
        {
            if ((int)$grades['subject_id'] === $subjectID) 
            {
                return true;
            }
        }

        return false;
    }

    public function checkIfGraded(int $studentGradeID, string $quarter): array|bool
    {
        $statement = $this->pdo->prepare("SELECT * FROM quarter_grades WHERE student_grade_id = :student_grade_id AND quarter = :quarter");
        $statement->execute([
            ':student_grade_id' => $studentGradeID,
            ':quarter' => $quarter
        ]);
        return $statement->fetch();
    }

    public function createQuarterGrade(int $studentGradeID, string $quarter, float $grade) 
    {
        $statement = $this->pdo->prepare("INSERT INTO quarter_grades (student_grade_id, quarter, grade) VALUES 
                                            (:student_grade_id, :quarter, :grade)
                                            ");
        $statement->execute([
            ':student_grade_id' => $studentGradeID,
            ':quarter' => $quarter,
            ':grade' => $grade
        ]);
    }

    public function createStudentGrade(int $subjectID, int $studentID, string $remarks)
    {
        $statement = $this->pdo->prepare("INSERT INTO student_grades (subject_id, student_id, remarks) VALUES
                                        (:subject_id, :student_id, :remarks)
                                        ");
        $statement->execute([
            ':subject_id' => $subjectID,
            ':student_id' => $studentID,
            ':remarks' => $remarks
        ]);                                        
    }

    public function read()
    {
        $statement = $this->pdo->query("SELECT 
                                        s.student_id,
                                        s.full_name,
                                        sub.subject_code,
                                        g.grade,
                                        g.remarks
                                        FROM student_grades g
                                        JOIN students s ON  g.student_id = s.id
                                        JOIN subjects sub ON g.subject_id = sub.id
                                        ORDER BY s.id ASC
                                        ");
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

    public function getFinalGradeData(int $studentGradeID)
    {
        $statement = $this->pdo->prepare("SELECT student_grade_id, AVG(grade) AS final_grade
                                            FROM quarter_grades
                                            WHERE student_grade_id = :student_grade_id
                                            GROUP BY student_grade_id
                                            ");
        $statement->execute([
            ':student_grade_id' => $studentGradeID
        ]);
        return $statement->fetch();
    }

    public function updateFinalGrade(float|int $finalGrade, int $studentGradeID)
    {
        $statement = $this->pdo->prepare("UPDATE student_grades SET final_grade = :final_grade WHERE id = :student_grade_id");
        $statement->execute([
            ':final_grade' => $finalGrade,
            ':student_grade_id' => $studentGradeID
        ]);
    }
}