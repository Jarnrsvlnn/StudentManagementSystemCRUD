<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Subject;
use PDO;

class SubjectService {

    public function __construct(
        private PDO $db,
        private Subject $subjectModel
    )
    {}

}