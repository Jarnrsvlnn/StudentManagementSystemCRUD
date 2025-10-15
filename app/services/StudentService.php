<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Student;

class StudentService {
    public function __construct($db, private Student $student)
    {
        
    }

    public function getAllStudents() 
    {
         
    }
}