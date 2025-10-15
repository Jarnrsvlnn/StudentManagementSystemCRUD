<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Student;

class StudentService {
    public function __construct($db, private Student $student)
    {
        
    }
}