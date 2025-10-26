<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Grade;
use app\Helpers\Format;
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
        if ($this->gradeModel->checkIfGraded($studentGradeID, $quarter)) {
            throw new \Exception("This subject's quarter is already graded.");
            return;
        }

        $this->gradeModel->createQuarterGrade($studentGradeID, $quarter, Format::formatGrade($grade));
    }   

    public function assignStudentGrade(int $subjectID, int $studentID, float|int $finalGrade = 60.00) 
    {   
        $remarks = $this->gradeRemark($finalGrade);
        if (!$this->gradeModel->getStudentGrade($subjectID, $studentID)) {

            $this->gradeModel->createStudentGrade($subjectID, $studentID, $remarks);
        }
    }

    `public function viewStudentGrades(): array
    {
        return $this->gradeModel->read();
    }

    public function updateStudentGrade(int $studentID, float $grade): void
    {
        $this->gradeModel->update($studentID, Format::formatGrade($grade));
    }

    public function gradeRemark(float $grade) 
    {
        if ($grade >= 70) return 'Passed';
        return 'Failed';
    }

    public function getAllQuarters()
    {
        return $this->gradeModel->getAllQuarterGrades();
    }

    public function getStudentGradeID(int $subjectID, int $studentID) 
    {
        $studentGradeRow = $this->gradeModel->getStudentGrade($subjectID, $studentID);
        return $studentGradeRow['id'];
    }

    public function calculateFinalGrade()
    {
        return $this->gradeModel->calculateFinalGrade();
    }
}   