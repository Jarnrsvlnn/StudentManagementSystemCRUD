<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Section;
use app\Models\Student;
use app\Services\SectionService;
use PDO;

class StudentService {

    private SectionService $sectionService;

    public function __construct(
        private PDO $db,
        private Student $student
    )
    {
        $this->sectionService = new SectionService($this->db, new Section);
    }

    public function getAllStudents()
    {
        return $this->student->all();
    }

    public function assignSection(int $section, int $gradeLevelID): int
    {
        $sectionRow = $this->sectionService->getSectionByGradeLevel($section, $gradeLevelID);
 
        if (!$sectionRow) {
            throw new \Exception("Section not found for grade level ID: {$gradeLevelID}");
        }
        return $sectionRow['id'];
    }
    
    public function createStudent(array $studentData): void
    {
        $studentID = $studentData['student-id'];
        $fullName = $studentData['full-name'];
        $email = $studentData['email'];
        $gender = $studentData['gender'];
        $address = $studentData['address'];
        $tempSectionID = (int) $studentData['section-id'];  
        $gradeLevelID = (int) $studentData['grade-level-id'];

        $sectionID = $this->assignSection($tempSectionID, $gradeLevelID);

        if ($this->student->findByStudentID($studentID)) {
            throw new \Exception('Student with that ID already exists!');
        }

        if ($this->student->findByStudentName($fullName)) {
            throw new \Exception('Student with that name already exists!');
        }

        $this->student->add($studentID, $fullName, $email, $gender, $address, $sectionID, $gradeLevelID);
    }

    public function deleteStudent(array $studentData): void
    {
        $studentID = $studentData['student-id'];

        if (!$this->student->findByStudentID($studentID)) {
            throw new \Exception('Student not found!');
        }
        
        $this->student->delete($studentID);
    }

    public function updateStudent(array $studentData): void 
    {
        $studentID = $studentData['student-id'];
        $fullName = $studentData['full-name'];
        $email = $studentData['email'];
        $gender = $studentData['gender'];
        $address = $studentData['address'];
        $sectionID = $studentData['section-id'];
        $gradeLevelID = $studentData['grade-level-id'];

        $existingStudent = $this->student->findByStudentName($fullName);
        if ($existingStudent && $existingStudent['student_id'] !== $studentID) {
            throw new \Exception('Student with that name already exists!');
        }

        $this->student->update($studentID, $fullName, $email, $gender, $address, $sectionID, $gradeLevelID);
    }
}