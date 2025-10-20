<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\GradeLevel;
use PDO;

class GradeLevelService {

    public function __construct(
        private PDO $db,
        private GradeLevel $gradeLevel
    )
    {}

    public function getAllGradeLevel() {
        return $this->gradeLevel->getAll();
    }        
}