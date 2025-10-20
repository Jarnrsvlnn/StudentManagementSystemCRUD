<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;

class GradeLevel {

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    public function getAll() {
        $statement = $this->pdo->query('SELECT * FROM grade_levels');
        return $statement->fetchAll();
    }

}