<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;

class Grade {

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }


}