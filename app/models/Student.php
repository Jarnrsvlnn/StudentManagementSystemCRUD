<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;

class Student {

    private PDO $db;

    public function __construct()
    {
        $this->db = Application::$app->db->pdo;
    }

    public function selectAll() {
        
    }
}