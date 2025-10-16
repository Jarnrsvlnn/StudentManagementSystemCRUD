<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Student;
use PDO;

class StudentService {

    public function __construct(
        PDO $db, 
        private Student $student
        )
    {
        
    }

    public function getAllStudents() 
    {
        return $this->student->all();
    }
    
}