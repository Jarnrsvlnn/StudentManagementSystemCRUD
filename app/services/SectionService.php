<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Section;
use PDO;

class SectionService {

    public function __construct(
        private PDO $db,
        private Section $section
    )
    {}

    public function getAllSection() {
        return $this->section->getAll();
    }

    public function getAllByGradeLevel(int $gradeLevelID) {
        return $this->section->getByGradeLevel($gradeLevelID);
    }
}