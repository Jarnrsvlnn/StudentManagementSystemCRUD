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

    public function all() {
        $statement = $this->db->query('SELECT * FROM students');
        return $statement->fetchAll();
    }
}