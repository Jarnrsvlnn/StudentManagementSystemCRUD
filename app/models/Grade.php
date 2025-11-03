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

    public function getStudentGradeID(int $subjectID, int $studentID) 
    {
        $statement = $this->pdo->prepare("SELECT id FROM student_grades WHERE subject_id = :subject_id AND student_id = :student_id");
        $statement->execute([
            ':subject_id' => $subjectID,
            ':student_id' => $studentID
        ]);
        return $statement->fetch();
    }
    
    public function readStudentQuarterGrades(int $studentID)
    {
        $statement = $this->pdo->prepare("SELECT 
                                        s.full_name,
                                        sub.subject_name,   
                                        MAX(CASE WHEN qg.quarter = '1st' THEN qg.grade END) as q1,  
                                        MAX(CASE WHEN qg.quarter = '2nd' THEN qg.grade END) as q2,
                                        MAX(CASE WHEN qg.quarter = '3rd' THEN qg.grade END) as q3,
                                        MAX(CASE WHEN qg.quarter = '4th' THEN qg.grade END) as q4,
                                        sg.final_grade,
                                        sg.remarks,
                                        sg.avg_grade
                                        FROM student_grades sg
                                        JOIN students s ON sg.student_id = s.id
                                        JOIN subjects sub ON sg.subject_id = sub.id
                                        LEFT JOIN quarter_grades qg ON sg.id = qg.student_grade_id
                                        WHERE s.id = :student_id
                                        GROUP BY s.full_name, sub.subject_name, sg.final_grade, sg.remarks, sg.avg_grade
                                        ");

        $statement->execute([
            ':student_id' => $studentID
        ]);

        return $statement->fetchAll();
    }

    public function readAvgGrades()
    {
        $statement = $this->pdo->query("SELECT 
                                        s.id AS id,
                                        s.student_id,
                                        s.full_name,
                                        sg.avg_grade,
                                        sg.remarks
                                        FROM student_grades sg
                                        JOIN students s ON sg.student_id = s.id
                                        WHERE sg.id = (
                                            SELECT MIN(id)
                                            FROM student_grades
                                            WHERE student_id = sg.student_id
                                        )
                                        ORDER BY s.id ASC                        
                                        ");
        return $statement->fetchAll();                                        
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
    
    public function updateQuarterGrade(int $studentGradeID, string $quarter, float|int $grade) 
    {
        $statement = $this->pdo->prepare("UPDATE quarter_grades SET
                                            grade = :grade
                                            WHERE quarter = :quarter AND student_grade_id = :student_grade_id
                                        ");
        $statement->execute([
            ':grade' => $grade,
            ':quarter' => $quarter,
            ':student_grade_id' => $studentGradeID
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

    public function getAvgGradeData(int $studentID)
    {   
        $statement = $this->pdo->prepare("SELECT student_id, AVG(final_grade) AS avg_grade
                                            FROM student_grades
                                            WHERE student_id = :student_id
                                            GROUP BY student_id
                                        ");
        $statement->execute([
            ':student_id' => $studentID
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

    public function updateAvgGrade(float|int $avgGrade, int $studentID)
    {
        $statement = $this->pdo->prepare("UPDATE student_grades SET avg_grade = :avg_grade WHERE student_id = :student_id");
        $statement->execute([
            ':avg_grade' => $avgGrade,
            ':student_id' => $studentID
        ]);
    }

    public function updateRemark(string $remarks, int $studentGradeID) 
    {
        $statement = $this->pdo->prepare("UPDATE student_grades SET remarks = :remarks WHERE id = :student_grade_id");
        $statement->execute([
            ':remarks' => $remarks,
            ':student_grade_id' => $studentGradeID
        ]);
    }
}