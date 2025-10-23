<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Grade;
use PDO;

class GradeService {

    public function __construct(
        private PDO $db,
        private Grade $gradeModel
    )
    {}

}