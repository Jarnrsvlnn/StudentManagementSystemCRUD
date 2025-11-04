<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Grade;
use app\Helpers\Format;
use Exception;
use PDO;

class GradeService {

    public function __construct(
        private PDO $db,
        private Grade $gradeModel
    )
    {}  
    
    public function assignQuarterGrade(int $studentGradeID, string $quarter, float $grade): void
    {
        $remarks = $this->gradeRemark($grade);
        if (!$this->gradeModel->checkIfGraded($studentGradeID, $quarter)) {
            $this->gradeModel->createQuarterGrade($studentGradeID, $quarter, Format::formatGrade($grade));
            return;
        }

        throw new Exception("This quarter is already graded!"); 
    }

    public function assignStudentGrade(int $subjectID, int $studentID, float|int $finalGrade = 60.00) 
    {   
        $remarks = $this->gradeRemark($finalGrade);
        if (!$this->gradeModel->getStudentGradeID($subjectID, $studentID)) {
            $this->gradeModel->createStudentGrade($subjectID, $studentID, $remarks);
        }
    }

    public function viewStudentQuarterGrades(int $studentID) 
    {
        return $this->gradeModel->readStudentQuarterGrades($studentID);
    }

    public function viewAvgGrades(): array
    {
        return $this->gradeModel->readAvgGrades();
    }
    
    public function updateQuarterGrade(int $subjectID, int $studentID, string $quarter, float|int $grade)
    {
        $studentGradeID = $this->gradeModel->getStudentGradeID($subjectID, $studentID);
        if ($this->gradeModel->checkIfGraded($studentGradeID, $quarter)) 
        {
            $this->gradeModel->updateQuarterGrade($studentGradeID, $quarter, $grade);
            $this->calculateFinalGrade($studentGradeID);
            $this->calculateAvgGrade($studentID);
            return;
        }
        
        throw new Exception("This quarter is not graded yet.");
    }    

    public function gradeRemark(int|float $grade) 
    {
        if ($grade >= 70) return 'Passed';
        return 'Failed';
    }

    public function getStudentGradeID(int $subjectID, int $studentID) 
    {
        $studentGradeID = $this->gradeModel->getStudentGradeID($subjectID, $studentID);
        return $studentGradeID;
    }

    public function calculateFinalGrade(int $studentGradeID) 
    {
        $finalGradesData = $this->gradeModel->getFinalGradeData($studentGradeID);
        $finalGrade = (float) $finalGradesData['final_grade'];
        $studentGradeID = $finalGradesData['student_grade_id'];

        $this->gradeModel->updateFinalGrade($finalGrade, $studentGradeID);
        $this->gradeModel->updateRemark($this->gradeRemark($finalGrade), $studentGradeID);
    }

    public function calculateAvgGrade(int $studentID) 
    {
        $avgGradeData = $this->gradeModel->getAvgGradeData($studentID);
        $avgGrade = (float) $avgGradeData['avg_grade'];
        $studentID = $avgGradeData['student_id'];

        $this->gradeModel->updateAvgGrade($avgGrade, $studentID);
    }
}   