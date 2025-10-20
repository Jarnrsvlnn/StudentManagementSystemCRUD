<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;

class Section {

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    public function getAll() {
        $statement = $this->pdo->query("SELECT * FROM sections");
        return $statement->fetchAll();
    }

    public function getByGradeLevel(int $gradeLevelID) {
        $statement = $this->pdo->prepare("SELECT * FROM sections WHERE grade_level_id = :gradeLevelID");
        $statement->execute([
            ':gradeLevelID' => $gradeLevelID
        ]);
        return $statement->fetchAll();
    }
}