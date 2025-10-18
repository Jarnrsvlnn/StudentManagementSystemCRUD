<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Student;
use PDO;

class StudentService {

    public function __construct(
        private PDO $db,
        private Student $student
    )
    {}

    public function getAllStudents()
    {
        return $this->student->all();
    }
    
    public function createStudent(array $studentData): void
    {
        $studentID = $studentData['student-id'];
        $fullName = $studentData['full-name'];
        $email = $studentData['email'];
        $section = $studentData['section'];
        $gender = $studentData['gender'];
        $address = $studentData['address'];
        $gradeLevel = $studentData['grade-level'];

        if ($this->student->findByStudentID($studentID)) {
            throw new \Exception('Student with that ID already exists!');
        }

        if ($this->student->findByStudentName($fullName)) {
            throw new \Exception('Student with that name already exists!');
        }

        $this->student->add($studentID, $fullName, $email, $section, $gender, $address, $gradeLevel);
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
        $section = $studentData['section'];
        $gender = $studentData['gender'];
        $address = $studentData['address'];
        $gradeLevel = $studentData['grade-level'];

        $existingStudent = $this->student->findByStudentName($fullName);
        if ($existingStudent && $existingStudent['student_id'] !== $studentID) {
            throw new \Exception('Student with that name already exists!');
        }

        $this->student->update($studentID, $fullName, $email, $section, $gender, $address, $gradeLevel);
    }
}