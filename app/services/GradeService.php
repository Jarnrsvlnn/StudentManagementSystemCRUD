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
    
    public function assignGrade(int $subjectID, int $studentID, float $grade): void
    {
        if ($this->gradeModel->checkSubjectExists($subjectID, $studentID)) 
        {
            throw new \Exception("This student already has a subject $subjectID");
        }

        $remarks = $this->gradeRemark($grade);

        $this->gradeModel->create($subjectID, $studentID, Format::formatGrade($grade), $remarks);
    }

    public function viewStudentGrades(): array
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
}